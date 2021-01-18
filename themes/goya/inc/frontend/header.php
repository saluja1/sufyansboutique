<?php

/* Header Styles
---------------------------------------------------------- */

function goya_header_styles() {
	/* Header Color Scheme */
	$classes[] = '';
	$header_color = '';
	$page_header_border = goya_meta_config('page','header_border',true);

	// All Woocommerce pages but product page
	if ( goya_is_woocommerce() && (! is_product() ) ) {

		$shop_hero_title = goya_meta_config('shop','hero_title','none');
		$shop_header_border = goya_meta_config('shop','header_border',true);

		// All shop pages
		if ( $shop_hero_title != 'none' && ! is_page() ) {
			if ( is_shop() && !is_search() ) {
				$header_color = goya_meta_config('shop','menu_color','dark-title');
				$classes[] = 'page-header-transparent';
			} else if ( is_product_category() && $shop_hero_title != 'main-hero') {
				$classes[] = 'page-header-transparent';
				$header_color = 'dark-title';
			} else {
				$classes[] = 'header-border-' . $shop_header_border;
				$classes[] = 'page-header-regular';
			}
		} elseif ( $shop_hero_title != 'none' && is_shop() && !is_search() ) {
			$classes[] = 'page-header-transparent';
			$header_color = 'dark-title';
		// All Woocommerce pages shop included
		} elseif ( $shop_hero_title == 'all-hero' && is_page() ) {
			$classes[] = 'page-header-transparent';
		} else {
			$classes[] = 'header-border-' . $shop_header_border;
			$classes[] = 'page-header-regular';
		}

		//Color mode of the hero title
		if ( $shop_hero_title != 'none' ) {
			if (is_shop() && !is_search() ) {	
					$classes[] = 'hero-' . goya_meta_config('shop','menu_color','dark-title');
			} elseif ( is_product_category() && $shop_hero_title != 'main-hero') {
				$cat = get_queried_object();
				$cat_id = $cat->term_id;
				if ( get_term_meta( $cat_id, 'header_id', true ) ) {
					$classes[] = 'hero-'.get_term_meta( $cat_id, 'shop_menu_color_cat', true );
					$header_color = get_term_meta( $cat_id, 'shop_menu_color_cat', true );
				}
			}
		} 

	// Single product page
	} else if ( goya_is_woocommerce() && ( is_product() ) ) {

		$product_layout = goya_meta_config('product','layout_single','regular');
		$is_showcase = ($product_layout == 'showcase') ? true : false;
		$transparent_header = goya_meta_config('product','transparent_header',false);
		$transparent_header_ex = goya_meta_config('product','transparent_header_ex',false);

		if ($transparent_header_ex == 'border') {
			$transparent_header = false;
		}

		if ($is_showcase) {
			$transparent_header = apply_filters( 'goya_showcase_transparent_header', true );
		}

		$shop_header_border = goya_meta_config('shop','header_border',true);

		if ( $transparent_header == true ) {
			$single_prod_header = get_post_meta(get_queried_object_id(), 'goya_product_header_style', true);
			$single_prod_transparent = get_post_meta(get_queried_object_id(), 'goya_product_transparent_header', true);
			$global_prod_header = get_theme_mod('product_header_color', 'dark-title');

			$classes[] = 'page-header-transparent';
			$header_color = ($single_prod_header && $single_prod_transparent) ? $single_prod_header : $global_prod_header;
		} else {
			$classes[] = 'header-border-' . $shop_header_border;
			$classes[] = 'page-header-regular';
		}
		
		/* Showcase Background */
		$showcase_text = goya_meta_config('product','showcase_style','dark-text');
		$classes[] = 'product-showcase-' . $showcase_text;

		/* Sticky product bar */
		if ( goya_meta_config( 'product', 'sticky_bar', true ) == true ) { 
			$classes[] = 'fixed-product-bar';
			$classes[] = 'fixed-product-bar-' . goya_meta_config('product', 'sticky_bar_position', 'top' );
			$classes[] = 'fixed-product-bar-mobile-' . goya_meta_config('product','sticky_bar_mobile', false );
		}

	// Other pages
	} else	if ( is_page() ) {

		$transparent_header = get_post_meta(get_queried_object_id(), 'goya_page_transparent_header', true);
		$title_style = get_post_meta(get_queried_object_id(), 'goya_page_title_style', true);

		if($title_style != 'hide') {
			$classes[] = 'page-title-visible';
		}

		if ($title_style == 'hero') {
			$classes[] = 'hero-title-active hero-'.get_post_meta(get_queried_object_id(), 'goya_page_hero_title_style', true);
		}

		if ( $transparent_header == 'transparent' ) {
			$classes[] = 'page-header-transparent';
			$header_color = get_post_meta(get_queried_object_id(), 'goya_page_header_style', true);
		} else {
			$classes[] = 'page-header-regular';
			$classes[] = 'header-border-' . $page_header_border;
		}

	// Single portfolio
	} elseif ( is_singular('portfolio') ) {

		$title_style = goya_meta_config('portfolio','title_style','parallax');
		$header_style = get_theme_mod('portfolio_header_style','dark-title');
		$transparent_header = goya_meta_config('portfolio','transparent_header',false);

		$title_style_meta = get_post_meta(get_queried_object_id(), 'goya_portfolio_title_style', true);
		$header_style_meta = get_post_meta(get_queried_object_id(), 'goya_portfolio_header_style', true);
		$transparent_header_meta = get_post_meta(get_queried_object_id(), 'goya_portfolio_transparent_header', true);

		$hero_title_style = ($title_style_meta == false ) ? get_theme_mod('portfolio_header_style', 'dark-title') : get_post_meta(get_queried_object_id(), 'goya_portfolio_hero_title_style', true); 
		

		if($title_style != 'hide') {
			$classes[] = 'page-title-visible';
		}

		if ($title_style == 'hero' || $title_style == 'parallax') {
			$classes[] = 'hero-title-active hero-'.$hero_title_style;
		}

		if ( $transparent_header == true && ($title_style == 'hero' || $title_style == 'parallax') ) {
			$classes[] = 'page-header-transparent';
			if ($transparent_header_meta == 'transparent') {
				$header_color = $header_style_meta;
			} else {
				$header_color = $header_style;
			}
		} else {
			$classes[] = 'page-header-regular';
			$classes[] = 'header-border-' . $page_header_border;
		}

	// Knowledge Base
	} elseif ( is_singular('ht_kb') || is_post_type_archive('ht_kb') || is_tax('ht_kb_category') || is_tax('ht_kb_tag') || array_key_exists('ht-kb-search', $_REQUEST) ) {
		$classes[] = 'page-header-transparent';
		$classes[] = 'header-border-0';

	// Single post
	} elseif ( is_single() ) {

		$format = get_post_format();
		$feat_gallery = goya_meta_config('post','featured_image','below');
		$transparent_header = goya_meta_config('post','transparent_header',false);
		$hero_title = goya_meta_config('blog','hero_title',false);
		$hero_title = false;
		$tcolor = get_post_meta(get_queried_object_id(), 'goya_post_header_style', true);
		$title_color = (!empty($tcolor)) ? $tcolor : 'light-title';

		if ( $transparent_header == true && ( ( $feat_gallery == 'parallax' && $format != 'video' ) || ( $hero_title == true && $feat_gallery == 'regular' ) ) ) {
			$classes[] = 'page-header-transparent';
			$header_color = $tcolor;
		} else {
			$classes[] = 'page-header-regular';
			$classes[] = 'header-border-' . $page_header_border;
		}
		$classes[] = 'hero-' . $tcolor;
	
	// Blog
	} elseif ( goya_is_blog() ) {

		$hero_title = goya_meta_config('blog','hero_title',false);

		$header_color = goya_meta_config('blog','menu_color','dark-title');

		$classes[] = 'hero-' . goya_meta_config('blog','menu_color','dark-title');

		if ( $hero_title == true ) {
			$classes[] = 'page-header-transparent';
		} else {
			$classes[] = 'page-header-regular';
			$classes[] = 'header-border-' . $page_header_border;
		}

	// Everything else
	} else {
		$classes[] = 'page-header-regular';
		$classes[] = 'header-border-' . $page_header_border;
	}
	
	if ($header_color == '') {
		$header_color = get_theme_mod('header_regular_mode', 'dark') . '-title';
	}

	/* Sticky Header Color Scheme */
	$classes[] = 'sticky-header-' . get_theme_mod('header_regular_mode', 'dark');

	// Transparent header on mobiles
	$header_transparent_mobiles = goya_meta_config('','header_transparent_mobiles',true);
	$classes[] = ( $header_transparent_mobiles == true ) ? 'header-transparent-mobiles' : '';
	

	if( goya_wc_active() ) {
		//Catalog Mode
		$classes[] = ( get_theme_mod( 'shop_catalog_mode', false ) == true ) ? 'shop-catalog-mode' : '';

		if (class_exists('argMC\WooCommerceCheckout')) {
			$classes[] = 'woocommerce-multistep';
		}
	}

	$main_header_color = post_password_required() ? false : $header_color;

	$classes[] = $main_header_color;

	return $classes;
}

