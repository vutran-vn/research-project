<div class="object panel-body">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-2">Object name: </div>
                <div class="col-md-6">
                    <input type="text" name="object_name" value="<?= isset($object['name']) ? $object['name'] : '' ?>">
                </div>
                <div class="col-md-4">
                    <button type="button" class="btn btn-xs btn-danger btn-remove-object" onclick="removeObject(this)"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button>
                    <button type="button" class="btn btn-xs btn-info btn-add-attribute" onclick="addAttribute(this)"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> attribute</button>
                    <!--<button type="button" class="btn btn-xs btn-success btn-add-page" onclick="addObjectPage(this)"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> page</button>-->
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="attributes">
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
                                    <th>Multiple</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($object['attributes'])) {
                                    foreach ($object['attributes'] as $attr) {
                                        include('config-attribute.php');
                                    }
                                } else {
                                    $this->view('config-attribute');
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php
            if (isset($object['pages'])) {
                foreach($object['pages'] as $page) {
                    $page_index++;
                    include 'config-page.php';
                }
            }
            ?>
        </div>
    </div>
</div>

