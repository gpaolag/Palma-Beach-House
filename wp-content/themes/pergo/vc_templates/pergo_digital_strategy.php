<?php
$shortcode_content = $content;
$atts = shortcode_atts(pergo_digital_strategy_shortcode_vc( true ), $atts);
extract($atts);

if( $display == 'counter' ){
	$params = $counter_group;
}elseif( $display == 'techs' ){
	$params = $techs_group;
}else{
	$params = $strategy_list;
}
$paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params) : array();
$classes = ($position == 'yes')? ' image-position-right' : ' offset-md-6';

$Arr = explode(':', $tag);
$titletag = $Arr[0];
$title_class = $Arr[1];
$title_class .= ' '.$title_text_color.'-color';

$tagclass = '';
if( $underline == 'yes' ){
	$tagclass = ($underline_color != 'none')? $underline_color : '';
	$tagclass .= ($highlight_text_color != '')? ' '.$highlight_text_color.'-color' : '';
}


$atts['paramsArr'] = $paramsArr;
$atts['classes'] = $classes;
$atts['title_class'] = $title_class;
$atts['titletag'] = $titletag;
$atts['tagclass'] = $tagclass;
$atts['content'] = $shortcode_content;
$atts['parse_args'] = array('tagclass' => $tagclass );
$atts[ 'image_alt' ] = (isset($image_alt) && ($image_alt != '') )? $image_alt : $subtitle;
echo pergo_buffer_template_file('sections/digital-strategy.php', $atts);
?>