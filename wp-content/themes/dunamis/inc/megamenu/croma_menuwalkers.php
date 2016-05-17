<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php

/**
 * Croma Mega menu walkers and template invokers
 *
 *
 * @package Croma.framework
 * @subpackage Croma.framework
 * @since 1.0
 */





/* 
 * -04- ADD MENU DESCRIPTIONS
 * */


class cro_Walker extends Walker_Nav_Menu
{
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
	

		// calculate the indent	
		$indent 		= ( $depth ) ? str_repeat( "\t", $depth ) : '';


		// read the megamenu metabox value
		$cro_megamen 	= get_post_meta($item->ID, 'croma-custom-field', true );


		// reserve variables
		$class_names 	= '';
		$value 			= '';


		// set the classes & class names
		$classes 		= empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names 	= join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );



		if (isset($cro_megamen) && $cro_megamen >= 1) {

			$class_names 	= ' class="' . esc_attr( $class_names ) . ' cro_megamenudropper"';

		} else {
			$class_names 	= ' class="' . esc_attr( $class_names ) . '"';
		}



		//start the output
		$output 		.= $indent . '<li ' . $value . $class_names .'>';


		// add the attibutes
		$attributes  	= ! empty( $item->attr_title ) 	? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes 	.= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes 	.= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes 	.= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';



		// start the output
		$item_output 	= $args->before;
		$item_output 	.= '<a'. $attributes .'>';
		$item_output 	.= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
     	$item_output 	.= '</a>';		
		$item_output 	.= $args->after;


		if (isset($cro_megamen) && $cro_megamen >= 1) {
			$item_output 	.= cro_fetch_megamen_part($cro_megamen);
		}


		
		$output 		.= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}


function cro_custom_walker( $args ) {
    
    return array_merge( 
    	$args, 
    	array('walker' => new cro_Walker()) 
    );

}
add_filter( 'wp_nav_menu_args', 'cro_custom_walker' );






function cro_fetch_megamen_part($cro_megamen) {


	if ($cro_megamen == 0 || 'private' != get_post_status ($cro_megamen ) ) {return;}

	$before 	= '<ul class="submenu cro_megamenu"><li class="menu-item cro_megamenu-item">';
	$after 		= '</li></ul>';
	$leftside	= get_post_meta( $cro_megamen, 'cro_type1', true);
	$rightside	= get_post_meta( $cro_megamen, 'cro_type2', true);
	$mm_layouts	= cromatic_mm_layouts();



	// fetch the google fonts array
	
	$nowside 		= $leftside;
	$nowmetatext 	= 1;
	ob_start();
	include('templates/menuparts/mm-fp' . $nowside . '.php');
	$content 		= ob_get_contents();
	ob_end_clean();



	// fetch the google fonts array
	
	$nowside 		= $rightside;
	$nowmetatext 	= 2;
	ob_start();
	include('templates/menuparts/mm-fp' . $nowside . '.php');
	$content 		.= ob_get_contents();
	ob_end_clean();
	



	return $before . $content . $after;
	
}