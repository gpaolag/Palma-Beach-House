<?php
$atts = shortcode_atts(array(
		'params' => '',
), $atts);
extract($atts);
$paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params) : array();
$animation_delay = 600;

$atts['paramsArr'] = $paramsArr;
$atts['animation_delay'] = $animation_delay;
echo pergo_buffer_template_file('sections/statistic-block.php', $atts);
?>