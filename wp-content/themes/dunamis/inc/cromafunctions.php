<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
	die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php
/**
 * Cromatheme Core Functions
 *
 * Functions available on both the front-end and admin.
 *
 * @author   Cromatheme
 * @category  Core
 * @package  theme/inc
 * @version     1.0
 */





/**
 * Quick general purpose array formatter for getting a small post array.
 *
 * @access public
 * @return array
 */
function cromatheme_return_array( $posttype, $post_status ) {


	$op 	= array();
	$myargs = array(
		'posts_per_page'   	=> -1,
		'post_type'			=>$posttype,
		'post_status' 		=> $post_status
	); 
	
	$my_newquery = get_posts( $myargs );

	foreach ( $my_newquery as $mynewpost ){ 
		$op[] =  $mynewpost->ID;
	}

	return $op;

}


/**
 * FUNCTION : cromatheme_processmetas  - 
 *
 * @access public
 * @version   1.0
 * @since     1.0
 * @uses      format a collection of metabox values
 */


function cromatheme_processmetas($args, $id) {

  $id = (is_numeric($id)) ? $id : 0 ;
  $returnarray = array();

  foreach ($args as $value) {
    $returnarray[] = (get_post_meta( $id, $value, true ) != '')?  get_post_meta( $id, $value, true ) : '' ;
  }

  return $returnarray;
  
}





/**
 * Generate Dynamic theme colors & generate the inline styles
 *
 * @access public
 * @return array
 */
function cromatheme_get_theme_css() {

	$croma 					= get_option('cromatic');
	$color    				= $croma['cro_maincolor'];
	$secmenbg    			= $croma['cro_secondbg'];
	$secmencol    			= $croma['cro_secondcol'];
	$croma_font  			= $croma['cro_mainfont'];
	$croma_menfont  		= $croma['cro_menufont'];
	$cromafont   			= $croma['cro_mainfont'];
	$croma_menfontsize 		= $croma['cro_fontsize'];



	if ( !empty( $croma_font ) ) {
		$fontfamilydeclaration = 'font-family: ' . $croma_font . ',sans-serif; font-weight: normal !important;';
	}
	if ( !empty( $croma_menfont ) ) {
		$menufontfamilydeclaration = 'font-family: ' . $croma_menfont . ',sans-serif; font-weight: normal !important;';
	}


	ob_start();
	
	include('templates/cromastyles.php');
	$op = ob_get_contents();

	ob_end_clean();

	return $op;


}




/**
 * Message to assist with innitial setup
 *
 * @access public
 * @return array
 */

function cromatheme_show_admin_mess() {
	if ( get_option( 'show_on_front' ) == 'posts' ) {
		echo '<div class="error"><p>' .  __( 'Front page is currently set as a blog page.<br/> To make it look the theme you need to do the following:<br/><br/> 1. Create a front page<br/>2. Set the front page template as "front page"<br/>3.  Create a blog page.<br/>4. Set your "frontpage displays" in settings->reading.<br/><br/> You can view a short video on achieving these settings <a target="_blank" href="https://vimeo.com/70324939">here</a>', 'croma' )  . '</p></div>';
	}
}
add_action( 'admin_notices', 'cromatheme_show_admin_mess' );






/**
 * Return a list with all the google fonts
 *
 * @access public
 * @return array
 */

