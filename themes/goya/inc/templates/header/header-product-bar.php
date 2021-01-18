<?php 
/**
 * Template file for displaying product sticky bar
 *
 * @package Goya
 */

global $product;		
$product_layout = goya_meta_config('product','layout_single','regular');

remove_all_actions('woocommerce_before_add_to_cart_form');
remove_all_actions('woocommerce_after_add_to_cart_form');

remove_all_actions('woocommerce_before_variations_form');
remove_all_actions('woocommerce_before_single_variation');
remove_all_actions('woocommerce_after_single_variation');
remove_all_actions('woocommerce_after_variations_form');

remove_all_actions('woocommerce_before_add_to_cart_button');

remove_all_actions('woocommerce_before_add_to_cart_quantity');
remove_all_actions('woocommerce_after_add_to_cart_quantity');
remove_all_actions('woocommerce_after_add_to_cart_button');

// Wrapper for quantity and add to cart button
if ( $product->is_type( 'grouped' ) ) {
	add_action('woocommerce_before_add_to_cart_button', 'goya_wishlist_div_open', 1);
} else {
	add_action('woocommerce_before_add_to_cart_quantity', 'goya_wishlist_div_open', 1);
}
add_action('woocommerce_after_add_to_cart_button', 'goya_extra_div_close', 2);

?>

<?php if ( is_product() && goya_meta_config('product', 'sticky_bar', true) == true && get_theme_mod('shop_catalog_mode', false) == false )  { ?>
	<div class="sticky-product-bar sticky-product-bar-layout-<?php echo esc_attr( $product_layout ); ?>">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="sticky-product-bar-content sticky-product-type-<?php echo esc_attr( $product->get_type() ) ?>">

						<div class="sticky-product-bar-image">
							<?php if ( has_post_thumbnail() ) {
								$image = get_the_post_thumbnail( $post->ID, apply_filters( 'goya_sticky_product_thumbnail_size', 'thumbnail' ) );
								echo apply_filters( 'goya_sticky_product_details_html', $image, $post->ID ); } ?>
						</div>

						<div class="sticky-product-bar-title"><h4><?php echo esc_attr( $product->get_title() ); ?></h4></div>

						<?php if ( $product->is_type( 'grouped' ) || $product->is_type( 'variable' ) ) { ?>
						<a href="#" class="sticky_add_to_cart add_to_cart add_to_cart_button button product_type_variable"><?php esc_html_e( 'Select Options', 'goya' ); ?></a>
						<?php } ?>
						
						<?php if ( !$product->is_type( 'grouped' ) ) { ?>
							<?php if ( !$product->is_type( 'variable' ) ) {
								echo '<span class="price">'. $product->get_price_html() . '</span>';
							} ?>
							<?php woocommerce_template_single_add_to_cart() ?>
						<?php } ?>
					
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }