<?php
include PERGO_DIR . '/admin/widgets-area.php';
include PERGO_DIR . '/admin/scripts.php';
include PERGO_DIR . '/admin/iconpicker/iconpicker.php';
include PERGO_DIR . '/admin/mce-button.php';
include PERGO_DIR . '/admin/widgets.php';
include PERGO_DIR . '/admin/meta-boxes.php';
include PERGO_DIR . '/admin/onepage-meta-boxes.php';
include PERGO_DIR . '/admin/mr-image-resize.php';
include PERGO_DIR . '/admin/default-options.php';
include PERGO_DIR . '/admin/demo-data.php';
include PERGO_DIR . '/admin/class.newsletter.php';

if( !function_exists('pergo_default_color_classes') ):
function pergo_default_color_classes(){
  $array = array(
    'tra' => array('label' => 'Transparent color', 'value' => 'transparent' ),
    'white' => array('label' => 'White color', 'value' => '#fff' ),    
    'dark' => array('label' => 'Dark color', 'value' => '#2c353f', 'color' => '#000' ),
    'lightdark' => array('label' => 'Dark color - Light', 'value' => '#252d35'),
    'deepdark' => array('label' => 'Dark color - Deep', 'value' => '#1d1d1d'),
    'lightgrey' => array('label' => 'Grey color - Light', 'value' => '#f0f0f0', 'color' => '#ccc'),
    'grey' => array('label' => 'Grey color', 'value' => '#e8e8e8', 'color' => '#666'),
    'deepgrey' => array('label' => 'Grey color - Deep', 'value' => '#ddd'),
    'rose' => array('label' => 'Rose color ( Preset color )', 'value' => ot_get_option('primary_color', '#ff3366')),
    'red' => array('label' => 'Red color', 'value' => '#e35029'),
    'tomato' => array('label' => 'Tomato color', 'value' => '#eb2f5b'),
    'coral' => array('label' => 'Red color - Coral', 'value' => '#ea5c5a'),
    'yellow' => array('label' => 'Yellow color', 'value' => '#feca16', 'color' => '#fcb80b'),    
    'green' => array('label' => 'Green color', 'value' => '#42a045', 'color' => '#56a959'),
    'lightgreen' => array('label' => 'Green color - Light', 'value' => '#59BD56', 'color' => '#22bc3f'),
    'deepgreen' => array('label' => 'Green color - Deep', 'value' => '#009587'),
    'blue' => array('label' => 'Blue color', 'value' => '#2154cf', 'color' => '#3176ed'),
    'lightblue' => array('label' => 'Blue color - Light', 'value' => '#1e88e5'),
    'skyblue' => array('label' => 'Blue color - Skyblue', 'value' => '#01b7de'),
    'deepblue' => array('label' => 'Blue color - Deep', 'value' => '#004861'),
    'tinyblue' => array('label' => 'Blue color - Tiny', 'value' => '#e6f9fa'),
    'purple' => array('label' => 'Purple color', 'value' => '#6e45e2'),
    'deeppurple' => array('label' => 'Purple color - Deep', 'value' => '#510fa7', 'color' => '#004861'),
    'lightpurple' => array('label' => 'Purple color - Light', 'value' => '#715fef'),
  );
  return apply_filters( 'pergo_default_color_classes', $array);
}
endif;

if( !function_exists('pergo_default_dark_color_classes') ):
function pergo_default_dark_color_classes(){
    return array( 'bg-deepdark', 'bg-dark', 'bg-lightdark', 'bg-rose', 'bg-red', 'bg-green', 'bg-lightgreen', 'bg-deepgreen', 'bg-blue','bg-skyblue', 'bg-deepblue', 'bg-lightblue', 'bg-purple','bg-deeppurple', 'bg-tomato', 'bg-coral' );
}
endif;

function pergo_setup_theme_supported_features() {
    $colorArr = pergo_default_color_classes();
    unset($colorArr['tra']);
    unset($colorArr['light']);
    $colors = array();
    foreach ($colorArr as $key => $value) {
        $colors[] = array(
            'name' => esc_attr($value['label']),
            'slug' => $key,
            'color' => esc_attr($value['value']),
        );
    }
    add_theme_support( 'editor-color-palette', $colors);
}

add_action( 'after_setup_theme', 'pergo_setup_theme_supported_features' );

add_action( 'login_enqueue_scripts', 'pergo_login_logo' );
if( !function_exists('pergo_login_logo') ):
function pergo_login_logo( ) {
    $logo = ( function_exists( 'ot_get_option' ) ) ? ot_get_option( 'admin_logo', PERGO_URI . '/images/logo.png' ) : PERGO_URI . '/images/logo.png';
    echo '<style type="text/css">
        body.login div#login h1 a {
            background-image: url(' . esc_url( $logo ) . ');
            background-position: bottom center; 
        }
    </style>';
}
endif;

/* filter theme option header */
add_filter( 'ot_header_version_text', 'pergo_header_version_text' );
if( !function_exists('pergo_header_version_text') ):
function pergo_header_version_text( $output ) {
    return 'PERGO <small>vs</small> ' . PERGO_VERSION;
}
endif;

add_action( 'ot_header_list', 'pergo_customizer_link' );
function pergo_customizer_link( ) {
    echo '<li style="margin-top:9px"><a class="option-tree-ui-button button button-primary" style="color:#fff" href="' . admin_url() . 'customize.php">Customizer</a></li><li style="margin-top:9px"><a target="_blank" class="option-tree-ui-button button button-primary" style="color:#fff" href="//jthemes.org/wp/pergo/documentation/">Documentation</a></li>';
}

// Add Toolbar Menus
if( !function_exists('pergo_themeperch_toolbar') ):
function pergo_themeperch_toolbar( ) {
    global $wp_admin_bar;
    $args = array(
         'id' => 'themeperch',
        'parent' => '',
        'title' => 'PERGO ' . PERGO_VERSION,
        'href' => '//jthemes.org/wp/pergo/' 
    );
    $wp_admin_bar->add_menu( $args );
    $args = array(
         'id' => 'theme_options',
        'parent' => 'themeperch',
        'title' => __( 'Theme options', 'pergo' ),
        'href' => admin_url( 'themes.php?page=ot-theme-options' ),
        'target' => '_blank' 
    );
    $wp_admin_bar->add_menu( $args );

    $args = array(
         'id' => 'docs',
        'parent' => 'themeperch',
        'title' => __( 'Documentation', 'pergo' ),
        'href' => '//jthemes.org/wp/pergo/documentation/',
        'target' => '_blank' 
    );
    $wp_admin_bar->add_menu( $args );

    $args = array(
         'id' => 'portfolio',
        'parent' => 'themeperch',
        'title' => __( 'Envato Portfolio', 'pergo' ),
        'href' => 'http://themeforest.net/user/themeperch/portfolio?ref=themeperch',
        'target' => '_blank' 
    );
    //$wp_admin_bar->add_menu( $args );
    $wp_admin_bar->remove_node( 'essb' );
}
endif;
function pergo_themeperch_toolbar_remove( ) {
    global $wp_admin_bar;
    $wp_admin_bar->remove_node( 'essb' );
}
// Hook into the 'wp_before_admin_bar_render' action
if ( is_admin() ) {
    add_action( 'wp_before_admin_bar_render', 'pergo_themeperch_toolbar', 999 );
} //is_admin()
else {
    add_action( 'wp_before_admin_bar_render', 'pergo_themeperch_toolbar_remove', 999 );
}

add_filter( 'tiny_mce_before_init', 'pergo_formatTinyMCE' );
function pergo_formatTinyMCE( $in ) {
    $in[ 'wordpress_adv_hidden' ] = FALSE;
    return $in;
}

if ( !function_exists( 'pergo_parse_text' ) ):
    function pergo_parse_text( $text, $args = array( ) ) {
        if ( is_array( $args ) ) {
            extract( shortcode_atts( array(
                 'tag' => 'span',
                'tagclass' => '',
                'before' => '',
                'after' => '' 
            ), $args ) );
        } //is_array( $args )
        else {
            extract( shortcode_atts( array(
                 'tag' => $args,
                'tagclass' => 'color-text',
                'before' => '',
                'after' => '' 
            ), $args ) );
        }

        $allowed_html = array(
            'strong' => array(),
            'em'     => array(),
            'b'      => array(),
            'i'      => array(),
            'br'      => array(),
            'a'     => array(
                        'href' => array()
                    )
        );
        $text = wp_kses($text, $allowed_html );
        
        preg_match_all( "/\{([^\}]*)\}/", $text, $matches );

        if ( !empty( $matches ) ) {
            foreach ( $matches[ 1 ] as $value ) {
                $find    = "{{$value}}";
                $replace = "{$before}<{$tag} class='{$tagclass}'>{$value}</{$tag}>{$after}";
                $text    = str_replace( $find, $replace, $text );
            } //$matches[1] as $value
        } //!empty( $matches )
        return  $text;
    }
endif;

if ( !function_exists( 'pergo_get_terms_choices' ) ):
    function pergo_get_terms_choices( $tax = 'category', $key = 'slug' ) {
        $terms = array( );
        if ( !taxonomy_exists( $tax ) )
            return false;
        if ( $key === 'id' )
            foreach ( (array) get_terms( $tax, array( 'hide_empty' => false ) ) as $term )
                $terms[] = array(
                    'label' => $term->name,
                    'value' => $term->term_id
                );
        elseif ( $key === 'slug' )
            foreach ( (array) get_terms( $tax, array( 'hide_empty' => false ) ) as $term )
                $terms[] = array(
                    'label' => $term->name,
                    'value' => $term->slug
                );

        return $terms;
    }
endif;

