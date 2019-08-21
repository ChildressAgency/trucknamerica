<?php if(have_rows('partners', 'option')): ?>
  <section id="partners">
    <div class="container">
      <h3><?php echo esc_html__('Our Partners', 'trucknamerica'); ?></h3>
      <div class="partners">
        <?php while(have_rows('partners', 'option')): the_row(); ?>
          <?php $partner_img = get_sub_field('partner_image'); ?>
          <div>
            <img src="<?php echo esc_url($partner_imag['url']); ?>" class="img-fluid d-block mx-auto" alt="<?php echo esc_attr($partner_img['alt']); ?>" />
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </section>
<?php endif; ?>