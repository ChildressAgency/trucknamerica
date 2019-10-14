<?php
  $facebook = get_field('facebook', 'option');
  $twitter = get_field('twitter', 'option');
  $instagram = get_field('instagram', 'option');
?>

<div class="social">
  <?php if($facebook): ?>
    <a href="<?php echo esc_url($facebook); ?>" class="facebook" title="Facebook" target="_blank"><i class="fab fa-facebook"></i><span class="sr-only">Facebook</span></a>
  <?php endif; if($twitter): ?>
    <a href="<?php echo esc_url($twitter); ?>" class="twitter" title="Twitter" target="_blank"><i class="fab fa-twitter"></i><span class="sr-only">Twitter</span></a>
  <?php endif; if($instagram): ?>
    <a href="<?php echo esc_url($instagram); ?>" class="instagram" title="Instagram" target="_blank"><i class="fab fa-instagram"></i><span class="sr-only">Instagram</span></a>
  <?php endif; ?>
</div>
