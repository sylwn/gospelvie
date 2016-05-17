<?php
/*
Plugin Name: Undelete: Restore Deleted Posts
Plugin URI: http://josscrowcroft.com/swag/wp-undelete-restore-deleted-posts-wordpress-plugin/
Description: Adds the ability to undelete/restore deleted posts, even after emptying the trash or 'permanently deleting' them. First Version - please report any bugs!
Version: 0.0.1
Author: Joss Crowcroft
Author URI: http://www.josscrowcroft.com
Tags: undelete, restore, deleted, posts, trash, admin, backup
*/
/*
	Copyright 2011 Joss Crowcroft | josscrowcroft.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, see <http://www.gnu.org/licenses/>.
*/
/*
Roadmap/to-do:
- 0.1:
	* Make sure attachments/revisions are restored along with parent post
	* Add support for restoring static pages
	* Add support for restoring custom post types
	* Retain postmeta values on deleted items
	* Retain category/tag/taxonomy associations on deleted items
	* Finish commenting code
	
- 0.2:
	* New database tables for storing deleted comments and metadata, to be restored along with their posts.
	* Options panel to change plugin settings
	
- 0.3:
	* Who knows?
*/



/************************************************************************
 * Plugin Definitions (can be overwritten)
 ************************************************************************/

/** Boring Stuff */

// Database version (for upgrades)
define( 'UND_DATABASE_VERSION', '0.0.2' );

// Plugin path and URL:
define( 'UND_PLUGIN_PATH', WP_PLUGIN_DIR . '/' . str_replace( basename( __FILE__ ), '', plugin_basename( __FILE__ ) ) );
define( 'UND_PLUGIN_URL', WP_PLUGIN_URL . '/' . str_replace( basename( __FILE__ ), '', plugin_basename( __FILE__ ) ) );




/************************************************************************
 * Setup:
 ************************************************************************/

function undelete_init() {
	global $wpdb;
	$wpdb->undelete_posts = $wpdb->prefix . "undelete_posts";
}
add_action('plugins_loaded','undelete_init');




/************************************************************************
 * Databasey Functions
 ************************************************************************/

/**
 * Move deleted post to undelete database table
 * 
 * Hooks onto 'delete_post' action, to copy the deleted post over to the
 * undelete database table and set the post_status to 'deleted'
 */
function und_delete_post_hook( $post_id ) {
	global $wpdb;

	$wpdb->undelete_posts = $wpdb->prefix . "undelete_posts";
	
	// Later use option to check whether user wants to save Post Revisions
	if ( get_post_type( $post_id ) != 'revision' ) {
		$sql = "INSERT INTO $wpdb->undelete_posts
				SELECT *
				FROM $wpdb->posts
				WHERE ID = $post_id";
		
		$result = $wpdb->query( $wpdb->prepare( $sql ) );
		
		// Set post status to 'deleted'
		// For now, also set comment_count to 0 since they get deleted :(
		$status = $wpdb->query( 
			$wpdb->prepare("
				UPDATE $wpdb->undelete_posts 
				SET `post_status` = 'deleted', 
				`comment_count` = 0 
				WHERE `ID` = $post_id;
			")
		);
	}
	return true;
}
add_action('delete_post', 'und_delete_post_hook', 1);



/**
 * Copy deleted post from undelete database table to wp_posts table
 * 
 * Hooks onto the transition post_status of 'deleted_to_trash', to copy
 * the restored post from the undelete_posts database table to the standard
 * wp_posts table.
 *
 * When this function is called, $wpdb->posts will have been temporarily
 * overridden by $wpdb->undelete_posts, and the original wp_posts table-
 * name is stored in $wpdb->posts_orig
 */
function undelete_deleted_to_trash( $post ) {
	global $wpdb;
	
	$result = $wpdb->query(
		$wpdb->prepare("
			INSERT INTO $wpdb->posts_orig
			SELECT *
			FROM $wpdb->undelete_posts
			WHERE ID = $post->ID
		")
	);
	
	// Set post_status to trashed
	$status = $wpdb->query( 
		$wpdb->prepare("
			UPDATE $wpdb->posts_orig
			SET `post_status` = 'trash'
			WHERE `ID` = $post->ID;
		")
	);
	
	// This will delete the post from the undelete_posts table, as the
	// default $wpdb->posts table-name has been temporarily overridden.
	wp_delete_post( $post->ID );
	
	return true;
}
add_action('deleted_to_trash', 'undelete_deleted_to_trash', 9999);





/************************************************************************
 * WordPress Admin Functions
 ************************************************************************/

/**
 * Sets up the admin screen and deleted post queries/actions, when requested:
 */
function undelete_admin_init() {
	if ( $_REQUEST['page'] == 'undelete' ) {
		require_once( UND_PLUGIN_PATH . 'admin/undelete-admin-init.php');
	}
}
add_action('admin_init', 'undelete_admin_init');


/**
 * Adds new management page under 'Tools' for 'Undelete/Restore'
 */
function undelete_posts_admin_menu() {
	add_management_page( __('Undelete Posts'), __('Undelete/Restore'), 'manage_options', 'undelete', 'undelete_posts_page');
	add_contextual_help('tools_page_undelete',
		'<p>' . __('Anus. That is all.') . '</p>'
	);
}
add_action('admin_menu', 'undelete_posts_admin_menu');


/**
 * Loads up the Undelete posts page:
 */
function undelete_posts_page() {
	if ( !current_user_can('manage_options') )
		wp_die( __('You do not have sufficient permissions to access this page.') );
	
	include( UND_PLUGIN_PATH . 'admin/undelete-edit.php' );
}





/************************************************************************
 * Plugin Installation
 ************************************************************************/

/**
 * Sets up database tables for Undelete, where deleted items are stored
 */
function und_install() {
	global $wpdb;
	$wpdb->undelete_posts = $wpdb->prefix . "undelete_posts";
	
	// All this taken from schema.php:
	if ( ! empty($wpdb->charset) )
		$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
	if ( ! empty($wpdb->collate) )
		$charset_collate .= " COLLATE $wpdb->collate";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	
	// Create undelete_posts database table matching wp_posts table:
	dbDelta( "CREATE TABLE $wpdb->undelete_posts LIKE $wpdb->posts;" );
	
	// Register the plugin's current database version:
	update_option( "undelete_db_version", UND_DATABASE_VERSION );
	
	// Set up plugin options for the first time:
	$options = array(
		'und_days_to_store' => 28
	);
	foreach ( $options as $k => $v ) {
		if ( !get_option( $k ) )
			add_option( $k, $v );
	}
}
register_activation_hook( __FILE__, 'und_install' );

/**
 * Drops Undelete table from database when plugin is uninstalled
 * 
 * Hope ya didn't have anything valuable still in there!
 */
function und_uninstall() {
	global $wpdb;
	$wpdb->query("DROP TABLE IF EXISTS {$wpdb->prefix}undelete_posts");
}
register_deactivation_hook( __FILE__, 'und_uninstall' );
?>