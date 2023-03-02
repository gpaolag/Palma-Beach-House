<?php
$atts = shortcode_atts( pergo_hero_business_agency_shortcode_vc(true), $atts);
extract($atts);
$paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params) : array();

$atts['paramsArr'] = $paramsArr;
echo pergo_buffer_template_file('sections/hero-business-agency.php', $atts);
?>