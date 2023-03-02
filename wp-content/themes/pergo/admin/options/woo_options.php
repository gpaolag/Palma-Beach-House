<?php
function pergo_woo_options( $options = array( ) ) {
    $options = array( 
        array(
             'id' => 'woo_products_option_tab',
            'label' => __( 'Products settings', 'pergo' ),
            'type' => 'tab',
            'section' => 'woo_options',
        ),
        array(
             'id' => 'shop_layout',
            'label' => __( 'Shop layout', 'pergo' ),
            'desc' => '',
            'std' => 'full',
            'type' => 'radio-image',
            'section' => 'woo_options',
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
             'id' => 'shop_layout_sidebar',
            'label' => __( 'Select shop Sidebar', 'pergo' ),
            'desc' => '',
            'std' => 'sidebar-product',
            'type' => 'sidebar-select',
            'section' => 'woo_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'condition' => 'shop_layout:not(full)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'loop_columns',
            'label' => __( 'Products column', 'pergo' ),
            'desc' => '',
            'std' => '3',
            'type' => 'numeric-slider',
            'section' => 'woo_options',
            'min_max_step' => '1,4,1',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'shop_per_page',
            'label' => __( 'Products per page', 'pergo' ),
            'desc' => '',
            'std' => '9',
            'type' => 'numeric-slider',
            'section' => 'woo_options',
            'min_max_step' => '-1,15,1',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'catalog_image_width',
            'label' => __( 'Catalog Images Width', 'pergo' ),
            'desc' => __( 'The size used in product listing.', 'pergo' ),
            'std' => '400',
            'type' => 'numeric-slider',
            'section' => 'woo_options',
            'min_max_step' => '350,1200,1',
            'class' => '',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'catalog_image_height',
            'label' => __( 'Catalog Images height', 'pergo' ),
            'desc' => __( 'The size used in product listing.', 'pergo' ),
            'std' => '500',
            'type' => 'numeric-slider',
            'section' => 'woo_options',
            'min_max_step' => '350,1000,1',
            'class' => '',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'woo_product_option_tab',
            'label' => __( 'Single product settings', 'pergo' ),
            'type' => 'tab',
            'section' => 'woo_options',
        ), 
        array(
             'id' => 'single_product_header',
            'label' => __( 'Single product header', 'pergo' ),
            'desc' => '',
            'std' => 'off',
            'type' => 'on-off',
            'section' => 'woo_options' 
        ),
        array(
             'id' => 'product_layout',
            'label' => __( 'Product layout', 'pergo' ),
            'desc' => '',
            'std' => 'rs',
            'type' => 'radio-image',
            'section' => 'woo_options',
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
            'id'          => 'product_tab_style',
            'label'       => __( 'Product tab style', 'pergo' ),
            'std'         => 'semirounded-tab',
            'type'        => 'select',
            'section'     => 'woo_options',
            'class'       => '',
            'condition'   => '',
            'operator'    => 'and',
            'choices'   => array(
                array(
                    'label' => 'Default',
                    'value' => 'semirounded-tab' 
                    ),
                array(
                    'label' => 'Rounded',
                    'value' => 'rounded-tab' 
                    ),
                )
        ),
        array(
             'id' => 'product_layout_sidebar',
            'label' => __( 'Product Sidebar', 'pergo' ),
            'desc' => '',
            'std' => 'sidebar-product',
            'type' => 'sidebar-select',
            'section' => 'woo_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '',
            'class' => '',
            'condition' => 'product_layout:not(full)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'single_image_width',
            'label' => __( 'Single Product Image Width', 'pergo' ),
            'desc' => __( 'This size used in single product page.', 'pergo' ),
            'std' => '600',
            'type' => 'numeric-slider',
            'section' => 'woo_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '400,1200,5',
            'class' => '',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'single_image_height',
            'label' => __( 'Single Product Image height', 'pergo' ),
            'desc' => __( 'This size used in single product page.', 'pergo' ),
            'std' => '700',
            'type' => 'numeric-slider',
            'section' => 'woo_options',
            'rows' => '',
            'post_type' => '',
            'taxonomy' => '',
            'min_max_step' => '400,1000,5',
            'class' => '',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
             'id' => 'related_product_display',
            'label' => __( 'Related product show in single product', 'pergo' ),
            'desc' => '',
            'std' => 'on',
            'type' => 'on-off',
            'section' => 'woo_options',
            'condition' => '',
            'operator' => 'and' 
        ),
        array(
            'id' => 'related_product_title',
            'label' => esc_attr__( 'Related products title', 'pergo' ),
            'desc' => '',
            'std' => '',
            'type' => 'text',
            'section' => 'woo_options',
            'condition' => 'related_product_display:is(on)' 
        ),
        array(
             'id' => 'related_loop_columns',
            'label' => __( 'Related Products column', 'pergo' ),
            'desc' => '',
            'std' => '2',
            'type' => 'numeric-slider',
            'section' => 'woo_options',
            'min_max_step' => '1,4,1',
            'condition' => 'related_product_display:is(on)',
            'operator' => 'and' 
        ),
        array(
             'id' => 'related_products_per_page',
            'label' => __( 'Related Products display', 'pergo' ),
            'desc' => '',
            'std' => '2',
            'type' => 'numeric-slider',
            'section' => 'woo_options',
            'min_max_step' => '2,12,1',
            'condition' => 'related_product_display:is(on)',
            'operator' => 'and' 
        ),
    );
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        return apply_filters( 'pergo_woo_options', $options );
    } //in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )
    else {
        return array(
             array(
                 'id' => 'woo_info',
                'label' => 'Woocommerce',
                'desc' => __( 'Woocommerce plugin is Required. Installed & activated woocommerce plugin to get Woo options', 'pergo' ),
                'std' => '3',
                'type' => 'textblock',
                'section' => 'woo_options' 
            ) 
        );
    }
}
?>