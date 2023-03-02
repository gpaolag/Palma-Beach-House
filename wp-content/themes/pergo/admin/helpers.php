<?php
/**
* developer pre print
*/
if( !function_exists('pergo_print') ):
function pergo_print($array = array()){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
endif;

if( !function_exists('pergo_breakCSS') ){
  function pergo_breakCSS($css){

      $results = array();

      preg_match_all('/(.+?)\s?\{\s?(.+?)\s?\}/', $css, $matches);
      foreach($matches[0] AS $i=>$original)
          foreach(explode(';', $matches[2][$i]) AS $attr)
              if (strlen(trim($attr)) > 0) // for missing semicolon on last element, which is legal
              {
                  list($name, $value) = explode(':', $attr);
                  $results[$matches[1][$i]][trim($name)] = trim($value);
              }
      return $results;
  }
}

if( !function_exists('pergo_breakCSS_iconArr') ){
  function pergo_breakCSS_iconArr($css){
    $css = pergo_breakCSS($css);
    $css = array_filter($css);

      $results = array();

      foreach ($css as $key => $value) {
        $key = str_replace(".","", $key );
        $key = str_replace(":before","", $key );

        $value = str_replace("-"," ", $key );

        $results[] = array ( $key => $value);
        
      }
      
      return $results;
  }
}

if( !function_exists('pergo_get_filtered_classes') ):
function pergo_get_filtered_classes($class, $classes){
  if ( ! empty( $class ) ) {
    if ( !is_array( $class ) )
      $class = preg_split( '#\s+#', $class );
    $classes = array_merge( $classes, $class );
  } else {
    // Ensure that we always coerce class to being an array.
    $class = array();
  }

  return array_map( 'esc_attr', $classes );
}
endif;

if( !function_exists('pergo_range_option') ):
function pergo_range_option( $start, $limit, $step = 1 ) {
  if ( $step < 0 )
  $step = 1;
  $range = range( $start, $limit, $step );  
  foreach( $range as $k => $v ) {
    if ( strpos( $v, 'E' ) ) {
      $range[$k] = 0;
    }
  }

  return $range;
}
endif;

if( !function_exists('pergo_range_option_by_args') ):
function pergo_range_option_by_args( $atts = array() ) {
  $args = array(
      'start' => 0,
      'limit' => 100,
      'step' => 5, 
      'label_prefix' => '',
      'label_postfix' => '',   
  );
  $atts = shortcode_atts($args, $atts);
  extract($atts);
  $label_prefix = ( $label_prefix != '' )? $label_prefix.' ' : $label_prefix;
  $label_postfix = ( $label_postfix != '' )? ' '.$label_postfix : $label_postfix;
 
  if ( $step < 0 ) $step = 1;
  $range = range( $start, $limit, $step );  
  $arr = array();
  foreach( $range as $v ) {
       $arr[$v] = $label_prefix.$v.$label_postfix;   
  }

  return $arr;
}
endif;

if ( !function_exists( 'pergo_get_posts_dropdown' ) ):
    function pergo_get_posts_dropdown( $args = array(), $key = 'ID' ) {
        global $post;
        $dropdown  = array( );
        $the_query = new WP_Query( $args );
        if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
                $the_query->the_post();
                $key_value = get_the_ID();
                if($key == 'title'){
                    $key_value = get_the_title();
                }
                if($key == 'slug'){
                    $key_value = $post->post_name;
                }
                $dropdown[ $key_value ] = get_the_title();
            } //$the_query->have_posts()
        } //$the_query->have_posts()
        wp_reset_postdata();
        return $dropdown;
    }
endif;

if ( !function_exists( 'pergo_get_post_options' ) ):
    function pergo_get_post_options( $post_type = 'post' , $key = 'ID' ) {        
        $args = array(
          'post_type' => esc_attr($post_type),
          'posts_per_page' => -1
        );
        return pergo_get_posts_dropdown($args, $key);
    }
endif;

if ( !function_exists( 'pergo_get_terms' ) ):
    function pergo_get_terms( $tax = 'category', $key = 'id' ) {
        $terms = array( );
        if ( !taxonomy_exists( $tax ) )
            return false;
        if ( $key === 'id' )
            foreach ( (array) get_terms( $tax, array(
                 'hide_empty' => false 
            ) ) as $term )
                $terms[ $term->term_id ] = $term->name;
        elseif ( $key === 'slug' )
            foreach ( (array) get_terms( $tax, array(
                 'hide_empty' => false 
            ) ) as $term )
                $terms[ $term->slug ] = $term->name;
        return $terms;
    }
endif;

if ( !function_exists( 'pergo_get_template_args' ) ):
function pergo_get_template_args(){
    global $wp_query;
    if( isset($wp_query->pergo)){
        if( isset($wp_query->pergo['template_args'])){
          return $wp_query->pergo['template_args'];
        }
    }
}
endif;

if ( !function_exists( 'pergo_prepare_template_file' ) ):
function pergo_prepare_template_file($filename){
  $file_path = get_template_directory() . '/'.get_post_type().'/'. $filename;
  $file_path_2 = get_template_directory() . '/post/'. $filename;
  $default_path = get_template_directory() . '/'.get_post_type().'/'. $filename;
  if( file_exists($file_path) ){
    return get_post_type().'/'. $filename;
  }elseif( file_exists($file_path_2) ){
    return 'post/'. $filename;
  }else{
    return 'template-empty.php';
  }
}
endif;

if ( !function_exists( 'pergo_buffer_template_file' ) ):
function pergo_buffer_template_file($template_file, $args = array()){
    ob_start();    
    pergo_get_template( $template_file , $args );
    return ob_get_clean();
}
endif;

/**
 * Get template part (post_type/content-single).
 *
 * @param mixed  $slug Template slug.
 * @param string $name Template name (default: '').
 */
if ( !function_exists( 'pergo_get_template_part' ) ):
function pergo_get_template_part( $slug, $name = '' ) {
  $my_theme = wp_get_theme();
  $cache_key = sanitize_key( implode( '-', array( 'template-part', $slug, $name, $my_theme->get( 'Version' ) ) ) );
  $template  = (string) wp_cache_get( $cache_key, 'pergo' );

  if ( ! $template ) {
    if ( $name ) {
      $template = locate_template(
        array(         
          get_post_type() . "/{$slug}-{$name}.php",
        )
      );

      if ( ! $template ) {
        $fallback = get_post_type() . "/{$slug}-{$name}.php";
        $template = file_exists( $fallback ) ? $fallback : '';
      }
    }

    if ( ! $template ) {
      // If template file doesn't exist, look in yourtheme/slug.php and yourtheme/pergo/slug.php.
      $template = locate_template(
        array(         
          get_post_type() . "/{$slug}.php",
        )
      );
    }

    wp_cache_set( $cache_key, $template, 'pergo' );
  }

  // Allow 3rd party plugins to filter template file from their plugin.
  $template = apply_filters( 'pergo_get_template_part', $template, $slug, $name );

  if ( $template ) {
    load_template( $template, false );
  }
}
endif;

/**
 * Get other templates (e.g. product attributes) passing attributes and including the file.
 *
 * @param string $template_name Template name.
 * @param array  $args          Arguments. (default: array).
 * @param string $template_path Template path. (default: '').
 * @param string $default_path  Default path. (default: '').
 */
