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

$userarray 		= array();


for ($i=1; $i < 7; $i++) { 
	if (get_post_meta( $id, 'cro_user' . $i , true ) != 0) {
		$userarray[] = get_post_meta( $id, 'cro_user' . $i , true );
	}
}



?>



<!-- START THE SECTION-->
<section class="cro_frontpage_peo cro_frontpage_layout">

	<ul>


	<?php 
	if (!empty($userarray)) { 

		foreach ($userarray as $value) {

			$userlargeimage = wp_get_attachment_image_src( get_user_meta( $value, 'cro_user_large_image', true ), 'full' );  

			$pastortitle 	= (get_the_author_meta( 'cro_user_designation', $value) != '')? '<h3 class="cro_cust_col cro_hp_body">' . stripslashes(html_entity_decode(get_the_author_meta( 'cro_user_designation', $value))) . '</h3>' : '' ;

			$pastordesc		= (get_the_author_meta( 'description', $value) != '')? '<p class="cro_hp_body">' . stripslashes(html_entity_decode(get_the_author_meta( 'description', $value))) . '</p>' : '' ;


	?>

		<li>
			<div class="cro_fppeo_outer">

				<div class="cro_fppeo_contentside">

				<h2 class="cro_hp_header"><?php echo get_the_author_meta( 'display_name', $value); ?></h2>
				<?php echo $pastortitle; ?>
				<?php echo $pastordesc; ?>


				</div>


				<div class="cro_fppeo_imageside" style="background: url(<?php echo $userlargeimage[0]; ?>) no-repeat center; background-size: cover;">



				</div>

			</div>

		</li>

	<?php } } ?>


	</ul>


</section>