if ( !function_exists( 'pergo_posts_template' ) ):
    function pergo_posts_template( $atts, $content = null, $type = "posts" ) {
        // Prepare error var
        $error               = null;
        // Parse attributes
        $atts                = shortcode_atts( array(
             'template' => 'templates/default-loop.php',
            'id' => false,
            'posts_per_page' => get_option( 'posts_per_page' ),
            'post_type' => 'post',
            'taxonomy' => 'category',
            'tax_term' => false,
            'tax_operator' => 'IN',
            'author' => '',
            'tag' => '',
            'meta_key' => '',
            'offset' => 0,
            'order' => 'DESC',
            'orderby' => 'date',
            'post_parent' => false,
            'post_status' => 'publish',
            'ignore_sticky_posts' => 'no',
            'info' => '' 
        ), $atts, $type );
        $original_atts       = $atts;
        $author              = sanitize_text_field( $atts[ 'author' ] );
        $id                  = $atts[ 'id' ]; // Sanitized later as an array of integers
        $ignore_sticky_posts = ( bool ) ( $atts[ 'ignore_sticky_posts' ] === 'yes' ) ? true : false;
        $meta_key            = sanitize_text_field( $atts[ 'meta_key' ] );
        $offset              = intval( $atts[ 'offset' ] );
        $order               = sanitize_key( $atts[ 'order' ] );
        $orderby             = sanitize_key( $atts[ 'orderby' ] );
        $post_parent         = $atts[ 'post_parent' ];
        $post_status         = $atts[ 'post_status' ];
        $post_type           = sanitize_text_field( $atts[ 'post_type' ] );
        $posts_per_page      = intval( $atts[ 'posts_per_page' ] );
        $tag                 = sanitize_text_field( $atts[ 'tag' ] );
        $tax_operator        = $atts[ 'tax_operator' ];
        $tax_term            = sanitize_text_field( $atts[ 'tax_term' ] );
        $taxonomy            = sanitize_key( $atts[ 'taxonomy' ] );
        // Set up initial query for post
        $args                = array(
             'category_name' => '',
            'order' => $order,
            'orderby' => $orderby,
            'post_type' => explode( ',', $post_type ),
            'posts_per_page' => $posts_per_page,
            'tag' => $tag 
        );
        // Ignore Sticky Posts
        if ( $ignore_sticky_posts )
            $args[ 'ignore_sticky_posts' ] = true;
        // Meta key (for ordering)
        if ( !empty( $meta_key ) )
            $args[ 'meta_key' ] = $meta_key;
        // If Post IDs
        if ( $id ) {
            $posts_in           = array_map( 'intval', explode( ',', $id ) );
            $args[ 'post__in' ] = $posts_in;
        } //$id
        // Post Author
        if ( !empty( $author ) )
            $args[ 'author' ] = $author;
        // Offset
        if ( !empty( $offset ) )
            $args[ 'offset' ] = $offset;
        // Post Status
        $post_status = explode( ', ', $post_status );
        $validated   = array( );
        $available   = array(
             'publish',
            'pending',
            'draft',
            'auto-draft',
            'future',
            'private',
            'inherit',
            'trash',
            'any' 
        );
        foreach ( $post_status as $unvalidated ) {
            if ( in_array( $unvalidated, $available ) )
                $validated[ ] = $unvalidated;
        } //$post_status as $unvalidated
        if ( !empty( $validated ) )
            $args[ 'post_status' ] = $validated;
        // If taxonomy attributes, create a taxonomy query
        if ( !empty( $taxonomy ) && !empty( $tax_term ) ) {
            // Term string to array
            $tax_term = explode( ',', $tax_term );
            // Validate operator
            if ( !in_array( $tax_operator, array(
                 'IN',
                'NOT IN',
                'AND' 
            ) ) )
                $tax_operator = 'IN';
            $tax_args         = array(
                 'tax_query' => array(
                     array(
                         'taxonomy' => $taxonomy,
                        'field' => ( is_numeric( $tax_term[ 0 ] ) ) ? 'id' : 'slug',
                        'terms' => $tax_term,
                        'operator' => $tax_operator 
                    ) 
                ) 
            );
            // Check for multiple taxonomy queries
            $count            = 2;
            $more_tax_queries = false;
            while ( isset( $original_atts[ 'taxonomy_' . $count ] ) && !empty( $original_atts[ 'taxonomy_' . $count ] ) && isset( $original_atts[ 'tax_' . $count . '_term' ] ) && !empty( $original_atts[ 'tax_' . $count . '_term' ] ) ) {
                // Sanitize values
                $more_tax_queries           = true;
                $taxonomy                   = sanitize_key( $original_atts[ 'taxonomy_' . $count ] );
                $terms                      = explode( ', ', sanitize_text_field( $original_atts[ 'tax_' . $count . '_term' ] ) );
                $tax_operator               = isset( $original_atts[ 'tax_' . $count . '_operator' ] ) ? $original_atts[ 'tax_' . $count . '_operator' ] : 'IN';
                $tax_operator               = in_array( $tax_operator, array(
                     'IN',
                    'NOT IN',
                    'AND' 
                ) ) ? $tax_operator : 'IN';
                $tax_args[ 'tax_query' ][ ] = array(
                     'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => $terms,
                    'operator' => $tax_operator 
                );
                $count++;
            } //isset( $original_atts['taxonomy_' . $count] ) && !empty( $original_atts['taxonomy_' . $count] ) && isset( $original_atts['tax_' . $count . '_term'] ) && !empty( $original_atts['tax_' . $count . '_term'] )
            if ( $more_tax_queries ):
                $tax_relation = 'AND';
                if ( isset( $original_atts[ 'tax_relation' ] ) && in_array( $original_atts[ 'tax_relation' ], array(
                     'AND',
                    'OR' 
                ) ) )
                    $tax_relation = $original_atts[ 'tax_relation' ];
                $args[ 'tax_query' ][ 'relation' ] = $tax_relation;
            endif;
            $args = array_merge( $args, $tax_args );
        } //!empty( $taxonomy ) && !empty( $tax_term )
        // Fix for pagination
        if ( is_front_page() ) {
            $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
        } //is_front_page()
        else {
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        }
        $args[ 'paged' ] = $paged;
        // If post parent attribute, set up parent
        if ( $post_parent ) {
            if ( 'current' == $post_parent ) {
                global $post;
                $post_parent = $post->ID;
            } //'current' == $post_parent
            $args[ 'post_parent' ] = intval( $post_parent );
        } //$post_parent
        // Save original posts
        global $posts;
        $original_posts = $posts;
        // Query posts
        $posts          = new WP_Query( $args );
        $posts->info    = $atts;
        // Buffer output
        ob_start();
        // Search for template in stylesheet directory
        if ( file_exists( get_stylesheet_directory() . '/' . $atts[ 'template' ] ) )
            load_template( get_stylesheet_directory() . '/' . $atts[ 'template' ], false );
        // Search for template in theme directory
        elseif ( file_exists( get_template_directory() . '/' . $atts[ 'template' ] ) )
            load_template( get_template_directory() . '/' . $atts[ 'template' ], false );
        // Template not found
        else
            echo esc_attr(__( 'template not found', 'pergo' ));
        $output = ob_get_contents();
        ob_end_clean();
        // Return original posts
        $posts = $original_posts;
        // Reset the query
        wp_reset_postdata();
        return $output;
    }
endif;

function pergo_get_the_term_list( $id, $taxonomy, $before = '', $sep = '', $after = '', $name = true ) {
    $terms = get_the_terms( $id, $taxonomy );
    if ( is_wp_error( $terms ) )
        return $terms;
    if ( empty( $terms ) )
        return false;
    $links = array( );
    foreach ( $terms as $term ) {
        $link = get_term_link( $term, $taxonomy );
        if ( is_wp_error( $link ) ) {
            return $link;
        } //is_wp_error( $link )
        $links[ ] = ( $name ) ? $term->name : $term->slug;
    } //$terms as $term
    /**    
    * Filters the term links for a given taxonomy.    
    *    
    * The dynamic portion of the filter name, `$taxonomy`, refers    
    * to the taxonomy slug.    
    *
    * @since 2.5.0    
    *    
    * @param array $links An array of term links.    
    */
    $term_links = apply_filters( "term_links-$taxonomy", $links );
    return $before . join( $sep, $term_links ) . $after;
}
function pergo_header_search_icon( $align = "" ) {
    return '<li class="search-box' . ( ( $align != '' ) ? ' ' . $align : '' ) . '"><a href="#"><i class="fa fa-search"></i></a>

                      <ul>

                          <li>

                              <div class="search-form">' . get_search_form( false ) . '</div>

                          </li>

                      </ul>

                  </li>';
}
function pergo_post_thumbnail( $size = 'thumbnail' ) {
    global $post;
    $postid = $post->ID;
    echo pergo_get_post_thumbnail( $postid, $size );
}
function pergo_get_post_thumbnail( $postid, $size = 'thumbnail' ) {
    $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $postid ), 'full' );
    $sizearr         = pergo_get_image_size( $size );
    return '<img src="' . pergo_image_resize( $large_image_url[ 0 ], $sizearr[ 'width' ], $sizearr[ 'height' ] ) . '" alt="' . esc_attr(get_the_title( $postid )) . '">';
}
/**

* Get size information for all currently-registered image sizes.

*

* @global $_wp_additional_image_sizes

* @uses   get_intermediate_image_sizes()

* @return array $sizes Data for all currently-registered image sizes.

*/
function pergo_get_image_sizes( ) {
    global $_wp_additional_image_sizes;
    $sizes = array( );
    foreach ( get_intermediate_image_sizes() as $_size ) {
        if ( in_array( $_size, array(
             'thumbnail',
            'medium',
            'medium_large',
            'large',
            'full' 
        ) ) ) {
            $sizes[ $_size ][ 'width' ]  = get_option( "{$_size}_size_w" );
            $sizes[ $_size ][ 'height' ] = get_option( "{$_size}_size_h" );
            $sizes[ $_size ][ 'crop' ]   = (bool) get_option( "{$_size}_crop" );
        } //in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) )
        elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array(
                 'width' => $_wp_additional_image_sizes[ $_size ][ 'width' ],
                'height' => $_wp_additional_image_sizes[ $_size ][ 'height' ],
                'crop' => $_wp_additional_image_sizes[ $_size ][ 'crop' ] 
            );
        } //isset( $_wp_additional_image_sizes[ $_size ] )
    } //get_intermediate_image_sizes() as $_size
    return $sizes;
}
function pergo_get_image_sizes_Arr( ) {
    $sizes = pergo_get_image_sizes();
    $arr   = array( 'full' => 'Full' );
    foreach ( $sizes as $key => $value ) {
        $arr[ $key ] = $key . ' - ' . $value[ 'width' ] . 'X' . $value[ 'height' ] . ' - ' . ( ( $value[ 'crop' ] ) ? 'Cropped' : '' );
    } //$sizes as $key => $value
    return $arr;
}
/**

* Filter callback to add image sizes to Media Uploader

*/
function pergo_display_image_size_names_muploader( $sizes ) {
    $new_sizes   = array( );
    $added_sizes = get_intermediate_image_sizes();
    // $added_sizes is an indexed array, therefore need to convert it
    // to associative array, using $value for $key and $value
    foreach ( $added_sizes as $key => $value ) {
        $new_sizes[ $value ] = $value;
    } //$added_sizes as $key => $value
    // This preserves the labels in $sizes, and merges the two arrays
    $new_sizes = array_merge( $new_sizes, $sizes );
    return $new_sizes;
}
add_filter( 'image_size_names_choose', 'pergo_display_image_size_names_muploader', 11, 1 );
/**

* Get size information for a specific image size.

*

* @uses   pergo_get_image_sizes()

* @param  string $size The image size for which to retrieve data.

* @return bool|array $size Size data about an image size or false if the size doesn't exist.

*/
function pergo_get_image_size( $size ) {
    $sizes = pergo_get_image_sizes();
    if ( isset( $sizes[ $size ] ) ) {
        return $sizes[ $size ];
    } //isset( $sizes[ $size ] )
    return false;
}
/**

* Get the width of a specific image size.

*

* @uses   pergo_get_image_size()

* @param  string $size The image size for which to retrieve data.

* @return bool|string $size Width of an image size or false if the size doesn't exist.

*/
function pergo_get_image_width( $size ) {
    if ( !$size = pergo_get_image_size( $size ) ) {
        return false;
    } //!$size = pergo_get_image_size( $size )
    if ( isset( $size[ 'width' ] ) ) {
        return $size[ 'width' ];
    } //isset( $size[ 'width' ] )
    return false;
}
/**

* Get the height of a specific image size.

*

* @uses   get_image_size()

* @param  string $size The image size for which to retrieve data.

* @return bool|string $size Height of an image size or false if the size doesn't exist.

*/
function pergo_get_image_height( $size ) {
    if ( !$size = pergo_get_image_size( $size ) ) {
        return false;
    } //!$size = pergo_get_image_size( $size )
    if ( isset( $size[ 'height' ] ) ) {
        return $size[ 'height' ];
    } //isset( $size[ 'height' ] )
    return false;
}
add_filter( 'manage_posts_columns', 'pergo_columns_head' );
add_action( 'manage_posts_custom_column', 'pergo_columns_content', 10, 2 );
// ADD NEW COLUMN
function pergo_columns_head( $defaults ) {
    $defaults[ 'featured_image' ] = esc_attr(__( 'Featured Image', 'pergo' ));
    return $defaults;
}
function pergo_columns_content( $column_name, $post_ID ) {
    if ( $column_name == 'featured_image' ) {
        if ( has_post_thumbnail( $post_ID ) ) {
            // HAS A FEATURED IMAGE
            echo pergo_get_post_thumbnail( $post_ID, 'thumbnail' );
        } //has_post_thumbnail( $post_ID )
    } //$column_name == 'featured_image'
}

