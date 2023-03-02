( function( $, api, ctrlbp ) {
	// Add nonce to list of inputs for validation.
	var inputSelectors = 'input[name*="nonce"], ' + ctrlbp.inputSelectors;

	$.extend( FormSerializer.patterns, {
		validate: /^[a-z][a-z0-9_-]*(?:\[(?:\d*|[a-z0-9_-]+)\])*$/i,
		key:      /[a-z0-9_-]+|(?=\[\])/gi,
		named:    /^[a-z0-9_-]+$/i
	} );

	// Transform { "cbp_0": "first", "cbp_1": "second" } to ["first", "second"] recursively.
	const transformObject = obj => {
		if ( typeof obj !== 'object' ) {
			return obj;
		}
		if ( Array.isArray( obj ) ) {
			return obj.map( transformObject );
		}

		// Make sure all keys are 'cbp_*'.
		const keys = Object.keys( obj );
		const match = keys.reduce( ( check, key ) => check && /^cbp_\d+$/.test( key ), true );
		if ( match ) {
			return Object.values( obj ).map( transformObject );
		}

		keys.forEach( key => obj[key] = transformObject( obj[key] ) );

		return obj;
	}

	api.controlConstructor[ 'meta_box' ] = api.Control.extend( {
		ready: function() {
			var setting = this.setting,
				$container = $( this.container );

			function setValue() {
				var data = $container.find( inputSelectors ).ctrlbpSerializeObject();
				data = transformObject( data );
				setting.set( JSON.stringify( data ) );
			}

			$container.on( 'change keyup input ctrlbp_change', inputSelectors, _.debounce( setValue, 200 ) );
			setValue();
			

			ctrlbp.$document.trigger( 'ctrlbp_init_editors' );
			
		}
	} );

	$(document).on('click', '#customize-footer-actions .devices button', function(){
		var device = $(this).data('device');
		$(".ctrlbp-devices label").removeClass('selected');
		if( device == 'desktop' ){			
			$(".ctrlbp-devices input[value=lg]").prop("checked", true).trigger('keyup').closest('label').addClass('selected');
		}

		if( device == 'tablet' ){			
			$(".ctrlbp-devices input[value=sm]").prop("checked", true).trigger('keyup').closest('label').addClass('selected');
		}

		if( device == 'mobile' ){			
			$(".ctrlbp-devices input[value=xs]").prop("checked", true).trigger('keyup').closest('label').addClass('selected');
		}

		
	})

	$(document).on('change', '.ctrlbp-devices input', function(){
		var device = $(this).val();
		if( device == 'lg' ){
			$('#customize-footer-actions .preview-desktop').trigger('click');
		}
		if( device == 'sm' ){
			$('#customize-footer-actions .preview-tablet').trigger('click');
		}
		if( device == 'xs' ){
			$('#customize-footer-actions .preview-mobile').trigger('click');
		}
	})

	
} )( jQuery, wp.customize, ctrlbp );