if ( !function_exists( 'pergo_get_template' ) ):
function pergo_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
  $my_theme = wp_get_theme();
  $cache_key = sanitize_key( implode( '-', array( 'template', $template_name, $template_path, $default_path, $my_theme->get( 'Version' ) ) ) );
  $template  = (string) wp_cache_get( $cache_key, 'pergo' );

  if ( ! $template ) {
    $template = pergo_locate_template( $template_name, $template_path, $default_path );
    wp_cache_set( $cache_key, $template, 'pergo' );
  }

  // Allow 3rd party plugin filter template file from their plugin.
  $filter_template = apply_filters( 'pergo_get_template', $template, $template_name, $args, $template_path, $default_path );

  if ( $filter_template !== $template ) {    
    $template = $filter_template;
  }

  if( $template_name == '' ) return;

  $action_args = array(
    'template_name' => $template_name,
    'template_path' => $template_path,
    'located'       => $template,
    'args'          => $args,
  );

  global $post;
  $args['post'] = $post;



  if ( ! empty( $args ) && is_array( $args ) ) {    
    extract( $args ); 
  }

  do_action( 'pergo_before_template_part', $action_args['template_name'], $action_args['template_path'], $action_args['located'], $action_args['args'] );


  include $action_args['located'];
 

  do_action( 'pergo_after_template_part', $action_args['template_name'], $action_args['template_path'], $action_args['located'], $action_args['args'] );
}
endif;

/**
 * Like pergo_get_template, but returns the HTML instead of outputting.
 *
 * @see pergo_get_template
 * @param string $template_name Template name.
 * @param array  $args          Arguments. (default: array).
 * @param string $template_path Template path. (default: '').
 * @param string $default_path  Default path. (default: '').
 *
 * @return string
 */
if ( !function_exists( 'pergo_get_template_html' ) ):
function pergo_get_template_html( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
  ob_start();
  pergo_get_template( $template_name, $args, $template_path, $default_path );
  return ob_get_clean();
}
endif;

/**
 * Locate a template and return the path for inclusion.
 *
 * @param string $template_name Template name.
 * @param string $template_path Template path. (default: '').
 * @param string $default_path  Default path. (default: '').
 * @return string
 */
if ( !function_exists( 'pergo_locate_template' ) ):
function pergo_locate_template( $template_name, $template_path = '', $default_path = '' ) {
  if ( ! $template_path ) {
    $template_path = get_stylesheet_directory().'/';
  }

  if ( ! $default_path ) {
    $default_path = get_template_directory().'/';
  }

  


  $template = $default_path . $template_name;
  $child_template = $template_path . $template_name;
  

  // Get default template/.
  if ( file_exists($child_template) ) {
    $template = $child_template;
  }
  

  // Return what we found.
  return apply_filters( 'pergo_locate_template', $template, $template_name, $template_path );
}
endif;


if ( !function_exists( 'pergo_is_meta_field_exists' ) ):
function pergo_is_meta_field_exists( $field_name, $post_id = NULL ){  

  if( !function_exists('rwmb_meta') ) return false;

  if( $post_id == NULL ){      
      $post_id = get_the_ID();
  }

  $my_post_meta = get_post_meta($post_id, esc_attr($field_name), false); 
  
  if ( ! empty ( $my_post_meta ) ) 
    return true;
  else 
    return false;

}
endif;

if ( !function_exists( 'pergo_array_search_by_key_value' ) ):
function pergo_array_search_by_key_value($array, $key, $value){
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, pergo_array_search_by_key_value($subarray, $key, $value));
        }
    }

    return $results;
}
endif;


if ( !function_exists( 'pergo_parse_text' ) ):
function pergo_parse_text( $text, $args = array( ) ) {
    if ( is_array( $args ) ) {
        extract( shortcode_atts( array(
            'tag'  => 'span',     
            'inner_tag'  => '',     
            'all_classes' => '',
            'inline_css' => '',
            'before' => '',
            'after' => '' 
        ), $args ) );
    } //is_array( $args )
    else {
        extract( shortcode_atts( array(
            'tag' => ($args == '')? 'span' : $args,
            'inner_tag'  => '',  
            'all_classes' => '',
            'inline_css' => '',
            'before' => '',
            'after' => '' 
        ), $args ) );
    } 

    if( isset($inner_tag) && $inner_tag != '')  $tag = $inner_tag; 
    
    preg_match_all( "/\{([^\}]*)\}/", $text, $matches );    
    
    if ( !empty( $matches ) ) {
        foreach ( $matches[ 1 ] as $value ) {
            $find    = "{{$value}}";
            $replace = "{$before}<{$tag} {$all_classes} {$inline_css}>{$value}</{$tag}>{$after}";
            $text    = str_replace( $find, $replace, $text );
        } //$matches[1] as $value
    }
    return  $text;
}
endif;

if ( !function_exists( 'pergo_get_parse_text' ) ):
function pergo_get_parse_text($text = '', $args = array()){

    if( $text == '' ) return false;

    extract( shortcode_atts( array(
            'highlight_text' => '',
            'highlight_text_underline' => '',
            'highlight_text_color' => '',
            'highlight_text_bg' => '', 
            'highlight_text_weight' => '', 
            'highlight_text_tag' => 'span', 
        ), $args ));

    if( $highlight_text == '' ) return $text;

    $classes = array();
    $classes[] = $highlight_text_underline;
    $classes[] = ($highlight_text_color != '')? $highlight_text_color.'-color' : '';
    $classes[] = ($highlight_text_bg != '')? $highlight_text_bg : '';
    $classes[] = ($highlight_text_weight != '')? $highlight_text_weight : '';
    $classes = array_filter($classes);

    $parse_args = array(
        'tag' => $highlight_text_tag,
        'tagclass' => implode(' ', $classes),
        'before' => '',
        'after' => ''
    );

    $parse_args = ( $highlight_text != '' )? $parse_args : array();

    return pergo_parse_text($text, $parse_args);
}
endif;

if( !function_exists('pergo_hex2rgb') ):
function pergo_hex2rgb( $color, $opacity='1' ) {
  $color = trim( $color, '#' );

  if ( strlen( $color ) == 3 ) {
    $r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
    $g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
    $b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
  } else if ( strlen( $color ) == 6 ) {
    $r = hexdec( substr( $color, 0, 2 ) );
    $g = hexdec( substr( $color, 2, 2 ) );
    $b = hexdec( substr( $color, 4, 2 ) );
  } else {
    return '';
  }
  if(!$opacity){
    return "{$r}, {$g}, {$b}";
  }else{
    return "rgba( {$r}, {$g}, {$b}, {$opacity} )";
  }
  
}
endif;

if( !function_exists('pergo_get_server_database_version') ):
function pergo_get_server_database_version() {
	global $wpdb;

	if ( empty( $wpdb->is_mysql ) ) {
		return array(
			'string' => '',
			'number' => '',
		);
	}

	if ( $wpdb->use_mysqli ) {
		$server_info = mysqli_get_server_info( $wpdb->dbh ); // @codingStandardsIgnoreLine.
	} else {
		$server_info = mysql_get_server_info( $wpdb->dbh ); // @codingStandardsIgnoreLine.
	}

	return array(
		'string' => $server_info,
		'number' => preg_replace( '/([^\d.]+).*/', '', $server_info ),
	);
}
endif;

