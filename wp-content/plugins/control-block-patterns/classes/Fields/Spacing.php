<?php
namespace ControlPatterns\Fields;
use ControlPatterns\Field;

/**
 * The spacing field which uses HTML <input type="number"> and HTML select tag.
 *
 * @package ControlPatterns
 */

/**
 * Spacing field class.
 */
class Spacing extends Field {

	/**
	 * Get field HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 * @return string
	 */
	public static function html( $meta, $field ) {
		$meta = wp_parse_args( $meta, array(
			'top' => 0,
			'right' => 0,
			'bottom' => 0,
			'left' => 0,
			'unit' => 'px',
		) );

		$output = '<div class="ctrlbp-row g-1">';
		$output .= '<div class="col">';

		//spacing top
		$top = Number::normalize(
			array(
				'type'        => 'number',
				'id'          => "{$field['id']}_top",
				'field_name'  => "{$field['field_name']}[top]",
				'placeholder' => 'Top',
				'min' => $field['min'],
				'max' => $field['max'],
				'step' => $field['step']
			)
		);
		$output .= Number::html( $meta['top'], $top);
		$output .= '</div>';
		$output .= '<div class="col">';

		//spacing right
		$right = Number::normalize(
			array(
				'type'        => 'number',
				'id'          => "{$field['id']}_right",
				'field_name'  => "{$field['field_name']}[right]",
				'placeholder' => 'Right',
				'min' => $field['min'],
				'max' => $field['max'],
				'step' => $field['step']
			)
		);
		$output .= Number::html( $meta['right'], $right);

		$output .= '</div>';
		$output .= '<div class="col">';

		//spacing bottom
		$bottom = Number::normalize(
			array(
				'type'        => 'number',
				'id'          => "{$field['id']}_bottom",
				'field_name'  => "{$field['field_name']}[bottom]",
				'placeholder' => 'Bottom',
				'min' => $field['min'],
				'max' => $field['max'],
				'step' => $field['step']
			)
		);
		$output .= Number::html( $meta['bottom'], $bottom);
		$output .= '</div>';
		$output .= '<div class="col">';

		//spacing left
		$left = Number::normalize(
			array(
				'type'        => 'number',
				'id'          => "{$field['id']}_left",
				'field_name'  => "{$field['field_name']}[left]",
				'placeholder' => 'Left',
				'min' => $field['min'],
				'max' => $field['max'],
				'step' => $field['step']
			)
		);
		$output .= Number::html( $meta['left'], $left);
		$output .= '</div>';
		$output .= '<div class="col">';

		//spacing unit
		$units = Select::normalize(
			array(
				'type'        => 'select',
				'id'          => "{$field['id']}_unit",
				'field_name'  => "{$field['field_name']}[unit]",
				'placeholder' => esc_html__( 'unit', 'control-block-patterns' ),
				'options'     => $field['units'],
			)
		);
		$output .= Select::html( $meta['unit'], $units );
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
