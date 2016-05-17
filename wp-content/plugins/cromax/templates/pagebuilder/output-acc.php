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


$padder 			= '';
$pads_title 		= ($namearray[0] != '')?  '<div class="cro_accordion_header cro_cust_font">' . esc_attr( stripslashes($namearray[0]) ) . '</div>' :  '' ;

if (isset($namearray[1])) {

	for ($i=1; $i < 1000 ; $i++) { 
		$pad_title = '';
		$pad_cnt = '';
		$arrsa = $namearray[1];

		if (isset($arrsa[$i]) && isset($arrsa[($i + 1000)]) ) {
			$arrsb = $arrsa[$i];
			$arrsc = $arrsa[($i + 1000)];
		} else {
			$arrsb = '';
			$arrsc = '';
		}
		if ($arrsb != '') {
			$pad_title = '<div class="accordion-pane"><i class="icon-plus"></i><i class="icon-remove"></i>' .  apply_filters('the_title',  esc_attr( stripslashes($arrsb))) . '</div>';
			$pad_cnt = '<div class="accordion-cnt" style="display: none;">' . wpautop(html_entity_decode(esc_attr( stripslashes($arrsc))))  . '</div>';
		}

		if ($pad_title != '') {
			$padder .= '<div class="cro_accordion_single">' . $pad_title . $pad_cnt . '</div>';
		}

	}

}

?>

<div class="cro_accordion_container">
	<?php echo $pads_title; ?>
	<?php echo $padder; ?>
</div>





