<?php
$args = pergo_single_portfolio_info_shortcode_vc(true);
$atts = shortcode_atts( $args, $atts);
extract($atts);
echo $template;
get_template_part($template);
?>