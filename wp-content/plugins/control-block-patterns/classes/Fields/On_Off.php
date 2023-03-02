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
class On_Off extends Button_Group {	

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
				'inline' => true,
				'multiple' => false
			)
		);

		$field = $field['multiple'] ? Multiple_Values::normalize( $field ) : $field;
		$field = Input::normalize( $field );

		$field['flatten'] = true;
		$field['type'] = 'button_group';
		$field['inline']  = true;
		$field['multiple']  = false;
		$field['options'] = array(
			'on' => esc_attr__('ON', 'control-block-patterns'),
			'off' => esc_attr__( 'OFF', 'control-block-patterns' )
		);
		$field['class'] = 'ctrlbp-on-off ';

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
		$attributes['type']  = 'radio';
		$attributes['value'] = $value;
		
		

		return $attributes;
	}
}