/* Header Classes
---------------------------------------------------------- */

function goya_header_classes() {

	$header_layout = goya_meta_config('','header_layout','prebuild');
	if ($header_layout != 'custom') {
		$version = goya_meta_config('','header_version','v6');
		$header_layout = apply_filters( 'goya_header_version_meta', $version );
	}
	
	$mobile_logo = goya_meta_config('mobile','logo_center','center');

	$classes[] = 'header site-header';
	$classes[] = 'header-'.$header_layout;
	$classes[] = 'sticky-display-' . goya_meta_config( '','header_sticky_sections','top' );
	$classes[] = 'mobile-logo-' . $mobile_logo;

	return $classes;
}

 add_filter( 'goya_header_class', 'goya_header_classes' );


/* Page Transition
---------------------------------------------------------- */

function goya_page_transition() {
	if ( goya_meta_config('','page_transition',false) == false ) {
		return;
	}

	$loader = get_theme_mod( 'page_transition_style', 'dot3-loader' ); ?>

	<div id="et-page-load-overlay" class="et-page-load-overlay">
		<span class="loader">
			<?php if ($loader == 'custom-loader') { ?>
				<img src="<?php echo esc_attr( get_theme_mod( 'page_transition_icon', '' ) ); ?>" class="custom-loader" />
			<?php } else { ?>
				<span class="<?php echo esc_attr( $loader ); ?>"></span>
			<?php } ?>
		</span>
	</div>

<?php }

