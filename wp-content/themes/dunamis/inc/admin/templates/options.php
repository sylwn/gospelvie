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

$ctr 	= 1;
$ctr2 	= 1;										
?>



<!-- CROMATIC PAGE WRAPPER-->
<div class="cromatic_wrapper">

	

	<!-- CROMATIC PREHEADER -->
	<div class="cromatic_preheader">

		<!--  Page title  -->
		<h1><?php echo _e('Theme Options','croma'); ?></h1>


		<!-- get and display the update_message -->
		<?php if(isset($_GET['updated'])){

			switch ($_GET['updated']) {
				case 1:
					echo'<p class="cro_mn_updatemessage">' .  __('Theme options Updated','croma') . '</p>';
				break;		
			}
		} ?>

	</div><!-- cromatic_preheader -->

	<form method="post" action="<?php admin_url('admin.php?page=cromatic_opitons'); ?>">

	
		<!-- TOGGLER HEADER -->
		<div class="cro_togglerwrap">

			<!--  click to add part  -->
			<div class="cromatic_inner cromatic_center">
				<input type="submit" value="<?php echo _e('Save','croma'); ?>" class="cro_thopt_submit">
			</div>


		

		</div> <!-- cro_togglerwrap -->



		<div class="cro_pagewrapper">

			<!-- Page options wrap -->
			<div class="cromatic_wrap cro_pageopitons_wrap">



				<!-- create the left sidebar -->
				<div class="cromatic_mainpagelist cro_optionspagelist">
		

					<ul class="cro_optiontabs">
						<?php foreach(cromatic_theme_options() as $valu) {
								$active = ($ctr == 1)?  'active' : '' ;
								echo '<li class="cro_page_li_' .  $active  . ' cro_page_li" rel="#' .  $valu['handle'] . '"><i class="' . $valu['icon'] . '"></i>' .  $valu['name']    .  '</li>';
								$ctr++;
						} ?>
					</ul>


					<!-- Create the main pagepart -->
					<div class="cro_optiontabouter">
				
						<input type="hidden" name="cro_opt_submit" value="Y">


						<!-- display the output from the form creator  -->
						<?php foreach(cromatic_theme_options() as $valu) {

							$active = ($ctr2 == 1)?  'active' : '' ;
							echo '<div class="cro_page_option_' .  $active  . ' cro_page_option_page" id="' .  $valu['handle'] . '">';

							foreach ($valu['content'] as $vals) { echo cromatic_make_formpart(0, $vals); }

							echo '</div>';
							$ctr2++;
	
						} ?>

					</div>	
					<br class="clear" />	
				</div>
			</div>

		</div>
	</form>
</div>

