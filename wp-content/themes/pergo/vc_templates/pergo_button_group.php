<?php
$atts = shortcode_atts(array(
		'align' => 'left',		
		'display' => 'buttons',
		'footer_text' => '',
		'params' => '',
		'params2' => '',
		'mtop' => '',
		'mbottom' => '',
		'mleft' => '',
		'mright' => '',
), $atts);
extract($atts);
$paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params) : array();
$paramsArr2 = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params2) : array();
$divclass = array( 'text-'.$align , 'pergo-btns hero-btns stores-badge animated', $mright, $mleft, $mtop, $mbottom);

$atts['paramsArr'] = $paramsArr;
$atts['paramsArr2'] = $paramsArr2;
$atts['divclass'] = $divclass;
echo pergo_buffer_template_file('sections/button-group.php', $atts);
?>