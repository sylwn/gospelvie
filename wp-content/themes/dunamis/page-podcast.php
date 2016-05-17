<?php
/**
 * The template for displaying member pages.
 *
 *
 Template Name: Itunes feed
 */
header("Content-Type: application/rss+xml; charset=UTF-8");
echo '<?xml version="1.0" encoding="UTF-8"?>';


 if (WPLANG != ''){
 	$wl = WPLANG;
 } else {
 	$wl = 'en-US';
 }

 $mcat = $tlset['cro_podcat'];
 $mcata = explode(': ', $mcat);
 $mcc = '';
 $mcctr = 1;

 foreach ($mcata as $cro_v) {
 	if ($mcctr <= 1) {
 		$mcc .= '<itunes:category text="' . $cro_v  . '">';
 	} else {
 		$mcc .= '<itunes:category text="' . $cro_v  . '" />';
 	}
 	$mcctr++;
 }

 
 ?>


<?php while ( have_posts() ) : the_post(); 
$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">

	<channel>

		<title><?php the_title(); ?></title>

		<link><?php echo home_url(); ?></link>

		<language><?php echo $wl; ?></language>

		<copyright>&#x2117; &amp; &#xA9; <?php echo date("Y"); ?> <?php echo htmlspecialchars((get_bloginfo('name'))); ?></copyright>

		<itunes:subtitle><?php echo htmlspecialchars((get_bloginfo('description'))); ?></itunes:subtitle>

		<itunes:author><?php echo htmlspecialchars((get_bloginfo('name'))); ?></itunes:author>

		<itunes:summary><?php echo get_the_content(); ?></itunes:summary>

		<description><?php echo get_the_content(); ?></description>

		<itunes:owner>

			<itunes:name><?php echo htmlspecialchars((get_bloginfo('name'))); ?></itunes:name>

			<itunes:email><?php echo get_option('admin_email'); ?></itunes:email>

		</itunes:owner>

		<itunes:image href="<?php echo $image[0]; ?>" />

		<?php echo $mcc; ?>

		</itunes:category>

	<?php endwhile; // end of the loop. ?>		



	<?php

	$args = array(
		'numberposts' => 20,
		'post_type' => 'sermons'
	);

	$the_query = new WP_Query( $args );

	while ( $the_query->have_posts() ) : $the_query->the_post();

	$images = get_children( array( 'post_parent' => get_the_ID(), 'post_type' => 'attachment', 'post_mime_type' => 'audio/mpeg', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );	
	if ( $images ) :
		$total_images = count( $images );
		$image = array_shift( $images );
		foreach ($image as $cro_v){
			$aud_url= wp_get_attachment_url($image->ID);
		}
	endif;


    $x = array_change_key_case(get_headers($aud_url, 1),CASE_LOWER);
    if ( strcasecmp($x[0], 'HTTP/1.1 200 OK') != 0 ) { 
    	$x = $x['content-length'][1]; 
	} else { 
		$x = $x['content-length']; 
	}



	?>

		<item>
			<title><?php the_title(); ?></title>
			<itunes:author><?php echo htmlspecialchars((get_bloginfo('name'))); ?></itunes:author>
			<itunes:summary><?php echo  htmlspecialchars(strip_tags(get_the_excerpt())); ?></itunes:summary>
			<enclosure url="<?php echo $aud_url; ?>" length="<?php echo $x; ?>" type="audio/mpeg" />
			<guid><?php echo $aud_url; ?></guid>
			<pubDate><?php echo get_the_date('D, d M Y H:i:s T', '', ''); ?></pubDate>
		</item>

		<?php endwhile; ?>

	</channel>

</rss>