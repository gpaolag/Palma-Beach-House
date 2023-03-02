<?php
/**
 * Retrieve list of WordPress theme features (aka theme tags).
 *
 * @since 3.1.0
 * @since 3.2.0 Added 'Gray' color and 'Featured Image Header', 'Featured Images',
 *              'Full Width Template', and 'Post Formats' features.
 * @since 3.5.0 Added 'Flexible Header' feature.
 * @since 3.8.0 Renamed 'Width' filter to 'Layout'.
 * @since 3.8.0 Renamed 'Fixed Width' and 'Flexible Width' options
 *              to 'Fixed Layout' and 'Fluid Layout'.
 * @since 3.8.0 Added 'Accessibility Ready' feature and 'Responsive Layout' option.
 * @since 3.9.0 Combined 'Layout' and 'Columns' filters.
 * @since 4.6.0 Removed 'Colors' filter.
 * @since 4.6.0 Added 'Grid Layout' option.
 *              Removed 'Fixed Layout', 'Fluid Layout', and 'Responsive Layout' options.
 * @since 4.6.0 Added 'Custom Logo' and 'Footer Widgets' features.
 *              Removed 'Blavatar' feature.
 * @since 4.6.0 Added 'Blog', 'E-Commerce', 'Education', 'Entertainment', 'Food & Drink',
 *              'Holiday', 'News', 'Photography', and 'Portfolio' subjects.
 *              Removed 'Photoblogging' and 'Seasonal' subjects.
 * @since 4.9.0 Reordered the filters from 'Layout', 'Features', 'Subject'
 *              to 'Subject', 'Features', 'Layout'.
 * @since 4.9.0 Removed 'BuddyPress', 'Custom Menu', 'Flexible Header',
 *              'Front Page Posting', 'Microformats', 'RTL Language Support',
 *              'Threaded Comments', and 'Translation Ready' features.
 * @since 5.5.0 Added 'Block Editor Patterns', 'Block Editor Styles',
 *              and 'Full Site Editing' features.
 * @since 5.5.0 Added 'Wide Blocks' layout option.
 *
 * @param bool $api Optional. Whether try to fetch tags from the WordPress.org API. Defaults to true.
 * @return array Array of features keyed by category with translations keyed by slug.
 */
function cbp_get_theme_feature_list( $api = true ) {
	// Hard-coded list is used if API is not accessible.
	$features = array(

		__( 'Subject' )  => array(
			'buttons'           => __( 'Buttons' ),
			'columns'     => __( 'columns' ),
			'gallery'      => __( 'Gallery' ),
			'header'  => __( 'Header' ),
			'images' => __( 'Images' ),
			'text'        => __( 'Text' )
		),

		__( 'Features' ) => array(
			'accessibility-ready'   => __( 'Accessibility Ready' ),
			'block-patterns'        => __( 'Block Editor Patterns' ),
			'block-styles'          => __( 'Block Editor Styles' ),
			'custom-background'     => __( 'Custom Background' ),
			'custom-colors'         => __( 'Custom Colors' ),
			'custom-header'         => __( 'Custom Header' ),
			'custom-logo'           => __( 'Custom Logo' ),
			'editor-style'          => __( 'Editor Style' ),
			'featured-image-header' => __( 'Featured Image Header' ),
			'featured-images'       => __( 'Featured Images' ),
			'footer-widgets'        => __( 'Footer Widgets' ),
			'full-site-editing'     => __( 'Full Site Editing' ),
			'full-width-template'   => __( 'Full Width Template' ),
			'post-formats'          => __( 'Post Formats' ),
			'sticky-post'           => __( 'Sticky Post' ),
			'theme-options'         => __( 'Theme Options' ),
		),

		__( 'Layout' )   => array(
			'grid-layout'   => __( 'Grid Layout' ),
			'one-column'    => __( 'One Column' ),
			'two-columns'   => __( 'Two Columns' ),
			'three-columns' => __( 'Three Columns' ),
			'four-columns'  => __( 'Four Columns' ),
			'left-sidebar'  => __( 'Left Sidebar' ),
			'right-sidebar' => __( 'Right Sidebar' ),
			'wide-blocks'   => __( 'Wide Blocks' ),
		),

	);

	if ( ! $api || ! current_user_can( 'install_themes' ) ) {
		return $features;
	}

	$feature_list = get_site_transient( 'wporg_pattern_feature_list' );
	if ( ! $feature_list ) {
		set_site_transient( 'wporg_pattern_feature_list', array(), 3 * HOUR_IN_SECONDS );
	}

	if ( ! $feature_list ) {
		$feature_list = cbp_patterns_api( 'feature_list', array() );
		if ( is_wp_error( $feature_list ) ) {
			return $features;
		}
	}

	if ( ! $feature_list ) {
		return $features;
	}

	set_site_transient( 'wporg_pattern_feature_list', $feature_list, 3 * HOUR_IN_SECONDS );

	$category_translations = array(
		'Layout'   => __( 'Layout' ),
		'Features' => __( 'Features' ),
		'Subject'  => __( 'Subject' ),
	);

	$wporg_features = array();

	// Loop over the wp.org canonical list and apply translations.
	foreach ( (array) $feature_list as $feature_category => $feature_items ) {
		if ( isset( $category_translations[ $feature_category ] ) ) {
			$feature_category = $category_translations[ $feature_category ];
		}

		$wporg_features[ $feature_category ] = array();

		foreach ( $feature_items as $feature ) {
			if ( isset( $features[ $feature_category ][ $feature ] ) ) {
				$wporg_features[ $feature_category ][ $feature ] = $features[ $feature_category ][ $feature ];
			} else {
				$wporg_features[ $feature_category ][ $feature ] = $feature;
			}
		}
	}

	return $wporg_features;
}

