<?php

/**
 *
 * cromax-custom header form
 * 
 * @author  	AJ aj@cro.ma
 * @package 	Cromax
 * @category 	Croma theme
 * @copyright 	Copyright (c) 2014, Alwyn Kotze & Croma
 * @version 	1.0
 * @since 		1.0
 * @uses 		custom header form
 */



// array of metas to be processed
$args 			= array(	'cro_headimg_src',
							'cro_header_tileformat',
							'cro_headimg_boxheight',
							'cro_headimg_txtcol',
							'cro_headimg_maskcol',
							'cro_headimg_boxmask',
							'cro_header_enabled',
							'cro_header_mapaddress',
							'cro_header_maplat',
							'cro_header_maplng',
							'cro_header_sliderselect'
				);



$solutions 		= cro_processmetas($args, $post->ID);


$sliderheight 	= ($solutions[2] !== '')? $solutions[2] : 140 ;
$slidermask 	= ($solutions[5] !== '')? $solutions[5] : 0 ;


$att_img 		= wp_get_attachment_image_src($solutions[0],'thumbnail');


$cro_att_image 	= ($att_img[0] != '')? '<img src="' . $att_img[0] . '" alt="image">' : '' ;



								
?>

<!-- CODE THE EXPANDER -->
<div class="cro_clickexpand">+</div>

<!-- THE WRAPPER FOR ALL THE FORM COMPONENTS -->
<div class="custheaderwrap">


	<?php wp_nonce_field( 'cromax_headerimage_admin', 'cromax_headerimage_admin_nonce' ); ?>

	<!-- the image block -->
 	<p>
 		<select class="cro_formpartselect" name="cro_header_enabled">
 		 <option value="1" <?php selected( $solutions[6], 1, true ); ?>><?php _e('Disabled','croma'); ?></option>
		 <option value="2" <?php selected( $solutions[6], 2, true ); ?>><?php _e('Enabled','croma'); ?></option>
		 <option value="3" <?php selected( $solutions[6], 3, true ); ?>><?php _e('Map','croma'); ?></option>
		 <option value="4" <?php selected( $solutions[6], 4, true ); ?>><?php _e('Slideshow','croma'); ?></option>
 		</select>
 	</p>
 
 	
	<!-- the image block -->
 	<p>
 		<input type="hidden"  value="<?php echo $solutions[0]; ?>" name="cro_headimg_src" class="cro_imgmng cro_headimg_src">
 		<span class="cro_showheadimg"> <?php echo $cro_att_image; ?> </span>
 		<span class="cro_clearimginput">Clear</span>
 	</p>



	<!-- the tile manager -->
 	<p>
		<select class="cro_formpartselect" name="cro_header_tileformat">
			<option value="1" <?php selected( $solutions[1], 1, true ); ?>><?php _e('Tile vertical and horizontal','croma'); ?></option>
			<option value="2" <?php selected( $solutions[1], 2, true ); ?>><?php _e('Tile vertical','croma'); ?></option>
			<option value="3" <?php selected( $solutions[1], 3, true ); ?>><?php _e('Tile Horizontal','croma'); ?></option>
			<option value="4" <?php selected( $solutions[1], 4, true ); ?>><?php _e('Stretch over the area','croma'); ?></option>
			<option value="5" <?php selected( $solutions[1], 5, true ); ?>><?php _e('no tiling','croma'); ?></option>
		</select>
 	</p>



	<!-- the box height slider -->
 	<p class="cro_header-sliderp">
		<span class="sliderouter">
			<span class="cro_txtlabel"><?php _e('Box height','croma'); ?></span>
			<span class="header-noUiSlider uibox1" rel="uibox1" data-min="140" data-max="800" data-step="1" data-val="<?php echo $sliderheight; ?>" ></span>
			<input id="show-serialization-field" class="i-uibox1" value="<?php echo $solutions[2]; ?>" name="cro_headimg_boxheight">
		</span>
 	</p>




	<!-- the color picker for the text color -->
 	<p>
 		<span class="cro_txtlabel"><?php _e('Text color','croma'); ?></span>
		<input type="text" class="cro_header_pickme " name="cro_headimg_txtcol" value="<?php echo $solutions[3]; ?>" size="29" style="" rel=".cro_header" />
 	</p>




	<!-- the color picker for the mask color -->
 	<p>
 		<span class="cro_txtlabel"><?php _e('Mask color','croma'); ?></span>
		<input type="text" class="cro_header_pickme " name="cro_headimg_maskcol" value="<?php echo $solutions[4]; ?>" size="29" style="" rel="" />
 	</p>




	<!-- the mask slider -->
 	<p class="cro_header-sliderp">
 		<span class="sliderouter">
 			<span class="cro_txtlabel"><?php _e('Mask opacity','croma'); ?></span>
			<span class="header-noUiSlider uibox2" rel="uibox2" data-min="1" data-max="100" data-step="1" data-val="<?php echo $slidermask; ?>" ></span>
			<input id="show-serialization-field" class="i-uibox2" value="<?php echo $solutions[5]; ?>" name="cro_headimg_boxmask">
		</span>
 	</p>


 	<p class="cro_mapdetails">
 		<span class="cro_txtlabel"><?php _e('Map address','croma'); ?></span>
 		<input id="cro_header_mapaddress" class="" value="<?php echo $solutions[7]; ?>" name="cro_header_mapaddress">
 	</p>

 	<p class="cro_mapdetails">
 		<span class="cro_txtlabel"><?php _e('Lattitude override','croma'); ?></span>
 		<input id="cro_header_maplat" class="" value="<?php echo $solutions[8]; ?>" name="cro_header_maplat">
 	</p>


 	<p class="cro_mapdetails">
 		<span class="cro_txtlabel"><?php _e('Longitude override','croma'); ?></span>
 		<input id="cro_header_maplng" class="" value="<?php echo $solutions[9]; ?>" name="cro_header_maplng">
 	</p>


	<?php 

	if (class_exists('RevSlider')) {

		$sld 		= new RevSlider();
    	$sliders 	= $sld->getArrSliders();

	?>

	<p class="cro_sliderdetails">
	<span class="cro_txtlabel"><?php _e('Select a slideshow','croma'); ?></span>
	<select name="cro_header_sliderselect" class="cro_formpartselect">
			
	<?php 
	if(!empty($sliders)){
        foreach($sliders as $slider){
			echo '<option ' . selected( $solutions[10], $slider->getParam('alias','false'), false)   . ' value="' .  $slider->getParam('alias','false') . '">' . $slider->getParam('title','false') . '</option>';					
		}
	}   

	?>

	</select>
	</p>

 	<?php } ?>



</div><!-- custheaderwrap -->