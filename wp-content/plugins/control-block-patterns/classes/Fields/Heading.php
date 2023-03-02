<?php
namespace ControlPatterns\Fields;
use ControlPatterns\Field as Field;

/**
 * The heading field which displays a simple heading text.
 *
 * @package ControlPatterns
 */

/**
 * Heading field class.
 */
class Heading extends Field {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {
	}

	/**
	 * Show begin HTML markup for fields.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 *
	 * @return string
	 */
	public static function begin_html( $meta, $field ) {
		$attributes = empty( $field['id'] ) ? '' : " id='{$field['id']}'";
		return sprintf( '<div class="ctrlbp-col"><h4%s>%s</h4></div>', $attributes, $field['name'] );
	}

	/**
	 * Show end HTML markup for fields.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 *
	 * @return string
	 */
	public static function end_html( $meta, $field ) {
		return sprintf( '<div class="ctrlbp-col">%s</div>', self::input_description( $field ) );
	}
}
