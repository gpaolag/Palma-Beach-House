<?php
namespace ControlPatterns\User;
use ControlPatterns\Meta_Box as Meta_Box;

class MetaBox extends Meta_Box {
	protected $object_type = 'user';

	protected function object_hooks() {
		// Add meta fields to edit user page.
		add_action( 'show_user_profile', array( $this, 'show' ) );
		add_action( 'edit_user_profile', array( $this, 'show' ) );

		// Save user meta.
		add_action( 'profile_update', array( $this, 'save_post' ) );
		add_action( 'user_register', array( $this, 'save_post' ) );

		add_action( "ctrlbp_before_{$this->meta_box['id']}", array( $this, 'show_heading' ) );
	}

	public function show_heading() {
		echo '<h2>', esc_html( $this->meta_box['title'] ), '</h2>';
	}

	public function enqueue() {
		parent::enqueue();
		if ( ! $this->is_edit_screen() ) {
			return;
		}
		wp_enqueue_style( 'ctrlbp-user', CTRLBP_CSS_URI . 'user-meta.css', '', CTRLBP_VER );
	}

	public function is_edit_screen( $screen = null ) {
		if ( ! is_admin() ) {
			return false;
		}
		$screen = get_current_screen();
		return in_array( $screen->id, ['profile', 'user-edit', 'profile-network', 'user-edit-network'], true );
	}

	public function get_current_object_id() {
		if ( ! is_admin() ) {
			return false;
		}
		$screen = get_current_screen();
		if ( in_array( $screen->id, ['profile', 'profile-network'], true ) ) {
			return get_current_user_id();
		}
		if ( in_array( $screen->id, ['user-edit', 'user-edit-network'], true ) ) {
			return isset( $_REQUEST['user_id'] ) ? absint( $_REQUEST['user_id'] ) : false;
		}
		return false;
	}

	public function register_fields() {
		$field_registry = ctrlbp_get_registry( 'field' );

		foreach ( $this->fields as $field ) {
			$field_registry->add( $field, 'user', 'user' );
		}
	}
}
