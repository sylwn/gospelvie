<?php
if ( ! isset( $content_width ) )
	$content_width = 480;

add_action( 'after_setup_theme', 'set_verve_options' );
add_action( 'after_setup_theme', 'verve_setup' );
add_action( 'after_setup_theme', 'verve_insert_analytics' );
//add_action( 'after_setup_theme', 'verve_insert_header_ad' );
//add_action( 'after_setup_theme', 'verve_insert_footer_ad' );
//add_action( 'after_setup_theme', 'verve_insert_logo' );
add_filter('pre_get_posts', 'verve_post_results');

function verve_get_default_theme_options(){
	$verve_default_options['colors'] = array(
		"custom_color_light"=>"999999",
		"custom_color_medium_light"=>"666666",
		"custom_color_dark"=>"FFFFFF",
		"default_link_color"=>"FFFFFF",
		"custom_post_background"=>"000000",
		"custom_header_logo"=>"FFFFFF",
		"custom_website_background"=>"000000"
	);
	
		$verve_default_options['images'] = array(
	"custom_website_background"=>"images/bg-black-solid.png",
);
	
	return $verve_default_options;
}

function get_verve_options(){
	return $GLOBALS['websitez_options'];
}

function set_verve_options(){
	$GLOBALS['websitez_options'] = get_option('websitez-options');
}

function verve_post_results($query){
	$options = verve_get_options();
	if(is_numeric($options['general']['posts_per_page']) && $options['general']['posts_per_page'] > 0){
		$query->query_vars['posts_per_page'] = $options['general']['posts_per_page'];
	}
	return $query;
}

function verve_insert_logo(){
	if (is_feed()){
		return;
	}

	ob_start("websitez_insert_logo_now");
}

function verve_insert_logo_now($html){
	$options = verve_get_options();
	if($options && strlen($options['images']['logo']) > 0){
		$html = preg_replace("/<a.*class=\"logo\">(.*?)<\/a>/im", "<a href='".get_bloginfo('url')."' class='logo'><img src='".$options['images']['logo']."' border='0' alt=''></a><a href='".bloginfo('url')."' class='logo_addition'>".get_bloginfo('name')."</a>", $html);
	}
	return $html;
}

function verve_insert_header_ad(){
	if (is_feed()){
		return;
	}

	ob_start("websitez_insert_header_ad_now");
}

function verve_insert_footer_ad(){
	if (is_feed()){
		return;
	}

	ob_start("websitez_insert_footer_ad_now");
}

function verve_insert_analytics(){
	if (is_feed()){
		return;
	}

	ob_start("websitez_insert_analytics_now");
}

function verve_get_options(){
	return get_option('websitez-options');
}

function verve_insert_header_ad_now($html){
	$options = verve_get_options();
	if($options['ads']['show_header'] == "yes")
		$html = preg_replace("/<body(.*?)>/im", "<body>\n".stripslashes($options['ads']['show_header_snippet']), $html);
	return $html;
}

function verve_insert_footer_ad_now($html){
	$options = verve_get_options();
	if($options['ads']['show_footer'] == "yes")
		$html = preg_replace("/<\/body>/im", stripslashes($options['ads']['show_footer_snippet'])."\n</body>", $html);
	return $html;
}

function verve_insert_analytics_now($html){
	$options = verve_get_options();
	if($options['analytics']['show_analytics'] == "yes")
		$html = preg_replace("/<\/body>/im", stripslashes($options['analytics']['show_analytics_snippet'])."\n</body>", $html);
	return $html;
}

/*
Dynamically load stylesheet
*/
add_action( 'wp_print_styles', 'verve_stylesheet');
if (!function_exists('verve_stylesheet')){
	function verve_stylesheet() {
		if(isset($_GET['verve-mobile'])):
			$myStyleUrl = get_bloginfo('template_url').'/style.php?verve-mobile=1';
		else:
			$myStyleUrl = get_bloginfo('template_url').'/style.php';
		endif;
		wp_register_style('websitez-custom-stylesheet', $myStyleUrl);
		wp_enqueue_style( 'websitez-custom-stylesheet');
	}
}

if (!function_exists('verve_setup')){
	function verve_setup() {
		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );
	}
}

function verve_verve_advertisement(){
	$verve_options = get_verve_options();
	if(strlen($verve_options['general']['verve_partner_key']) > 0):
		$partner_key = $verve_options['general']['verve_partner_key'];
	else:
		$partner_key = "wpblogger";
	endif;
	if(strlen($verve_options['general']['verve_category_id']) > 0):
		$category_id = $verve_options['general']['verve_category_id'];
	else:
		$category_id = "";
	endif;
?>
		<script type='text/javascript'>
		
		<!--//<![CDATA[

var m3_u = 'http://adcel.vrvm.com/adtag.js';
var m3_r = Math.floor(Math.random() * 99999999999);
var category="<?php echo $category_id;?>";
if (!document.MAX_used) document.MAX_used = ',';
document.write("<scr" + "ipt type='text/javascript' src='" + m3_u);
document.write("?c=" + category +"&b=<?php echo $partner_key; ?>&p=ptnr");

document.write('&cb=' + m3_r);
if (document.MAX_used != ',') document.write("&exclude=" + document.MAX_used);
document.write(document.charset ? '&charset=' + document.charset :
(document.characterSet ? '&charset=' + document.characterSet : ''));

document.write("&loc=" + escape(window.location));
if (document.referrer) document.write("&referer=" + escape(document.referrer));
if (document.context) document.write("&context=" + escape(document.context));

if (document.mmm_fo) document.write("&mmm_fo=1");

document.write("'><\/scr" + "ipt>");

//]]>-->
</script>
<?php
}

function verve_comment($comment, $args, $depth){
	$GLOBALS['comment'] = $comment;
?>
	<div class="websitez-comments" <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<div class="websitez-comments-author">
			<p class="websitez-comments-gravatar"><?php  if(function_exists('get_avatar')){ echo get_avatar($comment, '80'); } ?></p>
			<p class="websitez-comments-author-link"><?php  comment_author_link() ?></p>
		</div>
		<?php if ($comment->comment_approved == '0') : ?>
	   	<p class="websitez-comments-awaiting-moderation"><?php _e('This comment is awaiting moderation.'); ?></p>
	  <?php endif; ?>
		<p class="websitez-comments-text"><?php comment_text() ?></p>
		<p class="websitez-comments-reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>
		<div style="clear: both;"></div>
	</div>
<?php
}
?>