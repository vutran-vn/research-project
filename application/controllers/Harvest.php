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
        if ($website_url != null && !empty($website_url)) {
            //These lines of code are for temporary developing purpose
            //The real code here should be execute the Python script with appropriate "website_url" which is the input from user
            if ($website_url == "http://www.serchen.co.uk/browse/") {
                $json = file_get_contents(base_url() . 'python/JSON/categories');
                $data['categories'] = json_decode($json, true);
                $data['website_url'] = $website_url;
            }
        }

        $data['title'] = "Harvesting Web App";
        $this->load->view('header', $data);
        $this->load->view('parse', $data);
        $this->load->view('footer');
    }
    
    public function getData() {
        echo "abc";
    }

}
