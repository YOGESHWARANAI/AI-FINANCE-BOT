<?php
/*
Plugin Name: ChatBot.com - AI platform
Plugin URI: https://www.chatbot.com/integrations/wordpress
Description: Easy to use chatbot platform for business. This plugin allows to quickly install ChatBot on any WordPress website.
Author: ChatBot
Author URI: https://www.chatbot.com
Text Domain: chatbot-com-ai-platform
Version: 1.0.3
*/

if (!defined('ABSPATH')) { exit; }

require_once 'config/index.php';

is_admin()
    ? require_once(CHATBOTCOM_ADMIN_DIR.'index.php')
    : require_once(CHATBOTCOM_PUBLIC_DIR.'index.php');
