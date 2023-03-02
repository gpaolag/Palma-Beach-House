<?php
$atts = shortcode_atts( pergo_hero_business_consultancy_shortcode_vc(true), $atts);
extract($atts);

$paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params) : array();
$style = ($bg != '')?' style="background-image: url('.esc_url($bg).')"' : '';

$atts['paramsArr'] = $paramsArr;
$atts['style'] = $style;
echo pergo_buffer_template_file('sections/hero-business-consultancy.php', $atts);
?>