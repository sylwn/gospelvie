<?php
/**
* Cromax mediacast metaboxes file
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



 
function cromax_define_mediacast_meta_layouts() {
	$cromax_mediacast_metas = array(
		array(
			'tab' 				=> '0',
			'tabname' 			=> __('General', 'croma'),
			'type'				=> 'mediacast',
			'title'				=> __('Mediacast additional content', 'croma'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'values' 			=> array(	


				array(		
					'type' 		=> 'starthalf'
				),

				array(
					'type' 		=> 'getuser',
					'fn' 		=> 'cro_mediacaster',
					'heading' 	=> __('Mediacaster','croma'),
					'desc' 		=> __('Person who is mediacasting','croma'),
					'options' 	=> array(),
					'def' 		=> 1
				),

				array(
					'type' 		=> 'getinput',
					'fn' 		=> 'cro_vidlink',
					'heading' 	=> __('Link to Youtube or Vimeo','croma'),
					'desc' 		=> __('Add a link to a vimeo or youtube video','croma'),
					'options' 	=> array(),
					'def' 		=> ''
				),

				array(
					'type' 		=> 'getdoc',
					'fn' 		=> 'cro_doclink',
					'heading' 	=> __('Link to pdf notes','croma'),
					'desc' 		=> __('Add a link to pdf sermon notes','croma'),
					'options' 	=> array(),
					'def' 		=> ''
				),

				array(		
					'type' 		=> 'endhalf'
				),



				array(		
					'type' 		=> 'starthalf'
				),



				array(
					'type' 		=> 'getmp3',
					'fn' 		=> 'cro_mediamp3',
					'heading' 	=> __('Mp3 from media manager','croma'),
					'desc' 		=> __('Play a mp3 from the WordPress media manager','croma'),
					'options' 	=> array(),
					'def' 		=> 1
				),


				array(
					'type' 		=> 'getinput',
					'fn' 		=> 'cro_mp3alt',
					'heading' 	=> __('Alternative link to mp3','croma'),
					'desc' 		=> __('Link from alternative mp3 source','croma'),
					'options' 	=> array(),
					'def' 		=> ''
				),



				array(		
					'type' 		=> 'endhalf'
				)




			)				
		)		

	);

	return apply_filters( 'cromax_define_mediacast_meta_layouts',$cromax_mediacast_metas );
}





/**
 * Funciton that draws the individual box items
 *
 * @access public
 * @return void
 */


function cromax_mediacast_formbox($v, $ID){


	if ($v['type'] == 'starthalf') {
		return '<div class="cro_onehalf">';
	}

	if ($v['type'] == 'endhalf') {
		return '</div>';
	}


	if ($v['type'] == 'sectionheading') {
		return '<h2 class="cro_sectionheading">' . $v['heading'] . '</h2>';
	}


	$op =  $field =  $val = $hdl = '';

	// SET THE FIELDS ANS VALUES
	if (isset($v['fn'])){
		$val = get_post_meta($ID, $v['fn'], true);
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
			$op .= $hdl . '<input type="text" name="' . $v['fn']  . '" value="' . stripslashes($val)  . '" placeholder="' . $v['desc']  . '" />';									
		break;	



		// SET UP THE INPUT FIELD		
		case 'gettextarea':
			$op .= $hdl . '<textarea cols="28" rows="7" class="cro_mboxtextarea" name="' . $v['fn']  . '" placeholder="' . $v['desc']  . '">' . esc_html( stripslashes($val ))  . '</textarea>';									
		break;	


		// get user	
		case 'getuser':
			$op .= $hdl . '<select name="' . $v['fn']  . '">';
			$op .= '<option value="0" ' . selected( 0, $val, false ) . '>' . __('No mediacaster','croma') . '</option>';

			$oparr = cro_fetch_userarray(2);

			foreach ($oparr as $vl) {
				$op .= '<option value="' . $vl . '" ' . selected( $vl, $val, false ) . '>' . get_the_author_meta( 'display_name', $vl )  . '</option>';
			}

			$op .= '</select>';
		break;	


		case 'getmp3':

			$hidden 	= ($val == '')? 'cro_media_clear_hide' : '' ;


			$op .= $hdl . '
			<span class="cro_buttonparent cro_clearparent">
				<button class="cro_user_large_button button cro_media_clear ' . $hidden . '" data-cro-clearmediabut="yes" type="button">
					' .  __('Clear Mp3','croma') . '
				</button>
				<button class="cro_user_large_button button" data-cro-mediabut="yes" type="button">
					' .  __('Choose MP3','croma') . '
				</button>
				<div class="cro_media_audioholder">';

			if ($val != '') {
				$op .= '<audio class="wp-audio-shortcode " id="audio-6-1" preload="none" style="width: 100%; visibility: hidden;" controls="controls"><source type="audio/mpeg" src="' . $val . '" /></audio>';
			}
					
			$op .= '</div>
				<input type="hidden" class="cro_audio_hidden_input" name="' . $v['fn']  . '" value="' . $val . '" />
			</span>';


		break;

		case 'getdoc':

			$hidden 	= ($val == '')? 'cro_media_clear_hide' : '' ;


			$op .= $hdl . '
			<span class="cro_docparent cro_clearparent">
				<button class="cro_user_large_button button cro_media_clear ' . $hidden . '" data-cro-clearmediabut="yes" type="button">
					' .  __('Clear document','croma') . '
				</button>
				<button class="cro_user_large_button button" data-cro-docbut="yes" type="button">
					' .  __('Choose document','croma') . '
				</button>
				<input type="text" class="cro_audio_hidden_input" name="' . $v['fn']  . '" value="' . $val . '" placeholder="' . $v['desc']  . '" />
			</span>';


		break;


		case 'yesno':
			$op .= $hdl;
			$valu 		= ($val != '')? $val : $v['def'] ;
			$valuclass 	= ($valu == 1)? 'cro_yesnohandler' : 'cro_yesnohandler  cro_nonohandler' ;
			$op .= '<span class="cro_yesnoouter"><span class="'.  $valuclass  . '"><span class="cro_yesno_knob">&nbsp;</span></span><input type="hidden" value="' . esc_attr($valu)   .   '" name="' . $v['fn']  .   '"></span>';
		break;

	}


	return $op . '</div>';


}


