<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php
/**
 * The template for displaying the footer.
 *
 *
 * @package Croma.framework
 * @subpackage Croma.framework
 * @since 1.0
 */
?>
	<footer id="colophon" role="contentinfo">

		<div class="container">

			<!-- draw the footer widgets -->
			<div class="row cro_footwidgets">


				<!-- footer widget left -->
				<div class="large-4 columns">
					<?php if ( is_active_sidebar( 'cro_footleft' ) ) { 
						echo '<ul class="cro_footwidget">';
							dynamic_sidebar( 'cro_footleft' );
						echo '</ul>';
					} ?>	
			
				</div>


				<!-- footer widget center -->
				<div class="large-4 columns">
					<?php if ( is_active_sidebar( 'cro_footcent' ) ) { 
						echo '<ul class="cro_footwidget">';
							dynamic_sidebar( 'cro_footcent' );
						echo '</ul>';
					} ?>

				</div>


				<!-- footer widget right -->
				<div class="large-4 columns">
					<?php if ( is_active_sidebar( 'cro_footright' ) ) { 
						echo '<ul class="cro_footwidget">';
							dynamic_sidebar( 'cro_footright' );
						echo '</ul>';
					} ?>
			
				</div>

			</div>

			<div class="site-info">
				<div class="row">

					<!-- draw the site credits & copyright -->
					<div class="large-6 columns">
						<div id="site-cnt">
							<a href="<?php echo home_url( '/' ) ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
								<?php bloginfo( 'name' ); ?> &copy; (<?php echo date('Y'); ?>)
							</a>
						</div>					
					</div>

					<!-- draw the site clink -->
					<div class="large-6 columns">
						<div id="site-generator">
							<a href="<?php echo esc_url( __('http://www.cro.ma', 'croma') ); ?>">
								<?php printf( __('Proudly Designed by %s', 'croma'), '<span>Croma</span>' ); ?>
							</a>
						</div><!-- #site-generator -->							
					</div>
				</div>	
			</div>
		</div>
	</footer>

<!-- closing the footer -->
	<?php wp_footer(); ?>
</body>
</html>