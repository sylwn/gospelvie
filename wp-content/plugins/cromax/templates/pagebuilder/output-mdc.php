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


// get the settings for the calendar type.
$caltype 	= $namearray[0];


//get the color settings for the button
$callinkcol	= ($namearray[4] != '')? ' color: ' . esc_attr($namearray[4]) . '; '  :  '';
$callinkbg	= ($namearray[5] != '')? ' background: ' . esc_attr($namearray[5]) . '; '  :  '';


// set hte button and the title
$callink 	= ($namearray[2] != '' && $namearray[3] != '')? '<a class="cro_hp_body" href="'  . esc_url( $namearray[3] )   .  '" style="' . $callinkcol  .  $callinkbg  .  '">' . html_entity_decode(esc_attr( stripslashes($namearray[2]))) . '</a>'  :  '';
$caltitle 	= ($namearray[1] != '')? '<h3 class="cro_hp_body cro_cal_short_title">'  .  html_entity_decode(esc_attr( stripslashes($namearray[1])))   . ' ' .  $callink  . '</h3>'  : ''  ;

$op 		= '';

switch ($caltype) {
	case '1':
		$op = '<div class="cromax_latest_media">' . cromax_fetch_latest_media(1) . '</div>';
	break;
	case '2':
		$op = '<div class="cromax_latest_media">' . cromax_fetch_latest_media(2) . '</div>';
	break;
	case '3':
		$op = '<div class="cromax_latest_media">' . cromax_fetch_latest_media(3) . '</div>';
	break;
	case '4':
		$op = '<div class="cromax_latest_media">' . cromax_fetch_latest_media(4) . '</div>';
	break;
	case '5':
		$op = '<div class="cromax_latest_media">' . cromax_fetch_latest_media(5) . '</div>';
	break;
	case '6':
		$op = '<div class="cromax_latest_media">' . cromax_fetch_latest_media(6) . '</div>';
	break;

}

?>

<div class="cro_latest_media_container">
	<?php echo $caltitle; ?>
	<?php echo $op; ?>
</div>





