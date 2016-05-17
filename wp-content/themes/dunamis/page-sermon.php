<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?><?php
/**
 * The page template file.
 *
 *
 * @package Croma.framework
 * @subpackage Croma.framework
 * @since 1.0
 *
 * Template Name: sermon
 */

get_header(); 


while ( have_posts() ) : the_post();


	// set the sidebar
	$sbar 		= get_post_meta($post->ID, 'cro_sidebar', true);	
	$sidebarbox = (get_post_meta($post->ID, 'cromabox_sbbar', true) == '')? 0 : get_post_meta($post->ID, 'cromabox_sbbar', true);	
	$abar = 'hi';



	// print_r( json_decode(  rawurldecode(  get_post_meta( get_the_ID(),'cromax_pagebuilder', true )  ), true));


	get_template_part( 'inc/templates/cromaheader'); 


endwhile;

$apost = $post;


$temp 			= $wp_query;
$wp_query 		= null;
// $paged 		= (get_query_var('paged')) ? get_query_var('paged') : 1;
$post_counter 	= 0;
$wp_query 		= new WP_Query(
					array(
						'post_type' => 'mediacast',
						'paged'=>$paged
					)
				);


?>


<!-- start tit hthe page layout -->
<section id="pagelayout">
	<div class="row">
		<div id="main">
			<div class="main singlemain cro_pagelayout">				


				<!-- render the page subject to the sidebar settings 1> sidebar left -->
				<?php if ($sidebarbox == 1) { ?>

					<!-- render the sidebar -->
					<div class="large-4 column">
						<?php get_sidebar('mediacast'); ?>
					</div>


					<!-- render the main part -->
					<div class="large-8 column">
						<div class="croma_pad_left">
							<div class="croma_pad_right cro_mediacast_post">
							<?php 
							while ($wp_query->have_posts()) : $wp_query->the_post();

							get_template_part( 'inc/templates/content-mediacast');

							endwhile; 

							cro_paging();  ?>


						</div>
						</div>
					</div>


					<!-- if there is a right sidebar start ot render -->
					<?php } elseif ($sidebarbox == 2) { ?>



					<!-- render the main part -->
					<div class="large-8 column">
						
						<div class="croma_pad_right cro_mediacast_post">
							<?php 
							while ($wp_query->have_posts()) : $wp_query->the_post();

							get_template_part( 'inc/templates/content-mediacast');

							endwhile; 

							cro_paging();  ?>


						</div>
					

					</div>

					<!-- render the sidebar -->
					<div class="large-4 column">
						<?php get_sidebar('mediacast'); ?>
					</div>


				<!-- render the page without a sidebar -->
				<?php } else { ?>
				
					<div class="large-12 column">
						<div class="croma_pad_right cro_mediacast_post">
							<?php 
							while ($wp_query->have_posts()) : $wp_query->the_post();

							get_template_part( 'inc/templates/content-mediacast');

							endwhile; 

							cro_paging();  ?>


						</div>
					</div>

				<?php } ?>
			
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>