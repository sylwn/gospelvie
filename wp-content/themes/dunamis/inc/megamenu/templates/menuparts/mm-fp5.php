<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>

<?php
/**
 * 2 latest news posts
 *
 *
 * @author 		Croma
 * @package 	templates
 * @version     1.0
 */

$cats = get_post_meta( $cro_megamen, 'cro_categories-' . $nowmetatext, true );

if ($cats == 0) {
	$args = array( 'numberposts' => 2);
} else {
	$args = array( 'numberposts' => 2, 'category'    => $cats);
}


$latestmmposts = get_posts( $args );

?>


<!-- start the section  -->
<div class="cro_mm_oneside cro_mm_latestnews clearfix">



		<?php foreach( $latestmmposts as $mm_post ) {	

			setup_postdata($mm_post); 
			$theimg = get_the_post_thumbnail($mm_post->ID,'cro_third');

		?>

		<div class="cro_mm_singlepost">


		<?php if ($theimg) {  ?>

			<a href="<?php echo  get_permalink($mm_post); ?>"><?php echo $theimg; ?></a>

		<?php } 

		$text = $mm_post->post_content;
		$text = strip_shortcodes($text);
		$text = wp_trim_words( $text, $num_words = 6, $more = null );

		?>

			<h6 class="cromax_accent"><a href="<?php echo  get_permalink($mm_post->ID); ?>"><?php echo $mm_post->post_title; ?></a></h6>
			<p><?php echo $text; ?></p>

		</div>


		<?php }  ?>




</div>




