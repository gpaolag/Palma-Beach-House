<?php
// Register Style
function perch_admin_styles( ) {
    wp_enqueue_style( 'perch-admin-style', PERCH_MODULES_URI . '/assets/css/style.css', false, '1.0.0', 'all' );
    wp_enqueue_style( 'perch-vc-admin', PERCH_MODULES_URI . '/assets/css/vc-admin.css', false, '1.0.0', 'all' );
    wp_enqueue_style( 'tonicons' );
    wp_enqueue_style( 'flaticon' );
	wp_enqueue_style( 'fontawesome' );
}
// Hook into the 'admin_enqueue_scripts' action
add_action( 'admin_enqueue_scripts', 'perch_admin_styles' );

// Register Script
function perch_admin_scripts() {
   
    wp_register_script( 'perch-admin-scripts', PERCH_MODULES_URI . '/assets/js/perch-ui.js', array(
         'jquery' 
    ), '1.0.0.1', false ); 
    wp_enqueue_script( 'perch-admin-scripts' );   

    $arr = array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'PERCH_MODULES_URI' => PERCH_MODULES_URI,
        'PERCH_MODULES_DIR' => PERCH_MODULES_DIR,
        'vc_preview' => 'full',
        );
    wp_localize_script( 'perch-admin-scripts', 'PERCH_MODULES', $arr );
}
// Hook into the 'admin_enqueue_scripts' action
add_action( 'admin_enqueue_scripts', 'perch_admin_scripts' );
