<?php get_header(); ?>
<div class="websitez-container">
	<div id="container" class="homeCont">
	
	<?php if(have_posts()) : ?>
		<?php $i=0; ?>
		<?php while(have_posts()) : the_post(); ?>
	
			<div class="post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<div class="secHead-noshadow">
			
		    	
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-title"><?php the_title(); ?></a> 
					<p class="post-author"><?php echo __("Author: <strong>".get_the_author()); ?>&nbsp;&nbsp;&nbsp;&nbsp;Posted: <?php the_time('M') ?> <?php the_time('j') ?></strong></p>
			
					
				
			
				
					
					
					<div style="clear: both;"></div>
				</div>
					
				
	
			
			
				<div class="post-more">
				
					<div style="clear: both;"></div>
				</div>
			</div>
		
			<?php $i++; ?>
		<?php endwhile; ?>
		
	  <div class="websitez-navigation">
	  	<?php posts_nav_link(' &#124; ','&#171; previous','next &#187;'); ?>
	  </div>          
	<?php else : ?>
		<div class="post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post-wrapper">
				<h3><?php _e('No posts are added.'); ?></h3>
			</div>
		</div>
	<?php endif; ?>
</div>

</div>
<?php get_footer(); ?>      