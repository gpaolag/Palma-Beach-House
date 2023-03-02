<?php
$shortcode_content = $content;
$atts = shortcode_atts(array(
		'style' => 'style1',
		'image' => PERGO_URI . '/images/video-3-img.png',
		'title' => 'Watch video', 
		'url' => 'https://www.youtube.com/embed/7e90gBu4pas',
), $atts);
extract($atts);

$atts['content'] = $shortcode_content;
echo pergo_buffer_template_file('sections/watch-video.php', $atts);
?>