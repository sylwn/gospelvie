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

function cromatic_make_formpart($id, $value){

	// get the theme options array
	$cromatic 		= get_option('cromatic');


	// are we rendering a theme option or a meta box?
	if ($id == 0) {
		$val 			= (isset($cromatic[esc_attr($value['fn'])]))?  $cromatic[esc_attr($value['fn'])] :  '';
	} else {
		$val 			= get_post_meta( $id, $value['fn'], true );
	}



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
			$op .= '<select name="' . esc_attr( $value['fn'] )  . '" class="cro_formpartselect">';
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
		case 'selectslider':

			// check if the layerslider is active
			if (class_exists('RevSlider')) {

				$sld 		= new RevSlider();
    			$sliders 	= $sld->getArrSliders();
				$op 		.= '<select name="' . $value['fn']  . '" class="cro_formpartselect">';
			

				if(!empty($sliders)){
        			foreach($sliders as $slider){
						$op .= '<option ' . selected( $val, $slider->getParam('alias','false'), false)   . ' value="' .  $slider->getParam('alias','false') . '">' .  $slider->getParam('title','false')  . '</option>';					
					}
				}

				$op .= '</select>';

			}
		break;





		// create a preformated selectbox
		case 'selectlist':
			$op 		.= '<select name="' . $value['fn']  . '" class="cro_formpartselect">';
			$ctr 		= 1;
			foreach ($value['options'] as $v) {
				$op 	.= '<option ' . selected( $val, $ctr, false)   . ' value="' .  $ctr  . '">' .  $v  . '</option>';	
				$ctr++;				
			}
			$op .= '</select>';
		break;




		// create a preformated selectbox
		case 'userselect':
			$op 		.= '<select name="' . $value['fn']  . '" class="cro_formpartselect">';
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
			$op .= '<input type="text"  name="' . $value['fn']  . '" class="cro_formpartinput" value="' . esc_attr( $valu ) . '">';
		break;





		// create a textbox
		case 'textarea':
			$valu 	= ($val != '')? $val : $value['def'] ;
			$op 	.= '<textarea name="' . $value['fn']  . '" class="cro_formparttextarea">' . stripslashes($valu) . '</textarea>';
		break;





		//create and innitialize the colorpicker
		case 'colorpicker':
			$valu = ($val != '')? $val : $value['def'] ;
			$op .= '<input type="text" class="cro_pickme ' . $value['fn']   .   '" name="' . $value['fn']  .   '" value="' . esc_attr( $val )  .   '" size="29" style="background: ' . $val   . ';" rel=".' . $value['fn']   .   '" />';
		break;





		// create the image manager
		case 'imagemanager':
			$valu = ($val != '')? $val : $value['def'] ;
			$op .= '<input type="text" class="cro_imgmng ' . $value['fn']   .   '" name="' . $value['fn']  .   '" value="' . esc_url($val)   .   '" size="29" style="background: ' . $val   . ';" rel=".' . $value['fn']   .   '" /><span class="cro_clearimginput">Clear</span>';
		break;





		//create the slider
		case 'uislider':
			$valu = ($val != '')? $val : $value['def'] ; 
			$op .= '<span class="sliderouter"><span class="noUiSlider ' . $value['fn']  . '" rel="' . $value['fn']  . '" data-min="'. $value['options'][0].'" data-max="'. $value['options'][1].'" data-step="'. $value['options'][2].'" data-val="' . esc_attr( $valu )  . '" ></span><input id="show-serialization-field" class="i-' . $value['fn']  . '" value="' . esc_attr( $valu )  .   '" name="' . $value['fn']  .   '"></span>';
		break;





		// create the switch
		case 'yesno':
			$valu 		= ($val != '')? $val : $value['def'] ;
			$valuclass 	= ($valu == 1)? 'cro_yesnohandler' : 'cro_yesnohandler  cro_nonohandler' ;
			$op .= '<span class="cro_yesnoouter"><span class="'.  $valuclass  . '"><span class="cro_yesno_knob">&nbsp;</span></span><input type="hidden" value="' . esc_attr($valu)   .   '" name="' . $value['fn']  .   '"></span>';
		break;





		// create the category selector
		case 'catselect':
			$op .= '<select name="' . $value['fn']  . '" class="cro_formpartselect">';
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
			$op .= '<select name="' . $value['fn']  . '" class="cro_formpartselect">';
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


		// prepare the fontlist
		case 'fontlist':


			// fetch the google fonts array
			ob_start();
			include('templates/cromafonts.php');
			$fontlist 		= json_decode(ob_get_contents(), true);
			ob_end_clean();



		
			// set the variables	
			$fontvariant 	= $fontsubset 	=  array();
			$optval1		= $optval1		=  '';
			$groupvalue 	= explode('|', $val);




			// start the layout
			$op 		.= '
			<span class="cro_fontselectmain">
				<select class="cro_formpartselect cro_formmainselect cro_formselectpart">
				';
			


			// loop the array of availabel fornts
			foreach ($fontlist['items'] as $vfonts) {



				// build the variantlist & subsetlist for the current font in the list $ change ot a string & unset
				foreach ($vfonts['variants'] as $vvar) {$fontvariant[] = $vvar;}
				foreach ($vfonts['subsets'] as $vvar) { $fontsubset[] = $vvar;}
				
				$vvariant 		= implode('|', $fontvariant);
				$vsubset 		= implode('|', $fontsubset);
				
				unset($fontvariant);
				unset($fontsubset);



				// get the default font variants and subsets
				if ($groupvalue[0] == $vfonts['family']) {
					$optval1 	= $vvariant;
					$optval2 	= $vsubset;
				}


				// build the option for the fontnames
                $op 	.= '<option  ' . selected( $groupvalue[0], $vfonts['family'], false)   . '  value="' . $vfonts['family']  .  '" data-cro-subset="' .  $vsubset  . '" data-cro-variant="' . $vvariant . '">' .  $vfonts['family']  . '</option>
                ';
 

            } // end foreach loop




			// create the variant loop			
			$op .= '
				</select>
				<select class="cro_formpartselect cro_formsecondselect">';


			// if there's a variant set loop through the available settings and build the options list
			if ($optval1 != '') {
				
				$optval 	= explode('|', $optval1);
				foreach ($optval as $valu1) {
					$op 	.= '<option  ' . selected( $groupvalue[1], $valu1, false)   . '  value="' . $valu1  .  '">' . $valu1  . '</option>';
				}
			}



			// create the subset loop
			$op .= '
				</select>
				<select class="cro_formpartselect cro_formthirdselect">';



			// if there's a subset loop through the available settings and build the options list
			if ($optval2 != '') {
				$optval 	= explode('|', $optval2);
				foreach ($optval as $valu2) {
					$op 	.= '<option  ' . selected( $groupvalue[2], $valu2, false)   . '  value="' . $valu2  .  '">' . $valu2  . '</option>';
				}
			}


			// finnish and build the hidden input
			$op .= '
				</select>
				<input name="' . $value['fn']  . '" type="hidden" value="' . $val  . '" class="cro_formfontinput" />
			</span>';



			// build the font example display
			$gval = str_replace(' ', '+', $groupvalue[0]);
			$op .= "
				<span class='cro_linkholder'>
						<link href='http://fonts.googleapis.com/css?family=" . $gval . ":" . $groupvalue[1] . "&subset=" . $groupvalue[2] . "' rel='stylesheet' type='text/css'>
					</span>";

			$cro_weightval = str_replace('italic', '', $groupvalue[1]);

			if (strpos($groupvalue[1],'italic') !== false) {$itlcs = 'italic';} else {$itlcs = 'normal';}

			$op .= '
				<span class="cro_fontshowcase" style="font-style: ' . $itlcs . ';font-weight: ' . $cro_weightval . ';font-family: ' . $groupvalue[0] . '">
					Bright vixens jump; dozy fowl quack
				</span>
				';

			
		break;





		// add the all important helpfile
		case 'help':
			$op .= '
				<span class="cro_help_maintitle">Theme Help</span>
				<span class="cro_help_subtitle">How to get help</span>
				<span class="cro_help_discussion">Help is available from any of the links below. For your ease we have also packaged a helpfile compilation in your Theme folder</span>
				<span class="cro_help_subtitle">Helpfull links</span>
				<span class="cro_help_itemlink"><a href="http://themeforest.net/user/Net-Labs/portfolio">Dunamis Themeforest Site </a></span>
				<span class="cro_help_itemlink"><a href="http://cro.ma">Croma Website </a></span>
				<span class="cro_help_itemlink"><a href="http://cro.ma/?page_id=327">Croma Support </a></span>
				<span class="cro_help_itemlink"><a href="http://assets.cro.ma/dunamis">Helpfile Online </a></span>
				<span class="cro_help_subtitle" style="margin-top: 50px;">We are here to assist</span>
				<span class="cro_help_discussion">Feel free to make contact with any requests that you may have. our service is legendary.</span>
			';
		break;



	}
	return $op . '</span></p>';
}