add_action( 'goya_before_site', 'goya_page_transition' );


/* Site Global Layout
---------------------------------------------------------- */

function goya_site_layout() {
	if ( goya_meta_config('site','general_layout','regular') != 'framed' ) {
		return;
	}

	echo '<span class="frame-spacer line-top"></span><span class="frame-spacer line-right"></span><span class="frame-spacer line-bottom"></span><span class="frame-spacer line-left"></span>';

}

add_action( 'goya_before_site', 'goya_site_layout' );


/* Campaign Bar
---------------------------------------------------------- */

function goya_campaigns() {
	if ( goya_meta_config('','campaign_bar',false) == false ) {
		return;
	}

	get_template_part( 'inc/templates/header-parts/campaigns' );

	
}

add_action( 'goya_before_site', 'goya_campaigns', 99 );



/* Top Bar
---------------------------------------------------------- */

function goya_topbar() {
	if ( goya_meta_config('','top_bar',false) == false ) {
		return;
	}

	get_template_part( 'inc/templates/header-parts/top-bar' );
}

add_action( 'goya_before_header', 'goya_topbar' );



/* Top Bar Items
---------------------------------------------------------- */

function goya_topbar_elements( $item ) {
	switch ( $item ) {
		case 'menu':
			if ( has_nav_menu( 'topbar-menu' ) ) {
				wp_nav_menu( array(
					'theme_location' => 'topbar-menu',
					'depth' => 1,
					'container' => false,
					'menu_class' => 'et-top-menu'
				) );
			}
			break;

		case 'social':
			echo goya_social_profiles( 'top-bar-social-icons' );
			break;

		case 'currency':
			do_action( 'goya_currency_switcher' );
			break;

		case 'language':
			do_action( 'goya_language_switcher' );
			break;

		case 'text':
			echo '<div class="et-top-bar-text text-1">' . do_shortcode( wp_kses( get_theme_mod('top_bar_text', ''), 'essentials' ) ) .'</div>';
			break;

		case 'text2':
			echo '<div class="et-top-bar-text text-2">' . do_shortcode( wp_kses( get_theme_mod('top_bar_text2', ''), 'essentials' ) ) .'</div>';
			break;

		case 'text3':
			echo '<div class="et-top-bar-text text-3">' . do_shortcode( wp_kses( get_theme_mod('top_bar_text3', ''), 'essentials' ) ) .'</div>';
			break;

		default:
			do_action( 'goya_topbar_main_item', $item );
			break;
	}
}

