<?php

/**
 * Sidebar template
 *
 *
 * @author 		Croma
 * @category 	Admin
 * @package 	templates
 * @version     1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$cro_sidebararray = get_option( 'cromatic_sidebars');

										
?>


<!-- CROMATIC PAGE WRAPPER-->
<div class="cromatic_wrapper">


	<!-- CROMATIC PREHEADER -->
	<div class="cromatic_preheader">

		<!--  Page title  -->
		<h1><?php echo _e('Sidebar Composer','croma'); ?></h1>


		<!--  update message  -->
		<?php if(isset($_GET['updated'])){
			switch ($_GET['updated']) {
				case 1:
					echo'<p class="cro_mn_updatemessage">' .  __('Sidebar sucessfully updated','croma') . '</p>';
				break;
				case 2:
					echo'<p class="cro_mn_updatemessage">' .  __('Sidebar sucessfully deleted','croma') . '</p>';
				break;			
			}
		} ?>

	</div><!-- cromatic_preheader -->



		<!-- TOGGLER HEADER -->
	<div class="cro_togglerwrap">

		<form method="post" class="cro-add-sidebarform" action="<?php admin_url('admin.php?page=cromatic_sbar'); ?>">
			<input type="hidden" name="cro_sbar_submit" value="Y"/>
			<input type="submit" value="Create" class="cro_sidebarcreate_btn">
			<input type="text" class="cro_add_sidebar"  name="cro_sbarname" placeholder="<?php  _e('Type sidebar name and click create','croma'); ?>" rel="<?php  _e('Type sidebar name and click create','croma'); ?>">
		</form>

	</div> <!-- cro_togglerwrap -->




	<div class="cro_pagewrapper">


		<!-- add the page wrapper  -->
		<div class="cromatic_wrap cro_pagemaker_wrap">


			<!-- list all the current sidebars  -->
			<div class="cromatic_mainpagelist">

			<?php if (!empty($cro_sidebararray)){ 
				foreach($cro_sidebararray as $v) {
					$str2 	= 'admin.php?page=cromatic_sbar&delete=1&id=' . urlencode($v);
			?>


				<div class="cro_page_mainpart cro_gradientsys">
					<a href="<?php echo  admin_url($str2); ?>" class="cro_page_deleter"><i class="icon-trash"></i></a>
					<div class="cro_pagecontentholder" ><?php echo esc_attr($v); ?></div>
				</div>


			<?php } }  ?>

		
			</div>
		</div>
	</div>
</div>

