<?php if (!defined('ABSPATH')) { exit; } ?>

<a
    <?= $id ? 'id="'.$id.'"' : '' ?>
    <?= $blank ? 'target="_blank"' : '' ?>
    href="<?=$url?>"
    class="tpl-button"
    button-size="<?= $size ?>">
    <?= $title ?>
</a>
