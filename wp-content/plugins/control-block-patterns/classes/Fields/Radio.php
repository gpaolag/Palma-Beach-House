<?php
namespace ControlPatterns\Fields;
/**
 * The radio field.
 *
 * @package ControlPatterns
 */

/**
 * Radio field class.
 */
class Radio extends Input_List {
	/**
	 * Normalize parameters for field.
	 *
	 * @param array $field Field parameters.
	 * @return array
	 */
	public static function normalize( $field ) {
		$field['multiple'] = false;
		$field             = parent::normalize( $field );

		return $field;
	}
}
