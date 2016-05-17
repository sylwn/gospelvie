<?php
/*
Plugin Name: GoGadget Weather and Weatherforecast Widget
Plugin URI: http://www.go-gadget-blog.com
Description: Sidebar widget with shortcode function in Arabic, Chinese, Danish, Dutch, English, French, German, Hungarian, Irish, Italian, Norwegian, Polish, Portuguese, Russian, Serbian and Spanish to show either current weather and forecasts for ten days for any given location or the home location of your site visitors - detailled infotexts for current weather and forecasts on mouseover - multiple installation

Author: Guido Osterwald
Version: 5.0
                                                      
Author URI: http://www.go-gadget-blog.com
*/

/*                                  

Changes:

= 1.0 =  Initial Version
= 1.1 =  First Update
	*Additional languages (French / Italian / Polish / Spanish)
	*“Auto”-Language detection and output
	*Multiple installation – widget can now be installed up to three times
	*Output of system status in widget panel
	*Minor bug fixes (broken links / image location finder / wrong picture …)
= 2.0 =  Second Update
  Layout improvements:
  * Usage of additional sets of Images               
  * Images can be adjusted and resized with the control panel
  * Embedded CSS or use of own CSS set
  Technical Improvements:
  * Extended Forecast for further six days (forecast total of ten days possible now
  * Ten day Forecast available with every language selection - text description for further six days in english or german only nevertheless  
  * more detailled weather texts(in english version)
  * Autolocation option - Weather at site visitors home can be shown now  
= 2.1 =  Third Update
  * Additional language (Hungarian)
  * Country Names shown with the "Auto Location" feature are now translated into all installed languages
  Layout improvements:
  * Optional padding (left and right) to fit widget in wider sidebars as they are often used in "footer" widgetareas
  * Widget title can be shown within the widget or as usually at widget top
  * Some improvements of arranging icons in CSS
  Technical Improvements:
  * addition of further 200 German text phrases for translation of weather texts
  * added some mouseover texts in the control panel with help texts
  * Bugfixed a timeout error if one of the geoip-server are down  
  * Minor bugfixes and slight improvements (location finder / css / German translation) 
 = 3.0 = Fourth Update
  * Addition of Shortcode functionality 
  * Additional language (Portuguese and Arabic)
  * Bugfix to prevent slower server connections to timeout before getting location data
  * Images and Weatherinfos about actual weather can be deselected now, if actual report data only show "N/A" for the location
  * Layout changes in the control panel  
= 4.0 = Fith Update
  * Change of Weather Data Provider from Weather.Com (now a service to be paid for) to (Free services) of World Weather Online (WWO) and Wunderground (WUN)
  * Major Changes in Codes and some functionalities
  * Weather Services can be used separately or combined 
  * Setting of preferenced Weather Service with optional optimization
  * Better Availability: If one weather service fails, the other gets the data!
  * Input of coordinates to set location possible(latitude / longitude)       
  * Total of 5 day data from WWO to 8 day data of WUN
  * Further weather details: Visibility / Cloudcover / Dewpoint
  * UV-Index no longer available / separate Night and Day Images no more available    
  * Changes in the Large Layout
  * Autolocation feature now also available with the Shortcode Plugin
  * "Feels like" temperature is now optional 
 = 5.0 = This version
  * Shortcode working with coordinates as well
  * Additional Layout Option "Pure"  
  * Larger Weather-Infotext and descriptions in international versions  
  * Additional languages - Chinese, Danish, Dutch, Irish, Norwegian, Russian, Serbian              
*/

//error_reporting(E_ALL | E_STRICT);
//ini_set('display_errors','1');
add_action('widgets_init', 'GG_func_widget_weather_and_weather_forecast_init');
include_once 'gg_funx_.php';
register_activation_hook( __FILE__, 'GG_func_activate');
register_deactivation_hook( __FILE__, 'GG_func_deactivate');



