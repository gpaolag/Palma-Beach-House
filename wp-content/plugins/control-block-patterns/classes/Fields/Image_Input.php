<?php
namespace ControlPatterns\Fields;
use ControlPatterns\Helpers\Field_Type as Helpers_Field;
/**
 * The advanced image upload field which uses WordPress media popup to upload and select images.
 *
 * @package ControlPatterns
 */

/**
 * Image advanced field class.
 */
class Image_Input extends Input {
	/**
	 * Enqueue scripts and styles.
	 */
	public static function admin_enqueue_scripts() {	
		wp_enqueue_media();
		$ver = WP_DEBUG? time() : CTRLBP_VER;
		wp_enqueue_script( 'ctrlbp-image-input', CTRLBP_JS_URI . 'image-input.js', array( 'jquery', 'underscore', 'backbone', 'media-grid' ), $ver, true );
		Helpers_Field::localize_script_once(
			'ctrlbp-image-input',
			'ctrlbpImageInput',
			array(
				'confirm_text' => esc_html__( 'Are you sure to remove the Image?', 'control-block-patterns' ),
			)
		);
	}
	/**
	 * Get field HTML.
	 *
	 * @param mixed $meta  Meta value.
	 * @param array $field Field parameters.
	 *
	 * @return string
	 */
	public static function html( $meta, $field ) {
		
		$attributes = self::get_attributes( $field, $meta );

		$field = wp_parse_args( $field, array(
			'select_text' => esc_html__( 'Add Image', 'control-block-patterns' ),
			'remove_text' => esc_html__( 'Remove', 'control-block-patterns' ),
		));
		$preview = $meta? '<div class="ctrlbp-file-icon">					
				<img src="'.esc_url($meta).'" alt="">					
			</div>' : '';
		return sprintf(
			'<div class="ctrlbp-image-input-inner">
				<ul class="ctrlbp-media-list %3$s"><li class="ctrlbp-image-item">%5$s</li></ul>				
				<input %1$s>
				<a href="#" class="ctrlbp-image-input-select button">%2$s</a>
				<a href="#" class="ctrlbp-image-input-remove button %3$s">%4$s</a>
			</div>',
			self::render_attributes( $attributes ),
			$field['select_text'],
			$meta ? '' : 'hidden',
			$field['remove_text'],
			$preview
		);
	}

	/**
	 * Get the attributes for a field.
	 *
	 * @param array $field Field parameters.
	 * @param mixed $value Meta value.
	 * @return array
	 */
	public static function get_attributes( $field, $value = null ) {
		$attributes         = parent::get_attributes( $field, $value );
		$attributes['type'] = 'hidden';

		return $attributes;
	}

	public static function add_actions() {
		$args  = func_get_args();
		$field = reset( $args );
		add_action( 'print_media_templates', array( Helpers_Field::get_class( $field ), 'print_templates' ) );
	}


	/**
	 * Template for media item.
	 */
	public static function print_templates() {
		require_once CTRLBP_INC_DIR . 'templates/image-input.php';
	}
}
