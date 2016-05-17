<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly



/**
 * Cromax Paypal Api
 *
 * The cromax paypal integration
 *
 * @class 		Cromax_paypal
 * @version		1.0.0
 * @package		Donations
 * @category	Class
 * @author 		Croma
 */
class Cromax_paypal {



	/**
     * Constructor for the gateway.
     *
     * @access public
     * @return void
     */
	public function __construct($trans_id) {
		$this->settings 						= get_option('cromatic');
        $this->payurl 							= 'https://api-3t.paypal.com/nvp';
		$this->sandboxurl 						= 'https://api-3t.sandbox.paypal.com/nvp';
		$this->paypaluser 						= $this->settings['cro_paypaluser'];
		$this->paypalpassword 					= $this->settings['cro_paypalpass'];
		$this->paypalsignature 					= $this->settings['cro_paypalsig'];
		$this->issandboxactive 					= $this->settings['cro_paypalmode'];
		$this->paypalversion 					= '72.0';
		$this->name 							= get_post_meta( $trans_id,'cro_name', true );
		$this->surname 							= get_post_meta( $trans_id,'cro_surname', true );
		$this->email 							= get_post_meta( $trans_id,'cro_email', true );
		$this->ammount 							= get_post_meta( $trans_id,'cro_ammt', true );
		$this->invoiceno 						= $trans_id;
		$this->currencycode 					= $this->settings['cro_paypalcurr'];
		$this->pmtsuccess 						= $this->settings['cro_paysucc'];
		$this->pmtfailed 						= $this->settings['cro_payfail'];
	}




	 /**
	 * Prepare the connection and post
	 *
	 * @access public
	 * @return string
	 */
	function make_paypal_contact($type, $data) {


		$pp_url = ($this->issandboxactive == '1')? $this->sandboxurl : $this->payurl;
		$now 	= time() + 2592000;



		switch ($this->currencycode) {
			case 1: 	$currcode = 'AUD'; break;
			case 2: 	$currcode = 'CAD'; break;
			case 3: 	$currcode = 'CZK'; break;
			case 4: 	$currcode = 'DKK'; break;
			case 5: 	$currcode = 'EUR'; break;
			case 6: 	$currcode = 'HKD'; break;
			case 7: 	$currcode = 'HUF'; break;
			case 8: 	$currcode = 'ILS'; break;
			case 9: 	$currcode = 'JPY'; break;
			case 10: 	$currcode = 'MYR'; break;
			case 11: 	$currcode = 'MXN'; break;
			case 12: 	$currcode = 'NOK'; break;
			case 13: 	$currcode = 'NZD'; break;
			case 14: 	$currcode = 'PHP'; break;
			case 15: 	$currcode = 'PLN'; break;
			case 16: 	$currcode = 'GBP'; break;
			case 17: 	$currcode = 'RUB'; break;
			case 18: 	$currcode = 'SGD'; break;
			case 19: 	$currcode = 'SEK'; break;
			case 20: 	$currcode = 'CHF'; break;
			case 21: 	$currcode = 'TWD'; break;
			case 22: 	$currcode = 'THB'; break;
			case 23: 	$currcode = 'TRY'; break;
			case 24: 	$currcode = 'USD'; break;
			
			
		}

		// set default fields 
		$fields = array(
					'USER' 						=> $this->paypaluser,
					'PWD' 						=> $this->paypalpassword,
					'SIGNATURE' 				=> $this->paypalsignature,
					'VERSION' 					=> $this->paypalversion,
				 );
		

		switch ($type) {

			// set fields for expresscheckout
			case 'SetExpressCheckout':
				$fields['PAYMENTACTION'] 		= 'Sale';
				$fields['AMT'] 					= $this->ammount;
				$fields['CURRENCYCODE'] 		= $currcode;
				$fields['REQCONFIRMSHIPPING']	= 0;
    			$fields['NOSHIPPING'] 			= 1;
    			$fields['ALLOWNOTE'] 			= 0;
    			$fields['SOLUTIONTYPE'] 		= 'Sole';
    			$fields['LANDINGPAGE'] 			= 'Billing';
    			$fields['BRANDNAME'] 			= get_option('blogname');
				$fields['RETURNURL'] 			= get_permalink($this->pmtsuccess) . cro_prepare_a_perm() . 'id=' . $this->invoiceno;
				$fields['CANCELURL'] 			= get_permalink($this->pmtfailed) . cro_prepare_a_perm() . 'id=' . $this->invoiceno;					
				$fields['METHOD'] 				= $type;
				$fields['DESC'] 				= $data['description'];		
			break;


			if (isset( $data['freq']) && $data['freq'] != 1 && $type == 'SetExpressCheckout')	{
				$fields['L_BILLINGTYPE0'] 	= 'RecurringPayments';
				$fields['L_BILLINGAGREEMENTDESCRIPTION'] = $data['description'];
			}

			
			// set fields for getexpresscheckoutdetails
			case 'GetExpressCheckoutDetails':
				$fields['TOKEN'] 				= $data['token'];
				$fields['METHOD']				= $type;		
			break;


 			// set fields for get_exresscheckoutdetails
			case 'DoExpressCheckoutPayment':
				$fields['TOKEN'] 				= $data['token'];
				$fields['PAYMENTACTION'] 		= 'Sale';
				$fields['AMT'] 					= $this->ammount;
				$fields['CURRENCYCODE'] 		= $currcode;
				$fields['PAYERID']				= $data['payerid'];
				$fields['METHOD'] 				= $type;
			break;


			if (isset( $data['freq']) && $data['freq'] >= 2 && $type == 'DoExpressCheckoutPayment')	{
				$fields['PROFILESTARTDATE']  	= date('Y-d-mTG:i:sz',$now);
				$fields['DESC'] 			 	= $data['description'];
				$fields['MAXFAILEDPAYMENTS'] 	= 6;
				$fields['INITAMT'] 				= 6;
			}

			if (isset( $data['freq']) && $data['freq'] == 2 && $type == 'DoExpressCheckoutPayment')	{
				$fields['BILLINGPERIOD']  	= 'Month';
				$fields['BILLINGFREQUENCY'] = 12;
			}

			if (isset( $data['freq']) && $data['freq'] == 3 && $type == 'DoExpressCheckoutPayment')	{
				$fields['BILLINGPERIOD']  	= 'Year';
				$fields['BILLINGFREQUENCY']  = 1;
			}


		}

		$response = wp_remote_post( 
						$pp_url, 
						array(
							'method' 		=> 'POST',
							'timeout' 		=> 45,
							'redirection' 	=> 5,
							'httpversion' 	=> '1.0',
							'blocking' 		=> true,
							'headers' 		=> array(),
							'body' 			=> $fields,
							'cookies' 		=> array()
						)
				);

		
		parse_str($response['body'],$result);



		return $result;

	}

}
?>