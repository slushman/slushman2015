<?php
/**
 * Slushman 2015 functions and definitions
 *
 * @package Slushman 2015
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'slushman_2015_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function slushman_2015_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on _s, use a find and replace
	 * to change 'slushman2015' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'slushman2015', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'slushman2015' ),
		'social' => __( 'Social Links', 'slushman2015' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	/*add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );*/

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'slushman_2015_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

} // slushman_2015_setup()
endif; // slushman_2015_setup
add_action( 'after_setup_theme', 'slushman_2015_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function slushman_2015_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Sidebar', 'slushman2015' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

} // slushman_2015_widgets_init()
add_action( 'widgets_init', 'slushman_2015_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function slushman_2015_scripts() {

	wp_enqueue_style( 'slushman2015-style', get_stylesheet_uri() );

	wp_enqueue_script( 'slushman2015-navigation', get_template_directory_uri() . '/js/navigation.min.js', array(), '20120206', true );

	wp_enqueue_script( 'slushman2015-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.min.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

} // slushman_2015_scripts()
add_action( 'wp_enqueue_scripts', 'slushman_2015_scripts' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';



/**
 * Customize footer
 */
function custom_footer_left() {

	//

} // custom_footer_left()
add_action( 'footer_left', 'custom_footer_left' );

function custom_site_info() {

	printf( __( '<div class="copyright">All content &copy %1$s <a href="%2$s" title="Login">%3$s</a></a></div>', 'slushman2015' ), date( 'Y' ), get_admin_url(), get_bloginfo( 'name' ) );

} // custom_site_info()
add_action( 'site_info', 'custom_site_info' );

function custom_footer_right() {

	//

} // custom_footer_right()
add_action( 'footer_right', 'custom_footer_right' );


/**
 * Load Fonts
 */
function load_fonts() {

	//wp_register_style( 'et-googleFonts', 'http://fonts.googleapis.com/css?family=Cabin:400,500,600,700' );
	//wp_enqueue_style( 'et-googleFonts' );

} // load_fonts()
add_action( 'wp_print_styles', 'load_fonts' );



/**
 * Prints whatever in a nice, readable format
 */
function pretty( $input ) {

	echo '<pre>'; print_r( $input ); echo '</pre>';

} // pretty()


/**
 * Add Down Caret to Menus with Children
 *
 * @param 	string 		$item_output		//
 * @param 	object 		$item				//
 * @param 	int 		$depth 				//
 * @param 	array 		$args 				//
 *
 * @return 	string 							modified menu
 */
function slushman_2015_menu_caret( $item_output, $item, $depth, $args ) {

	if ( ! in_array( 'menu-item-has-children', $item->classes ) ) { return $item_output; }

	$output = '<a href="' . $item->url . '">';
	$output .= $item->title;
	$output .= '<span class="children">' . get_svg( 'caret-down' ) . '</span>';
	$output .= '</a>';

	return $output;

} // slushman_2015_menu_caret()
add_filter( 'walker_nav_menu_start_el', 'slushman_2015_menu_caret', 10, 4 );



/**
 * Change Social Menu to Icons Only
 *
 * @link 	http://www.billerickson.net/customizing-wordpress-menus/
 *
 * @param 	string 		$item_output		//
 * @param 	object 		$item				//
 * @param 	int 		$depth 				//
 * @param 	array 		$args 				//
 *
 * @return 	string 							modified menu
 */
function slushman_2015_social_menu_svgs( $item_output, $item, $depth, $args ) {

	if ( 'social' !== $args->theme_location ) { return $item_output; }

	$host 	= parse_url( $item->url, PHP_URL_HOST );
	$output = '<a href="' . $item->url . '" class="icon-menu">';
	$class 	= slushman_2015_get_svg_by_class( $item->classes );

	if ( ! empty( $class ) ) {

		$output .= $class;

	} else {

		$output .= slushman_2015_get_svg_by_url( $item->url );

	} // class check

	$output .= '</a>';

	return $output;

} // slushman_2015_social_menu_svgs()
add_filter( 'walker_nav_menu_start_el', 'slushman_2015_social_menu_svgs', 10, 4 );


/**
 * Gets the appropriate SVG based on a menu item class
 *
 * @param  [type] $url [description]
 * @return [type]      [description]
 */
function slushman_2015_get_svg_by_class( $classes ) {

	$output = '';

	foreach ( $classes as $class ) {

		$check = slushman_2015_get_svg( $class );

		if ( ! is_null( $check ) ) { $output .= $check; break; }

	} // foreach

	return $output;

} // slushman_2015_get_svg_by_class()

/**
 * Gets the appropriate SVG based on a URL
 *
 * @param  [type] $url [description]
 * @return [type]      [description]
 */
/*function slushman_2015_get_svg_by_pageID( $ID ) {

	$output = '';
	$page 	= get_post( $ID );

	switch( $page->post_title ) {

		case 'Calendar' 			: $output .= slushman_2015_get_svg( 'calendar' ); break;
		case 'Camping' 				: $output .= slushman_2015_get_svg( 'camping' ); break;
		case 'Events & Festivals' 	: $output .= slushman_2015_get_svg( 'calendar' ); break;
		case 'Hotels' 				: $output .= slushman_2015_get_svg( 'hotel' ); break;
		case 'Motels' 				: $output .= slushman_2015_get_svg( 'hotel' ); break;
		case 'Travel Guides' 		: $output .= slushman_2015_get_svg( 'map-location' ); break;

	} // switch

	return $output;

} // slushman_2015_get_svg_by_pageID()*/

/**
 * Gets the appropriate SVG based on a URL
 *
 * @param  [type] $url [description]
 * @return [type]      [description]
 */
function slushman_2015_get_svg_by_url( $url ) {

	$output = '';
	$host 	= parse_url( $url, PHP_URL_HOST );

	switch( $host ) {

		case 'facebook.com' 	: $output .= slushman_2015_get_svg( 'facebook' ); break;
		case 'instagram.com' 	: $output .= slushman_2015_get_svg( 'instagram' ); break;
		case 'linked.com' 		: $output .= slushman_2015_get_svg( 'linkedin' ); break;
		case 'pinterest.com' 	: $output .= slushman_2015_get_svg( 'pinterest' ); break;
		case 'twitter.com' 		: $output .= slushman_2015_get_svg( 'twitter' ); break;
		case 'youtube.com' 		: $output .= slushman_2015_get_svg( 'youtube' ); break;

	} // switch

	return $output;

} // slushman_2015_get_svg_by_url()

/**
 * Returns the requested SVG
 *
 * @param 	string 		$icon 		The name of the icon to return
 *
 * @return 	mixed 					The SVG code
 */
function slushman_2015_get_svg( $svg ) {

	$output = '';

	switch ( $svg ) {

		case 'caret-down' 	: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="caret-down" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M96.8 37.7L54.3 80.2C53.1 81.4 51.6 82 50 82c-1.6 0-3.1-0.7-4.3-1.8L3.2 37.7c-1.1-1.1-1.8-2.7-1.8-4.3 0-3.3 2.8-6.1 6.1-6.1h85c3.3 0 6.1 2.8 6.1 6.1C98.6 35.1 97.9 36.6 96.8 37.7z"/></svg>'; break;
		case 'caret-right' 	: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="caret-right" viewBox="0 0 100 100" enable-background="new 0 0 100 100" ><path d="M69.8 53.4L32.3 90.9c-1 1-2.3 1.6-3.8 1.6 -2.9 0-5.4-2.4-5.4-5.4v-75c0-2.9 2.4-5.4 5.4-5.4 1.4 0 2.8 0.6 3.8 1.6l37.5 37.5c1 1 1.6 2.3 1.6 3.8S70.8 52.4 69.8 53.4z"/></svg>'; break;
		case 'facebook'		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="facebook" viewBox="0 0 113 113" enable-background="new 0 0 113 113"><path d="M82.2 21.1H72.1c-7.9 0-9.4 3.8-9.4 9.2v12.1h18.8l-2.5 19H62.8v48.7H43.1V61.5H26.8v-19h16.4v-14c0-16.2 9.9-25.1 24.5-25.1 6.9 0 12.9 0.5 14.6 0.8V21.1z"/></svg>'; break;
		case 'flickr' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" class="flickr"><path d="M97.6 20.2v59.5c0 9.8-8 17.8-17.8 17.8H20.3c-9.8 0-17.8-8-17.8-17.8V20.2c0-9.8 8-17.8 17.8-17.8h59.5C89.6 2.3 97.6 10.3 97.6 20.2zM32.5 36.8c-7.2 0-13.1 5.9-13.1 13.1S25.3 63 32.5 63s13.1-5.9 13.1-13.1S39.8 36.8 32.5 36.8zM67.5 36.8c-7.2 0-13.1 5.9-13.1 13.1S60.2 63 67.5 63s13.1-5.9 13.1-13.1S74.7 36.8 67.5 36.8z"/></svg>'; break;
		case 'hamburger' 	: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" class="hamburger"><path d="M97.1 21.3c0 2.1-1.8 3.9-3.9 3.9H6.8c-2.1 0-3.9-1.8-3.9-3.9v-7.9c0-2.1 1.8-3.9 3.9-3.9h86.4c2.1 0 3.9 1.8 3.9 3.9V21.3zM97.1 52.8c0 2.1-1.8 3.9-3.9 3.9H6.8c-2.1 0-3.9-1.8-3.9-3.9v-7.9c0-2.1 1.8-3.9 3.9-3.9h86.4c2.1 0 3.9 1.8 3.9 3.9V52.8zM97.1 84.2c0 2.1-1.8 3.9-3.9 3.9H6.8c-2.1 0-3.9-1.8-3.9-3.9v-7.9c0-2.1 1.8-3.9 3.9-3.9h86.4c2.1 0 3.9 1.8 3.9 3.9V84.2z"/></svg>'; break;
		case 'instagram' 	: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="instagram" viewBox="226.8 316.8 612.7 612.7" enable-background="new 226.8 316.8 612.7 612.7"><path d="M533.2 316.8c-168.8 0-306.4 136.9-306.4 306.4 0 168.8 136.9 306.4 306.4 306.4 168.8 0 306.4-137.6 306.4-306.4S702.6 316.8 533.2 316.8zM533.2 901.1c-153.9 0-278-124.1-278-278s124.8-278 278-278c153.9 0 278 124.8 278 278C811.1 777 686.3 901.1 533.2 901.1zM422.3 474H644c21.1 0 38.3 15.6 38.3 38.3V734c0 22.7-17.1 38.3-38.3 38.3H422.3c-21.1 0-38.3-15.6-38.3-38.3V512.3C384 489.7 401.2 474 422.3 474L422.3 474zM601.4 507.1c-7.3 0-13.5 6.1-13.5 13.5v32.1c0 7.3 6.1 13.5 13.5 13.5h33.7c7.3 0 13.5-6.1 13.5-13.5v-32.1c0-7.3-6.1-13.5-13.5-13.5H601.4L601.4 507.1zM648.6 600.2h-26.3c2.4 8 4 16.8 4 25.7 0 49.6-41.6 89.7-92.8 89.7s-92.8-40.1-92.8-89.7c0-8.9 1.2-17.5 4-25.7h-27.3V726c0 6.4 5.2 11.9 11.9 11.9H637c6.4 0 11.9-5.2 11.9-11.9V600.2H648.6zM533.5 564.4c-33.1 0-60 26-60 58.2s26.9 58.2 60 58.2 60-26 60-58.2S566.5 564.4 533.5 564.4z"/></svg>'; break;
		case 'linkedin' 	: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="linkedin" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M14.2 25.9H14c-6.8 0-11.2-4.7-11.2-10.5 0-6 4.5-10.5 11.4-10.5 6.9 0 11.2 4.5 11.3 10.5C25.6 21.2 21.2 25.9 14.2 25.9zM24.3 95H4V34.2h20.3V95zM97.1 95H77V62.5c0-8.2-2.9-13.8-10.3-13.8 -5.6 0-8.9 3.7-10.4 7.4 -0.5 1.4-0.7 3.1-0.7 5V95H35.5c0.2-55.1 0-60.8 0-60.8h20.2V43h-0.1c2.6-4.2 7.4-10.3 18.4-10.3 13.3 0 23.3 8.7 23.3 27.4V95z"/></svg>'; break;
		case 'logo' 		: $output .= ''; break;
		case 'pinterest' 	: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="pinterest" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M50 97c-4.7 0-9.1-0.7-13.4-2 1.8-2.8 3.8-6.4 4.8-10.1 0 0 0.6-2.1 3.3-13 1.6 3.1 6.4 5.9 11.5 5.9 15.2 0 25.5-13.8 25.5-32.4 0-13.9-11.8-27-29.9-27 -22.3 0-33.6 16.1-33.6 29.5 0 8.1 3.1 15.3 9.6 18 1 0.4 2 0 2.3-1.2 0.2-0.8 0.7-2.9 1-3.7 0.3-1.2 0.2-1.6-0.7-2.6 -1.9-2.3-3.1-5.2-3.1-9.3 0-11.9 8.9-22.6 23.2-22.6 12.6 0 19.6 7.7 19.6 18.1 0 13.6-6 25-15 25 -4.9 0-8.6-4.1-7.4-9.1 1.4-6 4.2-12.4 4.2-16.7 0-3.9-2.1-7.1-6.4-7.1 -5 0-9.1 5.2-9.1 12.2 0 0 0 4.5 1.5 7.5 -5.2 21.9-6.1 25.7-6.1 25.7C31 85.7 31 89.7 31.1 93 14.5 85.7 2.9 69.2 2.9 49.8 2.9 23.8 24 2.7 50 2.7c26 0 47.1 21.1 47.1 47.1S76 97 50 97z"/></svg>'; break;
		case 'telephone' 	: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="telephone" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M95.1 86.5c-1.4 3.3-5.2 5.4-8.2 7.1 -4 2.1-8 3.4-12.5 3.4 -6.2 0-11.9-2.5-17.5-4.6 -4.1-1.5-8-3.3-11.7-5.6 -11.4-7-25.1-20.8-32.1-32.1C10.8 51 9 47 7.5 43c-2.1-5.7-4.6-11.3-4.6-17.5 0-4.5 1.3-8.5 3.4-12.5 1.7-3 3.8-6.8 7.1-8.2 2.2-1 6.9-2.1 9.3-2.1 0.5 0 0.9 0 1.4 0.2C25.5 3.4 27 6.7 27.6 8c2.1 3.8 4.2 7.7 6.4 11.5 1.1 1.7 3.1 3.9 3.1 6 0 4.1-12.1 10-12.1 13.7 0 1.8 1.7 4.2 2.6 5.8C34.4 57 42.8 65.5 55 72.2c1.6 0.9 4 2.6 5.8 2.6 3.6 0 9.6-12.1 13.7-12.1 2.1 0 4.2 2 6 3.1 3.8 2.2 7.6 4.3 11.5 6.4 1.3 0.7 4.6 2.1 5.1 3.5 0.2 0.5 0.2 0.9 0.2 1.4C97.2 79.6 96.1 84.3 95.1 86.5z"/></svg>'; break;
		case 'twitter' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="twitter" viewBox="0 0 113 113" enable-background="new 0 0 113 113"><path d="M101.2 33.6c0.1 1 0.1 2 0.1 3 0 30.5-23.2 65.6-65.6 65.6 -13.1 0-25.2-3.8-35.4-10.4 1.9 0.2 3.6 0.3 5.6 0.3 10.8 0 20.7-3.6 28.6-9.9 -10.1-0.2-18.6-6.9-21.6-16 1.4 0.2 2.9 0.4 4.4 0.4 2.1 0 4.1-0.3 6.1-0.8C12.7 63.7 4.8 54.4 4.8 43.2c0-0.1 0-0.2 0-0.3 3.1 1.7 6.6 2.8 10.4 2.9C9 41.7 4.9 34.6 4.9 26.6c0-4.3 1.1-8.2 3.1-11.6 11.4 14 28.4 23.1 47.6 24.1 -0.4-1.7-0.6-3.5-0.6-5.3 0-12.7 10.3-23.1 23.1-23.1 6.6 0 12.6 2.8 16.9 7.3 5.2-1 10.2-2.9 14.6-5.6 -1.7 5.4-5.4 9.9-10.1 12.7 4.6-0.5 9.1-1.8 13.3-3.6C109.6 26.2 105.7 30.3 101.2 33.6z"/></svg>'; break;
		case 'vimeo' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" viewBox="0 0 100 100" enable-background="new 0 0 100 100" xml:space="preserve" class="vimeo"><path d="M97.1 79.3c0 9.8-7.9 17.7-17.7 17.7H20.5c-9.8 0-17.7-7.9-17.7-17.7V20.4c0-9.8 7.9-17.7 17.7-17.7h58.9c9.8 0 17.7 7.9 17.7 17.7V79.3zM78.5 25.8c-2.5-3.2-7.8-3.3-11.5-2.8 -2.9 0.5-13 4.9-16.4 15.5 6-0.5 9.2 0.4 8.6 7.1 -0.2 2.8-1.7 5.8-3.2 8.8 -1.8 3.4-5.2 10-9.7 5.2 -4-4.3-3.7-12.5-4.6-18 -0.6-3.1-1.1-6.9-2.1-10.1 -0.9-2.7-2.9-6-5.3-6.7 -2.6-0.7-5.9 0.4-7.8 1.5 -6 3.6-10 8.6-15.9 12.8v0.4c2 1 1.4 2.6 2.9 2.8 3.6 0.5 7.1-3.4 9.5 0.7 1.5 2.5 1.9 5.2 2.8 7.8 1.3 3.6 2.2 7.4 3.3 11.5 1.7 6.9 3.8 17.2 9.8 19.8 3 1.3 7.6-0.4 9.9-1.8 6.3-3.7 11.2-9 15.3-14.5C73.8 52.9 79 38.2 79.8 33.9 80.4 31 80.3 28.1 78.5 25.8z"/></svg>'; break;
		case 'youtube' 		: $output .= '<svg xmlns="http://www.w3.org/2000/svg" version="1.1" x="0" y="0" xml:space="preserve" class="youtube" viewBox="0 0 100 100" enable-background="new 0 0 100 100"><path d="M89.5 90.4c-1 4.4-4.6 7.6-8.8 8 -10.2 1.2-20.4 1.2-30.7 1.2 -10.2 0-20.5 0-30.7-1.2 -4.3-0.4-7.8-3.6-8.8-8 -1.4-6.2-1.4-13-1.4-19.3 0-6.4 0.1-13.2 1.4-19.3 1-4.4 4.6-7.6 8.9-8.1 10.1-1.1 20.4-1.1 30.6-1.1 10.2 0 20.5 0 30.7 1.1 4.3 0.5 7.8 3.7 8.8 8.1 1.4 6.2 1.4 12.9 1.4 19.3C90.9 77.4 90.9 84.2 89.5 90.4zM32.4 57.3v-5.2H15.2v5.2H21v31.4h5.5V57.3H32.4zM41.4 0.5l-6.7 22v15h-5.5v-15c-0.5-2.7-1.6-6.6-3.4-11.7C24.6 7.4 23.4 4 22.3 0.5h5.9L32 15.1l3.8-14.5H41.4zM47.4 88.7V61.4h-4.9v20.9c-1.1 1.5-2.2 2.3-3.1 2.3 -0.7 0-1-0.4-1.2-1.2 -0.1-0.2-0.1-0.8-0.1-1.9V61.4h-4.9V83c0 1.9 0.2 3.2 0.4 4 0.4 1.4 1.6 2 3.2 2 1.8 0 3.6-1.1 5.6-3.4v3H47.4zM56.2 28.6c0 2.9-0.5 5.1-1.5 6.5 -1.4 1.9-3.3 2.8-5.9 2.8 -2.5 0-4.4-0.9-5.8-2.8 -1-1.4-1.5-3.6-1.5-6.5v-9.7c0-2.9 0.5-5.1 1.5-6.5 1.4-1.9 3.3-2.8 5.8-2.8 2.5 0 4.5 0.9 5.9 2.8 1 1.4 1.5 3.5 1.5 6.5V28.6zM51.2 17.9c0-2.5-0.7-3.8-2.4-3.8 -1.6 0-2.4 1.3-2.4 3.8v11.6c0 2.5 0.8 3.9 2.4 3.9 1.7 0 2.4-1.3 2.4-3.9V17.9zM66.1 69.7c0-2.5-0.1-4.4-0.5-5.5 -0.6-2-2-3.1-3.9-3.1 -1.8 0-3.5 1-5.1 3v-12h-4.9v36.6h4.9v-2.7c1.7 2 3.4 3 5.1 3 1.9 0 3.3-1 3.9-3 0.4-1.2 0.5-3 0.5-5.5V69.7zM61.2 80.9c0 2.5-0.7 3.7-2.2 3.7 -0.8 0-1.7-0.4-2.5-1.2V66.8c0.8-0.8 1.7-1.2 2.5-1.2 1.4 0 2.2 1.3 2.2 3.7V80.9zM74.8 37.6h-5v-3c-2 2.3-3.9 3.4-5.7 3.4 -1.6 0-2.8-0.7-3.3-2 -0.3-0.8-0.4-2.2-0.4-4.1V10h5v20.3c0 1.2 0 1.8 0.1 1.9 0.1 0.8 0.5 1.2 1.2 1.2 1 0 2-0.8 3.1-2.4V10h5V37.6zM84.8 79.3h-5c0 2-0.1 3.1-0.1 3.4 -0.3 1.3-1 2-2.2 2 -1.7 0-2.5-1.3-2.5-3.8V76h9.9v-5.7c0-2.9-0.5-5-1.5-6.4 -1.4-1.9-3.4-2.8-5.9-2.8 -2.5 0-4.5 0.9-5.9 2.8 -1 1.4-1.5 3.5-1.5 6.4v9.6c0 2.9 0.6 5.1 1.6 6.4 1.4 1.9 3.4 2.8 6 2.8 2.6 0 4.6-1 6-2.9 0.6-0.9 1-1.9 1.2-3 0.1-0.5 0.1-1.6 0.1-3.2V79.3zM79.9 71.9h-5v-2.5c0-2.5 0.8-3.8 2.5-3.8 1.7 0 2.5 1.3 2.5 3.8V71.9z"/></svg>'; break;

	} // switch

	return $output;

} // slushman_2015_get_svg()

/**
 * Returns the URL of the featured image
 *
 * @param 	int 		$postID 		The post ID
 * @param 	string 		$size 			The image size to return
 *
 * @return 	string | bool 				The URL of the featured image, otherwise FALSE
 */
function slushman_2015_get_thumbnail_url( $postID, $size = 'thumbnail' ) {

	if ( empty( $postID ) ) { return FALSE; }

	$thumb_id = get_post_thumbnail_id( $postID );

	if ( empty( $thumb_id ) ) { return FALSE; }

	$thumb_array = wp_get_attachment_image_src( $thumb_id, $size, true );

	if ( empty( $thumb_array ) ) { return FALSE; }

	return $thumb_array[0];

} // slushman_2015_get_thumbnail_url()

/**
 * Add Themes Options page, if using ACF
 */
if( function_exists('acf_add_options_page') ) {

	$args['page_title'] 	= 'Theme Options';
	$args['menu_title'] 	= 'Theme Options';
	$args['parent_slug'] 	= 'themes.php';
	$args['capabilities'] 	= 'edit_posts';

	acf_add_options_sub_page( $args );

}

