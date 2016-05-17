<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/**
 *
 * cromax-functions
 * 
 * @author    AJ aj@cro.ma
 * @package   Cromax
 * @category  Cromax
 * @copyright   Copyright (c) 2014, Alwyn Kotze & Croma
 * @version   1.0
 * @since     1.0
 * @uses    croma core functions
 */


/**
 * FUNCTION : cromax_get_fonticons  - 
 *
 * @access public
 * @version   1.0
 * @since     1.0
 * @uses    a array wit hall the fontawesome fonts for use in the components
 */

function cromax_get_fonticons() {
	return array('glass','music','search','envelope-alt','heart','star','star-empty','user',
    'film','th-large','th','th-list','ok','remove','zoom-in','zoom-out','power-off','off',
    'signal','gear','cog','trash','home','file-alt','time','road','download-alt','download',
    'upload','inbox','play-circle','rotate-right','repeat','refresh','list-alt','lock','flag',
    'headphones','volume-off','volume-down','volume-up','qrcode','barcode','tag','tags','book',
    'bookmark','print','camera','font','bold','italic','text-height','text-width','align-left',
    'align-center','align-right','align-justify','list','indent-left','indent-right',
    'facetime-video','picture','pencil','map-marker','adjust','tint','edit','share','check',
    'move','step-backward','fast-backward','backward','play','pause','stop','forward',
    'fast-forward','step-forward','eject','chevron-left','chevron-right','plus-sign',
    'minus-sign','remove-sign','ok-sign','question-sign','info-sign','screenshot',
    'remove-circle','ok-circle','ban-circle','arrow-left','arrow-right','arrow-up','arrow-down',
    'mail-forward','share-alt','resize-full','resize-small','plus','minus','asterisk',
    'exclamation-sign','gift','leaf','fire','eye-open','eye-close','warning-sign','plane',
    'calendar','random','comment','magnet','chevron-up','chevron-down','retweet','shopping-cart',
    'folder-close','folder-open','resize-vertical','resize-horizontal','bar-chart','twitter-sign',
    'facebook-sign','camera-retro','key','gears','cogs','comments','thumbs-up-alt','thumbs-down-alt',
    'star-half','heart-empty','signout','linkedin-sign','pushpin','external-link','signin','trophy',
    'github-sign','upload-alt','lemon','phone','unchecked','check-empty','bookmark-empty',
    'phone-sign','twitter','facebook','github','unlock','credit-card','rss','hdd','bullhorn','bell',
    'certificate','hand-right','hand-left','hand-up','hand-down','circle-arrow-left',
    'circle-arrow-right','circle-arrow-up','circle-arrow-down','globe','wrench','tasks','filter',
    'briefcase','fullscreen','group','link','cloud','beaker','cut','copy','paperclip','paper-clip',
    'save','sign-blank','reorder','list-ul','list-ol','strikethrough','underline','table','magic',
    'truck','pinterest','pinterest-sign','google-plus-sign','google-plus','money','caret-down',
    'caret-up','caret-left','caret-right','columns','sort','sort-down','sort-up','envelope',
    'linkedin','rotate-left','undo','legal','dashboard','comment-alt','comments-alt','bolt','sitemap',
    'umbrella','paste','lightbulb','exchange','cloud-download','cloud-upload','user-md','stethoscope',
    'suitcase','bell-alt','coffee','food','file-text-alt','building','hospital','ambulance','medkit',
    'fighter-jet','beer','h-sign','plus-sign-alt','double-angle-left','double-angle-right',
    'double-angle-up','double-angle-down','angle-left','angle-right','angle-up','angle-down',
    'desktop','laptop','tablet','mobile-phone','circle-blank','quote-left','quote-right','spinner',
    'circle','mail-reply','reply','github-alt','folder-close-alt','folder-open-alt','expand-alt',
    'collapse-alt','smile','frown','meh','gamepad','keyboard','flag-alt','flag-checkered','terminal',
    'code','reply-all','mail-reply-all','star-half-full','star-half-empty','location-arrow','crop',
    'code-fork','unlink','question','minfo','exclamation','superscript','subscript','eraser',
    'puzzle-piece','microphone','microphone-off','shield','calendar-empty','fire-extinguisher','rocket',
    'maxcdn','chevron-sign-left','chevron-sign-right','chevron-sign-up','chevron-sign-down','html5',
    'css3','anchor','unlock-alt','bullseye','ellipsis-horizontal','ellipsis-vertical','rss-sign',
    'play-sign','ticket','minus-sign-alt','check-minus','level-up','level-down','check-sign',
    'edit-sign','external-link-sign','share-sign','compass','collapse','collapse-top','expand',
    'euro','eur','gbp','dollar','usd','rupee','inr','yen','jpy','renminbi','cny','won','krw',
    'bitcoin','btc','file','file-text','sort-by-alphabet','sort-by-alphabet-alt',
    'sort-by-attributes','sort-by-attributes-alt','sort-by-order','sort-by-order-alt','thumbs-up',
    'thumbs-down','youtube-sign','youtube','xing','xing-sign','youtube-play','dropbox',
    'stackexchange','instagram','flickr','adn','bitbucket','bitbucket-sign','tumblr','tumblr-sign',
    'long-arrow-down','long-arrow-up','long-arrow-left','long-arrow-right','apple','windows','android',
    'linux','dribbble','skype','foursquare','trello','female','male','gittip','sun','moon','archive',
    'bug','vk','weibo','renren');
}



