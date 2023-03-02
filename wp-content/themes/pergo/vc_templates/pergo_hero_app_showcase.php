<?php
$args = pergo_hero_app_showcase_shortcode_vc(true);
$atts = shortcode_atts(pergo_hero_app_showcase_shortcode_vc(true), $atts);
extract($atts);
$paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params) : array();

$atts['paramsArr'] = $paramsArr;
echo pergo_buffer_template_file('sections/hero-app-showcase.php', $atts);
?>