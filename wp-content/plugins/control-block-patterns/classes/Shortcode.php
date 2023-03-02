<?php
namespace ControlPatterns;
use ControlPatterns\Helpers\Array_Type as Helpers_Array;

class Shortcode {
	public function init() {
		add_shortcode( 'ctrlbp_meta', [ $this, 'register_shortcode' ] );
	}

	public function register_shortcode( $atts ) {
		$atts = wp_parse_args( $atts, [
			'id'                => '',
			'object_id'         => null,
			'attribute'         => '',
			'render_shortcodes' => 'true',
		] );
		Helpers_Array::change_key( $atts, 'post_id', 'object_id' );
		Helpers_Array::change_key( $atts, 'meta_key', 'id' );

		if ( empty( $atts['id'] ) ) {
			return '';
		}

		$field_id  = $atts['id'];
		$object_id = $atts['object_id'];
		unset( $atts['id'], $atts['object_id'] );

		$value = $this->get_value( $field_id, $object_id, $atts );
		$value = 'true' === $atts['render_shortcodes'] ? do_shortcode( $value ) : $value;

		return $value;
	}

	private function get_value( $field_id, $object_id, $atts ) {
		$attribute = $atts['attribute'];
		if ( ! $attribute ) {
			return ctrlbp_the_value( $field_id, $atts, $object_id, false );
		}

		$value = ctrlbp_get_value( $field_id, $atts, $object_id );

		if ( ! is_array( $value ) && ! is_object( $value ) ) {
			return $value;
		}

		if ( is_object( $value ) ) {
			return $value->$attribute;
		}

		if ( isset( $value[ $attribute ] ) ) {
			return $value[ $attribute ];
		}

		$value = wp_list_pluck( $value, $attribute );
		$value = implode( ',', array_filter( $value ) );

		return $value;
	}

}