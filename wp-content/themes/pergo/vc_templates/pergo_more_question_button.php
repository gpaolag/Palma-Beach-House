<?php
 $atts = shortcode_atts(array(
		'title' => 'Didn\'t find what you\'re looking for?', 
		'params' => '',
		'css_animation' => 'fadeInUp',
		'animation_delay' => 800,
), $atts);
 extract($atts);
$paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params) : array();

$atts['paramsArr'] = $paramsArr;
echo pergo_buffer_template_file('sections/more-question-button.php', $atts);

?>