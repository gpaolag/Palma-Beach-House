<?php
$atts = shortcode_atts( pergo_discount_banner_shortcode_vc(true), $atts);
extract($atts);
$paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params) : array();
$dark_color_class = pergo_default_dark_color_classes();
if( in_array($bg_class, $dark_color_class) ){
	$bg_class .= ' white-color';	
}
$titleClass = apply_filters('perch_vc_class_filter', 'h2-xl animated', 'title', $atts);
$subtitleClass = apply_filters('perch_vc_class_filter', 'p-xl animated', 'lead_text', $atts);

$atts['paramsArr'] = $paramsArr;
$atts['dark_color_class'] = $dark_color_class;
$atts['titleClass'] = $titleClass;
$atts['subtitleClass'] = $subtitleClass;
echo pergo_buffer_template_file('sections/discount-banner.php', $atts);
?>