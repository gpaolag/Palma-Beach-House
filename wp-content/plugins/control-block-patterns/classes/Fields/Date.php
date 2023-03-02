<?php
namespace ControlPatterns\Fields;
/**
 * The date picker field, which uses built-in jQueryUI date picker widget.
 *
 * @package ControlPatterns
 */

/**
 * Date field class.
 */
class Date extends Datetime {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {
		parent::register_assets();
		wp_enqueue_script( 'ctrlbp-date' );
	}

	/**
	 * Returns a date() compatible format string from the JavaScript format.
	 *
	 * @link http://www.php.net/manual/en/function.date.php
	 * @param array $js_options JavaScript options.
	 *
	 * @return string
	 */
	public static function get_php_format( $js_options ) {
		return strtr( $js_options['dateFormat'], self::$date_formats );
	}
}
