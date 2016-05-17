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

$holder 	= cromax_define_pagebuilder_parts();
$val 		= '';
if (isset($handler_id)) {
	$myarr_id 	=  json_decode(  rawurldecode(  get_post_meta( $handler_id,'cromax_pagebuilder', true )  ), true);
	// $myarr_id 	=   get_post_meta( $handler_id,'cromax_pagebuilder', true );
}

if (!isset($rnd2)) {
	$rnd2 	= $parent . '-' . cromax_randstring(5);
} 

if (!isset($size)) {
	$size 	= '1/1';
} 

if (!isset($sizeclass)) {
	$sizeclass 	= 'cromax-width-1-1';
} 

foreach ($holder as $v) {
	if ($v['short'] == $type){
		$title 	= $v['tabname'];
		$cnt 	= $v['values'];
	}
}

?>


<div class="cromax_shortcode_handler <?php echo $sizeclass; ?>">
	<div class="cromax_size_manager">
		<div class="cromax-sizedash"><?php echo $size; ?></div>
		<div class="cromax-sizespinner">
			<span class="cromax_size_increase" data-cro_clicker="cro_make_this_bigger">+</span>
			<span class="cromax_size_decrease" data-cro_clicker="cro_make_this_smaller">-</span>
		</div>
	</div>
		
	<div class="cromax_handler_name"><?php echo $title; ?></div>
		
	<div class="cromax_handler_controller">
		<div class="cromax-handler-editer" data-cro_clicker="cro_edit_this_content"><i class="icon-pencil"></i></div>
		<div class="cromax-handler-deleter" data-cro_clicker="cro_delete_this_shortcode"><i class="icon-remove"></i></div>
	</div>

	<div class="cromax_form_holder">
		<input type="hidden" value="<?php echo $size; ?>" name="<?php echo $rnd2; ?>-handler-size" data-inputtype="item-size">
		<div class="formpart">
			<input type="hidden" value="<?php echo $type; ?>" name="<?php echo $rnd2; ?>-cromax-childtype" data-inputtype="parenttype">
			<input type="hidden" value="<?php echo $rnd2; ?>" name="cromax-childname[]" data-inputtype="childname" class="cromax_childname">
				<?php foreach ($cnt as $va) { 
					$val = '';
					if( isset($section_webid) && isset($myarr_id[$section_webid][$rnd2][$rnd2.'-'.$va['fn']])){
						$val = $myarr_id[$section_webid][$rnd2][$rnd2.'-'.$va['fn']];
					}
					echo cro_pagebuilderparts($va, $rnd2, $val);
 				} ?>
 		</div>
	</div>
</div>