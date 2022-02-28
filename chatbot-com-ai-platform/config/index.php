<?php

if (!defined('ABSPATH')) { exit; }

$env = 'chatbot.com';

// EXTERNALS
define('CHATBOTCOM_ACCOUNTS_URL', 'https://accounts.'.$env);
define('CHATBOTCOM_API_URL', 'https://api.'.$env);
define('CHATBOTCOM_CDN_URL', 'cdn.'.$env);
define('CHATBOTCOM_UTM_SOURCE', 'metadata[utm_source]=wordpress.org');

// MENU
define('CHATBOTCOM_MENU_TITLE', 'ChatBot');
define('CHATBOTCOM_MENU_SLUG', 'chatbotcom-configuration');

// INTERNALS
define('CHATBOTCOM_ROOT_FILE_PATH', 'chatbot-com-ai-platform/chatbotcom.php');
define('CHATBOTCOM_ADMIN_PAGE_URL', admin_url('admin.php?page='.CHATBOTCOM_MENU_SLUG));
define('CHATBOTCOM_ADMIN_URL', plugin_dir_url(__FILE__).'../admin/');
define('CHATBOTCOM_ADMIN_DIR', dirname(__FILE__).'/../admin/');
define('CHATBOTCOM_PUBLIC_DIR', dirname(__FILE__).'/../public/');

// PAGE
define('CHATBOTCOM_PAGE_TITLE', 'ChatBot Configuration');
define('CHATBOTCOM_PAGE_HOOK', 'toplevel_page_chatbotcom-configuration');
define('CHATBOTCOM_ASSETS_PREFIX', 'chatbotcom-configuration-');

// DATABASE PROPERTY
define('CHATBOTCOM_DATA_WIDGET_ID', 'chatbotcom_configuration_widget_id');
define('CHATBOTCOM_DATA_EMAIL', 'chatbotcom_configuration_email');
define('CHATBOTCOM_DATA_DISABLE_MOBILE', 'chatbotcom_configuration_mobile');
define('CHATBOTCOM_DATA_DISABLE_GUESTS', 'chatbotcom_configuration_guests');
define('CHATBOTCOM_DATA_STORY_NAME', 'chatbotcom_configuration_story_name');

// NONCE
define('CHATBOTCOM_NONCE', 'chatbotcom_security_nonce');

// SDK
define('CHATBOTCOM_SDK_CLIENT_ID', 'H-c7rsQK_VBX-e99_k7x');

// SUPPORT
define('CHATBOTCOM_SUPPORT_MAIL', 'support@chatbot.com');
