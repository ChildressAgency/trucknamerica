<?php get_header(); ?>
<main id="main">
  <div class="container">
    <?php get_template_part('partials', 'banner'); ?>

    <?php 
      if(have_posts()){
        while(have_posts()){
          the_post();

          echo '<article>';
            the_content();
          echo '</article>';
        }
      }
    ?>
  </div>

  <?php if(have_rows('our_heros')): while(have_rows('our_heros')): the_row(); ?>
    <section class="our-hero-section">
      <header class="our-hero-header">
        <div class="container">
          <div class="row">
            <div class="col-3">
              <?php 
                $our_hero_image = get_sub_field('our_hero_image'); 

                if($our_hero_image){
                  $our_hero_image_url = $our_hero_image['url'];
                  $our_hero_image_alt = $our_hero_image['alt'];
                }
                else{
                  $our_hero_image_url = get_stylesheet_directory_uri() . '/images/hero-placeholder.jpg';
                  $our_hero_image_alt = '';
                }
              ?>
              <img src="<?php echo esc_url($our_hero_image_url); ?>" class="our-hero-img" alt="<?php echo esc_attr($our_hero_image_alt); ?>" />
            </div>
            <div class="col-9">
              <div class="our-hero-name">
                <h3><?php echo esc_html(get_sub_field('our_hero_name')); ?></h3>
              </div>
            </div>
          </div>
        </div>
      </header>
      <article class="our-hero-article">
        <div class="container">
          <div class="col-md-9 offset-md-3">
            <?php echo apply_filters('the_content', wp_kses_post(get_sub_field('our_hero_bio'))); ?>
          </div>
        </div>
      </article>
    </section>
  <?php endwhile; endif; ?>
</main>
<?php get_footer();