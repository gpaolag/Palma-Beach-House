( function ( $, ctrlbp ) {
	'use strict';

	/**
	 * Transform an input into a color picker.
	 */
	function transform() {
		var $this = $( this );

		function triggerChange() {
			$this.trigger( 'color:change' ).trigger( 'ctrlbp_change' );
		}

		var $container = $this.closest( '.wp-picker-container' ),
			// Hack: the picker needs a small delay (learn from the Kirki plugin).
			options = $.extend(
				{
					change: function () {
						setTimeout( triggerChange, 20 );
					},
					clear: function () {
						setTimeout( triggerChange, 20 );
					}
				},
				$this.data( 'options' )
			);

		// Clone doesn't have input for color picker, we have to add the input and remove the color picker container
		if ( $container.length > 0 ) {
			$this.insertBefore( $container );
			$container.remove();
		}

		// Show color picker.
		$this.wpColorPicker( options );
	}

	function init( e ) {
		$( e.target ).find( '.ctrlbp-color' ).each( transform );
	}

	ctrlbp.$document
		.on( 'ctrlbp_ready', init )
		.on( 'clone', '.ctrlbp-color', transform );
} )( jQuery, ctrlbp );
