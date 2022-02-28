<?php if (!defined('ABSPATH')) { exit; } ?>

<div class="tpl-switch-label-wrapper">
    <div
        class="tpl-switch-label-wrapper-text"
        text-type="h5">
        <?= $label ?>
    </div>

    <label class="tpl-switch-wrapper">
        <input
            <?= $checked ? 'checked="checked"' : '' ?>
            name="<?= $name ?>"
            type="checkbox">

        <span class="tpl-switch"></span>
    </label>
</div>
