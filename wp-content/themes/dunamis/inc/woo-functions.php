<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php
/**
 * Woo commerce functions
 *
 *
 * @author   Cromatheme
 * @category  Core
 * @package  theme/inc
 * @version     1.0
 */




// function to properly draw the cart updates

add_filter('add_to_cart_fragments', 'cro_cartshort');

function cro_cartshort( $fragments ) {
	global $woocommerce;
	
	$fragments['span.cro_floatcounter'] = cro_cartset();

	$fragments['div.cro_minicart'] = cro_cartflux();
		
	return $fragments;
}



function cro_cartset() {
	global $woocommerce;

	$cart_contents_count 	= $woocommerce->cart->cart_contents_count;
    $menu_item = '';
	
	if ($cart_contents_count >= 1 ) {
		$menu_item .= '<span class="cro_floatcounter"><span class="cro_floatcountinner">' . $cart_contents_count .'</span></span>';
	} else {
		$menu_item = '<span class="cro_floatcounter"></span>';
	}

	return $menu_item;	
}

function cro_cartflux() {
	global $woocommerce;

	$op = '';

    if (sizeof($woocommerce->cart->cart_contents)>0) {                      

		$op .= ' <div class="cro_minicart"><ul class="cart_list">';

        
        	foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) {

        		$_product = $cart_item['data'];

        		if ($_product->exists() && $cart_item['quantity']>0) { 


        			$op .= '<li class="cart_list_product">';             
        			$op .= '<div class="cart_list_product_price">';
        			$op .= woocommerce_price($_product->get_price()); 
        			$op .= '</div>';
        			$op .= '<a class="cart_list_product_img" href="' .  get_permalink($cart_item['product_id']) . '">';
        			$op .= $_product->get_image();
        			$op .= '</a>';
        			$op .= '<div class="cart_list_product_title">';
        			$op .= '<a href="'. get_permalink($cart_item['product_id']) .'">';
        			$op .= apply_filters('woocommerce_cart_widget_product_title', $_product->get_title() , $_product);
        			$op .= '</a>';
        			$op .= '<div class="cart_list_product_quantity">';
        			$op .=  __('Quantity:', 'croma') . ' ' . $cart_item['quantity'];
        			$op .= '</div></div>';
        			$op .= apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'croma') ), $cart_item_key );
        			$op .= '<div class="clearfix"></div></li>';

				}
			}

		$op .= '</ul>';


        $op .= '<div class="minicart_total_checkout">';
        $op .=  __('Cart subtotal', 'croma');
        $op .= '<span>' .  $woocommerce->cart->get_cart_total() . '</span>';
        $op .= '</div>';
        $op .= '<a href="' .  esc_url( $woocommerce->cart->get_cart_url() ) . '" class="button croma_minicart_cart_but">';
        $op .= __('View Shopping Bag', 'croma');
        $op .= '</a>';
        $op .= '<a href="' .  esc_url( $woocommerce->cart->get_checkout_url() ) . '" class="button croma_minicart_checkout_but">';
        $op .=  __('Proceed to Checkout', 'croma'); 
        $op .= '</a>';


	} else {

		$op .= '<div class="cro_minicart"><div class="cro_emptyshop">' .  __('No products in the shopping bag.','croma') . '</div> <a href="' .  get_permalink(esc_attr( get_option('woocommerce_shop_page_id'))) . '" class="button croma_minicart_checkout_but">' .  __('Visit Shop', 'croma') . '</a></div>';   

	}

	$op .= '</div>';

	return $op;	
}





?>
