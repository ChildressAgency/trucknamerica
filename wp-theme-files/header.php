<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta http-equiv="cache-control" content="public">
  <meta http-equiv="cache-control" content="private">

  <title><?php echo esc_html(bloginfo('name')); ?></title>

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header id="header">
    <div id="top-banner">
      <div class="container d-flex">
        <div class="phone-social">
          <?php $main_phone = get_field('main_phone', 'option'); ?>
          <a href="tel:<?php echo $main_phone; ?>" class="phone"><?php echo esc_html($main_phone); ?></a>
          <?php get_template_part('partials/social'); ?>
        </div>
        <div class="login-cart ml-auto">
          <?php if(is_user_logged_in()): ?>
            <a href="<?php echo esc_url(home_url('my-account')); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-login.png" alt="Login Icon" /><span class="d-none d-sm-inline">&nbsp;<?php echo esc_html__('My Account', 'trucknamerica'); ?></span></a>
          <?php else: ?>
            <a href="<?php echo esc_url(home_url('login')); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-login.png" alt="Login Icon" /><span class="d-none d-sm-inline">&nbsp;<?php echo esc_html__('Login', 'trucknamerica'); ?></span></a>
          <?php endif; ?>
          <?php trucknamerica_cart_link(); ?>
        </div>
      </div>
    </div>
    <div id="masthead">
      <div class="container d-flex">
        <a href="<?php echo esc_url(home_url()); ?>" class="navbar-brand">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" class="img-fluid" alt="Truck'n America Logo" />
        </a>
        <div class="locations-call ml-auto d-none d-md-flex align-items-center">
          <a href="<?php echo esc_url(home_url('locations')); ?>" id="header-locations" class="header-contact"><span>STORE</span>LOCATIONS</a>
          <a href="tel:<?php echo $main_phone; ?>" id="header-call-today" class="header-contact"><span>CALL</span>TODAY</a>
        </div>
      </div>
    </div>

    <nav id="header-nav" class="navbar navbar-dark navbar-expand-lg">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <?php
          $header_menu_extra = '<li class="nav-item d-block d-md-none"><a href="' . esc_url(home_url('locations')) . '" class="nav-link">' . esc_html__('Store Locations', 'trucknamerica') . '</a></li>';
          $header_menu_extra .= '<li class="nav-item d-block d-md-none"><a href=tel:"' . $main_phone . '" class="nav-link">' . esc_html__('Call Today', 'trucknamerica') . '</a></li>';

          $header_nav_args = array(
            'theme_location' => 'header-nav',
            'menu' => '',
            'container' => 'div',
            'container_id' => 'navbar',
            'container_class' => 'collapse navbar-collapse',
            'menu_id' => '',
            'menu_class' => 'navbar-nav',
            'echo' => true,
            'fallback_cb' => 'trucknamerica_header_fallback_menu',
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s' . $header_menu_extra . '</ul>',
            'depth' => 2,
            'walker' => new WP_Bootstrap_NavWalker()
          );
          wp_nav_menu($header_nav_args);
        ?>
      </div>
    </nav>
  </header>

  <?php 
    if(is_front_page()){
      get_template_part('partials/hero'); 
    }
  ?>

  <?php get_template_part('partials/products', 'search'); ?>