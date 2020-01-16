<?php

/* Get Elementor Templates */
function opstore_lite_get_elementor_templates( $type = '' ) {
  $args = [
      'post_type'         => 'elementor_library',
      'posts_per_page'    => -1,
  ];
  
  if ( $type ) {
      $args['tax_query'] = [
          [
              'taxonomy' => 'elementor_library_type',
              'field'    => 'slug',
              'terms' => $type,
          ]
      ];
  }
  
  $page_templates = get_posts( $args );

  $options = array();
  if ( ! empty( $page_templates ) && ! is_wp_error( $page_templates ) ){
      foreach ( $page_templates as $post ) {
          $options[ $post->ID ] = $post->post_title;
      }
  }
  return $options;
}


/**
* sanitize select
*
*/
function opstore_lite_sanitize_select( $input, $setting ) {
  // Ensure input is a slug.
  $input = sanitize_key( $input );
  
  // Get list of choices from the control associated with the setting.
  $choices = $setting->manager->get_control( $setting->id )->choices;
  
  // If the input is a valid key, return it; otherwise, return the default.
  return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}