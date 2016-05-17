<?php 
/**
 * Undelete admin initialisation bootstrap
 * 
 * Called before the Undelete/Restore Posts admin panel is loaded
 */


/**
 * Hackey-hack - we override the wp_posts table name with wp_undelete_posts, so that
 * the standard WP queries recognise deleted posts and ignore standard ones, meanwhile
 * storing the original wp_posts table name for later (comes in handy when a post is undeleted)
 *
 * NB: This only happens on the Undelete Posts admin panel, so doesn't affect anything else.
 */
global $wpdb;
// Assign orignal wp_posts table name to $wpdb->posts_orig:
$wpdb->posts_orig = $wpdb->posts;
// Override $wpdb->posts table name with wp_undelete_posts:
$wpdb->posts = $wpdb->undelete_posts;


// 'post_type' argument is assigned with 'ptype' to avoid conflict on management page:
global $post_type;
if ( !isset($_GET['ptype']) )
	$post_type = 'post';
elseif ( in_array( $_GET['ptype'], get_post_types( array('show_ui' => true ) ) ) )
	$post_type = $_GET['ptype'];
else
	wp_die( __('Invalid post type') );

// Assign post_type for later use:
$_GET['ptype'] = $post_type;
$post_type_object = get_post_type_object( $post_type );

// Check user can edit this post type:
if ( !current_user_can($post_type_object->cap->edit_posts) )
	wp_die(__("Nice try, buddy."));



/**
 * Erase posts older than 28 days whenever the admin page is loaded:
 */
$days = get_option('und_days_to_keep');
if ( !$days )
	$days = 28;