if( !function_exists('pergo_let_to_num') ):
function pergo_let_to_num( $size ) {
	$l    = substr( $size, -1 );
	$ret  = substr( $size, 0, -1 );
	$byte = 1024;

	switch ( strtoupper( $l ) ) {
		case 'P':
			$ret *= 1024;
			// No break.
		case 'T':
			$ret *= 1024;
			// No break.
		case 'G':
			$ret *= 1024;
			// No break.
		case 'M':
			$ret *= 1024;
			// No break.
		case 'K':
			$ret *= 1024;
			// No break.
	}
	return $ret;
}
endif;

if( !function_exists('pergo_get_server_system_status') ):
function pergo_get_server_system_status(){
	global $wpdb;

		// Figure out cURL version, if installed.
		$curl_version = '';
		if ( function_exists( 'curl_version' ) ) {
			$curl_version = curl_version();
			$curl_version = $curl_version['version'] . ', ' . $curl_version['ssl_version'];
		}

		// WP memory limit.
		$wp_memory_limit = pergo_let_to_num( WP_MEMORY_LIMIT );
		if ( function_exists( 'memory_get_usage' ) ) {
			$wp_memory_limit = max( $wp_memory_limit, pergo_let_to_num( @ini_get( 'memory_limit' ) ) );
		}

		

		$database_version = pergo_get_server_database_version();

		// Return all environment info. Described by JSON Schema.
		return array(
			'home_url'                  => home_url(),
			'site_url'                  => get_option( 'siteurl' ),
			'wp_version'                => get_bloginfo( 'version' ),
			'wp_multisite'              => is_multisite(),
			'wp_memory_limit'           => $wp_memory_limit,
			'wp_debug_mode'             => ( defined( 'WP_DEBUG' ) && WP_DEBUG ),
			'wp_cron'                   => ! ( defined( 'DISABLE_WP_CRON' ) && DISABLE_WP_CRON ),
			'language'                  => get_locale(),
			'external_object_cache'     => wp_using_ext_object_cache(),			
			'php_version'               => phpversion(),
			'php_post_max_size'         => pergo_let_to_num( ini_get( 'post_max_size' ) ),
			'php_max_execution_time'    => ini_get( 'max_execution_time' ),
			'php_max_input_vars'        => ini_get( 'max_input_vars' ),
			'curl_version'              => $curl_version,
			'suhosin_installed'         => extension_loaded( 'suhosin' ),
			'max_upload_size'           => wp_max_upload_size(),
			'mysql_version'             => $database_version['number'],
			'mysql_version_string'      => $database_version['string'],
			'default_timezone'          => date_default_timezone_get(),
			'fsockopen_or_curl_enabled' => ( function_exists( 'fsockopen' ) || function_exists( 'curl_init' ) ),
			'soapclient_enabled'        => class_exists( 'SoapClient' ),
			'domdocument_enabled'       => class_exists( 'DOMDocument' ),
			'gzip_enabled'              => is_callable( 'gzopen' ),
			'mbstring_enabled'          => extension_loaded( 'mbstring' ),			
		);
}
endif;

if( !function_exists('pergo_get_server_invironment') ):
function pergo_get_server_invironment( $type= '' ){

    $environment      = pergo_get_server_system_status();
    if( $type == 'wp_memory_limit' ){
      if ( $environment['wp_memory_limit'] < 67108864 ) {        
          return '<mark class="no"><span class="dashicons dashicons-warning"></span>' . esc_html( size_format( $environment['wp_memory_limit'] ) ) . '</mark>';
        } else {
          return '<mark class="yes"><span class="dashicons dashicons-yes"></span>' . esc_html( size_format( $environment['wp_memory_limit'] ) ) . '</mark>';
        }
    }

    if( $type == 'max_upload_size' ){
      if ( $environment['max_upload_size'] < 67108864 ) {
         return '<mark class="no"><span class="dashicons dashicons-warning"></span>' . esc_html( size_format( $environment['max_upload_size'] ) ) . '</mark>';
      }else{
         return '<mark class="yes"><span class="dashicons dashicons-yes"></span>' . esc_html( size_format( $environment['max_upload_size'] ) ) . '</mark>';
      }      
    }

    if( $type == 'php_post_max_size' ){
      if ( $environment['php_post_max_size'] < 67108864 ) {
         return '<mark class="no"><span class="dashicons dashicons-warning"></span>' . esc_html( size_format( $environment['php_post_max_size'] ) ) . '</mark>';
      }else{
         return '<mark class="yes"><span class="dashicons dashicons-yes"></span>' . esc_html( size_format( $environment['php_post_max_size'] ) ) . '</mark>';
      }      
    }

    if( $type == 'php_max_execution_time' ){
      if ( $environment['php_max_execution_time'] < 300 ) {
         return '<mark class="no"><span class="dashicons dashicons-warning"></span>' . esc_html( $environment['php_max_execution_time'] ) . '</mark>';
      }else{
         return '<mark class="yes"><span class="dashicons dashicons-yes"></span>' . esc_html( $environment['php_max_execution_time'] ) . '</mark>';
      }      
    } 

    if( $type == 'php_version' ){
      if ( version_compare( $environment['php_version'], '7.1', '>=' ) ) {
         return '<mark class="yes"><span class="dashicons dashicons-yes"></span>' . esc_html( $environment['php_version'] ) . '</mark>';         
      }else{
        return '<mark class="no"><span class="dashicons dashicons-warning"></span>' . esc_html( $environment['php_version'] ) . '</mark>';
      }      
    }  
 
}
endif;

