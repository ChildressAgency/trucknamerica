<?php
/**
 * Import original product list
 */
if(!defined('ABSPATH')){ exit; }

if(!class_exists('Trucknamerica_Import_Products')){
  class Trucknamerica_Import_Products{
    private $features_key = 'field_5d60521858ac5';
    private $specs_key = 'field_5d694c80d04b3';
    private $accessories_key = 'field_5d6fc57336eb3';
    private $options_key = 'field_5d60523358ac6';
    private $video_key = 'field_5d60524858ac7';

    public function __construct(){
      $this->init();
    }

    public function init(){
      add_shortcode('trucknamerica_import_products', array($this, 'process_shortcode'));
    }

    public function process_shortcode(){
      ob_start();

      if(isset($_POST['submit'])){
        $this->process_import();
      }
      else{
        $this->show_upload_form();
      }

      return ob_get_clean();
    }

    private function show_upload_form($upload_error = null){
      ?>
      <form action="<?php echo esc_url(get_permalink()); ?>" method="post" enctype="multipart/form-data">
        <h3><?php echo esc_html__('Import products', 'trucknamerica'); ?></h3>

        <?php $nonce = wp_create_nonce('import_products'); ?>
        <input type="hidden" name="nonce" value="<?php echo $nonce; ?>" />

        <div class="from-group">
          <button type="submit" name="submit" class="btn btn-primary"><?php echo esc_html__('BEGIN', 'trucknamerica'); ?></button>
        </div>
      </form>
      <?php
    }

    private function process_import(){
      global $wpdb;

      $products = $wpdb->get_results("
        SELECT * 
        FROM products_import");

      if($products){
        foreach($products as $product){
          $product_id = $this->create_product($product);

          if(!is_wp_error($product_id)){
            $this->set_the_brand($product_id, $product->manufacturer_name);

            update_field($this->features_key, $product->features, $product_id);
            update_field($this->specs_key, $product->specs, $product_id);
            update_field($this->accessories_key, $product->accessories, $product_id);
            update_field($this->options_key, $product->options, $product_id);
            update_field($this->video_key, $product->video, $product_id);

            echo '<p>Imported: ' . $product->product_page_title . '</p>';
          }
          else{
            echo '<p>Error importing ' . $product->product_page_title . ' - ' . $product_id->get_error_message() . '</p>';
          }
        }
      }
    }

    private function create_product($product){
      $new_product = new WC_Product();

      $new_product->set_name($product->product_page_title);
      $new_product->set_status('publish');
      $new_product->set_catalog_visibility('visible');
      $new_product->set_description($product->product_desc);
      $new_product->set_sku($product->product_sku);

      $product_price = ($product->product_price > 0) ? $product->product_price : '';
      $new_product->set_price($product_price);

      $new_product->set_manage_stock(false);
      $new_product->set_reviews_allowed(false);
      $new_product->set_sold_individually(false);
      $new_product->set_downloadable(false);

      if($product->product_featured > 0){
        $new_product->set_featured(true);
      }

      $cat_ids = $this->get_product_cat_ids($product->category_name);
      $new_product->set_category_ids($cat_ids);

      if($product->tags !== null && $product->tags !== ''){
        $tag_ids = $this->get_product_tag_ids($product->tags);
        $new_product->set_tag_ids($tag_ids);
      }

      $product_image_ids = $this->get_product_image_ids($product);
      $new_product->set_image_id($product_image_ids[0]);

      if(count($product_image_ids) > 1){
        $new_product->set_gallery_image_ids($product_image_ids);
      }

      $product_id = $new_product->save();

      return $product_id;
    }

    private function get_product_image_ids($product){
      $image_path = 'https://www.trucknamerica.com/media/com_eshop/products/';
      $image_ids = array();
      $images = array($image_path . $product->product_image);

      if($product->product_additional_images !== null || $product->product_additional_images !== ''){
        $additional_images = explode(';', $product->product_additional_images);

        foreach($additional_images as $additional_image){
          $images[] = $image_path . $additional_image;
        }
      }

      foreach($images as $image){
        $image_id = $this->upload_media($image);
        if($image_id){
          $image_ids[] = $image_id;
        }
      }

      return $image_ids;
    }

    private function upload_media($image){
      require_once 'wp-admin/includes/image.php';
      require_once 'wp-admin/includes/file.php';
      require_once 'wp-admin/includes/media.php';

      $media = media_sideload_image($image, 0);
      $attachments = get_posts(array(
        'post_type' => 'attachment',
        'post_status' => null,
        'post_parent' => 0,
        'orderby' => 'post_date',
        'order' => 'DESC'
      ));

      return $attachments[0]->ID;
    }

    private function get_product_cat_ids($cat_list){
      // UTVs, Golf Carts & Carts / Accessories/UTVs & Carts/Fun Kart Units;UTVs, Golf Carts & Carts / Accessories;UTVs, Golf Carts & Carts / Accessories/UTVs & Carts

      $cat_ids = array();

      $cats = explode(';', $cat_list);
      foreach($cats as $cat){
        $cat_name_parts = explode('/', $cat);
        $cat_name = array_pop($cat_name_parts);

        $cat_exists = term_exists($cat_name, 'product_cat');

        if($cat_exists !== 0 && $cat_exists !== null){
          $existing_cat = get_term_by('name', $cat_name, 'product_cat');

          if($existing_cat){
            $cat_ids[] = $existing_cat->term_id;
          }
        }

      }

      return $cat_ids;
    }

    private function set_the_brand($product_id, $brand){
      $brand_id = term_exists($brand);

      if($brand_id == 0  || $brand_id == null){
        $brand_term = wp_insert_term($brand, 'brands');
        if(!is_wp_error($brand_term)){
          $brand_id = $brand_term[0];
        }
        else{
          echo '<p>Error: ' . $brand_term->get_error_message() . '</p>';
        }
      }

      if(!is_wp_error($brand_id)){
        wp_set_post_terms($product_id, $brand_id, 'brands');
      }
      else{
        echo '<p>Error: ' . $brand_id->get_error_message() . '</p>';
      }
    }

    private function get_product_tag_ids($tag_list){
      // access, access aa battery led truck bed light, access bed battery light, agir-cover aa battery led light, aci bed light, aa led truck bed light, led bed battery light with switch

      $tag_ids = array();

      $tags = explode(', ', $tag_list);
      foreach($tags as $tag){
        $existing_tag = term_exists($tag);

        if($existing_tag == 0 || $existing_tag == null){
          $existing_term = wp_insert_term($tag, 'product_tag');
          $existing_tag = $existing_term[0];
        }

        if(!is_wp_error($existing_tag)){
          $tag_ids[] = $existing_tag;
        }
        else{
          echo '<p>' . $existing_tag->get_error_message() . '</p>';
        }
      }

      return $tag_ids;
    }
  }//end class
}