<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Slushman 2015
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 *
 * @uses 	add_theme_support()
 */
function slushman_2015_jetpack_setup() {

	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'footer'    => 'page',
	) );

} // slushman_2015_jetpack_setup()
add_action( 'after_setup_theme', 'slushman_2015_jetpack_setup' );
