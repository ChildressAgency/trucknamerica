<?php get_header(); ?>
  <main id="main">
    <div class="container">
      <article class="main-content">
        <?php 
          if(have_posts()){
            while(have_posts()){
              the_post();

              the_content();
            }
          }
        ?>
        <h3><?php echo esc_html__('Current Job Openings', 'trucknamerica'); ?></h3>
        <?php if(have_rows('job_openings')): while(have_rows('job_openings')): the_row(); ?>
          <div class="job-opening">
            <h2><?php echo esc_html(get_sub_field('job_location')); ?></h2>
            <ul class="list-unstyled">
              <?php if(have_rows('positions')): while(have_rows('positions')): the_row(); ?>
                <?php $apply_now_link = get_sub_field('apply_now_link'); ?>
                <li><?php echo esc_html(get_sub_field('position_title')); ?> - <a href="#job-descriptions" class="more-info"><?php echo esc_html__('MORE INFO', 'trucknamerica'); ?></a> - <a href="<?php echo esc_url($apply_now_link['url']); ?>" target="_blank"><?php echo esc_html__('APPLY NOW', 'trucknamerica'); ?></a></li>
              <?php endwhile; endif; ?>
            </ul>
          </div>
        <?php endwhile; else: ?>
          <p><?php echo esc_html__('There are currently no open positions.', 'trucknamerica'); ?></p>
        <?php endif; ?>
      </article>
    </div>
  </main>

  <section id="to-apply">
    <div class="container">
      <article>
        <?php echo wp_kses_post(get_field('application_instructions')); ?>
        <p class="text-center">
          <a href="<?php echo esc_url(home_url('job-application')); ?>" class="btn-alt"><?php echo esc_html__('APPLY NOW', 'trucknamerica'); ?></a>
        </p>
      </article>
    </div>
  </section>

  <?php 
    $job_descriptions = get_field('job_descriptions');
    if($job_descriptions): ?>
      <section id="job-descriptions">
        <div class="container">
          <article class="main-content">

            <header class="job-desc-header">
              <h2><?php echo esc_html__('Job Descriptions', 'trucknamerica'); ?></h2>
              <p><?php echo esc_html__('Jump to: ', 'trucknamerica'); ?>
                <?php
                  $i = 0;
                  $count = count($job_descriptions);
                  foreach($job_descriptions as $job): ?>
                    <a href="#<?php echo sanitize_title($job['job_title']); ?>"><?php echo esc_html($job['job_title']); ?></a><?php ($i == $count -1) ? ' / ' : ''; ?>
                <?php $i++; endforeach; reset($job_descriptions); ?>
              </p>
            </header>

            <section id="jobs" class="accordion">

              <?php foreach($job_descriptions as $job): ?>
                <?php if($job['display_job_description']): ?>
                  <?php $job_title_slug = sanitize_title($job['job_title']); ?>

                  <div class="card">
                    <div id="<?php echo $job_title_slug; ?>-title" class="card-header">
                      <h3>
                        <a href="#<?php echo $job_title_slug; ?>-description" class="collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="<?php echo $job_title_slug; ?>-description">
                          <span class="expander"></span>
                          <?php echo esc_html($job['job_title']); ?>
                        </a>
                      </h3>
                    </div>
                    <div id="<?php echo $job_title_slug; ?>-description" class="collapse" aria-labelledby="<?php echo $job_title_slug; ?>-title" data-parent="#jobs">
                      <div class="card-body">
                        <?php echo wp_kses_post($job['job_description']); ?>

                        <?php 
                          $job_description_link = $job['job_description_link']; 
                          if($job_description_link): ?>
                            <p class="text-center">
                              <a href="<?php echo esc_url($job_description_link['url']); ?>" class="btn-alt"><?php echo esc_html__('APPLY NOW', 'trucknamerica'); ?></a>
                            </p>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                <?php endif; ?>
              <?php endforeach; ?>

            </section>
          </article>
        </div>
      </section>
  <?php endif; ?>
<?php get_footer();