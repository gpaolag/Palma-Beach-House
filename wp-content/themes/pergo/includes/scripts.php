<?php
function pergo_get_typography_font_options(){
	$arr = array();
	
	$default_fonts = array(
		'Roboto:300,regular,500,700,900',
		'Montserrat:300,regular,500,600,700,800,900',
	);

	//return $default_fonts;
	$fonts = ot_get_option('pergo_google_fonts', $default_fonts);

	
	if( empty($fonts) ) return $default_fonts;

	$ot_set_google_fonts  = get_theme_mod( 'ot_google_fonts', array() );
	
	$default = array(			
            'montserrat'     => 'Montserrat',
            'roboto' => 'Roboto',
            'arial'     => 'Arial',
            'georgia'   => 'Georgia',
            'helvetica' => 'Helvetica',
            'palatino'  => 'Palatino',
            'tahoma'    => 'Tahoma',
            'times'     => '"Times New Roman", sans-serif',
            'trebuchet' => 'Trebuchet',
            'verdana'   => 'Verdana'
          );
	$default = apply_filters( 'pergo/recognized_font_families', $default );

	if( !empty($fonts) ){		
		foreach ($fonts as $key => $value) {
			 $f = isset($value['family'])? $value['family'] : 'Roboto';	

			 $familyArr = isset($ot_set_google_fonts[$f])? $ot_set_google_fonts[$f] : array('family' => $f);

			 $family = $familyArr['family'];
			 $variants = (isset($value['variants']) && !empty($value['variants']) )? implode(',', $value['variants']): '';
			 $arr[] = $family.':'.$variants;
		}
	}else{
		return $default_fonts;
	}

	return $arr;
}

