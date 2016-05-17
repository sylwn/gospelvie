<?php
/**
* Plugin Name: Cromax
* Plugin URI: http://cro.ma
* Description: Cromax mediacast extention pack for Croma Themes
* Version: 1.0
* Author: Croma
* Author URI: http://www.cro.ma
* License: Themeforest Regular licence
* 
*
* @package Cromax
* @category Core
* @author Croma
*/



/*  Copyright 2013  Croma  (email : aj@cro.ma)
*
*	The licence for this plugin is The Themeforest regular Licence
*
*	The Regular License grants you, the purchaser, an ongoing, non-exclusive, 
*	worldwide license to make use of the digital work (Item) you have selected. 
*
*	Read the rest of this license for the details that apply to your use of the Item, 
*	as well as the FAQs (which form part of this license) at the address below:
*
*	http://themeforest.net/licenses/regular
*
*	Support for this licence will only be granted with the purchase of a Themeforest Theme.
*
*/


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



/**
 * Add post types for calendar
 *
 * @access public
 * @return void
 */

$purl 				= untrailingslashit( plugins_url( '/', __FILE__ ) );
$labels = array(
			'name' 					=> _x('Mediacast', 'post type general name', 'croma'),
			'singular_name' 		=> _x('Mediacast Item', 'post type singular name', 'croma'),
			'add_new' 				=> _x('Add New', 'Mediacast Item', 'croma'),
			'add_new_item' 			=> __('Add New Mediacast item', 'croma'),
			'edit_item' 			=> __('Edit Mediacast item', 'croma'),
			'new_item' 				=> __('New Mediacast item', 'croma'),
			'all_items' 			=> __('All Mediacast items', 'croma'),
			'view_item' 			=> __('View Mediacast item', 'croma'),
			'search_items' 			=> __('Search Mediacast item', 'croma'),
			'not_found' 			=> __('No Mediacast item found', 'croma'),
			'not_found_in_trash' 	=> __('No Mediacast item found in Trash', 'croma'), 
			'parent_item_colon' 	=> '',
			'menu_name' 			=> _x('Mediacast', 'Mediacast', 'croma'),
		);

		$args = array(
			'labels' 				=> $labels,
			'public' 				=> false,
			'menu_icon' 			=> $purl . '/assets/images/mediacast.png',
			'publicly_queryable' 	=> true,
			'show_ui' 				=> true, 
			'show_in_menu' 			=> true, 
			'show_in_nav_menus' 	=> false,
			'query_var' 			=> true,
			'rewrite' 				=> true,
			'capability_type' 		=> 'post',
			'has_archive' 			=> true, 
			'hierarchical' 			=> false,
			'menu_position' 		=> 4,
			'supports' 				=> array('title', 'thumbnail', 'editor', 'author','comments'),
			'rewrite' 				=> array('slug' => 'foodmenu-item'),
			'with_front' 			=> FALSE
		);
	
		register_post_type('mediacast',$args);




	$labels2 = array(
		'name' => __('Mediacast Tags','croma'),
		'singular_name' => __('Mediacast Tag','croma'),
		'search_items' =>  __('Mediacast Tag','croma'),
		'all_items' => __('All Mediacast ','croma'),
		'add_new_item' => __( 'Add new Mediacast  tag','croma'),
		'new_item_name' => __( 'New Mediacast  tag','croma')
	);

	register_taxonomy( 'mediacast_tags', 'mediacast', array(
		'hierarchical' => false,
		'labels' => $labels2, /* NOTICE: Here is where the $labels variable is used */
		'show_ui' => true,
		'query_var' => true,
		'public' => true,
		'show_in_nav_menus' => false
	));




	$labels3 = array(
				'name' => ucfirst('media_category'),
				'singular_name' => ucfirst('media_category')  . __(' category','croma'),
				'search_items' =>  __( 'Search ','croma') . ucfirst('media_category'),
				'all_items' => __( 'All ','croma') . ucfirst('media_category'),
				'parent_item' => __( 'Parent ','croma') . ucfirst('media_category'),
				'parent_item_colon' => __( 'Parent ','croma') . ucfirst('media_category'),
				'edit_item' => __( 'Edit ','croma') . ucfirst('media_category'),
				'update_item' => __( 'Update ','croma') . ucfirst('media_category'),
				'add_new_item' => __( 'Add new ','croma') . ucfirst('media_category'),
				'new_item_name' => __( 'New ','croma') . ucfirst('media_category')
			);
		
			register_taxonomy( 'media_category', 'mediacast', array(
				'hierarchical' => true,
				'labels' => $labels3, /* NOTICE: Here is where the $labels variable is used */
				'show_ui' => true,
				'query_var' => true,
				'public' => true,
				'show_in_nav_menus' => true
			));




?>