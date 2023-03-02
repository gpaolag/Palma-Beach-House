jQuery(document).ready(function($) {
    jQuery('#ctrlbp-import').on('click', function(){
        
        var import_data = jQuery(this).closest('.ctrlbp-input').find('textarea').val();
        var page_url = jQuery('[name="_wp_http_referer"]').val()
        var file = jQuery(this).closest('.ctrlbp-input').find('input').val();

        var data = {
            'action': 'import_settings_data',
            'import_data': import_data ,
            'nonce': jQuery(this).closest('.ctrlbp-input').find('textarea').data('nonce'),
            'option_name': jQuery(this).closest('[data-object-type="setting"]').data('object-id'),
            'file' : file
        };
        // We can also pass the url value separately from ajaxurl for front end AJAX implementations
        jQuery.post(ajax_object.ajax_url, data, function(response) {
            alert(response);
            window.location.href = page_url;
        });
        return false;
    });

    
});

window.addEventListener('load', function() {
    var upload = document.getElementById('fileInput');
    
    // Make sure the DOM element exists
    if (upload) 
    {
      upload.addEventListener('change', function() {
        // Make sure a file was selected
        if (upload.files.length > 0) 
        {
          var reader = new FileReader(); // File reader to read the file 
          
          // This event listener will happen when the reader has read the file
          reader.addEventListener('load', function() {
            //var result = JSON.parse(reader.result); // Parse the result into an object 
            document.getElementById('textareImportInput').value = reader.result;
           
          });
          
          reader.readAsText(upload.files[0]); // Read the uploaded file
        }
      });
    }
  });