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


$p_cntnt 	= get_post($id);
$p_classes 	= get_post_class('', $id); 
$p_classesout = '';

foreach ($p_classes as $p_v) {
	$p_classesout .= $p_v . ' ';
}


?>

<div class="cromax-pct">

	<article id="post-<?php echo $id; ?>" class="<?php echo $p_classesout; ?>">

		<div class="entry-content">

			<?php echo apply_filters('the_content', $p_cntnt->post_content); ?>

		</div>

	</article>

</div>