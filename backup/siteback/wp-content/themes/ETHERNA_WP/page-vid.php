<?php
/*
Template Name: Page Suited for Video
*/
get_header();
global $options;
foreach ($options as $value) {
    if (get_option( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_option( $value['id'] ); }
}
?>
	<!-- Main content alpha -->
	<div class="main">
		<div class="inner_main">
			<div class="container_alpha slider">
				<?php if (have_posts()) :
					while (have_posts()) : the_post();
					the_content('');
					endwhile;
					endif; ?>
			</div>
		</div>
		<!-- /containers -->
    </div>
    <div class="endmain"></div>
	<!-- /Main content alpha -->
	
    <!-- //Main Content Sector ends// -->
	<?php get_footer(); ?>