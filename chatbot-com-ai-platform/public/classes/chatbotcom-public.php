<?php

if (!defined('ABSPATH')) { exit; }

class CHATBOTCOM_Public {
    private static $instance;

    public $data_disable_mobile;
    public $data_disable_guests;
    public $data_widget_id;

    private function __construct () {
        $this->load_db_data();
        add_action ('wp_footer', array($this, 'html'));
    }
    private function is_mobile() {
        $userAgent = array_key_exists('HTTP_USER_AGENT', $_SERVER) ? $_SERVER['HTTP_USER_AGENT'] : '';
        $regex = '/((Chrome).*(Mobile))|((Android).*)|((iPhone|iPod).*Apple.*Mobile)|((Android).*(Mobile))/i';
        return preg_match($regex, $userAgent);
    }
    private function is_logged() {
        return property_exists(wp_get_current_user()->data, 'ID');
    }
    private function load_db_data () {
        $this->data_widget_id = get_option(CHATBOTCOM_DATA_WIDGET_ID);
        $this->data_disable_mobile = get_option(CHATBOTCOM_DATA_DISABLE_MOBILE);
        $this->data_disable_guests = get_option(CHATBOTCOM_DATA_DISABLE_GUESTS);
    }
    public static function get_instance () {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }
    public function html () {
        if (
            !$this->data_widget_id ||
            ($this->data_disable_mobile && $this->is_mobile()) ||
            ($this->data_disable_guests && !$this->is_logged())
        ) {
            return;
        }

        require_once CHATBOTCOM_PUBLIC_DIR.'/views/footer.php';
    }
}
