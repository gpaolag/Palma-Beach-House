<?php
$__content = $content;
$atts = shortcode_atts( pergo_hero_marketing_agency_shortcode_vc(true), $atts);
extract($atts);

$style = ($bg != '')?' style="background-image: url('.esc_url($bg).')"' : '';

$atts['__content'] = $__content;
$atts['style'] = $style;
echo pergo_buffer_template_file('sections/hero-marketing-agency.php', $atts);
?>