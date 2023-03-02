<?php
$atts = shortcode_atts(array(
	'column' => 'col-md-4',
	'params' => '',
), $atts);
extract($atts);
$paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params) : array();
$animation_delay = 300;

$atts['paramsArr'] = $paramsArr;
$atts['animation_delay'] = $animation_delay;
echo pergo_buffer_template_file('sections/highlight-boxes.php', $atts);
?>