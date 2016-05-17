<?php
/**
 * cromax_shortcodes class.
 *
 * @class 		cromatic_shortcodes
 * @version		1.0
 * @package		cromatic/classes
 * @category	class
 * @author 		Croma
 */

class cromax_shortcodes {


	public function __construct() {

		add_shortcode( 'cromax-streetmap', 						array( $this, 'crx_streetmap'));
		add_shortcode( 'cromax-drivingdir', 					array( $this, 'crx_drivedir'));
		add_shortcode( 'cromax-streetview', 					array( $this, 'crx_streetview'));
		add_shortcode( 'cromax-contactblock', 					array( $this, 'crx_contactblock'));
		add_shortcode( 'cromax-contactitems', 					array( $this, 'crx_contactitems'));
		add_shortcode( 'cromax-twitter', 						array( $this, 'crx_twitter'));
		add_shortcode( 'croma-paypal', 							array( $this, 'crx_paypal'));
		add_shortcode( 'croma-paypal-success', 					array( $this, 'cromax_paypalsucc'));
		add_shortcode( 'croma-paypal-fail', 					array( $this, 'cromax_paypalfail'));
	}




	/**
	 * booking Success page
	 *
	 * @access public
	 * @param mixed $atts
	 * @return string
	 */
	public function cromax_paypalsucc($params = array(), $content = null) {

		$cro_av = array();

		
		if ( isset($_GET['token']) && isset($_GET['id']) ) {

			$data = array(
				'token' 	=> $_GET['token'],
				'payerid' 	=> $_GET['PayerID'],
				'desc' 		=> get_post_meta($_GET['id'], 'cro_desc',true),
				'freq' 		=> get_post_meta($_GET['id'], 'cro_payfreq',true)
			);


			$paypal_check 	= new Cromax_paypal($_GET['id']);
			$cro_av 		= $paypal_check->make_paypal_contact('DoExpressCheckoutPayment',$data);


			update_post_meta( $_GET['id'], 'paypaldetails',  rawurlencode( json_encode($cro_av)) );
			if ($cro_av['ACK'] == 'Success'){
				update_post_meta( $_GET['id'], 'cro_statuslabel',2);
				cromax_sendmail( $_GET['id'], 'admin_paymentreceived', 'admin', 'class');
				cromax_sendmail( $_GET['id'], 'customer_paymentreceived', get_post_meta($_GET['id'], 'cro_email',true), 'class');
			}


		}
	
	}


	/**
	 * booking Success page
	 *
	 * @access public
	 * @param mixed $atts
	 * @return string
	 */
	public function cromax_paypalfail($params = array(), $content = null) {


		$cro_av = array();

		
		if ( isset($_GET['token']) && isset($_GET['id']) ) {

			$data = array(
				'token' 	=> $_GET['token'],
				'payerid' 	=> $_GET['PayerID'],
			);


			$paypal_check 	= new Cromax_paypal($_GET['id']);
			$cro_av 		= $paypal_check->make_paypal_contact('GetExpressCheckoutDetails',$data);


			update_post_meta( $_GET['id'], 'paypaldetails',  rawurlencode( json_encode($cro_av)) );
			if ($cro_av['ACK'] == 'Success'){
				update_post_meta( $_GET['id'], 'cro_statuslabel',3);
				cromax_sendmail( $_GET['id'], 'admin_cancelled', 'admin', 'class');
			}


		}

		return;
	
	}





	/**
	 * paypal
	 *
	 * @access public
	 * @param mixed $atts
	 * @return string
	 */
	public function crx_paypal($params = array(), $content = null) {

		$croma = get_option('cromatic');

		extract(
			shortcode_atts(
				array(
					'min' 		=> 0,
					'max' 		=> 100,
					'def' 		=> 20,
					'step' 		=> 5,
					'repeat' 	=> 1,
			), $params)
		);



		$preffer 	= 	($croma['cro_currpos'] == 1)?   
						( list($prefclass, $prefimg) = array('cro_prefixer', 'cro_has_prefixer') ):   
						( list($prefclass, $prefimg) = array('cro_suffixer', 'cro_has_suffixer') );

		$prefstring =   '<div class="' . $prefclass . '">' . $croma['cro_currsign'] . '</div>';

		$prefix 	= '';
		$suffix 	= $prefstring;

		if ($croma['cro_currpos'] == 1) {
			$prefix =  $prefstring;
			$suffix = '';
		} 

		if ($max >= 1000000){
			$maxclass = 'cro_maxmill';
		} elseif ($max >= 100000) {
			$maxclass = 'cro_maxhun';
		} elseif ($max >= 10000) {
			$maxclass = 'cro_maxtent';
		} elseif ($max >= 1000) {
			$maxclass = 'cro_maxthou';
		} else {
			$maxclass = 'cro_maxstd';
		}

		ob_start();
			include('templates/paypalform.php');
			$output 		= ob_get_contents();
		ob_end_clean();
	
		return $output;
	}





