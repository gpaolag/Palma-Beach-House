<?php
namespace ControlPatterns\Fields;
class Import extends Textarea {
	

	public static function html( $meta, $field ) {
		
		$field['attributes'] = [
			'class' => 'ctrlbp-import-field',
			'data-nonce' => wp_create_nonce('ctrlbp-import'),
			'id' => 'textareImportInput',
			'rows' => 5
		];	

		$meta = '';

		$output = parent::html( $meta, $field );

		$output .= '<p>or '.esc_html__( 'Choose an exported ".json" file from your computer:', 'control-block-patterns' ). ' <input type="file" id="fileInput"></p>';

		
		$output .= '<button class="button button-primary" id="ctrlbp-import">'.esc_attr('Import settings', 'control-block-patterns').'</button>';


		return $output;
	}

	public static function save( $new, $old, $post_id, $field ) {}

	public static function normalize( $field ) {
		$field = wp_parse_args( $field, [
			'rows'       => 15,
			//'desc'       => __( 'To export settings, copy the content of this field and save to a file.', 'control-block-patterns' ),
			'placeholder' => esc_attr__( 'Please put your json file only to import data', 'control-block-patterns' ),
			'attributes' => [
				'onclick' => 'this.select()',
			],			
			'id' => false,
			
		] );
		$field = parent::normalize( $field );

		return $field;
	}

	

}