<?php
namespace ControlPatterns\Fields;
/**
 * The image upload field which allows users to drag and drop images.
 *
 * @package ControlPatterns
 */

/**
 * File advanced field class which users WordPress media popup to upload and select files.
 */
class Image_Upload extends Image_Advanced {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {
		parent::admin_enqueue_scripts();
		File_Upload::admin_enqueue_scripts();
		wp_enqueue_script( 'ctrlbp-image-upload', CTRLBP_JS_URI . 'image-upload.js', array( 'ctrlbp-file-upload', 'ctrlbp-image-advanced' ), CTRLBP_VER, true );
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
		return File_Upload::normalize( $field );
	}

	/**
	 * Template for media item.
	 */
	public static function print_templates() {
		parent::print_templates();
		File_Upload::print_templates();
	}
}
