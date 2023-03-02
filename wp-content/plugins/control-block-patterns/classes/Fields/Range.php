<?php
namespace ControlPatterns\Fields;
/**
 * The HTML5 range field.
 *
 * @package ControlPatterns
 */

/**
 * HTML5 range field class.
 */
class Range extends Number {
	/**
	 * Get field HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 * @return string
	 */
	public static function html( $meta, $field ) {
		return sprintf(
			'<div class="ctrlbp-range-inner">
				%s
				<span class="ctrlbp-range-output">%s</span>
			</div>',
			parent::html( $meta, $field ),
			$meta
		);
	}

	/**
	 * Enqueue styles.
	 */
	public static function admin_enqueue_scripts() {
		wp_enqueue_script( 'ctrlbp-range', CTRLBP_JS_URI . 'range.js', array(), CTRLBP_VER, true );
	}

	/**
	 * Normalize parameters for field.
	 *
	 * @param array $field Field parameters.
	 * @return array
	 */
	public static function normalize( $field ) {
		$field = wp_parse_args(
			$field,
			array(
				'max' => 10,
			)
		);
		$field = parent::normalize( $field );
		return $field;
	}

	/**
	 * Ensure number in range.
	 *
	 * @param mixed $new     The submitted meta value.
	 * @param mixed $old     The existing meta value.
	 * @param int   $post_id The post ID.
	 * @param array $field   The field parameters.
	 *
	 * @return int
	 */
	public static function value( $new, $old, $post_id, $field ) {
		$new = intval( $new );
		$min = intval( $field['min'] );
		$max = intval( $field['max'] );

		if ( $new < $min ) {
			return $min;
		}
		if ( $new > $max ) {
			return $max;
		}
		return $new;
	}
}