/**
 * Add metabox
 *
 * @access public
 * @return void
 */

add_action( 'add_meta_boxes', 'cromax_add_mediacast_box' );
function cromax_add_mediacast_box() {	
	foreach ( cromax_define_mediacast_meta_layouts() as $val ) {		
		 add_meta_box( 
        	'cromax_mediacast_metas',
        	$val['title'],
        	'cromax_add_mediacast_metabox',
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

function cromax_mediacast_meta_scripts( $hook ) {

    global $post;

    $ajax_url 			= admin_url( 'admin-ajax.php', 'relative' );
    $ptypehooks 		= array();
    $cromax_params 		= array('ajax_url' => $ajax_url);
    $purl 				= untrailingslashit( plugins_url( '/', __FILE__ ) );

    foreach ( cromax_define_mediacast_meta_layouts() as $val ) {	
    	$ptypehooks[] = $val['type'];
    }

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( in_array($post->post_type,$ptypehooks) ) {     
            wp_enqueue_style('cromax-meta-box', $purl . '/assets/cromax-mediacast-box.css');
            wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script('cromax-meta-box', $purl . '/assets/js/cromax-mediacastbuilder.js', array('jquery', 'wp-color-picker'), null, false);
			wp_localize_script( 'cromax-meta-box', 'cromax_params', apply_filters( 'cromax_params', $cromax_params ) );
        }
    }
}
add_action( 'admin_enqueue_scripts', 'cromax_mediacast_meta_scripts', 10, 1 );





/**
 * Metabox save functions
 *
 * @access public
 * @return void
 */

add_action('save_post', 'cromax_save_mediacast_metabox');  
function cromax_save_mediacast_metabox($id) {

	global $post_type, $post;
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



	foreach ( cromax_define_mediacast_meta_layouts() as $val ) {	

		if (isset($val['type']) && $val['type'] == $post_type){
				
			if (isset($val['values'])){
					
				foreach ($val['values'] as $vs) {
						
					if (isset($vs['fn'])) {
	
						if (isset($_POST[$vs['fn']])){
							if ($_POST[$vs['fn']]){
								update_post_meta($id, $vs['fn'] , $_POST[$vs['fn']]);
							} else {
								update_post_meta($id, $vs['fn'] ,'');
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

function cromax_add_mediacast_metabox() {
	global $post_type, $post;	

	foreach ( cromax_define_mediacast_meta_layouts() as $val ) {		
		if ($val['type'] == $post_type) {
			foreach ($val['values'] as $vs) {
				echo cromax_mediacast_formbox($vs, $post->ID);
			}
		}
	}	
	echo '<br class="clear">';		
}



?>