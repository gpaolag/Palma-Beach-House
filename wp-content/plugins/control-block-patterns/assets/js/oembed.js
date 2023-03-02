( function ( $, _, ctrlbp ) {
	'use strict';

	/**
	 * Show preview of oembeded media.
	 */
	function showPreview( e ) {
		e.preventDefault();

		var $this = $( this ),
			$spinner = $this.siblings( '.spinner' ),
			data = {
				action: 'ctrlbp_get_embed',
				url: this.value,
				not_available: $this.data( 'not-available' ),
			};

		$spinner.css( 'visibility', 'visible' );
		$.post( ajaxurl, data, function ( response ) {
			$spinner.css( 'visibility', 'hidden' );
			$this.siblings( '.ctrlbp-embed-media' ).html( response.data );
		}, 'json' );
	}

	/**
	 * Remove oembed preview when cloning.
	 */
	function removePreview() {
		$( this ).siblings( '.ctrlbp-embed-media' ).html( '' );
	}

	ctrlbp.$document
		.on( 'change', '.ctrlbp-oembed', _.debounce( showPreview, 250 ) )
	    .on( 'clone', '.ctrlbp-oembed', removePreview );
} )( jQuery, _, ctrlbp );
