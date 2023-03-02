<?php
$atts = shortcode_atts( pergo_hero_medical_health_shortcode_vc(true), $atts);
$__content = $content;
extract($atts);
$paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params) : array();
$style = ($bg != '')?' style="background-image: url('.esc_url($bg).')"' : '';
$titleClass = apply_filters('perch_vc_class_filter', '', 'title', $atts);
$subtitleClass = apply_filters('perch_vc_class_filter', 'p-hero animated', 'lead_text', $atts);

$atts['__content'] = $__content;
$atts['paramsArr'] = $paramsArr;
$atts['style'] = $style;
$atts['titleClass'] = $titleClass;
$atts['subtitleClass'] = $subtitleClass;
echo pergo_buffer_template_file('sections/hero-medical-health.php', $atts);
?>