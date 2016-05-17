<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Cromatic admin functions
 *
 *
 * @package Cromatic
 * @subpackage Cromatic
 * @since 1.0
 */



/**
 * Add all the help pages 
 *
 * @version	1.0
 * @since 1.0
 * @package	Cromatic
 * @author Croma
 */

function cromatic_admin_menu() {


	// add the croma main theme options handle
	$cromatic_page 	= add_menu_page(
		__('Pagebuilder', 'croma'), 
		__('croma.dash', 'croma'), 
		'manage_options',
		'cromatic', 
		'cromatic_pages', 
		get_template_directory_uri() .'/inc/admin/assets/styles/images/ticon.png',
		3
	);

	// add the croma frontpage builder page
	$cromatic_pager 	= add_submenu_page(
		'cromatic',
		__('Front page', 'croma'), 
		__('Front page', 'croma'), 
		'manage_options',
		'cromatic', 
		'cromatic_pages'
	);


	// add the croma sidebar builder page
	$cromatic_sidebar 	= add_submenu_page(
		'cromatic',
		__('Sidebars', 'croma'), 
		__('Sidebars', 'croma'), 
		'manage_options',
		'cromatic_sbar', 
		'cromatic_sidebar_pages'
	);


	// add the croma theme options page
	$cromatic_options 	= add_submenu_page(
		'cromatic',
		__('Theme options', 'croma'), 
		__('Theme options', 'croma'), 
		'manage_options',
		'cromatic_options', 
		'cromatic_options_pages'
	);


	// add the includes ot render the pages
	include('cromatic-admin-layouts.php');
	include('cromatic-page-formpart.php');
	include('croma-headers.php');


	// add the "action" part of the page options
	add_action( "load-{$cromatic_pager}", 'cromatic_s_page' );
	add_action( "load-{$cromatic_sidebar}", 'cromatic_sidebar_s_page' );
	add_action( "load-{$cromatic_options}", 'cromatic_options_s_page' );



	// load the scripts for the pagebuilder
	add_action( 'admin_print_scripts-' . $cromatic_pager , 'cromatic_enqueue_scripts' );	
	add_action( 'admin_print_styles-' . $cromatic_page , 'cromatic_enqueue_styles' );	



	// load the scripts for the sidebar builder
	add_action( 'admin_print_scripts-' . $cromatic_sidebar , 'cromatic_enqueue_scripts' );	
	add_action( 'admin_print_styles-' . $cromatic_sidebar , 'cromatic_enqueue_styles' );	



	// load the scripts for the theme options
	add_action( 'admin_print_scripts-' . $cromatic_options , 'cromatic_enqueue_scripts' );	
	add_action( 'admin_print_styles-' . $cromatic_options , 'cromatic_enqueue_styles' );	

}
add_action('admin_menu', 'cromatic_admin_menu', 9);





/**
 * Main Admin Page
 *
 * @access public
 * @return void
 */

function cromatic_pages() {	

	// selector to eigher show the pagemaker template or the pagemanager template
	if (isset($_GET['action']) && $_GET['action'] != '') {
		include('templates/pagemanager.php');
	} else {
		include('templates/pagemaker.php');
	}


}




/**
 * Sidebar management page
 *
 * @access public
 * @return void
 */

function cromatic_sidebar_pages() {	
	// include the sidebar manager page
	include('templates/sidebars.php');
}





/**
 * Theme options pages
 *
 * @access public
 * @return void
 */

function cromatic_options_pages() {	
	// include the them options page
	include('templates/options.php');
}





/**
 * Main Save Action
 *
 * @access public
 * @return void
 */