function GG_func_activate(){    
    $widget_options = array('title'=>'',
        'title_back'=>'', 
  			'wun_licence_code' => '', 
  			'fwo_licence_code' => '', 
  			'ipinfodb_key'=> '',
  			'wc_cache' => '',
  			'wc_cachetime' => '3600',
  			'i_location_city' => 'Castrop-Rauxel',
  			'i_location_state' => 'Germany',
  			'i_location_city_check' => '',
  			'wc_lastcheck' => 2,
  			'images' => get_bloginfo('wpurl').'/wp-content/plugins/weather-and-weather-forecast-widget/weatherimages/',
  			'imagefolder' => 'WeatherCom_1',
  			'size_padding'=>'0px',
  			'f_size_l' => '140%',
  			'f_size_m' => '120%',
  			'f_size_s' => '100%',
  			'i_size_l' => '1',
  			'i_size_m' => '1',
  			'i_size_s' => '1',
  			'background_color' => '',
  			'font_color' => '',
  			'font_family' => '',
  			'opt_lines' => '',
        'opt_language'  => 'en',
        'opt_language_select'  => 'unchecked',
        'opt_unit' => 'm',
        'opt_css_select'  => 'checked',
        'opt_auto_location_select' => 'unchecked',
        'opt_extended_forecast_select' => 'unchecked',
        'opt_hide_feels_like' => 'unchecked',
        'opt_title_select' => 'unchecked',
        'opt_layout' => 'large',
        'opt_sunmoon_text' => 'yes',
        'opt_link_to_provider' => 'yes',
        'opt_provider_preference' => 'wun', 
  			'format_c1' => '',
        'format_l1' => '',
        'format_t0' => '',
  			'format_t1' => '',
  			'format_t2' => '',
  			'format_t3' => '',
  			'format_t4' => '',
  			'format_t5' => '',
  			'format_l2' => '',
  			'format_c2' => '',
  			'time_corr' => '0',
  			'timeout'=>'2',
    	);
    if ( ! get_option('GG_func_widget_weather_and_weather_forecast')){
      add_option('GG_func_widget_weather_and_weather_forecast' , $widget_options);
    } else {
      update_option('GG_func_widget_weather_and_weather_forecast' , $widget_options);
    }
}
function GG_func_deactivate(){
    delete_option('GG_func_widget_weather_and_weather_forecast');
}
//**************************init*************************************************
function GG_func_widget_weather_and_weather_forecast_init() {
	  if ( !function_exists('register_sidebar_widget') )
		return;
	  wp_register_sidebar_widget( 'GoGadget_Weather_Widget', 'GoGadget Weather Widget', 'GG_func_widget_weather_and_weather_forecast', array('description' => __('Add Weather and a three Day Forecast (english or german) to your widget area '))) ;
    wp_register_widget_control( 'GoGadget_Weather_Widget', 'GoGadget Weather Widget', 'GG_func_widget_weather_and_weather_forecast_control', array('width' => 350, 'length' => 325));
}
//**************************control**********************************************
function GG_func_widget_weather_and_weather_forecast_control() {    
$wc_id_check="";
    $wc_loc_check="";
    $wc_connection_check="";
    $ipinfodb_check="";
    $wc_WP="";
    $wc_Theme="";
    $wc_PHP="";
    $wc_MYSQL="";
    $wc_browser="";
    $widget_options = get_option('GG_func_widget_weather_and_weather_forecast');  	
  	if ( $_POST['weather_and_weather_forecast-submit'] ) {
  		$widget_options['title_back'] = strip_tags(stripslashes($_POST['weather_and_weather_forecast-title_back']));
  		$widget_options['i_location_city'] = strip_tags(stripslashes($_POST['weather_and_weather_forecast-i_location_city']));
  		$widget_options['i_location_state'] = strip_tags(stripslashes($_POST['weather_and_weather_forecast-i_location_state']));
  		$widget_options['i_location_lat'] = str_replace(",",".",strip_tags(stripslashes($_POST['weather_and_weather_forecast-i_location_lat'])));
  		$widget_options['i_location_lon'] = str_replace(",",".",strip_tags(stripslashes($_POST['weather_and_weather_forecast-i_location_lon'])));
  		$widget_options['wun_licence_code'] = ltrim(rtrim(strip_tags(stripslashes($_POST['weather_and_weather_forecast-wun_licence_code']))));
  		$widget_options['fwo_licence_code'] = ltrim(rtrim(strip_tags(stripslashes($_POST['weather_and_weather_forecast-fwo_licence_code']))));
  		$widget_options['ipinfodb_key'] = strip_tags(stripslashes($_POST['weather_and_weather_forecast-ipinfodb_key']));
  		$widget_options['wc_cachetime'] = strip_tags(stripslashes($_POST['weather_and_weather_forecast-wc_cachetime']));
  		$widget_options['images'] = strip_tags(stripslashes($_POST['weather_and_weather_forecast-images']));
  		$widget_options['imagefolder'] = strip_tags(stripslashes($_POST['weather_and_weather_forecast-imagefolder']));
  		$widget_options['opt_unit'] = $_POST['weather_and_weather_forecast-opt_unit'];
  		$widget_options['wc_lastcheck'] = -1;
  		$widget_options['size_padding'] = stripslashes($_POST['weather_and_weather_forecast-size_padding']);
  		$widget_options['f_size_l'] = stripslashes($_POST['weather_and_weather_forecast-f_size_l']);
  		$widget_options['f_size_m'] = stripslashes($_POST['weather_and_weather_forecast-f_size_m']);
  		$widget_options['f_size_s'] = stripslashes($_POST['weather_and_weather_forecast-f_size_s']);
  		$widget_options['i_size_l'] = stripslashes($_POST['weather_and_weather_forecast-i_size_l']);
  		$widget_options['i_size_m'] = stripslashes($_POST['weather_and_weather_forecast-i_size_m']);
  		$widget_options['i_size_s'] = stripslashes($_POST['weather_and_weather_forecast-i_size_s']);
  		$widget_options['background_color'] = stripslashes($_POST['weather_and_weather_forecast-background_color']);
  		$widget_options['font_color'] = stripslashes($_POST['weather_and_weather_forecast-font_color']);
  		$widget_options['font_family'] = stripslashes($_POST['weather_and_weather_forecast-font_family']);
  		$widget_options['opt_lines'] = stripslashes($_POST['weather_and_weather_forecast-opt_lines']);
  		$widget_options['opt_title_select'] = stripslashes($_POST['weather_and_weather_forecast-opt_title_select']);
  		$widget_options['opt_language'] = stripslashes($_POST['weather_and_weather_forecast-opt_language']);
  		$widget_options['opt_language_select'] = stripslashes($_POST['weather_and_weather_forecast-opt_language_select']);
  		$widget_options['opt_auto_location_select'] = stripslashes($_POST['weather_and_weather_forecast-opt_auto_location_select']);
  		$widget_options['opt_eng_in_fc_texts'] = stripslashes($_POST['weather_and_weather_forecast-opt_eng_in_fc_texts']);
  		$widget_options['opt_hide_feels_like'] = stripslashes($_POST['weather_and_weather_forecast-opt_hide_feels_like']);
  		$widget_options['opt_provider_preference'] = stripslashes($_POST['weather_and_weather_forecast-opt_provider_preference']);      
      $widget_options['opt_extended_forecast_select'] = stripslashes($_POST['weather_and_weather_forecast-opt_extended_forecast_select']);
  		$widget_options['opt_css_select'] = stripslashes($_POST['weather_and_weather_forecast-opt_css_select']);
  		$widget_options['time_corr'] = stripslashes($_POST['weather_and_weather_forecast-time_corr']);
      $widget_options['opt_layout']=  stripslashes($_POST['weather_and_weather_forecast-opt_layout']);
      $widget_options['opt_get_better']=  stripslashes($_POST['weather_and_weather_forecast-opt_get_better']);
  		$widget_options['opt_link_to_provider']= stripslashes($_POST['weather_and_weather_forecast-opt_link_to_provider']);
  		$widget_options['opt_sunmoon_text']=  stripslashes($_POST['weather_and_weather_forecast-opt_sunmoon_text']);
      $widget_options['timeout'] = strip_tags(stripslashes($_POST['weather_and_weather_forecast-timeout'])); 
      //update_option('GG_func_widget_weather_and_weather_forecast', $widget_options);
      $size_padding = htmlspecialchars($widget_options['size_padding'], ENT_QUOTES);      
      $f_size_l = htmlspecialchars($widget_options['f_size_l'], ENT_QUOTES);
  	  $f_size_m = htmlspecialchars($widget_options['f_size_m'], ENT_QUOTES);
  	  $f_size_s = htmlspecialchars($widget_options['f_size_s'], ENT_QUOTES);
  	  $i_size_l = htmlspecialchars($widget_options['i_size_l'], ENT_QUOTES);
  	  $i_size_m = htmlspecialchars($widget_options['i_size_m'], ENT_QUOTES);
  	  $i_size_s = htmlspecialchars($widget_options['i_size_s'], ENT_QUOTES);
  	  $font_color = htmlspecialchars($widget_options['font_color'], ENT_QUOTES);
  	  $font_family = htmlspecialchars($widget_options['font_family'], ENT_QUOTES);
  	  $opt_lines = htmlspecialchars($widget_options['opt_lines'], ENT_QUOTES);
  	  $opt_get_better =  htmlspecialchars($widget_options['opt_get_better'], ENT_QUOTES);
  	  $opt_css_select =  htmlspecialchars($widget_options['opt_css_select'], ENT_QUOTES);
  	  $opt_extended_forecast_select =  htmlspecialchars($widget_options['opt_extended_forecast_select'], ENT_QUOTES);
  	  $opt_hide_feels_like =  htmlspecialchars($widget_options['opt_hide_feels_like'], ENT_QUOTES);
  	  $opt_eng_in_fc_texts =  htmlspecialchars($widget_options['opt_eng_in_fc_texts'], ENT_QUOTES);
  	  $opt_auto_location_select =  htmlspecialchars($widget_options['opt_auto_location_select'], ENT_QUOTES);
      $opt_provider_preference =  htmlspecialchars($widget_options['opt_provider_preference'], ENT_QUOTES);
      $background_color = htmlspecialchars($widget_options['background_color'], ENT_QUOTES);
      $wun_licence_code =  GG_funx_get_code(htmlspecialchars($widget_options['wun_licence_code'], ENT_QUOTES));
      $fwo_licence_code =  htmlspecialchars($widget_options['fwo_licence_code'], ENT_QUOTES);
      $ipinfodb_key = htmlspecialchars($widget_options['ipinfodb_key'], ENT_QUOTES);
      $opt_layout = htmlspecialchars($widget_options['opt_layout'], ENT_QUOTES);
      $title_back= htmlspecialchars($widget_options['title_back'], ENT_QUOTES);
      $timeout= htmlspecialchars($widget_options['timeout'], ENT_QUOTES);
      $i_location_city = htmlspecialchars($widget_options['i_location_city'], ENT_QUOTES);
  	  $i_location_state = htmlspecialchars($widget_options['i_location_state'], ENT_QUOTES);
  	  $i_location_lat = htmlspecialchars($widget_options['i_location_lat'], ENT_QUOTES);
  	  $i_location_lon = htmlspecialchars($widget_options['i_location_lon'], ENT_QUOTES);      
      $format_c1 =  "";
      $format_l1 =  "";
    	$format_t0 =  "";
    	$format_t1 =  "";
    	$format_t2 =  "";
    	$format_t3 =  "";
    	$format_t4 =  "";
    	$format_t5 =  "";
    	$format_l2 =  "";
    	$format_c2 =  "";
      $opt_title_select = htmlspecialchars($widget_options['opt_title_select'], ENT_QUOTES);
      $opt_link_to_provider  = htmlspecialchars($widget_options['opt_link_to_provider'], ENT_QUOTES);
      $term="";
      $term_out="";
      $images="";
      if($opt_css_select == "checked") {  
      $format_c1= "<div id='gogadget_weather_widget' class='widget GG_func_widget_weather_and_weather_forecast'><style type='text/css'>.GG_func_widget_weather_and_weather_forecast {padding-right:".$size_padding.";padding-left:".$size_padding."} .GG_func_widget_weather_and_weather_forecast img {padding: 0; margin: 0;vertical-align:middle}.GG_func_widget_weather_and_weather_forecast table {border:0;margin:0;padding:0;border-collapse:collapse;background-color:".$background_color."}.GG_func_widget_weather_and_weather_forecast hr {display: block;}.GG_func_widget_weather_and_weather_forecast tr td{text-align:center;margin:0;margin-bottom:0;width:0%;height:0%;padding:0;border:0;border-collapse:collapse;}</style>";
      }
      if ($opt_lines=="yes"){
        $format_l1=GG_func_widget_format("lines",$term_out,$f_size_s,$f_size_m,$f_size_l,$i_size_s,$i_size_m,$i_size_l,$background_color,$font_family, $font_color, $images,$wun_licence_code,"",$opt_hide_feels_like);
      }
      if($opt_auto_location_select =="checked" or $opt_title_select=="checked"){
        $format_t0 = GG_func_widget_format("auto_location",$term_out,$f_size_s,$f_size_m,$f_size_l,$i_size_s,$i_size_m,$i_size_l,$background_color,$font_family, $font_color, $images,$wun_licence_code,"",$opt_hide_feels_like);
      }
      if($opt_title_select=="checked")
      {
       $title="";
      }
      else
      {
        $title=$widget_options['title_back']; 
      }
      $widget_options['title'] = $title;
      $widget_options['title_back'] = $title_back;
      if ($opt_layout!="pure"){
        $format_t1 = GG_func_widget_format("small",$term_out,$f_size_s,$f_size_m,$f_size_l,$i_size_s,$i_size_m,$i_size_l,$background_color,$font_family, $font_color, $images,$wun_licence_code,"",$opt_hide_feels_like);
      }
      if ($opt_layout=="medium" or $opt_layout=="large"){
        $format_t2=GG_func_widget_format("medium",$term_out,$f_size_s,$f_size_m,$f_size_l,$i_size_s,$i_size_m,$i_size_l,$background_color,$font_family, $font_color, $images,$wun_licence_code,"",$opt_hide_feels_like);
      }
      if ($opt_layout=="large" and $opt_extended_forecast_select!="checked"){
        $format_t3=GG_func_widget_format("large",$term_out,$f_size_s,$f_size_m,$f_size_l,$i_size_s,$i_size_m,$i_size_l,$background_color,$font_family,$font_color, $images,$wun_licence_code,"",$opt_hide_feels_like);
      }
      if ($opt_extended_forecast_select=="checked" and $opt_layout!="pure"){
        $format_t4=GG_func_widget_format("extended",$term_out,$f_size_s,$f_size_m,$f_size_l,$i_size_s,$i_size_m,$i_size_l,$background_color,$font_family,$font_color, $images,$wun_licence_code,"middle",$opt_hide_feels_like);
      }
      if ($opt_extended_forecast_select=="checked" and $opt_layout=="pure"){
        $format_t4=GG_func_widget_format("extended_pure",$term_out,$f_size_s,$f_size_m,$f_size_l,$i_size_s,$i_size_m,$i_size_l,$background_color,$font_family,$font_color, $images,$wun_licence_code,"middle",$opt_hide_feels_like);
      }
      if ($opt_extended_forecast_select!="checked" and $opt_layout=="pure"){
        $format_t4=GG_func_widget_format("pure",$term_out,$f_size_s,$f_size_m,$f_size_l,$i_size_s,$i_size_m,$i_size_l,$background_color,$font_family,$font_color, $images,$wun_licence_code,"middle",$opt_hide_feels_like);
      }
      if ($opt_link_to_provider == "yes")
      { $format_t5=GG_func_widget_format("link",$term_out,$f_size_s,$f_size_m,$f_size_l,$i_size_s,$i_size_m,$i_size_l,$background_color,$font_family, $font_color, $images,$wun_licence_code,"",$opt_hide_feels_like);
      }
       if ($opt_lines=="yes"){
        $format_l2=GG_func_widget_format("lines",$term_out,$f_size_s,$f_size_m,$f_size_l,$i_size_s,$i_size_m,$i_size_l,$background_color,$font_family, $font_color, $images,$wun_licence_code,"",$opt_hide_feels_like);
      }
      if($opt_css_select == "checked") {  
        $format_c2= "</div>";
      }
      $widget_options['format_c1'] = $format_c1;
      $widget_options['format_l1'] = $format_l1;
      $widget_options['format_t0'] = $format_t0;
      $widget_options['format_t1'] = $format_t1;
      $widget_options['format_t2'] = $format_t2;
      $widget_options['format_t3'] = $format_t3;
      $widget_options['format_t4'] = $format_t4;
      $widget_options['format_t5'] = $format_t5;
      $widget_options['format_l2'] = $format_l2;
      $widget_options['format_c2'] = $format_c2;      
      $widget_options['time_corr'] = str_replace(",",".",$widget_options['time_corr'] );
      $check_time_1 = str_replace("-","",$widget_options['time_corr'] );
      $check_time_2 = str_replace(".","",$check_time_1 );
      if (ctype_digit($check_time_2)==false) {
      echo "Please choose a number for 'Synchronize Time'! (Set to 0 now)<br /><br />";
      $widget_options['time_corr'] = "0";
      }
      else
      if ($check_time_1 > 24 or $check_time_1 <0){
        echo "'Synchronize Time: Please choose a number between -24 and 24 (Set to 0 now)<br /><br />";
      $widget_options['time_corr'] = "0";
      }
      $check_time = $widget_options['wc_cachetime'];
      if (ctype_digit($check_time)==false) {
      echo "Cache Time: Please choose a number! (Set to 3.600 now)<br />";
      $widget_options['wc_cachetime'] = "3600";
      }
      $check_timeout = $widget_options['timeout'];
      if (!is_numeric($check_timeout) or $check_timeout<0 ) {
      echo "Timeout: Choose a positive number! (Set to 2 seconds now)<br />";
      $widget_options['timeout'] = "2";
      }   
      if( $opt_auto_location_select=="checked" && $widget_options['wc_cachetime']+1 > 2 ){
      echo "Cachetime has to be set 0 or 1, when using 'Auto-Location'!<br /><br />";
      $widget_options['wc_cachetime'] = "0";
      } 
      if( $opt_auto_location_select=="checked" && $widget_options['opt_title_select']=="checked" ){
      echo "If you choose the Auto-Location-Feature, your given widget title has to be shown as a standard widget title! The 'shown-within-widget' selection is set to unchecked!' <br /><br />";
      $widget_options['opt_title_select'] = "unchecked";
      $widget_options['title'] = $title_back;      
      }    
      $opt_sunmoon_text = htmlspecialchars($widget_options['opt_sunmoon_text'], ENT_QUOTES);
      if ($opt_sunmoon_text == "no"){$term=str_replace("%sunmoon_string_lang%","",$term);}
      $location_string_wun="/".$i_location_state."/".$i_location_city;
      $location_string_wun=str_replace(" ","_",$location_string_wun);
      $location_string_fwo=$i_location_city.",".$i_location_state;
      $location_string_fwo=str_replace(" ","+",$location_string_fwo);
      $location_string_wun2=$i_location_lat.",".$i_location_lon;
      $location_string_fwo2=$i_location_lat.",".$i_location_lon;
      $test_wun = 'http://api.wunderground.com/api/'.$wun_licence_code.'/geolookup/q/'.$location_string_wun.'.json';
      $test_fwo = 'http://free.worldweatheronline.com/feed/weather.ashx?q='.$location_string_fwo.'&format=json&num_of_days=2&key='.$fwo_licence_code;
      $test_wun2 = 'http://api.wunderground.com/api/'.$wun_licence_code.'/geolookup/q/'.$location_string_wun2.'.json';
      $test_fwo2 = 'http://free.worldweatheronline.com/feed/weather.ashx?q='.$location_string_fwo2.'&format=json&num_of_days=2&key='.$fwo_licence_code;
      $flag_key_already_not_found=0;
      $wc_connection_check="";
      $wun_parsed['response']['error']="";
      $fwo_parsed['data']['error']="";
      $fwo_test['msg']="";
      $fwo_parsed['data']['current_condition']="";
      if($wun_licence_code=="" and $fwo_licence_code=="")
      { $wc_connection_check=$wc_connection_check."You must at least enter ONE license key to run the widget! ";
      }
      if($wun_licence_code!=""){
        if($i_location_city!="" or $i_location_state!=""){
          $wun_string = GG_func_get_content($test_wun,$timeout);
          $wun_parsed = json_decode($wun_string,true);
          $wun_test = $wun_parsed['response']['error'];
          if($wun_test[type]=="keynotfound"){
            $wc_connection_check=$wc_connection_check."Invalid Key (".$wun_licence_code.") for Wonderground! ";
            $flag_key_already_not_found=1;
          }
          elseif(
            $wun_test[type]=="querynotfound"){
            $wc_connection_check=$wc_connection_check."Wunderground: The location is unknown. Please verify! Still problems? Check the location at <a href='http://http://www.go-gadget-blog.com/gogadget/?page_id=30' target='_blank'>locationchecker</a>! ";           
          }
        }
        if($i_location_lat!=""){
          $wun_string = GG_func_get_content($test_wun2,$timeout);
          $wun_parsed = json_decode($wun_string,true);
          $wun_test = $wun_parsed['response']['error'];
          if($wun_test[type]=="keynotfound" and $flag_key_already_not_found==0){
            $wc_connection_check=$wc_connection_check."Invalid Key (".$wun_licence_code.") for Wonderground! ";
          }
          elseif($wun_test[type]=="querynotfound"){
            $wc_connection_check=$wc_connection_check."Wunderground: No city near your coordinates. Please verify! Still problems? Check the location at <a href='http://http://www.go-gadget-blog.com/gogadget/?page_id=30' target='_blank'>locationchecker</a>! ";           
          }
        }
      }	   
      $flag_key_already_not_found=0;
      if($fwo_licence_code!=""){
         if($i_location_city!="" or $i_location_state!=""){
            $fwo_string = GG_func_get_content($test_fwo,$timeout);
            $fwo_parsed = json_decode($fwo_string,true);
            $fwo_test = $fwo_parsed['data']['error'][0];
            $pos1=strpos($fwo_test['msg'],"account");
            $pos2=strpos($fwo_test['msg'],"location");
            if($pos1>0){
              $wc_connection_check=$wc_connection_check."Invalid Key (".$fwo_licence_code.") for WorldWeatherOnline! ";
              $flag_key_already_not_found=1;
            }
            elseif($pos2>0){
              $wc_connection_check=$wc_connection_check."World Weather Online: The location is unknown. Please verify! Still problems? Check the location at <a href='http://www.go-gadget-blog.com/gogadget/?page_id=30'  target='_blank'>locationchecker</a>! ";           
            }
        }
        if($i_location_lat!=""){
            $fwo_string = GG_func_get_content($test_fwo2,$timeout);
            $fwo_parsed = json_decode($fwo_string,true);
            $fwo_test = $fwo_parsed['data']['error'][0];
            $pos1=strpos($fwo_test['msg'],"account");
            $fwo_test = $fwo_parsed['data']['current_condition'];
            //print_r($fwo_test);
            if($pos1>0 and $flag_key_already_not_found==0){
              $wc_connection_check=$wc_connection_check."Invalid Key (".$fwo_licence_code.") for WorldWeatherOnline! ";
            }
            elseif(!$fwo_test){
              $wc_connection_check=$wc_connection_check."World Weather Online: No city near your coordinates. Please verify! Still problems? Check the location at <a href='http://www.go-gadget-blog.com/gogadget/?page_id=30'  target='_blank'>locationchecker</a>! ";           
            }           
        }
      }	
      if($ipinfodb_key<>""){
         $uri = 'http://api.ipinfodb.com/v3/ip-city/?key='.$ipinfodb_key.'&format=xml&ip=24.143.194.27';
	       $data = $data = GG_func_get_content($uri,$timeout);
	       if(!substr_count($data,'ode>ERROR') ){}
            else
            {$ipinfodb_check="You have entered an invalid license key for ipinfodb.com please check!";}
      }
      $wc_MYSQL=mysql_query("select version() as ve");
      $wc_MYSQL=mysql_fetch_object($wc_MYSQL);
      $wc_browser=GG_func_getBrowser();
      $wc_browser= " - " . $wc_browser['name'] . " " . $wc_browser['version'] . " on " .$wc_browser['platform']; 
      $wc_PHP = " - PHP:".phpversion();
      $wc_MYSQL = " MYSQL:".$wc_MYSQL->ve;
      $wc_WP = " WP:".get_bloginfo('version');
      $wc_Theme = get_template_directory_uri();
      $pos_Theme = strrpos($wc_Theme,"/");
      $wc_Theme = substr($wc_Theme,$pos_Theme+1,strlen($wc_Theme)-$pos_Theme-1);
      $wc_Theme = " - ".$wc_Theme;
      if($title=""){$title="&nbsp";}      
  		update_option('GG_func_widget_weather_and_weather_forecast', $widget_options);
  	}  
  	$title_back = htmlspecialchars($widget_options['title_back'], ENT_QUOTES);
  	$i_location_city = htmlspecialchars($widget_options['i_location_city'], ENT_QUOTES);
  	$i_location_state = htmlspecialchars($widget_options['i_location_state'], ENT_QUOTES);
  	$i_location_lat = htmlspecialchars($widget_options['i_location_lat'], ENT_QUOTES);
  	$i_location_lon = htmlspecialchars($widget_options['i_location_lon'], ENT_QUOTES);
  	$images = htmlspecialchars($widget_options['images'], ENT_QUOTES);
  	$imagefolder = htmlspecialchars($widget_options['imagefolder'], ENT_QUOTES);
  	$wun_licence_code = htmlspecialchars($widget_options['wun_licence_code'], ENT_QUOTES);
  	$fwo_licence_code = htmlspecialchars($widget_options['fwo_licence_code'], ENT_QUOTES);
  	$ipinfodb_key = htmlspecialchars($widget_options['ipinfodb_key'], ENT_QUOTES);                                
  	$wc_cachetime = htmlspecialchars($widget_options['wc_cachetime'], ENT_QUOTES);
  	$f_size_l = htmlspecialchars($widget_options['f_size_l'], ENT_QUOTES);
  	$f_size_m = htmlspecialchars($widget_options['f_size_m'], ENT_QUOTES);
  	$f_size_s = htmlspecialchars($widget_options['f_size_s'], ENT_QUOTES);
  	$i_size_l = htmlspecialchars($widget_options['i_size_l'], ENT_QUOTES);
  	$i_size_m = htmlspecialchars($widget_options['i_size_m'], ENT_QUOTES);
  	$i_size_s = htmlspecialchars($widget_options['i_size_s'], ENT_QUOTES);
  	$background_color = htmlspecialchars($widget_options['background_color'], ENT_QUOTES);
  	$font_color = htmlspecialchars($widget_options['font_color'], ENT_QUOTES);
  	$font_family = htmlspecialchars($widget_options['font_family'], ENT_QUOTES);
  	$opt_language = htmlspecialchars($widget_options['opt_language'], ENT_QUOTES);
  	$opt_language_select = htmlspecialchars($widget_options['opt_language_select'], ENT_QUOTES);
  	$opt_auto_location_select =  htmlspecialchars($widget_options['opt_auto_location_select'], ENT_QUOTES);
  	$opt_extended_forecast_select =  htmlspecialchars($widget_options['opt_extended_forecast_select'], ENT_QUOTES);
  	$opt_hide_feels_like =  htmlspecialchars($widget_options['opt_hide_feels_like'], ENT_QUOTES);
  	$opt_get_better =  htmlspecialchars($widget_options['opt_get_better'], ENT_QUOTES);
  	$opt_eng_in_fc_texts =  htmlspecialchars($widget_options['opt_eng_in_fc_texts'], ENT_QUOTES);
  	$opt_auto_location_select =  htmlspecialchars($widget_options['opt_auto_location_select'], ENT_QUOTES);
  	$opt_css_select = htmlspecialchars($widget_options['opt_css_select'], ENT_QUOTES);
  	$opt_title_select = htmlspecialchars($widget_options['opt_title_select'], ENT_QUOTES);
  	$opt_provider_preference = htmlspecialchars($widget_options['opt_provider_preference'], ENT_QUOTES);
    $opt_layout = htmlspecialchars($widget_options['opt_layout'], ENT_QUOTES);
  	$time_corr = htmlspecialchars($widget_options['time_corr'], ENT_QUOTES);
  	$opt_lines = htmlspecialchars($widget_options['opt_lines'], ENT_QUOTES);
  	$opt_sunmoon_text = htmlspecialchars($widget_options['opt_sunmoon_text'], ENT_QUOTES);
  	$opt_link_to_provider  = htmlspecialchars($widget_options['opt_link_to_provider'], ENT_QUOTES);
  	$opt_unit = $widget_options['opt_unit'];
  	$timeout = $widget_options['timeout'];
  	$imageloc = $widget_options['images'];
  	$size_padding = htmlspecialchars($widget_options['size_padding'], ENT_QUOTES);
    if($wun_licence_code=="" and $fwo_licence_code=="" ){
      $opt_provider_preference="wun";
    }
    elseif($wun_licence_code==""){$opt_provider_preference="fwo";}
    elseif($fwo_licence_code==""){$opt_provider_preference="wun";}
    if($opt_provider_preference=="wun"){
    $i_wun_preference_select="checked='checked'";
  	$i_fwo_preferenceselect="";
  	}
  	if($opt_provider_preference=="fwo"){
      $i_fwo_preference_select="checked='checked'";
    	$i_wun_preferenceselect="";
    }
    
    echo '<table>';
    echo '<tr><td><b>Title:</b></td></tr>';                  
    echo '<tr><td><label><input style="width: 250px;" name="weather_and_weather_forecast-title_back" type="text" value="'.$title_back.'" /></label></td>';
    echo '<td>&nbsp;<input type="checkbox" name="weather_and_weather_forecast-opt_title_select" value="checked" '.(($opt_title_select=='checked')?'checked="checked"' : '').'"><a title="Check if you want to show the title within the widget - if unchecked, the title will be shown like every widget title according to the settings of your theme">&nbsp;shown within widget</a></td></td></tr>';   
    echo '</table>';
    echo '<table>';
    echo '<tr><td><b>Location:</b>&nbsp;&nbsp;<a href="http://www.go-gadget-blog.com"  target="_blank" title="Click here and visit the LOCATION CHECK on www.go-gadge-blog.com, if you need help with the Location">Help!</a></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox" name="weather_and_weather_forecast-opt_auto_location_select" value="checked" '.(($opt_auto_location_select=='checked')?'checked="checked"' : '').'"><a title="Check this, if you like to show the weather for the location of each of your visitor! The location (City / State) from below will only be used, in case the weather widget isnt able to locate visitors home!"> Auto&nbsp;</a></td></tr>';
    echo '</table>';
    echo '<table>';
    echo '<tr><td><a title="Enter a City and Country/State (in the next field) if you dont like to use coordinates!">City:</a></td><td><label><input style="width: 107px;"  name="weather_and_weather_forecast-i_location_city" type="text" value="'.$i_location_city.'" /></label></td>';
    echo '<td><a title="Enter the name of the country or the state here!">&nbsp;Country/State:</a></td><td><label><input style="width: 105px;"  name="weather_and_weather_forecast-i_location_state" type="text" value="'.$i_location_state.'" /></label></td></tr>';
    echo '</table>';
    echo '<table>';
    echo '<tr><td><a title="Enter the coordinates of your location, if you like to - The widget will then ignore all input for City and State then! You are unfamilliar with coordinates? Get yours at www.go-gadget-blog.com">Coordinates:</a></td>';
    echo '<td>&nbsp;<a title="Please us decimal degrees! For example: 51.5">Latitude:</a></td><td><label><input style="width: 50px;"  name="weather_and_weather_forecast-i_location_lat" type="text" value="'.$i_location_lat.'" /></label>&deg</td>';
    echo '<td>&nbsp;<a title="Please us decimal degrees! For example:  -0.121">Longitude:</a></td><td><label><input style="width: 50px;"  name="weather_and_weather_forecast-i_location_lon" type="text" value="'.$i_location_lon.'" /></label>&deg</td></tr>';
    echo '</table>';
    echo '<table>';
    echo '<td><b>Technical Settings:</b></td><td>&nbsp;&nbsp;<a href="http://www.go-gadget-blog.com" target="_blank" style:"font-size:0.5em" title="Click here and visit HELP and INSTRUCTIONS on www.gop-gadget-blog.com for help! You can also download a manual at www.go-gadget-blog.com!">Help!</a>&nbsp;&nbsp;</td>';
    echo '</table>';
    echo '<table>';
    echo '<tr><td><a href="http://www.wunderground.com/members/signup.asp" target="_blank"><img src='.$imageloc.'WUN_logo_31px.png height="25" width= "41" title="Get your free Key at www.wunderground.com"</a></td><td><a title="Please enter your Wunderground Licence Code here! Stuck in getting your Code? Go to HELP AND INSTRUCTION and download a little guide how to get the code!">WUN ID</a></td>';
    echo '<td><label><input style="width: 130px;" name="weather_and_weather_forecast-wun_licence_code" type="text" value="'.$wun_licence_code.'" /></label></td>';
    echo '<td><label><input type="radio" name="weather_and_weather_forecast-opt_provider_preference"  value="wun" '.$i_wun_preference_select.'>Prefer WUN</label></tr>';
    echo '<tr><td>&nbsp;<a href="http://worldweatheronline.com/register.aspx" target="_blank"><img src='.$imageloc.'WWO_logo_31px.png height="25" width= "25" title="Get your free Key at www.worldweatheronline.com"</a></td><td><a title="Please enter your Worldweatheronline Licence Code here! Stuck in getting your Code? Go to HELP AND INSTRUCTION and download a little guide how to get the code!">WWO ID</a></td>';
    echo '<td><label><input style="width: 130px;" name="weather_and_weather_forecast-fwo_licence_code" type="text" value="'.$fwo_licence_code.'" /></label></td>';   
    echo '<td><label><input type="radio" name="weather_and_weather_forecast-opt_provider_preference" value="fwo" '.$i_fwo_preference_select.'>Prefer WWO</label></tr>';
    echo '</table>';
    echo '<table>';
    echo '<tr><td><a title="If using the Auto-location feature you might like to get a key from Ipinfodb to improve the results of geolocation. Enter it here!">(opt.)Ipinfo ID</a>:</td><td><label><input style="width: 125px; " name="weather_and_weather_forecast-ipinfodb_key" type="text" value="'.$ipinfodb_key.'" /></label></td>';
    echo '<td>&nbsp;<input type="checkbox" name="weather_and_weather_forecast-opt_get_better" value="checked" '.(($opt_get_better=='checked')?'checked="checked"' : '').'"><a title="If you like to get more data or details for your weather by combining the above weather services, please check this option!">&nbsp;Optimize data</a></td></td></tr>';
    echo '</tr>';
    echo '</table>';
    echo '<table><tr>';
    echo '<td><td><a title="The Server will cache the weather data for the entered time in seconds!">Cache:</a></td><td><label><input style="width: 40px;" name="weather_and_weather_forecast-wc_cachetime" type="text" value="'.$wc_cachetime.'" /></label></td><td>sec</td>';
    echo '<td>&nbsp;<a title="Enter a number of hours here to synchronize local with server time!">Serv.time:</a></td><td><label><input style="width: 25px;" name="weather_and_weather_forecast-time_corr" type="text" value="'.$time_corr.'" /></label></td><td>hrs</td';
    echo '<td>&nbsp;<a title="Enter a number of seconds here to stop your geolocation query, if the geolocation server doesnt respond! Increase if you are running your site on slow server!">&nbsp;Timeout:</a></td><td><label><input style="width: 20px;" name="weather_and_weather_forecast-timeout" type="text" value="'.$timeout.'" /></label></td><td>sec</td>';
    echo '</tr></table>';
    echo '<table>';
    echo '<tr><td><a title="Path, where to find the images!">Images</a>:</td><td><label><input style="width: 305px; " name="weather_and_weather_forecast-images" type="text" value="'.$images.'" /></label></td></tr>';
    echo '</table>';
    echo '<table>';
    echo '<td><b>Status:</b></td>';
    echo '</table>';
    echo $wc_connection_check." ".$wc_id_check." ".$wc_loc_check." ".$ipinfodb_check.' System: '.$wc_WP.$wc_Theme.$wc_PHP.$wc_MYSQL.$wc_browser;
    echo '<table>';
    echo '<td><b>Language Selection:</b></td>';
    echo '</table>';
    echo '<table>';
    echo '<tr>';
    echo '<td>&nbsp;&nbsp<input type="checkbox" name="weather_and_weather_forecast-opt_language_select" value="checked" '.(($opt_language_select=='checked')?'checked="checked"' : '').'"><a title="Check this if you like the widget to decide which language to choose from (see the manual for details!). The chosen language from the box on the right will be used as your default language nevertheless!">&nbsp;Auto&nbsp;</a></td>';
    echo '<td><label><select style="width: 280px;" name="weather_and_weather_forecast-opt_language"></option><option value="ar" '.( ($opt_language == "ar") ? "selected=\"selected\" " : "" ).'>عربي(السعودية) (Arabic) </option><option value="zh" '.( ($opt_language == "zh") ? "selected=\"selected\" " : "" ).'>中國的 (Chinese) </option><option value="da" '.( ($opt_language == "da") ? "selected=\"selected\" " : "" ).'>Dansk (Danish) </option><option value="de" '.( ($opt_language == "de") ? "selected=\"selected\" " : "" ).'>Deutsch (German) </option><option value="en" '.( ($opt_language == "en") ? "selected=\"selected\" " : "" ).'>English</option><option value="nl" '.( ($opt_language == "nl") ? "selected=\"selected\" " : "" ).'>Dutch (Nederlands)</option><option value="es" '.( ($opt_language == "es") ? "selected=\"selected\" " : "" ).'>Espa&ntilde;ol (Spanish)</option><option value="fr" '.( ($opt_language == "fr") ? "selected=\"selected\" " : "" ).'>Fran&ccedil;ais (French)</option><option value="it" '.( ($opt_language == "it") ? "selected=\"selected\" " : "" ).'>Italiano (Italian)</option><option value="ga" '.( ($opt_language == "ga") ? "selected=\"selected\" " : "" ).'>Gaeilge (Irish) </option><option value="hu" '.( ($opt_language == "hu") ? "selected=\"selected\" " : "" ).'>Magyar (Hungarian)</option><option value="no" '.( ($opt_language == "no") ? "selected=\"selected\" " : "" ).'>Norske (Norwegian)</option><option value="pl" '.( ($opt_language == "pl") ? "selected=\"selected\" " : "" ).'>Polski (Polish)</option><option value="pt" '.( ($opt_language == "pt") ? "selected=\"selected\" " : "" ).'>Portugu&ecirc;s (Portuguese)</option><option value="ru" '.( ($opt_language == "ru") ? "selected=\"selected\" " : "" ).'>&#1088;&#1091;&#1089;&#1089;&#1082;&#1080;&#1081; (Russian) </option><option value="sr" '.( ($opt_language == "sr") ? "selected=\"selected\" " : "" ).'>&#1089;&#1088;&#1087;&#1089;&#1082;&#1080;(Serbian) </option></label>&nbsp;</td>';
    echo '</tr>';
    echo '</table>';
    echo '<table>';
    echo '<td><b>Layout Settings:</b></td><td>&nbsp;&nbsp;<a href="http://www.go-gadget-blog.com" target="_blank" style:"font-size:0.5em" title="Click here and visit HELP and INSTRUCTIONS on www.gop-gadget-blog.com for help! You can also download the manual at www.go-gadget-blog.com!">Help!</a>&nbsp;&nbsp;</td>';
    echo '</table>';
    echo '<table>';
    echo '<tr><td><label><select style="width: 360px;" name="weather_and_weather_forecast-opt_layout"><option value="small" '.( ($opt_layout == "small") ? "selected=\"selected\" " : "" ).'>Small Layout: Shows only the current conditions</option><option value="medium" '.( ($opt_layout == "medium") ? "selected=\"selected\" " : "" ).'>Medium Layout: Current Conditions and forecast for today</option><option value="large" '.( ($opt_layout == "large") ? "selected=\"selected\" " : "" ).'>Large Layout: Conditions and Forecast for next three days</option><option value="pure" '.( ($opt_layout == "pure") ? "selected=\"selected\" " : "" ).'>Pure: Forecast data only for today and the next three days (check "Extended" to get data for even more days)</option></label></td></tr>';
    echo '<tr><td><label><select style="width: 360px;" name="weather_and_weather_forecast-imagefolder"><option value="WeatherCom_1" '.( ($imagefolder == "WeatherCom_1") ? "selected=\"selected\" " : "" ).'>Images: Weather.Com Images (Set 1)</option><option value="WeatherCom_2" '.( ($imagefolder == "WeatherCom_2") ? "selected=\"selected\" " : "" ).'>Images: Weather.Com Images (Set 2)</option><option value="Custom1" '.( ($imagefolder == "Custom1") ? "selected=\"selected\" " : "" ).'>Images:  Custom 1 ("../weatherimages/Custom1")</option><option value="Custom2" '.( ($imagefolder == "Custom2") ? "selected=\"selected\" " : "" ).'>Images:  Custom 2 ("../weatherimages/Custom2")</option><option value="Custom3" '.( ($imagefolder == "Custom3") ? "selected=\"selected\" " : "" ).'>Images:  Custom 3 ("../weatherimages/Custom3")</option></label></td></tr>';
    echo '</table>';
    echo '<table>';
    echo '<tr><td><input type="checkbox" name="weather_and_weather_forecast-opt_extended_forecast_select" value="checked" '.(($opt_extended_forecast_select=='checked')?'checked="checked"' : '').'"><a title="Show forecast for all available days (app. 5 days total with WWO and 8 days total with WUN)! ">&nbsp;Extended Forecast</a></td>';
    echo '<td><input type="checkbox" name="weather_and_weather_forecast-opt_eng_in_fc_texts" value="checked" '.(($opt_eng_in_fc_texts=='checked')?'checked="checked"' : '').'"><a title="Check if you dont mind getting more detailed forecast texts in English although having chosen another language (Default if language = English)">&nbsp;Det.Texts&nbsp;</a></td>';
    echo '<td><input type="checkbox" name="weather_and_weather_forecast-opt_hide_feels_like" value="checked" '.(($opt_hide_feels_like=='checked')?'checked="checked"' : '').'"><a title="Check if you dont want to show the FeelsLike temperature">&nbsp;Hide FeelsLike</a></td>';  
    echo '</tr>';
    echo '</table>';
    echo '<table>'; 
    echo '<tr><td colspan = 2><a title="Choose YES to show infos about Sunrise, -setting and Moonphase with the actual conditions!">Sun/Moon</a> &nbsp; <a title="Select between metric and imperial units">Units</a></td><td colspan=2> &nbsp;&nbsp;<a title="Coose a different Font and Font Color. For color choose a valid color name or a hexcode! See manual for details!">Font Family / Color (opt.)</a></td></tr>';
    echo '<tr>';
    echo '<td><label><select style="width: 50px;" name="weather_and_weather_forecast-opt_sunmoon_text"><option value="yes" '.( ($opt_sunmoon_text == "yes") ? "selected=\"selected\" " : "" ).'>yes</option><option value="no" '.( ($opt_sunmoon_text == "no") ? "selected=\"selected\" " : "" ).'>no</option></label></td>';
    echo '<td><label><select style="width: 103px;" name="weather_and_weather_forecast-opt_unit"><option value="s" '.( ($opt_unit == "s") ? "selected=\"selected\" " : "" ).'>&deg;F / imperial</option><option value="m" '.( ($opt_unit == "m") ? "selected=\"selected\" " : "" ).'>&deg;C / metric</option></label></td>';
    echo '<td><label><select style="width: 97px;" name="weather_and_weather_forecast-font_family"><option value="(Theme)" '.( ($font_family == "") ? "selected=\"selected\" " : "" ).'>(Theme)</option><option value="Arial" '.( ($font_family == "Arial") ? "selected=\"selected\" " : "" ).'>Arial</option><option value="Avantgarde" '.( ($font_family == "Avantgarde") ? "selected=\"selected\" " : "" ).'>Avantgarde</option><option value="Comic Sans MS" '.( ($font_family == "Comic Sans MS") ? "selected=\"selected\" " : "" ).'>Comic Sans MS</option><option value="Helvetica" '.( ($font_family == "Helvetica") ? "selected=\"selected\" " : "" ).'>Helvetica</option><option value="Times New Roman" '.( ($font_family == "Times New Roman") ? "selected=\"selected\" " : "" ).'>Times New Roman</option><option value="Verdana" '.( ($font_family == "Verdana") ? "selected=\"selected\" " : "" ).'>Verdana</option></label></td>';
    echo '<td><label><input style="width: 97px;" name="weather_and_weather_forecast-font_color" type="text" value="'.$font_color.'" /></label></td>';
    echo '</table>';
    echo '<table>';
    echo '<tr><td></td><td><a title="Settings for all large images and texts. See manual for details!">Size L</a></td><td><a title="Settings for all medium images and texts. See manual for details!">Size M</a></td><td><a title="Settings for all small images and texts. See manual for details!">Size S</a></td></tr>';
    echo '<tr>';
    echo '<td><a title="Use the percentage values to fit font size. See manual for details!">Font&nbsp;</a></td><td><label><select style="width: 99px;" name="weather_and_weather_forecast-f_size_l"><option value="170%" '.( ($f_size_l == "170%") ? "selected=\"selected\" " : "" ).'>170%</option><option value="160%" '.( ($f_size_l == "160%") ? "selected=\"selected\" " : "" ).'>160%</option><option value="150%" '.( ($f_size_l == "150%") ? "selected=\"selected\" " : "" ).'>150%</option><option value="140%" '.( ($f_size_l == "140%") ? "selected=\"selected\" " : "" ).'>140%</option><option value="130%" '.( ($f_size_l == "130%") ? "selected=\"selected\" " : "" ).'>130%</option><option value="120%" '.( ($f_size_l == "120%") ? "selected=\"selected\" " : "" ).'>120%</option><option value="110%" '.( ($f_size_l == "110%") ? "selected=\"selected\" " : "" ).'>110%</option></option><option value="100%" '.( ($f_size_l == "100%") ? "selected=\"selected\" " : "" ).'>100%</option><option value="90%" '.( ($f_size_l == "90%") ? "selected=\"selected\" " : "" ).'>90%</option><option value="80%" '.( ($f_size_l == "80%") ? "selected=\"selected\" " : "" ).'>80%</option></label></td>';
    echo '<td><label><select style="width: 99px;" name="weather_and_weather_forecast-f_size_m"><option value="150%" '.( ($f_size_m == "150%") ? "selected=\"selected\" " : "" ).'>150%</option><option value="140%" '.( ($f_size_m == "140%") ? "selected=\"selected\" " : "" ).'>140%</option><option value="130%" '.( ($f_size_m == "130%") ? "selected=\"selected\" " : "" ).'>130%</option><option value="120%" '.( ($f_size_m == "120%") ? "selected=\"selected\" " : "" ).'>120%</option><option value="110%" '.( ($f_size_m == "110%") ? "selected=\"selected\" " : "" ).'>110%</option><option value="100%" '.( ($f_size_m == "100%") ? "selected=\"selected\" " : "" ).'>100%</option><option value="90%" '.( ($f_size_m == "90%") ? "selected=\"selected\" " : "" ).'>90%</option><option value="80%" '.( ($f_size_m == "80%") ? "selected=\"selected\" " : "" ).'>80%</option><option value="70%" '.( ($f_size_m == "70%") ? "selected=\"selected\" " : "" ).'>70%</option><option value="60%" '.( ($f_size_m == "60%") ? "selected=\"selected\" " : "" ).'>60%</option></label></td>';
    echo '<td><label><select style="width: 99px;" name="weather_and_weather_forecast-f_size_s"><option value="130%" '.( ($f_size_m == "130%") ? "selected=\"selected\" " : "" ).'>130%</option><option value="120%" '.( ($f_size_s == "120%") ? "selected=\"selected\" " : "" ).'>120%</option><option value="110%" '.( ($f_size_s == "110%") ? "selected=\"selected\" " : "" ).'>110%</option><option value="100%" '.( ($f_size_s == "100%") ? "selected=\"selected\" " : "" ).'>100%</option><option value="90%" '.( ($f_size_s == "90%") ? "selected=\"selected\" " : "" ).'>90%</option><option value="80%" '.( ($f_size_s == "80%") ? "selected=\"selected\" " : "" ).'>80%</option><option value="70%" '.( ($f_size_s == "70%") ? "selected=\"selected\" " : "" ).'>70%</option><option value="60%" '.( ($f_size_s == "60%") ? "selected=\"selected\" " : "" ).'>60%</option><option value="50%" '.( ($f_size_s == "50%") ? "selected=\"selected\" " : "" ).'>50%</option><option value="40%" '.( ($f_size_s == "40%") ? "selected=\"selected\" " : "" ).'>40%</option></label></td>';
    echo '</tr>';
    echo '<tr>';
    echo '<td><a title="Use the percentage values to fit the size of the images. See manual for details!">Images&nbsp;</a></td><td><label><select style="width: 99px;" name="weather_and_weather_forecast-i_size_l"><option value="1.4" '.( ($i_size_l == "1.4") ? "selected=\"selected\" " : "" ).'>140%</option><option value="1.3" '.( ($i_size_l == "1.3") ? "selected=\"selected\" " : "" ).'>130%</option><option value="1.2" '.( ($i_size_l == "1.2") ? "selected=\"selected\" " : "" ).'>120%</option><option value="1.1" '.( ($i_size_l == "1.1") ? "selected=\"selected\" " : "" ).'>110%</option></option><option value="1" '.( ($i_size_l == "1") ? "selected=\"selected\" " : "" ).'>100%</option><option value="0.9" '.( ($i_size_l == "0.9") ? "selected=\"selected\" " : "" ).'>90%</option><option value="0.8" '.( ($i_size_l == "0.8") ? "selected=\"selected\" " : "" ).'>80%</option><option value="0.7" '.( ($i_size_l == "0.7") ? "selected=\"selected\" " : "" ).'>70%</option><option value="0.6" '.( ($i_size_l == "0.6") ? "selected=\"selected\" " : "" ).'>60%</option></label></td>';
    echo '<td><label><select style="width: 99px;" name="weather_and_weather_forecast-i_size_m"><option value="1.4" '.( ($i_size_m == "1.4") ? "selected=\"selected\" " : "" ).'>140%</option><option value="1.3" '.( ($i_size_m == "1.3") ? "selected=\"selected\" " : "" ).'>130%</option><option value="1.2" '.( ($i_size_m == "1.2") ? "selected=\"selected\" " : "" ).'>120%</option><option value="1.1" '.( ($i_size_m == "1.1") ? "selected=\"selected\" " : "" ).'>110%</option></option><option value="1" '.( ($i_size_m == "1") ? "selected=\"selected\" " : "" ).'>100%</option><option value="0.9" '.( ($i_size_m == "0.9") ? "selected=\"selected\" " : "" ).'>90%</option><option value="0.8" '.( ($i_size_m == "0.8") ? "selected=\"selected\" " : "" ).'>80%</option><option value="0.7" '.( ($i_size_m == "0.7") ? "selected=\"selected\" " : "" ).'>70%</option><option value="0.6" '.( ($i_size_m == "0.6") ? "selected=\"selected\" " : "" ).'>60%</option></label></td>';
    echo '<td><label><select style="width: 99px;" name="weather_and_weather_forecast-i_size_s"><option value="1.4" '.( ($i_size_s == "1.4") ? "selected=\"selected\" " : "" ).'>140%</option><option value="1.3" '.( ($i_size_s == "1.3") ? "selected=\"selected\" " : "" ).'>130%</option><option value="1.2" '.( ($i_size_s == "1.2") ? "selected=\"selected\" " : "" ).'>120%</option><option value="1.1" '.( ($i_size_s == "1.1") ? "selected=\"selected\" " : "" ).'>110%</option></option><option value="1" '.( ($i_size_s == "1") ? "selected=\"selected\" " : "" ).'>100%</option><option value="0.9" '.( ($i_size_s == "0.9") ? "selected=\"selected\" " : "" ).'>90%</option><option value="0.8" '.( ($i_size_s == "0.8") ? "selected=\"selected\" " : "" ).'>80%</option><option value="0.7" '.( ($i_size_s == "0.7") ? "selected=\"selected\" " : "" ).'>70%</option><option value="0.6" '.( ($i_size_s == "0.6") ? "selected=\"selected\" " : "" ).'>60%</option></label></td>';
    echo '</tr>';
    echo '</table>';
    echo '<table>';
    echo '<tr><td><a title="Choose YES if you like to separate the widget with additional lines before and after the widget">Lines(opt.)</a></td><td><a title="Name a color name for the background if you like. For color choose a valid color name or a hexcode! See manual for details!">BackColor(opt.)</a></td><td><a title="If your widget area provides more space than the widget needs, you can choose a left and right padding to optimize the look!">Padding(opt.)</a></td><td><a title="Recommended to check!">Embedded</a></td></tr>';
    echo '<tr><td><label><select style="width: 70px;" name="weather_and_weather_forecast-opt_lines"><option value="no" '.( ($opt_lines == "no") ? "selected=\"selected\" " : "" ).'>no</option><option value="yes" '.( ($opt_lines == "yes") ? "selected=\"selected\" " : "" ).'>yes</option></label></td>';
    echo '<td><label><input style="width: 110px;" name="weather_and_weather_forecast-background_color" type="text" value="'.$background_color.'" /></label></td>';
    echo '<td><label><select style="width: 90px;" name="weather_and_weather_forecast-size_padding"><option value="0px" '.( ($size_padding == "0px") ? "selected=\"selected\" " : "" ).'>0px</option><option value="5px" '.( ($size_padding == "5px") ? "selected=\"selected\" " : "" ).'>5px</option><option value="10px" '.( ($size_padding == "10px") ? "selected=\"selected\" " : "" ).'>10px</option><option value="15px" '.( ($size_padding == "15px") ? "selected=\"selected\" " : "" ).'>15px</option><option value="20px" '.( ($size_padding == "20px") ? "selected=\"selected\" " : "" ).'>20px</option><option value="25px" '.( ($size_padding == "25px") ? "selected=\"selected\" " : "" ).'>25px</option><option value="30px" '.( ($size_padding == "30px") ? "selected=\"selected\" " : "" ).'>30px</option><option value="35px" '.( ($size_padding == "35px") ? "selected=\"selected\" " : "" ).'>35px</option><option value="40px" '.( ($size_padding == "40px") ? "selected=\"selected\" " : "" ).'>40px</option><option value="45px" '.( ($size_padding == "45px") ? "selected=\"selected\" " : "" ).'>45px</option><option value="50px" '.( ($size_padding == "50px") ? "selected=\"selected\" " : "" ).'>50px</option></label></td>';  
    echo '<td>&nbsp;&nbsp;&nbsp;<input type="checkbox" name="weather_and_weather_forecast-opt_css_select" value="checked" '.(($opt_css_select=='checked')?'checked="checked"' : '').'">&nbsp;CSS</td>';
    echo '</table>';
    echo '<table><td>&nbsp;&nbsp;&nbsp;Link to provider (mandatory!):</td>';
    echo '<td><label><select style="width: 100px;" name="weather_and_weather_forecast-opt_link_to_provider"><option value="yes" '.( ($opt_link_to_provider == "yes") ? "selected=\"selected\" " : "" ).'>yes</option><option value="no" '.( ($opt_link_to_provider == "no") ? "selected=\"selected\" " : "" ).'>no</option></label></td></tr></table>';
   $widget_options['opt_provider_preference']=$opt_provider_preference;
    echo '<input type="hidden" name="weather_and_weather_forecast-submit" value="1" />';
}
//**************************end control******************************************

