<?php
if ( ! function_exists('pergo_portfolio_post_type') ) {

// Register Custom Post Type
function pergo_portfolio_post_type() {

	$title = _x( 'Portfolios', 'Post Type General Name', 'pergo' );
	$title = apply_filters( 'pergo_portfolio_post_type_title', $title );


	$labels = array(
		'name'                  => esc_attr($title),
		'singular_name'         => _x( 'Portfolio', 'Post Type Singular Name', 'pergo' ),
		'menu_name'             => __( 'Portfolio', 'pergo' ),
		'name_admin_bar'        => __( 'Portfolio', 'pergo' ),
		'archives'              => __( 'Portfolio Archives', 'pergo' ),
		'parent_item_colon'     => __( 'Parent Portfolio:', 'pergo' ),
		'all_items'             => __( 'All Portfolio Items', 'pergo' ),
		'add_new_item'          => __( 'Add New Portfolio', 'pergo' ),
		'add_new'               => __( 'Add New', 'pergo' ),
		'new_item'              => __( 'New Portfolio', 'pergo' ),
		'edit_item'             => __( 'Edit Portfolio', 'pergo' ),
		'update_item'           => __( 'Update Portfolio', 'pergo' ),
		'view_item'             => __( 'View Portfolio', 'pergo' ),
		'search_items'          => __( 'Search Portfolio', 'pergo' ),
		'not_found'             => __( 'Not found', 'pergo' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'pergo' ),
		'featured_image'        => __( 'Featured Image', 'pergo' ),
		'set_featured_image'    => __( 'Set featured image', 'pergo' ),
		'remove_featured_image' => __( 'Remove featured image', 'pergo' ),
		'use_featured_image'    => __( 'Use as featured image', 'pergo' ),
		'insert_into_item'      => __( 'Insert into Portfolio', 'pergo' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Portfolio', 'pergo' ),
		'items_list'            => __( 'Portfolio list', 'pergo' ),
		'items_list_navigation' => __( 'Portfolio list navigation', 'pergo' ),
		'filter_items_list'     => __( 'Filter Portfolio list', 'pergo' ),
	);
	$args = array(
		'label'                 => __( 'Portfolio', 'pergo' ),
		'description'           => __( 'Post Type Description', 'pergo' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail' ),
		'taxonomies'            => array( 'portfolio_category', 'tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',		
	);

	$slug = apply_filters( 'pergo_portfolio_post_type_slug', 'portfolio' );
	$args['rewrite'] = array('slug' => $slug,'with_front' => false);
	

	if( !in_array('portfolio', pergo_disable_post_type_arr()) ){
		register_post_type( 'portfolio', $args );
	}
	

}
add_action( 'init', 'pergo_portfolio_post_type', 0 );

}



if ( ! function_exists( 'pergo_portfolio_category_taxonomy' ) ) {

// Register Custom Taxonomy
function pergo_portfolio_category_taxonomy() {

	$labels = array(
		'name'                       => _x( 'Categories', 'Taxonomy General Name', 'pergo' ),
		'singular_name'              => _x( 'Category', 'Taxonomy Singular Name', 'pergo' ),
		'menu_name'                  => __( 'Category', 'pergo' ),
		'all_items'                  => __( 'All Categories', 'pergo' ),
		'parent_item'                => __( 'Parent Category', 'pergo' ),
		'parent_item_colon'          => __( 'Parent Category:', 'pergo' ),
		'new_item_name'              => __( 'New Category Name', 'pergo' ),
		'add_new_item'               => __( 'Add New Category', 'pergo' ),
		'edit_item'                  => __( 'Edit Category', 'pergo' ),
		'update_item'                => __( 'Update Category', 'pergo' ),
		'view_item'                  => __( 'View Category', 'pergo' ),
		'separate_items_with_commas' => __( 'Separate Categories with commas', 'pergo' ),
		'add_or_remove_items'        => __( 'Add or remove Categories', 'pergo' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'pergo' ),
		'popular_items'              => __( 'Popular Categories', 'pergo' ),
		'search_items'               => __( 'Search Items', 'pergo' ),
		'not_found'                  => __( 'Not Found', 'pergo' ),
		'no_terms'                   => __( 'No Categories', 'pergo' ),
		'items_list'                 => __( 'Categories list', 'pergo' ),
		'items_list_navigation'      => __( 'Categories list navigation', 'pergo' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'rewrite'           => array( 'slug' => apply_filters('pergo_portfolio_category_slug', 'portfolio_category') ),
	);
	register_taxonomy( 'portfolio_category', array( 'portfolio' ), $args );

}
add_action( 'init', 'pergo_portfolio_category_taxonomy', 0 );
}

if ( ! function_exists('pergo_team_post_type') ) {

// Register Custom Post Type
function pergo_team_post_type() {

	$title = _x( 'Team', 'Post Type General Name', 'pergo' );
	$title = apply_filters( 'pergo_team_post_type_title', $title );

	$labels = array(
		'name'                  => esc_attr($title),
		'singular_name'         => _x( 'Team', 'Post Type Singular Name', 'pergo' ),
		'menu_name'             => __( 'Team', 'pergo' ),
		'name_admin_bar'        => __( 'Team', 'pergo' ),
		'archives'              => __( 'Team Archives', 'pergo' ),
		'parent_item_colon'     => __( 'Parent Team:', 'pergo' ),
		'all_items'             => __( 'All Team', 'pergo' ),
		'add_new_item'          => __( 'Add New Team', 'pergo' ),
		'add_new'               => __( 'Add New', 'pergo' ),
		'new_item'              => __( 'New Team', 'pergo' ),
		'edit_item'             => __( 'Edit Team', 'pergo' ),
		'update_item'           => __( 'Update Team', 'pergo' ),
		'view_item'             => __( 'View Team', 'pergo' ),
		'search_items'          => __( 'Search Team', 'pergo' ),
		'not_found'             => __( 'Not found', 'pergo' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'pergo' ),
		'featured_image'        => __( 'Featured Image', 'pergo' ),
		'set_featured_image'    => __( 'Set featured image', 'pergo' ),
		'remove_featured_image' => __( 'Remove featured image', 'pergo' ),
		'use_featured_image'    => __( 'Use as featured image', 'pergo' ),
		'insert_into_item'      => __( 'Insert into Team', 'pergo' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Team', 'pergo' ),
		'items_list'            => __( 'Team list', 'pergo' ),
		'items_list_navigation' => __( 'Team list navigation', 'pergo' ),
		'filter_items_list'     => __( 'Filter Team list', 'pergo' ),
	);
	$args = array(
		'label'                 => __( 'Team', 'pergo' ),
		'description'           => __( 'Post Type Description', 'pergo' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes', 'excerpt' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 6,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,		
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);

	$slug = apply_filters( 'pergo_team_post_type_slug', 'team' );
	$args['rewrite'] = array('slug' => $slug,'with_front' => false);

	if( !in_array('team', pergo_disable_post_type_arr()) ){
		register_post_type( 'team', $args );
	}

}
add_action( 'init', 'pergo_team_post_type', 0 );

}