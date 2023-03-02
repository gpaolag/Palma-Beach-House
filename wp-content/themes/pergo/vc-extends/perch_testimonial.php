<?php
if(class_exists('PerchVcMapListGroup')):
/*
Element Description: Testimonial
*/
 
// Element Class 
class PergoTestimonialsingle extends PerchVcMap {
     
    private $base = 'pergo_testimonials_single';

    private $title = 'Testimonial Single';
    
    function __construct() {
        // vc map inits
        add_action( 'init', array( $this, 'vc_mapping' ) );

        // Shortcode filter
        add_filter( $this->base, array( $this, 'perch_testimonial_output' ), 30, 2 ); 
        add_filter( $this->base.'_slide', array( $this, 'perch_testimonial_slide_output' ), 30, 2 ); 
    }

    private function testimonial_image(){
        $array = array(
            array(
                'type' => 'image_upload',
                'heading' => __( 'Reviewer Image', 'perch' ),
                'param_name' => 'image',
                'value' => get_template_directory_uri(). '/images/review-author-1.jpg', 
            ),
        );

        return $array;
    }

    private function testimonial_info_args(){
        $array = array(
            array(
                'type' => 'textfield',
                'heading' => __( 'Name', 'pergo' ),
                'param_name' => 'name',
                'value' => ' @p_paterson',
                'admin_label' => true 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Title', 'pergo' ),
                'param_name' => 'title',                
                'admin_label' => true 
            ),            
             array(
                'type' => 'dropdown',
                'heading' => __( 'Choose Rating', 'perch' ),
                'param_name' => 'review',                
                'value' => array(                    
                    'None' => '',
                    '5 out of 5' => 'star:star:star:star:star',                                  
                    '4.5 out of 5' => 'star:star:star:star:star-half',                                  
                    '4 out of 5' => 'star:star:star:star',                                  
                    '3.5 out of 5' => 'star:star:star:star-half',                                  
                    '3 out of 5' => 'star:star:star',                                  
                    '2.5 out of 5' => 'star:star:star-half',                                  
                    '2 out of 5' => 'star:star',                                  
                    '1.5 out of 5' => 'star:star-half',                                  
                    '1 out of 5' => 'star',                                  
                ),
            ),
             array(
                'type' => 'textarea',
                'heading' => __( 'Description', 'pergo' ),
                'param_name' => 'desc',
                'value' => '" Etiam sapien sem at sagittis congue augue massa varius sodales sapien undo tempus dolor        egestas magna suscipit magna tempus aliquet porta sodales augue suscipit luctus neque "',
            )
        );

        return $array;
    }

   

    // Title element mapping
    private function vc_map_args(){        

        $array = self::element_align_args();         
        $array = array_merge($array, self::testimonial_image());
        $array = array_merge($array, self::testimonial_info_args());
        $array = array_merge($array, PerchVcMap::element_common_args2());
         
        $array = apply_filters( 'perch_modules/vc/'.$this->base , $array);

        return $array;
    } 
     
     
    // Element HTML
    public function perch_testimonial_output( $atts, $content = NULL ) {
        $map_arr = self::vc_mapping(true);
        $args = PerchVcMap::get_vc_element_atts_array($map_arr, $content); 
        // Params extraction
        $atts = shortcode_atts( $args, $atts );

        $wrapper_attributes = perch_modules_shortcode_wrapper_attributes($atts, $this->base );        

        // Used for periodic animation
        PerchVcMap::periodic_animation_start($atts);

        extract($atts);
        $rating_html = '';
        $name_html = '<span class="name none">'.esc_attr($name).'</span>';
        $title_html = '<h5 class="h5-md">'.esc_attr($title).'</h5>';
        $desc_html = '<p>'.esc_attr($desc).'</p>';
        $image_html = '<div class="testimonial-avatar"><img src="'.esc_attr($image).'" alt="'.esc_attr($title).'"></div><!-- Author Avatar -->';
        $image_html2 = '<img src="'.esc_attr($image).'" alt="'.esc_attr($title).'"><!-- Author Avatar -->';
        if( $review != ''){
            $reviewArr = explode(':', $review);
           $rating_html = '<div class="app-rating">
                                <i class="fa fa-'.implode('"></i><i class="fas fa-', $reviewArr).'"></i>
                            </div><!-- App Rating -->'; 
        }

       

            $html = '<div '. implode( ' ', $wrapper_attributes ).'>
            <div class="mb-60 reviews-2">
                ' .$title_html.'
                <div class="testimonial-avatar">
                   '. $image_html .'
                </div><!-- Author Avatar -->

               '.$desc_html.'
               '. $name_html .'
               '. $rating_html .'
                            
            </div>
            </div>'."\n"; 

        
        

        PerchVcMap::periodic_animation_end();     
         
        return force_balance_tags($html);
         
    }

    public function perch_testimonial_slide_output( $atts, $content = NULL ) {
        $map_arr = self::vc_map_args();
        $args = PerchVcMap::get_vc_element_atts_array($map_arr, $content); 

        // Params extraction
        $atts = shortcode_atts( $args, $atts );

        $html ='<div class="perch-slide-item">';
        $html .= self::perch_testimonial_output($atts);
        $html .='</div>';

        return $html;
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
                'base' => 'pergo_testimonials_single',
                'name' => $this->title,                
                'description' => __('Display title & subtitle', 'perch'),                 
                'params' => $params,
                'js_view' => 'PerchVcElementPreview',
                'custom_markup' => '<div class="perch_vc_element_container">{{title}}</div>',  
                'admin_enqueue_js' =>   array( PERCH_MODULES_URI. '/assets/js/vc-admin-scripts.js'),       
            ); 
        // slide element
        $vc_map_slide = array(
                'class' => perch_shortcodes_vc_class(),
                'category' => perch_shortcodes_vc_category(),
                'base' => $this->base.'_slide',
                'name' => $this->title,                
                'description' => __('Display title & subtitle', 'perch'),                 
                'as_child'  => array('only' => 'perch_vc_carousel'),           
                'params' => $params,
                'js_view' => 'PerchVcElementPreview',
                'custom_markup' => '<div class="perch_vc_element_container">{{title}}</div>',        
            );
        
        vc_map( $vc_map );
        vc_map( $vc_map_slide );
        
    }
    
    
     
} // End Element Class 
 
// Element Class Init
new PergoTestimonialsingle();
endif;