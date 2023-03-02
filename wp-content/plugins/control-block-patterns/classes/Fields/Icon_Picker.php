<?php
namespace ControlPatterns\Fields;
use ControlPatterns\Field;

/**
 * The icon_picker field which uses HTML <input type="text"> and HTML button.
 *
 * @package ControlPatterns
 */

/**
 * Icon_Picker field class.
 */
class Icon_Picker extends Field {

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
			'type' => 'fontawsome5',
		));
				
		$output = '<div class="ctrlbp-range-inner">';

		$icon = Button::normalize(
			array(
				'type'        => 'button',
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

		//icon type
		$type = Number::normalize(
			array(
				'type'        => 'hidden',
				'id'          => "{$field['id']}_type",
				'field_name'  => "{$field['field_name']}[type]",
			)
		);
		$output .= Number::html($meta['type'], $type);
		
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

	/**
	 * Enqueue styles.
	 */
	public static function admin_enqueue_scripts() {

		wp_enqueue_style( 'ctrlbp-fa-all', CTRLBP_CSS_URI . 'icon-picker/all.min.css');
		wp_enqueue_style( 'ctrlbp-bootstrap-iconpicker-stlye', CTRLBP_CSS_URI . 'icon-picker/bootstrap-iconpicker.min.css');

		wp_register_script( 'ctrlbp-bootstrap-bundle',  CTRLBP_JS_URI. 'icon-picker/bootstrap.bundle.min.js', array(), false , false );
		wp_register_script( 'ctrlbp-iconpicker-bundle',  CTRLBP_JS_URI. 'icon-picker/bootstrap-iconpicker.bundle.min.js', array('jquery', 'ctrlbp-bootstrap-bundle'), false , false );
		wp_enqueue_script( 'ctrlbp-bootstrap-iconpicker', CTRLBP_JS_URI . 'icon-picker/bootstrap-iconpicker.js', array('ctrlbp-iconpicker-bundle'), false , '1.0.1' );
	}

}
