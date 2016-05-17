<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>

<?php
/**
 * 2 banners
 *
 *
 * @author 		Croma
 * @package 	templates
 * @version     1.0
 */


?>


<!-- start the section  -->
<div class="cro_mm_oneside cro_mm_2banners">


	<div class="cro_mm_image_2topside" style=" <?php echo croma_meta_makebgstyle($cro_megamen, 'cro_layimage1-' . $nowmetatext,'cro_third'); ?> ">
			
			<?php echo cro_makemask($cro_megamen, 'cro_bmask1-' . $nowmetatext, 'cro_bgcolor1-' . $nowmetatext); ?>

			<?php echo croma_meta_makelink ( 	$cro_megamen, 
										'cro_laylink1-' . $nowmetatext, 
										'cro_laytitle1-' . $nowmetatext, 
										'',
										'', 
										'', 
										'<h5 class="cro_cust_font">', 
										'</h5>'
									); ?>

	</div>


	<div class="cro_mm_image_2bottomside" style=" <?php echo croma_meta_makebgstyle($cro_megamen, 'cro_layimage2-' . $nowmetatext,'cro_third'); ?> ">
			
			<?php echo cro_makemask($cro_megamen, 'cro_bgmask2-' . $nowmetatext, 'cro_bgcolor2-' . $nowmetatext); ?>

			<?php echo croma_meta_makelink ( 	$cro_megamen, 
										'cro_laylink2-' . $nowmetatext, 
										'cro_laytitle2-' . $nowmetatext, 
										'',
										'', 
										'', 
										'<h5 class="cro_cust_font">', 
										'</h5>'
									); ?>

	</div>







</div>




