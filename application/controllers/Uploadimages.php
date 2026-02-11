<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Uploadimages extends CI_Controller {
public function index()
    {
    $this->load->view('includes/header');
    $this->load->view('upload_browse_view');
    $this->load->view('includes/footer');
    }
    public function uploadimage(){
    $this->load->library('form_validation');
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
    $this->form_validation->set_rules('title', 'Title', 'required|min_length[4]');
    if ($this->form_validation->run() == FALSE){
    $this->load->view('includes/header');
    $this->load->view('upload_view');
    $this->load->view('includes/footer');
    }
    else{
    $config['upload_path'] = 'uploads/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '10000';
    $config['max_width'] = '4000';
    $config['max_height'] = '3000';
    $this->load->library('upload', $config);
    if ( ! $this->upload->do_upload())
    {
    $error = array('error' => $this->upload->display_errors());
    $this->load->view('includes/header');
    $this->load->view('upload_view', $error);// this will display upload errors thru
    $this->load->view('includes/footer');
    }else{
    //echo "all good";

    // get filename of uploaded image to resize and put into DB
    $tmp = array('upload_data' => $this->upload->data());
    $filename = $tmp['upload_data']['file_name'];
    // resize image, and move it
    $this->load->library('image_lib');
    $config1['image_library'] = 'gd2';
    $config1['source_image'] = 'uploads/'. $filename;
    $config1['new_image'] = 'uploads/thumbnails/'. $filename;
    $config1['create_thumb'] = FALSE;
    $config1['maintain_ratio'] = TRUE;
    $config1['width'] = 300;
    $config1['height'] = 300;
    $this->image_lib->initialize($config1);
    $this->image_lib->resize();
    $this->image_lib->clear();
    /*************************************************************
    HERE IS THE OTHER STUFF THAT YOU SHOULD ALREADY KNOW HOW TO DO
    *************************************************************/
    // grab other form data, and insert all into DB
    //$data['title'] = $this->input->post('title');
    //$data['author_id']= $author_id; // got this from ion_auth
    //$data['filename'] = $filename; // got this from the $_FILES array above
    // do your DB stuff here
    // inform user and redirec
    }
    }
    } // end uploadimage()
}