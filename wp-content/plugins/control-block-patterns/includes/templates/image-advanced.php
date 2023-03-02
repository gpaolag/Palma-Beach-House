<script id="tmpl-ctrlbp-image-item" type="text/html">
	<input type="hidden" name="{{{ data.controller.fieldName }}}" value="{{{ data.id }}}" class="ctrlbp-media-input">
	<div class="ctrlbp-file-icon">
		<# if ( 'image' === data.type && data.sizes ) { #>
			<# if ( data.sizes[data.controller.imageSize] ) { #>
				<img src="{{{ data.sizes[data.controller.imageSize].url }}}">
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
	<div class="ctrlbp-image-overlay"></div>
	<div class="ctrlbp-image-actions">
		<a class="ctrlbp-image-edit ctrlbp-edit-media" title="{{{ i18nCtrlbpMedia.edit }}}" href="{{{ data.editLink }}}" target="_blank">
			<span class="dashicons dashicons-edit"></span>
		</a>
		<a href="#" class="ctrlbp-image-delete ctrlbp-remove-media" title="{{{ i18nCtrlbpMedia.remove }}}">
			<span class="dashicons dashicons-no-alt"></span>
		</a>
	</div>
</script>
