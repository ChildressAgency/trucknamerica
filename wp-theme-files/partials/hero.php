<?php
  $hero_slides = get_field('hero_slides', 'option');

  if($hero_slides): ?>
    <section id="hero">
      <div id="hero-carousel" class="carousel slide carousel-heights" data-ride="carousel">
        <ol class="carousel-indicators">

          <?php $i = 0; foreach($hero_slides as $slide): ?>
            <?php if(trucknamerica_can_display_hero_slide($slide['start_date'], $slide['end_date'])): ?>
              <li data-target="#hero-carousel" data-slide-to="<?php echo $i; ?>"<?php if($i == 0){ echo ' class="active"'; } ?>></li>
            <?php endif; ?>
          <?php $i++; endforeach; reset($hero_slides); ?>

        </ol>

        <div class="carousel-inner">

          <?php $s = 0; foreach($hero_slides as $slide): ?>
            <?php if(trucknamerica_can_display_hero_slide($slide['start_date'], $slide['end_date'])): ?>

              <?php 
                $hero_image = $slide['image'];
                $hero_image_position = $slide['image_position'];
                if($hero_image_position){
                  $background_position = 'background-position:' . $hero_image_position . ';';
                }
              ?>
              <div class="carousel-item<?php if($s == 0){ echo ' active'; } ?>" style="background-image:url(<?php echo esc_attr($hero_image['url']); ?>); <?php echo esc_attr($background_position); ?>">
                <?php if($slide['show_caption']): ?>
                  <div class="container">
                    <div class="hero-caption">
                      <h1><?php echo esc_html($slide['hero_title']); ?></h1>
                      <h4><?php echo esc_html($slide['hero_caption']); ?></h4>

                      <?php $caption_link = $slide['caption_link']; ?>
                      <a href="<?php echo esc_url($caption_link['url']); ?>" class="btn-alt"><?php echo esc_html($caption_link['title']); ?></a>
                    </div>
                  </div>
                  <div class="half-overlay"></div>
                <?php else: ?>
                  <?php $slide_link = $slide['slide_link']; ?>
                  <a href="<?php echo esc_url($slide_link['url']); ?>" class="hero_link" title="<?php echo esc_attr($slide_link['title']); ?>"></a>
                <?php endif; ?>
              </div>

            <?php endif; ?>
          <?php $s++; endforeach; ?>
          
        </div>
      </div>
    </section>
<?php endif; ?>
