<?php
namespace ControlPatterns;


class Meta_Group {
	/**
	 * Indicate that the meta box is saved or not.
	 * This variable is used inside group field to show child fields.
	 *
	 * @var bool
	 */
	public static $saved = false;

	public function __construct() {
				
		add_action( 'ctrlbp_before', array( $this, 'set_saved' ) );
		add_action( 'ctrlbp_after', array( $this, 'unset_saved' ) );
	}

	

	/**
	 * Check if current meta box is saved.
	 * This variable is used inside group field to show child fields.
	 *
	 * @param object $obj Meta Box object.
	 */
	public function set_saved( $obj ) {
		self::$saved = $obj->is_saved();
	}

	/**
	 * Unset 'saved' variable, to be ready for next meta box.
	 */
	public function unset_saved() {
		self::$saved = false;
	}
}
