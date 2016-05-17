<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 *
 * cromax-mediacast-init
 * 
 * @author  	AJ aj@cro.ma
 * @package 	Cromax
 * @category 	Foodmenu
 * @copyright 	Copyright (c) 2014, Alwyn Kotze & Croma
 * @version 	1.0
 * @since 		1.0
 * @uses 		bind the different files for the food menu, and hold the important functions.
 */




/**
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		link all the different files in the mediacast group of functions
 */


include('cromax-mediacast-users.php');
include('cromax-mediacast-metaboxes.php');



/**
 * FUNCTION : cromax_fetch_latest_media  - Return a widget with the latest mediacasts
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		Return a widget with the latest mediacasts
 */


function cromax_fetch_latest_media($number) {	

	$args = array(
		'posts_per_page'   => $number,
		'post_type'        => 'mediacast'
	); 

	$mediacast_array = get_posts( $args );


	ob_start();
	include('templates/latest-mediacasts.php');
	$op = ob_get_contents();
	ob_end_clean();


	return $op;

}



/**
 * FUNCTION : fetch_mp3player
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		fetch the media player
 */
function fetch_mp3player($id){

	$mp3link = get_post_meta( $id, 'cro_mp3alt', true );

	if ($mp3link == '') {
		$mp3link = get_post_meta( $id, 'cro_mediamp3', true );
	}

	return do_shortcode('[audio mp3="' . $mp3link . '"]' );

}




/**
 * FUNCTION : cro_fetch_microphone
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		fetch the microphone icon if there is a mediacast
 */
function cro_fetch_microphone($id){

	$mp3link = get_post_meta( $id, 'cro_mp3alt', true );

	if ($mp3link == '') {
		$mp3link = get_post_meta( $id, 'cro_mediamp3', true );
	}

	if ($mp3link != '') {

	return '<div class="cro_mediacast_playerpart"><i class="icon-microphone"></i></div>';

	}

	return;
}




/**
 * FUNCTION : cro_fetch_videocast
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		fetch the videocast icon if there is a videocast
 */
function cro_fetch_videocast($id){

	$videolink = get_post_meta( $id, 'cro_vidlink', true );

	if ($videolink != '') {

		$tturi 						= cro_identifyvideo($videolink,0);	
		$randomstring 				= cromax_randstring(4);

		$vidframe 	= '<div class="cromaxModal reveal-modal large" id="' . $randomstring  .  '" data-cro-actistring="' . $randomstring  .  '"><div class="flex-video vimeo widescreen">';
		$vidframe 	.= $tturi['frame'];
		$vidframe 	.= '</div><a class="close-reveal-modal"><i class="icon-remove"></i></a></div>';

		return '<div class="cro_mediacast_videopart"><a class="cromax_videodiv"  data-reveal-id="' . $randomstring  .  '" data-reveal data-cro-actistring="' .  $randomstring .   '"><i class="icon-film"></i></a></div>' . $vidframe;

	}

	return;
}



/**
 * FUNCTION : cro_fetch_download
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		fetch the videocast icon if there is a videocast
 */
function cro_fetch_download($id){

	$mp3link 	= get_post_meta( $id, 'cro_mp3alt', true );

	if ($mp3link == '') {
		$mp3link = get_post_meta( $id, 'cro_mediamp3', true );
	}


	if ($mp3link != '') {

		$upload_dir = wp_upload_dir();
		$isloaded 	= strpos($mp3link, $upload_dir['baseurl']);

		if ($isloaded !== false) {

			$sr 		= str_replace(ABSPATH, '', $upload_dir['basedir']);
			$st 		= explode('/',str_replace(ABSPATH, '', get_stylesheet_directory()));
			$ss 		= str_repeat('../', count($st));
			$c 			= $ss . str_replace(ABSPATH, '', str_replace( $upload_dir['baseurl'], $upload_dir['basedir'],  $mp3link ));


			return '<div class="cro_mediacast_downloadpart"><a href="' . get_template_directory_uri() . '/download.php?type=' . $c . '"><i class="icon-download"></i></a></div>';

		} 

	}

	return;
}



/**
 * FUNCTION : cro_fetch_notes
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		fetch the videocast icon if there is a videocast
 */
function cro_fetch_notes($id){

	$mp3link = get_post_meta( $id, 'cro_doclink', true );


	if ($mp3link != '') {

	return '<div class="cro_mediacast_notespart"><a href="' . $mp3link . '" target="_blank"><i class="icon-book"></i></a></div>';

	}

	return;
}



/**
 * FUNCTION : cro_fetch_commentslink
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		fetch a link ot the comments
 */
function cro_fetch_commentslink($id, $status){

	if ('open' == $status) {
		return '<div class="cro_mediacast_commentpart"><a href="' . get_comments_link( $id ) . '"><i class="icon-comments-alt"></i></a></div>';

	}

	return;

}





/**
 * FUNCTION : cro_fetch_commentslink
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		fetch a link ot the comments
 */
function cro_count_user_mediacasts( $userid, $post_type = 'mediacast' ) {
	global $wpdb;

	$where = get_posts_by_author_sql( $post_type, true, $userid );

	$count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts $where" );

  	return apply_filters( 'get_usernumposts', $count, $userid );
}





