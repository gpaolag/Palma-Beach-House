<?php
if( !function_exists('pergo_hex2rgb') ):
function pergo_hex2rgb( $color, $opacity='1' ) {
  $color = trim( $color, '#' );

  if ( strlen( $color ) == 3 ) {
    $r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
    $g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
    $b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
  } else if ( strlen( $color ) == 6 ) {
    $r = hexdec( substr( $color, 0, 2 ) );
    $g = hexdec( substr( $color, 2, 2 ) );
    $b = hexdec( substr( $color, 4, 2 ) );
  } else {
    return '';
  }
  if(!$opacity){
    return "{$r}, {$g}, {$b}";
  }else{
    return "rgba( {$r}, {$g}, {$b}, {$opacity} )";
  }
  
}
endif;

if( !function_exists('pergo_compress') ):
function pergo_compress($buffer) {
    //Remove CSS comments
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    //Remove tabs, spaces, newlines, etc.
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    return $buffer;
}
endif;

function pergo_background_css($option_id, $selector = '') {
    $background = ot_get_option($option_id, array());
    $output     = pergo__background_css($background, $selector);
    
    return $output;
}

function pergo__background_css($background = array(), $selector = '') {
    $output = '';
    $properties = '';
    if ( is_array($background) && !empty($background)) {
        foreach ($background as $key => $value) :
            if( $value != '' ):                
            switch (str_replace('background-', '', $key)) {
                case 'color':
                    $properties .= 'background-color:' . $value . ';';
                    break;
                case 'image':
                    $properties .= 'background-image:url(' . esc_url($value) . ');';
                    break; 
                case 'repeat':
                    $properties .= 'background-repeat:' . esc_attr($value) . ';';
                    break;
                case 'attachment':
                    $properties .= 'background-attachment:' . esc_attr($value) . ';';
                    break;
                case 'position':
                    $properties .= 'background-position:' . esc_attr($value) . ';';
                    break;
                case 'size':
                    $properties .= 'background-size:' . esc_attr($value) . ';';
                    break;
                case 'clip':
                    $properties .= 'background-clip:' . esc_attr($value) . ';';
                    break;
                case 'origin':
                    $properties .= 'background-origin:' . esc_attr($value) . ';';
                    break;
            }
            endif;
        endforeach;
    
        $output .= ($properties != '')?"\n" . esc_attr($selector) . ' { ' . $properties . '}' . "\n" : '';
    }
    return $output;
}

function pergo_spacing_option( $option_id ){
  $spacing = ot_get_option( $option_id, array() );
  if(!empty($spacing)){
      $unit = (isset($spacing['unit']) && ($spacing['unit'] != ''))? $spacing['unit'] : 'px';
      return (isset($spacing['top'])? $spacing['top'].$unit : 0).' '.(isset($spacing['right'])? $spacing['right'].$unit : 0).' '.(isset($spacing['bottom'])? $spacing['bottom'].$unit : 0).' '.(isset($spacing['left'])? $spacing['left'].$unit : 0);
  }else{
    return '';
  } 
  
}

function pergo_typography_css($option_id){
    $typography = ot_get_option( $option_id, array() );
    $css = '';
    if(!empty($typography) && is_array($typography)) :       
                
        foreach ($typography as $key => $value) {

            if( ($key == 'font-color') && ($value != '') ) $css .= 'color: '.$value.'; ';
            elseif( $key == 'font-family' ){
                if($value != ''){
                    $ot_set_google_fonts  = get_theme_mod( 'ot_google_fonts', array() );

                    $default = array(
                        'roboto'     => 'Roboto',
                        'montserrat'     => 'Montserrat',
                        'arial'     => 'Arial',
                        'georgia'   => 'Georgia',
                        'helvetica' => 'Helvetica',
                        'palatino'  => 'Palatino',
                        'tahoma'    => 'Tahoma',
                        'times'     => '"Times New Roman"',
                        'trebuchet' => 'Trebuchet',
                        'verdana'   => 'Verdana'
                      );

                    $default = apply_filters( 'pergo/recognized_font_families', $default );
                    $family = isset($ot_set_google_fonts[$value])? $ot_set_google_fonts[$value]['family'] : '';
                    $family = (($family == '') && isset($default[$value]))? $default[$value]. ';' : $family;

                    $css .= ($family != '')? 'font-family: '.$family.'; ' : '';
                }
                
            } 
            else
              $css .= ( ($key != 'font-family') && ($value != '') )? $key. ': '.$value.'; ' : '';
        }

    endif;

    return $css;
}

