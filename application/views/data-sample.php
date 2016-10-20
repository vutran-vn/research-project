<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="container">
    <div id="data-sample-website">
        <div id="project-name">
            Project: Develop a Web Application for Harvesting Cloud Services Information from the Web
        </div>
        <hr>

        <a href="<?= site_url('home') ?>">Home</a> > View Sample Data
        <h3>Sample Data</h3>

        <hr>

        <form id="form-data-sample" method="post">
            <div class="row">
                <div class="col-md-2"><strong>Select page:</strong></div> 
                <div class="col-md-8">
                    <select name="page">
                        <?php
                        foreach ($sample_pages as $pageName => $pageURL) {
                            $selected = ($this->input->post('page') == $pageName) ? "selected" : '';
                            ?>
                            <option value="<?= $pageName ?>" <?= $selected ?>><?= $pageURL ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="submit" class="btn btn-success" value="Get data"/>
                </div>
            </div>
        </form>
        <?php
        if (isset($page_data)) {
            if ($sample_pages[$this->input->post('page')] == "http://www.serchen.com/company/xero/") {
                $company_data = array();
                $company_reviews = array();
                foreach ($page_data['root_data'] as $obj) {
                    if ($obj['object_name'] == "detail") {
                        $company_data['company_name'] = $obj['data'][0]['company_name'];
                        $company_data['about'] = $obj['data'][0]['sub_data'][0]['data'][0]['about_content'];
                        $company_data['key_features'] = $obj['data'][0]['sub_data'][1]['data'][0]['key_feature_value'];
                    } else if ($obj['object_name'] == "services") {
                        $company_data['services'] = $obj['data'][0]['service_name'];
                    } else if ($obj['object_name'] == "more_info") {
                        $company_data['company_url'] = $obj['data'][0]['company_url'];
                    } else if ($obj['object_name'] == "review") {
                        $company_reviews['company_name'] = $company_data['company_name'];
                        $company_reviews['company_url'] = $company_data['company_url'];
                        $company_reviews['reviews'] = $obj['data'];
                    }
                }

                //Print data to HTML
                ?>
                <h3>Service</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Service Name</th>
                            <th>Service URL</th>
                            <th>Service Key Features</th>
                            <th>Service Categories</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $company_data['company_name'] ?></td>
                            <td><?= $company_data['company_url'] ?></td>
                            <td><ul><li><?= join('</li><li>', $company_data['key_features']) ?></li></ul></td>
                            <td><ul><li><?= join('</li><li>', $company_data['services']) ?></li></ul></td>
                        </tr>
                        <tr>
                            <th colspan="4">About</th>
                        </tr>
                        <tr>
                            <td colspan="4"><?= $company_data['about'] ?></td>
                        </tr>
                    </tbody>
                </table>

                <h3>Reviews</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Service Name</th>
                            <th>Service URL</th>
                            <th>Review Name</th>
                            <th>Review Date</th>
                            <th>Review Content</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($company_reviews['reviews'] as $re) { ?>
                            <tr>
                                <td><?= $company_data['company_name'] ?></td>
                                <td><?= $company_data['company_url'] ?></td>
                                <td><?= $re['review_name'] ?></td>
                                <td><?= $re['review_date'] ?></td>
                                <td><?= $re['review_comment'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else if ($sample_pages[$this->input->post('page')] == "http://www.serchen.com/browse/") { ?>
                <h3>Categories List</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Category Name</th>
                            <th>Number of Service Providers</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($page_data['root_data'][0]['data'] as $category) { ?>
                        <tr>
                            <td><?= $category['category_name'] ?></td>
                            <td><?= $category['category_number'] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php
            } else if ($sample_pages[$this->input->post('page')] == "http://www.serchen.com/category/accounting-software/") { ?>
                <h3>Services List</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Service Name</th>
                            <th>Service Category</th>
                            <th>Last reviewed date</th>
                            <th>Review Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($page_data['root_data'][0]['data'] as $company) { ?>
                        <tr>
                            <td><?= $company['company_name'] ?></td>
                            <td><?= $company['company_service'] ?></td>
                            <td><?= $company['listed_date'] ?></td>
                            <td><?= $company['reviews_number'] ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php }
        }
        ?>
    </div>
</div>

