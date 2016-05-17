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


/** If woo commerce is not active, return nothing. **/
if ( class_exists( 'Woocommerce' ) ) {

global $woocommerce;



$postarr = get_post_custom($id);


// front page animation
$cro_anim  		=   (isset($postarr['cro_anim'][0]) && $postarr['cro_anim'][0] != 0 )? 
					'data-cro-anim-data="' . $animarr[$postarr['cro_anim'][0]] . '"' : '';	
$cro_animclass  =   ($cro_anim != '' )? ' animated ' : '';



/** Is there a floating image? **/
$float_image 			= get_post_meta( $id, 'cro_layimage', true );
$float_class 			= (get_post_meta( $id, 'cro_layimage', true ) != '')? 'cro_wsh_hasfloater' : '' ;


/** Prepare the title **/
$title_info 			= get_post_meta( $id, 'cro_laytitle', true );
$title 					= ($title_info != '')? '<h3 class="cro_cust_font cro_header">' .  stripslashes(html_entity_decode($title_info))  . '</h3>' : '' ;


/** Prepare the content **/
$content_info 			= get_post_meta( $id, 'cro_laydesc', true );
$content 				= ($content_info != '')? '<p class="cro_wsh_content">' .  stripslashes(html_entity_decode($content_info))  . '</p>' : '' ;



/** Prepare the store components **/
$category 				= get_post_meta( $id, 'cro_laycat', true );
$numbermeta 			= get_post_meta( $id, 'cro_laynumber', true );
$number 				= (is_numeric($numbermeta))?  $numbermeta  :   4;
$cro_ids_on_sale 		= woocommerce_get_product_ids_on_sale();
$cro_meta_query 		= $woocommerce->query->get_meta_query();

switch ($category) {
	case 1:
		$args = array(
			'post_type' 				=> 'product',
			'post_status' 				=> 'publish',
			'ignore_sticky_posts'   	=> 1,
			'posts_per_page' 			=> $number
		);
	break;

		case 2:
		$args = array(
			'post_status' 				=> 'publish',
			'post_type' 				=> 'product',
			'ignore_sticky_posts'   	=> 1,
			'meta_key' 					=> '_featured',
			'meta_value' 				=> 'yes',
			'posts_per_page' 			=> $number
		);
	break;

		case 3:
		$args = array(
			'posts_per_page' 			=> $number,
			'no_found_rows' 			=> 1,
			'post_status' 				=> 'publish',
			'post_type' 				=> 'product',
			'orderby' 					=> 'date',
			'order' 					=> 'ASC',
			'meta_query' 				=> $cro_meta_query,
			'post__in'					=> $cro_ids_on_sale 
		);
	break;

	case 4:
		$args = array(
			'post_type' 				=> 'product',
			'post_status' 				=> 'publish',
			'ignore_sticky_posts'   	=> 1,
			'posts_per_page' 			=> $number,
			'meta_key' 					=> 'total_sales',
			'orderby' 					=> 'meta_value'
         );
	break;

}


/** Prepare the link details **/
$cro_laylink 			= (get_post_meta( $id, 'cro_laylink', true ) != '')? get_post_meta( $id, 'cro_laylink', true ) :   0;
$linklabel 				= (get_post_meta( $id, 'cro_laylabel', true ) != '')? get_post_meta( $id, 'cro_laylabel', true )  : '' ;
$linkshop 				= ($cro_laylink == 1 && $linklabel != '') ?  '<p class="cro_productshoplink"><a class="cro_productspage_visitshop cro_cust_font" href="' . get_permalink(esc_attr( get_option('woocommerce_shop_page_id')))  . '">' . $linklabel   . '</a></p>' :  '';



/** Prepare the slider details **/
$cro_linkrand			= cromatic_randstring(5);
$cro_slide_sw 			= ($number >= 4)?   'cro_hashorslider' : ''  ;





?>

<!-- start hte woocommerce section -->
<section class="cro_frontpage_wsh cro_frontpage_layout <?php echo $classname; ?> <?php echo $float_class; ?>">


	<!-- add the content -->
	<?php if ($float_image  != '') { ?>
		<div class="floater cro_floaters" style="background: url(<?php echo $float_image; ?>) no-repeat center top fixed; background-size: cover;">
			&nbsp;
		</div>
	<?php } ?>



	<div class="wsh_titlebg">
		<div class="row">

			<?php echo $title; ?>

			<?php echo $content; ?>

		</div>

	</div>

	<!-- add the code foe the woocommerce loop -->
	<div class="row">

		<div class="large-12 columns <?php echo $cro_animclass; ?>" <?php echo $cro_anim; ?>>
			<ul class="cro_archiveprod cro_horslider <?php  echo $cro_slide_sw; ?>" data-cro-showslide="<?php  echo $cro_slide_sw; ?>" data-cro-linkstring="<?php echo $cro_linkrand; ?>" data-cro-maxslides="3" data-cro-maxwidth="325" data-cro-maxspacer="5">
				<?php $products = new WP_Query( $args );
					if ( $products->have_posts() ) :
						while ( $products->have_posts() ) : $products->the_post();
							woocommerce_get_template_part( 'content', 'product' ); 
						endwhile; 
					endif; 
				wp_reset_query();
			?>
			</ul>


			<div class="cro_shopdircol">
				<?php if ($number >= 4) { ?>
					<ul>
						<li class="<?php echo $cro_linkrand; ?>-linkleft"></li>
						<li class="<?php echo $cro_linkrand; ?>-linkright"></li>
					</ul>
				<?php } else { ?>
					&nbsp;
				<?php } ?>
			</div>
		</div>
	</div>


	<?php echo $linkshop; ?>

</section>

<?php } ?>