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


$txtcolor 		= ($namearray[2] != '')?  ' color:  ' . esc_attr($namearray[2])  . '; ' :  ' color: #222; ' ;
$mainpadding 	= ($namearray[1] != '')?  ' margin-bottom: 20px; ' :  ' margin-bottom: 0; ' ;
$mainsize 		= ($namearray[4] != '')?  ' font-size:  ' . esc_attr($namearray[4])  . 'px; ' :  ' font-size: 30px; ' ;
$subsize 		= ($namearray[5] != '')?  ' font-size:  ' . esc_attr($namearray[5])  . 'px; ' :  ' font-size: 30px; ' ;
$bg 			= ($namearray[6] != '')?  'style="background: url(' . esc_attr($namearray[6]) . ') no-repeat center; background-size: cover;' :  'style="' ;
$mask 			= ($namearray[7] != '')?  'opacity: ' . (esc_attr($namearray[7])/100) . '; filter: alpha(opacity=' .  esc_attr($namearray[7]) . ');' : '';


$colorset   	= ($namearray[3] != '')?  'style="background:' .  esc_attr($namearray[3])  . '; ' . $mask . '"' : '' ;

$title 			= ($namearray[0] != '')?  '<h3 class="cro_cust_font" style="' .  $txtcolor . $mainsize . $mainpadding  . '">' . esc_attr( stripslashes($namearray[0]) ). '</h3>' :  '' ;
$content 		= ($namearray[1] != '')?  '<p style="' . $txtcolor  . $subsize . '">' .  stripslashes(html_entity_decode(esc_attr($namearray[1]))) . '</p>' :  '' ;

$paddingset = ($namearray[8] != '')?  $bg . ' padding: ' . esc_attr($namearray[8]) . 'px 40px; " ' : $bg . '" ';


?>

<div class="cromax-hed" <?php echo $paddingset; ?>>

	<div class="cromax-maskholder" <?php echo $colorset; ?>>&nbsp;</div>

	<?php echo $title; ?>

	<?php echo $content; ?>

</div>