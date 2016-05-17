<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( 'You do not have sufficient permissions to access this page!' );
}
?>
<?php
/**
 * The Header for our theme.
 *
 *
 * @package Cromathemes
 * @subpackage Framework
 * @since 1.0
 */
$croma = get_option('cromatic');
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <meta name="viewport" content="width=device-width" />
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php wp_head(); ?>
</head>


<body <?php body_class(); ?>>



         <!-- fetch menu -->
        <nav id="croma-mobilenav" class="reveal-modal">
            <a class="mobilenav-close cro_cust_bg close-reveal-modal"><i class="icon-remove"></i></a>
            <?php                       
                if ( has_nav_menu('croma-primarynav' ) ) {
                    wp_nav_menu( array( 'container_class' => 'croma-mobilenavigation', 'theme_location' => 'croma-primarynav') );
                }
            ?>
        </nav>

        <?php if ($croma['cro_topb'] == 1) { ?>
        
            <?php  get_template_part('inc/templates/cromatop' ); ?>

        <?php }  ?>


        <?php if ($croma['cro_headtype'] == 2) { ?>

            <?php  get_template_part('inc/templates/cromaheader-home' ); ?>

        <?php }  ?>





         <div class="cro_menurow">

            <div class="container">

                <div class="row">

                     <div class="large-12 columns">

                            <?php  
                            if ( has_nav_menu('croma-topbarnav' ) ) {
                                wp_nav_menu( array( 'container_class' => 'croma-topbarnav', 'theme_location' => 'croma-topbarnav') );
                            } ?> 

                            <?php  if ( has_nav_menu('croma-primarynav' ) ) { ?>

                                <nav id="croma-primarynav">

                                    <div class="mobilemenupart" data-reveal-id="croma-mobilenav" data-reveal><i class="icon-reorder"></i></div>
                            
                                    <?php wp_nav_menu( array( 'container_class' => 'croma-primarynav', 'theme_location' => 'croma-primarynav') ); ?>

                                </nav>

                            <?php } ?> 

                    </div>

                </div>

            </div>

        </div>


         <?php if ($croma['cro_headtype'] == 1) { ?>

            <?php  get_template_part('inc/templates/cromaheader-home' ); ?>

        <?php }  ?>
        


