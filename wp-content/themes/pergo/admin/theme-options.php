<?php
//include all available options
include PERGO_DIR . '/admin/options/general_options.php';
include PERGO_DIR . '/admin/options/background_options.php';
include PERGO_DIR . '/admin/options/header_options.php';
include PERGO_DIR . '/admin/options/sidebar_options.php';
include PERGO_DIR . '/admin/options/footer_options.php';
include PERGO_DIR . '/admin/options/blog_options.php';
include PERGO_DIR . '/admin/options/portfolio_options.php';
include PERGO_DIR . '/admin/options/typography_options.php';
include PERGO_DIR . '/admin/options/styling_options.php';
include PERGO_DIR . '/admin/options/slider_options.php';
include PERGO_DIR . '/admin/options/404_options.php';
include PERGO_DIR . '/admin/options/woo_options.php';
function pergo_woo_ot_section() {
    return array(
         'id' => 'woo_options',
        'title' => __( 'Woo options', 'pergo' ) 
    );
}
/**

* Initialize the custom theme options.

*/
add_action( 'admin_init', 'pergo_theme_options', 1 );
/**

* Build the custom settings & update OptionTree.

*/
function pergo_theme_options( ) {
    /* OptionTree is not loaded yet */
    if ( !function_exists( 'ot_settings_id' ) )
        return false;
    /**
    
    * Get a copy of the saved settings array. 
    
    */
    $saved_settings     = get_option( ot_settings_id(), array( ) );
    /**
    
    * Custom settings array that will eventually be 
    
    * passes to the OptionTree Settings API Class.
    
    */
    //available option functions - return type array()
    $general_options    = pergo_general_options();
    $background_options = pergo_background_options();
    $header_options     = pergo_header_options();
    $slider_options     = pergo_slider_options();
    $sidebar_options    = pergo_sidebar_options();
    $footer_options     = pergo_footer_options();
    $blog_options       = pergo_blog_options();
    $portfolio_options  = pergo_portfolio_options();
    $typography_options = pergo_typography_options();
    $styling_options    = pergo_styling_options();
    $error_options      = pergo_404_options();
    $woo_options        = pergo_woo_options();

    //merge all available options
    $settings           = array_merge( $general_options, $background_options, $header_options, $slider_options, $sidebar_options, $footer_options, $blog_options, $portfolio_options, $error_options, $typography_options, $styling_options, $woo_options );
    $custom_settings    = array(
         'contextual_help' => array(
             'sidebar' => '' 
        ),
        'sections' => array(
             array(
                 'id' => 'general_options',
                'title' => __( 'General options', 'pergo' ) 
            ),
            array(
                 'id' => 'header_options',
                'title' => __( 'Header options', 'pergo' ) 
            ),
            array(
                 'id' => 'background_options',
                'title' => __( 'Background Options', 'pergo' ) 
            ),
            array(
                 'id' => 'footer_options',
                'title' => __( 'Footer options', 'pergo' ) 
            ),
            array(
                 'id' => 'sidebar_option',
                'title' => __( 'Sidebar options', 'pergo' ) 
            ),
            array(
                 'id' => 'blog_options',
                'title' => __( 'Blog options', 'pergo' ) 
            ),
            array(
                 'id' => 'portfolio_options',
                'title' => __( 'Portfolio & Team options', 'pergo' ) 
            ),
            pergo_woo_ot_section(),
            array(
                 'id' => '404_options',
                'title' => __( '404 page', 'pergo' ) 
            ),
            array(
                 'id' => 'fonts',
                'title' => __( 'Typography options', 'pergo' ) 
            ),
            array(
                 'id' => 'styling_options',
                'title' => __( 'Styling options', 'pergo' ) 
            ),
        ),
        'settings' => $settings 
    );
    /* allow settings to be filtered before saving */
    //$custom_settings = apply_filters( ot_settings_id() . '_args', $custom_settings );
    /* settings are not the same update the DB */
    if ( ( $saved_settings !== $custom_settings ) ) {
        update_option( ot_settings_id(), $custom_settings );
    } //( $saved_settings !== $custom_settings )
    /* Lets OptionTree know the UI Builder is being overridden */
    global $ot_has_custom_theme_options;
    $ot_has_custom_theme_options = true;
    return $custom_settings[ 'settings' ];
}