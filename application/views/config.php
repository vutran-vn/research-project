<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="container">
    <div id="config-website">
        <h2>Configuration</h2>
        <hr>
        <form action="#">
            <div class="website-url">
                <div class="row">
                    <div class="col-md-2">Website URL:</div> 
                    <div class="col-md-8">
                        <input type="text" name="website_url" value="<?= $custom_config['website_url'] ?>">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-xs btn-success btn-add-page">Add page</button>
                    </div>
                </div>
            </div>
            <hr>
            <div class="pages">
                <?php
                $page_index = 0;
                ?>
                <?php
                foreach ($custom_config['pages'] as $page) {
                    $page_index++;
                    ?>
                    <div class="page panel panel-success">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-2">
                                    <a data-toggle="collapse" href="#collapse-page<?= $page_index ?>"><span class="glyphicon glyphicon glyphicon-menu-down" aria-hidden="true"></span></a>
                                    Page URL: 
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="page_url" value="<?= $page['url'] ?>">
                                </div>
                                <div class="col-md-4">
                                    <button type="button" class="btn btn-xs btn-danger btn-remove-object">Remove</button>
                                    <button type="button" class="btn btn-xs btn-success btn-add-object">Add object</button>
                                </div>
                            </div>
                        </div>
                        <div id="collapse-page<?= $page_index ?>" class="panel-collapse collapse">
                            <?php foreach ($page['objects'] as $object) { ?>
                                <div class="object panel-body">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <div class="row">
                                                <div class="col-md-2">Object name: </div>
                                                <div class="col-md-6">
                                                    <input type="text" name="object_name" value="<?= $object['name'] ?>">
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="button" class="btn btn-xs btn-danger btn-remove-object">Remove</button>
                                                    <button type="button" class="btn btn-xs btn-success btn-add-attribute">Add attribute</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="attributes panel-body">
                                            <div class="row">
                                                <div class="col-md-2"></div>
                                                <div class="col-md-10">
                                                    <table class="table attributes">
                                                        <thead>
                                                            <tr>
                                                                <th>Attribute Name</th>
                                                                <th>Attribute Sample</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($object['attributes'] as $attr) { ?>
                                                                <tr>
                                                                    <td><input type="text" name="attribute_name" value="<?= $attr['name'] ?>"></td>
                                                                    <td><input type="text" name="attribute_sample" value="<?= $attr['sample'] ?>"></td>
                                                                    <td><button type="button" class="btn btn-xs btn-danger btn-remove-atribute">Remove</button></td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                            ?>
                        </div>
                    </div>
                <?php }
                ?>
            </div>
            <hr>
            <input type="submit" class="btn btn-success" value="Save"/>
        </form>
    </div>
</div>

