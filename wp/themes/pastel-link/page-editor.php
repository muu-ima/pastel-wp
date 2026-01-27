<?php

/**
 * Template Name: Editor (Fullscreen)
 */
if (!defined('ABSPATH')) exit;

add_filter('show_admin_bar', '__return_false');
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>

  <style>
    .pl-editor-iframe {
      width: 100%;
      height: 100dvh;
      border: 0;
      display: block;
      background: #fff;
    }
  </style>
</head>

<body <?php body_class('pl-editor-page'); ?>>
  <?php wp_body_open(); ?>

  <div class="pl-editor-wrap">
    <iframe
      class="pl-editor-iframe"
      src="https://muu-braille-card.vercel.app/editor?embed=1"
      allow="clipboard-read; clipboard-write; fullscreen"
      loading="lazy"></iframe>
  </div>

  <?php wp_footer(); ?>
</body>

</html>