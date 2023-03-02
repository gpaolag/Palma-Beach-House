<?php
$atts = shortcode_atts( pergo_faq_shortcode_vc(true), $atts);
extract($atts);
echo pergo_buffer_template_file('sections/faq.php', $atts);
?>