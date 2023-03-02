<?php
$atts = shortcode_atts( pergo_hero_startup1_shortcode_vc(true), $atts);
extract($atts);
$paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params) : array();
$dark_color_class = pergo_default_dark_color_classes();

if( in_array($form_bg, $dark_color_class) ){
	$form_bg .= ' white-color';	
}

$atts['paramsArr'] = $paramsArr;
$atts['dark_color_class'] = $dark_color_class;
echo pergo_buffer_template_file('sections/hero-startup1.php', $atts);
?>