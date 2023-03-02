<?php
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
add_action( 'woocommerce_before_shop_loop_item', 'pergo_template_loop_product_img_wrap_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
add_action( 'woocommerce_after_shop_loop_item', 'pergo_template_loop_product_img_wrap_close', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 10 );
/*single product*/
function pergo_single_product_hook( ) {
    if ( is_singular( 'product' ) ) {
        add_action( 'woocommerce_single_product_summary', 'woocommerce_breadcrumb', 0 );
        add_filter( 'woocommerce_breadcrumb_defaults', 'pergo_woo_woocommerce_breadcrumbs' );
        add_filter( 'woocommerce_breadcrumb_home_url', 'pergo_woo_breadrumb_home_url' );
    } //is_singular( 'product' )
    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
    add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_sale_flash', 15 );
    remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
    $related_product_display = ot_get_option( 'related_product_display', 'on' );
    if( $related_product_display == 'on' )
    add_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products', 20 );
}
add_action( 'wp', 'pergo_single_product_hook' );
function pergo_template_loop_product_img_wrap_open( ) {
    echo '<div class="loop-item-inner hover-overlay">';
}
function pergo_template_loop_product_img_wrap_close( ) {
    echo '<div class="item-overlay"></div></div>';
}

/**
 * Show the product title in the product loop. By default this is an H2.
 */
function woocommerce_template_loop_product_title() {
    echo '<h5 class="woocommerce-loop-product__title h5-sm m-top-30">' . get_the_title() . '</h5>';
}
add_filter( 'woocommerce_loop_add_to_cart_args', 'pergo_loop_add_to_cart_args', 10, 2 );
function pergo_loop_add_to_cart_args( $args, $product ) {
    $args[ 'class' ] = implode( ' ', array_filter( array(
         'product_type_' . $product->get_type(),
        $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
        $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '' 
    ) ) );
    return $args;
}
// Change number or products per row to 3
add_filter( 'loop_shop_columns', 'pergo_loop_columns' );
if ( !function_exists( 'pergo_loop_columns' ) ) {
    function pergo_loop_columns() {
        $column = ot_get_option( 'loop_columns', 3 );
        return intval($column); 
    }
} //!function_exists( 'pergo_loop_columns' )
/**

* Change number of products that are displayed per page (shop page)

*/
add_filter( 'loop_shop_per_page', 'pergo_new_loop_shop_per_page', 20 );
function pergo_new_loop_shop_per_page( $cols ) {    
    $cols = ot_get_option( 'shop_per_page', 9 );
    return $cols;
}
/**

* Change number of related products output

*/
add_filter( 'woocommerce_output_related_products_args', 'pergo_woo_related_products_args' );
function pergo_woo_related_products_args( $args ) {
    $args[ 'posts_per_page' ] = ot_get_option( 'related_products_per_page', 3 ); // 3 related products
    $args[ 'columns' ]        = ot_get_option( 'related_loop_columns', 3 );; // arranged in 3 columns
    return $args;
}
/**

* Change several of the breadcrumb defaults

*/
function pergo_woo_woocommerce_breadcrumbs( ) {
    $title = esc_attr( get_the_title( get_option( 'woocommerce_shop_page_id' ) ) );
    $args  = array(
         'delimiter' => ' &#47; ',
        'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
        'wrap_after' => '</nav>',
        'before' => '',
        'after' => '',
        'home' => $title 
    );
    return $args;
}
/**

* Replace the home link URL

*/
function pergo_woo_breadrumb_home_url( ) {
    $link = get_permalink( get_option( 'woocommerce_shop_page_id' ) );
    return esc_url( $link );
}
function pergo_woo_add_featured_product_flash( ) {
    global $product;
    if ( $product->is_featured() ) {
        echo '<span class="onsale featured">' . esc_attr( __( 'Featured', 'pergo' ) ) . '</span>';
    } //$product->is_featured()
}
//add_action( 'woocommerce_before_shop_loop_item_title', 'pergo_woo_add_featured_product_flash' );
//add_action( 'woocommerce_before_single_product_summary', 'pergo_woo_add_featured_product_flash' );
add_action( 'pre_get_posts', 'pergo_is_shop_workaround_demo', 1 );
function pergo_is_shop_workaround_demo( $query ) {
    $front_page_id        = get_option( 'page_on_front' );
    $current_page_id      = $query->get( 'page_id' );
    $shop_page_id         = apply_filters( 'woocommerce_get_shop_page_id', get_option( 'woocommerce_shop_page_id' ) );
    $is_static_front_page = 'page' == get_option( 'show_on_front' );
    // Detect if it's a static front page and the current page is the front page, then use our work around
    // Otherwise, just use is_shop since it works fine on other pages
    if ( $is_static_front_page && $front_page_id == $current_page_id ) {
        error_log( 'is static front page and current page is front page' );
        $is_shop_page = ( $current_page_id == $shop_page_id ) ? true : false;
    } //$is_static_front_page && $front_page_id == $current_page_id
    else {
        error_log( 'is not static front page, can use is_shop instead' );
        $is_shop_page = is_shop();
    }
    // Now we can use it in a conditional like so:
    if ( $is_shop_page ) {
        error_log( 'this is the shop page' );
    } //$is_shop_page
}
/**

* Output the WooCommerce Breadcrumb.

*

* @param array $args Arguments.

*/
function woocommerce_breadcrumb( $args = array( ) ) {
    $args        = wp_parse_args( $args, apply_filters( 'woocommerce_breadcrumb_defaults', array(
         'delimiter' => '<span class="color-text">&nbsp;&#47;&nbsp;</span>',
        'wrap_before' => '<nav class="woocommerce-breadcrumb pull-left">',
        'wrap_after' => '</nav>',
        'before' => '',
        'after' => '',
        'home' => _x( 'Home', 'breadcrumb', 'woocommerce' ) 
    ) ) );
    $breadcrumbs = new WC_Breadcrumb();
    if ( !empty( $args[ 'home' ] ) ) {
        $breadcrumbs->add_crumb( $args[ 'home' ], apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) );
    } //!empty( $args[ 'home' ] )
    $args[ 'breadcrumb' ] = $breadcrumbs->generate();
    /**    
    * WooCommerce Breadcrumb hook    
    *    
    * @hooked WC_Structured_Data::generate_breadcrumblist_data() - 10    
    */
    do_action( 'woocommerce_breadcrumb', $breadcrumbs, $args );
    wc_get_template( 'global/breadcrumb.php', $args );
}

