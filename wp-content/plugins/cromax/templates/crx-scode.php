<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Cromatic shortcode form
 *
 *
 * @package Cromatic
 * @subpackage Cromatic
 * @since 1.0
 */
?>

<div class="cro_shcode_main">

     <!-- Shortcode menu -->
    <ul class="cro_shccode_men">    
        <li class="tabber cro_topcurrent" rel="#crol1"><span><?php _e('Layout','croma'); ?></span></li> 
        <li class="tabber" rel="#crol2"><span><?php _e('Splash header with image','croma'); ?></span></li>  
        <li class="tabber" rel="#crol3"><span><?php _e('Splash header with color','croma'); ?></span></li> 
        <li class="tabber" rel="#crol4"><span><?php _e('Accordion','croma'); ?></span></li>    
        <li class="tabber" rel="#crol5"><span><?php _e('Tab','croma'); ?></span></li> 
        <li class="tabber" rel="#crol6"><span><?php _e('Icon textbox','croma'); ?></span></li> 
        <li class="tabber" rel="#crol7"><span><?php _e('Image textbox','croma'); ?></span></li>
        <li class="tabber" rel="#crol8"><span><?php _e('Seperator','croma'); ?></span></li>                  
    </ul>

    
    <div class="tabstrap">

        <!-- Layout Shortcode -->
        <div  id="crol1" class="cro_tabpage cro_tabcurrent" rel="croma-layout">
            <p>
                <select id="teamcatselector" class="croma-shortcode-selector"  rel="tlayoutno" >';
                    <option value="0"><?php _e('Select a layout...','croma'); ?></option>
                    <option value="1"><?php _e('Halves','croma'); ?></option>
                    <option value="2"><?php _e('Thirds','croma'); ?></option>
                    <option value="3"><?php _e('2/3 and 1/3','croma'); ?></option>
                    <option value="4"><?php _e('1/3 and 2/3','croma'); ?></option>
                    <option value="5"><?php _e('quarters','croma'); ?></option>
                    <option value="6"><?php _e('half & quarters','croma'); ?></option>
                    <option value="7"><?php _e('quarters & half','croma'); ?></option>
                </select>
            </p>
            <p class="cro_shortcode_submit">
                <input type="button" id="cro-shortcode-submit" class="cro_shortcode_submit_button" value="<?php _e('Insert layout Shortcode','croma'); ?>" name="cro-shortcode-submit"/>
            </p>
            <p class="shcode-explain">
                <?php _e('Insert a shortcode to add layouts to a page.','croma'); ?>
            </p>
        </div>

        <!-- Splash header with image -->
        <div  id="crol2" class="cro_tabpage" rel="cromax-splash-header">
            <p>
                <select id="teamcatselector" class="croma-shortcode-selector"  rel="mask" >';
                    <option value="0"><?php _e('Select a Mask...','croma'); ?></option>
                    <option value="1">0%</option>
                    <option value="2">10%</option>
                    <option value="3">20%</option>
                    <option value="4">30%</option>
                    <option value="5">40%</option>
                    <option value="6">50%</option>
                    <option value="7">60%</option>
                    <option value="8">70%</option>
                    <option value="9">70%</option>
                </select>
            </p>
            <p class="cro_shortcode_submit">
                <input type="button" id="cro-shortcode-submit" class="cro_shortcode_submit_button" value="<?php _e('Insert splash header Shortcode','croma'); ?>" name="cro-shortcode-submit"/>
            </p>
            <p class="shcode-explain">
                <?php _e('Insert a shortcode to add a splash header with background.<br/><br/> After the shortcode is inserted you can modify the contents','croma'); ?>
            </p>
        </div>

        <!-- Splash header with image -->
        <div  id="crol3" class="cro_tabpage" rel="cromax-color-header">
            <p class="cro_shortcode_submit">
                <input type="button" id="cro-shortcode-submit" class="cro_shortcode_submit_button" value="<?php _e('Insert splash header Shortcode','croma'); ?>" name="cro-shortcode-submit"/>
            </p>
            <p class="shcode-explain">
                <?php _e('Insert a shortcode to add a splash header with color.<br/><br/> After the shortcode is inserted you can modify the contents','croma'); ?>
            </p>
        </div>

        <!-- Accordion -->
        <div  id="crol4" class="cro_tabpage" rel="cromax-accordion">
            <p>
                <select id="teamcatselector" class="croma-shortcode-selector"  rel="accord" >';
                    <option value="0"><?php _e('Select number of tabs...','croma'); ?></option>
                    <?php for ($i=2; $i < 30 ; $i++) { 
                       echo '<option value="' . $i  . '">' . $i  . '</option>';
                    } ?>
                </select>
            </p>
            <p class="cro_shortcode_submit">
                <input type="button" id="cro-shortcode-submit" class="cro_shortcode_submit_button" value="<?php _e('Insert accordion Shortcode','croma'); ?>" name="cro-shortcode-submit"/>
            </p>
            <p class="shcode-explain">
                <?php _e('Insert a accodrion shortcode.<br/><br/> After the shortcode is inserted you can modify the contents','croma'); ?>
            </p>
        </div>

        <!-- Tab -->
        <div  id="crol5" class="cro_tabpage" rel="cromax-tabs">
            <p>
                <select id="teamcatselector" class="croma-shortcode-selector"  rel="tabski" >';
                    <option value="0"><?php _e('Select number of tabs...','croma'); ?></option>
                     <?php for ($i=2; $i < 30 ; $i++) { 
                       echo '<option value="' . $i  . '">' . $i  . '</option>';
                    } ?>
                </select>
            </p>
            <p class="cro_shortcode_submit">
                <input type="button" id="cro-shortcode-submit" class="cro_shortcode_submit_button" value="<?php _e('Insert tab Shortcode','croma'); ?>" name="cro-shortcode-submit"/>
            </p>
            <p class="shcode-explain">
                <?php _e('Insert a tab shortcode.<br/><br/> After the shortcode is inserted you can modify the contents','croma'); ?>
            </p>
        </div>

         <!-- icon text box -->
        <div  id="crol6" class="cro_tabpage" rel="cromax-icon-textbox">
            <p>
                <select id="teamcatselector" class="croma-shortcode-selector"  rel="icon" >';
                    <option value="0"><?php _e('Select a icon...','croma'); ?></option>
                    <option value="1"><?php _e('none','croma'); ?></option>
                    <?php 
                    $bc = cromax_get_fonticons();
                    sort($bc);
                    foreach ($bc as $v) {
                        echo '<option value="' . $v .'">' . $v .'</option>';
                    }


                    ?>
                </select>
            </p>
            <p class="cro_shortcode_submit">
                <input type="button" id="cro-shortcode-submit" class="cro_shortcode_submit_button" value="<?php _e('Insert icon textbox Shortcode','croma'); ?>" name="cro-shortcode-submit"/>
            </p>
            <p class="shcode-explain">
                <?php _e('Insert a textbox with an icon ','croma'); ?>
            </p>
        </div>

         <!-- image text box -->
        <div  id="crol7" class="cro_tabpage" rel="cromax-image-textbox">
            <p class="cro_shortcode_submit">
                <input type="button" id="cro-shortcode-submit" class="cro_shortcode_submit_button" value="<?php _e('Insert image textbox Shortcode','croma'); ?>" name="cro-shortcode-submit"/>
            </p>
            <p class="shcode-explain">
                <?php _e('Insert a textbox with an image ','croma'); ?>
            </p>
        </div>

        <!-- seperator -->
        <div  id="crol8" class="cro_tabpage" rel="cromax-seperator">
            <p>
                <select id="teamcatselector" class="croma-shortcode-selectort"  rel="mtop" >';
                    <option value="0"><?php _e('Padding top...','croma'); ?></option>
                    <option value="0">0</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                    <option value="60">60</option>
                    <option value="70">70</option>
                    <option value="80">80</option>
                    <option value="90">90</option>
                </select>
            </p>
            <p>
                <select id="teamcatselector" class="croma-shortcode-selectorb"  rel="mbottom" >';
                    <option value="0"><?php _e('Padding bottom...','croma'); ?></option>
                    <option value="0">0</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="40">40</option>
                    <option value="50">50</option>
                    <option value="60">60</option>
                    <option value="70">70</option>
                    <option value="80">80</option>
                    <option value="90">90</option>
                </select>
            </p>
            <p class="cro_shortcode_submit">
                <input type="button" id="cro-shortcode-submit" class="cro_shortcode_submit_button" value="<?php _e('Insert seperator Shortcode','croma'); ?>" name="cro-shortcode-submit"/>
            </p>
            <p class="shcode-explain">
                <?php _e('Insert a shortcode to add seperator.','croma'); ?>
            </p>
        </div>

    </div>



</div>