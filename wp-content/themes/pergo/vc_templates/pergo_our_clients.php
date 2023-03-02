<?php
$atts = shortcode_atts(array(		
		'params' => '',
		'style' => 'style1',
		'title' => 'Over 2000+ companies are already using {PERGO} every day. '
), $atts);
extract($atts);
$paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params) : array();
$style_id = ( $style == 'style1' )? 'brands-2' : 'brands-1';

$atts['paramsArr'] = $paramsArr;
$atts['style_id'] = $style_id;
echo pergo_buffer_template_file('sections/our-clients.php', $atts);
?>