//**************************widget***********************************************
function GG_func_widget_weather_and_weather_forecast($args) {
  extract($args); 
  $flag_shortcode=0;
  $extended_forecast ="";
  $icon_layout_middle_check="";
  $opt_language_index="";
  $opt_auto_language_select="";
  $sc_title="";
  $i_flag_no_data="";
  $gg_weather=GG_funx_initialize_GG_weather();   
  $widget_options = get_option('GG_func_widget_weather_and_weather_forecast');
  $ipinfodb_key = htmlspecialchars($widget_options['ipinfodb_key'], ENT_QUOTES);
	$timeout = htmlspecialchars($widget_options['timeout'], ENT_QUOTES);
  if($args['flag']){
    $sc_title = htmlspecialchars($args['title'], ENT_QUOTES);
    $opt_language = $args['language'];
    $opt_layout =   "sc_".$args['layout'];
    $i_location_city = $args['city'];
    $i_location_state = $args['state'];
    if($args['lat']){
    $i_location_lat = $args['lat'];
    $i_location_lon = $args['lon'];
    //echo "LAT=".$i_location_lat;
    //echo "LON=".$i_location_lon;
    }
    if($args['language']=="auto"){$opt_language_select="checked";}else{$opt_language_select = "unchecked";}
    $opt_auto_location_select = "unchecked";
    if($args['autolocation']=="yes" or $args['autolocation']=="Yes"){
      list($flag_search,$i_search_state,$i_search_city,$country_code) = GG_func_get_ip_data($ipinfodb_key,$timeout); 
      if($flag_search=="Yes"){
        $location_city=$i_search_city;
        $location_state=$i_search_state;
        $sc_title=ucfirst(strtolower($i_search_city));
      }
    }
    $opt_css_select = "unchecked";
    $wc_cachetime = 0;
    }
  else
  {
    $title = htmlspecialchars($widget_options['title'], ENT_QUOTES);
    $opt_language = $widget_options['opt_language'];
    $opt_layout = $widget_options['opt_layout'];
    $i_location_city = htmlspecialchars($widget_options['i_location_city'], ENT_QUOTES);
    $i_location_state= htmlspecialchars($widget_options['i_location_state'], ENT_QUOTES);
    $i_location_lat = str_replace(",",".",$widget_options['i_location_lat']);
    $i_location_lon= str_replace(",",".",$widget_options['i_location_lon']);
    $opt_auto_location_select =  htmlspecialchars($widget_options['opt_auto_location_select'], ENT_QUOTES);
    $opt_language_select = $widget_options['opt_language_select'];
    $opt_css_select = $widget_options['opt_css_select'];
    $wc_cachetime = $widget_options['wc_cachetime'];
  }
  $title_back = htmlspecialchars($widget_options['title_back'], ENT_QUOTES);
	$wun_licence_code = GG_funx_get_code(htmlspecialchars($widget_options['wun_licence_code'], ENT_QUOTES));
	$fwo_licence_code = htmlspecialchars($widget_options['fwo_licence_code'], ENT_QUOTES);
	$opt_provider_preference = htmlspecialchars($widget_options['opt_provider_preference'], ENT_QUOTES);	
  $opt_get_better =  htmlspecialchars($widget_options['opt_get_better'], ENT_QUOTES);
	$imageloc = $widget_options['images'];
	$imagefolder = $widget_options['imagefolder']."/";
	$imagefolder_check="WeatherCom";
	if(!substr_count($imagefolder,"Weather")){$imagefolder_check="Custom";} 
	$widgettitle = ($widget_options['title'] != "") ? $before_title.$widget_options['title'].$after_title : "";  // ($widget_options['title'] != "") ? $widget_options['title'] : "weather Rankings";	
	$wc_lastcheck = $widget_options['wc_lastcheck'];
	$opt_unit = $widget_options['opt_unit'];
	$opt_unit = ($opt_unit == "s" || $opt_unit == "m") ? $opt_unit : "m";
	$opt_title_select = htmlspecialchars($widget_options['opt_title_select'], ENT_QUOTES);
  $opt_language = ($opt_language == "de" || $opt_language == "en" || $opt_language == "fr" || $opt_language == "es" || $opt_language == "it" || $opt_language == "pl" || $opt_language == "hu" || $opt_language == "pt" || $opt_language == "ar"  || $opt_language == "da" || $opt_language == "ga" || $opt_language == "nl" || $opt_language == "no" || $opt_language == "ru" || $opt_language == "sr" || $opt_language == "zh"   ) ? $opt_language : "en";
  $opt_language_2="";
  $opt_language_index=99;
  $opt_eng_in_fc_texts =  htmlspecialchars($widget_options['opt_eng_in_fc_texts'], ENT_QUOTES);
  $pageURL="";
  $auto_loc=""; 
  list($opt_language_index,$opt_language)=GG_func_get_language($opt_language,$opt_language_select);
  $info_text="<!--V5.0 rev003 *PID"." *ALoS".$opt_auto_location_select." *ALaS".$opt_auto_language_select." *L".$opt_language." *CSS".$opt_css_select." *Loc".$i_location_city.$i_location_lat.",".$i_location_state.$i_location_lon."*"."-->";
  $location_city=$i_location_city;
  $location_state=$i_location_state; 
  if($opt_auto_location_select=="checked"){
    list($flag_search,$i_search_state,$i_search_city,$country_code) = GG_func_get_ip_data($ipinfodb_key,$timeout); 
    if($flag_search=="Yes"){
      $location_city=$i_search_city;
      $location_state=$i_search_state;
      if(!isset($opt_language_index) and $opt_language_index!=99){
        $auto_loc=ucfirst(strtolower($i_search_city)).", ".GG_funx_translate_statename($country_code,$opt_language_index);
      }
      else{
        $auto_loc=ucfirst(strtolower($i_search_city)).", ".ucwords(strtolower($i_search_state));
      }     
    }
    if($flag_search!="Yes"){
    $auto_loc="";}
  }
  
  if($opt_title_select=="checked")
    {
    $auto_loc=$title_back;  
    }  
	$opt_sunmoon_text = $widget_options['opt_sunmoon_text'];
	$opt_link_to_provider = $widget_options['opt_link_to_provider'];
	$format_c1 =  htmlspecialchars($widget_options['format_l1'], ENT_QUOTES);
  $format_l1 =  htmlspecialchars($widget_options['format_l1'], ENT_QUOTES);
	$format_t0 =  htmlspecialchars($widget_options['format_t0'], ENT_QUOTES);
	$format_t1 =  htmlspecialchars($widget_options['format_t1'], ENT_QUOTES);
	$format_t2 =  htmlspecialchars($widget_options['format_t2'], ENT_QUOTES);
	$format_t3 =  htmlspecialchars($widget_options['format_t3'], ENT_QUOTES);
	$format_t4 =  htmlspecialchars($widget_options['format_t4'], ENT_QUOTES);
	$format_t5 =  htmlspecialchars($widget_options['format_t5'], ENT_QUOTES);
	$format_l2 =  htmlspecialchars($widget_options['format_l2'], ENT_QUOTES);
	$format_c2 =  htmlspecialchars($widget_options['format_l1'], ENT_QUOTES);
	$time_corr = $widget_options['time_corr'];
  if(time() - $wc_cachetime < $wc_lastcheck and $widget_options['wc_cache'] != "") 
      {
	   echo $before_widget.$widgettitle.$widget_options['wc_cache'].$after_widget;
     }
	else 
    {		
  $location_string_wun="/".$location_state."/".$location_city;
  $location_string_wun=str_replace(" ","_",$location_string_wun);
  $location_string_fwo=$location_city.",".$location_state;
  $location_string_fwo=str_replace(" ","+",$location_string_fwo);
  if($i_location_lat<>""){
    $location_string_wun=$i_location_lat.",".$i_location_lon;
    $location_string_fwo=$i_location_lat.",".$i_location_lon;
  }
  $gg_weather=gg_funx_get_weather_data($gg_weather,$wun_licence_code,$location_string_wun,$fwo_licence_code,$location_string_fwo,$opt_provider_preference,$opt_get_better,$imagefolder_check,$imageloc,$imagefolder,$time_corr,$timeout);
  if($gg_weather[0][99][0]=="Error" or $gg_weather[0][99][1]=="Error")
  {
    if($opt_provider_preference=="wun")
    {
      $gg_weather=GG_funx_initialize_GG_weather();
      $gg_weather=gg_funx_get_weather_data($gg_weather,$wun_licence_code,$location_string_wun,$fwo_licence_code,$location_string_fwo,"fwo",$opt_get_better,$imagefolder_check,$imageloc,$imagefolder,$time_corr,$timeout);
    }
    if($opt_provider_preference=="fwo")
    {
      $gg_weather=GG_funx_initialize_GG_weather();
      $gg_weather=gg_funx_get_weather_data($gg_weather,$wun_licence_code,$location_string_wun,$fwo_licence_code,$location_string_fwo,"wun",$opt_get_better,$imagefolder_check,$imageloc,$imagefolder,$time_corr,$timeout);
    }
    if($gg_weather[0][99][0]=="Error" or $gg_weather[0][99][1]=="Error")
    {$gg_weather[0][99][3]="Error";} 
  }
  if(!$gg_weather[0][99][3])
  {
          if($opt_unit=="s"){
            $flag_unit=0;
            $unit_temp="&deg;F";
            $unit_temp_short="&deg;";
            $unit_pressure="in";
            $unit_speed="mph";
            $unit_length="mi";
            $unit_rain="in";
          }
          if($opt_unit=="m"){
            $flag_unit=1;
            $unit_temp="&deg;C";
            $unit_temp_short="&deg;";
            $unit_pressure="mbar";
            $unit_speed="km/h";
            $unit_length="km";
            $unit_rain="mm";
          }
          $i_days=count($gg_weather)-1;
          $o_day[1]=GG_funx_translate_array("Today",$opt_language);
          $o_day[2]=GG_funx_translate_array("Tomorrow",$opt_language);
          for($i=3;$i<=$i_days;$i++){$o_day[$i]=GG_funx_translate_array($gg_weather[$i][0][3],$opt_language); }
          for($i=0;$i<=$i_days;$i++){$o_day_short[$i]=GG_funx_translate_weekdays($gg_weather[$i][0][3],$opt_language_index);}
          if($opt_language=="en"){for($i=0;$i<=$i_days;$i++){$o_day_short[$i]=substr($gg_weather[$i][0][3],0,3);};}      
                     
          $o_feels_lang=GG_funx_translate_array("Feels like",$opt_language);         
          $o_mo_actual=GG_funx_translate_array("Actual Conditions",$opt_language)." - ";          
          if($gg_weather[0][12][1]>=800 and $gg_weather[0][12][1]<=1100){  //pressuretendence einbauen
            $term_out=GG_funx_translate_pressure($gg_weather[0][12][$flag_unit],$unit_pressure,$opt_language);
            if ($term_out!=""){$o_mo_actual=$o_mo_actual."(".$term_out."-) ";}
            $o_mo_actual=$o_mo_actual.GG_funx_translate_array("Pressure",$opt_language).": ".$gg_weather[0][12][$flag_unit]." ".$unit_pressure." - ";
          }
          if($gg_weather[0][11][3]>0 and $gg_weather[0][11][3]<=200 and GG_funx_translate_windspeed($gg_weather[0][11][3],"mph",$opt_language)!=""){
            $o_mo_actual=$o_mo_actual."".GG_funx_translate_array("Wind",$opt_language).": ".GG_funx_translate_windspeed($gg_weather[0][11][3+$flag_unit],$unit_speed,$opt_language)." (".$gg_weather[0][11][3+$flag_unit].$unit_speed.") ".GG_funx_translate_array("from",$opt_language)." ".GG_funx_translate_winddirections($gg_weather[0][11][1],$opt_language);
            if($gg_weather[0][11][5]>0 and $gg_weather[0][11][5]<=200){
            $o_mo_actual=$o_mo_actual." (".GG_funx_translate_array("Gusts",$opt_language).": ".$gg_weather[0][11][5+$flag_unit].$unit_speed.")";
            }
            $o_mo_actual=$o_mo_actual." - ";
          }
          if($gg_weather[0][10]!=""){
            $o_mo_actual=$o_mo_actual."".GG_funx_translate_array("Humidity",$opt_language).": ".$gg_weather[0][10]."% - ";
          }
          if($gg_weather[0][15][0]!="" and $gg_weather[0][15][0]<>"N/A"){
            $o_mo_actual=$o_mo_actual."".GG_funx_translate_array("Visibility",$opt_language).": ".$gg_weather[0][15][$flag_unit]."".$unit_length." - ";
          }
          if($gg_weather[0][16]!="" or ($gg_weather[0][17][0]!="" and $gg_weather[0][17][0]!="0")){
            $o_mo_actual=$o_mo_actual."".GG_funx_translate_array("Precipitation",$opt_language).": ";
            if($gg_weather[0][16]!=""){
              $o_mo_actual=$o_mo_actual.$gg_weather[0][16]."% ";
            }
            if($gg_weather[0][17][0]!="" and $gg_weather[0][17][0]>0){
              $o_mo_actual=$o_mo_actual.$gg_weather[0][17][$flag_unit].$unit_rain." ";
            }
            $o_mo_actual=$o_mo_actual." - ";
          }
          if($gg_weather[0][14][0]!=""){
            $o_mo_actual=$o_mo_actual."".GG_funx_translate_array("Dewpoint",$opt_language).": ".$gg_weather[0][14][$flag_unit]."".$unit_temp." - ";
          }                                                                      
          if($gg_weather[0][18]!=""){
            $o_mo_actual=$o_mo_actual."".GG_funx_translate_array("Cloudcover",$opt_language).": ".$gg_weather[0][18]."% - ";
          }
          if($gg_weather[0][19][5]<>""){
            list($o_sunmoon_text,$flag_day_night)=GG_funx_get_sun_moon_text($gg_weather,$opt_language,$opt_language_index,$opt_auto_location_select,$time_corr,$args);
          }
          if($opt_language=="en"){
            $o_actual_brief=$gg_weather[0][2][2];
          }
          else{
            $o_actual_brief=GG_funx_translate_weather_detail_lang($gg_weather[0][2][2],$opt_language_index);
            //echo "HHHHHHHHHHHHHHHHH".$gg_weather[0][2][2]."-".$o_actual_brief."<br />";
            if($o_actual_brief=="" or $o_actual_brief==$gg_weather[0][2][2]){$o_actual_brief=GG_funx_translate_wetter_lang($gg_weather[0][2][3],$opt_language_index);}
            }
          $o_mo_today=$o_day[1].": ";
          if($opt_eng_in_fc_texts=="checked" or $opt_language=="en"){
              if($gg_weather[1][3][0]!="" or $gg_weather[1][4][0]!=""){
                if($gg_weather[1][3][0]!=""){$o_mo_today=$o_mo_today." ".GG_funx_translate_array("Day",$opt_language)." - ".$gg_weather[1][3][$flag_unit];
                  if(empty($gg_weather[1][3][$flag_unit])){$o_mo_today=$o_mo_today.$gg_weather[1][3][0]." - ";}
                }                                                                                              
                if($gg_weather[1][4][0]!=""){$o_mo_today=$o_mo_today." ".GG_funx_translate_array("Night",$opt_language)." - ".$gg_weather[1][4][$flag_unit];}
                  if(empty($gg_weather[1][3][$flag_unit])){$o_mo_today=$o_mo_today.$gg_weather[1][3][0]." - ";}
                }
              else{
                $o_mo_today=$o_mo_today.$gg_weather[1][2][2]." - ";
                if($gg_weather[1][11][3]>0 and $gg_weather[1][11][3]<=200 and GG_funx_translate_windspeed($gg_weather[1][11][3],"mph",$opt_language)!=""){
                  $o_mo_today=$o_mo_today."".GG_funx_translate_array("Wind",$opt_language).": ".GG_funx_translate_windspeed($gg_weather[1][11][3+$flag_unit],$unit_speed,$opt_language)." (".$gg_weather[1][11][3+$flag_unit].$unit_speed.") ".GG_funx_translate_array("from",$opt_language)." ".GG_funx_translate_winddirections($gg_weather[1][11][1],$opt_language);
                  if($gg_weather[1][11][5]>0 and $gg_weather[1][11][5]<=200){
                    $o_mo_today=$o_mo_today." (".GG_funx_translate_array("Gusts",$opt_language).": ".$gg_weather[1][11][5+$flag_unit].$unit_speed.")";
                  }
                  $o_mo_today=$o_mo_today." - ";
                  }
                  if($gg_weather[1][16]!="" or ($gg_weather[1][17][0]!="" and $gg_weather[1][17][0]!="0")){
                  $o_mo_today=$o_mo_today."".GG_funx_translate_array("Precipitation",$opt_language).": ";
                  if($gg_weather[1][16]!=""){
                    $o_mo_today=$o_mo_today.$gg_weather[1][16]."% ";
                  }
                  if($gg_weather[1][17][0]!="" and $gg_weather[1][17][0]>0){
                    $o_mo_today=$o_mo_today.$gg_weather[1][17][$flag_unit].$unit_rain." ";
                  }
                  $o_mo_today=$o_mo_today." - ";
                  if($gg_weather[1][10]!=""){
                    $o_mo_today=$o_mo_today."".GG_funx_translate_array("Humidity",$opt_language).": ".$gg_weather[0][10]."% - ";
                  }
                }
              }
          } 
          else
          {              
             if(GG_funx_translate_weather_detail_lang($gg_weather[1][2][2],$opt_language_index)!="" and GG_funx_translate_weather_detail_lang($gg_weather[1][2][2],$opt_language_index)!=$gg_weather[1][2][2]){
                $o_mo_today=$o_mo_today.GG_funx_translate_weather_detail_lang($gg_weather[1][2][2],$opt_language_index)." - ";}
             else{ 
                $o_mo_today=$o_mo_today.GG_funx_translate_wetter_lang($gg_weather[1][2][3],$opt_language_index)." - ";}
             if($gg_weather[1][11][3]>0 and $gg_weather[1][11][3]<=200 and GG_funx_translate_windspeed($gg_weather[1][11][3],"mph",$opt_language)!=""){
                $o_mo_today=$o_mo_today."".GG_funx_translate_array("Wind",$opt_language).": ".GG_funx_translate_windspeed($gg_weather[1][11][3+$flag_unit],$unit_speed,$opt_language)." (".$gg_weather[1][11][3+$flag_unit].$unit_speed.") ".GG_funx_translate_array("from",$opt_language)." ".GG_funx_translate_winddirections($gg_weather[1][11][1],$opt_language);
                if($gg_weather[1][11][5]>0 and $gg_weather[1][11][5]<=200){
                $o_mo_today=$o_mo_today." (".GG_funx_translate_array("Gusts",$opt_language).": ".$gg_weather[1][11][5+$flag_unit].$unit_speed.")";
                }
                $o_mo_today=$o_mo_today." - ";
              }
              if($gg_weather[1][16]!="" or ($gg_weather[1][17][0]!="" and $gg_weather[1][17][0]!="0")){
                $o_mo_today=$o_mo_today."".GG_funx_translate_array("Precipitation",$opt_language).": ";
                  if($gg_weather[1][16]!=""){
                    $o_mo_today=$o_mo_today.$gg_weather[1][16]."% ";
                  }
                  if($gg_weather[1][17][0]!="" and $gg_weather[1][17][0]>0){
                    $o_mo_today=$o_mo_today.$gg_weather[1][17][$flag_unit].$unit_rain." ";
                }
              }
              $o_mo_today=$o_mo_today." - ";
              if($gg_weather[1][10]!=""){
                $o_mo_today=$o_mo_today."".GG_funx_translate_array("Humidity",$opt_language).": ".$gg_weather[1][10]."% - ";
              }              
          }
          for($i=2;$i<=$i_days;$i++){
              $o_mo_fc[$i]=$o_day[$i].", ".$gg_weather[$i][0][2];
              if($opt_language=="en"){
                  if($gg_weather[$i][0][2]=="1" or $gg_weather[$i][0][2]=="11" or $gg_weather[$i][0][2]=="21"){$o_mo_fc[$i]=$o_mo_fc[$i]."st";}
                  elseif($gg_weather[$i][0][2]=="2" or $gg_weather[$i][0][2]=="22"){$o_mo_fc[$i]=$o_mo_fc[$i]."nd";}
                  elseif($gg_weather[$i][0][2]=="3" or $gg_weather[$i][0][2]=="23"){$o_mo_fc[$i]=$o_mo_fc[$i]."rd";}
                  else{$o_mo_fc[$i]=$o_mo_fc[$i]."th";}
              }
              $o_mo_fc[$i]=$o_mo_fc[$i].": ";
              if($opt_eng_in_fc_texts=="checked" or $opt_language=="en"){
                  if($gg_weather[$i][3][0]!="" or $gg_weather[$i][4][0]!=""){
                    if($gg_weather[$i][3][0]!=""){$o_mo_fc[$i]=$o_mo_fc[$i]." ".GG_funx_translate_array("Day",$opt_language)." - ".$gg_weather[$i][3][$flag_unit];
                      if(empty($gg_weather[$i][3][$flag_unit])){$o_mo_fc[$i]=$o_mo_fc[$i].$gg_weather[$i][3][0]." - ";}
                    }
                    if($gg_weather[$i][4][0]!=""){$o_mo_fc[$i]=$o_mo_fc[$i]." ".GG_funx_translate_array("Night",$opt_language)." - ".$gg_weather[$i][4][$flag_unit];}
                      if(empty($gg_weather[$i][4][$flag_unit])){$o_mo_fc[$i]=$o_mo_fc[$i].$gg_weather[$i][4][0]." - ";}
                    $o_mo_fc[$i]=$o_mo_fc[$i]." - ";
                    }
                  else{
                    $o_mo_fc[$i]=$o_mo_fc[$i].$gg_weather[$i][2][2]." - ";
                    if($gg_weather[$i][11][3]>0 and $gg_weather[$i][11][3]<=200 and GG_funx_translate_windspeed($gg_weather[$i][11][3],"mph",$opt_language)!=""){
                      $o_mo_fc[$i]=$o_mo_fc[$i]."".GG_funx_translate_array("Wind",$opt_language).": ".GG_funx_translate_windspeed($gg_weather[$i][11][3+$flag_unit],$unit_speed,$opt_language)." (".$gg_weather[$i][11][3+$flag_unit].$unit_speed.") ".GG_funx_translate_array("from",$opt_language)." ".GG_funx_translate_winddirections($gg_weather[$i][11][1],$opt_language);
                    if($gg_weather[$i][11][5]>0 and $gg_weather[$i][11][5]<=200){
                      $o_mo_fc[$i]=$o_mo_fc[$i]." (".GG_funx_translate_array("Gusts",$opt_language).": ".$gg_weather[$i][11][5+$flag_unit].$unit_speed.")";
                      }
                    $o_mo_fc[$i]=$o_mo_fc[$i]." - ";  
                    }
                    if($gg_weather[$i][16]!="" or ($gg_weather[$i][17][0]!="" and $gg_weather[$i][17][0]!="0"))  {
                        $o_mo_fc[$i]=$o_mo_fc[$i]." ".GG_funx_translate_array("Precipitation",$opt_language).": ";
                        if($gg_weather[$i][16]!=""){
                            $o_mo_fc[$i]=$o_mo_fc[$i].$gg_weather[$i][16]."% ";
                        }
                        if($gg_weather[$i][17][$flag_unit]!="" and $gg_weather[$i][17][0]>0){
                            $o_mo_fc[$i]=$o_mo_fc[$i].$gg_weather[$i][17][$flag_unit].$unit_rain." ";
                        }
                    }
                  }
              } 
              else{
              if(GG_funx_translate_weather_detail_lang($gg_weather[$i][2][2],$opt_language_index)!="" and GG_funx_translate_weather_detail_lang($gg_weather[$i][2][2],$opt_language_index)!=$gg_weather[$i][2][2]){
                $o_mo_fc[$i]=$o_mo_fc[$i].GG_funx_translate_weather_detail_lang($gg_weather[$i][2][2],$opt_language_index)." - ";}
             else{ 
                $o_mo_fc[$i]=$o_mo_fc[$i].GG_funx_translate_wetter_lang($gg_weather[$i][2][3],$opt_language_index)." - ";}
              
              
                    
                    if($gg_weather[$i][11][3]>0 and $gg_weather[$i][11][3]<=200 and GG_funx_translate_windspeed($gg_weather[$i][11][3],"mph",$opt_language)!=""){
                      $o_mo_fc[$i]=$o_mo_fc[$i]."".GG_funx_translate_array("Wind",$opt_language).": ".GG_funx_translate_windspeed($gg_weather[$i][11][3+$flag_unit],$unit_speed,$opt_language)." (".$gg_weather[$i][11][3+$flag_unit].$unit_speed.") ".GG_funx_translate_array("from",$opt_language)." ".GG_funx_translate_winddirections($gg_weather[$i][11][1],$opt_language);
                    if($gg_weather[$i][11][5]>0 and $gg_weather[$i][11][5]<=200){
                      $o_mo_fc[$i]=$o_mo_fc[$i]." (".GG_funx_translate_array("Gusts",$opt_language).": ".$gg_weather[$i][11][5+$flag_unit].$unit_speed.")";
                      }
                    $o_mo_fc[$i]=$o_mo_fc[$i]." - ";  
                    }
                  if($gg_weather[$i][16]!="" or ($gg_weather[$i][17][0]!="" and $gg_weather[$i][17][0]!="0"))  {
                      $o_mo_fc[$i]=$o_mo_fc[$i]." ".GG_funx_translate_array("Precipitation",$opt_language).": ";
                      if($gg_weather[$i][16]!=""){
                        $o_mo_fc[$i]=$o_mo_fc[$i].$gg_weather[$i][16]."% ";
                      }
                      if($gg_weather[$i][17][0]!="" and $gg_weather[$i][17][0]>0){
                        $o_mo_fc[$i]=$o_mo_fc[$i].$gg_weather[$i][17][$flag_unit].$unit_rain." ";
                      }
                  }
                  $o_mo_fc[$i]=$o_mo_fc[$i]." - ";  
                  if($gg_weather[$i][10]!=""){
                $o_mo_fc[$i]=$o_mo_fc[$i]."".GG_funx_translate_array("Humidity",$opt_language).": ".$gg_weather[$i][10]."% - ";
                }               
              }
          
          }   
          $o_actual_temp=$gg_weather[0][5][$flag_unit].$unit_temp;
          $o_actual_windchill=$gg_weather[0][6][$flag_unit].$unit_temp;
          for($i=0;$i<=10;$i++){$o_code_destructor[$i]="";}
            for($i=$i_days+1;$i<=10;$i++){$o_code_destructor[$i]="DESTRUCT";}
             $o_temp_hi[1]=$gg_weather[1][7][$flag_unit].$unit_temp;
             $o_temp_lo[1]=$gg_weather[1][8][$flag_unit].$unit_temp;
             $o_temp_hi1[1]=$gg_weather[1][7][$flag_unit].$unit_temp_short;;
             $o_temp_lo1[1]=$gg_weather[1][8][$flag_unit].$unit_temp_short;;
            for($i=2;$i<=$i_days;$i++){
             $o_temp_hi[$i]=$gg_weather[$i][7][$flag_unit].$unit_temp_short;
             $o_temp_lo[$i]=$gg_weather[$i][8][$flag_unit].$unit_temp_short;
          }
          for($i=0;$i<=10;$i++){
            if(isset($gg_weather[$i][2][5]) or $gg_weather[$i][2][5]!="" ){
            $o_back_img[$i]=$gg_weather[$i][2][5];}
            else
            {$o_back_img[$i]="";}
            if($o_back_img[$i]=="" or !isset($gg_weather[$i][2][5])){$o_back_img[$i]=$imageloc."1x1.gif";}
          }
   }
   else
   {
        $i_flag_no_data="1";
        for($i=0;$i<=10;$i++){
          $o_code_destructor[$i]="";
        }
        for($i=0;$i<=10;$i++){
          $o_code_destructor[$i]="DESTRUCT";
          $o_back_img[$i]=$imageloc."1x1.gif";
        }
   }              
    $o_prmo[0]=$imageloc."1x1.gif";
    $o_prmo[1]=$imageloc."1x1.gif";
    $o_logo_destructor="DESTRUCT";
    $wun_prmo = $imageloc."WUN_logo_31px.png";
    $wun_prmo_link="http://www.wunderground.com";  
		$fwo_prmo =  $imageloc."WWO_logo_31px.png";
		$fwo_prmo_link="http://www.worldweatheronline.com"; 
    if($opt_provider_preference=="wun"){
      $o_prmo[0]=$wun_prmo;
      $o_prmo_link[0]=$wun_prmo_link;
      if($opt_get_better=="checked"){
        $o_logo_destructor=" ";
        $o_prmo[1]=$fwo_prmo;
        $o_prmo_link[1]=$fwo_prmo_link;
      }
    }
    if($opt_provider_preference=="fwo"){
      $o_prmo[0]=$fwo_prmo;
      $o_prmo_link[0]=$fwo_prmo_link;
      if($opt_get_better=="checked"){
        $o_logo_destructor=" ";
        $o_prmo[1]=$wun_prmo;
        $o_prmo_link[1]=$wun_prmo_link;
      }
    }
    $hide_table_1=0;    
    $format = $info_text.$widget_options['format_c1'].$widget_options['format_l1'].$widget_options['format_t0'];
    if($hide_table_1==0){
      $format = $format.$widget_options['format_t1'];
    }
    $format = $format.$widget_options['format_t2'].$widget_options['format_t3'].$widget_options['format_t4'].$widget_options['format_t5'].$widget_options['format_l2'].$widget_options['format_c2'];
    if($args['flag']){
      $format = $info_text.GG_func_widget_format($opt_layout,$args['float'],'','','',$args['scale'],'','','','','','','',$args['sidechange'],'');
    }

    
    if($i_flag_no_data==""){
    $content = str_replace(
			array (
        "%o_mo_actual%", "%sunmoon_text%", "%o_actual_temp%", "%o_actual_windchill%", "%actual_icon_href%", "%o_feels_lang%", "%o_actual_brief%","%o_code_destructor_0%",
				"%o_mo_today%", "%o_temp_hi_1%", "%o_temp_hi_11%", "%o_temp_lo_1%","%o_temp_lo_11%", "%today_icon_href%","%o_day_1%","%o_day_short_1%","%o_code_destructor_1%",
        "%o_mo_fc_2%", "%o_temp_hi_2%", "%o_temp_lo_2%", "%fc_2_icon_href%","%o_day_2%","%o_day_short_2%","%o_code_destructor_2%",
        "%o_mo_fc_3%", "%o_temp_hi_3%", "%o_temp_lo_3%", "%fc_3_icon_href%","%o_day_3%","%o_day_short_3%","%o_code_destructor_3%",   
        "%o_mo_fc_4%", "%o_temp_hi_4%", "%o_temp_lo_4%", "%fc_4_icon_href%","%o_day_4%","%o_day_short_4%","%o_code_destructor_4%",    
        "%o_mo_fc_5%", "%o_temp_hi_5%", "%o_temp_lo_5%", "%fc_5_icon_href%","%o_day_5%","%o_day_short_5%","%o_code_destructor_5%",    
        "%o_mo_fc_6%", "%o_temp_hi_6%", "%o_temp_lo_6%", "%fc_6_icon_href%","%o_day_6%","%o_day_short_6%","%o_code_destructor_6%",    
        "%o_mo_fc_7%", "%o_temp_hi_7%", "%o_temp_lo_7%", "%fc_7_icon_href%","%o_day_7%","%o_day_short_7%","%o_code_destructor_7%",    
        "%o_mo_fc_8%", "%o_temp_hi_8%", "%o_temp_lo_8%", "%fc_8_icon_href%","%o_day_8%","%o_day_short_8%","%o_code_destructor_8%",    
        "%o_mo_fc_9%", "%o_temp_hi_9%", "%o_temp_lo_9%", "%fc_9_icon_href%","%o_day_9%","%o_day_short_9%","%o_code_destructor_9%",                    
        "%extendend_forecast%", "%icon_layout_middle_check%","%auto_loc%","%info_text%","%sc_title%","%o_degree_seperator%",
        "%o_prmo_0%","%o_prmo_1%","%o_prmo_link_0%","%o_prmo_link_1%","%o_logo_destructor%",
			) ,
			array (
      	$o_mo_actual, $o_sunmoon_text, $o_actual_temp, $o_actual_windchill, $o_back_img[0],$o_feels_lang,$o_actual_brief,$o_code_destructor[0],
        $o_mo_today, $o_temp_hi[1], $o_temp_hi1[1], $o_temp_lo[1],$o_temp_lo1[1], $o_back_img[1],$o_day[1].":",$o_day_short[1],$o_code_destructor[1],
        $o_mo_fc[2], $o_temp_hi[2], $o_temp_lo[2], $o_back_img[2],$o_day[2],$o_day_short[2],$o_code_destructor[2],
        $o_mo_fc[3], $o_temp_hi[3], $o_temp_lo[3], $o_back_img[3],$o_day[3],$o_day_short[3],$o_code_destructor[3],
        $o_mo_fc[4], $o_temp_hi[4], $o_temp_lo[4], $o_back_img[4],$o_day[4],$o_day_short[4],$o_code_destructor[4],
        $o_mo_fc[5], $o_temp_hi[5], $o_temp_lo[5], $o_back_img[5],$o_day[5],$o_day_short[5],$o_code_destructor[5],
        $o_mo_fc[6], $o_temp_hi[6], $o_temp_lo[6], $o_back_img[6],$o_day[6],$o_day_short[6],$o_code_destructor[6],
        $o_mo_fc[7], $o_temp_hi[7], $o_temp_lo[7], $o_back_img[7],$o_day[7],$o_day_short[7],$o_code_destructor[7],
        $o_mo_fc[8], $o_temp_hi[8], $o_temp_lo[8], $o_back_img[8],$o_day[8],$o_day_short[8],$o_code_destructor[8],
        $o_mo_fc[9], $o_temp_hi[9], $o_temp_lo[9], $o_back_img[9],$o_day[9],$o_day_short[9],$o_code_destructor[9],                         
        $extended_forecast, $icon_layout_middle_check,$auto_loc,$info_text,$sc_title,' / ',
        $o_prmo[0],$o_prmo[1],$o_prmo_link[0],$o_prmo_link[1],$o_logo_destructor                
			) ,
			$format
		);
    }
    else
    {
     $content = str_replace(
			array (
        "%o_mo_actual%", "%sunmoon_text%", "%o_actual_temp%", "%o_actual_windchill%", "%actual_icon_href%", "%o_feels_lang%", "%o_actual_brief%","%o_code_destructor_0%", 
				"%o_mo_today%", "%o_temp_hi_1%", "%o_temp_lo_1%", "%today_icon_href%","%o_day_1%","%o_day_short_1%", "%o_code_destructor_1%", 
        "%o_mo_fc_2%", "%o_temp_hi_2%", "%o_temp_lo_2%", "%fc_2_icon_href%","%o_day_2%","%o_day_short_2%","%o_code_destructor_2%", 
        "%o_mo_fc_3%", "%o_temp_hi_3%", "%o_temp_lo_3%", "%fc_3_icon_href%","%o_day_3%","%o_day_short_3%","%o_code_destructor_3%",    
        "%o_mo_fc_4%", "%o_temp_hi_4%", "%o_temp_lo_4%", "%fc_4_icon_href%","%o_day_4%","%o_day_short_4%","%o_code_destructor_4%",    
        "%o_mo_fc_5%", "%o_temp_hi_5%", "%o_temp_lo_5%", "%fc_5_icon_href%","%o_day_5%","%o_day_short_5%","%o_code_destructor_5%",    
        "%o_mo_fc_6%", "%o_temp_hi_6%", "%o_temp_lo_6%", "%fc_6_icon_href%","%o_day_6%","%o_day_short_6%","%o_code_destructor_6%",    
        "%o_mo_fc_7%", "%o_temp_hi_7%", "%o_temp_lo_7%", "%fc_7_icon_href%","%o_day_7%","%o_day_short_7%","%o_code_destructor_7%",    
        "%o_mo_fc_8%", "%o_temp_hi_8%", "%o_temp_lo_8%", "%fc_8_icon_href%","%o_day_8%","%o_day_short_8%","%o_code_destructor_8%",    
        "%o_mo_fc_9%", "%o_temp_hi_9%", "%o_temp_lo_9%", "%fc_9_icon_href%","%o_day_9%","%o_day_short_9%","%o_code_destructor_9%",                    
        "%extendend_forecast%", "%icon_layout_middle_check%","%auto_loc%","%info_text%","%sc_title%","%o_degree_seperator%",
        "%o_prmo_0%","%o_prmo_1%","%o_prmo_link_0%","%o_prmo_link_1%","%o_logo_destructor%",
			) ,
			array (
      	"", "", "", "", $o_back_img[0],"",GG_funx_translate_array("Sorry! No actual weather data available!",$opt_language), "DESTRUCT",
        $o_mo_today, $o_temp_hi[1], $o_temp_lo[1], $o_back_img[1],"",$o_day_short[1],"DESTRUCT",
        $o_mo_fc[2], $o_temp_hi[2], $o_temp_lo[2], $o_back_img[2],"",$o_day_short[2],"DESTRUCT",
        $o_mo_fc[3], $o_temp_hi[3], $o_temp_lo[3], $o_back_img[3],$o_day[3],$o_day_short[3],"DESTRUCT",
        $o_mo_fc[4], $o_temp_hi[4], $o_temp_lo[4], $o_back_img[4],$o_day[4],$o_day_short[4],"DESTRUCT",
        $o_mo_fc[5], $o_temp_hi[5], $o_temp_lo[5], $o_back_img[5],$o_day[5],$o_day_short[5],"DESTRUCT",
        $o_mo_fc[6], $o_temp_hi[6], $o_temp_lo[6], $o_back_img[6],$o_day[6],$o_day_short[6],"DESTRUCT",
        $o_mo_fc[7], $o_temp_hi[7], $o_temp_lo[7], $o_back_img[7],$o_day[7],$o_day_short[7],"DESTRUCT",
        $o_mo_fc[8], $o_temp_hi[8], $o_temp_lo[8], $o_back_img[8],$o_day[8],$o_day_short[8],"DESTRUCT",
        $o_mo_fc[9], $o_temp_hi[9], $o_temp_lo[9], $o_back_img[9],$o_day[9],$o_day_short[9],"DESTRUCT",                         
        $extended_forecast, $icon_layout_middle_check,$auto_loc,$info_text,$sc_title,'',
        $o_prmo[0],$o_prmo[1],$o_prmo_link[0],$o_prmo_link[1],$o_logo_destructor                
			) ,
			$format);
    }
    $widget_options['wc_cache'] = $content;
		$widget_options['wc_lastcheck'] = time();
		if($args['flag']){
      return $content;
		}
		else
		{
      update_option('GG_func_widget_weather_and_weather_forecast',$widget_options);		
      echo $before_widget;
  		echo $widgettitle; 	
  		echo $content;
  		echo $after_widget;
		}

    //print_r($gg_weather);
    //  $help_b= str_replace("<","[",$content);
    //  $help_b= str_replace(">","]",$help_b);
    //  echo $help_b;
	}
}
//**************************end widget*******************************************
//**************************functions********************************************

