<?php
/**
* Plugin Name: Cromax
* Plugin URI: http://cro.ma
* Description: Cromax widgets pack
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



if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly




/**
 * Cromax video widget
 *
 * @access public
 * @return void
 */

class cromax_video extends WP_Widget {

	
	public function __construct() {
		parent::__construct(
	 		'cromax_video', // Base ID
			'Video &nbsp;&nbsp;&nbsp;&nbsp;[C]', // Name
			array( 'description' => __( 'Cromax video widget', 'croma' ), ) // Args
		);
	}


	// WIDGET OUTPUT
	public function widget( $args, $instance ) {


		extract( $args );		

		$video 			= $instance[ 'video' ];
		$thumb 			= $instance[ 'thumb' ];
		$frame 			= $instance[ 'frame' ];
		$desc 			= $instance[ 'description' ];
		$randomstring 	= cromax_randstring(4);
		$galclass 		= ($desc == '') ? 'cromax_nodesc' : '' ;
		
		if (isset($instance[ 'ids' ])) {$id = $instance[ 'ids' ];}

		
		echo $before_widget;


		echo '<img src="' . $thumb . '" alt="image"><div class="cromax_playerbutdiv cromax_videodiv ' . $galclass  . '"  data-cro-actistring="' .  $randomstring .   '" data-reveal data-reveal-id="' .  $randomstring .   '" ><i class="icon-play-circle"></i></div>';

		if ($desc) {
			echo '<div class="cromax_videodesc cro_accent">' .  $desc  .   '</div>';
		}


		$vidframe 	= '</div><div class="cromaxModal reveal-modal large" id="' . $randomstring  .  '"><div class="flex-video vimeo widescreen">';
		$vidframe 	.= $frame;
		$vidframe 	.= '</div><a class="close-reveal-modal"><i class="icon-remove"></i></a>';
		echo $vidframe;

		echo $after_widget;


				
	}
	
	
	

