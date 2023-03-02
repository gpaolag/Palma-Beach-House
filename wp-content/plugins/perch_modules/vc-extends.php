<?php 
function perch_range_option( $start, $limit, $step = 1 ) {
  if ( $step < 0 )
  $step = 1;
  $range = range( $start, $limit, $step );	
  foreach( $range as $k => $v ) {
    if ( strpos( $v, 'E' ) ) {
      $range[$k] = 0;
    }
  }

  return $range;
}

function perch_vc_dropdown_options($start, $limit, $step = 1, $unit = 'px'){
   $range = perch_range_option( $start, $limit, $step );
	$array = array( '' => 'Letter spacing' );
    foreach( $range as $k => $v ) {
      $array[$v . $unit] = $v . $unit;
    } 

   $array = array_flip($array);

   return apply_filters( 'perch_vc_dropdown_options', $array );
}

vc_add_shortcode_param( 'number', 'perch_module_number_settings_field' );
vc_add_shortcode_param( 'perch_select', 'perch_module_perch_select_settings_field' );
vc_add_shortcode_param( 'image_upload', 'perch_module_vc_image_upload_settings_field' );

require_once PERCH_MODULES_DIR . '/vc-typography-field.php';
require_once PERCH_MODULES_DIR . '/perch_vc.php';
require_once PERCH_MODULES_DIR . '/vc-templates.php';
require_once PERCH_MODULES_DIR . '/class.listgroup.php';
/* global vc include files */
foreach ( glob( PERCH_MODULES_DIR . "/vc-extends/*.php" ) as $filename ) {
    include $filename;
} //glob( PERCH_MODULES_DIR . "/admin/vc-extends/*.php" ) as $filename


function perch_modules_get_vc_param_html( $param_name = '', $atts = array() ){

	$_atts = $atts;

    if( !isset($atts[$param_name]) || ($atts[$param_name] == '') ) return '';
    $output = $atts[$param_name];

    $output = apply_filters('perch_modules_text_filter', $output, $param_name, $_atts);


    $font_container = $param_name.'_font_container';
    if( isset($atts[$font_container])  && ($atts[$font_container] != '')){       
        $typo_settings =  perch_modules_get_vc_typography_value($atts[$font_container], $param_name, $_atts);
        extract($typo_settings);
        if( '' == $inner_tag ){
            $output = "<{$tag}{$all_classes}{$inline_css}>{$output}</{$tag}>";
        }else{
            $output = "<{$tag}{$all_classes}{$inline_css}><{$inner_tag}>{$output}</{$inner_tag}></{$tag}>";
        }
        
    }
    


    return $output;
}

function perch_modules_highlight_text($output, $param_name, $atts){
	
	$field_id = $param_name. '_highlight_text_enable';
    if( !isset($atts[$field_id]) ) return $output;
    
	if( ('' != $param_name) && ( 'yes' == $atts[$field_id] ) ){
		$key = $param_name. '_highlight_text';
		if( isset($atts[$key])  && ($atts[$key] != '')){
			$args = perch_modules_get_vc_typography_value($atts[$key], $param_name, $atts);
			$output = perch_modules_parse_text($output, $args);
		}
	}

	return $output;
}
add_filter( 'perch_modules_text_filter', 'perch_modules_highlight_text', 10, 3 );

function perch_modules_vc_class_filter( $classes, $field_id , $atts){
        $array = array( $classes );

        $font_container = $field_id.'_font_container';
        if( isset($atts[$font_container])  && ($atts[$font_container] != '')){
          $_arr = perch_modules_get_vc_typography_atts($atts[$font_container], $field_id, $atts);  
          $array[] = $_arr[ 'all_classes' ];
        } 
        

        $array = array_filter($array);
        return implode(' ', $array);

}
add_filter( 'perch_vc_class_filter', 'perch_modules_vc_class_filter', 10, 3 );


function perch_modules_vc_inline_css_filter( $output, $field_id , $atts){
        $array = array( $output );

        $font_container = $field_id.'_font_container';
        if( isset($atts[$font_container])  && ($atts[$font_container] != '')){
          $_arr = perch_modules_get_vc_typography_atts($atts[$font_container], $field_id, $atts);  
          $array[] = $_arr[ 'inline_css' ];
        } 
        

        $array = array_filter($array);

        if(!empty($array)){
          return ' style="'.implode(' ', $array).'"';
        }

}
add_filter( 'perch_vc_inline_css_filter', 'perch_modules_vc_inline_css_filter', 10, 3 );

/**
* Get size information for all currently-registered image sizes.
*
* @global $_wp_additional_image_sizes
* @uses   get_intermediate_image_sizes()
* @return array $sizes Data for all currently-registered image sizes.
*/
function perch_get_image_sizes( ) {
    global $_wp_additional_image_sizes;
    $sizes = array( );
    foreach ( get_intermediate_image_sizes() as $_size ) {
        if ( in_array( $_size, array(
             'thumbnail',
            'medium',
            'medium_large',
            'large',
            'full' 
        ) ) ) {
            $sizes[ $_size ][ 'width' ]  = get_option( "{$_size}_size_w" );
            $sizes[ $_size ][ 'height' ] = get_option( "{$_size}_size_h" );
            $sizes[ $_size ][ 'crop' ]   = (bool) get_option( "{$_size}_crop" );
        } //in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) )
        elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array(
                 'width' => $_wp_additional_image_sizes[ $_size ][ 'width' ],
                'height' => $_wp_additional_image_sizes[ $_size ][ 'height' ],
                'crop' => $_wp_additional_image_sizes[ $_size ][ 'crop' ] 
            );
        } //isset( $_wp_additional_image_sizes[ $_size ] )
    } //get_intermediate_image_sizes() as $_size
    return $sizes;
}
function perch_get_image_sizes_Arr( ) {
    $sizes = perch_get_image_sizes();
    $arr   = array( );
    foreach ( $sizes as $key => $value ) {
        $arr[ $key ] = $key . ' - ' . $value[ 'width' ] . 'X' . $value[ 'height' ] . ' - ' . ( ( $value[ 'crop' ] ) ? 'Cropped' : '' );
    } //$sizes as $key => $value
    return $arr;
}

