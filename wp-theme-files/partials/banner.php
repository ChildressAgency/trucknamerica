<?php 
  $banner = get_field('site_banner', 'option');
  if($banner): ?>
    <div class="banner">
      <img src="<?php echo esc_url($banner['url']); ?>" class="img-fluid d-block mx-auto" alt="<?php echo esc_attr($banner['alt']); ?>" />
    </div>
<?php endif; ?>
