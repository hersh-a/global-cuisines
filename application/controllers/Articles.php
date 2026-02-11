<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Articles extends CI_Controller {
    function __construct() {
    parent::__construct();
    $this->load->helper('form'); // loading this for the entire class/controller
    $this->load->library('form_validation'); // loading this for the entire class/controller
    $this->load->database(); // ummm...ditto
    $this->load->library('typography');
    $this->load->model('crud_model');
    $this->load->library('ion_auth');

    }
    public function index(){
    $data['heading'] = "Global Cuisines";
    $this->load->model('crud_model');
    $data['results'] = $this->crud_model->get_cuisines();
    $this->load->view('includes/header', $data);
    $this->load->view('crud_read_view',$data);
    $this->load->view('includes/footer');
    }

    public function detail($id)
    {
    /* We need to add some security and a "graceful exit: in case of a URL manipulation or other
    error that prevents us from getting the required $id */
    if(!is_numeric($id)){ /* if this parameter is missing, or wrong format...*/
    /* best to just redirect*/
    redirect('/', 'location');
    }
    $this->load->library('typography');
    $data['heading'] = "";

    $this->load->model('crud_model');
    $data['cuisine'] = $this->crud_model->get_cuisine_detail($id);
    $this->load->view('includes/header',$data);
    $this->load->view('crud_detail_view',$data);
    $this->load->view('includes/footer');
    }// \ detail

    public function write()
    {

        if (!$this->ion_auth->logged_in())
        {
        redirect('/auth/login/');
        }else{
        $data['author_id'] = $this->ion_auth->user()->row()->id;
        }
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
    $this->form_validation->set_rules('cuisine_name', 'cuisine Name',
    'required|min_length[3]|max_length[40]');
    $this->form_validation->set_rules('description', 'Description',
    'required|min_length[20]|max_length[2000]');
    if ($this->form_validation->run() == FALSE)
    {
    $this->load->view('includes/header');
    $this->load->view('crud_write_view');
    $this->load->view('includes/footer');
    }
    else
    {
    //echo "SUCCESS";
    // retrieve POSTED form data
    $data['cuisine_name'] = $this->input->post('cuisine_name');
    $data['description']= $this->input->post('description');

    $this->load->library('upload');
    $this->load->library('image_lib');

        $imageName = null; // default

        if (!empty($_FILES['image']['name'])) 
        {
            // Upload config
            $config['upload_path']   = './uploads/';     // Make sure folder exists
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = 2048;             // 2MB
            $config['encrypt_name']  = TRUE;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('image'))
            {
                $uploadData = $this->upload->data();
                $imageName  = $uploadData['file_name'];   // store filename for DB

                // Thumbnail config
                $resize['image_library']  = 'gd2';
                $resize['source_image']   = './uploads/' . $imageName;
                $resize['new_image']      = './uploads/thumbnails/' . $imageName;
                $resize['maintain_ratio'] = TRUE;
                $resize['width']          = 200;
                $resize['height']         = 200;

                $this->image_lib->initialize($resize);
                $this->image_lib->resize();
                $this->image_lib->clear();
            }
            else
            {
                // Show upload errors
                echo $this->upload->display_errors();
                return;
            }
        }

        // Save file name to database
        $data['image'] = $imageName;

    $this->load->model('crud_model');
    $this->crud_model->insert_cuisine($data);

    $this->session->set_userdata('message', 'Insert Successful');

    redirect("articles/index", 'location');
    
    }
    } // \ write
public function edit($id)
{
    // Get logged-in user ID
    $user_id = $this->ion_auth->user()->row()->id;

    // Check ownership
    if (!$this->crud_model->check_owner($id, $user_id) && !$this->ion_auth->is_admin()) {
        $this->session->set_flashdata('message', 'Unauthorized access.');
        redirect('articles', 'refresh');
    }

    if (!is_numeric($id)) {
        redirect('/', 'location');
    }

    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
    $this->form_validation->set_rules('cuisine_name', 'Cuisine Name', 'required|min_length[3]|max_length[40]');
    $this->form_validation->set_rules('description', 'Description', 'required|min_length[20]|max_length[2000]');

    $this->load->model('crud_model');

    if ($this->form_validation->run() == FALSE) {
        $data['results'] = $this->crud_model->get_cuisine_detail($id);
        $this->load->view('includes/header');
        $this->load->view('crud_edit_view', $data);
        $this->load->view('includes/footer');
    } else {
        $data['cuisine_name'] = $this->input->post('cuisine_name');
        $data['description']  = $this->input->post('description');

        $oldCuisine = $this->crud_model->get_cuisine_detail($id);

        // Default: preserve old image
        $data['image'] = $oldCuisine->image;

        // Handle new image upload
        if (!empty($_FILES['image']['name'])) {
            $config['upload_path']   = './uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['max_size']      = 2048;
            $config['encrypt_name']  = TRUE;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                $uploadData = $this->upload->data();
                $imageName  = $uploadData['file_name'];
                $data['image'] = $imageName;

                // Create thumbnail
                $resize['image_library']  = 'gd2';
                $resize['source_image']   = './uploads/' . $imageName;
                $resize['new_image']      = './uploads/thumbnails/' . $imageName;
                $resize['maintain_ratio'] = TRUE;
                $resize['width']          = 200;
                $resize['height']         = 200;

                $this->load->library('image_lib', $resize);
                $this->image_lib->resize();
                $this->image_lib->clear();

                // Delete old image if exists
                if (!empty($oldCuisine->image)) {
                    @unlink('./uploads/' . $oldCuisine->image);
                    @unlink('./uploads/thumbnails/' . $oldCuisine->image);
                }
            } else {
                echo $this->upload->display_errors();
                return;
            }
        }

        // Save updated data
        $this->crud_model->edit_cuisine($data, $id);

        $this->session->set_userdata('message', 'Edit Successful');
        redirect('articles/edit/' . $id, 'location');
    }
}


    public function delete($id) 
    {

        // Get logged-in user ID
        $user_id = $this->ion_auth->user()->row()->id;

        // Check ownership
        if (!$this->crud_model->check_owner($id, $user_id) && !$this->ion_auth->is_admin()) {
            $this->session->set_flashdata('message', 'Unauthorized access.');
            redirect('articles', 'refresh');
        }

        if(!is_numeric($id)){
        redirect('/', 'location');
        }

    $this->load->model('crud_model'); 
    $this->crud_model->delete_cuisine($id);
    $this->session->set_userdata('message', 'Deleted Successful');
    redirect('articles' . $id, 'location');
    }
 // \ delete
 
}

// Ensure thumbnail exists for existing image if no new image uploaded
if (!empty($data['image'])) {
    $thumbPath = './uploads/thumbnails/' . $data['image'];
    $fullPath = './uploads/' . $data['image'];
    if (!file_exists($thumbPath) && file_exists($fullPath)) {
        $resize = [
            'image_library'  => 'gd2',
            'source_image'   => $fullPath,
            'new_image'      => $thumbPath,
            'maintain_ratio' => TRUE,
            'width'          => 200,
            'height'         => 200
        ];
        $this->image_lib->initialize($resize);
        $this->image_lib->resize();
        $this->image_lib->clear();
    }
}
