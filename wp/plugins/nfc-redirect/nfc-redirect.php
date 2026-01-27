<?php
/**
 * Plugin Name: NFC Redirect
 * Description: /n/{code} でリダイレクト（停止対応）
 * Version: 0.1.2
 */
if (!defined('ABSPATH')) exit;

define('NFC_REDIRECT_DIR', plugin_dir_path(__FILE__));

require_once NFC_REDIRECT_DIR . 'includes/rewrite.php';
require_once NFC_REDIRECT_DIR . 'includes/handler.php';
require_once NFC_REDIRECT_DIR . 'includes/admin.php';
require_once NFC_REDIRECT_DIR . 'includes/profile.php';

// rewrite
add_filter('query_vars', 'nfc_redirect_register_query_var');
add_action('init', 'nfc_redirect_add_rewrite_rules');

// admin
add_action('init', 'nfc_redirect_register_cpt');
add_action('add_meta_boxes', 'nfc_redirect_add_meta_boxes');
add_action('save_post_nfc_redirect', 'nfc_redirect_save_meta');

// handler
add_action('template_redirect', 'nfc_redirect_handle_request');

// activation
register_activation_hook(__FILE__, function () {
  nfc_redirect_add_rewrite_rules();
  nfc_profile_add_rewrite_rules();
  flush_rewrite_rules();
});
register_deactivation_hook(__FILE__, function () {
  flush_rewrite_rules();
});

// profile
add_action('init', 'nfc_profile_register_cpt');
add_action('add_meta_boxes', 'nfc_profile_add_meta_boxes');
add_action('save_post_nfc_profile', 'nfc_profile_save_meta');

// profile route
add_action('init', 'nfc_profile_add_rewrite_rules');
add_filter('query_vars', 'nfc_profile_register_query_vars');
add_action('template_redirect', 'nfc_profile_handle_request');