<?php
namespace ControlPatterns;
/**
 * Load plugin's files with check for installing it as a standalone plugin or
 * a module of a theme / plugin. If standalone plugin is already installed, it
 * will take higher priority.
 *
 * @package ControlPatterns
 */

/**
 * Plugin loader class.
 *
 * @package ControlPatterns
 */
class Loader {
	public function __construct() {
		
		$this->init();
	}
	/**
	 * Define plugin constants.
	 */
	protected function constants() {
		// Script version, used to add version for scripts and styles.
		define( 'CTRLBP_VER', '1.3.5.3' );

		list( $path, $url ) = self::get_path( dirname( dirname( __FILE__ ) ) );

		// Plugin URLs, for fast enqueuing scripts and styles.
		define( 'CTRLBP_URI', $url );
		define( 'CTRLBP_ASSETS_URI', trailingslashit( CTRLBP_URI . 'assets' ) );		
		define( 'CTRLBP_JS_URI', trailingslashit( CTRLBP_URI . 'assets/js' ) );
		define( 'CTRLBP_CSS_URI', trailingslashit( CTRLBP_URI . 'assets/css' ) );

		// Plugin paths, for including files.
		define( 'CTRLBP_DIR', $path );
		
		define( 'CTRLBP_ASSETS_DIR', trailingslashit( CTRLBP_DIR . 'assets' ) );
		define( 'CTRLBP_INC_URI', trailingslashit( CTRLBP_URI . 'includes' ) );
		define( 'CTRLBP_INC_DIR', trailingslashit( CTRLBP_DIR . 'includes' ) );
	}

	/**
	 * Get plugin base path and URL.
	 * The method is static and can be used in extensions.
	 *
	 * @link http://www.deluxeblogtips.com/2013/07/get-url-of-php-file-in-wordpress.html
	 * @param string $path Base folder path.
	 * @return array Path and URL.
	 */
	public static function get_path( $path = '' ) {
		// Plugin base path.
		$path       = wp_normalize_path( untrailingslashit( $path ) );
		$themes_dir = wp_normalize_path( untrailingslashit( dirname( get_stylesheet_directory() ) ) );

		// Default URL.
		$url = plugins_url( '', $path . '/' . basename( $path ) . '.php' );

		// Included into themes.
		if (
			0 !== strpos( $path, wp_normalize_path( WP_PLUGIN_DIR ) )
			&& 0 !== strpos( $path, wp_normalize_path( WPMU_PLUGIN_DIR ) )
			&& 0 === strpos( $path, $themes_dir )
		) {
			$themes_url = untrailingslashit( dirname( get_stylesheet_directory_uri() ) );
			$url        = str_replace( $themes_dir, $themes_url, $path );
		}

		$path = trailingslashit( $path );
		$url  = trailingslashit( $url );

		return array( $path, $url );
	}

	/**
	 * Bootstrap the plugin.
	 */
	public function init() {
		$this->constants();		
		
		// Plugin core.
		new Core;
		new Shortcode;
		// Validation module.
		new Validation;
		new Sanitizer;
		new Media_Modal;		

		// WPML Compatibility.
		new WPML;	

		// Group Field
		new Meta_Group;
		// Tabs
		new Tabs;		
		
		
		
		// Settings page
		new Settings_Pages;

		// Conditional Logic
		new Conditional;
		new Responsive;	
		
		// Blocks
		new Blocks\Loader;	
		// User
		new User\Meta;
		// Term
		new Term\Loader;
		
		new User\DuplicatedFields;
		// Admin columns
		new Columns\Loader;	

		// Patterns
		new Patterns;

		// Misc
		new About(false);		
	}	
}
