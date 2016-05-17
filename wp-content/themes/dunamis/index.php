<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?><?php
/**
 * The main template file.
 *
 *
 * @package Croma.framework
 * @subpackage Croma.framework
 * @since 1.0
 */

get_header(); 

$croma 			= get_option('cromatic');
$sidebarrule 	= (isset($croma['cro_catsidebar']))?  esc_attr($croma['cro_catsidebar']) :  3 ;


?>


<?php get_template_part( 'inc/templates/cromaheader'); ?>

	<div class="main singleitem">				
		<div class="row singlepage">
						
			<!-- structure for the page with left sidebar -->
			<?php if ($sidebarrule == 1) { ?>
			<div class="large-4 column">
				<?php get_sidebar(); ?>
			</div>	
			<div class="large-8 column">
				<div class="croma_pad_left">
					<?php 
						while ( have_posts() ) : the_post();
							get_template_part( 'inc/templates/content', get_post_format()); 
						endwhile; 
						cro_paging();
					?>
				</div>
			</div>	




			<!-- structure for the page with no sidebar -->
			<?php } elseif ($sidebarrule == 2) { ?>
			<div class="large-12 column">
				<?php 
					while ( have_posts() ) : the_post();
						get_template_part( 'inc/templates/content', get_post_format()); 
					endwhile; 
					cro_paging();
				?>
			</div>




			<!-- structure for the page with right sidebar -->
			<?php } else  { ?>
				<div class="large-8 column">
					<div class="croma_pad_right">
					<?php 
						while ( have_posts() ) : the_post();
							get_template_part( 'inc/templates/content', get_post_format()); 
						endwhile; 
						cro_paging();
					?>
				</div>
				</div>	
				<div class="large-4 column">
					<?php get_sidebar(); ?>
				</div>	
			<?php } ?>

		
		</div>
	</div>


<?php get_footer(); ?>