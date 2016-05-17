<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 *
 * cromax-mediacast-users
 * 
 * @author  	AJ aj@cro.ma
 * @package 	Cromax
 * @category 	mediacast
 * @copyright 	Copyright (c) 2014, Alwyn Kotze & Croma
 * @version 	1.0
 * @since 		1.0
 * @uses 		user management for the mediacast
 */



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly




/**
 * FUNCTION : cromax_mediacast_profile_fields - 
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		add additional fields ot the user profile
 */




// add the user profiles for the edit and show pages
add_action( 'show_user_profile', 'cromax_mediacast_profile_fields' );
add_action( 'edit_user_profile', 'cromax_mediacast_profile_fields' );



function cromax_mediacast_profile_fields( $user ) { 
?>

	<!-- header for the section -->
	<h3><?php _e('Mediacast additional info','croma'); ?></h3>


	<!-- table for the selectbox -->
	<table class="form-table">

		<tr>
			<th><label for="Status"><?php _e('Status','croma'); ?></label></th>

			<td>

				<!-- sleect box for user status -->
				<select name="cro-userstatus" id="cro-userstatus" >
					<option value="0" <?php selected( esc_attr( get_the_author_meta( 'cro-userstatus', $user->ID ) ), 0, true ); ?> ><?php _e('Not a mediacaster or member','croma'); ?></option>
					<option value="1" <?php selected( esc_attr( get_the_author_meta( 'cro-userstatus', $user->ID ) ), 1, true ); ?> ><?php _e('Member and not mediacaster','croma'); ?></option>
					<option value="2" <?php selected( esc_attr( get_the_author_meta( 'cro-userstatus', $user->ID ) ), 2, true ); ?> ><?php _e('Member and Mediacaster','croma'); ?></option>
				</select><br/>
				<span class="description"><?php _e('Select this users status','croma'); ?></span>

			</td>
		</tr>


		<tr>
			<th><label for="Image"><?php _e('Thumbnail','croma'); ?></label></th>

			<td class="cro_buttonparent">

				<button class="cro_user_large_button button" type="button">
					<?php _e('Choose thumbnail','croma'); ?>
				</button>

				<div class="cro_imgholder"><?php echo  wp_get_attachment_image( esc_attr( get_the_author_meta( 'cro_user_small_image', $user->ID ) ), 'thumbnail'); ?></div>

				<input name="cro_user_small_image" type="hidden" value="<?php echo  esc_attr( get_the_author_meta( 'cro_user_small_image', $user->ID ) ); ?>" />
				
				<button class="cro_user_clear_button button" type="button">
					<?php _e('Clear Image','croma'); ?>
				</button>

				<br/>

				<span class="description"><?php _e('Select a thumbnail','croma'); ?></span>


			</td>
		</tr>

	</table><!-- form-table -->
<?php }




/**
 * FUNCTION : cromax_save_extra_profile_fields - 
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		save the additional fields to the form
 */



// add the save actions for the user update and edit field
add_action( 'personal_options_update', 'cromax_save_mediacast_profile_fields' );
add_action( 'edit_user_profile_update', 'cromax_save_mediacast_profile_fields' );



function cromax_save_mediacast_profile_fields( $user_id ) {

	update_option('cro_test',$_POST['cro-userstatus']);

	if ( !current_user_can( 'edit_user', $user_id ) ) { return false; }

	update_user_meta( $user_id, 'cro-userstatus', $_POST['cro-userstatus'] );
	update_user_meta( $user_id, 'cro_user_small_image', $_POST['cro_user_small_image'] );
}




/**
 * FUNCTION : cro_preachers_available - 
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		true if there's preachers registered
 */

function cro_preachers_available() {
	 
	 foreach (get_users() as $value) {
	 	if (  esc_attr(get_the_author_meta( 'cro-userstatus', $value->ID )) == 2 ){
	 		return true;
	 	}
	 }

	 return false;
}







/**
 * FUNCTION : cro_fetch_userarray - 
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		fetch an array to get all the members for the personell pages. 
 */

function cro_fetch_userarray($number){


	$returnarray = array();


	foreach (get_users() as $value) {
	 	if (  esc_attr(get_the_author_meta( 'cro-userstatus', $value->ID )) >= $number ){
	 		$returnarray[] = $value->ID;
	 	}
	 }


	return $returnarray;

}



/**
 * FUNCTION : cro_user_enqueue - 
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		fetch an array to get all the members for the personell pages. 
 */



add_action('admin_print_scripts-profile.php', 'cro_user_enqueue');
add_action('admin_print_scripts-user-edit.php', 'cro_user_enqueue');


function cro_user_enqueue() {

	$purl 				= untrailingslashit( plugins_url( '/', __FILE__ ) );
	wp_enqueue_media();
	wp_enqueue_style( 'cro-options', $purl . '/assets/cro-user-style.css', false, '2012-08-01' );
	wp_enqueue_script( 'cro_user_scripts', $purl . '/assets/js/cro_userscripts.js', array('jquery') );

}


add_filter('posts_where', 'cromax_include_for_author');

function cromax_include_for_author($where){
	if(is_author())
		$where = str_replace(".post_type = 'post'", ".post_type in ('mediacast')", $where);
        return $where;
    }

