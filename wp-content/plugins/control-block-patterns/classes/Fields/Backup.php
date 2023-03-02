<?php
namespace ControlPatterns\Fields;
class Backup extends Textarea {
	

	public static function html( $meta, $field ) {
		
		$storage_class = get_class( $field['storage'] );
		$func          = false !== strpos( $storage_class, 'Network' ) ? 'get_site_option' : 'get_option';

		//$field['field_name'] = "{$field['option_name']}_backup";

		$meta = $func( $field['option_name'] );
		$meta = $meta ? wp_json_encode( array_filter($meta) ) : '';
		$field['rows'] = 2;
		$output = '';
		
		$export_link = add_query_arg( 
			[
			'action' => 'ctrlbp-settings-export', 
			'id' => $field['option_name'],
			'nonce' => wp_create_nonce( 'ctrlbp-export' ),
			] 
		);
		if( !empty($meta) ){
			$output .= '<p><a href="'.esc_url($export_link).'" class="button button-primary">'.esc_attr('Export .json file', 'control-block-patterns').'</a></p>';

		}
		$output .= parent::html( $meta, $field );
		
		return $output;
	}

	public static function save( $new, $old, $post_id, $field ) {}

	public static function normalize( $field ) {
		$field = wp_parse_args( $field, [
			'rows'       => 15,
			'desc'       => __( 'To export settings, copy the content of this field and save to a file.', 'control-block-patterns' ),
			'attributes' => [
				'onclick' => 'this.select()',
			],			
			'id' => false,
			
		] );
		$field = parent::normalize( $field );

		return $field;
	}
	
}