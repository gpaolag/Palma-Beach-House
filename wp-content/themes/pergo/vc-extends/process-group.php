<?php
if(class_exists('PerchVcMapListGroup')):
/*
Element Description: List
*/

// Element Class 
class PergoProcess extends PerchVcMap {
     
    private $base = 'perch_process';

    private $title = 'Process Group';
    
    function __construct() {
        // vc map inits
        add_action( 'init', array( $this, 'vc_mapping' ) );

        // Shortcode filter
        add_filter( $this->base, array( $this, 'perch_cbox_output' ), 30, 2 ); 
    }

   

    // Title element mapping
    private function vc_map_args(){        
        $array = array();        
        
        $array = array_merge($array, self::cbox_group_args());
        $array = array_merge($array, PerchVcMap::element_common_args2());
         
        $array = apply_filters( 'perch_modules/vc/'.$this->base , $array);

        return $array;
    } 
     
     
    // Element HTML
    public function perch_cbox_output( $atts, $content = NULL ) {
        $map_arr = self::vc_mapping(true);
        $args = PerchVcMap::get_vc_element_atts_array($map_arr, $content); 
        // Params extraction
        $atts = shortcode_atts( $args, $atts );

        $wrapper_attributes = perch_modules_shortcode_wrapper_attributes($atts, $this->base );               

        // Used for periodic animation
        PerchVcMap::periodic_animation_start($atts);
      
        // Fill $html var with data
        $html ='
        <div '. implode( ' ', $wrapper_attributes ).'>                      
            '.self::cbox_group_html($atts).'     
        </div>';        

        PerchVcMap::periodic_animation_end();     
         
        return wpb_js_remove_wpautop($html);
         
    }    


    // Element Mapping
    public function vc_mapping( $return = false ) {
        $params = $this->vc_map_args();
        if($return) {
            return $params;  
        }        
       
       $vc_map = array(
                'class' => 'pergo-vc',
                'category' => __( 'Pergo new', 'pergo' ),
                'icon' => 'pergo-icon',
                'base' => $this->base,
                'name' => $this->title,                
                'description' => __('Display title & subtitle', 'pergo'),                 
                'params' => $params,
                'js_view' => 'PerchVcElementPreview',
                'custom_markup' => '<div class="perch_vc_element_container">{{title}}</div>',  
                'admin_enqueue_js' =>   array( PERCH_MODULES_URI. '/assets/js/vc-admin-scripts.js'),       
            ); 
       
        
        vc_map( $vc_map );
       
        
    }

    public static function cbox_args(){        
        $array =array(
                array(
                    'type' => 'image_upload',
                    'heading' => __( 'Icon Image', 'pergo' ),
                    'param_name' => 'image',
                    'description' => '',
                    'value' => PERGO_URI . '/images/add-user.png',
                    'edit_field_class' => 'vc_col-sm-8', 
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_attr__( 'Icon image size', 'pergo' ),
                    'param_name' => 'img_size',
                    'value' => '70',                    
                    'edit_field_class' => 'vc_col-sm-4', 
                ),                              
                array(
                    'type' => 'textfield',
                    'heading' => esc_attr__( 'List title', 'pergo' ),
                    'param_name' => 'title',
                    'description' => '',
                    'value' => 'Connect',
                    'admin_label' => true 
                ),
                 array(
                    'type' => 'textarea',
                    'heading' => esc_attr__( 'Description', 'pergo' ),
                    'param_name' => 'subtitle',
                    'description' => '',
                    'value' => 'Nemo ipsam egestas volute fugit dolores quaerat sodales',
                ),
            );        

        

        return $array;
    }

