( function ( $, ctrlbp ) {
	'use strict';

	/**
	 * Update text value.
	 */
	function update() {
		var $this = $( this ),
			$output = $this.siblings( '.ctrlbp-range-output' );

		$this.on( 'input propertychange change', function () {
			$output.html( $this.val() );
		} );
	}

	function init( e ) {
		$( e.target ).find( '.ctrlbp-range' ).each( update );
	}

	ctrlbp.$document
		.on( 'ctrlbp_ready', init )
		.on( 'clone', '.ctrlbp-range', update );
} )( jQuery, ctrlbp );
