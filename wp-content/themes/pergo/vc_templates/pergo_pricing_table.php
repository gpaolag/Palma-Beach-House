<?php
$shortcode_content = $content;
$atts = shortcode_atts(array(
	'style' => 'style1',
	'featured' => false,
    'title' => 'Personal Plan',
    'unit' => '$', 
    'price' => '29',
    'validity' => 'monthly',
    'link_title' => 'Get started now',
    'link' => '#',
    'css_animation' => '',
	'animation_delay' => 300,
), $atts);
extract($atts);

$btnclass = ($featured)? 'btn-primary' : 'btn-tra-black';
$titleclass = ($featured)? ' '.pergo_default_color().'-color' : '';
$borderclass = ($featured)? ' '.pergo_default_color().'-border' : '';

$atts['content'] = $shortcode_content;
$atts['btnclass'] = $btnclass;
$atts['titleclass'] = $titleclass;
$atts['borderclass'] = $borderclass;
echo pergo_buffer_template_file('sections/pricing-table.php', $atts);
?>