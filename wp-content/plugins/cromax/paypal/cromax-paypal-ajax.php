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
 * paypal ajax actions
 *
 * @access public
 * @return void
 */


add_action('wp_ajax_cromax_paypal_ajaxdatas', 'cromax_paypal_ajaxdatas');
add_action('wp_ajax_nopriv_cromax_paypal_ajaxdatas', 'cromax_paypal_ajaxdatas');

function cromax_paypal_ajaxdatas() {

	$cro_p = '';


	if(isset($_POST['type'])){$action_identifier = $_POST['type'];}
	check_ajax_referer( 'cro_ajax_functions', 'nonce' );


	if ($action_identifier == 'cro_do_paypaldonation') { $cro_p = cro_bookpaypal($_POST); } 

	
	echo $cro_p;
	exit;

}

