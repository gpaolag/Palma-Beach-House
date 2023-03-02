( function ( $, wp, ctrlbp ) {
	'use strict';

	var views = ctrlbp.views = ctrlbp.views || {},
		MediaField = views.MediaField,
		FileUploadField, UploadButton;

	FileUploadField = views.FileUploadField = MediaField.extend( {
		createAddButton: function () {
			this.addButton = new UploadButton( {controller: this.controller} );
		}
	} );

	UploadButton = views.UploadButton = Backbone.View.extend( {
		className: 'ctrlbp-upload-area',
		tagName: 'div',
		template: wp.template( 'ctrlbp-upload-area' ),
		render: function () {
			this.$el.html( this.template( {} ) );
			return this;
		},

		initialize: function ( options ) {
			this.controller = options.controller;
			this.el.id = _.uniqueId( 'ctrlbp-upload-area-' );
			this.render();

			// Auto hide if you reach the max number of media
			this.listenTo( this.controller, 'change:full', function () {
				this.$el.toggle( ! this.controller.get( 'full' ) );
			} );
		},

		// Initializes plupload using code from wp.Uploader (wp-includes/js/plupload/wp-plupload.js)
		initUploader: function () {
			var self = this,
				extensions = this.getExtensions().join( ',' ),
				maxFileSize = this.controller.get( 'maxFileSize' ),
				options = {
					container: this.el,
					dropzone: this.el,
					browser: this.$( '.ctrlbp-browse-button' ),
					params: {
						post_id : $( '#post_ID' ).val()
					},
					added: function( attachment ) {
						self.controller.get( 'items' ).add( [attachment] );
					}
				};

			// Initialize the plupload instance.
			this.uploader = new wp.Uploader( options );

			var filters = this.uploader.uploader.getOption( 'filters' );
			if ( maxFileSize ) {
				filters.max_file_size = maxFileSize;
			}
			if ( extensions ) {
				filters.mime_types = [{title: i18nCtrlbpMedia.select, extensions: extensions}];
			}
			this.uploader.uploader.setOption( 'filters', filters );
		},

		getExtensions: function () {
			var mimeTypes = this.controller.get( 'mimeType' ).split( ',' ),
				exts = [];

			_.each( mimeTypes, function ( current, index ) {
				if ( i18nCtrlbpMedia.extensions[current] ) {
					exts = exts.concat( i18nCtrlbpMedia.extensions[current] );
				}
			} );
			return exts;
		}
	} );

	function initFileUpload() {
		var $this = $( this ),
			view = $this.data( 'view' );

		if ( view ) {
			return;
		}

		view = new FileUploadField( { input: this } );

		$this.siblings( '.ctrlbp-media-view' ).remove();
		$this.after( view.el );

		// Init uploader after view is inserted to make wp.Uploader works.
		view.addButton.initUploader();

		$this.data( 'view', view );
	}

	function init( e ) {
		$( e.target ).find( '.ctrlbp-file_upload' ).each( initFileUpload );
	}

	ctrlbp.$document
		.on( 'ctrlbp_ready', init )
		.on( 'clone', '.ctrlbp-file_upload', initFileUpload )
} )( jQuery, wp, ctrlbp );
