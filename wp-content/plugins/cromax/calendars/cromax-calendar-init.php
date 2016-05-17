<?php
/**
* Plugin Name: Cromax
* Plugin URI: http://cro.ma
* Description: Cromax calendar extention pack for Croma Themes
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



/**
 * link to the includes files
 *
 * @access public
 * @return void
 */


include('cromax-calendar-metaboxes.php');
include('cromax-calendar-ajax.php');








/**
 * draw the calendar for use by the admin
 *
 * @access public
 * @return void
 */
function cromax_admin_calendar($day , $month, $year, $default) {


	
$op 			= 	$thisday 	= '';
$tday 			= 0;
$date 			= time() ;



// IF THERE'S NO DAY OR MONTH SET, USE TODAY AS SETTINGS
if (!$month || !$year) {
	$day 		= date('d', $date) ;
	$month 		= date('m', $date) ;
	$year 		= date('Y', $date) ;
}


// GET THE FIRST DAY OF THE MONTH, AND THE LAST DAY OF THE MONTH AND THE CALENDAR MONT HFOR THE TITLE
$first_day 		= mktime(0,0,0,$month, 1, $year);
$fifteenth 		= mktime(0,0,0,$month, 15, $year);
$title 			= date_i18n( 'F' , $first_day , false );




// GET A DEFAULT SETTING FOR THE TIMEPICKER IF NO SELECTION WAS MADE
if ($default) {
	$mday 		= date('d', $default);
	$mmonth 	= date('m', $default);
	$myear 		= date('Y', $default);
	if ($mmonth == $month && $myear == $year) {
		$tday 	= $mday;
	}

} elseif (date('m', $date) == $month && date('Y', $date) == $year) {
	$tday 		= $day;
}




 // get a day number for the first day of the month
$startday = get_option('start_of_week');
$day_of_week = date('D', $first_day) ; 
 switch($day_of_week){ 
 	case "Sun": $blank = 0 - $startday; break; 
 	case "Mon": $blank = 1 - $startday; break; 
 	case "Tue": $blank = 2 - $startday; break; 
 	case "Wed": $blank = 3 - $startday; break; 
 	case "Thu": $blank = 4 - $startday; break; 
 	case "Fri": $blank = 5 - $startday; break; 
 	case "Sat": $blank = 6 - $startday; break; 
 }



 if ($blank < 0) {
 	$blank = 7 + $blank;
 }



 switch($startday){ 
 	case 0: $daytripper = 'sunday'		; break; 
 	case 1: $daytripper = 'monday'		; break; 
 	case 2: $daytripper = 'tuesday'		; break; 
 	case 3: $daytripper = 'wednesday'	; break; 
 	case 4: $daytripper = 'thursday'	; break; 
 	case 5: $daytripper = 'friday'		; break; 
 	case 6: $daytripper = 'saturday'	; break; 
 }




$mon 				= strtotime('December 2010 first ' . $daytripper);


 // how many days in month
 $days_in_month 	= $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year %400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);

 
 //build the bloody thing

 $op .=  '<table style="width: 100%;">';
 $op .= '<tr><td>&nbsp;</td></tr>';
 $op .=  '<tr class="calhead"><th><i class="prevm caldir icon-chevron-left" data-cro-caldir="' . ($fifteenth - 2592000)  . '" data-cro-clicker="cal_prevm"></th><th colspan=5><span>' .  $title . ' ' .  $year  . '</span></th><th><i class="nextm caldir icon-chevron-right" data-cro-caldir="' . ($fifteenth + 2592000)  . '" data-cro-clicker="cal_prevm"></th></tr>';
 $op .=  '<tr>
 			<td class="dayname"><span>' . date_i18n( 'D' , $mon , false )  . '</span></td>
 			<td class="dayname"><span>' . date_i18n( 'D' , ($mon + 86400) , false )  . '</span></td>
 			<td class="dayname"><span>' . date_i18n( 'D' , ($mon + 172800) , false )  . '</span></td>
 			<td class="dayname"><span>' . date_i18n( 'D' , ($mon + 259200) , false )  . '</span></td>
 			<td class="dayname"><span>' . date_i18n( 'D' , ($mon + 345600) , false )  . '</span></td>
 			<td class="dayname"><span>' . date_i18n( 'D' , ($mon + 432000) , false )  . '</span></td>
 			<td class="dayname"><span>' . date_i18n( 'D' , ($mon + 518400) , false )  . '</span></td>
 		</tr>';

 // counts the day of the week to 7
 $day_count = 1;
 $op .=  '<tr>';



 // draw blank days
 while ( $blank > 0 ) { 
 	$op .=  '<td></td>'; 
 	$blank = $blank-1; 
 	$day_count++;
 } 
 

 // set first day of the month
 $day_num = 1;


 //count up the days

 while ( $day_num <= $days_in_month ) 

 { 

	if ($day) {$thisday = ($tday == $day_num) ? 'thisday' : '' ;}




 $relnumber = mktime(0,0,0,$month, $day_num, $year);

 $op .=  '</td><td class="daynum"><span class="' .  $thisday  . ' daybox">';

 $op .=   '<span class="daynumber" rel="' . $relnumber  . '" data-cro-clicker="cal_dayselect">' . $day_num . '</span>';

 $op .=   '</span></td>'; 

 $day_num++; 

 $day_count++;



 //start each week on a new row
 if ($day_count > 7)

 {

 $op .=  '</tr><tr>';

 $day_count = 1;

 }

 } 
 
 // finnish with the blanks
 while ( $day_count >1 && $day_count <=7 ) 

 { 

 $op .=  '<td> </td>'; 

 $day_count++; 

 } 

 
 $op .=  '</tr></table>'; 

  return $op;
	
}





