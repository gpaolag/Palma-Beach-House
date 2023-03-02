<?php

function pergo_set_default_vc_values($default, $args){

    $params = $args['params'];
    
    foreach ($default as $key => $value) {
        $arrKey = array_search($key, array_column($params, 'param_name'));
        if( !is_array($value) ){
            if( isset($params[$arrKey]['value']) && is_array($params[$arrKey]['value']) ){
                $params[$arrKey]['std'] = $value;
            }elseif( isset($params[$arrKey]['settings']) && is_array($params[$arrKey]['settings']) ){
                $params[$arrKey]['std'] = $value;
            }else{
                $params[$arrKey]['value'] = $value;
            }
        }else{
            $params[$arrKey] = array_merge($params[$arrKey], $value );          
        }       
    }
    $args['params'] = $params;

    return $args;
}

/**
* vc_map default values
* @param string
* @param array
*
* @since 1.2
* @return mixed html
*/
function pergo_get_vc_param_html( $param_name = '', $atts = array(), $animation = '', $delay = 300 ){
    $all_classes = $inline_css = $tag = $output = $inner_tag = $animation_atts = '';

    if( !isset($atts[$param_name]) || ($atts[$param_name] == '') ) return '';
    $output = $atts[$param_name];
    $output = apply_filters('perch_modules_text_filter', $output, $param_name, $atts);

    

    $font_container = $param_name.'_font_container';
    if( isset($atts[$font_container])  && ($atts[$font_container] != '')){       
        $typo_settings =  pergo_get_vc_typography_value($atts[$font_container]);       
        extract($typo_settings);
        if( $animation != '' ){
            $animation_atts = ' data-animation="'.esc_attr($animation).'"';      
            $animation_atts .= ' data-animation-delay="'.intval($delay).'"';
            $all_classes .= ' animated'; 
        }

        $all_classes = ( $all_classes != '' )? ' class="'.esc_attr($all_classes).'"': '';
        if( '' == $inner_tag ){
            $output = "<{$tag}{$all_classes}{$animation_atts}{$inline_css}>{$output}</{$tag}>";
        }else{
            $output = "<{$tag}{$all_classes}{$animation_atts}{$inline_css}><{$inner_tag}>{$output}</{$inner_tag}></{$tag}>";
        }
        
    }
    


    return $output;
}


if( !function_exists('vc_get_shared') ):
/**
 * @param string $asset
 *
 * @return array|string
 */
function vc_get_shared( $asset = '' ) {
    switch ( $asset ) {
        case 'colors':
            return VcSharedLibrary::getColors();
            break;

        case 'colors-dashed':
            return VcSharedLibrary::getColorsDashed();
            break;

        case 'icons':
            return VcSharedLibrary::getIcons();
            break;

        case 'sizes':
            return VcSharedLibrary::getSizes();
            break;

        case 'button styles':
        case 'alert styles':
            return VcSharedLibrary::getButtonStyles();
            break;
        case 'message_box_styles':
            return VcSharedLibrary::getMessageBoxStyles();
            break;
        case 'cta styles':
            return VcSharedLibrary::getCtaStyles();
            break;

        case 'text align':
            return VcSharedLibrary::getTextAlign();
            break;

        case 'cta widths':
        case 'separator widths':
            return VcSharedLibrary::getElementWidths();
            break;

        case 'separator styles':
            return VcSharedLibrary::getSeparatorStyles();
            break;

        case 'separator border widths':
            return VcSharedLibrary::getBorderWidths();
            break;

        case 'single image styles':
            return VcSharedLibrary::getBoxStyles();
            break;

        case 'single image external styles':
            return VcSharedLibrary::getBoxStyles( array( 'default', 'round' ) );
            break;

        case 'toggle styles':
            return VcSharedLibrary::getToggleStyles();
            break;

        case 'animation styles':
            return VcSharedLibrary::getAnimationStyles();
            break;

        default:
            # code...
            break;
    }

    return '';
}
endif;

include PERGO_DIR . '/admin/vc-typography-field.php';
if ( function_exists( 'vc_set_as_theme' ) ):
    vc_set_as_theme( $disable_updater = false );
endif;
$dir = get_template_directory() . '/vc_templates';
vc_set_shortcodes_templates_dir( $dir );

