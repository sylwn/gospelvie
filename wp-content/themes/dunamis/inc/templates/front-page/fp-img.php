<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>

<?php
/**
 * front image banner blocks
 *
 *
 * @author 		Croma
 * @package 	templates
 * @version     1.0
 */

// front page animation
$animarr 		= array('','none','bounce','flash','pulse','rubberBand','shake','swing','tada','wobble','bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp','bounceO','fadeInRightBig','fadeInUp','fadeInUpBig','flip','flipInX','flipInY','Lightspeed','lightSpeedIn','rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight','slideInDown','slideInLeft','slideInRight','hinge','rollIn');

$cro_anim  		=   (get_post_meta( $id, 'cro_anim', true ) != '' || get_post_meta( $id, 'cro_anim', true ) != 0 )? 
				'data-cro-anim-data="' . $animarr[get_post_meta( $id, 'cro_anim', true )] . '"' 
				: '';
				
$cro_animclass  =   (get_post_meta( $id, 'cro_anim', true ) != '' || get_post_meta( $id, 'cro_anim', true ) != 0 )? 
				' animated ' 
				: '';



// format background color
$bg_col			=  (get_post_meta( $id, 'cro_maskcolor', true ) != '' )? 
					' background: ' .get_post_meta( $id, 'cro_maskcolor', true ) . ' '
					: ' background: #fff; ';





?>



<!-- START THE SECTION-->
<section class="cro_frontpage_img cro_frontpage_layout clearfix" style="<?php echo $bg_col; ?>">
	<ul>

	
		<!-- GET THE VALRIABLES FOR THE FIRST IMAGE-->
		<?php 
			if (get_post_meta( $id, 'cro_banimg1', true ) != '') { 
			$imgurl 	= get_post_meta( $id, 'cro_banimg1', true ); 
			$imid 		= cro_attachment_id_from_src ($imgurl);
			if ($imgurl !== '' && !isset($imid)) {
				$theimg1 = '<img src="' . $imgurl . '" alt="image">';
			} else {
			    $theimg1 = wp_get_attachment_image($imid,'cro_third');
			}
			$imtarg 	= get_post_meta( $id, 'cro_linktarg1', true ); 
			$linktarg 	= (get_post_meta( $id, 'cro_link1', true ) != '')? get_post_meta( $id, 'cro_link1', true ) : '' ;
		?> 

		<!-- SET THE HTML FOR THE FIRST IMAGE-->
		<li class="cro_fpage_img" data-cro-linker="<?php echo $linktarg; ?>" data-cro-linktarg="<?php echo $imtarg; ?>">
			<div class="cro_imginner">
			
				<?php echo $theimg1 ?>
				<div class="cro_img_textpart">
					<?php echo croma_meta_part ($id, 'cro_title1', '<h2 class="cro_hp_header ' . $cro_animclass . '" ' .  $cro_anim  . ' >', '</h2>'); ?>
					<?php echo croma_meta_part ($id, 'cro_subtitle1', '<h3 class="cro_hp_body cro_cust_bg ' . $cro_animclass . '"  ' .  $cro_anim  . ' >', '</h3>'); ?>
				</div>

			</div>

		</li>

		<?php } ?>



		<!-- GET THE VALRIABLES FOR THE SECOND IMAGE-->
		<?php 
			if (get_post_meta( $id, 'cro_banimg2', true ) != '') { 
			$imgurl 	= get_post_meta( $id, 'cro_banimg2', true ); 
			$imid 		= cro_attachment_id_from_src ($imgurl);
			if ($imgurl !== '' && !isset($imid)) {
				$theimg1 = '<img src="' . $imgurl . '" alt="image">';
			} else {
			    $theimg1 = wp_get_attachment_image($imid,'cro_third');
			}
			$imtarg 	= get_post_meta( $id, 'cro_linktarg2', true ); 
			$linktarg 	= (get_post_meta( $id, 'cro_link2', true ) != '')? get_post_meta( $id, 'cro_link2', true ) : '' ;
		?> 


		<!-- SET THE HTML FOR THE SECOND IMAGE-->
		<li class="cro_fpage_img" data-cro-linker="<?php echo $linktarg; ?>" data-cro-linktarg="<?php echo $imtarg; ?>">

			<div class="cro_imginner">
			
				<?php echo $theimg1 ?>
				<div class="cro_img_textpart">
					<?php echo croma_meta_part ($id, 'cro_title2', '<h2 class="cro_hp_header ' . $cro_animclass . '"  ' .  $cro_anim  . '  data-cro-anim-delay="150">', '</h2>'); ?>
					<?php echo croma_meta_part ($id, 'cro_subtitle2', '<h3 class="cro_hp_body cro_cust_bg ' . $cro_animclass . '"  ' .  $cro_anim  . '  data-cro-anim-delay="150">', '</h3>'); ?>
				</div>

			</div>

		</li>

		<?php } ?>



		<!-- GET THE VALRIABLES FOR THE THIRD IMAGE-->
		<?php 
			if (get_post_meta( $id, 'cro_banimg3', true ) != '') { 
			$imgurl 	= get_post_meta( $id, 'cro_banimg3', true ); 
			$imid 		= cro_attachment_id_from_src ($imgurl);
			if ($imgurl !== '' && !isset($imid)) {
				$theimg1 = '<img src="' . $imgurl . '" alt="image">';
			} else {
			    $theimg1 = wp_get_attachment_image($imid,'cro_third');
			}
			$imtarg 	= get_post_meta( $id, 'cro_linktarg3', true ); 
			$linktarg 	= (get_post_meta( $id, 'cro_link3', true ) != '')? get_post_meta( $id, 'cro_link3', true ) : '' ;
		?> 


		<!-- SET THE HTML FOR THE THIRD IMAGE-->
		<li class="cro_fpage_img" data-cro-linker="<?php echo $linktarg; ?>" data-cro-linktarg="<?php echo $imtarg; ?>">
			<div class="cro_imginner">
				<?php echo $theimg1 ?>
				<div class="cro_img_textpart">
					<?php echo croma_meta_part ($id, 'cro_title3', '<h2 class="cro_hp_header ' . $cro_animclass . '"  ' .  $cro_anim  . ' data-cro-anim-delay="300">', '</h2>'); ?>
					<?php echo croma_meta_part ($id, 'cro_subtitle3', '<h3 class="cro_hp_body cro_cust_bg ' . $cro_animclass . '"  ' .  $cro_anim  . '  data-cro-anim-delay="300">', '</h3>'); ?>
				</div>
			</div>
		</li>

		<?php } ?>
	
	</ul>
</section>
