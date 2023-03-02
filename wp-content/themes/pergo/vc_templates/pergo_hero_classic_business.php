<?php
$atts = shortcode_atts( pergo_hero_classic_business_shortcode_vc(true), $atts);
extract($atts);
echo pergo_buffer_template_file('sections/hero-classic-business.php', $atts);
?>