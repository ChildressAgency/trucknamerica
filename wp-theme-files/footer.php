<?php get_template_part('partials/products', 'featured'); ?>

<?php get_template_part('partials', 'quick_links'); ?>

<?php get_template_part('partials', 'partners'); ?>

  <footer id="footer">
    <section id="footer-top">
      <div class="container">
        <div class="row">
          <div class="col-md-8">

            <?php if(have_rows('locations', 'option')): ?>
              <h3><?php echo esc_html__('Our Locations', 'trucknamerica'); ?></h3>

              <div class="row">
                <?php $l = 0; while(have_rows('locations', 'option')): the_row(); ?>

                  <?php if($l % 2 == 0){ echo '<div class="clearfix"></div>'; } ?>
                  <div class="col-md-6">
                    <table class="table table-borderless">
                      <caption><?php echo esc_html(get_sub_field('location_area'); ?></caption>
                      <tbody>
                        <?php if(have_rows('area_locations')): while(have_rows('area_locations')): the_row(); ?>
                          <tr>
                            <th scope="row"><?php echo esc_html(get_sub_field('area_location')); ?></th>
                            <td><?php echo esc_html(get_sub_field('area_location_phone')); ?></td>
                          </tr>
                        <?php endwhile; endif; ?>
                      </tbody>
                    </table>
                  </div>

                <?php endwhile; ?>
              </div>
            <?php endif; ?>
          </div>

          <div class="col-md-4">
            <h3><?php echo esc_html__('Hours of Operation', 'trucknamerica'); ?></h3>
            <table class="table table-borderless">
              <caption>&nbsp;</caption>
              <tbody>
                <?php if(have_rows('hours_of_operation', 'option')): while(have_rows('hours_of_operation', 'option')): the_row(); ?>
                  <tr>
                    <th scope="row"><?php echo esc_html(get_sub_field('day_of_week')); ?></th>
                    <td><?php echo esc_html(get_sub_field('hours')); ?></td>
                  </tr>
                <?php endwhile; endif; ?>
              </tbody>
            </table>

            <div class="holiday-hours">
              <h4><?php echo esc_html__('Holiday Hours of Operation', 'trucknamerica'); ?></h4>
              <?php echo get_field('holiday_hours_of_operation', 'option'); ?>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="footer-middle">
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <h3><?php echo esc_html__('About', 'trucknamerica'); ?></h3>
            <?php
              $about_menu_args = array(
                'theme_location' => 'footer-about-menu',
                'menu' => '',
                'container' => '',
                'container_id' => '',
                'container_class' => '',
                'menu_id' => '',
                'menu_class' => 'list-unstyled',
                'echo' => true,
                'fallback_cb' => '',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth' => 1
              );
              wp_nav_menu($about_menu_args);
            ?>
          </div>
          <div class="col-lg-3 col-md-6">
            <h3><?php echo esc_html('Customer Service', 'trucknamerica'); ?></h3>
            <?php 
              $customer_service_menu_args = array(
                'theme_location' => 'footer-customer-service-menu',
                'menu' => '',
                'container' => '',
                'container_id' => '',
                'container_class' => '',
                'menu_id' => '',
                'menu_class' => 'list-unstyled',
                'echo' => true,
                'fallback_cb' => '',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth' => 1
              );
              wp_nav_menu($customer_service_menu_args);
            ?>
          </div>
          <div class="clearfix d-block d-lg-none"></div>
          <div class="col-lg-3 col-md-6">
            <h3><?php echo esc_html__('Shop by Category', 'trucknamerica'); ?></h3>
            <?php 
              $shop_menu_args = array(
                'theme_location' => 'footer-shop-menu', 
                'menu' => '',
                'container' => '',
                'container_id' => '',
                'container_class' => '',
                'menu_id' => '',
                'menu_class' => '',
                'echo' => true,
                'fallback_cb' => '',
                'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth' => 1
              );
              wp_nav_menu($shop_menu_args);
            ?>
          </div>
          <div class="col-lg-3 col-md-6 find-us">
            <h3><?php echo esc_html__('Find Us On', 'trucknamerica'); ?></h3>
            <?php get_template_part('partials', 'social'); ?>

            <h3 class="mt-5"><?php echo esc_html__('Affiliations', 'trucknamerica'); ?></h3>
            <?php $affiliations_img = get_field('affiliations_image', 'option'); ?>
            <img src="<?php echo esc_url($affiliations_img['url']); ?>" class="affiliations" alt="<?php echo esc_attr($affiliations_img['alt']); ?>" />
          </div>
        </div>
      </div>
    </section>
    <section id="footer-bottom">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <p>&copy; Truck'n America. All rights reserved. Prices and product availability are subject to change without notice.</p>
            <p>Website created by <a href="https://childressagency.com" target="_blank">The Childress Agency</a></p>
          </div>
          <div class="col-lg-6">
            <p class="text-right">
              <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/credit-cards.png" class="img-fluid" alt="Accepted Credit Cards" />
            </p>
          </div>
        </div>
      </div>
    </section>
  </footer>
  <?php wp_footer(); ?>
</body>
</html>