<?php

/**
 * Pagemaker template
 *
 *
 * @author 		Croma
 * @category 	Admin
 * @package 	templates
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$args = array(
	'post_type' 		=> 'cromaticfronts',
	'post_status' 		=> 'private',
	'meta_key' 			=> 'cromatic_post_order', 
	'orderby' 			=> 'meta_value_num',
	'order' 			=> 'ASC',
	'posts_per_page' 	=> -1
); 
$pages = get_posts($args); 
									
?>



<!-- CROMATIC PAGE WRAPPER-->
<div class="cromatic_wrapper">




	<!-- CROMATIC PREHEADER -->
	<div class="cromatic_preheader">

		<!--  Page title  -->
		<h1><?php echo _e('Frontpage Composer','croma'); ?></h1>


		<!--  update message  -->
		<?php if(isset($_GET['updated'])){
			switch ($_GET['updated']) {
				case 1:
					echo'<p class="cro_mn_updatemessage">' .  __('Post deleted','croma') . '</p>';
				break;
				case 2:
					echo'<p class="cro_mn_updatemessage">' .  __('Post updated','croma') . '</p>';
				break;			
			}
		} ?>

	</div><!-- cromatic_preheader -->




	<!-- TOGGLER HEADER -->
	<div class="cro_togglerwrap">

		<!--  click to add part  -->
		<div class="cromatic_inner">
			<div class="cromatic_add_a_desc cro_toggle_me"><?php _e('Click here to add a page element','croma'); ?></div>
		</div>


		<!-- pagebuilder layouts-->
		<div class="cromatic_adder">
			<div class="cro_adder_closer cro_toggle_me">x</div>
			<ul class="cro_ul_adder">
				<?php foreach (cromatic_pbuilder_layouts() as $value) {
					if (isset($value['divider']) &&  $value['divider'] == 'yes') {
						echo '<li class="cro_divider_maker">&nbsp;</li>';
					}
					echo '<li class="cro_page_adder" rel="' . $value['handle']  . '"><a href="' . admin_url( 'admin.php?page=cromatic&action=' . $value['handle'] )  . '"><i class="' .  $value['icon']  . '"></i>' .  $value['name'] . '</a></li>';
				} ?>
			</ul>
		</div>

	</div> <!-- cro_togglerwrap -->


<div class="cro_pagewrapper">

<!--  Page wrap  -->
<div class="cromatic_wrap cro_pagemaker_wrap">



	<!-- Create the cromatic formparts -->
	<div class="cromatic_mainpagelist">
	<?php 
	if (!empty($pages)){
		$p_array = cromatic_pbuilder_layouts();
		foreach($pages as $valu) {
			$hdl 	= get_post_meta( $valu->ID, 'cro_type', true );
			$sdl 	= get_post_meta( $valu->ID, 'cromatic_post_order', true );
			$str1 	= 'admin.php?page=cromatic&id=' . $valu->ID . '&action=' . $hdl;
			$str2 	= 'admin.php?page=cromatic&delete=1&id=' . $valu->ID;
			echo '
			<div class="cro_page_mainpart" rel="' . $valu->ID  . '" contents="' . $sdl  . '">
				<a href="' . admin_url($str1) . '" class="cro_page_editer"><i class="icon-edit"></i></a>
				<a href="' . admin_url($str2) . '" class="cro_page_deleter"><i class="icon-trash"></i></a>
				<div class="cro_pagecontentholder" rel="' . $valu->ID  . '">' .  $p_array[$hdl]['name']  . '</div>
			</div>
			';
		}
	} else {
		echo '<p class="cro_mn_nopostmess">' . __('No frontpage elements','croma') . '</p>';
	}
	?>

		
	</div>
</div>

</div>

</div>

