<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;

$classes[] = 'et-main-products';

// Variations in archive
$swatches = get_theme_mod('archive_show_swatches', false);
if ($swatches) $classes[] = 'et-shop-show-variations';

// Hover images
if ( goya_meta_config('shop','product_img_hover',true) == true ) $classes[] = 'et-shop-hover-images';

// Columns
if ( ( isset( $woocommerce_loop['columns'] ) && $woocommerce_loop['columns'] != '' ) ) {
	$columns = $woocommerce_loop['columns'];
} else {
	$columns = ( isset( $_GET['col'] ) ) ? intval( sanitize_key( $_GET['col'] ) ) : 4;
}

?>

<ul class="products row <?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" data-autoplay="false" data-navigation="true" data-pagination="true">