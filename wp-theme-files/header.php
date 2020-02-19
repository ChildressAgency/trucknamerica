<!doctype html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Hotjar Tracking Code for https://trucknamerica.com --> 
    <script> (function(h,o,t,j,a,r){ h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
    h._hjSettings={hjid:1633944,hjsv:6}; a=o.getElementsByTagName('head')[0]; r=o.createElement('script');
    r.async=1; r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv; a.appendChild(r); })
    (window,document,'https://static.hotjar.com/c/hotjar-','.js?sv='); </script>
    
   <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PM93BBK');</script>
<!-- End Google Tag Manager --> 
  
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <meta http-equiv="cache-control" content="public">
  <meta http-equiv="cache-control" content="private">

  <title><?php echo esc_html(bloginfo('name')); ?></title>
  <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PM93BBK"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->  
  <header id="header">
    <div id="masthead">
      <div class="container d-flex">
        <a href="<?php echo esc_url(home_url()); ?>" class="navbar-brand">
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logo.png" class="img-fluid" alt="Truck'n America Logo" />
        </a>
        <div class="locations-call ml-auto d-none d-md-flex align-items-center">
          <a href="<?php echo esc_url(home_url('locations')); ?>" id="header-locations" class="header-contact"><span>STORE</span>LOCATIONS</a>
          <!--<a href="tel:<?php echo $main_phone; ?>" id="header-call-today" class="header-contact"><span>CALL</span>TODAY</a>-->
          <a href="<?php echo esc_url(home_url('locations')); ?>" id="header-call-today" class="header-contact"><span>CALL</span>TODAY</a>
        </div>
      </div>
    </div>

    <nav id="header-nav" class="navbar navbar-dark navbar-expand-lg">
      <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle Navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div id="navbar" class="collapse navbar-collapse">
          <?php
            $header_menu_extra = '<li class="nav-item d-block d-md-none"><a href="' . esc_url(home_url('locations')) . '" class="nav-link">' . esc_html__('Store Locations', 'trucknamerica') . '</a></li>';
            $header_menu_extra .= '<li class="nav-item d-block d-md-none"><a href="' . esc_url(home_url('locations')) . '" class="nav-link">' . esc_html__('Call Today', 'trucknamerica') . '</a></li>';

            $header_nav_args = array(
              'theme_location' => 'header-nav',
              'menu' => '',
              'container' => '',
              'container_id' => '',
              'container_class' => '',
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

          <div class="phone-social-cart d-flex ml-auto">
            <div class="phone-social">
              <?php $main_phone = get_field('main_phone', 'option'); ?>
              <!--<a href="tel:<?php echo $main_phone; ?>" class="phone"><?php echo esc_html($main_phone); ?></a>-->
              <?php get_template_part('partials/social'); ?>
            </div>
            <div class="login-cart">
              <?php if(is_user_logged_in()): ?>
                <a href="<?php echo esc_url(home_url('my-account')); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-login.png" alt="Login Icon" /><span class="d-none d-sm-inline">&nbsp;<?php echo esc_html__('My Account', 'trucknamerica'); ?></span></a>
              <?php else: ?>
                <a href="<?php echo esc_url(home_url('login')); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/icon-login.png" alt="Login Icon" /><span class="d-none d-sm-inline">&nbsp;<?php echo esc_html__('Login', 'trucknamerica'); ?></span></a>
              <?php endif; ?>
              <?php trucknamerica_cart_link(); ?>
            </div>         
          </div>

        </div><?php //#navbar ?>
      </div>
    </nav>
  </header>

  <?php 
    if(is_front_page()){
      get_template_part('partials/hero'); 
    }
  ?>

  <?php get_template_part('partials/products', 'search'); ?>