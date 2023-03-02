<?php
/**
* Modified vc element base
*
* @since 1.2
* @return array
*/
function pergo_modified_element_base(){
    $array = array( 
        'pergo_slide_item', 
        'pergo_hero_slide',
        'pergo_service_box', 
        'pergo_hero_startup', 
        'pergo_hero_web_design_agency', 
        'pergo_hero_business_agency',  
        'pergo_hero_startup1',  
        'pergo_hero_business_consultancy',  
        'pergo_hero_app_showcase',  
        'pergo_hero_freelancer1',  
        'pergo_hero_marketing_agency',  
        'pergo_hero_creative_business',  
        'pergo_hero_digital_agency',  
        'pergo_hero_branding_agency',  
        'pergo_hero_freelancer2',  
        'pergo_hero_startup2',  
        'pergo_hero_classic_business',  
        'pergo_hero_medical_health',  
        'pergo_inner_content', 
        'pergo_bring_ideas',
        'pergo_card_box', 
        'pergo_discount_banner',
        'pergo_our_skills',
        'pergo_faq'        
    );

    return apply_filters( 'pergo_modified_element_base', $array );
}

/**
* Set typogography options
*
* @since 1.2
* @return array
*/
function pergo_add_param_typography_options(){
    $array = array( 'title', 'subtitle', 'sub_title', 'lead_text', 'name' );   

    return apply_filters( 'pergo_param_add_typography_options', $array );
}


/**
* Additional params typography options
*
* @since 1.2
* @return array
*/
add_filter( 'pergo_vc_map_filter', 'pergo_vc_elements_param_extention', 11, 2 );
function pergo_vc_elements_param_extention( $args, $base ){
    $elementArr = pergo_modified_element_base();
    $paramsArr = pergo_add_param_typography_options();

   if( in_array($base, $elementArr) ){
        $params = $args['params'];        

        foreach ($paramsArr as $field_id) {           
            if(pergo_is_field_id_exists($params, $field_id)):
            $params = pergo_vc_param_typography_extention($params, $base, $field_id);       
            endif;
        }
        
        $params = array_filter($params);
       
       $args['params'] = $params;
       
   }

    return $args;
}

/**
* Set params weight
*
* @since 1.2
* @param array
* @return array
*/
function pergo_set_param_weight($args){
    $weight = 200;
    $new_args = array();
    $typoParams = pergo_add_param_typography_options();
    foreach ($args as $key => $value) {
        $value[ 'weight' ] = $weight;

        if( in_array($value['param_name'], $typoParams) ){
            $description = (isset($value['description']) && ('' != $value['description'])) ? $value['description'] . '<br>' : '';
            $_description = __( 'Typography options available', 'pergo' );
            $value[ 'description' ] = $description . $_description;
        }       
        $new_args[] = $value;
        
        $weight = $weight - 10;
    }

    return $new_args;
}


/**
* get param array
*
* @since 1.2
* @return array
*/
function pergo_get_param_array( $params, $param_name, $key = 'param_name' ){

     $arrKey = array_search($param_name, array_column($params, $key));
     if($params[$arrKey]['param_name'] == $param_name){         
         return $params[$arrKey];
     }else{
        return false;
     }
}
/**
* is param_name exists in params
* @param array, string, string(optional)
*
* @since 1.2
* @return array
*/
function pergo_is_field_id_exists($params, $param_name, $key = 'param_name'){
    $arrKey = array_search($param_name, array_column($params, $key));
     if( isset($params[$arrKey]['param_name']) && ($params[$arrKey]['param_name'] == $param_name)){         
         return true;
     }else{
        return false;
     }
}

/**
* Typography options for params element
* @param array, string, string
*
* @since 1.2
* @return array
*/
function pergo_vc_param_typography_extention( $params, $base, $field_id ){  
    $param = pergo_get_param_array($params, $field_id);
    $heading = $param['heading'];
        
    $params[] =  PerchVcMap::_vc_param_enable_highlight_text( $field_id, $heading ); 
    $params[] =  PerchVcMap::_vc_highlight_text_typography( $field_id, $heading );           
    $params[] =  PerchVcMap::_vc_param_typography( $field_id, $heading );

    //$params[] =  PerchVcMap::_vc_param_enable_google_fonts( $field_id, $heading );
    //$params[] =  PerchVcMap::_vc_param_custom_google_fonts( $field_id, $heading );            
          
    
    $params = array_filter($params);
  
    return $params;    
}



add_filter( 'perch/vc_param_enable_highlight_text', 'pergo_param_enable_highlight_text', 10, 1 );
function pergo_param_enable_highlight_text( $args ){
    $args['edit_field_class'] = 'vc_col-sm-6';
    return $args;
}
add_filter( 'perch_vc_typography_fields_column', 'pergo_vc_typography_fields_column', 10, 2 );
function pergo_vc_typography_fields_column( $column, $field_id ){
    if( $field_id == 'title' ){
        $column = 3;
    }else{
        $column = 4;
    }
    return intval($column);
}

add_filter( 'perch_vc_typography_std', 'pergo_vc_typography_std', 10, 2 );
function pergo_vc_typography_std( $std, $field_id ){
    if( $field_id == 'title' ){
        $std = '';
    }else{
        $std = 'tag:p';
    }
    return $std;
}

