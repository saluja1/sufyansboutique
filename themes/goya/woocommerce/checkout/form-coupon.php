<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>

<div class="et-checkout-coupon">
	<div class="et-checkout-coupon-title">
		<?php esc_html_e('Have a coupon?', 'woocommerce'); ?> <a href="#" class="showcoupon"><?php esc_html_e('Click here to enter your code', 'woocommerce'); ?></a>
	</div>
	<form class="checkout_coupon" method="post" style="display:none">
		<div class="inner_coupon form-row">
			<input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
			<label for="coupon_code"><?php esc_html_e( 'Coupon code', 'woocommerce' ); ?></label>
			<button type="submit" class="button outlined" name="apply_coupon" value="<?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
		</div>
	</form>
</div>