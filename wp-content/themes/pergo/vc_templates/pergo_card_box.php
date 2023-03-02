<?php
$shortcode_content = $content;
$__content = $content;
$atts = shortcode_atts( pergo_card_box_shortcode_vc(true), $atts);
extract($atts);

$atts['__content'] = $__content;
$atts['content'] = $shortcode_content;
$atts[ 'image_alt' ] = (isset($image_alt) && ($image_alt != '') )? $image_alt : $title;
echo pergo_buffer_template_file('sections/card-box.php', $atts);
?>