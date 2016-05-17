<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>

<?php
/**
 * front 3 banners
 *
 *
 * @author 		Croma
 * @package 	templates
 * @version     1.0
 */

?>


<!-- start the section  -->
<div class="cro_mm_oneside cro_mm_introtext">



	<!-- start the header  -->
	<?php echo croma_meta_part     ( 	$cro_megamen, 
										'cro_layhead-' . $nowmetatext, 
										'<h2 class="cro_hp_header">', 
										'</h2>'
									); ?>


	<!--  start the body -->
	<?php echo croma_meta_part 	   ( 	$cro_megamen, 
										'cro_laycnt-' . $nowmetatext, 
										'<p class="cro_hp_body">', 
										'</p>'
									); ?>


	<!-- start the link  -->
	<?php echo croma_meta_makelink ( 	$cro_megamen, 
										'cro_laylink-' . $nowmetatext, 
										'cro_laylabel-' . $nowmetatext, 
										'cro_textcolor-' . $nowmetatext,
										'cro_bgcolor-' . $nowmetatext, 
										'', 
										'<p class="cro_mm_textlink">', 
										'</p>'
									); ?>



</div>




