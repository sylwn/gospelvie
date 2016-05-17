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



<div class="cro_mm_oneside cro_mm_3banner">


	<div class="cro_mm_imagetopside clearfix">

		<div class="cro_mm_imagerightside" style=" <?php echo croma_meta_makebgstyle($cro_megamen, 'cro_layimage2-' . $nowmetatext,'cro_third'); ?> ">
			
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


		<div class="cro_mm_imageleftside" style=" <?php echo croma_meta_makebgstyle($cro_megamen, 'cro_layimage1-' . $nowmetatext,'cro_third'); ?> ">

			<?php echo cro_makemask($cro_megamen, 'cro_bgmask1-' . $nowmetatext, 'cro_bgcolor1-' . $nowmetatext); ?>

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

	</div>

	<div class="cro_mm_imagebottomside">

		<div class="cro_mm_imagebottom" style=" <?php echo croma_meta_makebgstyle($cro_megamen, 'cro_layimage3-' . $nowmetatext,'cro_third'); ?> ">

			<?php echo cro_makemask($cro_megamen, 'cro_bgmask3-' . $nowmetatext, 'cro_bgcolor3-' . $nowmetatext); ?>

			<?php echo croma_meta_makelink ( 	$cro_megamen, 
										'cro_laylink3-' . $nowmetatext, 
										'cro_laytitle3-' . $nowmetatext, 
										'',
										'', 
										'', 
										'<h3 class="cro_cust_font">', 
										'</h3>'
									); ?>

		</div>

	</div>

</div>


