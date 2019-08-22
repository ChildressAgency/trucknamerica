<h3><?php echo esc_html__('Our Locations', 'trucknamerica'); ?></h3>
<div class="row">
  <?php
    $states = get_terms(array(
      'taxonomy' => 'locations',
      'orderby' => 'name',
      'order' => 'ASC'
    ));

    $s = 0;
    foreach($states as $state){
      $locations = new WP_Query(array(
        'post_type' => 'locations',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'tax_query' => array(
          array(
            'taxonomy' => 'states',
            'field' => 'slug',
            'terms' => $state->slug
          )
        )
      ));

      if($s % 2 == 0){ echo '<div class="clearfix"></div>'; }
      echo '<div class="col-md-6"><table class="table table-borderless">';

        echo '<caption>' . esc_html($state->name) . '</caption>';
        echo '<tbody>';
          if($locations->have_posts()){
            while($locations->have_posts()){
              $locations->the_post();
              echo '<tr>';
              echo '<th scope="row">' . esc_html(get_the_title()) . '</th>';
              echo '<td>' . esc_html(get_field('location_main_phone')) . '</td>';
            }
          }
      echo '</tbody></table></div>';

      $s++;
    }
  ?>
</div>