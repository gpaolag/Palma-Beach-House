<?php
namespace ControlPatterns\Fields;
use ControlPatterns\Helpers\Field_Type as Helpers_Field;
/**
 * The autocomplete field.
 *
 * @package ControlPatterns
 */

/**
 * Autocomplete field class.
 */
class Autocomplete extends Multiple_Values {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {
		wp_enqueue_script( 'ctrlbp-autocomplete', CTRLBP_JS_URI . 'autocomplete.js', array( 'jquery-ui-autocomplete' ), CTRLBP_VER, true );

		Helpers_Field::localize_script_once(
			'ctrlbp-autocomplete',
			'CTRLBP_Autocomplete',
			array(
				'delete' => __( 'Delete', 'control-block-patterns' ),
			)
		);
	}

	/**
	 * Get field HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 * @return string
	 */
	public static function html( $meta, $field ) {
		if ( ! is_array( $meta ) ) {
			$meta = array( $meta );
		}

		$field   = apply_filters( 'ctrlbp_autocomplete_field', $field, $meta );
		$options = $field['options'];

		if ( is_array( $field['options'] ) ) {
			$options = array();
			foreach ( $field['options'] as $value => $label ) {
				$options[] = array(
					'value' => $value,
					'label' => $label,
				);
			}
			$options = wp_json_encode( $options );
		}

		// Input field that triggers autocomplete.
		// This field doesn't store field values, so it doesn't have "name" attribute.
		// The value(s) of the field is store in hidden input(s). See below.
		$html = sprintf(
			'<input type="text" class="ctrlbp-autocomplete-search">
			<input type="hidden" name="%s" class="ctrlbp-autocomplete" data-options="%s" disabled>',
			esc_attr( $field['field_name'] ),
			esc_attr( $options )
		);

		$html .= '<div class="ctrlbp-autocomplete-results">';

		// Each value is displayed with label and 'Delete' option.
		// The hidden input has to have ".ctrlbp-*" class to make clone work.
		$tpl = '
			<div class="ctrlbp-autocomplete-result">
				<div class="label">%s</div>
				<div class="actions">%s</div>
				<input type="hidden" class="ctrlbp-autocomplete-value" name="%s" value="%s">
			</div>
		';

		if ( is_array( $field['options'] ) ) {
			foreach ( $field['options'] as $value => $label ) {
				if ( ! in_array( $value, $meta ) ) {
					continue;
				}
				$html .= sprintf(
					$tpl,
					esc_html( $label ),
					esc_html__( 'Delete', 'control-block-patterns' ),
					esc_attr( $field['field_name'] ),
					esc_attr( $value )
				);
			}
		} else {
			$meta = array_filter( $meta );
			foreach ( $meta as $value ) {
				$label = apply_filters( 'ctrlbp_autocomplete_result_label', $value, $field );
				$html .= sprintf(
					$tpl,
					esc_html( $label ),
					esc_html__( 'Delete', 'control-block-patterns' ),
					esc_attr( $field['field_name'] ),
					esc_attr( $value )
				);
			}
		}

		$html .= '</div>'; // .ctrlbp-autocomplete-results.

		return $html;
	}
}
