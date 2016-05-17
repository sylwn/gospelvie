/* Author: 
Daniel Łęczycki www.designsentry.com
*/

jQuery(document).ready(function() {

	/* Search on hover effect, focus effect, and double-click to erase value */
	hasFocci = false;
	jQuery('#search_input').focus(function(){
		jQuery(this).stop().animate({"opacity": "1"},{queue:false,duration:300});
		hasFocci = true;
	}).blur(function() {
		jQuery(this).stop().animate({"opacity": "0.01"},{queue:false,duration:300});
		hasFocci = false;
	}).dblclick(function() {
		jQuery(this).val('');
		hasFocci = true;
	});
	jQuery('#search_submit').add('#search_input').hover(function(){
		jQuery(this).stop().animate({"opacity": "1"},{queue:false,duration:300});
	},function() {
		if(!hasFocci){jQuery(this).stop().animate({"opacity": "0.01"},{queue:false,duration:300});}
		if(hasFocci){jQuery(this).filter('#search_submit').stop().animate({"opacity": "0.01"},{queue:false,duration:300});}
	});

	/* Menu jQuery rollout, additional styling allowing for rounded borders */
	var Menus = jQuery('#menu ul li');
	if(!(jQuery.browser.msie && jQuery.browser.version.substr(0,1)<8)){Menus.find('ul li').has('ul li').find('>a').append('<span> &raquo;</span>');}
	Menus.find('ul li:first-child').addClass('first_sub png_bg');
	Menus.find('ul').append('<li class="last_sub png_bg"></li>');
	Menus.find('ul').css({display: "none"}); // Opera Fix
	Menus.hover(function(){
		jQuery(this).not(':has(ul)').find('> a').addClass('menu_box_mid_bg');
		jQuery(this).has('ul').find('> a').addClass('menu_box_mid_bg_has_li');
		jQuery('span.menu_box_left', this).addClass('menu_box_left_bg');
		jQuery('span.menu_box_right', this).addClass('menu_box_right_bg');
	},function() {
		jQuery(this).not(':has(ul)').find('> a').removeClass('menu_box_mid_bg');
		jQuery(this).has('ul').find('> a').removeClass('menu_box_mid_bg_has_li');
		jQuery('span.menu_box_left', this).removeClass('menu_box_left_bg');
		jQuery('span.menu_box_right', this).removeClass('menu_box_right_bg');
	});
	Menus.hoverIntent({
	over: makeTall, 
	timeout: 300, 
	out: makeShort
	});
	function makeTall(){ jQuery(this).find('ul:first').slideDown({queue:false,duration:220});}
	function makeShort(){ jQuery(this).find('ul:first').fadeOut({queue:true,duration:200});}
	
	/* Automated sidebar top/bottom finishing graphics */
	if(!(jQuery.browser.msie && jQuery.browser.version=="6.0")){
	jQuery('.sidebar').wrapInner('<div class="sidebar"></div>').prepend('<div class="top_sidebar_mask"></div>').append('<div class="bottom_sidebar_mask"></div>').removeClass('sidebar');
	jQuery('.sidebar_mirror').wrapInner('<div class="sidebar_mirror"></div>').prepend('<div class="top_sidebar_mask_mirror"></div>').append('<div class="bottom_sidebar_mask_mirror"></div>').removeClass('sidebar_mirror');
	};
	
	/* Pricing Table */
	var pricingcolumn = jQuery('.pricing_column');
	pricingcolumn.hover(function(){
		jQuery(this).find('.pricing_blurb').animate({top: '10px'},300);
	},function(){
		jQuery(this).find('.pricing_blurb').animate({top: '0px'},300);
	});
	
	/* Set the pricing tables to the right size */
	var pricingrowselector = jQuery('.pricing');
	pricingrowselector.each(function(){
		var numberofcolumns = jQuery(this).find('.pricing_column').length;
		var widthofrow = jQuery(this).parent().width();
		var finalresult = (11 + Math.floor(((widthofrow-2) - (numberofcolumns * (168)))/(numberofcolumns * 2)));
		jQuery(this).find('.pricing_blurb').css({marginLeft: finalresult,marginRight: finalresult});
	});
	
	/* Hack for all browsers to load the slider nicier way. The #slider has default property of display:none in css(for nice IE loading), then when js is loaded it changes to block (so Opera can
	render height of the slider properly while loading images), and then hides it again. Later, when all images are loaded - the fadeIn function kicks in. */
	jQuery('#slider').css({display: "block"}).hide();
	
	/* Social networking icons fade on hover, and footer links neo-tech blink :) */
	jQuery('#footer ul li a').hover(function(){
		jQuery(this).stop().animate({"opacity": "0.45"},{queue:true,duration:300});
	}, function() {
		jQuery(this).stop().animate({"opacity": "1"},{queue:true,duration:300});
	});
	
	/* Clear input on focus in fields */
	jQuery('input:not(.wpcf7-submit,#submit)').each(function(){
	var inputfieldval = jQuery(this).val();
		jQuery(this).focus(function(){
			if(inputfieldval==jQuery(this).val()){
				jQuery(this).val('');
			}
		});
		jQuery(this).blur(function(){
			if(jQuery(this).val()==''){
				jQuery(this).val(inputfieldval);
			}
		});
	});
	
	jQuery(".inner_main select, .inner_main input:checkbox, .inner_main input:radio, .inner_main input:file").uniform();
	
	jQuery("a[rel^='prettyPhoto']").add('.zoomer').add('.inner_main a:has(img.wpimgload)').prettyPhoto();
	
	/* Toggler */
	jQuery('div.toggler:not(.open)').hide();
	jQuery('.toggle').click(function(){
		jQuery(this).toggleClass("active").next().slideToggle("fast");
	});
	
	/* Tabber */
	jQuery('.ds_tabber_wrap,.ds_vtabber_wrap').each(function(){
	var tabContainers = jQuery(this).find('.ds_tabber');
	var tabSelectors = jQuery(this).find('.tabber li');
    tabContainers.hide();
    jQuery(this).find('ul.tabber li a').click(function(){
        tabContainers.hide().filter(this.hash).fadeIn(500);
        tabSelectors.removeClass('selected');
        jQuery(this).parent().addClass('selected');
        return false;
    });
	jQuery(this).find('ul.tabber li a:first').click();
	});
});
/* End of onstart functions */

