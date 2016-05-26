jQuery(document).ready(function($) {
    // $('.hover_style option:nth-child(2)').attr('selected', true);
    $('.colorpicker').wpColorPicker();

    // Show Hide Styles
  jQuery('.caption-border').hide();
   var Border = jQuery('.show_on').val();
    if (Border == 'square') {
      jQuery('.caption-border').show();
    }
    jQuery('.show_on').change(function() {
      var thisVal = jQuery(this).val();
      if (thisVal == 'square') {
        jQuery('.caption-border').show();
        $( "#wcpinner" ).accordion('refresh');
      } else {
        jQuery('.caption-border').hide();
        $( "#wcpinner" ).accordion('refresh');
      }
    });

    jQuery('table').each(function(index, el) {
           var show_on_value_load =  jQuery(this).find('.show_on').val();
           if (show_on_value_load == 'circle') {
            jQuery(this).find('.hover_style option[value=effect1], .hover_style option[value=effect8]').hide();
           } else {
            jQuery(this).find('.hover_style option[value=effect1], .hover_style option[value=effect8]').show();
           }
    });

   jQuery('select').change(function(event) {
        var this_parent = jQuery(this).closest('table');
       var show_on_value =  this_parent.find('.show_on').val();
       if (show_on_value == 'circle') {
        this_parent.find('.hover_style option[value=effect1], .hover_style option[value=effect8]').hide();
       } else {
        this_parent.find('.hover_style option[value=effect1], .hover_style option[value=effect8]').show();
       }
   });
    var active = false,
        sorting = false;
    // accordion
    $( "#wcpinner" )
    .accordion({
        header: "> div > h3",
        collapsible: true,
        activate: function( event, ui){
            //this fixes any problems with sorting if panel was open (remove to see what I am talking about)
            if(sorting)
                $(this).sortable("refresh");   
        }
    })
    // drag and drop function
    .sortable({
        handle: "h3",
        placeholder: "ui-state-highlight",
        start: function( event, ui ){
            //change bool to true
            sorting=true;
            
            //find what tab is open, false if none
            active = $(this).accordion( "option", "active" ); 
            
            //possibly change animation here
            $(this).accordion( "option", "animate", { easing: 'swing', duration: 0 } );
            
            //close tab
            $(this).accordion({ active:false });
        },
        stop: function( event, ui ) {
            ui.item.children( "h3" ).triggerHandler( "focusout" );
            
            //possibly change animation here; { } is default value
            $(this).accordion( "option", "animate", { } );
            
            //open previously active panel
            $(this).accordion( "option", "active", active );
            
            //change bool to false
            sorting=false;
        }
    });

    var count = $('.na-main-wrap .group:last-child').attr('id');
    $('.na-main-wrap .group').each(function(index, el) {
    	if (parseInt($(this).attr('id')) > parseInt(count)) {
    		count = $(this).attr('id');
    	};
    });
	        $(".add").click(function() {
		        count = parseInt(count) + 1;
		        var clone_this = $('.na-main-wrap div#1').clone(true);
		        $(clone_this).attr('id', count);
		        $(clone_this).find('input, select, textarea').each(function(index, el) {
		         var old_name = $(this).attr('name');
		         var new_name = old_name.replace(/[0-9]/g, count);
		         $(this).attr('name', new_name);
		        });
		        $(clone_this).appendTo('.na-main-wrap');
		    });
	        $(".na-main-wrap").on('click', '.button-delete', function() {
	        	event.preventDefault();
	        	var this_col = $(this).closest('.group').attr('id');
	        	if (this_col == '1' || this_col == 1) {
	        		alert('Sorry, you cannot delete first column')
	        	} else {
	        		$(this).closest('.group').remove();
	        	}
	        });
            $('.preview').click(function() {
                
            });

	var image_caption_hover_plugin;
     
    jQuery('.upload_image_button').live('click', function( event ){
     
        event.preventDefault();

        var this_widget = jQuery(this).closest('table');
     
     
        // Create the media frame.
        image_caption_hover_plugin = wp.media.frames.image_caption_hover_plugin = wp.media({
          title: jQuery( this ).data( 'title' ),
          button: {
            text: jQuery( this ).data( 'btntext' ),
          },
          multiple: false  // Set to true to allow multiple files to be selected
        });
     
        // When an image is selected, run a callback.
        image_caption_hover_plugin.on( 'select', function() {
          // We set multiple to false so only get one image from the uploader
          attachment = image_caption_hover_plugin.state().get('selection').first().toJSON();
          	jQuery(this_widget).find('.imageurl').val(attachment.url);
        });
     
        // Finally, open the modal
        image_caption_hover_plugin.open();
    });
});