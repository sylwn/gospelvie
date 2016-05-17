<?php
/**
* Cromax metaboxes file
* 
*
* @package Cromax
* @category Core
* @author Croma
*/




/**
 * Metabox Layouts
 *
 * @access public
 * @return void
 */



 
function cromax_define_meta_layouts() {
	$cromax_metas = array(
		array(
			'tab' 				=> '0',
			'tabname' 			=> __('General', 'croma'),
			'type'				=> 'page',
			'title'				=> __('Page builder', 'croma'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'values' 			=> array(	

				array(		
					'type' 		=> 'pagebuilder',
					'fn' 		=> 'cro_pagebuilder',
					'heading'	=> __('Page Builder', 'croma'),
					'options'	=> '',
					'desc'		=> __('Pagebuilder','croma')
				)														
			)				
		),
		array(
			'tab' 				=> '0',
			'tabname' 			=> __('General', 'croma'),
			'type'				=> 'post',
			'title'				=> __('Page builder', 'croma'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'values' 			=> array(	

				array(		
					'type' 		=> 'pagebuilder',
					'fn' 		=> 'cro_pagebuilder',
					'heading'	=> __('Page Builder', 'croma'),
					'options'	=> '',
					'desc'		=> __('Pagebuilder','croma')
				)														
			)				
		),

	);

	return apply_filters( 'cromax_define_meta_layouts',$cromax_metas );
}


 
function cromax_define_pagebuilder_parts() {


	$croma = get_option('cromatic');


	$cromax_pb = array(
		array(
			'short' 			=> 'acc',
			'tabname' 			=> __('Accordion', 'croma'),
			'icon' 				=> 'icon-sign-blank',
			'type'				=> 'cromax_accordionblock',
			'title'				=> __('Accordion', 'croma'),
			'values' 			=> array(

				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_title',
					'help'		=> __('Title for the featured block','croma'),
					'name' 		=> __('Title','croma')
				),
				array(
					'type' 		=> 'tabbuilder',
					'fn' 		=> 'cro_meta_tabbuilder',
					'help'		=> __('Accordion component builder','croma'),
					'name' 		=> __('Accordions','croma')
				)														
			)				
		),
		array(
			'short' 			=> 'cal',
			'tabname' 			=> __('Calendar', 'croma'),
			'icon' 				=> 'icon-sign-blank',
			'type'				=> 'cromax_calblock',
			'title'				=> __('Calendar', 'croma'),
			'values' 			=> array(	
				array(
					'type' 		=> 'select',
					'fn' 		=> 'cro_caltype',
					'help'		=> __('Type of Calendar ot add','croma'),
					'name' 		=> __('Type of Calendar ot add','croma'),
					'options' 	=> array(__('Calendar','croma'), __('Agenda Calendar','croma'), '2 ' . __('Upcoming Events','croma'), '4 ' . __('Upcoming Events','croma'), '6 ' . __('Upcoming Events','croma'), '8 ' . __('Upcoming Events','croma'), '10 ' . __('Upcoming Events','croma'),  '12 ' . __('Upcoming Events','croma'))
				),
				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_title',
					'help'		=> __('Text for the title','croma'),
					'name' 		=> __('Title','croma')
				),
				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_label',
					'help'		=> __('Text for the button','croma'),
					'name' 		=> __('Button Label text','croma')
				),	
				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_link',
					'help'		=> __('Button link','croma'),
					'name' 		=> __('Link the button','croma')
				),
				array(
					'type' 		=> 'color',
					'fn' 		=> 'cro_meta_col',
					'help'		=> __('Button text color','croma'),
					'name' 		=> __('Button text color','croma'),
					'def' 		=> '#272727'
				),
				array(
					'type' 		=> 'color',
					'fn' 		=> 'cro_meta_bgcol',
					'help'		=> __('Button background color','croma'),
					'name' 		=> __('Button background color','croma'),
					'def' 		=> '#FBF9FA'
				)													
			)				
		),
		array(
			'short' 			=> 'cta',
			'tabname' 			=> __('Call to action', 'croma'),
			'icon' 				=> 'icon-sign-blank',
			'type'				=> 'cromax_ctablock',
			'title'				=> __('Call ot action', 'croma'),
			'values' 			=> array(

				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_title',
					'help'		=> __('Text for the call to action','croma'),
					'name' 		=> __('Title','croma')
				),
				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_label',
					'help'		=> __('Text for the button','croma'),
					'name' 		=> __('Button Label text','croma')
				),
				array(
					'type' 		=> 'color',
					'fn' 		=> 'cro_meta_col',
					'help'		=> __('text color','croma'),
					'name' 		=> __('Text color','croma'),
					'def' 		=> '#272727'
				),
				array(
					'type' 		=> 'color',
					'fn' 		=> 'cro_meta_bgcol',
					'help'		=> __('Background color','croma'),
					'name' 		=> __('Background color','croma'),
					'def' 		=> '#FBF9FA'
				),	
				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_link',
					'help'		=> __('Call to action link','croma'),
					'name' 		=> __('Link the call to action','croma')
				),	
				array(
					'type' 		=> 'select',
					'fn' 		=> 'cro_link_target',
					'help'		=> __('Link Target','croma'),
					'name' 		=> __('Link Target','croma'),
					'options' 	=> array(__('Open in....','croma'), __('Same window','croma'),__('New window','croma'))
				)														
			)				
		),
		array(
			'short' 			=> 'ctc',
			'tabname' 			=> __('Contacts', 'croma'),
			'icon' 				=> 'icon-sign-blank',
			'type'				=> 'cromax_contactsblock',
			'title'				=> __('Contacts', 'croma'),
			'values' 			=> array(

				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_title',
					'help'		=> __('Title for the contacts block','croma'),
					'name' 		=> __('Title','croma')
				),
				array(
					'type' 		=> 'tabbuilder',
					'fn' 		=> 'cro_meta_ctcbuilder',
					'help'		=> __('Contact component builder','croma'),
					'name' 		=> __('Details','croma')
				)														
			)				
		),
		
		array(
			'short' 			=> 'dir',
			'tabname' 			=> __('Directions', 'croma'),
			'icon' 				=> 'icon-sign-blank',
			'type'				=> 'cromax_directionsblock',
			'title'				=> __('Directions', 'croma'),
			'values' 			=> array(

				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_title',
					'help'		=> __('Address for Driving Directions','croma'),
					'name' 		=> __('Address','croma')
				),
				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_lattitude',
					'help'		=> __('Overwrite if needed (see helpfile)','croma'),
					'name' 		=> __('Lattitude overwrite','croma')
				),
				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_longitude',
					'help'		=> __('Overwrite if needed (see helpfile)','croma'),
					'name' 		=> __('Longitude overwrite','croma')
				)													
			)				
		),
		array(
			'short' 			=> 'ftb',
			'tabname' 			=> __('Featured Box', 'croma'),
			'icon' 				=> 'icon-sign-blank',
			'type'				=> 'cromax_featureblock',
			'title'				=> __('Feature box with image or icon', 'croma'),
			'values' 			=> array(

				array(
					'type' 		=> 'image',
					'fn' 		=> 'cro_meta_image',
					'help'		=> __('background image for the block','croma'),
					'name' 		=> __('Featured image','croma')
				),
				array(
					'type' 		=> 'icon',
					'fn' 		=> 'cro_meta_icon',
					'help'		=> __('Icon to use','croma'),
					'name' 		=> __('Icon','croma')
				),
				array(
					'type' 		=> 'color',
					'fn' 		=> 'cro_meta_color',
					'help'		=> __('Icon image color','croma'),
					'name' 		=> __('Icon Color','croma'),
					'def' 		=> '#ffffff'
				),
				array(
					'type' 		=> 'color',
					'fn' 		=> 'cro_meta_bgcol',
					'help'		=> __('background color for the icon','croma'),
					'name' 		=> __('Icon Background','croma'),
					'def' 		=> '#272727'
				),
				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_title',
					'help'		=> __('Title for the featured block','croma'),
					'name' 		=> __('Title','croma')
				),
				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_subtitle',
					'help'		=> __('Sub Title for the featured block','croma'),
					'name' 		=> __('Subtitle','croma')
				),
				array(
					'type' 		=> 'textarea',
					'fn' 		=> 'cro_meta_content',
					'help'		=> __('content for the featured block','croma'),
					'name' 		=> __('Content','croma')
				),
				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_link',
					'help'		=> __('Address to link to','croma'),
					'name' 		=> __('Link address','croma')
				),
				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_label',
					'help'		=> __('Link label','croma'),
					'name' 		=> __('Link label','croma')
				),
				array(
					'type' 		=> 'select',
					'fn' 		=> 'cro_link_target',
					'help'		=> __('Link Target','croma'),
					'name' 		=> __('Link Target','croma'),
					'options' 	=> array(__('Open in....','croma'), __('Same window','croma'),__('New window','croma'))
				)															
			)				
		),
		array(
			'short' 			=> 'frm',
			'tabname' 			=> __('Form', 'croma'),
			'icon' 				=> 'icon-sign-blank',
			'type'				=> 'cromax_formblock',
			'title'				=> __('Form with the Contact form 7 plugin', 'croma'),
			'values' 			=> array(



				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_title',
					'help'		=> __('Title for the form','croma'),
					'name' 		=> __('Title','croma')
				),
				array(
					'type' 		=> 'postselect',
					'fn' 		=> 'cro_meta_frmselect',
					'help'		=> __('Form to select','croma'),
					'name' 		=> __('From','croma'),
					'options' 	=> array('wpcf7_contact_form')
				)														
			)				
		),
		array(
			'short' 			=> 'giv',
			'tabname' 			=> __('Give Online', 'croma'),
			'icon' 				=> 'icon-sign-blank',
			'type'				=> 'cromax_giveonline',
			'title'				=> __('Give Online', 'croma'),
			'values' 			=> array(

				array(
					'type' 		=> 'uislider',
					'fn' 		=> 'cro_min_ammt',
					'help'		=> __('Minimum amount','croma'),
					'name' 		=> __('Minimum amount','croma'),
					'options' 	=> array(1,$croma['cro_globalmin'],1),
					'def' 		=> '5'
				),
				array(
					'type' 		=> 'uislider',
					'fn' 		=> 'cro_max_ammt',
					'help'		=> __('Maximum amount','croma'),
					'name' 		=> __('Maximum amount','croma'),
					'options' 	=> array(5,$croma['cro_globalmax'],5),
					'def' 		=> '500'
				),	
				array(
					'type' 		=> 'uislider',
					'fn' 		=> 'cro_def_ammt',
					'help'		=> __('Default amount','croma'),
					'name' 		=> __('Default amount','croma'),
					'options' 	=> array(1,$croma['cro_globalmax'],1),
					'def' 		=> '30'
				),
				array(
					'type' 		=> 'uislider',
					'fn' 		=> 'cro_def_inc',
					'help'		=> __('Increments','croma'),
					'name' 		=> __('increments','croma'),
					'options' 	=> array(5,$croma['cro_globalmax'],5),
					'def' 		=> '5'
				),
				array(
					'type' 		=> 'select',
					'fn' 		=> 'cro_rep_don',
					'help'		=> __('Repeat Donation','croma'),
					'name' 		=> __('Enable repeat Donations','croma'),
					'options' 	=> array(__('Yes','croma'), __('No','croma'))
				)																
			)				
		),
		array(
			'short' 			=> 'pic',
			'tabname' 			=> __('Image Banner', 'croma'),
			'icon' 				=> 'icon-sign-blank',
			'type'				=> 'cromax_imgbanner',
			'title'				=> __('Image Banner', 'croma'),
			'values' 			=> array(

				array(
					'type' 		=> 'image',
					'fn' 		=> 'cro_meta_image',
					'help'		=> __('background image for the block','croma'),
					'name' 		=> __('Featured image','croma')
				),
				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_title',
					'help'		=> __('Title for the featured block','croma'),
					'name' 		=> __('Title','croma')
				),
				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_link',
					'help'		=> __('Address to link to','croma'),
					'name' 		=> __('Link address','croma')
				),
				array(
					'type' 		=> 'select',
					'fn' 		=> 'cro_link_target',
					'help'		=> __('Link Target','croma'),
					'name' 		=> __('Link Target','croma'),
					'options' 	=> array(__('Open in....','croma'), __('Same window','croma'),__('New window','croma'))
				)															
			)				
		),
		array(
			'short' 			=> 'hed',
			'tabname' 			=> __('Header Block', 'croma'),
			'icon' 				=> 'icon-sign-blank',
			'type'				=> 'cromax_headerblock',
			'title'				=> __('Headerblock with background or image', 'croma'),
			'values' 			=> array(

				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_title',
					'help'		=> __('Title for the header block','croma'),
					'name' 		=> __('Title','croma')
				),
				array(
					'type' 		=> 'textarea',
					'fn' 		=> 'cro_meta_content',
					'help'		=> __('content for the header block','croma'),
					'name' 		=> __('Sub Title','croma')
				),
				array(
					'type' 		=> 'color',
					'fn' 		=> 'cro_txt_color',
					'help'		=> __('Text color','croma'),
					'name' 		=> __('Text Color','croma'),
					'def' 		=> '#272727'
				),
				array(
					'type' 		=> 'color',
					'fn' 		=> 'cro_meta_color',
					'help'		=> __('background color for the block','croma'),
					'name' 		=> __('Background-color','croma'),
					'def' 		=> ''
				),
				array(
					'type' 		=> 'uislider',
					'fn' 		=> 'cro_sub_size',
					'help'		=> __('Title font size','croma'),
					'name' 		=> __('Title font size','croma'),
					'options' 	=> array(10,80,1),
					'def' 		=> '30'
				),
				array(
					'type' 		=> 'uislider',
					'fn' 		=> 'cro_hed_size',
					'help'		=> __('Sub-title font size','croma'),
					'name' 		=> __('Sub title size','croma'),
					'options' 	=> array(10,80,1),
					'def' 		=> '20'
				),
				array(
					'type' 		=> 'image',
					'fn' 		=> 'cro_meta_image',
					'help'		=> __('background image for the block','croma'),
					'name' 		=> __('Background-image','croma')
				),
				array(
					'type' 		=> 'uislider',
					'fn' 		=> 'cro_meta_mask',
					'help'		=> __('mask for the image','croma'),
					'name' 		=> __('Image-mask','croma'),
					'options' 	=> array(0,100,1),
					'def' 		=> '20'
				),
				array(
					'type' 		=> 'uislider',
					'fn' 		=> 'cro_meta_pad',
					'help'		=> __('Padding between message and image edge','croma'),
					'name' 		=> __('Block padding','croma'),
					'options' 	=> array(0,200,1),
					'def' 		=> '20'
				)															
			)				
		),
		array(
			'short' 			=> 'map',
			'tabname' 			=> __('Streetmap', 'croma'),
			'icon' 				=> 'icon-sign-blank',
			'type'				=> 'cromax_streetmap',
			'title'				=> __('Google Streetmap', 'croma'),
			'values' 			=> array(

				array(
					'type' 		=> 'uislider',
					'fn' 		=> 'cro_meta_height',
					'help'		=> __('Height of the map','croma'),
					'name' 		=> __('Map Height','croma'),
					'options' 	=> array(100,700,10),
					'def' 		=> '300'
				),
				array(
					'type' 		=> 'uislider',
					'fn' 		=> 'cro_meta_zoom',
					'help'		=> __('Map Zoom','croma'),
					'name' 		=> __('Map Zoom','croma'),
					'options' 	=> array(1,22,1),
					'def' 		=> '16'
				),	
				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_address',
					'help'		=> __('Street address for map','croma'),
					'name' 		=> __('Address','croma')
				),
				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_lattitude',
					'help'		=> __('Overwrite if needed (see helpfile)','croma'),
					'name' 		=> __('Lattitude overwrite','croma')
				),
				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_longitude',
					'help'		=> __('Overwrite if needed (see helpfile)','croma'),
					'name' 		=> __('Longitude overwrite','croma')
				)													
			)				
		),
        array(
			'short' 			=> 'sep',
			'tabname' 			=> __('Seperator', 'croma'),
			'icon' 				=> 'icon-resize-horizontal',
			'type'				=> 'cromax_seperator',
			'title'				=> __('Seperator with padding and lines', 'croma'),
			'values' 			=> array(

				array(
					'type' 		=> 'uislider',
					'fn' 		=> 'cro_pad_top',
					'help'		=> __('Height for the seperator','croma'),
					'name' 		=> __('Seperator height','croma'),
					'options' 	=> array(0,100,1),
					'def' 		=> '20'

				)														
			)				
		),
		array(
			'short' 			=> 'mdc',
			'tabname' 			=> __('Mediacast', 'croma'),
			'icon' 				=> 'icon-sign-microphone',
			'type'				=> 'cromax_mediablock',
			'title'				=> __('Mediacast', 'croma'),
			'values' 			=> array(	
				array(
					'type' 		=> 'select',
					'fn' 		=> 'cro_mediatype',
					'help'		=> __('Type of media to add','croma'),
					'name' 		=> __('Type of media to add','croma'),
					'options' 	=> array( '1 ' . __('Latest mediacast','croma'), '2 ' . __('Latest mediacast','croma'), '3 ' . __('Latest mediacast','croma'), '4 ' . __('Latest mediacast','croma'), '5 ' . __('Latest mediacast','croma'),  '6 ' . __('Latest mediacast','croma'))
				),
				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_title',
					'help'		=> __('Text for the title','croma'),
					'name' 		=> __('Title','croma')
				),
				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_label',
					'help'		=> __('Text for the button','croma'),
					'name' 		=> __('Button Label text','croma')
				),	
				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_link',
					'help'		=> __('Button link','croma'),
					'name' 		=> __('Link the button','croma')
				),
				array(
					'type' 		=> 'color',
					'fn' 		=> 'cro_meta_col',
					'help'		=> __('Button text color','croma'),
					'name' 		=> __('Button text color','croma'),
					'def' 		=> '#272727'
				),
				array(
					'type' 		=> 'color',
					'fn' 		=> 'cro_meta_bgcol',
					'help'		=> __('Button background color','croma'),
					'name' 		=> __('Button background color','croma'),
					'def' 		=> '#FBF9FA'
				)													
			)				
		),
		array(
			'short' 			=> 'pct',
			'tabname' 			=> __('Page content', 'croma'),
			'icon' 				=> 'icon-sign-blank',
			'type'				=> 'cromax_pcontentblock',
			'title'				=> __('Page content', 'croma'),
			'values' 			=> array(

				array(
					'type' 		=> 'message',
					'fn' 		=> 'cro_pagemessage',
					'help'		=> __('Add a content of page editor','croma'),
					'name' 		=> __('Page content','croma'),
					'options'	=> __('This component adds the content of the post editor to your page builder and does not have any editable options','croma')
				),														
			)				
		),
		array(
			'short' 			=> 'tab',
			'tabname' 			=> __('Tabs', 'croma'),
			'icon' 				=> 'icon-sign-blank',
			'type'				=> 'cromax_tabblock',
			'title'				=> __('Tabs', 'croma'),
			'values' 			=> array(

				array(
					'type' 		=> 'text',
					'fn' 		=> 'cro_meta_title',
					'help'		=> __('Title for the tab block','croma'),
					'name' 		=> __('Title','croma')
				),
				array(
					'type' 		=> 'tabsbuilder',
					'fn' 		=> 'cro_meta_tabsbuilder',
					'help'		=> __('Tab component builder','croma'),
					'name' 		=> __('Tabs','croma')
				)														
			)				
		),
		array(
			'short' 			=> 'htm',
			'tabname' 			=> __('Text blocks', 'croma'),
			'icon' 				=> 'icon-resize-horizontal',
			'type'				=> 'cromax_textblock',
			'title'				=> __('Text box wit hcustom code', 'croma'),
			'values' 			=> array(

				array(
					'type' 		=> 'textarea',
					'fn' 		=> 'cro_meta_content',
					'help'		=> __('content for the text block','croma'),
					'name' 		=> __('Content','croma')
				),
				array(
					'type' 		=> 'select',
					'fn' 		=> 'cro_link_target',
					'help'		=> __('Make Paragraphs','croma'),
					'name' 		=> __('Make paragraphs','croma'),
					'options' 	=> array(__('No','croma'), __('Tes','croma'))
				)															
			)
		),	
		array(
			'short' 			=> 'vdo',
			'tabname' 			=> __('Video', 'croma'),
			'icon' 				=> 'icon-sign-blank',
			'type'				=> 'cromax_videoblock',
			'title'				=> __('Video', 'croma'),
			'values' 			=> array(

				array(
					'type' 		=> 'textarea',
					'fn' 		=> 'cro_video_link',
					'help'		=> __('Video link to the youtube or vimeo video','croma'),
					'name' 		=> __('Video link','croma')
				)													
			)				
		)

	);

	return apply_filters( 'cromax_define_pagebuilder_parts',$cromax_pb );
}





