<?php
$atts = shortcode_atts( pergo_hero_freelancer1_shortcode_vc(true), $atts);
extract($atts);
echo pergo_buffer_template_file('sections/hero-freelancer1.php', $atts);
?>