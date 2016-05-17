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


// format the label{
$link_src 			= get_post_meta( $id, 'cro_laylink', true );
$link_label 		= get_post_meta( $id, 'cro_laylabel', true );
$linkme 			= ($link_label != '' && $link_src != '')?  '<a href="' .  $link_src . '" class="cro_fpblog_linkme cro_cust_bg">' .  $link_label . '</a>':  '' ;



// format the categories and columns to display
$cats 				= get_post_meta( $id, 'cro_laycat', true );
$noposts 			= 2;
$args 				= ($cats == 0)? array( 'numberposts' => ($noposts + 1)) : array( 'numberposts' => ($noposts + 1), 'category'    => $cats) ;
$latestnewsposts 	= get_posts( $args );
$ctr = 1;




$title 				= (get_post_meta( $id, 'cro_maintitle', true ) != '')?  '<h2 class="cro_hp_header">' . get_post_meta( $id, 'cro_maintitle', true ) . '</h2>' : ''  ;

?>


<!-- start the section & add the foater -->
<section class="cro_frontpage_blg cro_frontpage_layout <?php echo $classname; ?>" <?php echo $bg; ?> >


	<div class="cro_blg_block">


		<div class="cro_prodmask" style="<?php echo $maskopacity; ?>"></div>

		<div class="cro_titleblock">
			<?php echo html_entity_decode($title); ?>
		</div>

		<!-- the loop for the categories -->
		<div class="row">
			<?php  
				foreach( $latestnewsposts as $post ) {	
					setup_postdata($post); 
					$cro_img 	= ($noposts == 1)? get_the_post_thumbnail($post->ID,'cro_third')  :   get_the_post_thumbnail($post->ID,'cro_third');
			?>

		
			<div class="large-4 columns <?php echo $cro_animclass; ?> cro_blgcol" <?php echo $cro_anim; ?> data-cro-anim-delay="<?php echo  200*$ctr ; ?>">
				<div class="cro_fp_latest_21">


					<!-- if there's an image, show it -->
					<?php if ($cro_img != '') { ?>
						<a href="<?php echo get_permalink($post->ID); ?>"  class="cro_blogimg"><?php echo $cro_img; ?></a>
					<?php } ?>


					<!-- show the title and the content -->
					<div class="cro_fp_latest_content">
						<h4 class="cro_cust_font">
							<a href="<?php echo get_permalink($post->ID); ?>">
								<?php the_title(); ?>
							</a>
						</h4>

						<?php echo cro_excerpt(15) ; ?>


						<div class="cro_time cro_homepage_header"><i class="icon-calendar cro_cust_col"></i> <?php the_time( get_option('date_format') ); ?></div>

					</div>
			
				</div>
			</div>

			<?php $ctr++; } ?>

		</div>

		<!-- do the link -->
		<div class="blg_titlebg">
			<?php echo $linkme; ?>		
		</div>

	</div>

</section>


