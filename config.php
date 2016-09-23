<?php

$config['custom'] = array(
    'website_url' => 'http://www.serchen.com',
    'pages' => array(
        array(
            'url' => 'http://www.serchen.com/browse/',
            'pattern' => '',
            'siblings_urls' => array(),
            'has_structure' => '0',
            'objects' => array(
                array(
                    'name' => 'category',
                    'attributes' => array(
                        array(
                            'name' => 'category_name',
                            'sample' => 'Accounting Software'),
                        array(
                            'name' => 'category_number',
                            'sample' => '166')
                    )
                )
            )
        ),
        array(
            'url' => 'http://www.serchen.com/category/accounting-software/',
            'pattern' => 'http://www.serchen.com/category/',
            'siblings_urls' => array(),
            'has_structure' => '0',
            'objects' => array(
                array(
                    'name' => 'company',
                    'attributes' => array(
                        array(
                            'name' => 'company_name',
                            'sample' => 'Xero'),
                        array(
                            'name' => 'company_service',
                            'sample' => 'Accounting Software')
                    )
                )
            )
        )
    )
);

$json = json_encode($config['custom']);
echo $json;