/**
 * Retrieves theme installer pages from the WordPress.org Themes API.
 *
 * It is possible for a theme to override the Themes API result with three
 * filters. Assume this is for themes, which can extend on the Theme Info to
 * offer more choices. This is very powerful and must be used with care, when
 * overriding the filters.
 *
 * The first filter, {@see 'themes_api_args'}, is for the args and gives the action
 * as the second parameter. The hook for {@see 'themes_api_args'} must ensure that
 * an object is returned.
 *
 * The second filter, {@see 'themes_api'}, allows a plugin to override the WordPress.org
 * Theme API entirely. If `$action` is 'query_themes', 'theme_information', or 'feature_list',
 * an object MUST be passed. If `$action` is 'hot_tags', an array should be passed.
 *
 * Finally, the third filter, {@see 'themes_api_result'}, makes it possible to filter the
 * response object or array, depending on the `$action` type.
 *
 * Supported arguments per action:
 *
 * | Argument Name      | 'query_themes' | 'theme_information' | 'hot_tags' | 'feature_list'   |
 * | -------------------| :------------: | :-----------------: | :--------: | :--------------: |
 * | `$slug`            | No             |  Yes                | No         | No               |
 * | `$per_page`        | Yes            |  No                 | No         | No               |
 * | `$page`            | Yes            |  No                 | No         | No               |
 * | `$number`          | No             |  No                 | Yes        | No               |
 * | `$search`          | Yes            |  No                 | No         | No               |
 * | `$tag`             | Yes            |  No                 | No         | No               |
 * | `$author`          | Yes            |  No                 | No         | No               |
 * | `$user`            | Yes            |  No                 | No         | No               |
 * | `$browse`          | Yes            |  No                 | No         | No               |
 * | `$locale`          | Yes            |  Yes                | No         | No               |
 * | `$fields`          | Yes            |  Yes                | No         | No               |
 * 
 * @return object|array|WP_Error Response object or array on success, WP_Error on failure. See the
 *         {@link https://developer.wordpress.org/reference/functions/themes_api/ function reference article}
 *         for more information on the make-up of possible return objects depending on the value of `$action`.
 */
