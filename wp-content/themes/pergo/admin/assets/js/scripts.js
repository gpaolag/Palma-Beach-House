;(function($) {
// JavaScript Document
jQuery(document).ready(function($) {
  "use strict";


  $('#pergo_settings_box').show();
  $('#pergo_onepage_sttings_boxes').insertAfter('#edit-slug-box').hide();
  $('#pergo_onepage_footer_sttings_boxes').hide();

  if($('#page_template').length > 0){
    
      $(document).on('change', '#page_template', function(){
        if( $(this).val() == 'templates/onepage-template.php'  ){
          $('#pergo_settings_box').hide();
          $('#pergo_onepage_sttings_boxes').show();
          $('#pergo_onepage_footer_sttings_boxes').show();
        }else{
          $('#pergo_settings_box').show();
          $('#pergo_onepage_sttings_boxes').hide();
          $('#pergo_onepage_footer_sttings_boxes').hide();
        }       
      })

      $('#page_template').trigger('change');

    }

    $(document).on( 'change', '.edit-menu-item-megamenustyle', function(){
        if( $(this).val() != '' ){
          $(this).closest('li').find('.megamenucolumn-wrap').show();
        }else{
          $(this).closest('li').find('.megamenucolumn-wrap').hide();
        }
    })

     

    $(document).on('click', '.pergo-upload-button', function(e) {
      var $button = $(this),
      $val = $(this).parents('.pergo-upload-container').find('input:text'),
      file;
      e.preventDefault();
      e.stopPropagation();
      // If the frame already exists, reopen it
      if (typeof(file) !== 'undefined') file.close();
      // Create WP media frame.
      file = wp.media.frames.perch_media_frame_2 = wp.media({
        // Title of media manager frame
        title: 'Pergo Upload image',
        button: {
          //Button text
          text: 'Insert image url'
        },
        // Do not allow multiple files, if you want multiple, set true
        multiple: false
      });
      //callback for selected image
      file.on('select', function() {
        var attachment = file.state().get('selection').first().toJSON();
        $val.val(attachment.url).trigger('change');
        $button.closest('.pergo-upload-container').find('img').attr('src', attachment.url);
      });
      // Open modal
      file.open();
    });

    $(window).on('load', function(){
      $('#page_template').trigger('change');
    })
    
  });  


})( jQuery, window, document );