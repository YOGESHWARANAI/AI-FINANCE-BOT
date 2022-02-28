<?php if (!defined('ABSPATH')) { exit; } ?>

<button
    <?= $id ? 'id="'.$id.'"' : '' ?>
    class="tpl-button"
    button-size="<?= $size ?>">
    <?= $title ?>
</button>
