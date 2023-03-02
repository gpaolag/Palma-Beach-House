<script id="tmpl-ctrlbp-media-item" type="text/html">
	<input type="hidden" name="{{{ data.controller.fieldName }}}" value="{{{ data.id }}}" class="ctrlbp-media-input">
	<div class="ctrlbp-media-preview">
		<div class="ctrlbp-media-content">
			<div class="centered">
				<# if ( 'image' === data.type && data.sizes ) { #>
					<# if ( data.sizes.thumbnail ) { #>
						<img src="{{{ data.sizes.thumbnail.url }}}">
					<# } else { #>
						<img src="{{{ data.sizes.full.url }}}">
					<# } #>
				<# } else { #>
					<# if ( data.image && data.image.src && data.image.src !== data.icon ) { #>
						<img src="{{ data.image.src }}" />
					<# } else { #>
						<img src="{{ data.icon }}" />
					<# } #>
				<# } #>
			</div>
		</div>
	</div>
	<div class="ctrlbp-media-info">
		<h4>
			<a href="{{{ data.url }}}" target="_blank" title="{{{ i18nCtrlbpMedia.view }}}">
				<# if( data.title ) { #> {{{ data.title }}}
					<# } else { #> {{{ i18nCtrlbpMedia.noTitle }}}
				<# } #>
			</a>
		</h4>
		<p>{{{ data.mime }}}</p>
		<p>
			<a class="ctrlbp-edit-media" title="{{{ i18nCtrlbpMedia.edit }}}" href="{{{ data.editLink }}}" target="_blank">
				<span class="dashicons dashicons-edit"></span>{{{ i18nCtrlbpMedia.edit }}}
			</a>
			<a href="#" class="ctrlbp-remove-media" title="{{{ i18nCtrlbpMedia.remove }}}">
				<span class="dashicons dashicons-no-alt"></span>{{{ i18nCtrlbpMedia.remove }}}
			</a>
		</p>
	</div>
</script>
