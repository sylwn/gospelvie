<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?><?php
/**
 * The front page template file.
 *
 *
 * @package Croma.framework
 * @subpackage Croma.framework
 * @since 1.0
 *
 * Template Name: Page front
 */

get_header(); ?>

<!-- fetch front page content -->
<?php get_template_part('inc/templates/croma_frontpage'); ?>



<!-- fetch front page footer -->
<?php get_footer('home'); ?>