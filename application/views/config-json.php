<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="container">
    <div id="config-website">
        <div id="project-name">
            Project: Develop a Web Application for Harvesting Cloud Services Information from the Web
        </div>
        <hr>
        
        <a href="<?= site_url('home') ?>">Home</a> > View Config Structure
        <h3>JSON structure</h3>
        
        <hr>
        <pre>
            <?= json_encode($custom_config, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) ?>
        </pre>
    </div>
</div>
