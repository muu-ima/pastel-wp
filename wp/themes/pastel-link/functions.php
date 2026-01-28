<?php
/**
 * Pastel Link theme functions
 */
if (!defined('ABSPATH')) {
  exit;
}

/**
 * Theme setup
 */
add_action('after_setup_theme', 'pastel_link_setup');
function pastel_link_setup() {
  // <title> をWPに任せる
  add_theme_support('title-tag');

  // アイキャッチ
  add_theme_support('post-thumbnails');

  // Newsカード用（横長カードに合わせる）
  add_image_size('pl-news-thumb', 960, 640, true);

  // ブロックのワイド幅（必要なら）
  add_theme_support('align-wide');

  // HTML5マークアップ
  add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
    'style',
    'script',
  ));

  // メニュー
  register_nav_menus(array(
    'primary' => 'Primary Menu',
    'footer'  => 'Footer Menu',
  ));
}

/**
 * Enqueue CSS
 */
add_action('wp_enqueue_scripts', 'pastel_link_enqueue_assets');
function pastel_link_enqueue_assets() {
  $uri = get_stylesheet_directory_uri() . '/assets/css/';
  $ver = wp_get_theme()->get('Version');

  // 分離CSS（順序が命）
  wp_enqueue_style('pl-00-tokens',     $uri . '00-tokens.css',     [], $ver);
  wp_enqueue_style('pl-01-base',       $uri . '01-base.css',       ['pl-00-tokens'], $ver);
  wp_enqueue_style('pl-02-components', $uri . '02-components.css', ['pl-01-base'], $ver);
  wp_enqueue_style('pl-03-sections',   $uri . '03-sections.css',   ['pl-02-components'], $ver);

  // （任意）WPが要求する style.css は残す：テーマ情報のため
  wp_enqueue_style('pastel-link-style', get_stylesheet_uri(), ['pl-03-sections'], $ver);
}

/**
 * News（お知らせ）: CPT
 */
add_action('init', 'pastel_link_register_news');
function pastel_link_register_news() {
  register_post_type('pl_news', array(
    'label' => 'News',
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-megaphone',
    'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    'rewrite' => array('slug' => 'news'),
    'show_in_rest' => true,
  ));

  register_taxonomy('pl_news_cat', array('pl_news'), array(
    'label' => 'News Category',
    'public' => true,
    'hierarchical' => true,
    'rewrite' => array('slug' => 'news-category'),
    'show_in_rest' => true,
  ));
}

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_script(
    'pastel-drawer',
    get_stylesheet_directory_uri() . '/assets/js/drawer.js',
    [],
    '1.0.0',
    true
  );
});

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style(
    'pl-fonts',
    'https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+Antique:wght@300;400;500;700&display=swap',
    [],
    null
  );
});
