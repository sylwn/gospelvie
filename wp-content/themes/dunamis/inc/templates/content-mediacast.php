<?php
// File Security Check
if ( ! function_exists( 'wp' ) && ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

/**
 * The mediacastt format file
 *
 *
 * @package Croma.framework
 * @subpackage Croma.framework
 * @since 1.0
 */


?>



	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >

		<div class="cro_mediacast_imagepart">

			<?php
				$mediacaster 	= (get_post_meta( $post->ID, 'cro_mediacaster', true ) >= 1)? get_post_meta( $post->ID, 'cro_mediacaster', true ) :  0;
				$mediacastimg 	= ($mediacaster >= 1)? get_the_author_meta( 'cro_user_small_image', $mediacaster ): 0;
				$att_image		= wp_get_attachment_image( $mediacastimg, 'thumbnail' );
				$thepreacher 	= ($mediacaster >= 1)? get_the_author_meta( 'display_name', $mediacaster ) : '';
				$thepreacher 	= ($thepreacher != '')? '<h5 class="cro_cust_font">' . $thepreacher . '</h5>' : '' ;


				if ($att_image == '') {
					$att_image = get_the_post_thumbnail( $post->ID, 'thumbnail' );
				}

				echo $att_image; 
				echo $thepreacher; 
			?>
												
			<h6 class="cro_cust_bg"><?php echo get_the_date( $d ); ?></h6>
		</div>


		<div class="cro_mediacast_sermonpart">
			<?php 
				echo cro_fetch_microphone($post->ID); 
				echo cro_fetch_videocast($post->ID); 
				echo cro_fetch_download($post->ID); 
				echo cro_fetch_notes($post->ID);
				echo cro_fetch_commentslink($post->ID, $post->comment_status); 
			?>
		</div>

									

		<div class="cro_mediacast_mainpart">

			<div class="cro_playerholder"><?php echo fetch_mp3player($post->ID); ?></div>

			<div class="cro_mediacast_innerpart">

				<h4 class="cro_cust_font"><?php the_title(); ?></h4>

					<div class="entry-summary">

						<?php if (is_single()) {  ?>

							<div class="cro_singlepart" style="padding-bottom: 50px;">

							<?php the_content();  ?>


							</div>


						<?php } else {  ?>


							<?php cro_excerpt(20);  ?>

							<p class="cro_readfurther">
								<a href="<?php the_permalink(); ?>" class="cro_cust_font cro_cust_bg">
									<?php _e('Read further','croma'); ?>
								</a>
							</p>


						<?php  }  ?>

						<?php $tcat = get_the_term_list( $post->ID, 'mediacast_tags', '<li>', '</li><li>', '</li>' );

						if ($tcat != '') {
							echo '<ul class="cro_messagetags">' . $tcat . '</ul>';
						}  ?>

					</div>

			</div>

		</div>

	</article>


	







