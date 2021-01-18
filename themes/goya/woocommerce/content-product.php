<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $post, $product, $woocommerce_loop;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$vars = $wp_query->query_vars;

// Product item style
if (array_key_exists('goya_product_style', $vars)) {
	$item_style = $vars['goya_product_style'];
} else if ( (is_shop() || is_product_category() || is_product_tag()) && isset( $_GET['product_style'] ) ) {
	$item_style = sanitize_key( $_GET['product_style'] );
} else {
	$item_style = get_theme_mod('shop_product_listing', 'style1');
}


// Color/image Swatches
add_action( 'goya_woocommerce_after_shop_loop_item', 'goya_add_loop_variation_swatches', 9 );


// Columns large
if ( isset( $_GET['col'] ) ) {
	$columns_large = intval( sanitize_key( $_GET['col'] ) );
} else if ( ( isset( $woocommerce_loop['columns'] ) && $woocommerce_loop['columns'] != '' ) ) {
	$columns_large = $woocommerce_loop['columns'];
} else {
	$columns_large = get_theme_mod('shop_columns', 4);
}

// Columns medium
if ( intval( $columns_large ) < 3 ) {
	$columns_medium = '2'; // Make sure "columns_medium" is lower-than or equal-to "columns"
} else {
	$columns_medium = ( isset( $woocommerce_loop['columns_medium'] ) ) ? $woocommerce_loop['columns_medium'] : '3';
}

// Columns small
$columns_small = ( isset( $woocommerce_loop['columns_small'] ) ) ? $woocommerce_loop['columns_small'] : '2';

// Columns x-small
$columns_xsmall = ( isset( $woocommerce_loop['columns_xsmall'] ) ) ? $woocommerce_loop['columns_xsmall'] : get_theme_mod('shop_columns_mobile', 2);


// Classes
$classes[] = 'item';
$classes[] = 'et-listing-'.$item_style;


// Animation
$inner_classes[] = 'product-inner';
$inner_classes[] = goya_meta_config('shop','product_animation','animation bottom-to-top');
$inner_classes[] = 'hover-animation-' . goya_meta_config('shop','product_animation_hover','zoom-jump');


// Masonry/Columns size
if (array_key_exists('goya_masonry_list', $vars)) {
	$masonry_size = get_post_meta($id, 'goya_product_masonry_size', true);
	$masonry_size = ($masonry_size) ? $masonry_size : 'small';
	$masonry_adjust = goya_get_masonry_size($masonry_size);
	$classes[] = $masonry_adjust['class'];
	$image_size = $masonry_adjust['image_size'];
} else {
	$classes[] = 'col-' . 12 / $columns_xsmall;
	$classes[] = 'col-sm-' . 12 / $columns_small;
	$classes[] = 'col-md-' . 12 / $columns_medium;
	
	if($columns_large != 5) {
		$classes[] = 'col-lg-' . 12 / $columns_large;
	} else {
		$classes[] = 'large_grid_5';
	}

	// Small grid class
	$classes[] = 'small_grid_' . ( $columns_large + 1 );
}


// Categories
$terms = get_the_terms( $id, 'product_cat' );

$cats = '';	
if (!empty($terms)) {
	foreach ($terms as $term) { $cats .= ' cat-'.strtolower($term->slug); }
}

$classes[] = $cats;

// Hover product image
$shop_product_hover = goya_meta_config('shop','product_img_hover',true);
$thumbnail_class = ( $shop_product_hover ) ? 'et-image-hover' : '';
if ($shop_product_hover == 1 ) {
	$classes[] = 'hover-image-load';
}

// Star rating
if ( get_theme_mod('rating_listing', true) == true ) {
	$classes[] = 'show-rating';
}

// Image class

	$image_class = 'main-image';
	if ($wp_query->current_post < get_theme_mod( 'lazy_load_skip', 6 )) {
		$image_class .= ' skip-lazy';
	}

?>

<li <?php wc_product_class($classes, $product); ?>>
	<div class="<?php echo esc_attr(implode(' ', $inner_classes)); ?>">
	<?php
		/**
		 * Hook: woocommerce_before_shop_loop_item.
		 *
		 * @hooked woocommerce_template_loop_product_link_open - 10
		 */
		do_action( 'woocommerce_before_shop_loop_item' );
	?>
	<figure class="product_thumbnail <?php echo esc_attr($thumbnail_class); ?>">  
		<a href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php
				if ( has_post_thumbnail( $product->get_id() ) ) {   
					echo  get_the_post_thumbnail( $product->get_id(), 'shop_catalog', array( 'class' => $image_class ) );
				} else {
					echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="Placeholder" />', wc_placeholder_img_src() ), $product->get_id() );
				}
				// Alternative/hover image
				if ($shop_product_hover == 1) {
					echo goya_product_thumbnail_alt( $product );
			} ?></a>
		<?php
			/**
			 * Hook: woocommerce_before_shop_loop_item_title.
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
		?>
		<div class="actions-wrapper">
			<div class="actions-inner">
				<?php if ($item_style != 'style1' ) { echo apply_filters( 'goya_wishlist_button_output', 'loop' ); } ?>
				<?php if ($item_style == 'style2' || $item_style == 'style3' ) { woocommerce_template_loop_add_to_cart(); } ?>
				<?php 
				if ( get_theme_mod('product_quickview', true) == true ) {
					goya_loop_quick_view();
				} ?>
			</div>
		</div>
	</figure>
	<div class="caption">
		<div class="product-title">
			<h3><a class="product-link" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
			<?php if ($item_style === 'style1') { echo apply_filters( 'goya_wishlist_button_output', 'loop' ); } ?>
		</div>
		<?php 
			/**
			 * Hook: woocommerce_shop_loop_item_title.
			 *
			 * @hooked woocommerce_template_loop_product_title - 10
			 */
			do_action( 'woocommerce_shop_loop_item_title' );
		?>

		<div class="product_after_title">

			<div class="product_after_shop_loop_price">
				<?php
					/**
					 * Hook: woocommerce_after_shop_loop_item_title.
					 *
					 * @hooked woocommerce_template_loop_rating - 5
					 * @hooked woocommerce_template_loop_price - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item_title' );
				?>
			</div>

			<div class="product-excerpt">
				<?php the_excerpt(); ?>
			</div>

			<div class="after_shop_loop_actions">

				<?php 
					/**
					 * Hook: woocommerce_after_shop_loop_item.
					 *
					 * @hooked woocommerce_template_loop_product_link_close - 5
					 * @hooked woocommerce_template_loop_add_to_cart - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item' );
				 ?>
			</div>

		</div>

		<?php do_action( 'goya_woocommerce_after_shop_loop_item' ); ?>

	</div>

	</div>

</li>