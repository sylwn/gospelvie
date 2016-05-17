<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php
/**
 * Main Croma Functions File
 *
 *
 * @package Croma.framework
 * @subpackage Croma.framework
 * @since 1.0
 */


if ( ! class_exists( 'Cromatheme' ) ) {


/**
 * Main Cromatheme Class
 *
 * Contains the main functions for Cromathemes, stores variables, and handles error messages
 *
 * @class Cromatheme
 * @version	1.0
 * @since 1.0
 * @package	Cromatheme
 * @author Cromatheme
 */
class Cromatheme {


	/**
	 * @var string
	 */
	public $version = '1.0';

	/**
	 * Cromatheme Constructor.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {

		// Define version constant
		define( 'CROMATHEME_VERSION', $this->version );

		// Include required files
		$this->includes();

		// Run the init sequence
		add_action( 'init', array( $this, 'init' ), 0 );


		// Run the init sequence
		add_action( 'init', array( $this, 'installs' ), 0 );


		// Favicons Function
		add_action('wp_head', array( $this, 'favicons' ));

	}


	/**
	 * Include required core files used in admin and on the frontend.
	 *
	 * @access public
	 * @return void
	 */
	function includes() {
		// Functions
		include_once( 'cromafunctions.php' );					// Contains core functions for the front/back end
		include_once( 'croma-taxfields.php' );					// Contains core functions for the front/back end
		include_once( 'cromaposttypes.php' );					// Contains custom post type functions
		include_once( 'cromasidebars.php' );					// Contains custom post type functions
		include_once( 'croma-ajax.php' );						// Contains custom post type functions
		include_once( 'megamenu/cromatic-megamenu-init.php' );	// Contains custom post type functions

		if (is_admin()) {
			include_once( 'admin/cromatic-admin-init.php' );		// Contains core functions for the meta-boxes
			
		}
	}



	/**
	 * Init Cromatheme scripts & styles when WordPress Initialises.
	 *
	 * @access public
	 * @return void
	 */
	public function init() {
		add_action( 'wp_enqueue_scripts', array( $this, 'cromatheme_scripts' ),0);
		add_action( 'wp_enqueue_scripts', array( $this, 'cromatheme_style_scripts' ),99);
		
	}




	/**
	 * Register/queue frontend scripts.
	 *
	 * @access public
	 * @return void
	 */
	public function cromatheme_scripts() {
		$script_path 	= get_template_directory_uri() . '/assets/js/';         // path to javascript folder
		$script_path2 	= get_template_directory_uri() . '/assets/styles/';     // path to stylesheets folder
		$croma 			= get_option('cromatic');								// get the theme options


		// create the array to be localized with the scripts
		$vals = array(
			'ajaxurl' 		=> urldecode(admin_url( 'admin-ajax.php')),
			'cro_nonces' 	=> wp_create_nonce( 'cro_ajax_functions')
		);


		// register the standard scripts.
		wp_register_script( 'croma-modernizr', $script_path . 'modernizer.min.js', array('jquery','mediaelement'), '1.0', false );
		wp_register_script( 'croma-scripts', $script_path . 'cromatheme-app.js', array( 'jquery' ), '1.0', true );
		wp_register_script( 'croma-apps', $script_path . 'croma-app.js', array( 'jquery'), '1.0', true );

		wp_localize_script( 'croma-apps', 'cro_query', $vals);   
		


		// enqueue the fonts needed
		$cromafont   	= $croma['cro_mainfont'];								// get the font settings
		$cromamenufont  = $croma['cro_menufont'];								// get the font settings
		$cromaheadfont  = $croma['cro_headfont'];								// get the font settings
		$cromabodyfont  = $croma['cro_bodyfont'];								// get the font settings
		$fontstack 		= croma_createfontsarray(array($cromafont,$cromamenufont, $cromaheadfont, $cromabodyfont),'enqueueing');

		$finalarray 	= '';

		foreach ($fontstack as $b) {
			$variant  		 =  (strpos(implode(",", $b["variant"]), 'latin') !== FALSE)? '' : '&subset=' . implode(",", $b["variant"]) ;
			$finalarray 	.= str_replace(" ", "+", $b["fontname"]) . ':' . implode(",", $b["subset"]) . $variant .'|'; 
		}

		wp_enqueue_style('croma_font', 'http://fonts.googleapis.com/css?family=' .  rtrim($finalarray, "|"), array(), null, 'all');  

		wp_enqueue_style('tp-kaushan-css', 'http://fonts.googleapis.com/css?family=Kaushan+Script', array(), null, 'all');  

		wp_enqueue_style('tp-lato-css', 'http://fonts.googleapis.com/css?family=Lato%3A400%2C900%2C700%2C300', array(), null, 'all');  



		// Enqueue scripts
		if (  is_singular() ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// enqueue scripts
		wp_enqueue_script( 'croma-modernizr' );
		wp_enqueue_script( 'croma-apps' );
		wp_enqueue_script( 'croma-scripts' );

	}



	/**
	 * Register/queue frontend styles.
	 *
	 * @access public
	 * @return void
	 */
	public function cromatheme_style_scripts() {
		$script_path 	= get_template_directory_uri() . '/assets/js/';         // path to javascript folder
		$script_path2 	= get_template_directory_uri() . '/assets/styles/';     // path to stylesheets folder
		$croma 			= get_option('cromatic');								// get the theme options
		$cromafont   	= $croma['cro_mainfont'];								// get the font settings							// get the theme options

		
		// Register and scripts
		wp_register_style('cro-stylesheet', get_stylesheet_uri(), array(), '1.0', 'all');	


		// Enqueue scripts
		wp_enqueue_style( 'cro-stylesheet' );


		// Fetch inline styles
		$custom_css = cromatheme_get_theme_css();
		wp_add_inline_style( 'cro-stylesheet', $custom_css);
	}



	/**
	 * Funciton to add favicons to the header
	 *
	 * @access public
	 * @return void
	 */
	public function favicons() {
		$croma 					= get_option('cromatic');

		$faviconarray  =  ($croma['cro_favicon0'] 	!= '')? '<link rel="icon" href="' . esc_url($croma['cro_favicon0']) . '">' : '';
		$faviconarray .=  ($croma['cro_favicon76'] 	!= '')? '<link rel="apple-touch-icon" href="' . esc_url($croma['cro_favicon76']) . '" sizes="76x76">' : '';
		$faviconarray .=  ($croma['cro_favicon120'] != '')? '<link rel="apple-touch-icon"  href="' . esc_url($croma['cro_favicon120']) . '"  sizes="120x120">' : '';
		$faviconarray .=  ($croma['cro_favicon152'] != '')? '<link rel="apple-touch-icon"  href="' . esc_url($croma['cro_favicon152']) . '"  sizes="152x152">' : '';
		$faviconarray .=  ($croma['cro_favicon144'] != '')? '<name="msapplication-TileImage" content="' . esc_url($croma['cro_favicon144']) . '"><meta name="msapplication-TileColor" content="' . $color . '"/> <meta name="application-name" content="' .  get_bloginfo('name') . '" />' : '';
		$faviconarray .=  ($croma['cro_favicon70'] 	!= '')? '<meta name="msapplication-square70x70logo" content="' . esc_url($croma['cro_favicon70']) . '">' : '';
		$faviconarray .=  ($croma['cro_favicon150'] != '')? '<meta name="msapplication-square150x150logo" content="' . esc_url($croma['cro_favicon150']) . '">' : '';
		$faviconarray .=  ($croma['cro_favicon310'] != '')? '<meta name="msapplication-square310x310logo" content="' . esc_url($croma['cro_favicon310']) . '">' : '';

		echo $faviconarray;

	}



	 /**
	 * Installs the default options for use in the theme
	 *
	 * @access public
	 * @return void
	 */
	public function installs() {
		
		define( 'THEMENAME', 'Modena' ); 

		$croma_setuparray 		= array();
		$cromess_setuparray 	= array();
		$croma 					= get_option('cromatic');
		$crommess 				= get_option('cro_class_mails');


		if (!isset( $crommess ) || empty($crommess)){

			$cromess_setuparray['admin_justdonated_t'] 			= 'New donation started on your website';
			$cromess_setuparray['admin_justdonated_s'] 			= 'Good day admin. You had a new donation on your website customer is being directed to paypal right now';
			$cromess_setuparray['admin_justdonated_b'] 			= 'Below the details of donation';

			$cromess_setuparray['admin_errorwarning_t'] 		= 'There was an error with a donation';
			$cromess_setuparray['admin_errorwarning_s'] 		= 'Good day admin. There was an error and a donation did not get processed';
			$cromess_setuparray['admin_errorwarning_b'] 		= 'Below the details of the error';


			$cromess_setuparray['customer_paymentreceived_t'] 	= 'Thank you for your donation.';
			$cromess_setuparray['customer_paymentreceived_s'] 	= 'We received your payment. Thank you';
			$cromess_setuparray['customer_paymentreceived_b'] 	= 'Below the details of the donation';

			$cromess_setuparray['admin_paymentreceived_t'] 		= 'A donation payment was sucessful.';
			$cromess_setuparray['admin_paymentreceived_s'] 		= 'A payment made through Paypal was successful';
			$cromess_setuparray['admin_paymentreceived_b'] 		= 'Details of the donation below';


			$cromess_setuparray['admin_cancelled_t'] 			= 'Cancelled donation';
			$cromess_setuparray['admin_cancelled_s'] 			= 'Good day admin. There was a cancelled donation. Details below. You might want to follow up with the donor.';
			$cromess_setuparray['admin_cancelled_b'] 			= 'Below the details of the cancellation';

		
			update_option( 'cro_class_mails',  $cromess_setuparray);
		}



		if (!isset( $croma ) || empty($croma)){


			$croma_setuparray['cro_headtype'] 		= 1;
			$croma_setuparray['cro_hedcolor'] 		= '#313438';
			$croma_setuparray['cro_maincolor'] 		= '#EA392B';
			$croma_setuparray['cro_mainfont'] 		= 'Lato|400|latin';
			$croma_setuparray['cro_logoimg'] 		= '';
			$croma_setuparray['cro_logopadtop'] 	= 25;
			$croma_setuparray['cro_logopadbottom'] 	= 20;


			$croma_setuparray['cro_menufont'] 		= 'Lato|400|latin';
			$croma_setuparray['cro_fontsize'] 		= 13;
			$croma_setuparray['cro_menresponsive'] 	= 940;
			$croma_setuparray['cro_mainmenbg'] 		= '#292C2F';
			$croma_setuparray['cro_mainmencol'] 	= '#C1C5C9';
			$croma_setuparray['cro_submenbg'] 		= '#EA392B';
			$croma_setuparray['cro_submencol'] 		= '#FFFFFF';
			$croma_setuparray['cro_subpadding'] 	= 45;


			$croma_setuparray['cro_topb'] 			= 1;
			$croma_setuparray['cro_topbartext'] 	= 'Add any text here.';
			$croma_setuparray['cro_secondbg'] 		= '#191B1D';
			$croma_setuparray['cro_secondcol'] 		= '#949AA1';




			$croma_setuparray['cro_headfont'] 		= 'Lato|400|latin';
			$croma_setuparray['cro_bodyfont'] 		= 'Lato|400|latin';


			$croma_setuparray['cro_headimg'] 		= get_template_directory_uri() . '/assets/styles/images/headimg.jpg';
			$croma_setuparray['cro_imgtile'] 		= 4;
			$croma_setuparray['cro_headheight'] 	= 250;
			$croma_setuparray['cro_headtextcol'] 	= '#ffffff';
			$croma_setuparray['cro_headmaskcol'] 	= '#000000';
			$croma_setuparray['cro_headmask'] 		= 40;


			$croma_setuparray['cro_facebook'] 		= '';
			$croma_setuparray['cro_twitter'] 		= '';
			$croma_setuparray['cro_linkedin'] 		= '';
			$croma_setuparray['cro_flickr'] 		= '';
			$croma_setuparray['cro_foursquare'] 	= '';
			$croma_setuparray['cro_instagram'] 		= '';
			$croma_setuparray['cro_googleplus'] 	= '';
			$croma_setuparray['cro_pinterest'] 		= '';
			$croma_setuparray['cro_youtube'] 		= '';


			$croma_setuparray['cro_favicon0'] 		= '';
			$croma_setuparray['cro_favicon76'] 		= '';
			$croma_setuparray['cro_favicon120'] 	= '';
			$croma_setuparray['cro_favicon152'] 	= '';
			$croma_setuparray['cro_favicon144'] 	= '';
			$croma_setuparray['cro_favicon70'] 		= '';
			$croma_setuparray['cro_favicon150'] 	= '';
			$croma_setuparray['cro_favicon310'] 	= '';


			$croma_setuparray['cro_paypaluser'] 	= '';
			$croma_setuparray['cro_paypalpass'] 	= '';
			$croma_setuparray['cro_paypalsig'] 		= '';
			$croma_setuparray['cro_paypalcurr'] 	= 'USD';
			$croma_setuparray['cro_paypalmail'] 	= get_option('admin_email');
			$croma_setuparray['cro_paysucc'] 		= '';
			$croma_setuparray['cro_payfail'] 		= '';
			$croma_setuparray['cro_paypalmode'] 	= 2;
			$croma_setuparray['cro_currsign'] 		= '$';
			$croma_setuparray['cro_currpos'] 		= 1;
			$croma_setuparray['cro_globalmin'] 		= 100;
			$croma_setuparray['cro_globalmax'] 		= 10000;


			$croma_setuparray['cro_analyticscode'] 	= '';
			$croma_setuparray['cro_stylerules'] 	= '';


			$croma_setuparray['cro_excptlngth'] 	= 30;
			$croma_setuparray['cro_catsidebar'] 	= 3;


			update_option( 'cromatic',  $croma_setuparray);

		}

		

		include dirname( __FILE__ ) . '/installs/tgm_modified_plugin.php';
		add_action( 'tgmpa_register', array( $this, 'cromatheme_installs' ) );

	}

	/**
	 * Installs action file
	 *
	 * @access public
	 * @return void
	 */
	public function cromatheme_installs() {
		
		$plugins = array(
			array(
				'name'     				=> 'Contact form 7',
				'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
				'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '3.9.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented. If the plugin version is higher than the plugin version installed , the user will be notified to update the plugin
			),
			array(
				'name'     				=> 'Cromax',
				'slug'     				=> 'cromax', // The plugin slug (typically the folder name)
				'source'   				=> get_template_directory_uri()  . '/inc/installs/cromax.zip',
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '1.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented. If the plugin version is higher than the plugin version installed , the user will be notified to update the plugin
				'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			),
			array(
				'name'     				=> 'Slider Revolution',
				'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
				'source'   				=> get_template_directory_uri()  . '/inc/installs/revslider.zip',
				'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
				'version' 				=> '4.6.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented. If the plugin version is higher than the plugin version installed , the user will be notified to update the plugin
				'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
				'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
				'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
			)
		);




    	$theme_text_domain = 'croma';

    	$config = array(
        	'domain'            => $theme_text_domain,           
        	'default_path'      => '',                          
        	'parent_menu_slug'  => 'themes.php',         
        	'parent_url_slug'   => 'themes.php',        
        	'menu'              => 'install-required-plugins',  
        	'has_notices'       => true,                        
        	'is_automatic'      => true,            
        	'message'           => '',              
        	'strings'           => array(
            	'page_title'                        => __( 'Install Required Plugins', $theme_text_domain ),
            	'menu_title'                        => __( 'Install Plugins', $theme_text_domain ),
            	'installing'                        => __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
            	'oops'                              => __( 'Something went wrong with the plugin API.', $theme_text_domain ),
            	'notice_can_install_required'       => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
            	'notice_can_install_recommended'    => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
            	'notice_cannot_install'             => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
            	'notice_can_activate_required'      => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            	'notice_can_activate_recommended'   => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
            	'notice_cannot_activate'            => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
            	'notice_ask_to_update'              => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
            	'notice_cannot_update'              => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
            	'install_link'                     	=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            	'activate_link'                  	=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
            	'return'                       		=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
            	'plugin_activated'       			=> __( 'Plugin activated successfully.', $theme_text_domain ),
            	'complete' 							=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ) // %1$s = dashboard link
        	)

		);

		tgmpa( $plugins, $config );

	}

}


$GLOBALS['Cromatheme'] = new Cromatheme();


}
?>
