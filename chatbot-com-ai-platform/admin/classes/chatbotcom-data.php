<?php

if (!defined('ABSPATH')) { exit; }

class CHATBOTCOM_Data {
    /* Current view slug */
    public $current_view;

    /* Widgets list from API */
    public $widgets_list;

    /* Temporary POST data */
    public $temp_access_token;
    public $temp_email;

    /* Data from WP database */
    public $data_disable_mobile;
    public $data_disable_guests;
    public $data_email;
    public $data_story_name;
    public $data_widget_id;

    public function __construct () {
        $this->load_db_data();
        $this->handle_actions();
    }
    public function is_connected () {
        return (
            $this->data_widget_id &&
            $this->data_email &&
            $this->data_story_name
        );
    }
    public function get_action_url ($action) {
        return CHATBOTCOM_ADMIN_PAGE_URL.'&nonce='.wp_create_nonce(CHATBOTCOM_NONCE).'&action='.$action;
    }
    private function validate_widget_id ($input) {
        return (bool) preg_match('/^[0-9a-fA-F]{24}$/', $input);
    }
    private function validate_access_token ($input) {
        return !empty($input);
    }
    private function sanitize_email ($input) {
        return sanitize_email($input);
    }
    private function sanitize_string ($input) {
        return esc_html($input);
    }
    private function sanitize_boolean ($input) {
        return boolval($input);
    }
    private function load_db_data () {
        $this->data_widget_id = get_option(CHATBOTCOM_DATA_WIDGET_ID);
        $this->data_email = get_option(CHATBOTCOM_DATA_EMAIL);
        $this->data_story_name = get_option(CHATBOTCOM_DATA_STORY_NAME);
        $this->data_disable_mobile = get_option(CHATBOTCOM_DATA_DISABLE_MOBILE);
        $this->data_disable_guests = get_option(CHATBOTCOM_DATA_DISABLE_GUESTS);
    }
    private function verify_form_action () {
        return (
            current_user_can('manage_options') &&
            array_key_exists('nonce', $_GET) &&
            array_key_exists('action', $_GET) &&
            wp_verify_nonce($_GET['nonce'], CHATBOTCOM_NONCE)
        );
    }
    private function handle_actions () {
        if ($this->verify_form_action()) {
            switch ($this->sanitize_string($_GET['action'])) {
                case 'log-in':
                    if (!array_key_exists('access_token', $_POST)) {
                        break;
                    }

                    $this->temp_access_token = $this->sanitize_string($_POST['access_token']);
                    $this->temp_email = $this->sanitize_email($_POST['email']);

                    if (!$this->validate_access_token($this->temp_access_token) || !$this->temp_email) {
                        return $this->set_current_view('error');
                    }

                    $this->widgets_list = $this->api_request("/integrations/widget?storyName=true");

                    if ($this->widgets_list === false) {
                        return $this->set_current_view('error');
                    }

                    if (empty($this->widgets_list)) {
                        return $this->set_current_view('no-stories');
                    }

                    return $this->set_current_view('set-up');
                case 'set-up':
                    if (!array_key_exists('widget', $_POST) || !array_key_exists('email', $_POST)) {
                        break;
                    }

                    $widget = explode(':', (string) $_POST['widget'], 2);

                    $widget_id = $this->sanitize_string($widget[0]);
                    $story_name = $this->sanitize_string($widget[1]);
                    $email = $this->sanitize_email($_POST['email']);
                    $disable_mobile = $this->sanitize_boolean($_POST['disable-mobile']);
                    $disable_guests = $this->sanitize_boolean($_POST['disable-guests']);

                    if (!$this->validate_widget_id($widget_id) || !$story_name || !$email) {
                        return $this->set_current_view('error');
                    }

                    update_option(CHATBOTCOM_DATA_WIDGET_ID, $widget_id);
                    update_option(CHATBOTCOM_DATA_STORY_NAME, $story_name);
                    update_option(CHATBOTCOM_DATA_EMAIL, $email);
                    update_option(CHATBOTCOM_DATA_DISABLE_MOBILE, $disable_mobile);
                    update_option(CHATBOTCOM_DATA_DISABLE_GUESTS, $disable_guests);

                    $this->data_widget_id = $widget_id;
                    $this->data_story_name = $story_name;
                    $this->data_email = $email;
                    $this->data_disable_mobile = $disable_mobile;
                    $this->data_disable_guests = $disable_guests;

                    return $this->set_current_view('connected');
                case 'update':
                    $disable_mobile = $this->sanitize_boolean($_POST['disable-mobile']);
                    $disable_guests = $this->sanitize_boolean($_POST['disable-guests']);

                    update_option(CHATBOTCOM_DATA_DISABLE_MOBILE, $disable_mobile);
                    update_option(CHATBOTCOM_DATA_DISABLE_GUESTS, $disable_guests);

                    $this->data_disable_mobile = $disable_mobile;
                    $this->data_disable_guests = $disable_guests;

                    return $this->set_current_view('connected');
                case 'disconnect':
                    delete_option(CHATBOTCOM_DATA_WIDGET_ID);
                    delete_option(CHATBOTCOM_DATA_DISABLE_MOBILE);
                    delete_option(CHATBOTCOM_DATA_EMAIL);
                    delete_option(CHATBOTCOM_DATA_DISABLE_GUESTS);
                    delete_option(CHATBOTCOM_DATA_STORY_NAME);

                    $this->data_widget_id = false;
                    $this->data_email = false;
                    $this->data_story_name = false;
                    $this->data_disable_mobile = false;
                    $this->data_disable_guests = false;

                    return $this->set_current_view('log-in');
            }
        }

        if ($this->is_connected()) {
            return $this->set_current_view('connected');
        }

        return $this->set_current_view('log-in');
    }
    private function api_request ($endpoint) {
        $url = CHATBOTCOM_API_URL . $endpoint;
        $args = array('headers' => array('Authorization' => "Bearer " . $this->temp_access_token));
        $response = wp_remote_get($url, $args);
        $code = wp_remote_retrieve_response_code($response);
        $body = wp_remote_retrieve_body($response);

        if ($code !== 200) {
            return false;
        }

        return json_decode($body);
    }
    private function set_current_view ($view) {
        return $this->current_view = $view;
    }
}
