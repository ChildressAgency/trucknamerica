<?php if(have_rows('quick_links', 'option')): ?>
  <section id="quick-links">
    <div class="container">
      <div class="quick-links d-flex flex-wrap justify-content-center">
        <?php while(have_rows('quick_links', 'option')): the_row(); ?>

          <?php
            $quick_link_img = get_sub_field('quick_link_image');
            if(!$quick_link_img){
              $quick_link_img = get_field('quick_link_default_image', 'option');
            }

            $quick_link = get_sub_field('quick_link');
          ?>
          <div class="img-link">
            <div class="img-link-inner" style="background-image:url(<?php echo esc_url($quick_link_img['url']); ?>);"></div>
            <a href="<?php echo esc_url($quick_link['url']); ?>">
              <span class="center-center"><?php echo esc_html($quick_link['title']); ?></span>
            </a>
            <div class="dark-overlay"></div>
          </div>

        <?php endwhile; ?>

      </div>
    </div>
  </section>
<?php endif; ?>