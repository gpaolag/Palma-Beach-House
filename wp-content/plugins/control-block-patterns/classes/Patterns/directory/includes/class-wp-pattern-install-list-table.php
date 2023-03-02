<?php
/**
 * List Table API: WP_Theme_Install_List_Table class
 *
 * @package WordPress
 * @subpackage Administration
 * @since 3.1.0
 */

/**
 * Core class used to implement displaying themes to install in a list table.
 *
 * @since 3.1.0
 * @access private
 *
 * @see WP_Themes_List_Table
 */
class CTRLBP_List_Table extends WP_List_Table{

	protected $search_terms = array();
	public $features = array();

	/**
	 * Constructor.
	 *
	 * @since 3.1.0
	 *
	 * @see WP_List_Table::__construct() for more information on default arguments.
	 *
	 * @param array $args An associative array of arguments.
	 */
	public function __construct( $args = array() ) {
		parent::__construct(
			array(
				'ajax'   => true,
				'screen' => isset( $args['screen'] ) ? $args['screen'] : null,
			)
		);
	}


	/**
	 * @return bool
	 */
	public function ajax_user_can() {
		// Do not check edit_theme_options here. Ajax calls for available themes require switch_themes.
		return current_user_can( 'switch_themes' );
	}

	/**
	 * @return array
	 */
	public function get_columns() {
		return array();
	}


	/**
	 * @global array  $tabs
	 * @global string $tab
	 * @global int    $paged
	 * @global string $type
	 * @global array  $theme_field_defaults
	 */
	public function prepare_items() {
		

		global $tabs, $tab, $paged, $type, $theme_field_defaults;
		wp_reset_vars( array( 'tab' ) );

		$search_terms  = array();
		$search_string = '';
		if ( ! empty( $_REQUEST['s'] ) ) {
			$search_string = strtolower( wp_unslash( $_REQUEST['s'] ) );
			$search_terms  = array_unique( array_filter( array_map( 'trim', explode( ',', $search_string ) ) ) );
		}

		if ( ! empty( $_REQUEST['features'] ) ) {
			$this->features = $_REQUEST['features'];
		}


		$paged = $this->get_pagenum();

		$per_page = 9;

		// These are the tabs which are shown on the page,
		$tabs              = array();
		$tabs['new']     = _x( 'Latest', 'themes' );
		$tabs['dashboard'] = __( 'Search' );
		if ( 'search' === $tab ) {
			$tabs['search'] = __( 'Search Results' );
		}
		$tabs['upload']   = __( 'Upload' );
		$tabs['featured'] = _x( 'Featured', 'themes' );
		//$tabs['popular']  = _x( 'Popular', 'themes' );
		
		$tabs['updated'] = _x( 'Recently Updated', 'themes' );

		$nonmenu_tabs = array( 'theme-information' ); // Valid actions to perform which do not have a Menu item.

		

	

		// If a non-valid menu tab has been selected, And it's not a non-menu action.
		if ( empty( $tab ) || ( ! isset( $tabs[ $tab ] ) && ! in_array( $tab, (array) $nonmenu_tabs, true ) ) ) {
			$tab = key( $tabs );
		}

		$args = array(
			'page'     => $paged,
			'per_page' => $per_page,
			'fields'   => $theme_field_defaults,
		);

		

		switch ( $tab ) {
			case 'search':
				$type = isset( $_REQUEST['type'] ) ? wp_unslash( $_REQUEST['type'] ) : 'term';
				switch ( $type ) {
					case 'tag':
						$args['tag'] = array_map( 'sanitize_key', $search_terms );
						break;
					case 'term':
						$args['search'] = $search_string;
						break;
					case 'author':
						$args['author'] = $search_string;
						break;
				}

				if ( ! empty( $this->features ) ) {
					$args['tag']      = $this->features;
					$_REQUEST['s']    = implode( ',', $this->features );
					$_REQUEST['type'] = 'tag';
				}

				add_action( 'install_themes_table_header', 'install_theme_search_form', 10, 0 );
				break;

			case 'featured':
				// case 'popular':
			case 'new':
			case 'updated':
				$args['browse'] = $tab;
				break;

			default:
				$args = false;
				break;
		}





		/**
		 * Filters API request arguments for each Install Themes screen tab.
		 *
		 * The dynamic portion of the hook name, `$tab`, refers to the theme install
		 * tab.
		 *
		 * Possible hook names include:
		 *
		 *  - `install_themes_table_api_args_dashboard`
		 *  - `install_themes_table_api_args_featured`
		 *  - `install_themes_table_api_args_new`
		 *  - `install_themes_table_api_args_search`
		 *  - `install_themes_table_api_args_updated`
		 *  - `install_themes_table_api_args_upload`
		 *
		 * @since 3.7.0
		 *
		 * @param array|false $args Theme install API arguments.
		 */
		$args = apply_filters( "install_patterns_table_api_args_{$tab}", $args );

		if ( ! $args ) {
			return;
		}

		$patterns = (array)cbp_patterns_api( 'cbp_query_patterns', $args );

		$per_page = 18;
		$page     = $this->get_pagenum();

		$start = ( $page - 1 ) * $per_page;

		$this->items = array_slice( $patterns, $start, $per_page, true );

		
		

		$this->set_pagination_args(
			array(
				'total_items'     => count($patterns),
				'per_page'        => $args['per_page'],
				'infinite_scroll' => true,
			)
		);
	}

