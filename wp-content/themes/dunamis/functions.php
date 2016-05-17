<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php
/**
 * Croma functions and definitions
 *
 *
 * @package Croma.framework
 * @subpackage Croma.framework
 * @since 1.0
 */



/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ){
	$content_width = 990;
}
	

/**
 * Sets up theme defaults and registers the various WordPress features
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since 1.0
 */
function cro_setup() {


	// get the main funcitons file linked
	require( get_template_directory() . '/inc/cromatheme.php' );


	/*
	 * Makes available for translation.
	 */
	load_theme_textdomain( 'croma', get_template_directory_uri() . '/languages' );



	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();



	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );


	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'assets/styles/editor-style.css', get_template_directory_uri() ) );



	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'quote', 'audio', 'video'));


	$cust_args = array(
		'width'         => 2000,
		'height'        => 480
	);
	add_theme_support( 'custom-header', $cust_args );



	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'croma-primarynav', __( 'Primary Menu', 'croma' ) );
	register_nav_menu( 'croma-topbarnav', __( 'Colored Button', 'croma' ) );
	register_nav_menu( 'croma-subnav', __( 'Next to logo', 'croma' ) );

	
	// add theme support for woocommerce
	add_theme_support( 'woocommerce' );

	/*
	 * This theme supports custom background color and image
	 */
	add_theme_support( 'custom-background');



	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );



	// different images sizes used in the theme

	add_image_size( 'cro_quarter', 250, 170, true);
	add_image_size( 'cro_third', 350, 200, true);
	add_image_size( 'cro_img_half', 610, 300, true);
	add_image_size( 'cro_landscape', 250, 350, true);
	add_image_size( 'cro_img_ban', 300, 300, true);
}
add_action( 'after_setup_theme', 'cro_setup' );




/**
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since 1.0
 */
function croma_page_menu_args( $args ) {
	if ( ! isset( $args['show_home'] ) )
		$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'croma_page_menu_args' );





/**
 * Create a nicely formatted and more specific title element text for output
 *
 * @since 1.0
 */
function croma_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'croma' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'croma_wp_title', 10, 2 );

