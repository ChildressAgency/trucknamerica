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