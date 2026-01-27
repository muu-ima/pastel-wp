<?php
if (!defined('ABSPATH')) exit;

function nfc_redirect_register_query_var($vars) {
  $vars[] = 'nfc_code';
  return $vars;
}

function nfc_redirect_add_rewrite_rules() {
  add_rewrite_rule(
    '^n/([A-Za-z0-9_-]+)/?$',
    'index.php?nfc_code=$matches[1]',
    'top'
  );
}
