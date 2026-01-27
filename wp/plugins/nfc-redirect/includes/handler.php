<?php
if (!defined('ABSPATH')) exit;

function nfc_redirect_handle_request() {
  $code = get_query_var('nfc_code');
  if (!$code) return;

  $slug = sanitize_title($code);

  $q = new WP_Query([
    'post_type'      => 'nfc_redirect',
    'name'           => $slug,   // slugで検索
    'post_status'    => 'any',
    'posts_per_page' => 1,
    'no_found_rows'  => true,
  ]);

  if (!$q->have_posts()) {
    status_header(404);
    header('Content-Type: text/plain; charset=utf-8');
    echo "Not Found: {$code}";
    exit;
  }

  $post   = $q->posts[0];
  $status = get_post_meta($post->ID, '_nfc_status', true) ?: 'active';

  if ($status !== 'active') {
    status_header(410);

    $template = locate_template('nfc-disabled.php');
    if ($template) {
      include $template;
    } else {
      include NFC_REDIRECT_DIR . 'templates/disabled.php';
    }
    exit;
  }

  // ✅ active は target_url 優先（空なら /p/{code}）
  $target = get_post_meta($post->ID, '_nfc_target_url', true);
  $target = is_string($target) ? trim($target) : '';

  if ($target === '') {
    $target = '/p/' . $slug; // fallback（codeはsanitize_titleで揃える）
  }

  // 相対パスなら絶対URLへ
  if (substr($target, 0, 1) === '/') {
    $target = home_url($target);
  }

  wp_safe_redirect($target, 302);
  exit;
}