function pergo_vc_hero_options(){
    $array = array(
        'Startup Agency', 
        'Design Studio', 
        'Web Design Agency', 
        'Business Agency', 
        'Startup 1',
        'Business Consultancy', 
        'Creative Agency', 
        'App Showcase', 
        'Innovation Agency', 
        'Freelancer 1',
        'Marketing Agency', 
        'Designer Portfolio', 
        'Creative Business', 
        'Digital Agency',
        'Branding Agency',
        'Freelancer 2',
        'Startup 2',
        'Classic Business',
        'Medical & Health',
        'Event & Conference',
        'E-Book',
        'Lawyer',
        'Construction',
        'Insurance',
        'Product Showcase',
        'Hosting',
        'eCourse',
        'Consulting',
        'Interior Design',
    );
    $new_arr = array();
    foreach ($array as $key => $value) {
        $new_arr["{$value}"] = 'hero-'.($key+1);
    }

    return $new_arr;
}


if ( !function_exists( 'pergo_get_posts_dropdown' ) ):
    function pergo_get_posts_dropdown( $args = array( ) ) {
        global $wpdb, $post;
        $dropdown  = array( );
        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $dropdown[ get_the_ID() ] = get_the_title();
            } //$the_query->have_posts()
        } //$the_query->have_posts()
        wp_reset_postdata();
        return $dropdown;
    }
endif;
if ( !function_exists( 'pergo_get_terms' ) ):
    function pergo_get_terms( $tax = 'category', $key = 'id' ) {
        $terms = array( );
        if ( !taxonomy_exists( $tax ) )
            return false;
        if ( $key === 'id' )
            foreach ( (array) get_terms( $tax, array(
                 'hide_empty' => false 
            ) ) as $term )
                $terms[ $term->term_id ] = $term->name;
        elseif ( $key === 'slug' )
            foreach ( (array) get_terms( $tax, array(
                 'hide_empty' => false 
            ) ) as $term )
                $terms[ $term->slug ] = $term->name;
        return $terms;
    }
endif;
if ( !function_exists( 'pergo_number_settings_field' ) ):
    function pergo_number_settings_field( $settings, $value ) {
        return '<div class="my_param_block">' . '<input name="' . esc_attr( $settings[ 'param_name' ] ) . '" class="wpb_vc_param_value wpb-textinput ' . esc_attr( $settings[ 'param_name' ] ) . ' ' . esc_attr( $settings[ 'type' ] ) . '_field" type="number" min="' . intval( $settings[ 'min' ] ) . '" max="' . intval( $settings[ 'max' ] ) . '" step="' . intval( $settings[ 'step' ] ) . '" value="' . esc_attr( $value ) . '" />' . '</div>'; // This is html markup that will be outputted in content elements edit form
    }
endif;
if ( !function_exists( 'pergo_vc_image_upload_settings_field' ) ):
    function pergo_vc_image_upload_settings_field( $settings, $value ) {
        return '<div class="pergo-upload-container">

      <input type="text" name="' . esc_attr( $settings[ 'param_name' ] ) . '" value="' . esc_url( $value ) . '" class="wpb_vc_param_value wpb-textinput perch-generator-attr perch-generator-upload-value" />

      <a href="javascript:;" class="button pergo-upload-button"><span class="wp-media-buttons-icon"></span>' . esc_attr( __( 'Media manager', 'pergo' ) ) . '</a>

      <img width="80" src="' . esc_url( $value ) . '" alt="">     

    </div>';
    }
