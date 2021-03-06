/*! $.noUiSlider
 *  Documentation available at:
 *  http://refreshless.com/nouislider/
 *
 *  Copyright Léon Gersen, https://twitter.com/LeonGersen
 *  Released under the WTFPL license
 *  http://www.wtfpl.net/about/
 */
(function(f){if(f.zepto&&!f.fn.removeData)throw new ReferenceError("Zepto is loaded without the data module.");f.fn.noUiSlider=function(x){function n(a,c,d){f.isArray(a)||(a=[a]);f.each(a,function(){"function"===typeof this&&this.call(c,d)})}function s(a){return a instanceof f||f.zepto&&f.zepto.isZ(a)}function y(a){a.preventDefault();var c=0===a.type.indexOf("touch"),d=0===a.type.indexOf("mouse"),b=0===a.type.indexOf("pointer"),h,l,e=a;0===a.type.indexOf("MSPointer")&&(b=!0);a.originalEvent&&(a=a.originalEvent);
c&&(h=a.changedTouches[0].pageX,l=a.changedTouches[0].pageY);if(d||b)b||void 0!==window.pageXOffset||(window.pageXOffset=document.documentElement.scrollLeft,window.pageYOffset=document.documentElement.scrollTop),h=a.clientX+window.pageXOffset,l=a.clientY+window.pageYOffset;return f.extend(e,{pointX:h,pointY:l,cursor:d})}function p(a,c,d,b,h){a=a.replace(/\s/g,q+" ")+q;if(h)return c.on(a,f.proxy(d,f.extend(c,b)));b.handler=d;return c.on(a,f.proxy(function(b){if(this.target.hasClass("noUi-state-tap")||
this.target.attr("disabled"))return!1;this.handler(y(b))},b))}function k(a){return!isNaN(parseFloat(a))&&isFinite(a)}function z(){var a=parseFloat(this.style[f(this).data("style")]);return isNaN(a)?-1:a}function A(a){var c=this.target;if(void 0===a)return this.element.data("value");!0===a?a=this.element.data("value"):this.element.data("value",a);f.each(this.elements,function(){if("function"===typeof this)this.call(c,a);else this[0][this[1]](a)})}function B(){var a=[null,null];a[this.which]=this.val();
this.target.val(a,!0)}function C(a,c){var d={handles:{r:!0,t:function(b){b=parseInt(b,10);return 1===b||2===b}},range:{r:!0,t:function(b,a,c){if(2!==b.length)return!1;b=[parseFloat(b[0]),parseFloat(b[1])];if(!k(b[0])||!k(b[1])||"range"===c&&b[0]===b[1]||b[1]<b[0])return!1;a[c]=b;return!0}},start:{r:!0,t:function(b,a,c){return 1===a.handles?(f.isArray(b)&&(b=b[0]),b=parseFloat(b),a.start=[b],k(b)):d.range.t(b,a,c)}},connect:{t:function(b,a){return 1===a.handles?"lower"===b||"upper"===b:"boolean"===
typeof b}},orientation:{t:function(b){return"horizontal"===b||"vertical"===b}},margin:{r:!0,t:function(b,a,c){b=parseFloat(b);a[c]=100*b/(a.range[1]-a.range[0]);return k(b)}},direction:{r:!0,t:function(b,a,c){switch(b){case "ltr":a[c]=0;break;case "rtl":a[c]=1;break;default:return!1}return!0}},serialization:{r:!0,t:function(b,a,c){function d(a){return s(a)||"string"===typeof a||"function"===typeof a||!1===a||s(a[0])&&"function"===typeof a[0][a[1]]}function e(a){var b=[[],[]];d(a)?b[0].push(a):f.each(a,
function(a,c){1<a||(d(c)?b[a].push(c):b[a]=b[a].concat(c))});return b}if(b.to){var m,k;b.to=e(b.to,0);a.direction&&b.to[1].length&&b.to.reverse();for(m=0;m<a.handles;m++)for(k=0;k<b.to[m].length;k++){if(!d(b.to[m][k]))return!1;b.to[m][k]||b.to[m].splice(k,1)}a[c].to=b.to}else a[c].to=[[],[]];if(b.resolution)switch(b.resolution){case 1:case 0.1:case 0.01:case 0.001:case 1E-4:case 1E-5:break;default:return!1}else a[c].resolution=0.01;if(!b.mark)a[c].mark=".";else if("."!==b.mark&&","!==b.mark)return!1;
return!0}},slide:{t:function(a){return"function"===typeof a}},set:{t:function(a,c){return d.slide.t(a,c)}},block:{t:function(a,c){return d.slide.t(a,c)}},step:{t:function(a,c,d){a=parseFloat(a);c[d]=a;return k(a)}}};f.each(d,function(b,d){var e=a[b],f=e||0===e;if(d.r&&!f||f&&!d.t(e,a,b))throw console&&console.log&&console.group&&(console.group("Invalid noUiSlider initialisation:"),console.log("Option:\t",b),console.log("Value:\t",e),console.log("Slider(s):\t",c),console.groupEnd()),new RangeError("noUiSlider");
})}function D(a,c){a=a.toFixed(c.decimals);return a.replace(".",c.serialization.mark)}function E(a,c,d){if(c)return!1;var b=a.data("target");b.hasClass(e[14])||(d||(b.addClass(e[15]),setTimeout(function(){b.removeClass(e[15])},600)),b.addClass(e[14]),n(a.data("options").block,b));return!1}function u(a,c,d){var b=a.data("options"),h=a.data("base"),f=h.data("handles"),g,t=a[0].gPct();c=0>c?0:100<c?100:c;if(!k(c)||c===t)return!1;b.step&&(g=100*b.step/(b.range[1]-b.range[0]),c=Math.round(c/g)*g);if(c===
t)return!1;1<f.length&&(a[0]===f[1][0]?(g=f[0][0].gPct()+b.margin,c=c<g?g:c):(g=f[1][0].gPct()-b.margin,c=c>g?g:c));c=0>c?0:100<c?100:c;if(c===t)return E(h,d,!b.margin);h.data("target").removeClass(e[14]);a.css(a.data("style"),c+"%");a[0]===f[0][0]&&a.children("."+e[2]).toggleClass(e[13],50<c);b.direction&&(c=100-c);a.data("store").val(D(c*(b.range[1]-b.range[0])/100+b.range[0],b));return!0}function F(a,c,d){if(s(c)){var b=[];a.data("options").direction&&(d=d?0:1);c.each(function(){p("change",f(this),
B,{target:a.data("target"),handle:a,which:d},!0);b.push([f(this),"val"])});return b}"string"===typeof c&&(c=[f('<input type="hidden" name="'+c+'">').appendTo(a).addClass(e[3]).change(function(a){a.stopPropagation()}),"val"]);return[c]}function G(a,c,d){var b=[];f.each(d.to[c],function(e){b=b.concat(F(a,d.to[c][e],c))});return{element:a,elements:b,target:a.data("target"),val:A}}function H(a){var c=this.base,d;"left"===this.handle.data("style")?(a=a.pointX-this.startEvent.pointX,d=c.width()):(a=a.pointY-
this.startEvent.pointY,d=c.height());a=this.position+100*a/d;u(this.handle,a)&&n(c.data("options").slide,c.data("target"))}function I(a){this.handle.children("."+e[2]).removeClass(e[4]);a.cursor&&v.css("cursor","").off(q);w.off(q);this.target.removeClass(e[14]).change();n(this.handle.data("options").set,this.target)}function J(a){this.handle.children("."+e[2]).addClass(e[4]);a.stopPropagation();p(r.move,w,H,{startEvent:a,position:this.handle[0].gPct(),base:this.base,target:this.target,handle:this.handle});
p(r.end,w,I,{base:this.base,target:this.target,handle:this.handle});a.cursor&&(v.css("cursor","default"),v.on("selectstart"+q,function(){return!1}))}function K(a){if(!this.base.find("."+e[4]).length){var c,d,b=this.base;d=b.data("handles");var f=d[0].data("style");a=a["left"===f?"pointX":"pointY"];var l="left"===f?b.width():b.height(),g=[],k=b.offset();for(c=0;c<d.length;c++)g.push(d[c].offset());c=1===d.length?0:(g[0][f]+g[1][f])/2;d=1===d.length||a<c?d[0]:d[1];b.addClass(e[5]);setTimeout(function(){b.removeClass(e[5])},
300);u(d,100*(a-k[f])/l);n([d.data("options").slide,d.data("options").set],b.data("target"));b.data("target").change()}}function L(){var a=f(this).data("base"),c=[];f.each(a.data("handles"),function(){c.push(f(this).data("store").val())});return 1===c.length?c[0]:a.data("options").direction?c.reverse():c}function M(a,c){f.isArray(a)||(a=[a]);return this.each(function(){var d=Array.prototype.slice.call(f(this).data("base").data("handles"),0),b=d[0].data("options"),e,l;1<d.length&&(d[2]=d[0]);b.direction&&
a.reverse();for(l=0;l<d.length;l++)if(e=a[l%2],null!==e&&void 0!==e){"string"===f.type(e)&&(e=e.replace(",","."));var g=b.range;e=parseFloat(e);e=100*(0>g[0]?e+Math.abs(g[0]):e-g[0])/(g[1]-g[0]);b.direction&&(e=100-e);u(d[l],e,!0)||d[l].data("store").val(!0);!0===c&&n(b.set,f(this))}})}var w=f(document),v=f("body"),q=".nui",N=f.fn.val,e="noUi-base noUi-origin noUi-handle noUi-input noUi-active noUi-state-tap noUi-target -lower -upper noUi-connect noUi-vertical noUi-horizontal noUi-background noUi-z-index noUi-block noUi-state-blocked noUi-rtl".split(" "),
r=window.navigator.pointerEnabled?{start:"pointerdown",move:"pointermove",end:"pointerup"}:window.navigator.msPointerEnabled?{start:"MSPointerDown",move:"MSPointerMove",end:"MSPointerUp"}:{start:"mousedown touchstart",move:"mousemove touchmove",end:"mouseup touchend"};f.fn.val=function(){return this.hasClass(e[6])?arguments.length?M.apply(this,arguments):L.apply(this):N.apply(this,arguments)};return function(a){a=f.extend({handles:2,margin:0,direction:"ltr",orientation:"horizontal"},a)||{};a.serialization=
a.serialization||{};C(a,this);return this.each(function(){var c=f(this).addClass(e[6]),d,b,h=f("<div/>").appendTo(c);d=a.direction;b=[e[0]];var l=[[e[1],e[1]+e[d?8:7]],[e[1],e[1]+e[d?7:8]]],g=[[e[2],e[2]+e[d?8:7]],[e[2],e[2]+e[d?7:8]]];a.connect?(d&&("lower"===a.connect?a.connect="upper":"upper"===a.connect&&(a.connect="lower")),"lower"===a.connect?(b.push(e[9],e[9]+e[7]),l[0].push(e[12])):(b.push(e[9]+e[8],e[12]),l[0].push(e[9]))):b.push(e[12]);var k=a,m=a.serialization.resolution,m=m.toString().split(".");
k.decimals="1"===m[0]?0:m[1].length;"vertical"===a.orientation?b.push(e[10]):b.push(e[11]);h.addClass(b.join(" ")).data({target:c,options:a,handles:[]});c.data("base",h);d&&c.addClass(e[16]);for(d=0;d<a.handles;d++)b=f("<div><div/></div>").appendTo(h),b.addClass(l[d].join(" ")),b.children().addClass(g[d].join(" ")),p(r.start,b.children(),J,{base:h,target:c,handle:b}),b.data({base:h,target:c,options:a,style:"vertical"===a.orientation?"top":"left"}),b.data({store:G(b,d,a.serialization)}),b[0].gPct=
z,h.data("handles").push(b);c.val(a.start);p(r.start,h,K,{base:h,target:c})})}.call(this,x)}})(window.jQuery||window.Zepto);






