<?php get_header(); ?>
  <main id="main">
    <section id="timeline">
      <div class="row no-gutters">
        <div class="col-3 timeline-marker">
          <div class="marker-line"></div>
        </div>
        <div class="col-9 timeline-contents">

          <?php
            if(have_rows('timeline_section_layout')): while(have_rows('timeline_section_layout')): the_row();
              $timeline_layout = get_row_layout();

              switch($timeline_layout){
                case 'image_section': ?>

                  <?php if(have_rows('timeline_images')): ?>
                    <div class="row no-gutters timeline-section">
                      <div class="col-12">
                        <div class="timeline-image-section">
                          <?php while(have_rows('timeline_images')): the_row(); ?>
                            <div class="timeline-image">
                              <?php $timeline_image = get_sub_field('timeline_image'); ?>
                              <img src="<?php echo esc_url($timeline_image['url']); ?>" class="img-fluid" alt="<?php echo esc_attr($timeline_image['alt']); ?>" />
                            </div>
                          <?php endwhile; ?>
                        </div>
                      </div>
                    </div>
                  <?php endif; ?>

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
          <?php endwhile; endif; ?>
        </div>
      </div>
    </section>
  </main>
<?php get_footer();