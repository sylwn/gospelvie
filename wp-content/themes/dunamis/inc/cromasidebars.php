<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php
/**
 * Main Croma sidebar functions
 *
 *
 * @package Croma.framework
 * @subpackage Croma.framework
 * @since 1.0
 */
 




/**
 * Create the sidebars
 *
 * Contains the main functions to create the sidebars
 *
 * @since 1.0
 * @package	Cromatheme
 * @author Cromatheme
 */ 
function cromasidebars() {


	$msidebars = get_option('cromatic_sidebars');
 
	$sidebarsarray = array(
						array(
							'class' => 'cro_sidebarmain',
							'name' => __('Main Sidebar','croma')
						),
						array(
							'class' => 'cro_footleft',
							'name' => __('Footer Left','croma')
						),
						array(
							'class' => 'cro_footcent',
							'name' => __('Footer Center','croma')
						),
						array(
							'class' => 'cro_footright',
							'name' => __('Footer Right','croma')
						),
						array(
							'class' => 'mediacast',
							'name' => __('Mediacast','croma')
						)					
					);
						
	
	foreach($sidebarsarray as $val) {		
		register_sidebar( array(
			'name' => $val['name'],
			'id' => $val['class'],
			'before_widget' => '<li id="%1$s" class="widget-container %2$s clear"><div class="cro-sidebar-inner">',
			'after_widget' => '</div></li>',
			'before_title' => '<h3 class="widget-title cro_cust_font">',
			'after_title' => '</h3>',
			) 
		);
	}

	if (isset($msidebars) && !empty($msidebars)){

		foreach($msidebars as $crov) {		
		register_sidebar( array(
			'name' => $crov,
			'id' => 'cro_' . sanitize_title($crov),
			'before_widget' => '<li id="%1$s" class="widget-container %2$s clear">',
			'after_widget' => '</li>',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
			) 
		);
	}

	}					
}

add_action( 'widgets_init', 'cromasidebars' );
 
?>