/**
 * Funciton that draws the individual box items
 *
 * @access public
 * @return void
 */


function cromax_getformbox($v, $ID){


	$op =  $field =  $val = $hdl = '';

	// SET THE FIELDS ANS VALUES
	if (isset($v['fn'])){
		$field = $v['fn'];
		$val = get_post_meta($ID, $field, true);
	}

		// DRAW THE HEADINGS
	if (isset($v['heading'])) {
		$hdl = '<h2>' .  $v['heading']   . '</h2>';
	}


	if($v['type'] == 'pagebuilder') {
		$op .= '<div class="cromax_pagebuilder_box">';
	} else {
		$op .= '<div class="cromax_metabox_box">';
	}



	// TYPE SWITCHES
	switch ($v['type']) {

				// SET UP THE INPUT FIELD		
		case 'getinput':
			$op .= $hdl . '<input type="text" name="' . $field  . '" value="' . stripslashes($val)  . '" placeholder="' . $v['desc']  . '" />';									
		break;	

		// SET UP THE INPUT FIELD		
		case 'gettextarea':
			$op .= $hdl . '<textarea cols="28" rows="7" class="cro_mboxtextarea" name="' . $field  . '" placeholder="' . $v['desc']  . '">' . esc_html( stripslashes($val ))  . '</textarea>';									
		break;	

		// SET UP THE INPUT FIELD		
		case 'pagebuilder':
			$postno = (isset($_GET['post']))? $_GET['post'] :  '';
			$op .= '<input type="hidden" value="Y" name="cromax-pagebuilder" />';
			$op .= '<input type="hidden" value="' . $postno . '" name="cromax-postnumber" />';
			$op .= cro_prebuildersection($ID);
			$op .= '<div class="cromax_pagebuilder_clicktoadd" data-cro_clicker="cro_add_section"><i class="icon-cog icon-spin"></i>' . __('Click to add a Section','croma')  . '</div><div class="cromax_sectionholder">';
			$op .= cromax_draw_pb_section($postno);
			$op .= '</div><div id="cro_pagebuilder_popup"><div class="cro_pagebuilder_formblock"><h2 data-objtype="0">This my the Header</h2><div class="cro_popupformouter"><div class="cro_popupform_box"></div></div><div class="popupform_footer"><span class="cromax-savecl" data-cro_clicker="cro_close_popup">Save & close</span></div><div class="cro_popupcloser" data-cro_clicker="cro_close_popup"><i class="icon-remove"></i></div></div></div>';									
		break;	


	}


	return $op . '</div>';


}




