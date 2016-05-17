<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$ynow =  date_i18n( 'Y' , time() , false );

$cromax_cal_hours 		= (get_post_meta($ID,'cromax_calendarpack_hours',true) != '')? get_post_meta($ID,'cromax_calendarpack_hours',true) : 0;
$cromax_cal_minutes 	= (get_post_meta($ID,'cromax_calendarpack_minutes',true) != '')? get_post_meta($ID,'cromax_calendarpack_minutes',true) : 0;
$cromax_cal_rec 		= (get_post_meta($ID,'cromax_cal_rec',true) != '')? get_post_meta($ID,'cromax_cal_rec',true) : 1;
$cromax_sel_rec_a 		= get_post_meta($ID,'cromax_sel_rec_a',true);
$cromax_sel_rec_b 		= get_post_meta($ID,'cromax_sel_rec_b',true);
$cromax_sel_rec_c 		= (get_post_meta($ID,'cromax_sel_rec_c',true) != '')? get_post_meta($ID,'cromax_sel_rec_c',true) : 0;
$cromax_sel_rec_d 		= get_post_meta($ID,'cromax_sel_rec_d',true);
$cromax_sel_rec_e 		= get_post_meta($ID,'cromax_sel_rec_e',true);
$cromax_calval 			= get_post_meta($ID,'cromax_calval',true);

if ($cromax_calval >= 1){
	$cro_mnth = date('n', intval($cromax_calval));
	$cro_yr = date('Y', intval($cromax_calval));
} else {
	$cro_mnth = '';
	$cro_yr = '';
}

?>

