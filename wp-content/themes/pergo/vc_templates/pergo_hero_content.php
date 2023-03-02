<?php
$shortcode_content = $content;
$atts = shortcode_atts(array(
		'name' => '',		
		'title' => 'We\'re making {better design} for everyone', 	
		'subtitle' => 'Aliquam a augue suscipit, luctus neque purus ipsum neque dolor primis libero tempus, tempor posuere ligula varius augue luctus donec sapien',	
		'align' => 'inherit',
		'tag' => 'h2:h2-normal',
		'title_text_color' => 'default',
		'name_color' => 'rose',
		'underline' => 'yes',
		'underline_color' => 'underline-yellow',
		'highlight_text_color' => 'rose',
		'subtitle_text_color' => 'grey',
		'subtitle_text_size' => 'p-lg',
		'footer_text' => '',
		'fullwidth' => 'yes',
		'enable_content' => '',
		'enable_list' => '',
		'content_list' => '',
		'enable_button' => '',
		'params' => '',
		'column' => 'full',
		'right_content_type' => 'none',
		'form_title' => 'Get Started',
		'form_desc' => 'Please fill all fields so we can get some info about you. We will never send you spam',
		'form_id' => '',
		'form_bg' => 'bg-white',
		'shortcode' => '',
		'image' => PERGO_URI. '/images/hero-17-img.png',
		'video_popup' => '',
		'url' => 'https://www.youtube.com/embed/SZEflIVnhH8',
		'icon_class' => 'rose'
), $atts);
extract($atts);
$right_column_class = '';
$left_column_class = '';
$Arr = explode(':', $tag);
$tagname = $Arr[0];
$classname = $Arr[1];
$classname .= ' '.$title_text_color.'-color';
$sectionclass = array('hero-txt');
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
?>
<?php if( $column != 'full' ): 
$left_column_class = 'col-md-6';		
$right_column_class = 'col-md-6';	
if( $right_content_type == 'form' ){
	$right_column_class = 'col-md-5 col-xl-4 offset-xl-2 offset-md-1';
}
endif;

$atts['tagname'] = $tagname;
$atts['classname'] = $classname;
$atts['sectionclass'] = $sectionclass;
$atts['tagclass'] = $tagclass;
$atts['content'] = $shortcode_content;
$atts['parse_args'] = array('tagclass' => $tagclass );
$atts['left_column_class'] = $left_column_class;
$atts['right_column_class'] = $right_column_class;
echo pergo_buffer_template_file('sections/hero-content.php', $atts);
?>