/* Hamburger Menu */
function goya_hamburger($menu) {

?>
	<div class="hamburger-menu">
		<button class="menu-toggle <?php echo esc_attr( $menu ) ?>-toggle" data-target="<?php echo esc_attr( $menu ) ?>-menu"><span class="bars"><?php get_template_part('assets/img/svg/menu.svg'); ?></span> <span class="name"><?php esc_attr_e( 'Menu', 'goya' ); ?></span></button>
	</div>
<?php }

add_action( 'goya_hamburger', 'goya_hamburger' );


/* Fullscreen menu check */
function goya_has_fullscreen_menu() {

	if (has_nav_menu( 'fullscreen-menu' )) {
		$fullscreen_menu = 'fullscreen-menu';
	} else if (has_nav_menu( 'primary-menu' )) {
		$fullscreen_menu = 'primary-menu';
	} else {
		$fullscreen_menu = false;
	}

	return $fullscreen_menu;
}


/* Header
---------------------------------------------------------- */


function goya_header() {
	get_template_part( 'inc/templates/header/header-default' );
}

add_action( 'goya_header', 'goya_header' );


/* Header Layout 
*/
function goya_header_content() {
	if ( 'prebuild' == goya_meta_config( '','header_layout','prebuild' ) ) {

		$version = goya_meta_config( '','header_version','v6' );
		$header_version = apply_filters( 'goya_header_version_meta', $version );

		$header_main = array();
		$header_bottom = array();
		
		switch ( $header_version ) {

			case 'v1':
				$elements   = array(
					'left'   => array('hamburger','menu-primary'),
					'center' => array('logo'),
					'right'  => array('account','search','wishlist','cart'),
				);
				break;

			case 'v2':
				$elements = array(
					'left'   => array('hamburger','search'),
					'center' => array('menu-primary','logo','menu-secondary'),
					'right'  => array('account','cart'),
				);
				break;

			case 'v3':
				$elements = array(
					'left'   => array('hamburger','search'),
					'center' => array('logo'),
					'right'  => array('account','cart'),
				);
				break;

			case 'v4':
				$elements = array(
					'left'  => array('hamburger','logo','menu-primary'),
					'right' => array('account','search','wishlist','cart'),
				);
				break;

			case 'v5':
				$elements = array(
					'left'  => array('hamburger','logo'),
					'right' => array('account','search','wishlist','cart'),
				);
				break;

			case 'v6':
				$elements = array(
					'left'   => array('hamburger','logo'),
					'center' => array('menu-primary'),
					'right'  => array('account','search','cart'),
				);
				break;

			case 'v7':
				$elements = array(
					'left'  => array('logo','menu-primary'),
					'right' => array('account','search','cart','hamburger'),
				);
				break;

			case 'v8':
				$elements = array(
					'left'  => array('logo','menu-primary'),
					'right' => array('account','search','cart'),
				);
				break;

			case 'v9':
				$elements = array(
					'left'   => array('hamburger','search'),
					'center' => array('logo'),
					'right'  => array('account','cart'),
				);
				$header_bottom = array(
					'center' => array(
						array( 'item' => 'menu-primary' ),
					),
				);
				break;
			
			default:
				break;
		}

		foreach($elements as $sec => $val) {
			unset($item);
			foreach($val as $el) {
				$item[] = array( 'item' => $el );
			}
			$header_main[$sec] = $item;
		}

	} else {

		$header_main = array(
			'left'   => goya_meta_config( '','header_main_left','' ),
			'center' => goya_meta_config( '','header_main_center','' ),
			'right'  => goya_meta_config( '','header_main_right','' ),
		);
		
		$header_bottom = array(
			'left'   => goya_meta_config( '','header_bottom_left','' ),
			'center' => goya_meta_config( '','header_bottom_center','' ),
			'right'  => goya_meta_config( '','header_bottom_right','' ),
		);
		
	}

	goya_header_sections( $header_main, 'header-main');
	if (!empty($header_bottom)) {
		goya_header_sections( $header_bottom, 'header-bottom');
	}	

}

add_action( 'goya_header_inner', 'goya_header_content' );


/* Header Contents
---------------------------------------------------------- */

