<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index() {
        $this->load->view('login');
    }

    public function check_input() {
        //Check user input here
        $form_data = $this->input->post();
        $username = $form_data["username"];
        $password = $form_data["password"];

        redirect('/Welcome');
    }

}
