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



$ctr = 0;


$pad_top 	= ($namearray[0] != '')?  'height: ' .  esc_attr($namearray[0]) .   'px;' :  '' ;

?>

<hr class="cromax-seperator" style=" <?php echo $pad_top; ?>" />