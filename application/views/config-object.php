<div class="object panel-body">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-2">Object name: </div>
                <div class="col-md-6">
                    <input type="text" name="object_name" value="">
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php $this->view('config-attribute'); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