<div class="cromax-calendarpack">


	<div class="timeside">
		<div class="cromax_sideinner">

			<p class="cromax-uiblock">
				<label><?php _e('Hours','croma'); ?></label>
				<span class="noUiSlider"></span>
				<input type="text" class="cromax-uislider cromax_calendarpack_hours cromax-datanode"   data-ui-values="0,23,1,<?php echo $cromax_cal_hours; ?>" name="cromax_calendarpack_hours" value="<?php echo $cromax_cal_hours; ?>" size="29"  rel="cromax_calendarpack_hours" data-cro-clicker="cro_ui_slide" />
			</p>


			<p class="cromax-uiblock">
				<label><?php _e('Minutes','croma'); ?></label>
				<span class="noUiSlider"></span>
				<input type="text" class="cromax-uislider cromax_calendarpack_minutes cromax-datanode"   data-ui-values="0,59,1,<?php echo $cromax_cal_minutes; ?>" name="cromax_calendarpack_minutes" value="<?php echo $cromax_cal_minutes; ?>" size="29"  rel="cromax_calendarpack_minutes" data-cro-clicker="cro_ui_slide" />
			</p>

		</div>

		<div class="cromax_evtype">
			<h2><?php _e('Type of event','croma'); ?></h2>
			<div class="cro_sidebox">
				<div class="calopti">
					<div class="seltype">
						<span rel="1" class="optspan" data-cro-clicker="cal_optselect"></span>
						<span class="optdesc"><?php _e('Single day event','croma'); ?></span>
					</div>
					<br class="clear">
					<div class="seltype">
						<span rel="2" class="optspan" data-cro-clicker="cal_optselect"></span>
						<span class="optdesc"><?php _e('Multiple day event','croma'); ?></span>
					</div>
					<br class="clear">
					<div class="seltype">
						<span rel="3" class="optspan" data-cro-clicker="cal_optselect"></span>
						<span class="optdesc"><?php _e('Every week same day','croma'); ?></span>
					</div>
					<br class="clear">
					<div class="seltype">
						<span rel="4" class="optspan" data-cro-clicker="cal_optselect"></span>
						<span class="optdesc"><?php _e('Every month same date.','croma'); ?></span>
					</div>
					<br class="clear">
					<div class="seltype">
						<span rel="5" class="optspan" data-cro-clicker="cal_optselect"></span>
						<span class="optdesc"><?php _e('Advanced configuration','croma'); ?>.</span>
					</div>
					<br class="clear">
					<div class="showadvconf"><?php _e('Select Configuration','croma'); ?>
						<br />

						<select name="cromax_sel_rec_a" class="cro_addayofconf adadvselect">
							<option <?php selected( $cromax_sel_rec_a, 'first', true); ?> value="first"><?php _e('First','croma'); ?></option>
							<option <?php selected( $cromax_sel_rec_a, 'second', true); ?> value="second"><?php _e('Second','croma'); ?></option>
							<option <?php selected( $cromax_sel_rec_a, 'third', true); ?> value="third"><?php _e('Third','croma'); ?></option>
							<option <?php selected( $cromax_sel_rec_a, 'fourth', true); ?> value="fourth"><?php _e('Fourth','croma'); ?></option>
							<option <?php selected( $cromax_sel_rec_a, 'last', true); ?> value="last"><?php _e('Last','croma'); ?></option>
						</select>


						<select name="cromax_sel_rec_b" class="cro_adweekofconf adadvselect">
							<option <?php selected( $cromax_sel_rec_b, 'Monday', true); ?> value="Monday"><?php echo date_i18n( 'l' , 388800 , false ); ?></option>
							<option <?php selected( $cromax_sel_rec_b, 'Tuesday', true); ?> value="Tuesday"><?php echo date_i18n( 'l' , 475200 , false ); ?></option>
							<option <?php selected( $cromax_sel_rec_b, 'Wednesday', true); ?> value="Wednesday"><?php echo date_i18n( 'l' , 561600 , false ); ?></option>
							<option <?php selected( $cromax_sel_rec_b, 'Thursday', true); ?> value="Thursday"><?php echo date_i18n( 'l' , 43200 , false ); ?></option>
							<option <?php selected( $cromax_sel_rec_b, 'Friday', true); ?> value="Friday"><?php echo date_i18n( 'l' , 129600 , false ); ?></option>
							<option <?php selected( $cromax_sel_rec_b, 'Saturday', true); ?> value="Saturday"><?php echo date_i18n( 'l' , 216000 , false ); ?></option>
							<option <?php selected( $cromax_sel_rec_b, 'Sunday', true); ?> value="Sunday"><?php echo date_i18n( 'l' , 302400 , false ); ?></option>
						</select>
					</div>


					<br class="clear">
					<div class="showlastday">Last day of event
						<br />
						<select name="cromax_sel_rec_c" class="cro_addayselect  adcalselect">
							<option value="0">--</option>

							<?php for ($i=1; $i <32 ; $i++) { ?>
							<option <?php selected( $cromax_sel_rec_c, $i, true); ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?php } ?>
						</select>



						<select name="cromax_sel_rec_d" class="cro_admonthselect adcalselect">
							<option selected="selected" value="0">--</option>
							<option <?php selected( $cromax_sel_rec_d, 1, true); ?> value="1"><?php echo date_i18n( 'F' , 1252812 , false ); ?></option>
							<option <?php selected( $cromax_sel_rec_d, 2, true); ?> value="2"><?php echo date_i18n( 'F' , 3931212 , false ); ?></option>
							<option <?php selected( $cromax_sel_rec_d, 3, true); ?> value="3"><?php echo date_i18n( 'F' , 6350412 , false ); ?></option>
							<option <?php selected( $cromax_sel_rec_d, 4, true); ?> value="4"><?php echo date_i18n( 'F' , 9028812 , false ); ?></option>
							<option <?php selected( $cromax_sel_rec_d, 5, true); ?> value="5"><?php echo date_i18n( 'F' , 11620812 , false ); ?></option>
							<option <?php selected( $cromax_sel_rec_d, 6, true); ?> value="6"><?php echo date_i18n( 'F' , 14299212 , false ); ?></option>
							<option <?php selected( $cromax_sel_rec_d, 7, true); ?> value="7"><?php echo date_i18n( 'F' , 16891212 , false ); ?></option>
							<option <?php selected( $cromax_sel_rec_d, 8, true); ?> value="8"><?php echo date_i18n( 'F' , 19569612 , false ); ?></option>
							<option <?php selected( $cromax_sel_rec_d, 9, true); ?> value="9"><?php echo date_i18n( 'F' , 22248012 , false ); ?></option>
							<option <?php selected( $cromax_sel_rec_d, 10, true); ?> value="10"><?php echo date_i18n( 'F' , 24840012 , false ); ?></option>
							<option <?php selected( $cromax_sel_rec_d, 11, true); ?> value="11"><?php echo date_i18n( 'F' , 27518412 , false ); ?></option>
							<option <?php selected( $cromax_sel_rec_d, 12, true); ?> value="12"><?php echo date_i18n( 'F' , 30110412 , false ); ?></option>
						</select>
								
						<select name="cromax_sel_rec_e" class="cro_adyearselect adcalselect">
							<option selected="selected" value="0">--</option>
							<option <?php selected( $cromax_sel_rec_e, $ynow, true); ?> value="<?php echo $ynow; ?>"><?php echo $ynow; ?></option>
							<option <?php selected( $cromax_sel_rec_e, ($ynow + 1), true); ?> value="<?php echo $ynow + 1; ?>"><?php echo $ynow + 1; ?></option>
							<option <?php selected( $cromax_sel_rec_e, ($ynow + 2), true); ?> value="<?php echo $ynow + 2; ?>"><?php echo $ynow + 2; ?></option>
							<option <?php selected( $cromax_sel_rec_e, ($ynow + 3), true); ?> value="<?php echo $ynow + 3; ?>"><?php echo $ynow + 3; ?></option>
							<option <?php selected( $cromax_sel_rec_e, ($ynow + 4), true); ?> value="<?php echo $ynow + 4; ?>"><?php echo $ynow + 4; ?></option>
							<option <?php selected( $cromax_sel_rec_e, ($ynow + 5), true); ?> value="<?php echo $ynow + 5; ?>"><?php echo $ynow + 5; ?></option>
							<option <?php selected( $cromax_sel_rec_e, ($ynow + 6), true); ?> value="<?php echo $ynow + 6; ?>"><?php echo $ynow + 6; ?></option>
						</select>
					</div>

					<input type="hidden" value="<?php echo $cromax_cal_rec; ?>" name="cromax_cal_rec" class="crocalboxx">

				</div>

				<p class="cro_metaboxpdesc"><?php _e('select the recurring type of this event','croma'); ?></p>
				
			</div>
		</div>
	</div>



	<div class="calendarside">
		<div class="cromax_sideinner">
			<div class="cromax-cal-container">
				<?php echo cromax_admin_calendar('', $cro_mnth ,$cro_yr,''); ?>
			</div>
			<input type="hidden" value="<?php echo $cromax_calval; ?>" name="cromax_calval" class="cromax_calval">
		</div>
	</div>

	<br class="clear">
</div>