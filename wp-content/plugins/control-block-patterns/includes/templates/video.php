<script id="tmpl-ctrlbp-video-item" type="text/html">
	<input type="hidden" name="{{{ data.controller.fieldName }}}" value="{{{ data.id }}}" class="ctrlbp-media-input">
	<# if( _.indexOf( i18nCtrlbpVideo.extensions, data.url.substr( data.url.lastIndexOf('.') + 1 ) ) > -1 ) { #>
		<video controls="controls" class="ctrlbp-video-element" preload="metadata"
			<# if ( data.width ) { #>width="{{ data.width }}"<# } #>
			<# if ( data.height ) { #>height="{{ data.height }}"<# } #>
			<# if ( data.image && data.image.src !== data.icon ) { #>poster="{{ data.image.src }}"<# } #>>
			<source type="{{ data.mime }}" src="{{ data.url }}"/>
		</video>
	<# } else { #>
		<# if ( data.image && data.image.src && data.image.src !== data.icon ) { #>
			<img src="{{ data.image.src }}" />
		<# } else { #>
			<img src="{{ data.icon }}" />
		<# } #>
	<# } #>
	<div class="ctrlbp-media-info">
		<a href="{{{ data.url }}}" class="ctrlbp-file-title" target="_blank">
			<# if( data.title ) { #>
				{{{ data.title }}}
			<# } else { #>
				{{{ i18nCtrlbpMedia.noTitle }}}
			<# } #>
		</a>
		<div class="ctrlbp-file-name">{{{ data.filename }}}</div>
		<div class="ctrlbp-media-actions">
			<a class="ctrlbp-edit-media" title="{{{ i18nCtrlbpMedia.edit }}}" href="{{{ data.editLink }}}" target="_blank">
				{{{ i18nCtrlbpMedia.edit }}}
			</a>
			<a href="#" class="ctrlbp-remove-media" title="{{{ i18nCtrlbpMedia.remove }}}">
				{{{ i18nCtrlbpMedia.remove }}}
			</a>
		</div>
	</div>
</script>
