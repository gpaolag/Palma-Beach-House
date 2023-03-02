<?php
/**
* Insert Headers and Footers Class
*/
class PerchInsertHeadersAndFooters {
	/**
	* Constructor
	*/
	public function __construct() {

		// Plugin Details
        $this->plugin               = new stdClass;
        $this->plugin->name         = 'perch-header-footer-scripts'; // Plugin Folder
        $this->plugin->displayName  = 'Headers & Footers scripts'; // Plugin Name
        $this->plugin->version      = '1.4.6';
        $this->plugin->folder       = __DIR__;
        $this->plugin->url          = plugins_url( 'header-and-footer-scripts', PERCH_MODULES_PLUGIN );
        $this->plugin->db_welcome_dismissed_key = $this->plugin->name . '_welcome_dismissed_key';
        $this->body_open_supported	= function_exists( 'wp_body_open' ) && version_compare( get_bloginfo( 'version' ), '5.2' , '>=' );
        

		// Hooks
		add_action( 'admin_init', array( &$this, 'registerSettings' ) );
        add_action( 'admin_menu', array( &$this, 'adminPanelsAndMetaBoxes' ) );
        add_action( 'admin_notices', array( &$this, 'dashboardNotices' ) );
        add_action( 'wp_ajax_' . $this->plugin->name . '_dismiss_dashboard_notices', array( &$this, 'dismissDashboardNotices' ) );

        // Frontend Hooks
        add_action( 'wp_head', array( &$this, 'frontendHeader' ) );
		add_action( 'wp_footer', array( &$this, 'frontendFooter' ) );
		if ( $this->body_open_supported ) {
			add_action( 'wp_body_open', array( &$this, 'frontendBody' ), 1 );
		}
	}

    /**
     * Show relevant notices for the plugin
     */
    function dashboardNotices() {
        global $pagenow;
        $parent_page = apply_filters( 'perch_modules/header_footer_scripts_parent_page', 'options-general.php' );
        if ( !get_option( $this->plugin->db_welcome_dismissed_key ) ) {
        	if ( ! ( $pagenow == $parent_page && isset( $_GET['page'] ) && $_GET['page'] == 'perch-header-footer-scripts' ) ) {
	            $setting_page = admin_url( $parent_page. '?page=' . $this->plugin->name );
	            // load the notices view
                include_once( $this->plugin->folder . '/views/dashboard-notices.php' );
        	}
        }
    }

    /**
     * Dismiss the welcome notice for the plugin
     */
    function dismissDashboardNotices() {
    	check_ajax_referer( $this->plugin->name . '-nonce', 'nonce' );
        // user has dismissed the welcome notice
        update_option( $this->plugin->db_welcome_dismissed_key, 1 );
        exit;
    }

	/**
	* Register Settings
	*/
	function registerSettings() {
		register_setting( $this->plugin->name, 'perch_ihaf_insert_header', 'trim' );
		register_setting( $this->plugin->name, 'perch_ihaf_insert_footer', 'trim' );
		register_setting( $this->plugin->name, 'perch_ihaf_insert_body', 'trim' );
	}

	/**
    * Register the plugin settings panel
    */
    function adminPanelsAndMetaBoxes() {
    	$parent_page = apply_filters( 'perch_modules/header_footer_scripts_parent_page', 'options-general.php' );
    	add_submenu_page( $parent_page, $this->plugin->displayName, $this->plugin->displayName, 'manage_options', $this->plugin->name, array( &$this, 'adminPanel' ) );
	}

    /**
    * Output the Administration Panel
    * Save POSTed data from the Administration Panel into a WordPress option
    */
    function adminPanel() {
		// only admin user can access this page
		if ( !current_user_can( 'administrator' ) ) {
			echo '<p>' . __( 'Sorry, you are not allowed to access this page.', 'perch' ) . '</p>';
			return;
		}

    	// Save Settings
        if ( isset( $_REQUEST['submit'] ) ) {
        	// Check nonce
			if ( !isset( $_REQUEST[$this->plugin->name.'_nonce'] ) ) {
	        	// Missing nonce
	        	$this->errorMessage = __( 'nonce field is missing. Settings NOT saved.', 'perch' );
        	} elseif ( !wp_verify_nonce( $_REQUEST[$this->plugin->name.'_nonce'], $this->plugin->name ) ) {
	        	// Invalid nonce
	        	$this->errorMessage = __( 'Invalid nonce specified. Settings NOT saved.', 'perch' );
        	} else {
	        	// Save
				// $_REQUEST has already been slashed by wp_magic_quotes in wp-settings
				// so do nothing before saving
	    		update_option( 'perch_ihaf_insert_header', $_REQUEST['perch_ihaf_insert_header'] );
	    		update_option( 'perch_ihaf_insert_footer', $_REQUEST['perch_ihaf_insert_footer'] );
				update_option( 'perch_ihaf_insert_body', isset( $_REQUEST['perch_ihaf_insert_body'] ) ? $_REQUEST['perch_ihaf_insert_body'] : '' );
				update_option( $this->plugin->db_welcome_dismissed_key, 1 );
				$this->message = __( 'Settings Saved.', 'perch' );
			}
        }

        // Get latest settings
        $this->settings = array(
			'perch_ihaf_insert_header' => esc_html( wp_unslash( get_option( 'perch_ihaf_insert_header' ) ) ),
			'perch_ihaf_insert_footer' => esc_html( wp_unslash( get_option( 'perch_ihaf_insert_footer' ) ) ),
			'perch_ihaf_insert_body' => esc_html( wp_unslash( get_option( 'perch_ihaf_insert_body' ) ) ),
        );

    	// Load Settings Form
        include_once( $this->plugin->folder . '/views/settings.php' );
    }

   
	/**
	* Outputs script / CSS to the frontend header
	*/
	function frontendHeader() {
		$this->output( 'perch_ihaf_insert_header' );
	}

	/**
	* Outputs script / CSS to the frontend footer
	*/
	function frontendFooter() {
		$this->output( 'perch_ihaf_insert_footer' );
	}

	/**
	* Outputs script / CSS to the frontend below opening body
	*/
	function frontendBody() {
		$this->output( 'perch_ihaf_insert_body' );
	}

	/**
	* Outputs the given setting, if conditions are met
	*
	* @param string $setting Setting Name
	* @return output
	*/
	function output( $setting ) {
		// Ignore admin, feed, robots or trackbacks
		if ( is_admin() || is_feed() || is_robots() || is_trackback() ) {
			return;
		}

		// provide the opportunity to Ignore IHAF - both headers and footers via filters
		if ( apply_filters( 'disable_perch_ihaf', false ) ) {
			return;
		}

		// provide the opportunity to Ignore IHAF - footer only via filters
		if ( 'perch_ihaf_insert_footer' == $setting && apply_filters( 'disable_perch_ihaf_footer', false ) ) {
			return;
		}

		// provide the opportunity to Ignore IHAF - header only via filters
		if ( 'perch_ihaf_insert_header' == $setting && apply_filters( 'disable_perch_ihaf_header', false ) ) {
			return;
		}

		// provide the opportunity to Ignore IHAF - below opening body only via filters
		if ( 'perch_ihaf_insert_body' == $setting && apply_filters( 'disable_perch_ihaf_body', false ) ) {
			return;
		}

		// Get meta
		$meta = get_option( $setting );
		if ( empty( $meta ) ) {
			return;
		}
		if ( trim( $meta ) == '' ) {
			return;
		}

		// Output
		echo wp_unslash( $meta );
	}
}

$perch_ihaf = new PerchInsertHeadersAndFooters();