add_filter( 'manage_team_posts_columns', 'pergo_team_columns_item' );
add_action( 'manage_team_posts_custom_column', 'pergo_manage_team_posts_custom_column', 10, 2 );
function pergo_team_columns_item( $columns ) {
    unset( $columns[ 'featured_image' ], $columns[ 'date' ] );
    $new_columns = array(
         'designation' => esc_attr(__( 'Designation', 'pergo' )),
        'date' => esc_attr(__( 'Date', 'pergo' )),
        'featured_image' => esc_attr(__( 'Member image', 'pergo' )) 
    );
    return array_merge( $columns, $new_columns );
}
function pergo_manage_team_posts_custom_column( $column, $post_id ) {
    switch ( $column ) {
        case 'designation':
            echo get_post_meta( $post_id, 'designation', true );
            break;
    } //$column
}
add_action( 'print_media_templates', function( ) {
    // define your backbone template;
    // the "tmpl-" prefix is required,
    // and your input field should have a data-setting attribute
    // matching the shortcode name
    ?>
  <script type="text/html" id="tmpl-pergo-custom-gallery-setting">
    <label class="setting">
      <span><?php echo esc_attr(__( 'Gallery type', 'pergo' )); ?></span>
      <select data-setting="gallery_type">
        <option value="default"> <?php echo esc_attr(__( 'Default', 'pergo' )); ?> </option>
        <option value="slider"> <?php echo esc_attr(__( 'Slider', 'pergo' )); ?> </option>
        <option value="tiled"> <?php echo esc_attr(__( 'Tiled', 'pergo' )); ?> </option>
      </select>
    </label>
  </script>
  <script>
    jQuery(document).ready(function(){
      // add your shortcode attribute and its default value to the
      // gallery settings list; $.extend should work as well...
      _.extend(wp.media.gallery.defaults, {
        gallery_type: 'default'
      });
      // merge default gallery settings template with yours
      wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
        template: function(view){
          return wp.media.template('gallery-settings')(view)
               + wp.media.template('pergo-custom-gallery-setting')(view);
        }
      });
    });
  </script>
  <?php
} );

function pergo_set_post_views( $postID ) {
    $count_key = 'pergo_post_views_count';
    $count     = get_post_meta( $postID, $count_key, true );
    if ( $count == '' ) {
        $count = 0;
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
    } //$count == ''
    else {
        $count++;
        update_post_meta( $postID, $count_key, $count );
    }
}

//pergo_set_post_views(get_the_ID());
function pergo_track_post_views( $post_id ) {
    if ( !is_single() )
        return;
    if ( empty( $post_id ) ) {
        global $post;
        $post_id = $post->ID;
    } //empty( $post_id )
    pergo_set_post_views( $post_id );
}
add_action( 'wp_head', 'pergo_track_post_views' );

function pergo_get_post_views( $postID ) {
    $count_key = 'pergo_post_views_count';
    $count     = get_post_meta( $postID, $count_key, true );
    if ( $count == '' ) {
        delete_post_meta( $postID, $count_key );
        add_post_meta( $postID, $count_key, '0' );
        return "0";
    } //$count == ''
    return pergo_format_count( $count );
}
//pergo_get_post_views(get_the_ID());
if ( !function_exists( 'pergo_get_comments_number' ) ):
    function pergo_get_comments_number( ) {
        global $post;
        $num_comments = get_comments_number( $post->ID ); // get_comments_number returns only a numeric value
        if ( comments_open( $post->ID ) ) {
            if ( $num_comments == 0 ) {
                $comments = esc_attr(__( 'No Comments', 'pergo' ));
            } //$num_comments == 0
            elseif ( $num_comments > 1 ) {
                $comments = $num_comments . ' <span>' . esc_attr(__( 'Comments', 'pergo' )) . '</span>';
            } //$num_comments > 1
            else {
                $comments = '1 <span>' . esc_attr(__( 'Comment', 'pergo' )) . '</span>';
            }
            $write_comments = '<a href="' . get_comments_link() . '">' . $comments . '</a>';
        } //comments_open( $post->ID )
        else {
            $write_comments = esc_attr(__( 'Comments off', 'pergo' ));
        }
        return '<i class="fa fa-comment-o"></i>' . $write_comments;
    }
endif;
/**

* gets the current post type in the WordPress Admin

*/
function pergo_get_current_post_type( ) {
    global $wpdb, $post, $typenow, $current_screen;
    //we have a post so we can just get the post type from that
    if ( $typenow )
        return $typenow;
    //check the global $typenow - set in admin.php
    //check the global $current_screen object - set in sceen.php
    elseif ( $current_screen && $current_screen->post_type )
        return $current_screen->post_type;
    //lastly check the post_type querystring
    elseif ( isset( $_REQUEST[ 'post_type' ] ) )
        return sanitize_key( $_REQUEST[ 'post_type' ] );
    elseif ( isset( $_REQUEST[ 'post' ] ) && get_post_type( $_REQUEST[ 'post' ] ) )
        return get_post_type( $_REQUEST[ 'post' ] );
    elseif ( $post && $post->post_type )
        return $post->post_type;
    //we do not know the post type!
    return null;
}