function goya_header_sections( $groups, $class ) {
	if ( false == array_filter( $groups ) ) {
		return;
	}

	$classes[] = $class;
	$classes[] = 'header-section';

	if ( empty( $groups['left'] ) && empty( $groups['right'] ) ) {
		unset( $groups['left'] );
		unset( $groups['right'] );
	}

	if ( ! empty( $groups['center'] ) ) {
		$center_items = wp_list_pluck( $groups['center'], 'item' );

		if ( in_array( 'menu-primary', $center_items ) || in_array( 'menu-secondary', $center_items ) ) {
			$classes[] = 'menu-center';
		}

		if ( in_array( 'logo', $center_items ) ) {
			$classes[] = 'logo-center';
		}

		if ( empty( $groups['left'] ) && empty( $groups['right'] ) ) {
			$classes[] = 'no-sides';
		}
	} else {
		$classes[] = 'no-center';
		unset( $groups['center'] );

		if ( empty( $groups['left'] ) ) {
			unset( $groups['left'] );
		}

		if ( empty( $groups['right'] ) ) {
			unset( $groups['right'] );
		}
	}

	?>
	<div class="<?php echo esc_attr( implode( ' ', $classes ) ) ?> ">
		<div class="header-contents container">
			<?php foreach ( $groups as $group => $items ) : ?>
				<div class="header-<?php echo esc_attr( $group ); ?>-items header-items">
					<?php goya_header_items( $items ); ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
}


/* Header Items
---------------------------------------------------------- */

function goya_header_items( $items ) {
	global $goya;

	if ( empty( $items ) ) {
		return;
	}

	foreach ( $items as $item ) {
		$item['item'] = $item['item'] ? $item['item'] : key( goya_header_elements_list() );
		$template = $item['item'];

		switch ( $item['item'] ) {
			
			case 'hamburger':
				do_action( 'goya_hamburger', 'fullscreen' );
				$template = '';
				$goya['panels'][] = $item['item'];
				break;

			case 'account':
				do_action( 'goya_get_myaccount_link', true );
				$template = '';
				$goya['panels'][] = $item['item'];
				break;

			case 'wishlist':
				do_action( 'goya_quick_wishlist' );
				$template = '';
				break;

			case 'search':
				do_action( 'goya_quick_search' );
				$template = '';
				$goya['panels'][] = $item['item'];
				break;
			
			case 'search-box':
				do_action( 'goya_search_box' );
				$template = '';
				break;
			
			case 'cart':
				if ( ! class_exists( 'WooCommerce' ) ) {
					break;
				}
				do_action( 'goya_quick_cart' );
				$template = '';
				$goya['panels'][] = $item['item'];
				break;

			case 'text':
				echo '<div class="et-header-text text-1">' . do_shortcode( wp_kses( get_theme_mod('header_custom_text', ''), 'essentials' ) ) .'</div>';
				break;

			case 'text2':
				echo '<div class="et-header-text text-2">' . do_shortcode( wp_kses( get_theme_mod('header_custom_text2', ''), 'essentials' ) ) .'</div>';
				break;

			case 'text3':
				echo '<div class="et-header-text text-3">' . do_shortcode( wp_kses( get_theme_mod('header_custom_text3', ''), 'essentials' ) ) .'</div>';
				break;

			case 'social':
				echo goya_social_profiles( 'header-social-icons' );
				break;

			case 'currency':
				do_action( 'goya_currency_switcher' );
				break;

			case 'language':
				do_action( 'goya_language_switcher' );
				break;

		}

		if ( $template ) {
			get_template_part( 'inc/templates/header-parts/' . $template );
		}
	}
}


/* Vertical Panel Bar
---------------------------------------------------------- */

function goya_vertical_panel_bar() {
	if ( goya_meta_config('','vertical_bar',true) == true ) {
	
		$bar_mode = ( goya_meta_config('','vertical_bar_mode', 'light') == 'dark' ) ? 'dark' : 'light';
		$bar_style = apply_filters( 'goya_menu_style', $bar_mode );
		?>

		<div class="mobile-bar <?php echo esc_attr( $bar_style ) ?>">
			<a href="#" class="et-close remove" title="<?php esc_attr_e('Close', 'goya'); ?>"></a>

			<div class="action-icons">
				<?php do_action( 'goya_vertical_bar_icons', 'vertical_bar' ); ?>
			</div>
			
		</div>
		
	<?php } else { ?>

		<header>
		<div class="container">
				<div class="panel-header-inner">
				<a href="#" class="et-close remove" title="<?php esc_attr_e('Close', 'goya'); ?>"></a>
				</div>
			</div>
		</header>

	<?php }

}

