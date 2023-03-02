<?php 
// Element Class 
class PerchVcMap{
     
  
    function __construct() {
        add_action( 'wp_ajax_perch_vc_admin_view', array( $this, 'vc_admin_view' ) );
        add_action( 'init', array( $this, 'vc_map_register_scripts' ) );        
    }

    function vc_map_register_scripts() {
        wp_register_script( 'perch-scripts', get_template_directory_uri() . '/admin/assets/js/perch-scripts.js', array('jquery', 'owl-carousel', 'slick'), '1.0.0', 'all' );
      
    }    

    public static function carousel_item_map(){
        $array = array('perch_vc_feature_box_slide','perch_vc_testimonial_slide', 'perch_vc_title_slide', 'perch_vc_image_slide', 'vc_row', 'perch_vc_pricing_table_slide');        

        return implode(', ', $array);
    }

    public static function get_vc_element_atts_array($map_arr, $map_content = null){ 
         
        $newarray = array();
        foreach ($map_arr as $key => $value) {
            $param_name = isset($value['param_name'])? $value['param_name'] : '';
            $std = '';
            if(isset($value['value']) ){
                if( is_array($value['value']) && ( $value['type'] == 'dropdown' ) ) {
                    $array = $value['value'];  $std = array_shift($array);
                }else {
                    $std = $value['value'];
                }
            }
            $std = isset($value['std'])? $value['std'] : $std;

            if( $param_name != '' ){
                $newarray[$param_name] = $std;
            }
        } 

        $newarray['content'] = $map_content;       
       
        if( !empty($newarray) ) $map_arr = $newarray;
       
        
        return $map_arr;

    }
    /*List teb function*/
    public static function getExtraClass( $el_class, $atts = array() ) {
        $output = '';
        if ( '' !== $el_class ) {
            $output = ' ' . str_replace( '.', '', $el_class );
        }

        return $output;
    }

    /**
     * @param $css_animation
     *
     * @return string
     */
    public  static function getCSSAnimation( $css_animation, $atts = array() ) {
        if( !empty($atts) && isset($atts['periodic_animation']) ){
            $css_animation = ( $atts['periodic_animation'] == 'yes' )? 'none' : $css_animation;
        }
        $output = '';
        if ( '' !== $css_animation && 'none' !== $css_animation ) {
            wp_enqueue_script( 'wow' );
            wp_enqueue_style( 'animate' );
            $output = ' wow perch-' . $css_animation . ' ' . $css_animation;
        }

        return $output;
    }

    public static function periodic_getCSSAnimation( $classes, $param_name, $atts ){      
        if(!isset($atts['css_animation']) || ($atts['css_animation'] == '') || ($atts['css_animation'] == 'none')){
            return $classes;
        }

        if( !empty($atts) && isset($atts['periodic_animation']) && ( $atts['periodic_animation'] == 'yes' ) ){

            $atts['periodic_animation'] = '';
            if ( ('' !== $atts['css_animation']) && ('none' !== $atts['css_animation']) ) {
                $classes[] = self::getCSSAnimation($atts['css_animation'], $atts);
            }
        }

        return $classes;
    }
     public static function periodic_animation_start( $atts ) {
        if( isset($atts['periodic_animation']) && ( $atts['periodic_animation'] == 'yes') ){
            set_query_var( 'perch_periodic_animation', true );
            set_query_var( 'perch_periodic_interval', 0 );
        }        
    }

    public static function periodic_animation_end() {
        set_query_var( 'perch_periodic_animation', false );    
        set_query_var( 'perch_periodic_interval', 0 );    
    }
    public static function periodic_wrapperAttributes( $wrapper_attributes, $param_name, $atts ){ 

        if(!isset($atts['css_animation']) || ($atts['css_animation'] == '') || ($atts['css_animation'] == 'none')){
            return $wrapper_attributes;
        }



        if( get_query_var('perch_periodic_animation', false)){
            $atts['periodic_animation'] = ''; 
            $interval = get_query_var('perch_periodic_interval');
            if($interval){                
                $atts['animation_delay'] = intval($atts['animation_delay']) + ($interval * intval($atts['animation_interval']));
            }
            $new_interval = $interval + 1;
            set_query_var( 'perch_periodic_interval',  $new_interval );
            $wrapper_attributes = self::wrapperAttributes($wrapper_attributes, $atts);
            
            
            
        }      

        return $wrapper_attributes;
    }