if( !function_exists('pergo_intro_text') ):
function pergo_intro_text( $default_text ) {
  $default_text .= '<div class="ocdi__intro-text"><table class="widefat">
  <thead><tr>
  <th><h3>Check your server settings</h3></th>
  <th><h3>Common error</h3></th>
  </tr></thead>
  <tbody><tr><td>
  <p>Deactivate all cache plugin before import demo data.</p>
   <p>These defaults are not perfect and it depends on how large of an import you are making. So the bigger the import, the higher the numbers should be.</p>
  <ul>
    <li>PHP version (minimam 7.1+) '.pergo_get_server_invironment("php_version").'</li> 
    <li>upload_max_filesize (64MB) '.pergo_get_server_invironment("max_upload_size").'</li>    
    <li>memory_limit (256MB) '.pergo_get_server_invironment("wp_memory_limit").'</li>
    <li>max_execution_time (300) '.pergo_get_server_invironment("php_max_execution_time").'</li>
    <li>post_max_size (64MB) '.pergo_get_server_invironment("php_post_max_size").'</li>    
    </ul>
    
    </td><td>
    <h3>Server error 500</h3>
   <p>This usually indicates a poor server configuration, usually on a cheap shared hosting (low values for PHP settings, missing PHP modules, and so on. <br>
   There are two things you can do. You can contact your hosting support and ask them to update some PHP settings for your site</p>   
    <h3>Server error 504 - Gateway timeout</h3>
   <p>This means, that the server did not get a timely response and so it stopped with the current import. What you can try is to run the same import again. If you get the same error, you can try to run the same import a few times. A couple of import tries might finish the import till the end, becaue your server will be able to process the import data in smaller chunks.</p>
   <h4>Error: Not Found (404)</h4>
   <p>Sometime server blocked read permissions for demo data files. Please <a href="http://localhost/pergo/demos/wp-admin/themes.php?page=pt-one-click-demo-import&amp;import-mode=manual">Switch to manual import!</a> to avoid this issues.
		You can see demo data files in <strong>pergo/admin/demo-data</strong> folder.
	</p>
   </td>
   </tr></tbody>
   </table>
  </div>';

  return $default_text;
}
endif;
add_filter( 'pt-ocdi/plugin_intro_text', 'pergo_intro_text' );

if ( !function_exists( 'pergo_get_current_post_type' ) ):
/**
* gets the current post type in the WordPress Admin
*/
function pergo_get_current_post_type( ) {
    global $wpdb, $post, $typenow, $current_screen;
    //we have a post so we can just get the post type from that
    if ( $typenow )
        return $typenow;
    //check the global $typenow - set in admin.php
    //check the global $current_screen object - set in sceen.php
    elseif ( $current_screen && $current_screen->post_type )
        return $current_screen->post_type;
    //lastly check the post_type querystring
    elseif ( isset( $_REQUEST[ 'post_type' ] ) )
        return sanitize_key( $_REQUEST[ 'post_type' ] );
    elseif ( isset( $_REQUEST[ 'post' ] ) && get_post_type( $_REQUEST[ 'post' ] ) )
        return get_post_type( $_REQUEST[ 'post' ] );
    elseif ( $post && $post->post_type )
        return $post->post_type;
    //we do not know the post type!
    return null;
}
endif;

if ( !function_exists( 'pergo_get_terms_choices' ) ):
function pergo_get_terms_choices( $tax = 'category', $key = 'slug' ) {
    $terms = array( );
    if ( !taxonomy_exists( $tax ) )
        return false;
    if ( $key === 'id' )
        foreach ( (array) get_terms( $tax, array( 'hide_empty' => false ) ) as $term )
            $terms[] = array(
                'label' => $term->name,
                'value' => $term->term_id
            );
    elseif ( $key === 'slug' )
        foreach ( (array) get_terms( $tax, array( 'hide_empty' => false ) ) as $term )
            $terms[] = array(
                'label' => $term->name,
                'value' => $term->slug
            );

    return $terms;
}
endif;

if ( !function_exists( 'pergo_get_terms_options' ) ):
function pergo_get_terms_options( $tax = 'category', $key = 'slug' ) {
    $options = array();
    $choices = pergo_get_terms_choices($tax, $key);
    if( !empty($choices) ){
      foreach ($choices as $option) {
        $key = $option['value'];
        $value = $option['label'];
        $options[$key] = $value;
      }
    }
    return $options;
}
endif;

if ( !function_exists( 'pergo_posts_template' ) ):
    function pergo_posts_template( $atts, $content = null, $type = "posts" ) {
        // Prepare error var
        $error               = null;
        // Parse attributes
        $atts                = shortcode_atts( array(
            'template' => 'templates/default-loop.php',
            'id' => false,
            'posts_per_page' => get_option( 'posts_per_page' ),
            'post_type' => 'post',
            'taxonomy' => 'category',
            'tax_term' => false,
            'tax_operator' => 'IN',
            'author' => '',
            'tag' => '',
            'meta_key' => '',
            'offset' => 0,
            'order' => 'DESC',
            'orderby' => 'date',
            'post_parent' => false,
            'post_status' => 'publish',
            'ignore_sticky_posts' => 'no',
            'img_size' => '',
            'info' => '' 
        ), $atts, $type );
        $original_atts       = $atts;
        $author              = sanitize_text_field( $atts[ 'author' ] );
        $id                  = $atts[ 'id' ]; // Sanitized later as an array of integers
        $ignore_sticky_posts = ( bool ) ( $atts[ 'ignore_sticky_posts' ] === 'yes' ) ? true : false;
        $meta_key            = sanitize_text_field( $atts[ 'meta_key' ] );
        $offset              = intval( $atts[ 'offset' ] );
        $order               = sanitize_key( $atts[ 'order' ] );
        $orderby             = sanitize_key( $atts[ 'orderby' ] );
        $post_parent         = $atts[ 'post_parent' ];
        $post_status         = $atts[ 'post_status' ];
        $post_type           = sanitize_text_field( $atts[ 'post_type' ] );
        $posts_per_page      = intval( $atts[ 'posts_per_page' ] );
        $tag                 = sanitize_text_field( $atts[ 'tag' ] );
        $tax_operator        = $atts[ 'tax_operator' ];
        $tax_term            = sanitize_text_field( $atts[ 'tax_term' ] );
        $taxonomy            = sanitize_key( $atts[ 'taxonomy' ] );
        // Set up initial query for post
        $args                = array(
             'category_name' => '',
            'order' => $order,
            'orderby' => $orderby,
            'post_type' => explode( ',', $post_type ),
            'posts_per_page' => $posts_per_page,
            'tag' => $tag 
        );
        // Ignore Sticky Posts
        if ( $ignore_sticky_posts )
            $args[ 'ignore_sticky_posts' ] = true;
        // Meta key (for ordering)
        if ( !empty( $meta_key ) )
            $args[ 'meta_key' ] = $meta_key;
        // If Post IDs
        if ( $id ) {
            $posts_in           = array_map( 'intval', explode( ',', $id ) );
            $args[ 'post__in' ] = $posts_in;
        } //$id
        // Post Author
        if ( !empty( $author ) )
            $args[ 'author' ] = $author;
        // Offset
        if ( !empty( $offset ) )
            $args[ 'offset' ] = $offset;
        // Post Status
        $post_status = explode( ', ', $post_status );
        $validated   = array( );
        $available   = array(
             'publish',
            'pending',
            'draft',
            'auto-draft',
            'future',
            'private',
            'inherit',
            'trash',
            'any' 
        );
        foreach ( $post_status as $unvalidated ) {
            if ( in_array( $unvalidated, $available ) )
                $validated[ ] = $unvalidated;
        } //$post_status as $unvalidated
        if ( !empty( $validated ) )
            $args[ 'post_status' ] = $validated;
        // If taxonomy attributes, create a taxonomy query
        if ( !empty( $taxonomy ) && !empty( $tax_term ) ) {
            // Term string to array
            $tax_term = explode( ',', $tax_term );
            // Validate operator
            if ( !in_array( $tax_operator, array(
                 'IN',
                'NOT IN',
                'AND' 
            ) ) )
                $tax_operator = 'IN';
            $tax_args         = array(
                 'tax_query' => array(
                     array(
                         'taxonomy' => $taxonomy,
                        'field' => ( is_numeric( $tax_term[ 0 ] ) ) ? 'id' : 'slug',
                        'terms' => $tax_term,
                        'operator' => $tax_operator 
                    ) 
                ) 
            );
            // Check for multiple taxonomy queries
            $count            = 2;
            $more_tax_queries = false;
            while ( isset( $original_atts[ 'taxonomy_' . $count ] ) && !empty( $original_atts[ 'taxonomy_' . $count ] ) && isset( $original_atts[ 'tax_' . $count . '_term' ] ) && !empty( $original_atts[ 'tax_' . $count . '_term' ] ) ) {
                // Sanitize values
                $more_tax_queries           = true;
                $taxonomy                   = sanitize_key( $original_atts[ 'taxonomy_' . $count ] );
                $terms                      = explode( ', ', sanitize_text_field( $original_atts[ 'tax_' . $count . '_term' ] ) );
                $tax_operator               = isset( $original_atts[ 'tax_' . $count . '_operator' ] ) ? $original_atts[ 'tax_' . $count . '_operator' ] : 'IN';
                $tax_operator               = in_array( $tax_operator, array(
                     'IN',
                    'NOT IN',
                    'AND' 
                ) ) ? $tax_operator : 'IN';
                $tax_args[ 'tax_query' ][ ] = array(
                     'taxonomy' => $taxonomy,
                    'field' => 'slug',
                    'terms' => $terms,
                    'operator' => $tax_operator 
                );
                $count++;
            } //isset( $original_atts['taxonomy_' . $count] ) && !empty( $original_atts['taxonomy_' . $count] ) && isset( $original_atts['tax_' . $count . '_term'] ) && !empty( $original_atts['tax_' . $count . '_term'] )
            if ( $more_tax_queries ):
                $tax_relation = 'AND';
                if ( isset( $original_atts[ 'tax_relation' ] ) && in_array( $original_atts[ 'tax_relation' ], array(
                     'AND',
                    'OR' 
                ) ) )
                    $tax_relation = $original_atts[ 'tax_relation' ];
                $args[ 'tax_query' ][ 'relation' ] = $tax_relation;
            endif;
            $args = array_merge( $args, $tax_args );
        } //!empty( $taxonomy ) && !empty( $tax_term )
        // Fix for pagination
        if ( is_front_page() ) {
            $paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
        } //is_front_page()
        else {
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        }
        $args[ 'paged' ] = $paged;
        // If post parent attribute, set up parent
        if ( $post_parent ) {
            if ( 'current' == $post_parent ) {
                global $post;
                $post_parent = $post->ID;
            } //'current' == $post_parent
            $args[ 'post_parent' ] = intval( $post_parent );
        } //$post_parent
        // Save original posts
        global $posts;
        $original_posts = $posts;
        // Query posts
        $posts          = new WP_Query( $args );
        $posts->info    = $atts;
        // Buffer output
        ob_start();
        // Search for template in stylesheet directory
        if ( file_exists( get_stylesheet_directory() . '/' . $atts[ 'template' ] ) )
            load_template( get_stylesheet_directory() . '/' . $atts[ 'template' ], false );
        // Search for template in theme directory
        elseif ( file_exists( get_template_directory() . '/' . $atts[ 'template' ] ) )
            load_template( get_template_directory() . '/' . $atts[ 'template' ], false );
        // Template not found
        else
            echo esc_attr(esc_attr__( 'template not found', 'pergo' ));
        $output = ob_get_contents();
        ob_end_clean();
        // Return original posts
        $posts = $original_posts;
        // Reset the query
        wp_reset_postdata();
        return $output;
    }
endif;

if ( !function_exists( 'pergo_get_the_slug' ) ):
function pergo_get_the_slug( $id = null ) {
    if ( empty( $id ) ):
        global $post;
        if ( empty( $post ) )
            return ''; // No global $post var available.
        $id = $post->ID;
    endif;
    $slug = basename( get_permalink( $id ) );
    return $slug;
}
endif;

if ( !function_exists( 'pergo_get_the_term_list' ) ):
function pergo_get_the_term_list( $id, $taxonomy, $before = '', $sep = '', $after = '', $name = true ) {
    $terms = get_the_terms( $id, $taxonomy );
    if ( is_wp_error( $terms ) )
        return $terms;
    if ( empty( $terms ) )
        return false;
    $links = array( );
    foreach ( $terms as $term ) {
        $link = get_term_link( $term, $taxonomy );
        if ( is_wp_error( $link ) ) {
            return $link;
        } //is_wp_error( $link )
        $links[ ] = ( $name ) ? $term->name : $term->slug;
    } //$terms as $term
    /**    
    * Filters the term links for a given taxonomy.    
    * @param array $links An array of term links.    
    */
    $term_links = apply_filters( "term_links-$taxonomy", $links );
    return $before . join( $sep, $term_links ) . $after;
}
endif;

if ( !function_exists( 'pergo_compress' ) ):
function pergo_compress($buffer) {
    //Remove CSS comments
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    //Remove tabs, spaces, newlines, etc.
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    return $buffer;
}
endif;

if ( !function_exists( 'pergo_get_intermediate_image_sizes_array' ) ):
function pergo_get_intermediate_image_sizes_array( ) {
    $arr         = array( );
    $image_sizes = get_intermediate_image_sizes();
    foreach ( $image_sizes as $key => $value ) {
        $arr[ $value ] = $value;
    } //$image_sizes as $key => $value
    return $arr;
}
endif;

/**
* Get size information for all currently-registered image sizes.
*
* @global $_wp_additional_image_sizes
* @uses   get_intermediate_image_sizes()
* @return array $sizes Data for all currently-registered image sizes.
*/
if ( !function_exists( 'pergo_get_image_sizes' ) ):
function pergo_get_image_sizes( ) {
    global $_wp_additional_image_sizes;
    $sizes = array( );
    foreach ( get_intermediate_image_sizes() as $_size ) {
        if ( in_array( $_size, array(
             'thumbnail',
            'medium',
            'medium_large',
            'large',
            'full' 
        ) ) ) {
            $sizes[ $_size ][ 'width' ]  = get_option( "{$_size}_size_w" );
            $sizes[ $_size ][ 'height' ] = get_option( "{$_size}_size_h" );
            $sizes[ $_size ][ 'crop' ]   = (bool) get_option( "{$_size}_crop" );
        } //in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) )
        elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array(
                 'width' => $_wp_additional_image_sizes[ $_size ][ 'width' ],
                'height' => $_wp_additional_image_sizes[ $_size ][ 'height' ],
                'crop' => $_wp_additional_image_sizes[ $_size ][ 'crop' ] 
            );
        } //isset( $_wp_additional_image_sizes[ $_size ] )
    } //get_intermediate_image_sizes() as $_size
    return $sizes;
}
endif;

