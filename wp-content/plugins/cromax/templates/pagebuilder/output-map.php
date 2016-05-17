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



$height 		= ($namearray[0] != '')?  esc_attr( $namearray[0] ) :  100 ;
$zoom 			= ($namearray[1] != '')?  esc_attr( $namearray[1] ) :  10 ;
$address 		= ($namearray[2] != '')?  esc_attr( $namearray[2] ) :  '' ;
$lt 			= ($namearray[3] != '')?  esc_attr( $namearray[3] ) :  '' ;
$lg 			= ($namearray[4] != '')?  esc_attr( $namearray[4] ) :  '' ;


?>

<?php echo do_shortcode( '[cromax-streetmap address="' . $address . '" height="' . $height . '" zoom="'  . $zoom .  '" lt="' . $lt . '"  lg="' .  $lg . '"]' ); ?>




