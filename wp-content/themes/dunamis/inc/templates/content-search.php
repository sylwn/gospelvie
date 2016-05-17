<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?><?php
/**
 * The general post format file
 *
 *
 * @package Croma.framework
 * @subpackage Croma.framework
 * @since 1.0
 */

$croma 				= get_option('cromatic');
$showdate 			= $croma['cro_showpostdate'];
$showexptlngt 		= $croma['cro_excptlngth'];
$date_class 		= ($showdate == 1)? '' : 'cro_notshow_date' ;

get_header(); 
?>

	<!-- Start the section -->
	<?php if ( is_search() || is_category() || is_front_page() || is_tag() || is_front_page() || is_home() || is_archive()) { ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('cromatheme-format-post croma_searchresult'); ?>>
			<div class="cro-articleinner">
	<?php } else { ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div>
	<?php } ?>




	<!-- Post title -->
	<?php if ( is_search() || is_category() || is_front_page() || is_tag() || is_front_page() || is_home() || is_archive()) { ?>
	<header class="entry-title">
		<h2 class="entry-title cro_cust_font">
			<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'croma' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h2>
	</header>
	<?php } ?>



	<!-- render the content -->
	<?php if ( is_search() || is_category() || is_front_page() || is_tag() || is_front_page() || is_home() || is_archive()) { ?>
		
		<div class="entry-summary">
			<?php cro_excerpt($showexptlngt); ?>

		</div><!-- .entry-summary -->

	<?php }  ?>
	

	</div>
</article>
