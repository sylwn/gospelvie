<?php

add_action('wp_ajax_websitez_options', 'websitez_save_options');

function websitez_save_options() {
	global $wpdb; // this is how you get access to the database
	$websitez_options = array();
	$websitez_current_options = get_option('websitez-options');
	$path = WEBSITEZ_PLUGIN_DIR.'/themes';
	$themes_preinstalled = websitez_get_themes($path,true);

	$preinstalled_themes_update = false;
	foreach($themes_preinstalled as $k=>$v):
		if($v['Template']==$_POST['general']['selected_mobile_theme']){
			//If this is true, this is a theme located in the plugins folder
			//This value will tell the rest of the script to look in the plugin themes folder
			if(get_option(WEBSITEZ_USE_PREINSTALLED_THEMES_NAME)){
				update_option(WEBSITEZ_USE_PREINSTALLED_THEMES_NAME, "true");
				$preinstalled_themes_update = true;
			}
		}
	endforeach;

	//If this is false, it means we're using a theme from the regular themes folder
	//and must tell the rest of the script not to change the theme folder location
	if($preinstalled_themes_update == false){
		if(get_option(WEBSITEZ_USE_PREINSTALLED_THEMES_NAME)){
			update_option(WEBSITEZ_USE_PREINSTALLED_THEMES_NAME, "false");
		}
	}
	
	if(get_option(WEBSITEZ_ADVANCED_THEME))
		update_option(WEBSITEZ_ADVANCED_THEME, $_POST['general']['selected_mobile_theme']);
	if(get_option(WEBSITEZ_BASIC_THEME))
		update_option(WEBSITEZ_BASIC_THEME, $_POST['general']['selected_mobile_theme']);
		
	foreach($_POST as $k=>$v):
		if(is_array($v)){
			foreach($v as $key=>$value):
				$websitez_options[$k][$key] = $value;
			endforeach;
		}
	endforeach;
	$options = $websitez_options;
	
	if($_POST['general']['selected_mobile_theme'] != $websitez_current_options['general']['selected_mobile_theme'] && file_exists(WEBSITEZ_PLUGIN_DIR."/themes/".$_POST['general']['selected_mobile_theme']."/functions.php")):
		include_once(WEBSITEZ_PLUGIN_DIR."/themes/".$_POST['general']['selected_mobile_theme']."/functions.php");
		if(function_exists('verve_get_default_theme_options')):
			$theme_default_options = verve_get_default_theme_options();
			$options = array_merge($options,$theme_default_options);
		endif;
	endif;
	
	$response = array();
	
	if(count($websitez_options) > 0){
		if(update_option('websitez-options', $options)){
			$response['status'] = "true";
			$response['theme'] = $_POST['general']['selected_mobile_theme'];
		}else{
			$response['status'] = "false";
		}
	}else{
		$response['status'] = "false";
	}
	echo json_encode($response);
	die();
}

