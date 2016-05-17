<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php
global $wp_query, $woocommerce;

/**
 * The Woo commerce Archive file ***
 *
 * @package Cromatheme
 * @subpackage Cromatheme
 * @since 1.0
 */


get_header(); 
$sbar = get_post_meta(get_option('woocommerce_shop_page_id'), 'cro_sidebar', true);
$sidebarbox = (get_post_meta(get_option('woocommerce_shop_page_id'), 'cromabox_sbbar', true) == '')? 2 : get_post_meta(get_option('woocommerce_shop_page_id'), 'cromabox_sbbar', true);   

get_template_part( 'inc/templates/cromaheader'); 


?>



<!-- start tit hthe page layout -->
<section id="pagelayout">
    <div class="row">
        <div id="main">
            <div class="main singlemain cro_shoplayout-<?php echo $sidebarbox; ?>">               


                <!-- render the page subject to the sidebar settings 1> sidebar left -->
                <?php if ($sidebarbox == 1) { ?>

                    <!-- render the sidebar -->
                    <div class="large-4 column">
                        <?php get_sidebar('shop'); ?>
                    </div>


                    <!-- render the main part -->
                    <div class="large-8 column">
                        <div class="croma_pad_left">                        
                            <?php do_action( 'woocommerce_archive_description' ); ?>

        <?php if ( have_posts() ) : ?>

            <?php
                /**
                 * woocommerce_before_shop_loop hook
                 *
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                do_action( 'woocommerce_before_shop_loop' );
            ?>

            <?php woocommerce_product_loop_start(); ?>

                <?php woocommerce_product_subcategories(); ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php wc_get_template_part( 'content', 'product' ); ?>

                <?php endwhile; // end of the loop. ?>

            <?php woocommerce_product_loop_end(); ?>

            <?php
                /**
                 * woocommerce_after_shop_loop hook
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action( 'woocommerce_after_shop_loop' );
            ?>

        <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

            <?php wc_get_template( 'loop/no-products-found.php' ); ?>

        <?php endif; ?>

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


                    <!-- if there is a right sidebar start ot render -->
                    <?php } elseif ($sidebarbox == 2) { ?>



                    <!-- render the main part -->
                    <div class="large-8 column">
                        <div class="croma_pad_right">
                            <?php do_action( 'woocommerce_archive_description' ); ?>

        <?php if ( have_posts() ) : ?>

            <?php
                /**
                 * woocommerce_before_shop_loop hook
                 *
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                do_action( 'woocommerce_before_shop_loop' );
            ?>

            <?php woocommerce_product_loop_start(); ?>

                <?php woocommerce_product_subcategories(); ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php wc_get_template_part( 'content', 'product' ); ?>

                <?php endwhile; // end of the loop. ?>

            <?php woocommerce_product_loop_end(); ?>

            <?php
                /**
                 * woocommerce_after_shop_loop hook
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action( 'woocommerce_after_shop_loop' );
            ?>

        <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

            <?php wc_get_template( 'loop/no-products-found.php' ); ?>

        <?php endif; ?>

    <?php
        /**
         * woocommerce_after_main_content hook
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
        do_action( 'woocommerce_after_main_content' );
    ?>




                    <!-- render the sidebar -->
                    <div class="large-4 column">
                        <?php get_sidebar('shop'); ?>
                    </div>


                <!-- render the page without a sidebar -->
                <?php } else { ?>
                
                    <div class="large-12 column">                    
                      <?php do_action( 'woocommerce_archive_description' ); ?>

        <?php if ( have_posts() ) : ?>

            <?php
                /**
                 * woocommerce_before_shop_loop hook
                 *
                 * @hooked woocommerce_result_count - 20
                 * @hooked woocommerce_catalog_ordering - 30
                 */
                do_action( 'woocommerce_before_shop_loop' );
            ?>

            <?php woocommerce_product_loop_start(); ?>

                <?php woocommerce_product_subcategories(); ?>

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php wc_get_template_part( 'content', 'product' ); ?>

                <?php endwhile; // end of the loop. ?>

            <?php woocommerce_product_loop_end(); ?>

            <?php
                /**
                 * woocommerce_after_shop_loop hook
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action( 'woocommerce_after_shop_loop' );
            ?>

        <?php elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) : ?>

            <?php wc_get_template( 'loop/no-products-found.php' ); ?>

        <?php endif; ?>

    <?php
        /**
         * woocommerce_after_main_content hook
         *
         * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
         */
        do_action( 'woocommerce_after_main_content' );
    ?>

                    </div>

                <?php } ?>
            
            </div>
        </div>
    </div>
</section>



<?php get_footer(); ?>

