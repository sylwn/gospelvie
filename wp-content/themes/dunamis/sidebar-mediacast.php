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



?>


<?php if ( is_active_sidebar('mediacast') ) : ?>
<aside class="cro_bodysidebar">
	<ul class="mainwidget">
		<?php dynamic_sidebar('mediacast'); ?>
	</ul><!-- #secondary -->
</aside>
<?php endif; ?>