function cbp_patterns_api( $action, $args = array() ) {
	// Include an unmodified $wp_version.
	require ABSPATH . WPINC . '/version.php';
	
	
	if ( is_array( $args ) ) {
		$args = (object) $args;
	}

	if ( 'cbp_query_patterns' === $action ) {
		if ( ! isset( $args->per_page ) ) {
			$args->per_page = 18;
		}
	}

	if ( ! isset( $args->page ) ) {
		$args->page = 1;
	}

	if ( ! isset( $args->locale ) ) {
		$args->locale = get_user_locale();
	}

	if ( ! isset( $args->wp_version ) ) {
		$args->wp_version = substr( $wp_version, 0, 3 ); // x.y
	}



	/**
	 * Filters arguments used to query for installer pages from the WordPress.org Themes API.
	 *
	 * Important: An object MUST be returned to this filter.
	 *
	 * @since 2.8.0
	 *
	 * @param object $args   Arguments used to query for installer pages from the WordPress.org Themes API.
	 * @param string $action Requested action. Likely values are 'theme_information',
	 *                       'feature_list', or 'query_themes'.
	 */
	$args = apply_filters( 'cbp_pattern_api_args', $args, $action );

	/**
	 * Filters whether to override the WordPress.org Themes API.
	 *
	 * Passing a non-false value will effectively short-circuit the WordPress.org API request.
	 *
	 * If `$action` is 'query_themes', 'theme_information', or 'feature_list', an object MUST
	 * be passed. If `$action` is 'hot_tags', an array should be passed.
	 *
	 * @since 2.8.0
	 *
	 * @param false|object|array $override Whether to override the WordPress.org Themes API. Default false.
	 * @param string             $action   Requested action. Likely values are 'theme_information',
	 *                                    'feature_list', or 'query_themes'.
	 * @param object             $args     Arguments used to query for installer pages from the Themes API.
	 */
	$res = false;
	$url = 'https://wordpress.org/patterns/wp-json/wp/v2/wporg-pattern/?_locale=user&locale=en_US';

	if ( ! $res ) {
		
		$url = add_query_arg(
			(array)$args,
			$url
		);

		$http_url = $url;
		$ssl      = wp_http_supports( array( 'ssl' ) );
		if ( $ssl ) {
			$url = set_url_scheme( $url, 'https' );
		}

		$http_args = array(
			'user-agent' => 'WordPress/' . $wp_version . '; ' . home_url( '/' ),
		);

		//cbp_print((array)$url);
		$request   = wp_remote_get( $url, $http_args );
		
		
		if ( $ssl && is_wp_error( $request ) ) {
			if ( ! wp_doing_ajax() ) {
				return false;
			}
			$request = wp_remote_get( $http_url, $http_args );
		}

		if ( is_wp_error( $request ) ) {
			
		} else {
			$res = json_decode( wp_remote_retrieve_body( $request ), true );
			if ( is_array( $res ) ) {
				// Object casting is required in order to match the info/1.0 format.
				$res = (object) $res;
			} elseif ( null === $res ) {
				return $res;
			}

			
		}

			
			
	}	

	/**
	 * Filters the returned WordPress.org Themes API response.
	 *
	 * @param array|object|WP_Error $res    WordPress.org Themes API response.
	 * @param string                $action Requested action. Likely values are 'theme_information',
	 *                                      'feature_list', or 'query_themes'.
	 * @param object                $args   Arguments used to query for installer pages from the WordPress.org Themes API.
	 */
	return apply_filters( 'patterns_api_result', $res, $action, $args );
}

function cbp_pattern_api( $id, $args = array() ) {
	// Include an unmodified $wp_version.
	require ABSPATH . WPINC . '/version.php';

	
	
	if ( is_array( $args ) ) {
		$args = (object) $args;
	}	

	
	if ( ! isset( $args->locale ) ) {
		$args->locale = get_user_locale();
	}

	if ( ! isset( $args->wp_version ) ) {
		$args->wp_version = substr( $wp_version, 0, 3 ); // x.y
	}

	$url = 'https://wordpress.org/patterns/wp-json/wp/v2/wporg-pattern/'.intval($id);
	$url = add_query_arg(
			(array)$args,
			$url
		);

	$request   = wp_remote_get( $url );
	$res = false;
	if ( !is_wp_error( $request ) ) {
		return json_decode( wp_remote_retrieve_body( $request ), true );
	}

	
}

function _cbp_get_list_table( $class, $args = array() ) {
	include __DIR__ .'/class-wp-pattern-install-list-table.php';
	$core_classes = array(
		// Site Admin.
		'CTRLBP_List_Table'                         => 'themes',
	);

	if ( isset( $core_classes[ $class ] ) ) {
		

		if ( isset( $args['screen'] ) ) {
			$args['screen'] = convert_to_screen( $args['screen'] );
		} elseif ( isset( $GLOBALS['hook_suffix'] ) ) {
			$args['screen'] = get_current_screen();
		} else {
			$args['screen'] = null;
		}

		return new $class( $args );
	}

	return false;
}    

