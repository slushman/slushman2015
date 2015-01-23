<?php
/**
 * Replace With Theme Name Theme Customizer
 *
 * @package DocBlock
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 *
 * @uses 	get_setting()
 */
function function_names_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

} // function_names_customize_register()
add_action( 'customize_register', 'function_names_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @uses 	wp_enqueue_script()
 * @uses 	get_template_directory_uri()
 */
function function_names_customize_preview_js() {

	wp_enqueue_script( 'function_names_customizer', get_template_directory_uri() . '/js/customizer.min.js', array( 'customize-preview' ), '20130508', true );

} // function_names_customize_preview_js()
add_action( 'customize_preview_init', 'function_names_customize_preview_js' );