// Custom filter function to modify default gallery shortcode output
function pergo_post_gallery( $output, $attr ) {
    // Initialize
    global $post, $wp_locale;
    // Gallery instance counter
    static $instance = 0;
    $instance++;
    // Validate the author's orderby attribute
    if ( isset( $attr[ 'orderby' ] ) ) {
        $attr[ 'orderby' ] = sanitize_sql_orderby( $attr[ 'orderby' ] );
        if ( !$attr[ 'orderby' ] )
            unset( $attr[ 'orderby' ] );
    } //isset( $attr[ 'orderby' ] )
    // Get attributes from shortcode
    extract( shortcode_atts( array(
         'order' => 'ASC',
        'orderby' => 'menu_order ID',
        'id' => $post->ID,
        'itemtag' => 'dl',
        'icontag' => 'dt',
        'captiontag' => 'dd',
        'columns' => 3,
        'size' => 'thumbnail',
        'include' => '',
        'exclude' => '',
        'gallery_type' => 'default' 
    ), $attr ) );
    // Initialize
    $id          = intval( $id );
    $attachments = array( );
    if ( $order == 'RAND' )
        $orderby = 'none';
    if ( !empty( $include ) ) {
        // Include attribute is present
        $include      = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array(
             'include' => $include,
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => $order,
            'orderby' => $orderby 
        ) );
        // Setup attachments array
        foreach ( $_attachments as $key => $val ) {
            $attachments[ $val->ID ] = $_attachments[ $key ];
        } //$_attachments as $key => $val
    } //!empty( $include )
    else if ( !empty( $exclude ) ) {
        // Exclude attribute is present 
        $exclude     = preg_replace( '/[^0-9,]+/', '', $exclude );
        // Setup attachments array
        $attachments = get_children( array(
             'post_parent' => $id,
            'exclude' => $exclude,
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => $order,
            'orderby' => $orderby 
        ) );
    } //!empty( $exclude )
    else {
        // Setup attachments array
        $attachments = get_children( array(
             'post_parent' => $id,
            'post_status' => 'inherit',
            'post_type' => 'attachment',
            'post_mime_type' => 'image',
            'order' => $order,
            'orderby' => $orderby 
        ) );
    }
    if ( empty( $attachments ) )
        return '';
    // Filter gallery differently for feeds
    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
        return $output;
    } //is_feed()
    // Filter tags and attributes
    $itemtag    = tag_escape( $itemtag );
    $captiontag = tag_escape( $captiontag );
    $columns    = intval( $columns );
    $itemwidth  = $columns > 0 ? floor( 100 / $columns ) : 100;
    $float      = is_rtl() ? 'right' : 'left';
    $selector   = "gallery-{$instance}";
    $output     = '';
    if ( $gallery_type == 'slider' ):
        $output = '<div class="image-holder post-carousel">';
        foreach ( $attachments as $id => $attachment ) {
            $src         = wp_get_attachment_image_src( $id, $size );
            $fullsrc     = wp_get_attachment_image_src( $id, 'full' );
            $imagewidth  = ( pergo_get_layout() == 'full' ) ? 1170 : 832;
            $imageheight = ( pergo_get_layout() == 'full' ) ? 585 : 554;
            $output .= '<img alt="' . esc_attr( $attachment->post_title ) . '"

                 src="' . pergo_image_resize( $fullsrc[ 0 ], $imagewidth, $imageheight ) . '">';
        } //$attachments as $id => $attachment
        $output .= '</div>';
    elseif ( $gallery_type == 'tiled' ):
        $uniqid = uniqid( 'tiled_gallery_' );
        wp_enqueue_style( 'unite-gallery' );
        wp_enqueue_script( 'ug-theme-tiles' );
        $output = '<div id="' . $uniqid . '" class="gallery-tiled" style="display:none;">';
        foreach ( $attachments as $id => $attachment ) {
            $src     = wp_get_attachment_image_src( $id, $size );
            $fullsrc = wp_get_attachment_image_src( $id, 'full' );
            $output .= '<a href="' . get_attachment_link( $id ) . '">
            <img alt="' . esc_attr( $attachment->post_title ) . '"
                 src="' . esc_url( $src[ 0 ] ) . '"
                 data-image="' . esc_url( $fullsrc[ 0 ] ) . '"
                 data-description="' . wptexturize( $attachment->post_excerpt ) . '"
                 style="display:none">
            </a>';
        } //$attachments as $id => $attachment
        $output .= '</div>

    <script>
      jQuery(document).ready(function(){
        jQuery("#' . $uniqid . '").unitegallery({
          tiles_type:"justified",
          tiles_justified_space_between: 10
        });
      });

    </script>';
    else:
        // Filter gallery CSS
        $output = apply_filters( 'gallery_style', "
      <style type='text/css'>
        #{$selector} {
          margin-left:  -15px;
          margin-right:  -15px;
        }
        #{$selector} .gallery-item {
          float: {$float};
          margin-top: 10px;
          text-align: center;
          width: {$itemwidth}%;
          padding-left: 15px;
          padding-right: 15px;
        }
        #{$selector} img {         

        }
        #{$selector} .gallery-caption {
          margin-left: 0;
        }
      </style>
      <!-- see gallery_shortcode() in wp-includes/media.php -->
      <div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns}'>" );
        // Iterate through the attachments in this gallery instance
        $i      = 0;
        $class  = ( isset( $attr[ 'link' ] ) && $attr[ 'link' ] == 'file' ) ? ' image-link' : '';
        foreach ( $attachments as $id => $attachment ) {
            // Attachment link
            $link = isset( $attr[ 'link' ] ) && 'file' == $attr[ 'link' ] ? wp_get_attachment_link( $id, $size, false, false ) : wp_get_attachment_link( $id, $size, true, false );
            // Start itemtag
            $output .= "<{$itemtag} class='gallery-item{$class}'>";
            // icontag
            $output .= "
      <{$icontag} class='gallery-icon'>
        $link
      </{$icontag}>";
            if ( $captiontag && trim( $attachment->post_excerpt ) ) {
                // captiontag
                $output .= "
        <{$captiontag} class='gallery-caption'>
          " . wptexturize( $attachment->post_excerpt ) . "
        </{$captiontag}>";
            } //$captiontag && trim( $attachment->post_excerpt )
            // End itemtag
            $output .= "</{$itemtag}>";
            // Line breaks by columns set
            if ( $columns > 0 && ++$i % $columns == 0 )
                $output .= '<br style="clear: both;">';
        } //$attachments as $id => $attachment
        // End gallery output
        $output .= "
    </div>\n";
    endif;
    return $output;
}
// Apply filter to default gallery shortcode
add_filter( 'post_gallery', 'pergo_post_gallery', 10, 2 );


function pergo_header_default_social_icons( ) {
    return array(
         array(
             'title' => 'Facebook',
            'icon_link' => array(
                 'icon' => 'fa-facebook-f',
                'input' => '#' 
            ) 
        ),        
        array(
             'title' => 'Twitter',
            'icon_link' => array(
                 'icon' => 'fa-twitter',
                'input' => '#' 
            ) 
        ) ,
        array(
             'title' => 'Dribbble',
            'icon_link' => array(
                 'icon' => 'fa-dribbble',
                'input' => '#' 
            ) 
        ),
        array(
             'title' => 'Pinterest',
            'icon_link' => array(
                 'icon' => 'fa-pinterest-p',
                'input' => '#' 
            ) 
        ),
    );
}
function pergo_header_default_contact_info( ) {
    return array(
         array(
             'title' => 'Email us',
            'icon_link' => array(
                 'icon' => 'pergo-envelop',
                'input' => 'info@pergo.com' 
            ),
            'link' => 'mailto:info@pergo.com' 
        ),
        array(
             'title' => 'Call us',
            'icon_link' => array(
                 'icon' => 'pergo-phone',
                'input' => '+68004540088' 
            ),
            'link' => 'tel:+68004540088' 
        ) 
    );
}
function pergo_default_social_icons( ) {
    return array(
         array(
             'title' => 'Facebook',
            'icon_link' => array(
                 'icon' => 'fa-facebook',
                'input' => '#' 
            ) 
        ),
        array(
             'title' => 'Twitter',
            'icon_link' => array(
                 'icon' => 'fa-twitter',
                'input' => '#' 
            ) 
        ),
        array(
             'title' => 'youtube',
            'icon_link' => array(
                 'icon' => 'fa-youtube',
                'input' => '#' 
            ) 
        ),
        array(
             'title' => 'tumblr',
            'icon_link' => array(
                 'icon' => 'fa-tumblr',
                'input' => '#' 
            ) 
        ) 
    );
}
function pergo_get_social_icons( $social_icons = array( ), $args = array( ) ) {
    if ( empty( $social_icons ) )
        return;
    $output = '';
    extract( shortcode_atts( array(
         'wrap' => 'ul',
        'wrapclass' => '',
        'linkwrapbefore' => '',
        'linkwrap' => 'li',
        'linkwrapclass' => '',
        'linkclass' => '',
        'iconclass' => '',
        'linktext' => false 
    ), $args ) );
    $output = ( $wrap != '' ) ? '<' . esc_attr( $wrap ) . ( ( $wrapclass != '' ) ? ' class="' . esc_attr( $wrapclass ) . '"' : '' ) . '>' : '';
    $output .= ( $linkwrapbefore != '' ) ? wpautop( $linkwrapbefore ) : '';
    $linkbefore = ( $linkwrap != '' ) ? '<' . esc_attr( $linkwrap ) . ( ( $linkwrapclass != '' ) ? ' class="' . esc_attr( $linkwrapclass ) . '"' : '' ) . '>' : '';
    $linkafter  = ( $linkwrap != '' ) ? '</' . esc_attr( $linkwrap ) . '>' : '';
    $linkclass  = ( $linkclass != '' ) ? esc_attr( $linkclass ) : '';
    foreach ( $social_icons as $key => $value ) {
        $url        = isset( $value[ 'icon_link' ][ 'input' ] ) ? $value[ 'icon_link' ][ 'input' ] : '';
        $title      = isset( $value[ 'title' ] ) ? $value[ 'title' ] : '';
        $icon_class = isset( $value[ 'icon_link' ][ 'icon' ] ) ? $value[ 'icon_link' ][ 'icon' ] : '';
        $icon_class .= ( $iconclass ) ? ' ' . $iconclass : '';
        $output .= $linkbefore . '<a target="_blank" href="' . esc_url( $url ) . '" title="' . esc_attr( $title ) . '" class="' . $linkclass . ' ico-'.sanitize_title($title).'">

      <i class="fa ' . esc_attr( $icon_class ) . '"></i>

      ' . ( ( $linktext ) ? '<span>' . esc_attr( $title ) . '</span>' : '' ) . '

      </a>' . $linkafter;
    } //$social_icons as $key => $value
    $output .= ( $wrap != '' ) ? '</' . esc_attr( $wrap ) . '>' : '';
    return $output;
}
// Add Profile Fields
if ( !function_exists( 'pergo_contact_options' ) ):
    function pergo_contact_options( ) {
        $profile_fields                   = array( );
        $profile_fields[ 'facebook' ]     = array(
             'Facebook',
            'fb' 
        );
        $profile_fields[ 'twitter' ]      = array(
             'Twitter',
            'tw' 
        );
        $profile_fields[ 'youtube-play' ] = array(
             'Youtube',
            'yt' 
        );
        $profile_fields[ 'pinterest' ]    = array(
             'Pinterest',
            'pt' 
        );
        $profile_fields[ 'linkedin' ]     = array(
             'Linkedin',
            'li' 
        );
        $profile_fields[ 'flickr' ]       = array(
             'Flickr',
            'fl' 
        );
        $profile_fields[ 'google-plus' ]  = array(
             'Google+',
            'gplus' 
        );
        $profile_fields[ 'instagram' ]    = array(
             'Instagram',
            'ig' 
        );
        $profile_fields[ 'vk' ]           = array(
             'Vk',
            'vk' 
        );
        return $profile_fields;
    }
