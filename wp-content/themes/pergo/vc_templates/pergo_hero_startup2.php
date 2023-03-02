<?php
$atts = shortcode_atts( pergo_hero_startup2_shortcode_vc(true), $atts);
extract($atts);
$paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params) : array();

$atts['paramsArr'] = $paramsArr;
echo pergo_buffer_template_file('sections/hero-startup2.php', $atts);
?>
