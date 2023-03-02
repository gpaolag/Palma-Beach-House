<?php
namespace ControlPatterns\Fields;
use ControlPatterns\Field as Field;
/**
 * The WYSIWYG (editor) field.
 *
 * @package ControlPatterns
 */

/**
 * WYSIWYG (editor) field class.
 */
class Wysiwyg extends Field {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {
		wp_enqueue_editor();
		wp_enqueue_script( 'ctrlbp-wysiwyg', CTRLBP_JS_URI . 'wysiwyg.js', ['jquery', 'ctrlbp'], CTRLBP_VER, true );
	}

	/**
	 * Change field value on save.
	 *
	 * @param mixed $new     The submitted meta value.
	 * @param mixed $old     The existing meta value.
	 * @param int   $post_id The post ID.
	 * @param array $field   The field parameters.
	 * @return string
	 */
	public static function value( $new, $old, $post_id, $field ) {
		return $field['raw'] ? $new : wpautop( $new );
	}

	/**
	 * Get field HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 * @return string
	 */
	public static function html( $meta, $field ) {
		// Using output buffering because wp_editor() echos directly.
		ob_start();

		$attributes = self::get_attributes( $field );

		$options = $field['options'];
		$options['textarea_name'] = $field['field_name'];
		if ( ! empty( $attributes['required'] ) ) {
			$options['editor_class'] .= ' ctrlbp-wysiwyg-required';
		}

		wp_editor( $meta, $attributes['id'], $options );
		echo '<script class="ctrlbp-wysiwyg-id" type="text/html" data-id="', esc_attr( $attributes['id'] ), '" data-options="', esc_attr( wp_json_encode( $options ) ), '"></script>';

		return ob_get_clean();
	}

	/**
	 * Normalize parameters for field.
	 *
	 * @param array $field Field parameters.
	 * @return array
	 */
	public static function normalize( $field ) {
		$field = parent::normalize( $field );
		$field = wp_parse_args(
			$field,
			array(
				'raw'     => false,
				'options' => array(),
			)
		);

		$field['options'] = wp_parse_args(
			$field['options'],
			array(
				'editor_class' => 'ctrlbp-wysiwyg',
				'dfw'          => true, // Use default WordPress full screen UI.
			)
		);

		// Keep the filter to be compatible with previous versions.
		$field['options'] = apply_filters( 'ctrlbp_wysiwyg_settings', $field['options'] );

		return $field;
	}
}
