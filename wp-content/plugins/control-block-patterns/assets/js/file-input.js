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
				title: ctrlbpFileInput.frameTitle
			} );
		}

		// Open media uploader
		frame.open();

		// Remove all attached 'select' event
		frame.off( 'select' );

		// Handle selection
		frame.on( 'select', function () {
			var url = frame.state().get( 'selection' ).first().toJSON().url;
			$el.siblings( 'input' ).val( url ).trigger( 'change' ).siblings( 'a' ).removeClass( 'hidden' );
		} );
	}

	function clearSelection( e ) {
		e.preventDefault();
		$( this ).addClass( 'hidden' ).siblings( 'input' ).val( '' ).trigger( 'change' );
	}

	function hideRemoveButtonWhenCloning() {
		$( this ).siblings( '.ctrlbp-file-input-remove' ).addClass( 'hidden' );
	}

	ctrlbp.$document
		.on( 'click', '.ctrlbp-file-input-select', openSelectPopup )
		.on( 'click', '.ctrlbp-file-input-remove', clearSelection )
		.on( 'clone', '.ctrlbp-file_input', hideRemoveButtonWhenCloning );
} )( jQuery, ctrlbp );
