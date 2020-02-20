<?php
/*
add_action('wp_footer', 'show_template');
function show_template() {
	global $template;
	print_r($template);
}
*/
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
    'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js',
    array('jquery'),
    '',
    true
  );

  wp_register_script(
    'bootstrap-scripts',
    'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js',
    array('jquery', 'bootstrap-popper'),
    '',
    true
  );

  wp_register_script(
    'google-maps',
    '//maps.googleapis.com/maps/api/js?key=' . get_field('google_maps_api_key', 'option'),
    array('jquery'),
    '',
    false
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
  if(is_page('locations') || is_singular('locations')){
    wp_enqueue_script('google-maps');
  }
  wp_enqueue_script('trucknamerica-scripts');
}

add_filter('script_loader_tag', 'trucknamerica_add_script_meta', 10, 2);
function trucknamerica_add_script_meta($tag, $handle){
  switch($handle){
    case 'jquery':
      $tag = str_replace('></script>', ' integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>', $tag);
      break;

    case 'bootstrap-popper':
      $tag = str_replace('></script>', ' integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>', $tag);
      break;

    case 'bootstrap-scripts':
      $tag = str_replace('></script>', ' integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>', $tag);
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

add_filter('block_categories', 'trucknamerica_custom_block_category', 10, 2);
function trucknamerica_custom_block_category($categories, $post){
  return array_merge(
    $categories,
    array(
      array(
        'slug' => 'custom-blocks',
        'title' => esc_html__('Custom Blocks', 'trucknamerica'),
        'icon' => 'wordpress'
      )
    )
  );
}

add_action('acf/init', 'trucknamerica_register_blocks');
function trucknamerica_register_blocks(){
  if(function_exists('acf_register_block_type')){
    
    acf_register_block_type(array(
      'name' => 'prestyled_button',
      'title' => esc_html__('Pre-Styled Button', 'trucknamerica'),
      'description' => esc_html__('Add a pre-styled button.', 'trucknamerica'),
      'category' => 'custom-blocks',
      'mode' => 'auto',
      'align' => 'full',
      'render_template' => get_stylesheet_directory() . '/partials/blocks/prestyled_button.php',
      'enqueue_style' => get_stylesheet_directory_uri() . '/partials/blocks/prestyled_button.css'
    ));

  }
}

add_filter('frm_notification_attachment', 'trucknamerica_coupon_attachment', 10, 3);
function trucknamerica_coupon_attachment($attachments, $form, $args){
  $email_id = $args['email_key'];

  $email_coupons = get_field('email_coupons', 'option');
  if($email_coupons){
    foreach($email_coupons as $coupon){
      if($coupon['email_id'] == $email_id){
        $attachments[] = $coupon['coupon_image'];
      }
    }
  }

  return $attachments;
}

add_shortcode('trucknamerica_form_popup', 'trucknamerica_form_popup_handler');
function trucknamerica_form_popup_handler($atts){
  $a = shortcode_atts(array(
    'formidable_form_id' => '',
    'link_text' => ''
  ), $atts);

  ob_start();
  ?>
    <p><a href="#add-product-form" data-toggle="modal"><?php echo $a['link_text']; ?></a></p>

    <div class="modal fade" id="add-product-form" tabindex="-1" role="dialog" aria-labelledby="add-product-modal-label" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <?php echo do_shortcode('[formidable id="' . $a['formidable_form_id'] . '"]'); ?>
          </div>
        </div>
      </div>
    </div>
  <?php
  return ob_get_clean();
}

//add_action('woocommerce_product_object_updated_props', 'trucknamerica_updated_props');
//function trucknamerica_updated_props($updated_props){
//  var_dump($updated_props);
//}

add_action('woocommerce_update_product', 'trucknamerica_fix_gallery_array');
add_action('woocommerce_new_product', 'trucknamerica_fix_gallery_array', 99);
function trucknamerica_fix_gallery_array($product_id){
  global $wpdb;

  $gallery_array = $wpdb->get_row($wpdb->prepare("
    SELECT meta_value
    FROM $wpdb->postmeta
    WHERE post_id = %d
      AND meta_key = %s", $product_id, '_product_image_gallery'));

  if(is_serialized($gallery_array->meta_value)){
    $gallery_array = unserialize($gallery_array->meta_value);
    $gallery_string = implode(',', $gallery_array);
   
    $wpdb->query($wpdb->prepare("
     UPDATE $wpdb->postmeta
     SET meta_value = %s
     WHERE post_id = %d
       AND meta_key = %s", $gallery_string, $product_id, '_product_image_gallery'));
  }
}