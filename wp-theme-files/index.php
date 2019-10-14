<?php get_header(); ?>
<main id="main">
  <div class="container">
    <?php get_template_part('partials', 'banner'); ?>

    <?php 
      if(have_posts()){
        while(have_posts()){
          the_post();

          if(is_singular()){
            echo '<article>';
              the_content();
            echo '</article>';
          }
          else{
            echo '<h2>' . esc_html(get_the_title()) . '</h2>';
            the_excerpt();
            echo '<a href="' . esc_url(get_the_permalink()) . '">Read More</a>';
          }
        }
      }
      else{
        echo '<p>' . esc_html__('Sorry, we could not find what you were looking for.', 'trucknamerica') . '</p>';
      } wp_pagenavi();
    ?>
  </div>
</main>
<?php get_footer();