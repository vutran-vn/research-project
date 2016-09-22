<?php

$config['custom'] = array(
    'website_url' => 'http://www.serchen.co.uk',
    'pages' => array(
        array(
            'url' => 'categories.html',
            'objects' => array(
                array(
                    'name' => 'category',
                    'attributes' => array(
                        array(
                            'name' => 'category_name',
                            'sample' => 'Accounting Software'),
                        array(
                            'name' => 'category_number',
                            'sample' => '110')
                    )
                )
            )
        ),
        array(
            'url' => 'dedicated_hosting.html',
            'objects' => array(
                array(
                    'name' => 'company',
                    'attributes' => array(
                        array(
                            'name' => 'company_name',
                            'sample' => 'NameHOG'),
                        array(
                            'name' => 'company_service',
                            'sample' => 'Dedicated Server')
                    )
                )
            )
        )
    )
);

$json = json_encode($config['custom']);
echo $json;

