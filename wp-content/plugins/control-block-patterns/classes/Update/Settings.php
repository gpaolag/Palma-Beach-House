<?php
namespace ControlPatterns\Update;
/**
 * This class handles plugin settings, including adding settings page, show fields, save settings
 * Control Block Patterns Update Settings class
 * 
 * @package ControlPatterns
 */

class Settings {
	/**
	 * The update option object.
	 *
	 * @var object
	 */
	private $option;

	/**
	 * The update checker object
	 *
	 * @var object
	 */
	private $checker;

	/**
	 * Constructor.
	 *
	 * @param object $checker Update checker object.
	 * @param object $option  Update option object.
	 */
	public function __construct( $checker, $option ) {
		$this->checker = $checker;
		$this->option  = $option;
	}

	/**
	 * Add hooks to create the settings page.
	 */
	public function init() {
		// Whether to enable Control Block Patterns menu. Priority 1 makes sure it runs before adding Control Block Patterns menu.
		$admin_menu_hook = $this->option->is_network_activated() ? 'network_admin_menu' : 'admin_menu';
		add_action( $admin_menu_hook, array( $this, 'enable_menu' ), 1 );
	}

	/**
	 * Enable Control Block Patterns menu when a premium extension is installed.
	 */
	public function enable_menu() {
		if ( ! $this->checker->has_extensions() ) {
			return;
		}

		// Enable Control Block Patterns menu only in single site.
		if ( ! $this->option->is_network_activated() ) {
			add_filter( 'ctrlbp_admin_menu', '__return_true' );
		}

		// Add submenu. Priority 90 makes it the last sub-menu item.
		$admin_menu_hook = $this->option->is_network_activated() ? 'network_admin_menu' : 'admin_menu';
		add_action( $admin_menu_hook, array( $this, 'add_settings_page' ), 90 );
	}

	/**
	 * Add settings page.
	 */
	public function add_settings_page() {
		$parent     = $this->option->is_network_activated() ? 'settings.php' : 'control-block-patterns';
		$capability = $this->option->is_network_activated() ? 'manage_network_options' : 'manage_options';
		$title      = $this->option->is_network_activated() ? esc_html__( 'Control Block Patterns License', 'control-block-patterns' ) : esc_html__( 'License', 'control-block-patterns' );
		$page_hook  = add_submenu_page(
			$parent,
			$title,
			$title,
			$capability,
			'control-block-patterns-updater',
			array( $this, 'render' )
		);
		add_action( "load-{$page_hook}", array( $this, 'save' ) );
	}

	/**
	 * Render the content of settings page.
	 */
	public function render() {
		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Control Block Patterns License', 'control-block-patterns' ); ?></h1>
			<p><?php esc_html_e( 'Please enter your license key to enable automatic updates for Control Block Patterns extensions.', 'control-block-patterns' ); ?></p>
			<p>
				<?php
				printf(
					// Translators: %1$s - URL to the My Account page, %2$s - URL to the pricing page.
					wp_kses_post( __( 'To get the license key, visit the <a href="%1$s" target="_blank">My Account</a> page on controlpatterns.net website. If you have not purchased any extension yet, please <a href="%2$s" target="_blank">get a new license here</a>.', 'control-block-patterns' ) ),
					'https://controlpatterns.net/my-account/',
					'https://controlpatterns.net/pricing/'
				);
				?>
			</p>

			<form action="" method="post">
				<?php wp_nonce_field( 'control-block-patterns' ); ?>

				<table class="form-table">
					<tr>
						<th scope="row"><?php esc_html_e( 'License Key', 'control-block-patterns' ); ?></th>
						<td>
							<?php
							$messages = array(
								// Translators: %1$s - URL to the pricing page.
								'invalid' => __( 'Your license key is <b>invalid</b>. Please update your license key or <a href="%1$s" target="_blank">get a new one here</a>.', 'control-block-patterns' ),
								// Translators: %1$s - URL to the pricing page.
								'error'   => __( 'Your license key is <b>invalid</b>. Please update your license key or <a href="%1$s" target="_blank">get a new one here</a>.', 'control-block-patterns' ),
								// Translators: %2$s - URL to the My Account page.
								'expired' => __( 'Your license key is <b>expired</b>. Please <a href="%2$s" target="_blank">renew your license</a>.', 'control-block-patterns' ),
								'active'  => __( 'Your license key is <b>active</b>.', 'control-block-patterns' ),
							);
							$status   = $this->option->get_license_status();
							$api_key  = in_array( $status, array( 'expired', 'active' ), true ) ? '********************************' : $this->option->get( 'api_key' );
							?>
							<input class="regular-text" name="meta_box_updater[api_key]" value="<?php echo esc_attr( $api_key ); ?>" type="password">
							<?php if ( isset( $messages[ $status ] ) ) : ?>
								<p class="description"><?php echo wp_kses_post( sprintf( $messages[ $status ], 'https://controlpatterns.net/pricing/', 'https://controlpatterns.net/my-account/' ) ); ?></p>
							<?php endif; ?>
						</td>
					</tr>
				</table>

				<?php submit_button( __( 'Save Changes', 'control-block-patterns' ) ); ?>
			</form>
		</div>
		<?php
	}

	/**
	 * Save update settings.
	 */
	public function save() {
		$request = ctrlbp_request();
		if ( ! $request->post( 'submit' ) ) {
			return;
		}
		check_admin_referer( 'control-block-patterns' );

		$option           = $request->post( 'meta_box_updater', array() );
		$option           = (array) $option;
		$option['status'] = 'active';

		$args           = $option;
		$args['action'] = 'check_license';
		$response       = $this->checker->request( $args );
		$status         = isset( $response['status'] ) ? $response['status'] : 'invalid';

		if ( false === $response ) {
			add_settings_error( '', 'ctrlbp-error', __( 'Something wrong with the connection to controlpatterns.net. Please try again later.', 'control-block-patterns' ) );
		} elseif ( 'active' === $status ) {
			add_settings_error( '', 'ctrlbp-success', __( 'Your license is activated.', 'control-block-patterns' ), 'updated' );
		} elseif ( 'expired' === $status ) {
			// Translators: %s - URL to the My Account page.
			$message = __( 'License expired. Please renew on the <a href="%s" target="_blank">My Account</a> page on controlpatterns.net website.', 'control-block-patterns' );
			$message = wp_kses_post( sprintf( $message, 'https://controlpatterns.net/my-account/' ) );

			add_settings_error( '', 'ctrlbp-expired', $message );
		} else {
			// Translators: %1$s - URL to the My Account page, %2$s - URL to the pricing page.
			$message = __( 'Invalid license. Please <a href="%1$s" target="_blank">check again</a> or <a href="%2$s" target="_blank">get a new license here</a>.', 'control-block-patterns' );
			$message = wp_kses_post( sprintf( $message, 'https://controlpatterns.net/my-account/', 'https://controlpatterns.net/pricing/' ) );

			add_settings_error( '', 'ctrlbp-invalid', $message );
		}

		$option['status'] = $status;

		$admin_notices_hook = $this->option->is_network_activated() ? 'network_admin_notices' : 'admin_notices';
		add_action( $admin_notices_hook, 'settings_errors' );

		$this->option->update( $option );
	}
}
