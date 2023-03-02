( function ( $, ctrlbp ) {
	'use strict';

	function setActiveClass() {
		var $this = $( this ),
			type = $this.attr( 'type' ),
			selected = $this.is( ':checked' ),
			$parent = $this.parent(),
			$others = $parent.siblings();
		if ( selected ) {
			$parent.addClass( 'ctrlbp-active' );
			if ( type === 'radio' ) {
				$others.removeClass( 'ctrlbp-active' );
			}
		} else {
			$parent.removeClass( 'ctrlbp-active' );
		}
	}

	function init( e ) {
		$( e.target ).find( '.ctrlbp-image-select input' ).trigger( 'change' );
	}

	ctrlbp.$document
		.on( 'ctrlbp_ready', init )
		.on( 'change', '.ctrlbp-image-select input', setActiveClass );
} )( jQuery, ctrlbp );
