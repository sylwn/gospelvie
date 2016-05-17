<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>

<?php
/**
 * front page paypal payments
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


$title 		= (get_post_meta( $id, 'cro_title', true ) != '')? '<h3 class="cro_hp_body">' . stripslashes(html_entity_decode(get_post_meta( $id, 'cro_title', true ))) . '</h3>' : '' ;
$desc		= (get_post_meta( $id, 'cro_subtitle', true ) != '')? '<p class="cro_hp_body">' . stripslashes(html_entity_decode(get_post_meta( $id, 'cro_subtitle', true ))) . '</p>' : '' ;


$min		= (get_post_meta( $id, 'cro_laymin', true ) != '')? get_post_meta( $id, 'cro_laymin', true ) : 0 ;
$max		= (get_post_meta( $id, 'cro_laymax', true ) != '')? get_post_meta( $id, 'cro_laymax', true ) : 100 ;
$def		= (get_post_meta( $id, 'cro_laydef', true ) != '')? get_post_meta( $id, 'cro_laydef', true ) : 20;
$sign		= (get_post_meta( $id, 'cro_currsign', true ) != '')? get_post_meta( $id, 'cro_currsign', true ) : '$' ;
$code		= (get_post_meta( $id, 'cro_currcode', true ) != '')? get_post_meta( $id, 'cro_currcode', true ) : 'USD' ;
$repeat		= (get_post_meta( $id, 'cro_repdon', true ) != '')? get_post_meta( $id, 'cro_repdon', true ) : 1 ;
$position	= (get_post_meta( $id, 'cro_currpos', true ) != '')? get_post_meta( $id, 'cro_currpos', true ) : 1 ;


?>


<!-- start the section & add the foater -->
<section class="cro_frontpage_pay <?php echo $classname; ?> <?php echo $cro_animclass; ?>" <?php echo $cro_anim; ?>>


	<!-- do the title & link -->
	<div class="blg_titlebg">
		<div class="row">
			<div class="large-12 columns">

				<?php echo $title; ?>

				<?php echo $desc; ?>
				
				<?php echo do_shortcode('[croma-paypal min="' . $min . '" max="' . $max . '" def="' . $def . '" sign="' . $sign . '" curr="' . $code . '" repeat="' . $repeat . '" position="' . $position . '"]');  ?>
				
			</div>
		</div>
	</div>

</section>