function GG_func_cutout($data, $start, $end) {
    $from = strpos($data, $start) + strlen($start);
    if($from === false) {return false;}
    $to = @strpos($data, $end, $from); 
    if($to === false) {return false;} 
    return substr($data, $from, $to-$from);
  }

function GG_func_widget_format($term_in,$term_out,$f_size_s,$f_size_m,$f_size_l,$i_size_s,$i_size_m,$i_size_l,$background_color,$font_family, $font_color, $images,$wun_licence_code,$term,$opt_hide_feels_like){
    $check=$term_in;
    if ($check=="auto_location"){
      $term_out ="<!-- Table0 AL--><table width='100%' cellpadding='0' cellspacing ='0'><tr><td>&nbsp;</td></tr><tr><td><span style='font-family:".$font_family.";font-size:".$f_size_l.";color:".$font_color."'>%auto_loc%</span></td></tr></table>";
    }   
    if ($check=="small"){
      $term_out ="<!-- Table1 SM--><table  width='100%' cellpadding='0' cellspacing ='0'><tr><td><img src='%actual_icon_href%' alt='' style='float:right;' title='%o_mo_actual% %sunmoon_text%' %o_code_destructor_0%width='".round($i_size_l*93,0)."'><br /><p style='text-align:center'><span style='font-family:".$font_family."; font-size:".$f_size_l.";color:".$font_color."'>%o_actual_temp%</span><br />";
      if($opt_hide_feels_like!="checked"){
        $term_out=$term_out."<span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_feels_lang%  %o_actual_windchill%</span><br />";
      }
      $term_out=$term_out."<span style='font-family:".$font_family.";font-size:".$f_size_l.";color:".$font_color."'>%o_actual_brief%</span></p></td></tr></table>";
    }    
    if($check=="medium"){
      $term_out ="<!-- Table2 ME--><table width='100%' cellpadding='0' cellspacing ='0'><tr><td><span style='font-family:".$font_family.";font-size:".$f_size_m.";color:".$font_color."'>%o_day_1% <br />%o_temp_hi_1%%o_degree_seperator%%o_temp_lo_1% </span></td><td><img src='%today_icon_href%' alt='' title='%o_mo_today%' %o_code_destructor_1%width='".round($i_size_m*61,0)."'></td></tr></table>";
    }    
    if($check=="large"){
      if($term=="checked"){$term_out ="<!-- Table 3 LA C--><table  width='100%' cellpadding='0' cellspacing ='0'><tr><td><span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_2% </span></td><td><span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_3% </span></td><td><span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_4% </span></td></tr><tr><td></td><td></td><td></td></tr><tr><td><img src='%fc_2_icon_href%' alt='' %o_code_destructor_2%width='".round($i_size_s*31,0)."' title='%o_mo_fc_2%'></td><td><img src='%fc_3_icon_href%' alt='' %o_code_destructor_3%width='".round($i_size_s*31,0)."' title='%o_mo_fc_3%'></td><td> <img src='%fc_4_icon_href%' alt='' %o_code_destructor_4%width='".round($i_size_s*31,0)."' title='%o_mo_fc_4%'></td></tr><tr><td><span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_temp_hi_2%%o_degree_seperator%%o_temp_lo_2% </span> </td><td><span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_temp_hi_3%%o_degree_seperator%%o_temp_lo_3%  </span></td><td><span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_temp_hi_4%%o_degree_seperator%%o_temp_lo_4% </span></td></tr></table>"; }
      else{$term_out ="<!-- Table 3 LA--><table  width='100%' cellpadding='0' cellspacing ='0'><tr><td><span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_2% </span></td><td><span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_3% </span></td><td><span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_4% </span></td></tr><tr><td></td><td></td><td></td></tr><tr><td><img src='%fc_2_icon_href%' alt='' %o_code_destructor_2%width='".round($i_size_s*31,0)."' title='%o_mo_fc_2%'></td><td><img src='%fc_3_icon_href%' alt='' %o_code_destructor_3%width='".round($i_size_s*31,0)."' title='%o_mo_fc_3%'></td><td> <img src='%fc_4_icon_href%' alt='' %o_code_destructor_4%width='".round($i_size_s*31,0)."' title='%o_mo_fc_4%'></td></tr><tr><td><span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_temp_hi_2%%o_degree_seperator%%o_temp_lo_2% </span> </td><td><span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_temp_hi_3%%o_degree_seperator%%o_temp_lo_3%  </span></td><td><span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_temp_hi_4%%o_degree_seperator%%o_temp_lo_4% </span></td></tr>";       }
    }
    if($check=="pure"){
    $term_out ="<!-- Table 3 PU--><table  width='100%' cellpadding='0' cellspacing ='0'><tr><td><span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_short_1% </span></td><td><span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_short_2% </span></td><td><span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_short_3% </span></td><td><span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_short_4% </span></td></tr><tr><td></td><td></td><td></td><td></td></tr><tr><td><img src='%today_icon_href%' alt='' %o_code_destructor_2%width='".round($i_size_s*31,0)."' title='%o_mo_today%'></td><td><img src='%fc_2_icon_href%' alt='' %o_code_destructor_2%width='".round($i_size_s*31,0)."' title='%o_mo_fc_2%'></td><td><img src='%fc_3_icon_href%' alt='' %o_code_destructor_3%width='".round($i_size_s*31,0)."' title='%o_mo_fc_3%'></td><td> <img src='%fc_4_icon_href%' alt='' %o_code_destructor_4%width='".round($i_size_s*31,0)."' title='%o_mo_fc_4%'></td></tr><tr><td><span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_temp_hi_11%%o_degree_seperator%%o_temp_lo_11% </span></td><td><span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_temp_hi_2%%o_degree_seperator%%o_temp_lo_2% </span> </td><td><span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_temp_hi_3%%o_degree_seperator%%o_temp_lo_3%  </span></td><td><span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_temp_hi_4%%o_degree_seperator%%o_temp_lo_4% </span></td></tr></table>";   
      
      }    
    if($check=="extended"){
      $term_out ="<!-- Table 4 EX--><table width='100%' cellpadding='0' cellspacing ='0'>";
      if($term=="large"){$term_out =$term_out."<tr><td colspan=5 style='font-family:".$font_family.";font-size:0'>&nbsp;</td></tr>";}
      if($term!="large" and $term!="pure"){$term_out =$term_out."<tr><td colspan=8 style='font-family:".$font_family.";font-size:0'>&nbsp;</td></tr><tr><td style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_short_2%</td><td style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_short_3%</td><td style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_short_4%</td>";}
      $term_out =$term_out."<td style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_short_5%</td><td style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_short_6%</td><td style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_short_7%</td><td style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_short_8%</td><td style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_short_9%</td></tr><tr>"; 
      if($term!="large" and $term!="pure"){$term_out =$term_out."<td><img src='%fc_2_icon_href%'  alt='' width='".round($i_size_s*31*0.8,0)."' title='%o_mo_fc_2%'></td><td><img src='%fc_3_icon_href%'  alt='' width='".round($i_size_s*31*0.8,0)."' title='%o_mo_fc_3%'></td><td><img src='%fc_4_icon_href%' alt=''  %o_code_destructor_4%width='".round($i_size_s*31*0.8,0)."' title='%o_mo_fc_4%'></td>";}
      $term_out =$term_out."<td><img src='%fc_5_icon_href%' alt=''  %o_code_destructor_5%width='".round($i_size_s*31*0.8,0)."' title='%o_mo_fc_5%'></td><td><img src='%fc_6_icon_href%' alt=''  %o_code_destructor_6%width='".round($i_size_s*31*0.8,0)."' title='%o_mo_fc_6%'></td><td><img src='%fc_7_icon_href%' alt='' %o_code_destructor_7%width='".round($i_size_s*31*0.8,0)."' title='%o_mo_fc_7%'></td><td><img src='%fc_8_icon_href%' alt='' %o_code_destructor_8%width='".round($i_size_s*31*0.8,0)."' title='%o_mo_fc_8%'></td><td><img src='%fc_9_icon_href%' alt=''  %o_code_destructor_9%width='".round($i_size_s*31*0.8,0)."' title='%o_mo_fc_9%'></td></tr><tr>";
      if($term!="large" and $term!="pure"){$term_out =$term_out."<td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_hi_2%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_hi_3%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_hi_4%</td>";}
      $term_out =$term_out."<td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_hi_5%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_hi_6%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_hi_7%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_hi_8%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_hi_9%</td></tr><tr>"; 
      if($term!="large" and $term!="pure"){$term_out =$term_out."<td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_lo_2%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_lo_3%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_lo_4%</td>";}
      $term_out =$term_out."<td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_lo_5%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_lo_6%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_lo_7%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_lo_8%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_lo_9%</td></tr>";     
    }
    
    if($check=="extended_pure"){
      $term_out ="<!-- Table 4 EX PU--><table width='100%' cellpadding='0' cellspacing ='0'>";
      $term_out =$term_out."<tr><td colspan=9 style='font-family:".$font_family.";font-size:0'>&nbsp;</td></tr><tr><td style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_short_1%</td><td style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_short_2%</td><td style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_short_3%</td><td style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_short_4%</td>";
      $term_out =$term_out."<td style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_short_5%</td><td style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_short_6%</td><td style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_short_7%</td><td style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_short_8%</td><td style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>%o_day_short_9%</td></tr><tr>"; 
      $term_out =$term_out."<td><img src='%today_icon_href%'  alt='' width='".round($i_size_s*31*0.8,0)."' title='%o_mo_today%'></td><td><img src='%fc_2_icon_href%'  alt='' width='".round($i_size_s*31*0.8,0)."' title='%o_mo_fc_2%'></td><td><img src='%fc_3_icon_href%'  alt='' width='".round($i_size_s*31*0.8,0)."' title='%o_mo_fc_3%'></td><td><img src='%fc_4_icon_href%' alt=''  %o_code_destructor_4%width='".round($i_size_s*31*0.8,0)."' title='%o_mo_fc_4%'></td>";
      $term_out =$term_out."<td><img src='%fc_5_icon_href%' alt=''  %o_code_destructor_5%width='".round($i_size_s*31*0.8,0)."' title='%o_mo_fc_5%'></td><td><img src='%fc_6_icon_href%' alt=''  %o_code_destructor_6%width='".round($i_size_s*31*0.8,0)."' title='%o_mo_fc_6%'></td><td><img src='%fc_7_icon_href%' alt='' %o_code_destructor_7%width='".round($i_size_s*31*0.8,0)."' title='%o_mo_fc_7%'></td><td><img src='%fc_8_icon_href%' alt='' %o_code_destructor_8%width='".round($i_size_s*31*0.8,0)."' title='%o_mo_fc_8%'></td><td><img src='%fc_9_icon_href%' alt=''  %o_code_destructor_9%width='".round($i_size_s*31*0.8,0)."' title='%o_mo_fc_9%'></td></tr><tr>";
      $term_out =$term_out."<td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_hi_11%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_hi_2%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_hi_3%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_hi_4%</td>";
      $term_out =$term_out."<td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_hi_5%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_hi_6%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_hi_7%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_hi_8%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_hi_9%</td></tr><tr>"; 
      $term_out =$term_out."<td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_lo_11%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_lo_2%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_lo_3%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_lo_4%</td>";
      $term_out =$term_out."<td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_lo_5%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_lo_6%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_lo_7%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_lo_8%</td><td style='font-family:".$font_family.";font-size:".round($f_size_s*0.9,0)."%;color:".$font_color."'>%o_temp_lo_9%</td></tr>";     
   
       }
    
    if($check=="large" or $check=="extended" or $check=="extended_pure"){
      $term_out =$term_out."</table>";
    }      
    if($check=="link"){      
      $term_out ="<!-- Table 5 LI--><table width='100%' cellpadding='0' cellspacing ='0'><tr><td><br /><a href='%o_prmo_link_1%' target='_blank'><img src='%o_prmo_1%' alt=''  title='%o_prmo_link_1%'  %o_logo_destructor%height='25' ></a></td><td><br /><span style='font-family:".$font_family.";font-size:".$f_size_s.";color:".$font_color."'>Data powered by</span></td><td><br /><a href='%o_prmo_link_0%' target='_blank'><img src='%o_prmo_0%' alt=''  title='%o_prmo_link_0%'  height='25'></a>&nbsp;</td></tr></table>";
    }    
    if($check=="lines"){
      $term_out ="<hr>"; 
    } 
    if(substr($check,0,2)=='sc')
    { $i_size_l=round($i_size_s*70,0);
      $i_size_m=round($i_size_s*50,0);
      $i_size_s=round($i_size_s*31,0);
      }
      
    if ($check=="sc_small"){     
      if($term=="Yes" or $term=="yes"){
      $term_out ="<div id='gogadget_weather_widget_sc' ><!-- Table1 --><table style = 'float:".$term_out."'><tr><td colspan = 3><span style=font-size:110%>%sc_title%</span></td></tr><tr><td colspan=2><img src='%actual_icon_href%' alt=''  title='%o_mo_actual% %sunmoon_text%' width='".$i_size_l."'></td><td><span style=font-size:100%>%o_actual_temp%</span><br /><span style=font-size:100%>%o_actual_brief%</span></td></tr></table></div>";
      }                                                                                                                                                                                                                                                                                                                              
      else{
      $term_out ="<div id='gogadget_weather_widget_sc' ><!-- Table1 --><table style = 'float:".$term_out."'><tr><td colspan = 3><span style=font-size:110%>%sc_title%</span></td></tr><tr><td><span style=font-size:100%>%o_actual_temp%</span><br /><span style=font-size:100%>%o_actual_brief%</span></td><td colspan=2><img src='%actual_icon_href%' alt=''  title='%o_mo_actual% %sunmoon_text%' width='".$i_size_l."'></td></tr></table></div>";
      }
    }    
    if ($check=="sc_header"){     
      if($term=="Yes" or $term=="yes"){
      $term_out ="<div id='gogadget_weather_widget_sc_header' ><!-- Table1 --><table style = 'float:".$term_out."'><tr><td colspan=3><img src='%actual_icon_href%' alt=''  title='%o_mo_actual% %sunmoon_text%' width='".$i_size_l."'></td><td><span style=font-size:110%>%sc_title%</span><br /><span style=font-size:100%>%o_actual_temp%</span><br /><span style=font-size:100%>%o_actual_brief%</span></td></tr></table></div>";
      }
      else{
      $term_out ="<div id='gogadget_weather_widget_sc_header' ><!-- Table1 --><table style = 'float:".$term_out."'><tr><td><span style=font-size:110%>%sc_title%</span><br /><span style=font-size:100%>%o_actual_temp%</span><br /><span style=font-size:100%>%o_actual_brief%</span></td><td colspan=2><img src='%actual_icon_href%' alt=''  title='%o_mo_actual% %sunmoon_text%' width='".$i_size_l."'></td></tr></table></div>";
      }
    }    
    if ($check=="sc_today"){
      if($term=="Yes" or $term=="yes"){
      $term_out ="<div id='gogadget_weather_widget_sc' ><!-- Table1 --><table style = 'float:".$term_out."'><tr><td colspan = 3><span style=font-size:110%>%sc_title%</span></td></tr>";
      $term_out=$term_out."<tr><td colspan=2><img src='%today_icon_href%' alt=''  title='%o_mo_today%' width='".$i_size_l."'></td><td>%o_day_1% <br />%o_temp_hi_1%%o_degree_seperator%%o_temp_lo_1%</td></tr></table></div>";        
      }
      else{
        $term_out ="<div id='gogadget_weather_widget_sc' ><!-- Table1 --><table style = 'float:".$term_out."'><tr><td colspan = 3><span style=font-size:110%>%sc_title%</span></td></tr>";
      $term_out=$term_out."<tr><td>%o_day_1% <br />%o_temp_hi_1%%o_degree_seperator%%o_temp_lo_1%</td><td colspan=2><img src='%today_icon_href%' alt=''  title='%o_mo_today%' width='".$i_size_l."'></td></tr></table></div>";     
       }
    }    
    if ($check=="sc_middle"){
      if($term=="Yes" or $term=="yes"){
      $term_out ="<div id='gogadget_weather_widget_sc' ><!-- Table1 --><table style = 'float:".$term_out."'><tr><td colspan = 3><span style=font-size:110%>%sc_title%</span></td></tr><tr><td colspan=2><img src='%actual_icon_href%' alt=''  title='%o_mo_actual% %sunmoon_text%,' width='".$i_size_l."'></td><td><span style=font-size:100%>%o_actual_temp%</span><br /><span style=font-size:80%> %o_feels_lang%  %o_actual_windchill%</span><br /><span style=font-size:100%>%o_actual_brief%</span></td></tr>";
      $term_out=$term_out."<tr><td colspan=2><img src='%today_icon_href%'  alt=''  title='%o_mo_today%' width='".$i_size_m."'></td><td>%o_day_1% <br />%o_temp_hi_1%%o_degree_seperator%%o_temp_lo_1%</td></tr></table></div>";
      }
      else{
      $term_out ="<div id='gogadget_weather_widget_sc' ><!-- Table1 --><table style = 'float:".$term_out."'><tr><td colspan = 3><span style=font-size:110%>%sc_title%</span></td></tr><tr><td><span style=font-size:100%>%o_actual_temp%</span><br /><span style=font-size:80%> %o_feels_lang%  %o_actual_windchill%</span><br /><span style=font-size:100%>%o_actual_brief%</span></td><td colspan=2><img src='%actual_icon_href%' alt=''  title='%o_mo_actual% %sunmoon_text%' width='".$i_size_l."'></td></tr>";
      $term_out=$term_out."<tr><td>%o_day_1% <br />%o_temp_hi_1%%o_degree_seperator%%o_temp_lo_1%</td><td colspan=2><img src='%today_icon_href%' alt=''  title='%o_mo_today%' width='".$i_size_m."'></td></tr></table></div>";
      }
    }      
    if ($check=="sc_large"){
      if($term=="Yes" or $term=="yes"){
      $term_out ="<div id='gogadget_weather_widget_sc' ><!-- Table1 --><table style = 'float:".$term_out."'><tr><td colspan = 3><span style=font-size:110%>%sc_title%</span></td></tr><tr><td colspan=2><img src='%actual_icon_href%' alt=''  title='%o_mo_actual% %sunmoon_text%' width='".$i_size_l."'></td><td><span style=font-size:100%>%o_actual_temp%</span><br /><span style=font-size:80%> %o_feels_lang%  %o_actual_windchill%</span><br /><span style=font-size:100%>%o_actual_brief%</span></td></tr>";
      $term_out=$term_out."<tr><td colspan=2><img src='today_icon_href%' alt=''  title='%o_mo_today%' width='".$i_size_m."'><td>%o_day_1% <br />%o_temp_hi_1%%o_degree_seperator%%o_temp_lo_1%</td></tr>";
      }
      else{
      $term_out ="<div id='gogadget_weather_widget_sc' ><!-- Table1 --><table style = 'float:".$term_out."'><tr><td colspan = 3><span style=font-size:110%>%sc_title%</span></td></tr><tr><td><span style=font-size:100%>%o_actual_temp%</span><br /><span style=font-size:80%> %o_feels_lang%  %o_actual_windchill%</span><br /><span style=font-size:100%>%o_actual_brief%</span></td><td colspan=2><img src='%actual_icon_href%' alt=''  title='%o_mo_actual% %sunmoon_text%' width='".$i_size_l."'></td></tr>";
      $term_out=$term_out."<tr><td>%o_day_1% <br />%o_temp_hi_1%%o_degree_seperator%%o_temp_lo_1%</td><td colspan=2><img src='%today_icon_href%' alt=''  title='%o_mo_today%' width='".$i_size_m."'></td></tr>";
      } 
      $term_out=$term_out."<tr><td><span style='font-size:80%'>%o_day_2%</span></td><td><span style='font-size:80%'>%o_day_3%</span></td><td><span style='font-size:80%'>%o_day_4%</span></td></tr><tr><td><img src='%fc_2_icon_href%' alt=''  width='".$i_size_s."' title='%o_mo_fc_2%'></td><td><img src='%fc_3_icon_href%' alt=''  width='".$i_size_s."' title='%o_mo_fc_3%'></td><td> <img src='%fc_4_icon_href%' alt=''  width='".$i_size_s."' title='%o_mo_fc_4%'></td></tr><tr><td><span style='font-size:80%'>%o_temp_hi_2%%o_degree_seperator%%o_temp_lo_2%</span> </td><td><span style='font-size:80%'>%o_temp_hi_3%%o_degree_seperator%%o_temp_lo_3% </span></td><td><span style='font-size:80%'>%o_temp_hi_4%%o_degree_seperator%%o_temp_lo_4%</span></td></table></div>";
    }        
    return $term_out; 
}

