<?php

if (!defined('ABSPATH')) { exit; }

class CHATBOTCOM_Components {
    public static $url = CHATBOTCOM_ADMIN_URL.'components/';
    public static $dir = CHATBOTCOM_ADMIN_DIR.'components/';

    public static function register_scripts () {
        wp_enqueue_style(CHATBOTCOM_ASSETS_PREFIX.'tpl-switch', self::$url.'tpl-switch/tpl-switch.css');
        wp_enqueue_style(CHATBOTCOM_ASSETS_PREFIX.'tpl-header', self::$url.'tpl-header/tpl-header.css');
        wp_enqueue_style(CHATBOTCOM_ASSETS_PREFIX.'tpl-button', self::$url.'tpl-button/tpl-button.css');
    }

    public static function tpl_switch ($label, $name, $checked) {
        require self::$dir.'tpl-switch/tpl-switch.php';
    }

    public static function tpl_create_link () {
        require self::$dir.'tpl-create-link/tpl-create-link.php';
    }

    public static function tpl_disconnect_link () {
        require self::$dir.'tpl-disconnect-link/tpl-disconnect-link.php';
    }

    public static function tpl_header ($header, $description) {
        require self::$dir.'tpl-header/tpl-header.php';
    }

    public static function tpl_button_button ($title, $size, $id = '') {
        require self::$dir.'tpl-button/tpl-button-button.php';
    }

    public static function tpl_button_link ($title, $size, $url = '', $blank = false) {
        require self::$dir.'tpl-button/tpl-button-link.php';
    }

    public static function tpl_button_submit ($title, $size, $id = '') {
        require self::$dir.'tpl-button/tpl-button-submit.php';
    }
}
