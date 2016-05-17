<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>

<?php
/**
 * front page page link
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



// get the background image & process
$float_image 	= get_post_meta( $id, 'cro_layimage', true );
$bg 			= ($float_image != '')?  'style="background: url('  .   $float_image  .   ') no-repeat center top; overflow: hidden;"'  : '' ;


// get & process the mask
$mask 			= get_post_meta( $id, 'cro_laymask', true );
$maskcolor		= get_post_meta( $id, 'cro_maskcolor', true );
$maskstyle   	= ($maskcolor != '')?  ' background: ' . $maskcolor . '; ' : ''  ;
$maskopacity 	= $maskstyle . ' opacity:   '   .   ($mask/100)  .  '; ';



$textcol 		= (get_post_meta( $id, 'cro_textcolor', true ) != '')?  ' color: ' . stripslashes(html_entity_decode(get_post_meta( $id, 'cro_textcolor', true ))). '; ' : ''  ;
$cro_maintitle 	= (get_post_meta( $id, 'cro_maintitle', true ) != '')?  stripslashes(html_entity_decode(get_post_meta( $id, 'cro_maintitle', true ))) : ''  ;




// handle links
$link_dest 		= get_post_meta( $id, 'cro_laylink', true );
$link_label 	= get_post_meta( $id, 'cro_laylabel', true );
$link_label 	= ($link_label != '')? $link_label : '';
$linkcolor 		= (get_post_meta( $id, 'cro_buttcol', true ) != '')?  ' color: ' . stripslashes(html_entity_decode(get_post_meta( $id, 'cro_buttcol', true ))). '; ' : ' color:  #fff; '  ;
$linkbg 		= (get_post_meta( $id, 'cro_buttbg', true ) != '')?  ' background: ' . stripslashes(html_entity_decode(get_post_meta( $id, 'cro_buttbg', true ))). '; ' : ' background:  #000; '  ;
$linktext 		= ($link_dest != ''  && $link_label != '' )?  '<a href="' . $link_dest   . '" class="cro_cust_font" style="' .  $linkcolor . $linkbg . '">' . $link_label   . '</a>'  :  '';




?>



<section class="cro_frontpage_cta cro_frontpage_layout" <?php echo $bg; ?>>

	<div class="cro_cta_block">

		<div class="cro_prodmask" style="<?php echo $maskopacity; ?>"></div>

		<div class="container">

			<div class="row <?php echo $cro_animclass; ?>" <?php echo $cro_anim; ?> data-cro-anim-delay="400">

				<div class="large-9 columns cro_titleside" style="<?php echo $textcol; ?>"><?php echo $cro_maintitle; ?></div>

				<div class="large-3 columns" style="text-align: right;"><?php echo $linktext; ?></div>

			</div>

		</div>

	</div>

</section>


