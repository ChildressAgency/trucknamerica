<?php 
  $banner = get_field('site_banner', 'option');
  $banner_link = get_field('banner_link', 'option');
  if($banner): ?>
    <?php if(trucknamerica_can_display_hero_slide(get_field('banner_start_date', 'option'), get_field('banner_end_date', 'option'))): ?>
      <div class="banner">
        <?php if($banner_link){ echo '<a href="' . $banner_link['url'] . '">'; } ?>
          <img src="<?php echo esc_url($banner['url']); ?>" class="img-fluid d-block mx-auto" alt="<?php echo esc_attr($banner['alt']); ?>" />
        <?php if($banner_link){ echo '</a>'; } ?>
      </div>
    <?php endif; ?>
<?php endif; ?>
