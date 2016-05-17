<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Cromax add a new pagebuilder section
 *
 *
 * @package Cromatic
 * @subpackage Cromatic
 * @since 1.0
 */



$pads_title 		= ($namearray[0] != '')?  '<h2 class="cro_cust_font">' . esc_attr( $namearray[0] ) . '</h2>' :  '' ;


if(!class_exists('WPCF7_ContactForm')) {

	$do_form = __('Contact form 7 plugin not installed or activated','croma');

} elseif ($namearray[1] == 0) {

	$do_form = __('No form selected, please select a form','croma');

} else {

	$do_form = do_shortcode( '[contact-form-7 id="' . esc_attr( $namearray[1] )  . '"]' );

}


?>

<div class="cro_ctcblock">
	<?php echo $pads_title; ?>
	<?php echo $do_form; ?>
	
</div>