/* Start of functions initialized after full load of page */
jQuery(window).load(function(){
	/* Portfolio sortables */
	var highBoxes = 0,
	speed = 1000,
	grid = jQuery('#portfolio_wrap'),
	sortable_navi = jQuery('#portf2sorter a');
	jQuery('#portfolio_wrap .box').each(function(){
		var topBoxes = jQuery(this).height();
		if(topBoxes > highBoxes){highBoxes = topBoxes};
	});
	jQuery('#portfolio_wrap .box').height(highBoxes);
    grid.masonry({
    singleMode: true,
        itemSelector: '.box:not(.hide)',
        animate: true,
        animationOptions: {
			duration: speed,
			queue: false
        }
    });
    sortable_navi.click(function(){
		sortable_navi.removeClass('selected');
		var selectorz = (this.hash).replace('#','.').replace(/ /g,'_');
        if(selectorz=='.All') {
			jQuery(this).addClass('selected');
			grid.children('.hide').toggleClass('hide').fadeIn(speed);
        } else {
			jQuery(this).addClass('selected');
			grid.children().not(selectorz).not('.hide').toggleClass('hide').fadeOut(speed);
			grid.children(selectorz+'.hide').toggleClass('hide').fadeIn(speed);
        }
        grid.masonry();
        return false;
      });
	
	/* Adding some Border magic */
	var borderSubject = jQuery('.inner_main .border_magic, #footer .border_magic,.sidebar .wpp-thumbnail');
	borderSubject.wrap('<div class="add_border" />');
	
	/* Transfering alignment to added border */
	var bordered = jQuery('.inner_main .add_border, #footer .add_border');
	bordered.find('.alignleft').removeClass('alignleft').parent().addClass('alignleft');
	bordered.find('.alignright').removeClass('alignright').parent().addClass('alignright');
	bordered.find('.no_bottom_margin').removeClass('no_bottom_margin').parent().addClass('no_bottom_margin');
	
	/* Making the added border width completely automatic */
	borderSubject.each(function(){
	var addBordi = jQuery(this).width();
	jQuery(this).parent().width(addBordi+10);
	});
	
	/* Catch the height of longest footer column and stretch the others to the same size */
	var highHeels = 0;
	jQuery('#footer .widget').each(function(){
	var topHeels = jQuery(this).height();
	if(topHeels > highHeels){highHeels = topHeels};
	});
	jQuery('#footer .widget').height(highHeels);
	
	/* Cycle the "Hot stuff this week" */
	jQuery('.hotstuff ul, ul.testimonials').cycle({
		fx: 'fade',
		timeout:       7000,
		speed:         1000,
		before: onAfter
	});
	function onAfter(curr, next, opts, fwd){
        //get the height of the current slide
        var ht = jQuery(this).height();
        //set the container's height to that of the current slide
        jQuery(this).parent().animate({height: ht});
	}
	/* Spyglass icon on hover over images */
	jQuery('.zoomer img,.inner_main a .add_border img.wpimgload').hover(function(){
		jQuery(this).animate({"opacity": "0.45"},{queue:true,duration:300});
	}, function() {
		jQuery(this).animate({"opacity": "1"},{queue:true,duration:300});
	});
	jQuery('.inner_main a .add_border:has(img.wpimgload)').parent().addClass('zoomer');
});