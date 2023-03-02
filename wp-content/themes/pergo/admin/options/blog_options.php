<?php
function pergo_blog_options( $options = array( ) ) {
    $options = array(
        array(
             'id' => 'Blog_option_tab',
            'label' => __( 'Blog settings', 'pergo' ),
            'type' => 'tab',
            'section' => 'blog_options',
        ),
        array(
             'id' => 'blog_layout',
            'label' => __( 'Blog layout', 'pergo' ),
            'desc' => '',
            'std' => 'rs',
            'type' => 'radio-image',
            'section' => 'blog_options',
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
             'id' => 'blog_layout_sidebar',
            'label' => __( 'Blog Sidebar', 'pergo' ),
            'desc' => '',
            'std' => 'sidebar-1',
            'type' => 'sidebar-select',
            'section' => 'blog_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'condition' => 'blog_layout:not(full)',
            'operator' => 'and' 
        ),
         array(
             'id' => 'sticky_post_text',
            'label' => __( 'Sticky post text', 'pergo' ),
            'desc' => '',
            'std' => 'Sticky',
            'type' => 'text',
            'section' => 'blog_options',
            'condition' => '',
            'operator' => 'and' 
        ),
         array(
             'id' => 'post_meta_display',
            'label' => __( 'Post meta display', 'pergo' ),
            'desc' => '',
            'std' => 'on',
            'type' => 'on-off',
            'section' => 'blog_options' 
        ),
        array(
            'id'          => 'post_meta',
            'label'       => __( 'Post meta options', 'pergo' ),
            'std'         => array('date', 'category'),
            'type'        => 'checkbox',
            'section'     => 'blog_options',
            'condition'   => 'post_meta_display:is(on)',
            'operator'    => 'and',
            'choices'     => array(                 
              array(
                'value'       => 'date',
                'label'       => __( 'Post date', 'pergo' ),
              ),
              array(
                'value'       => 'category',
                'label'       => __( 'Post category', 'pergo' ),
              ),
              array(
                'value'       => 'author',
                'label'       => __( 'Post author', 'pergo' ),
              ),
              array(
                'value'       => 'comment',
                'label'       => __( 'Post comments', 'pergo' ),
              )
            )
        ),
        array(
             'id' => 'excerpt_length',
            'label' => __( 'Excerpt Length', 'pergo' ),
            'desc' => '',
            'std' => '40',
            'type' => 'numeric-slider',
            'section' => 'blog_options',
            'min_max_step' => '1,150,1',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'read_more_text',
            'label' => __( 'Read more text', 'pergo' ),
            'desc' => '',
            'std' => 'More Details',
            'type' => 'text',
            'section' => 'blog_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'next_post_text',
            'label' => __( 'Next post text', 'pergo' ),
            'desc' => '',
            'std' => 'Next',
            'type' => 'text',
            'section' => 'blog_options' 
        ),
        array(
             'id' => 'prev_post_text',
            'label' => __( 'Previous post text', 'pergo' ),
            'desc' => '',
            'std' => 'Previous',
            'type' => 'text',
            'section' => 'blog_options' 
        ),        
        array(
             'id' => 'Single_post_option_tab',
            'label' => __( 'Single post settings', 'pergo' ),
            'type' => 'tab',
            'section' => 'blog_options',
        ),
        array(
             'id' => 'single_post_header',
            'label' => __( 'Single post header', 'pergo' ),
            'desc' => '',
            'std' => 'off',
            'type' => 'on-off',
            'section' => 'blog_options' 
        ),
        array(
             'id' => 'single_layout',
            'label' => __( 'Single post layout', 'pergo' ),
            'desc' => '',
            'std' => 'rs',
            'type' => 'radio-image',
            'section' => 'blog_options',
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
            'id'          => 'single_post_title_tag',
            'label'       => esc_attr__( 'Single portfolio title tag', 'pergo' ),
            'std'         => 'h3',
            'type'        => 'select',           
            'section'     => 'blog_options',
            'operator'    => 'and',
            'choices'     => array(                 
              array(
                'value'       => 'h1',
                'label'       => esc_attr__( 'H1', 'pergo' ),
              ),
              array(
                'value'       => 'h2',
                'label'       => esc_attr__( 'H2', 'pergo' ),
              ),
              array(
                'value'       => 'h3',
                'label'       => esc_attr__( 'H3', 'pergo' ),
              ),
              array(
                'value'       => 'h4',
                'label'       => esc_attr__( 'H4', 'pergo' ),
              ),
              array(
                'value'       => 'h5',
                'label'       => esc_attr__( 'H5', 'pergo' ),
              ),
              array(
                'value'       => 'h6',
                'label'       => esc_attr__( 'H6', 'pergo' ),
              )
            )
        ),
        array(
            'id'          => 'single_post_title_tag_size',
            'label'       => esc_attr__( 'Single portfolio title tag size', 'pergo' ),
            'std'         => 'xs',
            'type'        => 'select',           
            'section'     => 'blog_options',
            'operator'    => 'and',
            'choices'     => array(                 
              array(
                'value'       => '',
                'label'       => esc_attr__( 'Initial', 'pergo' ),
              ),
              array(
                'value'       => 'xl',
                'label'       => esc_attr__( 'Extra large', 'pergo' ),
              ),
              array(
                'value'       => 'lg',
                'label'       => esc_attr__( 'Large', 'pergo' ),
              ),
              array(
                'value'       => 'md',
                'label'       => esc_attr__( 'Medium', 'pergo' ),
              ),
              array(
                'value'       => 'sm',
                'label'       => esc_attr__( 'Small', 'pergo' ),
              ),
              array(
                'value'       => 'xs',
                'label'       => esc_attr__( 'Extra small', 'pergo' ),
              )
            )
        ),
        array(
             'id' => 'single_layout_sidebar',
            'label' => __( 'Single post Sidebar', 'pergo' ),
            'desc' => '',
            'std' => 'sidebar-1',
            'type' => 'sidebar-select',
            'section' => 'blog_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'condition' => 'single_layout:not(full)',
            'operator' => 'and' 
        ),
        array(
            'id'          => 'single_post_meta',
            'label'       => __( 'Single post meta options', 'pergo' ),
            'std'         => array('date', 'category'),
            'type'        => 'checkbox',
            'section'     => 'blog_options',
            'condition'   => 'post_meta_display:is(on)',
            'operator'    => 'and',
            'choices'     => array(                 
              array(
                'value'       => 'date',
                'label'       => __( 'Post date', 'pergo' ),
              ),
              array(
                'value'       => 'category',
                'label'       => __( 'Post category', 'pergo' ),
              ),
              array(
                'value'       => 'author',
                'label'       => __( 'Post author', 'pergo' ),
              ),
              array(
                'value'       => 'comment',
                'label'       => __( 'Post comments', 'pergo' ),
              )
            )
        ),
        array(
             'id' => 'single_post_share',
            'label' => __( 'Single post share', 'pergo' ),
            'desc' => '',
            'std' => 'off',
            'type' => 'on-off',
            'section' => 'blog_options' 
        ),
        array(
             'id' => 'single_post_sharing_style',
            'label' => __( 'Sharing Icon style', 'pergo' ),
            'desc' => '',
            'std' => 'color',
            'type' => 'select',
            'section' => 'blog_options',
            'condition' => 'single_post_share:is(on)',
            'operator' => 'and',
            'choices' => array(
                array(
                     'label' => 'Colored icon',
                    'value' => 'color' 
                ),
                array(
                     'label' => 'Grey icon',
                    'value' => 'grey' 
                ),
            ) 
        ),
        array(
             'id' => 'realted_post_display',
            'label' => __( 'Display related posts', 'pergo' ),
            'desc' => '',
            'std' => 'on',
            'type' => 'on-off',
            'section' => 'blog_options' 
        ),
        array(
             'id' => 'related_title',
            'label' => __( 'Related Posts title', 'pergo' ),
            'desc' => '',
            'std' => 'Related Posts',
            'type' => 'text',
            'section' => 'blog_options',
            'condition' => 'realted_post_display:is(on)' 
        ),
        array(
             'id' => 'realted_post_base',
            'label' => __( 'Related posts based on', 'pergo' ),
            'desc' => '',
            'std' => 'tag',
            'type' => 'select',
            'section' => 'blog_options',
            'condition' => 'realted_post_display:is(on)', 
            'choices' => array(
                array( 'label' => 'Tags',  'value' => 'tag' ),
                array( 'label' => 'Category',  'value' => 'category' ),
            )
        ),
        array(
            'id'          => 'related_post_meta',
            'label'       => __( 'Related post meta options', 'pergo' ),
            'std'         => array('date', 'category'),
            'type'        => 'checkbox',
            'section'     => 'blog_options',
            'condition'   => 'post_meta_display:is(on)',
            'operator'    => 'and',
            'choices'     => array(                 
              array(
                'value'       => 'date',
                'label'       => __( 'Post date', 'pergo' ),
              ),
              array(
                'value'       => 'category',
                'label'       => __( 'Post category', 'pergo' ),
              ),
              array(
                'value'       => 'author',
                'label'       => __( 'Post author', 'pergo' ),
              ),
              array(
                'value'       => 'comment',
                'label'       => __( 'Post comments', 'pergo' ),
              )
            )
        ),
        
    );
    return apply_filters( 'pergo_blog_options', $options );
}
?>