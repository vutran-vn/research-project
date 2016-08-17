<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="container">
    <div id="harvest-website">
        <form class="form-inline" action="<?= base_url('/index.php/harvest/parse');?>" method="POST">
            <div class="form-group">
                <label for="website-url">Website URL:</label>
                <input type="text" name="website-url" class="form-control" id="website-url" placeholder="Website URL" value="www.serchen.co.uk">
            </div>
            <button type="submit" class="btn btn-success">Harvest data >></button>
        </form>
    </div>
</div>
