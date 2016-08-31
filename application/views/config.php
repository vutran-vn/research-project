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
                        <button type="button" class="btn btn-xs btn-success btn-add-page" onclick="addPage()">Add page</button>
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
                    <div class="page page-<?= $page_index ?> panel panel-success" data-page-index="<?= $page_index ?>">
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
                                    <button type="button" class="btn btn-xs btn-danger btn-remove-page" data-page-index="<?= $page_index ?>" onclick="removePage(this)">Remove</button>
                                    <button type="button" class="btn btn-xs btn-success btn-add-object" data-page-index="<?= $page_index ?>" onclick="addObject(this)">Add object</button>
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
                                                    <button type="button" class="btn btn-xs btn-danger btn-remove-object" onclick="removeObject(this)">Remove</button>
                                                    <button type="button" class="btn btn-xs btn-success btn-add-attribute" onclick="addAttribute(this)">Add attribute</button>
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
                                                                <th>Update</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($object['attributes'] as $attr) { ?>
                                                                <tr>
                                                                    <td><input type="text" name="attribute_name" value="<?= $attr['name'] ?>"></td>
                                                                    <td><input type="text" name="attribute_sample" value="<?= $attr['sample'] ?>"></td>
                                                                    <td><button type="button" class="btn btn-xs btn-danger btn-remove-attribute" onclick="removeAttribute(this)">Remove</button></td>
                                                                    <td><input type="checkbox" value="get-updated" checked="checked"/></td>
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
            <div>
                <button type="submit" class="btn btn-success">Save</button>
                <button type="button" class="btn btn-default btn-get-update">Get updated</button>
            </div>
        </form>
    </div>
</div>