function cro_prebuildersection($ID) {

	$currsbar 		= get_post_meta($ID,'cromabox_sidebarnames', true);
	$msidebars 		= get_option('cromatic_sidebars');
	$csidebars 		= get_post_meta($ID,'cromabox_sbbar', true);
	$csidebars 		= ($csidebars == '')? 2 : $csidebars ;
	$class_sbval0 	= '';
	$class_sbval1 	= '';
	$class_sbval2 	= '';


	switch ($csidebars) {
		case 0: $class_sbval0 = 'cro_sb_active'; break;
		case 1: $class_sbval1 = 'cro_sb_active'; break;
		case 2: $class_sbval2 = 'cro_sb_active'; break;
	}

	$sidebarlist 	= '<option value="cro_sidebarmain" ' . selected( $currsbar, 'cro_sidebarmain', false ) . ' >' .  __('Main Sidebar','croma') . '</option>';

	if(!empty($msidebars)) {
		foreach ($msidebars as $mv) {
			$sel = selected( $currsbar, sanitize_title_with_dashes($mv), false);
			$sidebarlist .= '<option value="' . sanitize_title_with_dashes($mv)  . '" ' . $sel . '>' . $mv . '</option>';
		}
	}

	$yesnoval 		= get_post_meta($ID,'cromabox_yesnobar', true);

	$yesnoval 		= ($yesnoval == '')? 0 : $yesnoval ;
	$valuclass 		= ($yesnoval == 1)? 'cro_yesnohandler' : 'cro_yesnohandler  cro_nonohandler' ;

	return'

		<div class="cro_prebuilder">
			<div class="cro_prebuilderpart">
				<h2>' . __('Select Sidebar','croma')  . '</h2>
				<div class="cro_sidebarselectorouter">
					<div class="cro_sidebarsel item cro_sb_left ' . $class_sbval1  . '" data-cro_clicker="cro_sb_click" data-sbval="1" > 
						<div class="cro_sbbar">
						</div>
					</div>
					<div class="cro_sidebarsel item cro_sb_full ' . $class_sbval0  . '" data-cro_clicker="cro_sb_click"  data-sbval="0" ></div>
					<div class="cro_sidebarsel item cro_sb_right ' . $class_sbval2  . '" data-cro_clicker="cro_sb_click"  data-sbval="2" >
						<div class="cro_sbbar">
						</div>
					</div>
					<input name="cromabox_sbbar" type="hidden" value="' .  $csidebars  . '"  class="cro_sidebarinputbox" />
				</div>
				<select class="cro_sidebarsel_select" name="cromabox_sidebarnames">
					<option value="0">' . __('Select sidebar to show...','croma') . '</option>
					' .  $sidebarlist . '
				</select>
			</div>
			<div class="cro_prebuilderpart">
				<h2>' .  __('Insert Pagebuilder','croma')   . '</h2>
				<span class="cro_yesnoouter cro_yesnomargin">
					<span class="'.  $valuclass  . '" data-cro_clicker="cro_yesno_click">
						<span class="cro_yesno_knob">&nbsp;</span>
					</span>
					<input type="hidden" value="' . $yesnoval . '" name="cromabox_yesnobar">
				</span>
			</div>
			<div class="clear"></div>
		</div>
	';

}



