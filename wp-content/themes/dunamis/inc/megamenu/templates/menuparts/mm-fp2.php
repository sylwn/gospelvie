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



<div class="cro_mm_oneside clearfix">


	<div class="cro_navside">

		<!-- start the header  -->
		<?php echo croma_meta_part( $cro_megamen, 
									'cro_navtitle1-' . $nowmetatext, 
									'<h2 class="cro_hp_header">', 
									'</h2>'
								); ?>



		<?php echo croma_make_navlisting($cro_megamen, 'cro_nn1-' . $nowmetatext); ?>



	</div>




	<div class="cro_navside">

		<!-- start the header  -->
		<?php echo croma_meta_part( $cro_megamen, 
									'cro_navtitle2-' . $nowmetatext, 
									'<h2 class="cro_hp_header">', 
									'</h2>'
								); ?>



		<?php echo croma_make_navlisting($cro_megamen, 'cro_nn2-' . $nowmetatext); ?>



	</div>





</div>