/*  ====================   PAGEMAKER FUNCTION for all the pagemaker javascript parts   ====================*/
;(function ($) {
	"use strict";

	$.pagemaker = function(el) {

		// set all the pagemaker default values		
		this.$el 				= $(el);
		this.toggler 			= this.$el.find('.cromatic_adder');
		this.tabcontent 		= this.$el.find('.cromaticholder').html();
		this.overlaycontent 	= '<div class="cro_pagemakeroverlay"></div>';
		this.bodybase 			= this.$el.parents('body');
		this._init();
	};


	$.pagemaker.prototype = {
		

		// the initialize function
		_init : function() {
			this._delegater();
		},

		// the delegater to manage all the clicks.
		_delegater : function() {
			var self = this;
			this.$el.on( 'click', 'div,li, input', function() {
				if ($(this).hasClass('cro_toggle_me')){ self._toggleparts();}
			});			
		},
		
		// the toggler for all the toggleswitches
		_toggleparts : function() {
			this.toggler.slideToggle('fast');
		}
	}


	// make this a jquery plugin
	$.fn.pagemaker = function() {
		new $.pagemaker($(this));
	};



})( jQuery, window );






/*  ====================   INDIVIDUAL JAVASCRIPT PARTS   ====================*/

jQuery(document).ready(function(){



	"use strict";
	if (jQuery('.cromatic_wrapper').length != 0) {
		jQuery('.cromatic_wrapper').pagemaker();
	}



	// JAVASCRIPT FOR THE ONN OFF BLOCK AND BUTTON
	jQuery('.cro_yesnohandler').click(function() {
		var varc = (jQuery(this).hasClass('cro_nonohandler'))? 1 : 0;
		jQuery(this).parents('.cro_yesnoouter').find('input').val(varc);
		jQuery(this).toggleClass('cro_nonohandler');
	});



	
	function setfont(el) {


		var fontvalues 			= el.split('|'),
			fontstartstring 	= "<link href='http://fonts.googleapis.com/css?family=",
			familyreplaced		= fontvalues[0].replace(" ", "+"),
			fontitalics			= (fontvalues[1].search('italics') >= 0)?  'italic' : '',
			fontweight			= fontvalues[1].replace('italics',''),
			finalstring			= fontstartstring +  familyreplaced + ':' + fontweight + "&subset=" + fontvalues[2] + "' rel='stylesheet' type='text/css'>",
			stringspace			= jQuery('.cro_linkholder'),
			csschanges 			= { 'font-family' 	: "'" + fontvalues[0] + "'",
									'font-weight'	: fontweight,
									'font-style'	: fontitalics,
								  };


			stringspace.html(finalstring);
			jQuery('.cro_fontshowcase').css(csschanges);

	}



	jQuery('.cro_formmainselect').change(function() {
		var $this = jQuery(this),
			activenodes 	= $this.find('option:selected'),
			variantnodes 	= activenodes.data('cro-variant').toString().split('|'),
			subsetnodes 	= activenodes.data('cro-subset').split('|'),
			insertnode 		= '',
			insertvar 		= '',
			nodevalue		= '',
			secondselect 	= $this.parent('.cro_fontselectmain').find('.cro_formsecondselect'),
			thirdselect 	= $this.parent('.cro_fontselectmain').find('.cro_formthirdselect'),
			fontimput 		= $this.parent('.cro_fontselectmain').find('.cro_formfontinput');


		variantnodes.forEach(function(e) {
    		insertnode += '<option value="' +  e  + '">' + e + '</option>';
		});

		fontimput.val($this.val() +  '|'  +  variantnodes[0] +  '|'  +  subsetnodes[0]);

		subsetnodes.forEach(function(e) {
    		insertvar += '<option value="' +  e  + '">' + e + '</option>';
		});

		secondselect.find('option').remove();
		secondselect.append(insertnode);

		thirdselect.find('option').remove();
		thirdselect.append(insertvar);

		setfont($this.val() +  '|'  +  variantnodes[0] +  '|'  +  subsetnodes[0]);

	});


	jQuery('.cro_formsecondselect').change(function() {

		var $this 			= jQuery(this),
			formselect 		= $this.parent('.cro_fontselectmain').find('.cro_formmainselect'),
			thirdselect 	= $this.parent('.cro_fontselectmain').find('.cro_formthirdselect'),
			fontimput 		= $this.parent('.cro_fontselectmain').find('.cro_formfontinput');

		fontimput.val(formselect.val() +  '|'  +  $this.val() +  '|'  +  thirdselect.val());
		setfont(formselect.val() +  '|'  +  $this.val() +  '|'  +  thirdselect.val());

	});

	jQuery('.cro_formthirdselect').change(function() {

		var $this 			= jQuery(this),
			formselect 		= $this.parent('.cro_fontselectmain').find('.cro_formmainselect'),
			secondselect 	= $this.parent('.cro_fontselectmain').find('.cro_formsecondselect'),
			fontimput 		= $this.parent('.cro_fontselectmain').find('.cro_formfontinput');

		fontimput.val(formselect.val() +  '|'  +  secondselect.val() +  '|'  + $this.val());
		setfont(formselect.val() +  '|'  +  secondselect.val() +  '|'  + $this.val());

	});




	// JAVASCRIPT FOR THE PICKER FUNCTION
	jQuery('.cro_pickme').each(function() {
		var identifier = jQuery(this).attr('rel');
		jQuery(identifier).wpColorPicker();
	});



	// MANAGE CLEAR THE IMAGE INPUT ON CLICK
	jQuery('.cro_clearimginput').click(function() {
		jQuery(this).parents('.cro_mn_contentadd').find('input').val('');
	});



	// MANAGE THE SUBMIT FORM
	jQuery('.cro_mn_targeter').click(function() {
		var action = jQuery(this).data('cro-submitaction');
		var target = jQuery(this).parents('form').find('input[data-formtarget]');
		jQuery(target).attr('value',action);
	});




	// GET HTE NOUI SLIDER GOING
	jQuery('.noUiSlider').each(function() {
		// SET ALL THE DEFAULTS
		var relstring 	= jQuery(this).attr('rel'),
			theClass 	= '.' + relstring,
			theId 		= '.i-' + relstring,
			theRange 	= jQuery(theClass).data('min'),
			theRangeT 	= jQuery(theClass).data('max'),
			theStart 	= jQuery(theClass).data('val'),
			theStep 	= jQuery(theClass).data('step');
			

		// START THE SLIDER
		jQuery(theClass).noUiSlider({
			range: [theRange, theRangeT]
			,start: theStart
			,step: theStep
			,handles: 1
			,serialization: {
			to: jQuery(theId)
			,resolution: 1
			}
		});
	});





	// ======================================  INSERT MEDIA ===========================
	var _cro_custom_media 		= true,
      	_orig_send_attachment 	= wp.media.editor.send.attachment;


     // open the media manager on click
	jQuery(document.body).on('click.tgmOpenMediaManager', '.cro_imgmng', function(){

	
		// set the variables
		var el 					= jQuery(this),
			insertinto 			= el.attr('rel'),
			send_attachment_bkp = wp.media.editor.send.attachment,
			_cro_custom_media 	= true;


		// send the needed info to the media editor
		wp.media.editor.send.attachment = function(props, attachment){
      		if (_cro_custom_media) {
        		el.val(attachment.url);
      		} else {
        		return _orig_send_attachment.apply( el, [props, attachment] );
      		}
    	}

    	// open the media editor
    	wp.media.editor.open(el);
    	return false;

	});



	// reset the media button
	jQuery('.add_media').on('click', function(){
    	_custom_media = false;
  	});




	// ======================================  SORT PAGEBUILDER ===========================
	jQuery('.cromatic_mainpagelist').sortable({

		// set the variables
		items: '.cro_page_mainpart',
		opacity: 0.6,
		axis: 'y',
		update: function() {


			// the update function to update the order
			var sdep 	= '';
			var adep 	= new Array();

			jQuery('.cro_page_mainpart').each(function(i) {adep[i] = jQuery(this).attr('rel');});

			sdep 		= adep.join('/');
			var data 	= 'action=cromatic_update_fp_order&idees=' + sdep + '&nonce=' + cromatic_admin_script.nonce;

			jQuery.post(ajaxurl, data, function(response) { });
		}
	});


	// ======================================  THEME OPTIONS TABS ===========================
	jQuery('.cro_page_li').click(function() {
		var relscore = jQuery(this).attr('rel');
		jQuery('.cro_page_li_active').removeClass('cro_page_li_active');
		jQuery(this).addClass('cro_page_li_active');
		jQuery('.cro_page_option_active').removeClass('cro_page_option_active');
		jQuery(relscore).addClass('cro_page_option_active');
	});

});