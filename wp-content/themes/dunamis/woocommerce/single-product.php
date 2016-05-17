<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

get_header(''); ?>




            
<?php get_template_part( 'inc/templates/cromaheader'); ?>
<section id="singleproduct">
	<div class="row">
    	<div id="main">

    		<div class="main catmain">              
        		<div class="large-12 column">

        		<?php  do_action( 'woocommerce_before_main_content' );?>

             	<?php while ( have_posts() ) : the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

		<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>


        		</div>        
    		</div>
  		</div>
	</div>
</section>

<?php get_footer(); ?>