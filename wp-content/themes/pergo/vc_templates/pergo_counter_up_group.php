<?php
$atts = shortcode_atts(array(
		'column' => 'col-sm-6 col-md-6',
		'align'	=> 'inherit',		
		'prefix_color' => 'rose',
		'counter_color' => 'rose',
		'postfix_color' => 'rose',
		'title_color' => 'default',
		'subtitle_color' => 'lightgrey',
		'params' => '',
), $atts);
extract($atts);
$paramsArr=(function_exists('vc_param_group_parse_atts'))?vc_param_group_parse_atts($params):array();

$atts['paramsArr'] = $paramsArr;
echo pergo_buffer_template_file('sections/counter-up-group.php', $atts);
?>