endif;
function pergo_get_user_contacts_list( ) {
    global $post;
    $array = pergo_contact_options();
    foreach ( $array as $key => $value ) {
        $link = get_user_meta( get_the_author_meta( 'ID' ), $key, true );
        if( $link != '' ){
            echo '<li><a class="' . esc_attr( $value[ 1 ] ) . '" href="' . esc_url( $link ) . '" title="' . esc_attr( $value[ 0 ] ) . '"><i class="fa fa-' . esc_attr( $key ) . '"></i></a></li>';
        }
    } //$array as $key => $value
}
function pergo_get_header_type( ) {
    global $post;
    $output = array(
         'type' => '',
        'shortcode' => false 
    );
    if ( is_page() ) {
        $header_type           = get_post_meta( $post->ID, 'header_type', true );
        $output[ 'shortcode' ] = ( $header_type == 'shortcode' ) ? get_post_meta( get_the_ID(), 'shortcode', true ) : false;
    } //is_page()
    elseif ( is_single() ) {
        $header_type           = ot_get_option( 'single_post_header_style', 'style1' );
        $output[ 'shortcode' ] = ( $header_type == 'shortcode' ) ? ot_get_option( 'single_post_shortcode' ) : false;
    } //is_single()
    else {
        $header_type           = ot_get_option( 'blog_header_style', 'style1' );
        $output[ 'shortcode' ] = ( $header_type == 'shortcode' ) ? ot_get_option( 'blog_shortcode' ) : false;
    }
    $output[ 'type' ] = ( $header_type != '' ) ? $header_type : 'style1';
    return $output;
}
add_action( 'pergo_after_header', 'pergo_get_header_style' );
function pergo_get_header_style( ) {
    $header      = pergo_get_header_type();
    $header_type = $header[ 'type' ];
    if ( ( $header_type == 'style1' ) || ( $header_type == 'style2' ) ) {
        $args[ 'template' ] = 'header/slider-' . $header_type . '.php';
    } //( $header_type == 'style1' ) || ( $header_type == 'style2' )
    else {
        $args[ 'template' ] = 'header/page-header.php';
    }
    if ( isset( $args[ 'template' ] ) ) {
        echo pergo_posts_template( $args );
    } //isset( $args[ 'template' ] )
}
function pergo_parse_color_text( $text ) {
    preg_match_all( "/\{([^\}]*)\}/", $text, $matches );
    if ( !empty( $matches ) ) {
        foreach ( $matches[ 1 ] as $value ) {
            $text = str_replace( "{{$value}}", "<span class='primary-color'>{$value}</span>", $text );
        } //$matches[ 1 ] as $value
    } //!empty( $matches )
    return $text;
}
add_filter( 'nav_menu_css_class', 'pergo_active_nav_class', 10, 2 );
function pergo_active_nav_class( $classes, $item ) {
    if ( in_array( 'current-menu-item', $classes ) ) {
        $classes[ ] = 'active';
    } //in_array( 'current-menu-item', $classes )
    return $classes;
}
function pergo_password_form( ) {
    global $post;
    $label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
    $o     = '<form class="password-form subscribe-form subscribe-form-style2" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">

    ' . esc_attr( __( "To view this protected post, enter the password below:", "pergo" ) ) . '
    <div class="input-group"><input class="form-control" placeholder="' . esc_attr( __( "Password:", "pergo" ) ) . '" required="" id="s-email" name="post_password" type="password"><span class="input-group-btn input-group-append"><button type="submit" name="submit" class="btn"><i class="fas fa-arrow-right"></i></button></span></div>

    </form><p>&nbsp;</p>

    ';
    return $o;
}
add_filter( 'the_password_form', 'pergo_password_form' );
add_action( 'wp_ajax_instafeed_access_token_action', 'pergo_instafeed_access_token_action' );
add_action( 'wp_ajax_nopriv_instafeed_access_token_action', 'pergo_instafeed_access_token_action' );
function pergo_instafeed_access_token_action( ) {
    global $wpdb;
    $access_token = ( isset( $_POST[ 'access_token' ] ) ) ? $_POST[ 'access_token' ] : '';
    if ( $access_token != '' ) {
        update_option( 'access_token', $access_token );
        echo 'Updated';
    } //$access_token != ''
    else {
        echo 'Some thing went wrong';
    }
    wp_die();
}
function pergo_wpcf7_dynamic_recipient_for_members( $args ) {
    if ( is_singular( 'team' ) ) {
        $args[ 'recipient' ] = get_post_meta( get_the_ID(), 'contact_form_email', true );
        return $args;
    } //is_singular( 'team' )
    return $args;
}
add_filter( 'vc_iconpicker-type-pixden', 'pergo_iconpicker_type_pixden' );
function pergo_iconpicker_type_pixden( $icons ) {
    $pixden = array(
         array(
             'pe-7s-album' => 'album' 
        ),
        array(
             'pe-7s-arc' => 'arc' 
        ),
        array(
             'pe-7s-back-2' => 'back-2' 
        ),
        array(
             'pe-7s-bandaid' => 'bandaid' 
        ),
        array(
             'pe-7s-car' => 'car' 
        ),
        array(
             'pe-7s-diamond' => 'diamond' 
        ),
        array(
             'pe-7s-door-lock' => 'door-lock' 
        ),
        array(
             'pe-7s-eyedropper' => 'eyedropper' 
        ),
        array(
             'pe-7s-female' => 'female' 
        ),
        array(
             'pe-7s-gym' => 'gym' 
        ),
        array(
             'pe-7s-hammer' => 'hammer' 
        ),
        array(
             'pe-7s-headphones' => 'headphones' 
        ),
        array(
             'pe-7s-helm' => 'helm' 
        ),
        array(
             'pe-7s-hourglass' => 'hourglass' 
        ),
        array(
             'pe-7s-leaf' => 'leaf' 
        ),
        array(
             'pe-7s-magic-wand' => 'magic-wand' 
        ),
        array(
             'pe-7s-male' => 'male' 
        ),
        array(
             'pe-7s-map-2' => 'map-2' 
        ),
        array(
             'pe-7s-next-2' => 'next-2' 
        ),
        array(
             'pe-7s-paint-bucket' => 'paint-bucket' 
        ),
        array(
             'pe-7s-pendrive' => 'pendrive' 
        ),
        array(
             'pe-7s-photo' => 'photo' 
        ),
        array(
             'pe-7s-piggy' => 'piggy' 
        ),
        array(
             'pe-7s-plugin' => 'plugin' 
        ),
        array(
             'pe-7s-refresh-2' => 'refresh-2' 
        ),
        array(
             'pe-7s-rocket' => 'rocket' 
        ),
        array(
             'pe-7s-settings' => 'settings' 
        ),
        array(
             'pe-7s-shield' => 'shield' 
        ),
        array(
             'pe-7s-smile' => 'smile' 
        ),
        array(
             'pe-7s-usb' => 'usb' 
        ),
        array(
             'pe-7s-vector' => 'vector' 
        ),
        array(
             'pe-7s-wine' => 'wine' 
        ),
        array(
             'pe-7s-cloud-upload' => 'cloud-upload' 
        ),
        array(
             'pe-7s-cash' => 'cash' 
        ),
        array(
             'pe-7s-close' => 'close' 
        ),
        array(
             'pe-7s-bluetooth' => 'bluetooth' 
        ),
        array(
             'pe-7s-cloud-download' => 'cloud-download' 
        ),
        array(
             'pe-7s-way' => 'way' 
        ),
        array(
             'pe-7s-close-circle' => 'close-circle' 
        ),
        array(
             'pe-7s-id' => 'id' 
        ),
        array(
             'pe-7s-angle-up' => 'angle-up' 
        ),
        array(
             'pe-7s-wristwatch' => 'wristwatch' 
        ),
        array(
             'pe-7s-angle-up-circle' => 'angle-up-circle' 
        ),
        array(
             'pe-7s-world' => 'world' 
        ),
        array(
             'pe-7s-angle-right' => 'angle-right' 
        ),
        array(
             'pe-7s-volume' => 'volume' 
        ),
        array(
             'pe-7s-angle-right-circle' => 'angle-right-circle' 
        ),
        array(
             'pe-7s-users' => 'users' 
        ),
        array(
             'pe-7s-angle-left' => 'angle-left' 
        ),
        array(
             'pe-7s-user-female' => 'user-female' 
        ),
        array(
             'pe-7s-angle-left-circle' => 'angle-left-circle' 
        ),
        array(
             'pe-7s-up-arrow' => 'up-arrow' 
        ),
        array(
             'pe-7s-angle-down' => 'angle-down' 
        ),
        array(
             'pe-7s-switch' => 'switch' 
        ),
        array(
             'pe-7s-angle-down-circle' => 'angle-down-circle' 
        ),
        array(
             'pe-7s-scissors' => 'scissors' 
        ),
        array(
             'pe-7s-wallet' => 'wallet' 
        ),
        array(
             'pe-7s-safe' => 'safe' 
        ),
        array(
             'pe-7s-volume2' => 'volume2' 
        ),
        array(
             'pe-7s-volume1' => 'volume1' 
        ),
        array(
             'pe-7s-voicemail' => 'voicemail' 
        ),
        array(
             'pe-7s-video' => 'video' 
        ),
        array(
             'pe-7s-user' => 'user' 
        ),
        array(
             'pe-7s-upload' => 'upload' 
        ),
        array(
             'pe-7s-unlock' => 'unlock' 
        ),
        array(
             'pe-7s-umbrella' => 'umbrella' 
        ),
        array(
             'pe-7s-trash' => 'trash' 
        ),
        array(
             'pe-7s-tools' => 'tools' 
        ),
        array(
             'pe-7s-timer' => 'timer' 
        ),
        array(
             'pe-7s-ticket' => 'ticket' 
        ),
        array(
             'pe-7s-target' => 'target' 
        ),
        array(
             'pe-7s-sun' => 'sun' 
        ),
        array(
             'pe-7s-study' => 'study' 
        ),
        array(
             'pe-7s-stopwatch' => 'stopwatch' 
        ),
        array(
             'pe-7s-star' => 'star' 
        ),
        array(
             'pe-7s-speaker' => 'speaker' 
        ),
        array(
             'pe-7s-signal' => 'signal' 
        ),
        array(
             'pe-7s-shuffle' => 'shuffle' 
        ),
        array(
             'pe-7s-shopbag' => 'shopbag' 
        ),
        array(
             'pe-7s-share' => 'share' 
        ),
        array(
             'pe-7s-server' => 'server' 
        ),
        array(
             'pe-7s-search' => 'search' 
        ),
        array(
             'pe-7s-film' => 'film' 
        ),
        array(
             'pe-7s-science' => 'science' 
        ),
        array(
             'pe-7s-disk' => 'disk' 
        ),
        array(
             'pe-7s-ribbon' => 'ribbon' 
        ),
        array(
             'pe-7s-repeat' => 'repeat' 
        ),
        array(
             'pe-7s-refresh' => 'refresh' 
        ),
        array(
             'pe-7s-add-user' => 'add-user' 
        ),
        array(
             'pe-7s-refresh-cloud' => 'refresh-cloud' 
        ),
        array(
             'pe-7s-paperclip' => 'paperclip' 
        ),
        array(
             'pe-7s-radio' => 'radio' 
        ),
        array(
             'pe-7s-note2' => 'note2' 
        ),
        array(
             'pe-7s-print' => 'print' 
        ),
        array(
             'pe-7s-network' => 'network' 
        ),
        array(
             'pe-7s-prev' => 'prev' 
        ),
        array(
             'pe-7s-mute' => 'mute' 
        ),
        array(
             'pe-7s-power' => 'power' 
        ),
        array(
             'pe-7s-medal' => 'medal' 
        ),
        array(
             'pe-7s-portfolio' => 'portfolio' 
        ),
        array(
             'pe-7s-like2' => 'like2' 
        ),
        array(
             'pe-7s-plus' => 'plus' 
        ),
        array(
             'pe-7s-left-arrow' => 'left-arrow' 
        ),
        array(
             'pe-7s-play' => 'play' 
        ),
        array(
             'pe-7s-key' => 'key' 
        ),
        array(
             'pe-7s-plane' => 'plane' 
        ),
        array(
             'pe-7s-joy' => 'joy' 
        ),
        array(
             'pe-7s-photo-gallery' => 'photo-gallery' 
        ),
        array(
             'pe-7s-pin' => 'pin' 
        ),
        array(
             'pe-7s-phone' => 'phone' 
        ),
        array(
             'pe-7s-plug' => 'plug' 
        ),
        array(
             'pe-7s-pen' => 'pen' 
        ),
        array(
             'pe-7s-right-arrow' => 'right-arrow' 
        ),
        array(
             'pe-7s-paper-plane' => 'paper-plane' 
        ),
        array(
             'pe-7s-delete-user' => 'delete-user' 
        ),
        array(
             'pe-7s-paint' => 'paint' 
        ),
        array(
             'pe-7s-bottom-arrow' => 'bottom-arrow' 
        ),
        array(
             'pe-7s-notebook' => 'notebook' 
        ),
        array(
             'pe-7s-note' => 'note' 
        ),
        array(
             'pe-7s-next' => 'next' 
        ),
        array(
             'pe-7s-news-paper' => 'news-paper' 
        ),
        array(
             'pe-7s-musiclist' => 'musiclist' 
        ),
        array(
             'pe-7s-music' => 'music' 
        ),
        array(
             'pe-7s-mouse' => 'mouse' 
        ),
        array(
             'pe-7s-more' => 'more' 
        ),
        array(
             'pe-7s-moon' => 'moon' 
        ),
        array(
             'pe-7s-monitor' => 'monitor' 
        ),
        array(
             'pe-7s-micro' => 'micro' 
        ),
        array(
             'pe-7s-menu' => 'menu' 
        ),
        array(
             'pe-7s-map' => 'map' 
        ),
        array(
             'pe-7s-map-marker' => 'map-marker' 
        ),
        array(
             'pe-7s-mail' => 'mail' 
        ),
        array(
             'pe-7s-mail-open' => 'mail-open' 
        ),
        array(
             'pe-7s-mail-open-file' => 'mail-open-file' 
        ),
        array(
             'pe-7s-magnet' => 'magnet' 
        ),
        array(
             'pe-7s-loop' => 'loop' 
        ),
        array(
             'pe-7s-look' => 'look' 
        ),
        array(
             'pe-7s-lock' => 'lock' 
        ),
        array(
             'pe-7s-lintern' => 'lintern' 
        ),
        array(
             'pe-7s-link' => 'link' 
        ),
        array(
             'pe-7s-like' => 'like' 
        ),
        array(
             'pe-7s-light' => 'light' 
        ),
        array(
             'pe-7s-less' => 'less' 
        ),
        array(
             'pe-7s-keypad' => 'keypad' 
        ),
        array(
             'pe-7s-junk' => 'junk' 
        ),
        array(
             'pe-7s-info' => 'info' 
        ),
        array(
             'pe-7s-home' => 'home' 
        ),
        array(
             'pe-7s-help2' => 'help2' 
        ),
        array(
             'pe-7s-help1' => 'help1' 
        ),
        array(
             'pe-7s-graph3' => 'graph3' 
        ),
        array(
             'pe-7s-graph2' => 'graph2' 
        ),
        array(
             'pe-7s-graph1' => 'graph1' 
        ),
        array(
             'pe-7s-graph' => 'graph' 
        ),
        array(
             'pe-7s-global' => 'global' 
        ),
        array(
             'pe-7s-gleam' => 'gleam' 
        ),
        array(
             'pe-7s-glasses' => 'glasses' 
        ),
        array(
             'pe-7s-gift' => 'gift' 
        ),
        array(
             'pe-7s-folder' => 'folder' 
        ),
        array(
             'pe-7s-flag' => 'flag' 
        ),
        array(
             'pe-7s-filter' => 'filter' 
        ),
        array(
             'pe-7s-file' => 'file' 
        ),
        array(
             'pe-7s-expand1' => 'expand1' 
        ),
        array(
             'pe-7s-exapnd2' => 'exapnd2' 
        ),
        array(
             'pe-7s-edit' => 'edit' 
        ),
        array(
             'pe-7s-drop' => 'drop' 
        ),
        array(
             'pe-7s-drawer' => 'drawer' 
        ),
        array(
             'pe-7s-download' => 'download' 
        ),
        array(
             'pe-7s-display2' => 'display2' 
        ),
        array(
             'pe-7s-display1' => 'display1' 
        ),
        array(
             'pe-7s-diskette' => 'diskette' 
        ),
        array(
             'pe-7s-date' => 'date' 
        ),
        array(
             'pe-7s-cup' => 'cup' 
        ),
        array(
             'pe-7s-culture' => 'culture' 
        ),
        array(
             'pe-7s-crop' => 'crop' 
        ),
        array(
             'pe-7s-credit' => 'credit' 
        ),
        array(
             'pe-7s-copy-file' => 'copy-file' 
        ),
        array(
             'pe-7s-config' => 'config' 
        ),
        array(
             'pe-7s-compass' => 'compass' 
        ),
        array(
             'pe-7s-comment' => 'comment' 
        ),
        array(
             'pe-7s-coffee' => 'coffee' 
        ),
        array(
             'pe-7s-cloud' => 'cloud' 
        ),
        array(
             'pe-7s-clock' => 'clock' 
        ),
        array(
             'pe-7s-check' => 'check' 
        ),
        array(
             'pe-7s-chat' => 'chat' 
        ),
        array(
             'pe-7s-cart' => 'cart' 
        ),
        array(
             'pe-7s-camera' => 'camera' 
        ),
        array(
             'pe-7s-call' => 'call' 
        ),
        array(
             'pe-7s-calculator' => 'calculator' 
        ),
        array(
             'pe-7s-browser' => 'browser' 
        ),
        array(
             'pe-7s-box2' => 'box2' 
        ),
        array(
             'pe-7s-box1' => 'box1' 
        ),
        array(
             'pe-7s-bookmarks' => 'bookmarks' 
        ),
        array(
             'pe-7s-bicycle' => 'bicycle' 
        ),
        array(
             'pe-7s-bell' => 'bell' 
        ),
        array(
             'pe-7s-battery' => 'battery' 
        ),
        array(
             'pe-7s-ball' => 'ball' 
        ),
        array(
             'pe-7s-back' => 'back' 
        ),
        array(
             'pe-7s-attention' => 'attention' 
        ),
        array(
             'pe-7s-anchor' => 'anchor' 
        ),
        array(
             'pe-7s-albums' => 'albums' 
        ),
        array(
             'pe-7s-alarm' => 'alarm' 
        ),
        array(
             'pe-7s-airplay' => 'airplay' 
        ) 
    );
    return array_merge( $icons, $pixden );
}
/* This code filters the Categories archive widget to include the post count inside the link */
//add_filter( 'wp_list_categories', 'cat_count_span' );
function cat_count_span( $links ) {
    $links = str_replace( '</a> <span class="count">(', ' [', $links );
    $links = str_replace( ')</span>', ']</a>', $links );
    $links = str_replace( '</a> (', ' [', $links );
    $links = str_replace( ')', ']</a>', $links );
    return $links;
}
/* This code filters the Archive widget to include the post count inside the link */
//add_filter( 'get_archives_link', 'archive_count_span' );
function archive_count_span( $links ) {
    $links = str_replace( '</a>&nbsp;(', ' [', $links );
    $links = str_replace( ')', ']</a>', $links );
    return $links;
}
add_action( 'init', 'pergo_archive_page_id' );
function pergo_archive_page_id( ) {
    global $wpdb;
    $archiveArr = array(
         'portfolio',
        'service',
        'partner',
        'team',
        'job' 
    );
    foreach ( $archiveArr as $key => $value ) {
        $default = ( get_post_status( get_option( $value . '_archive_id' ) ) == 'publish' ) ? get_option( $value . '_archive_id' ) : '';
        $aid     = ot_get_option( $value . '_archive', $default );
        if ( $default != $aid ) {
            delete_option( $value . '_archive_id' );
            add_option( $value . '_archive_id', $aid );
            flush_rewrite_rules();
        } //$default != $aid
    } //$archiveArr as $key => $value
}
add_filter( 'revslider_mod_default_css_handles', 'pergo_revslider_mod_default_css_handles', 10, 1 );
function pergo_revslider_mod_default_css_handles( $defaults ) {
    $defaults[ '.tp-caption.pergo-subtitle-style1' ] = '5.0';
    $defaults[ '.tp-caption.pergo-subtitle-style2' ] = '5.0';
    $defaults[ '.tp-caption.pergo-title-style1' ]    = '5.0';
    $defaults[ '.tp-caption.pergo-title-style2' ]    = '5.0';
    return $defaults;
}
function pergo_wpml_lang_select_option( ) {
    $display = ot_get_option( 'header_language_dropdown', 'on' );
    if ( $display != 'on' )
        return false;
    if ( function_exists( 'icl_disp_language' ) ):
        $languages = icl_get_languages( 'skip_missing=0&orderby=code' );
        if ( !empty( $languages ) ) {
            $activeflag = pergo_wpml_custom_flags();
            echo '<li id="language_list" class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="' . $activeflag[ 'country_flag_url' ] . '"><span class="caret"></span></a><ul class="dropdown-menu">';
            foreach ( $languages as $l ) {
                echo '<li>';
                if ( $l[ 'country_flag_url' ] ) {
                    if ( !$l[ 'active' ] )
                        echo '<a href="' . $l[ 'url' ] . '">';
                    echo '<img src="' . $l[ 'country_flag_url' ] . '" height="12" alt="' . esc_attr($l[ 'language_code' ]) . '" width="18" />';
                    if ( !$l[ 'active' ] )
                        echo '</a>';
                } //$l[ 'country_flag_url' ]
                if ( !$l[ 'active' ] )
                    echo '<a href="' . $l[ 'url' ] . '">';
                echo icl_disp_language( $l[ 'native_name' ], $l[ 'translated_name' ] );
                if ( !$l[ 'active' ] )
                    echo '</a>';
                echo '</li>';
            } //$languages as $l
            echo '</ul></li>';
        } //!empty( $languages )
    endif;
    if ( function_exists( 'pll_the_languages' ) ):
        $args         = array(
             'current_lang' => true,
            'raw' => 1 
        );
        $current_lang = pll_the_languages( $args );
        $current_lang = array_filter( $current_lang, function( $ar ) {
            return ( $ar[ 'current_lang' ] == 1 );
        } );
        echo '<li  id="language_list" class="dropdown">';
        foreach ( $current_lang as $key => $value ) {
            if ( is_array( $value ) && array_key_exists( 'current_lang', $value ) ) {
                echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
                echo '<img src="' . esc_url( $value[ 'flag' ] ) . '" height="12" alt="' . esc_attr( $value[ 'locale' ] ) . '" width="18" />';
                echo '<span class="caret"></span></a>';
                break;
            } //is_array( $value ) && array_key_exists( 'current_lang', $value )
        } //$current_lang as $key => $value
        $args = array(
             'dropdown' => 0,
            'echo' => 1,
            'show_flags' => 1 
        );
        echo '<ul class="dropdown-menu">';
        pll_the_languages( $args );
        echo '</ul>';
        echo '</li>';
    endif;
    if ( function_exists( 'mltlngg_get_switcher_block' ) ):
        global $mltlngg_current_language, $mltlngg_enabled_languages;
        echo '<li  id="language_list" class="dropdown">';
        echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
        echo '<img class="mltlngg-lang" src="' . plugins_url( 'multilanguage/images/flags/', '' ) . $mltlngg_current_language . '.png" alt="' . esc_attr($mltlngg_current_language) . '">';
        echo '<span class="caret"></span></a>';
        echo '<ul class="dropdown-menu">';
        echo '<form name="mltlngg_change_language" method="post" action="">';
        foreach ( $mltlngg_enabled_languages as $item ) {
            $flag = ( empty( $item[ 'flag' ] ) ) ? plugins_url( 'multilanguage/images/flags/', '' ) . $item[ 'locale' ] . '.png' : $item[ 'flag' ];
            echo '<li><button class="mltlngg-lang-button-icons" name="mltlngg_change_display_lang" value="' . $item[ 'locale' ] . '" title="' . $item[ 'name' ] . '"><img class="mltlngg-lang" src="' . $flag . '" alt="' . esc_attr($item[ 'name' ]) . '"> ' . $item[ 'name' ] . '</button></li>';
        } //$mltlngg_enabled_languages as $item
        echo '</form>';
        echo '</ul>';
        echo '</li>';
    endif;
}
function pergo_wpml_custom_flags( ) {
    $languages = icl_get_languages( 'skip_missing=1' );
    $curr_lang = array( );
    if ( !empty( $languages ) ) {
        foreach ( $languages as $language ) {
            if ( !empty( $language[ 'active' ] ) ) {
                $curr_lang = $language; // This will contain current language info.
                break;
            } //!empty( $language[ 'active' ] )
        } //$languages as $language
    } //!empty( $languages )
    return $curr_lang;
}
function pergo_menu_search_icon( $class = '' ) {
    $search_icon_display = ot_get_option( 'search_icon_display', 'off' );
    if ( $search_icon_display == 'on' ):
        $sticky_display = ot_get_option( 'sticky_search_display', 'off' );
        return '<li class="search-icon sticky-' . $sticky_display . ' ' . $class . '"><a href="#"><i class="perch perch-Search"></i></a><ul class="dropdown-menu"><li>' . get_search_form( false ) . '</li></ul></li>';
    endif;
}
function pergo_get_intermediate_image_sizes_array( ) {
    $arr         = array( );
    $image_sizes = get_intermediate_image_sizes();
    foreach ( $image_sizes as $key => $value ) {
        $arr[ $value ] = $value;
    } //$image_sizes as $key => $value
    return $arr;
}
function pergo_get_image_id( $image_url ) {
    global $wpdb;
    $attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ) );
    return isset( $attachment[ 0 ] ) ? $attachment[ 0 ] : false;
}
if ( !function_exists( 'pergo_disable_post_type_arr' ) ):
    function pergo_disable_post_type_arr( ) {
        if ( function_exists( 'ot_get_option' ) ) {
            return ot_get_option( 'disable_post_type', array( ) );
        } //function_exists( 'ot_get_option' )
        else {
            return array( );
        }
    }
