<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<pre>
<?= json_encode($custom_config, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES) ?>
</pre>
