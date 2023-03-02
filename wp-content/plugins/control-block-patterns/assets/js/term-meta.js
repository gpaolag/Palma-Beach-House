( function( $, document, i18n ) {
	"use strict";

	function clearInputs() {
		// TinyMCE.
		if ( typeof tinyMCE !== 'undefined' ) {
			tinyMCE.activeEditor.setContent( '' );
		}

		$( '.ctrlbp-meta-box :input:visible' ).val( '' );

		// Range.
		$( '.ctrlbp-range + .ctrlbp-output' ).text( '' );

		// Media field.
		$( '.ctrlbp-image_advanced' ).trigger( 'media:reset' );

		// File upload.
		$( '.ctrlbp-media-list' ).html( '' );

		// Color picker field.
		$( '.ctrlbp-color' ).val( '' );
		$( '.ctrlbp-input .wp-color-result' ).css( 'background-color', '' );

		// Checkbox and radio.
		$( '.ctrlbp-meta-box :input:checkbox, .ctrlbp-meta-box :input:radio' ).prop( 'checked', false );

		// Image select.
		$( '.ctrlbp-image-select' ).removeClass( 'ctrlbp-active' );

		// Clone field.
		$( '.ctrlbp-clone:not(:first-of-type)' ).remove();
	}

	function showSuccessMessage() {
		$( '#addtag p.submit' ).before( '<div id="ctrlbp-term-meta-message" class="notice notice-success"><p><strong>' + i18n.addedMessage + '</strong></p></div>' );

		setTimeout( function () {
			$( '#ctrlpb-term-meta-message' ).fadeOut();
		}, 2000 );
	}

	function makeEditorsSave() {
		if ( typeof tinyMCE === 'undefined' ) {
			return;
		}
		var editors = tinyMCE.editors;

		for ( var i in editors ) {
			editors[i].on( 'change', editors[i].save );
		}
	}

	$( document ).on( 'ajaxSuccess', function( e, request, settings ) {
		if ( settings.data.indexOf( 'action=add-tag' ) < 0 ) {
			return;
		}

		clearInputs();
		showSuccessMessage();
	} );

	$( function() {
		setTimeout( makeEditorsSave, 500 );
	} );
} )( jQuery, document, CTRLBPTermMeta );
