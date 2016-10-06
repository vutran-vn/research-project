<tr>
    <td><input type="text" name="attribute_name" value="<?= isset($attr['name']) ? $attr['name'] : '' ?>"></td>
    <td><input type="text" name="attribute_sample" value="<?= isset($attr['sample']) ? $attr['sample'] : '' ?>"></td>
    <td><button type="button" class="btn btn-xs btn-danger btn-remove-attribute" onclick="$(this).parent().parent().remove()"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span></button></td>
    <td><input type="checkbox" name="attribute_update" <?php if (isset($attr['update']) && $attr['update'] == 'yes') { ?>checked="checked"<?php } ?>/></td>
    <td><input type="checkbox" name="attribute_multiple" <?php if (isset($attr['multiple']) && $attr['multiple'] == 'yes') { ?>checked="checked"<?php } ?>/></td>
</tr>
