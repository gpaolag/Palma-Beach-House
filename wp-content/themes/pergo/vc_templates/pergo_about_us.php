<?php
$shortcode_content = $content;
$atts = shortcode_atts(pergo_about_us_shortcode_vc(true), $atts);
extract($atts);

if( $display == 'counter' ){
	$params = $counter_group;
}elseif( $display == 'techs' ){
	$params = $techs_group;
}else{
	$params = $strategy_list;
}
$paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params) : array();
$order = ($position == 'yes')? 'col-md-6 col-lg-6 offset-lg-1' : 'col-md-6 col-lg-6';
$container_class = ($position == 'yes')? 'col-md-6 col-lg-5' : 'col-md-6 col-lg-6 order-md-last order-lg-last';
$video_class = ( $video_popup == 'yes' )? 'video-preview' : 'ind-20';
$animation_class = ($position == 'yes')? 'fadeInLeft' : 'fadeInRight';
if( $display == 'list' ){
	$order = ($position == 'yes')? 'col-md-6 col-lg-5 offset-lg-1' : 'col-md-6 col-lg-5';
	$container_class = ($position == 'yes')? 'col-md-6 col-lg-5' : 'col-md-6 col-lg-6 offset-lg-1 order-md-last order-lg-last';
	$video_class = ( $video_popup == 'yes' )? 'video-preview' : '';
}
$about_class = ( $position == 'yes' )? '' : ' ind-45';

$Arr = explode(':', $tag);
$titletag = $Arr[0];
$title_class = $Arr[1];
$title_class .= ' '.$title_text_color.'-color';

$tagclass = '';
if( $underline == 'yes' ){
	$tagclass = ($underline_color != 'none')? $underline_color : '';
	$tagclass .= ($highlight_text_color != '')? ' '.$highlight_text_color.'-color' : '';
}

$atts['about_class'] = $about_class;
$atts['paramsArr'] = $paramsArr;
$atts['order'] = $order;
$atts['container_class'] = $container_class;
$atts['video_class'] = $video_class;
$atts['animation_class'] = $animation_class;
$atts['content'] = $shortcode_content;
$atts['title_class'] = $title_class;
$atts['titletag'] = $titletag;
$atts['tagclass'] = $tagclass;
$atts['parse_args'] = array('tagclass' => $tagclass );
$atts[ 'image_alt' ] = (isset($image_alt) && ($image_alt != '') )? $image_alt : $subtitle;
echo pergo_buffer_template_file('sections/about.php', $atts);
?>
