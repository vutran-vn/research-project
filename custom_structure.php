<?php

//defined('BASEPATH') OR exit('No direct script access allowed');

$config['custom'] = array(
    'website_url' => 'http://www.serchen.co.uk',
    'pages' => array(
        array(
            'url' => 'http://www.serchen.co.uk/browse',
            'objects' => array(
                array(
                    'name' => 'category',
                    'parent_tag' => 'ul.categories li',
                    'attributes' => array(
                        array(
                            'name' => 'category_name', 
                            'sample' => 'Accounting Software', 
                            'filter_criteria' => array('tagName' => 'a', 'tagAttributes' => array()), 
                            'expected_result' => array('tagText' => '1', 'tagAttributes' => array('href'))),
                        array(
                            'name' => 'category_number', 
                            'sample' => '110', 
                            'filter_criteria' => array('tagName' => 'span', 'tagAttributes' => array(array('name' => 'class', 'value' => 'listing-count'))), 
                            'expected_result' => array('tagText' => '1', 'tagAttributes' => array()))
                    )
                )
            )
        )
    )
);

$json = json_encode($config['custom']);
echo $json;

