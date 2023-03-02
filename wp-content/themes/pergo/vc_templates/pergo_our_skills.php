<?php
$shortcode_content = $content;
$atts = shortcode_atts( pergo_our_skills_shortcode_vc(true), $atts);
$atts['content'] = $shortcode_content;
extract($atts);
$paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params) : array();

$atts['paramsArr'] = $paramsArr;
echo pergo_buffer_template_file('sections/our-skills.php', $atts);
?>