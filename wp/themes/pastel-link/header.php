<?php if (!defined('ABSPATH')) exit; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="pl-header" id="plHeader">
  <div class="pl-container pl-header__inner">

    <!-- logo -->
    <div class="pl-header__logo">
      <a class="pl-header__brand" href="<?php echo esc_url(home_url('/')); ?>">
        <span class="pl-mark">P</span>
        <span class="pl-brand-text">PASTEL LINK</span>
      </a>
    </div>

    <!-- nav -->
    <nav class="pl-header__nav" aria-label="Primary">
      <?php
      wp_nav_menu([
        'theme_location' => 'primary',
        'container' => false,
        'menu_class' => 'pl-nav',
        'fallback_cb' => '__return_false',
      ]);
      ?>
    </nav>

    <!-- right -->
    <div class="pl-header__right">
      <a class="pl-header__cta" href="#contact">お問い合わせ</a>

      <button class="pl-burger" id="plBurger" aria-label="メニューを開く" aria-expanded="false" type="button">
        <span class="pl-burger__line"></span>
        <span class="pl-burger__line"></span>
        <span class="pl-burger__line"></span>
      </button>
    </div>
  </div>

  <!-- mobile drawer -->
  <div class="pl-drawer" id="plDrawer" aria-hidden="true">
    <div class="pl-drawer__panel">
      <div class="pl-drawer__top">
        <span class="pl-drawer__title">MENU</span>
        <button class="pl-drawer__close" id="plDrawerClose" aria-label="閉じる" type="button">×</button>
      </div>

      <?php
      wp_nav_menu([
        'theme_location' => 'primary',
        'container' => false,
        'menu_class' => 'pl-drawer__menu',
        'fallback_cb' => '__return_false',
      ]);
      ?>

      <a class="pl-drawer__cta" href="#contact">お問い合わせ</a>
    </div>

    <button class="pl-drawer__backdrop" id="plDrawerBackdrop" aria-label="背景をクリックして閉じる" type="button"></button>
  </div>
</header>
