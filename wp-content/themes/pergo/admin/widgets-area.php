<?php
/*Pergo widget are - Main widget area + Page widget area + Portfolio widget area*/
add_action( 'widgets_init', 'pergo_sidebars' );
if ( !function_exists( 'pergo_sidebars' ) ) {
    // Register Sidebars
    function pergo_sidebars( ) {
        $args = array(
             'id' => 'sidebar-1',
            'name' => __( 'Main Widget Area', 'pergo' ),
            'before_title' => '<h5 class="h5-sm widget-title">',
            'after_title' => '</h5>',
            'before_widget' => '<div id="%1$s" class="single-widget sidebar-div m-bottom-50 %2$s">',
            'after_widget' => '</div>' 
        );
        register_sidebar( $args );
        $args = array(
             'id' => 'sidebar-page',
            'name' => __( 'Page Widget Area', 'pergo' ),
            'before_title' => '<h5 class="h5-sm widget-title">',
            'after_title' => '</h5>',
            'before_widget' => '<div id="%1$s" class="single-widget sidebar-div m-bottom-50 %2$s">',
            'after_widget' => '</div>' 
        );
        register_sidebar( $args );
        $args = array(
             'id' => 'sidebar-portfolio',
            'name' => __( 'Portfolio Widget Area', 'pergo' ),
            'before_title' => '<h5 class="h5-sm widget-title">',
            'after_title' => '</h5>',
            'before_widget' => '<div id="%1$s" class="single-widget sidebar-div m-bottom-50 %2$s">',
            'after_widget' => '</div>' 
        );
        register_sidebar( $args );
        if ( function_exists( 'is_woocommerce' ) ):
            $args = array(
                 'id' => 'sidebar-product',
                'name' => __( 'Shop Widget Area', 'pergo' ),
                'before_title' => '<h5 class="h5-sm widget-title">',
                'after_title' => '</h5>',
                'before_widget' => '<div id="%1$s" class="single-widget sidebar-div m-bottom-50 %2$s">',
                'after_widget' => '</div>' 
            );
            register_sidebar( $args );
        endif;
        $footer_widget_display = ot_get_option( 'footer_widget_area', 'on' );
        //if ( $footer_widget_display == 'on' ):
            $column = ot_get_option( 'footer_widget_area_column', '4' );
            for ( $i = 1; $i <= $column; $i++ ) {
                $args = array(
                     'id' => 'footer-' . $i,
                    'name' => __( 'Footer Widget Area ', 'pergo' ) . intval( $i ),
                    'before_title' => '<h5 class="h5-sm">',
                    'after_title' => '</h5>',
                    'before_widget' => '<div id="%1$s" class="footer-widget m-bottom-40 %2$s">',
                    'after_widget' => '</div>'  
                );
                register_sidebar( $args );
            } //$i = 1; $i <= $column; $i++
        //endif;
        if ( function_exists( 'ot_get_option' ) ):
            $sidebarArr = ot_get_option( 'create_sidebar', array( ) );
            if ( !empty( $sidebarArr ) ) {
                $i = 2;
                foreach ( $sidebarArr as $sidebar ) {
                    register_sidebar( array(
                         'name' => esc_attr( $sidebar[ 'title' ] ),
                        'id' => 'sidebar-' . $i,
                        'description' => esc_attr( $sidebar[ 'desc' ] ),
                        'before_widget' => '<aside id="%1$s" class="single-widget %2$s">',
                        'after_widget' => '</aside>',
                        'before_title' => '<h3 class="widget-title">',
                        'after_title' => '</h3>' 
                    ) );
                    $i++;
                } //$sidebarArr as $sidebar
            } //!empty( $sidebarArr )
        endif; //if( function_exists( 'ot_get_option' ) ):	
    }
} //!function_exists( 'pergo_sidebars' )

function pergo_context_args($context){
    return $context;
}