<?php

if(!function_exists('pergo_posts_template')):

  function pergo_posts_template( $atts, $content = null, $type = "posts" ) {
    // Prepare error var
    $error = null;
    // Parse attributes
    $atts  = shortcode_atts( array(
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
      'autoplay' => 'no',
      'control' => 'yes',
      'column' => 4 ,
      'active' => '',
      'readmore_link' =>'no',
      'info' => '',
      'pagination' => 'yes',
      'all_posts_link_text' => 'See All posts'
    ), $atts, $type );    

    $original_atts = $atts;    

    $author              = sanitize_text_field( $atts['author'] );
    $id                  = $atts['id']; // Sanitized later as an array of integers
    $ignore_sticky_posts = ( bool ) ( $atts['ignore_sticky_posts'] === 'yes' ) ? true : false;
    $meta_key            = sanitize_text_field( $atts['meta_key'] );
    $offset              = intval( $atts['offset'] );
    $order               = sanitize_key( $atts['order'] );
    $orderby             = sanitize_key( $atts['orderby'] );
    $post_parent         = $atts['post_parent'];
    $post_status         = $atts['post_status'];
    $post_type           = sanitize_text_field( $atts['post_type'] );
    $posts_per_page      = intval( $atts['posts_per_page'] );
    $tag                 = sanitize_text_field( $atts['tag'] );
    $tax_operator        = $atts['tax_operator'];
    $tax_term            = sanitize_text_field( $atts['tax_term'] );
    $taxonomy            = sanitize_key( $atts['taxonomy'] );
    // Set up initial query for post

    $args                = array(
       'category_name' => '',
      'order' => $order,
      'orderby' => $orderby,
      'post_type' => $post_type,
      'posts_per_page' => $posts_per_page,
      'tag' => $tag 
    );

    // Ignore Sticky Posts

    if ( $ignore_sticky_posts )
      $args['ignore_sticky_posts'] = true;
    // Meta key (for ordering)

    if ( !empty( $meta_key ) )
      $args['meta_key'] = $meta_key;

    // If Post IDs
    if ( $id ) {
      $posts_in         = array_map( 'intval', explode( ',', $id ) );
      $args['post__in'] = $posts_in;
    } //$id

    // Post Author
    if ( !empty( $author ) )
      $args['author'] = $author;

    // Offset
    if ( !empty( $offset ) )
      $args['offset'] = $offset;

    // Post Status
    $post_status = explode( ', ', $post_status );
    $validated   = array();
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
        $validated[] = $unvalidated;
    } //$post_status as $unvalidated

    if ( !empty( $validated ) )
      $args['post_status'] = $validated;
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
            'field' => ( is_numeric( $tax_term[0] ) ) ? 'id' : 'slug',
            'terms' => $tax_term,
            'operator' => $tax_operator 
          ) 
        ) 
      );

      // Check for multiple taxonomy queries
      $count            = 2;
      $more_tax_queries = false;
      while ( isset( $original_atts['taxonomy_' . $count] ) && !empty( $original_atts['taxonomy_' . $count] ) && isset( $original_atts['tax_' . $count . '_term'] ) && !empty( $original_atts['tax_' . $count . '_term'] ) ) {

        // Sanitize values
        $more_tax_queries        = true;
        $taxonomy                = sanitize_key( $original_atts['taxonomy_' . $count] );
        $terms                   = explode( ', ', sanitize_text_field( $original_atts['tax_' . $count . '_term'] ) );
        $tax_operator            = isset( $original_atts['tax_' . $count . '_operator'] ) ? $original_atts['tax_' . $count . '_operator'] : 'IN';
        $tax_operator            = in_array( $tax_operator, array(
           'IN',
          'NOT IN',
          'AND' 
        ) ) ? $tax_operator : 'IN';
        $tax_args['tax_query'][] = array(
           'taxonomy' => $taxonomy,
          'field' => 'slug',
          'terms' => $terms,
          'operator' => $tax_operator 
        );
        $count++;
      } //isset( $original_atts['taxonomy_' . $count] ) && !empty( $original_atts['taxonomy_' . $count] ) && isset( $original_atts['tax_' . $count . '_term'] ) && !empty( $original_atts['tax_' . $count . '_term'] )

      if ( $more_tax_queries ):
        $tax_relation = 'AND';
        if ( isset( $original_atts['tax_relation'] ) && in_array( $original_atts['tax_relation'], array(
           'AND',
          'OR' 
        ) ) )
          $tax_relation = $original_atts['tax_relation'];
        $args['tax_query']['relation'] = $tax_relation;
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

    $args['paged'] = $paged;    

    // If post parent attribute, set up parent
    if ( $post_parent ) {
      if ( 'current' == $post_parent ) {
        global $post;
        $post_parent = $post->ID;
      } //'current' == $post_parent

      $args['post_parent'] = intval( $post_parent );

    } //$post_parent
    // Save original posts
    global $posts;
    $original_posts = $posts;

    // Query posts
    $posts = new WP_Query( $args ); 

    $posts->info = $atts['info'];   

    // Buffer output
    ob_start();
    // Search for template in stylesheet directory
    if ( file_exists( get_stylesheet_directory() . '/' . $atts['template'] ) )
      load_template( get_stylesheet_directory() . '/' . $atts['template'], false );
    // Search for template in theme directory

    elseif ( file_exists( get_template_directory() . '/' . $atts['template'] ) )
      load_template( get_template_directory() . '/' . $atts['template'], false );    

    // Template not found
    else
      echo __( 'Template not found', 'pergo' );
    $output = ob_get_contents();
    ob_end_clean();
    // Return original posts
    $posts = $original_posts;
    // Reset the query
    wp_reset_postdata();    

    return $output;
  }
