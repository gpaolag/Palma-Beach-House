<?php
namespace ControlPatterns\Fields;
use ControlPatterns\Field as Field;

/**
 * The link field.
 *
 * @package ControlPatterns
 */

/**
 * The Link field.
 */
class Link extends Field {
	
	/**
	 * Get field HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field settings.
	 *
	 * @return string
	 */
	public static function html( $meta, $field ) {
		$meta = wp_parse_args(
			$meta,
			array(
				'title' => '',
				'url' => '',
				'target' => '',
				'rel' => '',
			)
		);

		$output = '<div class="ctrlbp-link-row">';
		$link_title = Input::normalize(array(
			'id'          => "{$field['id']}_title",
			'field_name'  => "{$field['field_name']}[title]",
			'placeholder' => esc_html__( 'Link title', 'control-block-patterns' ),
		));
		$output  .= '<div class="ctrlbp-link-title mb-1">'.Input::html( $meta['title'], $link_title).'</div>';

		$link_url = Input::normalize(array(
			'id'          => "{$field['id']}_url",
			'field_name'  => "{$field['field_name']}[url]",
			'placeholder' => 'https://'
		));
		$output  .= '<div class="ctrlbp-link-url mb-1">'.Input::html( $meta['url'], $link_url).'</div>';

		$link_target = Checkbox::normalize(array(
			'type' => 'checkbox',
			'id'          => "{$field['id']}_target",
			'field_name'  => "{$field['field_name']}[target]",
			'desc' => esc_html__( 'Open link in a new tab', 'control-block-patterns' ),
			'attributes' => array(
				'value' => '_blank'
			)
		));
		$output  .= '<div class="ctrlbp-link-target mb-1">'.Checkbox::html( $meta['target'], $link_target).'</div>';

		$link_rel = Checkbox::normalize(array(
			'type' => 'checkbox',
			'id'          => "{$field['id']}_rel",
			'field_name'  => "{$field['field_name']}[rel]",
			'desc' => esc_html__( 'Add nofollow option to link', 'control-block-patterns' ),
			'attributes' => array(
				'value' => 'nofollow' 
			)
		));
		$output  .= '<div class="ctrlbp-link-rel">'.Checkbox::html( $meta['rel'], $link_rel).'</div>';
		$output .= '</div>';

		return $output;
	}

}
