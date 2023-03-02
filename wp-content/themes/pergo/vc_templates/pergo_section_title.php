<?php
$shortcode_content = $content;
$atts = shortcode_atts(array(
		'name' => '',		
		'title' => 'We\'re making design better for everyone', 	
		'subtitle' => 'Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero tempus, tempor posuere ligula varius augue luctus donec sapien',	
		'align' => 'center',
		'tag' => 'h3:h3-sm',
		'title_text_color' => 'default',
		'name_color' => 'rose',
		'underline' => 'yes',
		'underline_color' => 'underline-yellow',
		'highlight_text_color' => 'rose',
		'subtitle_text_color' => 'grey',
		'subtitle_text_size' => 'p-lg',
		'fullwidth' => '',
		'enable_content' => '',
		'enable_list' => '',
		'content_list' => '',
		'enable_button' => '',
		'params' => '',
), $atts);
extract($atts);
$Arr = explode(':', $tag);
$tagname = $Arr[0];
$classname = $Arr[1];
$classname .= ' '.$title_text_color.'-color';
$sectionclass = array('section-title');
$sectionclass[] = 'text-'.esc_attr($align);
if( $fullwidth == '' ){
	$sectionclass[] = ( $align == 'center' )? 'col-lg-10 offset-lg-1': 'col-md-11 col-lg-10';
}


$tagclass = '';
if( $underline == 'yes' ){
	$tagclass = ($underline_color != 'none')? $underline_color : '';
	$tagclass .= ($highlight_text_color != '')? ' '.$highlight_text_color.'-color' : '';
}

$parse_args = array('tagclass' => $tagclass );

$atts['content'] = $shortcode_content;
$atts['tagname'] = $tagname;
$atts['classname'] = $classname;
$atts['sectionclass'] = $sectionclass;
$atts['tagclass'] = $tagclass;
$atts['parse_args'] = array('tagclass' => $tagclass );
echo pergo_buffer_template_file('sections/section-title.php', $atts);
?>