add_action( 'goya_vertical_panel_bar', 'goya_vertical_panel_bar', 99 );



/* Mobile Header
----------------------------------------------------------*/

/* Mobile Header/Vertical Bar  Icons */

function goya_panel_header_icons($position) {

	if ($position == 'mobile_header') {
		$icons = goya_meta_config('','mobile_header_icons', array( array( 'item' => 'cart' ) ));
		$is_header = true;
	} else {
		$icons = goya_meta_config('','vertical_bar_icons', array( 'account', 'wishlist' ));
		$is_header = false;
	}

	if ( empty( $icons ) ) {
		return;
	}

	foreach ( $icons as $icon ) {
		if ($position == 'mobile_header') {
			$this_icon = $icon['item'] ? $icon['item'] : key( goya_mobile_header_elements_list() );
		} else {
			$this_icon = $icon ? $icon : key( goya_mobile_header_elements_list() );
		}

		switch ( $this_icon ) {
			case 'cart':
				if ( ! class_exists( 'WooCommerce' ) ) {
					break;
				}
				do_action( 'goya_quick_cart' );
				break;

			case'wishlist':
				do_action( 'goya_quick_wishlist' );
				break;

			case 'search':
				do_action( 'goya_quick_search' );
				break;

			case 'account':
				do_action( 'goya_get_myaccount_link', $is_header );
				break;

			default:
				do_action( 'goya_mobile_header_icon', $this_icon );
				break;
		}
	}
}

add_action( 'goya_mobile_header_icons', 'goya_panel_header_icons' );
add_action( 'goya_vertical_bar_icons', 'goya_panel_header_icons' );


/* Mobile header */

function goya_mobile_header() {
	$classes[] = 'logo-' . goya_meta_config('','mobile_logo_position', 'center');
	?>

	<div class="header-mobile <?php echo esc_attr( implode( ' ', $classes ) ); ?>">
		<div class="header-contents container">
			<?php get_template_part( 'inc/templates/header/header', 'mobile' ); ?>
		</div>
	</div>

	<?php
}

add_action( 'goya_header_inner', 'goya_mobile_header', 99 );


/* Mobile menu */

function goya_mobile_menu_extras() {
	$items = goya_meta_config('','menu_mobile_items', array('account', 'divider1', 'currency', 'language', 'divider2', 'social') );

	foreach ( $items as $indx => $item ) {
		switch ( $item ) {

			case 'cart':
				if ( ! class_exists( 'WooCommerce' ) ) {
					break;
				}
				do_action( 'goya_quick_cart' );
				break;

			case 'wishlist':
				do_action( 'goya_quick_wishlist' );
				break;

			case 'account':
				if ( ! class_exists( 'WooCommerce' ) ) {
					break;
				} ?>

				<ul class="account-menu">
				<?php 
				if ( ! is_user_logged_in() ) {
					echo '<li class="account-link account-login"><a href="' . esc_url( wc_get_account_endpoint_url( 'dashboard' ) ) . '"><span class="text">' . esc_html__( 'Login', 'woocommerce' ) . '</span>' . goya_load_template_part('assets/img/svg/user.svg') . '</a></li>';
				} else {
					echo '<li class="account-link account-dashboard"><a href="' . esc_url( wc_get_account_endpoint_url( 'dashboard' ) ) . '"><span class="text">' . esc_html__( 'My Account', 'goya' ) . '</span>' . goya_load_template_part('assets/img/svg/user.svg') . '</a></li>';

					echo '<li class="account-link account-logout"><a href="' . esc_url( wc_get_account_endpoint_url( 'customer-logout' ) ) . '">' . esc_html__( 'Logout', 'goya' ) . '</a></li>';
				} ?>
				</ul>

				<?php break;

			case 'language':
				do_action( 'goya_language_switcher' );
				break;

			case 'currency':
				do_action( 'goya_currency_switcher' );
				break;

			case 'social':
				echo goya_social_profiles( 'mobile-social-icons' );
				break;

			case 'divider1':
			case 'divider2':
			case 'divider3':
			case 'divider4':
				echo '<div class="menu-divider"></div>';
				break;

			default:
				do_action( 'goya_mobile_menu_items', $item );
				break;
		}
	}
}

add_action( 'goya_after_mobile_menu', 'goya_mobile_menu_extras' );
