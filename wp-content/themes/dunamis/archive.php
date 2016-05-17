<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}


/**
 * The archive template file.
 *
 *
 * @package Croma.framework
 * @subpackage Croma.framework
 * @since 1.0
 */

get_header(); 




// set up the needed valriables
$croma 			= get_option('cromatic');
$sidebarrule 	= (isset($croma['cro_catsidebar']))?  esc_attr($croma['cro_catsidebar']) :  3 ;
$sidebarclass 	= ($sidebarrule == 2)? 'large-12' : 'large-8' ;
$padclass 		= ($sidebarrule == 1)? 'croma_pad_left' : 'croma_pad_right' ;
$padclass 		= ($sidebarrule == 2)? '' : $padclass;



?>


<?php get_template_part( 'inc/templates/cromaheader'); ?>

	<div class="main singleitem">				
		<div class="row singlepage">
						
			<!-- structure for the page with left sidebar -->
			<?php if ($sidebarrule == 1) { ?>
			<div class="large-4 column">
				<?php get_sidebar(); ?>
			</div>	
			<?php } ?>



			<!-- structure for the main content part -->
			<div class="<?php echo $sidebarclass; ?> column">
				<div class="<?php echo $padclass; ?>">
					<?php 
						while ( have_posts() ) : the_post();
							get_template_part( 'inc/templates/content', get_post_format()); 
						endwhile; 
						cro_paging();
					?>
				</div>
			</div>



			<!-- structure for the page with left sidebar -->
			<?php if ($sidebarrule != 1 && $sidebarrule != 2) { ?>
				<div class="large-4 column">
					<?php get_sidebar(); ?>
				</div>	
			<?php } ?>

		
		</div>
	</div>



<?php get_footer(); ?>