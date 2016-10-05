<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     */
    public function index() {
        $data['title'] = "Harvesting Configuration";
        $data['custom_config'] = json_decode(file_get_contents(FCPATH . 'config.json'), true);

        $this->load->view('header', $data);
        $this->load->view('config', $data);
        $this->load->view('footer');
    }

    public function save() {
        $config_data = $this->input->post('config');
        //Store config data to config.json file
        $save_result = file_put_contents(FCPATH . 'config.json',$config_data);
        $response = ($save_result == false) ? "Fail" : "OK";
        echo $response;
        exit;
    }

    public function addPage() {
        $data['page_index'] = $this->input->post('pageIndex');
        $this->load->view('config-page', $data);
    }

    public function addObject() {
        $this->load->view('config-object');
    }

    public function addAttribute() {
        $this->load->view('config-attribute');
    }
    
    public function viewConfigJSON() {
        $data['title'] = "Config JSON";
        $data['custom_config'] = json_decode(file_get_contents(FCPATH . 'config.json'), true);
        
        $this->load->view('header', $data);
        $this->load->view('config-json', $data);
        $this->load->view('footer');
    }
    
    public function viewSiblingsJSON() {
        $data['title'] = "Config Siblings JSON";
        $data['custom_config'] = json_decode(file_get_contents(FCPATH . 'config-siblings.json'), true);
        
        $this->load->view('header', $data);
        $this->load->view('config-json', $data);
        $this->load->view('footer');
    }

}
