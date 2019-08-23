<?php
/**
 * Plugin Name: trucknamerica.com Core Functionality
 * Description: This contains all your site's core functionality so that it is theme independent. <strong>It should always be activated.</strong>
 * Author: The Childress Agency
 * Author URI: https://childressagency.com
 * Version: 1.0
 * Text Domain: maxvelocity
 */
if(!defined('ABSPATH')){ exit; }

define('TRUCKNAMERICA_PLUGIN_DIR', dirname(__FILE__));
define('TRUCKNAMERICA_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Load ACF if not already loaded
 */
if(!class_exists('acf')){
  require_once TRUCKNAMERICA_PLUGIN_DIR . '/vendors/advanced-custom-fields-pro/acf.php';
  add_filter('acf/settings/path', 'trucknamerica_acf_settings_path');
  add_filter('acf/settings/dir', 'trucknamerica_acf_settings_dir');
}

function trucknamerica_acf_settings_path($path){
  $path = plugin_dir_path(__FILE__) . 'vendors/advanced-custom-fields-pro/';
  return $path;
}

function trucknamerica_acf_settings_dir($dir){
  $dir = plugin_dir_url(__FILE__) . 'vendors/advanced-custom-fields-pro/';
  return $dir;
}

add_action('plugins_loaded', 'trucknamerica_load_textdomain');
function trucknamerica_load_textdomain(){
  load_plugin_textdomain('trucknamerica', false, basename(TRUCKNAMERICA_PLUGIN_DIR) . '/languages');
}

require_once TRUCKNAMERICA_PLUGIN_DIR . '/includes/trucknamerica-create-post-types.php';
add_action('init', 'trucknamerica_create_post_types');

add_action('acf/init', 'trucknamerica_acf_options_page');
function trucknamerica_acf_options_page(){
  acf_add_options_page(array(
    'page_title' => esc_html__('Hero Settings', 'trucknamerica'),
    'menu_title' => esc_html__('Hero Settings', 'trucknamerica'),
    'menu_slug' => 'hero-settings',
    'capability' => 'edit_posts',
    'icon_url' => 'dashicons-slides',
    'position' => 7,
    'redirect' => false
  ));

  acf_add_options_page(array(
    'page_title' => esc_html__('General Settings', 'trucknamerica'),
    'menu_title' => esc_html__('General Settings', 'trucknamerica'),
    'menu_slug' => 'general-settings',
    'capability' => 'edit_posts',
    'redirect' => false
  ));

  acf_add_options_sub_page(array(
    'page_title' => esc_html__('Footer Settings', 'trucknamerica'),
    'menu_title' => esc_html__('Footer Settings', 'trucknamerica'),
    'parent_slug' => 'general-settings'
  ));
}

require_once TRUCKNAMERICA_PLUGIN_DIR . '/includes/class-trucknamerica-brands-widget.php';
add_action('widgets_init', 'trucknamerica_init_widgets');
function trucknamerica_init_widgets(){
  register_widget('Trucknamerica_Brands_Widget');
}

/**
 * Add additional woocommerce product tabs
 */
add_filter('woocommerce_product_tabs', 'trucknamerica_additional_product_tabs');
function trucknamerica_additional_product_tabs($tabs){
  $tabs['featured_tab'] = array(
    'title' => esc_html__('Features', 'trucknamerica'),
    'priority' => 11,
    'callback' => 'trucknamerica_features_tab'
  );

  $tabs['popular_options_tab'] = array(
    'title' => esc_html__('Popular Options', 'trucknamerica'),
    'priority' => 12,
    'callback' => 'trucknamerica_popular_options_tab'
  );

  $tabs['video_tab'] = array(
    'title' => esc_html__('Video', 'trucknamerica'),
    'priority' => 13,
    'callback' => 'trucknamerica_video_tab'
  );

  return $tabs;
}

function trucknamerica_features_tab(){
  echo '<h2>' . esc_html__('Features', 'trucknamerica') . '</h2>';
  echo wp_kses_post(get_field('features'));
}

function trucknamerica_popular_options_tab(){
  echo '<h2>' . esc_html__('Popular Options', 'trucknamerica') . '</h2>';
  echo wp_kses_post(get_field('popular_options'));
}

function trucknamerica_video_tab(){
  echo '<h2>' . esc_html__('Video', 'trucknamerica') . '</h2>';
  echo wp_kses_post(get_field('video'));
}

/**
 * Allow iframes with wp_kses_post
 * allows youtube embed to work
 */
add_filter('wp_kses_allowed_html', 'trucknamerica_allow_iframes_filter');
function trucknamerica_allow_iframes_filter($allowedposttags){
	$allowedposttags['iframe'] = array(
		'align' => true,
		'width' => true,
		'height' => true,
		'frameborder' => true,
		'name' => true,
		'src' => true,
		'id' => true,
		'class' => true,
		'style' => true,
		'scrolling' => true,
		'marginwidth' => true,
		'marginheight' => true,
  );
  
	return $allowedposttags;
}