/**
 * Display theme content based on theme list.
 *
 * @since 2.8.0
 *
 * @global WP_Theme_Install_List_Table $wp_list_table
 */
function cbp_display_patterns_new() {
	global $wp_list_table;

	if ( ! isset( $wp_list_table ) ) {
		$wp_list_table = _cbp_get_list_table( 'CTRLBP_List_Table' );
	}


	$wp_list_table->prepare_items();
	$wp_list_table->display();

}
/**
 * Prepare themes for JavaScript.
 *
 * @since 3.8.0
 *
 * @param WP_Theme[] $themes Optional. Array of theme objects to prepare.
 *                           Defaults to all allowed themes.
 *
 * @return array An associative array of theme data, sorted by name.
 */
function cbp_wp_prepare_patterns_for_js( $patterns = null ) {	
	
	if ( empty( $patterns ) ) {
		return;
	}	

	$prepared_patterns = array();
	
	foreach ( $patterns as &$pattern ) {
		$pattern = (array)$pattern;
		//cbp_print((array)$pattern);
		
		$slug = $pattern['slug'];
		$prepared_patterns[ $slug ] = array(
			'id'             => $pattern['id'],
			'pattern_id'             => $pattern['id'],
			'slug'             => $slug,
			'name'           => $pattern['title']['rendered'],
			'screenshot'     => '', 
			'description'    => '',
			'author'         => $pattern['author_meta']['name'],
			'authorAndUri'   => $pattern['author_meta']['url'],
			'authorAvatar'   => $pattern['author_meta']['avatar'],
			'categories' 	=> $pattern['category_slugs'],
			'pattern_content' 	=> $pattern['pattern_content'],
			'content' 	=> $pattern['content'],
			'link' 	=> $pattern['link'],
			'favorite_count' 	=> $pattern['favorite_count'],
			'created_at' 	=> date_format( date_create($pattern['date']),get_option('date_format')),
			'last_modified' 	=> date_format( date_create($pattern['modified']),get_option('date_format')),
			'install_url' => add_query_arg(
				[
					'pattern-id' => $pattern['id'], 
					'source' => 'remote'
					
				],				
				admin_url('post-new.php?post_type=ctrl_block_patterns')
			),
			'tags'           => ['Tags'],
			'version'        => '1.0.0',
			'compatibleWP'   => '5.5',
			'compatiblePHP'  => '5.6',
			'updateResponse' => array(
				'compatibleWP'  => 1,
				'compatiblePHP' => 1,
			),
			'parent'         => 1,
			'active'         => '',
			'hasUpdate'      => 0,
			'hasPackage'     => 0,
			'update'         => '',
			'autoupdate'     => array(
				'enabled'   => 0,
				'supported' => 0,
				'forced'    => 0,
			),
			'actions'        => array(
				'activate'   => null,
				'customize'  => null,
				'delete'     => null,
				'autoupdate' => null,
			),
		);
	}


	
	
	/**
	 * Filters the themes prepared for JavaScript, for themes.php.
	 *
	 * Could be useful for changing the order, which is by name by default.
	 *
	 * @since 3.8.0
	 *
	 * @param array $prepared_themes Array of theme data.
	 */
	$prepared_patterns = apply_filters( 'cbp_wp_prepare_patterns_for_js', $prepared_patterns );
	$prepared_patterns = array_values( $prepared_patterns );
	return array_filter( $prepared_patterns );
}


function block_patterns_set_remote_value( $key, $value, $pattern){

	
	if( empty($pattern) ) return $value;

	switch ($key) {
		case 'content':
			return $pattern['pattern_content'];
			break;
		case 'viewportWidth':
			return $pattern['meta']['wpop_viewport_width'];
			break;	
		
		default:
			return $value;
			break;
	}

}


/**
 * Print JS templates for the theme-browsing UI in the Customizer.
 *
 * @since 4.2.0
 */
//add_action( 'customize_controls_print_footer_scripts', 'ctrlbp_customize_patterns_print_templates' );
function ctrlbp_customize_patterns_print_templates() {
	include __DIR__ . '/tmpl.patterns.php';
}

