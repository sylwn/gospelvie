<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 *
 * cromax-paypal-init
 * 
 * @author  	AJ aj@cro.ma
 * @package 	Cromax
 * @category 	Foodmenu
 * @copyright 	Copyright (c) 2014, Alwyn Kotze & Croma
 * @version 	1.0
 * @since 		1.0
 * @uses 		bind the different files for paypal
 */




/**
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		link all the different files in the paypal group of functions
 */

include('cromax-paypal-ajax.php');
include('class-cromax-paypal.php');







add_action('init', 'cromax_rewrite_rules');
add_filter('query_vars', 'cromax_rewrite_query_vars');


function cromax_rewrite_rules() {
  add_rewrite_rule('^payment/([^/]*)/([^/]*)/?','index.php?page_id=$matches[1]&id=$matches[2]&token=$matches[3]&PayerID=$matches[4]','top');
}


 function cromax_rewrite_query_vars($vars) {
  $vars[] = 'id';
  $vars[] = 'token';
  $vars[] = 'PayerID';

  return $vars;
 }



/**
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		Create a new paypal donation
 */
function cro_bookpaypal($data) {

	$op         = '';
  $settings   = get_option('cromatic');

  if ($settings['cro_paypalmode'] == '2') {
    $paypalurl = 'https://www.paypal.com';
  } else {
    $paypalurl = 'https://www.sandbox.paypal.com';
  }


	//create the post
	$post = array(
  		'post_title'     => esc_attr($data['cro_name']) . ' ' . esc_attr($data['cro_surname']),
  		'post_status'    => 'private',
  		'post_type'      => 'cromax_donations',
  		'post_author'    => 1,
  		'ping_status'    => 'closed'
	); 
	$post_id = wp_insert_post( $post, $wp_error );

   $payarray       = array(
                      'description' => esc_attr(get_bloginfo('name')) . '  -  '  . __('donation','croma'),
                      'freq'        => $_POST['cro_payfreq']
                    );



	// set the metas
	foreach(array('cro_name','cro_surname', 'cro_email', 'cro_ammt', 'cro_payfreq') as $v){add_post_meta( $post_id, $v, esc_attr($data[$v]));}



  add_post_meta($post_id, 'cro_statuslabel',1);
  

  switch ($payarray['freq']) {
    case 1:
      $solutiondesc = '';
    break;
 
    case 2:
      $solutiondesc = ' (' . __('Monthly','croma') . ')';
    break;  

    case 3:
      $solutiondesc = ' (' . __('Anually','croma') . ')';
    break;  
   
  }



	// initiate paypal
	$paypal_di 			= new Cromax_paypal($post_id);
  $payarray       = array(
                      'description' => esc_attr(get_bloginfo('name')) . '  -  '  . __('donation','croma') . $solutiondesc,
                      'freq'        => $_POST['cro_payfreq']
                    );


  add_post_meta($post_id, 'cro_desc',$payarray['description']);



	

  $result 			  = $paypal_di->make_paypal_contact('SetExpressCheckout',$payarray);

	// set the button
	if ($result['ACK'] == 'Success') {

    cromax_sendmail( $post_id, 'admin_justdonated', 'admin', 'class');

		$op = '
		<form action="' . $paypalurl . '/webscr?cmd=_express-checkout&token=' . $result['TOKEN']  . '&useraction=commit" method="post" id="paypal_payment_form" target="_top">
			<p>' . __('Click the button to finalize the payment','croma') . '</p>
			<button class="cro_cust_bg" >' . __('Make Paypal payment','croma') . '</button>
		</form>';
	} else {
		$op = '<p>' . __('There was a payment error. An email was dispatched to the site admin.','croma') . '</p>';

		update_post_meta($post_id, 'cro_statuslabel',4);

		update_post_meta( $post_id, 'paypaldetails',  rawurlencode( json_encode($result)) );

    cromax_sendmail( $post_id, 'admin_errorwarning', 'admin', 'class');

	}




	return $op;

}




/**
 * Add metabox
 *
 * @access public
 * @return void
 */

add_action( 'add_meta_boxes', 'cromax_add_paypal_box' );
function cromax_add_paypal_box() {			
	add_meta_box( 
		'cromax_paypal_metas',
		__('Donation details','croma'),
		'cromax_add_paypal_metabox',
		'cromax_donations',
		'normal',
		'high'     
	);
}




/**
 * The function that draws the metaboxes
 *
 * @access public
 * @return void
 */

function cromax_add_paypal_metabox() {
	global $post_type, $post;	

	include ('templates/invoicescreen.php');
}





