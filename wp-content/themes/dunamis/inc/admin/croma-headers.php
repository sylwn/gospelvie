<?php
// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;


/**
 *
 * cromax-foodmenu-ajax
 * 
 * @author  	AJ aj@cro.ma
 * @package 	Croma theme
 * @category 	Custom header
 * @copyright 	Copyright (c) 2014, Alwyn Kotze & Croma
 * @version 	1.0
 * @since 		1.0
 * @uses 		Set a custom header for pages
 */





/**
 * FUNCTION : croma_header_add_box 
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		Create the header metabox
 */


add_action( 'add_meta_boxes', 'croma_header_add_box' );
function croma_header_add_box() {	


	$screens = array( 'post', 'page', 'calendar' );


	foreach ($screens as $screen) {

		// add the metabox
		add_meta_box( 
			'header_metabox', 
			__('Custom Headers','croma'), 
			'croma_custhead_form', 
			$screen, 
			'side',
			'high', 
			''
		);

	}

}






/**
 * FUNCTION : cromax_headerimage_meta_scripts  -
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		add the css and javascript for the header images box
 */

function cromax_headerimage_meta_scripts( ) {



    // get the post base of the page and the plugin url
	$postbase 		= get_current_screen();
    $purl 			= untrailingslashit( plugins_url( '/', __FILE__ ) );
    $add_to         = array('post','page','calendar');

    // if it is a headerimage page add the javascripts
    if ( $postbase->base == 'post' && in_array($postbase->post_type, $add_to) ) {

    	// enqueue the styles for the headerimagebox creator
    	wp_enqueue_style( 'wp-color-picker' );
    	wp_enqueue_style('cromax-pageheader-box', get_template_directory_uri() . '/inc/admin/assets/styles/cromax-pageheader-box.css');

    	// enqueue the scripts for the reservationsbox creator
    	wp_enqueue_media();
    	wp_enqueue_script(
    		'cromax-pageheader-box', 
    		get_template_directory_uri() . '/inc/admin/assets/scripts/cromax-headerimg-box.js', 
    		array('jquery','wp-color-picker'), 
    		null, 
    		false
    	);

    }


}
add_action( 'admin_enqueue_scripts', 'cromax_headerimage_meta_scripts', 10, 1 );




/**
 * FUNCTION : croma_custhead_form
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		Create the custom header form
 */

function croma_custhead_form() {

    global $post;

	include('templates/customhead.php');
}





/**
 * FUNCTION : cromax_save_foodmenu_metabox  - save function for the foodmenu metabox
 *
 * @access public
 * @version     1.0
 * @since       1.0
 * @uses        save function for the foodmenu metabox
 */



add_action('save_post', 'cromax_save_headerimage_metabox');  
function cromax_save_headerimage_metabox($id) {

    
    // setup the globals 
    global $post_type, $post;
    $cro_old = $cro_new = $cro_valueset = '';
    $pbarray = array();


    // prevent this from being included in the autosave.
    if( defined( 'DOING_AUTOSAVE' ) &&  DOING_AUTOSAVE ) {
        return;
    } 

    // check if current user can legally edit the post
    if( !current_user_can( 'edit_post', $id ) ) {
        return;
    } 


    // check if current this is a autosave or revision
    if( wp_is_post_revision( $id ) || wp_is_post_autosave( $id ) ) {
        return;
    }


    // Check if our nonce is set.
    if ( ! isset( $_POST['cromax_headerimage_admin_nonce'] ) ) {
        return;
    }


    $nonce = $_POST['cromax_headerimage_admin_nonce'];


    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'cromax_headerimage_admin' ) ){
      return;
    }



    $savearray = array(
        'cro_headimg_src',
        'cro_header_tileformat',
        'cro_headimg_boxheight',
        'cro_headimg_txtcol',
        'cro_headimg_maskcol',
        'cro_headimg_boxmask',
        'cro_header_enabled',
        'cro_header_mapaddress',
        'cro_header_maplat',
        'cro_header_maplng',
        'cro_header_sliderselect'
    );

    foreach ($savearray as $v) {

        if (isset($_POST[$v])) {
            update_post_meta($id,$v,$_POST[$v]);
        } else {
            update_post_meta($id,$v,'');
        }
    }

}


?>
