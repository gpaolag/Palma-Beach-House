<?php
namespace ControlPatterns;
/**
 * Validation module.
 *
 * @package ControlPatterns
 */

/**
 * Validation class.
 */
class Validation {

	/**
	 * Add hooks when module is loaded.
	 */
	public function __construct() {
		add_action( 'ctrlbp_after', array( $this, 'rules' ) );
		add_action( 'ctrlbp_enqueue_scripts', array( $this, 'enqueue' ) );
	}

	/**
	 * Output validation rules of each meta box.
	 * The rules are outputted in [data-validation] attribute of an hidden <script> and will be converted into JSON by JS.
	 *
	 * @param Meta_Box $object Control Block Patterns object.
	 */
	public function rules( Meta_Box $object ) {
		if ( ! empty( $object->meta_box['validation'] ) ) {
			echo '<script type="text/html" class="ctrlbp-validation" data-validation="' . esc_attr( wp_json_encode( $object->meta_box['validation'] ) ) . '"></script>';
		}
	}

	/**
	 * Enqueue scripts for validation.
	 */
	public function enqueue() {
		wp_enqueue_script( 'ctrlbp-validation', CTRLBP_JS_URI . 'validation.min.js', array( 'jquery', 'ctrlbp' ), CTRLBP_VER, true );

		Helpers\Field_Type::localize_script_once(
			'ctrlbp-validation',
			'ctrlbpValidation',
			array(
				'message' => esc_html__( 'Please correct the errors highlighted below and try again.', 'control-block-patterns' ),
			)
		);
	}
}
