<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?><?php
/**
 * The comments template
 *
 *
 * @package Croma.framework
 * @subpackage Croma.framework
 * @since 1.0
 */

if ( post_password_required() )
	return;
?>


<!-- start the comments area -->
<div id="comments" class="comments-area">

	<!-- if there's comments  -->
	<?php if ( have_comments() ) : ?>

		<!-- add the header -->
		<h2 class="comments-title">
			<?php
				printf( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'croma' ),
				number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>


		<!-- add the comments list -->
		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 74,
				) );
			?>
		</ol><!-- .comment-list -->


		<!-- comment page functions -->
		<?php
			// Are there comments to navigate through?
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
		?>


		<!-- comment navigation -->
		<nav class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text section-heading">
				<?php _e( 'Comment navigation', 'croma' ); ?>
			</h1>
			<div class="nav-previous">
				<?php previous_comments_link( __( '&larr; Older Comments', 'croma' ) ); ?>
			</div>
			<div class="nav-next">
				<?php next_comments_link( __( 'Newer Comments &rarr;', 'croma' ) ); ?>
			</div>
		</nav><!-- .comment-navigation -->


		<?php endif; // Check for comment navigation ?>


		<!-- if comments are closed -->
		<?php if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.' , 'croma' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php comment_form(); ?>

</div><!-- #comments -->