/**
 * FUNCTION : cro_get_thumbnail  - 
 *
 * @access public
 * @version   1.0
 * @since     1.0
 * @uses      return a thumbnail url from a full url.
 */
function cro_get_thumbnail($image_url) {
	

  // load the database global and get values directly from the database
  global $wpdb;
	$prefix      = $wpdb->prefix;
	$attachment  = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " WHERE guid='%s';", $image_url )); 


  // if nothing is returned then abort
  if (!isset($attachment) || empty($attachment)) {  return; }


  // get the value and return the funciton
  $image_thumb = wp_get_attachment_image_src($attachment[0], 'thumbnail');   
  return $image_thumb[0]; 
 

}




/**
 * Prepare a variable "tail" depending on permalink settings
 *
 * @access public
 * @param string $tariff, $currency
 * @return string
 */
function cro_prepare_a_perm(){
  global $wp_rewrite;
  if ($wp_rewrite->permalink_structure == ''){
    return '&';
  } 
    

  return '?';


}


/**
 * FUNCTION : cro_get_ftb  - 
 *
 * @access public
 * @version   1.0
 * @since     1.0
 * @uses      return a thumbnail url from a full url.
 */
function cro_get_ftb($image_url) {
  

  // load the database global and get values directly from the database
  global $wpdb;
  $prefix      = $wpdb->prefix;
  $attachment  = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " WHERE guid='%s';", $image_url )); 


  // if nothing is returned then abort
  if (!isset($attachment) || empty($attachment)) {  return; }


  // get the value and return the funciton
  $image_thumb = wp_get_attachment_image_src($attachment[0], 'cro_third');   
  return $image_thumb[0]; 
 

}




/**
 * FUNCTION : cromax_randstring  - 
 *
 * @access public
 * @version   1.0
 * @since     1.0
 * @uses      create a random string for use in the pagebuilder and functions
 */

function cromax_randstring($length, $charset='abcdefghijklmnopqrstuvwxyz'){
 
    $str = '';
 
    $count = strlen($charset);
    while ($length--) {
        $str .= $charset[mt_rand(0, $count-1)];
    }

    return $str;
}





/**
 * create the page builder metabox
 *
 * @access public
 * @return void
 */

function cromax_draw_pb_section($id)
{
    if (!isset($id)){ return; }

    $op = '';

    $pbval = json_decode(  rawurldecode(  get_post_meta( $id,'cromax_pagebuilder', true )  ), true);

    // $pbval = get_post_meta( $id, 'cromax_pagebuilder', true );

    $op .= '<div class="cromax_sectionwrap">';

    if (isset($pbval) & !empty($pbval)){
        foreach ($pbval as $k => $v) {

            $rnd            = $k;
            $insidecnt      = $v;
            $section_id     = $id;


            ob_start();
                include('templates/pagebuilder/crx-newsection.php');
            $op .=  ob_get_clean();

        }
    }

    $op .=  '</div>';

    return $op;
}



/**
 * Ensure that all links return a http://
 *
 * @access public
 * @return void
 */

function cromax_addscheme($url, $scheme = 'http://'){
    if (parse_url($url, PHP_URL_SCHEME) === null) {
        return $scheme . $url;
    }
    return $url;
}


/**
 * create the page builder pagelayout
 *
 * @access public
 * @return void
 */