$result = $wpdb->query(
	$wpdb->prepare("
		DELETE FROM $wpdb->undelete_posts 
		WHERE post_modified_gmt < DATE_SUB(NOW(), INTERVAL $days DAY);
	")
);



/**
 * Load up the wp-undelete-list-table class, used to display the edit screen and handle actions:
 */
require_once( UND_PLUGIN_PATH . 'admin/class-wp-undelete-list-table.php' );
global $wp_list_table, $_wp_column_headers;
$wp_list_table = new WP_Undelete_List_Table;

// Set column headers for the table:
$_wp_column_headers['tools_page_undelete'] = $wp_list_table->get_columns();


// I'm not actually 100% sure if I used this. @todo.
if ( 'post' != $post_type ) {
	$parent_file = "tools.php?page=undelete&ptype=$post_type";
	$submenu_file = "tools.php?page=undelete&ptype=$post_type";
	$post_new_file = "post-new.php?ptype=$post_type";
} else {
	$parent_file = 'tools.php';
	$submenu_file = 'tools.php';
	$post_new_file = 'post-new.php';
}


/**
 * Handle bulk actions (erase_all, as well as undelete/erase multiple):
 */
if ( isset($_REQUEST['bulk']) && $doaction = $wp_list_table->current_action() ) {
	check_admin_referer('bulk-posts');
	
	$sendback = remove_query_arg( array('undeleted', 'erased', 'bulk'), wp_get_referer() );
	$sendback = add_query_arg( 'paged', $pagenum, $sendback );
	
	// If erasing all posts, store the IDs and move on to erase them
	if ( 'erase_all' == $doaction ) {
		$post_status = 'deleted';
		$post_ids = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type=%s AND post_status = %s", $post_type, $post_status ) );
		$doaction = 'erase';
	} elseif ( isset( $_REQUEST['ids'] ) ) {
		$post_ids = explode( ',', $_REQUEST['ids'] );
	} elseif ( !empty( $_REQUEST['post'] ) ) {
		$post_ids = array_map('intval', $_REQUEST['post']);
	}
	
	// Send back if there were no post IDs:
	if ( !isset( $post_ids ) ) {
		wp_redirect( $sendback );
		exit;
	}
	
	// Now, take care of the bulk action:
	switch ( $doaction ) :
		case 'undelete':
			$trashed = 0;
			foreach( (array) $post_ids as $post_id ) {
				if ( !current_user_can($post_type_object->cap->delete_post, $post_id) )
					wp_die( __('You are not allowed to restore these items to the Trash.') );
			
				if ( ! wp_trash_post($post_id) )
					wp_die( __('Error in restoring to Trash.') );
			
				do_action("deleted_to_trash", $post);

				$trashed++;
			}
			$sendback = add_query_arg( array('undeleted' => $trashed, 'ids' => join(',', $post_ids) ), $sendback );
		break;
		
		case 'erase':
			$untrashed = 0;
			foreach( (array) $post_ids as $post_id ) {
				if ( !current_user_can($post_type_object->cap->delete_post, $post_id) )
					wp_die( __('You are not allowed to delete these items.') );
		
				$force = true;
				
				if ( $post->post_type == 'attachment' ) {
					if ( ! wp_delete_attachment($post_id, $force) )
						wp_die( __('Error in deleting.') );
				} else {
					if ( !wp_delete_post($post_id, $force) )
						wp_die( __('Error in deleting.') );
				}

				$untrashed++;
			}
			$sendback = add_query_arg('erased', $untrashed, $sendback);
		break;
	endswitch;
	
	// Clean up query string and send back:
	$sendback = remove_query_arg( array('action', 'action2', 'tags_input', 'post_author', 'comment_status', 'ping_status', '_status',  'post', 'bulk_edit', 'post_view'), $sendback );
	wp_redirect($sendback);
	exit();
	
} elseif ( ! empty($_REQUEST['_wp_http_referer']) ) {
	 wp_redirect( remove_query_arg( array('_wp_http_referer', '_wpnonce'), stripslashes($_SERVER['REQUEST_URI']) ) );
	 exit;
}




// Get page number:
$pagenum = $wp_list_table->get_pagenum();

// Prepare items for display:
$wp_list_table->prepare_items();

// Redirect if page number was too high:
$total_pages = $wp_list_table->get_pagination_arg( 'total_pages' );
if ( $pagenum > $total_pages && $total_pages > 0 ) {
	wp_redirect( add_query_arg( 'paged', $total_pages ) );
	exit;
}




/**
 * Handle singular post actions (undelete / erase)
 */

if ( isset($_GET['post']) ) {
	$post_id = (int) $_GET['post'];
} elseif ( isset($_POST['post_ID']) ) {
	$post_id = (int) $_POST['post_ID'];
} else {
	$post_id = 0;
}
$post = null;
$post_type_object = null;
$post_type = null;
if ( $post_id ) {
	$post = get_post($post_id);
	if ( $post ) {
		$post_type_object = get_post_type_object($post->post_type);
		if ( $post_type_object ) {
			$post_type = $post->post_type;
		}
	}
} elseif ( isset($_REQUEST['ptype']) ) {
	$post_type_object = get_post_type_object($_REQUEST['ptype']);
	if ( $post_type_object ) {
		$post_type = $post_type_object->name;
	}
}





if ( isset( $_REQUEST['action'] ) ) {
	$action = $_REQUEST['action'];
}

$sendback = remove_query_arg( array('undeleted', 'erased'), wp_get_referer() );

switch($action) :
	case 'undelete':
		check_admin_referer('undelete-' . $post_type_object->name . '_' . $post_id);

		$post = &get_post($post_id);
		
		if ( !current_user_can($post_type_object->cap->delete_post, $post_id) )
			wp_die( __('You are not allowed to restore this item to the Trash.') );
	
		if ( ! wp_trash_post($post_id) )
			wp_die( __('Error in restoring to Trash.') );
	
		do_action("deleted_to_trash", $post);
		
		wp_redirect( add_query_arg( array('undeleted' => 1), $sendback ) );
		exit();
	break;

	case 'erase':
		check_admin_referer('erase-' . $post_type_object->name . '_' . $post_id);
	
		if ( !current_user_can($post_type_object->cap->delete_post, $post_id) )
			wp_die( __('You are not allowed to delete this item.') );

		$force = true;
		
		if ( $post->post_type == 'attachment' ) {
			if ( ! wp_delete_attachment($post_id, $force) )
				wp_die( __('Error in deleting.') );
		} else {
			if ( !wp_delete_post($post_id, $force) )
				wp_die( __('Error in deleting.') );
		}
	
		wp_redirect( add_query_arg('erased', 1, $sendback) );
		exit();
	break;
endswitch;

?>