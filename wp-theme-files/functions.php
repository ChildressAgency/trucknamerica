<?php
add_action('wp_footer', 'show_template');
function show_template() {
	global $template;
	print_r($template);
}

add_action('wp_enqueue_scripts', 'jquery_cdn');
function jquery_cdn(){
  if(!is_admin()){
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://code.jquery.com/jquery-3.3.1.min.js', false, null, true);
    wp_enqueue_script('jquery');
  }
}

add_action('wp_enqueue_scripts', 'trucknamerica_scripts');
function trucknamerica_scripts(){
  wp_register_script(
    'bootstrap-popper',
    'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js',
    array('jquery'),
    '',
    true
  );

  wp_register_script(
    'bootstrap-scripts',
    'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js',
    array('jquery', 'bootstrap-popper'),
    '',
    true
  );

  wp_register_script(
    'trucknamerica-scripts',
    get_stylesheet_directory_uri() . '/js/custom-scripts.min.js',
    array('jquery', 'bootstrap-scripts'),
    '',
    true
  );

  wp_enqueue_script('bootstrap-popper');
  wp_enqueue_script('bootstrap-scripts');
  wp_enqueue_script('trucknamerica-scripts');
}

add_filter('script_loader_tag', 'trucknamerica_add_script_meta', 10, 2);
function trucknamerica_add_script_meta($tag, $handle){
  switch($handle){
    case 'jquery':
      $tag = str_replace('></script>', ' integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>', $tag);
      break;

    case 'bootstrap-popper':
      $tag = str_replace('></script>', ' integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>', $tag);
      break;

    case 'bootstrap-scripts':
      $tag = str_replace('></script>', ' integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>', $tag);
      break;
  }

  return $tag;
}

add_action('wp_enqueue_scripts', 'trucknamerica_styles');
function trucknamerica_styles(){
  wp_register_style(
    'google-fonts',
    'https://fonts.googleapis.com/css?family=Cabin+Condensed:400,700&display=swap'
  );

  wp_register_style(
    'fontawesome',
    'https://use.fontawesome.com/releases/v5.6.3/css/all.css'
  );

  wp_register_style(
    'trucknamerica-css',
    get_stylesheet_directory_uri() . '/style.css'
  );

  wp_enqueue_style('google-fonts');
  wp_enqueue_style('fontawesome');
  wp_enqueue_style('trucknamerica-css');
}

add_filter('style_loader_tag', 'trucknamerica_add_css_meta', 10, 2);
function trucknamerica_add_css_meta($link, $handle){
  switch($handle){
    case 'fontawesome':
      $link = str_replace('/>', ' integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">', $link);
      break;
  }

  return $link;
}

add_action('after_setup_theme', 'trucknamerica_setup');
function trucknamerica_setup(){
  add_theme_support('post-thumbnails');
  //set_post_thumbnail_size(320, 320);

  add_theme_support(
    'html5',
    array(
      'comment-form',
      'comment-list',
      'gallery',
      'caption'
    )
  );

  add_theme_support('editor-styles');
  add_theme_support('wp-block-styles');
  add_theme_support('responsive-embeds');

  register_nav_menus(array(
    'header-nav' => 'Header Navigation',
    'footer-about-menu' => 'Footer About Menu',
    'footer-customer-service-menu' => 'Footer Customer Service Menu',
    'footer-shop-menu' => 'Footer Shop Menu'
  ));

  load_theme_textdomain('trucknamerica', get_stylesheet_directory_uri() . '/languages');

  //woocommerce support
  add_theme_support('woocommerce');
  add_theme_support('wc-product-gallery-zoom');
  add_theme_support('wc-product-gallery-lightbox');
  add_theme_support('wc-product-gallery-slider');
}

require_once dirname(__FILE__) . '/includes/class-wp-bootstrap-navwalker.php';
require_once dirname(__FILE__) . '/includes/woo-functions.php';

function trucknamerica_header_fallback_menu(){ ?>
  <div id="navbar" class="collapse navbar-collapse">
    <ul class="navbar-nav">
      <li class="nav-item"><a href="<?php echo esc_url(home_url('shop')); ?>" class="nav-link"><?php echo esc_html__('Shop', 'trucknamerica'); ?></a></li>
      <li class="nav-item"><a href="<?php echo esc_url(home_url('product-category/truck-caps')); ?>" class="nav-link"><?php echo esc_html__('Truck Caps', 'trucknamerica'); ?></a></li>
      <li class="nav-item"><a href="<?php echo esc_url(home_url('product-category/tonneaus')); ?>" class="nav-link"><?php echo esc_html__('Tonneaus', 'trucknamerica'); ?></a></li>
      <li class="nav-item"><a href="<?php echo esc_url(home_url('product-category/trailers')); ?>" class="nav-link"><?php echo esc_html__('Trailers', 'trucknamerica'); ?></a></li>
      <li class="nav-item"><a href="<?php echo esc_url(home_url('clearance')); ?>" class="nav-link"><?php echo esc_html__('Clearance', 'trucknamerica'); ?></a></li>
      <li class="nav-item"><a href="<?php echo esc_url(home_url('more-info')); ?>" class="nav-link"><?php echo esc_html__('More Info', 'trucknamerica'); ?></a></li>
      <li class="nav-item d-block d-md-none"><a href="<?php echo esc_url(home_url('locations')); ?>" class="nav-link"><?php echo esc_html__('Store Locations', 'trucknamerica'); ?></a></li>
      <li class="nav-item d-block d-md-none"><a href="tel:<?php echo get_field('main_phone', 'option'); ?>" class="nav-link"><?php echo esc_html__('Call Today', 'trucknamerica'); ?></a></li>
    </ul>
  </div>
<?php }

add_action('widgets_init', 'trucknamerica_register_sidebars');
function trucknamerica_register_sidebars(){
  register_sidebar(array(
    'name' => esc_html__('Shop Sidebar', 'trucknamerica'),
    'id' => 'sidebar-shop',
    'description' => esc_html__('Add widgets here to appear in your sidebar on the shop pages.', 'trucknamerica'),
    'before_widget' => '<div class="sidebar-section">',
    'after_widget' => '</div>',
    'before_title' => '<h3>',
    'after_title' => '</h3>'
  ));
}

function trucknamerica_can_display_hero_slide($start_date = '', $end_date = ''){
  $today = (int)date('Ymd');

  if($start_date !== ''){
    if($today < (int)$start_date){
      return false;
    }
  }

  if($end_date !== ''){
    if($today > (int)$end_date){
      return false;
    }
  }
  
  return true;
}