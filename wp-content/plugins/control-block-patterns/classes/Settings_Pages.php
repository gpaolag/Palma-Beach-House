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
class Settings_Pages {
	public function __construct() {
		add_action( 'init', [$this, 'init'] );
	}	

		
	public function init() {
		new Settings\Loader;
		new Settings\Customizer\Manager;
	}
	
}
