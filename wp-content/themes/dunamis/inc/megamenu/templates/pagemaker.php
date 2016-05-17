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
	'post_type' 		=> 'cromaticmms',
	'post_status' 		=> 'private',
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
		<h1><?php echo _e('Mega menu creator','croma'); ?> <span>&nbsp;</span></h1>


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




	<!--  Page wrap  -->
	<div class="cromatic_wrap cro_pagemaker_wrap">


		<!--  click to add part  -->
		<div class="cromatic_inner">
			<div class="cromatic_add_a_desc cro_toggle_me"><?php _e('Click to add a mega menu','croma'); ?></div>
		</div>


		<div class="cromatic_megamenu_creator">

			<div class="cro_adder_closer cro_toggle_me">x</div>


			<div class="cromatic_mm_left cromatic_page_dropper">
				<ul data-cro-side="l"></ul>
			</div>


			<div class="cromatic_mm_right cromatic_page_dropper">
				<ul  data-cro-side="r"></ul>
			</div><br/>


			<input type="text" class="create_mm_text" placeholder="<?php _e('Add a title here','croma'); ?>" />


			<p class="cro_mm_linkp">
				<a href="#" class="cro_mm_new_link" data-cro-mm-url="<?php echo admin_url('admin.php?page=cromatic_megamen'); ?>" data-cro-leftside="0" data-cro-rightside="0" data-cro-title="0"><?php _e('Create megamenu',''); ?></a>
			</p>


			<p class="cro_draginfo"><?php _e('Drag elements below to empty megamenu position','croma'); ?></p>
			<ul class="cro_megamenu">

				<li><div class="cro_ban cro_ban1"></div><div class="bandesc" data-cro-data="1"><?php _e('3 Banners','croma'); ?></div></li>
				<li><div class="cro_ban cro_ban2"></div><div class="bandesc" data-cro-data="2"><?php _e('2 navigation','croma'); ?></div></li>
				<li><div class="cro_ban cro_ban3"></div><div class="bandesc" data-cro-data="3"><?php _e('1 navigation & 2 banners','croma'); ?></div></li>
				<li><div class="cro_ban cro_ban4"></div><div class="bandesc" data-cro-data="4"><?php _e('Intro text','croma'); ?></div></li>
				<li><div class="cro_ban cro_ban5"></div><div class="bandesc" data-cro-data="5"><?php _e('Latest news','croma'); ?></div></li>
				<li><div class="cro_ban cro_ban6"></div><div class="bandesc" data-cro-data="6"><?php _e('2 banners','croma'); ?></div></li>
				<li><div class="cro_ban cro_ban7"></div><div class="bandesc" data-cro-data="7"><?php _e('Info banner','croma'); ?></div></li>
				<li><div class="cro_ban cro_ban8"></div><div class="bandesc" data-cro-data="8"><?php _e('Upcomming Events','croma'); ?></div></li>

			</ul>

		</div>


		<!-- Create the cromatic formparts -->
		<div class="cromatic_mainpagelist">
		<?php 
		if (!empty($pages)){
			$p_array = cromatic_pbuilder_layouts();
			foreach($pages as $valu) {
				$hdl 	= get_post_meta( $valu->ID, 'cro_type', true );
				$sdl 	= get_post_meta( $valu->ID, 'cromatic_post_order', true );
				$str1 	= 'admin.php?page=cromatic_megamen&id=' . $valu->ID;
				$str2 	= 'admin.php?page=cromatic_megamen&delete=1&id=' . $valu->ID;
				echo '
				<div class="cro_page_mainpart" rel="' . $valu->ID  . '" contents="' . $sdl  . '">
					<a href="' . admin_url($str1) . '" class="cro_page_editer"><i class="icon-edit"></i></a>
					<a href="' . admin_url($str2) . '" class="cro_page_deleter"><i class="icon-trash"></i></a>
					<div class="cro_pagecontentholder" rel="' . $valu->ID  . '">' .  get_the_title($valu->ID) . '</div>
				</div>
				';
			}
	
		} else {
			echo '<p class="cro_mn_nopostmess">' . __('No mega menu elements','croma') . '</p>';
		}
	
		?>

		</div>	
	</div>
</div>

