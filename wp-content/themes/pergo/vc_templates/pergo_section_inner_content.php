<?php
$atts = shortcode_atts(array(
		'bg' => 'lightgrey',
		'position' => '',
		'enable_video' => '',
		'image' => PERGO_URI. '/images/hero-11-img.jpg',
		'url' => 'https://www.youtube.com/embed/SZEflIVnhH8',
), $atts);
extract($atts);

$order = ( $position == 'yes' )? ' order-md-last order-lg-last' : '';
$text_align = ( $position == 'yes' )? ' ' : ' text-right';
$extraclass = ( $position == 'yes' )? 'image-right bg-'.$bg : 'image-left bg-'.$bg;

$atts['order'] = $order;
$atts['text_align'] = $text_align;
$atts['extraclass'] = $extraclass;
echo pergo_buffer_template_file('sections/section-inner-content.php', $atts);
?>