if ( !function_exists( 'pergo_get_image_sizes_Arr' ) ):
function pergo_get_image_sizes_Arr( ) {
    $sizes = pergo_get_image_sizes();
    $arr   = array( 'full' => esc_attr__('Full size', 'pergo') );
    foreach ( $sizes as $key => $value ) {
        $arr[ $key ] = $key . ' - ' . $value[ 'width' ] . 'X' . $value[ 'height' ] . ' - ' . ( ( $value[ 'crop' ] ) ? 'Cropped' : '' );
    } //$sizes as $key => $value
    return $arr;
}
endif;

/**
* Filter callback to add image sizes to Media Uploader
*/
if ( !function_exists( 'pergo_display_image_size_names_muploader' ) ):
function pergo_display_image_size_names_muploader( $sizes ) {
    $new_sizes   = array( );
    $added_sizes = get_intermediate_image_sizes();
    // $added_sizes is an indexed array, therefore need to convert it
    // to associative array, using $value for $key and $value
    foreach ( $added_sizes as $key => $value ) {
        $new_sizes[ $value ] = $value;
    } //$added_sizes as $key => $value
    // This preserves the labels in $sizes, and merges the two arrays
    $new_sizes = array_merge( $new_sizes, $sizes );
    return $new_sizes;
}
endif;
add_filter( 'image_size_names_choose', 'pergo_display_image_size_names_muploader', 11, 1 );


if ( !function_exists( 'pergo_get_image_id' ) ):
function pergo_get_image_id( $image_url ) {
    global $wpdb;
    $attachment = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid='%s';", $image_url ) );
    return isset( $attachment[ 0 ] ) ? $attachment[ 0 ] : false;
}
endif;

