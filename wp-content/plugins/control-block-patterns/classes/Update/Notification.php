<?php
namespace ControlPatterns\Update;
/**
 * This class notifies users to enter or update license key.
 * Control Block Patterns Update Notification class
 *
 * @package ControlPatterns
 */

class Notification {
	/**
	 * The update option object.
	 *
	 * @var object
	 */
	private $option;

	/**
	 * Settings page URL.
	 *
	 * @var string
	 */
	private $settings_page;

	/**
	 * The update checker object.
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

		$this->settings_page = $option->is_network_activated() ? network_admin_url( 'settings.php?page=control-block-patterns-updater' ) : admin_url( 'admin.php?page=control-block-patterns-updater' );
	}

	/**
	 * Add hooks to show admin notice.
	 */
	public function init() {
		if ( ! $this->checker->has_extensions() ) {
			return;
		}

		// Show update message on Plugins page.
		$extensions = $this->checker->get_extensions();
		foreach ( $extensions as $extension ) {
			$file = "{$extension}/{$extension}.php";
			add_action( "in_plugin_update_message-$file", array( $this, 'show_update_message' ), 10, 2 );
			add_filter( "plugin_action_links_$file", array( $this, 'plugin_links' ), 20 );
		}

		// Show global update notification.
		if ( $this->is_dismissed() ) {
			return;
		}

		$admin_notices_hook = $this->option->is_network_activated() ? 'network_admin_notices' : 'admin_notices';
		add_action( $admin_notices_hook, array( $this, 'notify' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
		add_action( 'wp_ajax_ctrlbp_dismiss_notification', array( $this, 'dismiss' ) );
	}

	/**
	 * Enqueue the notification script.
	 */
	public function enqueue() {
		wp_enqueue_script( 'ctrlbp-notification', CTRLBP_JS_URI . 'notification.js', array( 'jquery' ), CTRLBP_VER, true );
		wp_localize_script( 'ctrlbp-notification', 'CTRLBPNotification', array( 'nonce' => wp_create_nonce( 'dismiss' ) ) );
	}

	/**
	 * Dismiss the notification permanently via ajax.
	 */
	public function dismiss() {
		check_ajax_referer( 'dismiss', 'nonce' );

		$this->option->update(
			array(
				'notification_dismissed'      => 1,
				'notification_dismissed_time' => time(),
			)
		);

		wp_send_json_success();
	}

	/**
	 * Notify users to enter license key.
	 */
	public function notify() {
		// Do not show notification on License page.
		$screen = get_current_screen();
		if ( in_array( $screen->id, array( 'control-block-patterns_page_control-block-patterns-updater', 'settings_page_control-block-patterns-updater-network' ), true ) ) {
			return;
		}

		$messages = array(
			// Translators: %1$s - URL to the settings page, %2$s - URL to the pricing page.
			'no_key'  => __( 'You have not set your Control Block Patterns license key yet, which means you are missing out on automatic updates and support! Please <a href="%1$s">enter your license key</a> or <a href="%2$s" target="_blank">get a new one here</a>.', 'control-block-patterns' ),
			// Translators: %1$s - URL to the settings page, %2$s - URL to the pricing page.
			'invalid' => __( 'Your license key for Control Block Patterns is <b>invalid</b>. Please <a href="%1$s">update your license key</a> or <a href="%2$s" target="_blank">get a new one</a> to enable automatic updates.', 'control-block-patterns' ),
			// Translators: %1$s - URL to the settings page, %2$s - URL to the pricing page.
			'error'   => __( 'Your license key for Control Block Patterns is <b>invalid</b>. Please <a href="%1$s">update your license key</a> or <a href="%2$s" target="_blank">get a new one</a> to enable automatic updates.', 'control-block-patterns' ),
			// Translators: %3$s - URL to the My Account page.
			'expired' => __( 'Your license key for Control Block Patterns is <b>expired</b>. Please <a href="%3$s" target="_blank">renew your license</a> to get automatic updates and premium support.', 'control-block-patterns' ),
		);
		$status   = $this->option->get_license_status();
		if ( ! isset( $messages[ $status ] ) ) {
			return;
		}

		echo '<div id="control-block-patterns-notification" class="notice notice-warning is-dismissible"><p><span class="dashicons dashicons-warning" style="color: #f56e28"></span> ', wp_kses_post( sprintf( $messages[ $status ], $this->settings_page, 'https://controlpatterns.net/pricing/', 'https://controlpatterns.net/my-account/' ) ), '</p></div>';
	}

	/**
	 * Show update message on Plugins page.
	 *
	 * @param  array  $plugin_data Plugin data.
	 * @param  object $response    Available plugin update data.
	 */
	public function show_update_message( $plugin_data, $response ) {
		// Users have an active license.
		if ( ! empty( $response->package ) ) {
			return;
		}

		$messages = array(
			// Translators: %1$s - URL to the settings page, %2$s - URL to the pricing page.
			'no_key'  => __( 'Please <a href="%1$s">enter your license key</a> or <a href="%2$s" target="_blank">get a new one here</a>.', 'control-block-patterns' ),
			// Translators: %1$s - URL to the settings page, %2$s - URL to the pricing page.
			'invalid' => __( 'Your license key is <b>invalid</b>. Please <a href="%1$s">update your license key</a> or <a href="%2$s" target="_blank">get a new one here</a>.', 'control-block-patterns' ),
			// Translators: %1$s - URL to the settings page, %2$s - URL to the pricing page.
			'error'   => __( 'Your license key is <b>invalid</b>. Please <a href="%1$s">update your license key</a> or <a href="%2$s" target="_blank">get a new one here</a>.', 'control-block-patterns' ),
			// Translators: %3$s - URL to the My Account page.
			'expired' => __( 'Your license key is <b>expired</b>. Please <a href="%3$s" target="_blank">renew your license</a>.', 'control-block-patterns' ),
		);
		$status   = $this->option->get_license_status();
		if ( ! isset( $messages[ $status ] ) ) {
			return;
		}

		echo '<br><span style="width: 26px; height: 20px; display: inline-block;">&nbsp;</span>' . wp_kses_post( sprintf( $messages[ $status ], $this->settings_page, 'https://controlpatterns.net/pricing/', 'https://controlpatterns.net/my-account/' ) );
	}

	/**
	 * Add link for activate or update the license key.
	 *
	 * @param array $links Array of plugin links.
	 *
	 * @return array
	 */
	public function plugin_links( $links ) {
		$status = $this->option->get_license_status();
		if ( 'active' === $status ) {
			return $links;
		}

		$text    = 'no_key' === $status ? __( 'Activate License', 'control-block-patterns' ) : __( 'Update License', 'control-block-patterns' );
		$links[] = '<a href="' . esc_url( $this->settings_page ) . '" class="ctrlbp-activate-license" style="color: #39b54a; font-weight: bold">' . esc_html( $text ) . '</a>';

		return $links;
	}

	/**
	 * Check if the global notification is dismissed.
	 * Auto re-enable the notification every 2 weeks after it's dissmissed.
	 *
	 * @return bool
	 */
	private function is_dismissed() {
		$time = $this->option->get( 'notification_dismissed_time' );

		return $this->option->get( 'notification_dismissed' ) && time() - $time < 14 * DAY_IN_SECONDS;
	}
}
