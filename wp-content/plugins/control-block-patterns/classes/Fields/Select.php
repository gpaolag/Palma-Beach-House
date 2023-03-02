<?php
namespace ControlPatterns\Fields;
use ControlPatterns\Walkers\Select as Walker_Select;
use ControlPatterns\Fields\Multiple_Values as Multiple_Values;
/**
 * The select field.
 *
 * @package ControlPatterns
 */

/**
 * Select field class.
 */
class Select extends Choice {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {
		wp_enqueue_script( 'ctrlbp-select', CTRLBP_JS_URI . 'select.js', array( 'jquery' ), CTRLBP_VER, true );
	}

	/**
	 * Get field HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 * @return string
	 */
	public static function html( $meta, $field ) {
		$options                     = self::transform_options( $field['options'] );
		$attributes                  = self::call( 'get_attributes', $field, $meta );
		$attributes['data-selected'] = $meta;
		$walker                      = new Walker_Select( $field, $meta );
		$output                      = sprintf(
			'<select %s>',
			self::render_attributes( $attributes )
		);
		if ( ! $field['multiple'] && $field['placeholder'] ) {
			$output .= '<option value="">' . esc_html( $field['placeholder'] ) . '</option>';
		}
		$output .= $walker->walk( $options, $field['flatten'] ? -1 : 0 );
		$output .= '</select>';
		$output .= self::get_select_all_html( $field );
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
		$field = $field['multiple'] ? Multiple_Values::normalize( $field ) : $field;
		$field = wp_parse_args(
			$field,
			array(
				'select_all_none' => false,
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
		$attributes = parent::get_attributes( $field, $value );
		$attributes = wp_parse_args(
			$attributes,
			array(
				'multiple' => $field['multiple'],
			)
		);

		return $attributes;
	}

	/**
	 * Get html for select all|none for multiple select.
	 *
	 * @param array $field Field parameters.
	 * @return string
	 */
	public static function get_select_all_html( $field ) {
		if ( $field['multiple'] && $field['select_all_none'] ) {
			return '<div class="ctrlbp-select-all-none">' . __( 'Select', 'control-block-patterns' ) . ': <a data-type="all" href="#">' . __( 'All', 'control-block-patterns' ) . '</a> | <a data-type="none" href="#">' . __( 'None', 'control-block-patterns' ) . '</a></div>';
		}
		return '';
	}
}
