<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>

<?php
/**
 * 2 latest news posts
 *
 *
 * @author 		Croma
 * @package 	templates
 * @version     1.0
 */



?>


<!-- start the section  -->
<div class="cro_mm_oneside cro_mm_latestnews">


	<div class="cro_mm_image_bigban" style=" <?php echo croma_meta_makebgstyle($cro_megamen, 'cro_layimage1-' . $nowmetatext,'cro_third'); ?> ">

	<?php echo cro_makemask($cro_megamen, 'cro_bgmask1-' . $nowmetatext, 'cro_bgcolor1-' . $nowmetatext); ?>

	<!-- start the header  -->
	<?php echo croma_meta_part     ( 	$cro_megamen, 
										'cro_laytitle1-' . $nowmetatext, 
										'<h2 class="cro_hp_body cro_bigban_header">', 
										'</h2>'
									); ?>


	<!-- start the link  -->
	<?php echo croma_meta_makeinfolink ( 	$cro_megamen, 
										'cro_link1-' . $nowmetatext, 
										'cro_title1-' . $nowmetatext, 
										'',
										'', 
										'', 
										'<h5 class="cro_mm_bigban_subhead">', 
										'</h5>'
									); ?>


	<!-- start the link  -->
	<?php echo croma_meta_makeinfolink ( 	$cro_megamen, 
										'cro_link1-' . $nowmetatext, 
										'cro_info1-' . $nowmetatext, 
										'',
										'', 
										'', 
										'<p class="cro_mm_bigban_subinfo">', 
										'</p>'
									); ?>


	<!-- start the link  -->
	<?php echo croma_meta_makeinfolink ( 	$cro_megamen, 
										'cro_link2-' . $nowmetatext, 
										'cro_title2-' . $nowmetatext, 
										'',
										'', 
										'', 
										'<h5 class="cro_mm_bigban_subhead">', 
										'</h5>'
									); ?>


	<!-- start the link  -->
	<?php echo croma_meta_makeinfolink ( 	$cro_megamen, 
										'cro_link2-' . $nowmetatext, 
										'cro_info2-' . $nowmetatext, 
										'',
										'', 
										'', 
										'<p class="cro_mm_bigban_subinfo">', 
										'</p>'
									); ?>



	<!-- start the link  -->
	<?php echo croma_meta_makelink ( 	$cro_megamen, 
										'cro_link3-' . $nowmetatext, 
										'cro_title3-' . $nowmetatext, 
										'',
										'', 
										'', 
										'<h5 class="cro_mm_bigban_subhead">', 
										'</h5>'
									); ?>


	<!-- start the link  -->
	<?php echo croma_meta_makelink ( 	$cro_megamen, 
										'cro_link3-' . $nowmetatext, 
										'cro_info3-' . $nowmetatext, 
										'',
										'', 
										'', 
										'<p class="cro_mm_bigban_subinfo">', 
										'</p>'
									); ?>



	</div>



</div>