function cromatheme_show_webfonts() {
	return array( "ABeeZee", "Abel", "Abril Fatface", "Aclonica", "Acme", "Actor", "Adamina", "Advent Pro", "Aguafina Script", "Akronim", "Aladin", "Aldrich", "Alegreya", "Alegreya SC", "Alex Brush", "Alfa Slab One", "Alice", "Alike", "Alike Angular", "Allan", "Allerta", "Allerta Stencil", "Allura", "Almendra", "Almendra Display", "Almendra SC", "Amarante", "Amaranth", "Amatic SC", "Amethysta", "Anaheim", "Andada", "Andika", "Angkor", "Annie Use Your Telescope", "Anonymous Pro", "Antic", "Antic Didone", "Antic Slab", "Anton", "Arapey", "Arbutus", "Arbutus Slab", "Architects Daughter", "Archivo Black", "Archivo Narrow", "Arimo", "Arizonia", "Armata", "Artifika", "Arvo", "Asap", "Asset", "Astloch", "Asul", "Atomic Age", "Aubrey", "Audiowide", "Autour One", "Average", "Average Sans", "Averia Gruesa Libre", "Averia Libre", "Averia Sans Libre", "Averia Serif Libre", "Bad Script", "Balthazar", "Bangers", "Basic", "Battambang", "Baumans", "Bayon", "Belgrano", "Belleza", "BenchNine", "Bentham", "Berkshire Swash", "Bevan", "Bigelow Rules", "Bigshot One", "Bilbo", "Bilbo Swash Caps", "Bitter", "Black Ops One", "Bokor", "Bonbon", "Boogaloo", "Bowlby One", "Bowlby One SC", "Brawler", "Bree Serif", "Bubblegum Sans", "Bubbler One", "Buda", "Buenard", "Butcherman", "Butterfly Kids", "Cabin", "Cabin Condensed", "Cabin Sketch", "Caesar Dressing", "Cagliostro", "Calligraffitti", "Cambo", "Candal", "Cantarell", "Cantata One", "Cantora One", "Capriola", "Cardo", "Carme", "Carrois Gothic", "Carrois Gothic SC", "Carter One", "Caudex", "Cedarville Cursive", "Ceviche One", "Changa One", "Chango", "Chau Philomene One", "Chela One", "Chelsea Market", "Chenla", "Cherry Cream Soda", "Cherry Swash", "Chewy", "Chicle", "Chivo", "Cinzel", "Cinzel Decorative", "Clicker Script", "Coda", "Coda Caption", "Codystar", "Combo", "Comfortaa", "Coming Soon", "Concert One", "Condiment", "Content", "Contrail One", "Convergence", "Cookie", "Copse", "Corben", "Courgette", "Cousine", "Coustard", "Covered By Your Grace", "Crafty Girls", "Creepster", "Crete Round", "Crimson Text", "Croissant One", "Crushed", "Cuprum", "Cutive", "Cutive Mono", "Damion", "Dancing Script", "Dangrek", "Dawning of a New Day", "Days One", "Delius", "Delius Swash Caps", "Delius Unicase", "Della Respira", "Denk One", "Devonshire", "Didact Gothic", "Diplomata", "Diplomata SC", "Domine", "Donegal One", "Doppio One", "Dorsa", "Dosis", "Dr Sugiyama", "Droid Sans", "Droid Sans Mono", "Droid Serif", "Duru Sans", "Dynalight", "EB Garamond", "Eagle Lake", "Eater", "Economica", "Electrolize", "Elsie", "Elsie Swash Caps", "Emblema One", "Emilys Candy", "Engagement", "Englebert", "Enriqueta", "Erica One", "Esteban", "Euphoria Script", "Ewert", "Exo", "Expletus Sans", "Fanwood Text", "Fascinate", "Fascinate Inline", "Faster One", "Fasthand", "Federant", "Federo", "Felipa", "Fenix", "Finger Paint", "Fjalla One", "Fjord One", "Flamenco", "Flavors", "Fondamento", "Fontdiner Swanky", "Forum", "Francois One", "Freckle Face", "Fredericka the Great", "Fredoka One", "Freehand", "Fresca", "Frijole", "Fruktur", "Fugaz One", "GFS Didot", "GFS Neohellenic", "Gafata", "Galdeano", "Galindo", "Gentium Basic", "Gentium Book Basic", "Geo", "Geostar", "Geostar Fill", "Germania One", "Gilda Display", "Give You Glory", "Glass Antiqua", "Glegoo", "Gloria Hallelujah", "Goblin One", "Gochi Hand", "Gorditas", "Goudy Bookletter 1911", "Graduate", "Grand Hotel", "Gravitas One", "Great Vibes", "Griffy", "Gruppo", "Gudea", "Habibi", "Hammersmith One", "Hanalei", "Hanalei Fill", "Handlee", "Hanuman", "Happy Monkey", "Headland One", "Henny Penny", "Herr Von Muellerhoff", "Holtwood One SC", "Homemade Apple", "Homenaje", "IM Fell DW Pica", "IM Fell DW Pica SC", "IM Fell Double Pica", "IM Fell Double Pica SC", "IM Fell English", "IM Fell English SC", "IM Fell French Canon", "IM Fell French Canon SC", "IM Fell Great Primer", "IM Fell Great Primer SC", "Iceberg", "Iceland", "Imprima", "Inconsolata", "Inder", "Indie Flower", "Inika", "Irish Grover", "Istok Web", "Italiana", "Italianno", "Jacques Francois", "Jacques Francois Shadow", "Jim Nightshade", "Jockey One", "Jolly Lodger", "Josefin Sans", "Josefin Slab", "Joti One", "Judson", "Julee", "Julius Sans One", "Junge", "Jura", "Just Another Hand", "Just Me Again Down Here", "Kameron", "Karla", "Kaushan Script", "Kavoon", "Keania One", "Kelly Slab", "Kenia", "Khmer", "Kite One", "Knewave", "Kotta One", "Koulen", "Kranky", "Kreon", "Kristi", "Krona One", "La Belle Aurore", "Lancelot", "Lato", "League Script", "Leckerli One", "Ledger", "Lekton", "Lemon", "Libre Baskerville", "Life Savers", "Lilita One", "Limelight", "Linden Hill", "Lobster", "Lobster Two", "Londrina Outline", "Londrina Shadow", "Londrina Sketch", "Londrina Solid", "Lora", "Love Ya Like A Sister", "Loved by the King", "Lovers Quarrel", "Luckiest Guy", "Lusitana", "Lustria", "Macondo", "Macondo Swash Caps", "Magra", "Maiden Orange", "Mako", "Marcellus", "Marcellus SC", "Marck Script", "Margarine", "Marko One", "Marmelad", "Marvel", "Mate", "Mate SC", "Maven Pro", "McLaren", "Meddon", "MedievalSharp", "Medula One", "Megrim", "Meie Script", "Merienda", "Merienda One", "Merriweather", "Metal", "Metal Mania", "Metamorphous", "Metrophobic", "Michroma", "Milonga", "Miltonian", "Miltonian Tattoo", "Miniver", "Miss Fajardose", "Modern Antiqua", "Molengo", "Molle", "Monda", "Monofett", "Monoton", "Monsieur La Doulaise", "Montaga", "Montez", "Montserrat", "Montserrat Alternates", "Montserrat Subrayada", "Moul", "Moulpali", "Mountains of Christmas", "Mouse Memoirs", "Mr Bedfort", "Mr Dafoe", "Mr De Haviland", "Mrs Saint Delafield", "Mrs Sheppards", "Muli", "Mystery Quest", "Neucha", "Neuton", "New Rocker", "News Cycle", "Niconne", "Nixie One", "Nobile", "Nokora", "Norican", "Nosifer", "Nothing You Could Do", "Noticia Text", "Nova Cut", "Nova Flat", "Nova Mono", "Nova Oval", "Nova Round", "Nova Script", "Nova Slim", "Nova Square", "Numans", "Nunito", "Odor Mean Chey", "Offside", "Old Standard TT", "Oldenburg", "Oleo Script", "Oleo Script Swash Caps", "Open Sans", "Open Sans Condensed", "Oranienbaum", "Orbitron", "Oregano", "Orienta", "Original Surfer", "Oswald", "Over the Rainbow", "Overlock", "Overlock SC", "Ovo", "Oxygen", "Oxygen Mono", "PT Mono", "PT Sans", "PT Sans Caption", "PT Sans Narrow", "PT Serif", "PT Serif Caption", "Pacifico", "Paprika", "Parisienne", "Passero One", "Passion One", "Patrick Hand", "Patua One", "Paytone One", "Peralta", "Permanent Marker", "Petit Formal Script", "Petrona", "Philosopher", "Piedra", "Pinyon Script", "Pirata One", "Plaster", "Play", "Playball", "Playfair Display", "Playfair Display SC", "Podkova", "Poiret One", "Poller One", "Poly", "Pompiere", "Pontano Sans", "Port Lligat Sans", "Port Lligat Slab", "Prata", "Preahvihear", "Press Start 2P", "Princess Sofia", "Prociono", "Prosto One", "Puritan", "Purple Purse", "Quando", "Quantico", "Quattrocento", "Quattrocento Sans", "Questrial", "Quicksand", "Quintessential", "Qwigley", "Racing Sans One", "Radley", "Raleway", "Raleway Dots", "Rambla", "Rammetto One", "Ranchers", "Rancho", "Rationale", "Redressed", "Reenie Beanie", "Revalia", "Ribeye", "Ribeye Marrow", "Righteous", "Risque", "Roboto", "Roboto Condensed", "Rochester", "Rock Salt", "Rokkitt", "Romanesco", "Ropa Sans", "Rosario", "Rosarivo", "Rouge Script", "Ruda", "Rufina", "Ruge Boogie", "Ruluko", "Rum Raisin", "Ruslan Display", "Russo One", "Ruthie", "Rye", "Sacramento", "Sail", "Salsa", "Sanchez", "Sancreek", "Sansita One", "Sarina", "Satisfy", "Scada", "Schoolbell", "Seaweed Script", "Sevillana", "Seymour One", "Shadows Into Light", "Shadows Into Light Two", "Shanti", "Share", "Share Tech", "Share Tech Mono", "Shojumaru", "Short Stack", "Siemreap", "Sigmar One", "Signika", "Signika Negative", "Simonetta", "Sirin Stencil", "Six Caps", "Skranji", "Slackey", "Smokum", "Smythe", "Sniglet", "Snippet", "Snowburst One", "Sofadi One", "Sofia", "Sonsie One", "Sorts Mill Goudy", "Source Code Pro", "Source Sans Pro", "Special Elite", "Spicy Rice", "Spinnaker", "Spirax", "Squada One", "Stalemate", "Stalinist One", "Stardos Stencil", "Stint Ultra Condensed", "Stint Ultra Expanded", "Stoke", "Strait", "Sue Ellen Francisco", "Sunshiney", "Supermercado One", "Suwannaphum", "Swanky and Moo Moo", "Syncopate", "Tangerine", "Taprom", "Telex", "Tenor Sans", "Text Me One", "The Girl Next Door", "Tienne", "Tinos", "Titan One", "Titillium Web", "Trade Winds", "Trocchi", "Trochut", "Trykker", "Tulpen One", "Ubuntu", "Ubuntu Condensed", "Ubuntu Mono", "Ultra", "Uncial Antiqua", "Underdog", "Unica One", "UnifrakturCook", "UnifrakturMaguntia", "Unkempt", "Unlock", "Unna", "VT323", "Vampiro One", "Varela", "Varela Round", "Vast Shadow", "Vibur", "Vidaloka", "Viga", "Voces", "Volkhov", "Vollkorn", "Voltaire", "Waiting for the Sunrise", "Wallpoet", "Walter Turncoat", "Warnes", "Wellfleet", "Wendy One", "Wire One", "Yanone Kaffeesatz", "Yellowtail", "Yeseva One", "Yesteryear", "Zeyada" );
}





