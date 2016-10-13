<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="container">
    <div id="data-website">
        <div id="project-name">
            Project: Develop a Web Application for Harvesting Cloud Services Information from the Web
        </div>
        <hr>
        
        <a href="<?= site_url('home') ?>">Home</a> > View Data
        <h3>Datasets</h3>
        
        <hr>
        
        <form id="form-data" method="post">
            <div class="row">
                <div class="col-md-2"><strong>Select page:</strong></div> 
                <div class="col-md-8">
                    <select name="dataset">
                        <option value="companies" <?= ($this->input->post('dataset') == 'companies') ? "selected" : '' ?>>Companies</option>
                        <option value="companies_reviews" <?= ($this->input->post('dataset') == 'companies_reviews') ? "selected" : '' ?>>Companies Reviews</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="submit" class="btn btn-success" value="Get data"/>
                </div>
            </div>
        </form>
    </div>
</div>