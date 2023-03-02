<?php
namespace ControlPatterns\Fields;
use ControlPatterns\Walkers\Input_List as Walker_Input_List;
/**
 * The input list field which displays choices in a list of inputs.
 *
 * @package ControlPatterns
 */

/**
 * Input list field class.
 */
class Input_List extends Choice {
	/**
	 * Enqueue scripts and styles
	 */
	public static function admin_enqueue_scripts() {
		wp_enqueue_script( 'ctrlbp-input-list', CTRLBP_JS_URI . 'input-list.js', array(), CTRLBP_VER, true );
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
		$output  = self::get_select_all_html( $field );
		$output .= sprintf(
			'<ul class="ctrlbp-input-list%s%s">',
			$field['collapse'] ? ' ctrlbp-collapse' : '',
			$field['inline'] ? ' ctrlbp-inline' : ''
		);
		$output .= $walker->walk( $options, $field['flatten'] ? -1 : 0 );
		$output .= '</ul>';

		return $output;
	}

	/**
	 * Normalize parameters for field.
	 *
	 * @param array $field Field parameters.
	 * @return array
	 */
	public static function normalize( $field ) {
		$field = $field['multiple'] ? Multiple_Values::normalize( $field ) : $field;
		$field = Input::normalize( $field );
		$field = parent::normalize( $field );
		$field = wp_parse_args(
			$field,
			array(
				'collapse'        => true,
				'inline'          => null,
				'select_all_none' => false,
			)
		);

		$field['flatten'] = $field['multiple'] ? $field['flatten'] : true;
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

	/**
	 * Get html for select all|none for multiple checkbox.
	 *
	 * @param array $field Field parameters.
	 * @return string
	 */
	public static function get_select_all_html( $field ) {
		if ( $field['multiple'] && $field['select_all_none'] ) {
			return sprintf( '<p class="ctrlbp-toggle-all-wrapper"><button class="ctrlbp-input-list-select-all-none button" data-name="%s">%s</button></p>', $field['id'], __( 'Toggle All', 'control-block-patterns' ) );
		}
		return '';
	}
}
