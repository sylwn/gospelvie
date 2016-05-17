<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>

<?php
/**
 * front page page link
 *
 *
 * @author 		Croma
 * @package 	templates
 * @version     1.0
 */



$postarr = get_post_custom($id);


// front page animation
$cro_anim  		=   (isset($postarr['cro_anim'][0]) && $postarr['cro_anim'][0] != 0 )? 
					'data-cro-anim-data="' . $animarr[$postarr['cro_anim'][0]] . '"' : '';	
$cro_animclass  =   ($cro_anim != '' )? ' animated ' : '';



// background image & mask
$float_image 		= get_post_meta( $id, 'cro_layimage', true );
$mask 				= get_post_meta( $id, 'cro_laymask', true );
$maskcolor			= get_post_meta( $id, 'cro_maskcolor', true );
$maskstyle   		= ($maskcolor != '')?  ' background: ' . $maskcolor . '; ' : ''  ;
$maskopacity 		=  $maskstyle . ' opacity:   '   .   ($mask/100)  .  '; ';
$bg 				= ($float_image != '')?  'style="background: url('  .   $float_image  .   ') no-repeat center top fixed; background-size: cover; position: static;overflow: hidden;"'  : '' ;



// titles and content
$page_title 		= get_post_meta( $id, 'cro_pagetitle', true );
$title 				= ($page_title != '')?  '<h2 class="cro_cust_font">' . $page_title . '</h2>' : ''  ;



// twitter details
$num_tweets			= get_post_meta( $id, 'cro_numtweets', true );
$user_tweets		= get_post_meta( $id, 'cro_twitname', true );
$conskey_tweets		= get_post_meta( $id, 'cro_conskey', true );
$consecret_tweets	= get_post_meta( $id, 'cro_consecr', true );
$acctoken_tweets	= get_post_meta( $id, 'cro_acctoken', true );
$accsecret_tweets	= get_post_meta( $id, 'cro_accsecr', true );
$follabel_tweets 	= get_post_meta( $id, 'cro_follabel', true );



// link details
$link_dest 			= 'https://twitter.com/' . $user_tweets;
$link_label 		= get_post_meta( $id, 'cro_follabel', true );
$link_label 		= ($link_label != '')? $link_label : '';
$linktext 			= ($link_dest != '')?  '<p class="cro_fp_linkp"><a href="' . $link_dest   . '" class="cro_cust_bg" title="' . $link_label   . '" target="_blank">' . $link_label   . '</a></p>'  :  '';

?>


<!-- start the section -->
<section class="cro_frontpage_twi  cro_frontpage_scroll cro_frontpage_layout <?php echo $classname; ?>" <?php echo $bg; ?>>
	
	<div class="cro_twi_block">

		<div class="cro_prodmask" style="<?php echo $maskopacity; ?>"></div>

		<!-- content for twitter -->
		<div class="row">
			<div class="large-12 columns <?php echo $cro_animclass; ?>" <?php echo $cro_anim; ?>>
				<?php echo $title; ?>
				<?php echo do_shortcode( '[cromax-twitter username="' . $user_tweets . '" conskey="' . $conskey_tweets . '" consecret="'  . $consecret_tweets .  '" acctoken="'  . $acctoken_tweets .  '" accsecret="'  . $accsecret_tweets .  '" acclabel="'  . $follabel_tweets .  '"  tweetnum="'  . $num_tweets .  '"]' ); ?>
				<?php echo $linktext; ?>
			</div>
		</div>


	</div>

</section>


