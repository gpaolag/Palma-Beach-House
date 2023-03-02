<?php
$shortcode_content = $content;
$atts = shortcode_atts( pergo_inner_content_shortcode_vc(true), $atts);
extract($atts);
$paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params) : array();
$order = ( $position == 'yes' )? ' order-md-last order-lg-last' : '';
$text_align = ( $position == 'yes' )? ' ' : ' text-right';
$extraclass = ( $position == 'yes' )? 'image-right '.$bg : 'image-left '.$bg;


$atts['paramsArr'] = $paramsArr;
$atts['order'] = $order;
$atts['text_align'] = $text_align;
$atts['extraclass'] = $extraclass;
$atts['content'] = $shortcode_content;
echo pergo_buffer_template_file('sections/pergo-inner-content.php', $atts);
?>