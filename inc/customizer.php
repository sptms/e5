<?php
/**
 * e4 Theme Customizer
 *
 * @package e4
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function e4_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	
	$wp_customize->add_setting( 'e4_logo' ); // Add setting for logo uploader
         
    // Add control for logo uploader (actual uploader)
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'e4_logo', array(
        'label'    => __( 'Upload Logo (replaces text)', 'e4' ),
        'section'  => 'title_tagline',
        'settings' => 'e4_logo',
    ) ) );
}
add_action( 'customize_register', 'e4_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function e4_customize_preview_js() {
	wp_enqueue_script( 'e4_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'e4_customize_preview_js' );
