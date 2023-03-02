<?php
$atts = shortcode_atts(array(		
		'title' => 'Our Location', 	
		'subtitle' => '121 King Street, Melbourne,Victoria 3000 Australia',
		'css_animation' => '',
		'animation_delay' => 300,
), $atts);
extract($atts);
echo pergo_buffer_template_file('sections/contact-info.php', $atts);
?>