	/**
	 */
	public function no_items() {
		_e( 'No Block Pattern match your request.' );
	}

	/**
	 * @global array $tabs
	 * @global string $tab
	 * @return array
	 */
	protected function get_views() {
		global $tabs, $tab;

		$display_tabs = array();
		foreach ( (array) $tabs as $action => $text ) {
			$current_link_attributes                    = ( $action === $tab ) ? ' class="current" aria-current="page"' : '';
			$href                                       = self_admin_url( 'theme-install.php?tab=' . $action );
			$display_tabs[ 'theme-install-' . $action ] = "<a href='$href'$current_link_attributes>$text</a>";
		}

		return $display_tabs;
	}

	/**
	 * Displays the theme install table.
	 *
	 * Overrides the parent display() method to provide a different container.
	 *
	 * @since 3.1.0
	 */
	public function display() {
		
		
		wp_nonce_field( 'fetch-list-patterns_ajax_fetch_list_nonce' );
		?>
		<div class="tablenav top themes">
			<div class="alignleft actions">
				<?php
				/**
				 * Fires in the Install Themes list table header.
				 *
				 * @since 2.8.0
				 */
				do_action( 'install_themes_table_header' );
				?>
			</div>
			<?php //$this->pagination( 'top' ); ?>
			<br class="clear" />
		</div>

		<div id="availablethemes">
			<?php $this->display_rows_or_placeholder(); ?>
		</div>

		<?php
		$this->tablenav( 'bottom' );
	}

	/**
	 */
	public function display_rows() {
		$themes = $this->items;

		foreach ( $themes as $theme ) {
			?>
				<div class="available-theme installable-theme">
				<?php
					$this->single_row( $theme );
				?>
				</div>
			<?php
		} // End foreach $theme_names.

		$this->theme_installer();
	}

	/**
	 */
	public function display_rows_or_placeholder() {
		if ( $this->has_items() ) {
			
		} else {
			echo '<div class="no-items">';
			$this->no_items();
			echo '</div>';
		}
	}

