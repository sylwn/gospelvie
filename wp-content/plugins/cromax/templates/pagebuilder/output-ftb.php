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


$thumbimg 	= '';

if ($namearray[0] != '') {
	$thumbimg 	= cro_get_ftb($namearray[0]);
}

if ($namearray[0] != '' && $thumbimg == '') {
	$thumbimg 	= $namearray[0];
}

$link 		= ($namearray[7] != '')?  $namearray[7] :  '#' ;
$target 	= ($namearray[9] == '3')?  '  target="_blank"' :  '' ;
$iconimg 	= ($namearray[0] != '')?   '<img src="' . $thumbimg  . '" class="cro_boximage" alt="image">' :  '';
$iconcolor 	= ($namearray[2] != '')?  ' color: ' . esc_attr( $namearray[2])  .   '; ' :  '' ;
$iconbg 	= ($namearray[3] != '')?  ' background: ' .  esc_attr($namearray[3]) .   '; ' :  '' ;
$iconname 	= ($namearray[1] != '' && $namearray[0] == '')?  '<a href="' . $link . '" ' . $target . '><i class="icon-' . esc_attr($namearray[1])  . ' cromax_feat_icon" style="' . $iconcolor . ' ' .  $iconbg  . '"></i></a>' :  '' ;
$title 		= ($namearray[4] != '')?  '<h3 class="cro_cust_font">' .  esc_attr( stripslashes($namearray[4]) ) . '</h3>' :  '' ;
$subtitle 	= ($namearray[5] != '')?  '<h6>' .  esc_attr( stripslashes($namearray[5]) ) . '</h6>' :  '' ;
$content 	= ($namearray[6] != '')?  '<p>' . stripslashes(html_entity_decode(esc_attr($namearray[6]))) . '</p>' :  '' ;



$label 		= ($namearray[8] != '')?  '<a class="cromax_morelink cro_cust_bg" href="' . $link . '" ' .  $target  . '>' . esc_attr($namearray[8]) . '</a>' :  '' ;

?>
<div class="cromax-ftb">
	<?php if ($iconimg != '') { ?>
		<a href="<?php echo $link; ?>" <?php echo $target; ?> class="cro_ftb_img_a"><?php echo $iconimg; ?></a>
	<?php } else { ?>
		<?php echo $iconname; ?>
	<?php } ?>
	<?php echo $title; ?>
	<?php echo $subtitle; ?>
	<?php echo $content; ?>
	<?php echo $label; ?>
</div>