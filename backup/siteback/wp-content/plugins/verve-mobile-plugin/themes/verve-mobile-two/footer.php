	<?php
	$verve_options = get_verve_options();
	if(strlen($verve_options['general']['facebook_url']) > 0 || strlen($verve_options['general']['twitter_username']) > 0){
		echo "<div class='websitez-footer' style='text-align: center; padding: 0px;'>";
		if(strlen($verve_options['general']['facebook_url']) > 0)
			echo "<a href='".$verve_options['general']['facebook_url']."' target='_blank'><img src='".get_bloginfo('template_url')."/images/facebook-icon.png' border='0'></a> ";
		if(strlen($verve_options['general']['twitter_username']) > 0)
			echo "<a href='http://twitter.com/".$verve_options['general']['twitter_username']."'><img src='".get_bloginfo('template_url')."/images/twitter-icon.png' border='0'></a> ";
		echo "</div>";
	}
	?>
	<div style="clear: both;"></div>
	<?php wp_footer(); ?>
	<a name="bottom"></a>
</body>
</html>