function pergo_get_cart_icon( ) {
    $output           = '';
    $header_cart_icon = ot_get_option( 'header_cart_icon', 'off' );
    $newval = '';
    if(is_page_template('templates/onepage-template.php')){
        $newval = get_post_meta( get_the_ID(), 'header_cart_icon', true );
    }
    $header_cart_icon = ( $newval != '' )? $newval : $header_cart_icon;
    
    if ( $header_cart_icon == 'off' )
        return false;
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        $count = WC()->cart->cart_contents_count;
        $output .= '<li class="cart-icon nav-icon menu-item menu-item-has-children nav-item dropdown"><a class="cart-contents nav-link" href="' . wc_get_cart_url() . '" title="' . __( 'View your shopping cart', 'pergo' ) . '"><i class="fa fa-shopping-cart"></i>';
        if ( $count > 0 ) {
            $output .= '<span class="cart-contents-count primary-bg white-color">' . esc_html( $count ) . '</span>';
        } //$count > 0
        $output .= '</a></li>';
    } //in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )
    return $output;
}
/**

* Add Cart icon and count to header if WC is active

*/
function pergo_wc_cart_count( ) {
    $output = '';
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        $count = WC()->cart->cart_contents_count;
        $output .= '<li class="cart-icon nav-icon menu-item menu-item-has-children nav-item dropdown"><a class="cart-contents nav-link" href="' . wc_get_cart_url() . '" title="' . __( 'View your shopping cart', 'pergo' ) . '"><i class="fa fa-shopping-cart"></i>';
        if ( $count > 0 ) {
            $output .= '<span class="cart-contents-count primary-bg white-color">' . esc_html( $count ) . '</span>';
        } //$count > 0
        $output .= '</a></li>';
    } //in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )
}
add_action( 'pergo_header_top', 'pergo_wc_cart_count' );

