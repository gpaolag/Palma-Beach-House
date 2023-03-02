( function ( $, ctrlbp ) {
	'use strict';

	var views = ctrlbp.views = ctrlbp.views || {},
		MediaField = views.MediaField,
		MediaItem = views.MediaItem,
		MediaList = views.MediaList,
		ImageField;

	ImageField = views.ImageField = MediaField.extend( {
		createList: function () {
			this.list = new MediaList( {
				controller: this.controller,
				itemView: MediaItem.extend( {
					className: 'ctrlbp-image-item',
					template: wp.template( 'ctrlbp-image-item' )
				} )
			} );
		}
	} );

	/**
	 * Initialize image fields
	 */
	function initImageField() {
		var $this = $( this ),
			view = $this.data( 'view' );

		if ( view ) {
			return;
		}

		view = new ImageField( { input: this } );

		$this.siblings( '.ctrlbp-media-view' ).remove();
		$this.after( view.el );
		$this.data( 'view', view );
	}

	function init( e ) {
		$( e.target ).find( '.ctrlbp-image_advanced' ).each( initImageField );
	}

	ctrlbp.$document
		.on( 'ctrlbp_ready', init )
		.on( 'clone', '.ctrlbp-image_advanced', initImageField );
} )( jQuery, ctrlbp );
