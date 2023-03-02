<?php
namespace ControlPatterns\Settings;

class SettingsPage {
	private $args;
	public $page_hook;
	protected $type;

	public function __construct( $args = [] ) {
		$this->args = $args;
		$this->register_hooks();
	}

	protected function register_hooks() {
		add_action( 'admin_menu', array( $this, 'register_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'settings_export' ) );
		add_action( 'admin_init', array( $this, 'reset_action' ) );
		add_action( 'wp_ajax_import_settings_data', [ $this, 'import_settings_data' ] );
		add_action( 'wp_ajax_ctrlbp_reset_settings_page', [ $this, 'reset_settings_page' ] );
		
	}

	public function register_admin_menu() {
		// Add top level menu.
		if ( ! $this->parent ) {
			$this->page_hook = add_menu_page(
				$this->page_title,
				$this->menu_title,
				$this->capability,
				$this->id,
				array( $this, 'show' ),
				$this->icon_url,
				$this->position
			);

			// If this menu has a default sub-menu.
			if ( $this->submenu_title ) {
				add_submenu_page(
					$this->id,
					$this->page_title,
					$this->submenu_title,
					$this->capability,
					$this->id,
					array( $this, 'show' )
				);
			}
		} // Add sub-menu.
		else {
			$this->page_hook = add_submenu_page(
				$this->parent,
				$this->page_title,
				$this->menu_title,
				$this->capability,
				$this->id,
				array( $this, 'show' )
			);
		}

		// Enqueue scripts and styles.
		add_action( "admin_print_styles-{$this->page_hook}", array( $this, 'enqueue' ) );

		// Load action.
		add_action( "load-{$this->page_hook}", array( $this, 'load' ) );
		add_action( "load-{$this->page_hook}", array( $this, 'add_help_tabs' ) );
		add_action( "load-{$this->page_hook}", array( $this, 'add_admin_notice_hook' ) );
	}

	public function show() {		
		?>
		<div class="<?php echo esc_attr( $this->settings_class() ) ?>">
			<h1><?= esc_html( get_admin_page_title() ) ?></h1>
			<form method="post" action="" enctype="multipart/form-data" id="post" class="ctrlbp-settings-form">
			<?php 
				if( $this->header ){
					$this->output_header(); 
				}
			?>
			<div class="ctrlbp-settings-wrap">
				
				<?php $this->output_tab_nav() ?>

				<div class="ctrlbp-settings-form-wrap">
					
						<div id="poststuff">
							<?php
							// Nonce for saving meta boxes status (collapsed/expanded) and order.
							wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false );
							wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false );
							?>
							<div id="post-body" class="metabox-holder columns-<?= intval( $this->columns ); ?>">
								<?php if ( $this->columns > 1 ) : ?>
									<div id="postbox-container-1" class="postbox-container">
										<?php do_meta_boxes( null, 'side', null ); ?>
									</div>
								<?php endif; ?>
								<div id="postbox-container-2" class="postbox-container">
									<?php do_meta_boxes( null, 'normal', null ); ?>
									<?php do_meta_boxes( null, 'advanced', null ); ?>
								</div>
							</div>
							<br class="clear">
							
						</div>
					
				</div>
			</div>			
								
			<?php $this->output_buttons(); ?>
			
			</form>
		</div>
		<?php
		
	}

	private function settings_class(){
		$class = [
			'wrap',
			"ctrlbp-settings-{$this->style}",
			$this->class,
		];
		
		if ( $this->tabs ) {
			$class[] = "ctrlbp-settings-tabs-{$this->tab_style}";
		}
		if( $this->header ){
			$class[] = "ctrlbp-admin-custom-header";
		}
		if( $this->theme ){
			$class[] = 'ctrlbp-admin-theme';
			$class[] =  !is_bool($this->theme)? "ctrlbp-admin-theme-".esc_attr($this->theme) : '';
		}
		$class = array_unique(array_filter($class));
		return join(' ', $class);
	}

	private function output_buttons(){	
		$reset_url = add_query_arg( [
			'reset' => 'all',
			'_nonce' => wp_create_nonce( 'ctrlbp-reset' )
		] );
		
		?>
		<div class="submit-buttons py-3">
			<?php submit_button( esc_html( $this->submit_button ), 'primary', 'submit', false ); ?>
			<button type="button" class="button button-danger ctrlbp-reset-settings"><?php echo esc_attr('Reset Settings', 'control-block-patterns') ?></button>
			<?php do_action( 'ctrlbp_settings_page_submit_buttons' ); ?>
		</div>
		<?php
		
	}

