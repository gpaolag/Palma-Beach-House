<?php
$atts = shortcode_atts(array(
		'style' => 'style1',
		'subtitle' => 'Want to Learn More?',
		'title' => 'Start growing with {PERGO} today', 
		'lead_text' => 'Egestas magna egestas magna ipsum vitae purus ipsum primis in cubilia laoreet augue luctus magna',
		'display' => 'buttons',
		'params' => '',
		'params2' => '',
), $atts);
extract($atts);
$paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params) : array();
$paramsArr2 = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params2) : array();

$atts['paramsArr'] = $paramsArr;
$atts['paramsArr2'] = $paramsArr2;
echo pergo_buffer_template_file('sections/call-to-action.php', $atts);
?>