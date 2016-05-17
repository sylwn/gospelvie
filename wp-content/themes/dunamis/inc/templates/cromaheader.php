<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>

<?php
/**
 * The template for displaying the header and header image
 *
 *
 * @author 		Croma
 * @package 	templates
 * @version     1.0
 */



$typearray 		= array('post','page','calendar');
$curquer 		= $wp_query->get_queried_object();
$croma 			= get_option('cromatic');

$headerimage 	= $croma['cro_headimg'];
$imagetile 		= $croma['cro_imgtile'];
$headerheights 	= $croma['cro_headheight'];
$textcolor 		= $croma['cro_headtextcol'];
$maskcolor 		= $croma['cro_headmaskcol'];
$maskpercent 	= $croma['cro_headmask'];

if (is_single() && in_array(get_post_type(), $typearray) || is_page() && in_array(get_post_type(), $typearray)) {


	$args 				= array( 'cro_headimg_src','cro_header_tileformat','cro_headimg_boxheight','cro_headimg_txtcol','cro_headimg_maskcol','cro_headimg_boxmask','cro_header_enabled','cro_header_mapaddress','cro_header_maplat','cro_header_maplng','cro_header_sliderselect');
	$solutions 			= cromatheme_processmetas($args, $curquer->ID);



	if ($solutions[6] == "2") {
		$att_img 			= wp_get_attachment_image_src($solutions[0],'full');


		$headerimage 		= ($solutions[0] != '')? $att_img[0] 									: $croma['cro_headimg'];
		$imagetile 			= ($solutions[1] != '')? $solutions[1] 									: $croma['cro_imgtile'];
		$headerheights 		= ($solutions[2] != '140' || !$solutions[2] != '')? $solutions[2] 		: $croma['cro_headheight'];
		$textcolor 			= ($solutions[3] != '')? $solutions[3] 									: $croma['cro_headtextcol'];
		$maskcolor 			= ($solutions[4] != '')? $solutions[4] 									: $croma['cro_headmaskcol'];
		$maskpercent 		= ($solutions[5] != '1' || $solutions[5] != '')? $solutions[5] 			: $croma['cro_headmask'];

	}

	$solutionstring = $solutions[7] . $solutions[8] . $solutions[9];

	if ($solutions[6] == "3" && $solutions[7] . $solutions[8] . $solutions[9] != '' ) {
		$headerheights 		= ($solutions[2] != '140' || !$solutions[2] != '')? $solutions[2] 		: $croma['cro_headheight'];
		$address 			= ($solutions[7] != '')? $solutions[7] 									: '';
		$lat				= ($solutions[8] != '')? $solutions[8] 									: '';
		$lng 				= ($solutions[9] != '')? $solutions[9] 									: '';

	}

}



// get the styling options

$headerimage 	= ($headerimage != '')? 			' background-image: url(' . $headerimage . '); ' : '';
$headerheight 	= ($headerheights != "140")?   		' height: ' . $headerheights . 'px; '  :   '';
$textcolor		= ($textcolor != '')?  				' color: ' . $textcolor . '; '  :  '';
$maskcolor 		= ($maskcolor != '')?  				' background: ' . $maskcolor . '; '   :   '';
$maskpercent 	= ($maskpercent != '')?  			' opacity: ' . $maskpercent /100 . '; '   :   '';

switch ($imagetile) {
	case '1':
	$imagetile = ' background-repeat: repeat; ';
	break;

	case '2':
	$imagetile = ' background-repeat: repeat-y; ';
	break;

	case '3':
	$imagetile = ' background-repeat: repeat-x; ';
	break;

	case '4':
	$imagetile = ' background-repeat: no-repeat; background-size: cover; ';
	break;

	case '5':
	$imagetile = ' background-repeat: no-repeat; ';
	break;
	
}



// set the variable
$cromatitle = '';


$curquer 		= $wp_query->get_queried_object();
$wooshop_id 	= (get_option('woocommerce_shop_page_id') != '')? get_option('woocommerce_shop_page_id') : 0 ;


// if this is the shop page
if ( $curquer->capability_type == 'product' && is_archive()) {
	$cromatitle 	= get_the_title(get_option('woocommerce_shop_page_id'));

// if this is a category set the header title
} elseif (is_tag()) {
	$cromatitle 	= __( 'Tag Archive: ', 'croma' ) . '  ' . single_tag_title( '', false );

} elseif (is_tax('media_category')) {
	$cromatitle 	=  __('Category: ','croma') . single_cat_title('', false);

} elseif (is_tax('mediacast_tags')) {
	$cromatitle 	=  __('Tag: ','croma') . single_cat_title('', false);

} elseif (is_author()) {
	$cromatitle 	=  __('Posts by : ','croma') . $curquer->display_name;

// if this is search set the header title
} elseif (is_category()){							
	$cromatitle 	= single_cat_title('', false);


// if this is a page or post set the header title
} elseif (is_single() || is_page()) {		
	$cromatitle 	= get_the_title($post->ID);


// if this is the index page set the header title
} elseif (is_home()) {
	$cromatitle 	= (!empty($curquer))? get_the_title( $curquer->ID ) : __('blog','croma') ;



// if this is a tag set the header title
} elseif (is_search()) {
	$cromatitle 	=  __( 'Search Results for: ', 'croma' ) .  get_search_query();



// if this is a archive set the header title
} elseif (is_archive()) {
	if 			( is_day() )	{	$cromatitle .=   __( 'Daily Archive: ', 'croma' ) . '  ' . get_the_date() ;
	} elseif 	( is_month() ) 	{	$cromatitle .=  __( 'Monthly Archive: ', 'croma' ) . '  ' . get_the_date( _x( 'F Y', 'monthly archives date format', 'croma' ) ) ;
	} elseif 	( is_year() ) 	{	$cromatitle .=	__( 'Yearly Archive: ', 'croma' ) . '  ' . get_the_date( _x( 'Y', 'yearly archives date format', 'croma' ) ) ;
	} else {
		$cromatitle .= __( 'Archives', 'croma' );
	}
}

?>

<?php if (isset($solutions) && $solutions[6] == "3") {  ?>
<!-- draw the section -->
<section id="cromaheader" class="croma_streetmapheader" style="<?php echo $headerheight; ?>">
	<?php echo do_shortcode( '[cromax-streetmap address="' . $solutions[7] . '" height="' . $headerheights . '" zoom="16" lt="' . $solutions[8] . '"  lg="' .  $solutions[9] . '"]' ); ?>
	<h1 class="cro_cust_font cro_mapheader" style="<?php echo $textcolor; ?>"><?php echo $cromatitle; ?></h1>
</section>

<?php } elseif (isset($solutions) && $solutions[6] == "4") {  ?>

<div style="background: #292C2F; min-height: 200px;">
	<?php 
	if (class_exists('RevSlider')) {
		putRevSlider($solutions[10]); 

	}

	?>

</div>

<?php } else  {  ?>


<section id="cromaheader" style="<?php echo $headerimage; ?> background-position: center; <?php echo $headerheight; ?> <?php echo $imagetile; ?>">
	<div class="cro_headermask" style="<?php echo $maskcolor; ?><?php echo $maskpercent; ?>"></div>
	<h1 class="cro_cust_font" style="<?php echo $textcolor; ?>"><?php echo $cromatitle; ?></h1>
</section>


<?php } ?>





