<?php
namespace ControlPatterns\Fields;
use ControlPatterns\Field;

/**
 * The measurement field which uses HTML <input type="number"> and HTML select tag.
 *
 * @package ControlPatterns
 */

/**
 * Measurement field class.
 */
class Measurement extends Field {

	/*
	 * Get field HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 * @return string
	 */
	public static function html( $meta, $field ) {
				
		$output = '<div class="ctrlbp-row ctrlbp-g-1">';
		$output .= '<div class="ctrlbp-col-9">';

		//measurement unit
		$number = Number::normalize(
			array(
				'type'        => 'number',
				'id'          => "{$field['id']}_0",
				'field_name'  => "{$field['field_name']}[0]",
				'std'         => [ 0, 'px' ],
				'min' => $field['min'],
				'max' => $field['max'],
				'step' => $field['step'],
			)
		);

		$output .= Number::html( $meta[0], $number);
		$output .= '</div>';
		$output .= '<div class="ctrlbp-col-1">';

		//measurement unit
		$units = Select::normalize(
			array(
				'type'        => 'select',
				'id'          => "{$field['id']}_1",
				'field_name'  => "{$field['field_name']}[1]",
				'placeholder' => esc_html__( 'unit', 'control-block-patterns' ),
				'options'     => $field['units'],
			)
		);

		$output .= Select::html( $meta[1], $units );
		$output .= '</div>';
		$output .= '</div>';

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
				'step' => 1,
				'min'  => 0,
				'max'  => false,
				'units'     => array(
					'px' => esc_html__( 'px', 'control-block-patterns' ),
					'%' => esc_html__( '%', 'control-block-patterns' ),
					'em' => esc_html__( 'em', 'control-block-patterns' ),
					'pt' => esc_html__( 'pt', 'control-block-patterns' ),
				),
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
				'step' => $field['step'],
				'max'  => $field['max'],
				'min'  => $field['min'],
			)
		);
		return $attributes;
	}
}