    public static function cbox_group_args(){
        $array = array(            
             array(
                'type' => 'dropdown',
                'heading' => esc_attr__( 'Process style', 'pergo' ),
                'param_name' => 'process_style',
                'std' => '1',
                'value' => array(
                    'Process style 1' => '1',                    
                    'Process style 2' => '2',                    
                    'Process style 3' => '3',                    
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_attr__( 'column', 'pergo' ),
                'param_name' => 'column_sm',
                'std' => '3',
                'value' => array(
                    '2 column' => '2',
                    '3 column' => '3',
                    '4 column' => '4',
                ) 
            ),
            array(
                'type' => 'param_group',
                'save_always' => true,
                'heading' => esc_attr__( 'List Group', 'pergo' ),
                'param_name' => 'list_group',                
                'value' => urlencode( json_encode( array(
                    array(                      
                        'icon_type' => 'flaticon',
                        'icon_flaticon' => 'flaticon-011-add-user-1',
                        'icon_color' => 'grey-color',
                        'icon_image' => get_template_directory_uri(). '/images/icons/add-user.png',
                        'img_icon_size' => '70',
                         'title' => 'Create Account',
                         'subtitle' => 'Nemo ipsam egestas volute fugit dolores quaerat sodales',
                    ),
                    array(                      
                        'icon_type' => 'flaticon',
                        'icon_flaticon' => 'flaticon-104-settings-2',
                        'icon_color' => 'grey-color',
                        'icon_image' => get_template_directory_uri(). '/images/icons/settings-4.png',
                        'img_icon_size' => '70',
                         'title' => 'Customize Profile',
                         'subtitle' => 'Nemo ipsam egestas volute fugit dolores quaerat sodales',
                    ),
                    array(                      
                        'icon_type' => 'flaticon',
                        'icon_flaticon' => 'flaticon-078-chat-2',
                        'icon_color' => 'grey-color',
                        'icon_image' => get_template_directory_uri(). '/images/icons/target.png',
                        'img_icon_size' => '70',
                         'title' => 'Enter Your Data',
                         'subtitle' => 'Nemo ipsam egestas volute fugit dolores quaerat sodales',
                    ),
                ) ) ),
                'params' => self::cbox_args()
            ),
            PerchVcMapListGroup::list_group_typography('title', 'Process box title', 'tag:h5|size:sm'),
            PerchVcMapListGroup::list_group_typography('subtitle', 'Process box Sub-Title', 'tag:p'),
        );

        return $array;
    }

    public static function cbox_html($value){
        $map_arr = self::cbox_group_args();       
        $_atts = $typo_atts = $value;
        $typo_atts['periodic_animation'] = '';
        $typo_atts['css_animation'] = '';
        extract($value);

      

        $output = '';

        $new_title = isset($value['title'])? $value['title'] : '';
        $new_subtitle = isset($value['subtitle'])? $value['subtitle'] : '';
        $typo_atts['title'] =  $new_title;                   
        $typo_atts['subtitle'] =  $new_subtitle; 
        $tag = 'div';
        $tag = apply_filters( 'perch/cbox/tag', $tag );
       

        if( ( $new_title != '') || ( $new_subtitle != '') ):                                      
            $li_attr = array();
            $classes = array('pbox-'.intval($process_style).' text-center', 'icon-xs'); 
            $classes = apply_filters( 'perch/cbox/classes', $classes );
            
            $classes = self::periodic_getCSSAnimation($classes, 'list_li', $_atts);               
            
           
            $classes = array_filter($classes);
            $li_attr[] = (!empty($classes))? 'class="'.implode(' ', $classes).'"' : ''; 
            $li_attr = self::periodic_wrapperAttributes($li_attr, 'list_li', $_atts );                   
            $li_attributes = implode( ' ', $li_attr );
            //$_class = ($process_style == 3 || $process_style == 1)? 'pbox-icon' : 'step-icon';
           $image_html = '<div class="pbox-icon">
            <img src="'.esc_url($image).'" alt="'.esc_attr($title).'" width="'.intval($img_size).'" class="img-fluid">
        </div>';
            $title_html = perch_modules_get_vc_param_html( 'title', $typo_atts );                    
            $subtitle_html = perch_modules_get_vc_param_html('subtitle', $typo_atts);  
            
                         

            $output = "<{$tag} {$li_attributes}>
                {$image_html}
                {$title_html}
                {$subtitle_html}                
            </{$tag}>";           
        endif;

        return $output;        
    }

    public static function cbox_group_html($atts){
        $_atts = $atts;       
        // typo attr
        $typo_atts = $atts;       

        extract($atts);      

        $paramsArr = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($list_group) : array();

        $classes = array('row');          
        $classes = array_filter($classes);
        $wrapper_attributes[] = (!empty($classes))?'class="'.implode(' ', $classes).'"' : '';        
        $wrapper_attributes = array_filter($wrapper_attributes);  
        $wrapper_attributes = apply_filters( 'perch_modules/wrapper_attributes', $wrapper_attributes, $atts);
  
        

        $output = '<div id="process-'.intval($process_style).'-type"><div '.implode( ' ', $wrapper_attributes ).'>';
        if(!empty($paramsArr)):
            $delay = 200;
            $paramsArr = array_filter($paramsArr);
            $count = 1;  
            $total = count($paramsArr);          
            foreach ($paramsArr as $key => $value) {
                $pclass = array( 'col-sm-'.(12/$column_sm) );
                $pclass[] = ($count % $column_sm == 0)? 'column-last' : '';
                $pclass = array_filter($pclass);

                $value['process_style'] = intval($process_style);
                $output .= '<div id="step-'.$count.'" class="'.implode(' ', $pclass).'">';
                $output .= self::cbox_html(array_merge($atts, $value));
                $output .= '</div>';
                $count++;
            }
        endif;
        $output .= '</div></div>';

        return $output;

    }

    public static function enable_pbox_button_group(){
        $array = array(
                array(
                    'type' => 'checkbox',
                    'heading' => esc_attr__( 'Enable Buttons?', 'pergo' ),
                    'param_name' => 'enable_buttons',
                    'value' => array( __( 'Yes', 'pergo' ) => 'yes' ),  
                    'admin_label' => true,
                ), 
                array(                
                  'heading' => esc_attr__( 'Button Group', 'pergo' ),
                  'param_name' => 'params',   
                  'type' => 'param_group',
                  'save_always' => true, 
                  'dependency' => array( 'element' => 'enable_buttons', 'value' => 'yes', ),            
                  'value' => urlencode( json_encode( array(
                      array(
                          'button_type' => 'text_btn', 
                          'img_btn' => get_template_directory_uri(). '/images/appstore.png',
                          'img_btn_size' => '160',                          
                          'button_text' => 'Learn More About It',
                          'button_url' => '#',
                          'button_target' => '_blank',
                      ),
                  ) ) ),
                  //'params' => PerchVcMapButtons::button_groups_param()
                ),
                array(
                    'type' => 'textfield',
                    'heading' => esc_attr__( 'Buttons description', 'pergo' ),
                    'param_name' => 'buttons_desc',
                    'value' => '',                
                    'dependency' => array( 'element' => 'enable_buttons', 'value' => 'yes', ),                  
                ),  
            );  
        return $array;
    } 
   
     
} // End Element Class 
 
// Element Class Init
new PergoProcess();
endif;