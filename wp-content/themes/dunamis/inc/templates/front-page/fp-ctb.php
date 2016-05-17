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
$bg 			= ($float_image != '')?  'style="background: url('  .   $float_image  .   ') no-repeat center top fixed; background-size: cover; position: static;overflow: hidden;"'  : '' ;


// get & process the mask
$mask 			= get_post_meta( $id, 'cro_laymask', true );
$maskcolor		= get_post_meta( $id, 'cro_maskcolor', true );
$maskstyle   	= ($maskcolor != '')?  ' background: ' . $maskcolor . '; ' : ''  ;
$maskopacity 	= $maskstyle . ' opacity:   '   .   ($mask/100)  .  '; ';



$textcol 		= (get_post_meta( $id, 'cro_laytxtcolor', true ) != '')?  ' color: ' . stripslashes(html_entity_decode(get_post_meta( $id, 'cro_laytxtcolor', true ))). '; ' : ''  ;




// handle the title and content
$title 			= (get_post_meta( $id, 'cro_laytitle', true ) != '')?  '<h2 class="cro_hp_header" style="' . $textcol . '">' . stripslashes(html_entity_decode(get_post_meta( $id, 'cro_laytitle', true ))). '</h2>' : ''  ;
$desc 			= (get_post_meta( $id, 'cro_laydesc', true ) != '')?  '<p class="cro_hp_body" style="' . $textcol . '">' . stripslashes(html_entity_decode(get_post_meta( $id, 'cro_laydesc', true ))). '</p>' : ''  ;


// handle links
$link_dest 		= get_post_meta( $id, 'cro_laylink', true );
$link_label 	= get_post_meta( $id, 'cro_laylabel', true );
$link_label 	= ($link_label != '')? $link_label : '';
$linktext 		= ($link_dest != ''  && $link_label != '' )?  '<p class="cro_fp_linkp"><a href="' . $link_dest   . '" class="cro_cust_bg" >' . $link_label   . '</a></p>'  :  '';


// render complete page content
$page_content =  $title . $desc . $linktext;

?>


<!-- render the section and the background -->
<section class="cro_frontpage_ctb cro_frontpage_layout <?php echo $classname; ?> cro_parra" <?php echo $bg; ?> data-cro-parra="true">

	<div class="cro_ctb_block">

		<div class="cro_prodmask" style="<?php echo $maskopacity; ?>"></div>


		<div class="row">

			<div class="large-12 columns <?php echo $cro_animclass; ?>" <?php echo $cro_anim; ?> data-cro-anim-delay="400">
				<?php echo $page_content; ?>
			</div>

		</div>

	</div>

</section>


