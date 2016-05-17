<?php
/**
* Plugin Name: Cromax
* Plugin URI: http://cro.ma
* Description: Cromax calendar extention pack for Croma Themes
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
			'name' 					=> _x('Calendar', 'post type general name', 'croma'),
			'singular_name' 		=> _x('Calendar Item', 'post type singular name', 'croma'),
			'add_new' 				=> _x('Add New', 'Portfolio Item', 'croma'),
			'add_new_item' 			=> __('Add New Calendar item', 'croma'),
			'edit_item' 			=> __('Edit Calendar item', 'croma'),
			'new_item' 				=> __('New Calendar item', 'croma'),
			'all_items' 			=> __('All Calendar items', 'croma'),
			'view_item' 			=> __('View Calendar item', 'croma'),
			'search_items' 			=> __('Search Calendar item', 'croma'),
			'not_found' 			=> __('No Calendar item found', 'croma'),
			'not_found_in_trash' 	=> __('No Calendar item found in Trash', 'croma'), 
			'parent_item_colon' 	=> '',
			'menu_name' 			=> _x('Calendar', 'Calendar', 'croma'),
		);

		$args = array(
			'labels' 				=> $labels,
			'public' 				=> false,
			'menu_icon' 			=> $purl . '/assets/images/calendar.png',
			'publicly_queryable' 	=> true,
			'show_ui' 				=> true, 
			'show_in_menu' 			=> true, 
			'show_in_nav_menus' 	=> true,
			'query_var' 			=> true,
			'rewrite' 				=> true,
			'capability_type' 		=> 'post',
			'has_archive' 			=> true, 
			'hierarchical' 			=> true,
			'menu_position' 		=> 4,
			'supports' 				=> array('title', 'editor', 'thumbnail'),
			'rewrite' 				=> array('slug' => 'calendar-item'),
			'with_front' 			=> FALSE
		);
	
		register_post_type('calendar',$args);


		register_taxonomy(
			"calendar_types", 
			array("calendar"), 
			array(
				"hierarchical" 		=> true, 
				"label" 			=> "Calendar types", 
				"singular_label" 	=> "Calendar types", 
				"rewrite" 			=> true
			)
		);



?>