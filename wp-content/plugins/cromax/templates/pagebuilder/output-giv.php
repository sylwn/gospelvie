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





?>
<div class="cromax-giv clearfix">
	<?php echo do_shortcode('[croma-paypal min="' . $namearray[0] . '" max="' . $namearray[1] . '" def="' . $namearray[2] . '" step="' . $namearray[3] . '"   repeat="' . $namearray[4] . '"]');  ?>
</div>