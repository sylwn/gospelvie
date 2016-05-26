<div class="group" id="1">
	<h3>Section 1</h3>
	<div>
		<table style="padding: 5px;">
		<tr>
			<td><?php _e( 'Paste URL or use from Media', 'image-hover-effect' ); ?>
			<td>
				<input name="wcpop[1][imageurl]" type="text" class="imageurl" value="">
				<button class="button-secondary upload_image_button"
					data-title="<?php _e( 'Select Image', 'image-hover-effect' ); ?>"
					data-btntext="<?php _e( 'Select', 'image-hover-effect' ); ?>"><?php _e( 'Media', 'image-hover-effect' ); ?></button>
			</td>
			<td>
				<p class="description"><?php _e( 'Use media to upload image', 'image-hover-effect' ); ?>.</p>
			</td>
		</tr>
		<tr>
			<td><?php _e( 'Title', 'image-hover-effect' ); ?></td>
			<td>
				<input name="wcpop[1][imagetitle]" type="text" class="widefat" value="">
			</td>
			<td>
				<p class="description"><?php _e( 'It will be used as title attribute of image tag', 'image-hover-effect' ); ?>.</p>
			</td>
		</tr>
		<tr>
			<td><?php _e( 'Alternate Text', 'image-hover-effect' ); ?></td>
			<td>
				<input name="wcpop[1][imagealt]" type="text" class="widefat" value="">
			</td>
			<td>
				<p class="description"><?php _e( 'It will be used as alt attribute of image tag', 'image-hover-effect' ); ?>.</p>
			</td>
		</tr>
		<tr>
			<td><?php _e( 'Caption Title', 'image-hover-effect' ); ?></td>
			<td><input type="text" name="wcpop[1][captiontitle]" class="widefat"></td>
			<td>
				<p class="description"><?php _e( 'Set caption title as heading', 'image-hover-effect' ); ?>.</p>
			</td>
		</tr>
		<tr>
			<td><?php _e( 'Caption Title Font Size', 'image-hover-effect' ); ?></td>
			<td><input name="wcpop[1][titlesize]" class="widefat" type="number" value=""></td>
			<td>
				<p class="description"><?php _e( 'Set title font size in pixel', 'image-hover-effect' ); ?>.</p>
			</td>
		</tr>
		<tr>
			<td><?php _e( 'Caption Text', 'image-hover-effect' ); ?></td>
			<td><textarea name="wcpop[1][captiontext]" class="widefat"></textarea></td>
			<td>
				<p class="description"><?php _e( 'Set caption text as detail', 'image-hover-effect' ); ?>.</p>
			</td>
		</tr>
		<tr>
			<td><?php _e( 'Caption Text Font Size', 'image-hover-effect' ); ?></td>
			<td><input name="wcpop[1][captionsize]" class="widefat" type="number" value=""></td>
			<td>
				<p class="description"><?php _e( 'Set text font size in pixel', 'image-hover-effect' ); ?>.</p>
			</td>
		</tr>
		<tr>
			<td><?php _e( 'Content Color', 'image-hover-effect' ); ?></td>
			<td><input name="wcpop[1][captioncolor]" class="widefat" type="text" value=""></td>
			<td>
				<p class="description"><?php _e( 'Set Text & Title color', 'image-hover-effect' ); ?>.</p>
			</td>
		</tr>
		<tr>
			<td><?php _e( 'Title Background Color', 'image-hover-effect' ); ?></td>
			<td><input name="wcpop[1][bgclr]" class="widefat" type="text" value=""></td>
			<td>
				<p class="description"><?php _e( 'Set only title background color', 'image-hover-effect' ); ?>.</p>
			</td>
		</tr>
		<tr>
			<td><?php _e( 'Background Color', 'image-hover-effect' ); ?></td>
			<td><input name="wcpop[1][captionbg]" class="widefat" type="text" value=""></td>
			<td>
				<p class="description"><?php _e( 'Set caption background color', 'image-hover-effect' ); ?>.</p>
			</td>
		</tr>
		<tr class="caption-border">
			<td><?php _e( 'Border Width', 'image-hover-effect' ); ?></td>
			<td><input name="wcpop[1][borderwidth]" class="widefat" type="number" value=""></td>
			<td>
				<p class="description"><?php _e( 'Set border width in pixel', 'image-hover-effect' ); ?>.</p>
			</td>
		</tr>
		<tr class="caption-border">
			<td><?php _e( 'Border Color', 'image-hover-effect' ); ?></td>
			<td><input name="wcpop[1][borderclr]" class="widefat" type="text" value=""></td>
			<td>
				<p class="description"><?php _e( 'Choose border color around image', 'image-hover-effect' ); ?>.</p>
			</td>
		</tr>
		<tr>
			<td><?php _e( 'Link To', 'image-hover-effect' ); ?></td>
			<td><input name="wcpop[1][captionlink]" class="widefat" type="text" value=""></td>
			<td>
				<p class="description"><?php _e( 'Paste URL here or leave blank', 'image-hover-effect' ); ?>.</p>
			</td>
		</tr>
		<tr>
			<td><?php _e( 'Link Target', 'image-hover-effect' ); ?></td>
			<td><input name="wcpop[1][captiontarget]" class="widefat" type="text" value="_blank"></td>
			<td>
				<p class="description"><?php _e( 'write _blank for opening link in new window', 'image-hover-effect' ); ?>.</p>
			</td>
		</tr>
		<tr>
			<td><?php _e( 'Hover Style', 'image-hover-effect' ); ?></td>
			<td>
				<select name="wcpop[1][hoverstyle]" class="widefat hover_style">
					<?php foreach ($all_styles as $name) { ?>
						<option value="<?php echo $name; ?>"><?php echo ucfirst($name); ?></option>	
					<?php } ?>
				</select>									
			</td>
			<td>
				<p class="description"><?php _e( 'Choose hover style', 'image-hover-effect' ); ?></p>
			</td>
		</tr>
		<tr>
			<td><?php _e( 'Style Type', 'image-hover-effect' ); ?></td>
			<td>
				<select name="wcpop[1][styletype]" class="widefat show_on">
					<option value="square"><?php _e( 'Square', 'image-hover-effect' ); ?></option>
					<option value="circle"><?php _e( 'Circle', 'image-hover-effect' ); ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php _e( 'Caption Direction', 'image-hover-effect' ); ?></td>
			<td>
				<select name="wcpop[1][captiondirection]" class="widefat caption-direction">
					<option class="default-direction" value="left_to_right"><?php _e( 'Left To Right', 'image-hover-effect' ); ?></option>
					<option class="default-direction" value="right_to_left"><?php _e( 'Right to Left', 'image-hover-effect' ); ?></option>
					<option class="" value="top_to_bottom"><?php _e( 'Top To Bottom', 'image-hover-effect' ); ?></option>
					<option class="" value="bottom_to_top"><?php _e( 'Bottom To Top', 'image-hover-effect' ); ?></option>
	
				</select>
			</td>
		</tr>
		</table>
		<button class="button button-delete" style="float: right;">Remove</button>
		<br style="clear: both;">
		<br>
	</div>
</div>