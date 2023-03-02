<?php
$shortcode_content = $content;
$atts = shortcode_atts(array(
		'position' => '',
		'image' => PERGO_URI . '/images/image-02.png',
		'subtitle' => 'Digital Solutions',
		'title' => 'We use design and innovations', 
		'lead_text' => 'Justo integer odio velna vitae auctor integer congue magna at pretium purus ligula rutrum luctus',
		'display' => 'techs',
		'tech_title' => 'Technologies we use:',
		'style' => 'default',
		'techs_group' => '',
		'counter_group' => '',
		'strategy_list' => '',
		'image_alt' => '',

		'tag' => 'h3:h3-sm',
		'title_text_color' => 'default',
		'name_color' => 'default',
		'underline' => 'yes',
		'underline_color' => 'underline-yellow',
		'highlight_text_color' => 'rose',
		'subtitle_text_color' => 'grey',
		'subtitle_text_size' => 'p-lg',
), $atts);
extract($atts);

if( $display == 'counter' ){
	$params = $counter_group;
}elseif( $display == 'techs' ){
	$params = $techs_group;
}else{
	$params = $strategy_list;
}

$paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($params) : array();
$content_class = ($position == 'yes')? 'col-md-6 col-lg-6 offset-lg-1 order-md-last order-lg-last' : 'col-md-6 col-lg-6';
$image_class = ($position == 'yes')? 'col-md-6 col-lg-5' : 'col-md-6 col-lg-5 offset-lg-1';

$Arr = explode(':', $tag);
$titletag = $Arr[0];
$title_class = $Arr[1];
$title_class .= ' '.$title_text_color.'-color';

$tagclass = '';
if( $underline == 'yes' ){
	$tagclass = ($underline_color != 'none')? $underline_color : '';
	$tagclass .= ($highlight_text_color != '')? ' '.$highlight_text_color.'-color' : '';
}
$parse_args = array('tagclass' => $tagclass );

$atts['paramsArr'] = $paramsArr;
$atts['content_class'] = $content_class;
$atts['image_class'] = $image_class;
$atts['content'] = $shortcode_content;
$atts['title_class'] = $title_class;
$atts['titletag'] = $titletag;
$atts['tagclass'] = $tagclass;
$atts['parse_args'] = array('tagclass' => $tagclass );
$atts[ 'image_alt' ] = (isset($image_alt) && ($image_alt != '') )? $image_alt : $subtitle;
echo pergo_buffer_template_file('sections/digital-solutions.php', $atts);
?>