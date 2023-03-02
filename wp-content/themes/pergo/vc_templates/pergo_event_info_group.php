<?php
$atts = shortcode_atts(array(		
		'params' => '',
), $atts);
extract($atts);
$paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params) : array();

$atts['paramsArr'] = $paramsArr;
echo pergo_buffer_template_file('sections/event-info-group.php', $atts);