add_filter( 'perch_vc_typography_fields', 'pergo_perch_vc_typography_fields', 10, 2 );
function pergo_perch_vc_typography_fields( $fields, $field_id ){
    if( $field_id == 'title' ){
    $fields = array(
                'tag',              
                'size',              
                'text_color',              
                'text_underline',
                'extra_class',
                // inline css
                'font_family',
                'font_size',
                'font_style',
                'font_size',
                'text_transform',
                'text_decoration',            
                'font_variant',
                'font_weight',
                'letter_spacing',           
                'line_height',
            );
    }

    if( ($field_id == 'subtitle') || ($field_id == 'sub_title')  || ($field_id == 'lead_text') ){
    $fields = array(  
                'tag',              
                'size',             
                'text_color', 
                'size',             
                'text_underline',
                'extra_class',
                // inline css
                'font_family',
                'font_size',
                'font_style',
                'font_size',
                'text_transform',
                'text_decoration',            
                'font_variant',
                'font_weight',
                'letter_spacing',           
                'line_height',
            );
    }
    return $fields;
}

add_filter( 'perch/vc_param_enable_highlight_text', 'pergo_vc_param_enable_highlight_text' );
function pergo_vc_param_enable_highlight_text( $args ){
    $args['std'] = 'yes';
    return $args;
}

/*
* @since 1.3
* @return mixed html
*/

add_filter( 'pergo_add_link_filter', 'pergo_add_link_in_vc_element', 10, 3 );
add_filter( 'perch_modules_text_filter', 'pergo_add_link_in_vc_element', 10, 3 );
function pergo_add_link_in_vc_element( $value, $field_id, $atts ){
    $args = array( 
        'title' => '', 
        'url' => '', 
        'target' => '',
        'link_title' => $value 
    );    
    $enable_id = $field_id.'_link';

    if( isset($atts[$enable_id]) && ($atts[$enable_id] == 'yes') ){
        $link_id = $field_id.'_url';
        $href = vc_build_link( $atts[$link_id] );        
        $link_atts = shortcode_atts($args , $href);
        $value = pergo_build_safe_link($link_atts);
    }

    return $value;
}

/*
*
* @param array('title'=>'', 'url' => '', 'target' => '', 'link_title' => $link_title)
*
* @since 1.3
* @return mixed html
*/
function pergo_build_safe_link( $args = array() ){
   
    if( empty($args) ) return false;
    extract($args);

    if($link_title == '') return false;
    if( $url == '' ) return $link_title;

    $atts = array();
    $atts[] = 'href="'.esc_url($url).'"';
    $atts[] = ( $title != '' )? 'title="'.esc_attr($title).'"' : '';   
    $atts[] = ( $target != '' )? 'target="'.esc_attr($target).'"' : '';
    $atts = array_filter($atts);

    $output = '<a '.implode(' ', $atts).'>'.$link_title.'</a>';

    return $output;

}

function pergo_vc_map_carousel_options(){
    return array(
        array(
                'type' => 'dropdown',
                'heading' => __( 'Large screen column', 'pergo' ),
                'param_name' => 'column_lg',
                'std' => '',
                'value' => array(                    
                    'Default' => '',
                    'Single item' => '1',
                    '2 column' => '2',
                    '3 column' => '3',
                    '4 column' => '4',
                    '5 column' => '5',
                    '6 column' => '6',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Medium screen column', 'pergo' ),
                'param_name' => 'column_md',
                'std' => '',
                'value' => array(
                    'Default' => '',
                    'Single item' => '1',
                    '2 column' => '2',
                    '3 column' => '3',
                    '4 column' => '4',
                    '5 column' => '5',
                    '6 column' => '6',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),            
            array(
                'type' => 'dropdown',
                'heading' => __( 'Autoplay', 'pergo' ),
                'param_name' => 'autoplay',
                'std' => '',
                'value' => array(
                    'Default' => '',
                    'Yes' => '1',
                    'No' => '0',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Loop', 'pergo' ),
                'param_name' => 'loop',
                'std' => '',
                'value' => array(
                    'Default' => '',
                    'Yes' => '1',
                    'No' => '0',
                ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
        );
}
add_filter( 'pergo_vc_map_carousel_settings', 'pergo_vc_map_carousel_settings', 10, 2 );
function pergo_vc_map_carousel_settings($args, $base){
    $params = $args['params'];
   $new_params = pergo_vc_map_carousel_options();

   $args['params'] = array_merge($params, $new_params) ;


    return $args;
}

add_filter( 'pergo_carousel_attr', 'pergo_carousel_attr', 10, 2 );
function pergo_carousel_attr($output, $atts){
    $car_attr = array();
    $car_options = pergo_vc_map_carousel_options();
    foreach ($car_options as $key => $param) {
        extract($param);
        $car_attr[] = ($atts[$param_name] != '')? 'data-'.$param_name.'='.$atts[$param_name] : '';
    }
    $car_attr = array_filter($car_attr);
    if(!empty($car_attr)){        
        return ' '.implode(' ', $car_attr);
    }
}

/**
* developer pre print
*/
if( !function_exists('pergo_print') ):
function pergo_print($array = array()){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
endif;