function cro_pagebuilderparts($cnt, $name, $val) {

	$op = '';


	switch ($cnt['type']) {

		case 'text'  :

		$op .= '<p><label>' . $cnt['name']  . '</label><input type="input" value="' .  stripslashes($val)  . '" class="cromax-datanode" name="' . $name  . '-' . $cnt['fn']  . '" placeholder="' . $cnt['help']  . '"></p>';

		break;

		case 'message'  :

		$op .= '<p>' . $cnt['options']  . '<input type="hidden" value="1" class="cromax-datanode" name="' . $name  . '-' . $cnt['fn']  . '"></p>';

		break;

		case 'textarea'  :

		$op .= '<p><label>' . $cnt['name']  . '</label><textarea class="cromax-textnode" name="' . $name  . '-' . $cnt['fn']  . '" placeholder="' . $cnt['help']  . '">' .  stripslashes($val)  . '</textarea></p>';

		break;

		case 'color'  :
		if($val == '') {
			$val = $cnt['def'];
		}
		$op .= '<p class="cromax-colorblock"><label>' . $cnt['name']  . '</label><input type="text" class="cromax-pickme ' . $cnt['fn']   .   '  ' . $name  . '-' . $cnt['fn']  . '" name="' . $name  . '-' . $cnt['fn']  . '" value="' . $val   .   '" size="29" rel=".' . $name  . '-' . $cnt['fn']  . '" /></p>';

		break;

		case 'image'  :
		$op .= '<p><label>' . $cnt['name']  . '</label><input type="text" class="cromax-imgmng ' . $cnt['fn']   .   '  ' . $name  . '-' . $cnt['fn']  . ' cromax-datanode" name="' . $name  . '-' . $cnt['fn']  . '" value="' . $val   .   '" size="29"  rel=".' . $name  . '-' . $cnt['fn']  . '" data-cro_clicker="cro_upload_pic" /><span class="cromax-clearimginput" rel=".' . $name  . '-' . $cnt['fn']  . '" data-cro_clicker="cro_clear_pic">Clear</span></p>';
		break;
	
		case 'uislider'  :
		$val = ($val == '')? $cnt['def'] : $val;
		$op .= '<p class="cromax-uiblock"><label>' . $cnt['name']  . '</label><span class="noUiSlider"></span><input type="text" class="cromax-uislider ' . $cnt['fn']   .   '  ' . $name  . '-' . $cnt['fn']  . ' cromax-datanode"   data-min="'. $cnt['options'][0].'" data-max="'. $cnt['options'][1].'" data-step="'. $cnt['options'][2].'" data-val="' . $val   . '" name="' . $name  . '-' . $cnt['fn']  . '" value="' . $val   .   '" size="29"  rel=".' . $name  . '-' . $cnt['fn']  . '" data-cro_clicker="cro_ui_slide" /></p>';
		break;

		case 'icon'  :
		$fontlist = cromax_get_fonticons();
		$op .= '<p><label>' . $cnt['name']  . '</label><input type="text" class="cromax-iconinput ' . $cnt['fn']   .   '  ' . $name  . '-' . $cnt['fn']  . ' cromax-datanode"  data-cro_clicker="cro_insert_icon" name="' . $name  . '-' . $cnt['fn']  . '" value="' . $val   .   '" size="29" /><span data-cro_clicker="cro_clear_icon" rel=".fqsjf-crqre-cro_meta_image" class="cromax-cleariconinput">' .  __('Clear','croma') . '</span><span class="clear"></span><span class="cromax_iconcollection">';
		foreach ($fontlist as $fl) {
			$op .= '<i class="icon-' . $fl  . ' fontselect" rel="' . $fl  . '" data-cro_clicker="cro_move_icon"></i>';
		}
		$op .= '</span></p>';
		break;

		case 'select'  :
		$ctr = 1;
		$op .= '<p><label>' . $cnt['name']  . '</label><select class="cromax-select ' . $cnt['fn']   .   '  ' . $name  . '-' . $cnt['fn']  . ' cromax-selectnode" name="' . $name  . '-' . $cnt['fn']  . '">';
		foreach ($cnt['options'] as $sl) {
			$op .= '<option value="' . $ctr  . '" ' .    selected( $val, $ctr, false ) . '>' .  $sl . '</option>';
			$ctr++;
		}
		$op .= '</select></p>';
		break;


		case 'postselect'  :

		$pp = '<option value="0" >' . __('Select a item ...','croma')  .   '</option>';

		foreach($cnt['options'] as $vopt) {
			$args = array(
				'posts_per_page'   => -1,
				'post_type'        => $vopt,
				'post_mime_type'   => '',
				'post_parent'      => '',
				'post_status'      => 'publish',
				'suppress_filters' => true 
			); 

			$p_array = get_posts( $args );

			foreach ( $p_array as $post ){

				$pp .= '<option value="' . $post->ID  . '" ' . selected( $val, $post->ID, false ) . '>' . get_the_title($post->ID)  .   '</option>';

			}

		}

		$ctr = 1;
		$op .= '<p><label>' . $cnt['name']  . '</label><select class="cromax-select ' .  $cnt['fn']   .   '  ' . $name  . '-' . $cnt['fn']  . ' cromax-selectnode" name="' . $name  . '-' . $cnt['fn']  . '">';
		$op .= $pp;
		$op .= '</select></p>';
		break;


		case 'tabbuilder'   :
		$tabctr = 1;
		$ap = '';
		if (isset($val)) {
			for ($i=1; $i < 1000 ; $i++) { 
				$j = $i + 1000;
				if (isset($val[$i]) && isset($val[$j])) {
					$ap .= '<span class="cromax_tabitem"><input type="text" class="cromax_tabtitle cromax-datanode" name="' . $name   .  '-' . $cnt['fn']   .  '[' . $tabctr   .  ']" value="' .   stripslashes($val[$i])  . '" placeholder="' . __('title','croma')  . '"> <textarea class="cromax_tabcontent cromax-textnode" name="' . $name   .  '-' . $cnt['fn']   .  '[' . ($tabctr + 1000)  .  ']" placeholder="' . __('Content','croma')  . '">' . stripslashes($val[$j])  . '</textarea><span class="cromax-deleter" data-cro_clicker="cro_remove_tab">-</span></span>';
					$tabctr++;
				}
			}
		}
		$op .= '<p><label>' . $cnt['name']  . '</label><span class="tabpartholder"><span class="tabpartcontent" data-formcode="' . $cnt['fn']   .  '" data-formname="' . $name   .  '" data-formcount="' . $tabctr  . '">' .  $ap . '</span><span class="tabpartfooter"><i class="icon-plus" data-cro_clicker="cro_add_tabber"></i></span></span>';
		break;

		case 'tabsbuilder'   :
		$tabctr = 1;
		$ap = '';
		if (isset($val)) {
			for ($i=1; $i < 1000 ; $i++) { 
				$j = $i + 1000;
				$k = $i + 10000;
				if (isset($val[$i]) && isset($val[$j])) {
					$ap .= '<span class="cromax_tabsitem"><input type="text" class="cromax_tabstitle cromax-datanode" name="' . $name   .  '-' . $cnt['fn']   .  '[' . $tabctr   .  ']" value="' .   stripslashes($val[$i])  . '" placeholder="' . __('Title','croma')  . '"> <input type="text" class="cromax_tabstitle cromax-datanode" name="' . $name   .  '-' . $cnt['fn']   .  '[' . ($tabctr + 10000)   .  ']" value="' . stripslashes($val[$k]) . '" placeholder="' . __('Sub title','croma')  . '"> <textarea class="cromax_tabscontent cromax-textnode" name="' . $name   .  '-' . $cnt['fn']   .  '[' . ($tabctr + 1000)  .  ']" placeholder="' . __('Content','croma')  . '">' .  stripslashes($val[$j])  . '</textarea><span class="cromax-deleters" data-cro_clicker="cro_remove_tabs">-</span></span>';
					$tabctr++;
				}
			}
		}
		$op .= '<p><label>' . $cnt['name']  . '</label><span class="tabspartholder"><span class="tabspartcontent" data-formcode="' . $cnt['fn']   .  '" data-formname="' . $name   .  '" data-formcount="' . $tabctr  . '">' .  $ap . '</span><span class="tabspartfooter"><i class="icon-plus" data-cro_clicker="cro_add_tabbers"></i></span></span>';
		break;

	}


	return $op;

}




