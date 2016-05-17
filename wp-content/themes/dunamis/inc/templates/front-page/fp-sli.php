<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>

<?php
/**
 * front page page link
 *
 *
 * @author 		Croma
 * @package 	templates
 * @version     1.0
 */



if (class_exists('RevSlider')) {

$slideno 	= get_post_meta( $id, 'cro_laytarget1', true );
?>

<section class="cromaslide" style="overflow: hidden;width: 100%;">
	<div class="cromaslideinner" style="width: 100%; height: auto; position: relative;"><h1 style="display: none;">slideshow</h1>
		<?php putRevSlider($slideno); ?>
	</div>
</section>


<?php } ?>


