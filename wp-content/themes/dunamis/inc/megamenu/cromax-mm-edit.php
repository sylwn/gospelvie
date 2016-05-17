<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php

/**
 * create a custom walker
 *
 *
 * @package Croma.framework
 * @subpackage Croma.framework
 * @since 1.0
 */


class Croma_MM_Fields_Walker extends Walker_Nav_Menu_Edit {

	/**
	 * Start the element output.
	 *
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$item_output = '';
		parent::start_el( $item_output, $item, $depth, $args, $id );
		$output .= preg_replace(
			// NOTE: Check this regex from time to time!
			'/(?=<p[^>]+class="[^"]*field-move)/',
			$this->get_fields( $item, $depth, $args ),
			$item_output
		);
	}


	/**
	 * Get custom fields
	 *
	 *
	 * @return string Form fields
	 */
	protected function get_fields( $item, $depth, $args = array(), $id = 0 ) {
		ob_start();

		do_action( 'croma_mm_custom_fields', $item, $depth, $args, $id );

		return ob_get_clean();
	}
}
