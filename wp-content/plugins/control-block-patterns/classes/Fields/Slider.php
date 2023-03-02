<?php
namespace ControlPatterns\Fields;
use ControlPatterns\Field as Field;

/**
 * The slider field which users jQueryUI slider widget.
 *
 * @package ControlPatterns
 */

/**
 * Slider field class.
 */
class Slider extends Field {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {
		$url = CTRLBP_CSS_URI . 'jqueryui';
		wp_register_style( 'jquery-ui-core', "$url/core.css", [], '1.12.1' );
		wp_register_style( 'jquery-ui-theme', "$url/theme.css", [], '1.12.1' );
		wp_enqueue_style( 'jquery-ui-slider', "$url/slider.css", ['jquery-ui-core', 'jquery-ui-theme'], '1.12.1' );

		wp_enqueue_script( 'ctrlbp-slider', CTRLBP_JS_URI . 'slider.js', ['jquery-ui-slider', 'jquery-ui-widget', 'jquery-ui-mouse', 'jquery-ui-core'], CTRLBP_VER, true );
	}

	/**
	 * Get div HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 *
	 * @return string
	 */
	public static function html( $meta, $field ) {
		$attributes = self::call( 'get_attributes', $field, $meta );
		return sprintf(
			'<div class="ctrlbp-slider-inner">
				<div class="ctrlbp-slider-ui" id="%s" data-options="%s"></div>
				<span class="ctrlbp-slider-label">%s<span>%s</span>%s</span>
				<input type="hidden" value="%s" %s>
			</div>',
			$field['id'],
			esc_attr( wp_json_encode( $field['js_options'] ) ),
			$field['prefix'],
			$meta,
			$field['suffix'],
			$meta,
			self::render_attributes( $attributes )
		);
	}

	/**
	 * Normalize parameters for field.
	 *
	 * @param array $field Field parameters.
	 *
	 * @return array
	 */
	public static function normalize( $field ) {
		$field               = parent::normalize( $field );
		$field               = wp_parse_args(
			$field,
			array(
				'prefix'     => '',
				'suffix'     => '',
				'std'        => '',
				'js_options' => array(),
			)
		);
		$field['js_options'] = wp_parse_args(
			$field['js_options'],
			array(
				'range' => 'min', // range = 'min' will add a dark background to sliding part, better UI.
				'value' => $field['std'],
			)
		);

		return $field;
	}
}