function websitez_themes_page(){
	global $wpdb, $websitez_plugin_description, $table_prefix, $verve_free_version;
	
	if($_FILES['theLogo']){
		include_once('includes/file.php');
		$overrides = array( 'test_form' => false);
		$file = wp_handle_upload($_FILES['theLogo'], $overrides);
		if(array_key_exists('url', $file)){
			$options = get_option('websitez-options');
			if($options){
				$websitez_options = get_option('websitez-options');
				$websitez_options['images']['logo'] = $file['url'];
				update_option('websitez-options', $websitez_options);
			}
		}
	}
	
	/*if(function_exists('get_allowed_themes'))
		$themes_standard = get_allowed_themes();
	else
		$themes_standard = array();
	*/
	$themes_standard = array();
	$path = WEBSITEZ_PLUGIN_DIR.'/themes';
	$themes_preinstalled = websitez_get_themes($path,true);
	$themes = array_merge($themes_standard,$themes_preinstalled);
	$all_themes = $themes;
	
	if (isset($_GET['action']) ) {
		$preinstalled_themes_update = false;
		if ( 'activate' == $_GET['action'] ) {
			foreach($themes_preinstalled as $k=>$v):
				if($v['Template']==$_GET['template']){
					//If this is true, this is a theme located in the plugins folder
					//This value will tell the rest of the script to look in the plugin themes folder
					if(get_option(WEBSITEZ_USE_PREINSTALLED_THEMES_NAME)){
						update_option(WEBSITEZ_USE_PREINSTALLED_THEMES_NAME, "true");
						$preinstalled_themes_update = true;
					}
				}
			endforeach;

			//If this is false, it means we're using a theme from the regular themes folder
			//and must tell the rest of the script not to change the theme folder location
			if($preinstalled_themes_update == false){
				if(get_option(WEBSITEZ_USE_PREINSTALLED_THEMES_NAME)){
					update_option(WEBSITEZ_USE_PREINSTALLED_THEMES_NAME, "false");
				}
			}
			if(get_option(WEBSITEZ_ADVANCED_THEME))
				update_option(WEBSITEZ_ADVANCED_THEME, $_GET['template']);
			if(get_option(WEBSITEZ_BASIC_THEME))
				update_option(WEBSITEZ_BASIC_THEME, $_GET['template']);
			$activated=true;
		}
	}
	
	//Get the theme that is currently set for mobile devices
	$ct = current_mobile_theme_info($themes);
	unset($themes[$ct->name]);

	uksort( $themes, "strnatcasecmp" );
	$theme_total = count( $themes );
	$per_page = 15;

	if ( isset( $_GET['pagenum'] ) )
		$page = absint( $_GET['pagenum'] );

	if ( empty($page) )
		$page = 1;

	$start = $offset = ( $page - 1 ) * $per_page;

	$page_links = paginate_links( array(
		'base' => add_query_arg( 'pagenum', '%#%' ) . '#themenav',
		'format' => '',
		'prev_text' => __('&laquo;'),
		'next_text' => __('&raquo;'),
		'total' => ceil($theme_total / $per_page),
		'current' => $page
	));

	$themes = array_slice( $themes, $start, $per_page );
	
	$websitez_options = get_option('websitez-options');
?>
<div id="customize">
	<div class="wrap">
		<script type="text/javascript">
			//This is the iframe dom
			var doc;
			var iframe;
			var activeTheme = "<?php echo $ct->template;?>";
			//Setup the iframe dom
			jQuery(document).ready(function () {
				iframe = jQuery('#websitez-preview')[0];
				jQuery(iframe).load(function () { //The function below executes once the iframe has finished loading
					doc = iframe.document || iframe.contentDocument || iframe.contentWindow && iframe.contentWindow.document || null;
					set_links();
			  });
				jQuery('.Multiple').jPicker(
					{
						window: {
							position: {
								x: 'screenCenter',
								y: '100'
							}
						},
						images: {
							clientPath: '<?php bloginfo('url');?>/wp-content/plugins/verve-mobile-plugin/admin/images/'
						}
					},
					function(color,context){
						//update_color(this.id,color.val('all').hex);
						save();
					}
				);
				<?php
				if(isset($_GET['up'])){
				?>
				jQuery('.tools-work-box').each(function(){jQuery(this).hide();});
				jQuery('.options-menu').find('a').removeClass('selected');
				jQuery('#tools-work-customize').show();
				jQuery('#customize-link').addClass('selected');
				<?php
					if($_GET['up'] == "success"){
					?>
						jQuery("#message").html("Logo uploaded successfully!").fadeIn().delay(2000).fadeOut('slow');
					<?php
					}else if($_GET['up'] == "permission"){
					?>
						jQuery("#message").html("The logo could not be saved.").fadeIn().delay(2000).fadeOut('slow');
					<?php
					}else if($_GET['up'] == "fail"){
					?>
						jQuery("#message").html("Logo upload failed. Please try again.").fadeIn().delay(2000).fadeOut('slow');
					<?php
					}else{
					?>
						jQuery("#message").html("An error occured. Please try again.").fadeIn().delay(2000).fadeOut('slow');
					<?php
					}
				}
				?>
				//On page load, scroll to configurator
				reset_screen_location();
				//Make the menu items sortable
				jQuery("#show_items").sortable({update: function(){save();}});
				jQuery("#show_pages_order").sortable({update: function(){save();}});
			});
			function set_links(){
				jQuery("a", doc ).each(
					function(i){
						var linker = jQuery(this).attr("href");
						if(linker && linker.length > 0){
							if(linker.indexOf("?") != -1){
								jQuery(this).attr("href", linker+"&verve-mobile=1");
							}else{
								jQuery(this).attr("href", linker+"?verve-mobile=1");
							}
						}
					}
				);
			}
			function update_color(id,color){
				if(id == "custom_color_light"){
					jQuery("#header", doc ).attr("style", "background: -moz-linear-gradient(bottom, #"+jQuery("#custom_color_dark").val()+", #"+jQuery("#custom_color_light").val()+"); background: -webkit-gradient(linear, center bottom, center top, from(#"+jQuery("#custom_color_dark").val()+"), to(#"+jQuery("#custom_color_light").val()+"));");
				}else if(id == "custom_color_dark"){
					jQuery("#header", doc ).attr("style", "background: -moz-linear-gradient(bottom, #"+jQuery("#custom_color_dark").val()+", #"+jQuery("#custom_color_light").val()+"); background: -webkit-gradient(linear, center bottom, center top, from(#"+jQuery("#custom_color_dark").val()+"), to(#"+jQuery("#custom_color_light").val()+"));");
					jQuery(".post-title", doc ).each(function(i){ this.style.color = "#"+jQuery("#custom_color_dark").val(); });
					jQuery(".calendar-month", doc ).each(function(i){ this.style.backgroundColor = "#"+jQuery("#custom_color_dark").val(); });
				}else if(id == "custom_color_medium_light"){
					jQuery(".post-more", doc ).each(function(i){ this.style.backgroundColor = "#"+jQuery("#custom_color_medium_light").val(); });
				}else if(id == "custom_post_background"){
					jQuery(".post-wrapper", doc ).each(function(i){ this.style.backgroundColor = "#"+jQuery("#custom_post_background").val(); });
				}else if(id == "default_link_color"){
					jQuery("a", doc ).each(
						function(i){
							if(jQuery(this).attr("class").length == 0)
								this.style.color = "#"+jQuery("#default_link_color").val(); 
						}
					);
				}
			}
			function getValue(){
				jQuery( "#header", doc ).toggle("slow");
			}
			function iframe_reload(){
				window.frames["websitez-preview"].location.reload();
			}
			function showMenu(){
				jQuery( ".websitez-menu-content", doc ).show("slow");
				jQuery('.hid', doc ).show();
			}
			function refresh_page(){
				var url = document.URL.replace(/&up=(success|fail|permission)/gi, "");
				window.location = url;
			}
			function reset_screen_location(){
				var position = jQuery("#config-top").position();
				window.scrollTo(0,position.top);
			}
			function click_check(){
				return true;
				if(activeTheme == "verve-mobile" || activeTheme == "corporate-mobile" || activeTheme == "verve-mobile-one"){
					return true;
				}else{
					jQuery("#message").html("This section is not available for this theme.").fadeIn().delay(2000).fadeOut('slow');
					return false;
				}
			}
			function save(){
				var refresh = false;
				//Get the selected pages to show
				var show_pages_items = "";
				jQuery('input[id=show_pages_items_item]:checked').each(function(){show_pages_items += jQuery(this).val()+","});
				//Get the selected categories to show
				var show_categories_items = "";
				jQuery('input[id=show_categories_items_item]:checked').each(function(){show_categories_items += jQuery(this).val()+","});
				//Get the selected blogroll to show
				var show_blogroll_items = "";
				jQuery('input[id=show_blogroll_items_item]:checked').each(function(){show_blogroll_items += jQuery(this).val()+","});
				//Get the order of the menu items
				var menu_order = "";
				jQuery('.tools-work-box-sub').each(function(){menu_order += jQuery(this).attr("id")+",";});
				var data = {
						action: 'websitez_options',
						general: {
							mobile_home_page: jQuery("#mobile_home_page").val(),
							selected_mobile_theme: jQuery("#selected_mobile_theme").val(),
							posts_per_page: jQuery("#posts_per_page").val(),
							twitter_username: jQuery("#twitter_username").val(),
							twitter_username_action: jQuery("#twitter_username_action").val(),
							facebook_url: jQuery("#facebook_url").val(),
							verve_partner_key: jQuery("#verve_partner_key").val(),
							verve_category_id: jQuery("#verve_category_id").val()
						},
						analytics: {
							show_analytics: jQuery("#show_analytics").val(),
							show_analytics_snippet: jQuery("#show_analytics_snippet").val()
						},
						ads: {
							show_header: jQuery("#show_header_ad").val(),
							show_header_snippet: jQuery("#show_header_snippet").val(),
							show_footer: jQuery("#show_footer_ad").val(),
							show_footer_snippet: jQuery("#show_footer_snippet").val(),
						},
						colors: {
							custom_color_light : jQuery("#custom_color_light").val(),
							custom_color_medium_light : jQuery("#custom_color_medium_light").val(),
							custom_color_dark : jQuery("#custom_color_dark").val(),
							default_link_color : jQuery("#default_link_color").val(),
							custom_post_background : jQuery("#custom_post_background").val(),
							custom_header_logo : jQuery("#custom_header_logo").val()
						},
						images: {
							custom_website_background : jQuery('input[id=custom_website_background]:checked').val(),
							header_left_icon : jQuery('input[id=header_left_icon]:checked').val(),
							logo : jQuery("#the_logo").attr("src"),
							custom_background_image : jQuery("#custom_background_image").attr("src")
						},
						sidebar: {
							menu_order: menu_order,
							show_menu: jQuery("#show_menu").val(),
							show_pages: jQuery("#show_pages").val(),
							show_pages_items: show_pages_items,
							show_categories: jQuery("#show_categories").val(),
							show_categories_items: show_categories_items,
							show_blogroll: jQuery("#show_blogroll").val(),
							show_blogroll_items: show_blogroll_items,
							show_meta: jQuery("#show_meta").val(),
							show_search: jQuery("#show_search").val()
						}
					};
					if(jQuery("#delete_logo:checked").val()){
						refresh = true;
						data.images.logo = "";
					}
					if(jQuery("#delete_background:checked").val()){
						refresh = true;
						data.images.custom_background_image = "";
					}
					if(jQuery("#selected_mobile_theme").val() != activeTheme){
						refresh = true;
					}
				jQuery.post(ajaxurl, data, function(response) {
					var r = JSON.parse(response);
					if(r.status == "true"){
						var randomnumber = Math.floor(Math.random()*500);
						jQuery("#websitez-preview").attr("src", "<?php bloginfo('url');?>/?verve-mobile=1&rnd="+randomnumber);
						set_links();
						activeTheme = jQuery("#selected_mobile_theme").val();
						jQuery("#message").html("Update successful!").fadeIn().delay(2000).fadeOut('slow');
						if(refresh == true){
							refresh_page();
						}
						reset_screen_location();
					}else{
						jQuery("#message").html("Update NOT successful!").fadeIn().delay(2000).fadeOut('slow');
					}
				});
				//This should fix caching
				iframe.src = iframe.src;
			}
		</script>
		<a name="top"></a>
		<div class="container">
			<div class="options">
				<div id="config-top" class="tools-menu">
					<p class="logo"><img src="<?php echo plugin_dir_url(__FILE__)."images/verve_logo.png";?>"></p> <p class="tag_line">Mobile Theme and Advertising Solution</p>
					<div style="clear: both;"></div>
					<div class="options-menu">
						<ul>
							<li><a href="" onClick="if(click_check()){jQuery('.tools-work-box').each(function(){jQuery(this).hide();});jQuery('.options-menu').find('a').removeClass('selected');jQuery('#tools-work-general').show();jQuery(this).addClass('selected');}return false;" class="selected">Settings</a></li>
							<li><a href="" onClick="if(click_check()){jQuery('.tools-work-box').each(function(){jQuery(this).hide();});jQuery('.options-menu').find('a').removeClass('selected');jQuery('#tools-work-menu').show();jQuery(this).addClass('selected');}return false;">Menu</a></li>
							<li><a href="" onClick="if(click_check()){jQuery('.tools-work-box').each(function(){jQuery(this).hide();});jQuery('.options-menu').find('a').removeClass('selected');jQuery('#tools-work-customize').show();jQuery(this).addClass('selected');}return false;" id="customize-link">Customize</a></li>
							<li><a href="" onClick="if(click_check()){jQuery('.tools-work-box').each(function(){jQuery(this).hide();});jQuery('.options-menu').find('a').removeClass('selected');jQuery('#tools-work-analytics').show();jQuery(this).addClass('selected');}return false;">Analytics</a></li>
						</ul>
					</div>
					<div class="options-list">
						<div id="tools-work-general" class="tools-work-box" style="display: block;">
							<h2>Verve Settings</h2>
							<em>Please <a href="mailto:matt@vervewireless.com">contact Verve</a> to apply for a partner key.<br/> Once accepted into our ad network, you adhere to our <a href="http://vervewireless.com/privacy.html" target="_blank">privacy policy</a>.</em>
							<div class='tools-work-box-other'>
								<label>Enter your Verve Partner Key:</label>
								<div class="content">
										<input type="text" id="verve_partner_key" value="<?php echo $websitez_options['general']['verve_partner_key']; ?>">
								</div>
								<div style="clear: both;"></div>
							</div>
							<div class='tools-work-box-other'>
								<label>Enter your Verve Category ID:</label>
								<div class="content">
										<input type="text" id="verve_category_id" value="<?php echo $websitez_options['general']['verve_category_id']; ?>" maxlength="4">
								</div>
								<div style="clear: both;"></div>
							</div>
							<h2>General Settings</h2>
							<div class='tools-work-box-other'>
								<label>Select a mobile theme:</label>
								<div class="content">
										<select id="selected_mobile_theme" onChange="save();">
											<option value="<?php echo WEBSITEZ_DEFAULT_THEME; ?>">Please select a mobile theme...</option>
											<?php foreach($all_themes as $name => $mobile_theme): ?>
											<option value="<?php echo $mobile_theme['Template']; ?>" <?php if($ct->name == $name) echo 'selected="selected"'; if($mobile_theme['Template'] == "verve-mobile" || $mobile_theme['Template'] == "corporate-mobile") echo " style='font-weight: bold; font-size: 13px;'";?>><?php _e($name); ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								<div style="clear: both;"></div>
							</div>
							<div class='tools-work-box-other'>
								<label>Select the home page for mobile devices:</label>
								<div class="content">
									<select id="mobile_home_page" onChange="save();">
										<option value="<?php echo get_option('show_on_front');?>"><?php echo ucwords(get_option('show_on_front'));?></option>
									<?php 
									$pages = get_pages(array());
									if(count($pages) > 0){
										foreach($pages as $page):
											if($websitez_options['general']['mobile_home_page'] == $page->ID)
												echo "<option value='".$page->ID."' selected>".$page->post_title."</option>";
											else
												echo "<option value='".$page->ID."'>".$page->post_title."</option>"; 
										endforeach;
									}
									?>
									</select>
								</div>
							</div>
							<div class='tools-work-box-other'>
								<label>Select the number of posts to show per page:</label>
								<div class="content">
									<input type="text" id="posts_per_page" name="posts_per_page" value="<?php if($websitez_options['general']['posts_per_page'] == "") echo get_option("posts_per_page"); else echo $websitez_options['general']['posts_per_page'];?>">
								</div>
							</div>
							<h2>Social Settings</h2>
							<div class='tools-work-box-other'>
								<label>Enter your Twitter username:</label>
								<div class="content">
									<input type="text" id="twitter_username" name="twitter_username" value="<?php if($websitez_options['general']['twitter_username'] != "") echo $websitez_options['general']['twitter_username'];?>">
									<span <?php if($websitez_options['general']['selected_mobile_theme'] != "corporate-mobile") echo 'style="display: none;"';?>>
									<select id="twitter_username_action" onChange="save();">
										<option value="twitter" <?php if($websitez_options['general']['twitter_username_action'] == "twitter") echo "selected";?>>Link to my Twitter.com page.</option>
										<option value="local" <?php if($websitez_options['general']['twitter_username_action'] == "local") echo "selected";?>>Show tweets on my website.</option>
									</select>
									</span>
								</div>
							</div>
							<div class='tools-work-box-other'>
								<label>Enter your Facebook profile or Facebook fan page URL:</label>
								<div class="content">
									<input type="text" id="facebook_url" name="facebook_url" value="<?php if($websitez_options['general']['facebook_url'] != "") echo $websitez_options['general']['facebook_url'];?>" size="40">
								</div>
							</div>
							<div class='tools-work-box-other'>
								<label></label>
								<div class="content">
									<a href="" onClick="save();return false;" class="save rounded-corners">Save</a>
								</div>
							</div>
						</div>
						<div id="tools-work-menu" class="tools-work-box">
							<h2>Menu</h2>
							<p class="desc">To change the order in which they display, select and drag each item.</p>
							<?php
							$menu_order = explode(",",$websitez_options['sidebar']['menu_order']);
							?>
							<ul id="show_items">
								<?php
								foreach($menu_order as $menu):
									if($menu == "show_menu_div"){
								?>
									<li><div class='tools-work-box-sub tools-work-box-other selector' id="show_menu_div" <?php if($websitez_options['general']['selected_mobile_theme'] != "verve-mobile") echo 'style="display: none;"';?>>
										<label>Show custom navigation menu?</label>
										<div class="content">
											<select id="show_menu" onChange="save();"><option value="no" <?php if($websitez_options['sidebar']['show_menu'] == "no") echo " selected";?>>No</option><option value="yes"<?php if($websitez_options['sidebar']['show_menu'] == "yes") echo " selected";?>>Yes</option></select>
										</div>
									</div></li>
									<?php
									}else if($menu == "show_pages_div"){
									?>
									<li><div class='tools-work-box-sub tools-work-box-other selector' id="show_pages_div">
										<label>Show pages?</label>
										<div class="content">
											<select id="show_pages" onChange="save();"><option value="no" <?php if($websitez_options['sidebar']['show_pages'] == "no") echo " selected";?>>No</option><option value="yes"<?php if($websitez_options['sidebar']['show_pages'] == "yes") echo " selected";?>>Yes</option></select>
										</div>
										<?php
										echo "<h2>Which pages should be displayed?</h2>";
										$pages = websitez_get_ordered_pages($websitez_options['sidebar']['show_pages_items']);
										$selected_pages = explode(",",$websitez_options['sidebar']['show_pages_items']);
										echo "<div id='show_pages_div_sub' style='display: none;'>";
										echo "<ul id='show_pages_order'>";
										$i=0;
										foreach($pages as $page):
											if(in_array($page->ID,$selected_pages) || $websitez_options['sidebar']['show_pages_items'] == "")
												echo "<li><input type='checkbox' id='show_pages_items_item' value='".$page->ID."' checked> ".$page->post_title."</li>";
											else
												echo "<li><input type='checkbox' id='show_pages_items_item' value='".$page->ID."'> ".$page->post_title."</li>";
											$i++;
										endforeach;
										echo "</ul>";
										echo "<p><a href='' onClick='save();return false;' class='save rounded-corners'>Save</a></p>";
										echo "</div>";
										echo "<a href='' onClick='jQuery(\"#show_pages_div_sub\").show(\"slow\");jQuery(\"#show_pages_div_sub_show\").hide(\"fast\");jQuery(\"#show_pages_div_sub_hide\").show(\"fast\");return false;' id='show_pages_div_sub_show'><img src='".plugin_dir_url(__FILE__)."images/expand.png' border='0' alt='Expand'></a><a href='' onClick='jQuery(\"#show_pages_div_sub\").hide(\"slow\");jQuery(\"#show_pages_div_sub_hide\").hide(\"fast\");jQuery(\"#show_pages_div_sub_show\").show(\"fast\");return false;' id='show_pages_div_sub_hide' style='display: none;'><img src='".plugin_dir_url(__FILE__)."images/close.png' border='0' alt='Hide'></a>";
										?>
									</div></li>
									<?php
									}else if($menu == "show_categories_div"){
									?>
									<li><div class='tools-work-box-sub tools-work-box-other' id="show_categories_div" <?php if($websitez_options['general']['selected_mobile_theme'] != "verve-mobile") echo 'style="display: none;"';?>>
										<label>Show categories?</label>
										<div class="content">
											<select id="show_categories" onChange="save();"><option value="no"<?php if($websitez_options['sidebar']['show_categories'] == "no") echo " selected";?>>No</option><option value="yes"<?php if($websitez_options['sidebar']['show_categories'] == "yes") echo " selected";?>>Yes</option></select>
										</div>
										<?php
										echo "<h2>Which categories should be displayed?</h2>";
										$categories = get_categories();
										$selected_categories = explode(",",$websitez_options['sidebar']['show_categories_items']);
										echo "<div id='show_categories_div_sub' style='display: none;'><table width='100%'><tr>";
										$i=0;
										foreach($categories as $category):
											if($i%2==0)
												echo "</tr><tr>";
											if(in_array($category->cat_ID,$selected_categories) || $websitez_options['sidebar']['show_categories_items'] == "")
												echo "<td width='50%'><input type='checkbox' id='show_categories_items_item' value='".$category->cat_ID."' checked> ".$category->category_nicename."</td>";
											else
												echo "<td width='50%'><input type='checkbox' id='show_categories_items_item' value='".$category->cat_ID."'> ".$category->category_nicename."</td>";
											$i++;
										endforeach;
										echo "</tr></table>";
										echo "<p><a href='' onClick='save();return false;' class='save rounded-corners'>Save</a></p>";
										echo "</div>";
										echo "<a href='' onClick='jQuery(\"#show_categories_div_sub\").show(\"slow\");jQuery(\"#show_categories_div_sub_show\").hide(\"fast\");jQuery(\"#show_categories_div_sub_hide\").show(\"fast\");return false;' id='show_categories_div_sub_show'><img src='".plugin_dir_url(__FILE__)."images/expand.png' border='0' alt='Expand'></a><a href='' onClick='jQuery(\"#show_categories_div_sub\").hide(\"slow\");jQuery(\"#show_categories_div_sub_hide\").hide(\"fast\");jQuery(\"#show_categories_div_sub_show\").show(\"fast\");return false;' id='show_categories_div_sub_hide' style='display: none;'><img src='".plugin_dir_url(__FILE__)."images/close.png' border='0' alt='Hide'></a>";
										?>
									</div></li>
									<?php
									}else if($menu == "show_blogroll_div"){
									?>
									<li><div class='tools-work-box-sub tools-work-box-other' id="show_blogroll_div" <?php if($websitez_options['general']['selected_mobile_theme'] != "verve-mobile") echo 'style="display: none;"';?>>
										<label>Show blogroll?</label>
										<div class="content">
											<select id="show_blogroll" onChange="save();jQuery('#show_blogroll_items').toggle('slow');"><option value="no"<?php if($websitez_options['sidebar']['show_blogroll'] == "no") echo " selected";?>>No</option><option value="yes"<?php if($websitez_options['sidebar']['show_blogroll'] == "yes") echo " selected";?>>Yes</option></select>
										</div>
										<?php
										echo "<h2>Which links should be displayed?</h2>";
										$blogroll = get_bookmarks();
										$selected_blogroll = explode(",",$websitez_options['sidebar']['show_blogroll_items']);
										echo "<div id='show_blogroll_div_sub' style='display: none;'><table width='100%'><tr>";
										$i=0;
										foreach($blogroll as $blog):
											if($i%2==0)
												echo "</tr><tr>";
											if(in_array($blog->link_id,$selected_blogroll) || $websitez_options['sidebar']['show_blogroll_items'] == "")
												echo "<td width='50%'><input type='checkbox' id='show_blogroll_items_item' value='".$blog->link_id."' checked> ".$blog->link_name."</td>";
											else
												echo "<td width='50%'><input type='checkbox' id='show_blogroll_items_item' value='".$blog->link_id."'> ".$blog->link_name."</td>";
											$i++;
										endforeach;
										echo "</tr></table>";
										echo "<p><a href='' onClick='save();return false;' class='save rounded-corners'>Save</a></p>";
										echo "</div>";
										echo "<a href='' onClick='jQuery(\"#show_blogroll_div_sub\").show(\"slow\");jQuery(\"#show_blogroll_div_sub_show\").hide(\"fast\");jQuery(\"#show_blogroll_div_sub_hide\").show(\"fast\");return false;' id='show_blogroll_div_sub_show'><img src='".plugin_dir_url(__FILE__)."images/expand.png' border='0' alt='Expand'></a><a href='' onClick='jQuery(\"#show_blogroll_div_sub\").hide(\"slow\");jQuery(\"#show_blogroll_div_sub_hide\").hide(\"fast\");jQuery(\"#show_blogroll_div_sub_show\").show(\"fast\");return false;' id='show_blogroll_div_sub_hide' style='display: none;'><img src='".plugin_dir_url(__FILE__)."images/close.png' border='0' alt='Hide'></a>";
										?>
									</div></li>
									<?php
									}else if($menu == "show_meta_div"){
									?>
									<li><div class='tools-work-box-sub tools-work-box-other' id="show_meta_div" <?php if($websitez_options['general']['selected_mobile_theme'] != "verve-mobile") echo 'style="display: none;"';?>>
										<label>Show meta?</label>
										<div class="content">
											<select id="show_meta" onChange="save();"><option value="no"<?php if($websitez_options['sidebar']['show_meta'] == "no") echo " selected";?>>No</option><option value="yes"<?php if($websitez_options['sidebar']['show_meta'] == "yes") echo " selected";?>>Yes</option></select>
										</div>
									</div></li>
								<?php
									}else if($menu == "show_search_div"){
									?>
									<li><div class='tools-work-box-sub tools-work-box-other' id="show_search_div">
										<label>Show search?</label>
										<div class="content">
											<select id="show_search" onChange="save();"><option value="no"<?php if($websitez_options['sidebar']['show_search'] == "no") echo " selected";?>>No</option><option value="yes"<?php if($websitez_options['sidebar']['show_search'] == "yes") echo " selected";?>>Yes</option></select>
										</div>
									</div></li>
									<?php
									}
								endforeach;
								?>
							</ul>
							<div class="tools-work-box-other">
								<p><a href="" onClick="save();return false;" class="save rounded-corners">Save</a></p>
							</div>
						</div>
						<div id="tools-work-customize" class="tools-work-box">
							<h2>Colors</h2>
							<?php
							foreach($websitez_options['colors'] as $k=>$v):
								$vm_do_input = false;
								echo "<div class='tools-work-box-other'><label>";
								if($k == "custom_color_light"){
									echo "Top Header Color</label>";
									$vm_do_input = true;
								}else if($k == "custom_color_medium_light"){
									echo "Content Area Accent</label>";
									$vm_do_input = true;
								}else if($k == "custom_color_dark"){
									echo "Header & Post Color</label>";
									$vm_do_input = true;
								}else if($k == "default_link_color"){
									echo "Standard Link Color</label>";
									$vm_do_input = true;
								}else if($k == "custom_post_background"){
									echo "Post Background</label>";
									$vm_do_input = true;
								}else if($k == "custom_header_logo"){
									echo "Logo Text Font Color</label>";
									$vm_do_input = true;
								}
								if($vm_do_input)
									echo "<div class='content'><input type='text' class='Multiple' id='".$k."' value='".$v."'></div>";
								echo "</div>";
							endforeach;
							?>
							<h2>Images</h2>
							<?php
							if(isset($_GET['up'])){
								if($_GET['up'] == "permission"){
									echo "<p style='color: #ff0000;'>The image could not be saved. This is most likely due to having incorrect permissions on the 'wp-content/uploads' folder. Please set permissions to 777 for this folder and upload your image again.</p>";
								}
							}
							?>
							<?php
							if(array_key_exists('logo',$websitez_options['images']) && strlen($websitez_options['images']['logo']) > 0){
								echo "<img id='the_logo' src='".$websitez_options['images']['logo']."'>";
								echo "<br>Delete logo? <input type='checkbox' value='yes' id='delete_logo' onClick='save();'>";
								echo "<br><br>";
							}
							?>
							<div class="tools-work-box-other">
								<label>Upload a logo</label>
								<div class="content">
									<form action="<?php bloginfo('url');?>/wp-content/plugins/verve-mobile-plugin/admin/uploader.php" method="POST" enctype="multipart/form-data">
									<input type="hidden" name="referrer" value="<?php echo $_SERVER['REQUEST_URI'];?>">
									<input type="file" name="theLogo"> <input type="submit" value="Upload">
									</form>
								</div>
							</div>
							<?php
							if(array_key_exists('custom_background_image',$websitez_options['images']) && strlen($websitez_options['images']['custom_background_image']) > 0){
								echo "<img id='custom_background_image' src='".$websitez_options['images']['custom_background_image']."'>";
								echo "<br>Delete background image? <input type='checkbox' value='yes' id='delete_background' onClick='save();'>";
								echo "<br><br>";
							}
							?>
							<div <?php if($websitez_options['general']['selected_mobile_theme'] != "corporate-mobile") echo 'style="display: none;"';?>>
							Upload a custom header image<br>
							<form action="<?php bloginfo('url');?>/wp-content/plugins/verve-mobile-plugin/admin/uploader.php" method="POST" enctype="multipart/form-data">
							<input type="hidden" name="referrer" value="<?php echo $_SERVER['REQUEST_URI'];?>">
							<input type="file" name="theBackground"> <input type="submit" value="Upload">
							</form>
							<br>
							</div>
							<div class="tools-work-box-other">
								<?php
									$images = array("images/bg-transparent.gif","images/bg.gif","images/bg-grey-bar.gif","images/bg-blue-bar.gif","images/bg-red-bar.gif","images/bg-green-bar.gif","images/bg-blue-bar-horizontal.gif","images/bg-grey-bar-horizontal.gif","images/bg-wingding-d.gif","images/bg-light-blue-horizontal.png","images/bg-light-green-horizontal.png","images/bg-light-grey-solid.png","images/bg-light-red-solid.png","images/bg-light-green-solid.png","images/bg-black-solid.png","images/bg-dark-blue-solid.png","images/bg-medium-brown-solid.png","images/bg-medium-grey-solid.png","images/bg-light-grey-gradient.png","images/bg-reverse-grey.png","images/bg-square-grey.png","images/bg-diagonal-grey.png","images/bg-red-solid.png","images/bg-light-purple-solid.png","images/bg-grey-circle.png");
									echo "<label>Select a background image:</label>";
									echo "<div class='content'>";
									echo "<table>";
									echo "<tr>";
									$i=0;
									foreach($images as $image):
										if($i%5==0)
											echo "</tr><tr>";
										echo "<td style='padding-left: 15px;'>";
										if($websitez_options['images']['custom_website_background'] == $image)
											echo '<input type="radio" name="custom_website_background" id="custom_website_background" value="'.$image.'" onClick="save();" checked> ';
										else
											echo '<input type="radio" name="custom_website_background" id="custom_website_background" value="'.$image.'" onClick="save();"> ';
										echo "</td><td style='background: url(\"".get_bloginfo('url')."/wp-content/plugins/verve-mobile-plugin/themes/verve-mobile-one/".$image."\"); border: 1px solid #666666;' width='50' height='50'>";
										echo '<img src="'.get_bloginfo('url').'/wp-content/plugins/verve-mobile-plugin/themes/verve-mobile-one/'.$image.'">';
										echo "</td>";
										$i++;
									endforeach;
									echo "</tr>";
									echo "</table>";
									echo "</div>";
									?>
									<p><a href="" onClick="save();return false;" class="save rounded-corners">Save</a></p>
								</div>
								<div class="tools-work-box-other" style="display: none;">
									<?php
									$images = array("1_blank.png","1_archive.png","1_article.png","1_chat.png","1_clock.png","1_email.png","1_puzzle.png","1_shirts.png","2_person.png","2_gears.png","2_rss.png","2_house.png","2_book.png","22_house.png","3_smiley.png","3_offer.png","3_fire.png","3_present.png","3_people.png","3_image.png","4_printer.png","4_star.png","5_heart.png","5_compass.png","5_refresh.png","5_bird.png","5_chip.png","6_camera.png");
									echo "<label>Select a header icon:</label>";
									echo "<div class='content'>";
									echo "<table>";
									echo "<tr>";
									$i=0;
									foreach($images as $image):
										if($i%5==0)
											echo "</tr><tr>";
										echo "<td style='padding-left: 15px;'>";
										if($websitez_options['images']['header_left_icon'] == "images/ico/".$image)
											echo '<input type="radio" name="header_left_icon" id="header_left_icon" value="images/ico/'.$image.'" onClick="save();" checked> ';
										else
											echo '<input type="radio" name="header_left_icon" id="header_left_icon" value="images/ico/'.$image.'" onClick="save();"> ';
										echo '</td><td style="padding: 8px 0px;"><img src="'.get_bloginfo('url').'/wp-content/plugins/verve-mobile-plugin/themes/verve-mobile-one/images/ico/'.$image.'">';
										echo "</td>";
										$i++;
									endforeach;
									echo "</tr>";
									echo "</table>";
									echo "</div>";
									?>
								</div>
						</div>
						<div id="tools-work-analytics" class="tools-work-box">
							<h2>Analytics</h2>
							<div class='tools-work-box-other'>
								<label>Use custom analytics?</label>
								<div class="content">
									<select id="show_analytics" onChange="save();"><option value="no" <?php if($websitez_options['analytics']['show_analytics'] == "no") echo " selected";?>>No</option><option value="yes"<?php if($websitez_options['analytics']['show_analytics'] == "yes") echo " selected";?>>Yes</option></select>
								</div>
								<h2>Paste the script you would like to show for the analytics:</h2>
								<textarea id="show_analytics_snippet" rows="8" cols="50"><?php echo stripslashes($websitez_options['analytics']['show_analytics_snippet']) ?></textarea>
								<p><a href="" onClick="save();return false;" class="save rounded-corners">Save</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="phone">
				<div class="phone-container-verve">
					<div id="message" style="display: none; position: absolute; color: #ffffff; padding: 105px 0px 0px 42px; font-weight: bold; font-size: 13px;">
					</div>
					<div class="iphone-verve">
						<iframe id="websitez-preview" name="websitez-preview" src="<?php bloginfo('url');?>/?verve-mobile=1" frameborder="0" class="iphone-box-verve" scrolling="auto"></iframe>
					</div>
				</div>
				<div style="clear: both;"></div>
				<div style="padding: 10px 50px;">
					Note: This is not a 100% accurate preview of the mobile experience. For best results, please visit your site via a mobile device.
				</div>
			</div>
		</div>
	</div>
</div>
<?php
}

