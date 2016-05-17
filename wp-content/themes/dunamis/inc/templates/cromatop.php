<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>

<?php
/**
 * The template for top part above the logo
 *
 *
 * @author 		Croma
 * @package 	templates
 * @version     1.0
 */

$croma = get_option( 'cromatic');

$firstmessage = '';

?>
 <div class="topbar">
 	<div class="container">
 		<div class="row">

 			<!-- topbar message -->
 			<div class="large-6 columns">
 				<p class="cro_cust_font">
 					<?php echo stripslashes(html_entity_decode(esc_textarea($croma['cro_topbartext']))); ?>
 				</p>
 			</div>

			<!-- topbar text -->
 			<div class="large-6 columns">
				<?php echo cro_get_sociallist(); ?>
 			</div>

 		</div>
 	</div>
</div>
