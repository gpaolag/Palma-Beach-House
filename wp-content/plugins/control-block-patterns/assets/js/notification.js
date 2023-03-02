( function( $, i18n ) {
	'use strict';

	function dismissNotification() {
		$( '#control-block-patterns-notification' ).on( 'click', '.notice-dismiss', function( event ) {
			event.preventDefault();

			$.post( ajaxurl, {
				action: 'ctrlbp_dismiss_notification',
				nonce: i18n.nonce
			} );
		} );
	}

	$( dismissNotification );
} )( jQuery, CTRLBPNotification );
