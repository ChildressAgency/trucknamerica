<?php
if(!defined('ABSPATH')){ exit; }

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

add_action('woocommerce_before_main_content', 'trucknamerica_wrapper_start', 10);
function trucknamerica_wrapper_start(){
  echo '<main id="main">
          <div class="container">';
}

add_action('woocommerce_after_main_content', 'trucknamerica_wrapper_end', 10);
function trucknamerica_wrapper_end(){
  echo '</div></main>';
}

add_action('woocommerce_before_shop_loop', 'trucknamerica_shop_loop_wrapper_open', 15);
function trucknamerica_shop_loop_wrapper_open(){
  echo '<div class="row tna-product-loop">
          <div class="col-md-8 col-lg-9 order-md-12">';
}

add_action('woocommerce_after_shop_loop', 'trucknamerica_shop_loop_wrapper_close', 15);
function trucknamerica_shop_loop_wrapper_close(){
  echo '</div>'; //close col-md-8
  echo '<div class="col-md-4 col-lg-3 order-md-1">';
    get_sidebar('shop');
  echo '</div>';
  echo '</div>'; //close row
}

//header cart
add_action('trucknamerica_show_cart_link', 'trucknamerica_cart_link');
function trucknamerica_cart_link(){
  if(in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))){
    $count = WC()->cart->cart_contents_count;
    echo '<a href="'. wc_get_cart_url() . '" class="header-cart">' . $count . '<img src="' . get_stylesheet_directory_uri() . '/images/icon-cart.png" alt="Cart Icon" /><span class="d-none d-sm-inline">&nbsp;' . esc_html__('Cart', 'trucknamerica') . '</span></a>';
  }
}

add_filter('woocommerce_add_to_cart_fragments', 'trucknamerica_update_header_cart_count');
function trucknamerica_update_header_cart_count($fragments){
  ob_start();
  $count = WC()->cart->cart_contents_count;
    echo '<a href="'. wc_get_cart_url() . '" class="header-cart">' . $count . '<img src="' . get_stylesheet_directory_uri() . '/images/icon-cart.png" alt="Cart Icon" /><span class="d-none d-sm-inline">&nbsp;' . esc_html__('Cart', 'trucknamerica') . '</span></a>';

  $fragments['a.header-cart'] = ob_get_clean();

  return $fragments;
}

/**
 * Call for Price
 */
add_filter('woocommerce_empty_price_html', 'trucknamerica_empty_price_html');
add_filter('woocommerce_variable_empty_price_html', 'trucknamerica_empty_price_html');
add_filter('woocommerce_variation_empty_price_html', 'trucknamerica_empty_price_html');
function trucknamerica_empty_price_html(){
  return 'Call for price';
}

/**
 * product category thumbnail
 * @see content-product_cat.php
 */
remove_action('woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10);
remove_action('woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10);
remove_action('woocommerce_shop_loop_subcategory_title', 'woocommerce_template_loop_category_title', 10);
remove_action('woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10);

add_action('woocommerce_before_subcategory', 'trucknamerica_template_loop_category_link_open', 10);
function trucknamerica_template_loop_category_link_open($category){
  echo '<div class="img-link">';
}

add_action('woocommerce_before_subcategory_title', 'trucknamerica_subcategory_thumbnail', 10);
function trucknamerica_subcategory_thumbnail($category){
  $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
  $image_url = wp_get_attachment_url($thumbnail_id);

  echo '<div class="img-link-inner" style="background-image:url(' . esc_url($image_url) . ');"></div>';
}

add_action('woocommerce_shop_loop_subcategory_title', 'trucknamerica_template_loop_category_title', 10);
function trucknamerica_template_loop_category_title($category){
  echo '<a href="' . esc_url(get_term_link($category, 'product_cat')) . '">';
    echo '<span class="left-bottom">' . $category->name . '</span>';
  echo '</a>';
}

add_action('woocommerce_after_subcategory', 'trucknamerica_template_loop_category_link_close', 10);
function trucknamerica_template_loop_category_link_close($category){
  echo '<div class="light-overlay"></div>';
  echo '</div>';
}

remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

add_action('woocommerce_single_product_summary', 'trucknamerica_show_contact_buttons', 90);
function trucknamerica_show_contact_buttons(){
  echo '<div class="product-contact-buttons">';
  echo '<a href="#" class="btn-call-now btn-alt"><img src="' . get_stylesheet_directory_uri() . '/images/icon-call-now.png" class="" alt="Call Now" />Call Now</a>';
  echo '<a href="#" class="btn-request-quote btn-alt">Request Quote</a>';
  echo '</div>';
}