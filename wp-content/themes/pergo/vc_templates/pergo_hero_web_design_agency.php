<?php
$atts = shortcode_atts( pergo_hero_web_design_agency_shortcode_vc(true), $atts);
extract($atts);
echo pergo_buffer_template_file('sections/hero-web-design-agency.php', $atts);
?>

