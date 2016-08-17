<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Harvest extends CI_Controller {

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
    
    public function parse() {
        $website_url = $this->input->post('website-url');
        if($website_url != null && !empty($website_url)) {
            //$exec = 'python ' . realpath(base_url('/application/libraries/python-parse-html/main.py')) . ' ' . $website_url;
            exec('python sudo ' . '/var/www/html/application/libraries/python-parse-html/main.py ' . $website_url);
        }
    }

}
