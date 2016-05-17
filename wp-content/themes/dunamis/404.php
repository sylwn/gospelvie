<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?><?php
/**
 * The 404 page file.
 *
 *
 * @package Croma.framework
 * @subpackage Croma.framework
 * @since 1.0
 */

get_header(); 
?>

<!-- fetch the page header -->	
<?php get_template_part( 'inc/templates/cromaheader'); ?>


<!-- structure for the 404 page -->
<div class="row">
	<div id="main">
		<div class="main singlemain">				
			<div class="large-12 column">
				<section class="cro_404">
						<i class="icon-warning-sign"></i>
						<p>
							<?php echo _e('we were unable to find what you were looking for.','croma'); ?>
						</p>
						<p>
							<?php echo _e('You can access to the front-page ','croma'); ?> 
							<a href="<?php echo home_url(); ?>"><?php echo _e('here','croma'); ?></a>
						</p>
				</section>
			</div>
			
		</div>
	</div>
</div>


<?php get_footer(); ?>