function cromatic_s_page() {


	// if you are deleting a page
	if (isset($_GET['delete']) && isset($_GET['id']) && $_GET['delete'] == 1 && $_GET['id'] >= 1 ){

		// delete the page
		wp_delete_post( esc_attr($_GET['id']) , true );
		wp_redirect('admin.php?page=cromatic&updated=1');



	// if you need ot create a new section
	} elseif (isset($_GET['action']) && !isset($_GET['id'])){


		// actions to create a new section
		$iid = cromatic_make_pagepost( esc_attr( $_GET['action']) );
		wp_redirect('admin.php?page=cromatic&action=' . esc_attr( $_GET['action']) . '&id=' . $iid);



	// manage the components of the page manager
	} elseif (isset($_POST['cromatic_type']) && isset($_POST['cromatic_id']) && isset($_POST['crosubmit']) && $_POST['crosubmit'] == 'Y') {

		// fetch the pagebuilder layouts
		$p_array = cromatic_pbuilder_layouts();

		// run throuhg the layouts and update the meta_boxes
		foreach ($p_array[$_POST['cromatic_type']]['content'] as $v) {
			$ab = $v['fn'];
			if (isset($_POST[$ab])){
				update_post_meta( $_POST['cromatic_id'], esc_attr($v['fn']), esc_attr($_POST[$ab]));
			}
		}


		// set up the proper redirects
		if(isset($_POST['cromatic_target']) && $_POST['cromatic_target'] == '2') {
			wp_redirect('admin.php?page=cromatic&updated=2&id=' . esc_attr( $_POST['cromatic_id'] ) . '&action=' . esc_attr( $_POST['cromatic_type'] ));
		} else {
			wp_redirect('admin.php?page=cromatic&updated=2');
		}
	}
}







/**
 * Sidebar Save Action
 *
 * @access public
 * @return void
 */
function cromatic_sidebar_s_page() {


	// the delete functions for the sidebar page
	if (isset($_GET['delete']) && isset($_GET['id']) && $_GET['delete'] == 1 && $_GET['id'] != '' ){


		// get the array with the current active sidebars
		$startarray = get_option('cromatic_sidebars');
		$returnarray = array();


		// run the funciton to set up the new arrays
		if (!empty($startarray)) {
			foreach ($startarray as $v) {
				if ($v != urldecode ( esc_attr( $_GET['id'] ) )) {
					$returnarray[] = $v;
				}
			}

			// update the option
			update_option( 'cromatic_sidebars', $returnarray );


			// do a redirect
			wp_redirect(admin_url('admin.php?page=cromatic_sbar&updated=2'));

		}




	// thesave functions for the sidebar page

	} elseif (isset($_POST['cro_sbar_submit']) && $_POST['cro_sbar_submit'] == 'Y') {


		
		// run the funciton to set up the new arrays
		if (isset($_POST['cro_sbarname']) && $_POST['cro_sbarname'] != ''){

			$returnarray = get_option('cromatic_sidebars');
			$returnarray[] = esc_attr($_POST['cro_sbarname']);
			update_option( 'cromatic_sidebars', $returnarray );

		}

		// do a redirect
		wp_redirect(admin_url('admin.php?page=cromatic_sbar&updated=1'));

	}

}






/**
 * Options Save Action
 *
 * @access public
 * @return void
 */
function cromatic_options_s_page() {



	// theme options save action
	if (isset($_POST['cro_opt_submit']) && $_POST['cro_opt_submit'] == 'Y'){


		// set up the new postarray
		$postarray = array();

		// run through the options and set up the new array.
		foreach(cromatic_theme_options() as $v) {
			foreach ($v['content'] as $va) {
				if (isset($_POST[$va['fn']]) && $_POST[$va['fn']] != '') {
					$postarray[$va['fn']] = stripslashes($_POST[$va['fn']]) ;
				} else {
					$postarray[$va['fn']] = '';
				}
			}
		}


		// update the theme options
		update_option( 'cromatic', $postarray );

		// do a redirect
		wp_redirect('admin.php?page=cromatic_options&updated=1');


	}
}





/**
 * Enqueue Javascript
 *
 * @access public
 * @return void
 */
function cromatic_enqueue_scripts() {

	// register the scripts and add the media files
	wp_enqueue_media();
	wp_register_script( 'cromatic_admin_script', get_template_directory_uri() .'/inc/admin/assets/scripts/admin-app.js', array('jquery', 'wp-color-picker') );

	// run the localization script
	wp_localize_script( 'cromatic_admin_script', 'cromatic_admin_script',
            array(
                'title'     => __( 'Upload or Choose Your Custom Image File', 'croma' ), // This will be used as the default title
                'button'    => __( 'Insert Image into Input Field', 'croma' ),            // This will be used as the default button text
                'nonce'    	=>  wp_create_nonce( 'croma_themeadmin')
            )
        );

	// enqueue the registered script
	wp_enqueue_script( 'cromatic_admin_script');


}




/**
 * Enqueue stylesheet 
 *
 * @access public
 * @return void
 */


function cromatic_enqueue_styles() {

	// enqueue the stylesheets
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_style( 'cromaclass-admin-styles', get_template_directory_uri() .'/inc/admin/assets/styles/cromatic.css', false, '2014-01-01' );
}





