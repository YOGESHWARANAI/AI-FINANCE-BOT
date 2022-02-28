<?php

if (!defined('ABSPATH')) { exit; }

class CHATBOTCOM_Admin {
    private static $instance;
    public $data;

    private function __construct() {
        add_action('admin_menu', array($this, 'register_menu_links'));
        add_filter( 'plugin_action_links_' . CHATBOTCOM_ROOT_FILE_PATH, array($this, 'register_plugin_link'));
        add_action('admin_init', array($this, 'init_data'));
    }
    public static function get_instance() {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }
    public function register_menu_links () {
        add_menu_page(
            CHATBOTCOM_PAGE_TITLE,
            CHATBOTCOM_MENU_TITLE,
            'manage_options',
            CHATBOTCOM_MENU_SLUG,
            array($this, 'view'),
            CHATBOTCOM_ADMIN_URL.'assets/images/chatbot-logo-small-white.svg'
        );

        add_action( 'admin_enqueue_scripts', array($this, 'register_scripts'));
    }
    public function register_plugin_link ( $links ) {
        return array_merge(
            array(sprintf('<a href="'.CHATBOTCOM_ADMIN_PAGE_URL.'">%s</a>', __('Settings'))),
            $links
        );
    }
    public function register_scripts ($hook) {
        wp_enqueue_style(CHATBOTCOM_ASSETS_PREFIX.'style-menu-icon', CHATBOTCOM_ADMIN_URL.'assets/style/menu-icon.css');

        if ($hook !== CHATBOTCOM_PAGE_HOOK) {
            return;
        }

        CHATBOTCOM_Components::register_scripts();
        wp_enqueue_style(CHATBOTCOM_ASSETS_PREFIX.'style', CHATBOTCOM_ADMIN_URL.'assets/style/style.css');

        wp_enqueue_script(CHATBOTCOM_ASSETS_PREFIX.'script-login-sdk', CHATBOTCOM_ADMIN_URL.'assets/scripts/login-sdk.js');
        wp_localize_script(CHATBOTCOM_ASSETS_PREFIX.'script-login-sdk', 'wpSdkConfig', array(
            'origin' => CHATBOTCOM_ACCOUNTS_URL,
            'utmSource' => CHATBOTCOM_UTM_SOURCE,
            'clientId' => CHATBOTCOM_SDK_CLIENT_ID
        ));

        wp_enqueue_script(CHATBOTCOM_ASSETS_PREFIX.'scripts', CHATBOTCOM_ADMIN_URL.'assets/scripts/script.js');
        wp_localize_script(CHATBOTCOM_ASSETS_PREFIX.'scripts', 'wpUtils', array(
            'nonce' => wp_create_nonce(CHATBOTCOM_NONCE),
            'adminPageUrl' => CHATBOTCOM_ADMIN_PAGE_URL
        ));
    }
    public function view () {
        require_once CHATBOTCOM_ADMIN_DIR.'views/index.php';
    }
    public function init_data () {
        $this->data = new CHATBOTCOM_Data();
    }
}
