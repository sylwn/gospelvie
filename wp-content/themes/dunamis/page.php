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
 */

get_header(); 

while ( have_posts() ) : the_post();

// set the sidebar
$sbar = get_post_meta($post->ID, 'cro_sidebar', true);	
$sidebarbox = (get_post_meta($post->ID, 'cromabox_sbbar', true) == '')? 0 : get_post_meta($post->ID, 'cromabox_sbbar', true);	


// print_r( json_decode(  rawurldecode(  get_post_meta( get_the_ID(),'cromax_pagebuilder', true )  ), true));


get_template_part( 'inc/templates/cromaheader'); 

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
						<?php get_sidebar(); ?>
					</div>


					<!-- render the main part -->
					<div class="large-8 column">
						<div class="croma_pad_left">
							<?php 
								$croma_pagebuildertest = get_post_meta( $post->ID, 'cromabox_yesnobar', true );
								if ($croma_pagebuildertest == 1) {get_cromax_pagebuilder($post->ID);} else {get_template_part( 'inc/templates/content');} 
							?>
						</div>
					</div>


					<!-- if there is a right sidebar start ot render -->
					<?php } elseif ($sidebarbox == 2) { ?>



					<!-- render the main part -->
					<div class="large-8 column">
						<div class="croma_pad_right">
						<?php 
							$croma_pagebuildertest = get_post_meta( $post->ID, 'cromabox_yesnobar', true );
							if ($croma_pagebuildertest == 1) { get_cromax_pagebuilder($post->ID); } else {get_template_part( 'inc/templates/content');}
						?>
						</div>
					</div>

					<!-- render the sidebar -->
					<div class="large-4 column">
						<?php get_sidebar(); ?>
					</div>


				<!-- render the page without a sidebar -->
				<?php } else { ?>
				
					<div class="large-12 column">
						<?php 
							$croma_pagebuildertest = get_post_meta( $post->ID, 'cromabox_yesnobar', true );
							if ($croma_pagebuildertest == 1) {get_cromax_pagebuilder($post->ID);} else {get_template_part( 'inc/templates/content');}
						?>
					</div>

				<?php } ?>
			
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
</section>

	<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>