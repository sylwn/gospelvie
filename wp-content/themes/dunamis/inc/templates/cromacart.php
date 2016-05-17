<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>

<?php
/**
 * Shopping cart
 *
 *
 * @author 		Croma
 * @package 	templates
 * @version     1.0
 */
global $woocommerce;

 if ( class_exists( 'Woocommerce' ) ) {

 $cart_total    = $woocommerce->cart->cart_contents_count;
 $carts         = ($cart_total >= 1)? '<span class="cro_floatcounter"><span class="cro_floatcountinner">' .  $cart_total . '</span></span>' : '<span class="cro_floatcounter"></span>';

?>
<!-- start drawing the float manager -->
<div class="cro_floatmngr">

    <!-- start drawing the cartbox -->
    <div class="cro_sbccover">  
        <div class="cro_floater">
            <?php echo $carts; ?>
        </div>             
        <div class="croma_shopping bag">       
	       <div class="croma_shopping_bag_wrapper">
		      <div class="cro_minicart_wrapper">
			     <div class="cro_minicart">
                    

                    <!-- if there is contents in the cart draw them -->
                    <?php if (sizeof($woocommerce->cart->cart_contents)>0) { ?>

                        
                        <!-- innitialize the cartlist -->
                        <ul class="cart_list">

                            <?php foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) {

                                $_product = $cart_item['data'];

                                

                                // draw the product lists
                                if ($_product->exists() && $cart_item['quantity']>0) { ?>

                                    <li class="cart_list_product">              
                                        
                                        <div class="cart_list_product_price">
                                            <?php echo woocommerce_price($_product->get_price()); ?>
                                        </div>
                                                
                                       
                                        <a class="cart_list_product_img" href="<?php echo get_permalink($cart_item['product_id']); ?>">
                                            <?php echo  $_product->get_image(); ?>
                                        </a>
                                                
                                        

                                        <div class="cart_list_product_title">
                                            <a href="'.get_permalink($cart_item['product_id']).'">
                                                <?php echo apply_filters('woocommerce_cart_widget_product_title', $_product->get_title() , $_product); ?>
                                            </a>
                                            <div class="cart_list_product_quantity">
                                                <?php __('Quantity:', 'croma'); ?> <?php echo $cart_item['quantity']; ?>
                                            </div>
                                        </div>
                                                
                                        <?php apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'croma') ), $cart_item_key ); ?>
                                        <div class="clearfix"></div>
                                    </li>

                                <?php }
                            } ?>

                        </ul>


                        <!-- minicart totals -->
                        <div class="minicart_total_checkout">
                            <?php _e('Cart subtotal', 'croma'); ?>
                            <span><?php echo $woocommerce->cart->get_cart_total(); ?></span>
                        </div>

                        <!-- link to shopping bag and shop -->
                        <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="button croma_minicart_cart_but">
                            <?php _e('View Shopping Bag', 'croma'); ?>
                        </a>
                        <a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="button croma_minicart_checkout_but">
                            <?php _e('Proceed to Checkout', 'croma'); ?>
                        </a>


                    <!-- if shopping bag is empty -->
                    <?php } else { ?>                     
                        <div class="cro_emptyshop"><?php __('No products in the shopping bag.','croma'); ?></div>  
                         <a href="<?php echo get_permalink(esc_attr( get_option('woocommerce_shop_page_id'))); ?>" class="button croma_minicart_checkout_but">
                            <?php _e('Visit Shop', 'croma'); ?>
                        </a>   
                    <?php } ?> 
                                                                  
                    </div>
                </div>
            </div>                       
        </div>
    </div>
</div>

<?php } ?>