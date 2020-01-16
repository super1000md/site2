<?php

function opstore_lite_customize_register( $wp_customize ) {

    /* Header Layouts*/
    $wp_customize->get_control('opstore_header_layouts')->choices=array( 
                'style1'    => OPSTORE_IMAGES.'header2.png',
                'Style2'    => OPSTORE_IMAGES.'header1.png',
                'custom'    => get_stylesheet_directory_uri().'/assets/images/custom-header.png',
                );
    //Custom header
    $wp_customize->add_setting('opstore_custom_header',array(
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'opstore_lite_sanitize_select',
         'transport' => 'refresh',
         )
    );
    $wp_customize->add_control( 'opstore_custom_header',
         array(
             'label'  => esc_html__( 'Custom Header', 'opstore-lite' ),
             'section' => 'opstore_header_layouts_section',
             'type' => 'select',
             'choices' => opstore_lite_get_elementor_templates(),
             'priority' => 3,
             'active_callback' => 'opstore_header_layouts_cb' 
         )
    );

    //Footer Layouts
    $wp_customize->add_setting( 'opstore_footer_layout_seperator', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Opstore_Customize_Seperator_Control( $wp_customize, 'opstore_footer_layout_seperator',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Footer Layouts', 'opstore-lite' ),
      'section'   => 'opstore_footer_section',
      'priority' => 1
    ) ) );

    $wp_customize->add_setting('opstore_footer_layout',array(
    	'default' => 'default',
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'opstore_lite_sanitize_select',
         'transport' => 'refresh',
         )
    );
    $wp_customize->add_control( 'opstore_footer_layout',
         array(
             'label'  => esc_html__( 'Footer Layout', 'opstore-lite' ),
             'section' => 'opstore_footer_section',
             'type' => 'select',
             'choices' => array(
             	'default' => __('Default','opstore-lite'),
             	'custom' => __('Custom','opstore-lite')
             ),
             'priority' => 3,
         )
    );
    $wp_customize->add_setting('opstore_custom_footer',array(
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'opstore_lite_sanitize_select',
         'transport' => 'refresh',
         )
    );
    $wp_customize->add_control( 'opstore_custom_footer',
         array(
             'label'  => esc_html__( 'Custom Footer', 'opstore-lite' ),
             'section' => 'opstore_footer_section',
             'type' => 'select',
             'choices' => opstore_lite_get_elementor_templates(),
             'priority' => 4,
             'active_callback' => 'opstore_footer_layouts_cb' 
         )
    );


    /* before shop */
    $wp_customize->add_setting( 'opstore_woo_seperator_archive', array(
      'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( new Opstore_Customize_Seperator_Control( $wp_customize, 'opstore_woo_seperator_archive',  array(
      'type'      => 'text',                    
      'label'     => esc_html__( 'Product Archive', 'opstore-lite' ),
      'section'   => 'opstore_woo_section',
    ) ) );  

    $wp_customize->add_setting('opstore_before_shop',array(
         'capability' => 'edit_theme_options',
         'sanitize_callback' => 'opstore_lite_sanitize_select',
         'transport' => 'refresh',
         )
    );
    $wp_customize->add_control( 'opstore_before_shop',
         array(
             'label'  => esc_html__( 'Before Shop Page', 'opstore-lite' ),
             'description'  => esc_html__( 'The template made from elementor will be shown before shop page items.', 'opstore-lite' ),
             'section' => 'opstore_woo_section',
             'type' => 'select',
             'choices' => opstore_lite_get_elementor_templates() 
         )
    );

} 
add_action( 'customize_register', 'opstore_lite_customize_register',999 );   

/* Active Callback Functions */
function opstore_header_layouts_cb(){
    $header_layout = get_theme_mod('opstore_header_layouts');
    if($header_layout == 'custom'){
        return true;
    }
    return false;
}

function opstore_footer_layouts_cb(){
    $header_layout = get_theme_mod('opstore_footer_layout');
    if($header_layout == 'custom'){
        return true;
    }
    return false;
}