endif;
if ( !function_exists( 'pergo_perch_select_settings_field' ) ):
    function pergo_perch_select_settings_field( $args, $value ) {
        $selected = is_array( $value ) ? $value : explode( ',', $value );
        $args     = wp_parse_args( $args, array(
             'param_name' => '',
            'heading' => '',
            'class' => 'wpb_vc_param_value wpb-input wpb-select dropdown',
            'multiple' => '',
            'size' => '',
            'disabled' => '',
            'selected' => $selected,
            'none' => '',
            'value' => array( ),
            'style' => '',
            'format' => 'keyval', // keyval/idtext
            'noselect' => '' // return options without <select> tag
        ) );
        $options  = array( );
        if ( !is_array( $args[ 'value' ] ) )
            $args[ 'value' ] = array( );
        if ( $args[ 'param_name' ] )
            $name = ' name="' . $args[ 'param_name' ] . '"';
        if ( $args[ 'param_name' ] )
            $args[ 'param_name' ] = ' id="' . $args[ 'param_name' ] . '"';
        if ( $args[ 'class' ] )
            $args[ 'class' ] = ' class="' . $args[ 'class' ] . '"';
        if ( $args[ 'style' ] )
            $args[ 'style' ] = ' style="' . esc_attr( $args[ 'style' ] ) . '"';
        if ( $args[ 'multiple' ] )
            $args[ 'multiple' ] = ' multiple="multiple"';
        if ( $args[ 'disabled' ] )
            $args[ 'disabled' ] = ' disabled="disabled"';
        if ( $args[ 'size' ] )
            $args[ 'size' ] = ' size="' . $args[ 'size' ] . '"';
        if ( $args[ 'none' ] && $args[ 'format' ] === 'keyval' )
            $args[ 'options' ][ 0 ] = $args[ 'none' ];
        if ( $args[ 'none' ] && $args[ 'format' ] === 'idtext' )
            array_unshift( $args[ 'options' ], array(
                 'id' => '0',
                'text' => $args[ 'none' ] 
            ) );
        // keyval loop
        // $args['options'] = array(
        //   id => text,
        //   id => text
        // );
        if ( $args[ 'format' ] === 'keyval' )
            foreach ( $args[ 'value' ] as $id => $text ) {
                $options[ ] = '<option value="' . (string) $id . '">' . (string) $text . '</option>';
            } //$args[ 'value' ] as $id => $text
        // idtext loop
        // $args['options'] = array(
        //   array( id => id, text => text ),
        //   array( id => id, text => text )
        // );
        elseif ( $args[ 'format' ] === 'idtext' )
            foreach ( $args[ 'options' ] as $option ) {
                if ( isset( $option[ 'id' ] ) && isset( $option[ 'text' ] ) )
                    $options[ ] = '<option value="' . (string) $option[ 'id' ] . '">' . (string) $option[ 'text' ] . '</option>';
            } //$args[ 'options' ] as $option
        $options = implode( '', $options );
        if ( is_array( $args[ 'selected' ] ) ) {
            foreach ( $args[ 'selected' ] as $key => $value ) {
                $options = str_replace( 'value="' . $value . '"', 'value="' . $value . '" selected="selected"', $options );
            } //$args[ 'selected' ] as $key => $value
        } //is_array( $args[ 'selected' ] )
        else {
            $options = str_replace( 'value="' . $args[ 'selected' ] . '"', 'value="' . $args[ 'selected' ] . '" selected="selected"', $options );
        }
        $output = ( $args[ 'noselect' ] ) ? $options : '<select' . $name . $args[ 'param_name' ] . $args[ 'class' ] . $args[ 'multiple' ] . $args[ 'size' ] . $args[ 'disabled' ] . $args[ 'style' ] . '>' . $options . '</select>';
        // $output .= '<input type="hidden" '.$name.' value="'.$value.'">';
        return '<div class="perch_select_param_block">' . $output . '</div>';
    }
endif;

function pergo_vc_icontype_dropdown( $name = 'icon_type', $value = array( 'flaticon' => 'flaticon', 'Linecons' => 'linecons', 'Entypo' => 'entypo', 'Typicons' => 'typicons', 'Openiconic' => 'openiconic', 'Fontawesome' => 'fontawesome' ) ) {
    return array(
         'type' => 'dropdown',
        'heading' => __( 'Icon type', 'pergo' ),
        'param_name' => $name,
        'description' => '',
        'value' => $value 
    );
}
function pergo_vc_icon_set( $type, $name = 'icon_fontawesome', $value = '', $dependency = '' ) {
    $arr = array(
         'type' => 'iconpicker',
        'heading' => __( 'Icon', 'pergo' ),
        'param_name' => $name,
        'value' => $value,
        'settings' => array(
             'emptyIcon' => true,
            'type' => $type,
            'iconsPerPage' => 4000 
        ),
        'description' => __( 'Select icon from library.', 'pergo' ) 
    );
    if ( $dependency != '' ) {
        $arr[ 'dependency' ][ 'element' ] = $dependency;
        $arr[ 'dependency' ][ 'value' ]   = $type;
    } //$dependency != ''
    return $arr;
}

