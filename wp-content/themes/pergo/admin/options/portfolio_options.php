<?php
function pergo_portfolio_options( $options = array( ) ) {
    $options = array(
        array(
             'id' => 'Portfolio_option_tab',
            'label' => __( 'Portfolio settings', 'pergo' ),
            'type' => 'tab',
            'section' => 'portfolio_options',
        ),
         array(
             'id' => 'portfolio_archive',
            'label' => 'Portfolio Archive page',
            'desc' => sprintf( __( 'If archive page is not working, then save again <a href="%s" target="_blank">permalink settings</a>, For best performance use Pretty permalink(Example: Post name, Day and name etc)', 'pergo' ), admin_url( 'options-permalink.php' ) ),
            'std' => ( get_post_status( get_option( 'portfolio_archive_id' ) ) == 'publish' ) ? get_option( 'portfolio_archive_id' ) : '',
            'type' => 'page-select',
            'section' => 'portfolio_options',
            'rows' => '' 
        ),
         array(
             'id' => 'portfolio_all_text',
            'label' => __( 'Portfolio all text in filter', 'pergo' ),
            'desc' => '',
            'std' => 'All',
            'type' => 'text',
            'section' => 'portfolio_options',
            'operator' => 'and' 
        ),
         array(
             'id' => 'portfolio_archive_filter_display',
            'label' => __( 'Portfolio filter in archive page', 'pergo' ),
            'desc' => '',
            'std' => 'off',
            'type' => 'on-off',
            'section' => 'portfolio_options',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'portfolio_single_layout',
            'label' => __( 'Single portfolio layout', 'pergo' ),
            'desc' => '',
            'std' => 'full',
            'type' => 'radio-image',
            'section' => 'portfolio_options',
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
            'id'          => 'single_portfolio_title_tag',
            'label'       => esc_attr__( 'Single portfolio title tag', 'pergo' ),
            'std'         => 'h3',
            'type'        => 'select',           
            'section'     => 'portfolio_options',
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
            'id'          => 'single_portfolio_title_tag_size',
            'label'       => esc_attr__( 'Single portfolio title tag size', 'pergo' ),
            'std'         => 'xs',
            'type'        => 'select',           
            'section'     => 'portfolio_options',
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
             'id' => 'portfolio_single_layout_sidebar',
            'label' => __( 'Single portfolio Sidebar', 'pergo' ),
            'desc' => '',
            'std' => 'sidebar-1',
            'type' => 'sidebar-select',
            'section' => 'portfolio_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'condition' => 'portfolio_single_layout:not(full)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'single_portfolio_sharing_style',
            'label' => __( 'Sharing Icon style', 'pergo' ),
            'desc' => '',
            'std' => 'grey',
            'type' => 'select',
            'section' => 'portfolio_options',
            'condition' => '',
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
             'id' => 'display_single_related_portfolio',
            'label' => __( 'Related portfolio', 'pergo' ),
            'desc' => '',
            'std' => 'on',
            'type' => 'on-off',
            'section' => 'portfolio_options',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'related_portfolio_title',
            'label' => __( 'Related portfolio title', 'pergo' ),
            'desc' => '',
            'std' => 'Related portfolio',
            'type' => 'text',
            'section' => 'portfolio_options',
            'condition' => 'display_single_related_portfolio:is(on)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'related_portfolio',
            'label' => __( 'Related portfolio display', 'pergo' ),
            'min_max_step' => '-1,20,1',
            'std' => '3',
            'type' => 'numeric-slider',
            'section' => 'portfolio_options',
            'condition' => 'display_single_related_portfolio:is(on)',
            'operator' => 'and' 
        ), 
        array(
             'id' => 'Team_option_tab',
            'label' => __( 'Team settings', 'pergo' ),
            'type' => 'tab',
            'section' => 'portfolio_options',
        ),       
        array(
             'id' => 'team_archive',
            'label' => 'Team Archive page',
            'desc' => sprintf( __( 'If archive page is not working, then save again <a href="%s" target="_blank">permalink settings</a>, For best performance use Pretty permalink(Example: Post name, Day and name etc)', 'pergo' ), admin_url( 'options-permalink.php' ) ),
            'std' => ( get_post_status( get_option( 'team_archive_id' ) ) == 'publish' ) ? get_option( 'team_archive_id' ) : '',
            'type' => 'page-select',
            'section' => 'portfolio_options',
            'rows' => '' 
        ),
        array(
             'id' => 'display_team_hiring',
            'label' => __( 'Display team hiring', 'pergo' ),
            'desc' => '',
            'std' => 'on',
            'type' => 'on-off',
            'section' => 'portfolio_options',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'team_hiring_title',
            'label' => __( 'Team hiring title', 'pergo' ),
            'desc' => '',
            'std' => 'We Are Hiring!',
            'type' => 'text',
            'section' => 'portfolio_options',
            'condition' => 'display_team_hiring:is(on)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'team_hiring_link_text',
            'label' => __( 'Team hiring link text', 'pergo' ),
            'desc' => '',
            'std' => 'Become part of our team',
            'type' => 'text',
            'section' => 'portfolio_options',
            'condition' => 'display_team_hiring:is(on)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'team_hiring_link',
            'label' => __( 'Team hiring link', 'pergo' ),
            'desc' => '',
            'std' => '#',
            'type' => 'text',
            'section' => 'portfolio_options',
            'condition' => 'display_team_hiring:is(on)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'team_single_layout',
            'label' => __( 'Single team layout', 'pergo' ),
            'desc' => '',
            'std' => 'full',
            'type' => 'radio-image',
            'section' => 'portfolio_options',
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
             'id' => 'team_single_layout_sidebar',
            'label' => __( 'Single portfolio Sidebar', 'pergo' ),
            'desc' => '',
            'std' => 'sidebar-page',
            'type' => 'sidebar-select',
            'section' => 'portfolio_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'condition' => 'team_single_layout:not(full)',
            'operator' => 'and' 
        ),
        array(
            'id'          => 'single_team_title_tag',
            'label'       => esc_attr__( 'Single team title tag', 'pergo' ),
            'std'         => 'h3',
            'type'        => 'select',           
            'section'     => 'portfolio_options',
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
            'id'          => 'single_team_tag_size',
            'label'       => esc_attr__( 'Single team title tag size', 'pergo' ),
            'std'         => 'xs',
            'type'        => 'select',           
            'section'     => 'portfolio_options',
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
    );
    return apply_filters( 'pergo_portfolio_options', $options );
}
?>