/**
 * Add metabox
 *
 * @access public
 * @return void
 */

add_action( 'add_meta_boxes', 'cromax_add_box' );
function cromax_add_box() {	
	foreach ( cromax_define_meta_layouts() as $val ) {		
		 add_meta_box( 
        	'cromax_metas',
        	$val['title'],
        	'cromax_add_metabox',
        	$val['type'],
        	$val['context'],
        	$val['priority']       
    	);
	}
}




/**
 * Enqueue metabox stylesheets and javascript files
 *
 * @access public
 * @return void
 */

function cromax_meta_scripts( $hook ) {

    global $post;

    $ajax_url 			= admin_url( 'admin-ajax.php', 'relative' );
    $ptypehooks 		= array();
    $cromax_params 		= array(
    						'ajax_url' => $ajax_url,
    						'cro_nonces' => wp_create_nonce( 'cromax_pagebuilder')
    					  );
    $purl 				= untrailingslashit( plugins_url( '/', __FILE__ ) );

    foreach ( cromax_define_meta_layouts() as $val ) {	
    	$ptypehooks[] = $val['type'];
    }

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( in_array($post->post_type,$ptypehooks) ) {     
            wp_enqueue_style('cromax-meta-box', $purl . '/assets/cromax-box.css');
            wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script('cromax-meta-box', $purl . '/assets/js/cromax-pagebuilder.js', array('jquery','jquery-ui-sortable', 'wp-color-picker'), null, false);
			wp_localize_script( 'cromax-meta-box', 'cromax_params', apply_filters( 'cromax_params', $cromax_params ) );
        }
    }
}
add_action( 'admin_enqueue_scripts', 'cromax_meta_scripts', 10, 1 );





