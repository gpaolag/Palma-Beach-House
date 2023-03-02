( function ( document, $, i18n ) {
	'use strict';

	var $tabs, 
	$boxes, 
	page_url = $('[name="_wp_http_referer"]').val(),
	resetButton = '.ctrlbp-reset-settings';

	function toggleMetaBox() {
		$( '.if-js-closed' ).removeClass( 'if-js-closed' ).addClass( 'closed' );
		postboxes.add_postbox_toggles( i18n.pageHook );
	}

	function switchTab() {
		$boxes.each( function () {
			var $this = $( this );
			this.dataset.tab = '#tab-' + $this.find( '.ctrlbp-settings-tab' ).data( 'tab' );
		} );
		$( '.nav-tab-wrapper' ).on( 'click', 'a', ( e ) => showTab( e.target.getAttribute( 'href' ) ) );
	}

	function detectActiveTab() {
		$tabs.first().trigger( 'click' );
		showTab( location.hash );
	}

	function showValidateErrorFields() {
		var inputSelectors = 'input[class*="ctrlbp-error"], textarea[class*="ctrlbp-error"], select[class*="ctrlbp-error"], button[class*="ctrlbp-error"]';
		$( document ).on( 'after_validate', 'form', ( e ) => showTab( $( e.target ).find( inputSelectors ).closest( '.postbox' ).data( 'tab' ) ) );
	}

	function showTab( tab ) {
		if ( ! tab ) {
			return;
		}
		$tabs.removeClass( 'nav-tab-active' ).filter( '[href="' + tab + '"]' ).addClass( 'nav-tab-active' );
		$boxes.hide().filter( ( index, element ) => element.dataset.tab === tab ).show();
	}

	function resetSettings(){
		$(resetButton).prop('disabled', true).addClass('updating-message');
		$.ajax({
			url: 	CTRLBPSettingsPage.ajax_url,
			type: 	'POST',
			data: {
			  action: 		'ctrlbp_reset_settings_page',			
			  option_name: 	CTRLBPSettingsPage.option_name,		
			  nonce: 		CTRLBPSettingsPage.nonce
			}
		  }).done(function(response) {	
						  
				if( response ){
					$(this).prop('disabled', false).removeClass('updating-message');
					alert(response);
					window.location.href = page_url;
				}
				
		  });
	}

	$( function() {
		$boxes = $( '.wrap .postbox' );
		$tabs = $( '.nav-tab' );

		toggleMetaBox();
		switchTab();
		detectActiveTab();
		showValidateErrorFields();
	} );


	$('#ctrlbp-import').prop("disabled",true);
	$('#textareImportInput').on('change', function(){
		$('#ctrlbp-import').prop("disabled",false);
	})
	$('#ctrlbp-import').on('click', function(){
        
		var button = $(this);
		button.addClass('updating-message').css({"pointer-event":'none'});
        var import_data = $(this).closest('.ctrlbp-input').find('textarea').val();
        

        var data = {
            'action': 'import_settings_data',
            'import_data': import_data ,
            'nonce': $(this).closest('.ctrlbp-input').find('textarea').data('nonce'),
            'option_name': $(this).closest('[data-object-type="setting"]').data('object-id')
        };
        // We can also pass the url value separately from ajaxurl for front end AJAX implementations
        $.post(CTRLBPSettingsPage.ajax_url, data, function(response) {
			button.removeClass('updating-message');
            alert(response);
            window.location.href = page_url;
        });
        return false;
		
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
				$('#ctrlbp-import').prop("disabled",false);
			   
			  });
			  
			  reader.readAsText(upload.files[0]); // Read the uploaded file
			}
		  });
		}
	  });

	$(document).on('click', resetButton, function(){
		
		var r = confirm(CTRLBPSettingsPage.confirm_text);
		if (r == true) {
			resetSettings();
		}
		return false;
	});
	

} )( document, jQuery, CTRLBPSettingsPage );

