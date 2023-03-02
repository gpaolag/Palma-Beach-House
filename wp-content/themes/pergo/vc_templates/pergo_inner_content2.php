<?php
$shortcode_content = $content;
$atts = shortcode_atts(array(
		'position' => '',
		'subtitle' => 'Digital Strategy',
		'title' => 'We create successful digital products',
		'image' => PERGO_URI. '/images/content-9-img.jpg',
		'bg' => 'bg-lightgrey'
), $atts);
extract($atts);
$order = ( $position == 'yes' )? ' order-md-last order-lg-last' : '';
$extraclass = ( $position == 'yes' )? 'image-left '.$bg : 'image-right '.$bg;

$atts['order'] = $order;
$atts['content'] = $shortcode_content;
$atts['extraclass'] = $extraclass;
echo pergo_buffer_template_file('sections/inner-content2.php', $atts);
?>