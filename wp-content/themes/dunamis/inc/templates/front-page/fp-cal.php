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
$animarr 			= array('','none','bounce','flash','pulse','rubberBand','shake','swing','tada','wobble','bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp','bounceO','fadeInRightBig','fadeInUp','fadeInUpBig','flip','flipInX','flipInY','Lightspeed','lightSpeedIn','rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight','slideInDown','slideInLeft','slideInRight','hinge','rollIn');

$cro_anim  			=   (get_post_meta( $id, 'cro_anim', true ) != '' || get_post_meta( $id, 'cro_anim', true ) != 0 )? 
					'data-cro-anim-data="' . $animarr[get_post_meta( $id, 'cro_anim', true )] . '"' 
					: '';
				
$cro_animclass  	=   (get_post_meta( $id, 'cro_anim', true ) != '' || get_post_meta( $id, 'cro_anim', true ) != 0 )? 
					' animated ' 
					: '';





// format the title
$title 				= (get_post_meta( $id, 'cro_layhead', true ) != '')? '<h3 class="cro_cust_font cro_header">' .  stripslashes(html_entity_decode(get_post_meta( $id, 'cro_layhead', true )))  . '</h3>' : '' ;



// format the content
$content 			= (get_post_meta( $id, 'cro_laycnt1', true ) != '')? '<p class="cro_intro">' .  stripslashes(html_entity_decode(get_post_meta( $id, 'cro_laycnt1', true )))  . '</p>' : '' ;




// format the label{
$link_src 			= get_post_meta( $id, 'cro_laylink', true );
$link_label 		= get_post_meta( $id, 'cro_laylabel', true );
$linkme 			= ($link_label != '' && $link_src != '')?  '<a href="' .  $link_src . '" class="cro_fpblog_linkme cro_cust_font">' .  $link_label . '</a>':  '' ;



// number of events to show
$eventstoshow 		= (get_post_meta( $id, 'cro_evtoshow', true )  != '')? get_post_meta( $id, 'cro_evtoshow', true ) : 0;

$op 				= cromax_fetch_upc_events($eventstoshow, $cro_anim, 200, $cro_animclass);


?>


<!-- start the section & add the foater -->
<section class="cro_frontpage_cal cro_frontpage_layout <?php echo $classname; ?>" >



	<!-- render the section -->
	<div class="row">
		<div class="large-12 columns <?php echo $cro_animclass; ?>" <?php echo $cro_anim; ?>>
				<?php echo $title; ?>
				<?php echo $content; ?>
				<?php echo $op; ?>
				<div class="cro_directional">
					<div class="cro_wprev"> <i class="icon-chevron-left cro_cust_bg"></i></div>
					<div class="cro_wnext"><i class="icon-chevron-right cro_cust_bg"></i></div>
				</div>
				<div class="splinkme">
					<?php echo $linkme; ?>
				</div>
		</div>
	</div>

</section>


