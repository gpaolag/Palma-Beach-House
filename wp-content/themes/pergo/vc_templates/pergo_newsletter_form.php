<?php
$atts = shortcode_atts(array(
		'title' => 'Stay up to date with our news, ideas and updates',
		'placeholder' => 'Your email address',
		'columns' => '3'
), $atts);
extract($atts);
echo pergo_buffer_template_file('sections/newsletter-form.php', $atts);

?>