<?php
namespace ControlPatterns\Fields;
/**
 * The beautiful select field which uses select2 library.
 *
 * @package ControlPatterns
 */

/**
 * Select advanced field which uses select2 library.
 */
class Select_Advanced extends Select {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {
		parent::admin_enqueue_scripts();
		

		wp_register_script( 'ctrlbp-select2', CTRLBP_JS_URI . 'select2/select2.min.js', array( 'jquery' ), '4.0.10', true );

		// Localize.
		$dependencies = array( 'ctrlbp-select2', 'ctrlbp-select' );
		$locale       = str_replace( '_', '-', get_locale() );
		$locale_short = substr( $locale, 0, 2 );
		$locale       = file_exists( CTRLBP_DIR . "js/select2/i18n/$locale.js" ) ? $locale : $locale_short;

		if ( file_exists( CTRLBP_DIR . "js/select2/i18n/$locale.js" ) ) {
			wp_register_script( 'ctrlbp-select2-i18n', CTRLBP_JS_URI . "select2/i18n/$locale.js", array( 'ctrlbp-select2' ), '4.0.10', true );
			$dependencies[] = 'ctrlbp-select2-i18n';
		}

		wp_enqueue_script( 'ctrlbp-select-advanced', CTRLBP_JS_URI . 'select-advanced.js', $dependencies, CTRLBP_VER, true );
	}

	/**
	 * Normalize parameters for field.
	 *
	 * @param array $field Field parameters.
	 * @return array
	 */
	public static function normalize( $field ) {
		$field = wp_parse_args(
			$field,
			array(
				'js_options'  => array(),
				'placeholder' => __( 'Select an item', 'control-block-patterns' ),
			)
		);

		$field = parent::normalize( $field );

		$field['js_options'] = wp_parse_args(
			$field['js_options'],
			array(
				'allowClear'        => true,
				'dropdownAutoWidth' => true,
				'placeholder'       => $field['placeholder'],
				'width'             => 'style',
			)
		);

		return $field;
	}

	/**
	 * Get the attributes for a field.
	 *
	 * @param array $field Field parameters.
	 * @param mixed $value Meta value.
	 * @return array
	 */
	public static function get_attributes( $field, $value = null ) {
		$attributes = parent::get_attributes( $field, $value );
		$attributes = wp_parse_args(
			$attributes,
			array(
				'data-options' => wp_json_encode( $field['js_options'] ),
			)
		);

		return $attributes;
	}
}
