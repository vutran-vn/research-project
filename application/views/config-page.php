<div class="page page-<?= $page_index ?> panel panel-success" data-page-index="<?= $page_index ?>">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-2">
                <a data-toggle="collapse" href="#collapse-page<?= $page_index ?>"><span class="glyphicon glyphicon glyphicon-menu-down" aria-hidden="true"></span></a>
                Page: 
            </div>
            <div class="col-md-6">
                <input type="text" name="page_url" value="<?= isset($page['url']) ? $page['url'] : '' ?>">
            </div>
            <div class="col-md-4">
                <button type="button" class="btn btn-xs btn-danger btn-remove-page" data-page-index="<?= $page_index ?>" onclick="removePage(this)"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
                <button type="button" class="btn btn-xs btn-default btn-add-object" data-page-index="<?= $page_index ?>" onclick="addObject(this)"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> object</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                Pattern: 
            </div>
            <div class="col-md-6">
                <input type="text" name="page_pattern" value="<?= isset($page['pattern']) ? $page['pattern'] : '' ?>">
            </div>
            <div class="col-md-4">
            </div>
        </div>
    </div>
    <div id="collapse-page<?= $page_index ?>" class="panel-collapse collapse in" aria-expanded="true">
        <?php
        if (isset($page['objects'])) {
            foreach ($page['objects'] as $object) {
                include('config-object.php');
            }
        } else {
            $this->view('config-object');
        }
        ?>
    </div>
</div>

