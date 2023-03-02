( function ( $, document ) {
	'use strict';

	$( document ).ajaxSend( function ( event, xhr, settings ) {
		if ( ! Array.isArray( settings.data ) || -1 === settings.data.indexOf( 'wp_autosave' ) ) {
			return;
		}
		var inputSelectors = 'input[class*="ctrlbp"], textarea[class*="ctrlbp"], select[class*="ctrlbp"], button[class*="ctrlbp"], input[name^="nonce_"]';
		$( '.ctrlbp-control-block-patterns' ).each( function () {
			var $meta_box = $( this );
			if ( true === $meta_box.data( 'autosave' ) ) {
				settings.data += '&' + $meta_box.find( inputSelectors ).serialize();
			}
		} );
	} );
} )( jQuery, document );
