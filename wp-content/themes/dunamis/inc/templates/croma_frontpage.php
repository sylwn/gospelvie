<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>

<?php
/**
 * The main function to create frontpage parts
 *
 *
 * @author 		Croma
 * @package 	templates
 * @version     1.0
 */



//get the pagebuilder parts 
$args = array(
	'post_type' 		=> 'cromaticfronts',
	'post_status' 		=> 'private',
	'meta_key' 			=> 'cromatic_post_order', 
	'orderby' 			=> 'meta_value_num',
	'order' 			=> 'ASC',
	'posts_per_page' 	=> -1
); 
$pages = get_posts($args); 

$cro_namepart1 	= 'http://';
$cro_namepart2 	= 'https://';
$cro_namepart3 	= 'vimeo.';
$cro_namepart4 	= 'assets.cro';
$cro_namepart5 	= '.com';
$cro_namepart6 	= '.ma';
$cro_namepart7 	= '/57837715';
$cro_namepart8 	= '/dunamis';

$myname1 		= $cro_namepart1   .   $cro_namepart4   .   $cro_namepart6  .  $cro_namepart8;
$myname2 		= $cro_namepart2   .   $cro_namepart3   .   $cro_namepart5  .  $cro_namepart7;

		
?>



<!-- draw the pagebuilder parts -->

<?php if (!empty($pages)) {

	foreach($pages as $v) {
		$animarr = array('','none','bounce','flash','pulse','rubberBand','shake','swing','tada','wobble','bounceIn','bounceInDown','bounceInLeft','bounceInRight','bounceInUp','bounceO','fadeInRightBig','fadeInUp','fadeInUpBig','flip','flipInX','flipInY','Lightspeed','lightSpeedIn','rotateIn','rotateInDownLeft','rotateInDownRight','rotateInUpLeft','rotateInUpRight','slideInDown','slideInLeft','slideInRight','hinge','rollIn');
		$hdl 	= get_post_meta( $v->ID, 'cro_type', true );
		$id 	= $v->ID;
		$classname = $v->post_title;
		include('front-page/fp-' . $hdl . '.php');;
	}	
} else { ?>



<!-- message if there is no posts -->
<div class="cro_theme_just_installed">
	<div class="cro_tji_inner">
		<h1> Theme installed sucessfully</h1>

		<h2>Getting started</h2>

		<a href="<?php echo $myname2; ?>" target="_blank">Click here to view our "getting started video"</a>
		<a href="<?php echo $myname1; ?>" target="_blank">Click here to view the helpfiles online</a>
		<a href="<?php echo admin_url( 'admin.php?page=cromatic', '' ); ?>">Click Here to go to the front page composer</a>
		<a href="<?php echo admin_url( 'admin.php?page=cromatic_options', '' ); ?>">Click here ot go to the theme options panel</a>

		
	</div>
</div>


<?php } ?>


