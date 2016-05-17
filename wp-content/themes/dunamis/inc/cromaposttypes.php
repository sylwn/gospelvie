<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

/**
 * Cromatheme post type functions
 *
 *
 * @package Croma.framework
 * @subpackage Croma.framework
 * @since 1.0
 */




/**
 * Set up The post type array
 *
 * @version	1.0
 * @since 1.0
 * @package	Cromatheme
 * @author Cromatheme
 */
 
function cromatheme_customtype_array() {
	$cro_posttype_array = array(
		'sshow' => array(
				'singular' 			=> 'cromaticfront',
				'plural' 			=> 'cromaticfronts',
				'description' 		=> 'Slideshows post type',
				'supports' 			=> array('title','thumbnail','editor'),
				'show_men' 			=> false,
				'show_nav' 			=> false,
				'exclude-search' 	=> true,
				'make_categories' 	=> false,
				'menu_position' 	=> 52,
				'cat_names' 		=> 'ss'
		),
		'mms' => array(
				'singular' 			=> 'cromaticmm',
				'plural' 			=> 'cromaticmms',
				'description' 		=> 'Megamenu post type',
				'supports' 			=> array('title','thumbnail','editor'),
				'show_men' 			=> false,
				'show_nav' 			=> false,
				'exclude-search' 	=> true,
				'make_categories' 	=> false,
				'menu_position' 	=> 52,
				'cat_names' 		=> 'ss'
		)

	);
	return apply_filters( 'cromatheme_customtype_array', $cro_posttype_array );
}



/**
 * Registering the post types
 *
 * @version	1.0
 * @since 1.0
 * @package	Cromatheme
 * @author Cromatheme
 */

add_action('init', 'cromatheme_create_posttype');

function cromatheme_create_posttype($data) {
	foreach (  cromatheme_customtype_array() as $field ) {	
		$labels = array(
    		'name' 					=> ucfirst($field['plural']),
    		'singular_name' 		=> ucfirst($field['singular']),
    		'add_new' 				=> __('Add ','croma') . ucfirst($field['singular']),
    		'add_new_item' 			=> __('Add new ','croma') . ucfirst($field['singular']),
    		'edit_item' 			=> __('Edit ','croma') . ucfirst($field['singular']),
    		'new_item' 				=> __('New ','croma') . ucfirst($field['singular']),
    		'view_item' 			=> __('View ','croma') . ucfirst($field['singular']),
    		'search_items' 			=> __('Search ','croma') . ucfirst($field['singular']),
    		'not_found' 			=>  __('No ','croma') . ucfirst($field['singular']) , __(' found','croma'),
    		'not_found_in_trash' 	=> __('No ','croma') . ucfirst($field['singular']) , __(' found in trash','croma'), 
    		'parent_item_colon' 	=> ''
  		);
  		
  		$args = array(
    		'labels' 				=> $labels, 
    		'description' 			=> $field['description'],
    		'menu_icon' 			=> get_template_directory_uri() . '/assets/styles/framework-images/' . $field['singular'] . '.png',
    		'public' 				=> true,  
			'show_ui' 				=> true, 		
			'publicly_queryable' 	=> true,		
			'exclude_from_search' 	=> $field['exclude-search'], 
			'show_in_nav_menus' 	=> $field['show_nav'], 
			'can_export' 			=> true, 
			'hierarchical' 			=> true, 
			'show_in_menu' 			=> $field['show_men'], 
  			'menu_position' 		=> $field['menu_position'],
			'supports' 				=> $field['supports'],	
    		'query_var' 			=> true,
    		'rewrite' 				=> true,
    		'capability_type' 		=> 'post', 
    		'has_archive' 			=> 'true'
  		); 	 		
  		register_post_type($field['plural'],$args);
	}
}




/**
 * Registering the post type messages
 *
 * @version	1.0
 * @since 1.0
 * @package	Cromatheme
 * @author Cromatheme
 */
add_filter('post_updated_messages', 'cromatheme_make_messages');
function cromatheme_make_messages( $messages ) {
	global $post, $post_ID; 
	foreach ( cromatheme_customtype_array() as $field ) {	
  		$messages[$field['plural']] = array(
    		0 	=> '', 
    		1 	=> ucfirst($field['singular']) . __(' updated.','croma'),
    		2 	=> __('Custom field updated.' ,'croma'),
    		3 	=> __('Custom field deleted.', 'croma'),
    		4 	=> ucfirst($field['singular']) . __(' updated.', 'croma'),
    		5 	=> __('Restored to Revision.', 'croma'),
    		6 	=> ucfirst($field['singular']) . __(' published','croma'),
    		7 	=> ucfirst($field['singular']) . __(' saved.','croma'),
    		8 	=> ucfirst($field['singular']) . __(' submitted.','croma'),
    		9 	=> ucfirst($field['singular']) . __(' scheduled','croma'),
    		10 	=> ucfirst($field['singular']) . __(' draft updated.','croma')
  		); 		
  		return $messages;	
	}
}




/**
 * Registering the post taxonomies
 *
 * @version	1.0
 * @since 1.0
 * @package	Cromatheme
 * @author Cromatheme
 */
add_action( 'init', 'cromatheme_create_taxonomies', 0 );
function cromatheme_create_taxonomies() {

	foreach ( cromatheme_customtype_array() as $field ) {	
	
		if ($field['make_categories'] == true) {
	
			$labels = array(
				'name' 				=> ucfirst($field['cat_names']),
				'singular_name' 	=> ucfirst($field['cat_names'])  . __(' category','croma'),
				'search_items' 		=>  __( 'Search ','croma') . ucfirst($field['cat_names']),
				'all_items' 		=> __( 'All ','croma') . ucfirst($field['cat_names']),
				'parent_item' 		=> __( 'Parent ','croma') . ucfirst($field['cat_names']),
				'parent_item_colon' => __( 'Parent ','croma') . ucfirst($field['cat_names']),
				'edit_item' 		=> __( 'Edit ','croma') . ucfirst($field['cat_names']),
				'update_item' 		=> __( 'Update ','croma') . ucfirst($field['cat_names']),
				'add_new_item' 		=> __( 'Add new ','croma') . ucfirst($field['cat_names']),
				'new_item_name' 	=> __( 'New ','croma') . ucfirst($field['cat_names'])
			);
		
			register_taxonomy( $field['cat_names'], array( $field['plural'] ), array(
				'hierarchical' 		=> true,
				'labels' 			=> $labels, 
				'show_ui' 			=> true,
				'query_var' 		=> true,
				'show_in_nav_menus' => false
			));

		}
	}
}
?>