( function ( $, ctrlbp ) {
	'use strict';

	function toggleAddInput( e ) {
		e.preventDefault();
		this.nextElementSibling.classList.toggle( 'ctrlbp-hidden' );
	}

	ctrlbp.$document.on( 'click', '.ctrlbp-taxonomy-add-button', toggleAddInput );
} )( jQuery, ctrlbp );
