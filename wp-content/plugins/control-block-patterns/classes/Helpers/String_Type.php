<?php
namespace ControlPatterns\Helpers;
/**
 * String helper functions.
 *
 * @package ControlPatterns
 */

/**
 * String helper class.
 *
 * @package ControlPatterns
 */
class String_Type {
	/**
	 * Convert text to Title_Case.
	 *
	 * @param  string $text Input text.
	 * @return string
	 */
	public static function title_case( $text ) {
		$text = str_replace( array( '-', '_' ), ' ', $text );
		$text = ucwords( $text );
		$text = str_replace( ' ', '_', $text );

		return $text;
	}
}
