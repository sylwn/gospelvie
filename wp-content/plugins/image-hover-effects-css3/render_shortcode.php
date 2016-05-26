<div class="na-prefix">
	<div class="grid grid-pad">
		<?php 
			$all_data = get_post_meta( $atts['id'], 'wcpop', true );
			$arr_count = count($all_data);
			$css_class = 'col-1-'.$arr_count;
		 ?>
		 
		<?php foreach ($all_data as $key => $data) { ?>
		<div class="<?php echo $css_class; ?>">
			<div class="ih-item
				<?php echo $data['styletype']; ?>
				<?php echo $data['hoverstyle']; ?>
				<?php
				if ($data['hoverstyle'] == 'effect6' && $data['styletype'] == 'circle') {
				    echo "scale_up";
				} elseif ($data['hoverstyle'] == 'effect8' && $data['styletype'] == 'square') {
				    echo "scale_up";
				} elseif ($data['hoverstyle'] == 'effect1' && $data['styletype'] == 'square' && $data['captiondirection'] == 'left_to_right') {
				    echo "left_and_right";
				} else {
				    echo $data['captiondirection'];
				} ?>"
			style="border: <?php echo $data['borderwidth'];  ?>px solid <?php echo $data['borderclr'];  ?> !important;">
				<a href="<?php echo ($data['captionlink'] != '') ? $data['captionlink'] : 'javascript:void(0);' ; ?>" target="<?php echo $data['captiontarget']; ?>">
		          
		          <div class="img">
		          	<img src="<?php echo $data['imageurl']; ?>" title="<?php echo $data['imagetitle']; ?>" alt="<?php echo $data['imagealt']; ?>">
		          </div>
		          <div class="info" style="
			        background-color: <?php echo $data['captionbg']; ?>; width: 100%; 
			        color: <?php echo $data['captioncolor']; ?>;">
		            <h3 style="background-color: <?php if ($data['styletype'] == 'square') {
			        	echo $data['bgclr'];
			        } ?>; color: <?php echo $data['captioncolor']; ?>; font-size: <?php echo $data['titlesize']; ?>px;">
		            	<?php echo $data['captiontitle']; ?>
		            </h3>
		            <p style="color: <?php echo $data['captioncolor']; ?>; font-size: <?php echo $data['captionsize']; ?>px;">
		            	<?php echo stripcslashes($data['captiontext']); ?>
		            </p>
		          </div>
		        </a>
		    </div>
		</div>
		<?php } ?>

	</div>
		<div class="clearfix"></div>
</div>