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




// format the map components
$address			= get_post_meta( $id, 'cro_layaddr', true );
$height				= get_post_meta( $id, 'cro_layheight', true );
$lt					= get_post_meta( $id, 'cro_latt', true );
$lg					= get_post_meta( $id, 'cro_lng', true );
$zoom				= get_post_meta( $id, 'cro_zoom', true );



?>


<!-- start the section & add the foater -->
<section class="cro_frontpage_map cro_frontpage_layout">
	<?php echo do_shortcode( '[cromax-streetmap address="' . $address . '" height="' . $height . '" zoom="'  . $zoom .  '" lt="' . $lt . '"  lg="' .  $lg . '"]' ); ?>
</section>


