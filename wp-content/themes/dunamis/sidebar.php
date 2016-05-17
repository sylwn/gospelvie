<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?><?php
/**
 * The main sidebar file
 *
 *
 * @package Croma.framework
 * @subpackage Croma.framework
 * @since 1.0
 */

$sidebarname = '0';

$curquer 		= $wp_query->get_queried_object();

if ( is_page() || is_single())  {  

	$curquer 		= $wp_query->get_queried_object();

	$sidebarbox 	= (get_post_meta($curquer->ID, 'cromabox_sbbar', true) == '')? 0 : get_post_meta($curquer->ID, 'cromabox_sbbar', true);	
	$sidebarname 	= (get_post_meta($curquer->ID, 'cromabox_sidebarnames', true) == '')? 0 : get_post_meta($curquer->ID, 'cromabox_sidebarnames', true);	
} 

$sidebarname = ($sidebarname  == '0' || $sidebarname  == 'cro_sidebarmain')? 'cro_sidebarmain' :  'cro_' . $sidebarname ;


?>

<?php if ( is_active_sidebar($sidebarname) ) : ?>
<aside class="cro_bodysidebar">
	<ul class="mainwidget">
		<?php dynamic_sidebar($sidebarname); ?>
	</ul><!-- #secondary -->
</aside>
<?php endif; ?>