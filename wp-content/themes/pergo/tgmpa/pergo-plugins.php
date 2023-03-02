<?php
require_once get_template_directory() . '/tgmpa/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'pergo_register_required_plugins' );

if( !function_exists('pergo_register_required_plugins') ):
function pergo_register_required_plugins( ) {
    $plugins = array(
        // This is an example of how to include a plugin bundled with a theme.
         array(
             'name' => __( 'Visual Composer', 'pergo' ), // The plugin name.
            'slug' => 'js_composer', // The plugin slug (typically the folder name).
            'source' => get_template_directory() . '/tgmpa/plugins/js_composer-6.7.0.zip', // The plugin source.
            'required' => true,
            'version' => '6.7.0',
            'force_activation' => false, 
            'force_deactivation' => false, 
            'external_url' => '', 
            'is_callable' => '' 
        ),
        array(
             'name' => __( 'Pergo extends', 'pergo' ), // The plugin name.
            'slug' => 'perch_modules', // The plugin slug (typically the folder name).
            'source' => get_template_directory() . '/tgmpa/plugins/perch_modules.zip', // The plugin source.
            'required' => true,
            'version' => '1.0.6',
            'force_activation' => false, 
            'force_deactivation' => false, 
            'external_url' => '', 
            'is_callable' => '' 
        ),  
        array(
             'name' => __( 'Convert Plus', 'pergo' ), // The plugin name.
            'slug' => 'convertplug', // The plugin slug (typically the folder name).
            'source' => get_template_directory() . '/tgmpa/plugins/convertplug-3.5.23.zip', // The plugin source.
            'required' => 0,
            'version' => '3.5.23',
            'force_activation' => 0, 
            'force_deactivation' => 0, 
            'external_url' => '', 
            'is_callable' => '' 
        ),       
        array(
             'name' => __( 'Pergo post types & shortcodes', 'pergo' ), // The plugin name.
            'slug' => 'zpergo_modules', // The plugin slug (typically the folder name).
            'source' => get_template_directory() . '/tgmpa/plugins/zpergo_modules.zip', // The plugin source.
            'required' => true,
            'version' => '1.4',
            'force_activation' => false,
            'force_deactivation' => false 
        ), 
        array(
             'name' => __( 'Envato market', 'pergo' ), // The plugin name.
            'slug' => 'envato-market', // The plugin slug (typically the folder name).
            'source' => get_template_directory() . '/tgmpa/plugins/envato-market.zip', // The plugin source.
            'required' => false,
            'version' => '2.0.3',
            'force_activation' => false,
            'force_deactivation' => false 
        ),
        array(
             'name' => __( 'Domain checker', 'pergo' ), // The plugin name.
            'slug' => 'wp-domain-checker', // The plugin slug (typically the folder name).
            'source' => get_template_directory() . '/tgmpa/plugins/wp-domain-checker-5.0.4.zip', // The plugin source.
            'required' => false,
            'version' => '5.0.4',
            'force_activation' => false,
            'force_deactivation' => false 
        ),
        array(
             'name' => __( 'Slider revoulation', 'pergo' ), // The plugin name.
            'slug' => 'revslider', // The plugin slug (typically the folder name).
            'source' => get_template_directory() . '/tgmpa/plugins/revslider-6.5.8.zip', // The plugin source.
            'required' => false,
            'version' => '6.5.8',
            'force_activation' => false,
            'force_deactivation' => false 
        ), 
        array(
             'name' => __( 'Pergo Megamenu', 'pergo' ),
            'slug' => 'cool-responsive-mega-menu',
            'required' => true 
        ),
        array(
             'name' => __( 'Contact Form 7', 'pergo' ),
            'slug' => 'contact-form-7',
            'required' => true 
        ),
        array(
             'name' => __( 'Breadcrumb NavXT', 'pergo' ),
            'slug' => 'breadcrumb-navxt',
            'required' => true 
        ),
        array(
             'name' => __( 'Email Subscription', 'pergo' ),
            'slug' => 'email-subscribers',
            'required' => true 
        ),        
        array(
             'name' => __( 'One Click Demo Import', 'pergo' ),
            'slug' => 'one-click-demo-import',
            'required' => false 
        ),
        array(
             'name' => esc_attr__( 'Loco Translate', 'pergo' ),
            'slug' => 'loco-translate',
            'required' => false 
        ), 
        array(
            'name' => esc_attr__( 'Control Block Patterns', 'pergo' ),
            'slug' => 'control-block-patterns',
            'required' => false 
        ),
    );
    $config  = array(
         'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug' => 'themes.php', // Parent menu slug.
        'capability' => 'edit_theme_options', 
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '' // Message to output right before the plugins table.
    );
    tgmpa( $plugins, $config );
}
endif;

add_filter( 'ocdi/register_plugins', 'pergo_ocdi_register_plugins');
function pergo_ocdi_register_plugins(){
     return array(  

          array(
               'name' => __( 'Visual Composer', 'pergo' ), // The plugin name.
               'slug' => 'js_composer', // The plugin slug (typically the folder name).
               'source' => get_template_directory() . '/tgmpa/plugins/js_composer-6.7.0.zip', // The plugin source.
               'required' => true,
               'preselected' => true
          ),
          array(
               'name' => __( 'Pergo extends', 'pergo' ), // The plugin name.
               'slug' => 'perch_modules', // The plugin slug (typically the folder name).
               'source' => get_template_directory() . '/tgmpa/plugins/perch_modules.zip', // The plugin source.
               'required' => true, 
               'preselected' => true
          ), 
          array(
               'name' => esc_attr__( 'Contact Form 7', 'pergo' ),
               'slug' => 'contact-form-7',
               'required' => true,
               'preselected' => true
          ),
          array(
               'name' => esc_attr__( 'Breadcrumb NavXT', 'pergo' ),
               'slug' => 'breadcrumb-navxt',
               'required' => true,
               'preselected' => true 
          ),                       

          array(
               'name' => esc_attr__( 'Woocommerce', 'pergo' ),
               'slug' => 'woocommerce',
               'required' => false 
          ),

          array(
               'name' => esc_attr__( 'Woocommerce quick view', 'pergo' ),
               'slug' => 'yith-woocommerce-quick-view',
               'required' => false 
          ),
          array(
               'name' => esc_attr__( 'Woocommerce wishlist', 'pergo' ),
               'slug' => 'yith-woocommerce-wishlist',
               'required' => false 
          ),          
     );
}