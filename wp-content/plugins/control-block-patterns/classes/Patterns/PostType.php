<?php
namespace ControlPatterns\Patterns;

class PostType {
    public function __construct() {
        add_action( 'init', [ $this, 'register_post_type' ] );
		//add_filter( 'use_block_editor_for_post_type', [ $this, 'disable_block_editor' ], 10, 2 );
    }

    public function wp_get_nav_menu_items( $items, $menu, $args ) {
	   	
	    return  $items;
	}

    public function register_post_type() {
		$labels = [
			'name'                  => esc_html_x( 'Block Patterns', 'post type name', 'control-block-patterns' ),
			'singular_name'         => esc_html_x( 'Block Pattern', 'singular post type name', 'control-block-patterns' ),
			'add_new'               => esc_html__( 'Add New', 'control-block-patterns' ),
			'add_new_item'          => esc_html__( 'Add New', 'control-block-patterns' ),
			'edit_item'             => esc_html__( 'Edit Block Patterns', 'control-block-patterns' ),
			'new_item'              => esc_html__( 'New Block Patterns', 'control-block-patterns' ),
			'all_items'             => esc_html__( 'Block Patterns', 'control-block-patterns' ),
			'view_item'             => esc_html__( 'View Block Patterns', 'control-block-patterns' ),
			'search_items'          => esc_html__( 'Search Block Patterns', 'control-block-patterns' ),
			'not_found'             => esc_html__( 'No Block Patterns found', 'control-block-patterns' ),
			'not_found_in_trash'    => esc_html__( 'No Block Patterns found in Trash', 'control-block-patterns' ),
			'parent_item_colon'     => '',
			'menu_name'             => esc_html_x( 'Block Patterns', 'post type menu name', 'control-block-patterns' ),
			'filter_items_list'     => esc_html__( 'Filter Block Patterns list', 'control-block-patterns' ),
			'items_list_navigation' => esc_html__( 'Block Patterns list navigation', 'control-block-patterns' ),
			'items_list'            => esc_html__( 'Block Patterns list', 'control-block-patterns' ),
			'attributes' => esc_html__( 'Attributes', 'control-block-patterns' ),
			'featured_image' => esc_html__( 'Preview image', 'control-block-patterns' ),
			'remove_featured_image' => esc_html__( 'Remove preview image', 'control-block-patterns' ),
			'set_featured_image' => esc_html__( 'Add preview image', 'control-block-patterns' ),
		];

		$args = [
			'labels'          => $labels,
			'public'          => true,
			'show_ui'         => true,
			'show_in_menu'    => true,
			'query_var'       => false,
			'rewrite'         => [ 'slug' => 'ctrl-block-patterns', 'with_front' => false ],
			'capability_type' => 'post',
			'map_meta_cap'    => true,
			'exclude_from_search' => true,
			'has_archive'     => false,
			'hierarchical'    => false,
			'taxonomies'            => array( 'block_pattern_category', ' block_pattern_tag' ),
			'show_in_rest'    => true,
			'menu_icon'       => 'dashicons-plus',
			'supports'        => [
				'title',
				'editor',
				'author'
			],
		];
		register_post_type( 'ctrl_block_patterns', $args );

		$args = array(
	        'label'        => __( 'Category', 'control-block-patterns' ),
	        'hierarchical'  => true,	     
	        'show_admin_column' => true,
	        'publicly_queryable' => true,
	        'show_in_quick_edit' => true,
			'show_in_rest'    => true
	    );
		register_taxonomy( 'block_pattern_category', 'ctrl_block_patterns', $args );

		$args = array(
	        'label'        => __( 'Keywords', 'control-block-patterns' ),
	        'show_admin_column' => true,
	        'publicly_queryable' => true,
			'show_in_rest'    => true,
	        'show_in_quick_edit' => true
	    );
		register_taxonomy( 'block_pattern_tag', 'ctrl_block_patterns', $args );
    }

    public function disable_block_editor( $enabled, $post_type ) {
		return 'ctrl_block_patterns' === $post_type ? false : $enabled;
	}

	private function is_screen() {
		return 'ctrl_block_patterns' === get_current_screen()->id;
	}
}
