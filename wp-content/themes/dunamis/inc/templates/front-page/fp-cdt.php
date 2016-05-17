<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>

<?php
/**
 * front page page link
 *
 *
 * @author 		Croma
 * @package 	templates
 * @version     1.0
 */



$postarr = get_post_custom($id);


// front page animation
$cro_anim  		=   (isset($postarr['cro_anim'][0]) && $postarr['cro_anim'][0] != 0 )? 
					'data-cro-anim-data="' . $animarr[$postarr['cro_anim'][0]] . '"' : '';	
$cro_animclass  =   ($cro_anim != '' )? ' animated ' : '';




// get the details of the upcomming show
$ap 			= cromaxcal_upcomming_arr(1);
$timervalue 	= $ap[0]['date'] - (get_option('gmt_offset') * 3600);


$bgcol 		= ($postarr['cro_bgcolor'][0] != '')?  $postarr['cro_bgcolor'][0] :  '#292C2F';
$txtcol 	= ($postarr['cro_textcolor'][0] != '')?  $postarr['cro_textcolor'][0] :  '#fff';



// if there's an upcomming event, process the event
if ($ap && !empty($ap)){

// Get the content for the upcomming show
$title 			= get_the_title( $ap[0]['id']);
$title 			= ($title != '') ?  '<h3 class="cro_hp_header" style="color: ' . $txtcol . ';">' . stripslashes(html_entity_decode($title)) . '</h3>'  :  '';
$desc 			= '<p  class="cro_hp_body cro_introdate" style="color: ' . $txtcol . ';">' .  date_i18n( get_option('date_format') , $ap[0]['date'], false )  . ' ' .  date_i18n( get_option('time_format') , $ap[0]['date'], false )  . '</p>';
$adesc 			= (get_post_meta( $ap[0]['id'], 'cro_introdesc', true ) != '')?  '<p  class="cro_cdt_desc" style="color: ' . $txtcol . ';">' . get_post_meta( $ap[0]['id'], 'cro_introdesc', true ) . '</p>'  : '';
$page_content 	=  $title . $desc;

// check for an alternative link

$link_label = ($postarr['cro_laylabel'][0] != '')?  stripslashes(html_entity_decode($postarr['cro_laylabel'][0])) :  __('Read more','croma');
$link_src   = ($postarr['cro_laylink'][0] != '')?  stripslashes(html_entity_decode($postarr['cro_laylink'][0])) :  get_permalink( $ap[0]['id'] );;





?>


<!-- render the section and the background -->
<section class="cro_frontpage_cdt cro_frontpage_layout <?php echo $classname; ?>" style="background: <?php echo $bgcol; ?>;" >


	<div class="cro_cdt_block">


		<div class="row" style="padding-top: 80px; padding-bottom: 80px;position: relative; z-index: 5;">


			
			<div class="large-6 columns">


				<!-- page content and description -->
				<?php echo $page_content; ?>
				<?php echo $adesc; ?>

			</div>

			<div class="large-6 columns">

				<!-- start the countdown timer-->
				<ul data-cro-countdownvalue="<?php echo $timervalue; ?>" class="cro_timervalue">
			
					<!-- section for the days -->
					<li class="cro_timerday <?php echo $cro_animclass; ?>"  <?php echo $cro_anim; ?> data-cro-anim-delay="100">
						<span class="dayname" style="color: <?php echo  $txtcol;?>;"><?php _e('Days','croma'); ?></span>
						<span class="daynumber dsec" style="color: <?php echo  $txtcol;?>;"></span>
					</li>

			
					<!-- section for the hours -->
					<li class="cro_timerday <?php echo $cro_animclass; ?>"  <?php echo $cro_anim; ?> data-cro-anim-delay="200">
						<span class="dayname" style="color: <?php echo  $txtcol;?>;"><?php _e('Hours','croma'); ?></span>
						<span class="hournumber dsec" style="color: <?php echo  $txtcol;?>;"></span>
					</li>

			
					<!-- section for the minutes -->
					<li class="cro_timerday <?php echo $cro_animclass; ?>"  <?php echo $cro_anim; ?> data-cro-anim-delay="300">
						<span class="dayname" style="color: <?php echo  $txtcol;?>;"><?php _e('Minutes','croma'); ?></span>
						<span class="minutenumber dsec" style="color: <?php echo  $txtcol;?>;"></span>
					</li>


					<!-- section for the seconds  -->			
					<li class="cro_timerday cro_timerlinenone <?php echo $cro_animclass; ?>"  <?php echo $cro_anim; ?> data-cro-anim-delay="400">
						<span class="dayname" style="color: <?php echo  $txtcol;?>;"><?php _e('Seconds','croma'); ?></span>
						<span class="secondnumber dsec" style="color: <?php echo  $txtcol;?>;"></span>
					</li>


				</ul>


				<!-- view the calendar link -->
				<p class="cro_cdtlink">
					<a href="<?php echo $link_src; ?>" class="cro_cust_bg cro_hp_body"><?php echo $link_label; ?></a>
				</p>

			</div>
		</div>
	</div>
</section>




<?php } ?>














