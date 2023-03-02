jQuery( function ( $ ) {
	// Add "Export" option to the Bulk Actions dropdowns.
	$( '<option value="cbp-export">' )
		.text( CBP.export )
		.appendTo( 'select[name="action"], select[name="action2"]' );

	// Directory link
	var $directory = $( '<a class="page-title-action button-primary browse-directory" href="'+ window.location.href +'&page=directory">' )
		.text( CBP.directory )
		.insertBefore( '.page-title-action' );

	// Toggle upload form.
	var $form = $( $( '#cbp-import-form' ).html() ).insertAfter( '.wp-header-end' );
	var $toggle = $( '<button class="page-title-action">' )
		.text( CBP.import )
		.insertAfter( $directory );

	$toggle.on( 'click', function( e ) {
		e.preventDefault();
		$form.toggle();
	} );

	// Enable submit button when selecting a file.
	var $input = $form.find( 'input[type="file"]' ),
		$submit = $form.find( 'input[type="submit"]' );

	$input.on( 'change', function() {
		$submit.prop( 'disabled', ! $input.val() );
	} );

	var import_reusable_blocks = $('.cbp-import-reusable-blocks').on('click', function(){
		var $target = $(this);
		var $linkText = $target.text();
		
		wp.ajax.send( 'cbp-insert-reusable-blocks', {
			data: {},

			beforeSend: function() {
				$target.text( CBP.working );
			},
			success : function(response) {				
				setTimeout(function() {
					location.reload(); 					                         
				}, 500);
			},
		});
	});

	
} );