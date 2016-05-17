<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php
/**
 * Cromatheme ajax functions
 *
 *
 * @author   Cromatheme
 * @category  Core
 * @package  theme/inc
 * @version     1.0
 */




/**
 * Sort frontpage post order
 *
 * @access public
 * @return void
 */
function cromatic_update_fp_order() {

	
	 if (!wp_verify_nonce($_POST['nonce'], 'croma_themeadmin'))
    exit();

		$id 		= $_POST['idees'];
		$id 		= ltrim($id, "/");
		$arr_id 	= explode('/',$id);
		$arr_cnt 	= count($arr_id);
		for ($i = 1; $i <= $arr_cnt; $i++) {
			$b = $i - 1;
			update_post_meta($arr_id[$b], 'cromatic_post_order',$i);
		}

	die();
}

add_action( 'wp_ajax_cromatic_update_fp_order', 'cromatic_update_fp_order' );



?>
