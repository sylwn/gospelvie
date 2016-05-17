
jQuery(document).ready(function(){

	"use strict";


	// JAVASCRIPT FOR THE ONN OFF BLOCK AND BUTTON
	jQuery('.cro_yesnohandler').click(function() {
		var varc = (jQuery(this).hasClass('cro_nonohandler'))? 1 : 0;
		jQuery(this).parents('.cro_yesnoouter').find('input').val(varc);
		jQuery(this).toggleClass('cro_nonohandler');
	});


	var _croma_custom_media 	= true,
		_croma_orig_send 		= wp.media.editor.send.attachment;



	jQuery('[data-cro-mediabut="yes"]').click(function(e) {
    
    	var send_attachment_bkp 	= wp.media.editor.send.attachment,
    		button 					= jQuery(this),
    		cro_parr				= button.parent('.cro_buttonparent'),
    		cro_inp 				= cro_parr.find('.cro_media_audioholder'),
    		cro_imgclear			= cro_parr.find('.cro_media_clear'),
    		cro_inputs 				= cro_parr.find('.cro_audio_hidden_input');

    	_croma_custom_media = true;

    	wp.media.editor.send.attachment = function(props, attachment){
      
      	if ( _croma_custom_media) {
      		console.log(attachment);
      		if (attachment.mime == 'audio/mpeg'){
      			cro_inp.html('<audio class="wp-audio-shortcode " id="audio-6-1" preload="none" style="width: 100%; visibility: hidden;" controls="controls"><source type="audio/mpeg" src="' + attachment.url + '" /></audio>');
      			jQuery(cro_inp.find('audio')).mediaelementplayer();
      			cro_inputs.val(attachment.url);
      			cro_imgclear.removeClass('cro_media_clear_hide');
      		} else {
      			alert('You need to add a valid mp3');
      		}
      	} else {
        	return _croma_orig_send.apply( this, [props, attachment] );
     	 };

    	}

    	wp.media.editor.open(button);

    	return false;

  	});

    
    jQuery('[data-cro-docbut="yes"]').click(function(e) {
    
      var send_attachment_bkp   = wp.media.editor.send.attachment,
        button          = jQuery(this),
        cro_parr        = button.parent('.cro_docparent'),
        cro_imgclear      = cro_parr.find('.cro_media_clear'),
        cro_inputs        = cro_parr.find('.cro_audio_hidden_input');

      _croma_custom_media = true;

      wp.media.editor.send.attachment = function(props, attachment){
      
        if ( _croma_custom_media) {
          console.log(attachment);
          cro_inputs.val(attachment.url);
          cro_imgclear.removeClass('cro_media_clear_hide');
          
        } else {
          return _croma_orig_send.apply( this, [props, attachment] );
       };

      }

      wp.media.editor.open(button);

      return false;

    });


  	jQuery('.add_media').on('click', function(){
    	_croma_custom_media = false;
 	 });

  jQuery('.cro_media_clear').on('click', function(){
      var $this = jQuery(this);
      $this.addClass('cro_media_clear_hide');
      $this.parents('.cro_clearparent').find('.cro_media_audioholder').html('');
      $this.parents('.cro_clearparent').find('input').val('');
   });
	
});


