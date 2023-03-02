<?php
namespace ControlPatterns\Helpers;
/**
 * Helper functions for checking values.
 *
 * @package ControlPatterns
 */

/**
 * Helper class for checking values.
 *
 * @package ControlPatterns
 */
class Value_Type {
	/**
	 * Check if a value is valid for field (not empty "WordPress way"), e.g. equals to empty string or array.
	 *
	 * @param mixed $value Input value.
	 * @return bool
	 */
	public static function is_valid_for_field( $value ) {
		return '' !== $value && array() !== $value;
	}

	/**
	 * Check if a value is valid for attribute.
	 *
	 * @param mixed $value Input value.
	 * @return bool
	 */
	public static function is_valid_for_attribute( $value ) {
		return '' !== $value && false !== $value;
	}
}
