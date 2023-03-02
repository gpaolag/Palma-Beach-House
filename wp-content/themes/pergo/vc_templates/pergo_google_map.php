<?php
$atts = shortcode_atts(array(
		'style' => 'default',
		'title' => '121 King Street, Melbourne, Victoria 3000 Australia',
		'image' => PERGO_URI . '/images/place-marker.png',
		'latitude' => '-37.817214',
		'longitude' => '144.955925',
		'zoom' => '17'
), $atts);
extract($atts);
if($style == 'embaed'):
?>
<div style="width: 100%"><iframe scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=720&height=480&hl=en&q=<?php echo esc_attr($title) ?>&t=&z=<?php echo intval($zoom) ?>&ie=UTF8&iwloc=B&output=embed" height="480" frameborder="0" style="width: 100%; margin-bottom: 0; display: block"></iframe></div>
<?php
else:
wp_enqueue_script( 'googleapis' );
echo pergo_buffer_template_file('sections/google-map.php', $atts);
endif;
?>