function GG_func_get_ip_data($ipinfodb_key,$timeout)    
    {
    for($i=0;$i<=3;$i++){
    $iplocA[$i]="";
    $iplocB[$i]="";
    $iploc[$i]="";
    }
    $ip_address = $_SERVER['REMOTE_ADDR'];
    //$ip_address ="92.36.148.202";
	  $uri = 'http://freegeoip.net/xml/'.$ip_address;	  
    $data = GG_func_get_content_IP($uri,$timeout);
    //echo $data;
	  if($data<>""){
  	  $pos = strpos($data, "<CountryCode>"); 
  		$iplocA[0] = substr($data, $pos+13, strpos($data,"</CountryCode>") - $pos-13);
  		$pos = strpos($data, "<CountryName>"); 
  		$iplocA[1] = substr($data, $pos+13, strpos($data,"</CountryName>") - $pos-13);
  		$pos = strpos($data, "<RegionName>"); 
  		$iplocA[2] = substr($data, $pos+12, strpos($data,"</RegionName>") - $pos-12);
  		$pos = strpos($data, "<City>"); 
  		$iplocA[3] = substr($data, $pos+6, strpos($data,"</City>") - $pos-6);	
    }
    for($j=0;$j<=3;$j++){if($iplocA[$j]=="-"){$iplocA[$j]="";}
    }
	  $uri = 'http://api.ipinfodb.com/v3/ip-city/?key='.$ipinfodb_key.'&format=xml&ip='.$ip_address;
	  $data = GG_func_get_content_IP($uri,$timeout); 
	  if($data<>"" and !substr_count($data,'Code>ERROR') ){
  	$pos = strpos($data, "<countryCode>"); 
  		$iplocB[0] = substr($data, $pos+13, strpos($data,"</countryCode>") - $pos-13);
  		$pos = strpos($data, "<countryName>"); 
  		$iplocB[1] = substr($data, $pos+13, strpos($data,"</countryName>") - $pos-13);
  		$pos = strpos($data, "<regionName>"); 
  		$iplocB[2] = substr($data, $pos+12, strpos($data,"</regionName>") - $pos-12);
  		$pos = strpos($data, "<cityName>"); 
  		$iplocB[3] = substr($data, $pos+10, strpos($data,"</cityName>") - $pos-10);  
    }                  	  
	  if($iplocB[0]<>""){
        for($j=0;$j<=3;$j++){$iploc[$j]=$iplocB[$j];}
        }
    else{
        for($j=0;$j<=3;$j++){$iploc[$j]=$iplocA[$j];}
        }	  
    $flag_search="Yes";
	  if($iploc[0]=="US"){
        if($iploc[3]=="" or $iploc[3]=="-"){
            $iploc[3]=GG_funx_translate_capital($iploc[0]);
            $iploc[2]=$iploc[1];}            
        $iploc[2]=GG_funx_translate_country(strtolower($iploc[2]));
        $search_city=$iploc[3];
        $search_state=$iploc[2];            
        } 
	  else 
      {      
        if($iploc[0]=="UK"){$iploc[0]="GB";}
        if($iploc[3]=="" or $iploc[3]=="-"){
           $iploc[3]=GG_funx_translate_capital($iploc[0]);}
           //$iploc[2]=$iploc[1];}
        $search_city=$iploc[3];
        $search_state=$iploc[1];    
        }
    if($iploc[0]=="RD" or $iploc[0]==""or $iploc[0]=="-"){
        $flag_search="No";}
    return array($flag_search,$search_state,$search_city,$iploc[0]);
    }

