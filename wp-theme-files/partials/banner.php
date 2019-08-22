<?php 
  $banner = get_field('site_banner', 'option');
  if($banner): ?>
    <?php if(trucknamerica_can_display_hero_slide(get_field('banner_start_date', 'option'), get_field('banner_end_date', 'option'))): ?>
      <div class="banner">
        <img src="<?php echo esc_url($banner['url']); ?>" class="img-fluid d-block mx-auto" alt="<?php echo esc_attr($banner['alt']); ?>" />
      </div>
    <?php endif; ?>
<?php endif; ?>
