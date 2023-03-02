( function ( $, ctrlbp ) {
	'use strict';

	var views = ctrlbp.views = ctrlbp.views || {},
		ImageField = views.ImageField,
		ImageUploadField,
		UploadButton = views.UploadButton;

	ImageUploadField = views.ImageUploadField = ImageField.extend( {
		createAddButton: function () {
			this.addButton = new UploadButton( {controller: this.controller} );
		}
	} );

	function initImageUpload() {
		var $this = $( this ),
			view = $this.data( 'view' );

		if ( view ) {
			return;
		}

		view = new ImageUploadField( { input: this } );

		$this.siblings( '.ctrlbp-media-view' ).remove();
		$this.after( view.el );

		// Init uploader after view is inserted to make wp.Uploader works.
		view.addButton.initUploader();

		$this.data( 'view', view );
	}

	function init( e ) {
		$( e.target ).find( '.ctrlbp-image_upload, .ctrlbp-plupload_image' ).each( initImageUpload );
	}

	ctrlbp.$document
		.on( 'ctrlbp_ready', init )
		.on( 'clone', '.ctrlbp-image_upload, .ctrlbp-plupload_image', initImageUpload )
} )( jQuery, ctrlbp );