	// WIDGET VALUES UPDATE
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] 			= strip_tags( $new_instance['title'] );
		$instance['video'] 			= esc_attr( $new_instance['video'] );
		$instance['ids'] 			= esc_attr( $new_instance['ids'] );
		$instance['thumb'] 			= esc_attr( $new_instance['thumb'] );
		$instance['frame'] 			= esc_attr( $new_instance['frame'] );
		$instance['description'] 	= esc_attr( $new_instance['description'] );
		$tturi 						= cro_identifyvideo($instance['video'], $instance['ids']);	

		if ($tturi != '' && isset($tturi)) {
			$instance['ids'] 		= $tturi['ids'];
			$instance['thumb'] 		= $tturi['thumb'];
			$instance['frame'] 		= $tturi['frame'];
		}

		return $instance;
	}

	
	// WIDGET FORM
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) || isset( $instance[ 'video' ]) || isset( $instance[ 'id' ] ) || isset( $instance[ 'thumb' ])  || isset( $instance[ 'frame' ] )  || isset( $instance[ 'description' ] )) {
			
			$title 		= $instance[ 'title' ];
			$video 		= $instance[ 'video' ];
			$desc 		= $instance[ 'description' ];
			$ids 		= $instance[ 'ids' ];
			$thumb 		= $instance[ 'thumb' ];
			$frame 		= $instance[ 'frame' ];
		}
		else {
			$title 		= __( 'New title', 'croma' );
			$video 		= '';
			$ids 		= '';
			$thumb 		= '';
			$frame 		= '';
			$desc 		= '';
		}

		$args = array(
			'type'		=> 'input',
			'labelfor' 	=> $this->get_field_id( 'title' ),
			'label'		=> __('Title','croma'),
			'id'		=> $this->get_field_id( 'title' ),
			'idname'	=> $this->get_field_name( 'title' ),
			'val'		=> esc_attr( $title ),
			'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);

		$args = array(
			'type'		=> 'input',
			'labelfor' 	=> $this->get_field_id( 'video' ),
			'label'		=> __('Video link:','croma'),
			'id'		=> $this->get_field_id( 'video' ),
			'idname'	=> $this->get_field_name( 'video' ),
			'val'		=> esc_attr( $video ),
			'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);


		$args = array(
			'type'		=> 'textarea',
			'labelfor' 	=> $this->get_field_id( 'description' ),
			'label'		=> __('Video description:','croma'),
			'id'		=> $this->get_field_id( 'description' ),
			'idname'	=> $this->get_field_name( 'description' ),
			'val'		=> esc_attr( $desc ),
			'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);

		$args = array(
			'type'		=> 'hidden',
			'labelfor' 	=> $this->get_field_id( 'ids' ),
			'label'		=> '',
			'id'		=> $this->get_field_id( 'ids' ),
			'idname'	=> $this->get_field_name( 'ids' ),
			'val'		=> esc_attr( $ids ),
			'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);

		$args = array(
			'type'		=> 'hidden',
			'labelfor' 	=> $this->get_field_id( 'thumb' ),
			'label'		=> '',
			'id'		=> $this->get_field_id( 'thumb' ),
			'idname'	=> $this->get_field_name( 'thumb' ),
			'val'		=> esc_attr( $thumb ),
			'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);

		$args = array(
			'type'		=> 'hidden',
			'labelfor' 	=> $this->get_field_id( 'frame' ),
			'label'		=> '',
			'id'		=> $this->get_field_id( 'frame' ),
			'idname'	=> $this->get_field_name( 'frame' ),
			'val'		=> esc_attr( $frame ),
			'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);
	}

} // class Foo_Widget

add_action( 'widgets_init', create_function( '', 'register_widget( "cromax_video" );' ) );





/**
 * Cromax make widget formparts
 *
 * @access public
 * @return void
 */

 function cromax_make_widget_formpart($args){

 	$cro_p = '<p>';

 	if ($args['type'] != 'hidden'){
 		$cro_p .= '<label for="' . $args['labelfor']  . '">'   .  $args['label']  .    '</label> ';
 	}

 	switch ($args['type']) {
 		
 		case 'input':
 			$cro_p .= '<input class="widefat" id="' .  $args['id']  . '" name="' .  $args['idname']  . '" type="text" value="' .  $args['val']  . '" />';	
 		break;

 		case 'textarea':
 			$cro_p .= '<textarea name="' .  $args['idname']  . '" id="' .  $args['id']  . '" cols="20" rows="16" class="widefat">' .  $args['val']  . '</textarea>';	
 		break;

 		case 'hidden':
 			$cro_p .= '<input class="widefat" id="' .  $args['id']  . '" name="' .  $args['idname']  . '" type="hidden" value="' .  $args['val']  . '" />';	
 		break;

 		case 'carouselselect':
 			$cro_p .= '<select class="widefat" id="' .  $args['id']  . '" name="' .  $args['idname']  . '">';	

 			if (isset($args['val'])){
 				$vals = $args['val'];
 			} else {
 				$vals = '';
 			}

 			$args = array(
 					'default' => $vals,
 					'type'		=> 'page',
 			);

 			$cro_p .= cro_get_optionnodes($args, 'ifimages');

 			$cro_p .= '</select>';
 		break;



 		case 'get_cats':
 			$cro_p .= '<select class="widefat" id="' .  $args['id']  . '" name="' .  $args['idname']  . '">';	


 			if (isset($args['val'])){
 				$vals = $args['val'];
 			} else {
 				$vals = '';
 			}

 			if ($vals == 0) {
 				$cro_p .= '<option value="0"  selected="selected">' .  __('All catgories','croma')   . '</option>';
 			} else {
 				$cro_p .= '<option value="0">' .  __('All catgories','croma')   . '</option>';
 			}

 			$categories=  get_categories();
  			foreach ($categories as $category) {
  				if ($vals == $category->term_id){
  					$vsel = ' selected="selected"';
  				} else {
  					$vsel = '';
  				}
  				$cro_p .= '<option value="' .   $category->term_id    .     '" ' . $vsel  . '> '   .$category->category_nicename.'</option>';
  			}

 			$cro_p .= '</select>';
 		break;


 		case 'get_casts':
 			$cro_p .= '<select class="widefat" id="' .  $args['id']  . '" name="' .  $args['idname']  . '">';	


 			if (isset($args['val'])){
 				$vals = $args['val'];
 			} else {
 				$vals = '';
 			}

 			if ($vals == 0) {
 				$cro_p .= '<option value="0"  selected="selected">' .  __('All mediacast Categories','croma')   . '</option>';
 			} else {
 				$cro_p .= '<option value="0">' .  __('All Mediacast','croma')   . '</option>';
 			}

 			$args=array(
 				'name' => 'mediacast_category'
 			);
 			$output = 'objects'; // or objects
 			$categories = get_categories('taxonomy=media_category&post_type=mediacast');

  			foreach ($categories as $category) {
  				if ($vals == $category->term_id){
  					$vsel = ' selected="selected"';
  				} else {
  					$vsel = '';
  				}
  				$cro_p .= '<option value="' .   $category->term_id    .     '" ' . $vsel  . '> '   .$category->category_nicename.'</option>';
  			}

 			$cro_p .= '</select>';
 		break;



 		case 'selectbox':
 			$cro_p .= '<select class="widefat" id="' .  $args['id']  . '" name="' .  $args['idname']  . '">';	

 			if (isset($args['options'])) {

 				foreach ($args['options'] as $cro_v) {


 					$cro_p .= '<optgroup label="' . $cro_v . '">';

 					$vals = '';
 					if (isset($args['val'])){
 						$vals = $args['val'];
 					} 

 					$args = array(
 					'default' => $vals,
 					'type'		=> $cro_v,
 					'options'	=> array()
 					);

 					$cro_p .= cromax_get_optionnodes($args, '');

 					$cro_p .= '</optgroup>';

 				}
 			}

 			$cro_p .= '</select>';
 		break;


 	}

 	if (isset($args['desc'])) {
 		$cro_p .= '<br/>' . $args['desc'];
 	}

	$cro_p .= '</p>';
	return $cro_p;
 }





/**
 * Cromax get_optionnodes
 *
 * @access public
 * @return void
 */


function cromax_get_optionnodes($args, $imagelinks){

	$cro_p = '';

	$myargs = array('post_type'=>$args['type'],'showposts'=> 10000);	
	
	
	$my_newquery = new WP_Query($myargs);
	
	
	if ($my_newquery->have_posts()) : while ($my_newquery->have_posts()) : $my_newquery->the_post();
	
	$ctotid 			= get_the_ID();
	$ctotit 			= get_the_title($ctotid);
	$img 				= get_the_post_thumbnail( $ctotid, 'thumbnail');
	$continue 			= ($img && $imagelinks) ? 1 : 0 ;

	if (!$imagelinks ||$continue === 1){

		if (isset($args['default']) && $args['default'] == $ctotid) {
			$sel = ' selected="selected"';
		} else {
			$sel = '';
		}

		if (isset($args['options']) && $args['options'] ){

			$testit = 'false';

			$ptemplate = get_post_meta($ctotid, '_wp_page_template', true);

			foreach ($args['options'] as $crov) {
				if ($crov == $ptemplate){
					$testit = 'true';
				}
			}

			if ($testit == 'true') {
				$cro_p .= '<option ' .  $sel . ' value="' . $ctotid  . '">';
				$cro_p .= $ctotit;
				$cro_p .= '</option>';
			}

		} else {

			$cro_p .= '<option ' .  $sel . ' value="' . $ctotid  . '">';
			$cro_p .= $ctotit;
			$cro_p .= '</option>';

		}

	}

	
	endwhile;
	else : endif;
	wp_reset_query();


	return $cro_p;

}


/**
 * Cromax latest news widget
 *
 * @access public
 * @return void
 */

class cromax_latestnews extends WP_Widget {

	
	public function __construct() {
		parent::__construct(
	 		'cromax-latestnews', // Base ID
			'Latest News &nbsp;&nbsp;&nbsp;&nbsp;[C]', // Name
			array( 'description' => __( 'Cromax widget for displaying latest news', 'croma' ), ) // Args
		);
	}


	// WIDGET OUTPUT
	public function widget( $args, $instance ) {
		$tlset = get_option( 'tlset' );
		extract( $args );
		
		$title 			= apply_filters('widget_title', $instance['title']);
		$events 		= esc_attr($instance['events']);
		$cats 			= esc_attr($instance['cats']);


		$events = (!$events || !is_numeric($events)) ? 3 : $events;


		echo $before_widget;
		if ( ! empty( $title ) )
		echo $before_title . $title . $after_title;

		if ($cats == 0) {
			$args = array( 'numberposts' => $events);
		} else {
			$args = array( 'numberposts' => $events, 'category'    => $cats);
		}
		$latestnewsposts = get_posts( $args );
		foreach( $latestnewsposts as $post ) :	setup_postdata($post); 


		$theimg = get_the_post_thumbnail($post->ID,'thumbnail');

		echo '<div class="cromax_singlep clearfix">';


		if ($theimg) {
			echo '<a href="' .  get_permalink($post->ID) .  '">';
			echo $theimg;
			echo '</a>';
		}

		$text = $post->post_content;
		$text = strip_shortcodes($text);
		$text = wp_trim_words( $text, $num_words = 6, $more = null );

		echo '<h6 class="cromax_accent"><a href="' .  get_permalink($post->ID) .  '">' .   $post->post_title   .  '</a></h6>';
		echo '<p>' . $text . '</p>';



		echo '</div>';

		endforeach; 
		
		echo $after_widget;
	}
	
	
	

	// WIDGET VALUES UPDATE
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['events'] = esc_attr($new_instance['events']);
		$instance['cats'] = esc_attr($new_instance['cats']);

		return $instance;
	}

	
	// WIDGET FORM
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ]) || isset( $instance[ 'events' ])  || isset( $instance[ 'cats' ])   ) {
			$title 			= $instance[ 'title' ];
			$events 		= $instance[ 'events' ];
			$cats 			= $instance[ 'cats' ];
		}
		else {
			$title 			= __( 'New title', 'croma' );
			$events			= 3;
			$cats 			= 0;
		}


		$args = array(
				'type'		=> 'input',
				'labelfor' 	=> $this->get_field_id( 'title' ),
				'label'		=> __('Title','croma'),
				'id'		=> $this->get_field_id( 'title' ),
				'idname'	=> $this->get_field_name( 'title' ),
				'val'		=> esc_attr( $title ),
				'desc'		=> '',
				'options'	=> ''
		);

		echo cromax_make_widget_formpart($args);

		$args = array(
				'type'		=> 'input',
				'labelfor' 	=> $this->get_field_id( 'events' ),
				'label'		=> __('Number of posts','croma'),
				'id'		=> $this->get_field_id( 'events' ),
				'idname'	=> $this->get_field_name( 'events' ),
				'val'		=> esc_attr( $events ),
				'desc'		=> '',
				'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);


		$args = array(
				'type'		=> 'get_cats',
				'labelfor' 	=> $this->get_field_id( 'cats' ),
				'label'		=> __('Category to show','croma'),
				'id'		=> $this->get_field_id( 'cats' ),
				'idname'	=> $this->get_field_name( 'cats' ),
				'val'		=> esc_attr( $cats ),
				'desc'		=> '',
				'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);


	}

} // class Foo_Widget


add_action( 'widgets_init', create_function( '', 'register_widget( "cromax_latestnews" );' ) );
 




/**
 * Cromax twitter widget
 *
 * @access public
 * @return void
 */
 
class cromax_twitter extends WP_Widget {

	
	public function __construct() {
		parent::__construct(
	 		'cromax_twitter', // Base ID
			'Twitter &nbsp;&nbsp;&nbsp; [C]', // Name
			array( 'description' => __( 'Cromax twitter widget', 'croma' ), ) // Args
		);
	}


	// WIDGET OUTPUT
	public function widget( $args, $instance ) {


		extract( $args );		
		$title 					= apply_filters('widget_title', $instance['title']);
		$tweets 				= esc_attr($instance['tweets']);	
		$username 				= esc_attr(str_replace('@', '', $instance['username']));	
		$followlabel 			= esc_attr($instance['followlabel']);
		$consumer_key 			= $instance[ 'consumer_key'];
		$consumer_secret 		= $instance[ 'consumer_secret'];
		$access_token 			= $instance[ 'access_token'];
		$access_token_secret 	= $instance[ 'access_token_secret'];
		$twitterings 			= '';



		echo $before_widget;

		if ( $title ) echo $before_title . $title . $after_title; 		

		echo do_shortcode( '[cromax-twitter username="' . $username . '" conskey="' . $consumer_key . '" consecret="'  . $consumer_secret .  '" acctoken="'  . $access_token .  '" accsecret="'  . $access_token_secret .  '" acclabel="'  . $followlabel .  '"  tweetnum="'  . $tweets  .  '"]' );

		echo $after_widget;
				
	}
	
	
	

	// WIDGET VALUES UPDATE
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] 					= strip_tags( $new_instance['title'] );
		$instance['tweets'] 				= esc_attr( $new_instance['tweets'] );
		$instance['username'] 				= esc_attr( $new_instance['username'] );
		$instance['followlabel'] 			= esc_attr( $new_instance['followlabel'] );
		$instance['consumer_key'] 			= esc_attr( $new_instance['consumer_key']);
		$instance['consumer_secret'] 		= esc_attr( $new_instance['consumer_secret']);
		$instance['access_token'] 			= esc_attr( $new_instance['access_token']);
		$instance['access_token_secret'] 	= esc_attr( $new_instance['access_token_secret']);
		return $instance;
	}

	
	// WIDGET FORM
	public function form( $instance ) {
		if (isset($instance[ 'title' ]) || isset($instance[ 'tweets' ]) || isset($instance[ 'username' ]) || isset($instance[ 'followlabel' ]) || isset($instance[ 'consumer_key' ]) || isset($instance[ 'consumer_secret' ]) || isset($instance[ 'access_token' ]) || isset($instance[ 'access_token_secret' ])) {
			$title 					= $instance[ 'title'];
			$tweets 				= $instance[ 'tweets'];
			$username 				= $instance[ 'username'];
			$followlabel			= $instance[ 'followlabel'];
			$consumer_key 			= $instance[ 'consumer_key'];
			$consumer_secret 		= $instance[ 'consumer_secret'];
			$access_token 			= $instance[ 'access_token'];
			$access_token_secret 	= $instance[ 'access_token_secret'];

		} else {
			$title 						= 'New Title';
			$tweets 					= '';
			$username 					= '';
			$consumer_key 				= '';
			$consumer_secret 			= '';
			$access_token 				= '';
			$access_token_secret		= '';
			$followlabel 				= __('Follow us on Twitter','croma');
		}
		

		$args = array(
			'type'		=> 'input',
			'labelfor' 	=> $this->get_field_id( 'title' ),
			'label'		=> __('Title','croma'),
			'id'		=> $this->get_field_id( 'title' ),
			'idname'	=> $this->get_field_name( 'title' ),
			'val'		=> esc_attr( $title ),
			'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);

		$args = array(
			'type'		=> 'input',
			'labelfor' 	=> $this->get_field_id( 'tweets' ),
			'label'		=> __('Number of tweets:','croma'),
			'id'		=> $this->get_field_id( 'tweets' ),
			'idname'	=> $this->get_field_name( 'tweets' ),
			'val'		=> esc_attr( $tweets ),
			'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);

		$args = array(
			'type'		=> 'input',
			'labelfor' 	=> $this->get_field_id( 'username' ),
			'label'		=> __('Username:','croma'),
			'id'		=> $this->get_field_id( 'username' ),
			'idname'	=> $this->get_field_name( 'username' ),
			'val'		=> esc_attr( $username ),
			'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);

		$args = array(
			'type'		=> 'input',
			'labelfor' 	=> $this->get_field_id( 'consumer_key' ),
			'label'		=> __('Consumer key:','croma'),
			'id'		=> $this->get_field_id( 'consumer_key' ),
			'idname'	=> $this->get_field_name( 'consumer_key' ),
			'val'		=> esc_attr( $consumer_key ),
			'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);

		$args = array(
			'type'		=> 'input',
			'labelfor' 	=> $this->get_field_id( 'consumer_secret' ),
			'label'		=> __('Consumer Secret:','croma'),
			'id'		=> $this->get_field_id( 'consumer_secret' ),
			'idname'	=> $this->get_field_name( 'consumer_secret' ),
			'val'		=> esc_attr( $consumer_secret ),
			'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);

		$args = array(
			'type'		=> 'input',
			'labelfor' 	=> $this->get_field_id( 'access_token' ),
			'label'		=> __('Access token:','croma'),
			'id'		=> $this->get_field_id( 'access_token' ),
			'idname'	=> $this->get_field_name( 'access_token' ),
			'val'		=> esc_attr( $access_token ),
			'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);

		$args = array(
			'type'		=> 'input',
			'labelfor' 	=> $this->get_field_id( 'access_token_secret' ),
			'label'		=> __('Access token secret:','croma'),
			'id'		=> $this->get_field_id( 'access_token_secret' ),
			'idname'	=> $this->get_field_name( 'access_token_secret' ),
			'val'		=> esc_attr( $access_token_secret),
			'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);



		$args = array(
			'type'		=> 'input',
			'labelfor' 	=> $this->get_field_id( 'followlabel' ),
			'label'		=> __('Follow us label:','croma'),
			'id'		=> $this->get_field_id( 'followlabel' ),
			'idname'	=> $this->get_field_name( 'followlabel' ),
			'val'		=> esc_attr( $followlabel ),
			'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);
	}

} // class Foo_Widget


add_action( 'widgets_init', create_function( '', 'register_widget( "cromax_twitter" );' ) );



/**
 * Cromax mediacast categories
 *
 * @access public
 * @return void
 */
 
class cromax_mediacast_cat extends WP_Widget {

	
	public function __construct() {
		parent::__construct(
	 		'cromax_mediacast_catr', // Base ID
			'Mediacast Categories &nbsp;&nbsp;&nbsp; [C]', // Name
			array( 'description' => __( 'Displays all the mediacast categories in a widget', 'croma' ), ) // Args
		);
	}


	// WIDGET OUTPUT
	public function widget( $args, $instance ) {


		extract( $args );	
		$title 					= apply_filters('widget_title', $instance['title']);	


		echo $before_widget;

		if ( $title ) echo $before_title . $title . $after_title; 	

		$mediacast_categories 	= get_terms( 'media_category');


		echo '<ul>';


		foreach ($mediacast_categories as $key => $value) {
			echo '<li><a href="' . get_term_link( $value) . '">' . $value->name  . '</a></li>';
		}


		echo '</ul>';
	


		echo $after_widget;
				
	}
	
	
	

	// WIDGET VALUES UPDATE
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] 					= strip_tags( $new_instance['title'] );
		return $instance;
	}

	
	// WIDGET FORM
	public function form( $instance ) {
		if (isset($instance[ 'title' ])) {
			$title 					= $instance[ 'title'];

		} else {
			$title 						= 'New Title';
		}
		

		$args = array(
			'type'		=> 'input',
			'labelfor' 	=> $this->get_field_id( 'title' ),
			'label'		=> __('Title','croma'),
			'id'		=> $this->get_field_id( 'title' ),
			'idname'	=> $this->get_field_name( 'title' ),
			'val'		=> esc_attr( $title ),
			'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);

	}

} // class Foo_Widget


add_action( 'widgets_init', create_function( '', 'register_widget( "cromax_mediacast_cat" );' ) );





/**
 * Cromax mediacast tags
 *
 * @access public
 * @return void
 */
 
class cromax_mediacast_tag extends WP_Widget {

	
	public function __construct() {
		parent::__construct(
	 		'cromax_mediacast_tag', // Base ID
			'Mediacast Tags &nbsp;&nbsp;&nbsp; [C]', // Name
			array( 'description' => __( 'Displays all the mediacast tags in a widget', 'croma' ), ) // Args
		);
	}


	// WIDGET OUTPUT
	public function widget( $args, $instance ) {


		extract( $args );	
		$title 					= apply_filters('widget_title', $instance['title']);	


		echo $before_widget;

		if ( $title ) echo $before_title . $title . $after_title; 	

		$mediacast_categories 	= get_terms( 'mediacast_tags');


		echo '<div class="tagcloud">';


		foreach ($mediacast_categories as $key => $value) {
			echo '<a href="' . get_term_link( $value) . '">' . $value->name  . '</a>';
		}


		echo '</div>';
	

		echo $after_widget;
				
	}
	
	
	

	// WIDGET VALUES UPDATE
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] 					= strip_tags( $new_instance['title'] );
		return $instance;
	}

	
	// WIDGET FORM
	public function form( $instance ) {
		if (isset($instance[ 'title' ])) {
			$title 					= $instance[ 'title'];

		} else {
			$title 						= 'New Title';
		}
		

		$args = array(
			'type'		=> 'input',
			'labelfor' 	=> $this->get_field_id( 'title' ),
			'label'		=> __('Title','croma'),
			'id'		=> $this->get_field_id( 'title' ),
			'idname'	=> $this->get_field_name( 'title' ),
			'val'		=> esc_attr( $title ),
			'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);

	}

} // class Foo_Widget


add_action( 'widgets_init', create_function( '', 'register_widget( "cromax_mediacast_tag" );' ) );





/**
 * Cromax mediacast by author
 *
 * @access public
 * @return void
 */
 
class cromax_mediacast_author extends WP_Widget {

	
	public function __construct() {
		parent::__construct(
	 		'cromax_mediacast_authors', // Base ID
			'Mediacast Author listings &nbsp;&nbsp;&nbsp; [C]', // Name
			array( 'description' => __( 'Displays all the authors of a mediacast with counts', 'croma' ), ) // Args
		);
	}


	// WIDGET OUTPUT
	public function widget( $args, $instance ) {


		extract( $args );	
		$title 					= apply_filters('widget_title', $instance['title']);	


		echo $before_widget;

		if ( $title ) echo $before_title . $title . $after_title; 	

		$mediacastusers = get_users( );

		echo '<ul>';

		foreach ($mediacastusers  as $value) {

			$ct 			= cro_count_user_mediacasts( $value->ID);
			$img 			= wp_get_attachment_image( get_the_author_meta( 'cro_user_small_image',$value->ID ), 'thumbnail' );
			$imgwithlink 	= ($img != '')? '<a href="' . get_author_posts_url( $value->ID) . '">' . $img . '</a>'  : '' ;

			if ($ct >= 1 ) {
				echo '<li>' .  $imgwithlink . '<h6><a href="' . get_author_posts_url( $value->ID) . '">' . get_the_author_meta( 'display_name', $value->ID ) . ' (' . $ct . ')</a></h6>';
				echo '<p>' . get_the_author_meta( 'cro_user_designation',$value->ID ) . '</p></li>';

			}

		}


		echo '</ul>';
		echo $after_widget;
				
	}
	
	
	

	// WIDGET VALUES UPDATE
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] 					= strip_tags( $new_instance['title'] );
		return $instance;
	}

	
	// WIDGET FORM
	public function form( $instance ) {
		if (isset($instance[ 'title' ])) {
			$title 					= $instance[ 'title'];

		} else {
			$title 						= 'New Title';
		}
		

		$args = array(
			'type'		=> 'input',
			'labelfor' 	=> $this->get_field_id( 'title' ),
			'label'		=> __('Title','croma'),
			'id'		=> $this->get_field_id( 'title' ),
			'idname'	=> $this->get_field_name( 'title' ),
			'val'		=> esc_attr( $title ),
			'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);

	}

} // class Foo_Widget


add_action( 'widgets_init', create_function( '', 'register_widget( "cromax_mediacast_author" );' ) );





/**
 * Cromax mediacast by author
 *
 * @access public
 * @return void
 */
 
class cromax_mediacast_archives extends WP_Widget {

	
	public function __construct() {
		parent::__construct(
	 		'cromax_mediacast_archives', // Base ID
			'Mediacast archive listings &nbsp;&nbsp;&nbsp; [C]', // Name
			array( 'description' => __( 'Displays all the archives of your mediacast with counts', 'croma' ), ) // Args
		);
	}


	function croc_url($year, $month) {
        global $wp_rewrite;
        $year_month_value = $year . $month;
        $year_month_path = $year . "/" . $month;
        
        $url = home_url() . "/?m=" . $year_month_value . "&post_type=mediacast";        
        if ($wp_rewrite->using_permalinks()) {
            $cat_pos = strpos($wp_rewrite->permalink_structure, "%mediacast%");            
            if ($cat_pos != false) {
                // if %category% is in the permalink structure, figure out if year is before or after it
                $year_pos = strpos($wp_rewrite->permalink_structure, "%year%");                            
                if ($year_pos != false) {
                    $url = home_url() . "/";
                    if ($cat_pos < $year_pos) {
                        $url .= "mediacast/" . $year_month_path . "/";
                    } else {
                        $url .=  $year_month_path . "/mediacast/";
                    }
                }
            }
        }
        return ($url);
    }


	function cromax_getarchives_where_filter($where){
        $where = str_replace( "post_type = 'post'", "post_type = 'mediacast'", $where );
        return $where;
    }


	// WIDGET OUTPUT
	public function widget( $args, $instance ) {


		extract( $args );	
		$title 					= apply_filters('widget_title', $instance['title']);	


		echo $before_widget;

		if ( $title ) echo $before_title . $title . $after_title; 	

		
		  // TBD: could change to call sql statement that uses group by
        $myposts = get_posts("numberposts=-1&offset=0&post_type=mediacast&orderby=date&order=DESC");
        $previous_year_month_display = "";
        $previous_year_month_value = "";        
        $previous_year = "";
        $previous_month = "";
        $count = 0;
        $display_format = "F Y";
        $compare_format = "Ym";
               
        echo "<ul>";


        foreach($myposts as $post) {
            $post_date = strtotime($post->post_date);
            $current_year_month_display = date_i18n($display_format, $post_date);
            $current_year_month_value = date($compare_format, $post_date);
            $current_year = date("Y", $post_date);
            $current_month = date("m", $post_date);
            if ($previous_year_month_value != $current_year_month_value) {
                if ($count > 0) {
                    $url = $this->croc_url($previous_year, $previous_month);                   
                    echo "<li><a href=\"". $url . "\">" . $previous_year_month_display . "</a>";
                    echo  " (" . $count . ")";
                    echo "</li>";
                }
                $count = 0;
            }

            $count++;
            $previous_year_month_display = $current_year_month_display;
            $previous_year_month_value = $current_year_month_value;
            $previous_year = $current_year;
            $previous_month = $current_month;

        }
        if ($count > 0) {
            $url = $this->croc_url($previous_year, $previous_month);
            echo "<li><a href=\"". $url . "\">" . $previous_year_month_display . "</a>";
            echo " (" . $count . ")";
            echo "</li>";
        }
        
        echo "</ul>";



		echo $after_widget;
				
	}
	
	
	

	// WIDGET VALUES UPDATE
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] 					= strip_tags( $new_instance['title'] );
		return $instance;
	}

	
	// WIDGET FORM
	public function form( $instance ) {
		if (isset($instance[ 'title' ])) {
			$title 					= $instance[ 'title'];

		} else {
			$title 						= 'New Title';
		}
		

		$args = array(
			'type'		=> 'input',
			'labelfor' 	=> $this->get_field_id( 'title' ),
			'label'		=> __('Title','croma'),
			'id'		=> $this->get_field_id( 'title' ),
			'idname'	=> $this->get_field_name( 'title' ),
			'val'		=> esc_attr( $title ),
			'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);

	}

} // class Foo_Widget


add_action( 'widgets_init', create_function( '', 'register_widget( "cromax_mediacast_archives" );' ) );





/**
 * Cromax latest mediacast
 *
 * @access public
 * @return void
 */

class cromax_latestmediacast extends WP_Widget {

	
	public function __construct() {
		parent::__construct(
	 		'cromax-latestmediacast', // Base ID
			'Latest Mediacast &nbsp;&nbsp;&nbsp;&nbsp;[C]', // Name
			array( 'description' => __( 'Cromax widget for displaying latest mediacasts', 'croma' ), ) // Args
		);
	}


	// WIDGET OUTPUT
	public function widget( $args, $instance ) {
		$tlset = get_option( 'tlset' );
		extract( $args );
		
		$title 			= apply_filters('widget_title', $instance['title']);
		$events 		= esc_attr($instance['events']);
		$cats 			= esc_attr($instance['cats']);


		$events = (!$events || !is_numeric($events)) ? 3 : $events;


		echo $before_widget;
		if ( ! empty( $title ) )
		echo $before_title . $title . $after_title;


		if ($cats == 0) {
			$args = array( 
						'numberposts' => $events, 
						'post_type' => 'mediacast'
					);
		} else {
			$args = array( 
				'numberposts' => $events, 
				'tax_query' => array(
						array(
							'taxonomy' => 'media_category',
							'terms' => $cats
						)
				),
				'post_type' => 'mediacast'
			);
		}

		$latestnewsposts = get_posts( $args );
		foreach( $latestnewsposts as $post ) :	setup_postdata($post); 
		$imgwithlink = '';


		$mediacaster = get_post_meta($post->ID, 'cro_mediacaster',true);


		if ($mediacaster != 0) {

			$img 			= wp_get_attachment_image( get_the_author_meta( 'cro_user_small_image',$mediacaster ), 'thumbnail' );
			$imgwithlink 	= ($img != '')? '<a href="' . get_permalink( $post->ID) . '">' . $img . '</a>'  : '' ;

		}


		echo '<div class="cromax_singlep clearfix">';


		echo $imgwithlink;

		$text = $post->post_content;
		$text = strip_shortcodes($text);
		$text = wp_trim_words( $text, $num_words = 6, $more = null );

		echo '<h6 class="cromax_accent"><a href="' .  get_permalink($post->ID) .  '">' .   $post->post_title   .  '</a></h6>';
		echo '<p>' . $text . '</p>';



		echo '</div>';

		endforeach; 
		
		echo $after_widget;
	}
	
	
	

	// WIDGET VALUES UPDATE
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['events'] = esc_attr($new_instance['events']);
		$instance['cats'] = esc_attr($new_instance['cats']);

		return $instance;
	}

	
	// WIDGET FORM
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ]) || isset( $instance[ 'events' ])  || isset( $instance[ 'cats' ])   ) {
			$title 			= $instance[ 'title' ];
			$events 		= $instance[ 'events' ];
			$cats 			= $instance[ 'cats' ];
		}
		else {
			$title 			= __( 'New title', 'croma' );
			$events			= 3;
			$cats 			= 0;
		}


		$args = array(
				'type'		=> 'input',
				'labelfor' 	=> $this->get_field_id( 'title' ),
				'label'		=> __('Title','croma'),
				'id'		=> $this->get_field_id( 'title' ),
				'idname'	=> $this->get_field_name( 'title' ),
				'val'		=> esc_attr( $title ),
				'desc'		=> '',
				'options'	=> ''
		);

		echo cromax_make_widget_formpart($args);

		$args = array(
				'type'		=> 'input',
				'labelfor' 	=> $this->get_field_id( 'events' ),
				'label'		=> __('Number of posts','croma'),
				'id'		=> $this->get_field_id( 'events' ),
				'idname'	=> $this->get_field_name( 'events' ),
				'val'		=> esc_attr( $events ),
				'desc'		=> '',
				'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);


		$args = array(
				'type'		=> 'get_casts',
				'labelfor' 	=> $this->get_field_id( 'cats' ),
				'label'		=> __('Category to show','croma'),
				'id'		=> $this->get_field_id( 'cats' ),
				'idname'	=> $this->get_field_name( 'cats' ),
				'val'		=> esc_attr( $cats ),
				'desc'		=> '',
				'options'	=> ''
		);
		echo cromax_make_widget_formpart($args);


	}

} // class Foo_Widget


add_action( 'widgets_init', create_function( '', 'register_widget( "cromax_latestmediacast" );' ) );



?>