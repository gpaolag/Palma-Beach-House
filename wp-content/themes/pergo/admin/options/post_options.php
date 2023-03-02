<?php
function pergo_post_options( $options = array( ) ) {
    $options = array(
         array(
             'id' => 'single_post_header_style',
            'label' => __( 'Post header style', 'pergo' ),
            'desc' => '',
            'std' => 'banner',
            'type' => 'select',
            'section' => 'post_options',
            'condition' => '',
            'operator' => 'and',
            'choices' => array(
                 array(
                     'label' => 'Slider Style 1',
                    'value' => 'style1' 
                ),
                array(
                     'label' => 'Slider Style 2',
                    'value' => 'style2' 
                ),
                array(
                     'label' => 'Custom Shortcode',
                    'value' => 'shortcode' 
                ),
                array(
                     'label' => 'Leave blank',
                    'value' => 'empty' 
                ) 
            ) 
        ),
        array(
             'id' => 'single_post_shortcode',
            'label' => __( 'Post Banner Shortcode', 'pergo' ),
            'desc' => __( 'Use custom shortcode, you can create shortcode using revoulation slider.', 'pergo' ),
            'std' => '',
            'type' => 'text',
            'section' => 'post_options',
            'condition' => 'single_post_header_style:is(shortcode)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'single_layout',
            'label' => __( 'Single post layout', 'pergo' ),
            'desc' => '',
            'std' => 'rs',
            'type' => 'radio-image',
            'section' => 'post_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'condition' => '',
            'operator' => 'and',
            'choices' => array(
                 array(
                     'value' => 'full',
                    'label' => __( 'Full width', 'pergo' ),
                    'src' => OT_URL . '/assets/images/layout/full-width.png' 
                ),
                array(
                     'value' => 'ls',
                    'label' => __( 'Left sidebar', 'pergo' ),
                    'src' => OT_URL . '/assets/images/layout/left-sidebar.png' 
                ),
                array(
                     'value' => 'rs',
                    'label' => __( 'Right sidebar', 'pergo' ),
                    'src' => OT_URL . '/assets/images/layout/right-sidebar.png' 
                ) 
            ) 
        ),
        array(
             'id' => 'single_layout_sidebar',
            'label' => __( 'Single post Sidebar', 'pergo' ),
            'desc' => '',
            'std' => 'sidebar-1',
            'type' => 'sidebar-select',
            'section' => 'post_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'condition' => 'single_layout:not(full)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'single_post_sharing',
            'label' => __( 'Sharing Icon in single post', 'pergo' ),
            'desc' => '',
            'std' => 'on',
            'type' => 'on-off',
            'section' => 'post_options',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'single_related_posts',
            'label' => __( 'Show Related posts', 'pergo' ),
            'desc' => '',
            'std' => 'on',
            'type' => 'on-off',
            'section' => 'post_options',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'single_related_posts_title',
            'label' => __( 'Related posts title', 'pergo' ),
            'desc' => '',
            'std' => 'Related Posts',
            'type' => 'text',
            'section' => 'post_options',
            'condition' => 'single_related_posts:is(on)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'single_total_related_posts',
            'label' => __( 'Related posts display maximum', 'pergo' ),
            'desc' => '',
            'std' => '3',
            'type' => 'numeric-slider',
            'section' => 'post_options',
            'min_max_step' => '1,12,1',
            'condition' => 'single_related_posts:is(on)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'single_related_posts_column',
            'label' => __( 'Related posts column', 'pergo' ),
            'desc' => '',
            'std' => '3',
            'type' => 'numeric-slider',
            'section' => 'post_options',
            'min_max_step' => '1,4,1',
            'condition' => 'single_related_posts:is(on)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'single_post_options_css',
            'label' => __( 'CSS', 'pergo' ),
            'class' => 'hide-field',
            'desc' => '',
            'std' => '

.blog-header{

   {{single_post_header_background}}

} 



',
            'type' => 'css',
            'section' => 'post_options',
            'rows' => '20',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'condition' => '',
            'operator' => 'and' 
        ) 
    );
    return apply_filters( 'pergo_post_options', $options );
}
?>