/**
 * FUNCTION : cromax_hide_add_box  - 
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		Hides the add new box for new reservations in the admin menu
 */

function cromax_hide_add_box() {
  global $submenu;
  unset($submenu['edit.php?post_type=cromax_donations'][10]);
}
add_action('admin_menu', 'cromax_hide_add_box');




/**
 * FUNCTION : cromax_hide_add_button  - 
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		Hides the add new box for new reservations in the reservations page
 */

function cromax_hide_add_button() {
  $postbase 		= get_current_screen();
 
  if ( $postbase->base == 'post' && $postbase->post_type == 'cromax_donations') {
		echo '<style>.add-new-h2{display: none;}</style>';
  }


}
add_action('admin_head','cromax_hide_add_button');




/**
 * FUNCTION : add_new_reservations_columns  - 
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		Adds new reservations colums to the reservations page
 */


function add_new_donations_columns($reservations_columns) {

    $new_columns['cb'] 			  = '<input type="checkbox" />'; 
    $new_columns['title'] 		= _x('Gallery Name', 'column name','croma');  
    $new_columns['ammt'] 		  = __('Amount','croma');
    $new_columns['dondate'] 	= __('Date','croma');
    $new_columns['status'] 		= __('Status','croma');
    $new_columns['freq']      = __('Frequency','croma');
    $new_columns['email'] 		= __('Email','croma');
    return $new_columns;

}
add_filter('manage_edit-cromax_donations_columns', 'add_new_donations_columns');





add_action('manage_cromax_donations_posts_custom_column', 'manage_donations_columns', 10, 2);
 
function manage_donations_columns($column_name, $id) {

    global $wpdb;



    switch ($column_name) {
    

    case 'ammt':
        echo get_post_meta( $id, 'cro_ammt', true );
     
    break;


    case 'dondate':
       
       echo get_the_date('',  $id) . ' ' . get_the_time('',  $id);
     
    break;



    case 'status':

    	$status = get_post_meta(  $id, 'cro_statuslabel', true );

    	 if ($status == 1) {
        	echo '<span style="background: #28ABE3; color: #fff; padding: 5px;  text-transform: uppercase; font-size: 11px; font-weight: bold; -webkit-border-radius: 3px; border-radius: 3px; border: 1px solid rgba(0,0,0,0.1);">' . __('Initiated','croma') . '</span>';
        } elseif ($status == 2) {
        	echo '<span style="background: #5cb85c; color: #fff; padding: 5px;  text-transform: uppercase; font-size: 11px; font-weight: bold; -webkit-border-radius: 3px; border-radius: 3px; border: 1px solid rgba(0,0,0,0.1);">' . __('Paid','croma') . '</span>';
        } elseif ($status == 3) {
        	echo '<span style="background: #763F7F; color: #fff; padding: 5px;  text-transform: uppercase; font-size: 11px; font-weight: bold;  -webkit-border-radius: 3px; border-radius: 3px; border: 1px solid rgba(0,0,0,0.1);">' . __('Cancelled','croma') . '</span>';
        } else {
        	echo '<span style="background: #CE0000; color: #fff; padding: 5px;  text-transform: uppercase; font-size: 11px; font-weight: bold;  -webkit-border-radius: 3px; border-radius: 3px; border: 1px solid rgba(0,0,0,0.1);">' . __('Error','croma') . '</span>';
        }

     
    break;


     case 'freq':

      $freq = get_post_meta(  $id, 'cro_payfreq', true );

       if ($freq == 1) {
          echo '<span style="background: #EC971F; color: #fff; padding: 5px;  text-transform: uppercase; font-size: 11px; font-weight: bold; -webkit-border-radius: 3px; border-radius: 3px; border: 1px solid rgba(0,0,0,0.1);">' . __('Once','croma') . '</span>';
        } elseif ($freq == 2) {
          echo '<span style="background: #1FDA9A; color: #fff; padding: 5px;  text-transform: uppercase; font-size: 11px; font-weight: bold; -webkit-border-radius: 3px; border-radius: 3px; border: 1px solid rgba(0,0,0,0.1);">' . __('Monthly','croma') . '</span>';
        } else {
          echo '<span style="background: #59323C; color: #fff; padding: 5px;  text-transform: uppercase; font-size: 11px; font-weight: bold;">' . __('Annually','croma') . '</span>';
        }

     
    break;


     case 'email':
        echo get_post_meta( $id, 'cro_email', true );
     
    break;


 
    
    default:
    break;

    
    } 
}   