function pergo_vc_animation_duration( $label = true, $default = 300 ){
    return array(
                 'type' => 'textfield',
                'value' => intval($default),
                'heading' => __( 'Animation delay', 'pergo' ) ,
                'param_name' => 'animation_delay',
                'admin_label' => $label,
                'description' => __( 'Number only', 'pergo' ),    
            );
}

function pergo_vc_animation_type(){
    $output = vc_map_add_css_animation();
    $output['group'] = __( 'Animation', 'pergo' );

    return $output;
}

function pergo_animation_attr($css_animation, $animation_delay = 300){
    $output = '';
    if($css_animation == '') return $output;

    $output .= ' data-animation="'.$css_animation.'"';
    $output .= ' data-animation-delay="'.intval($animation_delay).'"';

    return $output;
}

function pergo_vc_counter_group(){
    return array(
        'type' => 'param_group',
        'save_always' => true,
        'heading' => __( 'Counter up', 'pergo' ),
        'param_name' => 'counter_group',
        'value' => urlencode( json_encode( array(
            array(
                 'title' => 'Happy Clients',
                'count' => '1154',
            ),
            array(
                 'title' => 'Tickets Closed',
                'count' => '409',
            ),
        ) ) ),
        'params' => array(
             array(
                 'type' => 'textfield',
                'heading' => __( 'Title', 'pergo' ),
                'param_name' => 'title',
                'description' => '',
                'value' => '',
                'admin_label' => true 
            ),
            array(
                 'type' => 'textfield',
                'heading' => __( 'Count', 'pergo' ),
                'param_name' => 'count',
                'description' => 'Number only',
                'value' => '' ,
                'admin_label' => true 
            ) 
        ),
        'dependency' => array(
            'element' => 'display',
            'value' => 'counter'
        ) 
    );
}

function pergo_vc_techs_group(){
    return array(
        'type' => 'param_group',
        'save_always' => true,
        'heading' => __( 'Techs', 'pergo' ),
        'param_name' => 'techs_group',
        'value' => urlencode( json_encode( array(
            array(
                 'title' => 'HTML5',
                'icon' => 'fa fa-html5',
                'image' => ''
            ),
            array(
                 'title' => 'CSS3',
                'icon' => 'fa fa-css3',
                'image' => ''
            ),
            array(
                 'title' => 'jsfiddle',
                'icon' => 'fa fa-jsfiddle',
                'image' => ''
            ),
            array(
                 'title' => 'git',
                'icon' => 'fa fa-git',
                'image' => ''
            ),
            array(
                 'title' => 'WordPress',
                'icon' => 'fa fa-wordpress',
                'image' => ''
            ),
            array(
                 'title' => 'mixcloud',
                'icon' => 'fa fa-mixcloud',
                'image' => ''
            ),
        ) ) ),
        'params' => array(
             array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'pergo' ),
                'param_name' => 'title',
                'description' => '',
                'value' => '',
                'admin_label' => true 
            ),
             pergo_vc_icon_set( 'fontawesome', 'icon' ),
             array(
                'type' => 'image_upload',
                'heading' => __( 'Icon Image', 'pergo' ),
                'param_name' => 'image',
                'description' => 'You can use image instead of Icon',
                'value' => '' 
            ),
        ),
        'dependency' => array(
            'element' => 'display',
            'value' => 'techs'
        ) 
    );
}

function pergo_vc_strategy_list_group(){
    return array(
            'type' => 'param_group',
            'save_always' => true,
            'heading' => __( 'Strategy list', 'pergo' ),
            'param_name' => 'strategy_list',
            'value' => urlencode( json_encode( array(
                array( 'title' => 'Fully Responsive Design' ),
                array( 'title' => 'Bootstrap 4.0 Based' ),
                array( 'title' => 'Google Analytics Ready' ),
                array( 'title' => 'Cross Browser Compatability' ),
                array( 'title' => 'Developer Friendly Commented Code' ),
                array( 'title' => 'and much more...' ),
            ) ) ),
            'params' => array(
                 array(
                    'type' => 'textfield',
                    'heading' => __( 'Title', 'pergo' ),
                    'param_name' => 'title',
                    'description' => '',
                    'value' => '',
                    'admin_label' => true 
                ),
            ),
            'dependency' => array(
                'element' => 'display',
                'value' => 'list'
            )  
        );
}

