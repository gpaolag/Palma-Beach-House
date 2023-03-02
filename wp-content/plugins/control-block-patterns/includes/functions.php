<?php
/**
 * Plugin public functions.
 *
 * @package ControlPatterns
 */

if ( ! function_exists( 'ctrlbp_meta' ) ) {
	/**
	 * Get post meta.
	 *
	 * @param string   $key     Meta key. Required.
	 * @param array    $args    Array of arguments. Optional.
	 * @param int|null $post_id Post ID. null for current post. Optional.
	 *
	 * @return mixed
	 */
	function ctrlbp_meta( $key, $args = array(), $post_id = null ) {
		$args  = wp_parse_args( $args );
		$field = ctrlbp_get_field_settings( $key, $args, $post_id );

		/*
		 * If field is not found, which can caused by registering meta boxes for the backend only or conditional registration.
		 * Then fallback to the old method to retrieve meta (which uses get_post_meta() as the latest fallback).
		 */
		if ( false === $field ) {
			return apply_filters( 'ctrlbp_meta', ctrlbp_meta_legacy( $key, $args, $post_id ) );
		}
		$meta = in_array( $field['type'], array( 'oembed', 'map', 'osm' ), true ) ?
			ctrlbp_the_value( $key, $args, $post_id, false ) :
			ctrlbp_get_value( $key, $args, $post_id );
		return apply_filters( 'ctrlbp_meta', $meta, $key, $args, $post_id );
	}
}

if ( ! function_exists( 'ctrlbp_set_meta' ) ) {
	/**
	 * Set meta value.
	 *
	 * @param int    $object_id Object ID. Required.
	 * @param string $key       Meta key. Required.
	 * @param string $value     Meta value. Required.
	 * @param array  $args      Array of arguments. Optional.
	 */
	function ctrlbp_set_meta( $object_id, $key, $value, $args = array() ) {
		$args = wp_parse_args( $args );
		$field = ctrlbp_get_field_settings( $key, $args, $object_id );

		if ( false === $field ) {
			return;
		}

		$old = ControlPatterns\Field::call( $field, 'raw_meta', $object_id );
		$new = ControlPatterns\Field::process_value( $value, $object_id, $field );
		ControlPatterns\Field::call( $field, 'save', $new, $old, $object_id );
	}
}

if ( ! function_exists( 'ctrlbp_get_field_settings' ) ) {
	/**
	 * Get field settings.
	 *
	 * @param string   $key       Meta key. Required.
	 * @param array    $args      Array of arguments. Optional.
	 * @param int|null $object_id Object ID. null for current post. Optional.
	 *
	 * @return array
	 */
	function ctrlbp_get_field_settings( $key, $args = array(), $object_id = null ) {
		$args = wp_parse_args(
			$args,
			array(
				'object_type' => 'post',
				'type'        => '',
			)
		);

		/**
		 * Filter meta type from object type and object id.
		 *
		 * @var string     Meta type, default is post type name.
		 * @var string     Object type.
		 * @var string|int Object id.
		 */
		$type = apply_filters( 'ctrlbp_meta_type', $args['type'], $args['object_type'], $object_id );
		if ( ! $type ) {
			$type = get_post_type( $object_id );
		}

		return ctrlbp_get_registry( 'field' )->get( $key, $type, $args['object_type'] );
	}
}

if ( ! function_exists( 'ctrlbp_meta_legacy' ) ) {
	/**
	 * Get post meta.
	 *
	 * @param string   $key     Meta key. Required.
	 * @param array    $args    Array of arguments. Optional.
	 * @param int|null $post_id Post ID. null for current post. Optional.
	 *
	 * @return mixed
	 */
	function ctrlbp_meta_legacy( $key, $args = array(), $post_id = null ) {
		$args  = wp_parse_args(
			$args,
			array(
				'type'     => 'text',
				'multiple' => false,
				'clone'    => false,
			)
		);
		$field = array(
			'id'       => $key,
			'type'     => $args['type'],
			'clone'    => $args['clone'],
			'multiple' => $args['multiple'],
		);

		$method = 'get_value';
		switch ( $args['type'] ) {
			case 'taxonomy':
			case 'taxonomy_advanced':
				$field['taxonomy'] = $args['taxonomy'];
				break;
			case 'map':
			case 'osm':
			case 'oembed':
				$method = 'the_value';
				break;
		}
		$field = ControlPatterns\Field::call( 'normalize', $field );

		return ControlPatterns\Field::call( $method, $field, $args, $post_id );
	}
}

