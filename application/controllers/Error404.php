<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Error404 extends CI_Controller {
    public function index()
    {
        {
            $data['heading'] = "404 - Page Not Found";
            $data['picture'] = "empty-plate.png";
            $data['message'] = "<p>Sorry. It appears the page you are looking for does not exist.</p>";
            $this->load->view('includes/header');
            $this->load->view('error404_view',$data); // we need to pass the array to the view
            $this->load->view('includes/footer');
        }

    }
}