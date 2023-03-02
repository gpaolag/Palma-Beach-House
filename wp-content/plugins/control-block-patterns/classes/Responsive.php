<?php
namespace ControlPatterns;


class Responsive {
	/**
	 * Indicate that the instance of the class is working on a meta box that has tabs or not.
	 * It will be set 'true' BEFORE meta box is display and 'false' AFTER.
	 *
	 * @var bool
	 */
	protected $active = false;

	/**
	 * Store all output of fields.
	 * This is used to put fields in correct <div> for tabs.
	 * The fields' output will be get via filter 'ctrlbp_outer_html'.
	 *
	 * @var array
	 */
	protected $fields_output = array();

	public function __construct() {
		add_action( 'ctrlbp_enqueue_scripts', array( $this, 'enqueue' ) );

		//add_filter( 'ctrlbp_outer_html', array( $this, 'outer_html' ), 10, 2 ); 
		//add_filter( 'ctrlbp_begin_html', array( $this, 'begin_html' ), 10, 2 ); 
		add_filter( 'ctrlbp_responsive_config', array( $this, 'configs' ), 10, 1 ); 
		
		
	}

	public function enqueue() {
		//wp_enqueue_script( 'ctrlbp-responsive', CTRLBP_JS_URI . 'responsive.js', array( 'jquery' ), CTRLBP_VER, true );
	}

	public function configs($configs){
		foreach ( $configs as $key => $config ) {
			$configs[$key] = self::meta_box($config);
		}
		return $configs;
	}

	private static function meta_box($meta_box){
		
		if( empty($meta_box['fields']) ) return $meta_box;

		$new_fields = [];
		foreach ($meta_box['fields'] as $field) {
			

			if( !empty($field['responsive']) && $field['responsive'] ){
				$field_id = $field['id'];
				
				
				if( !empty(self::responsive_fields($field)) ){
					$new_fields = array_merge($new_fields, self::responsive_fields($field));
					unset($field['responsive']);
				}
				
				$field_class = !empty($field['class'])? $field['class'].' ctrlbp-has-responsive' : 'ctrlbp-has-responsive';
				$field_condition = [$field_id.'_responsive', '=', 'lg'];
				if( !empty($field['visible'][0]) && !is_array($field['visible'][0]) ){					
					$field['visible'] = array( $field_condition, $field['visible']);
				}else{
					$field['visible'] = $field_condition;
				}
				$field['class'] = $field_class;				
			}

			
			$new_fields[] = $field;
		}
		$meta_box['fields'] = $new_fields;

		return $meta_box;
	}

	private static function responsive_fields($field){
		
		
		$devices = ['sm', 'xs'];
		$field_id = $field['id'];
		$field_visible = !empty($field['visible'])? $field['visible'] : [];
		

		$fields = [self::device_options($field)];


		
		foreach ($devices as $value) {
			if( !empty($field['responsive']) ) unset($field['responsive']);

			$field['id'] = $field_id.'_'.$value;
			
			$field_condition = [$field_id.'_responsive', '=', $value];
			if( !empty($field_visible[0]) && !is_array($field_visible[0]) ){					
				$field['visible'] = array( $field_condition, $field_visible);
			}else{
				$field['visible'] = $field_condition;
			}
			$fields[] = $field;
		}
		return $fields;
	}

	private static function device_options($field){
		$field_id = $field['id'];
		$device_field = array(
			'id'       => $field_id.'_responsive',
			'std'     => 'lg',
			'type'     => 'button_group',		
			'options'  => array(
				'lg'      => '<i class="dashicons dashicons-desktop"></i>',
				'sm'    => '<i class="dashicons dashicons-tablet"></i>',
				'xs' => '<i class="dashicons dashicons-smartphone"></i>',
			),
			'class' => 'ctrlbp-devices',			
			'inline'   => true,
			'multiple' => false,
		);

		if( !empty($field['visible']) ){
			$device_field['visible'] = $field['visible'];
		}

		if( !empty($field['hidden']) ){
			$device_field['hidden'] = $field['hidden'];
		}

		return $device_field;
	}

	

	/**
	 * Display outer div for tabs for meta box.
	 *
	 */
	public function outer_html( $outer_html, $field ) {
		if ( empty( $field['responsive'] ) ) {
			return $outer_html;
		}

		$this->active = true;

		return '<div class="ctrlbp-has-responsive">'.$outer_html.'</div>';
	}

	/**
	 * Display begin div for tabs for meta box.
	 *
	 */
	public function begin_html( $begin_html, $field ) {
		if ( empty( $field['responsive'] ) ) {
			return $begin_html;
		}

		$this->active = true;

		return '<div class="ctrlbp-responsive-wrapper">
				<div class="ctrlbp-responsive-devices">
					<button type="button" class="ctrlbp-preview ctrlbp-preview-desktop active" aria-pressed="true" data-device="desktop">
						<span class="dashicons dashicons-desktop"></span>
					</button>
					<button type="button" class="ctrlbp-preview ctrlbp-preview-tablet" aria-pressed="false" data-device="tablet">
						<span class="dashicons dashicons-tablet"></span>
					</button>
					<button type="button" class="ctrlbp-preview ctrlbp-preview-mobile" aria-pressed="false" data-device="mobile">
						<span class="dashicons dashicons-smartphone"></span>
					</button>
			</div></div>'.$begin_html;
	}

	
}