function perch_default_color_classes(){
  $array = array(
    'tra' => array('label' => 'Transparent color', 'value' => 'transparent' ),
    'light' => array('label' => 'Light color', 'value' => '#fff' ),
    'white' => array('label' => 'White color', 'value' => '#fff' ),   
    'black' => array('label' => 'Black color', 'value' => '#333' ),   
    'preset' => array('label' => 'Preset color', 'value' => '#389bf2'), 
    'preset2' => array('label' => 'Preset color 2', 'value' => '#389bf2'), 
    'dark' => array('label' => 'Dark color', 'value' => '#222', 'color' => '#000' ),
    'lightdark' => array('label' => 'Dark color - Light', 'value' => '#252d35'),
    'deepdark' => array('label' => 'Dark color - Deep', 'value' => '#1a1a1a'),
    'lightgrey' => array('label' => 'Grey color - Light', 'value' => '#f2f2f2', 'color' => '#ccc'),
    'grey' => array('label' => 'Grey color', 'value' => '#ede9e6', 'color' => '#666'),
    'deepgrey' => array('label' => 'Grey color - Deep', 'value' => '#ddd'),
    'rose' => array('label' => 'Rose color', 'value' => '#ff3366'),    
    'red' => array('label' => 'Red color', 'value' => '#e35029'),
    'tomato' => array('label' => 'Tomato color', 'value' => '#eb2f5b'),
    'coral' => array('label' => 'Red color - Coral', 'value' => '#ea5c5a'),
    'yellow' => array('label' => 'Yellow color', 'value' => '#fed841', 'color' => '#fcb80b'),    
    'green' => array('label' => 'Green color', 'value' => '#42a045', 'color' => '#56a959'),
    'lightgreen' => array('label' => 'Green color - Light', 'value' => '#59BD56', 'color' => '#22bc3f'),
    'deepgreen' => array('label' => 'Green color - Deep', 'value' => '#009587'),
    'blue' => array('label' => 'Blue color', 'value' => '#2154cf', 'color' => '#3176ed'),
    'lightblue' => array('label' => 'Blue color - Light', 'value' => '#1e88e5'),
    'skyblue' => array('label' => 'Blue color - Skyblue', 'value' => '#01b7de'),
    'deepblue' => array('label' => 'Blue color - Deep', 'value' => '#004861'),
    'tinyblue' => array('label' => 'Blue color - Tiny', 'value' => '#e6f9fa'),
    'purple' => array('label' => 'Purple color', 'value' => '#6e45e2'),
    'deeppurple' => array('label' => 'Purple color - Deep', 'value' => '#510fa7', 'color' => '#004861'),
    'lightpurple' => array('label' => 'Purple color - Light', 'value' => '#715fef'),
  );
  return apply_filters( 'perch_default_color_classes', $array);
}

function perch_vc_global_color_options(){
    $arr = array();

    $colors = perch_default_color_classes();
    foreach ($colors as $key => $value) {
        $color_name = $value['label'];
        $color_class = $key;
        $arr[$color_name] = $color_class;
    }

    return $arr;
}

if( !function_exists('perch_target_param_list') ):
function perch_target_param_list() {
    return array(
        __( 'Same window', 'perch' ) => '_self',
        __( 'New window', 'perch' ) => '_blank',
    );
}
endif;

function perch_shortcodes_vc_class(){
    return apply_filters( 'perch_modules/vc_class', 'perch-vc' );
}

function perch_shortcodes_vc_category(){
    return apply_filters( 'perch_modules/vc_category', 'Perch' );
}
function perch_modules_shortcode_classes($atts, $base){
    $css_class = $mtop = $mbottom = $pleft = $pright = $el_class = $el_id = $align = $display_as = $css_animation = '';
    extract($atts);
    $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, perch_shortcode_custom_css_class( $css, ' ' ), $base , $atts );
    

    $classes = array(             
            $css_class,
            $mtop, 
            $mbottom,
            $pleft,  
            $pright,
            PerchVcMap::getExtraClass( $el_class ), 
            PerchVcMap::getCSSAnimation( $css_animation, $atts ),
            // custom class
            $align,
            $display_as,
        );       
    $classes = array_filter($classes);
    $classes = array_unique($classes);

    return $classes;    
}

function perch_modules_shortcode_wrapper_attributes($atts, $base){
    $classes = perch_modules_shortcode_classes($atts, $base );
    extract($atts);
    $wrapper_attributes = array();
        if ( ! empty( $el_id ) ) {
            $wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
        }
    $wrapper_attributes[] = (!empty($classes))?'class="'.trim(implode(' ', $classes)).'"' : '';
    $wrapper_attributes = array_filter($wrapper_attributes);

    $wrapper_attributes = apply_filters( 'perch_modules/wrapper_attributes', $wrapper_attributes, $atts);

    return $wrapper_attributes;    
}
function perch_shortcode_custom_css_class( $param_value, $prefix = '' ) {
    $css_class = preg_match( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', $param_value ) ? $prefix . preg_replace( '/\s*\.([^\{]+)\s*\{\s*([^\}]+)\s*\}\s*/', '$1', $param_value ) : '';

    return $css_class;
}