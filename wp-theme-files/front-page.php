<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <?php get_template_part('partials', 'banner'); ?>

      <?php get_template_part('partials/products', 'top_categories'); ?>

      <section id="hp-services">
        <div class="row no-gutters">
          <?php $service_1_image = get_field('service_block_1_image'); ?>

          <div class="col-md-6 left-side d-flex align-items-center" style="background-image:url(<?php echo $service_1_image['url']); ?>);">
            <div class="services-content">
              <h2><?php echo esc_html(get_field('service_block_1_title')); ?></h2>
              <p><?php echo esc_html(get_field('service_block_1_description')); ?></p>
              <?php $service_1_link = get_field('service_block_1_link'); ?>
              <a href="<?php echo esc_url($service_1_link['url']); ?>" class="learn-more"><?php echo esc_html($service_1_link['title']); ?></a>
            </div>
            <div class="blue-overlay"></div>
          </div>

          <?php $service_2_image = get_field('service_block_2_image'); ?>
          <div class="col-md-6 right-side d-flex align-items-center" style="background-image:url(<?php echo esc_url($service_2_image['url']); ?>);">
            <div class="services-content">
              <h2><?php echo esc_html(get_field('service_block_2_title')); ?></h2>
              <p><?php echo esc_html(get_field('service_block_2_description')); ?></p>
              <?php $service_2_link = get_field('service_block_2_link'); ?>
              <a href="<?php echo esc_url($service_2_link['url']); ?>" class="learn-more"><?php echo esc_html($service_2_link['title']); ?></a>
            </div>
            <div class="dark-overlay"></div>
          </div>
        </div>
        <div class="row no-gutters">
          <div class="col-12 trade-ins">
            <div class="services-content">
              <h2><?php echo esc_html(get_field('service_block_3_title')); ?></h2>
              <p><?php echo esc_html(get_field('service_block_3_description')); ?></p>
              <?php $service_3_link = get_field('service_block_3_link'); ?>
              <p class="text-center">
                <a href="<?php echo esc_url($service_3_link['url']); ?>" class="btn-main"><?php echo esc_html($service_3_link['title']); ?></a>
              </p>
            </div>
          </div>
        </div>
        <div class="row no-gutters">
          <?php $service_4_image = get_field('service_block_4_image'); ?>
          <div class="col-12 trailers d-flex align-items-center" style="background-image:url(<?php echo esc_url($service_4_image['url']); ?>);">
            <div class="services-content">
              <h2><?php echo esc_html(get_field('service_block_4_title')); ?></h2>
              <p><?php echo esc_html(get_field('service_block_4_description')); ?></p>
              <?php $service_4_link = get_field('service_block_4_link'); ?>
              <a href="<?php echo esc_url($service_4_link['url']); ?>" class="learn-more"><?php echo esc_html($service_4_link['title']); ?></a>
            </div>
            <div class="dark-overlay"></div>
          </div>
        </div>
      </section>
    </div>
  </main>

  <section id="testimonials-feed">
    <div class="row no-gutters">
      <div class="col-md-6 testimonials-side">
        <div class="row">
          <div class="col-md-6">
            <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/testimonial-quotes.png" class="img-fluid d-block mx-auto" alt="" />
          </div>
          <div class="col-md-6">
            <?php
              $testimonials = get_field('testimonials');
              if($testimonials): ?>
                <div id="testimonials-carousel" class="carousel slide carousel-heights" data-ride="carousel">
                  <ol class="carousel-indicators">
                    <?php for($c = 0; $c < count($testimonials); $c++): ?>
                      <li data-target="#testimonials-carousel" data-slide-to="<?php echo $c; ?>"<?php if($t == 0){ echo ' class="active"'; } ?>></li>
                    <?php endfor; ?>
                  </ol>

                  <div class="carousel-inner">

                    <?php $t = 0; foreach($testimonials as $testimonial): ?>
                      <div class="carousel-item<?php if($t == 0){ echo ' active'; } ?>">
                        <div class="testimonial">
                          <p><?php echo esc_html($testimonial['testimonial']); ?></p>
                          <cite><?php echo esc_html($testimonial['testimonial_author']); ?></cite>
                        </div>
                      </div>
                    <?php $t++; endforeach; ?>

                  </div>
                </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
      <div class="col-md-6 feed-side">
        <header class="feed-header d-flex justify-content-between">
          <div class="feed-title">
            <h2><?php echo esc_html(get_field('instagram_section_title')); ?></h2>
            <?php
              $facebook = get_field('facebook', 'option');
              $twitter = get_field('twitter', 'option');
            ?>
            <div class="social">
              <p>@TruckNAmerica - Find us also on:
                <?php if($facebook): ?>   
                  <a href="<?php echo esc_url($facebook); ?>" class="facebook" title="Facebook" target="_blank"><i class="fab fa-facebook"></i><span class="sr-only">Facebook</span></a>
                <?php endif; if($twitter): ?>
                  <a href="<?php echo esc_url($twitter); ?>" class="twitter" title="Twitter" target="_blank"><i class="fab fa-twitter"></i><span class="sr-only">Twitter</span></a>
                <?php endif; ?>
              </p>
            </div>
          </div>
          <a href="<?php echo esc_url('instagram', 'option'); ?>" class="instagram large" title="Instagram" target="_blank"><i class="fab fa-instagram"></i><span class="sr-only">Instagram</span></a>
        </header>
        <div class="instagram-feed">
          <?php echo do_shortcode('[instagram-feed]'); ?>
        </div>
      </div>
    </div>
  </section>

<?php get_footer();