function pergo_vc_element_display_option(){
    return array(
                    'Counter' => 'counter',
                    'Techs' => 'techs',
                    'Strategy list' => 'list',
                );
}
function pergo_vc_heading_size_options(){
    $arr = array(
        __('H1 Normal', 'pergo') => 'h1:h1-normal',

        __('H2 Normal', 'pergo') => 'h2:h2-normal',
        __('H2 Huge', 'pergo') => 'h2:h2-huge',
        __('H2 extra large', 'pergo') => 'h2:h2-xl',
        __('H2 Large', 'pergo') => 'h2:h2-lg',
        __('H2 Medium', 'pergo') => 'h2:h2-md',
        __('H2 small', 'pergo') => 'h2:h2-sm',
        __('H2 Extra small', 'pergo') => 'h2:h2-xs',
        
        __('H3 Normal', 'pergo') => 'h3:h3-normal',
        __('H3 extra large', 'pergo') => 'h3:h3-xl',
        __('H3 Large', 'pergo') => 'h3:h3-lg',
        __('H3 Medium', 'pergo') => 'h3:h3-md',
        __('H3 small', 'pergo') => 'h3:h3-sm',
        __('H3 Extra small', 'pergo') => 'h3:h3-xs',

         __('H4 extra large') => 'h4:h4-xl',
        __('H4 Large', 'pergo') => 'h4:h4-lg',
        __('H4 Medium', 'pergo') => 'h4:h4-md',
        __('H4 small', 'pergo') => 'h4:h4-sm',
        __('H4 Extra small', 'pergo') => 'h4:h4-xs',

         __('H5 extra large', 'pergo') => 'h5:h5-xl',
        __('H5 Large', 'pergo') => 'h5:h5-lg',
        __('H5 Medium', 'pergo') => 'h5:h5-md',
        __('H5 small', 'pergo') => 'h5:h5-sm',
        __('H5 Extra small', 'pergo') => 'h5:h5-xs',
    );

    return $arr;
}

function pergo_vc_underline_color_options(){
    $arr = array(
        __('None', 'pergo') => 'none',
        __('Image', 'pergo') => 'underline-image',
         __('Font weight bold', 'pergo') => 'font-weight-bold',
         __('Italic text', 'pergo') => 'font-italic',
         __('Indicates uppercased text', 'pergo') => 'text-uppercase',
    );

    $colors = pergo_default_color_classes();
    foreach ($colors as $key => $value) {
        $color_name = $value['label'];
        $color_class = 'underline-'.$key;
        $arr[$color_name] = $color_class;
    }

    return $arr;
}
function pergo_vc_global_color_options(){
    $arr = array();

    $colors = pergo_default_color_classes();
    foreach ($colors as $key => $value) {
        $color_name = $value['label'];
        $color_class = $key;
        $arr[$color_name] = $color_class;
    }

    return $arr;
}
function pergo_vc_text_size_options(){
    return array(
        __('Default', 'pergo') => 'p-normal',
        __('Small', 'pergo') => 'p-sm',
        __('Medium', 'pergo') => 'p-md',
        __('large', 'pergo') => 'p-lg',
        __('Font weight bold', 'pergo') => 'p-lg font-weight-bold',
         __('Italic text', 'pergo') => 'p-lg font-italic',
         __('Indicates uppercased text', 'pergo') => 'p-lg text-uppercase',
    );
}
function pergo_vc_spacing_options($type='padding', $pos = 'bottom'){
    $total = apply_filters('pergo_vc_spacing_total', 80);
    $arr = array();
    $prefix = ($type == 'padding')? 'p-' : 'm-';
    $prefix = $prefix.$pos.'-';
    $arr = array(
        __('Default', 'pergo') => $prefix.'default',     
    );
    for ($i=0; $i <= $total; $i+=5) { 
        $name = ucfirst($type).' '.$pos. ' '.$i.'px';
       $arr[$name] = $prefix.$i; 
    }
    return $arr;
}