/**
* Get size information for a specific image size.
*
* @uses   pergo_get_image_sizes()
* @param  string $size The image size for which to retrieve data.
* @return bool|array $size Size data about an image size or false if the size doesn't exist.
*/
if ( !function_exists( 'pergo_get_image_size' ) ):
function pergo_get_image_size( $size ) {
    $sizes = pergo_get_image_sizes();
    if ( isset( $sizes[ $size ] ) ) {
        return $sizes[ $size ];
    } //isset( $sizes[ $size ] )
    return false;
}
endif;

/**
* Get the width of a specific image size.
*
* @uses   pergo_get_image_size()
* @param  string $size The image size for which to retrieve data.
* @return bool|string $size Width of an image size or false if the size doesn't exist.
*/
if ( !function_exists( 'pergo_get_image_width' ) ):
function pergo_get_image_width( $size ) {
    if ( !$size = pergo_get_image_size( $size ) ) {
        return false;
    } //!$size = pergo_get_image_size( $size )
    if ( isset( $size[ 'width' ] ) ) {
        return $size[ 'width' ];
    } //isset( $size[ 'width' ] )
    return false;
}
endif;

/**
* Get the height of a specific image size.
*
* @uses   get_image_size()
* @param  string $size The image size for which to retrieve data.
* @return bool|string $size Height of an image size or false if the size doesn't exist.
*/
if ( !function_exists( 'pergo_get_image_width' ) ):
function pergo_get_image_height( $size ) {
    if ( !$size = pergo_get_image_size( $size ) ) {
        return false;
    } //!$size = pergo_get_image_size( $size )
    if ( isset( $size[ 'height' ] ) ) {
        return $size[ 'height' ];
    } //isset( $size[ 'height' ] )
    return false;
}
endif;


if ( !function_exists( 'pergo_missing_template_callback' ) ):
function pergo_missing_template_callback(){
  $template_file = 'template-missing.php';
  $args = array(
    'title' => esc_html__( 'Template file is missing', 'pergo' )
  );
  return pergo_buffer_template_file( $template_file , $args );
}
endif;


if( !function_exists('pergo_unit_converter') ){
  function pergo_unit_converter($string, $sunit, $runit, $multiply){      
      preg_match_all("((.\d+)?{$sunit}+)", $string, $matches);
      $matches = array_unique($matches[0]);     
      foreach ($matches as $old) {        
        $number = str_replace($sunit, '', $old) * $multiply;
        $string = str_replace($old, $number.$runit, $string);       
      }
      return $string; 
  }
}

if( !function_exists('pergo_theme_config') ):
function pergo_theme_config(){
  $args = array(
    'theme_options' => pergo_theme_options_std_args(),
    'header' => pergo_header_config_args(),
    'global' => pergo_global_config_args(),
    'widgets_area' => pergo_widgets_area_config_args(),
  );

  $atts = apply_filters( 'pergo_theme_config', array() );

  return array_merge( $args, $atts );
}
endif;


if (!function_exists('pergo_get_option')) {
    function pergo_get_option($option_id, $default = false){
        global $pergo_options;
       
        /* look for the saved value */
        if (isset($pergo_options[$option_id])) {
            return $pergo_options[$option_id];
        }
        return $default;
    }
}

if( !function_exists('pergo_get_config') ):
function pergo_get_config( $id = '', $key = ''  ){
  if( $id == '' ) return false;
  $key = ( $key == '' )?  'theme_options' : $key;

  $args = pergo_theme_config();
  if( !isset($args[$key]) || empty($args[$key]) ) return false;

  $options = $args[$key]; 
  if( !isset($options[$id]) || empty($options[$id]) ) return false;
  
  return $options[$id];
}
endif;

if( !function_exists('pergo_create_safe_attributes') ):
function pergo_create_safe_attributes($header_atts, $args = array()){
  $attributes = array();
  if(empty($header_atts)) return $attributes;


  $header_atts = array_filter($header_atts);
  $wrapper_atts = array();
 
  foreach ($header_atts as $attribute) {
    $attribute = array_filter((array)$attribute);
    if( isset($attribute[0]) && isset($attribute[1]) ){
      $att_value = implode( ' ', array_unique(array_filter(explode(' ', $attribute[1]))));
      $att_key = $attribute[0];
      $wrapper_atts[$att_key] = trim($att_value);
    }    
  }

  if( !empty($args) ){
    $wrapper_atts = _pergo_add_safe_attributes($wrapper_atts, $args);
  }

  $count = 0;
  
  foreach ($wrapper_atts as $key => $value) {
    $attributes[] = (($count == 0)? ' ': '').esc_attr($key) .'="'.esc_attr(trim($value)).'"';
    $count++;
  }

  return $attributes;
}
endif;


if( !function_exists('pergo_get_dark_bg_class') ):
function pergo_get_dark_bg_class($bg = ''){
  $class = '';
  if( $bg != '' ){
    $bg = str_replace('bg-', '', $bg);
    if(_pergo_get_config($bg, 'dark-color' )){
      $class = 'white-color';
    }
  }  
  return $class;
}
endif;

if( !function_exists('pergo_dark_bg_class') ):
function pergo_dark_bg_class($attr, $bg = ''){
  if( $bg != '' ){
   $attr['class'] .= ' '.pergo_get_dark_bg_class($bg);
   
  }
  
  return $attr;
}
endif;


if( !function_exists('pergo_import_json_file_body') ):
function pergo_import_json_file_body($option_name, $url ){
  $request = wp_remote_get( $url );

  // If the remote request fails, wp_remote_get() will return a WP_Error, so let’s check if the $request variable is an error:
  if( is_wp_error( $request ) ) {
      echo esc_attr($request->get_error_message());
  }  

  // Retrieve the data
  $body = wp_remote_retrieve_body( $request );
  $body = json_decode($body, true);  
  delete_option( $option_name );
  if(add_option( $option_name, $body, true )){
      return $option_name. ' - ' . esc_attr__( 'Imported successfully', 'pergo' );
  }else{
    return false;
  }
}
endif;


if( !function_exists('pergo_import_json_callback') ):
add_action( 'wp_ajax_pergo_import_json', 'pergo_import_json_callback' );
function pergo_import_json_callback(){
  $url = esc_url($_POST['file']);
  $option_name = esc_attr($_POST['option_name']);
  
  echo pergo_import_json_file_body($option_name, $url);
  
  wp_die();
}
endif;


if( !function_exists('pergo_find_rules_from_css') ):
function pergo_find_rules_from_css($css = ''){
    $rules = array();
    $css = str_replace("\r", "", $css); // get rid of new lines
  $css = str_replace("\n", "", $css); // get rid of new lines
    // explode() on close curly braces
    // We should be left with stuff like:
    //   span{//whatever
    //   .block{//whatever
    $first = explode('}', $css);


    // If a } didn't exist then we probably don't have a valid CSS file
    if($first){
        // Loop each item
        foreach($first as $v){
            // explode() on the opening curly brace and the ZERO index should be the class declaration or w/e
            $second = explode('{', $v);

            // The final item in $first is going to be empty so we should ignore it
            if(isset($second[0]) && $second[0] !== ''){
                $rules[] = trim($second[0]);
            }
        }
    }
    return $rules;
}
endif;

