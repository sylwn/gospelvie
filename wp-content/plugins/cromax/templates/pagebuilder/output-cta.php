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



$color 		= ($namearray[2] != '')?  ' color: ' . esc_attr( $namearray[2])  .   '; ' :  '' ;
$bgcol 		= ($namearray[3] != '')?  ' background: ' . esc_attr( $namearray[3])  .   '; ' :  '' ;
$bdr 		= ($namearray[2] != '')?  ' background: rgba(0,0,0,0.3); ' :  '' ;


$link 		= ($namearray[4] != '')?  $namearray[4] :  '#' ;
$target 	= ($namearray[5] == '3')?  '  target="_blank"' :  '' ;
$label 		= ($namearray[1] != '')?  '<a class="cromax_morelink"  style="' . $color . ' ' .  $bdr  . '" href="' . $link . '" ' .  $target  . '>' . esc_attr($namearray[1]) . '</a>' :  '' ;


$title 		= ($namearray[0] != '')?  '<h4 class="cro_cust_font" style="' . $color . '" >' .  esc_attr( stripslashes($namearray[0]) ) . '</h4>' :  '' ;


?>
<div class="cromax-cta clearfix" style="<?php echo $color; ?> <?php echo $bgcol; ?>">
	<?php echo $title; ?>
	<?php echo $label; ?>
</div>