endif;

function pergo_vc_btn_style(){
    return array(
        'Default'               => '',
        'Transparent'           => 'btn-tra',
        'Transparent-purple'    => 'btn-tra-purple',
        'Transparent-skyblue'   => 'btn-tra-skyblue',
        'Transparent-black'     => 'btn-tra-black',
        'Transparent-white'     => 'btn-tra-white',
        'Semiwhite'             => 'btn-semiwhite',
        'Blue'                  => 'btn-blue',
        'Purple'                => 'btn-purple',
        'Skyblue'               => 'btn-skyblue',
        'Black'                 => 'btn-black',
        'White'                 => 'btn-white',
        'Yellow'                => 'btn-yellow',
        'Green'                 => 'btn-green',
        'Lightgreen'            => 'btn-lightgreen',
        'Red'                   => 'btn-red',
        'Teal'                  => 'btn-teal'
    );
}


function pergo_button_groups_param() {
    return array(
        pergo_vc_icon_set( 'fontawesome', 'icon', 'fa fa-angle-double-right', '' ),
        array(
             'type' => 'textfield',
            'value' => 'Get Started Now',
            'heading' => 'Button text',
            'param_name' => 'button_text',
            'admin_label' => true 
        ),
        array(
             'type' => 'textfield',
            'value' => '#',
            'heading' => 'Button URL',
            'param_name' => 'button_url',
        ),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Button target', 'pergo' ),
            'param_name' => 'button_target',
            'value' => array(
                 'Open link in a self tab' => '_self',
                'Open link in a new tab' => '_blank' 
            ) 
        ),
        array(
             'type' => 'dropdown',
            'heading' => __( 'Button style', 'pergo' ),
            'param_name' => 'button_style',
            'std' => 'btn-primary',
            'value' => pergo_vc_btn_style(),
            'admin_label' => true 
        ),
        array(
             'type' => 'dropdown',
            'std' => 'btn-normal',
            'value' => array( 
                'Default' => '',
                'Medium' => 'btn-md',                
                'Large' => 'btn-lg',
                'Small' => 'btn-sm',               
                
            ),
            'heading' => 'Button size',
            'param_name' => 'button_size' 
        ) 
    );
}
function pergo_get_button_groups( $buttons = array(), $extra_class = '' ) {
    if ( empty( $buttons ) )
        return;
    $output = '';
    foreach ( $buttons as $key => $value ):
        extract( shortcode_atts( array(
            'icon_position' => 'icon_position-right',
            'button_text' => 'Get Started Now',
            'button_url' => '#',
            'button_target' => '_self',
            'button_style' => 'btn-default',
            'button_size' => '',
            'icon' => 'fa fa-angle-double-right'
        ), $value ) );
        $iconClass              = array();
        $iconClass[ ]           = $icon;
        $iconClass              = array_filter( $iconClass );
        $buttonClass            = array(
             'btn',
            'btn-arrow',
            $extra_class 
        );
        $buttonClass[ ]         = $button_style;
        $buttonClass[ ]         = $button_size;
        $buttonClass            = array_filter( $buttonClass );
        $buttonAttr             = array( );
        $buttonAttr[ 'target' ] = $button_target;
        $buttonAttr[ 'href' ]   = esc_url( $button_url );
        $buttonAttr[ 'title' ]  = esc_attr( $button_text );
        $buttonAttr[ 'class' ]  = implode( ' ', $buttonClass );
        $attr                   = '';
        foreach ( $buttonAttr as $key => $value ) {
            $attr .= ' ' . $key . '="' . $value . '"';
        } //$buttonAttr as $key => $value
       
        if ( $icon != '' ) {
            $icon = '<i class="' . implode( ' ', $iconClass ) . '"></i>';
        } //$icon_pergo != ''
        $output .= '<a' . $attr . '><span>';
        $output .= pergo_parse_text( $button_text, array(
             'tag' => 'strong' 
        ) );
        $output .= ( $icon_position == 'icon_position-right' ) ? $icon : '';
        $output .= '</span></a>';
    endforeach;
    return $output;
}

