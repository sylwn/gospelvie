<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Cromatic color header
 *
 *
 * @package Cromatic
 * @subpackage Cromatic
 * @since 1.0
 */

$bgcol		= ($bgcol != '')?  ' style="background: ' . $bgcol . ';" ' :  ''  ;
$col 		= ($col != '')?  ' style="color: ' . $col . ';" ' :  ''  ;
$title      = ($title != '')? '<h2 class="cro_cust_font" ' . $col  . ' >' .  $title  . '</h2>' : '';
$img        = ($img != '')?  ' style="background: url(' .  $img  . ') no-repeat center;" ' : '';
$content    = ($content != '')?  '<p ' .  $col  . '>' .  str_replace('<p>', '<p ' .  $col  . '>', $content)  . '</p>' : '';
$mask 		= ($mask >= 1)? 'cro_mask-' . $mask : '';

?>


<div class="cro_color-head" <?php echo $bgcol; ?>>
    <div class="cro_prodmask">

        <?php echo $title; ?>

        <?php echo $content; ?>

    </div>
</div>