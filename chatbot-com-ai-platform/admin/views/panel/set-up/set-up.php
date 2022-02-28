<?php

if (!defined('ABSPATH')) { exit; }
wp_enqueue_style(CHATBOTCOM_ASSETS_PREFIX . 'style-panel-set-up', plugin_dir_url(__FILE__) . 'set-up.css');

?>

<div class="panel-set-up">
    <? CHATBOTCOM_Components::tpl_header('Set up your bot', 'Choose the story which you want to connect with your wordpress site.'); ?>

    <form
        method="post"
        action="<?= CHATBOTCOM_Admin::get_instance()->data->get_action_url('set-up') ?>"
        class="panel-set-up-content">

        <div
            text-type="h5"
            text-color="black">
            Choose your bot
        </div>

        <select name="widget"
            text-type="h5"
            text-weight="bold">
            <?php foreach (CHATBOTCOM_Admin::get_instance()->data->widgets_list as $widget) { ?>
                <option value="<?= $widget->id.':'.esc_html($widget->storyName) ?>"><?= esc_html($widget->storyName) ?></option>
            <?php } ?>
        </select>

        <input type="hidden" name="email" value="<?= CHATBOTCOM_Admin::get_instance()->data->temp_email ?>">

        <div class="panel-set-up-switch-wrapper">
            <?php CHATBOTCOM_Components::tpl_switch('Hide chat on mobile', 'disable-mobile', false); ?>
        </div>

        <div class="panel-set-up-switch-wrapper second-switch">
            <?php CHATBOTCOM_Components::tpl_switch('Hide chat for Guest visitors', 'disable-guests', false); ?>
        </div>

        <?php CHATBOTCOM_Components::tpl_button_submit('Add to your site', 'small'); ?>
    </form>

    <?php CHATBOTCOM_Components::tpl_disconnect_link(); ?>
</div>
