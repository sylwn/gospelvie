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



$iconimg 	= ($namearray[0] != '')?   '<img src="' . $namearray[0] . '" class="cro_boximage" alt="image">' :  '';
$title 		= ($namearray[1] != '')?  '<h5 class="cromapic-title">' . stripslashes(html_entity_decode(esc_attr($namearray[1]))) . '</h5>' :  '' ;
$link 		= ($namearray[2] != '')?  esc_attr(cromax_addscheme($namearray[2])) :  '#' ;
$target		= ($namearray[3] == '3')?  '  target="_blank"' :  '' ;

$label_bef 		= ($namearray[2] != '')?  '<a class="cromax_morelink" href="' . $link . '"  ' .  $target  . '>' :  '' ;
$label_aft 		= ($namearray[2] != '')?  '</a>' :  '' ;

?>
<div class="cromax-pic">
	<?php echo $label_bef; ?><?php echo $iconimg; ?><?php echo $label_aft; ?>
	<?php echo $title; ?>
</div>