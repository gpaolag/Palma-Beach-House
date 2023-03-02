<?php
function pergo_default_theme_options(){
    return array(
        'admin_logo' => PERGO_URI . '/images/logo.png',
        'google_map_api' => '',
        'search_placeholder' => 'Search...',
        'social_icons' => pergo_default_social_icons(),
        'logo' => apply_filters('pergo_header_logo_default', PERGO_URI . '/images/logo.png'),
        'header_sticky_nav' => 'on',
        'header_search_icon' => 'on',
        'header_cart_icon' => 'on',
        'background_style' => 'width',
        'footer_bg' => 'section-bg-revarse',
        'instagram_id' => apply_filters('pergo_instagram_id_default', 'carar11'), //kabir07.bd
        'footer_logo' => apply_filters('pergo_footer_logo_default', PERGO_URI . '/images/logo.png'),
        'copyright_text' => 'MADE WITH <i class="icon-heart2 pulse2"></i> BY KABIR ' . date('Y'),
        'sticky_post_text' => 'Sticky',
        'excerpt_length' => 55,
        'read_more_text' => 'Read More',
        'next_post_text' => 'Next',
        'prev_post_text' => 'Previous',
        'blog_layout' => 'rs',
        'blog_layout_sidebar' => 'sidebar-1',
        'single_layout' => 'rs',
        'single_layout_sidebar' => 'sidebar-1',
        'portfolio_archive' => (get_post_status(get_option('portfolio_archive_id')) == 'publish') ? get_option('portfolio_archive_id') : '',
        'portfolio_single_layout' => 'full',
        'portfolio_single_layout_sidebar' => 'sidebar-1',
        'display_single_related_portfolio' => 'on',
        'related_portfolio_title' => 'Related portfolio',
        'related_portfolio' => 6,
        'product_archive_custom_button_text' => 'off',
        'archive_add_to_cart_text' => 'Add to cart',
        'variable_add_to_cart_text' => 'Select options',
        'external_add_to_cart_text' => 'Buy product',
        'grouped_add_to_cart_text' => 'View products',
        'product_custom_button_text' => 'off',
        'add_to_cart_text' => 'Add to cart',
        'added_to_cart_text' => 'Already in cart',
        'related_product_display' => 'off',
        'catalog_image_width' => '390',
        'catalog_image_height' => '414',
        'single_image_width' => '570',
        'single_image_height' => '665',
        'shop_layout' => 'full',
        'shop_layout_sidebar' => 'sidebar-product',
        'product_layout' => 'rs',
        'product_layout_sidebar' => 'sidebar-product',
        '404_title' => '404',
        '404_subtitle' => '{Sorry}, The page was not found',
        'pergo_google_fonts' => apply_filters('pergo_header_logo_default', array(
            array(
                'family' => 'dosis',
                'variants' => array(
                    '300',
                    '600',
                    'regular',
                    '700'
                ),
                'subsets' => array(
                    'latin',
                    'latin-ext'
                )
            )
        )),
        'primary_font' => array(
            'font-family' => 'dosis'
        ),
        'secondary_font' => array(
            'font-family' => 'dosis'
        ),
        'body' => '',
        'h1' => '',
        'h2' => '',
        'h3' => '',
        'h4' => '',
        'h5' => '',
        'h6' => '',
        'sidebar_title' => '',
        'footer' => '',
        'primary_color' => apply_filters('pergo_primary_color_default', '#c9a084'),
        'secondary_color' => apply_filters('pergo_secondary_color_default', '#212121'),
        'secondary_color_2' => apply_filters('pergo_secondary_color_2_default', '#333'),
        'secondary_color_light' => apply_filters('pergo_secondary_color_light_default', '#737373'),
        'white_color' => apply_filters('pergo_white_color_default', '#fff'),
        'white_color_alt' => apply_filters('pergo_white_color_alt_default', '#f8f8f9')
    );
}