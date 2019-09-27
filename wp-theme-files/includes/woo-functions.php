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
    echo '<a href="'. wc_get_cart_url() . '" class="header-cart"><span class="cart-count">' . $count . '</span><img src="' . get_stylesheet_directory_uri() . '/images/icon-cart.png" alt="Cart Icon" /><span class="d-none d-sm-inline">&nbsp;' . esc_html__('Cart', 'trucknamerica') . '</span></a>';
  }
}

add_filter('woocommerce_add_to_cart_fragments', 'trucknamerica_update_header_cart_count');
function trucknamerica_update_header_cart_count($fragments){
  ob_start();
  $count = WC()->cart->cart_contents_count;
    echo '<a href="'. wc_get_cart_url() . '" class="header-cart"><span class="cart-count">' . $count . '</span><img src="' . get_stylesheet_directory_uri() . '/images/icon-cart.png" alt="Cart Icon" /><span class="d-none d-sm-inline">&nbsp;' . esc_html__('Cart', 'trucknamerica') . '</span></a>';

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
  $name_position = get_field('category_title_position', 'product_cat_' . $category->term_id);
  if(!$name_position){
    $name_position = 'left-bottom';
  }
  echo '<a href="' . esc_url(get_term_link($category, 'product_cat')) . '">';
    echo '<span class="' . esc_attr($name_position) . '">' . $category->name . '</span>';
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
  echo '<a href="#call-now-modal" class="btn-call-now btn-alt" data-toggle="modal"><img src="' . get_stylesheet_directory_uri() . '/images/icon-call-now.png" class="" alt="Call Now" />' . esc_html__('Call Now', 'trucknamerica') . '</a>';
  echo '<a href="#product-inquiry-modal" class="btn-request-quote btn-alt" data-toggle="modal" data-product_name="' . esc_html(get_the_title()) . '">' . esc_html__('Request Quote', 'trucknamerica') . '</a>';
  echo '</div>';
}

add_action('woocommerce_single_product_summary', 'trucknamerica_show_brand', 35);
function trucknamerica_show_brand(){
  $brands = get_the_terms(get_the_ID(), 'brands');

  if($brands){
    $brand = $brands[0];  
    echo '<p class="brand"><span>Brand:&nbsp;</span>' . $brand->name . '</p>';
  }
}

/**
 * Product inquiry modal content
 */
add_action('woocommerce_after_main_content', 'trucknamerica_product_inquiry_modal', 20);
function trucknamerica_product_inquiry_modal(){ 
  $cats = get_the_terms(get_the_ID(), 'product_cat');
  if($cats){
    $prod_cat = $cats[0];
    $prod_cat_parent = $prod_cat;

    if($prod_cat_parent->parent != 0){
      $prod_cat_parent = trucknamerica_get_oldest_ancestor($prod_cat);
    }

    $prod_cat_form = get_field('product_inquiry_form_shortcode', $prod_cat_parent);
    ?>
    <div class="modal fade" id="product-inquiry-modal" tabindex="-1" role="dialog" aria-labelledby="product-inquiry-modal-label" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="product-inquiry-modal-label"></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <?php echo do_shortcode($prod_cat_form); ?>
          </div>
        </div>
      </div>
    </div>
<?php }
}

function trucknamerica_get_oldest_ancestor($prod_cat){

  if($prod_cat->parent == 0){
    //var_dump($prod_cat);
    return $prod_cat;
  }
  else{
    $prod_cat_parent = get_term($prod_cat->parent, 'product_cat');
    //var_dump($prod_cat_parent);
    $prod_cat = trucknamerica_get_oldest_ancestor($prod_cat_parent);
    return $prod_cat;
  }
}

/**
 * Call Now Modal content
 */
add_action('woocommerce_after_main_content', 'trucknamerica_call_now_modal', 25);
function trucknamerica_call_now_modal(){ ?>
  <div class="modal fade" id="call-now-modal" tabindex="-1" role="dialog" aria-labelledby="call-now-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id="call-now-modal-title"><?php echo esc_html__('Give Us A Call', 'trucknamerica'); ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <div class="modal-body">
          <?php
            $states = get_terms(array(
              'taxonomy' => 'states',
              'orderby' => 'name',
              'order' => 'ASC'
            ));

            foreach($states as $state){
              echo '<h4 class="call-now-state">' . sprintf(esc_html__('%s Locations', 'trucknamerica'), $state->name) . '</h4>';
              echo '<div class="row">';

              $locations = new WP_Query(array(
                'post_type' => 'locations',
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'tax_query' => array(
                  array(
                    'taxonomy' => 'states',
                    'field' => 'slug',
                    'terms' => $state->slug
                  )
                )
              ));

              if($locations->have_posts()){
                $i = 0;
                while($locations->have_posts()){
                  $locations->the_post();
                  $phone = get_field('location_main_phone_number');

                  if($i % 2 == 0){ echo '<div class="clearfix"></div>'; }
                  echo '<div class="col-md-6">';
                    echo '<div class="modal-location"><p>';
                      echo '<span class="city-state">' . esc_html(get_the_title()) . '</span>';
                      echo '<a href="tel:' . esc_attr($phone) . '" class="tel">' . esc_html($phone) . '</a>';
                    echo '</p></div>';
                  echo '</div>';

                  $i++;
                }
              }

              echo '</div>'; //end row
            }
          ?>
        </div>
      </div>
    </div>
  </div>
<?php }