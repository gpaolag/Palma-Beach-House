<?php
namespace ControlPatterns\Fields;
/**
 * The checkbox list field which shows a list of choices and allow users to select multiple options.
 *
 * @package ControlPatterns
 */

/**
 * Checkbox list field class.
 */
class Checkbox_List extends Input_List {
	/**
	 * Normalize parameters for field.
	 *
	 * @param array $field Field parameters.
	 * @return array
	 */
	public static function normalize( $field ) {
		$field['multiple'] = true;
		$field             = parent::normalize( $field );

		return $field;
	}
}
