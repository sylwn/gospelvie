<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 *
 * cromax-foodmenu-init
 * 
 * @author  	AJ aj@cro.ma
 * @package 	Cromax
 * @category 	croma.class
 * @copyright 	Copyright (c) 2014, Alwyn Kotze & Croma
 * @version 	1.0
 * @since 		1.0
 * @uses 		bind the different files for the class bookings, and hold the important functions.
 */



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/**
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		files needed for emails.
 */



/**
 * FUNCTION : cro_class_admin_add
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		create the admin pages for classbookings
 */

add_action( 'admin_menu', 'cro_emailmess_admin_add' );

function cro_emailmess_admin_add() {


// add the Dashboard page
	$croma_mailmess 	= add_submenu_page(
		'cromatic',
		__('Emails', 'croma'), 
		__('Emails', 'croma'), 
		'manage_options',
		'cromaclass_mail', 
		'cro_class_mailbody'
	);



    // set the save pages for the admin section
	add_action( "load-{$croma_mailmess}", 'cro_fetch_class_email_saves' );


	// load the scripts for the dashboard
	add_action( 'admin_print_scripts-' . $croma_mailmess  , 'cro_class_scripts' );	
	add_action( 'admin_print_styles-' . $croma_mailmess  , 'cro_class_styles' );	


}



/**
 * FUNCTION : cro_class_body
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		create the admin pages for classbookings
 */


function cro_class_mailbody(){
	include('templates/croma-emailmess.php');
}




/**
 * FUNCTION : cro_fetch_classsaves
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		save function for the classes dash
 */


function cro_fetch_class_email_saves(){

	$saveopt = get_option('cro_class_mails');


	if (isset($_POST['cro_formsubmit']) && $_POST['cro_formsubmit'] == 'Y' ) {

		$savearray = array(
			'admin_justdonated_t',
			'admin_justdonated_s',
			'admin_justdonated_b',
			'admin_errorwarning_t',
			'admin_errorwarning_s',
			'admin_errorwarning_b',
			'customer_paymentreceived_t',
			'customer_paymentreceived_s',
			'customer_paymentreceived_b',
			'admin_paymentreceived_t',
			'admin_paymentreceived_s',
			'admin_paymentreceived_b',
			'admin_cancelled_t',
			'admin_cancelled_s',
			'admin_cancelled_b',
		);


		foreach ($savearray as $value) {
			if (isset($_POST[$value])) {
				$saveopt[$value] = stripslashes(esc_textarea($_POST[$value]));
			}
		}

	}

	update_option( 'cro_class_mails', $saveopt );

}






/**
 * FUNCTION : cro_class_scripts
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		enqueue the scripts for the admin
 */


function cro_class_scripts(){
	$purl 				= untrailingslashit( plugins_url( '/', __FILE__ ) );
	wp_enqueue_script( 'cro-classes-js', $purl . '/assets/js/class-script.js', array('jquery'), null, false);
}





/**
 * FUNCTION : cro_class_styles
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		enqueue the styles for the admin
 */


function cro_class_styles(){
	$purl 				= untrailingslashit( plugins_url( '/', __FILE__ ) );
	wp_enqueue_style( 'cro-classes', $purl . '/assets/class-style.css', false, '2012-08-01' );
}






/**
 * FUNCTION : cromax_sendmail
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		main file for sending emails.
 */

function cromax_sendmail($id, $type, $recipient){

	$mailopt = get_option('cro_class_mails');


	// START TO RENDER THE NEWSLETTER
	ob_start();
	include('templates/croma_emailform.php');
	$tpl 	= ob_get_contents();
	ob_end_clean();


	$from_name 		= 	($recipient == 'admin')? 
						get_post_meta( $id, 'cro_name' , true ) . ' ' . get_post_meta( $id, 'cro_surname' , true ) :
						get_bloginfo('name');


	$recipients 	= cro_fetch_recipients($id,$recipient,$purpose);
	$sender 		= cro_fetch_sender($id,$recipient,$purpose);
	$maininfo 		= cro_fetch_mail_main($id,$type,$purpose);
	$finaltemplate  = cro_fetch_finaltemplate( 	$mailopt[$type . '_t'], 
												$mailopt[$type . '_s'], 
												$mailopt[$type . '_b'], 
												$maininfo, $tpl
					   );



	add_filter('wp_mail_content_type',create_function('', 'return "text/html"; '));	

	$headers = 'From: ' . $from_name . ' <' . $sender[0] . '>';



    wp_mail( $recipients[0], $mailopt[$type . '_t'], $finaltemplate, $headers);
    

};


/**
 * FUNCTION : cro_fetch_finaltemplate
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		transactional part of the email template
 */

