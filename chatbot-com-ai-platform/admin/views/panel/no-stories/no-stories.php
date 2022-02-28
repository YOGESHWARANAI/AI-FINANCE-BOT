<?php

if (!defined('ABSPATH')) { exit; }
wp_enqueue_style(CHATBOTCOM_ASSETS_PREFIX.'style-panel-no-stories', plugin_dir_url(__FILE__) . 'no-stories.css');

?>

<div class="panel-no-stories">
    <img
        class="panel-no-stories-image"
        src="<?= CHATBOTCOM_ADMIN_URL.'assets/images/no-stories.png'; ?>"/>

    <?php CHATBOTCOM_Components::tpl_header('You don’t have any bot stories yet', 'Go to your ChatBot dashboard and create your first bot story.'); ?>

    <div class="panel-no-stories-button">
        <?php CHATBOTCOM_Components::tpl_button_link('Go to dashboard', 'small', CHATBOTCOM_ACCOUNTS_URL, true); ?>
    </div>

    <?php CHATBOTCOM_Components::tpl_disconnect_link(); ?>
</div>
