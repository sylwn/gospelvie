<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>

<?php
/**
 * front feedback on frontpage
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




// get the details of the background image 
$float_image 	= get_post_meta( $id, 'cro_layimage', true );
$bg 			= ($float_image != '')?  'style="background: url('  .   $float_image  .   ') no-repeat center fixed; background-size: cover; position: static;"'  : '' ;



// get the details of the text color
$tx_cl 			= get_post_meta( $id, 'cro_textcolor', true );
$txt_col 		=  ($tx_cl != '')?  'style="color: '  .   $tx_cl  .   ';"'  : '' ;




// get & process the mask
$mask 			= get_post_meta( $id, 'cro_bgmask', true );
$maskcolor		= get_post_meta( $id, 'cro_bgcolor', true );
$maskstyle   	= ($maskcolor != '')?  ' background: ' . $maskcolor . '; ' : ''  ;
$maskopacity 	= $maskstyle . ' opacity:   '   .   ($mask/100)  .  '; ';


// get $ manage the main title 
$main_title 	= get_post_meta( $id, 'cro_layhead', true )? '<h2 class="cro_cust_font" ' .  $txt_col  . '>' .  stripslashes(html_entity_decode( get_post_meta( $id, 'cro_layhead', true ) ) ) . '</h2>' : '';




?>





<section class="cro_frontpage_fee cro_frontpage_scroll cro_frontpage_layout" <?php echo $bg; ?>>


	<div class="cro_fee_block">

		<div class="cro_prodmask" style="<?php echo $maskopacity; ?>"></div>
	

			<div class="row">
 

 
				<div class="large-12 columns  <?php echo $cro_animclass; ?>" <?php echo $cro_anim; ?>>

					<?php echo $main_title; ?>

					<ul class="cromax_tweets">

						<?php 

							for ($i=1; $i < 5 ; $i++) { 
								$img_meta 	= get_post_meta( $id, 'cro_quotimg' . $i , true );
								$quot_meta 	= get_post_meta( $id, 'cro_quotee' . $i , true );
								$cnt_meta 	= get_post_meta( $id, 'cro_laycnt' . $i , true );


								$img_htm 	= ($img_meta != '')? '<span class="cro_images"><img src="' . cro_get_thumbnail($img_meta)  . '" alt="image"></span>' :  '' ;
								$quot_htm 	= ($quot_meta != '')? '<span class="cro_quotees cro_cust_font">' .  stripslashes(html_entity_decode($quot_meta))  . '</span>' :  '' ;
								$cnt_htm 	= ($cnt_meta != '')? '<span class="cro_quotes" ' .  $txt_col  . '>' . stripslashes(html_entity_decode($cnt_meta))   . '</span>' :  '' ;

							if ($img_meta != '' || $quot_meta != '' || $cnt_meta != '') {

						?>

							<li>
								<?php echo $img_htm; ?>
								<?php echo $cnt_htm; ?>
								<?php echo $quot_htm; ?>

							</li>

						<?php
							}

							}

						?>

				</ul>

			</div>
		</div>
	</div>
</section>