function get_cromax_pagebuilder($id){




    $meta_info    =  json_decode(  rawurldecode(  get_post_meta( $id,'cromax_pagebuilder', true )  ), true);
    $cro_form     = cromax_define_pagebuilder_parts();
    if (!isset($meta_info) || $meta_info == '') { return; }
    

    foreach ($meta_info as $v) {

        echo '<div class="row">';

        foreach ($v as $kk => $vv) {

          $codebase = array();

           switch ($vv['size']) {
               case '1/1': echo '<div class="large-12 column">'; break;
               case '3/4': echo '<div class="large-9 column">'; break;
               case '2/3': echo '<div class="large-8 column">'; break;
               case '1/2': echo '<div class="large-6 column">'; break;
               case '1/3': echo '<div class="large-4 column">'; break;
               case '1/4': echo '<div class="large-3 column">'; break;              
           }

           foreach ($cro_form as $vvv) {
                if ($vvv['short'] == $vv['type']) {
                    $codebase = $vvv['values'];
                }
           }


          $namearray = array();
          foreach ($codebase as $g) {
            $teststring = $kk . '-' . $g['fn'];
            $namearray[] = $vv[$teststring];
          }

           include('templates/pagebuilder/output-' . $vv['type'] . '.php');

           echo '</div>';

        }

        echo '</div>';
    }
}





/**
 * Convert time to twitter type time
 *
 * @access public
 * @return void
 */
function cromax_twittertime( $ptime) {

   $etime = time() - $ptime;

    if ($etime < 1)
    {
        return '0 seconds';
    }

    $a = array( 12 * 30 * 24 * 60 * 60  =>  __('year','croma'),
                30 * 24 * 60 * 60       =>  __('month','croma'),
                24 * 60 * 60            =>  __('day','croma'),
                60 * 60                 =>  __('hour','croma'),
                60                      =>  __('minute','croma'),
                1                       =>  __('second','croma')
                );

    foreach ($a as $secs => $str)
    {
        $d = $etime / $secs;
        if ($d >= 1)
        {
            $r = round($d);
            return $r . ' ' . $str . ($r > 1 ? 's' : '') . '';
        }
    }
}



/**
 * linkify tweets
 *
 * @access public
 * @return void
 */

function cromax_linkify_tweet($tweet) {
   return preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">http://$1</a>', $tweet);
}





/**
 * A function for parsing Vimeo and Youtube Video's
 *
 * @access public
 * @return array
 */

