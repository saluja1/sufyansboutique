<?php

/* Account login
---------------------------------------------------------- */

	/* Get my-account/login link */
	function goya_get_myaccount_link( $is_header = true ) {

		if( ! goya_wc_active() ) {
			return;
		}
		
		$myaccount_url = get_permalink( get_option( 'woocommerce_myaccount_page_id' ) );
		$button_style = 'account-' . goya_meta_config('','main_header_login_icon','text');

		if ( is_user_logged_in() && $is_header ) { ?>
			<ul class="account-links et-header-menu">
				<li class="menu-item-has-children">
					<a href="<?php echo esc_url( $myaccount_url ); ?>" class="et-menu-account-btn icon <?php echo esc_attr( $button_style ); ?>"><span class="icon-text"><?php esc_html_e( 'My Account', 'goya' ) ?></span> <?php echo goya_load_template_part('assets/img/svg/user.svg'); ?></a>
					<ul class="sub-menu">
					<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
						<li class="account-link--<?php echo esc_attr( $endpoint ); ?> menu-item">
							<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
						</li>
					<?php endforeach; ?>
				</ul>
				</li>
			</ul>
		<?php } else { ?>
			<a href="<?php echo esc_url( $myaccount_url ); ?>" class="et-menu-account-btn icon <?php echo esc_attr( $button_style ); ?>"><span class="icon-text"><?php esc_html_e( 'Login', 'woocommerce' ) ?></span> <?php echo goya_load_template_part('assets/img/svg/user.svg'); ?></a>
		<?php }
	}

	add_action( 'goya_get_myaccount_link', 'goya_get_myaccount_link' );


/* Wishlist
---------------------------------------------------------- */

	/* Wishlist icon on header */
	function goya_quick_wishlist() {

		if ( ! class_exists( 'YITH_WCWL' ) || ! goya_wc_active() )  {
			return;
		}
		
		$url = YITH_WCWL()->get_wishlist_url();
		$count = yith_wcwl_count_products();
		$countp = ($count > 0) ? $count : '';
		?>
		<a href="<?php echo esc_url( $url ); ?>" class="quick_wishlist icon">
			<span class="text"><?php esc_attr_e('Wishlist', 'goya' ); ?></span>
			<?php echo goya_load_template_part('assets/img/svg/heart.svg'); ?>
			<span class="item-counter et-wishlist-counter<?php if ($count > 0) echo esc_attr( ' active' ); ?>"><?php echo esc_attr( $countp ); ?></span>
		</a>
	<?php
	}

	add_action( 'goya_quick_wishlist', 'goya_quick_wishlist' );

	/* Wishlist button on products */
	add_filter( 'goya_wishlist_button_output', 'goya_wishlist_button' );

	function goya_wishlist_button($loop) {

		if ( class_exists( 'YITH_WCWL' ) && get_theme_mod('shop_catalog_mode', false) == false )  {
			echo do_shortcode('[yith_wcwl_add_to_wishlist]');			
		}
	}

	if( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_ajax_update_count' ) ){
		
		function yith_wcwl_ajax_update_count(){
			wp_send_json( array(
			'count' => yith_wcwl_count_products()
			) );
		}

		add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
		add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
	}

	
	/* Remove default YITH Wishlist shortcode */
	if ( class_exists( 'YITH_WCWL_Frontend' ) )  {
		remove_action( 'wp_head', array( YITH_WCWL_Frontend(), 'add_button' ) );
		update_option( 'yith_wcwl_show_on_loop', 'yes');
		update_option( 'yith_wcwl_ajax_enable', 'no');
		update_option( 'yith_wcwl_button_position', 'shortcode');
		update_option( 'yith_wcwl_loop_position', 'shortcode');
		update_option( 'add_to_wishlist-position', 'shortcode');
		update_option( 'add_to_wishlist_catalog-position', 'shortcode');
		update_option( 'yith_wcwl_rounded_corners', 0);
	}	

	
	/* Single Product: Render wishlist on single product pages */
	function goya_wishlist_button_product() {
		echo apply_filters( 'goya_wishlist_button_output', '' );
	}

	
	/* Mini Cart
	---------------------------------------------------------- */

		/* Mini Cart: Header Button */
		function goya_quick_cart() {

			if( ! goya_wc_active() ) {
				return;
			}

			if ( get_theme_mod('shop_catalog_mode', false) == false ) {
				$cart_count = apply_filters( 'goya_cart_count', WC()->cart->cart_contents_count );
				$count_class = ( $cart_count > 0 ) ? '' : ' et-count-zero';
			?>
				<a data-target="open-cart" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('Cart', 'goya' ); ?>" class="quick_cart icon">
					<span class="text"><?php esc_attr_e('Cart', 'goya' ); ?></span>
					<?php echo goya_load_template_part('assets/img/svg/shopping-'. get_theme_mod('header_cart_icon', 'bag').'.svg'); ?>
					<span class="item-counter minicart-counter<?php echo esc_attr( $count_class ); ?>"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>
				</a>
			<?php
			}
		}
		add_action( 'goya_quick_cart', 'goya_quick_cart', 3 );


		