<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     */
    public function index() {
        $data['title'] = "Harvesting Data";
        $data['custom_config'] = json_decode(file_get_contents(FCPATH . 'config.json'), true);

        $this->load->view('header', $data);
        $this->load->view('config', $data);
        $this->load->view('footer');
    }
    
    public function viewPage1() {
        $data['title'] = "Data";
        $data['custom_config'] = json_decode(file_get_contents(FCPATH . 'page1.json'), true);
        
        $this->load->view('header', $data);
        $this->load->view('data', $data);
        $this->load->view('footer');
    }
    
    public function viewPage2() {
        $data['title'] = "Data";
        $data['custom_config'] = json_decode(file_get_contents(FCPATH . 'page2.json'), true);
        
        $this->load->view('header', $data);
        $this->load->view('data', $data);
        $this->load->view('footer');
    }
    
    public function viewPage3() {
        $data['title'] = "Data";
        $data['custom_config'] = json_decode(file_get_contents(FCPATH . 'page3.json'), true);
        
        $this->load->view('header', $data);
        $this->load->view('data', $data);
        $this->load->view('footer');
    }
    
    public function viewPage4() {
        $data['title'] = "Data";
        $data['custom_config'] = json_decode(file_get_contents(FCPATH . 'page4.json'), true);
        
        $this->load->view('header', $data);
        $this->load->view('data', $data);
        $this->load->view('footer');
    }

}