if ( ! function_exists( 'pergo_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Fifteen.
 *
 * @return string Google fonts URL for the theme.
 */
function pergo_fonts_url() {
	$fonts_url = '';
	$fonts     = array();

	/*
	 * Translators: If there are characters in your language that are not supported
	 */
	$fonts = pergo_get_typography_font_options();
	

	$subsets   = 'latin,latin-ext';
	$subset = 'no-subset';

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;


/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 */
function pergo_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'pergo_javascript_detection', 0 );

// Register Style
function pergo_styles() {

	wp_dequeue_style( 'ot-google-fonts' );
	wp_register_style( 'pergo-google-fonts', pergo_fonts_url(), array(), null );
	wp_enqueue_style( 'pergo-google-fonts' );

	if( is_rtl() ){
		wp_enqueue_style( 'bootstrap', PERGO_URI. '/rtl/bootstrap-rtl.min.css', false, PERGO_VERSION );		
	}else{
		wp_enqueue_style( 'bootstrap', PERGO_URI. '/css/bootstrap.min.css', false, PERGO_VERSION );
	}

	wp_enqueue_style( 'fa-svg-with-js', PERGO_URI. '/css/fa-svg-with-js.css', false, '1.0' );	
	wp_enqueue_style( 'flaticon' );
	wp_enqueue_style( 'fontawesome' );
	wp_enqueue_style( 'magnific-popup', PERGO_URI. '/css/magnific-popup.css', false, '1.0' );	
	wp_dequeue_style( 'flexslider' );	
	wp_register_style( 'pergo-flexslider', PERGO_URI. '/css/flexslider.css', array(), '100' );
	wp_enqueue_style( 'pergo-flexslider' );
	wp_enqueue_style( 'owl-carousel', PERGO_URI. '/css/owl.carousel.min.css', false, '1.0' );
	wp_enqueue_style( 'owl-theme-default', PERGO_URI. '/css/owl.theme.default.min.css', false, '1.0' );
	wp_enqueue_style( 'slick', PERGO_URI. '/css/slick.css', false, '1.8.1' );
	wp_enqueue_style( 'slick-theme', PERGO_URI. '/css/slick-theme.css', false, '1.0.0.0' );
	wp_enqueue_style( 'animate', PERGO_URI. '/css/animate.css', false, '1.0' );
	wp_enqueue_style( 'selectize-bootstrap4', PERGO_URI. '/css/selectize.bootstrap4.css', false, '1.0' );

	if( function_exists('is_woocommerce') ){
    	wp_enqueue_style( 'pergo-woocommerce', PERGO_URI . '/css/woocommerce.css', array('bootstrap'), '1.0.0.1' );
	}

	wp_enqueue_style( 'pergo-default-style', PERGO_URI. '/css/style.css', false, '1.0.0.0' );
	wp_enqueue_style( 'pergo-style', get_stylesheet_uri(), false, PERGO_VERSION );
	if( is_rtl() ){
		wp_enqueue_style( 'pergo-styles-rtl', PERGO_URI. '/rtl/style-rtl.css', array('pergo-style'), PERGO_VERSION );		
	}
	
	wp_enqueue_style( 'pergo-responsive', PERGO_URI. '/css/responsive.css', array('pergo-style'), PERGO_VERSION );

	

	$pergo_layout_style = ot_get_option( 'pergo_layout_style', 'rounded' );
	if( $pergo_layout_style != 'rounded' ){
		wp_enqueue_style( 'pergo-layout-'.$pergo_layout_style, PERGO_URI. '/css/pergo-'.$pergo_layout_style.'.css', array('pergo-style'), PERGO_VERSION );
	}

}
add_action( 'wp_enqueue_scripts', 'pergo_styles' );

// Register Script
function pergo_scripts() {
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_register_script( 'pergo-map', PERGO_URI .'/js/pergo-map.js', array( 'jquery' ), '1.0', true );
	$key = 'AIzaSyAD6W-bPTWlf2LiQCtqEChUfxJcODPNGJ4';
	$key = ot_get_option( 'google_map_api', $key );
	wp_register_script( 'googleapis', '//maps.googleapis.com/maps/api/js?key='.esc_attr($key).'&callback=pergoinitMap', array( 'jquery', 'pergo-map' ), '1.0', true );	
	
	wp_enqueue_script( 'bootstrap', PERGO_URI .'/js/bootstrap.min.js', array( 'jquery' ), '1.0', true ); 	
	wp_enqueue_script( 'fontawesome-all', PERGO_URI .'/js/fontawesome-all.js', array('jquery'),'1.0',true );
	wp_enqueue_script( 'v4-shims', PERGO_URI .'/js/v4-shims.js', array( 'jquery' ), '1.0', true ); 
	wp_enqueue_script( 'modernizr-custom', PERGO_URI .'/js/modernizr.custom.js', array('jquery'),'1.0',true );
	wp_enqueue_script( 'imagesloaded-pkgd', PERGO_URI .'/js/imagesloaded.pkgd.min.js', array('jquery'),'1.0',true );	
	wp_enqueue_script( 'jquery-easing', PERGO_URI .'/js/jquery.easing.js', array('jquery'),'1.0',true );
	wp_enqueue_script( 'jquery-stellar', PERGO_URI .'/js/jquery.stellar.min.js', array('jquery'),'1.0',true );
	wp_enqueue_script( 'jquery-scrollto', PERGO_URI .'/js/jquery.scrollto.js', array('jquery'),'1.0',true );
	wp_enqueue_script( 'jquery-appear', PERGO_URI .'/js/jquery.appear.js', array('jquery'),'1.0',true );
	wp_enqueue_script( 'jquery-superslides', PERGO_URI .'/js/jquery.superslides.js', array('jquery'),'1.0',true );
	wp_enqueue_script( 'vidbg', PERGO_URI .'/js/vidbg.min.js', array('jquery'),'0.5.1',true );
	wp_enqueue_script( 'masonry-pkgd', PERGO_URI .'/js/masonry.pkgd.min.js', array('jquery'),'1.0',true );
	wp_enqueue_script( 'jquery-mixitup', PERGO_URI .'/js/jquery.mixitup.js', array('jquery'),'1.0',true );
	wp_enqueue_script( 'jquery-flexslider', PERGO_URI .'/js/jquery.flexslider.js', array('jquery'),'1.0',true );
	wp_enqueue_script( 'owl-carousel', PERGO_URI .'/js/owl.carousel.min.js', array('jquery'),'1.0',true );
	wp_enqueue_script( 'selectize', PERGO_URI .'/js/selectize.min.js', array('bootstrap'),'1.0',true );
	wp_enqueue_script( 'slick', PERGO_URI .'/js/slick.min.js', array('jquery'),'1.8.1',true );
	wp_enqueue_script( 'jquery-magnific-popup', PERGO_URI .'/js/jquery.magnific-popup.min.js', array('jquery'),'1.0',true );

	wp_enqueue_script( 'pergo-custom', PERGO_URI . '/js/custom.js', array( 'jquery' ), PERGO_VERSION, true );
	wp_register_script( 'jquery-countdown', PERGO_URI .'/js/jquery.countdown.min.js', array( 'pergo-custom' ), '1.0', true );
	 

	$arr = array( 
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'PERGO_URI' => PERGO_URI,
		'PERGO_DIR' => PERGO_DIR,
		'animation' => ot_get_option( 'pergo_animation', 'on' ),
		'backtotop' => ot_get_option( 'backtotop', 'on' )
		);
	wp_localize_script( 'pergo-custom', 'PERGO', $arr );



}
add_action( 'wp_enqueue_scripts', 'pergo_scripts' );

if( function_exists('register_block_type') ):
// Pergo gutenberg button block compability
function pergo_gutenberg_block_styles() {
	wp_register_style(
        'pergo-fonts',
        pergo_fonts_url(),
        array(),
        false
    );

    wp_register_style(
        'button',
        get_theme_file_uri( 'css/buttons/style.css' ),
        array(),
        filemtime( PERGO_DIR . '/css/buttons/style.css' )
    );


    if( is_admin() ):
	    wp_register_style(
	        'paragraph',
	        get_theme_file_uri( 'css/typography/style.css' ),
	        array( 'pergo-fonts' ),
	        filemtime( PERGO_DIR . '/css/typography/style.css' )
	    );
	    
	endif;
}

add_action( 'init', 'pergo_gutenberg_block_styles' );
endif;
