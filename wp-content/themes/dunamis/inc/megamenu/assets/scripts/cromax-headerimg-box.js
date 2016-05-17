
/*  ====================   INDIVIDUAL JAVASCRIPT PARTS   ====================*/

jQuery(document).ready(function(){



	"use strict";

	jQuery(".cro_clickexpand").click(function() {
		jQuery(".custheaderwrap").slideToggle('slow');
	})


	// JAVASCRIPT FOR THE PICKER FUNCTION
	jQuery('.cro_header_pickme').each(function() {
		jQuery(this).wpColorPicker();
	});


	jQuery('.cro_clearimginput').click(function() {
		jQuery('.cro_showheadimg').html('');
		jQuery('.cro_headimg_src').val('');
	});

	// GET HTE NOUI SLIDER GOING
	jQuery('.header-noUiSlider').each(function() {
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
	var cro_custom_headimg 		= true,
      	_orig_send_attachment 	= wp.media.editor.send.attachment;


     // open the media manager on click
	jQuery(document.body).on('click.tgmOpenHeaderbase', '.cro_showheadimg', function(){

	
		// set the variables
		var el 					= jQuery(this),
			insertinto 			= el,
			send_attachment_bkp = wp.media.editor.send.attachment;


		cro_custom_headimg 	= true;


		// send the needed info to the media editor
		wp.media.editor.send.attachment = function(props, attachment){
      		if (cro_custom_headimg) {
      			var img = new Image();
      			jQuery( img ).attr( 'src', attachment.sizes.thumbnail.url ).prependTo( insertinto ).fadeIn();	
        		jQuery('.cro_headimg_src').val(attachment.id);
      		} else {
        		return _orig_send_attachment.apply( el, [props, attachment] );
      		}
    	}

    	// open the media editor
    	wp.media.editor.open(el);
    	return false;

	});

});