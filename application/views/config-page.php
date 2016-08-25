<div class="page panel panel-success">
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
                <button class="btn btn-xs btn-danger btn-remove-object">Remove</button>
                <button class="btn btn-xs btn-success btn-add-object">Add object</button>
            </div>
        </div>
    </div>
    <div id="collapse-page<?= $page_index ?>" class="panel-collapse collapse">
        <div class="object panel-body">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-2">Object name: </div>
                        <div class="col-md-6">
                            <input type="text" name="object_name" value="">
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-xs btn-danger btn-remove-object">Remove</button>
                            <button class="btn btn-xs btn-success btn-add-attribute">Add attribute</button>
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
                                    <tr>
                                        <td><input type="text" name="attribute_name" value=""></td>
                                        <td><input type="text" name="attribute_sample" value=""></td>
                                        <td><button class="btn btn-xs btn-danger btn-remove-atribute">Remove</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

