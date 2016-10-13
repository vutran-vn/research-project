<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     */
    public function index() {
        $data['title'] = "Harvesting Data";
        $data['custom_config'] = json_decode(file_get_contents(FCPATH . 'data/config/config.json'), true);

        $this->load->view('header', $data);
        $this->load->view('config', $data);
        $this->load->view('footer');
    }
    
    public function viewSample() {
        $data['title'] = "Harvesting Data Sample";
        $data['sample_pages'] = json_decode(file_get_contents(FCPATH . 'data/sample/sample-pages.json'), true);
        
        $page = $this->input->post('page');
        if($page) {
            $data['page_data'] = json_decode(file_get_contents(FCPATH . $page), true);
        }

        $this->load->view('header', $data);
        $this->load->view('data-sample', $data);
        $this->load->view('footer');
    }
    
    public function viewSampleJSON() {
        $data['title'] = "Harvesting Data Sample";
        $data['sample_pages'] = json_decode(file_get_contents(FCPATH . 'data/sample/sample-pages.json'), true);
        
        $page = $this->input->post('page');
        if($page) {
            $data['page_data'] = json_decode(file_get_contents(FCPATH . $page), true);
        }

        $this->load->view('header', $data);
        $this->load->view('data-sample-json', $data);
        $this->load->view('footer');
    }
    
    public function viewSiblings() {
        $data['title'] = "Siblings JSON";
        $data['config_siblings'] = json_decode(file_get_contents(FCPATH . 'data/links/config-siblings.json'), true);
        
        $this->load->view('header', $data);
        $this->load->view('data-siblings', $data);
        $this->load->view('footer');
    }
    
    public function viewSiblingsJSON() {
        $data['title'] = "Siblings JSON";
        $data['config_siblings'] = json_decode(file_get_contents(FCPATH . 'data/links/config-siblings.json'), true);
        
        $this->load->view('header', $data);
        $this->load->view('data-siblings-json', $data);
        $this->load->view('footer');
    }
    
    public function viewData() {
        $data['title'] = "Harvesting Data";
        
        $this->load->view('header', $data);
        $this->load->view('data', $data);
        $this->load->view('footer');
    }

}
