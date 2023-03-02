<?php $atts = $args ?>
<div class="row" id="contacts-map">
	<div class="col-md-12">	
		<div id="gmap" class="gmap" data-latitude="<?php echo esc_attr($latitude) ?>" data-longitude="<?php echo esc_attr($longitude) ?>" data-title="<?php echo esc_attr($title) ?>" data-marker="<?php echo esc_url($image) ?>"  data-zoom="<?php echo intval($zoom) ?>"></div>
	</div>
</div>	<!-- End row -->