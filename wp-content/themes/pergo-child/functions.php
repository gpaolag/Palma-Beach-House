<?php
function pergo_child_enqueue_styles() {

    $parent_style = 'pergo-style';

    if( function_exists('is_woocommerce') ){
    	$dependency = array('pergo-google-fonts', 'fa-svg-with-js','bootstrap', 'pergo-woocommerce', 'pergo-default-style');
    }else{
    	$dependency = array('pergo-google-fonts', 'fa-svg-with-js','bootstrap', 'pergo-default-style');
    }

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', $dependency );
    wp_enqueue_style( 'pergo-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );

   
}
add_action( 'wp_enqueue_scripts', 'pergo_child_enqueue_styles' );

