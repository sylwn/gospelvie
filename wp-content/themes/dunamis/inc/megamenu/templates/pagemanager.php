<?php

/**
 * Pagemaker template
 *
 *
 * @author 		Croma
 * @category 	Admin
 * @package 	templates
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$id 	= (isset($_GET['id']) && $_GET['id'] >= 1)? $_GET['id'] : '';
$left 	= (isset($_GET['id']))? get_post_meta( $_GET['id'], 'cro_type1', true ) : '';
$right 	= (isset($_GET['id']))? get_post_meta( $_GET['id'], 'cro_type2', true ) : '';
$op 	= cromatic_mm_layouts();
$ct1 	= $op[$left];
$ct2 	= $op[$right];
?>


<!-- CROMATIC PAGE WRAPPER-->
<div class="cromatic_wrapper">


		
	<!-- CROMATIC PREHEADER -->
	<div class="cromatic_preheader">

		<!-- add the header -->
		<h1><?php echo _e('Mega menu manager','croma'); ?><span class="manager">&nbsp;</span></h1>


		<!-- display the update message -->
		<?php if(isset($_GET['updated'])){

			switch ($_GET['updated']) {
				case 2:
					echo'<p class="cro_mn_updatemessage">' .  __('Post updated','croma') . '</p>';
				break;			
			}
		} ?>

	</div><!-- cromatic_preheader -->




	<!-- start the page wrap  -->
	<div class="cromatic_wrap cro_pagemanager_wrap  cromatic_pagemakerlist">


		


		<!-- display add the fromparts -->
		<div class="cromatic_pageformouter">
			<h1><?php echo get_the_title($_GET['id']); ?> </h1>
			<form method="post" action="<?php echo admin_url('admin.php?page=cromatic_megamen'); ?>" class="cro_pagemanagerform">
				<?php wp_nonce_field('cromatic_pageparts'); ?>
				<input type="hidden" name="crosubmit" value="Y"/>
				<input type="hidden" name="cromatic_id" value="<?php echo $id; ?>"/>
				<input type="hidden" name="cromatic_target" data-formtarget="cromatic_target" value="0"/>
				<input type="hidden" name="cromatic_type_left" value="<?php echo $left; ?>"/>
				<input type="hidden" name="cromatic_type_right" value="<?php echo $right; ?>"/>
				<div class="cro_sideannounce"><?php _e('Left side','croma'); ?></div>
				<?php foreach ($ct1['content'] as $value) {
					echo cromatic_mm_make_formpart($id, $value, 1);
				} ?>
				<div class="cro_sideannounce"><?php _e('Right side','croma'); ?></div>
				<?php foreach ($ct2['content'] as $value) {
					echo cromatic_mm_make_formpart($id, $value, 2);
				} ?>
				<input type="submit" name="Submit"  data-cro-submitaction="2" class="cro_mn_formsave cro_mn_formsaver cro_mn_targeter" value="<?php  _e('Save & continue', 'croma'); ?>" />
				<input type="submit" name="Submit"  data-cro-submitaction="1" class="cro_mn_formsave cro_mn_formsavers cro_mn_targeter" value="<?php  _e('Save & go to index', 'croma'); ?>" />
			</form>
		</div>
	</div>
</div>