/**
* Ensure cart contents update when products are added to the cart via AJAX
*/
function my_header_add_to_cart_fragment( $fragments ) {
    ob_start();
    $count = WC()->cart->cart_contents_count; ?>
    <a class="cart-contents nav-link" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart', 'pergo' ); ?>"><i class="fa fa-shopping-cart"></i>
        <?php if ( $count > 0 ) { ?>
        <span class="cart-contents-count primary-bg white-color"><?php
        echo esc_html( $count ); ?></span>
        <?php
    } //$count > 0
    ?></a>

    <?php
    $fragments[ 'a.cart-contents' ] = ob_get_clean();
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'my_header_add_to_cart_fragment' );

add_filter( 'woocommerce_account_menu_item_classes', 'pergo_woo_account_menu_item_classes', 10, 2 );
function pergo_woo_account_menu_item_classes( $classes, $endpoint ) {
    if ( in_array( 'is-active', $classes ) )
        $classes[ ] = 'active';
    return $classes;
}
function woocommerce_get_product_thumbnail( $size = 'pergo-400x500-crop', $deprecated1 = 0, $deprecated2 = 0 ) {
    global $product, $post;
    $image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );
    return $product ? $product->get_image( $image_size ) : '';
}

/**
* Sets a new image size for our single product images
*
*/
function pergo_single_image_size( $size ) {
    $size[ 'width' ]  = ot_get_option( 'single_image_width', 600 );
    $size[ 'height' ] = ot_get_option( 'single_image_height', 800 );
    return $size;
} // wptt_single_image_size
add_filter( 'woocommerce_get_image_size_shop_single', 'pergo_single_image_size' );

/**
* Sets a new image size for our single product images
*
*/
function pergo_get_image_size_shop_catalog( $size ) {
    $size[ 'width' ]  = ot_get_option( 'catalog_image_width', 400 );
    $size[ 'height' ] = ot_get_option( 'catalog_image_height', 500 );
    return $size;
} // wptt_single_image_size
add_filter( 'woocommerce_get_image_size_shop_catalog', 'pergo_get_image_size_shop_catalog' );

/**
* Sets a new image size for our single product images
*
*/
function pergo_get_image_size_shop_thumbnail( $size ) {
    $size[ 'width' ]  = 150;
    $size[ 'height' ] = 150;
    return $size;
} // wptt_single_image_size
add_filter( 'woocommerce_get_image_size_shop_thumbnail', 'pergo_get_image_size_shop_thumbnail' );
function pergo_product_signup_url( ) {
    global $woocommerce, $post;
    $checkout_url = $woocommerce->cart->get_checkout_url() . '?add-to-cart=' . $post->ID;
    return $checkout_url;
}
function pergo_get_loop_add_to_cart_args( $args = array() ) {
    global $product;

    if ( $product ) {
        $defaults = array(
            'quantity'   => 1,
            'class'      => implode( ' ', array_filter( array(
                'button',
                'product_type_' . $product->get_type(),
                $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
            ) ) ),
            'attributes' => array(
                'data-product_id'  => $product->get_id(),
                'data-product_sku' => $product->get_sku(),
                'aria-label'       => $product->add_to_cart_description(),
                'rel'              => 'nofollow',
            ),
        );

        $args = apply_filters( 'woocommerce_loop_add_to_cart_args', wp_parse_args( $args, $defaults ), $product );

        if ( isset( $args['attributes']['aria-label'] ) ) {
            $args['attributes']['aria-label'] = strip_tags( $args['attributes']['aria-label'] );
        }

       return $args;
    }
}
if ( !function_exists( 'pergo_product_list' ) ):
    function pergo_product_list( ) {
        $product_list = get_post_meta( get_the_ID(), 'product_list', true );
        if ( !empty( $product_list ) ) {
            foreach ( $product_list as $key => $value ) {
                echo '<li><span><strong>' . esc_attr( $value[ 'title' ] ) . '</strong> : </span>' . esc_attr( $value[ 'desc' ] ) . '</li>';
            } //$product_list as $key => $value
        } //!empty( $product_list )
    }
