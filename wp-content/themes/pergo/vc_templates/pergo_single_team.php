<?php
$shortcode_content = $content;
$atts = shortcode_atts(array(
		'image' => PERGO_URI . '/images/team-5.jpg',
		'title' => 'Jonathan Barnes', 
		'link' => '',
		'subtitle' => 'CEO, Founder', 
		'css_animation' => '',
		'animation_delay' => 300,
		'style' => 'team-1',
		'align' => 'left',
		'tag' => 'h5:h5-sm',
		'title_text_color' => 'default',
		'subtitle_text_color' => 'grey',
		'content_text_color' => 'grey',		
		'content_text_size' => 'p-sm',
), $atts);
extract($atts);

$Arr = explode(':', $tag);
$tagname = $Arr[0];
$classname = $Arr[1];
$classname .= ' '.$title_text_color.'-color';

$atts['tagname'] = $tagname;
$atts['classname'] = $classname;
$atts['content'] = $shortcode_content;
echo pergo_buffer_template_file('sections/single-team.php', $atts);
?>