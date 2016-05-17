<?php
/**
 * Undelete/Restore Posts Administration Panel
 *
 * Since we're in the tools.php parent page, ./admin bootstrap has already been loaded.
 */

global $wpdb, $wp_list_table, $post_type, $post_type_object;


/**
 * Make sure excerpts in the Undelete screen don't have the theme's "Continue Reading" links
 *
 * Based on wp_trim_excerpt()
 */
function undelete_custom_excerpt() {
	$text = get_the_content('');
	$text = strip_shortcodes( $text );
	$text = apply_filters('the_content', $text);
	$text = str_replace(']]>', ']]&gt;', $text);
	$text = strip_tags($text);
	$excerpt_length = apply_filters('undelete_excerpt_length', 55);
	$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
	if ( count($words) > $excerpt_length ) {
		array_pop($words);
		$text = implode(' ', $words) . ' [...]';
	} else {
		$text = implode(' ', $words);
	}
	echo apply_filters('undelete_custom_excerpt', $text);
}

// Get the title for this page (will probably remove):
$title = $post_type_object->labels->name;
?>

<div class="wrap">
	<?php screen_icon('tools'); ?>
	<h2><?php printf( _x('Restore Deleted %s', 'Post Type plural'), esc_html( $post_type_object->labels->name ) ); ?> <?php
		if ( isset($_GET['s']) && $_GET['s'] )
			printf( '<span class="subtitle">' . __('Search results for &#8220;%s&#8221;') . '</span>', get_search_query() ); ?>
	</h2>


	
	<?php if ( isset($_REQUEST['undeleted']) || isset($_REQUEST['erased']) ) { ?>
	<div id="message" class="updated"><p>
	<?php
	
	if ( isset($_REQUEST['undeleted']) && (int) $_REQUEST['undeleted'] ) {
		printf( _n( 'Item restored to the Trash.', '%s items restored to the Trash.', $_REQUEST['undeleted'] ), number_format_i18n( $_REQUEST['undeleted'] ) );
		unset($_REQUEST['undeleted']);
	}
	
	if ( isset($_REQUEST['erased']) && (int) $_REQUEST['erased'] ) {
		printf( _n( 'Item permanently erased.', '%s items permanently erased.', $_REQUEST['erased'] ), number_format_i18n( $_REQUEST['erased'] ) );
		unset($_REQUEST['erased']);
	}
	
	$_SERVER['REQUEST_URI'] = remove_query_arg( array('undeleted', 'erased'), $_SERVER['REQUEST_URI'] );
	?>
	</p></div>
	<?php } ?>
	
	<p><?php _e( "Use this screen to restore deleted posts, or erase them forever." ); ?> <?php _e( "Deleted posts are automatically erased after 28 days." );?></p>
	<p><?php _e( "Currently only standard posts are supported - postmeta values, comments and tag/category/taxonomy relationships are lost in the process, but these will be features of the next release." );?></p>
	<?php $wp_list_table->views(); ?>
	
	<form id="posts-filter" action="" method="get">
		<input type="hidden" name="page" value="undelete" />
		
		<?php $wp_list_table->search_box( $post_type_object->labels->search_items, 'post' ); ?>
		
		<input type="hidden" name="bulk" value="1" />
		<input type="hidden" name="post_status" class="post_status_page" value="deleted" />
		<input type="hidden" name="ptype" class="post_type_page" value="<?php echo $post_type_object->name; ?>" />
		
		<?php if ( ! empty( $_REQUEST['show_sticky'] ) ) { ?>
			<input type="hidden" name="show_sticky" value="1" />
		<?php } ?>
		
		<?php // Output the results:
		$wp_list_table->display(); ?>
		
	</form>
	
	<div id="ajax-response"></div>
	<br class="clear" />
</div>

<?php
include('./admin-footer.php');