	/**
	 * Prints a theme from the WordPress.org API.
	 *
	 * @since 3.1.0
	 *
	 * @global array $themes_allowedtags
	 *
	 * @param object $theme {
	 *     An object that contains theme data returned by the WordPress.org API.
	 *
	 *     @type string $name           Theme name, e.g. 'Twenty Twenty-One'.
	 *     @type string $slug           Theme slug, e.g. 'twentytwentyone'.
	 *     @type string $version        Theme version, e.g. '1.1'.
	 *     @type string $author         Theme author username, e.g. 'melchoyce'.
	 *     @type string $preview_url    Preview URL, e.g. 'https://2021.wordpress.net/'.
	 *     @type string $screenshot_url Screenshot URL, e.g. 'https://wordpress.org/themes/twentytwentyone/'.
	 *     @type float  $rating         Rating score.
	 *     @type int    $num_ratings    The number of ratings.
	 *     @type string $homepage       Theme homepage, e.g. 'https://wordpress.org/themes/twentytwentyone/'.
	 *     @type string $description    Theme description.
	 *     @type string $download_link  Theme ZIP download URL.
	 * }
	 */
	public function single_row( $pattern ) {
		global $patterns_allowedtags;

		if ( empty( $pattern ) ) {
			return;
		}

		$name   = wp_kses( $pattern['name'], $patterns_allowedtags );
		$author = wp_kses( $pattern['author'], $patterns_allowedtags );
		$slug = $pattern['slug'];
		$screenshot_url = $pattern['screenshot'];

		/* translators: %s: Theme name. */
		$preview_title = sprintf( __( 'Preview &#8220;%s&#8221;' ), $name );
		$preview_url   = add_query_arg(
			array(
				'tab'   => 'pattern-information',
				'theme' => $pattern['id'],
			),
			self_admin_url( 'theme-install.php' )
		);

		$actions = array();

		$install_url = add_query_arg(
			array(
				'action' => 'insert-pattern',
				'theme'  => $pattern['id'],
			),
			self_admin_url( 'update.php' )
		);

		$update_url = add_query_arg(
			array(
				'action' => 'upgrade-pattern',
				'theme'  => $pattern['slug'],
			),
			self_admin_url( 'update.php' )
		);

		$status = $this->_get_theme_status( $pattern );

		switch ( $status ) {
			case 'update_available':
				$actions[] = sprintf(
					'<a class="install-now" href="%s" title="%s">%s</a>',
					esc_url( wp_nonce_url( $update_url, 'upgrade-theme_' . $theme->slug ) ),
					/* translators: %s: Theme version. */
					esc_attr( sprintf( __( 'Update to version %s' ), $theme->version ) ),
					__( 'Update' )
				);
				break;
			case 'newer_installed':
			case 'latest_installed':
				$actions[] = sprintf(
					'<span class="install-now" title="%s">%s</span>',
					esc_attr__( 'This theme is already installed and is up to date' ),
					_x( 'Installed', 'theme' )
				);
				break;
			case 'install':
			default:
				$actions[] = sprintf(
					'<a class="install-now" href="%s" title="%s">%s</a>',
					esc_url( wp_nonce_url( $install_url, 'install-theme_' . $slug ) ),
					/* translators: %s: Theme name. */
					esc_attr( sprintf( _x( 'Install %s', 'theme' ), $name ) ),
					__( 'Install Now' )
				);
				break;
		}

		$actions[] = sprintf(
			'<a class="install-theme-preview" href="%s" title="%s">%s</a>',
			esc_url( $preview_url ),
			/* translators: %s: Theme name. */
			esc_attr( sprintf( __( 'Preview %s' ), $name ) ),
			__( 'Preview' )
		);

		/**
		 * Filters the install action links for a theme in the Install Themes list table.
		 *
		 * @since 3.4.0
		 *
		 * @param string[] $actions An array of theme action links. Defaults are
		 *                          links to Install Now, Preview, and Details.
		 * @param WP_Theme $theme   Theme object.
		 */
		$actions = apply_filters( 'pattern_install_actions', $actions, $pattern );

		?>
		<a class="screenshot install-theme-preview" href="<?php echo esc_url( $preview_url ); ?>" title="<?php echo esc_attr( $preview_title ); ?>">
			<img src="<?php echo esc_url( $screenshot_url ); ?>" width="150" alt="" />
		</a>

		<h3><?php echo $name; ?></h3>
		<div class="theme-author">
		<?php
			/* translators: %s: Theme author. */
			printf( __( 'By %s' ), $author );
		?>
		</div>

		<div class="action-links">
			<ul>
				<?php foreach ( $actions as $action ) : ?>
					<li><?php echo $action; ?></li>
				<?php endforeach; ?>
				<li class="hide-if-no-js"><a href="#" class="theme-detail"><?php _e( 'Details' ); ?></a></li>
			</ul>
		</div>

		<?php
		$this->install_theme_info( $pattern );
	}

	/**
	 * Prints the wrapper for the theme installer.
	 */
	public function theme_installer() {
		?>
		<div id="theme-installer" class="wp-full-overlay expanded" style="display: none;">
			<div class="wp-full-overlay-sidebar">
				<div class="wp-full-overlay-header">
					<a href="#" class="close-full-overlay button"><?php _e( 'Close' ); ?></a>
					<span class="theme-install"></span>
				</div>
				<div class="wp-full-overlay-sidebar-content">
					<div class="install-theme-info"></div>
				</div>redi
				<div class="wp-full-overlay-footer">
					<button type="button" class="collapse-sidebar button" aria-expanded="true" aria-label="<?php esc_attr_e( 'Collapse Sidebar' ); ?>">
						<span class="collapse-sidebar-arrow"></span>
						<span class="collapse-sidebar-label"><?php _e( 'Collapse' ); ?></span>
					</button>
				</div>
			</div>
			<div class="wp-full-overlay-main"></div>
		</div>
		<?php
	}

	/**
	 * Prints the wrapper for the theme installer with a provided theme's data.
	 * Used to make the theme installer work for no-js.
	 *
	 * @param object $theme - A WordPress.org Theme API object.
	 */
	public function theme_installer_single( $pattern ) {
		?>
		<div id="theme-installer" class="wp-full-overlay single-theme">
			<div class="wp-full-overlay-sidebar">
				<?php $this->install_theme_info( $pattern ); ?>
			</div>			
		</div>
		<?php
	}

