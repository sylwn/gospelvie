<?php
/**
* Plugin Name: Cromax
* Plugin URI: http://cro.ma
* Description: Cromax calendar ajax functions
* Version: 1.0
* Author: Croma
* Author URI: http://www.cro.ma
* License: Themeforest Regular licence
* 
*
* @package Cromax
* @category Core
* @author Croma
*/



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



/**
 * advance the calendar to a new month
 *
 * @access public
 * @return void
 */




add_action( 'wp_ajax_cromax_cal_advance', 'cromax_cal_advance' );

function cromax_cal_advance() {

	$move = (isset($_POST['move']))? $_POST['move']: '';

	echo cromax_admin_calendar('', date('n', intval($move)), date('Y', intval($move)),'');

	die(); // this is required to return a proper result
}




add_action('wp_ajax_cromax_cal_ajaxdatas', 'cromax_cal_ajaxdatas');
add_action('wp_ajax_nopriv_cromax_cal_ajaxdatas', 'cromax_cal_ajaxdatas');

function cromax_cal_ajaxdatas() {

	$cro_p = '';

	if(isset($_POST['type'])){$action_identifier = $_POST['type'];}
	if(isset($_POST['option1'])){$option1 = $_POST['option1'];}


	if ($action_identifier == 'cro_movecal') {
		
		$cro_p = cromax_fetch_responsive_cal(date('n', intval($option1)), date('Y', intval($option1)));

	} elseif ($action_identifier == 'cro_moveagenda') {

		$cro_p = cromax_fetch_upc_agenda('','',date('n', intval($option1)), date('Y', intval($option1)),'');

	}

	
	echo $cro_p;
	exit;

}

