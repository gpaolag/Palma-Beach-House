<?php
/**
* The VC Functions
*/
add_action( 'vc_before_init', 'pergo_event_info_group_shortcode_vc' );
function pergo_event_info_group_shortcode_vc( $return = false ) {
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Event info group', 'pergo' ),
        'base' => 'pergo_event_info_group',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo new', 'pergo' ),
        'description' => __( 'Display event infos with title, desc & time', 'pergo' ),
        'params' => array(       
            // params group
            array(
                'type' => 'param_group',
                'save_always' => true,
                'heading' => __( 'Brands', 'pergo' ),
                'param_name' => 'params',
                'value' => urlencode( json_encode( array(
                    array(
                        'start' => '8:45 AM',
                        'end' => '9:00 AM',
                        'title' => 'Welcome & Registration',
                        'subtitle' => '',
                        'desc' => 'Continental breakfast and registration for Eventador\'18. Pick up your name badge and goodie bag', 
                        'info' => ''                         
                    ),
                    array(
                        'start' => '9:10 AM',
                        'end' => '10:45 AM',
                        'title' => 'Spotlight & Breakout Sessions',
                        'subtitle' => 'J.Barnes - Founder & Executive Chairman',
                        'desc' => 'Continental breakfast and registration for Eventador\'18. Pick up your name badge and goodie bag', 
                        'info' => ''                         
                    ),
                    array(
                        'start' => '11:00 AM',
                        'end' => '12:30 AM',
                        'title' => 'Content as Conversation',
                        'subtitle' => 'R.Peterson - VIP Technology Sales
                        E.Martinez - Author of "Some Book"',
                        'desc' => 'Continental breakfast and registration for Eventador\'18. Pick up your name badge and goodie bag',  
                        'info' => ''                      
                    ),
                    array(
                        'start' => '12:40 AM',
                        'end' => '1:30 PM',
                        'title' => 'Afternoon Lunch Break',
                        'subtitle' => '',
                        'desc' => 'Head out & our stewards will direct you to one of the three places lunch is being served - the downstairs bar, upstairs bar and front reception space.',
                        'info' => '* Please be back in your seats for 1:30 PM, when the afternoon session will get going'                        
                    ),
                ) ) ),
                'params' => array(
                     array(
                        'type' => 'textfield',
                        'heading' => __( 'Title', 'pergo' ),
                        'param_name' => 'title',
                        'description' => '',
                        'value' => 'Crafting a Creative Culture',
                        'admin_label' => true 
                    ),
                     array(
                        'type' => 'textfield',
                        'heading' => __( 'Start time', 'pergo' ),
                        'param_name' => 'start',
                        'description' => '',
                        'value' => '1:40 PM',
                        'admin_label' => true 
                    ),
                     array(
                        'type' => 'textfield',
                        'heading' => __( 'End time', 'pergo' ),
                        'param_name' => 'end',
                        'description' => '',
                        'value' => '3:00 PM',
                        'admin_label' => true 
                    ),
                    array(
                        'type' => 'textarea',
                        'heading' => __( 'Sub-Title', 'pergo' ),
                        'param_name' => 'subtitle',
                        'description' => '',
                        'value' => 'R.Peterson - VIP Technology Sales',
                    ),
                    array(
                        'type' => 'textarea',
                        'heading' => __( 'Description', 'pergo' ),
                        'param_name' => 'desc',
                        'description' => '',
                        'value' => 'Semper lacus cursus porta, magna mauris sapien risus auctor purus apien feugiat rabitur nulla sapien',
                    ),
                    array(
                        'type' => 'textarea',
                        'heading' => __( 'Notice', 'pergo' ),
                        'param_name' => 'info',
                        'description' => '',
                        'value' => '',
                    ),
                ) 
            )  
        ) 
    );

   $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
    if( $return ) {
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}
class WPBakeryShortCode_Pergo_event_info_group extends WPBakeryShortCode {
}