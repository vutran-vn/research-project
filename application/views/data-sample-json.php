<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="container">
    <div id="data-sample-website">
        <div id="project-name">
            Project: Develop a Web Application for Harvesting Cloud Services Information from the Web
        </div>
        <hr>
        
        <a href="<?= site_url('home') ?>">Home</a> > View Sample Data (JSON)
        <h3>Sample Data</h3>
        
        <hr>
        
        <form id="form-data-sample" method="post">
            <div class="row">
                <div class="col-md-2"><strong>Select page:</strong></div> 
                <div class="col-md-8">
                    <select name="page">
                        <?php foreach ($sample_pages as $pageName => $pageURL) { 
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
        <?php if (isset($page_data)) { ?>
            <pre>
                <?= json_encode($page_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?>
            </pre>
        <?php } ?>
    </div>
</div>

