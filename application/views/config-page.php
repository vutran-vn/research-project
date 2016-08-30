<div class="page page-<?= $page_index ?> panel panel-success" data-page-index="<?= $page_index ?>">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-2">
                <a data-toggle="collapse" href="#collapse-page<?= $page_index ?>"><span class="glyphicon glyphicon glyphicon-menu-down" aria-hidden="true"></span></a>
                Page URL: 
            </div>
            <div class="col-md-6">
                <input type="text" name="page_url" value="">
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-xs btn-danger btn-remove-page" data-page-index="<?= $page_index ?>" onclick="removePage(this)">Remove</button>
                <button type="button" class="btn btn-xs btn-success btn-add-object" data-page-index="<?= $page_index ?>" onclick="addObject(this)">Add object</button>
            </div>
        </div>
    </div>
    <div id="collapse-page<?= $page_index ?>" class="panel-collapse collapse">
        <?php $this->view('config-object'); ?>
    </div>
</div>

