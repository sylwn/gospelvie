<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>

<?php
/**
 * front page page  grid stack
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




// intro
$bgcolor    	=   (get_post_meta( $id, 'cro_bgcolor', true ) != '' )? 
				get_post_meta( $id, 'cro_bgcolor', true )
				: '#292C2F';

$txtcolor    	=   (get_post_meta( $id, 'cro_textcol', true ) != '' )? 
				get_post_meta( $id, 'cro_textcol', true )
				: '#fff';

$title			=   (get_post_meta( $id, 'cro_maintitle', true ) != '' )? 
				'<h2 style="color: ' . $txtcolor . ';" class="cro_hp_header">' . get_post_meta( $id, 'cro_maintitle', true ) . '</h2>'
				: '';

$content		=   (get_post_meta( $id, 'cro_laycnt1', true ) != '' )? 
				'<p style="color: ' . $txtcolor . ';" class="cro_hp_body">' . get_post_meta( $id, 'cro_laycnt1', true ) . '</p>'
				: '';




// image 1
$img1    		=   (get_post_meta( $id, 'cro_gridimg1', true ) != '' )? 
					get_post_meta( $id, 'cro_gridimg1', true )
					: '';

$imgid1 		=   cro_attachment_id_from_src ($img1);
$img1 			= 	wp_get_attachment_image_src( $imgid1, 'cro_landscape' );


$link1 			=   (get_post_meta( $id, 'cro_link1', true ) != '' )? 
					get_post_meta( $id, 'cro_link1', true )
					: '';

$target1 		=   (get_post_meta( $id, 'cro_linktarg1', true ) != '2' )? 
					'target="_blank"'
					: '';

$label1 		=   (get_post_meta( $id, 'cro_label1', true ) != '2' )? 
					get_post_meta( $id, 'cro_label1', true )
					: '';
$labelstring1   =   ($link1 != '' && $label1 != '')?
					'<a href="' . $link1 . '" ' . $target1 . '>' . $label1 . '</a>'
					: '';




// image 2
$img2    		=   (get_post_meta( $id, 'cro_gridimg2', true ) != '' )? 
					get_post_meta( $id, 'cro_gridimg2', true )
					: '';

$imgid2 		=   cro_attachment_id_from_src ($img2);
$img2 			= 	wp_get_attachment_image_src( $imgid2, 'cro_landscape' );


$link2 			=   (get_post_meta( $id, 'cro_link2', true ) != '' )? 
					get_post_meta( $id, 'cro_link2', true )
					: '';

$target2 		=   (get_post_meta( $id, 'cro_linktarg2', true ) != '2' )? 
					'target="_blank"'
					: '';

$label2 		=   (get_post_meta( $id, 'cro_label2', true ) != '2' )? 
					get_post_meta( $id, 'cro_label2', true )
					: '';
$labelstring2   =   ($link2 != '' && $label2 != '')?
					'<a href="' . $link2 . '" ' . $target2 . '>' . $label2 . '</a>'
					: '';



// image 3
$img3    		=   (get_post_meta( $id, 'cro_gridimg3', true ) != '' )? 
					get_post_meta( $id, 'cro_gridimg3', true )
					: '';

$imgid3 		=   cro_attachment_id_from_src ($img3);
$img3 			= 	wp_get_attachment_image_src( $imgid3, 'cro_landscape' );


$link3 			=   (get_post_meta( $id, 'cro_link3', true ) != '' )? 
					get_post_meta( $id, 'cro_link3', true )
					: '';

$target3 		=   (get_post_meta( $id, 'cro_linktarg3', true ) != '2' )? 
					'target="_blank"'
					: '';

$label3 		=   (get_post_meta( $id, 'cro_label3', true ) != '2' )? 
					get_post_meta( $id, 'cro_label3', true )
					: '';
$labelstring3   =   ($link3 != '' && $label3 != '')?
					'<a href="' . $link3 . '" ' . $target3 . '>' . $label3 . '</a>'
					: '';


// image 4
$img4    		=   (get_post_meta( $id, 'cro_gridimg4', true ) != '' )? 
					get_post_meta( $id, 'cro_gridimg4', true )
					: '';

$imgid4 		=   cro_attachment_id_from_src ($img4);
$img4 			= 	wp_get_attachment_image_src( $imgid4, 'cro_landscape' );

$link4 			=   (get_post_meta( $id, 'cro_link4', true ) != '' )? 
					get_post_meta( $id, 'cro_link4', true )
					: '';

$target4 		=   (get_post_meta( $id, 'cro_linktarg4', true ) != '2' )? 
					'target="_blank"'
					: '';

$label4 		=   (get_post_meta( $id, 'cro_label4', true ) != '2' )? 
					get_post_meta( $id, 'cro_label4', true )
					: '';
$labelstring4   =   ($link4 != '' && $label4 != '')?
					'<a href="' . $link4 . '" ' . $target4 . '>' . $label4 . '</a>'
					: '';


// image 5
$img5    		=   (get_post_meta( $id, 'cro_gridimg5', true ) != '' )? 
					get_post_meta( $id, 'cro_gridimg5', true )
					: '';

$imgid5 		=   cro_attachment_id_from_src ($img5);
$img5 			= 	wp_get_attachment_image_src( $imgid5, 'cro_half' );

$link5 			=   (get_post_meta( $id, 'cro_link5', true ) != '' )? 
					get_post_meta( $id, 'cro_link5', true )
					: '';

$target5 		=   (get_post_meta( $id, 'cro_linktarg5', true ) != '2' )? 
					'target="_blank"'
					: '';

$label5 		=   (get_post_meta( $id, 'cro_label5', true ) != '2' )? 
					get_post_meta( $id, 'cro_label5', true )
					: '';
$labelstring5   =   ($link5 != '' && $label5 != '')?
					'<a href="' . $link5 . '" ' . $target5 . '>' . $label5 . '</a>'
					: '';

?>


<!-- start the section & add the foater -->
<section class="cro_frontpage_grs cro_frontpage_layout">

	
	<!-- the loop for the categories -->
	<div class="row">


				<div class="large-12 column">

					<div class="cro_grs_grid clearfix">


						<div class="cro_halfone">

							<div class="cro_part40 cro_parttop <?php echo $cro_animclass; ?>" style="background: <?php echo $bgcolor; ?>;" <?php echo $cro_anim; ?> data-cro-anim-delay="250">
														
									<div class="cro_grcenter_outer">

										<div class="cro_grcenter_inner">
											
											<?php echo $title; ?>

											<?php echo $content; ?>

										</div>

									</div>

							</div>


							<div class="cro_part60 <?php echo $cro_animclass; ?>" <?php echo $cro_anim; ?> data-cro-anim-delay="300">
								

								<div class="cro_part60left"  style="background: url('<?php echo $img1[0]; ?>') no-repeat center;background-size: cover;" >


									<div class="cro_gr_labelholder">

										<?php echo $labelstring1; ?>

									</div>



								</div>

								<div class="cro_part60right <?php echo $cro_animclass; ?>" <?php echo $cro_anim; ?> data-cro-anim-delay="350">

									<div class="cro_part60rightinner" style="background: url('<?php echo $img2[0]; ?>') no-repeat center;background-size: cover;">

										<div class="cro_gr_labelholder">

											<?php echo $labelstring2; ?>

										</div>

									</div>

								</div>


							</div>


						</div>

						<div class="cro_halftwo">

							<div class="cro_halftwoinner">

								<div class="cro_part60 cro_parttop <?php echo $cro_animclass; ?>" <?php echo $cro_anim; ?> data-cro-anim-delay="400">


									<div class="cro_part60left" style="background: url('<?php echo $img3[0]; ?>') no-repeat center;background-size: cover;">
										
										<div class="cro_gr_labelholder">

											<?php echo $labelstring3; ?>

										</div>

									</div>

									<div class="cro_part60right <?php echo $cro_animclass; ?>" <?php echo $cro_anim; ?> data-cro-anim-delay="450">

									
										<div class="cro_part60rightinner" style="background: url('<?php echo $img4[0]; ?>') no-repeat center;background-size: cover;">

											<div class="cro_gr_labelholder">

												<?php echo $labelstring4; ?>

											</div>

										</div>

									</div>
									

								</div>


								<div class="cro_part40 <?php echo $cro_animclass; ?>" style="background: url('<?php echo $img5[0]; ?>') no-repeat center;background-size: cover;" <?php echo $cro_anim; ?> data-cro-anim-delay="500">
									

									<div class="cro_gr_labelholder">

										<?php echo $labelstring5; ?>

									</div>


								</div>


							</div>


						</div>

					</div>

		</div>
	</div>


</section>


