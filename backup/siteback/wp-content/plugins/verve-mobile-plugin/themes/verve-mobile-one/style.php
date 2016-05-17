<?php
header('Content-type: text/css');
if(isset($_GET['verve-mobile'])):
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	//echo "Hi, I am not cached. Current date time according to server:".date("r");
else:
	header("Cache-Control: must-revalidate");
	$offset = 72000 ;
	$ExpStr = "Expires: " . gmdate("D, d M Y H:i:s", time() + $offset) . " GMT";
	header($ExpStr);
endif;
require_once("../../../../../wp-load.php");
//Custom options
$verve_custom_options = get_option('websitez-options');
//Default options
$verve_default_options['colors'] = array(
	"custom_color_light"=>"4f7498",
	"custom_color_medium_light"=>"abbdce",
	"custom_color_dark"=>"3c5975",
	"default_link_color"=>"556b00",
	"custom_post_background"=>"fafafa",
	"custom_header_logo"=>"f5f5f5"
);
$verve_options = array_merge($verve_default_options,$verve_custom_options);
?>
*{
	padding: 0px;
	margin: 0px;
}



ul {
	margin: 0;
	padding: 0 20px 0 20px;
	list-style-type: circle;
	list-style-position: outside;
}

ol {
	margin: 0;
	padding: 0 25px 0 20px;
	list-style-type: decimal;
	list-style-position: outside;
}

li {
	margin-bottom: 5px;
	color: #555;
	list-style-type: disc;
	text-align: left;
	padding-bottom: 5px;
	font-size: 12px;
	margin-right: -15px;
	padding-top: 0;
}

h1, h2, h3, h4{
	padding: 5px 0px 10px;
}

p{
	padding: 5px 0px;
}

label{
	margin: 0px 0px 10px;
}

input {

}

code {
	font-family: Courier, "Courier New", mono;
	color: red;
}

blockquote {
	text-align: left;
	padding: 1px 10px 1px 15px;
	font-size: 90%;
	border-left: 2px solid #ccc;
	margin: 5px 15px;
}

.websitez-header{
	position: relative;
	text-align: center;
	margin: 0 auto;
}

.websitez-header-left{
	position: absolute;
	top: 0px;
	left: 0px;
	z-index: 100;
}

.websitez-header-right{
	position: absolute;
	top: 0px;
	right: 0px;
	z-index: 100;
}

.websitez-menu{

}

.websitez-menu-content{
	display: none;
}

.websitez-container{

}


.websitez-container ul li{
	
	margin: 4px 0px;
	padding: 5px 8px;
	list-style: none;
	font-size: 1.0em;
	border-bottom: 1px solid #ccc;
}


.websitez-navigation{
	text-align: center;
	margin: 0 auto;
}

.websitez-footer{
	text-align: center;
	margin: 0 auto;
}

.websitez-footer-mobile{
	text-align: center;
	margin: 0 auto;
}

<!-- 

.rounded-corners{
	-moz-border-radius: 20px;
	-webkit-border-radius: 20px;
	-khtml-border-radius: 20px;
	border-radius: 20px;
}

-->

.hidden{
	display: none;
}

/*
WordPress Required CSS
*/

.wp-caption, .wp-caption-text, .gallery-caption{
	font-size: .7em;
}

.aligncenter{
	text-align: center;
}

.alignleft{
	text-align: left;
}

.alignright{
	text-align: right;
}

/*
Start of Custom CSS
*/



/* -------------------- 

Verve CSS

-------------------- */



/* -------------------- 

Standard Reset

-------------------- */

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed, 
figure, figcaption, footer, header, hgroup, 
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
	margin: 0;
	padding: 0;
	border: 0;
	font-size: 100%;
	font: inherit;
	vertical-align: baseline;
}


/* --------------------

HTML5 Reset

-------------------- */

article, aside, details, figcaption, figure, 
footer, header, hgroup, menu, nav, section {
	display: block;
}


/* -------------------- 

Global Classes & Reusables

-------------------- */

