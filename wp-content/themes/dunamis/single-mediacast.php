<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?><?php
/**
 * The single template file.
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
$sidebarbox = (get_post_meta($post->ID, 'cromabox_sbbar', true) == '')? 2 : get_post_meta($post->ID, 'cromabox_sbbar', true);	


?>
		
<!-- get the header -->
<?php get_template_part( 'inc/templates/cromaheader'); ?>



<!-- start tit hthe page layout -->
<section id="pagelayout">
<div class="row">
	<div id="main">
		<div class="main singlemain cro_singleblogpage">				


			<!-- render the main part -->
			<div class="large-8 column">
				<div class="croma_pad_left cro_mediacast_post">
					<?php get_template_part( 'inc/templates/content-mediacast'); ?>
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'croma' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'croma' ) . '</span>' ); ?></span>
					<div class="clearfix"></div>
					<?php comments_template('', '');  ?>
				</div>
			</div>



			<!-- render the sidebar -->
			<div class="large-4 column">
				<?php get_sidebar('mediacast'); ?>
			</div>


			<div class="clearfix"></div>
			
		</div>
	</div>
</div>
</section>

	<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>



















