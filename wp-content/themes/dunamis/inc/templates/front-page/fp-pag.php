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




// format the title
$title 				= (get_post_meta( $id, 'cro_layhead1', true ) != '')? '<h3 class="cro_hp_header cro_header">' .  stripslashes(html_entity_decode(get_post_meta( $id, 'cro_layhead1', true )))  . '</h3>' : '' ;






// format the categories and columns to display
$pagetoshow 		= get_post_meta( $id, 'cro_laycat', true );
$croma_pbtest 		= get_post_meta( $pagetoshow, 'cromabox_yesnobar', true );



?>


<!-- start the section & add the foater -->
<section class="cro_frontpage_pag cro_frontpage_layout  <?php echo $classname; ?> ">

	
	<!-- the loop for the categories -->
	<div class="row">
		<div id="main">
			<div class="main singlemain cro_pagelayout clearfix">	
				<div class="large-12 column">

					<div class="pag_titlebg">
						<?php echo $title; ?>
					</div>


					<?php 
						if ($croma_pbtest == 1) {
							get_cromax_pagebuilder($pagetoshow);						
						} else { 
							$p_cn 			= get_post($pagetoshow);
							$p_classes 		= get_post_class('', $pagetoshow); 
							$p_classesout 	= '';
							foreach ($p_classes as $p_v) {
								$p_classesout .= $p_v . ' ';
							}
							?>
							<article id="post-<?php echo $pagetoshow; ?>" class="<?php echo $p_classesout; ?>">
								<div class="entry-content">
									<?php echo apply_filters('the_content', $p_cn->post_content); ?>
								</div>
							</article>

						<?php } ?>


				</div>
			</div>
		</div>
	</div>


</section>