function GG_func_get_language($opt_language,$opt_language_select){
 $opt_language_index="";
 $opt_language_2="";
 if ($opt_language_select=="checked") {
      if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
        } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
      }
     $pos = strpos($pageURL, "lang=");
     if ($pos >0){
      $opt_language_2 = substr($pageURL, $pos+5, 2);
       }
      else
      {
        $lang = getenv('HTTP_ACCEPT_LANGUAGE');
        if ( $lang != '' ) {
           $lang = preg_replace('/(;q=[0-99]+.[0-99]+)/i','',$lang);
           $lang_array = explode(",", $lang);
           $opt_language_2 = strtolower($lang_array[0]);
        }
      }  
   }

  if($opt_language_2 == "de" || $opt_language_2 == "en" || $opt_language_2 == "fr" || $opt_language_2 == "es" || $opt_language_2 == "it" || $opt_language_2 == "pl" || $opt_language_2 == "hu" || $opt_language_2 == "pt" || $opt_language_2 == "ar" || $opt_language_2 == "da" || $opt_language_2 == "ga" || $opt_language_2 == "nl" || $opt_language_2 == "no" || $opt_language_2 == "ru"|| $opt_language_2 == "sr"|| $opt_language_2 == "zh"){$opt_language=$opt_language_2;}
  if ($opt_language=="de"){$opt_language_index=0;}
  if ($opt_language=="fr"){$opt_language_index=1;}
  if ($opt_language=="es"){$opt_language_index=2;}
  if ($opt_language=="it"){$opt_language_index=3;}
  if ($opt_language=="pl"){$opt_language_index=4;}
  if ($opt_language=="hu"){$opt_language_index=5;}
  if ($opt_language=="pt"){$opt_language_index=6;}
  if ($opt_language=="ar"){$opt_language_index=7;}
  if ($opt_language=="da"){$opt_language_index=8;}
  if ($opt_language=="ga"){$opt_language_index=9;}
  if ($opt_language=="nl"){$opt_language_index=10;}
  if ($opt_language=="no"){$opt_language_index=11;}
  if ($opt_language=="ru"){$opt_language_index=12;}
  if ($opt_language=="sr"){$opt_language_index=13;}
  if ($opt_language=="zh"){$opt_language_index=14;}
  
 return array($opt_language_index,$opt_language);
}

