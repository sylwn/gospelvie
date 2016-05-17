<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>

<?php
/**
 * navigation and 2 banners
 *
 *
 * @author 		Croma
 * @package 	templates
 * @version     1.0
 */

?>



<div class="cro_mm_oneside cro_mm_nav_and_banners clearfix">


	<div class="cro_navside">

		<!-- start the header  -->
		<?php echo croma_meta_part( $cro_megamen, 
									'cro_navtitle-' . $nowmetatext, 
									'<h2 class="cro_hp_header">', 
									'</h2>'
								); ?>



		<?php echo croma_make_navlisting($cro_megamen, 'cro_nn1-' . $nowmetatext); ?>



	</div>



	<div class="cro_bannerside">


		<div class="cro_mm_imagetopban" style=" <?php echo croma_meta_makebgstyle($cro_megamen, 'cro_layimage1-' . $nowmetatext,'cro_third'); ?> ">

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


		<div class="cro_mm_imagebottomban" style=" <?php echo croma_meta_makebgstyle($cro_megamen, 'cro_layimage2-' . $nowmetatext,'cro_third'); ?> ">

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

</div>




