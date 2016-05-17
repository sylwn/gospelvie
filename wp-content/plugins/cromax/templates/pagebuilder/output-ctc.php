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
$pads_title 		= ($namearray[0] != '')?  '<h2 class="cro_cust_font">' . esc_attr( $namearray[0] ) . '</h2>' :  '' ;

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

		
		if ($arrsb != '' || $arrsc != '') {
			$pad_title = '<div class="cro_ctctitle">' . esc_attr( stripslashes($arrsb))   . '</div>';
			$pad_cnt = '<div class="cro_ctccnt">' .  stripslashes( html_entity_decode(esc_attr($arrsc)))  . '</div>';
		}

		if ($pad_title != '') {
			$padder .= '<div class="cro_ctcitem">' . $pad_title . $pad_cnt . '</div>';
		}

	}

}

?>

<div class="cro_ctcblock">
	<?php echo $pads_title; ?>
	<?php echo $padder; ?>
</div>