function pergo_get_ot_button_groups( $buttons = array(), $extra_class = '' ) {
    if ( empty( $buttons ) )
        return;
    $output = '';
    foreach ( $buttons as $key => $value ):
        extract( shortcode_atts( array(
            'title' => 'Open Website',
            'button_url' => '#',
            'button_target' => '_blank',
            'button_style' => 'btn-default',
            'icon_position' => 'icon_position-right',
            'icon' => 'fa fa-angle-double-right'
        ), $value ) ); 
        $buttonClass            = array(
             'btn',
            'btn-arrow',
            $extra_class 
        );
        $buttonClass[ ]         = $button_style;
        $buttonClass            = array_filter( $buttonClass );
        $buttonAttr             = array( );
        $buttonAttr[ 'target' ] = $button_target;
        $buttonAttr[ 'href' ]   = esc_url( $button_url );
        $buttonAttr[ 'title' ]  = esc_attr( $title );
        $buttonAttr[ 'class' ]  = implode( ' ', $buttonClass );
        $attr                   = '';
        foreach ( $buttonAttr as $key => $value ) {
            $attr .= ' ' . $key . '="' . $value . '"';
        } //$buttonAttr as $key => $value
       
        $iconClass              = array();
        $iconClass[ ]           = $icon;
        $iconClass              = array_filter( $iconClass );
        if ( $icon != '' ) {
            $icon = '<i class="' . implode( ' ', $iconClass ) . '"></i>';
        } //$icon_pergo != ''
        $output .= '<a' . $attr . '><span>';
        $output .= pergo_parse_text( $title, array(
             'tag' => 'strong' 
        ) );
        $output .= ( $icon_position == 'icon_position-right' ) ? $icon : '';
        $output .= '</span></a>';
    endforeach;
    return $output;
}
function pergo_get_post_type_archive_page_id( $post_type ) {
    if ( $post_type == '' )
        return false;
    $id = false;
    if ( $post_type == 'portfolio' ) {
        $id = ot_get_option( 'portfolio_archive', $id );
        update_option( 'pergo_portfolio_archive_id', $id, 'yes' );
    } //$post_type == 'portfolio'
    if ( $post_type == 'team' ) {
        $id = ot_get_option( 'team_archive', $id );
        update_option( 'pergo_team_archive_id', $id, 'yes' );
    } //$post_type == 'team'
    if ( $post_type == 'service' ) {
        $id = ot_get_option( 'service_archive', $id );
        update_option( 'pergo_service_archive_id', $id, 'yes' );
    } //$post_type == 'service'
    return $id;
}
add_filter( 'display_post_states', 'pergo_add_display_post_states', 10, 2 );
function pergo_add_display_post_states( $post_states, $post ) {
    if ( intval( get_option( 'pergo_portfolio_archive_id' ) ) === $post->ID ) {
        $post_states[ ] = esc_attr(__( 'Portfolio Page', 'pergo' ));
    } //intval( get_option( 'pergo_portfolio_archive_id' ) ) === $post->ID

     if ( intval( get_option( 'pergo_team_archive_id' ) ) === $post->ID ) {
        $post_states[ ] = esc_attr(__( 'Team Page', 'pergo' ));
    }
    return $post_states;
}
function pergo_get_the_slug( $id = null ) {
    if ( empty( $id ) ):
        global $post;
        if ( empty( $post ) )
            return ''; // No global $post var available.
        $id = $post->ID;
    endif;
    $slug = basename( get_permalink( $id ) );
    return $slug;
}
function pergo_select_background_size( $choices, $field_id ) {
    $choices = array(
         array(
             'label' => 'background-size',
            'value' => '' 
        ),
        array(
             'label' => 'auto',
            'value' => 'auto' 
        ),
        array(
             'label' => 'cover',
            'value' => 'cover' 
        ),
        array(
             'label' => 'contain',
            'value' => 'contain' 
        ),
        array(
             'label' => 'initial',
            'value' => 'initial' 
        ),
        array(
             'label' => 'inherit',
            'value' => 'inherit' 
        ) 
    );
    return $choices;
}
add_filter( 'ot_type_background_size_choices', 'pergo_select_background_size', 10, 2 );

