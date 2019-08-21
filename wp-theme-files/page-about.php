<?php get_header(); ?>
  <main id="main">
    <section id="timeline">
      <div class="row no-gutters">
        <div class="col-3 timeline-marker">
          <div class="marker-line"></div>
        </div>
        <div class="col-9 timeline-contents">

          <?php
            $timeline_layout = get_field('timeline_section_layout');
            switch($timeline_layout){
              case 'image_section': ?>

                <?php $timeline_image = get_sub_field('timeline_image'); ?>
                <div class="row no-gutters timeline-section">
                  <div class="col-12">
                    <div class="timeline-image-section">
                      <div class="timeline-image">
                        <img src="<?php echo esc_url($timeline_image['url']); ?>" class="img-fluid" alt="<?php echo esc_attr($timeline_image['alt']); ?>" />
                      </div>
                    </div>
                  </div>
                </div>

              <?php break;

              default: ?>
                <div class="row no-gutters timeline-section">
                  <div class="col-lg-2">
                    <div class="timeline-years">
                      <?php if(have_rows('timeline_years')): while(have_rows('timeline_years')): the_row(); ?>
                        <span class="timeline-year"><?php echo esc_html(get_sub_field('timeline_year')); ?></span>
                      <?php endwhile; endif; ?>
                    </div>
                  </div>
                  <div class="col-lg-10">
                    <div class="timeline-event">
                      <?php echo wp_kses_post(get_sub_field('timeline_event')); ?>
                    </div>
                  </div>
                </div>

            <?php } ?>

        </div>
      </div>
    </section>
  </main>
<?php get_footer();