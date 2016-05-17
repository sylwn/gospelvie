<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Paypal form
 *
 *
 * @package Cromatic
 * @subpackage Cromatic
 * @since 1.0
 */



?>



<div class="cro_paypalouter" style="background:#fff; background-size: cover;">

	<form>

		<div class="cro_paypal_range_slider" data-cro-min="<?php echo $min; ?>" data-cro-max="<?php echo $max; ?>" data-cro-def="<?php echo $def; ?>" data-cro-step="<?php echo $step; ?>"></div>




		<div class="cro_seriaouter">

			<div class="cro_ammtcontainer">
					
				<?php echo $prefix; ?>

				<input type="text" class="cro-serializer cro_serianumber <?php echo $prefimg; ?> <?php echo $maxclass; ?>" name="cro_ammt" value="<?php echo $def; ?>" />

				<?php echo $suffix; ?>

			</div>
			
		</div>


	  <?php if ($repeat == 1 ) { ?>

		<div class="cro_inputstart">
			<ul class="cro_donationsfrequency">
				<li class="cro_don_freq_active" data-cro-clicker="freqClik" data-cro-val="1">
					<?php  _e('One time donation','croma'); ?>
				</li>
				<li  data-cro-clicker="freqClik" data-cro-val="2">
					<?php  _e('Monthly donation','croma'); ?>
				</li>
				<li  data-cro-clicker="freqClik" data-cro-val="3">
					<?php  _e('Annual donation','croma'); ?>
				</li>
			</ul>
			<input type="hidden" class="cro_freqput" name="cro_payfreq" data-cro-serialize="true" value="1" />
		</div>


		<?php } else {  ?>

		<input type="hidden" class="cro_freqput" name="cro_payfreq" data-cro-serialize="true" value="1" />

		<?php } ?>


		<div class="cro_inputstart">

			<ul class="cro_donations_firstrow">

				<li>
					<input type="text" value="" class="cro_donations_nameinput cro_donations_validate" name="cro_name" placeholder="<?php  _e('Add your name','croma'); ?>">
				</li>

				<li>
					<input type="text" value="" class="cro_donations_surnameinput cro_donations_validate" name="cro_surname" placeholder="<?php  _e('Add your Last name','croma'); ?>">
				</li>

				<li>
					<input type="text" value="" class="cro_donations_mailinput cro_donations_validate" name="cro_email" placeholder="<?php  _e('Add your email','croma'); ?>">
				</li>

			</ul>

				
			<div class="cro_errmess">
				<?php _e('Please fill all the fields','croma'); ?>
			</div>

				
			<button class="cro_cust_bg cro_cust_font" data-cro-clicker="PaySubm">
				<?php _e('Process donation','croma'); ?>
			</button>

		</div>

	</form>


	<div class="cro_paypalpop">
					
		<div class="cro_spinholder">
			<i class="icon-spinner icon-spin icon-large"></i>
		</div>

		<div class="cro_popouter">

			<div class="cro_popinner">

				<div class="cro_poppanel">

					<h4 class="cro_cust_font">
						<?php _e('Setting up a secure payment through Paypal','croma'); ?>
					</h4>

				</div>

			</div>

		</div>

	</div>

</div>





