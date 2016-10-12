<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="container">
    <div id="data-website">
        <div id="project-name">
            Project: Develop a Web Application for Harvesting Cloud Services Information from the Web
        </div>
        <hr>

        <a href="<?= site_url('home') ?>">Home</a> > View URLs
        <h3>URLs</h3>

        <hr>
        <?php foreach ($config_siblings['pages'] as $page_index => $page) { ?>
            <div class="page page-<?= $page_index ?> panel panel-success" data-page-index="<?= $page_index ?>">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-2">
                            <a data-toggle="collapse" href="#collapse-page<?= $page_index ?>"><span class="glyphicon glyphicon glyphicon-menu-down" aria-hidden="true"></span></a>
                            Sample Page:
                        </div>
                        <div class="col-md-10">
                            <?= $page['url'] ?> <br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            Page Pattern:
                        </div>
                        <div class="col-md-10">
                            <?= $page['pattern'] ?> <br>
                        </div>
                    </div>
                </div>
                <div id="collapse-page<?= $page_index ?>" class="panel-collapse collapse" aria-expanded="true">
                    <ol>
                        <?php
                        if ($page['url'] == 'http://www.serchen.com/browse/' || $page['url'] == 'http://www.serchen.com/category/accounting-software/') {
                            foreach ($page['siblings_urls'] as $url) {
                                ?>
                                <li><?= $url ?></li>
                                <?php
                            }
                        } else if ($page['url'] == 'http://www.serchen.com/company/xero/') {
                            foreach ($page['siblings_urls'] as $en) {
                                ?>
                                <li><?= $en['url'] ?><br><?= $en['objects'][0]['detail'] ?></li>
                                <?php
                            }
                        }
                        ?>
                    </ol>
                </div>
            </div>
        <?php }
        ?>
    </div>
</div>
