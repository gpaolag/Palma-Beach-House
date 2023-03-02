<?php
$shortcode_content = $content;
$atts = shortcode_atts( pergo_bring_ideas_shortcode_vc(true), $atts);
extract($atts);
$Arr = explode(':', $tag);
$tagname = $Arr[0];
$classname = $Arr[1];
$paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params) : array();
$paramsArr2 = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params2) : array();
$tagclass = ( $display == 'buttons')? 'font-weight-bold' : pergo_default_color().'-color';
$classname .= ' animated';

$titleClass = apply_filters('perch_vc_class_filter', $classname, 'title', $atts);
$subtitleClass = apply_filters('perch_vc_class_filter', 'p-md animated', 'lead_text', $atts);

$atts['tagname'] = $tagname;
$atts['classname'] = $classname;
$atts['paramsArr'] = $paramsArr;
$atts['paramsArr2'] = $paramsArr2;
$atts['content'] = $shortcode_content;
$atts['tagclass'] = $tagclass;
$atts['titleClass'] = $titleClass;
$atts['subtitleClass'] = $subtitleClass;
$atts[ 'image_alt' ] = (isset($image_alt) && ($image_alt != '') )? $image_alt : $title;
echo pergo_buffer_template_file('sections/bring-ideas.php', $atts);
?>