endif;


add_shortcode( 'pergo_single_team_info', 'pergo_single_team_info_callback' );
function pergo_single_team_info_callback( $atts, $content = '' ){
	$atts = shortcode_atts( array(
	      'template' => 'team/header-info.php',
	  ), $atts );
	// Buffer output
  ob_start();

  // Search for template in stylesheet directory
  if ( file_exists( get_stylesheet_directory() . '/' . $atts['template'] ) )
    load_template( get_stylesheet_directory() . '/' . $atts['template'], false );
  // Search for template in theme directory

  elseif ( file_exists( get_template_directory() . '/' . $atts['template'] ) )
    load_template( get_template_directory() . '/' . $atts['template'], false );  

  // Template not found
  else

    echo __( 'template not found', 'pergo' );
  $output = ob_get_contents();
  ob_end_clean();  

  return $output;
}



add_shortcode( 'pergo_single_portfolio_info', 'pergo_single_portfolio_info_callback' );
function pergo_single_portfolio_info_callback( $atts, $content = '' ){
  $atts = shortcode_atts( array(
        'template' => 'portfolio/gallery.php',
    ), $atts );


  // Buffer output
  ob_start();

  // Search for template in stylesheet directory

  if ( file_exists( get_stylesheet_directory() . '/' . $atts['template'] ) )
    load_template( get_stylesheet_directory() . '/' . $atts['template'], false );
  // Search for template in theme directory

  elseif ( file_exists( get_template_directory() . '/' . $atts['template'] ) )
    load_template( get_template_directory() . '/' . $atts['template'], false );
  

  // Template not found
  else

    echo __( 'template not found', 'pergo' );
  $output = ob_get_contents();
  ob_end_clean();  

  return $output; 

}



add_shortcode( 'pergo_posts', 'pergo_posts_callback' );
function pergo_posts_callback( $atts, $content = '' ) {
    $atts = shortcode_atts( array(
    'template'            => 'templates/default-loop.php',
    'posts_per_page'      => 3,
    'img_size'            => 'pergo-600x600-crop',
    'excerpt_length'      => 18,
    'id'                  => '',
    'post_type'           => 'post',
    'taxonomy'            => 'category',
    'tax_term'            => true,
    'tax_operator'        => 'IN',
    'order'               => 'DESC',
    'orderby'             => 'date',
    'ignore_sticky_posts' => 'yes',
    'column'              => 3,
    'dots'                => 'yes',
    'autoplay'            => 'no',
    'active' => '',
    'filter' => 'yes',
    'read_more'           => 'Read more'
  ), $atts );


  $atts['info'] = $atts;

  return pergo_posts_template( $atts );
}


// Realstate Shortcode
add_shortcode( 'pergo_team_template', 'pergo_team_callback' );
function pergo_team_callback( $atts = null, $content = null ) {
    $atts = shortcode_atts( array(
        'template' => 'team/default-loop.php',
        'posts_per_page' => -1,
       'id' => '',
       'tax_term' => false,
       'tax_operator' => '',
       'order' => 'desc',
       'orderby' => 'id',
       'post_type' => 'team',
      'taxonomy' => '',
      'column' => 3,
      'read_more' => 'Know more',
      'dots' => 'no',
      'loop' => 'no',
      'navs' => 'no',
      'autoplay' => 'no',
      ), $atts, 'team' );
    do_action( 'pergo/shortcode/team', $atts );

    $atts['info'] = $atts;
    return pergo_posts_template($atts, '', 'team');
}



