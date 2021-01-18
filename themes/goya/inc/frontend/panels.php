<?php

/* Popup */
function goya_popup_modal() {
	
	$goya_popup = goya_meta_config('','popup_modal',false);
	$classes[] = 'popup-layout-' . goya_meta_config('','popup_layout','1-col');
	$classes[] = goya_meta_config('','popup_color_style','');

	if(!is_admin() && $goya_popup ) {
		$cookie = isset($_COOKIE['goya_popup']) ? wp_unslash($_COOKIE['goya_popup']) : false;
		$cookie = apply_filters( 'goya_popup_cookie', $cookie );
		$delay = isset($cookie) ? goya_meta_config('','popup_delay',3) * 1000 : 0;

		if (!$cookie) {
			$popup_content = get_theme_mod( 'popup_content', '' );
			$popup_image = get_theme_mod( 'popup_image', '' );
		?>
		<aside id="goya-popup" rel="inline-auto" class="mfp-hide mfp-automatic goya-popup <?php echo implode(' ', $classes); ?>" data-class="goya-popup" data-delay="<?php echo esc_attr( $delay ); ?>">
			<div class="popup-wrapper">
				<?php
				if ( strlen( $popup_image ) > 0 ) {
					$popup_image = ( is_ssl() ) ? str_replace( 'http://', 'https://', $popup_image ) : $popup_image;
				} ?>
				<div class="popup-image">
					<div class="image-wrapper" style="background-image: url(<?php echo esc_attr($popup_image); ?>)"><img src="<?php echo esc_attr($popup_image); ?>" alt="goya-popup" class="lazyload"></div>
				</div>
				<div class="popup-content">
					<div class="content-wrapper">
						<?php if ($popup_content) { echo do_shortcode( wp_kses_post( $popup_content ) ); } ?>
					</div>
				</div>
			</div>
		</aside>
		<?php
		}
	}
}
add_action( 'goya_after_site', 'goya_popup_modal' );


/* Cookie length */
function goya_get_cookie_length() {
	$popup_interval = get_theme_mod('popup_frequency', '1');
	$time = '';
	switch ($popup_interval) {
		case '0':
			$time = 0;
			break;
		case '1':
			$time = DAY_IN_SECONDS;
			break;
		case '2':
			$time = DAY_IN_SECONDS * 2;
			break;
		case '3':
			$time = DAY_IN_SECONDS * 3;
			break;
		case '7':
			$time = WEEK_IN_SECONDS;
			break;
		case '14':
			$time = WEEK_IN_SECONDS * 2;
			break;
		case '21':
			$time = WEEK_IN_SECONDS * 3;
			break;
		case '30':
			$time = DAY_IN_SECONDS * 30;
			break;
	}
	return $time;
}

/* Cookie checker */
function goya_popup_cookie() {
	$popup_interval = get_theme_mod('popup_frequency','1');
	$time = goya_get_cookie_length();
	
	if ($time) {
		if (isset($_COOKIE['goya_popup'])) {
			if ($_COOKIE['goya_popup'] !== $popup_interval) {
				setcookie('goya_popup', '1', time() + $time, COOKIEPATH, COOKIE_DOMAIN);
			} else {
				return;
			}
		} else {
			setcookie('goya_popup', '1', time() + $time, COOKIEPATH, COOKIE_DOMAIN);
		} 
	} else {
		setcookie('goya_popup', '', time() - 3600, COOKIEPATH, COOKIE_DOMAIN );	
	}
}
add_action( 'init', 'goya_popup_cookie');


/* Mobile/Side Menu Panel*/
function goya_mobile_menu() {

	get_template_part( 'inc/templates/header/mobile-menu' );

}
add_action( 'goya_after_site', 'goya_mobile_menu' );


/* FullScreen Menu Panel */

function goya_fullscreen_panel() { 

	global $goya;

	if ( empty( $goya['panels'] ) || ! in_array( 'hamburger', $goya['panels'] ) ) {
		return;
	}
	
	get_template_part( 'inc/templates/header/fullscreen-menu' );

}
add_action( 'goya_after_site', 'goya_fullscreen_panel' );


/* Mini Cart Panel */
function goya_quick_cart_panel() {
	global $goya;

	if ( empty( $goya['panels'] ) || ! in_array( 'cart', $goya['panels'] ) ) {
		return;
	}

	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	$classes[] = 'side-panel mini-cart';
	$classes[] = goya_meta_config('header', 'cart_position', 'side');
	$classes[] = goya_meta_config('header', 'cart_color', 'light');

	if ( !is_cart() ) {
	?>
		<nav id="side-cart" class="<?php echo implode(' ', $classes); ?>">
			<header>
				<div class="container">
					<div class="panel-header-inner">
					<h6><?php esc_html_e('Cart', 'goya' ); ?> <?php echo goya_minicart_items_count(); ?></h6>
					<a href="#" class="et-close remove" title="<?php esc_attr_e('Close', 'goya'); ?>"></a>
					</div>
				</div>
			</header>
			<div class="side-panel-content container widget_shopping_cart">
				<div id="minicart-loader">
					<h5 class="et-loader"><?php esc_html_e( 'Updating&hellip;', 'goya' );?></h5>
				</div>
				<div class="widget_shopping_cart_content">
					<?php woocommerce_mini_cart(); ?>
				</div>
			</div>
		</nav>
	<?php
	}
}
add_action( 'goya_after_site', 'goya_quick_cart_panel',3 );


/* Quick Login Panel*/

function goya_quick_login_panel() {

	global $goya;

	if ( empty( $goya['panels'] ) || ! in_array( 'account', $goya['panels'] ) ) {
		return;
	}

	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	if ( get_theme_mod('main_header_login_popup', false) && ! is_user_logged_in() && ! is_account_page() ) {
		?>
	 <div id="et-login-popup-wrap" class="et-login-popup-wrap mfp-hide">
		<?php wc_get_template( 'myaccount/form-login.php', array( 'is_popup' => true ) ); ?>
	 </div>
	<?php 
	}
}
add_action( 'goya_after_site', 'goya_quick_login_panel' );


/* Search Panel */

function goya_quick_search_panel() { 

	global $goya;

	if ( empty( $goya['panels'] ) || ! in_array( 'search', $goya['panels'] ) ) {
		return;
	}
	
	?>

	<nav class="search-panel side-panel">
		<header>
			<div class="container">
				<div class="panel-header-inner">
					<h6><?php esc_html_e('Search', 'goya' ); ?></h6>
					<a href="#" class="et-close remove" title="<?php esc_attr_e('Close', 'goya'); ?>"></a>
				</div>
			</div>
		</header>
		<div class="side-panel-content container">
			<div class="row justify-content-md-center">
				<div class="col-lg-10">
					<?php goya_search_box(); ?>
				</div>
			</div>
		</div>
	</nav>
	<?php
}
add_action( 'goya_after_site', 'goya_quick_search_panel' );


/* Quick View Panel: placeholder */

function goya_quick_view_panel() { 

	if ( get_theme_mod('product_quickview', true) == false ) {
		return;
	}
	?>
	<div id="et-quickview" class="clearfix"></div>
	<?php
}

add_action( 'goya_after_site', 'goya_quick_view_panel' );

