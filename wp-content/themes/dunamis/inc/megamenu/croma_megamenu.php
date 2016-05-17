<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php

/**
 * Croma Megamenu
 *
 *
 * @package Croma.framework
 * @subpackage Croma.framework
 * @since 1.0
 */



if ( ! class_exists( 'Croma_Megamenu_Fields' ) ) :



	class Croma_Megamenu_Fields {

		/**
		* Add filter
		*
		*/
		public static function load() {
			add_filter( 'wp_edit_nav_menu_walker', array( __CLASS__, '_filter_walker' ), 99 );
		}


		/**
		* Replace default menu editor walker with ours
		*
		* @since   1.0
		* @access  private
		*/
		public static function _filter_walker( $walker ) {
			$walker = 'Croma_MM_Fields_Walker';
			if ( ! class_exists( $walker ) ) {
				require_once dirname( __FILE__ ) . '/cromax-mm-edit.php';
			}

			return $walker;
		}
	}


	add_action( 'wp_loaded', array( 'Croma_Megamenu_Fields', 'load' ), 9 );
endif; 







/**
 * add and save fields
 *
 * @since 0.1.0
 */
class Cromax_MM_Actions {

	/**
	 * Initialize plugin
	 */
	public static function init() {
		add_action( 'croma_mm_custom_fields', array( __CLASS__, '_fields' ), 10, 3 );
		add_action( 'wp_update_nav_menu_item', array( __CLASS__, '_save' ), 10, 3 );
		add_filter( 'manage_nav-menus_columns', array( __CLASS__, '_columns' ), 99 );
	}


	/**
	 * Save custom field value
	 *
	 * @wp_hook action wp_update_nav_menu_item
	 *
	 * @param int   $menu_id         Nav menu ID
	 * @param int   $menu_item_db_id Menu item ID
	 * @param array $menu_item_args  Menu item data
	 */
	public static function _save( $menu_id, $menu_item_db_id, $menu_item_args ) {

		// Sanitize
		if ( ! empty( $_POST['croma-custom-field'][ $menu_item_db_id ] ) ) {
			// Do some checks here...
			$value = $_POST['croma-custom-field'][ $menu_item_db_id ];
		}
		else {
			$value = '';
		}

		// Update
		if ( ! empty( $value ) ) {
			update_post_meta( $menu_item_db_id, 'croma-custom-field', $value );
		}
		else {
			delete_post_meta( $menu_item_db_id, 'croma-custom-field' );
		}
	}


	/**
	 * Print field
	 *
	 * @param object $item  Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args  Menu item args.
	 * @param int    $id    Nav menu ID.
	 *
	 * @return string Form fields
	 */
	public static function _fields( $item, $depth, $args = array(), $id = 0 ) {


		$args = array(
			'post_type' 		=> 'cromaticmms',
			'post_status' 		=> 'private',
			'order' 			=> 'ASC',
			'posts_per_page' 	=> -1
		); 

		$pages = get_posts($args); 




		?>
			<p class="field-custom description description-wide">
				<label for="edit-croma-custom-field-<?php echo esc_attr( $item->ID ) ?>"><?php _e( 'Select mega-menu part', 'croma' ) ?><br />
					<select name="croma-custom-field[<?php echo esc_attr( $item->ID ); ?>]" class="widefat code edit-menu-item-custom-field" id="edit-menu-item-custom-field-<?php echo esc_attr( $item->ID ); ?>">
						<option value="0" <?php selected( esc_attr( get_post_meta( $item->ID, 'croma-custom-field', true )), 0, true); ?>><?php _e('None','croma'); ?></option>
						<?php foreach($pages as $value) {  ?>
						<option value="<?php echo $value->ID; ?>" <?php selected( esc_attr( get_post_meta( $item->ID, 'croma-custom-field', true )),$value->ID, true); ?>><?php echo get_the_title($value->ID); ?></option>
						<?php } ?>
						
					</select>
					<p><strong><?php _e('Please note','croma'); ?></strong><?php _e('The mega menu must be a top level item and can not have children underneath or parents above.','croma'); ?></p>
				</label>
			</p>
		<?php
	}


	/**
	 * Add our field to the screen options toggle
	 *
	 * To make this work, the field wrapper must have the class 'field-custom'
	 *
	 * @param array $columns Menu item columns
	 * @return array
	 */
	public static function _columns( $columns ) {
		$columns['custom'] = __( 'Select mega-menu part', 'croma' );

		return $columns;
	}
}
Cromax_MM_Actions::init();





