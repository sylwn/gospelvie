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


if (function_exists('lsSliders')) { 

?>
<div class="cromax-lsl clearfix" style="position: relative;">
	<?php layerslider($namearray[0]);  ?>
</div>


<?php } ?>