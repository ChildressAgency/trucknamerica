<?php get_header(); ?>
<main id="main">
  <div class="row no-gutters">
    <div class="col-lg-6">
      <div id="locations" itemscope itemtype="https://schema.org/LocalBusiness">
        <?php
          $states = get_terms(array(
            'taxonomy' => 'states',
            'orderby' => 'name',
            'order' => 'ASC'
          ));

          foreach($states as $state): ?>
            <h2><?php echo esc_html($state->name) . ' ' . esc_html__('Locations', 'trucknamerica'); ?></h2>
            <?php
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

              if($locations->have_posts()): while($locations->have_posts()): $locations->the_post(); ?>

                <div class="row no-gutters location">
                  <div class="col-12">
                    <h3><?php the_title(); ?></h3>
                  </div>
                  <div class="col-md-6">
                    <a href="<?php echo esc_url(get_field('larger_map_link')); ?>" class="store-address mb-0" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress" target="_blank">
                      <span class="d-block" itemprop="streetAddress">
                        <?php echo esc_html(get_field('address_1')); ?>
                        <?php echo get_field('address_2') ? '<br />' . esc_html(get_field('address_2')) : ''; ?>
                      </span>
                      <span itemprop="addressLocality"><?php echo esc_html(get_field('city')); ?></span>,
                      <span itemprop="addressRegion"><?php echo esc_html(get_field('state')); ?></span>&nbsp;
                      <span itemprop="postalCode"><?php echo esc_html(get_field('zip')); ?></span>
                    </a>
                    <a href="tel:<?php echo esc_attr(get_field('location_main_phone_number')); ?>"><span class="d-block main-phone" itemprop="telephone"><?php echo esc_html(get_field('location_main_phone_number')); ?></span></a>
                    <div class="management">
                      <?php 
                        $executive_manager = get_field('executive_manager');
                        $managers = get_field('managers');
                      ?>
                      <p>
                        <?php if($executive_manager): ?>
                          <span class="d-block"><?php echo esc_html__('Executive Manager', 'trucknamerica') . ' ' . $executive_manager; ?></span>
                        <?php endif; if($managers): ?>
                          <span class="d-block"><?php echo esc_html__('Manager(s)', 'trucknamerica') . ' ' . $managers; ?></span>
                        <?php endif; ?>
                      </p>
                    </div>
                    <a href="#contact-location-modal" class="btn-alt btn-location-contact mt-4" data-toggle="modal" data-contact_location="<?php echo esc_html(get_the_title()); ?>">Contact Us</a>
                  </div>

                  <div class="col-md-6">
                    <ul class="list-unstyled phone-numbers">
                      <li><span itemprop="telephone"><?php echo esc_html(get_field('location_main_phone_number')); ?></span>&nbsp;Sales</li>
                      <?php if(get_field('secondary_phone_number')): ?>
                        <li><span itemprop="telephone"><?php echo esc_html(get_field('secondary_phone_number')); ?></span>&nbsp;Sales</li>
                      <?php endif; if(get_field('fax_number')): ?>
                        <li><span itemprop="faxNumber"><?php echo esc_html(get_field('fax_number')); ?></span>&nbsp;Fax</li>
                      <?php endif; ?>
                    </ul>

                    <?php if(have_rows('hours')): ?>
                      <ul class="list-unstyled store-hours">
                        <?php while(have_rows('hours')): the_row(); ?>
                          <?php $day_and_time = get_sub_field('day_and_time'); ?>
                          <li itemprop="openingHours" content="<?php echo esc_attr($day_and_time); ?>"><?php echo esc_html($day_and_time); ?></li>
                        <?php endwhile; ?>
                      </ul>
                      <p class="directions" itemprop="hasMap"><a href="<?php echo esc_url(get_field('larger_map_link')); ?>" target="_blank"><i class="far fa-map"></i>&nbsp;VIEW LARGER MAP</a></p>
                    <?php endif; ?>
                  </div>
                  <div class="clearfix"></div>
                  <div class="col-12 location-more-info">
                    <?php echo wp_kses_post(get_field('additional_information')); ?>
                  </div>
                </div>

            <?php endwhile; endif; ?>

        <?php endforeach; ?>
      </div>
    </div>
    <div class="col-lg-6">
      <?php
        $map_locations = new WP_Query(array(
          'post_type' => 'locations',
          'posts_per_page' => -1,
          'post_status' => 'publish'
        ));

        if($map_locations->have_posts()): ?>
          <div class="locations-map embed-responsive embed-responsive-1by1">
            <?php while($map_locations->have_posts()): $map_locations->the_post(); ?>

              <?php $location = get_field('google_map_marker_location'); ?>
              <?php if($location): ?>
                <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>">
                  <h4><?php echo esc_html__('Truck\'n America', 'trucknamerica'); ?><br /><small><?php echo esc_html(get_the_title()); ?></small></h4>
                  <p class="map-address">
                    <span class="d-block"><?php echo esc_html(get_field('address_1')); ?></span>
                    <span class="d-block"><?php echo esc_html(get_field('address_2')); ?></span>
                    <span><?php echo esc_html(get_field('city')) . ', ' . esc_html(get_field('state')) . ' ' . esc_html(get_field('zip')); ?></span>
                  </p>
                  <p class="map-phone">
                    <?php $map_phone = get_field('location_main_phone_number'); ?>
                    <a href="tel:<?php echo esc_attr($map_phone); ?>"><?php echo esc_html($map_phone); ?></a>
                  </p>
                </div>
              <?php endif; ?>

            <?php endwhile; ?>
          </div>
      <?php endif; ?>
    </div>
  </div>
</main>

<div class="modal fade" id="contact-location-modal" tabindex="-1" role="dialog" aria-labelledby="contact-location-title" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="contact-location-title"><?php echo esc_html__('Contact Truckn\' America', 'trucknamerica'); ?>&nbsp;<span id="location_title"><span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <?php 
          $location_contact_form_shortcode = get_field('location_contact_form_shortcode', 'option'); 
          echo do_shortcode($location_contact_form_shortcode);
        ?>
      </div>
    </div>
  </div>
</div>
<?php get_footer();