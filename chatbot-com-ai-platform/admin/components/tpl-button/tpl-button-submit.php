<?php if (!defined('ABSPATH')) { exit; } ?>

<input
    type="submit"
    <?= $id ? 'id="'.$id.'"' : '' ?>
    button-size="<?= $size ?>"
    value="<?= $title ?>"
    class="tpl-button"/>
