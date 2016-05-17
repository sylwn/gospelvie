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


$croma = get_option('cromatic');


if ($croma['cro_headtype'] == 2) {

	$headclass = "cro_standardheader";

} else {

	$headclass = "cro_minimalheaderheader";

}


?>


<header id="pageheader" class="<?php echo $headclass; ?>">


    <!-- fetch main navigation part -->
    <div class="row">

    	<div class="large-12 columns">

            <?php  
            	if ( has_nav_menu('croma-subnav' ) ) {
            		wp_nav_menu( array( 'container_class' => 'croma-subnav', 'theme_location' => 'croma-subnav') );
            	} 
            ?> 

                    
			 <?php if ($croma['cro_logoimg'] ) { ?>
                    

				<div class="croma-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
						<img src="<?php echo $croma['cro_logoimg']; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
					</a>
				</div>
                    
			
			<?php } else { ?>
                                
            
            	<hgroup>
            		<h1 class="croma-title cro_cust_font">
            			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home" class="cro_cust_color">
            				<?php bloginfo( 'name' ); ?>
						</a>
					</h1>
            	</hgroup>
                    

            <?php } ?>


		</div>


	</div>


</header>




