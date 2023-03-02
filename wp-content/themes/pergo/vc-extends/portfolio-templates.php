<?php
/**
 * The VC Functions
 */
add_action( 'vc_before_init', 'pergo_portfolio_templates_shortcode_vc' );
function pergo_portfolio_templates_shortcode_vc( $return = false ) {
    $category = pergo_get_terms( 'portfolio_category', 'slug' );
    $category = ( !$category ) ? array( ) : $category;
    $args = array(
        'icon' => 'pergo-icon',
        'name' => __( 'Portfolio template', 'pergo' ),
        'base' => 'pergo_portfolios',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => __( 'Show Portfolio item with isotope, grid etc', 'pergo' ),
        'params' => array(             
            array(
                 'type' => 'dropdown',
                'heading' => __( 'Display type', 'pergo' ),
                'param_name' => 'template',
                'value' => array(
                    'Isotope style 1' => 'portfolio/isotope.php',
                    'Isotope with filter' => 'portfolio/isotope1.php',
                    'Carousel loop' => 'portfolio/carousel-loop.php',
                ),
                'admin_label' => true 
            ),
            array(
                'type' => 'number',
                'heading' => __( 'Column', 'pergo' ),
                'param_name' => 'column',
                'value' => '3',
                'min' => '2',
                'max' => '4',
                'step' => '1',
                'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array(
                     'element' => 'template',
                    'value' => array(
                         'portfolio/carousel-loop.php',
                        
                    ) 
                ) 
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Autoplay', 'pergo' ),
                'param_name' => 'autoplay',
                'std' => 'no',
                'value' => array(
                     'Yes' => 'yes',
                    'No' => 'no' 
                ),
                'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array(
                     'element' => 'template',
                    'value' => array(
                         'portfolio/carousel-loop.php' 
                    ) 
                ) 
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Dots', 'pergo' ),
                'param_name' => 'dots',
                'std' => 'no',
                'value' => array(
                     'Yes' => 'yes',
                    'No' => 'no' 
                ),
                'edit_field_class' => 'vc_col-sm-4',
                'dependency' => array(
                     'element' => 'template',
                    'value' => array(
                         'portfolio/carousel-loop.php' 
                    ) 
                ) 
            ), 
            array(
                'type' => 'dropdown',
                'heading' => __( 'Image size', 'pergo' ),
                'param_name' => 'img_size',
                'value' => array_flip( pergo_get_image_sizes_Arr() ),
                'description' => __( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)). Leave parameter empty to use "thumbnail" by default.', 'pergo' ),
                'std' => 'pergo-400x--nocrop' 
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Link type', 'pergo' ),
                'param_name' => 'link_type',
                'std' => 'popup',
                'value' => array(
                    'Popup' => 'popup',
                    'Link' => 'link',
                ),
                'admin_label' => true 
            ),
            array(
                'type' => 'number',
                'heading' => __( 'Posts per page', 'pergo' ),
                'param_name' => 'posts_per_page',
                'value' => 9,
                'min' => -1,
                'max' => '100',
                'step' => '1',
                'description' => 'Specify number of items that you want to show. Enter -1 to get all items',
                'admin_label' => true 
            ),
            array(
                'type' => 'perch_select',
                'multiple' => 'multiple',
                'heading' => __( 'Select category', 'pergo' ),
                'param_name' => 'tax_term',
                'value' => pergo_get_terms( 'portfolio_category' ),
                'group' => 'Portfolio settings',
                'description' => 'Default all category are selected',                
            ),
            array(
                'type' => 'perch_select',
                'heading' => __( 'Active category', 'pergo' ),
                'param_name' => 'active',
                'value' => array_merge( array(
                     '' => 'All' 
                ), $category ),
                'group' => 'Portfolio settings',
                'dependency' => array(
                     'element' => 'template',
                    'value' => 'portfolio/isotope.php' 
                ) 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Post ID\'s', 'pergo' ),
                'param_name' => 'id',
                'value' => '',
                'description' => 'Enter comma separated ID\'s of the posts that you want to show',
                'group' => 'Portfolio settings' 
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Taxonomy term operator', 'pergo' ),
                'param_name' => 'tax_operator',
                'description' => 'IN - posts that have any of selected categories terms<br/>NOT IN - posts that is does not have any of selected terms<br/>AND - posts that have all selected terms',
                'value' => array(
                     'IN' => 'IN',
                    'NOT IN' => 'NOT IN',
                    'AND' => 'AND' 
                ),
                'group' => 'Portfolio settings' 
            ),
            array(
                'type' => 'textfield',
                'heading' => __( 'Authors', 'pergo' ),
                'param_name' => 'author',
                'description' => 'Enter here comma-separated list of author\'s IDs. Example: 1,7,18',
                'group' => 'Portfolio settings' 
            ),
            array(
                'type' => 'perch_select',
                'heading' => __( 'Order', 'pergo' ),
                'param_name' => 'order',
                'description' => 'Posts order',
                'value' => array(
                     'desc' => __( 'Descending', 'pergo' ),
                    'asc' => __( 'Ascending', 'pergo' ) 
                ),
                'group' => 'Portfolio settings' 
            ),
            array(
                'type' => 'perch_select',
                'heading' => __( 'Order by', 'pergo' ),
                'param_name' => 'orderby',
                'description' => 'Order posts by',
                'selected' => 'date',
                'value' => array(
                     'none' => __( 'None', 'pergo' ),
                    'id' => __( 'Post ID', 'pergo' ),
                    'author' => __( 'Post author', 'pergo' ),
                    'title' => __( 'Post title', 'pergo' ),
                    'name' => __( 'Post slug', 'pergo' ),
                    'date' => __( 'Date', 'pergo' ),
                    'modified' => __( 'Last modified date', 'pergo' ),
                    'parent' => __( 'Post parent', 'pergo' ),
                    'rand' => __( 'Random', 'pergo' ),
                    'comment_count' => __( 'Comments number', 'pergo' ),
                    'menu_order' => __( 'Menu order', 'pergo' ),
                    'meta_value' => __( 'Meta key values', 'pergo' ) 
                ),
                'group' => 'Portfolio settings' 
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

