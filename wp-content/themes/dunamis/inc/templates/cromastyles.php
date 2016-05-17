<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}

/**
 * Cromatheme computer generated styles
 *
 *
 * @author 		Croma
 * @package 	templates
 * @version     1.0
 */

?>


a,
#cromaslide .ls-nav-prev:hover,
#cromaslide .ls-nav-next:hover,


.mobilemenupart:hover,

#croma-primarynav .current-menu-item > a,
#croma-primarynav .current-menu-ancestor > a,
#croma-primarynav .current_page_item > a,
#croma-primarynav .current_page_ancestor > a,


.cro_bodysidebar ul li.widget-container ul li a:hover,


.cat_post_wrapper h2 a:hover,


ul.cro_sociallinks li i:hover,


.cro_paging span,


.cro_cust_col,


.croma_searchresult a:hover,


.cro_frontpage_blg h4 a:hover,


#croma-primarynav li a:hover {
	color: <?php echo $color; ?>;
}




.cro_gr_labelholder a,

.cro_cust_bg,

ul.cro_shortcal li .clarlabel:hover,

.cat_audio_wrapper .mejs-container, .cat_audio_wrapper  .mejs-embed, .cat_audio_wrapper  .mejs-embed body,

.cro_bodysidebar ul li.widget-container .tagcloud a,

#comments .comment-reply-link,


.reveal-modal .close-reveal-modal,

.owl-theme .owl-controls .active span,

ul.cro_donationsfrequency li.cro_don_freq_active,

form.wpcf7-form input.wpcf7-submit,

ul.cro_footwidget li.widget-container .tagcloud a,

ul.cro_footwidget li.widget_search input#searchsubmit,

.comments-area input#submit{
	background:  <?php echo $color; ?>;
}

.croma-topbarnav ul li, .croma-topbarnav ul li ul{
	background-color:  <?php echo   esc_attr($croma['cro_submenbg']); ?>;
}

.topbar{
	background:  <?php echo   esc_attr($croma['cro_secondbg']); ?>;
}

.topbar p, ul.cro_sociallinks li a{
	color:  <?php echo   esc_attr($croma['cro_secondcol']); ?>;
}

header#pageheader.cro_standardheader{
	background:  <?php echo   esc_attr($croma['cro_hedcolor']); ?>;
}


.croma-topbarnav ul li a {
  color: <?php echo   esc_attr($croma['cro_submencol']); ?>;
}

.cat_audio_wrapper .mejs-container{
	border-top: 10px solid <?php echo $color; ?>;
	border-bottom: 10px solid <?php echo $color; ?>;
}


.croma-topbarnav ul li a,

.cro_cust_font{
	<?php echo cro_setfont_styles($croma['cro_mainfont']); ?>
}

.croma-logo img {
    padding-bottom: <?php echo   esc_attr($croma['cro_logopadbottom']); ?>px;
    padding-top: <?php echo esc_attr($croma['cro_logopadtop']); ?>px;
}


.cro_menurow{
	background-color: <?php echo esc_attr($croma['cro_mainmenbg']); ?>;
}



@media only screen and (max-width: <?php echo $croma['cro_menresponsive']; ?>px) { 
	.croma-primarynav{ display: none; }
	.mobilemenupart{ display: block;}

}



@media only screen and (max-width: 740px) {

	header#pageheader {
		background:  <?php echo esc_attr($croma['cro_hedcolor']); ?>;
	}

}



.mobilemenupart{
	color: <?php echo esc_attr($croma['cro_mainmencol']); ?>;
}


#croma-primarynav li a {
	<?php echo cro_setfont_styles($croma['cro_menufont']); ?>
	font-size: <?php echo $croma_menfontsize; ?>px;
	color: <?php echo esc_attr($croma['cro_mainmencol']); ?>;
}

.croma-topbarnav ul li a,
.croma-subnav ul li a {
	<?php echo cro_setfont_styles($croma['cro_menufont']); ?>
}



.cro_hp_header {
	<?php echo cro_setfont_styles($croma['cro_headfont']); ?>
}

.cro_hp_body {
	<?php echo cro_setfont_styles($croma['cro_bodyfont']); ?>
}


.croma-subnav {
	padding-top: <?php echo $croma['cro_subpadding'] ;  ?>px;

}


<?php echo $croma['cro_stylerules'];  ?>
