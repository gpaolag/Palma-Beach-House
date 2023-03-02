<?php
$shortcode_content = $content;
$atts = shortcode_atts(array(
	'style' => 'style1',
	'pricing_color' => 'rose',
	'featured' => false,
    'title' => 'Personal Plan',
    'unit' => '$', 
    'price' => '29',
    'validity' => 'monthly',
    'css_animation' => '',
	'animation_delay' => 300,
	'params' => '',
), $atts);
extract($atts);
$paramsArr=(function_exists('vc_param_group_parse_atts'))?vc_param_group_parse_atts($params):array();
$titleclass = $pricing_color.'-color';
$borderclass = $pricing_color.'-border';


$atts['paramsArr'] = $paramsArr;
$atts['content'] = $shortcode_content;
$atts['titleclass'] = $titleclass;
$atts['borderclass'] = $borderclass;

echo pergo_buffer_template_file('sections/pricing-table2.php', $atts);
?>