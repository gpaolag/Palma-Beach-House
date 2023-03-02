<?php
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );
function perch_get_server_database_version() {
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
function perch_let_to_num( $size ) {
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
function perch_get_server_system_status(){
  global $wpdb;

    // Figure out cURL version, if installed.
    $curl_version = '';
    if ( function_exists( 'curl_version' ) ) {
      $curl_version = curl_version();
      $curl_version = $curl_version['version'] . ', ' . $curl_version['ssl_version'];
    }

    // WP memory limit.
    $wp_memory_limit = perch_let_to_num( WP_MEMORY_LIMIT );
    if ( function_exists( 'memory_get_usage' ) ) {
      $wp_memory_limit = max( $wp_memory_limit, perch_let_to_num( @ini_get( 'memory_limit' ) ) );
    }

    

    $database_version = perch_get_server_database_version();

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
      'php_post_max_size'         => perch_let_to_num( ini_get( 'post_max_size' ) ),
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
function pergo_get_server_invironment( $type= '' ){

    $environment      = perch_get_server_system_status();
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
      if ( version_compare( $environment['php_version'], '5.6', '>=' ) ) {
         return '<mark class="yes"><span class="dashicons dashicons-yes"></span>' . esc_html( $environment['php_version'] ) . '</mark>';         
      }else{
        return '<mark class="no"><span class="dashicons dashicons-warning"></span>' . esc_html( $environment['php_version'] ) . '</mark>';
      }      
    }  
 
}

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
    <li>PHP version (minimam 5.6+) '.pergo_get_server_invironment("php_version").'</li> 
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
add_filter( 'pt-ocdi/plugin_intro_text', 'pergo_intro_text' );

function pergo_import_demo_data() {

  return array(    
    array(
      'import_file_name'           => '01 - Startup Agency',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-1.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/startup-agency',
    ),
    array(
      'import_file_name'           => '02 - Design Studio',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-2.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/design-studio',
    ),
    array(
      'import_file_name'           => '03 - Web Design Agency',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-3.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/web-design-agency',
    ),
    array(
      'import_file_name'           => '04 - Business Agency',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-4.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/business-agency',
    ),
    array(
      'import_file_name'           => '05 - Startup 1',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-5.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/startup-1',
    ),
    array(
      'import_file_name'           => '06 - Business Consultancy',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-6.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/business-consultancy',
    ),
    array(
      'import_file_name'           => '07 - Creative Agency',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-7.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/creative-agency',
    ),
    array(
      'import_file_name'           => '08 - App Showcase',
      'categories'                 => array( 'App', 'Landing pages' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-8.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/app-showcase',
    ),
    array(
      'import_file_name'           => '09 - Innovation Agency',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-9.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/innovation-agency',
    ),
    array(
      'import_file_name'           => '10 - Freelancer 1',
      'categories'                 => array( 'Freelancer', 'Landing pages' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-10.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/freelancer-1',
    ),
    array(
      'import_file_name'           => '11 - Marketing Agency',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-11.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/marketing-agency',
    ),
    array(
      'import_file_name'           => '12 - Designer Portfolio',
      'categories'                 => array( 'Freelancer', 'Landing pages' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-12.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/designer-portfolio',
    ),
    array(
      'import_file_name'           => '13 - Creative Business',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-13.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/creative-business',
    ),
    array(
      'import_file_name'           => '14 - Digital Agency',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-14.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/digital-agency',
    ),
    array(
      'import_file_name'           => '15 - Branding Agency',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-15.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/branding-agency',
    ),
    array(
      'import_file_name'           => '16 - Freelancer 2',
      'categories'                 => array( 'Freelancer', 'Landing pages' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-16.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/freelancer-2',
    ),
    array(
      'import_file_name'           => '17 - Startup 2',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-17.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/startup-2',
    ),
    array(
      'import_file_name'           => '18 - Classic Business',
      'categories'                 => array( 'Landing pages' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-18.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/classic-business',
    ),
    array(
      'import_file_name'           => '19 – Medical & Health',
      'categories'                 => array( 'Landing pages', 'New' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-19.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/medical-health/',
    ),
    array(
      'import_file_name'           => '20 – Event & Conference',
      'categories'                 => array( 'Landing pages', 'New' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-20.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/20-event-conference/',
    ),
    array(
      'import_file_name'           => '21 – E-Book',
      'categories'                 => array( 'Landing pages', 'New' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-21.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/21-e-book/',
    ),
    array(
      'import_file_name'           => '22 – Lawyer',
      'categories'                 => array( 'Landing pages', 'New' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-22.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/lawyer/',
    ),
    array(
      'import_file_name'           => '23 – Construction',
      'categories'                 => array( 'Landing pages', 'New' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-23.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/23-construction/',
    ),
    array(
      'import_file_name'           => '24 – Insurance',
      'categories'                 => array( 'Landing pages', 'New' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-24.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/24-insurance/',
    ),
    array(
      'import_file_name'           => '25 – Product Showcase',
      'categories'                 => array( 'Landing pages', 'New' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-25.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/25-product-showcase/',
    ),
    array(
      'import_file_name'           => '26 – Hosting',
      'categories'                 => array( 'Landing pages', 'New' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-26.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/26-hosting/',
    ),
    array(
      'import_file_name'           => '28 – Consulting',
      'categories'                 => array( 'Landing pages', 'New' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-27.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/28-consulting/',
    ),
    array(
      'import_file_name'           => '29 – Interior Design',
      'categories'                 => array( 'Landing pages', 'New' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-28.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/29-interior-design/',
    ),
    array(
      'import_file_name'           => '30 - Multipage demo',
      'categories'                 => array( 'Multi pages' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets.wie',
       
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-multi.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/demos/',
    ),
    array(
      'import_file_name'           => '31 - Shop Multipage demo',
      'categories'                 => array( 'Multi pages' ),
      'import_file_url'            => PERGO_URI.'/admin/demo-data/demo-content-woo.xml',
      'import_widget_file_url'     => PERGO_URI.'/admin/demo-data/widgets2.wie',
      'import_customizer_file_url' => PERGO_URI.'/admin/demo-data/customizer2.dat', 
      'import_preview_image_url'   => 'http://jthemes.org/wp/pergo/assests/images/layout-shop.jpg',
      'preview_url'                => 'http://jthemes.org/wp/pergo/woo/',
    ),

    

  );

}

add_filter( 'pt-ocdi/import_files', 'pergo_import_demo_data' );


function pergo_after_import_setup() {
  // Assign menus to their locations.
  $primary = get_term_by( 'name', 'Header menu', 'nav_menu' );

  set_theme_mod( 'nav_menu_locations', array(
        'primary' => $primary->term_id,
        //'footer' => $footer->term_id,
      )
  );

  // Assign front page and posts page (blog page).
  $front_page_id = get_page_by_title( 'Home' );
  $blog_page_id  = get_page_by_title( 'Blog' );

  update_option( 'show_on_front', 'page' );
  update_option( 'page_on_front', $front_page_id->ID );
  update_option( 'page_for_posts', $blog_page_id->ID );

  pergo_set_clean_content_by_post_type('page', array(
      'search' => 'http://jthemes.org/wp/pergo/demos/wp-content/themes/pergo',
      'replace' => get_template_directory_uri(),
    ));
}
add_action( 'pt-ocdi/after_import', 'pergo_after_import_setup' );

function pergo_after_import( $selected_import ) {

 
  $array = array(
    '01 - Startup Agency', '02 - Design Studio', '03 - Web Design Agency', '04 - Business Agency',
    '05 - Startup 1', '06 - Business Consultancy', '07 - Creative Agency', '08 - App Showcase',
    '09 - Innovation Agency', '10 - Freelancer 1', '11 - Marketing Agency', '12 - Designer Portfolio',
    '13 - Creative Business', '14 - Digital Agency', '15 - Branding Agency', '16 - Freelancer 2',
    '17 - Startup 2', '18 - Classic Business', '19 – Medical & Health', '20 – Event & Conference',
    '21 – E-Book', '22 – Lawyer', '23 – Construction', '24 – Insurance', '25 – Product Showcase',
    '26 – Hosting', '28 – Consulting', '29 – Interior Design'
  );

  foreach ($array as $key => $value) {
    $pagename = trim($value);
    if ( $pagename === $selected_import['import_file_name'] ) {
        $front_page_id = get_page_by_title( $pagename );
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $front_page_id->ID );
    }
  }
  


  $pagename = '30 - Multipage demo';
  if ( $pagename === $selected_import['import_file_name'] ) {
      $front_page_id = get_page_by_title( '00 – Home' );
      update_option( 'show_on_front', 'page' );
      update_option( 'page_on_front', $front_page_id->ID );
  }

  $pagename = '31 - Shop Multipage demo';
  if ( $pagename === $selected_import['import_file_name'] ) {
      $front_page_id = get_page_by_title( '00 – Home' );
      update_option( 'show_on_front', 'page' );
      update_option( 'page_on_front', $front_page_id->ID );

      //woocommerce setup
      $shop_page  = get_page_by_title( 'Shop' );
      $cart_page  = get_page_by_title( 'Cart' );
      $checkout_page  = get_page_by_title( 'Checkout' );
      $account_page  = get_page_by_title( 'My account' );
      $privacy_page  = get_page_by_title( 'Privacy Policy' );
      update_option( 'woocommerce_shop_page_id', $shop_page->ID );
      update_option( 'woocommerce_cart_page_id', $cart_page->ID );
      update_option( 'woocommerce_checkout_page_id', $checkout_page->ID );
      update_option( 'woocommerce_myaccount_page_id', $account_page->ID );
      update_option( 'woocommerce_terms_page_id', $privacy_page->ID );
  }
  
  
}
//pt-ocdi/after_import
add_action( 'pt-ocdi/after_import', 'pergo_after_import' );
