<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     */
    public function index() {
        $data['title'] = "Harvesting Web App";
        $this->load->view('header', $data);
        $this->load->view('home');
        $this->load->view('footer');
    }

}
