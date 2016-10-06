<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="container">
    <div id="config-website">
        <h2>Configuration</h2>
        <hr>
        <form id="form-save">
            <div class="website-url">
                <div class="row">
                    <div class="col-md-2">Website URL:</div> 
                    <div class="col-md-8">
                        <input type="text" name="website_url" value="<?= isset($custom_config['website_url']) ? $custom_config['website_url'] : '' ?>">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-xs btn-success btn-add-page" onclick="addPage()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> page</button>
                    </div>
                </div>
            </div>
            <hr>
            <div class="pages">
                <?php
                $page_index = 0;
                ?>
                <?php
                if (isset($custom_config['pages'])) {
                    foreach ($custom_config['pages'] as $page) {
                        $page_index++;
                        include('config-page.php');
                    }
                } else {
                    $this->view('config-page');
                }
                ?>
            </div>
            <hr>
            <div class="form-actions">
                <button type="button" class="btn btn-success btn-save-config" onclick="saveConfig()">Save</button>
                <button type="button" class="btn btn-default btn-get-update">Get updated</button>
            </div>
            <div class="form-alerts">
            </div>
        </form>
    </div>
</div>

<div class="modal fade" id="notification" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Notification</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
