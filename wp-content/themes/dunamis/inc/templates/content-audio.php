<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?><?php
/**
 * The video post format file
 *
 *
 * @package Croma.framework
 * @subpackage Croma.framework
 * @since 1.0
 */

$croma 				= get_option('cromatic');
$showexptlngt 		= $croma['cro_excptlngth'];

get_header(); 

?>

	<!-- Start the section -->
	<?php if ( is_search() || is_category() || is_front_page() || is_tag() || is_front_page() || is_home() || is_archive()) { ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class('cromatheme-format-post'); ?>>
			<div class="cro-articleinner">
	<?php } else { ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div>
	<?php } ?>



	<!-- category time handler -->
	<?php if (is_category() || is_tag() || is_home() || is_archive()) { ?>
		<div class="cat_post_wrapper">
			<div class="croma_blogtime cro_time cro_cust_bg">
				<?php the_time( 'd' ); ?>
					<br/>
				<?php the_time( 'M' ); ?>
			</div>
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



	<!--  show a different type of content for certain type of pages -->
	<?php if ( is_search() || is_category() || is_front_page() || is_tag() || is_front_page() || is_home() || is_archive()) { ?>
		
	<div class="entry-summary cat_audio_wrapper">
			<?php the_content(); ?>

			<?php the_tags('<div class="tagspan">','','</div>'); ?>

			
			<p class="cro_readmorep cro_accent">
				<a href="<?php the_permalink() ?>" class="cro_readmorea cro_cust_bg">
					<i class="icon-link"></i>
				</a>
			</p>	
		</div><!-- .entry-summary -->



	<!-- render summary meta -->
		<footer class="summarymeta clearfix">
			<div class="entry-meta">	
				<?php if ( comments_open() ) { ?>
				<div class="comments-link">
					<?php comments_popup_link( '<i class="icon-comments"></i>' ,'<span class="comment_count">1</span><i class="icon-comments-alt"></i>', '<span class="comment_count">%</span><i class="icon-comments-alt"></i>' ); ?>
				</div><!-- .comments-link -->
			<?php } ?>		
			</div>
		</footer>



	<!-- else render the content -->
	<?php } else { ?>
	<div class="entry-content  cat_audio_wrapper">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	<?php } ?>
	</div>
</article>
