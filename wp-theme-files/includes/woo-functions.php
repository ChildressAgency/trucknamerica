<?php


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