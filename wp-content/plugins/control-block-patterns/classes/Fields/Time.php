<?php
namespace ControlPatterns\Fields;
/**
 * The time picker field.
 *
 * @package ControlPatterns
 */

/**
 * Time field class.
 */
class Time extends Datetime {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {
		parent::register_assets();
		wp_enqueue_style( 'jquery-ui-timepicker' );
		wp_enqueue_script( 'ctrlbp-time' );
	}

	/**
	 * Normalize parameters for field.
	 *
	 * @param array $field Field parameters.
	 * @return array
	 */
	public static function normalize( $field ) {
		$field                             = parent::normalize( $field );
		$field['js_options']['timeFormat'] = empty( $field['format'] ) ? $field['js_options']['timeFormat'] : $field['format'];
		return $field;
	}
}
