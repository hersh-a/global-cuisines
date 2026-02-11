<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('crud_model'); // load your model once in constructor
    }

    public function index() {
        // Fetch all cuisines from the model
        $data['results'] = $this->crud_model->get_all_cuisines();

        // Load views
        $this->load->view('includes/header');
        $this->load->view('home_view', $data); // pass $data to the view
        $this->load->view('includes/footer');
    }
}
