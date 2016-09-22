<?php

$config['custom'] = array(
    'website_url' => 'http://www.serchen.co.uk',
    'pages' => array(
        array(
            'url' => 'categories.html',
            'objects' => array(
                array(
                    'name' => 'category',
                    'parent_tag' => array('name' => 'li', 'attributes' => array()),
                    'attributes' => array(
                        array(
                            'name' => 'category_name',
                            'sample' => 'Accounting Software',
                            'filter_tag' => array('name' => 'a', 'attributes' => array()),
                            'expected_result' => array('text' => '1', 'attributes' => array('href'))),
                        array(
                            'name' => 'category_number',
                            'sample' => '110',
                            'filter_tag' => array('name' => 'span', 'attributes' => array(array('name' => 'class', 'value' => 'listing-count'))),
                            'expected_result' => array('text' => '1', 'attributes' => array()))
                    )
                )
            )
        ),
        array(
            'url' => 'dedicated_hosting.html',
            'objects' => array(
                array(
                    'name' => 'company',
                    'parent_tag' => array('name' => 'div', 'attributes' => array(array('name' => 'class', 'value' => 'company-tile-info'))),
                    'attributes' => array(
                        array(
                            'name' => 'company_name',
                            'sample' => 'NameHOG',
                            'filter_tag' => array('name' => 'a', 'attributes' => array()),
                            'expected_result' => array('text' => '1', 'attributes' => array('href'))),
                        array(
                            'name' => 'company_service',
                            'sample' => 'Dedicated Server',
                            'filter_tag' => array('name' => 'span', 'attributes' => array(array('name' => 'class', 'value' => 'company-title-service'))),
                            'expected_result' => array('text' => '1', 'attributes' => array()))
                    )
                )
            )
        )
    )
);

$json = json_encode($config['custom']);
echo $json;