// Realstate Shortcode
add_shortcode( 'pergo_services', 'pergo_services_callback' );
function pergo_services_callback( $atts = null, $content = null ) {
    $atts = shortcode_atts( array(
        'template' => 'service/grid-loop.php',
        'posts_per_page' => -1,
       'id' => '',
       'tax_term' => false,
       'tax_operator' => '',
       'order' => 'desc',
       'orderby' => 'id',
       'post_type' => 'service',
      'taxonomy' => '',
      'column' => 3,
      'read_more' => 'Know more',
      'dots' => 'no',
      'navs' => 'no',
      'autoplay' => 'no',
      ), $atts, 'services' );
    do_action( 'pergo/shortcode/services', $atts );

    $atts['info'] = $atts;
    return pergo_posts_template($atts, '', 'service');
}

// Realstate Shortcode
add_shortcode( 'pergo_portfolios', 'pergo_portfolios_callback' );
function pergo_portfolios_callback( $atts = null, $content = null ) {
    $atts = shortcode_atts( array(

      'title_display' => 'yes',
      'title' => 'My workfolio',
        'template' => 'portfolio/isotope.php',
        'posts_per_page' => -1,
       'id' => '',
       'tax_term' => false,
       'tax_operator' => '',
       'order' => 'desc',
       'orderby' => 'id',
       'post_type' => 'portfolio',
      'taxonomy' => 'portfolio_category',
      'column' => 3,
      'read_more' => 'Load more',
      'dots' => 'no',
      'navs' => 'no',
      'autoplay' => 'no',
      'active' => 'all',
      'spacing' => 'yes',
      'filter' => 'yes',
      'link_type' => 'popup',
      'img_size'  => 'pergo-400x--nocrop',
      ), $atts, 'portfolios' );

    do_action( 'pergo/shortcode/portfolios', $atts );

    $atts['info'] = $atts;
    return pergo_posts_template($atts, '', 'portfolio');
}



// Realstate Shortcode
add_shortcode( 'pergo_products', 'pergo_products_callback' );
function pergo_products_callback( $atts = null, $content = null ) {
    $atts = shortcode_atts( array( 
        'template' => 'woocommerce/carousel.php',
        'posts_per_page' => 3,
       'id' => '',
       'tax_term' => false,
       'tax_operator' => '',
       'order' => 'desc',
       'orderby' => 'id',
       'post_type' => 'product',
      'taxonomy' => 'product_cat',
      'column' => 3,
      'read_more' => 'Go to Shop',
      'dots' => 'no',
      'navs' => 'no',
      'autoplay' => 'no',
       'active' => 'all',
      'spacing' => 'yes',
      'filter' => 'yes',
      'link_type' => 'link',
      'img_size'  => 'pergo-400x-400-nocrop',
      ), $atts, 'products' );
    do_action( 'pergo/shortcode/products', $atts );

    $atts['info'] = $atts;
    return pergo_posts_template($atts, '', 'product');
}


add_shortcode( 'pergo_add_value', 'pergo_add_value_callback' );
function pergo_add_value_callback( $atts, $content = '' ) {
  $atts = shortcode_atts( array(
    'add_values' => ''
  ), $atts );  

  $output = '';
  $output = '';
  $paramGroup = (function_exists('vc_param_group_parse_atts'))? vc_param_group_parse_atts($atts['add_values']) : array();
  if(!empty($paramGroup)){
    $output .= '<div id="main" class="post-text">
                  <ul>';
    foreach ($paramGroup as $key => $value) {
        $output .= '<li>
                      <p class="h_small">'.esc_attr($value['title']).'</p>
                      <p class="smaller">'.esc_attr($value['desc']).'</p>
                      <div class="h30"></div>
                    </li>';
    }

    $output .= '</div></ul>';
  }  

  return $output;

}



add_shortcode( 'pergo_accordions', 'pergo_accordions_callback' );
function pergo_accordions_callback( $atts, $content = '' ) {
  return '<div class="pergo-accordions">'.do_shortcode('[vc_tta_accordion shape="square" spacing="3" c_position="right" active_section="1" no_fill="true"]'.$content.'[/vc_tta_accordion]').'</div>';
}



add_shortcode( 'pergo_tabs', 'pergo_tabs_callback' );
function pergo_tabs_callback( $atts, $content = '' ) {
  return '<div class="pergo-tabs">'.do_shortcode('[vc_tta_tabs shape="round" align="center" spacing="" active_section="1"]'.$content.'[/vc_tta_tabs]').'</div>';
}