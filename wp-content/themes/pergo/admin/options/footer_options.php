<?php
function pergo_footer_options( $options = array( ) ) {
    $options = array(
        array(
             'id' => 'footer_Newsletter_option_tab',
            'label' => __( 'Newsletter settings', 'pergo' ),
            'type' => 'tab',
            'section' => 'footer_options',
        ), 
         array(
             'id' => 'newsletter_area',
            'label' => __( 'Newsletter area Display','pergo' ),
            'desc' => __( 'Display before footer area','pergo' ),
            'std' => 'on',
            'type' => 'on-off',
            'section' => 'footer_options' 
        ), 
        array(
             'id' => 'newsletter_bg',
            'label' => __( 'Newsletter background image', 'pergo' ),
            'std' => '',
            'type' => 'upload',
            'section' => 'footer_options',
            'condition' => 'newsletter_area:not(off)',
            'operator' => 'and' 
        ), 
        array(
             'id' => 'newsletter_title',
            'label' => __( 'Newsletter title', 'pergo' ),
            'desc' => __( 'Use {} to highlight text', 'pergo' ),
            'std' => __( 'Stay up to date with our news, ideas and updates', 'pergo' ),
            'type' => 'text',
            'section' => 'footer_options',
            'condition' => 'newsletter_area:not(off)',
            'operator' => 'and' 
        ), 
        array(
             'id' => 'newsletter_placeholder',
            'label' => __( 'Newsletter iemail placeholder', 'pergo' ),
            'std' => __( 'Your email address', 'pergo' ),
            'type' => 'text',
            'section' => 'footer_options',
            'condition' => 'newsletter_area:not(off)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'footer_Widget_option_tab',
            'label' => __( 'Widget area settings', 'pergo' ),
            'type' => 'tab',
            'section' => 'footer_options',
        ), 
        array(
             'id' => 'footer_widget_area',
            'label' => __( 'Footer widget area Display','pergo' ),
            'desc' => '',
            'std' => 'on',
            'type' => 'on-off',
            'section' => 'footer_options' 
        ),
        array(
            'id' => 'footer_bg_style',
            'label' => __('Footer background style', 'pergo'),
            'desc' => '',
            'std' => '',
            'type' => 'select',
            'choices' => array(           
                array( 'label' => 'Transparent', 'value' => '' ),
                array( 'label' => 'Light', 'value' => 'bg-light' ),
                array( 'label' => 'Grey', 'value' => 'bg-grey' ),
                array( 'label' => 'Dark', 'value' => 'bg-dark white-color' ),                    
           
            ),
            'section' => 'footer_options'
        ),
        array(
        'id'          => 'footer_background',
        'label'       => __( 'Footer background', 'pergo' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'background',
        'section'     => 'footer_options',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => 'footer_widget_area:is(on)',
        'operator'    => 'and',
        'action'   => array()
      ),
        array(
             'id' => 'footer_widget_area_column',
            'label' => __( 'Footer widget area column', 'pergo' ),
            'desc' => '',
            'std' => 4,
            'type' => 'numeric-slider',
            'section' => 'footer_options',
            'min_max_step' => '1,4,1',
            'condition' => 'footer_widget_area:is(on)',
            'operator' => 'and' 
            
        ), 
        array(
             'id' => 'footer_Copyright_option_tab',
            'label' => __( 'Copyright settings', 'pergo' ),
            'type' => 'tab',
            'section' => 'footer_options',
        ),        
        array(
             'id' => 'footer_copyright_bar',
            'label' => __( 'Footer copyright', 'pergo' ),
            'desc' => '',
            'std' => 'on',
            'type' => 'on-off',
            'section' => 'footer_options',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
            'id' => 'copyright_text',
            'label' => __( 'Copyright Text', 'pergo' ),
            'desc' => '',
            'std' => '&copy; ' . date( 'Y' ).' <span>Pergo.</span> All Rights Reserved',
            'type' => 'text',
            'section' => 'footer_options',
            'rows' => '2',
            'condition' => 'footer_copyright_bar:not(off)',
            'operator' => 'and' 
        ),

         array(
             'id' => 'footer_contact_option_tab',
            'label' => __( 'Quick contact form settings', 'pergo' ),
            'type' => 'tab',
            'section' => 'footer_options',
        ),
        array(
             'id' => 'quickform_area',
            'label' => __( 'Quick contact form Display','pergo' ),
            'desc' => __( 'Display in bottom of page','pergo' ),
            'std' => 'off',
            'type' => 'on-off',
            'section' => 'footer_options' 
        ),
        array(
             'id' => 'quickform_title',
            'label' => __( 'Contact form title', 'pergo' ),
            'std' => __( 'Quick Contact Form', 'pergo' ),
            'type' => 'text',
            'section' => 'footer_options',
            'operator' => 'and' 
        ),
        array(
             'id' => 'quickform_shortcode',
            'label' => __( 'Contact form shortcode', 'pergo' ),
            'std' => '',
            'desc' => __('Choose shortcode from Contact form 7.', 'pergo').' <a href="'.admin_url('admin.php?page=wpcf7').'" target="_blank">'.__('Click here', 'pergo').'</a>',
            'type' => 'text',
            'section' => 'footer_options',
            'operator' => 'and' 
        ),


        array(
             'id' => 'footer_backtotop_option_tab',
            'label' => __( 'Back to top settings', 'pergo' ),
            'type' => 'tab',
            'section' => 'footer_options',
        ),
        array(
             'id' => 'backtotop',
            'label' => __( 'Back to top Display','pergo' ),
            'desc' => __( 'Display in backtotop','pergo' ),
            'std' => 'on',
            'type' => 'on-off',
            'section' => 'footer_options',
        ),
        
    );
    return apply_filters( 'pergo_footer_options', $options );
}