/**
 * draw the responsive calendar
 *
 * @access public
 * @return void
 */

function cromax_fetch_responsive_cal($month, $year) {
	
	$op = $thisday = '';
	$tday = 0;
	$date =time () ;

	// IF THERE'S NO DAY OR MONTH SET, USE TODAY AS SETTINGS
	if (!$month || !$year) {
		$day = date('d', $date) ;
		$month = date('m', $date) ;
		$year = date('Y', $date) ;
	}

	$first_day = mktime(0,0,0,$month, 1, $year);
	$fifteenth = mktime(0,0,0,$month, 15, $year);
	$title = date_i18n( 'F' , $first_day , false );


	// GET A DEFAULT SETTING FOR THE TIMEPICKER
	if (date('m', $date) == $month && date('Y', $date) == $year) {
		$tday = $day;
	}


 	// get a day number for the first day of the month
	$startday = get_option('start_of_week');
	$day_of_week = date('D', $first_day); 
 	switch($day_of_week){ 
 		case "Sun": $blank = 0 - $startday; break; 
 		case "Mon": $blank = 1 - $startday; break; 
 		case "Tue": $blank = 2 - $startday; break; 
 		case "Wed": $blank = 3 - $startday; break; 
 		case "Thu": $blank = 4 - $startday; break; 
 		case "Fri": $blank = 5 - $startday; break; 
 		case "Sat": $blank = 6 - $startday; break; 
 	}

 	if ($blank < 0) {
 		$blank = 7 + $blank;
 	}

 	switch($startday){ 
 		case 0: $daytripper = 'sunday'		; break; 
 		case 1: $daytripper = 'monday'		; break; 
 		case 2: $daytripper = 'tuesday'		; break; 
 		case 3: $daytripper = 'wednesday'	; break; 
 		case 4: $daytripper = 'thursday'	; break; 
 		case 5: $daytripper = 'friday'		; break; 
 		case 6: $daytripper = 'saturday'	; break; 
 	}	


	$mon = strtotime('December 2010 first ' . $daytripper);


 	// how many days in month
	$days_in_month = $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year %400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
 

	$prt = cromax_get_the_calendar($month,$year);

 
 	//build the bloody thing
	$op .= '<ul class="calhead">';
	$op .= '<li class="prevm caldir" data-cro-caldir="' . ($fifteenth - 2592000)  . '"><i class="icon-chevron-left"></i></li>';
	$op .= '<li class="caltitle cro_cust_font">' .  $title . ' ' .  $year  . '</li>';
	$op .= '<li class="prevm caldir pnext" data-cro-caldir="' . ($fifteenth + 2592000)  . '"><i class="icon-chevron-right"></i></li>';
	$op .= '</ul>';


	$op .= '<ul class="calday">
				<li class="dayname cro_cust_font">' . date_i18n( 'D' , $mon , false )  . '</li>
 				<li class="dayname cro_cust_font">' . date_i18n( 'D' , ($mon + 86400) , false )  . '</li>
 				<li class="dayname cro_cust_font">' . date_i18n( 'D' , ($mon + 172800) , false )  . '</li>
 				<li class="dayname cro_cust_font">' . date_i18n( 'D' , ($mon + 259200) , false )  . '</li>
 				<li class="dayname cro_cust_font">' . date_i18n( 'D' , ($mon + 345600) , false )  . '</li>
 				<li class="dayname cro_cust_font">' . date_i18n( 'D' , ($mon + 432000) , false )  . '</li>
 				<li class="dayname cro_cust_font">' . date_i18n( 'D' , ($mon + 518400) , false )  . '</li>
			</ul>';


 	$op .= '<ul class="maincal">';

 	$day_count = 1;
 	while ( $blank > 0 )  {
 		$op .=  '<li class="empty">&nbsp;</li>'; 
 		$blank = $blank-1; 
 		$day_count++;
 	}


 	// set first day of the month
 	$day_num = 1;


 	while ( $day_num <= $days_in_month ) {

 		if ($day) {
			$thisday = ($tday == $day_num) ? 'thisday' : '' ;
		}

		$stringer = '';

		foreach ($prt as $cro_v) {
			$adate = date('j',$cro_v['strdate']);
 			if ($adate == $day_num) {
 				$stringer .= '<span class="numbday">' . $day_num . '</span>';
 				$stringer .= '<span class="numbtime">' . date(get_option('time_format'),$cro_v['strdate']) . '</span><span class="clearfix" style="display: block;"></span>';
 				$stringer .= '<span class="numbdesc"><a href="' . get_permalink($cro_v['cids'])  . '">' . get_the_title($cro_v['cids']) . '</a></span>';
 			}
 		}

 		$relnumber = mktime(0,0,0,$month, $day_num, $year);

 		$op .=  '<li class="daynum"><span class="' .  $thisday  . ' daybox">';

 		if ($stringer == '') {
 			$op .=   '<span class="daynumber">' . $day_num . '</span>';
 		} else {
 			$op .=   '<span class="stringer">';
 			$op .= $stringer;
 			$op .=  '</span>';
 		}

 		$op .=   '</span></li>'; 

 		$day_num++; 
 		$day_count++;
 		if ($day_count > 7) {$day_count = 1;}
 	}	

 	while ( $day_count >1 && $day_count <=7 ) {
 		$op .=  '<li class="empty">&nbsp;</li>'; 
 		$day_count++;
 	}

 	$op .= '</ul>';
 
	return $op;
	
}





