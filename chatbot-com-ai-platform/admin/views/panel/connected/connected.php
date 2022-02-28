<?php
if (!defined('ABSPATH')) { exit; }
wp_enqueue_style(CHATBOTCOM_ASSETS_PREFIX.'style-panel-connected', plugin_dir_url(__FILE__) . 'connected.css');
?>

<div class="panel-connected">
    <?php CHATBOTCOM_Components::tpl_header(
        'Congratulations',
        'Your bot <span class="panel-connected-story-name" text-weight="bold" title="'.CHATBOTCOM_Admin::get_instance()->data->data_story_name.'">'.CHATBOTCOM_Admin::get_instance()->data->data_story_name.'</span> is connected with your wordpress website.'
    ); ?>

    <form
        method="post"
        action="<?= CHATBOTCOM_Admin::get_instance()->data->get_action_url('update') ?>"
        class="panel-connected-content">

        <div class="panel-connected-switch-wrapper">
            <?php CHATBOTCOM_Components::tpl_switch('Hide chat on mobile', 'disable-mobile', CHATBOTCOM_Admin::get_instance()->data->data_disable_mobile); ?>
        </div>

        <div class="panel-connected-switch-wrapper second-switch">
            <?php CHATBOTCOM_Components::tpl_switch('Hide chat for Guest visitors', 'disable-guests', CHATBOTCOM_Admin::get_instance()->data->data_disable_guests); ?>
        </div>

        <?php CHATBOTCOM_Components::tpl_button_submit('Update settings', 'small', ''); ?>
    </form>

    <?php CHATBOTCOM_Components::tpl_disconnect_link(); ?>
</div>
