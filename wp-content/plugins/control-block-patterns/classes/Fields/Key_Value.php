<?php
namespace ControlPatterns\Fields;
/**
 * The key-value field which allows users to add pairs of keys and values.
 *
 * @package ControlPatterns
 */

/**
 * Key-value field class.
 */
class Key_Value extends Input {
	public static function admin_enqueue_scripts() {
	}

	/**
	 * Get field HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 *
	 * @return string
	 */
	public static function html( $meta, $field ) {
		// Key.
		$key                       = isset( $meta[0] ) ? $meta[0] : '';
		$attributes                = self::get_attributes( $field, $key );
		$attributes['placeholder'] = $field['placeholder']['key'];
		$html                      = sprintf( '<input %s>', self::render_attributes( $attributes ) );

		// Value.
		$val                       = isset( $meta[1] ) ? $meta[1] : '';
		$attributes                = self::get_attributes( $field, $val );
		$attributes['placeholder'] = $field['placeholder']['value'];
		$html                     .= sprintf( '<input %s>', self::render_attributes( $attributes ) );

		return $html;
	}

	/**
	 * Show begin HTML markup for fields.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 *
	 * @return string
	 */
	public static function begin_html( $meta, $field ) {
		$desc = $field['desc'] ? "<p id='{$field['id']}_description' class='description'>{$field['desc']}</p>" : '';

		if ( empty( $field['name'] ) ) {
			return '<div class="ctrlbp-input">' . $desc;
		}

		return sprintf(
			'<div class="ctrlbp-label ctrlbp-col-12 ctrlbp-col-md-3">
				<label for="%s">%s</label>
			</div>
			<div class="ctrlbp-input ctrlbp-col-12 ctrlbp-col-md-9">
			%s',
			$field['id'],
			$field['name'],
			$desc
		);
	}

	/**
	 * Do not show field description.
	 *
	 * @param array $field Field parameters.
	 *
	 * @return string
	 */
	public static function input_description( $field ) {
		return '';
	}

	/**
	 * Sanitize field value.
	 *
	 * @param mixed $new     The submitted meta value.
	 * @param mixed $old     The existing meta value.
	 * @param int   $post_id The post ID.
	 * @param array $field   The field parameters.
	 *
	 * @return array
	 */
	public static function value( $new, $old, $post_id, $field ) {
		foreach ( $new as &$arr ) {
			if ( empty( $arr[0] ) && empty( $arr[1] ) ) {
				$arr = false;
			}
		}
		$new = array_filter( $new );
		return $new;
	}

	/**
	 * Normalize parameters for field.
	 *
	 * @param array $field Field parameters.
	 *
	 * @return array
	 */
	public static function normalize( $field ) {
		$field['clone']    = true;
		$field['multiple'] = true;
		$field             = parent::normalize( $field );

		$field['attributes']['type'] = 'text';
		$field['placeholder']        = wp_parse_args(
			(array) $field['placeholder'],
			array(
				'key'   => __( 'Key', 'control-block-patterns' ),
				'value' => __( 'Value', 'control-block-patterns' ),
			)
		);
		return $field;
	}

	/**
	 * Format value for the helper functions.
	 *
	 * @param array        $field   Field parameters.
	 * @param string|array $value   The field meta value.
	 * @param array        $args    Additional arguments. Rarely used. See specific fields for details.
	 * @param int|null     $post_id Post ID. null for current post. Optional.
	 *
	 * @return string
	 */
	public static function format_clone_value( $field, $value, $args, $post_id ) {
		return sprintf( '<label>%s:</label> %s', $value[0], $value[1] );
	}
}
