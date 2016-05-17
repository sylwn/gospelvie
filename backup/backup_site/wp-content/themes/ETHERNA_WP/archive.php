<?php get_header(); ?>
<?php
global $options;
foreach ($options as $value) {
    if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_option( $value['id'] ); }
}
?>
	<!-- Main content alpha -->
	<div class="main">
		<div class="inner_main">
		<?php if($ds_eth_blog_alpha1){echo '<div class="container_alpha slogan">'.stripslashes($ds_eth_blog_alpha1).'</div>';}
		if($ds_eth_breadcrumbs_navi == 'Yes'){ ?>
			<div class="container_gamma breadcrumbs">
				<?php ds_breadcrumb_nav(); ?>
			</div>
		<?php } ?>
			<div class="container_omega blogpage">
				<?php if($ds_eth_blog_sidebar_left != 0){ ?>
				<ul class="gs_<?php echo($ds_eth_blog_sidebar_left); ?> sidebar_mirror">
					<?php if(function_exists(dynamic_sidebar(1))):
					dynamic_sidebar(1);
					endif; ?>
				</ul>
				<?php } ?>
				<div class="gs_<?php echo(12-$ds_eth_blog_sidebar_right-$ds_eth_blog_sidebar_left); ?> <?php if($ds_eth_blog_sidebar_right == 0){echo 'omega';} ?>">
					<?php
					$paged = get_query_var('paged') ? get_query_var('paged') : 1;
					$args = $query_string.'&posts_per_page='.$ds_eth_blog_ppp1.'&paged='.$paged;
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
					$picsize_x = ((((12-$ds_eth_blog_sidebar_right-$ds_eth_blog_sidebar_left)-1)*77)+33);
					$picsize_y = $picsize_x*2;
					$ds_thumb = get_post_thumbnail_id(); 
					$ds_image = vt_resize( $ds_thumb,'' , $picsize_x, $picsize_y, false );
					?>
						<div id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
							<h2 class="post_header"><a href="<?php the_permalink() ?>" title="See the rest of <?php the_title_attribute(); ?> article."><?php the_title(); ?></a></h2>
							<p class="post_info"><a href="<?php the_permalink() ?>"><?php the_time('j M Y') ?></a> | <a href="<?php the_permalink() ?>"><?php comments_number(); ?></a> | <?php _e('posted by','designSentry'); ?> <?php the_author_link() ?> | <?php _e('in','designSentry'); ?> <?php the_category(', '); ?></p>
							<div class="hr"><div class="inner_hr"></div></div>
							<?php if(get_the_post_thumbnail($post->ID,'thumbnail')){ ?><a href="<?php the_permalink() ?>" class="post_info move_pos"><img src="<?php echo $ds_image[url]; ?>" class="border_magic alignleft" /></a><?php } ?>
							<div class="clearfix"></div>
							<?php global $more; $more = FALSE; ?>
							<?php the_content(__('Read more..','designSentry')); ?>
						</div>
					<?php endwhile; ?>
					<?php
					if (function_exists("pagination")) {
					pagination($loop->max_num_pages);
					} ?>
				</div>
				<?php if($ds_eth_blog_sidebar_right != 0){ ?>
				<ul class="gs_<?php echo($ds_eth_blog_sidebar_right); ?> sidebar omega">
					<?php if(function_exists(dynamic_sidebar(2))):
					dynamic_sidebar(2);
					endif; ?>
				</ul>
				<?php } ?>
			</div>
		</div>
		<!-- /containers -->
    </div>
    <div class="endmain"></div>
	<!-- /Main content alpha -->
	
    <!-- //Main Content Sector ends// -->
	<?php get_footer(); ?>