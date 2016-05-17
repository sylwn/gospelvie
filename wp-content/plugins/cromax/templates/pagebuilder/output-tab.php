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
$padlist 			= '';
$pads_title 		= ($namearray[0] != '')?  '<div class="cro_tab_header cro_cust_font">' . esc_attr( stripslashes($namearray[0]) ) . '</div>' :  '' ;



if (isset($namearray[1])) {

	$arcount = 1;

	for ($i=1; $i < 1000 ; $i++) { 
		$pad_title = '';
		$rndstr = cromax_randstring(5);
		$pad_cnt = '';
		$arrsa = $namearray[1];
		if (isset($arrsa[$i]) && isset($arrsa[($i + 1000)]) && isset($arrsa[($i + 10000)])) {
			$arrsb = $arrsa[$i];
			$arrsc = $arrsa[($i + 1000)];
			$arrsd = $arrsa[($i + 10000)];
		} else {
			$arrsb = '';
			$arrsc = '';
			$arrsd = '';
		}


		if ($arrsd != '') {
			$arclass = ($arcount == 1)?  'cro_activeli' :  '' ; 
			$padlist .= '<li class="' . $arclass  . '"><a href="#tab_item_' .  $rndstr . '">' . apply_filters('the_title',  esc_attr( stripslashes($arrsb)))  . '</a></li>';
		}


		if ($arrsb != '') {
			$atclass = ($arcount == 1)?  'cro_activediv' :  '' ; 
			$padder .= '<div id="tab_item_' .  $rndstr . '" class="tab-pane ' . $atclass  . '"><h4>' .   apply_filters('the_title',  esc_attr( stripslashes($arrsd)))  . '</h4>' . wpautop(html_entity_decode(esc_attr( stripslashes($arrsc))))  . '</div>';
		}


		$arcount ++;

	}

}

?>

<div class="cro_tab_container">
	<?php echo $pads_title; ?>
	<ul class="nav nav-tabs clearfix">
		<?php echo $padlist; ?>
	</ul>
	<div class="tab-content">
		<?php echo $padder; ?>
	</div>
</div>





