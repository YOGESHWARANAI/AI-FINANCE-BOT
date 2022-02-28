<?php

if (!defined('ABSPATH')) { exit; }
wp_enqueue_style(CHATBOTCOM_ASSETS_PREFIX.'style-panel-error', plugin_dir_url(__FILE__) . 'error.css');

?>

<div class="panel-error">
    <img
        class="panel-error-image"
        src="<?= CHATBOTCOM_ADMIN_URL.'assets/images/no-stories.png'; ?>"/>

    <?php CHATBOTCOM_Components::tpl_header(
        'Something went wrong',
        'Please try again later. If the problem persists, contact our support team at <a text-actions href="'.CHATBOTCOM_SUPPORT_MAIL.'">'.CHATBOTCOM_SUPPORT_MAIL.'</a>'); ?>

    <div class="panel-error-button">
        <?php CHATBOTCOM_Components::tpl_button_link('Try again', 'small', CHATBOTCOM_ADMIN_PAGE_URL); ?>
    </div>
</div>
