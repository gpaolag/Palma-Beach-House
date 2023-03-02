<?php
$atts = shortcode_atts(array(
		'date' => '2019/11/23 09:00:00',	
		'datetxt' => 'Days:HRS:MIN:SEC',
		'css_animation' => '',
		'animation_delay' => 300,
), $atts);
extract( $atts);
wp_enqueue_script('jquery-countdown');
$arr = explode(':', $datetxt);

$atts['arr'] = $arr;
echo pergo_buffer_template_file('sections/count-down.php', $atts);
?>