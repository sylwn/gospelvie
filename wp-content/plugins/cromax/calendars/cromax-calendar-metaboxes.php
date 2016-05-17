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



 
function cromax_define_calendar_meta_layouts() {
	$cromax_calendar_metas = array(
		array(
			'tab' 				=> '0',
			'tabname' 			=> __('General', 'croma'),
			'type'				=> 'calendar',
			'title'				=> __('Calendar additional content', 'croma'),
			'context'			=> 'normal',
			'priority'			=> 'high',
			'values' 			=> array(	
				array(		
					'type' 		=> 'calendarpack',
					'fn' 		=> 'cro_introquote',
					'heading'	=> __('Calendar Select Date and time', 'croma'),
					'options'	=> '',
					'desc'		=> __('Add the introduction quote','croma')
				),	

				array(		
					'type' 		=> 'gettextarea',
					'fn' 		=> 'cro_introdesc',
					'heading'	=> __('Event Description', 'croma'),
					'options'	=> '',
					'desc'		=> __('Add the event description','croma')
				),	
				array(		
					'type' 		=> 'getinput',
					'fn' 		=> 'cro_introinput',
					'heading'	=> __('Event Location', 'croma'),
					'options'	=> '',
					'desc'		=> __('Add the event Location','croma')
				)															
			)				
		)		

	);

	return apply_filters( 'cromax_define_calendar_meta_layouts',$cromax_calendar_metas );
}





/**
 * Funciton that draws the individual box items
 *
 * @access public
 * @return void
 */


function cromax_getcalendar_formbox($v, $ID){


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
		case 'calendarpack':
			$op .= $hdl;
			ob_start();
			include('templates/calendarpack.php');
			$pageContent = ob_get_contents();
			ob_end_clean();
			$op .= $pageContent;								
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

add_action( 'add_meta_boxes', 'cromax_add_calendar_box' );
function cromax_add_calendar_box() {	
	foreach ( cromax_define_calendar_meta_layouts() as $val ) {		
		 add_meta_box( 
        	'cromax_calendar_metas',
        	$val['title'],
        	'cromax_add_calendar_metabox',
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

function cromax_calendar_meta_scripts( $hook ) {

    global $post;

    $ajax_url 			= admin_url( 'admin-ajax.php', 'relative' );
    $ptypehooks 		= array();
    $cromax_params 		= array('ajax_url' => $ajax_url);
    $purl 				= untrailingslashit( plugins_url( '/', __FILE__ ) );

    foreach ( cromax_define_calendar_meta_layouts() as $val ) {	
    	$ptypehooks[] = $val['type'];
    }

    if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
        if ( in_array($post->post_type,$ptypehooks) ) {     
            wp_enqueue_style('cromax-meta-box', $purl . '/assets/cromax-calendar-box.css');
            wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_script('cromax-meta-box', $purl . '/assets/js/cromax-calendarbuilder.js', array('jquery','jquery-ui-sortable', 'wp-color-picker'), null, false);
			wp_localize_script( 'cromax-meta-box', 'cromax_params', apply_filters( 'cromax_params', $cromax_params ) );
        }
    }
}
add_action( 'admin_enqueue_scripts', 'cromax_calendar_meta_scripts', 10, 1 );





/**
 * Metabox save functions
 *
 * @access public
 * @return void
 */

add_action('save_post', 'cromax_save_calendar_metabox');  
function cromax_save_calendar_metabox($id) {

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


	if (isset($_POST['cromabox_sidebarnames'])) {
		update_post_meta( $id, 'cromabox_sidebarnames', $_POST['cromabox_sidebarnames']);
	}

	if (isset($_POST['cromabox_sbbar'])) {
		update_post_meta( $id, 'cromabox_sbbar', $_POST['cromabox_sbbar']);

	}

	if (isset($_POST['cromabox_yesnobar'])) {
		update_post_meta( $id, 'cromabox_yesnobar', $_POST['cromabox_yesnobar']);
	}



	foreach ( cromax_define_calendar_meta_layouts() as $val ) {	

		if (isset($val['type']) && $val['type'] == $post_type){
				
			if (isset($val['values'])){
					
				foreach ($val['values'] as $vs) {
						
					if (isset($vs['fn'])) {
							
						if ($vs['type'] == 'calendarpack') {


							if (isset($_POST['cromax_calendarpack_hours'])) {
							    update_post_meta($id, 'cromax_calendarpack_hours' , $_POST['cromax_calendarpack_hours']);
							}

							if (isset($_POST['cromax_calendarpack_minutes'])) {
							    update_post_meta($id, 'cromax_calendarpack_minutes' , $_POST['cromax_calendarpack_minutes']);
							}

							if (isset($_POST['cromax_cal_rec'])) {
							    update_post_meta($id, 'cromax_cal_rec' , $_POST['cromax_cal_rec']);
							}

							if (isset($_POST['cromax_sel_rec_a'])) {
							    update_post_meta($id, 'cromax_sel_rec_a' , $_POST['cromax_sel_rec_a']);
							}

							if (isset($_POST['cromax_sel_rec_b'])) {
							    update_post_meta($id, 'cromax_sel_rec_b' , $_POST['cromax_sel_rec_b']);
							}

							if (isset($_POST['cromax_sel_rec_c'])) {
							    update_post_meta($id, 'cromax_sel_rec_c' , $_POST['cromax_sel_rec_c']);
							}

							if (isset($_POST['cromax_sel_rec_d'])) {
							    update_post_meta($id, 'cromax_sel_rec_d' , $_POST['cromax_sel_rec_d']);
							}

							if (isset($_POST['cromax_sel_rec_e'])) {
							    update_post_meta($id, 'cromax_sel_rec_e' , $_POST['cromax_sel_rec_e']);
							}

							if (isset($_POST['cromax_calval'])) {
							    update_post_meta($id, 'cromax_calval' , $_POST['cromax_calval']);
							}

						} else {
	
							if (isset($_POST[$vs['fn']])){
								if ($cro_old != $_POST[$vs['fn']]){
										update_post_meta($id, $vs['fn'] , $_POST[$vs['fn']]);
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

function cromax_add_calendar_metabox() {
	global $post_type, $post;	

	foreach ( cromax_define_calendar_meta_layouts() as $val ) {		
		if ($val['type'] == $post_type) {
			foreach ($val['values'] as $vs) {
				echo cromax_getcalendar_formbox($vs, $post->ID);
			}
		}
	}	
	echo '<br class="clear">';		
}



?>