endif;
add_action( 'woocommerce_show_page_title', 'pergo_woocommerce_show_page_title' );
function pergo_woocommerce_show_page_title( ) {
    return false;
}
if ( !function_exists( 'woocommerce_content' ) ) {
    /**    
    * Output WooCommerce content.    
    *    
    */
    function woocommerce_content( ) {
        if ( is_singular( 'product' ) ) {
            while ( have_posts() ):
                the_post();
                wc_get_template_part( 'content', 'single-product' );
            endwhile;
        } //is_singular( 'product' )
        else { ?>



			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ): ?>
				<h1 class="page-title"><?php woocommerce_page_title(); ?></h1>
			<?php endif; ?>

			<?php do_action( 'woocommerce_archive_description' ); ?>

			<?php
            if ( have_posts() ): ?>

				<?php do_action( 'woocommerce_before_shop_loop' ); ?>
				<?php woocommerce_product_loop_start(); ?>
			
			<div class="row">

				<?php
                $count  = 1;
                $column = pergo_loop_columns();
				?>

				<?php
                while ( have_posts() ):
                    the_post(); ?>
						<div class="product-item col-md-<?php echo ( 12 / $column ); ?> col-sm-6 m-bottom-50">
							<?php wc_get_template_part( 'content', 'product' ); ?>
						</div>
						<?php echo ( $count % $column == 0 ) ? '<div class="clearfix"></div>' : ''; ?>
						<?php $count++; ?>

					<?php endwhile; // end of the loop. ?>
					</div>

				<?php woocommerce_product_loop_end(); ?>

				<?php  do_action( 'woocommerce_after_shop_loop' ); ?>

			<?php
            elseif ( !woocommerce_product_subcategories( array(
                     'before' => woocommerce_product_loop_start( false ),
                    'after' => woocommerce_product_loop_end( false ) 
                ) ) ):
				 wc_get_template( 'loop/no-products-found.php' );
            endif;
        }
    }
} //!function_exists( 'woocommerce_content' )
if ( ! function_exists( 'woocommerce_output_product_categories' ) ) {
    /**
     * Display product sub categories as thumbnails.
     *
     * This is a replacement for woocommerce_product_subcategories which also does some logic
     * based on the loop. This function however just outputs when called.
     *
     * @since 3.3.1
     * @param array $args Arguments.
     * @return boolean
     */
    function woocommerce_output_product_categories( $args = array() ) {
        $args = wp_parse_args(
            $args,
            array(
                'before'    => apply_filters( 'woocommerce_before_output_product_categories', '<div class="row">' ),
                'after'     => apply_filters( 'woocommerce_after_output_product_categories', '</div>' ),
                'parent_id' => 0,
            )
        );

        $product_categories = woocommerce_get_product_subcategories( $args['parent_id'] );

        if ( ! $product_categories ) {
            return false;
        }

        echo pergo_context_args($args['before']); // WPCS: XSS ok.
        $count  = 1;
        $column = pergo_loop_columns();
        foreach ( $product_categories as $category ) {
            echo '<div class="product-item text-center col-md-'.( 12 / $column ).' mb-50">';
            wc_get_template(
                'content-product_cat.php',
                array(
                    'category' => $category,
                )
            );
            echo '</div>';
        }

        echo pergo_context_args($args['after']); // WPCS: XSS ok.

        return true;
    }
}

/**
 * Image Flipper class
 */
