<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Cromatic admin layouts
 *
 *
 * @package Cromatic
 * @subpackage Cromatic
 * @since 1.0
 */




function cromatic_mm_layouts() {




	// add the blog pagebuilder content array
	$cro_mm['1'] = array(
		'name' 		=> __('3 Banners','croma'),
		'handle' 	=> '1',
		'icon' 		=> 'icon-file-text',
		'content' 	=> array(

			array(
				'name' 		=> __('Banner 1 Image','croma'),
				'fn' 		=> 'cro_layimage1',
				'desc' 		=> __('Background image for banner 1','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 1 title','croma'),
				'fn' 		=> 'cro_laytitle1',
				'desc' 		=> __('Type the title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 1 link','croma'),
				'fn' 		=> 'cro_laylink1',
				'desc' 		=> __('Type the link or leave open','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 1 mask','croma'),
				'fn' 		=> 'cro_bgmask1',
				'desc' 		=> __('Background mask','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(1,100,1),
				'def' 		=> 150
			),
			array(
				'name' 		=> __('Banner 1 mask color','croma'),
				'fn' 		=> 'cro_bgcolor1',
				'desc' 		=> __('Select color','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> '#0000'
			),
			array(
				'name' 		=> '',
				'fn' 		=> 'cro_seperator',
				'desc' 		=> '',
				'type' 		=> 'seperator',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 2 Image','croma'),
				'fn' 		=> 'cro_layimage2',
				'desc' 		=> __('Background image for banner 1','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 2 title','croma'),
				'fn' 		=> 'cro_laytitle2',
				'desc' 		=> __('Type the title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 2 link','croma'),
				'fn' 		=> 'cro_laylink2',
				'desc' 		=> __('Type the link or leave open','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 2 mask','croma'),
				'fn' 		=> 'cro_bgmask2',
				'desc' 		=> __('Background mask','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(1,100,1),
				'def' 		=> 150
			),
			array(
				'name' 		=> __('Banner 2 mask color','croma'),
				'fn' 		=> 'cro_bgcolor2',
				'desc' 		=> __('Select color','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> '#0000'
			),
			array(
				'name' 		=> '',
				'fn' 		=> 'cro_seperator',
				'desc' 		=> '',
				'type' 		=> 'seperator',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 3 Image','croma'),
				'fn' 		=> 'cro_layimage3',
				'desc' 		=> __('Background image for banner 1','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 3 title','croma'),
				'fn' 		=> 'cro_laytitle3',
				'desc' 		=> __('Type the title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 3 link','croma'),
				'fn' 		=> 'cro_laylink3',
				'desc' 		=> __('Type the link or leave open','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 3 mask','croma'),
				'fn' 		=> 'cro_bgmask3',
				'desc' 		=> __('Background mask','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(1,100,1),
				'def' 		=> 150
			),
			array(
				'name' 		=> __('Banner 3 mask color','croma'),
				'fn' 		=> 'cro_bgcolor3',
				'desc' 		=> __('Select color','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> '#0000'
			),
		)
	);


	// add the blog pagebuilder content array
	$cro_mm['2'] = array(
		'name' 		=> __('2 Navigation columns','croma'),
		'handle' 	=> '2',
		'icon' 		=> 'icon-calendar',
		'content' 	=> array(
			array(
				'name' 		=> __('Navigation Title','croma'),
				'fn' 		=> 'cro_navtitle1',
				'desc' 		=> __('Type the title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Navigation left','croma'),
				'fn' 		=> 'cro_nn1',
				'desc' 		=> __('Select a navigaiotn name','croma'),
				'type' 		=> 'selectnav',
				'options' 	=> array(),
				'def' 		=> 0
			),
			array(
				'name' 		=> __('Navigation Title','croma'),
				'fn' 		=> 'cro_navtitle2',
				'desc' 		=> __('Type the title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Navigation right','croma'),
				'fn' 		=> 'cro_nn2',
				'desc' 		=> __('Select a navigaiotn name','croma'),
				'type' 		=> 'selectnav',
				'options' 	=> array(),
				'def' 		=> 0
			)
		)
	);



	// add the blog pagebuilder content array
	$cro_mm['3'] = array(
		'name' 		=> __('Countdown timer','croma'),
		'handle' 	=> '3',
		'icon' 		=> 'icon-time',
		'content' 	=> array(
			array(
				'name' 		=> __('Navigation title','croma'),
				'fn' 		=> 'cro_navtitle',
				'desc' 		=> __('Type the title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Navigation left','croma'),
				'fn' 		=> 'cro_nn1',
				'desc' 		=> __('Select a navigaiotn name','croma'),
				'type' 		=> 'selectnav',
				'options' 	=> array(),
				'def' 		=> 0
			),
			array(
				'name' 		=> '',
				'fn' 		=> 'cro_seperator',
				'desc' 		=> '',
				'type' 		=> 'seperator',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 1 Image','croma'),
				'fn' 		=> 'cro_layimage1',
				'desc' 		=> __('Background image for banner 1','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 1 title','croma'),
				'fn' 		=> 'cro_laytitle1',
				'desc' 		=> __('Type the title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 1 link','croma'),
				'fn' 		=> 'cro_laylink1',
				'desc' 		=> __('Type the link or leave open','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 1 mask','croma'),
				'fn' 		=> 'cro_bgmask1',
				'desc' 		=> __('Background mask','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(1,100,1),
				'def' 		=> 150
			),
			array(
				'name' 		=> __('Banner 1 mask color','croma'),
				'fn' 		=> 'cro_bgcolor1',
				'desc' 		=> __('Select color','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> '#0000'
			),
			array(
				'name' 		=> '',
				'fn' 		=> 'cro_seperator',
				'desc' 		=> '',
				'type' 		=> 'seperator',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 2 Image','croma'),
				'fn' 		=> 'cro_layimage2',
				'desc' 		=> __('Background image for banner 1','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 2 title','croma'),
				'fn' 		=> 'cro_laytitle2',
				'desc' 		=> __('Type the title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 2 link','croma'),
				'fn' 		=> 'cro_laylink2',
				'desc' 		=> __('Type the link or leave open','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 2 mask','croma'),
				'fn' 		=> 'cro_bgmask2',
				'desc' 		=> __('Background mask','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(1,100,1),
				'def' 		=> 150
			),
			array(
				'name' 		=> __('Banner 2 mask color','croma'),
				'fn' 		=> 'cro_bgcolor2',
				'desc' 		=> __('Select color','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> '#0000'
			),
		)
	);


	$cro_mm['4'] = array(
		'name' 		=> __('Intro text','croma'),
		'handle' 	=> '4',
		'icon' 		=> 'icon-comments-alt',
		'content' 	=> array(
			array(
				'name' 		=> __('Title','croma'),
				'fn' 		=> 'cro_layhead',
				'desc' 		=> __('Type the title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Content','croma'),
				'fn' 		=> 'cro_laycnt',
				'desc' 		=> __('Type the content','croma'),
				'type' 		=> 'textarea',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Label','croma'),
				'fn' 		=> 'cro_laylabel',
				'desc' 		=> __('Type the label','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('link','croma'),
				'fn' 		=> 'cro_laylink',
				'desc' 		=> __('Type the link or leave open','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Label text color','croma'),
				'fn' 		=> 'cro_textcolor',
				'desc' 		=> __('Select text color','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> '#0000'
			),

			array(
				'name' 		=> __('Label background color','croma'),
				'fn' 		=> 'cro_bgcolor',
				'desc' 		=> __('Select background color','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> '#0000'
			)
		),
	);


	$cro_mm['5'] = array(
		'name' 		=> __('Latest News','croma'),
		'handle' 	=> '5',
		'icon' 		=> 'icon-comments-alt',
		'content' 	=> array(
			array(
				'name' 		=> __('Category','croma'),
				'fn' 		=> 'cro_categories',
				'desc' 		=> __('Select the categories','croma'),
				'type' 		=> 'catselect',
				'options' 	=> array('post'),
				'def' 		=> ''
			)
		),
	);


	// add the blog pagebuilder content array
	$cro_mm['6'] = array(
		'name' 		=> __('2banners','croma'),
		'handle' 	=> '6',
		'icon' 		=> 'icon-time',
		'content' 	=> array(
			array(
				'name' 		=> __('Banner 1 Image','croma'),
				'fn' 		=> 'cro_layimage1',
				'desc' 		=> __('Background image for banner 1','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 1 title','croma'),
				'fn' 		=> 'cro_laytitle1',
				'desc' 		=> __('Type the title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 1 link','croma'),
				'fn' 		=> 'cro_laylink1',
				'desc' 		=> __('Type the link or leave open','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 1 mask','croma'),
				'fn' 		=> 'cro_bmask1',
				'desc' 		=> __('Background mask','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(1,100,1),
				'def' 		=> 150
			),
			array(
				'name' 		=> __('Banner 1 mask color','croma'),
				'fn' 		=> 'cro_bgcolor1',
				'desc' 		=> __('Select color','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> '#0000'
			),
			array(
				'name' 		=> '',
				'fn' 		=> 'cro_seperator',
				'desc' 		=> '',
				'type' 		=> 'seperator',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 2 Image','croma'),
				'fn' 		=> 'cro_layimage2',
				'desc' 		=> __('Background image for banner 1','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 2 title','croma'),
				'fn' 		=> 'cro_laytitle2',
				'desc' 		=> __('Type the title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 2 link','croma'),
				'fn' 		=> 'cro_laylink2',
				'desc' 		=> __('Type the link or leave open','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 2 mask','croma'),
				'fn' 		=> 'cro_bgmask2',
				'desc' 		=> __('Background mask','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(1,100,1),
				'def' 		=> 150
			),
			array(
				'name' 		=> __('Banner 2 mask color','croma'),
				'fn' 		=> 'cro_bgcolor2',
				'desc' 		=> __('Select color','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> '#0000'
			),
		)
	);

	
	// add the blog pagebuilder content array
	$cro_mm['7'] = array(
		'name' 		=> __('2banners','croma'),
		'handle' 	=> '7',
		'icon' 		=> 'icon-time',
		'content' 	=> array(
			array(
				'name' 		=> __('Banner  Image','croma'),
				'fn' 		=> 'cro_layimage1',
				'desc' 		=> __('Background image for banner 1','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner 1 title','croma'),
				'fn' 		=> 'cro_laytitle1',
				'desc' 		=> __('Type the title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Banner  mask','croma'),
				'fn' 		=> 'cro_bgmask1',
				'desc' 		=> __('Background mask','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(1,100,1),
				'def' 		=> 150
			),
			array(
				'name' 		=> __('Banner mask color','croma'),
				'fn' 		=> 'cro_bgcolor1',
				'desc' 		=> __('Select color','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> '#0000'
			),
			array(
				'name' 		=> '',
				'fn' 		=> 'cro_seperator',
				'desc' 		=> '',
				'type' 		=> 'seperator',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Title 1','croma'),
				'fn' 		=> 'cro_title1',
				'desc' 		=> __('Type the title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Info 1','croma'),
				'fn' 		=> 'cro_info1',
				'desc' 		=> __('Type the info','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link 1','croma'),
				'fn' 		=> 'cro_link1',
				'desc' 		=> __('Type the link','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> '',
				'fn' 		=> 'cro_seperator',
				'desc' 		=> '',
				'type' 		=> 'seperator',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Title 2','croma'),
				'fn' 		=> 'cro_title2',
				'desc' 		=> __('Type the title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Info 2','croma'),
				'fn' 		=> 'cro_info2',
				'desc' 		=> __('Type the info','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link 2','croma'),
				'fn' 		=> 'cro_link2',
				'desc' 		=> __('Type the link','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> '',
				'fn' 		=> 'cro_seperator',
				'desc' 		=> '',
				'type' 		=> 'seperator',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Title 3','croma'),
				'fn' 		=> 'cro_title3',
				'desc' 		=> __('Type the title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Info 3','croma'),
				'fn' 		=> 'cro_info3',
				'desc' 		=> __('Type the info','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link 3','croma'),
				'fn' 		=> 'cro_link3',
				'desc' 		=> __('Type the link','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			)
		)
	);


	// add the blog pagebuilder content array
	$cro_mm['8'] = array(
		'name' 		=> __('Latest Events','croma'),
		'handle' 	=> '8',
		'icon' 		=> 'icon-time',
		'content' 	=> array(
			array(
				'name' 		=> __('Latest Events','croma'),
				'fn' 		=> 'cro_layimage1',
				'desc' 		=> __('This section have no configurations','croma'),
				'type' 		=> 'textmessage',
				'options' 	=> array(),
				'def' 		=> ''
			)	
			
		)
	);


	return apply_filters( 'cromatic_mm_layouts', $cro_mm );
}


?>