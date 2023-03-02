<?php
namespace ControlPatterns\Patterns;
/**
 * ControlBlockPatterns Attributes class.
 */
class Attributes {

	/**
	 * Class Constructor
	 *
	 * @access    public
	 * 
	 */
	public function __construct() {
		$this->setup_actions();
	}

	/**
	 * Setup the default filters and actions.
	 *
	 * @uses add_action() To add various actions.
	 * @uses add_filter() To add various filters.
	 *
	 * @access private
	 * @since  1.0.0
	 */
	private function setup_actions() {

		// Initialize the meta boxes.
		add_action( 'admin_init', array( $this, 'meta_boxes' ), 2 );

		// Setup pings for the link & quote URLs.
		add_filter( 'pre_ping', array( $this, 'pre_ping_post_links' ), 10, 3 );
	}



	/**
	 * Builds the default Meta Boxes.
	 *
	 * @access private
	 * @since  1.0.0
	 */
	public function meta_boxes() {

		// Exit if called outside of WP admin.
		if ( ! is_admin() ) {
			return false;
		}

		/**
		 * Filter the allowed post types.
		 *
		 * @since 1.2.0
		 *
		 * @param array $post_types
		 * @return array
		 */
		$allowed_post_types = array( 
			( cbp_get_option( 'post_metabox', 'on' ) != 'off' )?  'post' : '', 
			( cbp_get_option( 'page_metabox', 'on' ) != 'off' )?  'page' : ''			
		); 
		$allowed_post_types = array_filter($allowed_post_types);

		/**
		 * Filter the meta boxes.
		 *
		 * @since 1.0.0
		 *
		 * @param array $meta_boxes The meta boxes being registered.
		 * @return array
		 */
		$meta_boxes = array(
			self::allowed_meta_boxes( $allowed_post_types )
		);
		$new_meta_boxes = apply_filters( 'block_patterns/attributes/allowed_meta_boxes', array() );
		$meta_boxes = array_filter( array_merge( $meta_boxes, $new_meta_boxes ));

		if( empty($meta_boxes) ) return;


		/**
		 * Register our meta boxes using the
		 */
		foreach ( $meta_boxes as $meta_box ) {
			new MetaBox( $meta_box );
		}
	}

	/**
	 * Returns an array with the meta box.
	 *
	 * @param mixed $pages Excepts a comma separated string or array of
	 *                     post_types and is what tells the metabox where to
	 *                     display. Default 'post'.
	 * @return array
	 *
	 * @access private
	 * @since  1.2.0
	 */
	private static function allowed_meta_boxes( $pages = 'post' ) {
		if( empty($pages) ) return;
		
		if ( is_string( $pages ) ) {
			$pages = explode( ',', $pages );
		}

		$fields = array();		
		foreach (glob(__DIR__ .'/attributes/*.php') as $filename) {
			$fields = array_merge( 
				$fields,  
				include $filename
			);
		}


		return array(
			'id'       => 'cbp-post-type-meta-box',
			'title'    => esc_html__( 'Control Block Patterns', 'control-block-patterns' ),
			'desc'     => sprintf('If you do not want this settings, you can disable this in the %1$s', '<a href="'.admin_url('edit.php?post_type=ctrl_block_patterns&page=block-patterns-options#section_control_posttypes').'">Block Patterns > Settings</a>'),
			'pages'    => $pages,
			'context'  => 'normal',
			'priority' => 'high',
			'class' => 'cbp-seemless',
			'fields'   => apply_filters( 'block_patterns/attributes/meta_box_fields', $fields	)
		);
	}

	/**
	 * Setup pings for the link & quote URLs
	 *
	 * @access public
	 * @since  1.0.0
	 *
	 * @param  array $post_links The URLs to ping.
	 * @param  array $pung Pinged URLs.
	 * @param  int   $post_id Post ID.
	 */
	public function pre_ping_post_links( $post_links, $pung, $post_id = null ) {

		$_link = get_post_meta( $post_id, '_format_link_url', true );
		if ( ! empty( $_link ) && ! in_array( $_link, $pung, true ) && ! in_array( $_link, $post_links, true ) ) {
			$post_links[] = $_link;
		}

		$_quote = get_post_meta( $post_id, '_format_quote_source_url', true );
		if ( ! empty( $_quote ) && ! in_array( $_quote, $pung, true ) && ! in_array( $_quote, $post_links, true ) ) {
			$post_links[] = $_quote;
		}
	}
	
}