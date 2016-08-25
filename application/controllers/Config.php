<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     */
    public function index() {
        $data['title'] = "Harvesting Configuration";
        $this->config->load('custom');
        $data['custom_config'] = $this->config->item('custom');
        
        $this->load->view('header', $data);
        $this->load->view('config', $data);
        $this->load->view('footer');
    }

    public function save() {
        
    }

    public function addPage() {
        $data['page_index'] = $this->input->post('pageIndex');
        header('Access-Control-Allow-Origin: *');
        $this->load->view('config-page', $data);
    }
}
