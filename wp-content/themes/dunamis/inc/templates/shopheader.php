<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>

<?php
/**
 * The template for displaying the header and header image
 *
 *
 * @author 		Croma
 * @package 	templates
 * @version     1.0
 */


$headimg = get_header_image();
$defimg  = get_template_directory_uri() . '/assets/styles/framework-images/defimg.jpg';
$cromatitle = '';


$cromatitle 	= '<h1 class="cro_cust_font">' . woocommerce_page_title() . '</h1>';


?>
<!-- draw the section -->
<section id="cromaheader">
	<div class="row cro_headerrow">
		<div class="large-12 column cro_headerrow">
			<div class="page_title">
				<div class="page_title_inner">
					<?php echo $cromatitle; ?>
				</div>
			</div>
		</div>
	</div>
</section>
