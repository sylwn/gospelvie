(function(){

    tinymce.create('tinymce.plugins.croshortcode', {

        createControl : function(id, controlManager) {
            if (id == 'crxshortcode_button') {

                var button = controlManager.createButton('crxshortcode_button', {
                    title : 'Cromax Shortcode', 
                    image : crx_shortcodeicon, 
                    onclick : function() {
                       
                        var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                        W = W - 80;
                        H = H - 84;
                        tb_show( 'Cromax Shortcode Manager', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=cro_shortcode_form' );

                    }
                });
                return button;
            }
            return null;
        }
    });
 

    tinymce.PluginManager.add('crxshortcode', tinymce.plugins.croshortcode);


    jQuery(function(){
        var data = {
                action: 'crx_shortcode_action',
                type: 'short_form'},
                form = jQuery('<div id="cro_shortcode_form">\
                                    <div class="cro_shcode_strap">\
                                    </div>\
                                </div>'),
                shortcode = '';
           

        form.appendTo('body').hide();


        jQuery.post(ajaxurl, data, function(response) {

            form.find('.cro_shcode_strap').html(response);
            form.find('#cro_shortcode_form').appendTo('body').hide();
            form.find('input.cro_shortcode_submit_button').on("click", function(){
                var $this   = jQuery(this);
                click_a_shortcode($this);
            });
            form.find('li.tabber').unbind('click').bind('click', update_a_tabski);
        });


         function update_a_tabski() {
            var $this   = jQuery(this);
            var $tc     = $this.parents('ul').find('.cro_topcurrent');
            var node    = jQuery(this).attr('rel');
            var $ttab   = jQuery('.cro_tabcurrent');
            $tc.removeClass('cro_topcurrent');
            $this.addClass('cro_topcurrent');
            $ttab.removeClass('cro_tabcurrent');
            $ttab.parents('.cro_shcode_strap').find(node).addClass('cro_tabcurrent')
            return;             
         }

         
         function click_a_shortcode(el) {
            var $this       = jQuery(el),
                shParent    = $this.parents('.cro_tabpage'),
                shName      = shParent.attr('rel');


            if (shName == 'croma-layout') {
                var layoutno =  shParent.find('.croma-shortcode-selector').val();

                switch (layoutno) {
                    case '1':
                        var  shString  = '[cromax-halves-layoutstart] [cromax-halves-layoutmid] [cromax-layoutend]';
                    break;
                    case '2':
                        var  shString  = '[cromax-thirds-firstthird] [cromax-thirds-secondthird] [cromax-thirds-third-third] [cromax-layoutend]';
                    break;
                    case '3':
                        var  shString  = '[cromax-thirds-twothirds] [cromax-thirds-onethird] [cromax-layoutend]';
                    break;
                    case '4':
                        var  shString  = '[cromax-thirds-onethirds] [cromax-thirds-twothird] [cromax-layoutend]';
                    break;
                    case '5':
                       var  shString  = '[cromax-quarters-firstquarter] [cromax-quarters-secondquarter] [cromax-quarters-thirdquarter] [cromax-quarters-fourthquarter] [cromax-layoutend] ';
                    break;
                    case '6':
                       var  shString  = '[cromax-quarters-firsthalf] [cromax-quarters_half-firstquarter] [cromax-quarters_half-secondquarter] [cromax-layoutend] ';
                    break;
                    case '7':
                       var  shString  = '[cromax-quarters-half-firstquarters] [cromax-quarters-half_secondquarters] [cromax-quarters-lasthalf] [cromax-layoutend] ';
                    break;
                }

            } else if (shName == 'cromax-splash-header') {

                var layoutno =  shParent.find('.croma-shortcode-selector').val(),
                    shString =  '[cromax-splash-header title="your title here" img="image address here" mask="' + layoutno + '"] sub message here[/cromax-splash-header]';

            } else if (shName == 'cromax-color-header') {

                var shString =  '[cromax-color-header title="your title here" col="color here" bgcol="background color here"] sub message here[/cromax-color-header]';

            } else if (shName == 'cromax-accordion') {

                var layoutno =  shParent.find('.croma-shortcode-selector').val(),
                    tabno   = '';

                for (var i = 1; i <= layoutno; i++) {
                    tabno = tabno + '[cromax-accordion title="add your title"]add your content[/cromax-accordion]';
                };


                 var shString =  '[cromax-accordions title="your title here"] ' + tabno + '[/cromax-accordions]';

            } else if (shName == 'cromax-tabs') {

                var layoutno =  shParent.find('.croma-shortcode-selector').val(),
                    tabno   = '';

                for (var i = 1; i <= layoutno; i++) {
                    tabno = tabno + '[cromax-tab title="add your title"]add your content[/cromax-tab]';
                };


                 var shString =  '[cromax-tabs title="your title here"] ' + tabno + '[/cromax-tabs]';

            } else if (shName == 'cromax-icon-textbox') {

                var layoutno =  shParent.find('.croma-shortcode-selector').val();
                var shString = '[cromax-icon-textbox title="add your title" icon="' + layoutno + '" color="#aaa" subtitle="add your subtitle or delete" link="add link address or leave open" label="add label"]add your content[/cromax-icon-textbox]';
    

            } else if (shName == 'cromax-seperator') {

                var layouta =  shParent.find('.croma-shortcode-selectort').val();
                var layoutb =  shParent.find('.croma-shortcode-selectorb').val();
                var shString = '[cromax-seperator top="' + layouta  + '" bottom="' + layoutb + '"]';
    

            } else if (shName == 'cromax-image-textbox') {
 
                var shString = '[cromax-image-textbox title="add your title" image="address to image" subtitle="add your subtitle or delete" link="add link address or leave open" label="add label"]add your content[/cromax-image-textbox]';
    
            } else {
                var shString    = '[' + shName + ' ';

                shParent.find('.croma-shortcode-selector').each(function() {
                    var self    = jQuery(this),
                        string  = self.attr('rel'),
                        vl      = self.val();

                    shString += string + '="' + vl + '" ';
                });

            shString += ']';

            }

            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shString);
            
            tb_remove();

         }      
    });
})()