function pergo_vc_spacing_options_param($type = 'padding', $pos = 'bottom'){
    $prefix = ($type == 'padding')? 'p' : 'm';
    $param_name = $prefix.$pos;
    $heading = ucfirst($type).' '.$pos;
    return array(
                'type' => 'dropdown',
                'heading' => $heading,
                'param_name' => $param_name,
                'value' => pergo_vc_spacing_options($type, $pos),
                'group' => __( 'Spacing option', 'pergo' ),
            );
}

function pergo_vc_content_list_group(){
    return array(
            'type' => 'param_group',
            'save_always' => true,
            'heading' => __( 'Content list', 'pergo' ),
            'param_name' => 'content_list',
            'value' => urlencode( json_encode( array(
                array( 'title' => 'Fully Responsive Design' ),
                array( 'title' => 'Bootstrap 4.0 Based' ),
                array( 'title' => 'Google Analytics Ready' ),
                array( 'title' => 'Cross Browser Compatability' ),
                array( 'title' => 'Developer Friendly Commented Code' ),
                array( 'title' => 'and much more...' ),
            ) ) ),
            'params' => array(
                 array(
                    'type' => 'textarea',
                    'heading' => __( 'Title', 'pergo' ),
                    'param_name' => 'title',
                    'description' => '',
                    'value' => '',
                    'admin_label' => true 
                ),
            ),            
            'dependency' => array(
                'element' => 'enable_list',
                'value' => 'yes'
            )  
        );
}

if( !function_exists('pergo_target_param_list') ):
function pergo_target_param_list() {
    return array(
        __( 'Same window', 'pergo' ) => '_self',
        __( 'New window', 'pergo' ) => '_blank',
    );
}
endif;

function pergo_vc_get_content_list_group( $paramsArr = array(), $animation = '', $delay = '100'){
    if(empty($paramsArr)) return false;
    echo '<ul class="content-list">';
    foreach ($paramsArr as $key => $value):                     
        echo '<li class="animated" data-animation="'.esc_attr($animation).'" data-animation-delay="'. intval($delay).'">'.esc_attr($value['title']).'</li>';
        $delay = $delay + 100; 
    endforeach; 
    echo '</ul>';
}

if ( function_exists( 'vc_set_as_theme' ) ):
    vc_set_as_theme( $disable_updater = false );
    $list = array(
         'page',
        'post',
        'team',
        'portfolio',
        'service',
        'job' 
    );
    vc_set_default_editor_post_types( $list );
endif;
/* global vc include files */
foreach ( glob( PERGO_DIR . "/vc-extends/*.php" ) as $filename ) {
    include $filename;
} //glob( PERGO_DIR . "/admin/vc-extends/*.php" ) as $filename

/**
* vc_map default values
* @param array
*
* @since 1.2
* @return array
*/
function pergo_vc_get_params_value($args = array(), $_content = NULL){
    $array = array();
    if( !isset($args['base']) || !isset($args['params']) ){
        return $array;
    }

    $newarray = array();
    $map_arr = $args['params'];
    foreach ( $map_arr as $key => $value) {
        $param_name = isset($value['param_name'])? $value['param_name'] : '';
            $std = '';
            if(isset($value['value']) ){
                if( is_array($value['value']) ) {                    
                    if(!isset($value['std'])){
                        $array = $value['value']; reset($array); $std = key($array);
                    }else{
                        $std = $value['std'];
                    }
                }else {
                    $std = $value['value'];
                }
            }
            $std = isset($value['std'])? $value['std'] : $std;

            if( $param_name != '' ){
                $newarray[$param_name] = $std;
            }
    }
    $newarray['content'] = $_content;


    if( !empty($newarray) ) $array = $newarray;

    return $array;
}


if( class_exists('PerchVcMap')):
include PERGO_DIR . '/admin/vc-extends2.php';
endif;

function pergo_validate_video_url($url = '#'){
  $url_parse = wp_parse_url($url);
  $url = str_replace('watch?v=', 'embed/', $url);
  return $url;
}