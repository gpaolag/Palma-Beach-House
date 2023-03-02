<?php
namespace ControlPatterns\Fields;
use ControlPatterns\Helpers\Field_Type as Helpers_Field;
/**
 * The file input field which allows users to enter a file URL or select it from the Media Library.
 *
 * @package ControlPatterns
 */

/**
 * File input field class which uses an input for file URL.
 */
class File_Input extends Input {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {
		wp_enqueue_media();
		wp_enqueue_script( 'ctrlbp-file-input', CTRLBP_JS_URI . 'file-input.js', array( 'jquery' ), CTRLBP_VER, true );
		Helpers_Field::localize_script_once(
			'ctrlbp-file-input',
			'ctrlbpFileInput',
			array(
				'frameTitle' => esc_html__( 'Select File', 'control-block-patterns' ),
			)
		);
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
		$attributes = self::get_attributes( $field, $meta );
		return sprintf(
			'<div class="ctrlbp-file-input-inner">
				<input %s>
				<a href="#" class="ctrlbp-file-input-select button">%s</a>
				<a href="#" class="ctrlbp-file-input-remove button %s">%s</a>
			</div>',
			self::render_attributes( $attributes ),
			esc_html__( 'Select', 'control-block-patterns' ),
			$meta ? '' : 'hidden',
			esc_html__( 'Remove', 'control-block-patterns' )
		);
	}

	/**
	 * Get the attributes for a field.
	 *
	 * @param array $field Field parameters.
	 * @param mixed $value Meta value.
	 * @return array
	 */
	public static function get_attributes( $field, $value = null ) {
		$attributes         = parent::get_attributes( $field, $value );
		$attributes['type'] = 'text';

		return $attributes;
	}
}