function current_mobile_theme_info($themes) {
	$current_theme_safe = get_current_mobile_theme();
	foreach($themes as $k=>$v):
		if($v['Template']==$current_theme_safe){
			$current_theme = $k;
			break;
		}else{
			$current_theme = ucwords(str_replace("-"," ",$current_theme_safe));
		}
	endforeach;

	$ct->name = $current_theme;
	$ct->title = $themes[$current_theme]['Title'];
	$ct->version = $themes[$current_theme]['Version'];
	$ct->parent_theme = $themes[$current_theme]['Parent Theme'];
	$ct->template_dir = $themes[$current_theme]['Template Dir'];
	$ct->stylesheet_dir = $themes[$current_theme]['Stylesheet Dir'];
	$ct->template = $themes[$current_theme]['Template'];
	$ct->stylesheet = $themes[$current_theme]['Stylesheet'];
	$ct->screenshot = $themes[$current_theme]['Screenshot'];
	$ct->description = $themes[$current_theme]['Description'];
	$ct->author = $themes[$current_theme]['Author'];
	$ct->tags = $themes[$current_theme]['Tags'];
	$ct->theme_root = $themes[$current_theme]['Theme Root'];
	$ct->theme_root_uri = $themes[$current_theme]['Theme Root URI'];
	return $ct;
}

function get_current_mobile_theme(){
	$theme = get_option(WEBSITEZ_ADVANCED_THEME);
	return $theme;
}

function websitez_get_ordered_pages($ordered_pages){
	$final_pages = array();
	$not_selected_pages = array();
	$desired_pages = explode(",",$ordered_pages);
	$pages = get_pages('include='.$ordered_pages);
	$ex_pages = get_pages('exclude='.$ordered_pages);
	if($ordered_pages != ""){
		foreach($desired_pages as $dpage):
			foreach($pages as $page):
				if($dpage == $page->ID){
					$final_pages[] = $page;
				}
			endforeach;
		endforeach;
		
		return array_merge($final_pages,$ex_pages);
	}else{
		return $pages;
	}
}
?>