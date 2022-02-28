<?php

if (!defined('ABSPATH')) { exit; }
wp_enqueue_style(CHATBOTCOM_ASSETS_PREFIX.'style-panel-log-in', plugin_dir_url(__FILE__) . 'log-in.css');

?>

<div class="panel-log-in">
    <div
        text-type="h1"
        text-weight="bold"
        text-color="black">
        Easy to use
    </div>
    <div
        class="text-mark"
        text-type="h1"
        text-weight="bold"
        text-color="black">
        chatbot platform
        <img src="<?= CHATBOTCOM_ADMIN_URL.'assets/images/u-text-mark.svg'; ?>"/>
    </div>

    <div
        text-type="h2"
        class="panel-log-in-description">
        <span>Build your custom AI bot in minutes.</span>
        <span>No technical skills needed.</span>
    </div>

    <div class="panel-log-in-button">
        <?php CHATBOTCOM_Components::tpl_button_button(
            '<img src="'.CHATBOTCOM_ADMIN_URL.'assets/images/chatbot-logo-small-white.svg'.'" alt="dashboard"/> Connect account',
            'big',
            'connect_account_button'
        ); ?>
    </div>

    <?php CHATBOTCOM_Components::tpl_create_link(); ?>
</div>
