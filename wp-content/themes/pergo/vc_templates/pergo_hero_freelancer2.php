<?php
$args = pergo_hero_freelancer2_shortcode_vc(true);
$atts = shortcode_atts( $args, $atts);
extract($atts);
echo pergo_buffer_template_file('sections/hero-freelancer2.php', $atts);
?>