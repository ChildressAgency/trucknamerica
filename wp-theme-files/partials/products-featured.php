<?php
  $featured_products = new WP_Query(array(
    'post_type' => 'product',
    'posts_per_page' => -1,
    'tax_query' => array(
      array(
        'taxonomy' => 'product_visibility',
        'field' => 'name',
        'terms' => 'featured'
      )
    )
  ));

  if($featured_products->have_posts()): ?>
    <section id="featured-products">
      <div class="container">
        <h2 class="title-subtitle">FEATURED PRODUCTS<small>See whats new and popular</small></h2>
        <div class="card-deck featured-products">

          <?php while($featured_products->have_posts()): $featured_products->the_post(); ?>
            <div class="card featured-product">
              <?php
                if(has_post_thumbnail()){
                  $product_image_url = get_the_post_thumbnail_url(get_the_ID());
                }
                else{
                  $product_image_url = wc_placeholder_img_src('thumbnail');
                }
              ?>
              <img src="<?php echo esc_url($product_image_url); ?>" class="card-img-top" alt="" />
              <div class="card-body">
                <h4 class="card-title"><?php the_title(); ?></h4>
              </div>
              <div class="card-footer">
                <a href="<?php the_permalink(); ?>">See Details</a>
              </div>
            </div>
          <?php endwhile; ?>

        </div>
      </div>
    </section>
<?php endif; ?>