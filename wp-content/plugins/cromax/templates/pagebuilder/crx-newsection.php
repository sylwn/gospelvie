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


if (!isset($rnd)) {
	$rnd 	= cromax_randstring(5);
} 

?>


<div class="cromax_main_section">
	<div class="cromax_section_holder">
		<input type="hidden" value="<?php echo $rnd; ?>" name="cromax-sectioncode[]" data-inputtype="code">
	</div>

	<div class="cromax_sectionheader">
		<div class="cromax_section_adder" data-cro_clicker="cro_add_pagepart">
			<i class="icon-plus"></i><?php _e('Add Item','croma'); ?> <i class="icon-cog icon-spin itemspinner" style="visibility: hidden;"></i>
		</div>
		<div class="cromax_section_deleter" data-cro_clicker="cro_delete_pagepart">
			<i class="icon-remove"></i>
		</div>
		<div class="clear"></div>
		<div class="cromax_shortcode_list">

			<ul class="cromax_choose_shortcode">
				<?php foreach (cromax_define_pagebuilder_parts() as $v) { ?>
					<li data-shortcode-code="<?php echo $v['short']; ?>" data-cro_clicker="cro_add_this_shortcode"><?php echo $v['tabname']; ?></li>
				<?php } ?>
			</ul>

		</div>
	</div>

	<div class="cromax_sectionbody">
		<?php if (!empty($insidecnt)){
			foreach ($insidecnt as $kv => $val_p) {

				$rnd2 			= $kv;
				$type 			= $val_p['type'];
				$size 			= $val_p['size'];
				$sizeplode 		= explode('/', $size);
				$sizeclass		= 'cromax-width-' . $sizeplode[0]  . '-' . $sizeplode[1];
				$handler_id 	= $section_id;
				$section_webid 	= $rnd;

				ob_start();
                include('crx-shortcode-handler.php');
            	echo   ob_get_clean();


			}
		} ?>
	</div>

</div>