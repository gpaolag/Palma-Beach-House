<?php
namespace ControlPatterns\Fields;
/**
 * The file upload field which allows users to drag and drop files to upload.
 *
 * @package ControlPatterns
 */

/**
 * The file upload field class.
 */
class File_Upload extends Media {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {
		parent::admin_enqueue_scripts();
		wp_enqueue_script( 'ctrlbp-file-upload', CTRLBP_JS_URI . 'file-upload.js', array( 'ctrlbp-media' ), CTRLBP_VER, true );
	}

	/**
	 * Normalize parameters for field.
	 *
	 * @param array $field Field parameters.
	 *
	 * @return array
	 */
	public static function normalize( $field ) {
		$field = parent::normalize( $field );
		$field = wp_parse_args(
			$field,
			array(
				'max_file_size' => 0,
			)
		);

		$field['js_options'] = wp_parse_args(
			$field['js_options'],
			array(
				'maxFileSize' => $field['max_file_size'],
			)
		);

		return $field;
	}

	/**
	 * Template for media item.
	 */
	public static function print_templates() {
		parent::print_templates();
		require_once CTRLBP_INC_DIR . 'templates/upload.php';
	}
}
