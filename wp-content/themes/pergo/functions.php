<?php
define( 'PERGO_VERSION', '1.7.5' );
define( 'PERGO_URI', get_template_directory_uri() );
define( 'PERGO_DIR', get_template_directory() );


// Set content width value based on the theme's design
if ( ! isset( $content_width ) )
	$content_width = 1170;


if ( ! function_exists('pergo_theme_features') ) {
// Register Theme Features
function pergo_theme_features()  {

	// Add theme support for Automatic Feed Links
	add_theme_support( 'automatic-feed-links' );

	// Add theme support for Post Formats
	add_theme_support( 'post-formats', array( 'video' ) );

	// Add theme support for Featured Images
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'pergo-800x400-crop', 800, 400, true );
	add_image_size( 'pergo-700x700-crop', 700, 700, true );
	add_image_size( 'pergo-600x600-crop', 600, 600, true );
	add_image_size( 'pergo-400x400-crop', 400, 400, true );	
	add_image_size( 'pergo-400x500-crop', 400, 500, true );	
	add_image_size( 'pergo-400x--nocrop', 400, '', false );	
	add_image_size( 'pergo-150x150-crop', 150, 150, true );


	// add theme support for woocommerce
	add_theme_support( 'woocommerce' );


	 // Set custom thumbnail dimensions
	set_post_thumbnail_size( 830, 540, true );

	// Add theme support for Custom Background

	$background_args = array(
		'default-color'          => '#fff',
		'default-image'          => '',
		'default-repeat'         => '',
		'default-position-x'     => ''
	);

	// deactivate new block editor
function pergo_widgets_block_editor() {
    remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'pergo_widgets_block_editor' );


	// Add theme support for HTML5 Semantic Markup
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );


	// Add theme support for document Title tag
	add_theme_support( 'title-tag' );

	// Add theme support for custom CSS in the TinyMCE visual editor
	add_editor_style( 'css/editor-style.css', pergo_fonts_url(), 'css/flaticon.css' );

	// Add theme support for Translation
	load_theme_textdomain( 'pergo', get_template_directory() . '/languages' );	

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );


}

add_action( 'after_setup_theme', 'pergo_theme_features' );
}



if ( !function_exists( 'pergo_navigation_menus' ) ) {
	// Register Navigation Menus
	function pergo_navigation_menus() {
		$locations = array(
			'primary' => __( 'Header Menu', 'pergo' )
		);
		register_nav_menus( $locations );
	}
	add_action( 'init', 'pergo_navigation_menus' );

} //!function_exists( 'pergo_navigation_menus' )

// Required: include google fonts.
require( PERGO_DIR . '/admin/google-web-fonts.php' );

function pergo_default_color(){
	return 'rose';
}
/**
 * Filters the Layouts ID
 */

function pergo_filter_demo_layouts_id() {
  return 'pergo';
}

add_filter( 'ot_layouts_id', 'pergo_filter_demo_layouts_id' );

/**
 * Theme Mode
 */
add_filter( 'ot_theme_mode', '__return_true' );

/**
 * Child Theme Mode
 */
add_filter( 'ot_child_theme_mode', '__return_false' );

/**
 * Show Settings Pages
 */
add_filter( 'ot_show_pages', '__return_false' );

/**
 * Show Theme Options UI Builder
 */
add_filter( 'ot_show_options_ui', '__return_false' );

/**
 * Show Settings Import
 */
add_filter( 'ot_show_settings_import', '__return_false' );

/**
 * Show Settings Export
 */
add_filter( 'ot_show_settings_export', '__return_false' );

/**
 * Show New Layout
 */
add_filter( 'ot_show_new_layout', '__return_true' );

/**
 * Show posts format
 */
add_filter( 'ot_post_formats', '__return_true' );



// Required: include OptionTree.
require( PERGO_DIR . '/option-tree/ot-loader.php' );

// Theme Options
require( PERGO_DIR . '/admin/theme-options.php' );

//admin functions 
include PERGO_DIR. '/admin/functions.php';

//frontent functions
include PERGO_DIR. '/includes/functions.php';

/**
* @version 1.5.7
*/
include PERGO_DIR . '/admin/helpers.php';

//required plugins
require( PERGO_DIR . '/tgmpa/pergo-plugins.php' );