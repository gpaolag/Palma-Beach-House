<?php
namespace ControlPatterns\Helpers;
use ControlPatterns\Helpers\String_Type as Helpers_String;
/**
 * Field helper functions.
 *
 * @package ControlPatterns
 */

/**
 * Field helper class.
 *
 * @package ControlPatterns
 */
class Field_Type {
	/**
	 * Localize a script only once.
	 *
	 * @link https://github.com/rilwis/control-block-patterns/issues/850
	 *
	 * @param string $handle Script handle.
	 * @param string $name   Object name.
	 * @param array  $data   Localized data.
	 */
	public static function localize_script_once( $handle, $name, $data ) {
		if ( ! wp_scripts()->get_data( $handle, 'data' ) ) {
			wp_localize_script( $handle, $name, $data );
		}
	}

	public static function add_inline_script_once( $handle, $text ) {
		if ( ! wp_scripts()->get_data( $handle, 'after' ) ) {
			wp_add_inline_script( $handle, $text );
		}
	}

	/**
	 * Get field class name.
	 *
	 * @param array $field Field settings.
	 * @return string
	 */
	public static function get_class( $field ) {
		$type  = self::get_type( $field );
		$class = 'ControlPatterns\\Fields\\' . Helpers_String::title_case( $type );
		return class_exists( $class ) ? $class : 'ControlPatterns\\Fields\\Input';
	}

	/**
	 * Get field type.
	 *
	 * @param array $field Field settings.
	 * @return string
	 */
	private static function get_type( $field ) {
		$type = isset( $field['type'] ) ? $field['type'] : 'text';
		
		$map  = array_merge(
			array(
				$type => $type,
			),
			array(
				'file_advanced'  => 'media',
				'plupload_image' => 'image_upload',
				'url'            => 'text',
			)
		);

		return $map[ $type ];
	}
}