/**
 * sort function for the calendar entries
 *
 * @access public
 * @return void
 */
function cromax_cal_val_sort($a,$subkey) {
	foreach($a as $k=>$v) {$b[$k] = strtolower($v[$subkey]);}
	asort($b);
	foreach($b as $key=>$val) {$c[] = $a[$key];}
	return $c;
}







/**
 * start fetching the calendar
 *
 * @access public
 * @return void
 */
function cromax_get_the_calendar($cmonth,$cyear) {
	$calentries = cromaxcal_get_the_events($cmonth,$cyear);
	if($calentries) {		
		$calentries = cromax_cal_val_sort($calentries,'strdate'); 
	}
	return $calentries;
}







function recinthappening ($intervalvalue, $dayvalue, $month, $year, $time, $daysinmonth){	

	$first_day_tocalculate = get_first_day($dayvalue,$month, $year);
	$specrec = $first_day_tocalculate + ($time[0] * 60 * 60) + ($time[1] * 60);
			
	if ($intervalvalue == 'second') {$specrec = $specrec + 604800;}
	if ($intervalvalue == 'third') {$specrec = $specrec + 1209600;}		
	if ($intervalvalue == 'fourth') {$specrec = $specrec + 1814400;}	
	if ($intervalvalue == 'last') {	
		$lastmonthday = mktime(23,59,59,$month, $daysinmonth, $year); 
		$specrec = ($specrec + 2419200 <= $lastmonthday) ? $specrec + 2419200 : $specrec + 1814400;	
	}
	return $specrec;	
}




function get_first_day($day_number, $month=false, $year=false)
  {
    $month  = ($month === false) ? strftime("%m"): $month;
    $year   = ($year === false) ? strftime("%Y"): $year;
	if ($day_number == 'Sunday') {$day_number = 0; 
  	} elseif($day_number == 'Monday') {$day_number = 1;
  	} elseif($day_number == 'Tuesday') {$day_number = 2;
  	} elseif ($day_number == 'Wednesday') {$day_number = 3;
  	} elseif ($day_number == 'Thursday') {$day_number = 4;
	} elseif ($day_number == 'Friday') {$day_number = 5;
	} elseif ($day_number == 'Saturday') {$day_number = 6; } 
    $first_day = 1 + ((7+$day_number - strftime("%w", mktime(0,0,0,$month, 1, $year)))%7);
    return mktime(0,0,0,$month, $first_day, $year);
}









/**
 * Configure events
 *
 * @access public
 * @return void
 */


