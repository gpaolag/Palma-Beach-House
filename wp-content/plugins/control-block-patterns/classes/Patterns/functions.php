<?php
/**
 * ControlBlockPatterns Function.
 *
 * @package ControlBlockPatterns
 */


if ( ! function_exists( 'cbp_options_id' ) ) {

	/**
	 * Block Patterns Options ID
	 *
	 * @return string
	 *
	 * @access public
	 */
	function cbp_options_id() {

		return 'control_block_patterns';

	}
}

if ( ! function_exists( 'cbp_settings_id' ) ) {

	/**
	 * Theme Settings ID
	 *
	 * @return string
	 *
	 * @access public
	 */
	function cbp_settings_id() {

		return 'ctrl_block_patterns_settings';

	}
}


if ( ! function_exists( 'cbp_layouts_id' ) ) {

	/**
	 * Theme Layouts ID
	 *
	 * @return string
	 *
	 * @access public
	 */
	function cbp_layouts_id() {

		return apply_filters( 'block_patterns/layouts_id', 'block_patterns_layouts' );

	}
}

if ( ! function_exists( 'cbp_get_option' ) ) {

	/**
	 * Get Option.
	 *
	 * Helper function to return the option value.
	 * If no value has been saved, it returns $default.
	 *
	 * @param  string $option_id The option ID.
	 * @param  string $default   The default option value.
	 * @return mixed
	 *
	 * @access public
	 */
	function cbp_get_option( $option_id, $default = '' ) {

		// Get the saved options.
		$options = get_option( cbp_options_id() );

		// Look for the saved value.
		if ( isset( $options[ $option_id ] ) && '' !== $options[ $option_id ] ) {

			return $options[ $option_id ];

		}

		return $default;

	}
}

if ( ! function_exists( 'cbp_echo_option' ) ) {

	/**
	 * Echo Option.
	 *
	 * Helper function to echo the option value.
	 * If no value has been saved, it echos $default.
	 *
	 * @param  string $option_id The option ID.
	 * @param  string $default   The default option value.
	 * @return mixed
	 *
	 * @access public
	 */
	function cbp_echo_option( $option_id, $default = '' ) {

		echo cbp_get_option( $option_id, $default ); // phpcs:ignore

	}
}


if ( ! function_exists( 'control_block_patterns_compress' ) ) {
	function control_block_patterns_compress($buffer) {
	    //Remove CSS comments
	    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
	    //Remove tabs, spaces, newlines, etc.
	    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
	    return $buffer;
	}
}

if ( ! function_exists( 'control_block_patterns_prepare_settings' ) ) {
	function control_block_patterns_prepare_settings($custom_settings) {
		// backup default settings
		$setting_fields = $custom_settings['settings'];
		

		if( !empty($custom_settings['sections']) ):
			// backup sections
			$setting_sections = $custom_settings['sections'];
		 	// prepare section settings
			foreach ( $setting_sections as $key => $section ) {
				if( empty($section['settings']) ) continue;

				//Ensure section ID is available
				$new_settings = $section['settings'];
				foreach ($new_settings as $_key => $_value) {
					$new_settings[$_key]['section'] = $section['id']; 
				}

				// Merge Section settings 
				$setting_fields = array_merge($new_settings, $setting_fields);
				// remove settings from section
				unset($setting_sections[$key]['settings']);
			}

			// restore sections
			$custom_settings['sections'] = $setting_sections;
		endif;	

		// restore all settings
		$custom_settings['settings'] = $setting_fields;

	   return $custom_settings;
	}
}

if ( ! function_exists( 'control_block_patterns_choices' ) ) {
	function control_block_patterns_choices($choices = array()) {
		if( empty($choices) ){
			$choices = array(
		    	array(
		    		'value' => '',
		    		'label' => esc_attr__( '-- Choose Pattern --', 'control-block-patterns' ),
		    	)
		    );
		}

		$args = array(
		    'post_type'  => 'ctrl_block_patterns',
		    'numberposts' => -1
		);
		$postslist = get_posts( $args );

		if( empty($postslist) || is_wp_error($postslist) )
			return array(
		    	array(
		    		'value' => '',
		    		'label' => esc_attr__( 'No Patterns Found', 'control-block-patterns' ),
		    	)
		    );


		foreach ($postslist as $key => $value) {
			$choices[] = array(
				'value' => $value->post_name,
				'label' => $value->post_title,
			);
		}
	    
	    return $choices;
	}
}

function cbp_get_pattern_preview(){


	if( !empty($_GET['post']) ){
		$desc = '
		<div class="cbp-pattern-preview-frame iframe-ready">
			<div class="pattern-grid__preview">
				<iframe src="'.sprintf( CTRL_BLOCK_PATTERNS_URL.'classes/directory/preview.php?post_id=%s', $_GET['post'] ).'" loading="lazy"></iframe>
			</div>
		</div>';
	}else{
		$desc ='Block HTML Markup is required for the pattern preview. <p><a class="button" href="'.admin_url('edit.php?post_type=ctrl_block_patterns&page=directory').'">Insert Pattern Content from
		Directory</a></p>';
		
	}
	return array(
		'id'           => 'cbp_patternpreview',				
		'desc'         => $desc,	
		'class' 		=> 'no-flex',		
		'type'         => 'textblock',
		'condition'      => 'display_preview:is(on)',
	);
}

