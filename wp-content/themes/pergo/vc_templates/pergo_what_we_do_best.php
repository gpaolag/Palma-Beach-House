<?php
$shortcode_content = $content;
$atts = shortcode_atts(array(		
		'subtitle' => 'What We Do Best',
		'title' => 'We\'re an award-winning digital agency focused on hight-quality brands', 
		'lead_text' => 'Lorem ipsum dolor sit amet, suscipit egestas luctus magna suscipit elit aenean magna. An integer congue magna at pretium purus pretium ligula rutrum luctus',
		'textarea_html' => 'An enim nullam tempor sapien gravida enim ipsum blandit porta justo integer odio velna vitae auctor integer congue magna at pretium purus pretium ligula rutrum luctus risus ultrice luctus ligula congue vitae auctor erat',
), $atts);
extract($atts);

$atts['content'] = $shortcode_content;
echo pergo_buffer_template_file('sections/what-we-do.php', $atts);
?>