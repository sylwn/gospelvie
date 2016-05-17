<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Cromax add a new pagebuilder section
 *
 *
 * @package Cromatic
 * @subpackage Cromatic
 * @since 1.0
 */




$title 		= ($namearray[0] != '')?  stripslashes($namearray[0]) :  '' ;

$make_par 	= ($namearray[1] == 2)?  wpautop($title) :  $title ;


?>
<div class="cromax-htm clearfix">
	<?php echo $make_par; ?>
</div>