<?php
namespace ControlPatterns\Fields;
use ControlPatterns\Field as Field;
/**
 * The divider field which displays a simple horizontal line.
 *
 * @package ControlPatterns
 */

/**
 * Divider field class.
 */
class Divider extends Field {
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
		return "<hr$attributes>";
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
		return '';
	}
}
