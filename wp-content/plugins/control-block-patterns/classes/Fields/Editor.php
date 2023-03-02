<?php
namespace ControlPatterns\Fields;
use ControlPatterns\Field;

/**
 * The background field.
 *
 * @package ControlPatterns
 */

/**
 * The Editor field.
 */
class Editor extends Field {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {

		// Load Ace Editor for CSS Editing.
		wp_enqueue_script( 'ace-editor', CTRLBP_JS_URI . 'vendor/ace/ace.js', null, '6.07.20', false );
		wp_enqueue_script( 'ctrlbp-editor', CTRLBP_JS_URI . 'editor.js', ['jquery', 'ace-editor'], time(), false );
	}

	/**
	 * Get field HTML.
	 *
	 * @param mixed $meta Meta value.
	 * @param array $field Field parameters.
	 *
	 * @return string
	 */
	public static function html( $meta, $field ) {
		$attributes = self::get_attributes( $field, $meta );

		return sprintf(
			'<textarea %1$s>%3$s</textarea><pre %2$s>%3$s</pre>',
			self::render_attributes( $attributes ),
			self::render_editor_attributes( $attributes ),
			esc_textarea($meta)
		);
	}

	/**
	 * Renders an attribute array into an html attributes string.
	 *
	 * @param array $attributes HTML attributes.
	 *
	 * @return string
	 */
	public static function render_attributes( $attributes ) {
		$output = '';

		$attributes['class'] = $attributes['class'].' hidden';

		$attributes = array_filter( $attributes, 'ControlPatterns\\Helpers\\Value_Type::is_valid_for_attribute' );
		foreach ( $attributes as $key => $value ) {
			if ( is_array( $value ) ) {
				$value = \wp_json_encode( $value );
			}

			$output .= sprintf( ' %s="%s"', $key, esc_attr( $value ) );
		}

		return $output;
	}

	/**
	 * Renders an attribute array into an html attributes string.
	 *
	 * @param array $attributes HTML attributes.
	 *
	 * @return string
	 */
	public static function render_editor_attributes( $attributes ) {
		$output = '';

		$attributes['data-id'] = $attributes['id'];
		$attributes['id'] = "ctrlbp_editor_".$attributes['id'];
		$attributes['class'] = $attributes['class']." ctrlbp-editor-type";
		

		$attributes = array_filter( $attributes, 'ControlPatterns\\Helpers\\Value_Type::is_valid_for_attribute' );
		foreach ( $attributes as $key => $value ) {
			if ( is_array( $value ) ) {
				$value = \wp_json_encode( $value );
			}

			$output .= sprintf( ' %s="%s"', $key, esc_attr( $value ) );
		}

		return $output;
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
				'autocomplete' => false,
				'cols'         => false,
				'rows'         => 3,
				'maxlength'    => false,
				'wrap'         => false,
				'readonly'     => false,
				'editor_type'  => 'html',
				'editor_theme'  => 'monokai',
			)
		);

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
		$attributes           = parent::get_attributes( $field, $value );
		$attributes           = wp_parse_args(
			$attributes,
			array(
				'autocomplete' => $field['autocomplete'],
				'cols'         => $field['cols'],
				'rows'         => $field['rows'],
				'maxlength'    => $field['maxlength'],
				'wrap'         => $field['wrap'],
				'readonly'     => $field['readonly'],
				'placeholder'  => $field['placeholder'],
				'data-editor_type'  => $field['editor_type'],
				'data-editor_theme'  => $field['editor_theme'],
			)
		);

		return $attributes;
	}
}
