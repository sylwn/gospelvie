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


	$callocation 		=  (get_post_meta(get_the_ID(), 'cro_introinput', true ) != '')?     ' <br/><br/><span class="locationspan cro_cust_col" style="font-size: 16px;text-style: italics;">' .  html_entity_decode(esc_attr( stripslashes(get_post_meta(get_the_ID(), 'cro_introinput', true )))) : '</span>';


?>
		
<?php get_template_part( 'inc/templates/cromaheader'); ?>
<section id="calendarlayout">
	<div id="main" class="singlemain" style="padding: 50px 0;">	
	  <div class="row">


			<div class="large-4 column cro_calendarsidebar">
				<div class="cro_calhead_single">
					<h4 class="cro_cust_font"><?php the_title(); ?><?php echo $callocation;  ?></h4>
					<?php echo  cromaxcal_page_header($post->ID); ?>
				</div>
			</div>			

			<div class="large-8 column cro_calendarmain">
				<div class="cro_portfolioinner">
					<?php get_template_part( 'inc/templates/content'); ?>
				</div>
			</div>
		
		</div>
	</div>
</section>

	<?php endwhile; // end of the loop. ?>


<?php get_footer(); ?>