if( !function_exists('pergo_font_icon_options') ):
function pergo_font_icon_options($css_file, $prefix = '', $substr = 0){
  $options = array();
  $file_path = get_template_directory(). '/' . $css_file;
  $file_url = get_template_directory_uri(). '/' . $css_file;
    if( file_exists($file_path) ){
      $pattern = '/\.('. $prefix .'(?:\w+(?:-)?)+):before\s+{\s*content:\s*"\\\\(.+)";\s+}/';
      $request = wp_remote_get($file_url);
      $subject = wp_remote_retrieve_body( $request );
      
      preg_match_all( $pattern, $subject, $matches, PREG_SET_ORDER );
      
      if( !empty($matches) ){
        foreach ($matches as $match) {
           $class_name = $match[1];           
           $value = substr($class_name, $substr);
           $options[esc_attr($class_name)] = $value;
        }
      }
      
    }
    
    return $options;
}
endif;


if( !function_exists('pergo_image_icon_options') ):
function pergo_image_icon_options($path = '', $substr = 0){
  $options = array();
  
  foreach ( glob( get_template_directory() . "/{$path}*.png" ) as $filename ) {
      if( file_exists($filename) ){
          $key = str_replace(get_template_directory() . "/{$path}", '', $filename);
          $options[$key] = $key;
      }    
  }  
 
  return $options;
}
endif;

if( !function_exists('pergo_css_file_class_options') ):
function pergo_css_file_class_options($css_file, $prefix = '', $postfix = '', $substr = 0){
  $options = array();
  $file_path = get_template_directory(). '/' . $css_file;
  $file_url = get_template_directory_uri(). '/' . $css_file;
    if( file_exists($file_path) ){
      $pattern = '/\.('. $prefix .'(?:\w+(?:-)?)+)\s+{\s*\s+}/';
      $request = wp_remote_get($file_url);      
      $subject = wp_remote_retrieve_body( $request );
    
      $rules = pergo_find_rules_from_css($subject);
      
      
      preg_match_all( $pattern, $subject, $matches, PREG_SET_ORDER );
      
      if( !empty($matches) ){
        foreach ($matches as $match) {
           $class_name = $match[1];           
           $value = substr($class_name, $substr);
           $options[esc_attr($class_name)] = $value;
        }
      }
      
    }  
    return $options;
}
endif;

if( !function_exists('pergo_get_template_parts') ):
function pergo_get_template_parts() { 
    $post_templates = '';

    if ( ! is_array( $post_templates ) ) {
      $post_templates = array();
      $files = (array) wp_get_theme()->get_files( 'php', 3, true );

      foreach ( $files as $file => $full_path ) {  
        $file_url = get_theme_file_uri($file);
        $file_content = function_exists('pergo_modules_file_content')?pergo_modules_file_content($full_path) : ''; 
        if ( ! preg_match( '|Element Name:(.*)$|mi', $file_content, $header ) ) {
          continue;
        }
        

        $types = array( 'element' );
        $file_content = function_exists('pergo_modules_file_content')?pergo_modules_file_content($full_path) : '';
        if ( preg_match( '|Element Type:(.*)$|mi', $file_content, $type ) ) {
          $types = explode( ',', _cleanup_header_comment( $type[1] ) );          
        }

        foreach ( $types as $type ) {
          $type = sanitize_key( $type );
          if (  ! isset( $post_templates[ $type ] ) ) {
            $post_templates[ $type ] = array();
          }


          $post_templates[ $type ][ $file ] = _cleanup_header_comment( $header[1] );
        }
      }

     
    }

    if ( wp_get_theme()->load_textdomain() ) {
      foreach ( $post_templates as &$post_type ) {
        foreach ( $post_type as &$post_template ) {
          $post_template = wp_get_theme()->translate_header( 'Template Name', $post_template );
        }
      }
    }

     

    return $post_templates;
}
endif;

/**
 * Gets the page templates available in this theme.
 *
 * @param WP_Post|null $post      Optional. The post being edited, provided for context.
 * @param string       $post_type Optional. Post type to get the templates for. Default 'page'.
 * @return string[] Array of template file names keyed by the template header name.
 */
if( !function_exists('pergo_get_page_elements') ):
function pergo_get_page_elements( $element_type="list", $default_path = '/', $find='' ) {  
  $find = ($find == '')? $element_type : $find;
  $elements = array();
  if (!function_exists('pergo_modules_file_content')) {
    foreach ( glob( get_template_directory() . "{$default_path}{$element_type}-*.php" ) as $filename ) {
        if( file_exists($filename) ):
          $filename = str_replace(get_template_directory().'/', '', $filename);
          if( strpos($filename, $find) !== false ) $elements[$filename] = $filename;         
        endif;   
    }
    
  }else{
    $templates = pergo_get_template_parts();
    if( !empty($templates) ):
      $templates = $templates[$element_type];    
      if( !empty($templates) ):
        foreach ($templates as $file => $value) {
          $elements[str_replace('template-parts/', '', $file)] = str_replace('{std}', '', $value);
        }
      endif;
    endif;
  }

  return $elements;
}
endif;


if( !function_exists('pergo_get_page_element_std') ):
function pergo_get_page_element_std( $element_type="list", $std = '' ) {  
  $templates = pergo_get_template_parts();
  if( !empty($templates) ):
    $templates = $templates[$element_type];
    foreach ($templates as $file => $template_name) {
      if(strpos($template_name, '{std}')){
          $std = $file;
      }
    }
    $std = str_replace('template-parts/', '', $std);
  endif;
  return $std;
}
endif;

if( !function_exists('pergo_validate_video_url') ):
function pergo_validate_video_url($url = '#'){
  $url_parse = wp_parse_url($url);
  $url = str_replace('watch?v=', 'embed/', $url);
  return $url;
}
endif;

if( !function_exists('pergo_google_map_iframe_output') ):
function pergo_google_map_iframe_output($link, $size){
  if ( '' === $link ) {
    return null;
  }
  $bubble = '';
  $link = trim( vc_value_from_safe( $link ) );
  $bubble = ( '' !== $bubble && '0' !== $bubble ) ? '&amp;iwloc=near' : '';
  $size = str_replace( array(
  'px',
  ' ',
  ), array(
    '',
    '',
  ), $size );

  if ( is_numeric( $size ) ) {
    $link = preg_replace( '/height="[0-9]*"/', 'height="' . $size . '"', $link );
  }

  $output = '';
  if ( preg_match( '/^\<iframe/', $link ) ) {
    $output .= $link;
  } else {
    // TODO: refactor or remove outdated/deprecated attributes that is not mapped in gmaps.
    $output .= '<iframe width="100%" height="' . esc_attr( $size ) . '" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="' . esc_url( $link ) . '&amp;t=' . esc_attr( $type ) . '&amp;z=' . esc_attr( $zoom ) . '&amp;output=embed' . esc_attr( $bubble ) . '"></iframe>';
  }

  return $output;
}
endif;


if( !function_exists('pergo_set_default_mb_values') ):
function pergo_set_default_mb_values($default, $args){

  $output = array();
  foreach ($args as $field) {
        if( isset($field['id']) &&  $field['id'] != '' ){
            $field_id = $field['id'];
            $field['std'] = isset($default[$field_id])? $default[$field_id] : '';
        }
        $output[] =  $field;  
    }

    return $output;
}
endif;

