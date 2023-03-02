<?php
// Register Script
function cool_megamenu_scripts() {

    if(is_rtl()){
        $css_file = 'crmm.rtl.css';
    }else{
        $css_file = 'crmm.css';
    }
    
    $load_css = crmm_get_option('crmm_megamenu_load_css', 'off');
    if( $load_css == 'on' ):
        $bsfile = crmm_get_option('crmm_megamenu_type', '');
        switch ($bsfile) {
            case 'bs4':
                wp_enqueue_style( 'bootstrap', CRMM_URL . 'assets/bootstrap-4/css/bootstrap.min.css', false, '4.1.3' );
                break;
            case 'bs3':
                wp_enqueue_style( 'bootstrap', CRMM_URL . 'assets/bootstrap-3/bootstrap.min.css', false, '4.1.3' );
                break;    
            
            default:
            
                break;
        }
    endif;

   
	
	// Search for template in stylesheet directory
    if ( file_exists( get_stylesheet_directory() . '/cool-megamenu/css/'.$css_file ) ){
        $cssfile = get_stylesheet_directory_uri() . '/cool-megamenu/css/'.$css_file;
    }elseif ( file_exists( get_template_directory() . '/cool-megamenu/css/'.$css_file ) ){
        $cssfile = get_template_directory_uri() . '/cool-megamenu/css/'.$css_file;
    }else{
        $cssfile = CRMM_URL . 'assets/css/'.$css_file;
    }
        
    
	wp_enqueue_style( 'cool-megamenu', esc_url($cssfile), false, CRMM_VERSION );

    $load_js = crmm_get_option('crmm_megamenu_load_js', 'off');
	if( $load_js == 'on' ):
	    wp_enqueue_script( 'popper', CRMM_URL . 'assets/bootstrap-4/js/popper.min.js', array( 'jquery' ), '1.12.2', true );	 
	    wp_enqueue_script( 'bootstrap', CRMM_URL . 'assets/bootstrap-4/js/bootstrap.min.js', array( 'jquery', 'popper' ), '4.1.3', true );	
    endif; 
	// Search for template in stylesheet directory
    if ( file_exists( get_stylesheet_directory() . '/cool-megamenu/js/crmm.js' ) )
        $file = get_stylesheet_directory_uri() . '/cool-megamenu/js/crmm.js';
    // Search for template in theme directory
    elseif ( file_exists( get_template_directory() . '/cool-megamenu/js/crmm.js' ) )
        $file = get_template_directory_uri() . '/cool-megamenu/js/crmm.js';
    // Template not found
    else
        $file = CRMM_URL . 'assets/js/crmm.js';

	wp_enqueue_script( 'cool-megamenu', esc_url($file), array( 'jquery' ), CRMM_VERSION, true );	 

	$arr = array( 
		'ajaxurl' => admin_url( 'admin-ajax.php' )
		);
	wp_localize_script( 'cool-megamenu-localize', 'CRMM', $arr );

}
add_action( 'wp_enqueue_scripts', 'cool_megamenu_scripts' );