if ( ! function_exists( 'ctrlbp_get_value' ) ) {
	/**
	 * Get value of custom field.
	 * This is used to replace old version of ctrlbp_meta key.
	 *
	 * @param  string   $field_id Field ID. Required.
	 * @param  array    $args     Additional arguments. Rarely used. See specific fields for details.
	 * @param  int|null $post_id  Post ID. null for current post. Optional.
	 *
	 * @return mixed false if field doesn't exist. Field value otherwise.
	 */
	function ctrlbp_get_value( $field_id, $args = array(), $post_id = null ) {
		$args  = wp_parse_args( $args );
		$field = ctrlbp_get_field_settings( $field_id, $args, $post_id );

		// Get field value.
		$value = $field ? ControlPatterns\Field::call( 'get_value', $field, $args, $post_id ) : false;

		/*
		 * Allow developers to change the returned value of field.
		 * For version < 4.8.2, the filter name was 'ctrlbp_get_field'.
		 *
		 * @param mixed    $value   Field value.
		 * @param array    $field   Field parameters.
		 * @param array    $args    Additional arguments. Rarely used. See specific fields for details.
		 * @param int|null $post_id Post ID. null for current post. Optional.
		 */
		$value = apply_filters( 'ctrlbp_get_value', $value, $field, $args, $post_id );

		return $value;
	}
}

if ( ! function_exists( 'ctrlbp_the_value' ) ) {
	/**
	 * Display the value of a field
	 *
	 * @param  string   $field_id Field ID. Required.
	 * @param  array    $args     Additional arguments. Rarely used. See specific fields for details.
	 * @param  int|null $post_id  Post ID. null for current post. Optional.
	 * @param  bool     $echo     Display field meta value? Default `true` which works in almost all cases. We use `false` for  the [ctrlbp_meta] shortcode.
	 *
	 * @return string
	 */
	function ctrlbp_the_value( $field_id, $args = array(), $post_id = null, $echo = true ) {
		$args  = wp_parse_args( $args );
		$field = ctrlbp_get_field_settings( $field_id, $args, $post_id );

		if ( ! $field ) {
			return '';
		}

		$output = ControlPatterns\Field::call( 'the_value', $field, $args, $post_id );

		/*
		 * Allow developers to change the returned value of field.
		 * For version < 4.8.2, the filter name was 'ctrlbp_get_field'.
		 *
		 * @param mixed    $value   Field HTML output.
		 * @param array    $field   Field parameters.
		 * @param array    $args    Additional arguments. Rarely used. See specific fields for details.
		 * @param int|null $post_id Post ID. null for current post. Optional.
		 */
		$output = apply_filters( 'ctrlbp_the_value', $output, $field, $args, $post_id );

		if ( $echo ) {
			echo $output; // WPCS: XSS OK.
		}

		return $output;
	}
}

if ( ! function_exists( 'ctrlbp_get_object_fields' ) ) {
	/**
	 * Get defined meta fields for object.
	 *
	 * @param int|string $type_or_id  Object ID or post type / taxonomy (for terms) / user (for users).
	 * @param string     $object_type Object type. Use post, term.
	 *
	 * @return array
	 */
	function ctrlbp_get_object_fields( $type_or_id, $object_type = 'post' ) {
		$meta_boxes = ctrlbp_get_registry( 'meta_box' )->get_by( array( 'object_type' => $object_type ) );
		array_walk( $meta_boxes, 'ctrlbp_check_meta_box_supports', array( $object_type, $type_or_id ) );
		$meta_boxes = array_filter( $meta_boxes );

		$fields = array();
		foreach ( $meta_boxes as $meta_box ) {
			foreach ( $meta_box->fields as $field ) {
				$fields[ $field['id'] ] = $field;
			}
		}

		return $fields;
	}
}

