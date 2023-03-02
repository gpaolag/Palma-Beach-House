<?php
namespace ControlPatterns\Fields;
use ControlPatterns\Field as Field;

/**
 * The custom HTML field which allows users to output any kind of content to the meta box.
 *
 * @package ControlPatterns
 */

/**
 * Custom HTML field class.
 */
class Custom_Html extends Field {
	/**
	 * Get field HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 *
	 * @return string
	 */
	public static function html( $meta, $field ) {
		$html = ! empty( $field['std'] ) ? $field['std'] : '';
		if ( ! empty( $field['callback'] ) && is_callable( $field['callback'] ) ) {
			$html = call_user_func_array( $field['callback'], array( $meta, $field ) );
		}
		return $html;
	}
}
