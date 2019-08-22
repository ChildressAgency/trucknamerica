<?php
if(!defined('ABSPATH')){ exit; }

function trucknamerica_create_post_types(){
  $locations_labels = array(
    'name' => esc_html_x('Locations', 'post type name', 'trucknamerica'),
    'singular_name' => esc_html_x('Location', 'post type singular name', 'trucknamerica'),
    'menu_name' => esc_html_x('Locations', 'post type menu name', 'trucknamerica'),
    'add_new_item' => esc_html__('Add New Location', 'trucknamerica'),
    'search_items' => esc_html__('Search Locations', 'trucknamerica'),
    'edit_item' => esc_html__('Edit Location', 'trucknamerica'),
    'view_item' => esc_html__('View Location', 'trucknamerica'),
    'all_items' => esc_html__('All Locations', 'trucknamerica'),
    'new_item' => esc_html__('New Location', 'trucknamerica'),
    'not_found' => esc_html__('No Locations Found', 'trucknamerica')
  );

  $locations_args = array(
    'labels' => $locations_labels,
    'capability_type' => 'post',
    'public' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-location',
    'query_var' => 'locations',
    'has_archive' => false,
    'show_in_rest' => true,
    'supports' => array(
      'title',
      'editor',
      'custom-fields',
      'revisions'
    )
  );
  register_post_type('locations', $locations_args);

  register_taxonomy('states',
    'locations',
    array(
      'hierarchical' => true,
      'show_admin_column' => true,
      'public' => true,
      'show_in_rest' => true,
      'labels' => array(
        'name' => esc_html__('States', 'trucknamerica'),
        'singular_name' => esc_html__('State', 'trucknamerica'),
        'all_items' => esc_html__('All States', 'trucknamerica'),
        'edit_items' => esc_html__('Edit States', 'trucknamerica'),
        'view_item' => esc_html__('view State', 'trucknamerica'),
        'update_item' => esc_html__('Update State', 'trucknamerica'),
        'add_new_item' => esc_html__('Add New State', 'trucknamerica'),
        'parent_item' => esc_html__('Parent State', 'trucknamerica'),
        'search_items' => esc_html__('Search States', 'trucknamerica'),
        'popular_items' => esc_html__('Popular States', 'trucknamerica'),
        'add_or_remove_item' => esc_html__('Add or Remove State', 'trucknamerica'),
        'not_found' => esc_html__('No States Found', 'trucknamerica'),
        'back_to_items' => esc_html__('Back to States', 'trucknamerica')
      )
    )
  );
}