	/**
	 * streetmap
	 *
	 * @access public
	 * @param mixed $atts
	 * @return string
	 */
	public function crx_streetmap($params = array(), $content = null) {


		$purl = plugins_url( 'assets/images/mapmarker.png' , dirname(__FILE__) );


		wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array(), '1.0', false);

		extract(
			shortcode_atts(
				array(
					'address' 		=> 0,
					'height' 		=> '',
					'zoom' 			=> 15,
					'lt' 			=> 0,
					'lg' 			=> 0
			), $params)
		);

		$height 	= ($height != '')?  ' style="height: ' .  $height  . 'px;" ':  '' ;
		$zoom 		= ($zoom != '')?  ' data-zoom="' .  $zoom  . '" ':  ' data-zoom="15" ' ;
		$lt 		= ($lt != '')?  ' data-lt="' .  $lt  . '" ':  ' data-lt="" ' ;
		$lg 		= ($lg != '')?  ' data-lg="' .  $lg  . '" ':  ' data-lg="" ' ;

		return '<div id="map-div" data-addr="' .  $address  . '" ' .  $height  . ' ' .  $zoom . '  data-icon="' .  $purl  .   '" ' .  $lg  .   ' ' .  $lt  .   '> </div>';
		
	}


	/**
	 * Driving Directions
	 *
	 * @access public
	 * @param mixed $atts
	 * @return string
	 */
	public function crx_drivedir($params = array(), $content = null) {


		$purl = plugins_url( 'assets/images/mapmarker.png' , dirname(__FILE__) );


		wp_enqueue_script('google-maps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array(), '1.0', false);

		extract(
			shortcode_atts(
				array(
					'address' 		=> 0,
					'lt' 			=> 0,
					'lg' 			=> 0
			), $params)
		);

		$zoom 		= (isset($zoom) && $zoom != '')?  ' data-zoom="' .  $zoom  . '" ':  ' data-zoom="15" ' ;
		$lt 		= ($lt != '')?  ' data-lt="' .  $lt  . '" ':  ' data-lt="" ' ;
		$lg 		= ($lg != '')?  ' data-lg="' .  $lg  . '" ':  ' data-lg="" ' ;

		return '
		<div class="row">
			<div class="large-6 column">
				<ul class="cro_directionscal">
                    <li class="dir-label">' .  __('To:','croma')   . '</li>
                    <li class="cro_fromaddr">' .   stripslashes($address)  .     '</li>
                    <li class="dir-label">' .  __('From:','croma')   . '</li>
                    <li><input id="from-input" type=text value=""/></li>
                    <li><input id="to-input" type=hidden value="' .   stripslashes($address)  .     '"/></li>
                    <li class="cro_clickouter"><input id="cro_driveclick" class="cro_cust_bg"  type=button value="' .  __('Calculate:','croma')   . '"/></li>
                </ul>
                <div id="dir-container"></div>
			</div>
			<div class="large-6 column">
				<div id="map-drv" data-addr="' .  $address  . '"   data-zoom="15"   data-icon="' .  $purl  .   '" ' .  $lg  .   ' ' .  $lt  .   '> </div>
			</div>
		</div>';
		
	}


	/**
	 * Contact Block
	 *
	 * @access public
	 * @param mixed $atts
	 * @return string
	 */
	public function crx_contactblock($params = array(), $content = null) {

		extract(
			shortcode_atts(
				array(
					'title' 			=> ''
			), $params)
		);

		$title = ($title != '')? '<h2 class="cro_cust_font">' .  $title . '</h2>' :  '' ;


		return '<div class="cro_ctcblock">'  . $title   .  do_shortcode( $content )  .  '</div>';
		
	}

	/**
	 * Contact Block
	 *
	 * @access public
	 * @param mixed $atts
	 * @return string
	 */
	public function crx_contactitems($params = array(), $content = null) {

		extract(
			shortcode_atts(
				array(
					'title' 			=> '',
					'icon' 				=> ''
			), $params)
		);


		return '<div class="cro_ctcitem"><div class="cro_ctctitle">'  . $title   . '</div><div class="cro_ctccnt">' .  do_shortcode( $content )  .  '</div></div>';
		
	}

	/**
	 * Contact Form
	 *
	 * @access public
	 * @param mixed $atts
	 * @return string
	 */
	public function crx_sectiontitle($params = array(), $content = null) {

		extract(
			shortcode_atts(
				array(
					'title' 			=> '',
					'icon' 				=> ''
			), $params)
		);


		return '<h2 class="cro_cust_font section_title">' .  do_shortcode( $content )  .  '<//h2>';
		
	}



	/**
	 * Twitter shortcode
	 *
	 * @access public
	 * @param mixed $atts
	 * @return string
	 */
	public function crx_twitter($params = array(), $content = null) {


		extract(
			shortcode_atts(
				array(
					'username' 		=> 0,
					'conskey' 		=> 0,
					'consecret' 	=> 0,
					'acctoken' 		=> 0,
					'accsecret' 	=> 0,
					'acclabel' 		=> 0,
					'tweetnum' 		=> 0
				), $params
			)
		);


		if (!class_exists('Codebird')) {
		require_once ('libraries/codebird.php');
		}




		Codebird::setConsumerKey($conskey, $consecret);
		$cb = Codebird::getInstance();
		$cb->setToken($acctoken, $accsecret);
		$cb->setReturnFormat(CODEBIRD_RETURNFORMAT_ARRAY);


		try {
			$twitter_data =  $cb->statuses_userTimeline(array(
			array(
				'screen_name'=>$username, 
				'count'=> $tweetnum
			)
		));
		} catch (Exception $e) { return __('Error retrieving tweets','croma'); }


		if (isset($twitter_data['errors'])) {
			print_r($twitter_data['errors'][0]['message']);
		}


		$twittercounter = 1;


  		$op = '<ul class="cromax_tweets">';

  		foreach($twitter_data as $tv) {
  			if ($twittercounter > $tweetnum) {break;}
  			$ago 		= '<a href="http://twitter.com/' . $username . '/statuses/' . $tv['id'] . '" target="_blank" class="cromax_timesince">' . str_replace(' ', '&nbsp;', cromax_twittertime(strtotime($tv['created_at']))) . '&nbsp;' . __('ago', 'croma') . '</a>';
  			$retweet 	= '<a class="cromax_retweet" href="http://twitter.com/intent/retweet?tweet_id=' . $tv['id'] . '" target="_blank"><i class="icon-star"></i><em>' . __('retweet', 'croma') . '</em></a>';
			$reply 		= '<a class="cromax_reply" href="http://twitter.com/intent/tweet?in_reply_to=' . $tv['id'] .  '" target="_blank"><i class="icon-mail-reply"></i><em>' . __('reply', 'croma') . '</em></a>';
			$favorite 	= '<a class="cromax_favorite" href="http://twitter.com/intent/favorite?tweet_id=' . $tv['id'] .  '" target="_blank"><i class="icon-heart"></i><em>' . __('favorite', 'croma') . '</em></a>';
  			$op .= '<li><span class="cromax_twitstring">' .  cromax_linkify_tweet($tv['text'])  . '</span> ' . $ago  . ' ' . $favorite  . ' ' . $retweet  . ' ' . $reply . '</li>';
  			$twittercounter++;
  		}
		$op .= '</ul>';

		if ($acclabel != ''){

			$op .= '<a href="http://twitter.com/' . $username . '" class="cro_twitter_followlabel" target="_blank">' . stripslashes($acclabel) . '</a>';


		}


		return $op;

	}


}