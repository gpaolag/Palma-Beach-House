<?php
$shortcode_content = $content;
$atts = shortcode_atts( pergo_service_box_shortcode_vc(true), $atts);
extract($atts);
$icon_html = '';
if( $icon_type == 'flaticon' ){
	$icon_html = '<span class="flaticon '.esc_attr($icon).'"></span><!-- Icon -->';
}
if( $icon_type == 'fontawesome' ){
	$icon_html = ($icon_2 != '')? '<span class="flaticon"><i class="fa-5x '.esc_attr($icon_2).'"></i></span><!-- Icon -->' : '';
}
if( ($icon_type == 'image') && ( $icon_image != '' ) ){
	$icon_html = '<span class="sbox-icon-img img-fluid"><img src="'.esc_url($icon_image).'" alt="'.esc_attr($title).'" width="'.esc_attr($image_width).'"></span><!-- Icon -->';
}
if(!$icon_color)  $icon_color = 'grey';

//$href = vc_build_link( $title_url ); print_r($href) ;

$atts['icon_html'] = $icon_html;
$atts['content'] = $shortcode_content;
echo pergo_buffer_template_file('sections/service-box.php', $atts);
?>
