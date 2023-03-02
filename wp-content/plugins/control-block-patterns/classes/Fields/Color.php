<?php
namespace ControlPatterns\Fields;

/**
 * The color field which uses WordPress color picker to select a color.
 *
 * @package ControlPatterns
 */

/**
 * Color field class.
 */
class Color extends Input {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {

		$dependencies = array( 'wp-color-picker' );
		$args         = func_get_args();
		$field        = reset( $args );
		if ( ! empty( $field['alpha_channel'] ) ) {
			wp_enqueue_script( 'wp-color-picker-alpha', CTRLBP_JS_URI . 'wp-color-picker-alpha/wp-color-picker-alpha.min.js', array( 'wp-color-picker' ), CTRLBP_VER, true );
			$dependencies = array( 'wp-color-picker-alpha' );
		}
		wp_enqueue_script( 'ctrlbp-color', CTRLBP_JS_URI . 'color.js', $dependencies, CTRLBP_VER, true );
	}

	/**
	 * Normalize parameters for field.
	 *
	 * @param array $field Field parameters.
	 *
	 * @return array
	 */
	public static function normalize( $field ) {
		$field = wp_parse_args(
			$field,
			array(
				'alpha_channel' => false,
				'js_options'    => array(),
			)
		);

		$field['js_options'] = wp_parse_args(
			$field['js_options'],
			array(
				'defaultColor' => false,
				'hide'         => true,
				'palettes'     => true,
			)
		);

		$field = parent::normalize( $field );

		return $field;
	}

	/**
	 * Get the attributes for a field.
	 *
	 * @param array $field Field parameters.
	 * @param mixed $value Meta value.
	 *
	 * @return array
	 */
	public static function get_attributes( $field, $value = null ) {
		$attributes         = parent::get_attributes( $field, $value );
		$attributes         = wp_parse_args(
			$attributes,
			array(
				'data-options' => wp_json_encode( $field['js_options'] ),
			)
		);
		$attributes['type'] = 'text';

		if ( $field['alpha_channel'] ) {
			$attributes['data-alpha-enabled']    = 'true';
			$attributes['data-alpha-color-type'] = 'hex';
		}

		return $attributes;
	}

	/**
	 * Format a single value for the helper functions. Sub-fields should overwrite this method if necessary.
	 *
	 * @param array    $field   Field parameters.
	 * @param string   $value   The value.
	 * @param array    $args    Additional arguments. Rarely used. See specific fields for details.
	 * @param int|null $post_id Post ID. null for current post. Optional.
	 *
	 * @return string
	 */
	public static function format_single_value( $field, $value, $args, $post_id ) {
		return sprintf( "<span style='display:inline-block;width:20px;height:20px;border-radius:50%%;background:%s;'></span>", $value );
	}
}
