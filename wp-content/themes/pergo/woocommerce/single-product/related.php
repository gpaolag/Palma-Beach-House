<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_singular( 'product' ) ) {
	exit;
}

if ( $related_products ) : ?>

	<div class="related products">
		<?php 
		$columns =  (count($related_products) == 2)? 2 : $columns;
		$related_title = ot_get_option( 'related_product_title', '' );
		$related_title = apply_filters( 'woocommerce_product_related_products_heading', esc_attr( $related_title ) );		
		if( $related_title != '' && !empty($related_title) ): ?>
			<div class="row">	
				<div class="col-md-12 section-title text-center center">	
					<h2 class="small-h4 underline_small mb-0"><?php printf( _x( '%s','Related Products title', 'pergo' ), esc_attr($related_title)) ?></h2>									
				</div>
			</div>
		<?php endif; ?>

		<div class="row">
			<div class="col <?php echo (count($related_products) > 2)? 'col-12' : 'col-xl-8 offset-xl-2' ?>">
				<div class="row">
					<?php foreach ( $related_products as $related_product ) : ?>
					<div class="col-xs-12 col-md-<?php echo intval(12/$columns); ?> mb-40 text-center 	product-item metreex-has-gallery">
						<div class="loop-item">
							<?php
							 	$post_object = get_post( $related_product->get_id() );
								setup_postdata( $GLOBALS['post'] =& $post_object );
								wc_get_template_part( 'content', 'related-product' ); 
							?>
						</div>
					</div>	
					<?php endforeach; ?>
				</div>
			</div>
		</div>

	</div>

<?php endif;

wp_reset_postdata();

