<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Cromatic megamenu functions
 *
 *
 * @package Cromatic
 * @subpackage Cromatic
 * @since 1.0
 */



include( 'croma_megamenu.php' );
include( 'cromatic-mm-layouts.php' );
include('cromatic-mm-formpart.php');
include('croma_menuwalkers.php');


/**
 * Add the help pages 
 *
 * @version	1.0
 * @since 1.0
 * @package	Cromatic
 * @author Croma
 */

function cromatic_admin_megamenu() {



	// add the croma frontpage builder page
	$cromatic_menupart 	= add_submenu_page(
		'cromatic',
		__('Mega menu', 'croma'), 
		__('Mega menu', 'croma'), 
		'manage_options',
		'cromatic_megamen', 
		'cromatic_megamenu'
	);

	// add the "action" part of the page options
	add_action( "load-{$cromatic_menupart}", 'cromatic_mm_s_page' );


	// load the scripts for the pagebuilder
	add_action( 'admin_print_scripts-' .$cromatic_menupart , 'cromatic_mm_enqueue_scripts' );	
	add_action( 'admin_print_styles-' . $cromatic_menupart , 'cromatic_mm_enqueue_styles' );	



}
add_action('admin_menu', 'cromatic_admin_megamenu', 10);






/**
 * Main Admin Page
 *
 * @access public
 * @return void
 */

function cromatic_megamenu() {	

	// selector to eigher show the pagemaker template or the pagemanager template
	if (isset($_GET['id']) && $_GET['id'] != '') {
		include('templates/pagemanager.php');
	} else {
		include('templates/pagemaker.php');
	}

}




/**
 * Main Save Action
 *
 * @access public
 * @return void
 */
function cromatic_mm_s_page() {


	// if you are deleting a page
	if (isset($_GET['delete']) && isset($_GET['id']) && $_GET['delete'] == 1 && $_GET['id'] >= 1 ){

		// delete the page
		wp_delete_post( esc_attr($_GET['id']) , true );
		wp_redirect('admin.php?page=cromatic_megamen&updated=1');



	// if you need ot create a new section
	} elseif (isset($_GET['leftside']) && isset($_GET['rightside']) && isset($_GET['title']) && !isset($_GET['id'])){


		// actions to create a new section
		$iid = cromatic_make_mm_pagepost( esc_attr( $_GET['leftside']), esc_attr( $_GET['rightside']), esc_attr( $_GET['title']));
		wp_redirect('admin.php?page=cromatic_megamen&id=' . $iid);



	// manage the components of the page manager
	} elseif (isset($_POST['cromatic_type_left']) && isset($_POST['cromatic_type_right']) && isset($_POST['cromatic_id']) && isset($_POST['crosubmit']) && $_POST['crosubmit'] == 'Y') {

		// fetch the pagebuilder layouts
		$p_array = cromatic_mm_layouts();

		$ct1 	= $p_array[$_POST['cromatic_type_left']];
		$ct2 	= $p_array[$_POST['cromatic_type_right']];



		// run throuhg the layouts and update the meta_boxes
		foreach ($ct1['content'] as $v) {
			$ab = $v['fn'] .  '-1';
			if (isset($_POST[$ab])){
				update_post_meta( $_POST['cromatic_id'], $ab, esc_attr($_POST[$ab]));
			}
		}

		// run throuhg the layouts and update the meta_boxes
		foreach ($ct2['content'] as $v) {
			$ab = $v['fn'] .  '-2';
			if (isset($_POST[$ab])){
				update_post_meta( $_POST['cromatic_id'], $ab, esc_attr($_POST[$ab]));
			}
		}


		// set up the proper redirects
		if(isset($_POST['cromatic_target']) && $_POST['cromatic_target'] == '2') {
			wp_redirect('admin.php?page=cromatic_megamen&updated=2&id=' . esc_attr( $_POST['cromatic_id'] ) );
		} else {
			wp_redirect('admin.php?page=cromatic_megamen&updated=2');
		}
	}
}






/**
 * Enqueue Javascript
 *
 * @access public
 * @return void
 */
function cromatic_mm_enqueue_scripts() {

	// register the scripts and add the media files
	wp_enqueue_media();
	wp_register_script( 'cromatic_mm_script', get_template_directory_uri() .'/inc/megamenu/assets/scripts/admin-app.js', array('jquery', 'jquery-ui-draggable','jquery-ui-droppable','wp-color-picker') );


	// enqueue the registered script
	wp_enqueue_script( 'cromatic_mm_script');


}




/**
 * Enqueue stylesheet 
 *
 * @access public
 * @return void
 */


function cromatic_mm_enqueue_styles() {

	wp_enqueue_style( 'wp-color-picker' );
	// enqueue the stylesheets
	wp_enqueue_style( 'cromaclass-admin-styles', get_template_directory_uri() .'/inc/megamenu/assets/styles/cromatic.css', false, '2014-01-01' );
}






/**
 * Make a custom navigation list
 *
 * @access public
 * @return void
 */


function croma_make_navlisting($id, $meta) {

	$mennum = get_post_meta( $id, $meta, true );
	$op = '<ul class="cro_mm_nav">';


	if ($mennum != '') {

		$items = wp_get_nav_menu_items( $mennum);

		foreach ( (array) $items as $key => $menu_item ) {
	    	$op .= '<li><a href="' . $menu_item->url . '">' . $menu_item->title . '</a></li>';
		}

	} else {

		return;

	}


	$op .= '</ul>';


	return $op;

}



