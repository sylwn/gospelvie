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
$type 	= (isset($_GET['action']) && $_GET['action'] != '')? $_GET['action'] : '';
$op 	= cromatic_pbuilder_layouts();
$ct 	= $op[$type];
?>


<!-- CROMATIC PAGE WRAPPER-->
<div class="cromatic_wrapper">



	<!-- CROMATIC PREHEADER -->
	<div class="cromatic_preheader">

		<!--  Page title  -->
		<h1><?php echo _e('Frontpage Manager','croma'); ?></h1>


		<!-- display the update message -->
		<?php if(isset($_GET['updated'])){

			switch ($_GET['updated']) {
				case 2:
					echo'<p class="cro_mn_updatemessage">' .  __('Post updated','croma') . '</p>';
				break;			
			}
		} ?>

	</div><!-- cromatic_preheader -->


	<!-- TOGGLER HEADER -->
	<div class="cro_togglerwrap">

		<h1 class="cromatic_pagemanager_title"><?php echo $ct['name']; ?> </h1>

	</div> <!-- cro_togglerwrap -->





	<div class="cro_pagewrapper">



		<!-- start the page wrap  -->
		<div class="cromatic_wrap cro_pagemanager_wrap  cromatic_pagemakerlist">


			<!-- display add the fromparts -->
			<div class="cromatic_pageformouter">
		
				<form method="post" action="<?php admin_url('admin.php?page=cromatic'); ?>">
					<?php wp_nonce_field('cromatic_pageparts'); ?>
					<input type="hidden" name="crosubmit" value="Y"/>
					<input type="hidden" name="cromatic_id" value="<?php echo $id; ?>"/>
					<input type="hidden" name="cromatic_target" data-formtarget="cromatic_target" value="0"/>
					<input type="hidden" name="cromatic_type" value="<?php echo $type; ?>"/>
					<?php foreach ($ct['content'] as $value) {
						echo cromatic_make_formpart($id, $value);
					} ?>
					<input type="submit" name="Submit"  data-cro-submitaction="2" class="cro_mn_formsave cro_mn_formsaver cro_mn_targeter" value="<?php  _e('Save & continue', 'croma'); ?>" />
					<input type="submit" name="Submit"  data-cro-submitaction="1" class="cro_mn_formsave cro_mn_formsavers cro_mn_targeter" value="<?php  _e('Save & go to index', 'croma'); ?>" />
				</form>
			</div>
		</div>


	</div>


</div>