function cromaxcal_get_the_events($month,$year) {
	$op = $endepoch = '';
	$calentries = array();
	$calargs=array(
		'post_type'=>'calendar',
		'showposts'=> -1,
	);

	$calposts = get_posts($calargs);
	foreach( $calposts as $cpost ) :	setup_postdata($cpost);

	$occurance = 0;

	$key_date_value		= get_post_meta($cpost->ID, 'cromax_calval', true);
	$key_time_value 	= get_post_meta($cpost->ID, 'cromax_calendarpack_hours', true) . ':' . get_post_meta($cpost->ID, 'cromax_calendarpack_minutes', true);
	$key_end_a 			= get_post_meta($cpost->ID, 'cromax_sel_rec_c', true);
	$key_end_b 			= get_post_meta($cpost->ID, 'cromax_sel_rec_d', true);
	$key_end_c 			= get_post_meta($cpost->ID, 'cromax_sel_rec_e', true);
	$key_recint_value	= get_post_meta($cpost->ID, 'cromax_sel_rec_a', true);
	$key_recday_value 	= get_post_meta($cpost->ID, 'cromax_sel_rec_b', true);
	$key_rectype_value 	= get_post_meta($cpost->ID, 'cromax_cal_rec', true);

	$timeparts = explode(':', $key_time_value);


	$startepoch = $key_date_value + ($timeparts[0] * 60 * 60) + ($timeparts[1] * 60);


	if ($key_end_a && $key_end_b && $key_end_c && $key_end_a != '0' && $key_end_b != '0' && $key_end_c != '0'){
		$endepoch = mktime($timeparts[0],$timeparts[1],0,$key_end_b, $key_end_a, $key_end_c);
	} else {
		$endepoch = '';
	}


	$beginningepoch = mktime(0,0,0,$month,1,$year);
	$daysinmonth = $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year %400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31);
	$closingepoch = mktime(23,59,59,$month,$daysinmonth,$year);


	if ($key_rectype_value == 5) {	
		$firstone = recinthappening($key_recint_value, $key_recday_value, $month, $year, $timeparts, $daysinmonth);
		if ($startepoch <= $firstone ){
			if (!$endepoch) {
				$occurance = 1;
			} elseif ($endepoch >= $firstone) {
				$occurance = 1;
			}
		}


	} elseif ($key_rectype_value == 4) {
		$firstone = mktime($timeparts[0],$timeparts[1],0,$month, date('j', $startepoch), $year);
		if ($startepoch <= $firstone ){
			if (!$endepoch) {
				$occurance = 1;
			} elseif ($endepoch >= $firstone) {
				$occurance = 1;
			}
		}

	} elseif ($key_rectype_value == 3) {
		$occurance = 2;
		$interval = 604800;
		unset($datelist);
		$datelist = array();
		$the_dayname = date('l', $startepoch);
		$monthname = date('F', mktime(0,0,0,$month, 1 , $year));
		$first_occurence_in_month = cromaxcal_get_first_day($the_dayname, $month, $year);
		$firstone = $first_occurence_in_month + ($timeparts[0] * 60 * 60) + ($timeparts[1] * 60);

		for($i = $firstone; $i < $closingepoch; $i = $i + $interval) {	
			if ( $i <= $startepoch - 1 ) {

			} else {
				if (!$endepoch) {
					$datelist[] = $i;
				} else {
					if ($endepoch >= $i) {
						$datelist[] = $i;
					}
				}
			}
		}
	} elseif ($key_rectype_value == 2) {
		$occurance = 2;
		$timetocount = $beginningepoch  + ($timeparts[0] * 60 * 60) + ($timeparts[1] * 60);
		unset($datelist);
		$datelist = array();
		for($i = ($timetocount); $i < $closingepoch; $i = $i + 86400) {
			if ($i >= $startepoch && $endepoch == '') { 
				$datelist[] = $i;
			} elseif ($i >= $startepoch && $endepoch && $i <= $endepoch){
				$datelist[] = $i;
			}
		}
	} elseif ($key_rectype_value == 1) {
		if ( $month == date('n',$startepoch) && $year == date('Y',$startepoch)  ){
			$occurance = 1;
			$firstone = $startepoch;
		}
	}

	if ($occurance === 1) {
		$calentries[] = array (					
			'strdate' => $firstone,
			'cids' => $cpost->ID
		);
	}
	
	if ($occurance == 2) {
		foreach ($datelist as $dateentry) {
			$calentries[] = array (					
				'strdate' => $dateentry,
				'cids' => $cpost->ID
			);
		}
	}
	endforeach; 
	return $calentries;
}






/**
 * Draw upcomming events for frontpage
 *
 * @access public
 * @return void
 */


