<?php
/**
 * WP_Undelete_List_Table class
 *
 * Used to display all the aspects of the posts list table, WP-stylee.
 *
 * Mostly copied/modified from WP_Posts_List_Table (could definitely use some cleaning up)
 * - table wp_posts has been overridden with wp_undelete_posts to enable all the queries
 * to just work, no hassle involved.
 *
 * Will make more sense when custom post types/pages are supported.
 */
class WP_Undelete_List_Table extends WP_List_Table {

	/**
	 * Whether the items should be displayed hierarchically or linearly
	 *
	 * @since 3.1.0
	 * @var bool
	 * @access protected
	 */
	var $hierarchical_display;

	/**
	 * Holds the number of pending comments for each post
	 *
	 * @since 3.1.0
	 * @var int
	 * @access protected
	 */
	var $comment_pending_count;

	/**
	 * Holds the number of posts for this user
	 *
	 * @since 3.1.0
	 * @var int
	 * @access private
	 */
	var $user_posts_count;

	/**
	 * Holds the number of posts which are sticky.
	 *
	 * @since 3.1.0
	 * @var int
	 * @access private
	 */
	var $sticky_posts_count = 0;

	function WP_Undelete_List_Table() {
		global $post_type_object, $post_type, $wpdb;

		if ( !isset( $_REQUEST['ptype'] ) )
			$post_type = 'post';
		elseif ( in_array( $_REQUEST['ptype'], get_post_types( array( 'show_ui' => true ) ) ) )
			$post_type = $_REQUEST['ptype'];
		else
			wp_die( __( 'Invalid post type' ) );
		$_REQUEST['ptype'] = $post_type;

		$post_type_object = get_post_type_object( $post_type );

		if ( !current_user_can( $post_type_object->cap->edit_others_posts ) ) {
			$this->user_posts_count = $wpdb->get_var( $wpdb->prepare( "
				SELECT COUNT( 1 ) FROM $wpdb->posts
				WHERE post_type = %s AND post_status NOT IN ( 'auto-draft' )
				AND post_author = %d
			", $post_type, get_current_user_id() ) );

			if ( $this->user_posts_count && empty( $_REQUEST['post_status'] ) && empty( $_REQUEST['all_posts'] ) && empty( $_REQUEST['author'] ) && empty( $_REQUEST['show_sticky'] ) )
				$_GET['author'] = get_current_user_id();
		}

		if ( 'post' == $post_type && $sticky_posts = get_option( 'sticky_posts' ) ) {
			$sticky_posts = implode( ', ', array_map( 'absint', (array) $sticky_posts ) );
			$this->sticky_posts_count = $wpdb->get_var( $wpdb->prepare( "SELECT COUNT( 1 ) FROM $wpdb->posts WHERE post_type = %s AND ID IN ($sticky_posts)", $post_type ) );
		}

		parent::WP_List_Table( array(
			'plural' => 'posts',
		) );
	}

	function ajax_user_can() {
		global $post_type_object;

		return current_user_can( $post_type_object->cap->edit_posts );
	}

	function prepare_items() {
		global $post_type_object, $post_type, $avail_post_stati, $wp_query, $per_page, $mode;

		// Extend WP Post Statuses to include 'deleted' as an allowed status:
		global	$wp_post_statuses;
		$wp_post_statuses['deleted'] = array(
			'label' => 'Deleted',
			'label_count' => array(
				'0' => 'Deleted (%s)',
				'1' => 'Deleted (%s)',
				'singular' => 'Deleted (%s)',
				'plural' => 'Deleted (%s)',
				'context' => ''
			),
			'exclude_from_search' => 1,
			'_builtin' => 1,
			'_edit_link' => 'tools.php?page=undelete&post=%d',
			'capability_type' => 'post',
			'hierarchical' => false,
			'public' => false,
			'internal' => 1,
			'protected' => false,
			'private' => false,
			'show_in_admin_all' => false,
			'publicly_queryable' => false,
			'show_in_admin_status_list' => false,
			'show_in_admin_all_list' => false,
			'single_view_cap' => 'edit',
			'name' => 'deleted',
		);
		
		$avail_post_stati = wp_edit_posts_query(array('post_status' => 'deleted'));

		$this->hierarchical_display = ( $post_type_object->hierarchical && 'menu_order title' == $wp_query->query['orderby'] );

		$total_items = $this->hierarchical_display ? $wp_query->post_count : $wp_query->found_posts;

		$per_page = $this->get_items_per_page( 'edit_' . $post_type . '_per_page' );
 		$per_page = apply_filters( 'edit_posts_per_page', $per_page, $post_type );

		if ( $this->hierarchical_display )
			$total_pages = ceil( $total_items / $per_page );
		else
			$total_pages = $wp_query->max_num_pages;

		$mode = empty( $_REQUEST['mode'] ) ? 'list' : $_REQUEST['mode'];

/* 		$this->is_trash = true;//isset( $_REQUEST['post_status'] ) && $_REQUEST['post_status'] == ''; */

		$this->set_pagination_args( array(
			'total_items' => $total_items,
			'total_pages' => $total_pages,
			'per_page' => $per_page
		) );
	}

	function has_items() {
		return have_posts();
	}

	function no_items() {
		global $post_type_object;

		echo $post_type_object->labels->not_found;
	}

	function get_views() {
		global $post_type, $post_type_object, $locked_post_status, $avail_post_stati;
		
		if ( !$post_type )
			$post_type = $post_type_object->name;
		
		if ( !empty($locked_post_status) )
			return array();

		$status_links = array();

		$num_posts = wp_count_posts( $post_type );
		$class = '';
		$allposts = '';

		$current_user_id = get_current_user_id();

		if ( $this->user_posts_count ) {
			if ( isset( $_GET['author'] ) && ( $_GET['author'] == $current_user_id ) )
				$class = ' class="current"';
			$status_links['mine'] = "<a href='tools.php?page-undelete&ptype=$post_type&author=$current_user_id'$class>" . sprintf( _nx( 'Mine <span class="count">(%s)</span>', 'Mine <span class="count">(%s)</span>', $this->user_posts_count, 'posts' ), number_format_i18n( $this->user_posts_count ) ) . '</a>';
			$allposts = '&all_posts=1';
		}

		$total_posts = array_sum( (array) $num_posts );
		
		$class = empty( $class ) && empty( $_REQUEST['post_status'] ) && empty( $_REQUEST['show_sticky'] ) ? ' class="current"' : '';
		$status_links['all'] = "<a href='tools.php?page=undelete&ptype=$post_type{$allposts}'$class>" . sprintf( _nx( 'All <span class="count">(%s)</span>', 'All <span class="count">(%s)</span>', $total_posts, 'posts' ), number_format_i18n( $total_posts ) ) . '</a>';
		return $status_links;
	}

	function get_bulk_actions() {
		$actions = array();

		$actions['undelete'] = __( 'Restore to Trash' );
		$actions['erase'] = __( 'Erase Permanently' );

		return $actions;
	}

	function extra_tablenav( $which ) {
		global $post_type, $post_type_object, $cat;
?>
		<div class="alignleft actions">
<?php
		if ( 'top' == $which && !is_singular() ) {

			$this->months_dropdown( $post_type );

			if ( is_object_in_taxonomy( $post_type, 'category' ) ) {
				$dropdown_options = array(
					'show_option_all' => __( 'View all categories' ),
					'hide_empty' => 0,
					'hierarchical' => 1,
					'show_count' => 0,
					'orderby' => 'name',
					'selected' => $cat
				);
				wp_dropdown_categories( $dropdown_options );
			}
			do_action( 'restrict_manage_posts' );
			submit_button( __( 'Filter' ), 'secondary', false, false, array( 'id' => 'post-query-submit' ) );
		}

		// Erase All button:
		if ( current_user_can( $post_type_object->cap->edit_others_posts ) ) {
			submit_button( __( 'Permanently Erase All' ), 'button-secondary apply', 'erase_all', false );
		}
?>
		</div>
<?php
	}

	function current_action() {
		if ( isset( $_REQUEST['erase_all'] ) || isset( $_REQUEST['erase_all2'] ) )
			return 'erase_all';

		return parent::current_action();
	}

	function pagination( $which ) {
		global $post_type_object, $mode;

		parent::pagination( $which );

		if ( 'top' == $which && !$post_type_object->hierarchical )
			$this->view_switcher( $mode );
	}

	function get_table_classes() {
		global $post_type_object;

		return array( 'widefat', 'fixed', $post_type_object->hierarchical ? 'pages' : 'posts' );
	}

	function get_columns() {
		$screen = get_current_screen();

		if ( empty( $screen ) )
			$post_type = 'post';
		else
			$post_type = $screen->post_type;

		$posts_columns = array();

		$posts_columns['cb'] = '<input type="checkbox" />';

		/* translators: manage posts column name */
		$posts_columns['title'] = _x( 'Title', 'column name' );

		if ( post_type_supports( $post_type, 'author' ) )
			$posts_columns['author'] = __( 'Author' );

		if ( empty( $post_type ) || is_object_in_taxonomy( $post_type, 'category' ) )
			$posts_columns['categories'] = __( 'Categories' );

		if ( empty( $post_type ) || is_object_in_taxonomy( $post_type, 'post_tag' ) )
			$posts_columns['tags'] = __( 'Tags' );

		$post_status = !empty( $_REQUEST['post_status'] ) ? $_REQUEST['post_status'] : 'all';
		if ( post_type_supports( $post_type, 'comments' ) && !in_array( $post_status, array( 'pending', 'draft', 'future' ) ) )
			$posts_columns['comments'] = '<div class="vers"><img alt="' . esc_attr__( 'Comments' ) . '" src="' . esc_url( admin_url( 'images/comment-grey-bubble.png' ) ) . '" /></div>';

		$posts_columns['date'] = __( 'Date' );

		if ( 'page' == $post_type )
			$posts_columns = apply_filters( 'manage_pages_columns', $posts_columns );
		else
			$posts_columns = apply_filters( 'manage_posts_columns', $posts_columns, $post_type );
		$posts_columns = apply_filters( "manage_{$post_type}_posts_columns", $posts_columns );

		return $posts_columns;
	}

	function get_sortable_columns() {
		return array(
			'title'    => 'title',
			'author'   => 'author',
			'parent'   => 'parent',
			'comments' => 'comment_count',
			'date'     => array( 'date', true )
		);
	}

	function display_rows( $posts = array() ) {
		global $wp_query, $post_type_object, $per_page;

		if ( empty( $posts ) )
			$posts = $wp_query->posts;

		add_filter( 'the_title', 'esc_html' );

		if ( $this->hierarchical_display ) {
			$this->_display_rows_hierarchical( $posts, $this->get_pagenum(), $per_page );
		} else {
			$this->_display_rows( $posts );
		}
	}

	function _display_rows( $posts ) {
		global $post, $mode;

		// Create array of post IDs.
		$post_ids = array();

		foreach ( $posts as $a_post )
			$post_ids[] = $a_post->ID;

		$this->comment_pending_count = get_pending_comments_num( $post_ids );

		foreach ( $posts as $post )
			$this->single_row( $post );
	}

	function _display_rows_hierarchical( $pages, $pagenum = 1, $per_page = 20 ) {
		global $wpdb;

		$level = 0;

		if ( ! $pages ) {
			$pages = get_pages( array( 'sort_column' => 'menu_order' ) );

			if ( ! $pages )
				return false;
		}

		/*
		 * arrange pages into two parts: top level pages and children_pages
		 * children_pages is two dimensional array, eg.
		 * children_pages[10][] contains all sub-pages whose parent is 10.
		 * It only takes O( N ) to arrange this and it takes O( 1 ) for subsequent lookup operations
		 * If searching, ignore hierarchy and treat everything as top level
		 */
		if ( empty( $_REQUEST['s'] ) ) {

			$top_level_pages = array();
			$children_pages = array();

			foreach ( $pages as $page ) {

				// catch and repair bad pages
				if ( $page->post_parent == $page->ID ) {
					$page->post_parent = 0;
					$wpdb->update( $wpdb->posts, array( 'post_parent' => 0 ), array( 'ID' => $page->ID ) );
					clean_page_cache( $page->ID );
				}

				if ( 0 == $page->post_parent )
					$top_level_pages[] = $page;
				else
					$children_pages[ $page->post_parent ][] = $page;
			}

			$pages = &$top_level_pages;
		}

		$count = 0;
		$start = ( $pagenum - 1 ) * $per_page;
		$end = $start + $per_page;

		foreach ( $pages as $page ) {
			if ( $count >= $end )
				break;

			if ( $count >= $start )
				echo "\t" . $this->single_row( $page, $level );

			$count++;

			if ( isset( $children_pages ) )
				$this->_page_rows( $children_pages, $count, $page->ID, $level + 1, $pagenum, $per_page );
		}

		// if it is the last pagenum and there are orphaned pages, display them with paging as well
		if ( isset( $children_pages ) && $count < $end ){
			foreach ( $children_pages as $orphans ){
				foreach ( $orphans as $op ) {
					if ( $count >= $end )
						break;
					if ( $count >= $start )
						echo "\t" . $this->single_row( $op, 0 );
					$count++;
				}
			}
		}
	}

	/**
	 * Given a top level page ID, display the nested hierarchy of sub-pages
	 * together with paging support
	 *
	 * @since 3.1.0 (Standalone function exists since 2.6.0)
	 *
	 * @param unknown_type $children_pages
	 * @param unknown_type $count
	 * @param unknown_type $parent
	 * @param unknown_type $level
	 * @param unknown_type $pagenum
	 * @param unknown_type $per_page
	 */
	function _page_rows( &$children_pages, &$count, $parent, $level, $pagenum, $per_page ) {

		if ( ! isset( $children_pages[$parent] ) )
			return;

		$start = ( $pagenum - 1 ) * $per_page;
		$end = $start + $per_page;

		foreach ( $children_pages[$parent] as $page ) {

			if ( $count >= $end )
				break;

			// If the page starts in a subtree, print the parents.
			if ( $count == $start && $page->post_parent > 0 ) {
				$my_parents = array();
				$my_parent = $page->post_parent;
				while ( $my_parent ) {
					$my_parent = get_post( $my_parent );
					$my_parents[] = $my_parent;
					if ( !$my_parent->post_parent )
						break;
					$my_parent = $my_parent->post_parent;
				}
				$num_parents = count( $my_parents );
				while ( $my_parent = array_pop( $my_parents ) ) {
					echo "\t" . $this->single_row( $my_parent, $level - $num_parents );
					$num_parents--;
				}
			}

			if ( $count >= $start )
				echo "\t" . $this->single_row( $page, $level );

			$count++;

			$this->_page_rows( $children_pages, $count, $page->ID, $level + 1, $pagenum, $per_page );
		}

		unset( $children_pages[$parent] ); //required in order to keep track of orphans
	}

	function single_row( $a_post, $level = 0 ) {
		global $post, $current_screen, $mode;
		static $rowclass;

		$global_post = $post;
		$post = $a_post;
		setup_postdata( $post );

		$rowclass = 'alternate' == $rowclass ? '' : 'alternate';
		$post_owner = ( get_current_user_id() == $post->post_author ? 'self' : 'other' );
		$edit_link = get_edit_post_link( $post->ID );
		$title = _draft_or_post_title();
		$post_type_object = get_post_type_object( $post->post_type );
		$can_edit_post = current_user_can( $post_type_object->cap->edit_post, $post->ID );
		$post_format = get_post_format( $post->ID );
		$post_format_class = ( $post_format && !is_wp_error($post_format) ) ? 'format-' . sanitize_html_class( $post_format ) : 'format-default';
	?>
		<tr id='post-<?php echo $post->ID; ?>' class='<?php echo trim( $rowclass . ' author-' . $post_owner . ' status-' . $post->post_status . ' ' . $post_format_class); ?> iedit' valign="top">
	<?php

		list( $columns, $hidden ) = $this->get_column_info();

		foreach ( $columns as $column_name => $column_display_name ) {
			$class = "class=\"$column_name column-$column_name\"";

			$style = '';
			if ( in_array( $column_name, $hidden ) )
				$style = ' style="display:none;"';

			$attributes = "$class$style";

			switch ( $column_name ) {

			case 'cb':
			?>
			<th scope="row" class="check-column"><?php if ( $can_edit_post ) { ?><input type="checkbox" name="post[]" value="<?php the_ID(); ?>" /><?php } ?></th>
			<?php
			break;

			case 'title':
				if ( $this->hierarchical_display ) {
					$attributes = 'class="post-title page-title column-title"' . $style;

					if ( 0 == $level && (int) $post->post_parent > 0 ) {
						//sent level 0 by accident, by default, or because we don't know the actual level
						$find_main_page = (int) $post->post_parent;
						while ( $find_main_page > 0 ) {
							$parent = get_page( $find_main_page );

							if ( is_null( $parent ) )
								break;

							$level++;
							$find_main_page = (int) $parent->post_parent;

							if ( !isset( $parent_name ) )
								$parent_name = apply_filters( 'the_title', $parent->post_title, $parent->ID );
						}
					}

					$pad = str_repeat( '&#8212; ', $level );
?>
			<td <?php echo $attributes ?>><strong><?php if ( $maybe_user_this_later ) { ?><a class="row-title" href="<?php echo $edit_link; ?>" title="<?php echo esc_attr( sprintf( __( 'Edit &#8220;%s&#8221;' ), $title ) ); ?>"><?php echo $pad; echo $title ?></a><?php } else { echo $pad; echo $title; }; _post_states( $post ); echo isset( $parent_name ) ? ' | ' . $post_type_object->labels->parent_item_colon . ' ' . esc_html( $parent_name ) : ''; ?></strong>
<?php
				}
				else {
					$attributes = 'class="post-title page-title column-title"' . $style;
?>
			<td <?php echo $attributes ?>><strong><?php if ( $maybe_user_this_later ) { ?><a class="row-title" href="<?php echo $edit_link; ?>" title="<?php echo esc_attr( sprintf( __( 'Edit &#8220;%s&#8221;' ), $title ) ); ?>"><?php echo $title ?></a><?php } else { echo $title; }; _post_states( $post ); ?></strong>
<?php
					if ( 'excerpt' == $mode ) {
						undelete_custom_excerpt();
					}
				}

				$actions = array();

				if ( current_user_can( $post_type_object->cap->delete_post, $post->ID ) ) {
					$actions['undelete'] = "<a title='" . esc_attr( __( 'Restore this item to the Trash' ) ) . "' href='" . wp_nonce_url( admin_url( "tools.php?page=undelete&action=undelete&post=$post->ID" ), 'undelete-' . $post->post_type . '_' . $post->ID ) . "'>" . __( 'Restore to Trash' ) . "</a>";
					$actions['delete'] = "<a class='submitdelete' title='" . esc_attr( __( 'Erase this item permanently' ) ) . "' href='" . wp_nonce_url( admin_url( "tools.php?page=undelete&action=erase&post=$post->ID" ), 'erase-' . $post->post_type . '_' . $post->ID ) . "'>" . __( 'Erase Permanently' ) . "</a>";
				}

				$actions = apply_filters( is_post_type_hierarchical( $post->post_type ) ? 'page_row_actions' : 'post_row_actions', $actions, $post );
				echo $this->row_actions( $actions );

				get_inline_data( $post );
				echo '</td>';
			break;

			case 'date':
				if ( '0000-00-00 00:00:00' == $post->post_date && 'date' == $column_name ) {
					$t_time = $h_time = __( 'Unpublished' );
					$time_diff = 0;
				} else {
					$t_time = get_the_time( __( 'Y/m/d g:i:s A' ) );
					$m_time = $post->post_date;
					$time = get_post_time( 'G', true, $post );

					$time_diff = time() - $time;

					if ( $time_diff > 0 && $time_diff < 24*60*60 )
						$h_time = sprintf( __( '%s ago' ), human_time_diff( $time ) );
					else
						$h_time = mysql2date( __( 'Y/m/d' ), $m_time );
				}

				echo '<td ' . $attributes . '>';
				if ( 'excerpt' == $mode )
					echo apply_filters( 'post_date_column_time', $t_time, $post, $column_name, $mode );
				else
					echo '<abbr title="' . $t_time . '">' . apply_filters( 'post_date_column_time', $h_time, $post, $column_name, $mode ) . '</abbr>';
				echo '<br />';
				if ( 'publish' == $post->post_status ) {
					_e( 'Published' );
				} elseif ( 'future' == $post->post_status ) {
					if ( $time_diff > 0 )
						echo '<strong class="attention">' . __( 'Missed schedule' ) . '</strong>';
					else
						_e( 'Scheduled' );
				} else {
					_e( 'Last Modified' );
				}
				echo '</td>';
			break;

			case 'categories':
			?>
			<td <?php echo $attributes ?>><?php
				$categories = get_the_category();
				if ( !empty( $categories ) ) {
					$out = array();
					foreach ( $categories as $c ) {
						$out[] = sprintf( '<a href="%s">%s</a>',
							esc_url( add_query_arg( array( 'ptype' => $post->post_type, 'category_name' => $c->slug ), 'tools.php?page=undelete' ) ),
							esc_html( sanitize_term_field( 'name', $c->name, $c->term_id, 'category', 'display' ) )
						);
					}
					echo join( ', ', $out );
				} else {
					_e( 'Uncategorized' );
				}
			?></td>
			<?php
			break;

			case 'tags':
			?>
			<td <?php echo $attributes ?>><?php
				$tags = get_the_tags( $post->ID );
				if ( !empty( $tags ) ) {
					$out = array();
					foreach ( $tags as $c ) {
						$out[] = sprintf( '<a href="%s">%s</a>',
							esc_url( add_query_arg( array( 'ptype' => $post->post_type, 'tag' => $c->slug ), 'tools.php?page=undelete' ) ),
							esc_html( sanitize_term_field( 'name', $c->name, $c->term_id, 'tag', 'display' ) )
						);
					}
					echo join( ', ', $out );
				} else {
					_e( 'No Tags' );
				}
			?></td>
			<?php
			break;

			case 'comments':
			?>
			<td <?php echo $attributes ?>><div class="post-com-count-wrapper">
			<?php
				$pending_comments = isset( $this->comment_pending_count[$post->ID] ) ? $this->comment_pending_count[$post->ID] : 0;

				$this->comments_bubble( $post->ID, $pending_comments );
			?>
			</div></td>
			<?php
			break;

			case 'author':
			?>
			<td <?php echo $attributes ?>><?php
				printf( '<a href="%s">%s</a>',
					esc_url( add_query_arg( array( 'ptype' => $post->post_type, 'author' => get_the_author_meta( 'ID' ) ), 'tools.php?page=undelete' )),
					get_the_author()
				);
			?></td>
			<?php
			break;

			default:
			?>
			<td <?php echo $attributes ?>><?php
				if ( is_post_type_hierarchical( $post->post_type ) )
					do_action( 'manage_pages_custom_column', $column_name, $post->ID );
				else
					do_action( 'manage_posts_custom_column', $column_name, $post->ID );
				do_action( "manage_{$post->post_type}_posts_custom_column", $column_name, $post->ID );
			?></td>
			<?php
			break;
		}
	}
	?>
		</tr>
	<?php
		$post = $global_post;
	}
}
?>