    public static function image_args_simple(){
        $array = array(
            array(
                'type' => 'dropdown',
                'heading' => __( 'Image source', 'perch' ),
                'param_name' => 'source',
                'std' => 'external_link',
                'value' => array(
                    __( 'Media library', 'perch' ) => 'media_library',
                    __( 'External link', 'perch' ) => 'external_link',
                    __( 'Featured Image', 'perch' ) => 'featured_image',
                ),
                'description' => __( 'Select image source.', 'perch' ),
                 'admin_label' => true,
            ),
            array(
                'type' => 'attach_image',
                'heading' => __( 'Image', 'perch' ),
                'param_name' => 'image',
                'value' => '',
                'description' => __( 'Select image from media library.', 'perch' ),
                'dependency' => array(
                    'element' => 'source',
                    'value' => 'media_library',
                ),                
                'edit_field_class' => 'vc_col-sm-8', 
            ),
            array(
                'type' => 'image_upload',
                'heading' => __( 'External link', 'perch' ),
                'param_name' => 'custom_src',
                'value' => get_template_directory_uri(). '/images/image-01.png',
                'description' => __( 'Select external link.', 'perch' ),
                'dependency' => array(
                    'element' => 'source',
                    'value' => 'external_link',
                ),               
                'edit_field_class' => 'vc_col-sm-8', 
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Image size', 'perch' ),
                'param_name' => 'img_size',
                'std' => 'full',
                'value' => array_flip( perch_get_image_sizes_Arr() ),
                'description' => __( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'perch' ),
                'dependency' => array(
                    'element' => 'source',
                    'value' => array(
                        'media_library',
                        'featured_image',
                    ),
                ),
                'edit_field_class' => 'vc_col-sm-4', 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Image size', 'perch' ),
                'param_name' => 'external_img_size',
                'value' => '',
                'description' => __( 'Enter image size in pixels. Example: 200x100 (Width x Height).', 'perch' ),
                'dependency' => array(
                    'element' => 'source',
                    'value' => 'external_link',
                ),
                'edit_field_class' => 'vc_col-sm-4', 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Image alt text', 'perch' ),
                'param_name' => 'external_img_alt',
                'value' => 'External image',
                'description' => __( 'Enter text for image caption.', 'perch' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'source',
                    'value' => 'external_link',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Caption', 'perch' ),
                'param_name' => 'caption',
                'value' => '',
                'description' => __( 'Enter text for image caption.', 'perch' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'source',
                    'value' => 'external_link',
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'On click action', 'perch' ),
                'param_name' => 'onclick',
                'value' => array(
                    __( 'None', 'perch' ) => '',
                    __( 'Link to large image', 'perch' ) => 'img_link_large',
                    __( 'Open prettyPhoto', 'perch' ) => 'link_image',
                    __( 'Open custom link', 'perch' ) => 'custom_link',
                   // __( 'Zoom', 'perch' ) => 'zoom',
                    __( 'Video', 'perch' ) => 'video',
                ),
                'description' => __( 'Select action for click action.', 'perch' ),
                'std' => '',
                'edit_field_class' => 'vc_col-sm-8', 
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Force image to overflow container?', 'perch' ),
                'param_name' => 'max_width',
                'description' => __( 'Checked to force image to overflow container.', 'perch' ),
                'value' => array( __( 'Yes', 'perch' ) => 'yes' ),  
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-4', 
            ),
            array(
                'type' => 'href',
                'heading' => __( 'Video link', 'perch' ),
                'param_name' => 'video_link',
                'value' => 'https://www.youtube.com/embed/SZEflIVnhH8',
                'description' => __( 'Enter URL if you want this image to have a popup video link', 'perch' ),
                'dependency' => array(
                    'element' => 'onclick',
                    'value' => 'video',
                ),
                'edit_field_class' => 'vc_col-sm-8',
            ),
            array(
                 'type' => 'dropdown',
                'heading' => __( 'Video icon color', 'perch' ),
                'param_name' => 'icon_class',               
                'value' => perch_vc_global_color_options(),
                'std' => 'tra',
                'description' => '',
                'dependency' => array(
                    'element' => 'onclick',
                    'value' => 'video',
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'href',
                'heading' => __( 'Image link', 'perch' ),
                'param_name' => 'link',
                'description' => __( 'Enter URL if you want this image to have a link (Note: parameters like "mailto:" are also accepted).', 'perch' ),
                'dependency' => array(
                    'element' => 'onclick',
                    'value' => 'custom_link',
                ),
                'edit_field_class' => 'vc_col-sm-8',
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Link Target', 'perch' ),
                'param_name' => 'img_link_target',
                'value' => perch_target_param_list(),
                'dependency' => array(
                    'element' => 'onclick',
                    'value' => array(
                        'custom_link',
                        'img_link_large',
                    ),
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
        );

        return $array;
    }
public static function element_common_args2(){
         $array = array(
            array(
                'type' => 'animation_style',
                'heading' => __( 'Animation Style', 'perch' ),
                'param_name' => 'css_animation',
                'description' => __( 'Choose your animation style', 'perch' ),
                'std' => 'fadeInUp',
                'admin_label' => false,                
            ),            
            array(
                'type' => 'textfield',
                'heading' => __( 'Animation Delay', 'perch' ),
                'param_name' => 'animation_delay',
                'value' => '300', 
                'description' => __( 'Delay before the animation starts, in ms', 'perch' ),
                'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array(
                    'element' => 'css_animation',
                    'value_not_equal_to' => 'none'
                )
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Animation duration', 'perch' ),
                'param_name' => 'animation_duration',
                'value' => '1200', 
                'description' => __( 'Change the animation duration, in ms', 'perch' ),
                'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array(
                    'element' => 'css_animation',
                    'value_not_equal_to' => 'none'
                )
            ), 
            array(
                'type' => 'checkbox',
                'heading' => __( 'Perodic animation', 'perch' ),
                'param_name' => 'periodic_animation',               
                'value' => array( __( 'Checked to make item elements animation Perodic', 'perch' ) => 'yes' ),
                'edit_field_class' => 'vc_col-sm-4',
                'std' => '',  
                'dependency' => array(
                    'element' => 'css_animation',
                    'value_not_equal_to' => 'none'
                )             
                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Perodic animation interval', 'perch' ),
                'param_name' => 'animation_interval',
                'value' => '100',  
                'description' => 'Change the animation duration interval per element. Number only, in ms.',                
                'dependency' => array(
                    'element' => 'periodic_animation',
                    'value' => 'yes'
                )
            ),                      
            array(
                'type' => 'el_id',
                'heading' => __( 'Element ID', 'perch' ),
                'param_name' => 'el_id',
                'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'perch' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
                'edit_field_class' => 'vc_col-sm-6',                
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Extra class name', 'perch' ),
                'param_name' => 'el_class',
                'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'perch' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),            
            //perch_vc_spacing_options_param('margin', 'top'),
            //perch_vc_spacing_options_param('margin', 'bottom'), 
            //perch_vc_spacing_options_param('padding', 'left'),
            //perch_vc_spacing_options_param('padding', 'right'),
            array(
                'type' => 'css_editor',
                'heading' => __( 'CSS box', 'perch' ),
                'param_name' => 'css',
                'group' => __( 'Design Options', 'perch' ),
                
            ),            
         );
        

        return $array;   
    } 
    /*List teb end*/
    
    // Title element mapping
    public static function _vc_map_input_field_group( $field_id, $heading = '', $textarea = false, $value="" ){
        $array = array(            
            array( $this, _vc_param_input_field( $field_id, $heading, $textarea, $value )),
            array( $this, _vc_param_enable_highlight_text( $field_id, $heading )),
            array( $this, _vc_highlight_text_typography( $field_id, $heading )),         
            array( $this, _vc_param_typography( $field_id, $heading )),
            array( $this, _vc_param_enable_google_fonts( $field_id, $heading )),
            array( $this, _vc_param_custom_google_fonts( $field_id, $heading )),
        );

        $array = array_filter($array);

        $array = apply_filters( 'perch/vc_map_input_field_group', $array );

        return $array;
    }

    public static function _vc_param_input_field( $field_id, $_heading = 'Title', $textarea = false, $value="" ){  

        $array = array(
                'heading' => $_heading,
                'param_name' => $field_id,
                'value' => $value,
                'description' => __( 'Leave blank to avoid this field', 'perch' ),
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-9'
            );
        $array['type'] = ($textarea == true)? 'textarea' : 'textfield';
        return $array; 
    }

    public static function _vc_param_typography( $field_id, $_heading = 'Title' ){  

        $group = __( 'Typography settings', 'perch' );
        $param_name = $field_id. '_font_container';
        $title = sprintf(__( '%s Typography settings', 'perch' ), $_heading);
        $std = 'tag:h3';    
        $fields = array(
                'tag' => 'h2', 
                'size', 
                'color',              
                'text_underline',                
                'text_align',
                'text_bg',
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
        $std = apply_filters('perch_vc_typography_std', $std, $field_id);
        $fields = apply_filters('perch_vc_typography_fields', $fields, $field_id);
        $array = array(
            'type' => 'perch_vc_typography',
            'title' => esc_attr($title),
            'param_name' => esc_attr($param_name),
            'column' => apply_filters('perch_vc_typography_fields_column', 4, $field_id),
            'std' => $std,
            'group' => $group, 
            'settings' => array(
                'fields' => $fields,
            ),
        );         
        return $array;    
    }

    public static function _vc_param_enable_highlight_text( $field_id, $_heading = 'Title' ){  

        $group = __( 'Highlight text', 'perch' );
        $param_name = $field_id. '_highlight_text_enable';
        $title = sprintf(__( 'Enable highlight text for %s', 'perch' ), $_heading);
        $desc = __( 'Use {} to make text highlight.', 'perch' );      
        $array = array(
                'type' => 'checkbox',
                'heading' => $title,
                'param_name' => esc_attr($param_name),                
                'value' => array( __('Enable', 'perch') => 'yes' ), 
                'description' => esc_attr($desc),
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-3'
            ); 
        $array = apply_filters('perch/vc_param_enable_highlight_text', $array);            
        return $array;    
    }

    public static function _vc_highlight_text_typography( $field_id, $_heading = 'Title' ){  

        $group = __( 'Highlight text', 'perch' );
        $param_name = $field_id. '_highlight_text';
        $title = sprintf(__( '%s Highlight text settings', 'perch' ), $_heading);
        $dependency = array( 'element' => $field_id. '_highlight_text_enable', 'value' => 'yes' );
        $std = 'inner_tag:span|text_underline:underline';    
        $fields = array(               
                'text_underline',
                'text_color',
                'text_bg',
                'extra_class',
                // inline css            
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
        $std = apply_filters('perch_vc_highlight_text_typography_std', $std, $field_id);
        $fields = apply_filters('perch_vc_highlight_text_typography_fields', $fields, $field_id);
        $array = array(
            'type' => 'perch_vc_typography',
            'title' => esc_attr($title),
            'param_name' => esc_attr($param_name),
            'column' => 4,
            'std' => $std,
            'group' => $group,
            'dependency' =>  $dependency,
            'settings' => array(
                'fields' => $fields,
            ),
        );         
        return $array;    
    }

    public static function _vc_param_enable_google_fonts( $field_id, $_heading = 'Title' ){  

        $group = __( 'Typography settings', 'perch' );
        $param_name = $field_id. '_custom_font';
        $title = sprintf(__( 'Custom font family for %s', 'perch' ), $_heading);
        $desc = __( 'Checked to enable custom fonts', 'perch' );      
        $array = array(
                'type' => 'checkbox',
                'param_name' => esc_attr($param_name),                
                'value' => array( esc_attr($title) => 'yes' ), 
                'description' => esc_attr($desc),
                'admin_label' => true,
                'group' => $group, 
            );         
        return $array;    
    }

    public static function _vc_param_custom_google_fonts( $field_id, $_heading = 'Title' ){  

        $group = __( 'Typography settings', 'perch' );
        $param_name = $field_id. '_google_font';
        $font_dependency = array( 'element' => $field_id. '_custom_font', 'value' => 'yes' );     
        $array = array(
                'type' => 'google_fonts',
                'param_name' => esc_attr($param_name),
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => __( 'Select Font Family.', 'perch' ),
                    ),
                ), 
                'group' => $group, 
                'dependency' => $font_dependency, 

            );
               
        return $array;    
    }

    public  static function div_size_class_options(){
        $array = array(
                'None' => '',
                'Section name' => 'section-id',
                'Os version' => 'os-version',
                'Pricing validity' => 'validity',
                'Price' => 'price',
                'Text uppercase' => 'text-uppercase',
                'Text lowercase' => 'text-lowercase',
                'Text capitalize' => 'text-capitalize',
                'Text lead' => 'text-lead',
                'Truncate the text with an ellipsis' => 'text-truncate',
                'Text Muted' => 'text-muted',
                'Text italic' => 'font-italic',
                'Text success' => 'text-success',                               
                'Text danger' => 'text-danger',                               
                'Text warning' => 'text-warning',                               
                'Text info' => 'text-info',                               
                'Text opacity 25%' => 'opacity-25',                               
                'Text opacity 50%' => 'opacity-50',                               
                'Text opacity 75%' => 'opacity-75',                               
                'Text monospace' => 'text-monospace',                               
                'Blockquote' => 'blockquote',
                'Blockquote footer' => 'blockquote-footer',
                'Figure caption' => 'figure-caption',
                'Attribute' => 'attribute',
                'Screen readers text' => 'sr-only',
                 'Clearfix' => 'clearfix',
               
            );
        $array = apply_filters( 'perch/element_align_args', $array );

        return $array; 
    } 

    public static function element_align_args(){
         $array = array(
            array(
                'type' => 'dropdown',
                'heading' => __( 'Alignment', 'perch' ),
                'param_name' => 'align',
                'std' => 'text-left',
                'value' => array(
                    'Inherit' => '',
                    'Left' => 'text-left',
                    'Center' => 'text-center',
                    'Right' => 'text-right',
                    'Justify' => 'text-justify',                    
                ),
            ),
         );

        $array = apply_filters( 'perch/element_align_args', $array );

        return $array;   
    }

    public static function list_group_args(){
        $array = array(
            array(
                'type' => 'dropdown',
                'heading' => __( 'List type', 'perch' ),
                'param_name' => 'list_type',
                'std' => 'ul',
                'value' => array(
                    'Unordered list' => 'ul',
                    'Ordered list' => 'ol',
                    'Description list' => 'dl',
                ),
                'edit_field_class' => 'vc_col-sm-3',
            ),            
            array(
                'type' => 'dropdown',
                'heading' => __( 'List icon', 'perch' ),
                'param_name' => 'icon_type',
                'std' => '',
                'value' => array(
                    'None' => '',
                    'Fontawesome icon' => 'fontawesome',
                    'Image icon' => 'image',
                ),
                'edit_field_class' => 'vc_col-sm-3', 
                'admin_label' => true 
            ),
            array(
                'type' => 'dropdown',
                'heading' => 'Bottom spacing',
                'param_name' => 'li_spacing_bottom',
                'std' => '',
                'value' => array_merge(array('Inherit' => ''), perch_vc_dropdown_options(0, 150, 5)),
                'edit_field_class' => 'vc_col-sm-3', 
                'description' => 'List item spacing in bottom'
            ), 
            array(
                'type' => 'dropdown',
                'heading' => 'Left spacing',
                'param_name' => 'li_spacing_left',
                'std' => 'p-left-30',
                'value' => landpick_vc_spacing_options('padding', 'left'),
                'edit_field_class' => 'vc_col-sm-3', 
                'description' => 'List item spacing in left',
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => array('fontawesome', 'image'), 
                ),
            ),
            array(
                'type' => 'image_upload',
                'heading' => __( 'Icon Image', 'perch' ),
                'param_name' => 'image',
                'value' => get_template_directory_uri(). '/images/icon.png',
                'dependency' => array(
                     'element' => 'icon_type',
                    'value' => 'image' 
                ),
                'edit_field_class' => 'vc_col-sm-8',
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Icon size', 'perch' ),
                'param_name' => 'icon_size',
                'value' => landpick_vc_element_icon_size(),             
                'std' => '',
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => array('image', 'fontawesome'), 
                ),   
                'edit_field_class' => 'vc_col-sm-4',          
            ),   
            array(
                 'type' => 'dropdown',
                'heading' => __( 'Icon color', 'perch' ),
                'param_name' => 'icon_color',
                'value' => landpick_vc_color_options(false),
                'std' => 'preset-color',
                'admin_label' => true,               
                'dependency' => array(
                    'element' => 'icon_type',
                    'value' => array('fontawesome'), 
                ),
                'edit_field_class' => 'vc_col-sm-8',
            ), 
              
            landpick_vc_icon_set( 'fontawesome', 'icon_fontawesome', 'fa fa-check', 'icon_type' ),
            array(
                'type' => 'param_group',
                'save_always' => true,
                'heading' => __( 'List Group', 'perch' ),
                'param_name' => 'list_group',
                'value' => urlencode( json_encode( array(
                    array(
                         'title' => 'High Converting Landing Page',
                         'subtitle' => '',
                    ),
                    array(
                         'title' => 'Beautiful User Interface',
                         'subtitle' => '',
                    ),
                ) ) ),
                'params' => array(
                    array(
                        'type' => 'textarea',
                        'heading' => __( 'Description', 'perch' ),
                        'param_name' => 'title',
                        'description' => '',
                        'value' => 'The easy element for creativity & design',
                        'admin_label' => true 
                    ),
                     array(
                        'type' => 'textarea',
                        'heading' => __( 'Description', 'perch' ),
                        'param_name' => 'subtitle',
                        'description' => '',
                        'value' => '',
                    ),
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Display as', 'perch' ),
                'param_name' => 'display_as',
                'value' => array(                    
                    'Default' => '',
                    'Content list' => 'content-list',            
                ),
                'dependency' => array(
                     'element' => 'list_type',
                    'value' => 'ul' 
                ),
            ),
        );

        

        $array = apply_filters( 'perch/list_group_args', $array );

        return $array;
    }

    public static function list_group_html($atts){
        extract($atts);

        $paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($list_group) : array();
        if($list_type != 'dl'){
            $tag = 'li';
        }else{
           $tag = 'dd'; 
        }


       
        $classes = array();
        $classes[] = ($icon_type != '')?  'fa-ul' : '';
        $classes[] = $display_as;
        $classes = array_filter($classes);    
        $wrapper_attributes[] = (!empty($classes))?'class="'.implode(' ', $classes).'"' : '';
        $wrapper_attributes = array_filter($wrapper_attributes);             
        
        $icon_html = '';
        $title = isset($atts['title'])? $title : 'icon';

        
        $icon_classes = array( 'fa-li', 'fa-'.$icon_size );        
        $icon_classes[] = ( $icon_type == 'fontawesome' )? $icon_color : '';
        $icon_classes = array_filter($icon_classes); 

  
        if( ( $icon_type == 'fontawesome' ) && ($icon_fontawesome != '') ){
            wp_enqueue_style( 'font-awesome' );
            $icon_html = '<span class="'.implode(' ', $icon_classes).'"><i class="'.$icon_fontawesome.'"></i></span>';
        }       
        if( $icon_type == 'image' ){
            $icon_html = '<span class="'.implode(' ', $icon_classes).'">
            <img src="'.esc_url($image).'" alt="'.esc_attr($title).'" width="" class="img-fluid">
        </span>';
        }

        

        $output = '<'.esc_attr($list_type).' '.implode( ' ', $wrapper_attributes ).'>';
        if(!empty($paramsArr)):
            $delay = 100;
            $paramsArr = array_filter($paramsArr);
            foreach ($paramsArr as $key => $value) {                
                $new_title = isset($value['title'])? $value['title'] : '';
                $new_subtitle = isset($value['subtitle'])? $value['subtitle'] : '';

                if( ( $new_title != '') || ( $new_subtitle != '') ):
                    $atts['echo'] = false;
                    $classes = array('wow', $css_animation, $li_spacing_bottom);
                    $classes[] = ($icon_type != '')?  $li_spacing_left : '';
                    $classes = array_filter($classes); 
                    $li_attr = array();   
                    $li_attr[] = (!empty($classes))?'class="'.implode(' ', $classes).'"' : '';
                    $li_attr[] = ($css_animation != '')? ' data-wow-delay="'.intval($delay).'ms"' : ''; 
                    $li_attributes = implode( ' ', $li_attr );
                   

                    $title_html = landpick_get_parse_text_html($new_title, $atts, 'title');
                    $subtitle_html = landpick_get_parse_text_html($new_subtitle, $atts, 'subtitle');
                    $output .= "<{$tag} {$li_attributes}>{$icon_html}{$title_html}{$subtitle_html}</{$tag}>";
                    $delay = $delay + 100;
                endif;

            }
        endif;
        $output .= '</'.esc_attr($list_type).'>';

        return $output;

    }
    public static function icon_html($atts){
        $icon_type = $icon_spacing = '';
        extract($atts);

         $icon_html = '';
         $title = isset($atts['title'])? $title : 'icon';

         $icon_spacing = ( $icon_spacing == '' )? 'm-bottom-20' : $icon_spacing;

        if( ( $icon_type == 'tonicons' ) && ($icon_tonicons != '') ){
            $size = ( $icon_size != 'icon' )? ' box-icon-'.$icon_size : '';
            $icon_html = '<div class="b-icon '.esc_attr($icon_spacing).' '.esc_attr($icon_color).'-icon'.esc_attr($size).'"><span class="'.esc_attr($icon_tonicons.$size).'"></span></div>';
        }
        if( ( $icon_type == 'fontawesome' ) && ($icon_fontawesome != '') ){
            $size = ( $icon_size != 'icon' )? ' fa-'.$icon_size : '';
            $icon_html = '<div class="b-icon '.esc_attr($icon_spacing).' '.esc_attr($icon_color).'-icon"><span><i class="'.esc_attr($icon_fontawesome.$size).'"></i></span></div>';
        }
        if( $icon_type == 'text' ){
            $icon_html = '<h2 class="tra-digit '.esc_attr($icon_color) .'-color">'.esc_attr($tra_digit).'</h2>';
        }
        if( $icon_type == 'image' ){
            $icon_html = '<div class="b-img '.esc_attr($icon_spacing).'">
            <img src="'.esc_url($image).'" alt="'.esc_attr($title).'" width="'.intval($img_icon_size).'" class="img-fluid">
        </div>';
        }

        return $icon_html;
    }

    public static function button_args(){

        $group = __( 'Button', 'perch' );
        $dependency = '';
        
        if ( ! defined( 'ABSPATH' ) ) {
            die( '-1' );
        }

        $pixel_icons = vc_pixel_icons();
        require_once vc_path_dir( 'CONFIG_DIR', 'content/vc-icon-element.php' );

        $icons_params = vc_map_integrate_shortcode( vc_icon_element_params(), 'i_', '', array(
            'include_only_regex' => '/^(type|icon_\w*)/',
            // we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
        ), array(
            'element' => 'add_icon',
            'value' => 'true',            
        )   
        );

        $array = array_merge( array(
            array(
                'type' => 'textfield',
                'heading' => __( 'Button Text', 'perch' ),
                'param_name' => 'btn_title',
                // fully compatible to btn1 and btn2
                'value' => __( 'Text on the button', 'perch' ),
                'edit_field_class' => 'vc_col-sm-8',
            ),            
            array(
                'type' => 'dropdown',
                'heading' => __( 'Button type', 'perch' ),
                'param_name' => 'color',
                'description' => __( 'Select button color.', 'perch' ),
                // compatible with btn2, need to be converted from btn1
                'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
                'edit_field_class' => 'vc_col-sm-4',
                'value' => landpick_btn_style_options(true) + 
                array(
                    // Btn1 Colors                
                    __( 'Classic Grey', 'perch' ) => 'default',
                    __( 'Classic Blue', 'perch' ) => 'primary',
                    __( 'Classic Turquoise', 'perch' ) => 'info',
                    __( 'Classic Green', 'perch' ) => 'success',
                    __( 'Classic Orange', 'perch' ) => 'warning',
                    __( 'Classic Red', 'perch' ) => 'danger',
                    __( 'Classic Black', 'perch' ) => 'inverse' 
                    // + Btn2 Colors (default color set)
                ) + getVcShared( 'colors-dashed' ) ,
                'std' => 'btn-preset',
                // must have default color grey
                'dependency' => array(
                     'element' => 'style',
                    'value_not_equal_to' => array(
                         'custom',
                        'outline-custom',
                        'gradient',
                        'gradient-custom' 
                    ) 
                ) 
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Add button image?', 'perch' ),
                'param_name' => 'add_image', 
                'value' => array( __( 'Yes', 'perch' ) => 'yes' ),                 
            ),
            array(
                'type' => 'image_upload',
                'heading' => __( 'Button image', 'perch' ),
                'param_name' => 'button_image', 
                'value' => get_template_directory_uri().'/images/appstore.png',
                'edit_field_class' => 'vc_col-sm-8',
                'dependency' => array(
                     'element' => 'add_image',
                    'value' => 'yes' 
                ) 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Button image width', 'perch' ),
                'param_name' => 'btn_image_width',
                // fully compatible to btn1 and btn2
                'value' => __( '160', 'perch' ),
                'dependency' => array(
                     'element' => 'add_image',
                    'value' => 'yes' 
                ), 
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'vc_link',
                'heading' => __( 'URL (Link)', 'perch' ),
                'param_name' => 'link',
                'description' => __( 'Add link to button.', 'perch' ),
                // compatible with btn2 and converted from href{btn1}

            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Alignment', 'perch' ),
                'param_name' => 'align',
                'description' => __( 'Select button alignment.', 'perch' ),
                // compatible with btn2, default left to be compatible with btn1
                'std' => 'inline',
                'value' => array(
                    __( 'Inline', 'perch' ) => 'inline',
                    // default as well
                    __( 'Left', 'perch' ) => 'left',
                    // default as well
                    __( 'Right', 'perch' ) => 'right',
                    __( 'Center', 'perch' ) => 'center',

                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Set full width button?', 'perch' ),
                'param_name' => 'button_block',
                'dependency' => array(
                    'element' => 'align',
                    'value_not_equal_to' => 'inline',
                ),
                'edit_field_class' => 'vc_col-sm-4',
            ),  
            array(
                'type' => 'checkbox',
                'heading' => __( 'Add icon?', 'perch' ),
                'param_name' => 'add_icon', 
                'std' => false,
                'edit_field_class' => 'vc_col-sm-4',
            ),          
            array(
             'type' => 'dropdown',
                'heading' => __( 'Style', 'perch' ),
                'description' => __( 'Select button display style.', 'perch' ),
                'param_name' => 'style',
                'std' => 'perch',
                // partly compatible with btn2, need to be converted shape+style from btn2 and btn1
                'value' => array(
                    __( 'Landpick', 'perch' ) => 'perch',
                    __( 'Modern', 'perch' ) => 'modern',
                    __( 'Classic', 'perch' ) => 'classic',
                    __( 'Flat', 'perch' ) => 'flat',
                    __( 'Outline', 'perch' ) => 'outline',
                    __( '3d', 'perch' ) => '3d',
                    __( 'Custom', 'perch' ) => 'custom',
                    __( 'Outline custom', 'perch' ) => 'outline-custom',
                    __( 'Gradient', 'perch' ) => 'gradient',
                    __( 'Gradient Custom', 'perch' ) => 'gradient-custom' 
                ),
                'group' => $group,
            ),
            array(
                'type' => 'checkbox',
                'heading' => __( 'Display arrow on button hover?', 'perch' ),
                'param_name' => 'btnarrow',
                'value' => array( __( 'Yes', 'perch' ) => 'yes' ),
                'std' => 'yes',
                'dependency' => array(
                    'element' => 'style',
                    'value' => 'perch',
                ),
                 'group' => $group,
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Gradient Color 1', 'perch' ),
                'param_name' => 'gradient_color_1',
                'description' => __( 'Select first color for gradient.', 'perch' ),
                'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
                'value' => getVcShared( 'colors-dashed' ),
                'std' => 'turquoise',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'gradient' ),
                ),
                'edit_field_class' => 'vc_col-sm-6',
                'group' => $group,
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Gradient Color 2', 'perch' ),
                'param_name' => 'gradient_color_2',
                'description' => __( 'Select second color for gradient.', 'perch' ),
                'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
                'value' => getVcShared( 'colors-dashed' ),
                'std' => 'blue',
                // must have default color grey
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'gradient' ),
                ),
                'edit_field_class' => 'vc_col-sm-6',
                'group' => $group,
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Gradient Color 1', 'perch' ),
                'param_name' => 'gradient_custom_color_1',
                'description' => __( 'Select first color for gradient.', 'perch' ),
                'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
                'value' => '#dd3333',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'gradient-custom' ),
                ),
                'edit_field_class' => 'vc_col-sm-4',
                'group' => $group,
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Gradient Color 2', 'perch' ),
                'param_name' => 'gradient_custom_color_2',
                'description' => __( 'Select second color for gradient.', 'perch' ),
                'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
                'value' => '#eeee22',
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'gradient-custom' ),
                ),
                'edit_field_class' => 'vc_col-sm-4',
                'group' => $group,
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Button Text Color', 'perch' ),
                'param_name' => 'gradient_text_color',
                'description' => __( 'Select button text color.', 'perch' ),
                'param_holder_class' => 'vc_colored-dropdown vc_btn3-colored-dropdown',
                'value' => '#ffffff',
                // must have default color grey
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'gradient-custom' ),
                ),
                'edit_field_class' => 'vc_col-sm-4',
                'group' => $group,
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Background', 'perch' ),
                'param_name' => 'custom_background',
                'description' => __( 'Select custom background color for your element.', 'perch' ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'custom' ),
                ),
                'edit_field_class' => 'vc_col-sm-6',
                'std' => '#ededed',
                'group' => $group,
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Text', 'perch' ),
                'param_name' => 'custom_text',
                'description' => __( 'Select custom text color for your element.', 'perch' ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'custom' ),
                ),
                'edit_field_class' => 'vc_col-sm-6',
                'std' => '#666',
                'group' => $group,
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Outline and Text', 'perch' ),
                'param_name' => 'outline_custom_color',
                'description' => __( 'Select outline and text color for your element.', 'perch' ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'outline-custom' ),
                ),
                'edit_field_class' => 'vc_col-sm-4',
                'std' => '#666',
                'group' => $group,
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Hover background', 'perch' ),
                'param_name' => 'outline_custom_hover_background',
                'description' => __( 'Select hover background color for your element.', 'perch' ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'outline-custom' ),
                ),
                'edit_field_class' => 'vc_col-sm-4',
                'std' => '#666',
                'group' => $group,
            ),
            array(
                'type' => 'colorpicker',
                'heading' => __( 'Hover text', 'perch' ),
                'param_name' => 'outline_custom_hover_text',
                'description' => __( 'Select hover text color for your element.', 'perch' ),
                'dependency' => array(
                    'element' => 'style',
                    'value' => array( 'outline-custom' ),
                ),
                'edit_field_class' => 'vc_col-sm-4',
                'std' => '#fff',
                'group' => $group,
            ),
            array(
                 'type' => 'dropdown',
                'heading' => __( 'Shape', 'perch' ),
                'description' => __( 'Select button shape.', 'perch' ),
                'param_name' => 'shape',
                // need to be converted
                'value' => array(
                     __( 'Square', 'perch' ) => 'square',
                    __( 'Rounded', 'perch' ) => 'rounded',
                    __( 'Round', 'perch' ) => 'round' 
                ),
                'dependency' => array(
                     'element' => 'style',
                    'value_not_equal_to' => array(
                         'perch'
                    ) 
                ),
                'group' => $group,
            ),            
            array(
                'type' => 'dropdown',
                'heading' => __( 'Size', 'perch' ),
                'param_name' => 'size',
                'description' => __( 'Select button display size.', 'perch' ),
                // compatible with btn2, default md, but need to be converted from btn1 to btn2
                'std' => 'md',
                'value' => getVcShared( 'sizes' ),
                'group' => $group,
            ),            
            
            array(
                'type' => 'dropdown',
                'heading' => __( 'Icon Alignment', 'perch' ),
                'description' => __( 'Select icon alignment.', 'perch' ),
                'param_name' => 'i_align',
                'value' => array(
                    __( 'Left', 'perch' ) => 'left',
                    // default as well
                    __( 'Right', 'perch' ) => 'right',
                ),
                'dependency' => array(
                    'element' => 'add_icon',
                    'value' => 'true',
                ),
                'group' => $group,
            ),
        ), $icons_params, array(
                array(
                    'type' => 'iconpicker',
                    'heading' => __( 'Icon', 'perch' ),
                    'param_name' => 'i_icon_pixelicons',
                    'value' => 'vc_pixel_icon vc_pixel_icon-alert',
                    'settings' => array(
                        'emptyIcon' => false,
                        // default true, display an "EMPTY" icon?
                        'type' => 'pixelicons',
                        'source' => $pixel_icons,
                    ),
                    'dependency' => array(
                        'element' => 'i_type',
                        'value' => 'pixelicons',
                    ),
                    'description' => __( 'Select icon from library.', 'perch' ),
                    'group' => $group,
                ),
            )
    );

        $array = apply_filters( 'perch/button_args', $array );

        return $array;   
    }

    public static function element_common_args(){
         $array = array(
            vc_map_add_css_animation(),
            array(
                'type' => 'el_id',
                'heading' => __( 'Element ID', 'perch' ),
                'param_name' => 'el_id',
                'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'perch' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Extra class name', 'perch' ),
                'param_name' => 'el_class',
                'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'perch' ),
            ),
            array(
                'type' => 'css_editor',
                'heading' => __( 'CSS box', 'perch' ),
                'param_name' => 'css',
                'group' => __( 'Design Options', 'perch' ),
            ),
            //landpick_vc_spacing_options_param('margin', 'top'),
            //landpick_vc_spacing_options_param('margin', 'bottom'), 
            //landpick_vc_spacing_options_param('padding', 'left'),
            //landpick_vc_spacing_options_param('padding', 'right'),
         );
        $array = apply_filters( 'perch/common_args', $array );

        return $array;   
    }
   

    public static function heighlights_text_args(){
        $hl_group = __( 'Highlight text', 'perch' );
        $hl_dep = array( 'element' => 'highlight_text', 'value' => 'yes' );
        $array = array(
            array(
                'type' => 'checkbox',
                'heading' => __( 'Enable highlight text options?', 'perch' ),
                'param_name' => 'highlight_text',
                'description' => __( 'Checked to select enable highlight text option', 'perch' ),
                'value' => array( __( 'Yes', 'perch' ) => 'yes' ), 
                'admin_label' => true
            ), 
            array(
                 'type' => 'dropdown',
                'heading' => __( 'Underline for highlight text', 'perch' ),
                'param_name' => 'highlight_text_underline',
                'value' => landpick_vc_underline_color_options(),
                'std' => 'underline-yellow',
                'group' => $hl_group,
                'dependency' => $hl_dep, 
            ),
            array(
                 'type' => 'dropdown',
                'heading' => __( 'Highlight text bg', 'perch' ),
                'param_name' => 'highlight_text_bg',
                'value' => landpick_vc_background_options(true),
                'group' => $hl_group,  
                'std' => '',
                'description' => __( 'Only worked for highlighted text', 'perch' ),
                'dependency' => $hl_dep,  
            ),
            array(
                 'type' => 'dropdown',
                'heading' => __( 'Highlight text color', 'perch' ),
                'param_name' => 'highlight_text_color',
                'value' => landpick_vc_color_options(true),
                'std' => '',
                'group' => $hl_group,
                'dependency' => $hl_dep,
            ),           
        landpick_vc_size_options_param( 'highlight_text_size', 'Title size', '', $hl_group, $hl_dep ),          
           array(
                'type' => 'dropdown',
                'heading' => 'Class',
                'param_name' => 'highlight_text_weight',
                'std' => '',
                'value' => PerchVcMap::div_size_class_options(),
                'edit_field_class' => 'vc_col-sm-3', 
                'group' => $hl_group,
                'dependency' => $hl_dep,              
            ),
           
          
             
        );

        $array = apply_filters( 'perch/heighlights_text_args', $array );

        return $array;
       
    }

    // Title element mapping
    public static function title_typo_args( $title_field = true ){
        $array = array(            
            PerchVcMap::_vc_param_input_field('title', 'Title'),
            PerchVcMap::_vc_param_enable_highlight_text('title', 'Title'),
            PerchVcMap::_vc_highlight_text_typography('title', 'Title'),
            PerchVcMap::_vc_param_typography('title', 'Title'),
            PerchVcMap::_vc_param_enable_google_fonts('title', 'Title'),
            PerchVcMap::_vc_param_custom_google_fonts('title', 'Title'), 
        );

        $array = array_filter($array);

        $array = apply_filters( 'perch/title_typo_args', $array );

        return $array;
    }

    // Title element mapping
    public static function subtitle_typo_args($title_field = true){
        $group = __( 'Sub-title', 'perch' );
        $group = apply_filters( 'perch/subtitle_group', $group);
        $dependency = array( 'element' => 'custom_subtitle_option', 'value' => 'yes' );
        $font_dependency = array( 'element' => 'custom_subtitle_font', 'value' => 'yes' );
        $title_field_param = array(
                'type' => 'textarea',
                'heading' => __( 'Sub-title', 'perch' ),
                'param_name' => 'subtitle',
                'value' => __( 'Semper lacus cursus porta, feugiat primis ultrice in ligula risus auctor tempus feugiat dolor felis', 'perch' ),
                'description' => __( 'Leave blank to avoid this field', 'perch' ),
                'admin_label' => true,
                'edit_field_class' => 'vc_col-sm-8',
            );
        $title_field_param = ($title_field)? $title_field_param : array();
        $array = array(
            $title_field_param
            ,  
            
        );

        $array = array_filter($array);

        $array = apply_filters( 'perch/subtitle_typo_args', $array );

        return $array;
    }

    public static function button_html($atts){
        $css_class = $add_image = $btn_image_width = '';
        $custom_onclick = $custom_onclick_code = '';
        $a_href = $a_title = $a_target = $a_rel = '';
        $styles = array();
        $icon_wrapper = false;
        $icon_html = false;
        $attributes = array();

        extract( $atts );

       
        //parse link
        $link = trim( $link );
        $link = ( '||' === $link ) ? '' : $link;
        $link = vc_build_link( $link );
        $use_link = true;       
        if ( strlen( $link['url'] ) > 0 ) {
            $use_link = true;
            $a_href = $link['url'];
            $a_href = apply_filters( 'vc_btn_a_href', $a_href );
            $a_title = $link['title'];
            $a_title = apply_filters( 'vc_btn_a_title', $a_title );
            $a_target = $link['target'];
            $a_rel = $link['rel'];
        }

        $wrapper_classes = array(
            'vc_btn3-container',
            'vc_btn3-' . $align,
        );

        $button_classes = array(
            'vc_general',
            'vc_btn3',
            'vc_btn3-size-' . $size,
            'vc_btn3-shape-' . $shape,
            'vc_btn3-style-' . $style,
        );


        if($style == 'perch'){
            $size = ( $size == 'md' )? '' : 'btn-' . $size;
            $button_classes = array(
                'btn',      
                $size,
            );
            $darkcolorArr = landpick_default_dark_color_classes(array('prefix' => 'btn-'));   
            $darkcolortraArr = landpick_default_dark_color_classes(array('prefix' => 'btn-tra-'));    
            if(in_array( $color, $darkcolorArr)){
                $button_classes[] = 'btn-type-dark';
            }
            if(in_array( $color, $darkcolortraArr)){
                $button_classes[] = 'btn-hover-type-dark';
            }
            $button_classes[] = ( $btnarrow == 'yes' )? 'btn-arrow': '';
            
        }



        if( $style == 'perch' ){
            $button_html = ( $btnarrow == 'yes' )? '<span>'. $btn_title .' <i class="fa fa-angle-double-right"></i></span>': $btn_title;    
        }else{
            $button_html = $btn_title;
        }

        if ( '' === trim( $btn_title ) ) {
            $button_classes[] = 'vc_btn3-o-empty';
            $button_html = '<span class="vc_btn3-placeholder">&nbsp;</span>';
        }
        if ( 'true' === $button_block && 'inline' !== $align ) {
            $button_classes[] = ( $style == 'perch' )? 'btn-block' : 'vc_btn3-block';
        }
        if ( 'true' === $add_icon ) {
            $button_classes[] = 'vc_btn3-icon-' . $i_align;
            vc_icon_element_fonts_enqueue( $i_type );

            if ( isset( ${'i_icon_' . $i_type} ) ) {
                if ( 'pixelicons' === $i_type ) {
                    $icon_wrapper = true;
                }
                $icon_class = ${'i_icon_' . $i_type};
            } else {
                $icon_class = 'fa fa-adjust';
            }

            if ( $icon_wrapper ) {
                $icon_html = '<i class="vc_btn3-icon"><span class="vc_btn3-icon-inner ' . esc_attr( $icon_class ) . '"></span></i>';
            } else {
                $icon_html = '<i class="vc_btn3-icon ' . esc_attr( $icon_class ) . '"></i>';
            }

            if ( 'left' === $i_align ) {
                $button_html = $icon_html . ' ' . $button_html;
            } else {
                $button_html .= ' ' . $icon_html;
            }
        }

        if ( 'custom' === $style ) {
            if ( $custom_background ) {
                $styles[] = vc_get_css_color( 'background-color', $custom_background );
            }

            if ( $custom_text ) {
                $styles[] = vc_get_css_color( 'color', $custom_text );
            }

            if ( ! $custom_background && ! $custom_text ) {
                $button_classes[] = 'vc_btn3-color-grey';
            }
        } elseif ( 'outline-custom' === $style ) {
            if ( $outline_custom_color ) {
                $styles[] = vc_get_css_color( 'border-color', $outline_custom_color );
                $styles[] = vc_get_css_color( 'color', $outline_custom_color );
                $attributes[] = 'onmouseleave="this.style.borderColor=\'' . $outline_custom_color . '\'; this.style.backgroundColor=\'transparent\'; this.style.color=\'' . $outline_custom_color . '\'"';
            } else {
                $attributes[] = 'onmouseleave="this.style.borderColor=\'\'; this.style.backgroundColor=\'transparent\'; this.style.color=\'\'"';
            }

            $onmouseenter = array();
            if ( $outline_custom_hover_background ) {
                $onmouseenter[] = 'this.style.borderColor=\'' . $outline_custom_hover_background . '\';';
                $onmouseenter[] = 'this.style.backgroundColor=\'' . $outline_custom_hover_background . '\';';
            }
            if ( $outline_custom_hover_text ) {
                $onmouseenter[] = 'this.style.color=\'' . $outline_custom_hover_text . '\';';
            }
            if ( $onmouseenter ) {
                $attributes[] = 'onmouseenter="' . implode( ' ', $onmouseenter ) . '"';
            }

            if ( ! $outline_custom_color && ! $outline_custom_hover_background && ! $outline_custom_hover_text ) {
                $button_classes[] = 'vc_btn3-color-inverse';

                foreach ( $button_classes as $k => $v ) {
                    if ( 'vc_btn3-style-outline-custom' === $v ) {
                        unset( $button_classes[ $k ] );
                        break;
                    }
                }
                $button_classes[] = 'vc_btn3-style-outline';
            }
        } elseif ( 'gradient' === $style || 'gradient-custom' === $style ) {

            $gradient_color_1 = vc_convert_vc_color( $gradient_color_1 );
            $gradient_color_2 = vc_convert_vc_color( $gradient_color_2 );

            $button_text_color = '#fff';
            if ( 'gradient-custom' === $style ) {
                $gradient_color_1 = $gradient_custom_color_1;
                $gradient_color_2 = $gradient_custom_color_2;
                $button_text_color = $gradient_text_color;
            }

            $gradient_css = array();
            $gradient_css[] = 'color: ' . $button_text_color;
            $gradient_css[] = 'border: none';
            $gradient_css[] = 'background-color: ' . $gradient_color_1;
            $gradient_css[] = 'background-image: -webkit-linear-gradient(left, ' . $gradient_color_1 . ' 0%, ' . $gradient_color_2 . ' 50%,' . $gradient_color_1 . ' 100%)';
            $gradient_css[] = 'background-image: linear-gradient(to right, ' . $gradient_color_1 . ' 0%, ' . $gradient_color_2 . ' 50%,' . $gradient_color_1 . ' 100%)';
            $gradient_css[] = '-webkit-transition: all .2s ease-in-out';
            $gradient_css[] = 'transition: all .2s ease-in-out';
            $gradient_css[] = 'background-size: 200% 100%';

            // hover css
            $gradient_css_hover = array();
            $gradient_css_hover[] = 'color: ' . $button_text_color;
            $gradient_css_hover[] = 'background-color: ' . $gradient_color_2;
            $gradient_css_hover[] = 'border: none';
            $gradient_css_hover[] = 'background-position: 100% 0';

            $uid = uniqid();
            echo '<style type="text/css">.vc_btn3-style-' . $style . '.vc_btn-gradient-btn-' . $uid . ':hover{' . implode( ';', $gradient_css_hover ) . ';' . '}</style>';
            echo '<style type="text/css">.vc_btn3-style-' . $style . '.vc_btn-gradient-btn-' . $uid . '{' . implode( ';', $gradient_css ) . ';' . '}</style>';
            $button_classes[] = 'vc_btn-gradient-btn-' . $uid;
            $attributes[] = 'data-vc-gradient-1="' . $gradient_color_1 . '"';
            $attributes[] = 'data-vc-gradient-2="' . $gradient_color_2 . '"';
        } else {
            $button_classes[] = ( $style == 'perch' )? $color: 'vc_btn3-color-' . $color;
        }

        if ( $styles ) {
            $attributes[] = 'style="' . implode( ' ', $styles ) . '"';
        }

        $class_to_filter = implode( ' ', array_filter( $wrapper_classes ) );
        //$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' );
        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, 'perch_vc_button', $atts );
       
        if ( $button_classes ) {
            if($add_image == 'yes'){
                $button_html = '<img src="'.esc_url($button_image).'" alt="'.esc_attr($btn_title).'" class="img-fluid" width="'.intval($btn_image_width).'">';
                $use_link = true;
            }else{
                $button_classes = esc_attr( apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $button_classes ) ), 'perch_vc_button', $atts ) );
                $attributes[] = 'class="' . trim( $button_classes ) . '"';
            }
        }

        
      

        if ( $use_link ) {
            $attributes[] = 'href="' . trim( $a_href ) . '"';
            $attributes[] = 'title="' . esc_attr( trim( $a_title ) ) . '"';
            if ( ! empty( $a_target ) ) {
                $attributes[] = 'target="' . esc_attr( trim( $a_target ) ) . '"';
            }
            if ( ! empty( $a_rel ) ) {
                $attributes[] = 'rel="' . esc_attr( trim( $a_rel ) ) . '"';
            }
        }

        if ( ! empty( $custom_onclick ) && $custom_onclick_code ) {
            $attributes[] = 'onclick="' . esc_attr( $custom_onclick_code ) . '"';
        }

        $attributes = implode( ' ', $attributes );
        $wrapper_attributes = array();
        if ( ! empty( $btn_el_id ) ) {
            $wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
        }



        $output = '<div class="'.trim( esc_attr( $css_class ) ).'" '.implode( ' ', $wrapper_attributes ).'>';
         
            if ( $use_link ) {
                $output .= '<a ' . $attributes . '>' . $button_html . '</a>';
            } else {
                $output .=  '<button ' . $attributes . '>' . $button_html . '</button>';
            }
        $output .=  '</div>';


        return wpb_js_remove_wpautop($output);
    }


    //********************************//
    // GOOGLE FONTS PRIVATE FUNCTIONS // 
    //********************************//
     
    // Build the string of values in an Array
    public static function getFontsData( $fontsString ) {   
     
        // Font data Extraction
        $googleFontsParam = new Vc_Google_Fonts();      
        $fieldSettings = array();
        $fontsData = strlen( $fontsString ) > 0 ? $googleFontsParam->_vc_google_fonts_parse_attributes( $fieldSettings, $fontsString ) : '';
        return $fontsData;
         
    }
     
    // Build the inline style starting from the data
    public static function googleFontsStyles( $fontsData, $array = false ) {
         
        // Inline styles
        $fontFamily = explode( ':', $fontsData['values']['font_family'] );
        $styles[] = 'font-family:' . $fontFamily[0];
        $fontStyles = explode( ':', $fontsData['values']['font_style'] );
        $styles[] = 'font-weight:' . $fontStyles[1];
        $styles[] = 'font-style:' . $fontStyles[2];

        if( $array ){
            $_arr = array();
            $_fontFamily = explode( ':', $fontsData['values']['font_family'] );
            $_arr[] = 'font-family:' . $fontFamily[0];
            return $_arr;

        }else{
            $inline_style = '';     
            foreach( $styles as $attribute ){           
                $inline_style .= $attribute.'; ';       
            }   
             
            return $inline_style;
        }
         
        
         
    }
     
    // Enqueue right google font from Googleapis
    public static function enqueueGoogleFonts( $fontsData, $key="" ) {
         
        // Get extra subsets for settings (latin/cyrillic/etc)
        $settings = get_option( 'wpb_js_google_fonts_subsets' );
        if ( is_array( $settings ) && ! empty( $settings ) ) {
            $subsets = '&subset=' . implode( ',', $settings );
        } else {
            $subsets = '';
        }

        if( $key == '' ){
            $key = 'vc_google_fonts_' . vc_build_safe_css_class( $fontsData['values']['font_family'] );
        }

        // We also need to enqueue font from googleapis
        if ( isset( $fontsData['values']['font_family'] ) ) {
            wp_enqueue_style( 
              $key  , 
                '//fonts.googleapis.com/css?family=' . $fontsData['values']['font_family'] . $subsets
            );
        }
         
    } 

    public static function admin_vc_view($atts, $admin_params){
        if( isset($atts['icon_type']) && ($atts['icon_type'] != '') ){
            echo PerchVcMap::icon_html($atts);
        }
        if( isset($atts['custom_src']) && ($atts['custom_src'] != '') ){
            echo '<img src="'.esc_url($atts['custom_src']).'" alt="vc-image" width="100">';
        }
        if( isset($atts['title']) && ($atts['title'] != '') ){
            $atts['title_tag'] = 'h5';
            echo landpick_get_parse_text_html($atts['title'], $atts, 'title');
        }
        if( isset($atts['subtitle']) && ($atts['subtitle'] != '') ){
            $atts['subtitle_tag'] = 'p';
            echo landpick_get_parse_text_html($atts['subtitle'], $atts, 'subtitle');
        }

        //params
        $paramsArr = array();
        if( isset($atts['params']) && ($atts['params'] != '') ){
            $paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($atts['params']) : array();
            if( !empty($paramsArr) ):
                echo '<ul class="list-inline">';
                foreach ($paramsArr as $key => $value) {
                   extract($value);
                   echo '<li>';
                   if( $title && ($title != '') ){
                        echo '<strong>Title:</strong> '.esc_attr($title);
                   }
                   if( $subtitle && ($subtitle != '') ){
                        echo '<strong>Sub-Title:</strong> '.esc_attr($subtitle);
                   }
                   if( $image && ($image != '') ){
                        echo '<strong>Image:</strong> <img src="'.esc_url($image).'" alt="vc-image" width="50">';
                   }
                  
                   echo '</li>';
                }
                echo '</ul>';
            endif;
        }

        //params2
        $paramsArr = array();
        if( isset($atts['params2']) && ($atts['params2'] != '') ){
            $paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($atts['params2']) : array();
            if( !empty($paramsArr) ):
                echo '<ul class="list-inline">';
                foreach ($paramsArr as $key => $value) {
                   extract($value);
                   echo '<li>';
                   if( $title && ($title != '') ){
                        echo '<strong>Title:</strong> '.esc_attr($title);
                   }
                   if( $subtitle && ($subtitle != '') ){
                        echo '<strong>Sub-Title:</strong> '.esc_attr($subtitle);
                   }
                   if( $image && ($image != '') ){
                        echo '<strong>Image:</strong> <img src="'.esc_url($image).'" alt="vc-image" width="50">';
                   }
                   echo '</li>';
                }
                echo '</ul>';
            endif;
        }
       
        //list_group
        $paramsArr = array();
        if( isset($atts['list_group']) && ($atts['list_group'] != '') ){
            $paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($atts['list_group']) : array();
            if( !empty($paramsArr) ):
                echo '<ul class="list-inline">';
                foreach ($paramsArr as $key => $value) {
                   extract($value);
                   echo '<li>';
                   if( $title && ($title != '') ){
                        echo '<strong>Title:</strong> '.esc_attr($title);
                   }
                   if( $subtitle && ($subtitle != '') ){
                        echo '<strong>Sub-Title:</strong> '.esc_attr($subtitle);
                   }
                   if( $image && ($image != '') ){
                        echo '<strong>Image:</strong> <img src="'.esc_url($image).'" alt="vc-image" width="50">';
                   }
                   echo '</li>';
                }
                echo '</ul>';
            endif;
        }

        $haystack = array('title', 'subtitle', 'custom_src', 'image', 'params', 'params2', 'list_group' );

        $btn_group = PerchVcMap::button_args();
        $btn_group = array_merge($btn_group, PerchVcMap::icon_args());
        $btn_group = array_merge($btn_group, PerchVcMap::heighlights_text_args());
        foreach ($btn_group as $param) {
            $haystack[] = $param['param_name'];
        }

        $params = '';
        foreach ($atts as $key => $value) {
            $orginal_value = $value;
            if( !in_array($key, $haystack) && ( $value != '' ) ){
                $heading = (($admin_params[$key]['heading'] != '') && ($orginal_value != 'default') && ($orginal_value != ''))? '<strong>'.$admin_params[$key]['heading'].'</strong>: ' : '';
                if( $admin_params[$key]['type'] == 'dropdown' ){                    
                    $_value = $admin_params[$key]['value'];
                    $_value = array_flip($_value);
                    $value = $_value[$value];
                    $params .= ($heading != '')? $heading. $value . ', ' : '';
                }else{
                    $params .= ($heading != '')?  $heading. $value . ', ' : '';
                }
                
            }
        }

        if( $params != '' ){
            echo '<p class="p values">'.$params.'</p>';
        }
      

    }  

    public static function perch_vc_get_params_array($map_arr){        
    
         
        $newarray = array();
        foreach ($map_arr as $key => $value) {
            $param_name = isset($value['param_name'])? $value['param_name'] : '';
            $std = '';
            if(isset($value['value']) ){
                if( is_array($value['value']) ) {
                    $array = $value['value']; reset($array); $std = key($array);
                }else {
                    $std = $value['value'];
                }
            }
            $std = isset($value['std'])? $value['std'] : $std;

            if( $param_name != '' ){
                $newarray[$param_name] = $std;
            }
        }          
       
        if( !empty($newarray) ) $map_arr = $newarray;
       
        
        return $map_arr;

    }
    
    
    public function vc_admin_view(){
         
        $paramsArr = $_POST['params'];    
        $paramsArr['title_animation'] = '';
        $paramsArr['subtitle_animation'] = '';
        $paramsArr['css_animation'] = '';
        //var_dump($paramsArr);
        $params = ' ';
        foreach ($paramsArr as $key => $value) {
            $params .= ' '.$key.'="'.$value.'"';
        }
       //echo $params;

        $admin_view_style = ot_get_option('vc_admin_view', 'full');

        $base = $_POST['element'];
        if( $admin_view_style == 'simple' ){
            $admin_params = $_POST['admin_params'];
            if($admin_params != ''){
                echo PerchVcMap::admin_vc_view($paramsArr, $admin_params);
            }
        }else{
           echo do_shortcode('['.$base.$params.']'); 
        }
        

        wp_die();
    }

    public function carousel_output($html){

        if( is_user_logged_in() ){
             wp_enqueue_script( 'perch-scripts' );
            $html .=  '<div id="perch-vc-frontend-scripts"></div>';
        }
        return $html;
    }
     
} // End Element Class
 
 
// Element Class Init
new PerchVcMap();