if ( ! class_exists( 'Pergo_WC_Image_Flipper' ) ) {
    class Pergo_WC_Image_Flipper {
        public function __construct() {
            add_action( 'wp_enqueue_scripts', array( $this, 'pergo_scripts' ) );
            add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'woocommerce_template_loop_second_product_thumbnail' ), 11 );
            add_filter( 'post_class', array( $this, 'product_has_gallery' ) );
        }
        /**
         * Class functions
         */
        public function pergo_scripts() {           
        }
        public function product_has_gallery( $classes ) {
            global $product;
            $post_type = get_post_type( get_the_ID() );
            if ( ! is_admin() ) {
                if ( $post_type == 'product' ) {
                    $attachment_ids = $this->get_gallery_image_ids( $product );
                    if ( $attachment_ids ) {
                        $classes[] = 'pergo-has-gallery';
                    }
                }
            }
            return $classes;
        }
        /**
         * Frontend functions
         */
        public function woocommerce_template_loop_second_product_thumbnail() {
            global $product, $woocommerce;
            $attachment_ids = $this->get_gallery_image_ids( $product );
            if ( $attachment_ids ) {
                $attachment_ids     = array_values( $attachment_ids );
                $secondary_image_id = $attachment_ids['0'];
                $secondary_image_alt = get_post_meta( $secondary_image_id, '_wp_attachment_image_alt', true );
                $secondary_image_title = get_the_title($secondary_image_id);
                echo wp_get_attachment_image(
                    $secondary_image_id,
                    'pergo-400x500-crop',
                    '',
                    array(
                        'class' => 'secondary-image attachment-shop-catalog wp-post-image wp-post-image--secondary',
                        'alt' => $secondary_image_alt,
                        'title' => $secondary_image_title
                    )
                );
            }
        }
        /**
         * WooCommerce Compatibility Functions
         */
        public function get_gallery_image_ids( $product ) {
            if ( ! is_a( $product, 'WC_Product' ) ) {
                return;
            }
            if ( is_callable( 'WC_Product::get_gallery_image_ids' ) ) {
                return $product->get_gallery_image_ids();
            } else {
                return $product->get_gallery_attachment_ids();
            }
        }
    }
    $Pergo_WC_Image_Flipper = new Pergo_WC_Image_Flipper();
}

if ( class_exists( 'YITH_WCQV_Frontend' ) ):
    $YITH_WCQV_Frontend = YITH_WCQV_Frontend();
    remove_action( 'woocommerce_after_shop_loop_item', array(
         $YITH_WCQV_Frontend,
        'yith_add_quick_view_button' 
    ), 15 );
    remove_action( 'yith_wcwl_table_after_product_name', array(
         $YITH_WCQV_Frontend,
        'yith_add_quick_view_button' 
    ), 15, 0 );
    remove_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_price', 15 );
    remove_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_meta', 30 );
    remove_action( 'yith_wcqv_product_image', 'woocommerce_show_product_sale_flash', 10 );
    remove_action( 'yith_wcqv_product_image', 'woocommerce_show_product_images', 20 );
    add_action( 'yith_wcqv_product_image', 'pergo_yith_show_product_images', 20 );
    //add_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_sale_flash', 10 );
    add_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_meta', 12 );
    add_action( 'yith_wcqv_product_summary', 'woocommerce_template_single_price', 21 );
    add_action( 'pergo_woo_after_loop_cart', 'pergo_woocommerce_quickview' );
    function pergo_woocommerce_quickview( ) {
?>
    
	<a class="yith-wcqv-button" data-product_id="<?php echo get_the_ID();?>" href="#" title="<?php
        echo esc_attr( get_option( 'yith-wcqv-button-label' ) ); ?>"><i class="fa fa-eye"></i></a>

	<?php
    }
    function pergo_yith_show_product_images( ) {
        wc_get_template( 'yith-product-image.php' );
    }
endif;

if ( class_exists( 'YITH_WCWL' ) ):
    $YITH_WCWL = YITH_WCWL();
    add_action( 'pergo_woo_after_loop_cart', 'pergo_woocommerce_wishlist' );
    function pergo_woocommerce_wishlist( ) {
        echo '<div class="iconlink">';
        $icon = "<i class='fas fa-heart'></i>";
        echo do_shortcode( '[yith_wcwl_add_to_wishlist label="" title="" add_to_wishlist="" product_added_text="" icon="fa fa-heart-o" already_in_wishslist_text="" browse_wishlist_text="'.$icon.'"]' );
        echo '</div>';
    }
endif;