function GG_func_get_location_ids($term_in)
{
    $zeichen=array("Ã¤","Ã¶","Ã¼","ä","ü","ö","Ä","Ü","Ö","ß","ae","ue","oe"," ",);
    $zeichen_ersetzen=array("a","o","u","a","u","o","A","U","o","ss","a","u","o","_",);
    $string_in=  strtolower($term_in);
    $string_in = str_replace("&uuml;","u",$string_in);
    $string_in = str_replace($zeichen,$zeichen_ersetzen,$string_in);
    $uri= 'http://xoap.weather.com/search/search?where='.$string_in;
    $data="";
    if ($string_in!=""){$data = GG_func_get_content($uri,$timeout); }
    if($data<>"" and substr_count($data,'<loc id')){
    $data = str_replace('"',"",$data);  // Replace any of any " in the string! They might cause trouble ...
  	$pos_start = strpos($data, "<loc");
		$data = substr($data, $pos_start+4, strlen($data) - $pos_start-4);
		$pos_start =  strpos($data, "id=");
		$pos_end =    strpos($data, " type");
		$loc_id= substr($data,$pos_start+3,$pos_end-$pos_start-3);
		$pos_start =  strpos($data, ">");
		$pos_end =    strpos($data, "</loc");
		$loc_lang= substr($data,$pos_start+1,$pos_end-$pos_start-1);
		$pos_start =  strpos($loc_lang, ",");
		$loc_city= trim(substr($loc_lang,0,$pos_start));
		$loc_state= trim(substr($loc_lang,$pos_start+1,strlen($loc_lang)-$pos_start));
    }	
    return array($loc_id,$loc_city,$loc_state);
}

