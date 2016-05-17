<?php get_header(); ?>
<div class="websitez-container">
	<h3><?php printf( __( 'Category: %s'), single_cat_title( '', false )); ?></h3>
	<div id="container" class="homeCont">
	<?php if(have_posts()) : ?>
		<?php $i=0; ?>
		<?php while(have_posts()) : the_post(); ?>

			<div class="post" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<div class="secHead-noshadow">
						<article>
					<div class="articleMod">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="post-title"><?php the_title(); ?></a>
					<p class="post-author"><?php the_time('F j, Y') ?> <?php echo __("at"); ?> <?php the_time('g:i a')?> <?php echo __("by"); ?> <?php the_author(); ?></p>
					</article>
									<div class="post-entry"><?php the_excerpt(); ?></div>
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


   