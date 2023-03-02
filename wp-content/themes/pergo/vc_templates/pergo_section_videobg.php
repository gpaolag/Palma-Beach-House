<?php
$shortcode_content = $content;
$atts = shortcode_atts(array(
		'image' => PERGO_URI . '/images/video/video.jpg', 
		'mp4' => 'http://jthemes.org/wp/pergo/files/images/video/video.mp4',
		'webm' => 'http://jthemes.org/wp/pergo/files/images/video/video.webm',
		'ogv' => 'http://jthemes.org/wp/pergo/files/images/video/video.ogv',
), $atts);
extract($atts);
$atts['content'] = $shortcode_content;
echo pergo_buffer_template_file('sections/section-videobg.php', $atts);
?>