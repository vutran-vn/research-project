<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$config['custom'] = array(
    'website_url' => 'http://www.serchen.co.uk/',
    'pages' => array(
        array(
            'url' => 'http://www.serchen.co.uk/browse/',
            'objects' => array(
                array(
                    'name' => 'category',
                    'attributes' => array(
                        array('name' => 'category_name', 'sample' => 'Accounting Software'),
                        array('name' => 'category_number', 'sample' => '110')
                    )
                )
            )
        ),
        array(
            'url' => 'http://www.serchen.co.uk/category/accounting-software/',
            'objects' => array(
                array(
                    'name' => 'company',
                    'attributes' => array(
                        array('name' => 'company_name', 'sample' => 'KashFlow'),
                        array('name' => 'company_service', 'sample' => 'Accounting Software'),
                        array('name' => 'company_last_reviewed', 'sample' => 'Listed 29 Jul 2010'),
                        array('name' => 'company_review_count', 'sample' => '33 Reviews')
                    )
                ),
                array(
                    'name' => 'Similar Categories',
                    'attributes' => array(
                        array('name' => 'category_name', 'sample' => 'Accounts Payable'),
                        array('name' => 'category_number', 'sample' => '0')
                    )
                )
            )
        ),
        array(
            'url' => 'http://www.serchen.co.uk/company/kashflow/',
            'objects' => array(
                array(
                    'name' => 'company',
                    'attributes' => array(
                        array('name' => 'company_name', 'sample' => 'KashFlow')
                    )
                ),
                array(
                    'name' => 'Services',
                    'attributes' => array(
                        array('name' => 'service_name', 'sample' => 'Accounting Software')
                    )
                ),
                array(
                    'name' => 'Similar Companies',
                    'attributes' => array(
                        array('name' => 'similar_company', 'sample' => 'Truly Simple Accounts')
                    )
                ),
                array(
                    'name' => 'Company URL',
                    'attributes' => array(
                        array('name' => 'company_url', 'sample' => 'www.kashflow.com')
                    )
                ),
                array(
                    'name' => 'Review',
                    'attributes' => array(
                        array('name' => 'review_name', 'sample' => 'Ian Buck'),
                        array('name' => 'review_date', 'sample' => 'Tuesday, April 5, 2016'),
                        array('name' => 'review_text', 'sample' => 'It was great until like many others I realised I was overpaying,')
                    )
                ),
                array(
                    'name' => 'Page last update date',
                    'attributes' => array(
                        array('name' => 'page_last_update_date', 'sample' => 'This page was last updated 04 April 2016 09:51'),
                    )
                )
            )
        )
    )
);