if( !function_exists('pergo_balancetags') ):
function pergo_balancetags( $text ) {
    $tagstack  = array();
    $stacksize = 0;
    $tagqueue  = '';
    $newtext   = '';
    // Known single-entity/self-closing tags.
    $single_tags = array( 'area', 'base', 'basefont', 'br', 'col', 'command', 'embed', 'frame', 'hr', 'img', 'input', 'isindex', 'link', 'meta', 'param', 'source' );
    // Tags that can be immediately nested within themselves.
    $nestable_tags = array( 'blockquote', 'div', 'object', 'q', 'span' );
 
    // WP bug fix for comments - in case you REALLY meant to type '< !--'.
    $text = str_replace( '< !--', '<    !--', $text );
    // WP bug fix for LOVE <3 (and other situations with '<' before a number).
    $text = preg_replace( '#<([0-9]{1})#', '&lt;$1', $text );
 
    /**
     * Matches supported tags.
     *
     * To get the pattern as a string without the comments paste into a PHP
     * REPL like `php -a`.   
     * @example
     * ~# php -a
     * php > $s = [paste copied contents of expression below including parentheses];
     * php > echo $s;
     */
    $tag_pattern = (
        '#<' . // Start with an opening bracket.
        '(/?)' . // Group 1 - If it's a closing tag it'll have a leading slash.
        '(' . // Group 2 - Tag name.
            // Custom element tags have more lenient rules than HTML tag names.
            '(?:[a-z](?:[a-z0-9._]*)-(?:[a-z0-9._-]+)+)' .
                '|' .
            // Traditional tag rules approximate HTML tag names.
            '(?:[\w:]+)' .
        ')' .
        '(?:' .
            // We either immediately close the tag with its '>' and have nothing here.
            '\s*' .
            '(/?)' . // Group 3 - "attributes" for empty tag.
                '|' .
            // Or we must start with space characters to separate the tag name from the attributes (or whitespace).
            '(\s+)' . // Group 4 - Pre-attribute whitespace.
            '([^>]*)' . // Group 5 - Attributes.
        ')' .
        '>#' // End with a closing bracket.
    );
 
    while ( preg_match( $tag_pattern, $text, $regex ) ) {
        $full_match        = $regex[0];
        $has_leading_slash = ! empty( $regex[1] );
        $tag_name          = $regex[2];
        $tag               = strtolower( $tag_name );
        $is_single_tag     = in_array( $tag, $single_tags, true );
        $pre_attribute_ws  = isset( $regex[4] ) ? $regex[4] : '';
        $attributes        = trim( isset( $regex[5] ) ? $regex[5] : $regex[3] );
        $has_self_closer   = '/' === substr( $attributes, -1 );
 
        $newtext .= $tagqueue;
 
        $i = strpos( $text, $full_match );
        $l = strlen( $full_match );
 
        // Clear the shifter.
        $tagqueue = '';
        if ( $has_leading_slash ) { // End tag.
            // If too many closing tags.
            if ( $stacksize <= 0 ) {
                $tag = '';
                // Or close to be safe $tag = '/' . $tag.
 
                // If stacktop value = tag close value, then pop.
            } elseif ( $tagstack[ $stacksize - 1 ] === $tag ) { // Found closing tag.
                $tag = '</' . $tag . '>'; // Close tag.
                array_pop( $tagstack );
                $stacksize--;
            } else { // Closing tag not at top, search for it.
                for ( $j = $stacksize - 1; $j >= 0; $j-- ) {
                    if ( $tagstack[ $j ] === $tag ) {
                        // Add tag to tagqueue.
                        for ( $k = $stacksize - 1; $k >= $j; $k-- ) {
                            $tagqueue .= '</' . array_pop( $tagstack ) . '>';
                            $stacksize--;
                        }
                        break;
                    }
                }
                $tag = '';
            }
        } else { // Begin tag.
            if ( $has_self_closer ) { // If it presents itself as a self-closing tag...
                // ...but it isn't a known single-entity self-closing tag, then don't let it be treated as such
                // and immediately close it with a closing tag (the tag will encapsulate no text as a result).
                if ( ! $is_single_tag ) {
                    $attributes = trim( substr( $attributes, 0, -1 ) ) . "></$tag";
                }
            } elseif ( $is_single_tag ) { // Else if it's a known single-entity tag but it doesn't close itself, do so.
                $pre_attribute_ws = ' ';
                $attributes      .= '/';
            } else { // It's not a single-entity tag.
                // If the top of the stack is the same as the tag we want to push, close previous tag.
                if ( $stacksize > 0 && ! in_array( $tag, $nestable_tags, true ) && $tagstack[ $stacksize - 1 ] === $tag ) {
                    $tagqueue = '</' . array_pop( $tagstack ) . '>';
                    $stacksize--;
                }
                $stacksize = array_push( $tagstack, $tag );
            }
 
            // Attributes.
            if ( $has_self_closer && $is_single_tag ) {
                // We need some space - avoid <br/> and prefer <br />.
                $pre_attribute_ws = ' ';
            }
 
            $tag = '<' . $tag . $pre_attribute_ws . $attributes . '>';
            // If already queuing a close tag, then put this tag on too.
            if ( ! empty( $tagqueue ) ) {
                $tagqueue .= $tag;
                $tag       = '';
            }
        }
        $newtext .= substr( $text, 0, $i ) . $tag;
        $text     = substr( $text, $i + $l );
    }
 
    // Clear tag queue.
    $newtext .= $tagqueue;
 
    // Add remaining text.
    $newtext .= $text;
 
    while ( $x = array_pop( $tagstack ) ) {
        $newtext .= '</' . $x . '>'; // Add remaining tags to close.
    }
 
    // WP fix for the bug with HTML comments.
    $newtext = str_replace( '< !--', '<!--', $newtext );
    $newtext = str_replace( '<    !--', '< !--', $newtext );
 
    return $newtext;
}
endif;

add_action( 'wp_ajax_pergo_content_search_replace', 'pergo_content_search_replace_callback' );
if( !function_exists('pergo_content_search_replace_callback') ):
function pergo_content_search_replace_callback(){
  $results = '';
  $ids = $_POST['ids'];
  $search = $_POST['search'];
  $replace = $_POST['replace'];

  if($search == '') wp_die();
  if($replace == '') wp_die();
  if(empty($ids)) wp_die();

  $encode_search =  urlencode( $search);
  $encode_replace =  urlencode( $replace);
  foreach ($ids as $post_id) {
      $post = get_post($post_id);
      $content = $post->post_content;
      $total_founds = substr_count($content, $search);
      $total_founds += substr_count($content, $encode_search);

      if( $total_founds > 0 ):
        // Search
        $content = str_replace($search, $replace, $content);
        $content = str_replace($encode_search, $encode_replace, $content);

        $my_post = array(
            'ID'           => $post_id,
            'post_content' => $content,
        );     

          wp_update_post( $my_post );
          $results .= '<p>'.sprintf(esc_attr__( '%s items replace successfully for %s', 'pergo' ), $total_founds, $post->post_title).'</p>';
      else:
        $results .= '<p>'.sprintf(esc_attr__( 'Nothing founds to replace for %s', 'pergo' ), $post->post_title).'</p>';
      endif;

  }

 
  echo '<div id="message" class="updated pergo-message">';
  echo '<a class="welcome-panel-close" href="#" aria-label="Dismiss the panel">Dismiss</a>';
  echo do_shortcode($results);
  echo '</div>';
  
  
  wp_die();
}
endif;