function GG_func_get_content_IP($term_in,$timeout)
{
    if( ini_get('allow_url_fopen') ) 
      {
      $opts = array('http' => array('timeout' => $timeout));
      $context  = stream_context_create($opts);
      $term_out = @file_get_contents($term_in,false,$context);
    }
    else {
      $ch = curl_init();
      curl_setopt ($ch, CURLOPT_URL, $term_in);
      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt ($ch, CURLOPT_TIMEOUT, $timeout);
      $term_out = @curl_exec($ch);
      curl_close($ch);  
    }
    return $term_out;
}

function GG_func_get_content($term_in,$timeout)
{
    if($timeout==0 or !$timeout){$timeout=2;}
    if( ini_get('allow_url_fopen') ) 
      {
       $opts = array('http' => array('timeout' => $timeout));
      $context  = stream_context_create($opts);
      $term_out = @file_get_contents($term_in,false,$context);
    }
    else {
      $ch = curl_init();
      curl_setopt ($ch, CURLOPT_URL, $term_in);
      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt ($ch, CURLOPT_TIMEOUT, $timeout);
      $term_out = @curl_exec($ch);
      curl_close($ch);    
    }                                                                     
    return $term_out;
}

function GG_func_getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";
    if(function_exists('strripos') == true){
      if (preg_match('/linux/i', $u_agent)) {
          $platform = 'linux';
      }
      elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
          $platform = 'mac';
      }
      elseif (preg_match('/windows|win32/i', $u_agent)) {
          $platform = 'windows';
      }
      if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
      {
          $bname = 'Internet Explorer';
          $ub = "MSIE";
      }
      elseif(preg_match('/Firefox/i',$u_agent))
      {
          $bname = 'Mozilla Firefox';
          $ub = "Firefox";
      }
      elseif(preg_match('/Chrome/i',$u_agent))
      {
          $bname = 'Google Chrome';
          $ub = "Chrome";
      }
      elseif(preg_match('/Safari/i',$u_agent))
      {
          $bname = 'Apple Safari';
          $ub = "Safari";
      }
      elseif(preg_match('/Opera/i',$u_agent))
      {
          $bname = 'Opera';
          $ub = "Opera";
      }
      elseif(preg_match('/Netscape/i',$u_agent))
      {
          $bname = 'Netscape';
          $ub = "Netscape";
      }
      $known = array('Version', $ub, 'other');
      $pattern = '#(?<browser>' . join('|', $known) .
      ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
      if (!preg_match_all($pattern, $u_agent, $matches)) {
      }
      $i = count($matches['browser']);
      if ($i != 1) {
          if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
              $version= $matches['version'][0];
          }
          else {
              $version= $matches['version'][1];
          }
      }
      else {
          $version= $matches['version'][0];
      }
      if ($version==null || $version=="") {$version="?";}
    
    }
    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'   => $pattern
    );
}

function GG_func_convertLatinToHtml($term_in) { 
    $term_out=$term_in;
    $term_out=str_replace(
    array('¡','¢','£','¤','¥','À','Á','Â','Ã','Ä','Å','Æ','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ð','Ñ','Ò','Ó','Ô','Õ','Ö','×','Ø','Ù','Ú','Û','Ü','Ý','Þ','ß','à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ð','ñ','ò','ó','ô','õ','ö','÷','ø','ù','ú','û','ü','ý','þ','ÿ'),	
    array('&iexcl;','&cent;','&pound;','&curren;','&yen;','&Agrave;','&Aacute;','&Acirc;','&Atilde;','&Auml;','&Aring;','&AElig;','&Ccedil;','&Egrave;','&Eacute;','&Ecirc;','&Euml;','&Igrave;','&Iacute;','&Icirc;','&Iuml;','&ETH;','&Ntilde;','&Ograve;','&Oacute;','&Ocirc;','&Otilde;','&Ouml;','&times;','&Oslash;','&Ugrave;','&Uacute;','&Ucirc;','&Uuml;','&Yacute;','&THORN;','&szlig;','&agrave;','&aacute;','&acirc;','&atilde;','&auml;','&aring;','&aelig;','&ccedil;','&egrave;','&eacute;','&ecirc;','&euml;','&igrave;','&iacute;','&icirc;','&iuml;','&eth;','&ntilde;','&ograve;','&oacute;','&ocirc;','&otilde;','&ouml;','&divide;','&oslash;','&ugrave;','&uacute;','&ucirc;','&uuml;','&yacute;','&thorn;','&yuml;'),	
    $term_in);
    return $term_out;
   

} 

//**************************end functions****************************************
?>