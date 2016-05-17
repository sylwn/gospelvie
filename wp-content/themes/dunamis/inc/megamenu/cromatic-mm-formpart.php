<?php

/**
 * Pagemaker formpart creator
 *
 *
 * @author 		Croma
 * @category 	Admin
 * @package 	templates
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function cromatic_mm_make_formpart($id, $value, $side){

	// get the theme options array
	$cromatic 		= get_option('cromatic');


	$val 			= get_post_meta( $id, $value['fn'] . '-' . $side, true );




	// add different classes and wraps for textareas and helpfiles
	$istextarea			= ($value['type'] == 'textarea')?  'cro_mn_textarea' :  ''  ;

	if ($value['type'] == 'seperator'){
		$op 			= '<p class="cro_mn_seperator">';
	} elseif ($value['type'] == 'help') {
		$op 			= '<p class="cro_mn_part cro_mn_help_part ">';
	} elseif ($value['type'] == 'fontlist') {
		$op 			= '<p class="cro_mn_part cro_mn_font_part "><span class="cro_mn_helper">?<em>' . $value['desc']  . '</em></span><span class="cro_mn_title">' . $value['name']  . '</span><span class="cro_mn_contentadd ' . $istextarea . '">';
	} else {
		$op 			= '<p class="cro_mn_part"><span class="cro_mn_helper">?<em>' . $value['desc']  . '</em></span><span class="cro_mn_title">' . $value['name']  . '</span><span class="cro_mn_contentadd ' . $istextarea . '">';
	}



	// create our main formart switch
	switch ($value['type']) {



		// create a select link  for select boxes.
		case 'linkto':
			$op .= '<select name="' . esc_attr( $value['fn'] )  . '-' . $side . '" class="cro_formpartselect">';
			foreach ($value['options'] as $v) {
				$args = array(
					'post_type' 	=> $v,
					'post_status' 	=> 'publish',
					'numberposts'   => -1
				); 
				$pages = get_posts($args); 
				if(!empty($pages)){
					foreach ($pages as $vals) {
						$op .= '<option ' . selected( $val, $vals->ID, false)   . ' value="' .  $vals->ID  . '">' . wptexturize($vals->post_title)   . '</option>';					
					}
				}
			}
			$op .= '</select>';
		break;




		// create a select link  the layerslider selector
		case 'selectnav':

			$menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );
				
			$op	.= '<select name="' . $value['fn']  . '-' . $side . '" class="cro_formpartselect">';
			

			foreach ($menus as $menu) {
				$op .= '<option ' . selected( $val, $menu->term_id, false)   . ' value="' .  $menu->term_id . '">' .   esc_html( $menu->name )  . '</option>';					
			}


			$op .= '</select>';

		break;




		// create a select link  the layerslider selector
		case 'selectslider':

			// check if the layerslider is active
			if (function_exists('lsSliders')) { 

				$g_slider 	= lsSliders();
				$op 		.= '<select name="' . $value['fn']  . '-' . $side . '" class="cro_formpartselect">';
			

				if(!empty($g_slider)){
					foreach ($g_slider as $vals) {
						$op .= '<option ' . selected( $val, $vals['id'], false)   . ' value="' .  $vals['id'] . '">' .  wptexturize( $vals['name'] )  . '</option>';					
					}
				}

				$op .= '</select>';

			}
		break;





		// create a preformated selectbox
		case 'selectlist':
			$op 		.= '<select name="' . $value['fn']  . '-' . $side . '" class="cro_formpartselect">';
			$ctr 		= 1;
			foreach ($value['options'] as $v) {
				$op 	.= '<option ' . selected( $val, $ctr, false)   . ' value="' .  $ctr  . '">' .  $v  . '</option>';	
				$ctr++;				
			}
			$op .= '</select>';
		break;




		// create a preformated selectbox
		case 'userselect':
			$op 		.= '<select name="' . $value['fn']  . '-' . $side . '" class="cro_formpartselect">';
			$op 		.= '<option value="0">' . __('None Selected','croma') . '</option>';

			foreach (cro_fetch_userarray() as $v) {
				$op 	.= '<option ' . selected( $val, $v, false)   . ' value="' .  $v  . '">' .  get_the_author_meta( 'display_name', $v)  . '</option>';	
				$ctr++;				
			}


			$op 		.= '</select>';
		break;




		// create a inputbox
		case 'input':
			$valu = ($val != '')? $val : $value['def'] ;
			$op .= '<input type="text"  name="' . $value['fn']  . '-' . $side . '" class="cro_formpartinput" value="' . esc_attr( $valu ) . '">';
		break;





		// create a textbox
		case 'textarea':
			$valu 	= ($val != '')? $val : $value['def'] ;
			$op 	.= '<textarea name="' . $value['fn']  . '-' . $side . '" class="cro_formparttextarea">' . stripslashes($valu) . '</textarea>';
		break;





		//create and innitialize the colorpicker
		case 'colorpicker':
			$valu = ($val != '')? $val : $value['def'] ;
			$op .= '<input type="text" class="cro_pickme ' . $value['fn']   .   '" name="' . $value['fn']  .   '-' . $side . '" value="' . esc_attr( $val )  .   '" size="29" style="background: ' . $val   . ';" rel=".' . $value['fn']   .   '" />';
		break;






		// create the image manager
		case 'textmessage':

			$op .= '<span>' . $value['desc']   .   '</span>';
		break;







		// create the image manager
		case 'imagemanager':
			$valu = ($val != '')? $val : $value['def'] ;
			$op .= '<input type="text" class="cro_imgmng ' . $value['fn']   .   '" name="' . $value['fn']  .   '-' . $side . '" value="' . esc_url($val)   .   '" size="29" style="background: ' . $val   . ';" rel=".' . $value['fn']   .   '" /><span class="cro_clearimginput">Clear</span>';
		break;





		//create the slider
		case 'uislider':
			$valu = ($val != '')? $val : $value['def'] ; 
			$op .= '<span class="sliderouter"><span class="noUiSlider ' . $value['fn']  . '" rel="' . $value['fn']  . '" data-min="'. $value['options'][0].'" data-max="'. $value['options'][1].'" data-step="'. $value['options'][2].'" data-val="' . esc_attr( $valu )  . '" ></span><input id="show-serialization-field" class="i-' . $value['fn']  . '" value="' . esc_attr( $valu )  .   '" name="' . $value['fn']  .   '-' . $side . '"></span>';
		break;



		// create the switch
		case 'yesno':
			$valu 		= ($val != '')? $val : $value['def'] ;
			$valuclass 	= ($valu == 1)? 'cro_yesnohandler' : 'cro_yesnohandler  cro_nonohandler' ;
			$op .= '<span class="cro_yesnoouter"><span class="'.  $valuclass  . '"><span class="cro_yesno_knob">&nbsp;</span></span><input type="hidden" value="' . esc_attr($valu)   .   '" name="' . $value['fn']  .   '-' . $side . '"></span>';
		break;



		// create the category selector
		case 'catselect':
			$op .= '<select name="' . $value['fn']  . '-' . $side . '" class="cro_formpartselect">';
			$op .= '<option ' . selected( $val, 0, false)   . ' value="0">' . __('All categories','croma') . '</option>';	
			foreach ($value['options'] as $v) {
				$categories =  get_categories($value['options']);
				foreach ($categories as $category) {
					$op .= '<option ' . selected( $val, $category->term_id, false)   . ' value="' .  $category->term_id  . '">' .  wptexturize( $category->category_nicename ) . '</option>';	
				}		
			}
			$op .= '</select>';
		break;


		// create the page selector
		case 'pageselect':
			$op .= '<select name="' . $value['fn']  . '-' . $side . '" class="cro_formpartselect">';
			foreach ($value['options'] as $v) {
				$args = array(
						'posts_per_page'   => -1,
						'post_type'        => $v,
						'post_status'      => 'publish'
				);
				$categories =  get_posts($args);
				foreach ($categories as $category) {
					$op .= '<option ' . selected( $val, $category->ID, false)   . ' value="' .  $category->ID  . '">' . $category->post_title . '</option>';	
				}		
			}
			$op .= '</select>';
		break;


	}
	return $op . '</span></p>';
}