/**
 * Returns CSS for the color schemes.
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function pergo_get_dynamic_header_css() {
  $primary_color = ot_get_option('primary_color', apply_filters( 'pergo_primary_color', '#ff3366'));
	$css = '';
  
  $default_header_bg = array(
        'background-color' => '',
        'background-attachment' => 'fixed',
        'background-image' => ot_get_option('header_bg_img', PergoHeader::get_default_header_image()),
        'background-size' => 'cover'
    ); 
  $header_bg = apply_filters( 'pergo_header_image_url', $default_header_bg ); 
  $css .= pergo__background_css($header_bg, '#blog-listing-hero', true );
  $css .= pergo_background_css('body_background', 'body' );
  $css .= pergo_background_css('footer_background', '#footer-1' );


  $arr = ot_get_option( 'container_width', array( '1140',  'px' ) );
  $css .= '@media (min-width: 1200px) { .container {  max-width: '.esc_attr($arr[0]).esc_attr($arr[1]).'; } }';

  $logo_height = ot_get_option('logo_height', array('36', 'px'));  
  if(is_page_template('templates/onepage-template.php')){
      $newval = get_post_meta( get_the_ID(), 'logo_height', true );
      $logo_height = ( !empty($newval) )? $newval : $logo_height;
  } 

  $css .= '.navbar-brand img{ max-height: '.implode('', $logo_height).' }';

  $overlay_opacity = ot_get_option('overlay_opacity', 0);

  $overlay_type = apply_filters( 'pergo_breadcrumbs_overlay_type', 'light');
  $overlay_type = ot_get_option( 'breadcrumbs_overlay_type', $overlay_type);
  $color = pergo_hex2rgb( '#000', false );
  if( $overlay_type == 'light' ){
    $color = pergo_hex2rgb( '#fff', false );
  }
  if( $overlay_type == 'rose' ){
    $color = pergo_hex2rgb( $primary_color, false );
  }
  $css .= '.breadcrumbs-area{ box-shadow: 0px 1000px rgba('.esc_attr($color).', 0.'.intval($overlay_opacity).') inset; }';

  /* primary color */


  $css .= '/* color */ 
  body{ '.pergo_typography_css( 'primary_font' ).' }
  h1, h2, h3, h4, h5, h6 { '.pergo_typography_css( 'secondary_font' ).' }
body{
  '.pergo_typography_css('body').'
} 
.navbar-expand-lg .navbar-nav .nav-link{'.pergo_typography_css('menu_a').'}
.navbar-expand-lg .navbar-nav .dropdown-menu a,
.navbar-expand-lg .navbar-nav .sub-menu a{'.pergo_typography_css('submenu_a').'}
h1{
  '.pergo_typography_css('h1').'
}
h2{
'.pergo_typography_css('h2').'
}
h3{
'.pergo_typography_css('h3').'
}
h4{
'.pergo_typography_css('h4').'
}
h5{
'.pergo_typography_css('h5').'
}
h6{
'.pergo_typography_css('h6').'
}
.widget-area h5.h5-sm{
    '.pergo_typography_css('sidebar_title').'
}
footer, .footer-copyright p{
    '.pergo_typography_css('footer').'
}
  ';

  
  $css .= pergo_background_css('preloader_bg', '#loader-wrapper');
	return pergo_compress($css);
}



/**
 * Output an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the Customizer
 * preview.
 *
 */
function pergo_color_scheme_css() {	
	wp_add_inline_style( 'pergo-style', pergo_get_dynamic_header_css() );	
  wp_add_inline_style( 'pergo-default-style', pergo_dynamic_general_style_css() );
  wp_add_inline_style( 'bootstrap', pergo_bootstrap_style_css() );
  if(function_exists('is_woocommerce')){
    wp_add_inline_style( 'woocommerce-general', pergo_woocommerce_general_style_css() );
  }
}
add_action( 'wp_enqueue_scripts', 'pergo_color_scheme_css' );
