<?php

if (!defined('ABSPATH')) { exit; }
wp_enqueue_style(CHATBOTCOM_ASSETS_PREFIX.'style-panel', plugin_dir_url( __FILE__ ).'panel.css');

?>

<div class="panel">
    <!--Header-->
    <div class="panel-header-wrapper">
        <div class="panel-header">
            <img
                class="logo"
                src="<?= CHATBOTCOM_ADMIN_URL.'assets/images/chatbot-logo.svg'; ?>"/>

            <?php if (CHATBOTCOM_Admin::get_instance()->data->is_connected()) { ?>
            <div class="account">
                <span class="account-logged">Connected with</span>
                <span class="account-email" text-weight="bold"><?= CHATBOTCOM_Admin::get_instance()->data->data_email ?></span>
                <a
                    href="<?= CHATBOTCOM_Admin::get_instance()->data->get_action_url('disconnect') ?>"
                    text-color="black"
                    class="account-logout"
                    text-underline
                    text-actions>
                    Disconnect
                </a>
            </div>
            <?php } ?>
        </div>
    </div>

    <!--Content-->
    <div class="panel-content-outer-wrapper">
        <div class="panel-content-wrapper">
            <div class="panel-content">
                <?php
                    switch (CHATBOTCOM_Admin::get_instance()->data->current_view) {
                        case 'log-in':
                            require_once 'log-in/log-in.php'; break;
                        case 'error':
                            require_once 'error/error.php'; break;
                        case 'set-up':
                            require_once 'set-up/set-up.php'; break;
                        case 'no-stories':
                            require_once 'no-stories/no-stories.php'; break;
                        case 'connected':
                            require_once 'connected/connected.php'; break;
                    }
                ?>
            </div>
        </div>

        <div class="panel-image">
            <img
                src="<?= CHATBOTCOM_ADMIN_URL.'assets/images/chatbot-dashboard.jpg'; ?>"
                alt="dashboard"/>
        </div>
    </div>
</div>