<script id="tmpl-ctrlbp-media-item" type="text/html">
	<input type="hidden" name="{{{ data.controller.fieldName }}}" value="{{{ data.id }}}" class="ctrlbp-media-input">
	<div class="ctrlbp-file-icon">
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
	<div class="ctrlbp-file-info">
		<a href="{{{ data.url }}}" class="ctrlbp-file-title" target="_blank">
			<# if( data.title ) { #>
				{{{ data.title }}}
			<# } else { #>
				{{{ i18nCtrlbpMedia.noTitle }}}
			<# } #>
		</a>
		<div class="ctrlbp-file-name">{{{ data.filename }}}</div>
		<div class="ctrlbp-file-actions">
			<a class="ctrlbp-edit-media" title="{{{ i18nCtrlbpMedia.edit }}}" href="{{{ data.editLink }}}" target="_blank">
				{{{ i18nCtrlbpMedia.edit }}}
			</a>
			<a href="#" class="ctrlbp-remove-media" title="{{{ i18nCtrlbpMedia.remove }}}">
				{{{ i18nCtrlbpMedia.remove }}}
			</a>
		</div>
	</div>
</script>

<script id="tmpl-ctrlbp-media-status" type="text/html">
	<# if ( data.maxFiles > 0 ) { #>
		{{{ data.length }}}/{{{ data.maxFiles }}}
		<# if ( 1 < data.maxFiles ) { #>{{{ i18nCtrlbpMedia.multiple }}}<# } else {#>{{{ i18nCtrlbpMedia.single }}}<# } #>
	<# } #>
</script>

<script id="tmpl-ctrlbp-media-button" type="text/html">
	<a class="button">{{{ data.text }}}</a>
</script>
