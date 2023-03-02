( function ( $, ctrlbp ) {
	'use strict';

	var frame;

	function openSelectPopup( e ) {
		e.preventDefault();
		var $el = $( this );

		// Create a frame only if needed
		if ( ! frame ) {
			frame = wp.media( {
				className: 'media-frame ctrlbp-file-frame',
				multiple: false,
				title: $el.text()
			} );
		}

		// Open media uploader
		frame.open();

		// Remove all attached 'select' event
		frame.off( 'select' );

		// Handle selection
		frame.on( 'select', function () {
			var attachment = frame.state().get('selection').first().toJSON(), 
                url = attachment.url,
                mime = attachment.mime,
                regex = /^image\/(?:jpe?g|png|gif|x-icon)$/i;
				if ( mime.match(regex) ) {
					var template = wp.template( 'ctrlbp-image-input-preview' );
					$el.closest('div').find('.ctrlbp-media-list .ctrlbp-image-item').html(template( attachment ));
					$el.siblings( 'input' ).val( url ).trigger( 'change' ).siblings( 'a' ).removeClass( 'hidden' );
				}else{
					alert('Select valid image');
				}
		} );
	}

	function clearSelection( e ) {
		e.preventDefault();
		var r = confirm(ctrlbpImageInput.confirm_text);
		if (r == true) {
			$( this ).addClass( 'hidden' ).siblings( 'input' ).val( '' ).trigger( 'change' );
			$( this ).closest('div').find('.ctrlbp-media-list .ctrlbp-image-item').empty();
		}else{
			return false;
		}
		
	}

	function hideRemoveButtonWhenCloning() {
		$( this ).siblings( '.ctrlbp-image-input-remove' ).addClass( 'hidden' );
	}

	ctrlbp.$document
		.on( 'click', '.ctrlbp-image-input-select', openSelectPopup )
		.on( 'click', '.ctrlbp-image-input-remove', clearSelection )
		.on( 'clone', '.ctrlbp-image_input', hideRemoveButtonWhenCloning );
} )( jQuery,ctrlbp, wp );
