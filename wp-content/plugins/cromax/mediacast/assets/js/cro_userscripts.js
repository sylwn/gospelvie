/*!
* User scripts file to add javascript funcitonality to the user page.
* 
* Copyright (c) 2012-2014 Croma
* Version: 1.0
* 
* cro.ma
* Requires: jQuery v1.7.1 or later
*/



jQuery(document).ready(function(){

	"use strict";


	var _croma_custom_media 	= true,
		_croma_orig_send 		= wp.media.editor.send.attachment;

  jQuery('.cro_user_large_button').click(function(e) {
    
    var send_attachment_bkp 	= wp.media.editor.send.attachment,
    	button 					= jQuery(this),
    	cro_parr				= button.parent('.cro_buttonparent'),
    	cro_inp 				= cro_parr.find('input'),
    	cro_imgshow				= cro_parr.find('.cro_imgholder'),
    	cro_imgclear			= cro_parr.find('.cro_user_clear_button').show();

    _croma_custom_media = true;

    wp.media.editor.send.attachment = function(props, attachment){
      
      if ( _croma_custom_media) {
      	console.log(attachment);
        cro_inp.val(attachment.id);
        cro_imgshow.html('<img src="' + attachment.sizes.thumbnail.url + '"/>');
      } else {
        return _orig_send_attachment.apply( this, [props, attachment] );
      };

    }

    wp.media.editor.open(button);
    return false;
  });

  jQuery('.cro_imgholder').each(function() {
  		var ths = jQuery(this),
  			cnt = ths.html(),
  			par = ths.parent('.cro_buttonparent'),
  			btn = par.find('.cro_user_clear_button');

  		if (cnt) {
  			btn.show();
  		}
  });

  jQuery('.cro_user_clear_button').click(function() {
  		var ths = jQuery(this),
  			par = ths.parent('.cro_buttonparent'),
  			inp = par.find('input'),
  			ime = par.find('.cro_imgholder');

  		ime.html('');
  		inp.val('');
  		ths.hide();

  });

  jQuery('.add_media').on('click', function(){
    _croma_custom_media = false;
  });

	

});			
	