	public function reset_action(){		
		if( empty($_REQUEST['reset']) || empty($_REQUEST['_nonce']) ) return;
		
		$nonce = $_REQUEST['_nonce'];
		if(($_REQUEST['reset'] == 'all') && wp_verify_nonce( $nonce, 'ctrlbp-reset' )){	
			update_option($this->args['option_name'], $this->get_std($this->args['option_name']));
			remove_query_arg( ['reset', '_nonce'] );		
			if ( wp_safe_redirect( htmlspecialchars_decode(menu_page_url($this->id, false)) ) ) {
				exit;
			}		
		}		
	}

	public function settings_export(){
		$action  = isset( $_REQUEST['action'] ) && 'ctrlbp-settings-export' === $_REQUEST['action'];
		if ( ! $action)  {
			return;
		}
		$file_name = $_REQUEST['id'];

	
		$func          = false !== $this->network ? 'get_site_option' : 'get_option';
		$options = $func( $_REQUEST['id'] );
		$data = json_encode( $options, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT );

		header( 'Content-Type: application/octet-stream' );
		header( "Content-Disposition: attachment; filename=$file_name.json" );
		header( 'Expires: 0' );
		header( 'Cache-Control: must-revalidate' );
		header( 'Pragma: public' );
		header( 'Content-Length: ' . strlen( $data ) );
		echo $data;
		die;
	}

	private function output_header(){
		$default = array(
			'icon' => '',
            'title' => 'Control block Patterns',
            'subtitle' => '',
            'version' => CTRLBP_VER,
            'buttons' => false
		);
		extract(wp_parse_args( $this->header, $default ));
		?>
		<header class="py-3 px-5 rounded-top bg-dark text-white">
			<div class="ctrlbp-row d-flex">
				<div class="ctrlbp-col-12">
					<div class="d-flex align-items-end">
						<h3 class="fs-1 fw-bolder text-white mb-0"><?php echo esc_attr($title) ?></h3>
						<span class="ms-1 px-2 badge rounded-pill bg-primary"><?php echo esc_attr($version) ?></span>
					</div>
					<p><?php echo esc_attr($subtitle) ?></p>
				</div>				          
			</div>			
		</header>
		<?php if( $buttons ): ?>
			<div class="header-buttons text-end bg-white border px-3 my-1">					
				<?php $this->output_buttons(); ?>
			</div>      
		<?php endif; ?>	
		<?php
		do_action( 'control-block-patterns/settings/header/'.$this->id );
	}

	private function output_tab_nav() {
		if ( ! $this->tabs ) {
			return;
		}
		echo '<h2 class="nav-tab-wrapper">';
		foreach ( $this->tabs as $id => $tab ) {
			if ( is_string( $tab ) ) {
				$tab = ['label' => $tab];
			}
			$tab = wp_parse_args( $tab, [
				'icon'  => '',
				'label' => '',
			] );

			if ( filter_var( $tab['icon'], FILTER_VALIDATE_URL ) ) { // If icon is an URL.
				$icon = '<img src="' . esc_url( $tab['icon'] ) . '">';
			} else { // If icon is icon font.
				// If icon is dashicons, auto add class 'dashicons' for users.
				if ( false !== strpos( $tab['icon'], 'dashicons' ) ) {
					$tab['icon'] .= ' dashicons';
				}
				// Remove duplicate classes.
				$tab['icon'] = array_filter( array_map( 'trim', explode( ' ', $tab['icon'] ) ) );
				$tab['icon'] = implode( ' ', array_unique( $tab['icon'] ) );

				$icon = $tab['icon'] ? '<i class="' . esc_attr( $tab['icon'] ) . '"></i>' : '';
			}

			printf( '<a href="#tab-%s" class="nav-tab">%s%s</a>', esc_attr( $id ), $icon, esc_html( $tab['label'] ) );
		}
		echo '</h2>';
	}

