<?php
namespace ControlPatterns\Patterns;


class Directory{
    public function __construct() {
    	$this->init();
        add_action( 'admin_menu', array(&$this, 'admin_menu') );
        add_action( 'admin_enqueue_scripts', array(&$this, 'admin_enqueue') );  
    }

    public function init(){    	
		add_action( 'cbp_install_patterns_new', 'cbp_display_patterns_new' );
    }

    public function patterns_new(){    	
    	cbp_display_patterns_new();    	
    }
    
    public function query_patterns(){
    	require_once __DIR__ . '/directory/includes/pattern.php';
		cbp_query_patterns();		
    }

    private function register_categories() {
    	$terms = get_terms( array(
		    'taxonomy' => 'block_pattern_category',
		    'hide_empty' => true,
		));
		$categories = [];
		if( !empty($terms) ){
			foreach ($terms as $key => $term) {	
				$categories[$term->slug] = (array)$term;
			}
		}
		return $categories;
    }

    public function remote_categories(){
    	$remote_categories = get_option( 'cbp_remote_categories', array() );
    	if( empty($remote_categories) ){
    		$url = 'https://wordpress.org/patterns/wp-json/wp/v2/pattern-categories';
	    	$response   = wp_remote_get( $url );
	    	if ( is_array( $response ) && ! is_wp_error( $response ) ) {
				$remote_categories = json_decode( wp_remote_retrieve_body( $response ), true );
				update_option('cbp_remote_categories', $remote_categories);
			}
    	}
    	
		return $remote_categories;
    }


    public function categories(){ 		
    	return $this->remote_categories();    	
    }

    /**
	 * Display tags filter for themes.
	 *
	 * @since 2.8.0
	 */
	function directory_patterns_dashboard() {
		install_pattern_search_form( false );
		?>
			<h4><?php _e( 'Feature Filter' ); ?></h4>
			<p class="install-help"><?php _e( 'Find a theme based on specific features.' ); ?></p>

			<form method="get">
				<input type="hidden" name="tab" value="search" />
				<?php
				$feature_list = get_theme_feature_list();
				echo '<div class="feature-filter">';

				foreach ( (array) $feature_list as $feature_name => $features ) {
					$feature_name = esc_html( $feature_name );
					echo '<div class="feature-name">' . $feature_name . '</div>';

					echo '<ol class="feature-group">';
					foreach ( $features as $feature => $feature_name ) {
						$feature_name = esc_html( $feature_name );
						$feature      = esc_attr( $feature );
						?>

			<li>
				<input type="checkbox" name="features[]" id="feature-id-<?php echo $feature; ?>" value="<?php echo $feature; ?>" />
				<label for="feature-id-<?php echo $feature; ?>"><?php echo $feature_name; ?></label>
			</li>

			<?php	} ?>
			</ol>
			<br class="clear" />
					<?php
				}
				?>

			</div>
			<br class="clear" />
				<?php submit_button( __( 'Find Themes' ), '', 'search' ); ?>
			</form>
		<?php
	}

    

    /**
     * Register submenu
     * @return void
     */
    public function admin_menu() {
        add_submenu_page( 
        	'edit.php?post_type=ctrl_block_patterns',
            esc_html__( 'Patterns Directory', 'control-block-patterns' ),
            esc_html__( 'Directory', 'control-block-patterns' ),
            'manage_options', 
            'directory', 
            array(&$this, 'display_page')
        );
        
    }
 
    /**
     * Render display_page
     * @return void
     */
    public function display_page() {
    	if ( ! $this->is_screen() )
			return;

		include __DIR__ . '/directory/pattern-install.php';     
    }


    public function admin_enqueue() {
    	
		if ( ! $this->is_screen() ) {
			return;
		}
		wp_enqueue_code_editor( [ 'type' => 'application/x-httpd-php' ] );
		// Load admin styles.
		wp_enqueue_style( 'directory-css', CTRLBP_CSS_URI . 'directory.css', false, CTRLBP_VER );
		wp_enqueue_script( 'updates' );

		wp_enqueue_script( 'cbp-updates', CTRLBP_JS_URI . 'updates.js', [ 'wp-backbone' ], CTRLBP_VER, true );
		wp_enqueue_script( 'ctrl-pattern-directory', CTRLBP_JS_URI . 'directory.js', [ 'code-editor', 'underscore', 'wp-element', 'wp-backbone', 'wp-a11y', 'customize-base', 'cbp-updates' ], CTRLBP_VER, true );
		
		wp_localize_script( 'ctrl-pattern-directory', 'CBPAdmin', [
			'nonce' => wp_create_nonce('cbp-ajax-nonce'),
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'confirmReset'        => esc_html__( 'Are you sure to reset the template to the default?', 'control-block-patterns' ),
			'confirmCancel'       => esc_html__( 'Are you sure to cancel customizing the template? You\'ll loose all the custom changes and will use the default template.', 'control-block-patterns' ),
			'clickOnDisabledText' => esc_html__( 'You have already customized the template. Please cancel the customization before selecting another style.', 'control-block-patterns' ),
			'components'          => [
				'content'        => esc_html__( 'Content', 'control-block-patterns' ),
				'name'           => esc_html__( 'Author Name', 'control-block-patterns' ),
				'image'          => esc_html__( 'Author Image', 'control-block-patterns' ),
				'position'       => esc_html__( 'Author Position', 'control-block-patterns' ),
				'subject_rating' => esc_html__( 'Subject and Rating', 'control-block-patterns' ),
				'subject'        => esc_html__( 'Subject', 'control-block-patterns' ),
				'rating'         => esc_html__( 'Rating', 'control-block-patterns' ),
				'review_link'    => esc_html__( 'Review Link', 'control-block-patterns' ),
			],
		] );

		wp_localize_script(
			'ctrl-pattern-directory',
			'_cbpSettings',
			array(
				'themes'          => [],
				'settings'        => array(
					'isInstall'  => true,
					'canInstall' => current_user_can( 'install_themes' ),
					'installURI' => current_user_can( 'install_themes' ) ? self_admin_url( 'admin.php?page=directory' ) : null,
					'adminUrl'   => parse_url( self_admin_url(), PHP_URL_PATH ),
					'pageURL' => 'edit.php?post_type=ctrl_block_patterns&page=directory'
				),
				'l10n'            => array(
					'addNew'              => __( 'Add New Pattern' ),
					'search'              => __( 'Search Patterns' ),
					'searchPlaceholder'   => __( 'Search Patterns...' ), // Placeholder (no ellipsis).
					'upload'              => __( 'Upload Pattern' ),
					'back'                => __( 'Back' ),
					'error'               => sprintf(
						/* translators: %s: Support forums URL. */
						__( 'An unexpected error occurred. Something may be wrong with WordPress.org or this server&#8217;s configuration. If you continue to have problems, please try the <a href="%s">support forums</a>.' ),
						__( 'https://senseflame.com/support/forums/' )
					),
					'tryAgain'            => __( 'Try Again' ),
					/* translators: %d: Number of themes. */
					'themesFound'         => __( 'Number of Pattern found: %d' ),
					'noThemesFound'       => __( 'No themes found. Try a different search.' ),
					'collapseSidebar'     => __( 'Collapse Sidebar' ),
					'expandSidebar'       => __( 'Expand Sidebar' ),
					/* translators: Accessibility text. */
					'selectFeatureFilter' => __( 'Select one or more Theme features to filter by' ),
				),
				'installedThemes' => array(),
				'activeTheme'     => NULL,
			)
		);
	}

	
	private function is_screen() {
		return 'ctrl_block_patterns_page_directory' === get_current_screen()->id;
	}
   
}
