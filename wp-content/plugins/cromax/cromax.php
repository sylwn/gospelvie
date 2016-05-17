<?php
/**
* Plugin Name: Cromax
* Plugin URI: http://cro.ma
* Description: Cromax extention pack for Croma Themes
* Version: 1.2
* Author: Croma
* Author URI: http://www.cro.ma
* License: Themeforest Regular licence
* 
*
* @package Cromax
* @category Core
* @author Croma
*/



/*  Copyright 2013  Croma  (email : aj@cro.ma)
*
*	The licence for this plugin is The Themeforest regular Licence
*
*	The Regular License grants you, the purchaser, an ongoing, non-exclusive, 
*	worldwide license to make use of the digital work (Item) you have selected. 
*
*	Read the rest of this license for the details that apply to your use of the Item, 
*	as well as the FAQs (which form part of this license) at the address below:
*
*	http://themeforest.net/licenses/regular
*
*	Support for this licence will only be granted with the purchase of a Themeforest Theme.
*
*/


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


if ( ! class_exists( 'Cromax' ) ) {

/**
 * Main Cromax
 *
 * Contains the main functions for Cromax
 *
 * @class Cromax
 * @version 1.0
 * @since 1.0
 * @package	Cromax
 * @author Cromax
 */

class Cromax {


	/**
	 * @var string
	 */
	public $plugin_url = 0;



	/**
	 * @var string
	 */
	public $plugin_path = 0;



	/**
	 * Cromax Constructor.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {

		// Installation
		register_activation_hook( __FILE__, array( $this, 'activate' ) );

		$this->crx_includes();

		add_action( 'init', array( $this, 'init' ), 0 );


		$plugin_path = $this->plugin_path();

	}



	/**
	 * Init Cromatic when WordPress Initialises.
	 *
	 * @access public
	 * @return void
	 */
	public function init() {

		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );

		$this->shortcodes	= new cromax_shortcodes();	

		load_plugin_textdomain('croma', false, basename( dirname( __FILE__ ) ) . '/languages' );

		$this->init_taxonomy();

	}




	/**
	 * Register/queue backendend scripts.
	 *
	 * @access public
	 * @return void
	 */
	public function init_taxonomy() {
		include('calendars/cromax-calendar-posttype.php');
		include('mediacast/cromax-mediacast-posttype.php');
		include('paypal/cromax-paypal-posttype.php');
	}


	/**
	 * Register/queue frontend scripts.
	 *
	 * @access public
	 * @return void
	 */
	public function frontend_scripts() {

		$purl = $this->plugin_url() . '/assets/crx-styles.css';
		
		wp_enqueue_style('crx_styles', $purl, array(), null, 'all');

		$jurl = $this->plugin_url() . '/assets/js/cromax-app.js';

		wp_register_script( 'crx_app', $jurl, array( 'jquery'), '1.0', true );

		$vals = array(
				'ajaxurl' 		=> urldecode(admin_url( 'admin-ajax.php')),
				'cro_nonces' 	=> wp_create_nonce( 'cro_ajax_functions')
			);


		wp_localize_script( 'crx_app', 'cro_query', $vals);  
		wp_enqueue_script( 'crx_app' );

	}


	/**
	 * Register post types and taxonomies.
	 *
	 * @access public
	 * @return void
	 */
	public function crx_includes() {
		if (is_admin()) {
			
		}
		include('cromax-metaboxes.php');
		include('cromax-ajax.php');
		include('cromax-functions.php');
		include('classes/class-cromax-shortcodes.php');
		include('widgets/cromax-widgets.php');
		include('calendars/cromax-calendar-init.php');
		include('mediacast/cromax-mediacast-init.php');
		include('paypal/cromax-paypal-init.php');
		include('emails/cromax-email-init.php');
	}



	/**
	 * Get the plugin url.
	 *
	 * @access public
	 * @return string
	 */
	public function plugin_url() {
		if ( $this->plugin_url ) return $this->plugin_url;
		return $this->plugin_url = untrailingslashit( plugins_url( '/', __FILE__ ) );
	}


	/**
	 * Get the plugin path.
	 *
	 * @access public
	 * @return string
	 */
	public function plugin_path() {
		if ( $this->plugin_path ) return $this->plugin_path;

		return $this->plugin_path = untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

}


/**
 * Init CromaRest class
 */
$GLOBALS['cromax'] = new Cromax();

}
?>