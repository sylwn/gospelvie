<?php
$verve_options = get_verve_options();
?>
<!DOCTYPE html> 

<html <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php bloginfo('name'); ?><?php wp_title(); ?></title>
	<?php if(isset($_GET['verve-mobile'])): ?>
		<meta http-Equiv="Cache-Control" Content="no-cache">
		<meta http-Equiv="Pragma" Content="no-cache">
		<meta http-Equiv="Expires" Content="0">
	<?php endif; ?>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
		<meta name="viewport" content="target-densitydpi=device-dpi" /> 
		<meta name="HandheldFriendly" content="true" /> 
	<meta name="MobileOptimized" content="width" />
		<!-- iPhone Specific --> 
	<meta name="apple-mobile-web-app-capable" content="yes"> 
	<meta name="apple-mobile-web-app-status-bar-style" content="default" /> 
	<meta name="format-detection" content="telephone=no">
	
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
  <meta name="description" content="<?php bloginfo('description'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
	<script src="http://code.jquery.com/jquery-1.5.2.min.js"></script>
	<script type="application/x-javascript">
  addEventListener("load", function(){
      setTimeout(updateLayout, 0);
  }, false);

  var currentWidth = 0;
  
  function updateLayout(){
    if (window.innerWidth != currentWidth){
      currentWidth = window.innerWidth;

      var orient = currentWidth == 320 ? "profile" : "landscape";
      document.body.setAttribute("orient", orient);
      setTimeout(function(){
      	window.scrollTo(0, 1);
      }, 100);            
    }
  }
  
  $(document).ready(function() {
		setInterval(updateLayout, 400);
	});
	</script>
	
	
	
	<script type="text/javascript">
		$(document).ready(function() {
			$("article").click(function(){
				window.location = $(this).attr("data-href");
				return false;
			});
		});
	</script>	
</head>   
	
	
	
	<?php wp_head() ?>
</head>


<body <?php body_class(); ?>>
<?php
if($verve_options['ads']['show_header'] == "yes")
		echo stripslashes($verve_options['ads']['show_header_snippet']);
?>
	<a name="top"></a>
	<div id="header" class="websitez-header">
		<?php
		if("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'] != get_bloginfo('url')."/"){
		?>
		<a href="<?php bloginfo('url'); ?>"><div id="home-image" class="websitez-header-left"></div></a>
		<?php
		}
		if(strlen($verve_options['images']['logo']) > 0){
		?>
		<a href="<?php bloginfo('url'); ?>" class="logo"><img src='<?php echo $verve_options['images']['logo'];?>' border='0' alt=''></a>
		<?php
		}else{
		?>
		<a href="<?php bloginfo('url'); ?>" class="logo"><?php bloginfo('name'); ?></a>
		<?php
		}
		?>
		<a href="#" onClick="websitez_extendMenu(); return false;" class="websitez-header-right"></a>
	</div>

	<div id="menu" class="websitez-menu">
		<div id="sidebar" class="websitez-menu-content">
			<?php get_sidebar(); ?>
			<div style="clear: both;"></div>
		</div>
	
		<a id="menu-open" onClick="$('.websitez-menu-content').toggle('slow'); $('.hid').toggle(); return false;" href="#"><div class="websitez-menu-button hid"><img src="<?php bloginfo('template_url'); ?>/images/small-down-arrow.png" border="0"></div></a>
		<a id="menu-close" onClick="$('.websitez-menu-content').toggle('slow'); $('.hid').toggle();" href="#top"><div class="websitez-menu-button hid hidden"><img src="<?php bloginfo('template_url'); ?>/images/small-up-arrow.png" border="0"></div></a>
	</div>
	<div id="adUnit">
		<?php echo verve_verve_advertisement(); ?>
	</div>
	<!-- end adUnit -->