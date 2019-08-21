<?php
  if(have_rows('top_categories')): ?>
    <section id="top-categories">
      <h2 class="title-subtitle">TOP CATEGORIES<small>Browse through what is popular</small></h2>
      <div class="top-categories d-flex flex-wrap justify-content-center">
        <?php while(have_rows('top_categories')): the_row(); ?>

          <?php
            $double = '';
            if(get_sub_field('double_width')){
              $double = ' double';
            }

            $cat = get_sub_field('product_category');
            $cat_link = get_category_link($cat->term_id);

            if(get_sub_field('use_custom_image')){
              $cat_image = get_sub_field('category_image');
              $cat_image_url = $cat_image['url'];
            }
            else{
              $thumb_id = get_term_meta($cat->term_id, 'thumbnail_id', true);
              $cat_image_url = wp_get_attachment_url($thumb_id);
            }

            $name_position = get_sub_field('category_name_position');
          ?>

          <div class="img-link<?php echo $double; ?>">
            <div class="img-link-inner" style="background-image:url(<?php echo esc_url($cat_image_url); ?>);"></div>
            <a href="<?php echo esc_url($cat_link); ?>">
              <span class="<?php echo esc_attr($name_position); ?>"><?php echo esc_html($cat->name); ?></span>
            </a>
            <div class="light-overlay"></div>
          </div>

        <?php endwhile; ?>

    </div>
    <p class="text-center mt-5">
      <a href="<?php echo esc_url(home_url('shop')); ?>" class="btn-main"><?php echo esc_html__('Shop All', 'option'); ?></a>
    </p>
  </section>
