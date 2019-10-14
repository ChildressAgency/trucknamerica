<?php
/**
 * Widget to show Brands navigation on the shop sidebar
 */

if(!defined('ABSPATH')){ exit; }

class Trucknamerica_Brands_widget extends WP_Widget{
  public function __construct(){
    parent::__construct(
      'trucknamerica_brands_widget', 
      esc_html__('Brands Widget', 'trucknamerica'), 
      array('description' => esc_html__('Displays product Brands.', 'trucknamerica'))
    );
  }

  public function widget($args, $instance){
    $title = apply_filters('widget_title', $instance['title']);

    echo $args['before_widget'];
    if(!empty($title)){
      echo $args['before_title'] . $title . $args['after_title'];
    }

    $brands = get_terms(array(
      'taxonomy' => 'brands', 
      'orderby' => 'term_group', 
      'parent' => 0, 
      'hide_empty' => false
    ));

    if($brands){
      echo '<ul>';
      foreach($brands as $brand){
        echo '<li><a href="' . esc_html(get_term_link($brand)) . '">' . esc_html($brand->name) . ' (' . $brand->count . ')' . '</a></li>';
      }

      echo '</ul>';
    }

    echo $args['after_widget']; 
  }

  public function form($instance){
    if(isset($instance['title'])){
      $title = $instance['title'];
    }
    else{
      $title = esc_html__('New Title', 'trucknamerica');
    }

    echo '<p><label for="' . esc_attr($this->get_field_id('title')) . '">' . esc_html('Title:', 'trucknamerica') . '</label>';
    echo '<input class="" id="' . esc_attr($this->get_field_id('title')) . '" name="' . esc_attr($this->get_field_name('title')) . '" type="text" value="' . esc_attr($title) . '" /></p>';
  }

  public function update($new_instance, $old_instance){
    $instance = array();
    $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
    
    return $instance;
  }
}