function cromax_fetch_upc_events($toshow, $anim, $offset, $class) {


	$op 				= $thisday = '';
	$tday 				= 0;
	$date 				=time () ;


	$day 				= date('d', $date) ;
	$month 				= date('m', $date) ;
	$year 				= date('Y', $date) ;



	$first_day 			= mktime(0,0,0,$month, 1, $year);
	$fifteenth 			= mktime(0,0,0,$month, 15, $year);
	$title 				= date_i18n( 'F' , $first_day , false );



	$prt 				= cromaxcal_upcomming_arr($toshow);
	$cntr 				= 1;


	$op .= '<ul class="cro_twister cro_agendatwister">';

	foreach ($prt as $cro_v) {
		$image_id = get_post_thumbnail_id($cro_v['id']);
		$img = wp_get_attachment_image_src( $image_id, 'cro_landscape');
		if (!$img) {
				$img  =  '<img src="' . get_template_directory_uri() . '/public/styles/images/imgcommingsoon3.jpg">';
		}
		

		$page_object = get_page($cro_v['id']);
		$text = $page_object->post_content;
		$text = strip_shortcodes($text);
		$text = wp_trim_words( $text, $num_words = 12, $more = null );


		print_r('hi');
        $op 	.= '<li style="background: url(' . $img[0] . ') no-repeat center; background-size: cover;">';
        $op 	.= '<div class="popover">';
        $op 	.= '<div class="promoimg">';
        $op 	.= '<div class="agendadate"><span class="first">' .  date_i18n( 'j' , $cro_v['date'], false )   . '</span><span class="second">' .  date_i18n( 'F' , $cro_v['date'], false )   . '</span></div>';
        $op 	.= '</div>';
        $op 	.= '<div class="fpdiv"><span class="cro_caltime">' .  date_i18n( get_option('time_format') , $cro_v['date'], false ) . '</span></div>';
        $op 	.= '<h5 class="cro_cust_font">' . get_the_title($cro_v['id'])  . '</h5>';
        $op 	.= '<p>' . $text . '</p>';
        $op 	.= '<div class="clarlabel"><a href="' . get_permalink($cro_v['id']) . '" class="cro_accent">' .  __('More Info','croma')  .'</a></div>';
        $op 	.= '</div>';
        $op     .= '<a href="' . get_permalink($cro_v['id']) . '" class="calendarcover"><span class="calendarcoverspan"><i class="icon-link cro_cust_bg"></i></span></a>';
        $op 	.= '</li>';


 		$cntr++;
 	}

 	$op .= '</ul>';

 	return $op;
}




/**
 * Draw upcomming events for pages
 *
 * @access public
 * @return void
 */


function cromax_fetch_upco_events($toshow) {


	$op 				= $thisday = '';
	$tday 				= 0;
	$date 				=time () ;


	$day 				= date('d', $date) ;
	$month 				= date('m', $date) ;
	$year 				= date('Y', $date) ;



	$first_day 			= mktime(0,0,0,$month, 1, $year);
	$fifteenth 			= mktime(0,0,0,$month, 15, $year);
	$title 				= date_i18n( 'F' , $first_day , false );



	$prt 				= cromaxcal_upcomming_arr($toshow);
	$cntr 				= 1;




	$op .= '<ul class="cro_shortcal">';

	foreach ($prt as $cro_v) {

		$callocation 		=  (get_post_meta($cro_v['id'], 'cro_introinput', true ) != '')?     ' :' .  html_entity_decode(esc_attr( stripslashes(get_post_meta($cro_v['id'], 'cro_introinput', true )))) : '';

        $op .= '
        <li>
        	<div class="agendadate">
        		<span class="dateouter">
        			<span class="cro_dateinner cro_hp_header">' .  date_i18n( 'j M' , $cro_v['date'], false )   . '</span>
        		</span>
        	</div>

        	<div class="clarlabel">
        		<a href="' . get_permalink($cro_v['id']) . '" class="cro_accent">
        		<i class="icon-chevron-right"></i></a>
        	</div>

        	<div class="cro_maindate">
        		<h5 class="cro_cust_font cro_hp_header"><a href="'  . get_permalink( $cro_v['id'] ) . '">' . get_the_title($cro_v['id']) . '</a></h5>
        		<span class="cro_timeframe">' .  date_i18n( get_option('time_format') , $cro_v['date'], false ) . '  ' . $callocation  .   '</span>
        	</div>

        </li>';

 		$cntr++;
 	}

 	$op .= '</ul>';

 	return $op;
}





/**
 * Draw upcomming events for pages
 *
 * @access public
 * @return void
 */


function fetch_events_for_mm() {


	$op 				= $thisday = '';
	$tday 				= 0;
	$date 				=time () ;


	$day 				= date('d', $date) ;
	$month 				= date('m', $date) ;
	$year 				= date('Y', $date) ;



	$first_day 			= mktime(0,0,0,$month, 1, $year);
	$fifteenth 			= mktime(0,0,0,$month, 15, $year);
	$title 				= date_i18n( 'F' , $first_day , false );



	$prt 				= cromaxcal_upcomming_arr(5);
	$cntr 				= 1;




	$op .= '<div class="cro_mmcal">';

	foreach ($prt as $cro_v) {

        $op .= '
        <div class="cro_mm_calinner clearfix">
        	<div class="cro_mm_agendadate cro_hp_header"><a href="' . get_permalink($cro_v['id']) . '" class="cro_accent">' .  date_i18n( 'j M' , $cro_v['date'], false )   . '</a></div>

        	<div class="cro_mm_clarlabel">
        		<a href="' . get_permalink($cro_v['id']) . '" class="cro_accent">
        		<i class="icon-chevron-right"></i></a>
        	</div>

        	<div class="cro_mm_maindate">
        		<div class="cro_cust_font cro_hp_header"><a href="'  . get_permalink( $cro_v['id'] ) . '">' . get_the_title($cro_v['id']) . '</a></div>
        	</div>

        </div>';

 		$cntr++;
 	}

 	$op .= '</div>';

 	return $op;
}