	/**
	 * Prints the info for a theme (to be used in the theme installer modal).
	 *
	 * @global array $themes_allowedtags
	 *
	 * @param object $theme - A WordPress.org Theme API object.
	 */
	public function install_theme_info( $pattern ) {
		global $patterns_allowedtags;

		if ( empty( $pattern ) ) {
			return;
		}

		$name   = wp_kses( $pattern['name'], $patterns_allowedtags );
		$author = wp_kses( $pattern['author'], $patterns_allowedtags );
		$slug = $pattern['slug'];
		$version = $pattern['version'];

		$install_url = add_query_arg(
			array(
				'action' => 'install-theme',
				'theme'  => $slug,
			),
			self_admin_url( 'update.php' )
		);

		$update_url = add_query_arg(
			array(
				'action' => 'upgrade-theme',
				'theme'  => $slug,
			),
			self_admin_url( 'update.php' )
		);

		$status = $this->_get_theme_status( $pattern );

		?>
		<div class="install-theme-info">
		<?php
		switch ( $status ) {
			case 'update_available':
				printf(
					'<a class="theme-install button button-primary" href="%s" title="%s">%s</a>',
					esc_url( wp_nonce_url( $update_url, 'upgrade-theme_' . $slug ) ),
					/* translators: %s: Theme version. */
					esc_attr( sprintf( __( 'Update to version %s' ), $version ) ),
					__( 'Update' )
				);
				break;
			case 'newer_installed':
			case 'latest_installed':
				printf(
					'<span class="theme-install" title="%s">%s</span>',
					esc_attr__( 'This theme is already installed and is up to date' ),
					_x( 'Installed', 'theme' )
				);
				break;
			case 'install':
			default:
				printf(
					'<a class="theme-install button button-primary" href="%s">%s</a>',
					esc_url( wp_nonce_url( $install_url, 'install-theme_' . $slug ) ),
					__( 'Install' )
				);
				break;
		}
		?>
			<h3 class="theme-name"><?php echo $name; ?></h3>
			<span class="theme-by">
			<?php
				/* translators: %s: Theme author. */
				printf( __( 'By %s' ), $author );
			?>
			</span>
			<?php if ( isset( $pattern['screenshot_url'] ) ) : ?>
				<img class="theme-screenshot" src="<?php echo esc_url( $pattern['screenshot_url'] ); ?>" alt="" />
			<?php endif; ?>
			<div class="theme-details">
				<?php
				wp_star_rating(
					array(
						'rating' => null,
						'type'   => 'percent',
						'number' => null,
					)
				);
				?>
				<div class="theme-version">
					<strong><?php _e( 'Version:' ); ?> </strong>
					<?php echo wp_kses( $pattern['version'], $patterns_allowedtags ); ?>
				</div>
				<div class="theme-description">
					<?php echo wp_kses( $pattern['description'], $patterns_allowedtags ); ?>
				</div>
			</div>
			<input class="theme-preview-url" type="hidden" value="<?php echo esc_url( $pattern['preview_url'] ); ?>" />
		</div>
		<?php
	}

	/**
	 * Send required variables to JavaScript land
	 *
	 * @since 3.4.0
	 *
	 * @global string $tab  Current tab within Themes->Install screen
	 * @global string $type Type of search.
	 *
	 * @param array $extra_args Unused.
	 */
	public function _js_vars( $extra_args = array() ) {
		global $tab, $type;
		parent::_js_vars( compact( 'tab', 'type' ) );
	}

	/**
	 * Check to see if the theme is already installed.
	 *
	 * @since 3.4.0
	 *
	 * @param object $theme - A WordPress.org Theme API object.
	 * @return string Theme status.
	 */
	private function _get_theme_status( $pattern ) {
		$status = '';


		return $status;
	}

	/**
	 * An internal method that sets all the necessary pagination arguments
	 *
	 * @since 3.1.0
	 *
	 * @param array|string $args Array or string of arguments with information about the pagination.
	 */
	protected function set_pagination_args( $args ) {
		$args = wp_parse_args(
			$args,
			array(
				'total_items' => 0,
				'total_pages' => 0,
				'per_page'    => 0,
			)
		);

		if ( ! $args['total_pages'] && $args['per_page'] > 0 ) {
			$args['total_pages'] = ceil( $args['total_items'] / $args['per_page'] );
		}

		// Redirect if page number is invalid and headers are not already sent.
		if ( ! headers_sent() && ! wp_doing_ajax() && $args['total_pages'] > 0 && $this->get_pagenum() > $args['total_pages'] ) {
			wp_redirect( add_query_arg( 'paged', $args['total_pages'] ) );
			exit;
		}

		$this->_pagination_args = $args;
	}

	/**
	 * Access the pagination args.
	 *
	 * @since 3.1.0
	 *
	 * @param string $key Pagination argument to retrieve. Common values include 'total_items',
	 *                    'total_pages', 'per_page', or 'infinite_scroll'.
	 * @return int Number of items that correspond to the given pagination argument.
	 */
	public function get_pagination_arg( $key ) {
		if ( 'page' === $key ) {
			return $this->get_pagenum();
		}

		if ( isset( $this->_pagination_args[ $key ] ) ) {
			return $this->_pagination_args[ $key ];
		}
	}

	
}
