<?php
$atts = shortcode_atts(array(
		'align'	=> 'center',
		'shortcode'	=> '[wpdomainchecker button="Search Domain"]',
		'params' => '',
), $atts);
extract($atts);
$paramsArr=(function_exists('vc_param_group_parse_atts'))?vc_param_group_parse_atts($params):array();

$atts['paramsArr'] = $paramsArr;
echo pergo_buffer_template_file('sections/domain-names.php', $atts);