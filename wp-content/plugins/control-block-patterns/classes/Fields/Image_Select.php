<?php
namespace ControlPatterns\Fields;
use ControlPatterns\Field as Field;

/**
 * The image select field which behaves similar to the radio field but uses images as options.
 *
 * @package ControlPatterns
 */

/**
 * The image select field class.
 */
class Image_Select extends Field {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {
		wp_enqueue_script( 'ctrlbp-image-select', CTRLBP_JS_URI . 'image-select.js', array( 'jquery' ), CTRLBP_VER, true );
	}

	/**
	 * Get field HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 * @return string
	 */
	public static function html( $meta, $field ) {
		$html = array();
		$meta = (array) $meta;
		foreach ( $field['options'] as $value => $image ) {
			$attributes = self::get_attributes( $field, $value );
			$html[] = sprintf(
				'<label class="ctrlbp-image-select"><img src="%s"><input %s%s></label>',
				$image,
				self::render_attributes( $attributes ),
				checked( in_array( $value, $meta ), true, false )
			);
		}

		return implode( ' ', $html );
	}

	/**
	 * Normalize parameters for field.
	 *
	 * @param array $field Field parameters.
	 * @return array
	 */
	public static function normalize( $field ) {
		$field                = parent::normalize( $field );
		$field['field_name'] .= $field['multiple'] ? '[]' : '';

		return $field;
	}

	/**
	 * Get the attributes for a field.
	 *
	 * @param array $field Field parameters.
	 * @param mixed $value Meta value.
	 * @return array
	 */
	public static function get_attributes( $field, $value = null ) {
		$attributes = parent::get_attributes( $field, $value );
		$attributes['id']    = false;
		$attributes['type']  = $field['multiple'] ? 'checkbox' : 'radio';
		$attributes['value'] = $value;

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
		return $value ? sprintf( '<img src="%s">', esc_url( $field['options'][ $value ] ) ) : '';
	}
}
