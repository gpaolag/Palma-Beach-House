<?php
namespace ControlPatterns\Fields;
use ControlPatterns\Walkers\Input_List as Walker_Input_List;
/**
 * The Button group.
 *
 * @package ControlPatterns
 */

/**
 * Button group class.
 */
class Button_Group extends Choice {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {
		wp_enqueue_script( 'ctrlbp-button-group', CTRLBP_JS_URI . 'button-group.js', array(), CTRLBP_VER, true );
	}

	/**
	 * Get field HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 * @return string
	 */
	public static function html( $meta, $field ) {
		$options = self::transform_options( $field['options'] );
		$walker  = new Walker_Input_List( $field, $meta );

		$output  = sprintf(
			'<ul class="ctrlbp-button-input-list %s">',
			$field['inline'] ? ' ctrlbp-inline' : ''
		);
		$output .= $walker->walk( $options, -1 );
		$output .= '</ul>';

		return $output;
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
				'inline' => null,
			)
		);

		$field = $field['multiple'] ? Multiple_Values::normalize( $field ) : $field;
		$field = Input::normalize( $field );

		$field['flatten'] = true;
		$field['inline']  = ! $field['multiple'] && ! isset( $field['inline'] ) ? true : $field['inline'];

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
		$attributes          = Input::get_attributes( $field, $value );
		$attributes['id']    = false;
		$attributes['type']  = $field['multiple'] ? 'checkbox' : 'radio';
		$attributes['value'] = $value;

		return $attributes;
	}
}