/* 
 * -01- DRAW THE CALENDAR
 * */
function cromax_fetch_upc_agenda($type, $day , $month, $year, $default) {

	$op = $thisday = '';
	$tday = 0;
	$date =time () ;

	// IF THERE'S NO DAY OR MONTH SET, USE TODAY AS SETTINGS
	if (!$month || !$year) {
		$day = date('d', $date) ;
		$month = date('m', $date) ;
		$year = date('Y', $date) ;
	}


	$prt = cromax_get_the_calendar($month,$year);


	$first_day = mktime(0,0,0,$month, 1, $year);
	$fifteenth = mktime(0,0,0,$month, 15, $year);
	$title = date_i18n( 'F' , $first_day , false );


	$op .= '<ul class="calhead calagenda clearfix">';
	$op .= '<li class="prevm agendir" data-cro-agendir="' . ($fifteenth - 2592000)  . '"><i class="icon-chevron-left"></i></li>';
	$op .= '<li class="caltitle cro_cust_font" >' .  $title . ' ' .  $year  . '</li>';
	$op .= '<li class="prevm agendir pnext" data-cro-agendir="' . ($fifteenth + 2592000)  . '"><i class="icon-chevron-right"></i></li>';
	$op .= '</ul>';


	$cntr = 1;
	$op .= '<ul class="cro_twister cro_agendatwister">';

	foreach ($prt as $cro_v) {

		$img = get_the_post_thumbnail( $cro_v['cids'], 'cro_third');

		$page_object = get_page($cro_v['cids']);
		$text = $page_object->post_content;
		$text = strip_shortcodes($text);
		$text = strip_tags($text);
		$text = wp_trim_words( $text, $num_words = 12, $more = null ); 

		$callocation 		=  (get_post_meta($cro_v['cids'], 'cro_introinput', true ) != '')?     ' <br/><span class="locationspan" style="font-size: 16px;text-style: italics; color: #777;">' .  html_entity_decode(esc_attr( stripslashes(get_post_meta($cro_v['cids'], 'cro_introinput', true )))) : '</span>';





        $op .= '<li class="twistercontent">';
        $op .= '<div class="cro_cal_dateside">';
        $op .= '<div class="agendadate"><span class="first">' .  date_i18n( 'j' , $cro_v['strdate'], false )   . '</span><span class="second">' .  date_i18n( 'D' , $cro_v['strdate'], false )   . '</span></div>';
        $op .= '<span class="cro_cal_bigdate">' .  date_i18n( get_option('time_format') , $cro_v['strdate'], false ) . '</span>';
        $op .= '<div class="clarlabel"><a href="' . get_permalink($cro_v['cids']) . '" class="cro_cust_font cro_cust_bg">' .  __('More Info','croma')  .'</a></div>';
        $op .= '</div>';
        $op .= '<div class="cro_cal_infoside">';
        $op .= '<div class="promoimg">';
        $op .= ($img) ? $img : '' ;
        $op .= '</div>';
        $op .= '<h5 class="cro_cust_font">' . get_the_title($cro_v['cids']) . $callocation .  '</h5>';
        $op .= '<p>' . $text . '...</p>';
        $op .= '</div>';       
        $op .= '</li>';

       

 		$cntr++;
 	}

 	$op .= '</ul>';

 	return $op;
}







/**
 * Draw upcomming events array
 *
 * @access public
 * @return void
 */

function cromaxcal_upcomming_arr($count) {
	$now = time() + ( get_option( 'gmt_offset' ) * 3600 );
	$wmonth = date("n", $now);
	$wyear = date("Y", $now);
	$ctime = mktime(0,0,0,$wmonth,15,$wyear);
	$emptycounter = 0;
	$calwidget = array();

	while ((count($calwidget) <= ($count - 1)) && $emptycounter <= 50) { 
		$calentries = cromaxcal_get_the_events(date("n", $ctime),date("Y", $ctime));

		if($calentries) {
			$calentries = cromax_cal_val_sort($calentries,'strdate'); 
			foreach ($calentries as $crov) {
				if (isset($crov['strdate']) &&  $crov['strdate']  >= $now && count($calwidget) <= ($count - 1)) {
					$calwidget[] = array(					
						'date' => $crov['strdate'],
						'id' => $crov['cids'],
					);	
				}	
			}	
		}

		$ctime  = $ctime + 2678400;
		$emptycounter++;
	}
	return $calwidget;

}