/**
 * A function for parsing Vimeo and Youtube Video's
 *
 * @access public
 * @return array
 */

function cro_parsevideo( $string, $type ) {

	$matches 	= array();
	$ipart1 	= 'ifr';
	$ipart2 	= $ipart1 . 'ame';


	// large regex to identify youtube videos 

	$youtubestring = '~								# Match Youtube link and embed code
				(?: 								# Group to match embed codes
				(?:<' .  $ipart2  . ' [^>]*src=")?	# If iframe match up to first quote of src
				|(?:				 				# Group to match if older embed
				(?:<object .*>)?					# Match opening Object tag
				(?:<param .*</param>)*				# Match all param tags
				(?:<embed [^>]*src=")?				# Match embed tag to the first quote of src
				)?									# End older embed code group
				)?									# End embed code groups
				(?:									# Group youtube url
   				https?:\/\/		         			# Either http or https
   				(?:[\w]+\.)*		        		# Optional subdomains
   				(?:               	        		# Group host alternatives.
       			youtu\.be/      	        		# Either youtu.be,
       			| youtube\.com		 				# or youtube.com
       			| youtube-nocookie\.com	 			# or youtube-nocookie.com
   				)				 					# End Host Group
   				(?:\S*[^\w\-\s])?       			# Extra stuff up to VIDEO_ID
   				([\w\-]{11})		        		# $1: VIDEO_ID is numeric
				[^\s]*								# Not a space
				)				 					# End group
				"?				 					# Match end quote if part of src
				(?:[^>]*>)?			 				# Match any extra stuff up to close brace
				(?:				 					# Group to match last embed code
   				</' .  $ipart2  . '>		        # Match the end of the iframe
   				|</embed></object>	        		# or Match the end of the older embed
				)?				 					# End Group of last bit of embed code
				~ix';


	// large regex to identify vimeo videos
	$vimeostring = '~  								# Match Vimeo link and embed code
				(?:<' .  $ipart2  . ' [^>]*src=")? 	# If iframe match up to first quote of src
				(?:									# Group vimeo url
				https?:\/\/							# Either http or https
				(?:[\w]+\.)*						# Optional subdomains
				vimeo\.com							# Match vimeo.com
				(?:[\/\w]*\/videos?)?				# Optional video sub directory this handles groups links also
				\/									# Slash before Id
				([0-9]+)							# $1: VIDEO_ID is numeric
				[^\s]*								# Not a space
				)									# End group
				"?									# Match end quote if part of src
				(?:[^>]*></' .  $ipart2  . '>)?		# Match the end of the iframe
				(?:<p>.*</p>)?		        		# Match any title information stuff
				~ix';


	// return code for either youtube or vime obased on the regex result.
	if ( $type  == 'youtube' ) {
		preg_match( $youtubestring, $string, $matches );
	} else {
		preg_match( $vimeostring, $string, $matches );
	}

	return $matches;
}



/**
 * A function for identifying Vimeo and Youtube Video's amongst different link types
 *
 * @access public
 * @return array
 */

function cro_identifyvideo( $url, $id = 0 ) {


	// register the variables
	$returninfo 	= $vinf = array();
	$service 		= '';
	$vidno 			= $url;
	$ipart1 		= 'ifr';
	$ipart2 		= $ipart1 . 'ame';


	// QUICKLY DETERMINE WHICH TYPE OF SERVICE WE WILL NEED TO ACCESS.
	if ( !is_numeric( $url ) ) {
		$service 		= 'youtube';
		if ( strpos( $url, 'vimeo' ) !== false ) {
			$service 	= 'vimeo';
			$vinf 		= cro_parsevideo( $url, 'vimeo' );
		} else {
			$vinf 		= cro_parsevideo( $url, 'youtube' );
		}
	} else {
		$service 		= 'vimeo';
	}

	
	// extract the video number
	if ( isset( $vinf[1] ) && $vinf != '' ) {
		$vidno = $vinf[1];
	}

	if ( $vidno !== $id ) {

		switch ( $service ) {

		// setup an array for vimeo videos
		case 'vimeo':
			$response 		= wp_remote_get( esc_url_raw( 'http://vimeo.com/api/v2/video/' . $vidno . '.php' ), array( 'User-Agent' => 'wordpress' ) );
			$response_code 	= wp_remote_retrieve_response_code( $response );
			if ( 200 == $response_code ) {
				$videoinfo 				= unserialize( wp_remote_retrieve_body( $response ) );
				$returninfo['thumb'] 	=  $videoinfo[0]['thumbnail_large'];
				$returninfo['id'] 		=  $vidno;
				$returninfo['frame'] 	= '<' .  $ipart2  . ' src="http://player.vimeo.com/video/' .  $vidno . '?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="600" height="350" allowFullScreen></' .  $ipart2  . '>';
			}
		break;


		// setup an array for youtube videos
		case 'youtube':
			$returninfo['thumb'] 	=  'http://img.youtube.com/vi/' . $vidno  . '/mqdefault.jpg';
			$returninfo['id'] 		=  $vidno;
			$returninfo['frame'] 	= '<' .  $ipart2  . ' width="600" height="250" src="http://youtube.com/embed/' . $vidno . '" allowfullscreen></' .  $ipart2  . '>';
			break;
		}


		// return the array for the video
		return $returninfo;

	} else {
		return '';
	}
}




/**
 * The croma Paging function
 *
 * @access public
 * @return array
 */


if ( ! function_exists( 'cro_paging' ) ) {

	function cro_paging() {
		global $wp_rewrite, $wp_query;

		if ( isset($query) ) {$wp_query = $query;}
		if ( 1 >= $wp_query->max_num_pages ) return;


		// set all the variables
		$current 		= ( get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1 );
		$max_num_pages 	= intval( $wp_query->max_num_pages );



		// set all the paging default values
		$defaults = array(
			'base' 				=> add_query_arg( 'paged', '%#%' ),
			'format' 			=> '',
			'total' 			=> $max_num_pages,
			'current' 			=> $current,
			'prev_next' 		=> true,
			'prev_text' 		=> '<i class="icon-chevron-left"></i>',
			'next_text' 		=> '<i class="icon-chevron-right"></i>',
			'show_all' 			=> false,
			'end_size' 			=> 1,
			'mid_size' 			=> 1,
			'add_fragment' 		=> '',
			'type' 				=> 'plain',
			'before' 			=> '<div class="cro_paging">',
			'after' 			=> '</div>',
			'echo' 				=> true,
		);



		// set the values if permalinks are enabled.
		if ( $wp_rewrite->using_permalinks() )
			$defaults['base'] = user_trailingslashit( trailingslashit( get_pagenum_link() ) . 'page/%#%' );



		// set the values if this is asearch page.
		if ( is_search() ) {

			$search_permastruct = $wp_rewrite->get_search_permastruct();
			if ( !empty( $search_permastruct ) )
			$defaults['base'] = user_trailingslashit( trailingslashit( get_search_link() ) . 'page/%#%' );

		}


		// set one variable for all the defaults.
		$args = $defaults;

		
		// set hte type for the output
		if ( 'array' == $args['type'] )
			$args['type'] = 'plain';


		// build the links
		$page_links = paginate_links( $args );
		$page_links = str_replace( array( '&#038;paged=1\'', '/page/1\'' ), '\'', $page_links );
		$page_links = $args['before'] . $page_links . $args['after'];


		// output the paging 
		if ( $args['echo'] )
			echo $page_links;
		else
			return $page_links;

	}
}


 /**
 * Get all the woo commerce functions if woo comemrce is active.
 *
 * @access public
 * @return void
 */

if ( class_exists( 'Woocommerce' ) ) {
 	include('woo-functions.php');
 }




/**
 * Add a new frontpage post
 *
 * @access public
 * @return void
 */
function cromatic_make_pagepost($type) {


	// count the current pages and add a new number
  $count_pages 	= wp_count_posts('cromaticfronts');
  $runningcount = ($count_pages->private) + 1;



  // insert a new post
  $post_id = wp_insert_post( array(
    'post_type'       => 'cromaticfronts',
    'post_status'     => 'private',
    'comment_status'  => 'closed',
    'post_content'    => '',
    'post_title'      => cromatic_randstring(10),
    'post_author'     => '1'
  ) );



  // add all the needed meta values
  add_post_meta($post_id, 'cro_type', $type, '');
  add_post_meta($post_id, 'cro_activated', '0', '');
  add_post_meta($post_id, 'cromatic_post_order', $runningcount, '');

  return $post_id;

}



/**
 * Add a new frontpage post
 *
 * @access public
 * @return void
 */
function cromatic_make_mm_pagepost($left, $right, $title) {


	// count the current pages and add a new number
  $count_pages 	= wp_count_posts('cromaticfronts');
  $runningcount = ($count_pages->private) + 1;



  // insert a new post
  $post_id = wp_insert_post( array(
    'post_type'       => 'cromaticmms',
    'post_status'     => 'private',
    'comment_status'  => 'closed',
    'post_content'    => '',
    'post_title'      => urldecode($title),
    'post_author'     => '1'
  ) );



  // add all the needed meta values
  add_post_meta($post_id, 'cro_type1', $left, '');
   add_post_meta($post_id, 'cro_type2', $right, '');
  add_post_meta($post_id, 'cro_activated', '0', '');
  add_post_meta($post_id, 'cromatic_post_order', $runningcount, '');

  return $post_id;

}



/**
 * Build a random string
 *
 * @access public
 * @return void
 */

function cromatic_randstring($length, $charset='abcdefghijklmnopqrstuvwxyz')
{
    $str = '';
    $count = strlen($charset);
    while ($length--) {
        $str .= $charset[mt_rand(0, $count-1)];
    }
    return $str;
}


/**
 * Get the attachement id from the attachment source
 *
 * @access public
 * @return void
 */

function cro_attachment_id_from_src ($image_src) {
	global $wpdb;
	$query = "SELECT ID FROM {$wpdb->posts} WHERE guid='$image_src'";
	$id = $wpdb->get_var($query);
	return $id;
}




/**
 * Return formatted meta
 *
 * @access public
 * @return void
 */

function croma_meta_part ($id, $meta_label, $before, $after) {

	// get all the meta values to build the argument	
	$metatest = stripslashes(html_entity_decode(get_post_meta( $id, $meta_label, true )));

	// if no values were submitted, exit
	if ($metatest == '') { return; }
	if (!isset($metatest) || $metatest == '') { return; }



	// return the values
	return $before . $metatest . $after;

}



/**
 * Return formatted meta as a link
 *
 * @access public
 * @return void
 */

function 	croma_meta_makelink ($id, $link, $label, $color, $bg, $target, $wrapper_before, $wrapper_after){


	// return empty if there's no link
	if (get_post_meta( $id, $link, true ) == '') {return;}


	// set the label
	$label = (get_post_meta( $id, $link, true ) != '')? stripslashes(html_entity_decode(get_post_meta( $id, $label, true ))) :  __('More Info','croma');


	// set the color settings
	$color 	= ($color != '' && get_post_meta( $id, $color, true ) != '')? ' color: '  . get_post_meta( $id, $color, true )  .  '; ' : '' ;
	$bg 	= ($bg != '' && get_post_meta( $id, $bg, true ) != '')? ' background: '  . get_post_meta( $id, $bg, true )  .  '; ' : '' ;
	$style 	= ($color.$bg != '')? 'style=" ' .  $color  .  $bg  .  ' "' : '' ;


	// set the target
	$target = ($target == '_blank')? 'target="_blank"' : '' ;



	return $wrapper_before . '<a href="' . get_post_meta( $id, $link, true ) . '" ' . $style . ' ' . $target . '>' .  $label  .  '</a>' . $wrapper_after;


}




/**
 * Return formatted meta as a link
 *
 * @access public
 * @return void
 */

function 	croma_meta_makeinfolink ($id, $link, $label, $color, $bg, $target, $wrapper_before, $wrapper_after){



	// set the label
	$label = (get_post_meta( $id, $label, true ) != '')? stripslashes(html_entity_decode(get_post_meta( $id, $label, true ))) :  __('More Info','croma');


	// set the color settings
	$color 	= ($color != '' && get_post_meta( $id, $color, true ) != '')? ' color: '  . get_post_meta( $id, $color, true )  .  '; ' : '' ;
	$bg 	= ($bg != '' && get_post_meta( $id, $bg, true ) != '')? ' background: '  . get_post_meta( $id, $bg, true )  .  '; ' : '' ;
	$style 	= ($color.$bg != '')? 'style=" ' .  $color  .  $bg  .  ' "' : '' ;


	// set the target
	$target = ($target == '_blank')? 'target="_blank"' : '' ;

	if (get_post_meta( $id, $link, true ) == '') {

		return $wrapper_before .   $label   . $wrapper_after;

	} else {

		return $wrapper_before . '<a href="' . get_post_meta( $id, $link, true ) . '" ' . $style . ' ' . $target . '>' .  $label  .  '</a>' . $wrapper_after;

	}


}



/**
 * Return formatted meta as background style
 *
 * @access public
 * @return void
 */

function 	croma_meta_makebgstyle ($id, $image, $size){

	$image_id 		= cro_attachment_id_from_src (get_post_meta( $id, $image, true ));
	$image_src 		= wp_get_attachment_image_src( $image_id, $size);


	if (isset($image_src[0]) && $image_src[0] != '') {
		return ' background: url(' . $image_src[0] . ') no-repeat center; background-size: cover; ';
	} else {
		return ' background: url(' . get_post_meta( $id, $image, true ) . ') no-repeat center; background-size: cover; ';
	}


}





/**
 * Return formatted a image mask
 *
 * @access public
 * @return void
 */

function cro_makemask($id, $bg, $col){

	$color 	= get_post_meta( $id, $col, true );
	$bg 	= get_post_meta( $id, $bg, true );

	$color 	= ($color != '')? ' background:  '  . $color . '  ; ' : '' ;

	$bg 	= ($bg != '')? ' opacity:  ' . $bg/100 . ' ' : '' ;


	if ($color . $bg!= '') {
		return '<div class="cro_maskdiv" style="' . $color . $bg . '"></div>';
	} else {
		return;
	}

}





/**
 * Return a link from formatted meta
 *
 * @access public
 * @return void
 */

function croma_meta_createlink($id, $address, $label, $default, $class, $wrap) {


	// get all the meta values	
	$metalink 	= get_post_meta( $id, $address, true );
	$metalabel 	= get_post_meta( $id, $label, true );
	$metalabel 	= ($metalabel != '')?  $metalabel:  $default;


	// should the function be wrapped in a paragraph?
	if ($wrap == 'yes' ) {
		$wrapstart = '<p class="' . $class  . '_p">';
		$wrapend = '</p>';
	} else {
		$wrapstart = '';
		$wrapend = '';
	}


	// return empty or return a complete string
	if ($metalink == '') { return; }
	return $wrapstart . '<a class="' . $class  . '" href="' . $metalink . '" title="' .  $metalabel . '" alt="' .  $metalabel . '">' .  $metalabel . '</a>' . $wrapend;

}





/**
 * Excerpt shortner
 *
 * @access public
 * @return void
 */

class CroExcerpt {

  public static $length = 55;

  public static function length($new_length = 55) {
    CroExcerpt::$length = $new_length;
    add_filter('excerpt_length', 'CroExcerpt::new_length');
    CroExcerpt::output();
  }

  public static function new_length() {
      return CroExcerpt::$length;
  }

  public static function output() {
    the_excerpt();
  }

}

// An alias to the class
function cro_excerpt($length = 55) {
  CroExcerpt::length($length);
}


/**
 * Fonticon list
 *
 * @access public
 * @return void
 */

function get_fonticons() {
	return array('glass,music,search,envelope-alt,heart,star,star-empty,user,film,th-large,th,th-list,ok,remove,
		zoom-in,zoom-out,power-off,off,signal,gear,cog,trash,home,file-alt,time,road,download-alt,download,upload,inbox,play-circle,
rotate-right,repeat,refresh,list-alt,lock,flag,headphones,volume-off,volume-down,volume-up,qrcode,barcode,tag,tags,
book,bookmark,print,camera,font,bold,italic,text-height,text-width,align-left,align-center,align-right,
align-justify,list,indent-left,indent-right,facetime-video,picture,pencil,map-marker,adjust,tint,edit,share,check,
move,step-backward,fast-backward,backward,play,pause,stop,forward,fast-forward,step-forward,eject,chevron-left,
chevron-right,plus-sign,minus-sign,remove-sign,ok-sign,question-sign,info-sign,screenshot,remove-circle,ok-circle,
ban-circle,arrow-left,arrow-right,arrow-up,arrow-down,mail-forward,share-alt,resize-full,resize-small,plus,minus,
asterisk,exclamation-sign,gift,leaf,fire,eye-open,eye-close,warning-sign,plane,calendar,random,comment,magnet,
chevron-up,chevron-down,retweet,shopping-cart,folder-close,folder-open,resize-vertical,resize-horizontal,bar-chart,
twitter-sign,facebook-sign,camera-retro,key,gears,cogs,comments,thumbs-up-alt,thumbs-down-alt,star-half,
heart-empty,signout,linkedin-sign,pushpin,external-link,signin,trophy,github-sign,upload-alt,lemon,phone,unchecked,
check-empty,bookmark-empty,phone-sign,twitter,facebook,github,unlock,credit-card,rss,hdd,bullhorn,bell,certificate,
hand-right,hand-left,hand-up,hand-down,circle-arrow-left,circle-arrow-right,circle-arrow-up,circle-arrow-down,globe,
wrench,tasks,filter,briefcase,fullscreen,group,link,cloud,beaker,cut,copy,paperclip,paper-clip,save,sign-blank,
reorder,list-ul,list-ol,strikethrough,underline,table,magic,truck,pinterest,pinterest-sign,google-plus-sign,
google-plus,money,caret-down,caret-up,caret-left,caret-right,columns,sort,sort-down,sort-up,envelope,linkedin,
rotate-left,undo,legal,dashboard,comment-alt,comments-alt,bolt,sitemap,umbrella,paste,lightbulb,exchange,
cloud-download,cloud-upload,user-md,stethoscope,suitcase,bell-alt,coffee,food,file-text-alt,building,hospital,
ambulance,medkit,fighter-jet,beer,h-sign,plus-sign-alt,double-angle-left,double-angle-right,double-angle-up,
double-angle-down,angle-left,angle-right,angle-up,angle-down,desktop,laptop,tablet,mobile-phone,circle-blank,
quote-left,quote-right,spinner,circle,mail-reply,reply,github-alt,folder-close-alt,folder-open-alt,expand-alt,
collapse-alt,smile,frown,meh,gamepad,keyboard,flag-alt,flag-checkered,terminal,code,reply-all,mail-reply-all,
star-half-full,star-half-empty,location-arrow,,crop,code-fork,unlink,question,minfo,exclamation,superscript,
subscript,eraser,puzzle-piece,microphone,,microphone-off,shield,calendar-empty,fire-extinguisher,rocket,maxcdn,
chevron-sign-left,chevron-sign-right,,chevron-sign-up,chevron-sign-down,html5,css3,anchor,unlock-alt,bullseye,
ellipsis-horizontal,,ellipsis-vertical,rss-sign,play-sign,ticket,minus-sign-alt,check-minus,level-up,level-down,
check-sign,edit-sign,external-link-sign,share-sign,compass,collapse,collapse-top,expand,euro,eur,gbp,dollar,usd,
rupee,inr,yen,jpy,renminbi,cny,won,krw,bitcoin,btc,file,file-text,sort-by-alphabet,sort-by-alphabet-alt,
sort-by-attributes,sort-by-attributes-alt,sort-by-order,sort-by-order-alt,thumbs-up,thumbs-down,youtube-sign,
youtube,xing,xing-sign,youtube-play,dropbox,stackexchange,instagram,flickr,adn,bitbucket,bitbucket-sign,tumblr,
tumblr-sign,long-arrow-down,long-arrow-up,long-arrow-left,long-arrow-right,apple,windows,android,linux,dribbble,
skype,foursquare,trello,female,male,gittip,sun,moon,archive,bug,vk,weibo,renren
	');
}



/**
 * Fonticon list
 *
 * @access public
 * @return void
 */

function croma_get_analytics() {
	$croma = get_option('cromatic');
	echo $croma['cro_analyticscode'];
}
add_action('wp_footer', 'croma_get_analytics');





/**
 * Return a list with the selected social services
 *
 * @access public
 * @return void
 */

function cro_get_sociallist() {

	$croma = get_option( 'cromatic');

	$facebook 	= ($croma['cro_facebook'] != '' )? '<li class="cro_facebook"><a href="' . esc_url($croma['cro_facebook'])  . '" target="_blank"><i class="icon-facebook"></i></a></li>' : '';
	$twitter	= ($croma['cro_twitter'] != '' )? '<li class="cro_twitter"><a href="' .  esc_url($croma['cro_twitter']) . '" target="_blank"><i class="icon-twitter"></i></a></li>' : '';
	$flickr		= ($croma['cro_flickr'] != '' )? '<li class="cro_flickr"><a href="' . esc_url($croma['cro_flickr'])  . '" target="_blank"><i class="icon-flickr"></i></a></li>' : '';
	$foursquare	= ($croma['cro_foursquare'] != '' )? '<li class="cro_foursquare"><a href="' . esc_url($croma['cro_foursquare'])  . '" target="_blank"><i class="icon-foursquare"></i></a></li>' : '';
	$insatagram	= ($croma['cro_instagram'] != '' )? '<li class="cro_insatagram"><a href="' .  esc_url($croma['cro_instagram']) . '" target="_blank"><i class="icon-instagram"></i></a></li>' : '';
	$googleplus = ($croma['cro_googleplus'] != '' )? '<li class="cro_googleplus"><a href="' . esc_url($croma['cro_googleplus'])  . '" target="_blank"><i class="icon-google-plus"></i></a></li>' : '';
	$pinterest 	= ($croma['cro_pinterest'] != '' )? '<li class="cro_pinterest"><a href="' . esc_url($croma['cro_pinterest'])  . '" target="_blank"><i class="icon-pinterest"></i></a></li>' : '';
	$youtube 	= ($croma['cro_youtube'] != '' )? '<li class="cro_youtube"><a href="' . esc_url($croma['cro_youtube'])  . '" target="_blank"><i class="icon-youtube"></i></a></li>' : '';
	$linkedin 	= ($croma['cro_linkedin'] != '' )? '<li class="cro_linkedin"><a href="' . esc_url($croma['cro_linkedin'])  . '" target="_blank"><i class="icon-linkedin"></i></a></li>' : '';

	$socialtest = $facebook . $twitter . $flickr . $foursquare . $insatagram . $googleplus . $pinterest . $youtube . $linkedin;


	return ($socialtest != '')?  '<ul class="cro_sociallinks clearfix">' . $socialtest . '</ul>' : '' ;

}




/**
 * Return a list of all gallery items for a post.
 *
 * @access public
 * @return void
 */

function cro_get_gallerylist($id) {

	$retarray = array();

	// if there's no valid post number return
	if (!is_numeric($id)) {return $retarray;}

	
	// get the gallery post content & match to regexes
	$gallery_content 	= get_post( $id );
	preg_match ('/'. get_shortcode_regex() .'/s', $gallery_content->post_content, $gallery_matches);


	// search for the gallery id's among all the strings of shortcodes and return only the ids.
	foreach ( $gallery_matches as $value ) {

		if ( strpos( $value, 'ids="' ) !== FALSE ){

			$subval = explode( " ", $value );

			foreach ( $subval as $vv ) {

				if ( strpos( $vv, 'ids="' ) !== FALSE ){
					$ids[] = $vv;
				}

			}
		}
	}


	// sort to make sure unique post id's are returned
	$result 		= implode( ",", array_unique($ids,SORT_NUMERIC) ) ;
	$result 		= explode(",",str_replace(array('ids="','"'), "", $result));
	$retarray 		= array_unique($result,SORT_NUMERIC) ;

	return $retarray;

}




/**
 * Return a list of fontinfo for enqueueing and css use.
 *
 * @access public
 * @return void
 */


function croma_createfontsarray($fontsarray,$type){
	$returnarray = array();

	foreach ($fontsarray as $value) {


		// set the variables		
		$fval 									= explode("|", $value);
		$returnarray[$fval[0]]['fontname'] 		= $fval[0];
		$subsetarray 							= (isset($returnarray[$fval[0]]['subset']))? $returnarray[$fval[0]]['subset'] : '';
		$variantarray 							= (isset($returnarray[$fval[0]]['variant']))? $returnarray[$fval[0]]['variant']: '';



		// append and add to the subset array
		if (!isset($subsetarray) || empty($subsetarray)){

			$returnarray[$fval[0]]['subset'] = array($fval[1]);

		} elseif (!in_array($fval[1], $subsetarray)){

			array_push( $returnarray[$fval[0]]['subset'] , $fval[1] );

		}


		// append and add ot the variantarray
		if (!isset($variantarray) || empty($variantarray) ){

			$returnarray[$fval[0]]['variant'] = array($fval[2]);

		} elseif (!in_array($fval[2], $variantarray)){

			array_push( $returnarray[$fval[0]]['variant'] , $fval[2] );

		}




	}


	// return the output
	return $returnarray;


}



function cro_setfont_styles($font){



	$fontnames = explode('|', $font);
	$style = '';

	if (strpos($fontnames[1],'italic') !== false) {

    	$style = ' font-style: italic; ';

	}

	return 'font-family:"' . $fontnames[0] . '"; font-weight:' . str_replace(array('italic','regular'),array('','normal'),$fontnames[1]) . '; ' . $style;

}





function croc_url($year, $month) {
        global $wp_rewrite;
        $year_month_value = $year . $month;
        $year_month_path = $year . "/" . $month;
        
        $url = home_url() . "/?m=" . $year_month_value . "&post_type=mediacast";        
        if ($wp_rewrite->using_permalinks()) {
            $cat_pos = strpos($wp_rewrite->permalink_structure, "%mediacast%");            
            if ($cat_pos != false) {
                // if %category% is in the permalink structure, figure out if year is before or after it
                $year_pos = strpos($wp_rewrite->permalink_structure, "%year%");                            
                if ($year_pos != false) {
                    $url = home_url() . "/";
                    if ($cat_pos < $year_pos) {
                        $url .= "mediacast/" . $year_month_path . "/";
                    } else {
                        $url .=  $year_month_path . "/mediacast/";
                    }
                }
            }
        }
        return ($url);
    }



?>
