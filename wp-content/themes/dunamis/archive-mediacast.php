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



?>


<?php get_template_part( 'inc/templates/cromaheader'); ?>

	<div class="main singleitem">				
		<div class="row singlepage">
						

			<!-- structure for the main content part -->
			<div class="large-8 column">
				<div class="croma_pad_left cro_mediacast_post">
					<?php 
						while ( have_posts() ) : the_post();
							get_template_part( 'inc/templates/content-mediacast'); 
						endwhile; 
						cro_paging();
					?>
				</div>
			</div>


			<div class="large-4 column">
					<?php get_sidebar('mediacast'); ?>
			</div>	

		
		</div>
	</div>



<?php get_footer(); ?>