<?php
include('../../../../wp-load.php');
include('../../../../wp-config.php');
$status = "fail";
if(stripos($_POST['referrer'],"admin.php?page=verve_themes") !== false){
	include_once('../../../../wp-admin/includes/file.php');
	if(isset($_FILES['theLogo'])){
		$overrides = array( 'test_form' => false);
		$file = wp_handle_upload($_FILES['theLogo'], $overrides);
		if(array_key_exists('url', $file)){
			$options = get_option('websitez-options');
			if($options){
				$websitez_options = get_option('websitez-options');
				$websitez_options['images']['logo'] = $file['url'];
				if(update_option('websitez-options', $websitez_options))
					$status = "success";
			}
		}else{
			$status = "permissions";
		}
	}else if(isset($_FILES['theBackground'])){
		$overrides = array( 'test_form' => false);
		$file = wp_handle_upload($_FILES['theBackground'], $overrides);
		if(array_key_exists('url', $file)){
			$options = get_option('websitez-options');
			if($options){
				$websitez_options = get_option('websitez-options');
				$websitez_options['images']['custom_background_image'] = $file['url'];
				if(update_option('websitez-options', $websitez_options))
					$status = "success";
			}
		}else{
			$status = "permissions";
		}
	}
}
if(isset($_POST['referrer']) && strlen($_POST['referrer']) > 0){
	header("Location: ".$_POST['referrer']."&up=".$status);
}else{
	header("Location: /wp-admin/admin.php?page=verve_themes");
}
?>