/**
 * get_first_day function
 *
 * @access public
 * @return void
 */

function cromaxcal_get_first_day($day_number, $month=false, $year=false)
  {
    $month  = ($month === false) ? strftime("%m"): $month;
    $year   = ($year === false) ? strftime("%Y"): $year;
	if ($day_number == 'Sunday') {$day_number = 0; 
  	} elseif($day_number == 'Monday') {$day_number = 1;
  	} elseif($day_number == 'Tuesday') {$day_number = 2;
  	} elseif ($day_number == 'Wednesday') {$day_number = 3;
  	} elseif ($day_number == 'Thursday') {$day_number = 4;
	} elseif ($day_number == 'Friday') {$day_number = 5;
	} elseif ($day_number == 'Saturday') {$day_number = 6; } 
    $first_day = 1 + ((7+$day_number - strftime("%w", mktime(0,0,0,$month, 1, $year)))%7);
    return mktime(0,0,0,$month, $first_day, $year);
}



function cromaxcal_page_header($post_id) {

	$op = '';


	$byline =  (get_post_meta($post_id, 'cro_introdesc', true) !== '')? '<div class="cromaxcal_byline cro_cust_font">' . get_post_meta($post_id, 'cro_introdesc', true) .  '</div>' :  '';



	$key_end_a 			= get_post_meta($post_id, 'cromax_sel_rec_c', true);
	$key_end_b 			= get_post_meta($post_id, 'cromax_sel_rec_d', true);
	$key_end_c 			= get_post_meta($post_id, 'cromax_sel_rec_e', true);



	$key_recint_value	= get_post_meta($post_id, 'cromax_sel_rec_a', true);
	$key_recday_value 	= get_post_meta($post_id, 'cromax_sel_rec_b', true);
	$key_rectype_value 	= get_post_meta($post_id, 'cromax_cal_rec', true);



	$key_date_value		= get_post_meta($post_id, 'cromax_calval', true);
	$key_time_value 	= get_post_meta($post_id, 'cromax_calendarpack_hours', true) . ':' . get_post_meta($post_id, 'cromax_calendarpack_minutes', true);
	

	$timeparts = explode(':', $key_time_value);
	$startepoch = $key_date_value + ($timeparts[0] * 60 * 60) + ($timeparts[1] * 60);
	$playtime = date(get_option('time_format'), $startepoch);
	$img = get_the_post_thumbnail( $post_id , 'medium' );
	$maininfo = '';

	
	switch ($key_rectype_value) {
		case 1:
			$maininfo .= '<h3 class="cro_maindate cro_cust_font">' . date_i18n(get_option('date_format'), $startepoch, false )  . '</h3>';
		break;


		case 2:
			if (($key_end_a + $key_end_b + $key_end_c) === 0) {
				$maininfo .= '<h3 class="cro_maindate cro_datebylines cro_cust_font">' . __('Every day from','croma') . '</h3>';
				$maininfo .= '<h3 class="cro_maindate cro_cust_font">' . date_i18n(get_option('date_format'), $startepoch, false ) . '</h3>';			
				
			} else {
				$enddate = mktime(0,0,0, intval($key_end_b), $key_end_a, $key_end_c);
				$maininfo .= '<h3 class="cro_maindate cro_datebylines cro_cust_font" style="color: #272727">' . date_i18n(get_option('date_format'), $startepoch, false ) . '</h3>';
				$maininfo .= '<h3 class="cro_maindate cro_datebylines cro_cust_font">' . __('To','croma') . '</h3>';
				$maininfo .= '<h3 class="cro_maindate cro_cust_font">' . date_i18n(get_option('date_format'), $enddate, false ) . '</h3>';
			}
		break;


		case 3:

			if (($key_end_a + $key_end_b + $key_end_c) === 0) {
				$maininfo .= '<h3 class="cro_maindate cro_datebylines cro_cust_font">' . __('Every','croma') . ' ' . date_i18n('l', $startepoch, false ) . ' ' . __('from','croma') . '</h3>';
				$maininfo .= '<h3 class="cro_maindate cro_cust_font">' . date_i18n(get_option('date_format'), $startepoch, false ) . '</h3>';			
				
			} else {
				$enddate = mktime(0,0,0, intval($key_end_b), $key_end_a, $key_end_c);
				$maininfo .= '<h3 class="cro_maindate cro_datebylines cro_cust_font">' . __('Every','croma') . ' ' . date_i18n('l', $startepoch, false ) . ' ' . __('from','croma') . '</h3>';
				$maininfo .= '<h3 class="cro_maindate cro_datebylines cro_cust_font" style="color: #272727">' . date_i18n(get_option('date_format'), $startepoch, false ) . '</h3>';
				$maininfo .= '<h3 class="cro_maindate cro_datebylines cro_cust_font">' . __('To','croma') . '</h3>';
				$maininfo .= '<h3 class="cro_maindate cro_cust_font">' . date_i18n(get_option('date_format'), $enddate, false ) . '</h3>';
			}

		break;

		case 4:

			if (($key_end_a + $key_end_b + $key_end_c) === 0) {
				$maininfo .= '<h3 class="cro_maindate cro_datebylines cro_cust_font">' . __('Every','croma') . ' ' . date_i18n('jS', $startepoch, false ) . ' ' . __('from','croma') . '</h3>';
				$maininfo .= '<h3 class="cro_maindate cro_cust_font">' . date_i18n(get_option('date_format'), $startepoch, false ) . '</h3>';			
				
			} else {
				$enddate = mktime(0,0,0, intval($key_end_b), $key_end_a, $key_end_c);
				$maininfo .= '<h3 class="cro_maindate cro_datebylines cro_cust_font">' . __('Every','croma') . ' ' . date_i18n('jS', $startepoch, false ) . ' ' . __('from','croma') . '</h3>';
				$maininfo .= '<h3 class="cro_maindate cro_datebylines cro_cust_font"  style="color: #272727">' . date_i18n(get_option('date_format'), $startepoch, false ) . '</h3>';
				$maininfo .= '<h3 class="cro_maindate cro_datebylines cro_cust_font">' . __('To','croma') . '</h3>';
				$maininfo .= '<h3 class="cro_maindate cro_cust_font">' . date_i18n(get_option('date_format'), $enddate, false ) . '</h3>';
			}

		break;

		case 5:

		switch ($key_recint_value) {
			case 'first': 		$intval = __('First','croma');  break;
			case 'second': 		$intval = __('Second','croma');  break;
			case 'third': 		$intval = __('Third','croma');  break;
			case 'fourth': 		$intval = __('Fourth','croma');  break;
			case 'last': 		$intval = __('Last','croma');  break;
		}

		switch ($key_recday_value) {
			case 'Monday': 		$intday = date_i18n('l', (40000 + (86400 * 4)), false );  break;
			case 'Tuesday': 	$intday = date_i18n('l', (40000 + (86400 * 5)), false );  break;
			case 'Wednesday': 	$intday = date_i18n('l', (40000 + (86400 * 6)), false );  break;
			case 'Thursday': 	$intday = date_i18n('l', 40000, false );  break;
			case 'Friday': 		$intday = date_i18n('l', (40000 + (86400 * 1)), false );  break;
			case 'Saturday': 	$intday = date_i18n('l', (40000 + (86400 * 2)), false );  break;
			case 'Sunday': 		$intday = date_i18n('l', (40000 + (86400 * 3)), false );  break;
		}



			if (($key_end_a + $key_end_b + $key_end_c) === 0) {
				$maininfo .= '<h3 class="cro_maindate cro_datebylines cro_cust_font">' . __('Every','croma') . ' ' . $intval . ' ' . $intday . ' ' . __('from','croma') . '</h3>';
				$maininfo .= '<h3 class="cro_maindate cro_cust_font">' . date_i18n(get_option('date_format'), $startepoch, false ) . '</h3>';			
				
			} else {
				$enddate = mktime(0,0,0, intval($key_end_b), $key_end_a, $key_end_c);
				$maininfo .= '<h3 class="cro_maindate cro_datebylines cro_cust_font">' . __('Every','croma') . ' ' . $intval . ' ' . $intday . ' ' . __('from','croma') . '</h3>';
				$maininfo .= '<h3 class="cro_maindate cro_cust_font">' . date_i18n(get_option('date_format'), $startepoch, false ) . '</h3>';
				$maininfo .= '<h3 class="cro_maindate cro_datebylines cro_cust_font">' . __('To','croma') . '</h3>';
				$maininfo .= '<h3 class="cro_maindate cro_cust_font">' . date_i18n(get_option('date_format'), $enddate, false ) . '</h3>';
			}


		break;
		
	}

	$op .= '<div class="cro_caldescsingleouter">';




	$op .= $byline;



	if ($img) {
		$op .= '<div class="cro_calsingleimg">' . $img;
		$op .= '<div class="cro_twiouter"><div class="cro_timewithimage">' . __('time','croma') . ' '  .  $playtime   . '</div></div>';
		$op .=  '</div>';
	} else {
		$op .= '<div class="cro_calsingletime">' . __('time','croma') . ' '  .  $playtime   . '</div>';
	}

	$op .= '<div class="cro_maininfoholder">' . $maininfo . '</div>';



	$op .= '<div class="clearfix"></div>';

	$op .= '</div>';
	return $op;
}





?>