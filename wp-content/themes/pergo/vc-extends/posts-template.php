<?php
/**

* The VC Functions

*/
add_action( 'vc_before_init', 'pergo_posts_shortcode_vc' );
function pergo_posts_shortcode_vc( $return = false ) {
    $category = pergo_get_terms( 'category', 'slug' );
    $category = ( !$category ) ? array( ) : $category;
    $args = array(
         'icon' => 'pergo-icon',
        'name' => __( 'Posts template', 'pergo' ),
        'base' => 'pergo_posts',
        'class' => 'pergo-vc',
        'category' => __( 'Pergo', 'pergo' ),
        'description' => '',
        'params' => array(
             array(
                 'type' => 'dropdown',
                'heading' => __( 'Display type', 'pergo' ),
                'param_name' => 'template',
                'value' => array(
                     'Default' => 'templates/default-loop.php',
                     'Isotope' => 'templates/isotope-loop.php',                       
                     'Carousel' => 'templates/carousel-loop.php' 
                ),
                'std' => 'templates/default-loop.php',
                'admin_label' => true 
            ),
            array(
                 'type' => 'dropdown',
                'heading' => __( 'Image size', 'pergo' ),
                'param_name' => 'img_size',
                'value' => array_flip( pergo_get_image_sizes_Arr() ),
                'description' => __( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)). Leave parameter empty to use "thumbnail" by default.', 'pergo' ),
                'std' => 'pergo-600x600-crop' 
            ),
            array(
                 'type' => 'number',
                'heading' => __( 'Excerpt length', 'pergo' ),
                'param_name' => 'excerpt_length',
                'value' => '18',
                'min' => '0',
                'max' => '100',
                'step' => '1',
                'description' => 'Specify number of posts excerpt length that you want to show. Enter 0 to hide excerpt',
                'admin_label' => true 
            ),
            array(
                 'type' => 'number',
                'heading' => __( 'Posts per page', 'pergo' ),
                'param_name' => 'posts_per_page',
                'value' => '3',
                'min' => '-1',
                'max' => '100',
                'step' => '1',
                'description' => 'Specify number of posts that you want to show. Enter -1 to get all posts',
                'admin_label' => true 
            ),
            array(
                 'type' => 'dropdown',
                'heading' => __( 'Display filter', 'pergo' ),
                'param_name' => 'filter',
                'std' => 'yes',
                'value' => array(
                     'Yes' => 'yes',
                    'No' => 'no' 
                ),
                'dependency' => array(
                     'element' => 'template',
                    'value' => array(
                         'templates/isotope-loop.php' 
                    ) 
                ) 
            ),
            array(
                 'type' => 'perch_select',
                'heading' => __( 'Active category', 'pergo' ),
                'param_name' => 'active',
                'value' => array_merge( array(
                     '' => 'All' 
                ), $category ),               
                'dependency' => array(
                     'element' => 'template',
                    'value' => array(
                         'templates/isotope-loop.php',
                        
                    ) 
                ) 
            ),
            array(
                 'type' => 'number',
                'heading' => __( 'Column', 'pergo' ),
                'param_name' => 'column',
                'value' => '3',
                'min' => '2',
                'max' => '4',
                'step' => '1',
                'dependency' => array(
                     'element' => 'template',
                    'value' => array(
                         'templates/carousel-loop.php',
                        
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
                'dependency' => array(
                     'element' => 'template',
                    'value' => array(
                         'templates/carousel-loop.php' 
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
                'dependency' => array(
                     'element' => 'template',
                    'value' => array(
                         'templates/carousel-loop.php' 
                    ) 
                ) 
            ),            
            array(
                 'type' => 'textfield',
                'heading' => __( 'Post ID\'s', 'pergo' ),
                'param_name' => 'id',
                'value' => '',
                'description' => 'Enter comma separated ID\'s of the posts that you want to show',
                'group' => 'Posts Settings' 
            ),
            array(
                 'type' => 'perch_select',
                'multiple' => 'multiple',
                'heading' => __( 'Select category', 'pergo' ),
                'param_name' => 'tax_term',
                'value' => pergo_get_terms(),
                'group' => 'Posts Settings' 
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
                'group' => 'Posts Settings' 
            ),
            array(
                 'type' => 'textfield',
                'heading' => __( 'Authors', 'pergo' ),
                'param_name' => 'author',
                'description' => 'Enter here comma-separated list of author\'s IDs. Example: 1,7,18',
                'group' => 'Posts Settings' 
            ),
            array(
                 'type' => 'dropdown',
                'heading' => __( 'Order', 'pergo' ),
                'param_name' => 'order',
                'description' => 'Posts order',
                'value' => array_flip( array(
                     'desc' => __( 'Descending', 'pergo' ),
                    'asc' => __( 'Ascending', 'pergo' ) 
                ) ),
                'group' => 'Posts Settings' 
            ),
            array(
                 'type' => 'dropdown',
                'heading' => __( 'Order by', 'pergo' ),
                'param_name' => 'orderby',
                'description' => 'Order posts by',
                'selected' => 'date',
                'value' => array_flip( array(
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
                ) ),
                'group' => 'Posts Settings' 
            ),
            array(
                 'type' => 'dropdown',
                'heading' => __( 'Ignore sticky', 'pergo' ),
                'param_name' => 'ignore_sticky_posts',
                'description' => 'Select Yes to ignore posts that is sticked',
                'value' => array_flip( array(
                     'no' => __( 'No', 'pergo' ),
                    'yes' => __( 'Yes', 'pergo' ) 
                ) ),
                'group' => 'Posts Settings' 
            ) 
        ) 
    );

   
    if( $return ) {
        $args = apply_filters( 'pergo_vc_map_filter', $args, $args['base'] );
        return pergo_vc_get_params_value($args);
    }else{
        vc_map( $args );
    }
}