function cro_fetch_finaltemplate($title, $subtitle, $body, $maininfo, $tpl){


	$croma 					= get_option('cromatic');


	$mainarray = array(

		array(
			'lookfor' => '::TITLE::',
			'replace' => $title
		),
		array(
			'lookfor' => '::SUBTITLE::',
			'replace' => $subtitle
		),
		array(
			'lookfor' => '::BODY::',
			'replace' => $body
		),
		array(
			'lookfor' => '::MAININFO::',
			'replace' => $maininfo
		),
		array(
			'lookfor' => '::COLOR::',
			'replace' => $croma['cro_maincolor']
		),
		array(
			'lookfor' => '::BLOGNAME::',
			'replace' => get_bloginfo('name')
		),
		array(
			'lookfor' => '::BLOGADDR::',
			'replace' => get_bloginfo('home')
		),
		array(
			'lookfor' => '::BLOGYEAR::',
			'replace' => date('Y',time())
		)

	);

	foreach ($mainarray as $value) {
		$tpl = str_replace($value['lookfor'], $value['replace'], $tpl);
	}


	return $tpl;


}



/**
 * FUNCTION : cro_fetch_mail_main 
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		transactional part of the email template
 */

function cro_fetch_mail_main($id, $type, $purpose){



		$croma 		= get_option('cromatic');
		$currsign 	= ($croma['cro_currsign'] != '')? $croma['cro_currsign'] : '$';
		$currpos 	= ($croma['cro_currpos'] != '')? $croma['cro_currpos'] : 1;


		if (get_post_meta( $id, 'paypaldetails', true ) != '')      { 

          $paypalarray = json_decode(rawurldecode( get_post_meta( $id, 'paypaldetails', true ) ));

        } else {
        	$paypalarray = array();
        }



		switch ($currpos) {
			case 1:
				$payammount = $currsign  . ' ' . get_post_meta( $id, 'cro_ammt', true );
			break;

			case 2: 
				$payammount = get_post_meta( $id, 'cro_ammt', true ) . ' ' . $currsign;
			break;		
			
		}

		if ($type == 'admin_errorwarning') {

			$op .='
			<table border="0" cellpadding="20" cellspacing="0" width="100%">
				<tr>
					<td valign="top" colspan="2" style="padding: 10px 0 0 0;">
						<div>
							<h4 style="text-align:center; padding: 40px; color: #656973; background: #f9f9f9; line-height: 1.6; margin: 0 40px;">
								' . get_post_meta( $id, 'cro_desc', true ) . '<br/><br/>
								' . $payammount . '
							</h4> 
						</div>
					</td>
				</tr>
			</table>

			<table border="0" cellpadding="20" cellspacing="0" width="100%">

				<tr>
					<td valign="top" colspan="2" style="padding: 10px 0 0 0;">
						<div>
							<h5 style="text-align:center; padding: 10px 20px 0 20px; margin: 10px 0; color: #363b47; font-size: 16px;">
								' . __('Personal Details','croma') . '
							</h5> 
						</div>
					</td>
				</tr>

				<tr>
					<td valign="top" style="padding: 0;">
						<div style="text-align: right; font-weight: bold;border: 1px solid #efefef; margin: 3px 10px; padding: 5px;">
							' . __('NAME','croma') . '
						</div>
					</td>

					<td valign="top" style="padding: 0;">
						<div style="border: 1px solid #efefef; margin: 3px 10px; padding: 5px;">
							' . get_post_meta( $id, 'cro_name', true ) . ' ' . get_post_meta( $id, 'cro_surname', true ) . '
						</div>
					</td>
				</tr>

				<tr>
					<td valign="top" style="padding: 0;">
						<div style="text-align: right; border: 1px solid #efefef; margin: 3px 10px; padding: 5px; font-weight: bold;">
							' . __('EMAIL','croma') . '
						</div>
					</td>

					<td valign="top" style="padding: 0;">
						<div style="border: 1px solid #efefef; margin: 3px 10px; padding: 5px;">
							' . get_post_meta( $id, 'cro_email', true ) . '
						</div>
					</td>
				</tr>

			</table>

			<table border="0" cellpadding="20" cellspacing="0" width="100%">

				<tr>
					<td valign="top" colspan="2" style="padding: 10px 0 0 0;">
						<div>
							<h5 style="text-align:center; padding: 10px 20px 0 20px; margin: 10px 0; color: #363b47; font-size: 16px;">
								' . __('Error details','croma') . '
							</h5> 
						</div>
					</td>
				</tr>';


				if (!empty($paypalarray)) {

					foreach ($paypalarray as $key => $value) {

						$op .= '
						<tr>
							<td valign="top" style="padding: 0;">
							<div style="text-align: right; font-weight: bold;border: 1px solid #efefef; margin: 3px 10px; padding: 5px;">
								' . $key . '
							</div>
						</td>

						<td valign="top" style="padding: 0;">
							<div style="border: 1px solid #efefef; margin: 3px 10px; padding: 5px;">
								' . $value . '
							</div>
						</td>
					</tr>';
						
					}

				}


			$op .= '</table>';	

		} elseif ($type == 'admin_justdonated') {

			$op .='
			<table border="0" cellpadding="20" cellspacing="0" width="100%">
				<tr>
					<td valign="top" colspan="2" style="padding: 10px 0 0 0;">
						<div>
							<h4 style="text-align:center; padding: 40px; color: #656973; background: #f9f9f9; line-height: 1.6; margin: 0 40px;">
								' . get_post_meta( $id, 'cro_desc', true ) . '<br/><br/>
								' . $payammount . '
							</h4> 
						</div>
					</td>
				</tr>
			</table>

			<table border="0" cellpadding="20" cellspacing="0" width="100%">

				<tr>
					<td valign="top" colspan="2" style="padding: 10px 0 0 0;">
						<div>
							<h5 style="text-align:center; padding: 10px 20px 0 20px; margin: 10px 0; color: #363b47; font-size: 16px;">
								' . __('Personal Details','croma') . '
							</h5> 
						</div>
					</td>
				</tr>

				<tr>
					<td valign="top" style="padding: 0;">
						<div style="text-align: right; font-weight: bold;border: 1px solid #efefef; margin: 3px 10px; padding: 5px;">
							' . __('NAME','croma') . '
						</div>
					</td>

					<td valign="top" style="padding: 0;">
						<div style="border: 1px solid #efefef; margin: 3px 10px; padding: 5px;">
							' . get_post_meta( $id, 'cro_name', true ) . ' ' . get_post_meta( $id, 'cro_surname', true ) . '
						</div>
					</td>
				</tr>

				<tr>
					<td valign="top" style="padding: 0;">
						<div style="text-align: right; border: 1px solid #efefef; margin: 3px 10px; padding: 5px; font-weight: bold;">
							' . __('EMAIL','croma') . '
						</div>
					</td>

					<td valign="top" style="padding: 0;">
						<div style="border: 1px solid #efefef; margin: 3px 10px; padding: 5px;">
							' . get_post_meta( $id, 'cro_email', true ) . '
						</div>
					</td>
				</tr>

			</table>';	

		} elseif ($type == 'admin_paymentreceived') {


			$op .='
			<table border="0" cellpadding="20" cellspacing="0" width="100%">
				<tr>
					<td valign="top" colspan="2" style="padding: 10px 0 0 0;">
						<div>
							<h4 style="text-align:center; padding: 40px; color: #656973; background: #f9f9f9; line-height: 1.6; margin: 0 40px;">
								' . get_post_meta( $id, 'cro_desc', true ) . '<br/><br/>
								' . $payammount . '
							</h4> 
						</div>
					</td>
				</tr>
			</table>

			<table border="0" cellpadding="20" cellspacing="0" width="100%">

				<tr>
					<td valign="top" colspan="2" style="padding: 10px 0 0 0;">
						<div>
							<h5 style="text-align:center; padding: 10px 20px 0 20px; margin: 10px 0; color: #363b47; font-size: 16px;">
								' . __('Personal Details','croma') . '
							</h5> 
						</div>
					</td>
				</tr>

				<tr>
					<td valign="top" style="padding: 0;">
						<div style="text-align: right; font-weight: bold;border: 1px solid #efefef; margin: 3px 10px; padding: 5px;">
							' . __('NAME','croma') . '
						</div>
					</td>

					<td valign="top" style="padding: 0;">
						<div style="border: 1px solid #efefef; margin: 3px 10px; padding: 5px;">
							' . get_post_meta( $id, 'cro_name', true ) . ' ' . get_post_meta( $id, 'cro_surname', true ) . '
						</div>
					</td>
				</tr>

				<tr>
					<td valign="top" style="padding: 0;">
						<div style="text-align: right; border: 1px solid #efefef; margin: 3px 10px; padding: 5px; font-weight: bold;">
							' . __('EMAIL','croma') . '
						</div>
					</td>

					<td valign="top" style="padding: 0;">
						<div style="border: 1px solid #efefef; margin: 3px 10px; padding: 5px;">
							' . get_post_meta( $id, 'cro_email', true ) . '
						</div>
					</td>
				</tr>

			</table>';	



		} elseif ($type == 'customer_paymentreceived') {


			$op .='
			<table border="0" cellpadding="20" cellspacing="0" width="100%">
				<tr>
					<td valign="top" colspan="2" style="padding: 10px 0 0 0;">
						<div>
							<h4 style="text-align:center; padding: 40px; color: #656973; background: #f9f9f9; line-height: 1.6; margin: 0 40px;">
								' . get_post_meta( $id, 'cro_desc', true ) . '<br/><br/>
								' . $payammount . '
							</h4> 
						</div>
					</td>
				</tr>
			</table>

			<table border="0" cellpadding="20" cellspacing="0" width="100%">

				<tr>
					<td valign="top" colspan="2" style="padding: 10px 0 0 0;">
						<div>
							<h5 style="text-align:center; padding: 10px 20px 0 20px; margin: 10px 0; color: #363b47; font-size: 16px;">
								' . __('Personal Details','croma') . '
							</h5> 
						</div>
					</td>
				</tr>

				<tr>
					<td valign="top" style="padding: 0;">
						<div style="text-align: right; font-weight: bold;border: 1px solid #efefef; margin: 3px 10px; padding: 5px;">
							' . __('NAME','croma') . '
						</div>
					</td>

					<td valign="top" style="padding: 0;">
						<div style="border: 1px solid #efefef; margin: 3px 10px; padding: 5px;">
							' . get_post_meta( $id, 'cro_name', true ) . ' ' . get_post_meta( $id, 'cro_surname', true ) . '
						</div>
					</td>
				</tr>

				<tr>
					<td valign="top" style="padding: 0;">
						<div style="text-align: right; border: 1px solid #efefef; margin: 3px 10px; padding: 5px; font-weight: bold;">
							' . __('EMAIL','croma') . '
						</div>
					</td>

					<td valign="top" style="padding: 0;">
						<div style="border: 1px solid #efefef; margin: 3px 10px; padding: 5px;">
							' . get_post_meta( $id, 'cro_email', true ) . '
						</div>
					</td>
				</tr>

			</table>';	

			

		} elseif ($type == 'admin_cancelled') {


			$op .='
			<table border="0" cellpadding="20" cellspacing="0" width="100%">
				<tr>
					<td valign="top" colspan="2" style="padding: 10px 0 0 0;">
						<div>
							<h4 style="text-align:center; padding: 40px; color: #656973; background: #f9f9f9; line-height: 1.6; margin: 0 40px;">
								' . get_post_meta( $id, 'cro_desc', true ) . '<br/><br/>
								' . $payammount . '
							</h4> 
						</div>
					</td>
				</tr>
			</table>

			<table border="0" cellpadding="20" cellspacing="0" width="100%">

				<tr>
					<td valign="top" colspan="2" style="padding: 10px 0 0 0;">
						<div>
							<h5 style="text-align:center; padding: 10px 20px 0 20px; margin: 10px 0; color: #363b47; font-size: 16px;">
								' . __('Personal Details','croma') . '
							</h5> 
						</div>
					</td>
				</tr>

				<tr>
					<td valign="top" style="padding: 0;">
						<div style="text-align: right; font-weight: bold;border: 1px solid #efefef; margin: 3px 10px; padding: 5px;">
							' . __('NAME','croma') . '
						</div>
					</td>

					<td valign="top" style="padding: 0;">
						<div style="border: 1px solid #efefef; margin: 3px 10px; padding: 5px;">
							' . get_post_meta( $id, 'cro_name', true ) . ' ' . get_post_meta( $id, 'cro_surname', true ) . '
						</div>
					</td>
				</tr>

				<tr>
					<td valign="top" style="padding: 0;">
						<div style="text-align: right; border: 1px solid #efefef; margin: 3px 10px; padding: 5px; font-weight: bold;">
							' . __('EMAIL','croma') . '
						</div>
					</td>

					<td valign="top" style="padding: 0;">
						<div style="border: 1px solid #efefef; margin: 3px 10px; padding: 5px;">
							' . get_post_meta( $id, 'cro_email', true ) . '
						</div>
					</td>
				</tr>

			</table>';	

			

		}


	return $op;

}



/**
 * FUNCTION : cro_fetch_recipients
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		set the recipient of the mail
 */
function cro_fetch_recipients($id,$recipient,$purpose){


	if ($recipient == 'admin'){

		$croma 		= get_option('cromatic');
		$emailarray = ($croma['cro_paypalmail'] != '')? array($croma['cro_paypalmail']) : array(get_option('admin_email')) ;

	} else {

		$emailarray = array(get_post_meta( $id,'cro_email', true ));

	}


	return $emailarray;
	
}




/**
 * FUNCTION : cro_fetch_sender
 *
 * @access public
 * @version 	1.0
 * @since 		1.0
 * @uses 		set the sender of the mail
 */
function cro_fetch_sender($id,$recipient,$purpose){

	if ($recipient == 'admin'){

		$emailarray = array(get_post_meta( $id,'cro_email', true ));

	} else {
		$croma 		= get_option('cromatic');
		$emailarray = ($croma['cro_paypalmail'] != '')? array($croma['cro_paypalmail']) : array(get_option('admin_email')) ;
	}


	return $emailarray;
	
}