function pergo_bg_color_options(){
    $arr = array();
    $colors = pergo_default_color_classes();
    foreach ($colors as $key => $value) {
        $color_name = $value['label'];
        $color_class = 'bg-'.$key;
        $arr[] = array( 'label' => $color_name, 'value' =>  $color_class ); 
    }
    return $arr;
}

function pergo_nav_bg_color_options(){
    return array(           
            array( 'label' => 'Transparent dark', 'value' => 'navbar-dark bg-tra' ),
            array( 'label' => 'Transparent light', 'value' => 'navbar-light bg-tra' ),
            array( 'label' => 'White', 'value' => 'navbar-light bg-light' ),
            array( 'label' => 'Dark', 'value' => 'bg-dark navbar-dark' ),
       
        );
}
function pergo_vc_color_options($coloronly = false){
    $arr = pergo_bg_color_options();
    $colorArr = array('Default' => 'default');
    $newarr = array('Default' => 'default-color');
    foreach ($arr as $key => $value) {
        $newkey = $value['label'];
        $newvalue = $value['value'];
        $newvalue = str_replace( 'bg-', '', $newvalue );
        $colorArr[$newkey] = $newvalue;
        $newvalue = $newvalue. '-color';
        $newarr[$newkey] = $newvalue;
    }
    if($coloronly){
        return $colorArr;
    }else{
        return $newarr;
    }    
}



function pergo_btn_style_options(){
    $arr = array(
            array( 'label' => 'Default',  'value' => 'btn-default' ),
            array( 'label' => 'Transparent white',  'value' => 'btn-tra-white tra-hover' ),
        );
     $colorarr = pergo_default_color_classes();
     foreach ($colorarr as $key => $value) {
         $arr[] = array( 'label' => $value['label'],  'value' => 'btn-'.$key );
         if( $key != 'tra' ){
            $arr[] = array( 'label' => $value['label'] . ' Transparent background',  'value' => 'btn-tra-'.$key );
         }
         
     }
    return $arr;
}

function pergo_spacing_options(){
    $arr = array();

    for ($i=0; $i < 12 ; $i++) { 
      $arr[] = array( 'label' => 'Top & bottom padding '.($i*10),  'value' => 'p-top-bottom-'.($i*10) );
    }
    return $arr;
}

function pergo_vc_padding_options(){
    $output = array();
   
    for ($i=0; $i <= 12 ; $i++) { 
        $output['Wide -'. ($i * 10)] = 'wide-'. ($i * 10);
    }
    return $output;
}

function pergo_vc_top_padding_options(){
    $output = array();
   
    for ($i=0; $i <= 12 ; $i++) { 
         $output[] = array( 'label' => 'Padding top -'. ($i * 10),  'value' => 'p-top-'. ($i * 10) );        
    }
    return $output;
}

function pergo_vc_bottom_padding_options(){
    $output = array();
   
    for ($i=0; $i <= 12 ; $i++) { 
        $output[] = array( 'label' => 'Padding bottom -'. ($i * 10),  'value' => 'p-bottom-'. ($i * 10) );  
    }
    return $output;
}


function pergo_vc_background_options(){
    $output = array();

    $arr = pergo_bg_color_options();
   $output['Transparent'] = 'bg-tra';
    foreach ($arr as $value) {
        $key = $value['label'];
        $output[$key] =  $value['value'];
    }
    return $output;
}

function pergo_contact_form_options(){
    $cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

    $contact_forms = array();
    if ( $cf7 ) {
        foreach ( $cf7 as $cform ) {
            $contact_forms[ $cform->post_title ] = $cform->ID;
        }
    } else {
        $contact_forms[ esc_attr(__( 'No contact forms found', 'pergo' )) ] = 0;
    }

    return $contact_forms;
}


function pergo_archive_page_size( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ( is_post_type_archive( 'portfolio' ) ) {
        // Display 50 posts for a custom post type called 'movie'
        $query->set( 'posts_per_page', 6 );
        return;
    }

    if ( is_post_type_archive( 'team' ) ) {
        // Display 50 posts for a custom post type called 'movie'
        $query->set( 'posts_per_page', -1 );
        return;
    }
}
add_action( 'pre_get_posts', 'pergo_archive_page_size', 1 );

function pergo_inline_bg_image($bg_url = ''){
    $style = ($bg_url != '')?' style="background-image: url('.esc_url($bg_url).')"' : '';

    return $style;
}

if ( function_exists( 'vc_set_as_theme' ) ):
    include PERGO_DIR . '/admin/vc-icons.php';
    include PERGO_DIR . '/admin/vc-extends.php';
endif;


add_filter(  'cool_megamenu_type', 'pergo_cool_megamenu_type' );
function pergo_cool_megamenu_type(){
    return 'bs4';
}
add_filter(  'cool_megamenu_load_css', 'pergo_cool_megamenu_load_css' );
function pergo_cool_megamenu_load_css(){
    return 'on';
}
add_filter(  'cool_megamenu_load_js', 'pergo_cool_megamenu_load_js' );
function pergo_cool_megamenu_load_js(){
    return 'on';
}
add_filter(  'cool_megamenu_toggle_icon', 'pergo_cool_megamenu_toggle_icon' );
function pergo_cool_megamenu_toggle_icon(){
    return 'off';
}

/**
* Post content serch replace 
* @param $content string
* @param $search string
* @param $replace string
*
* @return filtered string
*/
function pergo_content_search_replace_content($content, $search, $replace){
    $encode_search =  urlencode( $search);
    $encode_replace =  urlencode( $replace);
    $json_search =  json_encode( $search);
    $json_replace =  json_encode( $replace);

    $total_founds = substr_count($content, $search);
    $total_founds += substr_count($content, $encode_search);
    $total_founds += substr_count($content, $json_search);

    if( $total_founds > 0 ):
      // Search
      $content = str_replace($search, $replace, $content);
      $content = str_replace($encode_search, $encode_replace, $content);
      $content = str_replace($json_search, $json_replace, $content);
    endif;
    return $content;
}

function pergo_set_clean_content_by_post_type( $post_type = 'page', $args = array() ){
    $output = array();
    if( $post_type == '' ) return;
    $default = array(
      'search' => '',
      'replace' => '',
    );
    extract(wp_parse_args($args, $default));
    
    if($search != '' && $replace != ''){
        $post_list = get_posts(array(
            'post_type'   => $post_type,
            'posts_per_page' => -1,
        ));
        
        foreach ( $post_list as $post ) {
            $my_post = array(
              'ID'           => $post->ID,
              'post_content' => pergo_content_search_replace_content($post->post_content, $search,  $replace),
            );
            wp_update_post( $my_post );
        }
    }
}

add_action( 'wp_ajax_pergo_content_search_replace', 'pergo_content_search_replace_callback' );
function pergo_content_search_replace_callback(){
  $results = '';
  $ids = $_POST['ids'];
  $search = $_POST['search'];
  $replace = $_POST['replace'];

  if($search == '') wp_die();
  if($replace == '') wp_die();
  if(empty($ids)) wp_die();

  $encode_search =  urlencode( $search);
  $encode_replace =  urlencode( $replace);
  foreach ($ids as $post_id) {
      $post = get_post($post_id);
      $content = $post->post_content;
     

        $my_post = array(
            'ID'           => $post_id,
            'post_content' => pergo_content_search_replace_content($content, $search,  $replace),
        );     

      wp_update_post( $my_post );
      $results .= '<p>'.sprintf(esc_attr__( '%s items replace successfully for %s', 'pergo' ), $total_founds, $post->post_title).'</p>';
     

  }

 
  echo '<div id="message" class="updated pergo-message">';
  echo '<a class="welcome-panel-close" href="#" aria-label="Dismiss the panel">Dismiss</a>';
  echo do_shortcode($results);
  echo '</div>';
  
  
  wp_die();
}

