<?php
$shortcode_content = $content;
$atts = shortcode_atts(array(
		'count_prefix' => '',
		'count_postfix' => '',
		'count' => '1154',
		'title' => 'Happy Clients', 
		'subtitle' => 'Viverra sem magna egestas',
		'css_animation' => '',
		'animation_delay' => 300,
		'align'	=> 'center',
		'prefix_color' => 'default',
		'counter_color' => 'default',
		'postfix_color' => 'default',
		'title_color' => 'default',
		'subtitle_color' => 'lightgrey',
), $atts);
extract($atts);

$atts['content'] = $shortcode_content;
echo pergo_buffer_template_file('sections/counter-up.php', $atts);
?>