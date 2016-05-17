<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/**
 * Latest Mediacast
 *
 *
 * @package Cromax
 * @subpackage Cromax
 * @since 1.0
 */




?>



<ul class="cro_latestmediacast">


	<?php foreach ( $mediacast_array as $post ){  



		$mediacaster 	= get_post_meta( $post->ID, 'cro_mediacaster', true );
		$mediacastimg 	= get_the_author_meta( 'cro_user_small_image', $mediacaster );
		$att_image		= wp_get_attachment_image( $mediacastimg, 'thumbnail' );
		$thepreacher 	= get_the_author_meta( 'display_name', $mediacaster );
		$thepreacher 	= ($thepreacher != '')? '<h3 class="cro_cust_font">' . $thepreacher . '</h3>' : '' ;

		if ($att_image == '') {
			$att_image = get_the_post_thumbnail( $post->ID, 'thumbnail' );
		}

	?>


	<li>
		
		<div class="cro_mainpart">

			<?php echo $att_image; ?>

			<h2 class="cro_hp_header"><a href="<?php echo get_permalink($post->ID ); ?>"><?php echo html_entity_decode(esc_attr( stripslashes($post->post_title))) ; ?></a></h2>
			<?php echo $thepreacher; ?>
			<h4><?php echo get_the_date( $d, $post->ID ); ?></h4>

		</div>


		<div class="cro_mediapart">

			<div class="cro_moreinfo">
				<a href="<?php echo get_permalink($post->ID ); ?>" class="cro_hp_body"><?php _e('More Info','croma'); ?></a>
			</div>
			<div class="cro_playerpart">
				<?php echo do_shortcode('[audio mp3="' .  get_post_meta($post->ID, "cro_mediamp3", true) . '"]' ); ?>
			</div>


		</div>







	</li>


	<?php }  ?>


</ul>