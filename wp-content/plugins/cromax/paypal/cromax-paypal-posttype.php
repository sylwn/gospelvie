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
 * Add post types for donations
 *
 * @access public
 * @return void
 */

$labels = array(
			'name' 					=> _x('Donations', 'post type general name', 'croma'),
			'singular_name' 		=> _x('Donations Item', 'post type singular name', 'croma'),
			'add_new' 				=> _x('Add New', 'Donation Item', 'croma'),
			'add_new_item' 			=> __('Add New Donation', 'croma'),
			'edit_item' 			=> __('Edit Donation', 'croma'),
			'new_item' 				=> __('New donation', 'croma'),
			'all_items' 			=> __('Donations', 'croma'),
			'view_item' 			=> __('View donations', 'croma'),
			'search_items' 			=> __('Search dontations', 'croma'),
			'not_found' 			=> __('No donations found', 'croma'),
			'not_found_in_trash' 	=> __('No donations found in Trash', 'croma'), 
			'parent_item_colon' 	=> '',
			'menu_name' 			=> _x('Donation', 'Donations', 'croma'),
		);

		$args = array(
			'labels' 				=> $labels,
			'public' 				=> false,
			'publicly_queryable' 	=> true,
			'show_ui' 				=> true, 
			'show_in_menu' 			=> 'cromatic', 
			'show_in_nav_menus' 	=> false,
			'query_var' 			=> true,
			'rewrite' 				=> true,
			'capability_type' 		=> 'post',
			'has_archive' 			=> false, 
			'hierarchical' 			=> false,
			'menu_position' 		=> 4,
			'supports' 				=> array(''),
			'rewrite' 				=> array('slug' => 'class_booking'),
			'with_front' 			=> FALSE
		);
	
register_post_type('cromax_donations',$args);





?>