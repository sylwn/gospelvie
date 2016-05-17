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




function cromatic_pbuilder_layouts() {


	$croma = get_option('cromatic');


	// add the blog pagebuilder content array
	$cro_pb['blg'] = array(
		'name' 		=> __('Blog articles','croma'),
		'handle' 	=> 'blg',
		'icon' 		=> 'icon-file-text',
		'content' 	=> array(
			array(
				'name' 		=> __('Animation','croma'),
				'fn' 		=> 'cro_anim',
				'desc' 		=> __('Add Animations ot the section','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array('none','bounce','flash','pulse','rubberBand','shake','swing','tada','wobble','bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp','bounceO','fadeInRightBig','fadeInUp','fadeInUpBig','flip','flipInX','flipInY','Lightspeed','lightSpeedIn','rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight','slideInDown','slideInLeft','slideInRight','hinge','rollIn'),
				'def' 		=> 0
			),
			array(
				'name' 		=> __('Background Image','croma'),
				'fn' 		=> 'cro_layimage',
				'desc' 		=> __('Select floating image for the layout or leave open if this section must not have a floating image','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Mask','croma'),
				'fn' 		=> 'cro_laymask',
				'desc' 		=> __('% mask for the image','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(0,100,1),
				'def' 		=> 0
			),
			array(
				'name' 		=> __('Mask Color','croma'),
				'fn' 		=> 'cro_maskcolor',
				'desc' 		=> __('Select color for the mask','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> 'default content'
			),
			array(
				'name' 		=> __('Main Title','croma'),
				'fn' 		=> 'cro_maintitle',
				'desc' 		=> __('Type the Title for the section','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Category to show','croma'),
				'fn' 		=> 'cro_laycat',
				'desc' 		=> __('Select the category to show','croma'),
				'type' 		=> 'catselect',
				'options' 	=> array('post'),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link','croma'),
				'fn' 		=> 'cro_laylink',
				'desc' 		=> __('Type the link or leave open','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link label','croma'),
				'fn' 		=> 'cro_laylabel',
				'desc' 		=> __('Select the button label','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> 'Read more'
			)
		)
	);



		// add the blog pagebuilder content array
	$cro_pb['cta'] = array(
		'name' 		=> __('Call to action','croma'),
		'handle' 	=> 'cta',
		'icon' 		=> 'icon-bell',
		'content' 	=> array(
			array(
				'name' 		=> __('Animation','croma'),
				'fn' 		=> 'cro_anim',
				'desc' 		=> __('Add Animations ot the section','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array('none','bounce','flash','pulse','rubberBand','shake','swing','tada','wobble','bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp','bounceO','fadeInRightBig','fadeInUp','fadeInUpBig','flip','flipInX','flipInY','Lightspeed','lightSpeedIn','rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight','slideInDown','slideInLeft','slideInRight','hinge','rollIn'),
				'def' 		=> 0
			),
			array(
				'name' 		=> __('Title','croma'),
				'fn' 		=> 'cro_maintitle',
				'desc' 		=> __('Type the Title for the section','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Background Image','croma'),
				'fn' 		=> 'cro_layimage',
				'desc' 		=> __('Select floating image for the layout or leave open if this section must not have a floating image','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Mask','croma'),
				'fn' 		=> 'cro_laymask',
				'desc' 		=> __('% mask for the image','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(0,100,1),
				'def' 		=> 0
			),
			array(
				'name' 		=> __('Mask Color','croma'),
				'fn' 		=> 'cro_maskcolor',
				'desc' 		=> __('Select color for the mask','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> 'default content'
			),
			array(
				'name' 		=> __('Text Color','croma'),
				'fn' 		=> 'cro_textcolor',
				'desc' 		=> __('Select color for the mask','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> 'default content'
			),
			array(
				'name' 		=> __('Button background Color','croma'),
				'fn' 		=> 'cro_buttbg',
				'desc' 		=> __('Select color for button background','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> 'default content'
			),
			array(
				'name' 		=> __('Button Color','croma'),
				'fn' 		=> 'cro_buttcol',
				'desc' 		=> __('Select color for button','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> 'default content'
			),
			array(
				'name' 		=> __('Link','croma'),
				'fn' 		=> 'cro_laylink',
				'desc' 		=> __('Type the link','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link label','croma'),
				'fn' 		=> 'cro_laylabel',
				'desc' 		=> __('Select the button label','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> 'Read more'
			)
		)
	);



	// add the blog pagebuilder content array
	$cro_pb['cdt'] = array(
		'name' 		=> __('Countdown timer','croma'),
		'handle' 	=> 'cdt',
		'icon' 		=> 'icon-time',
		'content' 	=> array(
			array(
				'name' 		=> __('Animation','croma'),
				'fn' 		=> 'cro_anim',
				'desc' 		=> __('Add Animations ot the section','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array('none','bounce','flash','pulse','rubberBand','shake','swing','tada','wobble','bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp','bounceO','fadeInRightBig','fadeInUp','fadeInUpBig','flip','flipInX','flipInY','Lightspeed','lightSpeedIn','rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight','slideInDown','slideInLeft','slideInRight','hinge','rollIn'),
				'def' 		=> 0
			),
			array(
				'name' 		=> __('Background Color','croma'),
				'fn' 		=> 'cro_bgcolor',
				'desc' 		=> __('Select color for the mask','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> 'default content'
			),
			array(
				'name' 		=> __('Text Color','croma'),
				'fn' 		=> 'cro_textcolor',
				'desc' 		=> __('Select color for the mask','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> 'default content'
			),
			array(
				'name' 		=> __('Alternate Link','croma'),
				'fn' 		=> 'cro_laylink',
				'desc' 		=> __('Type the link ot link to if you do not want to link to the calendar post.','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link label','croma'),
				'fn' 		=> 'cro_laylabel',
				'desc' 		=> __('Select the button label','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> 'Read more'
			)
		)
	);



	// add the blog pagebuilder content array
	$cro_pb['cal'] = array(
		'name' 		=> __('Events','croma'),
		'handle' 	=> 'cal',
		'icon' 		=> 'icon-calendar',
		'content' 	=> array(
			array(
				'name' 		=> __('Animation','croma'),
				'fn' 		=> 'cro_anim',
				'desc' 		=> __('Add Animations ot the section','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array('none','bounce','flash','pulse','rubberBand','shake','swing','tada','wobble','bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp','bounceO','fadeInRightBig','fadeInUp','fadeInUpBig','flip','flipInX','flipInY','Lightspeed','lightSpeedIn','rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight','slideInDown','slideInLeft','slideInRight','hinge','rollIn'),
				'def' 		=> 0
			),
			array(
				'name' 		=> __('Title','croma'),
				'fn' 		=> 'cro_layhead',
				'desc' 		=> __('Type the title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Content 1','croma'),
				'fn' 		=> 'cro_laycnt1',
				'desc' 		=> __('Type the content','croma'),
				'type' 		=> 'textarea',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Number of events to show','croma'),
				'fn' 		=> 'cro_evtoshow',
				'desc' 		=> __('Select number of events to show','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(1,20,1),
				'def' 		=> 4
			),
			array(
				'name' 		=> __('Link','croma'),
				'fn' 		=> 'cro_laylink',
				'desc' 		=> __('Type the link or leave open','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link label','croma'),
				'fn' 		=> 'cro_laylabel',
				'desc' 		=> __('Select the button label','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> 'Read more'
			)
		)
	);



	// add the image banner pagebuilder content array
	$cro_pb['gal'] = array(
		'name' 		=> __('Gallery','croma'),
		'handle' 	=> 'gal',
		'icon' 		=> 'icon-th',
		'divider' 	=> 'no',
		'content' 	=> array(
			array(
				'name' 		=> __('Animation','croma'),
				'fn' 		=> 'cro_anim',
				'desc' 		=> __('Add Animations ot the section','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array('none','bounce','flash','pulse','rubberBand','shake','swing','tada','wobble','bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp','bounceO','fadeInRightBig','fadeInUp','fadeInUpBig','flip','flipInX','flipInY','Lightspeed','lightSpeedIn','rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight','slideInDown','slideInLeft','slideInRight','hinge','rollIn'),
				'def' 		=> 0
			),
			array(
				'name' 		=> __('Main Title','croma'),
				'fn' 		=> 'cro_maintitle',
				'desc' 		=> __('Type the Title for the section','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Gallery page','croma'),
				'fn' 		=> 'cro_galpage',
				'desc' 		=> __('Select the page containing the gallery that you want to show.','croma'),
				'type' 		=> 'pageselect',
				'options' 	=> array('page'),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Items to show','croma'),
				'fn' 		=> 'cro_toshow',
				'desc' 		=> __('Background mask','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(3,9,3),
				'def' 		=> 4
			)
		)
	);


	// add the image banner pagebuilder content array
	$cro_pb['grs'] = array(
		'name' 		=> __('Gridstack','croma'),
		'handle' 	=> 'grs',
		'icon' 		=> 'icon-tasks',
		'divider' 	=> 'no',
		'content' 	=> array(
			array(
				'name' 		=> __('Animation','croma'),
				'fn' 		=> 'cro_anim',
				'desc' 		=> __('Add Animations ot the section','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array('none','bounce','flash','pulse','rubberBand','shake','swing','tada','wobble','bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp','bounceO','fadeInRightBig','fadeInUp','fadeInUpBig','flip','flipInX','flipInY','Lightspeed','lightSpeedIn','rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight','slideInDown','slideInLeft','slideInRight','hinge','rollIn'),
				'def' 		=> 0
			),
			array(
				'name' 		=> __('Main Title','croma'),
				'fn' 		=> 'cro_maintitle',
				'desc' 		=> __('Type the Title for the section','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Content 1','croma'),
				'fn' 		=> 'cro_laycnt1',
				'desc' 		=> __('Type the content','croma'),
				'type' 		=> 'textarea',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Background Color','croma'),
				'fn' 		=> 'cro_bgcolor',
				'desc' 		=> __('Select color','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> 'default content'
			),
			array(
				'name' 		=> __('Text Color','croma'),
				'fn' 		=> 'cro_textcol',
				'desc' 		=> __('Select color','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> 'default content'
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
				'name' 		=> __('Image ','croma'),
				'fn' 		=> 'cro_gridimg1',
				'desc' 		=> __('Select image ','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Label','croma'),
				'fn' 		=> 'cro_label1',
				'desc' 		=> __('Type the swf_labelframe(name)','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link','croma'),
				'fn' 		=> 'cro_link1',
				'desc' 		=> __('Type the link address','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link target','croma'),
				'fn' 		=> 'cro_linktarg1',
				'desc' 		=> __('Open in a new or same window?','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array(__('same window','croma'),__('new window','croma')),
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
				'name' 		=> __('Image ','croma'),
				'fn' 		=> 'cro_gridimg2',
				'desc' 		=> __('Select image ','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Label','croma'),
				'fn' 		=> 'cro_label2',
				'desc' 		=> __('Type the swf_labelframe(name)','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link','croma'),
				'fn' 		=> 'cro_link2',
				'desc' 		=> __('Type the link address','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link target','croma'),
				'fn' 		=> 'cro_linktarg2',
				'desc' 		=> __('Open in a new or same window?','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array(__('same window','croma'),__('new window','croma')),
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
				'name' 		=> __('Image ','croma'),
				'fn' 		=> 'cro_gridimg3',
				'desc' 		=> __('Select image ','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Label','croma'),
				'fn' 		=> 'cro_label3',
				'desc' 		=> __('Type the swf_labelframe(name)','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link','croma'),
				'fn' 		=> 'cro_link3',
				'desc' 		=> __('Type the link address','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link target','croma'),
				'fn' 		=> 'cro_linktarg3',
				'desc' 		=> __('Open in a new or same window?','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array(__('same window','croma'),__('new window','croma')),
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
				'name' 		=> __('Image ','croma'),
				'fn' 		=> 'cro_gridimg4',
				'desc' 		=> __('Select image ','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Label','croma'),
				'fn' 		=> 'cro_label4',
				'desc' 		=> __('Type the swf_labelframe(name)','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link','croma'),
				'fn' 		=> 'cro_link4',
				'desc' 		=> __('Type the link address','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link target','croma'),
				'fn' 		=> 'cro_linktarg4',
				'desc' 		=> __('Open in a new or same window?','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array(__('same window','croma'),__('new window','croma')),
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
				'name' 		=> __('Image ','croma'),
				'fn' 		=> 'cro_gridimg5',
				'desc' 		=> __('Select image ','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Label','croma'),
				'fn' 		=> 'cro_label5',
				'desc' 		=> __('Type the swf_labelframe(name)','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link','croma'),
				'fn' 		=> 'cro_link5',
				'desc' 		=> __('Type the link address','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link target','croma'),
				'fn' 		=> 'cro_linktarg5',
				'desc' 		=> __('Open in a new or same window?','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array(__('same window','croma'),__('new window','croma')),
				'def' 		=> 0
			),
		)
	);



	// add the image banner pagebuilder content array
	$cro_pb['img'] = array(
		'name' 		=> __('Image Banner','croma'),
		'handle' 	=> 'img',
		'icon' 		=> 'icon-picture',
		'divider' 	=> 'no',
		'content' 	=> array(
			array(
				'name' 		=> __('Animation','croma'),
				'fn' 		=> 'cro_anim',
				'desc' 		=> __('Add Animations ot the section','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array('none','bounce','flash','pulse','rubberBand','shake','swing','tada','wobble','bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp','bounceO','fadeInRightBig','fadeInUp','fadeInUpBig','flip','flipInX','flipInY','Lightspeed','lightSpeedIn','rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight','slideInDown','slideInLeft','slideInRight','hinge','rollIn'),
				'def' 		=> 0
			),
			array(
					'name' 		=> __('Background Color','croma'),
					'fn' 		=> 'cro_maskcolor',
					'desc' 		=> __('Select color for the mask','croma'),
					'type' 		=> 'colorpicker',
					'options' 	=> array(),
					'def' 		=> '#E4E4E4'
			),
			array(
				'name' 		=> __('First banner','croma'),
				'fn' 		=> 'cro_banimg1',
				'desc' 		=> __('Left fullheight banner image','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Title','croma'),
				'fn' 		=> 'cro_title1',
				'desc' 		=> __('Type the title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Sub-title','croma'),
				'fn' 		=> 'cro_subtitle1',
				'desc' 		=> __('Type the sub-title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link','croma'),
				'fn' 		=> 'cro_link1',
				'desc' 		=> __('Type the link address','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link target','croma'),
				'fn' 		=> 'cro_linktarg1',
				'desc' 		=> __('Open in a new or same window?','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array(__('same window','croma'),__('new window','croma')),
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
				'name' 		=> __('Second banner','croma'),
				'fn' 		=> 'cro_banimg2',
				'desc' 		=> __('Left half height banner image','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Title','croma'),
				'fn' 		=> 'cro_title2',
				'desc' 		=> __('Type the title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Sub-title','croma'),
				'fn' 		=> 'cro_subtitle2',
				'desc' 		=> __('Type the sub-title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link','croma'),
				'fn' 		=> 'cro_link2',
				'desc' 		=> __('Type the link address','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link target','croma'),
				'fn' 		=> 'cro_linktarg2',
				'desc' 		=> __('Open in a new or same window?','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array(__('same window','croma'),__('new window','croma')),
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
				'name' 		=> __('Third banner','croma'),
				'fn' 		=> 'cro_banimg3',
				'desc' 		=> __('Center fullheight banner image','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Title','croma'),
				'fn' 		=> 'cro_title3',
				'desc' 		=> __('Type the title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Sub-title','croma'),
				'fn' 		=> 'cro_subtitle3',
				'desc' 		=> __('Type the sub-title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link','croma'),
				'fn' 		=> 'cro_link3',
				'desc' 		=> __('Type the link address','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link target','croma'),
				'fn' 		=> 'cro_linktarg3',
				'desc' 		=> __('Open in a new or same window?','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array(__('same window','croma'),__('new window','croma')),
				'def' 		=> 0
			)
		)
	);


	// add the blog pagebuilder content array
	$cro_pb['pag'] = array(
		'name' 		=> __('Page Content','croma'),
		'handle' 	=> 'pag',
		'icon' 		=> 'icon-paste',
		'content' 	=> array(
			array(
				'name' 		=> __('Animation','croma'),
				'fn' 		=> 'cro_anim',
				'desc' 		=> __('Add Animations ot the section','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array('none','bounce','flash','pulse','rubberBand','shake','swing','tada','wobble','bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp','bounceO','fadeInRightBig','fadeInUp','fadeInUpBig','flip','flipInX','flipInY','Lightspeed','lightSpeedIn','rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight','slideInDown','slideInLeft','slideInRight','hinge','rollIn'),
				'def' 		=> 0
			),
			array(
				'name' 		=> __('Page to show','croma'),
				'fn' 		=> 'cro_laycat',
				'desc' 		=> __('Select the page to show','croma'),
				'type' 		=> 'pageselect',
				'options' 	=> array('page'),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Title','croma'),
				'fn' 		=> 'cro_layhead1',
				'desc' 		=> __('Type the title','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			)
		)
	);


	if (class_exists('RevSlider')) {

			// add the layerslider pagebuilder content array
		$cro_pb['sli'] = array(
			'name' 		=> __('Revolution slider','croma'),
			'handle' 	=> 'sli',
			'icon' 		=> 'icon-laptop',
			'divider' 	=> 'no',
			'content' 	=> array(
				array(
					'name' 		=> __('Select slider','croma'),
					'fn' 		=> 'cro_laytarget1',
					'desc' 		=> __('Select the Layerslider to show','croma'),
					'type' 		=> 'selectslider',
					'options' 	=> array(),
					'def' 		=> ''
				)
			)
		);

	}

	// add the text over image pagebuilder content array
	$cro_pb['ctb'] = array(
		'name' 		=> __('Text over image','croma'),
		'handle' 	=> 'ctb',
		'icon' 		=> 'icon-gift',
		'content' 	=> array(
			array(
				'name' 		=> __('Animation','croma'),
				'fn' 		=> 'cro_anim',
				'desc' 		=> __('Add Animations ot the section','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array('none','bounce','flash','pulse','rubberBand','shake','swing','tada','wobble','bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp','bounceO','fadeInRightBig','fadeInUp','fadeInUpBig','flip','flipInX','flipInY','Lightspeed','lightSpeedIn','rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight','slideInDown','slideInLeft','slideInRight','hinge','rollIn'),
				'def' 		=> 0
			),
			array(
				'name' 		=> __('Background Image','croma'),
				'fn' 		=> 'cro_layimage',
				'desc' 		=> __('Select floating image for the layout or leave open if this section must not have a floating image','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Mask','croma'),
				'fn' 		=> 'cro_laymask',
				'desc' 		=> __('% mask for the image','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(0,100,1),
				'def' 		=> 0
			),
			array(
				'name' 		=> __('Mask Color','croma'),
				'fn' 		=> 'cro_maskcolor',
				'desc' 		=> __('Select color for the mask','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> 'default content'
			),
			array(
				'name' 		=> __('Title','croma'),
				'fn' 		=> 'cro_laytitle',
				'desc' 		=> __('Select the title for the section','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Content','croma'),
				'fn' 		=> 'cro_laydesc',
				'desc' 		=> __('Select description','croma'),
				'type' 		=> 'textarea',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link','croma'),
				'fn' 		=> 'cro_laylink',
				'desc' 		=> __('Select the address to link','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Link label','croma'),
				'fn' 		=> 'cro_laylabel',
				'desc' 		=> __('Select the label of the "readmore" button','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Text Color','croma'),
				'fn' 		=> 'cro_laytxtcolor',
				'desc' 		=> __('Select text color for the layout','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> 'default content'
			)			
		)
	);


	if ( in_array( 'cromax/cromax.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	// add the portfolio pagebuilder content array


	// add the twitter pagebuilder content array
	$cro_pb['twi'] = array(
		'name' 		=> __('Twitter','croma'),
		'handle' 	=> 'twi',
		'icon' 		=> 'icon-twitter',
		'content' 	=> array(
			array(
				'name' 		=> __('Animation','croma'),
				'fn' 		=> 'cro_anim',
				'desc' 		=> __('Add Animations ot the section','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array('none','bounce','flash','pulse','rubberBand','shake','swing','tada','wobble','bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp','bounceO','fadeInRightBig','fadeInUp','fadeInUpBig','flip','flipInX','flipInY','Lightspeed','lightSpeedIn','rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight','slideInDown','slideInLeft','slideInRight','hinge','rollIn'),
				'def' 		=> 0
			),
			array(
				'name' 		=> __('Background Image','croma'),
				'fn' 		=> 'cro_layimage',
				'desc' 		=> __('Select floating image for the layout or leave open if this section must not have a floating image','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
					'name' 		=> __('Title','croma'),
					'fn' 		=> 'cro_pagetitle',
					'desc' 		=> __('Section Title','croma'),
					'type' 		=> 'input',
					'options' 	=> array(),
					'def' 		=> ''
			),
			array(
					'name' 		=> __('Mask','croma'),
					'fn' 		=> 'cro_laymask',
					'desc' 		=> __('% mask for the image','croma'),
					'type' 		=> 'uislider',
					'options' 	=> array(0,100,1),
					'def' 		=> 0
			),
			array(
					'name' 		=> __('Mask Color','croma'),
					'fn' 		=> 'cro_maskcolor',
					'desc' 		=> __('Select color for the mask','croma'),
					'type' 		=> 'colorpicker',
					'options' 	=> array(),
					'def' 		=> 'default content'
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
					'name' 		=> __('Number tweets','croma'),
					'fn' 		=> 'cro_numtweets',
					'desc' 		=> __('Number of tweets','croma'),
					'type' 		=> 'uislider',
					'options' 	=> array(1,10,1),
					'def' 		=> 1
			),	
			array(
					'name' 		=> __('Twitter username','croma'),
					'fn' 		=> 'cro_twitname',
					'desc' 		=> __('Twitter username without the @','croma'),
					'type' 		=> 'input',
					'options' 	=> array(),
					'def' 		=> ''
			),
			array(
					'name' 		=> __('Consumer key','croma'),
					'fn' 		=> 'cro_conskey',
					'desc' 		=> __('Add the twitter consumer key','croma'),
					'type' 		=> 'input',
					'options' 	=> array(),
					'def' 		=> ''
			),
			array(
					'name' 		=> __('Consumer Secret','croma'),
					'fn' 		=> 'cro_consecr',
					'desc' 		=> __('Add the twitter consumer secret','croma'),
					'type' 		=> 'input',
					'options' 	=> array(),
					'def' 		=> ''
			),
			array(
					'name' 		=> __('Access token','croma'),
					'fn' 		=> 'cro_acctoken',
					'desc' 		=> __('Add the twitter access token','croma'),
					'type' 		=> 'input',
					'options' 	=> array(),
					'def' 		=> ''
			),	
			array(
					'name' 		=> __('Access secret','croma'),
					'fn' 		=> 'cro_accsecr',
					'desc' 		=> __('Add the twitter access token secret','croma'),
					'type' 		=> 'input',
					'options' 	=> array(),
					'def' 		=> ''
			),
			array(
					'name' 		=> __('Follow label','croma'),
					'fn' 		=> 'cro_follabel',
					'desc' 		=> __('Add the twitter follow label','croma'),
					'type' 		=> 'input',
					'options' 	=> array(),
					'def' 		=> ''
			)
		)
	);
	}



	// add the blog pagebuilder content array
	$cro_pb['wel'] = array(
		'name' 		=> __('Welcome Message','croma'),
		'handle' 	=> 'wel',
		'icon' 		=> 'icon-bullhorn',
		'content' 	=> array(
			array(
				'name' 		=> __('Image','croma'),
				'fn' 		=> 'cro_layimage',
				'desc' 		=> __('Select image for the welcome message','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Main title','croma'),
				'fn' 		=> 'cro_subtitle',
				'desc' 		=> __('Type the subtitle for the section','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Sub title','croma'),
				'fn' 		=> 'cro_maintitle',
				'desc' 		=> __('Type the Title for the section','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Welcome Message','croma'),
				'fn' 		=> 'cro_laypage',
				'desc' 		=> __('Select the page that holds your welcome message','croma'),
				'type' 		=> 'pageselect',
				'options' 	=> array('page'),
				'def' 		=> ''
			)
		)
	);


	return apply_filters( 'cromatic_pbuilder_layouts', $cro_pb );
}



// add the theme options builder arrays
function cromatic_theme_options() {

	// build the general and logo options arrays.
	$cro_to['gen'] = array(
		'name' 		=> __('General & Logo','croma'),
		'handle' 	=> 'gen',
		'icon' 		=> 'icon-edit',
		'content' 	=> array(
			array(
				'name' 		=> __('Header type','croma'),
				'fn' 		=> 'cro_headtype',
				'desc' 		=> __('Type of header','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array(__('Minimal','croma'),__('Standard','croma')),
				'def' 		=> 1
			),
			array(
				'name' 		=> __('Standard header background','croma'),
				'fn' 		=> 'cro_hedcolor',
				'desc' 		=> __('Background for the standard header. The minimal header has no background','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> '#F99F55'
			),
			array(
				'name' 		=> __('Main Color','croma'),
				'fn' 		=> 'cro_maincolor',
				'desc' 		=> __('Select main color','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> '#F99F55'
			),
			array(
				'name' 		=> __('Main Font','croma'),
				'fn' 		=> 'cro_mainfont',
				'desc' 		=> __('Select main font','croma'),
				'type' 		=> 'fontlist',
				'options' 	=> array(),
				'def' 		=> 'Oswald'
			),
			array(
				'name' 		=> __('Logo','croma'),
				'fn' 		=> 'cro_logoimg',
				'desc' 		=> __('Select the logo image','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Logo paddding top','croma'),
				'fn' 		=> 'cro_logopadtop',
				'desc' 		=> __('Padding above the logo','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(0,100,1),
				'def' 		=> 0
			),
			array(
				'name' 		=> __('Logo paddding bottom','croma'),
				'fn' 		=> 'cro_logopadbottom',
				'desc' 		=> __('Padding below the logo','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(0,100,1),
				'def' 		=> 0
			)
		)
	);


	// build the navigation options arrays.
	$cro_to['nav'] = array(
		'name' 		=> __('Navigation','croma'),
		'handle' 	=> 'nav',
		'icon' 		=> 'icon-list',
		'content' 	=> array(
			array(
				'name' 		=> __('Menu Font','croma'),
				'fn' 		=> 'cro_menufont',
				'desc' 		=> __('Select menu font','croma'),
				'type' 		=> 'fontlist',
				'options' 	=> array(),
				'def' 		=> 'Oswald'
			),
			array(
				'name' 		=> __('Menu Font Size','croma'),
				'fn' 		=> 'cro_fontsize',
				'desc' 		=> __('Font Size for the main menu','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(1,50,1),
				'def' 		=> 12
			),
			array(
				'name' 		=> __('Responsive After','croma'),
				'fn' 		=> 'cro_menresponsive',
				'desc' 		=> __('"switch to responsive menu" width. If the screen is smaller than this width the responsive menu will be added.','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(10,1300,10),
				'def' 		=> 12
			),
			array(
				'name' 		=> __('Main menu Background','croma'),
				'fn' 		=> 'cro_mainmenbg',
				'desc' 		=> __('Select main menu background','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> '#F99F55'
			),
			array(
				'name' 		=> __('Main menu color','croma'),
				'fn' 		=> 'cro_mainmencol',
				'desc' 		=> __('Select main menu color (give online in the demo)','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> '#F99F55'
			),
			array(
				'name' 		=> __('Colored Button Background','croma'),
				'fn' 		=> 'cro_submenbg',
				'desc' 		=> __('Select colored button background (give online in the demo)','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> '#F99F55'
			),
			array(
				'name' 		=> __('Colored Button color','croma'),
				'fn' 		=> 'cro_submencol',
				'desc' 		=> __('Select colored button color (give online in the demo)','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> '#F99F55'
			),
			array(
				'name' 		=> __('Menu next to logo Padding top','croma'),
				'fn' 		=> 'cro_subpadding',
				'desc' 		=> __('Top padding for the menu right next to the logo (showing the church times in the demo)','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(1,70,1),
				'def' 		=> 55
			),
		)
	);


	// build the topbar options arrays.
	$cro_to['topb'] = array(
		'name' 		=> __('Top Bar','croma'),
		'handle' 	=> 'topb',
		'icon' 		=> 'icon-arrow-up',
		'content' 	=> array(
			array(
				'name' 		=> __('Top bar','croma'),
				'fn' 		=> 'cro_topb',
				'desc' 		=> __('Activate or De-activate the topbar','croma'),
				'type' 		=> 'yesno',
				'options' 	=> array(__('Yes','croma'),__('No','croma')),
				'def' 		=> 1
			),
			array(
				'name' 		=> __('Top Bar Background','croma'),
				'fn' 		=> 'cro_secondbg',
				'desc' 		=> __('Select top bar background','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> '#F99F55'
			),
			array(
				'name' 		=> __('Top Bar color','croma'),
				'fn' 		=> 'cro_secondcol',
				'desc' 		=> __('Select top bar color','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> '#F99F55'
			),
			array(
				'name' 		=> __('Top Bar text','croma'),
				'fn' 		=> 'cro_topbartext',
				'desc' 		=> __('Select the top bar left text','croma'),
				'type' 		=> 'textarea',
				'options' 	=> array(),
				'def' 		=> ''
			)

		),

	);

	
	// build the topbar options arrays.
	$cro_to['homp'] = array(
		'name' 		=> __('Home Page','croma'),
		'handle' 	=> 'homp',
		'icon' 		=> 'icon-home',
		'content' 	=> array(
			array(
				'name' 		=> __('Header Font','croma'),
				'fn' 		=> 'cro_headfont',
				'desc' 		=> __('Select header font','croma'),
				'type' 		=> 'fontlist',
				'options' 	=> array(),
				'def' 		=> 'Lato|900|latin'
			),
			array(
				'name' 		=> __('Body Font','croma'),
				'fn' 		=> 'cro_bodyfont',
				'desc' 		=> __('Select body font','croma'),
				'type' 		=> 'fontlist',
				'options' 	=> array(),
				'def' 		=> 'Lato|regular|latin'
			)

		),

	);



	// build the topbar options arrays.
	$cro_to['soci'] = array(
		'name' 		=> __('Social','croma'),
		'handle' 	=> 'soci',
		'icon' 		=> 'icon-thumbs-up',
		'content' 	=> array(
			array(
				'name' 		=> __('Facebook','croma'),
				'fn' 		=> 'cro_facebook',
				'desc' 		=> __('Select the link to your profile','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Twitter','croma'),
				'fn' 		=> 'cro_twitter',
				'desc' 		=> __('Select the link to your profile','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Linkedin','croma'),
				'fn' 		=> 'cro_linkedin',
				'desc' 		=> __('Select the link to your profile','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Flickr','croma'),
				'fn' 		=> 'cro_flickr',
				'desc' 		=> __('Select the link to your profile','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Foursquare','croma'),
				'fn' 		=> 'cro_foursquare',
				'desc' 		=> __('Select the link to your profile','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Instagram','croma'),
				'fn' 		=> 'cro_instagram',
				'desc' 		=> __('Select the link to your profile','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Googleplus','croma'),
				'fn' 		=> 'cro_googleplus',
				'desc' 		=> __('Select the link to your profile','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Pinterest','croma'),
				'fn' 		=> 'cro_pinterest',
				'desc' 		=> __('Select the link to your profile','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Youtube','croma'),
				'fn' 		=> 'cro_youtube',
				'desc' 		=> __('Select the link to your profile','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			)
		),

	);

		
	// build the topbar options arrays.
	$cro_to['hdr'] = array(
		'name' 		=> __('Header','croma'),
		'handle' 	=> 'headr',
		'icon' 		=> 'icon-picture',
		'content' 	=> array(
			array(
				'name' 		=> __('Header Image','croma'),
				'fn' 		=> 'cro_headimg',
				'desc' 		=> __('Select the header default image for inner pages','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Header image tiling','croma'),
				'fn' 		=> 'cro_imgtile',
				'desc' 		=> __('Type of tiling for the header image','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array(__('Tile vertical and horizontal','croma'),__('Tile vertical','croma'),__('Tile Horizontal','croma'), __('Stretch over the area','croma'),  __('no tiling','croma')),
				'def' 		=> 1
			),
			array(
				'name' 		=> __('Header height','croma'),
				'fn' 		=> 'cro_headheight',
				'desc' 		=> __('Height of the headerspace','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(140,600,10),
				'def' 		=> 140
			),
			array(
				'name' 		=> __('Text color','croma'),
				'fn' 		=> 'cro_headtextcol',
				'desc' 		=> __('Select header text color','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> '#000'
			),
			array(
				'name' 		=> __('Mask color','croma'),
				'fn' 		=> 'cro_headmaskcol',
				'desc' 		=> __('Select header mask color','croma'),
				'type' 		=> 'colorpicker',
				'options' 	=> array(),
				'def' 		=> '#000'
			),
			array(
				'name' 		=> __('Header mask','croma'),
				'fn' 		=> 'cro_headmask',
				'desc' 		=> __('Percentage of mask to apply','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(0,100,1),
				'def' 		=> 0
			)
		)
	);


	// build the favicon options arrays.		
	$cro_to['fav'] = array(
		'name' 		=> __('Favicon','croma'),
		'handle' 	=> 'fav',
		'icon' 		=> 'icon-bell-alt',
		'content' 	=> array(
			array(
				'name' 		=> __('Desktop Favicon','croma'),
				'fn' 		=> 'cro_favicon0',
				'desc' 		=> __('Select tHe favicon file for desktop browsers (16pixels x 16pixels) ico format','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('IOS 76px icon','croma'),
				'fn' 		=> 'cro_favicon76',
				'desc' 		=> __('IOS 76px x 76px icon in png format','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('IOS retina 120px icon','croma'),
				'fn' 		=> 'cro_favicon120',
				'desc' 		=> __('IOS 120px x 120px icon in png format','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('IOS retina 152px icon','croma'),
				'fn' 		=> 'cro_favicon152',
				'desc' 		=> __('IOS 152px x 152px icon in png format','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('WIN8 retina 144px icon','croma'),
				'fn' 		=> 'cro_favicon144',
				'desc' 		=> __('IOS 144px x 144px icon in png format','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('IE11 retina 70px icon','croma'),
				'fn' 		=> 'cro_favicon70',
				'desc' 		=> __('IOS 70px x 70px icon in png format','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('IE11 retina 150px icon','croma'),
				'fn' 		=> 'cro_favicon150',
				'desc' 		=> __('IOS 150px x 150px icon in png format','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('IE11 retina 310px icon','croma'),
				'fn' 		=> 'cro_favicon310',
				'desc' 		=> __('IOS 310px x 310px icon in png format','croma'),
				'type' 		=> 'imagemanager',
				'options' 	=> array(),
				'def' 		=> ''
			)
		)
	);


	// build the utilities options arrays.		
	$cro_to['uti'] = array(
		'name' 		=> __('Utilities','croma'),
		'handle' 	=> 'uti',
		'icon' 		=> 'icon-wrench',
		'content' 	=> array(
			array(
				'name' 		=> __('Google analytics','croma'),
				'fn' 		=> 'cro_analyticscode',
				'desc' 		=> __('Add your google analytics code here','croma'),
				'type' 		=> 'textarea',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Additional style rules','croma'),
				'fn' 		=> 'cro_stylerules',
				'desc' 		=> __('Add your additional style rules here','croma'),
				'type' 		=> 'textarea',
				'options' 	=> array(),
				'def' 		=> ''
			),
		)
	);




	// build the blog options arrays.		
	$cro_to['blg'] = array(
		'name' 		=> __('Blog','croma'),
		'handle' 	=> 'blg',
		'icon' 		=> 'icon-bold',
		'content' 	=> array(
			array(
				'name' 		=> __('Excerpt Length','croma'),
				'fn' 		=> 'cro_excptlngth',
				'desc' 		=> __('Excerpt length','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(5,55,1),
				'def' 		=> 5
			),
			array(
				'name' 		=> __('Category sidebars','croma'),
				'fn' 		=> 'cro_catsidebar',
				'desc' 		=> __('Sedebar setup for the categories','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array(__('Sidebar left','croma'),__('Fullwidth','croma'),__('sidebar right','croma')),
				'def' 		=> 1
			),
		)
	);




	// build the blog options arrays.		
	$cro_to['ppl'] = array(
		'name' 		=> __('Paypal','croma'),
		'handle' 	=> 'ppl',
		'icon' 		=> 'icon-shopping-cart',
		'content' 	=> array(
			array(
				'name' 		=> __('Paypal API username','croma'),
				'fn' 		=> 'cro_paypaluser',
				'desc' 		=> __('Set the Paypal API username','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Paypal API password','croma'),
				'fn' 		=> 'cro_paypalpass',
				'desc' 		=> __('Set the Paypal API password','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Paypal API signature','croma'),
				'fn' 		=> 'cro_paypalsig',
				'desc' 		=> __('Set the Paypal API signature','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Paypal Currency','croma'),
				'fn' 		=> 'cro_paypalcurr',
				'desc' 		=> __('Set the Paypal payment currency','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array('AUD','BLR','CAD','CZK','DKK','EUR','HKD','HUF','ILS','JPY','MYR','MXN','NOK','NZD','PHP','PLN','GBP','RUB','SGD','SEK','CHF','TWD','THB','TRY','USD'),
				'def' 		=> 'USD'
			),
			array(
				'name' 		=> __('Paypal email recipient','croma'),
				'fn' 		=> 'cro_paypalmail',
				'desc' 		=> __('Set the recipient for paypal emails','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Paypal success page','croma'),
				'fn' 		=> 'cro_paysucc',
				'desc' 		=> __('Select the Paypal success page.','croma'),
				'type' 		=> 'pageselect',
				'options' 	=> array('page'),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Paypal failure page','croma'),
				'fn' 		=> 'cro_payfail',
				'desc' 		=> __('Select the Paypal failure page.','croma'),
				'type' 		=> 'pageselect',
				'options' 	=> array('page'),
				'def' 		=> ''
			),
			array(
				'name' 		=> __('Paypal mode','croma'),
				'fn' 		=> 'cro_paypalmode',
				'desc' 		=> __('Select the paypal mode','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array(__('Sandbox','croma'),__('Live','croma')),
				'def' 		=> 1
			),
			array(
				'name' 		=> __('Currency sign','croma'),
				'fn' 		=> 'cro_currsign',
				'desc' 		=> __('Select the sign for your currency','croma'),
				'type' 		=> 'input',
				'options' 	=> array(),
				'def' 		=> '$'
			),
			array(
				'name' 		=> __('Currency Position','croma'),
				'fn' 		=> 'cro_currpos',
				'desc' 		=> __('Position of the currency sign','croma'),
				'type' 		=> 'selectlist',
				'options' 	=> array(__('before','croma'),__('after','croma')),
				'def' 		=> 1
			),
			array(
				'name' 		=> __('Global Minimum','croma'),
				'fn' 		=> 'cro_globalmin',
				'desc' 		=> __('Global minimum value','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(1,1000000,1),
				'def' 		=> 1
			),
			array(
				'name' 		=> __('Global Maximum','croma'),
				'fn' 		=> 'cro_globalmax',
				'desc' 		=> __('Global maximum value','croma'),
				'type' 		=> 'uislider',
				'options' 	=> array(1,1000000,1),
				'def' 		=> 1000
			),		
		)
	);


	// build the help options arrays.		
	$cro_to['inf'] = array(
		'name' 		=> __('Help','croma'),
		'handle' 	=> 'inf',
		'icon' 		=> 'icon-dashboard',
		'content' 	=> array(
			array(
				'name' 		=> __('Help Section','croma'),
				'fn' 		=> 'cro_favicon310',
				'desc' 		=> __('Help section','croma'),
				'type' 		=> 'help',
				'options' 	=> array(),
				'def' 		=> ''
			)			
		)
	);

	return apply_filters( 'cromatic_theme_options', $cro_to );
}




?>