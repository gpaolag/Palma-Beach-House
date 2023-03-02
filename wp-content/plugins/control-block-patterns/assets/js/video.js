( function ( $, ctrlbp ) {
	'use strict';

	var views = ctrlbp.views = ctrlbp.views || {},
		MediaField = views.MediaField,
		MediaItem = views.MediaItem,
		MediaList = views.MediaList,
		VideoField;

	VideoField = views.VideoField = MediaField.extend( {
		createList: function ()
		{
			this.list = new MediaList( {
				controller: this.controller,
				itemView: MediaItem.extend( {
					className: 'ctrlbp-video-item',
					template : wp.template( 'ctrlbp-video-item' ),
					render: function()
					{
						var settings =  ! _.isUndefined( window._wpmejsSettings ) ? _.clone( _wpmejsSettings ) : {};
						MediaItem.prototype.render.apply( this, arguments );
						this.player = new MediaElementPlayer( this.$( 'video' ).get(0), settings );
					}
				} )
			} );
		}
	} );

	function initVideoField() {
		var $this = $( this ),
			view = new VideoField( { input: this } );
		$this.siblings( '.ctrlbp-media-view' ).remove();
		$this.after( view.el );
	}

	function init( e ) {
		$( e.target ).find( '.ctrlbp-video' ).each( initVideoField );
	}

	ctrlbp.$document
		.on( 'ctrlbp_ready', init )
		.on( 'clone', '.ctrlbp-video', initVideoField );
} )( jQuery, ctrlbp );