/**
 * Metabox save functions
 *
 * @access public
 * @return void
 */

add_action('save_post', 'cromax_save_metabox');  
function cromax_save_metabox($id) {

	global $post_type;
	$cro_old = $cro_new = $cro_valueset = '';
	$pbarray = array();



	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	} 


	if( !current_user_can( 'edit_post', $id ) ) {
		return;
	} 

	if( wp_is_post_revision( $id ) || wp_is_post_autosave( $id ) ) {
		return;
	}


	if (isset($_POST['cromabox_sidebarnames'])) {
		update_post_meta( $id, 'cromabox_sidebarnames', $_POST['cromabox_sidebarnames']);
	}

	if (isset($_POST['cromabox_sbbar'])) {
		update_post_meta( $id, 'cromabox_sbbar', $_POST['cromabox_sbbar']);

	}

	if (isset($_POST['cromabox_yesnobar'])) {
		update_post_meta( $id, 'cromabox_yesnobar', $_POST['cromabox_yesnobar']);
	}


	if (isset($_POST['cromax-pagebuilder']) && $_POST['cromax-pagebuilder'] == 'Y') {

		if (isset($_POST['cromax-sectioncode']) && !empty($_POST['cromax-sectioncode'])) {

			$formidenti 	= cromax_define_pagebuilder_parts();

			if (isset($_POST['cromax-sectioncode']) ){
				foreach($_POST['cromax-sectioncode'] as $pb_v) {
					if(isset($_POST['cromax-childname'])) {
						foreach($_POST['cromax-childname'] as $pb_b) {
							$pb_pos = strpos($pb_b,$pb_v);
							if ($pb_pos !== false) {
								$pb_type = ($_POST[$pb_b . '-cromax-childtype'])? $_POST[$pb_b . '-cromax-childtype'] :  '' ;
								$pb_size = ($_POST[$pb_b . '-handler-size'])? $_POST[$pb_b . '-handler-size'] :  '' ;
								$cromaxfi = array();
								foreach ($formidenti as $vv) {
									if ($vv['short'] == $pb_type){							
										foreach ($vv['values'] as $ff) {
											$fntext = $ff['fn'];
											if (isset($_POST[$pb_b . '-' . $fntext]) ) {
												$cromaxfi[$pb_b . '-' . $fntext] = $_POST[$pb_b . '-' . $fntext];
											}							
										}
									}
								}

								$cromaxfi['type'] = $pb_type;
								$cromaxfi['size'] = $pb_size;
								$pbarray[$pb_v][$pb_b] = $cromaxfi;
							}
						}
					}
				}
			}

		}


		update_post_meta( $id, 'cromax_pagebuilder', rawurlencode(json_encode($pbarray)) );


	} else {


		foreach ( cromax_define_meta_layouts() as $val ) {	

			if (isset($val['type']) && $val['type'] == $post_type){
				if (isset($val['values'])){
					foreach ($val['values'] as $vs) {
						if (isset($vs['fn'])) {
							if ($vs['type'] != 'selectrecurring') {
								$cro_old = get_post_meta($id, $vs['fn'], true );
								if (isset($_POST[$vs['fn']])){
									if ($cro_old != $_POST[$vs['fn']]){
										update_post_meta($id, $vs['fn'] , $_POST[$vs['fn']]);
									}
								}
							} else {
								$cro_old 	= get_post_meta($id, $vs['fn'], true );
								$cro_old_a 	= get_post_meta($id, $vs['fn'] . '_a', true );
								$cro_old_b 	= get_post_meta($id, $vs['fn'] . '_b', true );
								$cro_old_c 	= get_post_meta($id, $vs['fn'] . '_c', true );
								$cro_old_d 	= get_post_meta($id, $vs['fn'] . '_d', true );
								$cro_old_e 	= get_post_meta($id, $vs['fn'] . '_e', true );


								if (isset($_POST[$vs['fn']])){
									if ($cro_old != $_POST[$vs['fn']]){
										update_post_meta($id, $vs['fn'] , $_POST[$vs['fn']]);
									}
								}
							
								$alass = $vs['fn'] . '_a';
								if (isset($_POST[$alass])){
									if ($cro_old_a != $_POST[$alass]){
										update_post_meta($id, $alass , $_POST[$alass]);
									}
								}
							
								$alass = $vs['fn'] . '_b';
								if (isset($_POST[$alass])){
									if ($cro_old_b != $_POST[$alass]){
										update_post_meta($id, $alass , $_POST[$alass]);
									}
								}

								$alass = $vs['fn'] . '_c';
								if (isset($_POST[$alass])){
									if ($cro_old_c != $_POST[$alass]){
										update_post_meta($id, $alass , $_POST[$alass]);
									}
								}
							
								$alass = $vs['fn'] . '_d';
								if (isset($_POST[$alass])){
									if ($cro_old_d != $_POST[$alass]){
										update_post_meta($id, $alass , $_POST[$alass]);
									}
								}

								$alass = $vs['fn'] . '_e';
								if (isset($_POST[$alass])){
									if ($cro_old_e != $_POST[$alass]){
										update_post_meta($id, $alass , $_POST[$alass]);
									}
								}

							}	
						}
					}
				}
			}
		}

	}
}






/**
 * The function that draws the metaboxes
 *
 * @access public
 * @return void
 */

function cromax_add_metabox() {
	global $post_type, $post;	

	foreach ( cromax_define_meta_layouts() as $val ) {		
		if ($val['type'] == $post_type) {
			foreach ($val['values'] as $vs) {
				echo cromax_getformbox($vs, $post->ID);
			}
		}
	}	
	echo '<br class="clear">';		
}



?>