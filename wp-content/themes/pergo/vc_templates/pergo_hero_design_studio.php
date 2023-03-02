<?php
$atts = shortcode_atts( pergo_hero_design_studio_shortcode_vc(true), $atts);
$__content = $content;
extract($atts);

$atts['__content'] = $__content;
echo pergo_buffer_template_file('sections/hero-design-studio.php', $atts);
?>