if ( ! function_exists( 'ctrlbp_check_meta_box_supports' ) ) {
	/**
	 * Check if a meta box supports an object.
	 *
	 * @param  object $meta_box    Control Block Patterns object.
	 * @param  int    $key         Not used.
	 * @param  array  $object_data Object data (type and ID).
	 */
	function ctrlbp_check_meta_box_supports( &$meta_box, $key, $object_data ) {
		list( $object_type, $type_or_id ) = $object_data;

		$type = null;
		$prop = null;
		switch ( $object_type ) {
			case 'post':
				$type = is_numeric( $type_or_id ) ? get_post_type( $type_or_id ) : $type_or_id;
				$prop = 'post_types';
				break;
			case 'term':
				$type = $type_or_id;
				if ( is_numeric( $type_or_id ) ) {
					$term = get_term( $type_or_id );
					$type = is_array( $term ) ? $term->taxonomy : null;
				}
				$prop = 'taxonomies';
				break;
			case 'user':
				$type = 'user';
				$prop = 'user';
				break;
			case 'setting':
				$type = $type_or_id;
				$prop = 'settings_pages';
				break;
		}
		if ( ! $type ) {
			$meta_box = false;
			return;
		}
		if ( isset( $meta_box->meta_box[ $prop ] ) && ! in_array( $type, $meta_box->meta_box[ $prop ], true ) ) {
			$meta_box = false;
		}
	}
}

if ( ! function_exists( 'ctrlbp_get_registry' ) ) {
	/**
	 * Get the registry by type.
	 * Always return the same instance of the registry.
	 *
	 * @param string $type Registry type.
	 *
	 * @return object
	 */
	function ctrlbp_get_registry( $type ) {
		static $data = array();
		$_type = ControlPatterns\Helpers\String_Type::title_case( $type );
		$class = 'ControlPatterns\\' . $_type . '_Registry';
		if ( ! isset( $data[ $type ] ) ) {
			$data[ $type ] = new $class();
		}

		return $data[ $type ];
	}
}

if ( ! function_exists( 'ctrlbp_get_storage' ) ) {
	/**
	 * Get storage instance.
	 *
	 * @param string      $object_type Object type. Use post or term.
	 * @param CTRLBP_Meta_Box $meta_box    Meta box object. Optional.
	 * @return ControlPatterns\Interfaces\Storage
	 */
	function ctrlbp_get_storage( $object_type, $meta_box = null ) {
		$object_type = ControlPatterns\Helpers\String_Type::title_case( $object_type );
		$class   = $object_type . '_Storage';
		$class   = class_exists( $class ) ? $class : 'ControlPatterns\\Post_Storage';
		$storage = ctrlbp_get_registry( 'storage' )->get( $class );

		return apply_filters( 'ctrlbp_get_storage', $storage, $object_type, $meta_box );
	}
}

if ( ! function_exists( 'ctrlbp_request' ) ) {
	/**
	 * Get request object.
	 *
	 * @return ControlPatterns\Request
	 */
	function ctrlbp_request() {
		static $request;
		if ( ! $request ) {
			$request = new ControlPatterns\Request();
		}
		return $request;
	}
}


if ( ! function_exists( 'ctrlbp_get_block_field' ) ) {
	function ctrlbp_get_block_field( $field_id, $args = [] ) {
		$block_name = ControlPatterns\Blocks\ActiveBlock::get_block_name();
		$args['object_type'] = 'block';
		return ctrlbp_get_value( $field_id, $args, $block_name );
	}
}

if ( ! function_exists( 'ctrlbp_the_block_field' ) ) {
	function ctrlbp_the_block_field( $field_id, $args = [], $echo = true ) {
		$block_name = ControlPatterns\Blocks\ActiveBlock::get_block_name();
		$args['object_type'] = 'block';
		return ctrlbp_get_value( $field_id, $args, $block_name, $echo );
	}
}

if ( ! function_exists( 'ctrlbp_get_option' ) ) {
	/**
	 * Get option value.
	 *
	 * @return option value
	 */
	function ctrlbp_get_option( $id, $default ) {
		$options = get_option('control_block_patterns');
		if( empty($options) || !isset($options[$id]) ) return;

		$value = $options[$id] ? $options[$id] : $default;
		return $value;
	}
}

add_action( 'widgets_init', function() {
    register_widget( 'ControlPatterns\Patterns\Widget' );
});
