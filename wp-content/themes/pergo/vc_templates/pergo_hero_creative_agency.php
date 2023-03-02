<?php
$__content = $content;
$atts = shortcode_atts( pergo_hero_creative_agency_shortcode_vc(true), $atts);
extract($atts);

$atts['__content'] = $__content;
echo pergo_buffer_template_file('sections/hero-creative-agency.php', $atts);
?>