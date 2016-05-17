<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Cromatic team shortcode
 *
 *
 * @package Cromatic
 * @subpackage Cromatic
 * @since 1.0
 */

$title      = ($title != '')? '<h2 class="cro_cust_font">' .  $title  . '</h2>' : '';
$img        = ($img != '')?  ' style="background: url(' .  $img  . ') no-repeat center;" ' : '';
$content    = ($content != '')?  '<p>' .  $content  . '</p>' : '';
$mask 		= ($mask >= 1)? 'cro_mask-' . $mask : '';

?>


<div class="cro_splash-head" <?php echo $img; ?>>
    <div class="cro_prodmask <?php echo $mask; ?>">

        <?php echo $title; ?>

        <?php echo $content; ?>

    </div>
</div>