	public function enqueue() {

		$version = WP_DEBUG? time() : CTRLBP_VER;
		wp_enqueue_style( 'control-block-patterns', CTRLBP_CSS_URI . 'settings.css', '', $version );
		if( $this->theme ){
			wp_enqueue_style( 'ctrlbp-admin-theme', CTRLBP_CSS_URI . 'admin-theme.css', '', $version );
		}

		// For meta boxes.
		wp_enqueue_script( 'common' );
		wp_enqueue_script( 'wp-lists' );
		wp_enqueue_script( 'postbox' );

		// Enqueue settings page script and style.
		wp_enqueue_script( 'control-block-patterns-settings', CTRLBP_JS_URI . 'settings.js', array( 'jquery' ), $version, true );
		wp_localize_script( 'control-block-patterns-settings', 'CTRLBPSettingsPage', array(
			'tabs'     => array_keys( $this->tabs ),
			'nonce'     => wp_create_nonce( 'ctrlbp-settings-page' ),
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'option_name' => $this->option_name,
			'option_id' => $this->id,
			'confirm_text' => esc_attr__( 'Are you sure want to reset all?', 'control-block-patterns' ),
		));
	}

	public function load() {
		$this->args['is_imported'] = $this->import();

		/**
		 * Custom hook runs when current page loads. Use this to add meta boxes and filters.
		 *
		 * @param array $page_args The page arguments
		 */
		do_action( 'ctrlbp_settings_page_load', $this->args );
	}

	public function add_admin_notice_hook() {
		if ( ! $this->parent || 'options-general.php' !== $this->parent ) {
			add_action( 'admin_notices', 'settings_errors' );
		}
	}

	public function add_help_tabs() {
		if ( ! $this->help_tabs || ! is_array( $this->help_tabs ) ) {
			return;
		}
		$screen = get_current_screen();
		foreach ( $this->help_tabs as $k => $help_tab ) {
			// Auto generate help tab ID if missed.
			if ( empty( $help_tab['id'] ) ) {
				$help_tab['id'] = "{$this->id}-help-tab-$k";
			}
			$screen->add_help_tab( $help_tab );
		}
	}

	protected function import() {
		$get_func    = 'get_option';
		$update_func = 'update_option';

		$option_name = $this->args['option_name'];

		$new = ctrlbp_request()->post( "{$option_name}_backup" );
		$new = wp_unslash( $new );
		$old = $get_func( $option_name );
		$old = json_encode( $old );
		if ( ! $new || $old === $new ) {
			return false;
		}
		$option = json_decode( $new, true );
		if ( json_last_error() === JSON_ERROR_NONE ) {
			$update_func( $option_name, $option );
		}
		return true;
	}

	public function __get( $name ) {
		return isset( $this->args[ $name ] ) ? $this->args[ $name ] : null;
	}

	private function get_std( $option_name ){
		$field_registry = ctrlbp_get_registry( 'field' );
		$fields = $field_registry->get_by_object_type( 'setting' );
		$option_fields = $fields[$option_name];

		$setting_ids = array_keys($option_fields);

		$std = [];
		foreach( $setting_ids as $setting_id ){
			if(isset($option_fields[$setting_id]['std'])){
				$std[$setting_id] = $option_fields[$setting_id]['std'];
			}
			else{
				$std[$setting_id] = null;
			}
		}
		return $std; 
	}

	public function reset_settings_page(){
		if( !wp_verify_nonce( $_POST['nonce'], 'ctrlbp-settings-page' ) ){
			wp_die(false);
		}
		$option_name = $_POST['option_name'];
		$options = $this->get_std($option_name);
		update_option( $option_name, $options, true );

		wp_die(esc_attr__('Settings options reset successfully', 'control-block-patterns'));
	}

	public function import_settings_data(){
		if(isset($_POST)){
			$get_func    = 'network' === $this->type ? 'get_site_option' : 'get_option';
			$update_func = 'network' === $this->type ? 'update_site_option' : 'update_option';
			

			
			$option_name = $_POST['option_name'];
			$nonce = $_POST['nonce'];
			if( !wp_verify_nonce( $nonce, 'ctrlbp-import' ) ){
				wp_die(esc_attr__('Nothing to update', 'control-block-patterns'));
			}
			
			$new = wp_unslash($_POST['import_data']);
			$old = $get_func( $option_name );
			$old = json_encode( $old, JSON_PRETTY_PRINT );		



			if ( ! $new || $old === $new ) {
				wp_die(esc_attr__('Nothing to update', 'control-block-patterns'));
			}
			$options = array_filter(json_decode( $new, true ));
			
			$similar_ids = count(array_intersect_key($this->get_std($option_name), $options));
			if( $similar_ids <= 0){
				wp_die(esc_attr__('Nothing to update.', 'control-block-patterns'));
			}			
			

			if ( json_last_error() === JSON_ERROR_NONE ) {
				$update_func( $option_name, $options );
				wp_die(esc_attr__('Settings options imported successfully', 'control-block-patterns'));
			}
		}

		wp_die();
	}
}