.bold { font-weight: bold; }
.center { text-align: center; }
.left { float: left; } 
.right { float: right; }
.borbot { border-bottom: 1px solid #ccc !important; }

h1 { float: left; font-size: 18px; }
h2 { float: left; font-size: 14px; }
h3 { float: left; font-size: 12px; }
h4 { float: left; font-size: 12px; }
h5 { float: left; font-size: 12px; }
h6 { float: left; font-size: 12px; }

p {
	margin: 0 0 8px 0;
	padding: 0;
	width: 100%;
	font-size: 14px;
	line-height: 1.4;
	box-sizing:border-box;
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
}

a { text-decoration: underline; color: #00437a; }


/* -------------------- 

Base Styles

-------------------- */

body { 
	margin: 0;
	padding: 0;
	font-family: helvetica, helvetica neue, arial, sans-serif;
	color: #464646;
	-webkit-user-select: none;
	-moz-user-select: none;
	box-sizing:border-box;
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
	overflow-x: hidden;
	background-color: #FAFAFA;
}

header {
	float: left;
	margin: 0;
	padding: 15px 0 15px 0;
	width: 100%;
	background: #005bb1; /* fallback */
    background: -webkit-gradient(linear, left top, left bottom, from(#08408d), to(#005bb1));
    background: -moz-linear-gradient(top,  #08408d,  #005bb1);
    background: -o-linear-gradient(top, #08408d, #005bb1);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#08408d', endColorstr='#005bb1');
	box-sizing:border-box;
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
}

	header img { margin: 0 auto; display: block; }



p.vervecredit {
text-align: center;
}





nav {
	float: left;
	margin: 0;
	padding: 0;
	width: 100%;
	height: 30px;
	border-bottom: 0px solid #ddd;
    box-sizing:border-box;
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
}

	nav a {
		float: left;
		margin: 0;
		padding: 7px 0 0 0;
		height: 30px;
		color: #666;
		text-align: center;
		text-shadow: 0 1px 0 #fff;
		font-weight: bold;
		font-size: 11px;
		text-decoration: none;
		border-top: 1px solid #ddd;
		cursor: pointer;
		background: #c7c7c7; /* fallback */
		background: -webkit-gradient(linear, left top, left bottom, from(#ffffff), to(#c7c7c7));
		background: -moz-linear-gradient(top,  #ffffff,  #c7c7c7);
		background: -o-linear-gradient(top, #ffffff, #c7c7c7);
		filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#c7c7c7');
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;		
	}
	
	nav a.active {
		float: left;
		margin: 0;
		padding: 7px 0 0 0;
		height: 30px;
		color: #666;
		text-align: center;
		text-shadow: 0 1px 0 #fff;
		font-weight: bold;
		font-size: 11px;
		text-decoration: none;
		border-top: 1px solid #ddd;
		cursor: pointer;
		background: #d9d9d9; /* fallback */
   	 	background: -webkit-gradient(linear, left top, left bottom, from(#c7c7c7), to(#ffffff));
    	background: -moz-linear-gradient(top,  #c7c7c7,  #ffffff);
    	background: -o-linear-gradient(top, #c7c7c7, #ffffff);
    	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#c7c7c7', endColorstr='#ffffff');
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
	}
	
	.home {
		width: 100%;
		border-right: 1px solid #999 !important;
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
		margin: 0 auto;
	}
	.search {
		width: 100%;
		border-left: 1px solid #fff !important;
		border-right: 1px solid #999 !important;
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
	}
	.categories {
		width: 36%;
		border-left: 1px solid #fff !important;
		border-right: 1px solid #999 !important;
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
	}
	.settings {
		width: 10%;
		padding-top: 7px !important;
		border-left: 1px solid #fff !important;
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
	}
	
#adUnit {
	float: left;
	margin: 0;
	padding: 5px 0;
	width: 100%;
	height: 65px;
	box-sizing:border-box;
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
	display: block;
	min-height: 65px !important;
}	

	#adUnit img {
		margin: 0 auto;
		display: block;
	}
	
#adUnitFixed {
	position: fixed;
	bottom: -61px;
	width: 100%;
	height: 53px;
	background: #f0f0f0;
	box-sizing:border-box;
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box; 
}	

	#adUnitFixed img {
		margin: 0 auto;
		display: block;
	}

#container {
	float: left;
	margin: 0;
	padding: 0;
	width: 100%;
	min-height: 242px;
	box-sizing:border-box;
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
}

	#container.homeCont {
		float: left;
		margin: 0;
		padding: 0;
		width: 100%;
		min-height: 242px;
		background: #fafafa;
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
	}

section {
	float: left;
	margin: 0;
	padding: 0;
	width: 100%;
	border: none !important;
	box-sizing:border-box;
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
}	

	.secHead {
		float: left;
		margin: 0 0 5px 0;
		padding: 8px 10px;
		width: 100%;
		color: #004374; 
		font-weight: normal;
		border-top: 1px solid #ccc;
		border-bottom: 1px solid #ccc;
		text-shadow: 0 1px 0 #fff;
		box-shadow: 0 1px 3px #888;
		-webkit-box-shadow: 0 1px 3px #888;
		-moz-box-shadow: 0 1px 3px #888;
		cursor: pointer;
		background: url(images/icon-sec-arrow.png) no-repeat 98% 50%, -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(50%,#e5e5e5), color-stop(51%,#dbdbdb), color-stop(100%,#d2d2d2));
		background: url(images/icon-sec-arrow.png) no-repeat 98% 50%, -webkit-linear-gradient(top, #ffffff 0%,#e5e5e5 50%,#dbdbdb 51%,#d2d2d2 100%); 
		background: url(images/icon-sec-arrow.png) no-repeat 98% 50%, -moz-linear-gradient(top, #ffffff 0%, #e5e5e5 50%, #dbdbdb 51%, #d2d2d2 100%); 
		background: url(images/icon-sec-arrow.png) no-repeat 98% 50% -o-linear-gradient(top, #ffffff 0%,#e5e5e5 50%,#dbdbdb 51%,#d2d2d2 100%); 
		filter: url(images/icon-sec-arrow.png) no-repeat 98% 50% progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#d2d2d2',GradientType=0 );
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;		
	}
	
	.secHead-noshadow {
		float: left;
		margin: 0;
		padding: 8px 10px;
		width: 100%;
		color: #004374; 
		font-weight: normal;
		border-top: 1px solid #ccc;
		border-bottom: 1px solid #ccc;
		text-shadow: 0 1px 0 #fff;
		cursor: pointer;
		background: url(images/icon-sec-arrow.png) no-repeat 98% 50%, -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(50%,#e5e5e5), color-stop(51%,#dbdbdb), color-stop(100%,#d2d2d2));
		background: url(images/icon-sec-arrow.png) no-repeat 98% 50%, -webkit-linear-gradient(top, #ffffff 0%,#e5e5e5 50%,#dbdbdb 51%,#d2d2d2 100%); 
		background: url(images/icon-sec-arrow.png) no-repeat 98% 50%, -moz-linear-gradient(top, #ffffff 0%, #e5e5e5 50%, #dbdbdb 51%, #d2d2d2 100%); 
		background: url(images/icon-sec-arrow.png) no-repeat 98% 50% -o-linear-gradient(top, #ffffff 0%,#e5e5e5 50%,#dbdbdb 51%,#d2d2d2 100%); 
		filter: url(images/icon-sec-arrow.png) no-repeat 98% 50% progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#d2d2d2',GradientType=0 );
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;		
	}
	
	.secHeadFlat {
		float: left;
		margin: 0;
		padding: 8px 10px;
		width: 100%;
		color: #666666; 
		font-weight: bold;
		border-top: 1px solid #ccc;
		border-bottom: 0px solid #ccc;
		text-shadow: 0 1px 0 #fff;
		background: #e5e5e5; 
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;		
	}


.secHeadnoarrow {
		float: left;
		margin: 0 0 5px 0;
		padding: 8px 10px;
		width: 100%;
		color: #004374; 
		font-weight: normal;
		border-top: 1px solid #ccc;
		border-bottom: 1px solid #ccc;
		text-shadow: 0 1px 0 #fff;
		box-shadow: 0 1px 3px #888;
		-webkit-box-shadow: 0 1px 3px #888;
		-moz-box-shadow: 0 1px 3px #888;
		cursor: pointer;
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(50%,#e5e5e5), color-stop(51%,#dbdbdb), color-stop(100%,#d2d2d2));
		background:-webkit-linear-gradient(top, #ffffff 0%,#e5e5e5 50%,#dbdbdb 51%,#d2d2d2 100%); 
		background: -moz-linear-gradient(top, #ffffff 0%, #e5e5e5 50%, #dbdbdb 51%, #d2d2d2 100%); 
		background: url(images/icon-sec-arrow.png) no-repeat 98% 50% -o-linear-gradient(top, #ffffff 0%,#e5e5e5 50%,#dbdbdb 51%,#d2d2d2 100%); 
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#d2d2d2',GradientType=0 );
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;		
	}
	



.articleTitle {
	float: left;
	margin: 0 0 5px 0;
	padding: 7px 0 0 0;
	width: 97%;
	font-weight: bold;
	box-sizing:border-box;
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
}	

	
/* -------------------- 

Home Styles

-------------------- */	

article.home {
	float: left;
	margin: 0;
	padding: 10px;
	width: 100%;
	background: url(images/icon-sec-arrow.png) no-repeat 98% 50% #fafafa;
	border-right: none !important;
	border-bottom: 1px solid #ddd;
	box-sizing:border-box;
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;	
}	

	article.home:last-child {
		border-bottom: none;
		
	}

	.articleMod {
		float: left;
		margin: 0;
		padding: 0;
		width: 93%;
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;	
	}
	
		.articleMod img {
			float: left;
			margin: 0 8px 0 0;
			padding: 4px;
			width: 74px;
			height: 74px;
			border: 1px solid #ccc;
			box-shadow: 0 0 6px #bbb;
			-webkit-box-shadow: 0 0 6px #bbb;
			-moz-box-shadow: 0 0 6px #bbb;
			box-sizing:border-box;
			-webkit-box-sizing:border-box;
			-moz-box-sizing:border-box;
		}	
		
		.homeTitle {
			float: left;
			margin: 0 0 5px 0;
			padding: 7px 0 0 0;
			width: 190px;
			font-weight: bold;
			box-sizing:border-box;
			-webkit-box-sizing:border-box;
			-moz-box-sizing:border-box;
		}
		
			@media screen and (orientation:landscape) {
				.homeTitle {
					width: 335px;
				}
			}
		
		.homeDate {
			float: left;
			margin: 0;
			padding: 0;
			width: 190px;
			color: #666666;
			font-size: 12px !important;
			box-sizing:border-box;
			-webkit-box-sizing:border-box;
			-moz-box-sizing:border-box;
		}

			@media screen and (orientation:landscape) {
				.homeDate {
					width: 335px;
				}
			}
			
			
/* -------------------- 

Search Styles

-------------------- */				
			
#searchForm {
	float: left;
	margin: 0;
	padding: 12px 10px 10px 10px;
	width: 100%;
	border-top: 1px solid #98a7b1;
    border-bottom: 1px solid #98a7b1;
	background: #e8eced; /* fallback */
 	background: -webkit-gradient(linear, left top, left bottom, from(#e8eced), to(#b4bec6));
    background: -moz-linear-gradient(top,  #e8eced,  #b4bec6);
    background: -o-linear-gradient(top, #e8eced, #b4bec6);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e8eced', endColorstr='#b4bec6');
	box-sizing:border-box;
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
}		

	#searchForm input { 
		float: left; 
		width: 100%; 
		height: 30px;
		padding: 3px 3px 3px 30px;
		font-size: 18px;
		border: 1px solid #bbb;
		background: url(images/backgrounds/bg-search.png) no-repeat 8px 7px #fff;
		-webkit-border-radius: 15px;
		-moz-border-radius: 15px;
		border-radius: 15px;
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
	}
	
	
/* -------------------- 

Categories Styles

-------------------- */				
			

	.articleTitle {
		float: left;
		margin: 0 0 5px 0;
		padding: 7px 0 0 0;
		width: 97%;
		font-weight: bold;
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
	}	
	
			
			
/* -------------------- 

Story Styles

-------------------- */	

article.story {
	float: left;
	margin: 0;
	padding: 10px;
	width: 100%;
	box-sizing:border-box;
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;	
}		
		
	#storyTitle {
		float: left;
		margin: 0 0 5px 0;
		padding: 0;
		width: 100%;
		font-size: 18px;
		font-weight: bold;
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
	}
	
	#storyByline {
		float: left;
		margin: 0;
		padding: 0;
		width: 100%;
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
	}
	
	#storyOccup {
		float: left;
		margin: 0 0 3px 0;
		padding: 0;
		width: 100%;
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
	}
	
	#storyDate {
		float: left;
		margin: 0;
		padding: 0;
		width: 100%;
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;
	}
	
	#storyCopy {
		float: left;
		margin: 12px 0 0 0;
		padding: 0;
		width: 100%;
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;	
	}
	
		#storyCopy img {
			float: left;
			margin: 0 12px 5px 0;
			padding: 4px;
			width: 130px;
			height: 130px;
			border: 1px solid #ccc;
			box-shadow: 0 0 6px #bbb;
			-webkit-box-shadow: 0 0 6px #bbb;
			-moz-box-shadow: 0 0 6px #bbb;
			box-sizing:border-box;
			-webkit-box-sizing:border-box;
			-moz-box-sizing:border-box;
		}
		
	#storyContact {
		float: left;
		margin: 10px 0 0 0;
		padding: 0;
		width: 100%;
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;	
	}
	
		#storyContact p { margin-bottom: 0px; font-size: 13px; }

		
	#storyShare {
		float: left;
		margin: 20px 0 13px 0;
		padding: 0;
		width: 100%;
		box-sizing:border-box;
		-webkit-box-sizing:border-box;
		-moz-box-sizing:border-box;	
		
	}
	
		#shareContainer {
			margin: 0 auto;
			width: 112px;
			height: 30px;
			border: 0px solid;
		}
	
		.shareButton {
			float: left;
			color: #666;
			padding: 5px 15px;
			font-size: 14px;
			font-weight: bold;
			text-align: center;
			text-shadow: 0 1px 0 #fff;
			text-decoration: none !important;
			border: 1px solid #ccc;	
			background: #d2d2d2; /* fallback */
			background: -webkit-gradient(linear, left top, left bottom, from(#ffffff), to(#d2d2d2)); 
			background: -moz-linear-gradient(top,  #ffffff,  #d2d2d2);
			background: -o-linear-gradient(top, #ffffff, #d2d2d2); 
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#d2d2d2'); 
			border-radius: 15px;
			-moz-border-radius: 15px;
			-webkit-border-radius: 15px;
			box-shadow: 0 1px 3px #999;
			-webkit-box-shadow: 0 1px 3px #999;
			-moz-box-shadow: 0 1px 3px #999;

		}




	

footer {
	float: left;
	margin: 0;
	padding: 20px 10px;
	width: 100%;
	min-height: 50px;
	background: #00428d; /* fallback */
    background: -webkit-gradient(linear, left top, left bottom, from(#000033), to(#00428d));
    background: -moz-linear-gradient(top,  #000033,  #00428d);
    background: -o-linear-gradient(top, #000033, #00428d);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#000033', endColorstr='#00428d');
    box-sizing:border-box;
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;
}

	footer p { margin-bottom: 0px; color: #fff; font-size: 12px; }
	footer p.footlogo { margin-top: 20px; }









body{
	background: url("<?php echo $verve_options['images']['custom_website_background'];?>") repeat;
}

a:link, a:visited{
	color: #<?php echo $verve_options['colors']['default_link_color'];?>;
	text-decoration: none;
}

.websitez-header{
	background: -moz-linear-gradient(bottom, #<?php echo $verve_options['colors']['custom_color_dark'];?>, #<?php echo $verve_options['colors']['custom_color_light'];?>);
	background: -webkit-gradient(linear, center bottom, center top, from(#<?php echo $verve_options['colors']['custom_color_dark'];?>), to(#<?php echo $verve_options['colors']['custom_color_light'];?>));
	-webkit-box-shadow:#333333 1px 1px 3px;
	border-bottom: 1px solid #000000;
	min-height: 42px;
}

.websitez-header-left{
	height: 40px;
	width: 40px;
	background: url("<?php echo $verve_options['images']['header_left_icon'];?>") no-repeat;
	background-position: 6px 6px;
}

.websitez-header .logo{
	margin: 0px 40px;
	padding: 12px 0px;
	display: block;
	overflow: hidden;
	font-weight: bold;
	font-size: 1.4em;
	color: #<?php echo $verve_options['colors']['custom_header_logo'];?>;
	text-shadow: #333333 1px 1px 1px;
}

.websitez-header .logo_addition{
	margin: 0px 40px;
	padding: 0px 0px 6px;
	display: block;
	overflow: hidden;
	font-weight: bold;
	font-size: 1.2em;
	color: #<?php echo $verve_options['colors']['custom_header_logo'];?>;
	text-shadow: #333333 1px 1px 1px;
}

.websitez-header-right{

}

.websitez-menu{
	margin: 0 10px;
	-moz-border-radius-bottomleft: 10px;
	-moz-border-radius-bottomright: 10px;
	-webkit-border-bottom-left: 10px;
	-webkit-border-bottom-right: 10px;
	border-bottom-left-radius: 10px;
	border-bottom-right-radius: 10px;
	-khtml-border-bottom-left-radius: 10px;
	-khtml-border-bottom-right-radius: 10px;
	background-color: #ffffff;
	-webkit-box-shadow:#333333 1px 1px 3px;
	border-bottom: 1px solid #999999;
	border-right: 1px solid #999999;
	border-left: 1px solid #999999;
}

.websitez-menu-content{
	padding: 5px 10px;
}

.websitez-menu-button{
	text-align: center;
	padding: 5px 0px 3px;
}

.websitez-container{
	padding: 10px 10px 0px;
}

.websitez-container h4{
	text-align: center;
	color: #333333;
	padding: 0px 0px 10px;
}

.websitez-container .post{
	background: #<?php echo $verve_options['colors']['custom_post_background'];?>;
	margin-bottom: 10px;

}

.websitez-container .post-wrapper{
	padding: 10px 10px 5px;
}

.websitez-container .post-title{
	color: #<?php echo $verve_options['colors']['custom_color_dark'];?>;
	font-size: 1.3em;
	font-weight: bold;
	word-wrap: break-word;
}

.websitez-container .post-author{
	color: #000000;
	font-size: .8em;
}

.websitez-container .post-tags{
	color: #000000;
	font-size: .8em;
	margin-bottom: 5px;
}

.websitez-container .post-more{
	color: #000000;
	font-size: .7em;
	background-color: #<?php echo $verve_options['colors']['custom_color_medium_light'];?>;
	
}

.websitez-container .post-view-more{
	text-align: right;
	padding: 5px 5px;
	float: right;
	width: 60%;
}

.websitez-container .post-read-more{
	text-align: left;
	padding: 3px 5px;
	float: left;
	width: 100%;
	color: #333333;
}

.calendar{
	text-align:center;
	position:relative;
	margin-bottom:5px;
	margin-right:10px;
	margin-top:0;
	border:1px solid #<?php echo $verve_options['colors']['custom_color_dark'];?>;
	top:0px;
	float:left;
	-webkit-border-top-left-radius:9px;
	-webkit-border-top-right-radius:0px;
	-webkit-border-bottom-left-radius:0px;
	-webkit-border-bottom-right-radius:9px;
	-webkit-box-shadow:#999999 1px 1px 4px;
}
.calendar-month{
	font-size:11px;
	font-weight:bold;
	color:#fff;
	letter-spacing:0;
	text-shadow:#000000 1px 1px 0px;
	text-transform:uppercase;
	padding:3px 10px;
	-webkit-border-top-left-radius:7px;
	-webkit-border-top-right-radius:0px;
	background-color: #<?php echo $verve_options['colors']['custom_color_dark'];?>;
}
.calendar-day{
	color:#111;
	background-color:#e9e9e9;
	text-shadow:#ffffff 1px 1px 1px;
	-webkit-border-bottom-left-radius:0px;
	-webkit-border-bottom-right-radius:9px;
	font:bold 18px "Arial Rounded MT Bold", Helvetica, Geneva, sans-serif;
	padding:2px 0 3px;
	text-align:center;
}

.websitez-navigation a{
	font-size: 1.3em;
	color: #333333;
	font-weight: bold;
}

.websitez-footer{
	padding: 5px 0px;
	font-size: .7em;
}

/*
Search
*/

.websitez-search{
	padding: 3px 0px 5px;
	text-align: center;
}

.websitez-search h3{
	margin: 0;
	padding: 5px 0px 0px;
	color: #333333;
	text-align: left;
}

.websitez-search-input{
	width: 93%;
	text-align: left;
	margin: 0 auto;
	padding: 2px 5px;
	font-size: 1.0em;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	-khtml-border-radius: 10px;
	border-radius: 10px;
}

/*
Sidebar
*/

.websitez-sidebar h3{
    color: #333333;
    display: block;
    float: none !important;
    font-size: 14px;
    font-weight: bold;
    margin: 0;
    padding: 8px 0 8px 10px;
    text-transform: uppercase;
	width: 100%;
	color: #666666; 
	border-top: 1px solid #ccc;
	border-bottom: 0px solid #ccc;
	text-shadow: 0 1px 0 #fff;
	background: #e5e5e5; 
	box-sizing:border-box;
	-webkit-box-sizing:border-box;
	-moz-box-sizing:border-box;	   
}
	

.websitez-sidebar ul{
	margin: 0;
	padding: 0;
}

.websitez-sidebar ul li{
	margin: 4px 0px;
	background-color: #ffffff;
	padding: 5px 8px;
	list-style: none;
	font-size: 1.0em;
	border-bottom: 1px solid #ccc;
}


.homeCont h3, .commenttitle {
float: none !important;
font-size: 16px;
 font-weight: bold;
}





#reply-title {
    float: none !important;
    margin: 0 0 10px;
    font-size: 16px;
 font-weight: bold;
}





/*
Comments
*/

input[type=submit] {
	color: #333;
}
#respond {
	margin: 10px 0;
	overflow: hidden;
	position: relative;
}
#respond p {
	margin: 0;
}
#respond .comment-notes {
	margin-bottom: 1em;
}
.form-allowed-tags {
	line-height: 1em;
}
.children #respond {
	margin: 0 48px 0 0;
}
h3#reply-title {
	margin: 0px 0 10px;
}
#comments-list #respond {
	margin: 0 0 18px 0;
}
#comments-list ul #respond {
	margin: 0;
}
#cancel-comment-reply-link {
	font-size: 12px;
	font-weight: normal;
	line-height: 18px;
}
#respond .required {
	color: #ff4b33;
	font-weight: bold;
}
#respond label {
	color: #888;
	font-size: 1.1em;
}
#respond input {
	margin: 0 0 9px;
	width: 98%;
	font-size: 1.1em;
}
#respond textarea {
	width: 98%;
	font-size: 1.1em;
}
#respond .form-allowed-tags {
	color: #888;
	font-size: 12px;
	line-height: 18px;
}
#respond .form-allowed-tags code {
	font-size: 11px;
}
#respond .form-submit {
	margin: 12px 0;
}
#respond .form-submit input {
	font-size: 14px;
	width: auto;
}

.websitez-comments{
	margin-bottom: 10px;
}

.websitez-comments-p{
	padding: 0px 0px 10px;
}

.websitez-comments-author{
	float: left;
	position: relative;
	text-align: center;
	margin-right: 10px;
}

.websitez-comments-author-link{
	text-align: center;
	padding: 5px 0px;
}

.websitez-comments-text{
	padding-top: 0px;
	margin-top: 0px;
}

.websitez-comments-reply{
	padding-top: 10px;
}

.websitez-comments-awaiting-moderation{
	font-weight: bold;
	color: #ff0000;
	padding-bottom: 10px;
}