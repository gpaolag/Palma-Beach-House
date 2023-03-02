<?php

/*
Element Description: VC Title area
*/
 
// Element Class 
class PerchVcTitleMap extends WPBakeryShortCode {
     
    // Element Init
    function __construct() {
        add_action( 'init', array( $this, 'vc_title_mapping' ) );
        add_filter( 'perch/title_map_args', array( $this, 'title_map_default_values') );


        add_filter( 'perch_vc_title', array( $this, 'vc_title_html' ), 30, 2 ); 
        add_filter( 'perch_vc_title_slide', array( $this, 'vc_title_slide_html' ), 30, 2 ); 
    }

    // Element Mapping
    public function vc_title_mapping( $return = false ) {
         
        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        $params = $this->title_map_args();  
        $params = apply_filters( 'perch/title_map_args', $params ); 
        if($return) {
            return $params;  
        }
       
       $vc_map_array = array(
                'class' => 'perch-vc',
                'name' => __('Title area', 'landpick'),
                'base' => 'perch_vc_title',
                'description' => __('Display title & subtitle', 'landpick'), 
                'category' => __('Landpick', 'landpick'),   
                'icon' => PERCH_MODULES_DIR.'/images/app-logo-2.png',            
                'params' => $params,
                'js_view' => 'PerchVcElementPreview',
                'custom_markup' => '<div class="perch_vc_element_container">{{title}}</div>',        
            );

       $vc_map_array = apply_filters( 'perch/vc_map_array', $vc_map_array );
        // Map the block with vc_map()
        vc_map( $vc_map_array );    

        $vc_map_array = array(
                'class' => 'perch-vc',
                'name' => __('Title area', 'landpick'),
                'base' => 'perch_vc_title_slide',
                'description' => __('Display title & subtitle', 'landpick'), 
                'category' => __('Landpick', 'landpick'), 
                'as_child'  => array('only' => 'perch_vc_carousel'),   
                'icon' => PERCH_MODULES_DIR.'/images/app-logo-2.png',            
                'params' => $params,
                'js_view' => 'PerchVcElementPreview',
                'custom_markup' => '<div class="perch_vc_element_container">{{title}}</div>',        
            );
        vc_map( $vc_map_array );    


        
    }

    // Title element mapping
    public function title_map_args(){
        
        $array = PerchVcMap::element_align_args();                       
        $array = array_merge($array, PerchVcMap::_vc_map_input_field_group('title', 'Title'));
        $array = array_merge($array, PerchVcMap::_vc_map_input_field_group('subtitle', 'Sub-Title', true));
        $array = array_merge($array, PerchVcMap::element_common_args());

        

        return $array;
    } 
     
     
    // Element HTML
    public function vc_title_html( $atts, $content = NULL ) {
        $map_arr = $this->vc_title_mapping(true);
        $args = PerchVcMap::get_vc_element_atts_array($map_arr, $content); 

        // Params extraction
        $atts = shortcode_atts( $args, $atts );
        extract( $atts );    

       $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );


        $classes = array(             
                $css_class, 
                $mtop, 
                $mbottom,
                $pleft,  
                $pright,
                $this->getExtraClass( $el_class ), 
                $this->getCSSAnimation( $css_animation ),
                // custom class
                $align,
                $display_as,
            );       
        $classes = array_filter($classes);
        $classes = array_unique($classes);


      
        $wrapper_attributes = array();
        if ( ! empty( $el_id ) ) {
            $wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
        }
        $wrapper_attributes[] = (!empty($classes))?'class="'.implode(' ', $classes).'"' : '';
        $wrapper_attributes = array_filter($wrapper_attributes);
      
        // Fill $html var with data
        $html ='
        <div '. implode( ' ', $wrapper_attributes ).'>            
            '.perch_modules_get_vc_param_html('title', $atts ).'
            '.perch_modules_get_vc_param_html('subtitle', $atts ).'         
        </div>';      
         
        return wpb_js_remove_wpautop($html);
         
    }

    public function vc_title_slide_html( $atts, $content = NULL ) {
        $map_arr = $this->title_map_args();
        $args = PerchVcMap::get_vc_element_atts_array($map_arr, $content); 

        // Params extraction
        $atts = shortcode_atts( $args, $atts );

        $html ='<div class="perch-slide-item">';
        $html .= $this->vc_title_html($atts);
        $html .='</div>';

        return $html;
    }
    
    public function title_map_default_values($arr){

       $array = array(
            'name' => 'Welcome to Appset',
            'name_font_container' => 'tag:span|text_color:preset-color|extra_class:section-id',
            'title' => 'We bring the best design for you',
            'title_font_container' => 'tag:h3|size:lg',
            'subtitle' => 'An orci nullam tempor sapien, eget orci gravida donec enim ipsum porta justo integer at odio velna auctor. Magna undo ipsum vitae purus ipsum primis in laoreet augue lectus',
            'subtitle_font_container' => 'tag:p|size:md',
        );

        foreach ($array as $key => $value) {
            $arrKey = array_search($key, array_column($arr, 'param_name'));
            if( isset($arr[$arrKey]['value']) && is_array($arr[$arrKey]['value']) ){
                $arr[$arrKey]['std'] = $value;
            }else{
                if($arr[$arrKey]['type'] == 'perch_vc_typography'){
                    $arr[$arrKey]['std'] = $value;
                }else{
                    $arr[$arrKey]['value'] = $value;
                }
                
            }
        }

        return $arr;
    }
     
} // End Element Class
 
 
// Element Class Init
new PerchVcTitleMap();