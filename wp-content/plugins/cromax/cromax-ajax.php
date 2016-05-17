<?php
/**
 * Cromax Ajax Handlers
 *
 * Handles AJAX requests via wp_ajax hook (both admin and front-end events)
 *
 * @author 		Cromax
 * @category 	Core
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Add a new section to the pagebuilder
 *
 * @access public
 * @return void
 */
function cromax_new_section() {


	 if (!wp_verify_nonce($_POST['nonce'], 'cromax_pagebuilder'))
    exit();


	ob_start();
		include('templates/pagebuilder/crx-newsection.php');
	echo ob_get_clean();

	die();
}

add_action( 'wp_ajax_cromax_new_section', 'cromax_new_section' );




/**
 * Add a new shortcode handler
 *
 * @access public
 * @return void
 */
function cromax_new_shortcode_handler() {

	 if (!wp_verify_nonce($_POST['nonce'], 'cromax_pagebuilder'))
    exit();

	$type 		= (isset($_POST['type_of']))?  $_POST['type_of'] :  '';
	$parent 	= (isset($_POST['codetype']))?  $_POST['codetype'] :  '';

	ob_start();
		include('templates/pagebuilder/crx-shortcode-handler.php');
	echo ob_get_clean();

	die();
}

add_action( 'wp_ajax_cromax_new_shortcode_handler', 'cromax_new_shortcode_handler' );





