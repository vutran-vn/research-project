<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div id="container">
    <div id="harvest-website">
        Website: <?= $website_url ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Category</th>
                    <th>Number of Company</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                ?>
                <?php foreach ($categories as $ca) { ?>
                    <tr>
                        <td><?= $count++ ?></td>
                        <td><a href="<?= $ca['URL'] ?>" target="_blank"><?= $ca['URLText'] ?></a></td>
                        <td>0</td>
                    </tr>
                <?php }
                ?>
            </tbody>
        </table>
    </div>
</div>

