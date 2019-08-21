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
          <?php get_template_part('partials', 'social'); ?>
        </div>
        <div class="login-cart ml-auto">
          <?php if(is_user_logged_in()): ?>
            <a href="<?php echo esc_url(home_url('my-account')); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-login.png" alt="Login Icon" /><span class="d-none d-sm-inline">&nbsp;<?php echo esc_html__('My Account', 'trucknamerica'); ?></span></a>
          <?php else: ?>
            <a href="<?php echo esc_url(home_url('login')); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-login.png" alt="Login Icon" /><span class="d-none d-sm-inline">&nbsp;<?php echo esc_html__('Login', 'trucknamerica'); ?></span></a>
          <?php endif; ?>
          <?php echo trucknamerica_cart_link(); ?>
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
    $hero_slides = get_field('hero_slides', 'option');
    if($hero_slides): ?>
      <section id="hero">
        <div id="hero-carousel" class="carousel slide carousel-heights" data-ride="carousel">
          <ol class="carousel-indicators">
            <?php for($i = 0; $i < count($hero_slides); $i++): ?>
              <li data-target="#hero-carousel" data-slide-to="<?php echo $i; ?>"<?php if($i == 0){ echo ' class="active"'; } ?>></li>
            <?php endfor; ?>
          </ol>

          <div class="carousel-inner">

            <?php $s = 0; foreach($hero_slides as $slide): ?>

              <?php 
                $hero_image = $slide['image'];
                $hero_image_position = $slide['image_position'];
                if($hero_image_position){
                  $background_position = 'background-position:' . $hero_image_position . ';';
                }
              ?>
              <div class="carousel-item<?php if($s == 0){ echo ' active'; } ?>" style="background-image:url(<?php echo esc_attr($hero_image['url']); ?>); <?php echo esc_attr($background_position); ?>">
                <?php if($slide['show_caption']): ?>
                  <div class="container">
                    <div class="hero-caption">
                      <h1><?php echo esc_html($slide['hero_title']); ?></h1>
                      <h4><?php echo esc_html($slide['hero_caption']); ?></h4>

                      <?php $caption_link = $slide['caption_link']; ?>
                      <a href="<?php echo esc_url($caption_link['url']); ?>" class="btn-alt"><?php echo esc_html($caption_link['title']); ?></a>
                    </div>
                  </div>
                  <div class="half-overlay"></div>
                <?php else: ?>
                  <?php $slide_link = $slide['slide_link']; ?>
                  <a href="<?php echo esc_url($slide_link['url']); ?>" class="hero_link" title="<?php echo esc_attr($slide_link['title']); ?>"></a>
                <?php endif; ?>
              </div>
            
          </div>
        </div>
      </section>
  <?php endif; ?>

  <?php get_template_part('partials/products', 'search'); ?>