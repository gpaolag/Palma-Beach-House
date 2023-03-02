<?php
namespace ControlPatterns\Fields;
use ControlPatterns\Field;

/**
 * The icon_picker_input field which uses HTML <input type="text"> and HTML button.
 *
 * @package ControlPatterns
 */

/**
 * Icon_Picker_Input field class.
 */
class Icon_Picker_Input extends Icon_Picker {

	/**
	 * Get field HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 * @return string
	 */
	public static function html( $meta, $field ) {

		$meta = wp_parse_args($meta, array(
				'icon' => 'fas fa-wifi',
				'input' => '#',
		));
				
		$output = '<div class="ctrlbp-range-inner">';

		$icon = Button::normalize(
			array(
				'type'        => 'icon_picker',
				'id'          => "{$field['id']}",
				'field_name'  => "{$field['field_name']}[icon]",
				'attributes' => [
					'class' => 'iconpicker',
					'role' => 'iconpicker',
					'data-iconset' => $field['iconset'],
					'data-icon'   => $meta['icon'],
					'data-cols'   => $field['cols'],
					'data-rows'   => $field['rows'],
				],
				
			)
		);
		$output .= Button::html($meta['icon'], $icon);

		//icon input
		$input = Input::normalize(
			array(
				'type'        => 'text',
				'id'          => "{$field['id']}_input",
				'field_name'  => "{$field['field_name']}[input]",
			)
		);
		$output .= Input::html($meta['input'], $input);
		
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
				'iconset' => 'fontawsome5',
				'icon' => 'fas fa-wifi',
				'cols'   	  => 4,
				'rows'   	  => 4,
			)
		);

		return $field;
	}

}
