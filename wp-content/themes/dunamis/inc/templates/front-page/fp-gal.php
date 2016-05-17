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



$postarr = get_post_custom($id);


// front page animation
$cro_anim  			=   (isset($postarr['cro_anim'][0]) && $postarr['cro_anim'][0] != 0 )? 
						'data-cro-anim-data="' . $animarr[$postarr['cro_anim'][0]] . '"' : '';	
$cro_animclass  	=   ($cro_anim != '' )? ' animated ' : '';




// format the title
$title 				= (get_post_meta( $id, 'cro_maintitle', true ) != '')? '<h3 class="cro_cust_font cro_header">' .  stripslashes(html_entity_decode(get_post_meta( $id, 'cro_maintitle', true )))  . '</h3>' : '' ;




// get the gallery images
$result 			= cro_get_gallerylist(get_post_meta( $id, 'cro_galpage', true ));
$cctr 				= 1;


// add the number of gallery items to show
$itemstoshow 		= $postarr['cro_toshow'][0];

?>


<!-- start the section & add the foater -->
<section class="cro_frontpage_gal <?php echo $classname; ?>" data-cro-showgals="<?php echo $itemstoshow; ?>">


	<!-- do the title & link -->
	<div class="blg_titlebg">

				<?php echo $title; ?>

				<?php if ( !empty($result ) ) { ?>

					<ul class="cro_gallery_outer clearfix">
						
						<?php foreach ($result as $vv) { 


							$titlemeta = wp_prepare_attachment_for_js( $vv );
							if ($cctr == 1 || $cctr == 5 || $cctr == 9) {
								$tid = wp_get_attachment_image_src( $vv, 'cro_img_half');
								$ctr_class = 'half';
								
							} else {
								$tid = wp_get_attachment_image_src( $vv, 'cro_img_ban');
								$ctr_class = '';
							}
							$lid = wp_get_attachment_image_src( $vv, 'full');

						?>

							<li  class="<?php echo $cro_animclass; ?> <?php echo $ctr_class; ?>"  <?php echo $cro_anim; ?>  data-cro-anim-delay="<?php echo  120*$cctr ; ?>"><a href="<?php echo $lid[0]; ?>"><img src="<?php echo $tid[0]; ?>" alt="image" data-cro-title="<?php echo $titlemeta['title'] ; ?>"></a></li>

						<?php 

						$cctr++;

						} 

						?>

					</ul>

				<?php }  ?>
				
	</div>

</section>


