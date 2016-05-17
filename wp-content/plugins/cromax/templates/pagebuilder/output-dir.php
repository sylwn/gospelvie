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



$address 	= ($namearray[0] != '')?  esc_attr( $namearray[0] ) :  '' ;
$lt 		= ($namearray[1] != '')?  esc_attr( $namearray[1] ) :  '' ;
$lg 		= ($namearray[2] != '')?  esc_attr( $namearray[2] ) :  '' ;

?>
<div class="cro_dirmaps">
	<?php echo do_shortcode( '[cromax-drivingdir address="' . $address . '" lt="' . $lt . '"  lg="' .  $lg . '"]' ); ?>
</div>




