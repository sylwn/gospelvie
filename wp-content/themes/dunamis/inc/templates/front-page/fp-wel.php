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




// get the background image & process
$float_image 	= get_post_meta( $id, 'cro_layimage', true );
$bg 			= ($float_image != '')?  'style="background: #fff url('  .   $float_image  .   ') no-repeat center; background-size: cover;"'  : '' ;


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
$noposts 			= get_post_meta( $id, 'cro_newscolumn', true );
$columns			= 4;
$args 				= ($cats == 0)? array( 'numberposts' => ($noposts + 1)) : array( 'numberposts' => ($noposts + 1), 'category'    => $cats) ;
$latestnewsposts 	= get_posts( $args );
$ctr = 1;




// date controller
$croma 				= get_option('cromatic');


$title 				= (get_post_meta( $id, 'cro_maintitle', true ) != '')?  '<h2 class="cro_hp_header">' . get_post_meta( $id, 'cro_maintitle', true ) . '</h2>' : ''  ;

$subtitle 			= (get_post_meta( $id, 'cro_subtitle', true ) != '')?  '<h6 class="cro_hp_header">' . get_post_meta( $id, 'cro_subtitle', true ) . '</h6>' : ''  ;



// format the categories and columns to display
$pagetoshow 		= get_post_meta( $id, 'cro_laypage', true );
$croma_pbtest 		= get_post_meta( $pagetoshow, 'cromabox_yesnobar', true );

?>


<!-- start the section & add the foater -->
<section class="cro_frontpage_wel <?php echo $classname; ?>">



	<div class="cro_twothirds">

		<div class="cro_titleblock">
			<?php echo html_entity_decode($title); ?>
			<?php echo html_entity_decode($subtitle); ?>
		</div>



		<div class="cro_bodyblock">


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


	<div class="cro_onethird" <?php echo $bg; ?>>



	</div>


</section>