function cromax_parsevideo( $string, $type ) {

  $matches  = array();
  $ipart1   = 'ifr';
  $ipart2   = $ipart1 . 'ame';


  // large regex to identify youtube videos 

  $youtubestring = '  ~                                     # Match Youtube link and embed code
                      (?:                                   # Group to match embed codes
                      (?:<' .  $ipart2  . ' [^>]*src=")?    # If iframe match up to first quote of src
                      |(?:                                  # Group to match if older embed
                      (?:<object .*>)?                      # Match opening Object tag
                      (?:<param .*</param>)*                # Match all param tags
                      (?:<embed [^>]*src=")?                # Match embed tag to the first quote of src
                      )?                                    # End older embed code group
                      )?                                    # End embed code groups
                      (?:                                   # Group youtube url
                      https?:\/\/                           # Either http or https
                      (?:[\w]+\.)*                          # Optional subdomains
                      (?:                                   # Group host alternatives.
                      youtu\.be/                            # Either youtu.be,
                      | youtube\.com                        # or youtube.com
                      | youtube-nocookie\.com               # or youtube-nocookie.com
                      )                                     # End Host Group
                      (?:\S*[^\w\-\s])?                     # Extra stuff up to VIDEO_ID
                      ([\w\-]{11})                          # $1: VIDEO_ID is numeric
                      [^\s]*                                # Not a space
                      )                                     # End group
                      "?                                    # Match end quote if part of src
                      (?:[^>]*>)?                           # Match any extra stuff up to close brace
                      (?:                                   # Group to match last embed code
                      </' .  $ipart2  . '>                  # Match the end of the iframe
                      |</embed></object>                    # or Match the end of the older embed
                      )?                                    # End Group of last bit of embed code
                      ~ix';


  // large regex to identify vimeo videos
  $vimeostring =      '~                                    # Match Vimeo link and embed code
                      (?:<' .  $ipart2  . ' [^>]*src=")?    # If iframe match up to first quote of src
                      (?:                                   # Group vimeo url
                      https?:\/\/                           # Either http or https
                      (?:[\w]+\.)*                          # Optional subdomains
                      vimeo\.com                            # Match vimeo.com
                      (?:[\/\w]*\/videos?)?                 # Optional video sub directory this handles groups links also
                      \/                                    # Slash before Id
                      ([0-9]+)                              # $1: VIDEO_ID is numeric
                      [^\s]*                                # Not a space
                      )                                     # End group
                      "?                                    # Match end quote if part of src
                      (?:[^>]*></' .  $ipart2  . '>)?       # Match the end of the iframe
                      (?:<p>.*</p>)?                        # Match any title information stuff
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

function cromax_identifyvideo( $url, $id = 0 ) {


  // register the variables
  $returninfo       = $vinf = array();
  $service          = '';
  $vidno            = $url;
  $ipart1           = 'ifr';
  $ipart2           = $ipart1 . 'ame';


  // QUICKLY DETERMINE WHICH TYPE OF SERVICE WE WILL NEED TO ACCESS.
  if ( !is_numeric( $url ) ) {
    $service    = 'youtube';
    if ( strpos( $url, 'vimeo' ) !== false ) {
      $service  = 'vimeo';
      $vinf     = cromax_parsevideo( $url, 'vimeo' );
    } else {
      $vinf     = croamx_parsevideo( $url, 'youtube' );
    }
  } else {
    $service    = 'vimeo';
  }

  
  // extract the video number
  if ( isset( $vinf[1] ) && $vinf != '' ) {
    $vidno = $vinf[1];
  }



  if ( $vidno !== $id ) {

    switch ( $service ) {

      // setup an array for vimeo videos
      case 'vimeo':
        $response     = wp_remote_get( esc_url_raw( 'http://vimeo.com/api/v2/video/' . $vidno . '.php' ), array( 'User-Agent' => 'wordpress' ) );
        $response_code  = wp_remote_retrieve_response_code( $response );
        if ( 200 == $response_code ) {
          $videoinfo        = unserialize( wp_remote_retrieve_body( $response ) );
          $returninfo['thumb']  =  $videoinfo[0]['thumbnail_large'];
          $returninfo['id']     =  $vidno;
          $returninfo['frame']  = '<' .  $ipart2  . ' src="http://player.vimeo.com/video/' .  $vidno . '?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="600" height="350" frameborder="0" allowFullScreen></' .  $ipart2  . '>';
        }
      break;


      // setup an array for youtube videos
      case 'youtube':
        $returninfo['thumb']  =  'http://img.youtube.com/vi/' . $vidno  . '/mqdefault.jpg';
        $returninfo['id']     =  $vidno;
        $returninfo['frame']  = '<' .  $ipart2  . ' width="600" height="250" src="http://youtube.com/embed/' . $vidno . '?" frameborder="0" allowfullscreen></' .  $ipart2  . '>';
      break;
    }


    // return the array for the video
    return $returninfo;

  } else {
      return '';
  }
}



class CromaxExcerpt {

  public static $length = 55;

  /**
   *
   * @param string $new_length 
   * @return void
   * @author Baylor Rae'
   */
  public static function length($new_length = 55) {
    CromaxExcerpt::$length = $new_length;

    add_filter('excerpt_length', 'CromaxExcerpt::new_length');

    CromaxExcerpt::output();
  }


  public static function new_length() {
      return CromaxExcerpt::$length;
  }


  public static function output() {
    the_excerpt();
  }

}

// An alias to the class
function cromax_excerpt($length = 55) {
  CromaxExcerpt::length($length);
}




/**
 * FUNCTION : cromax_get_template_part  - 
 *
 * @access public
 * @version   1.0
 * @since     1.0
 * @uses      create our own template part functions.
 */


function cromax_get_template_part( $component,$slug, $name = '' ) {
  $template = '';
  $template_path = $GLOBALS['cromax']->plugin_path;

  
  $template = cromax_locate_template( $template_path . "/{$component}/templates/{$slug}-{$name}.php"  );


  if ( $template ) {
    include(cromax_locate_template($template));
  }

}




/**
 * FUNCTION : cromax_locate_template  - 
 *
 * @access public
 * @version   1.0
 * @since     1.0
 * @uses      create our own locate template functions.
 */


function cromax_locate_template( $path ) {

  $located = false;

  if ( file_exists($path)) {
      $located = $path;
  }

  return $located;
  
}



/**
 * FUNCTION : cro_processmetas  - 
 *
 * @access public
 * @version   1.0
 * @since     1.0
 * @uses      format a collection of metabox values
 */


function cro_processmetas($args, $id) {

  $id = (is_numeric($id)) ? $id : 0 ;
  $returnarray = array();

  foreach ($args as $value) {
    $returnarray[] = (get_post_meta( $id, $value, true ) != '')?  get_post_meta( $id, $value, true ) : '' ;
  }

  return $returnarray;
  
}





?>