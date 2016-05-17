<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>

<?php
/**
 * 2 latest news posts
 *
 *
 * @author 		Croma
 * @package 	templates
 * @version     1.0
 */



?>


<!-- start the section  -->
<div class="cro_mm_oneside cro_mm_events">



	<?php echo fetch_events_for_mm(); ?>



</div>




