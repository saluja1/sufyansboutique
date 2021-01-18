<?php

/* Theme Support
---------------------------------------------------------- */

if ( ! function_exists( 'goya_theme_setup' ) ) {
	function goya_theme_setup() {

		// Loads wp-content/languages/themes/goya-it_IT.mo.
		load_theme_textdomain( 'goya', trailingslashit( WP_LANG_DIR ) . 'themes' );

		// Loads wp-content/themes/child-theme-name/languages/it_IT.mo.
		load_theme_textdomain( 'goya', get_stylesheet_directory() . '/languages' );

		// Loads wp-content/themes/goya/languages/it_IT.mo.
		load_theme_textdomain( 'goya', get_template_directory() . '/languages' );
		
		/* Background Support */
		add_theme_support( 'custom-background', array( 'default-color' => 'ffffff', 'wp-head-callback' => 'goya_change_custom_background' ) );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 80,
			'width'       => 200,
			'flex-width' => true,
		) );

		/* Post Formats */
		add_theme_support('post-formats', array('video', 'image', 'gallery'));

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );


		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Gutenberg: Color Pallete
		add_theme_support( 'editor-color-palette', array(
			array(
				'name' => esc_html__( 'White', 'goya' ),
				'slug' => 'gutenberg-white',
				'color' => '#ffffff',
			),
			array(
				'name' => esc_html__( 'Shade', 'goya' ),
				'slug' => 'gutenberg-shade',
				'color' => '#f8f8f8',
			),
			array(
				'name' => esc_html__( 'Gray', 'goya' ),
				'slug' => 'gutenberg-gray',
				'color' => esc_html( get_theme_mod( 'main_font_color', '#777777' ) ),
			),
			array(
				'name' => esc_html__( 'Dark', 'goya' ),
				'slug' => 'gutenberg-dark',
				'color' => esc_html( get_theme_mod( 'primary_buttons', '#282828' ) ),
			),
			array(
				'name' => esc_html__( 'Accent', 'goya' ),
				'slug' => 'gutenberg-accent',
				'color' => esc_html( get_theme_mod( 'accent_color', '#b9a16b' ) ),
			),
		) );


		/* Required Settings */
		if(!isset($content_width)) $content_width = 1140;
		
		
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style'
			)
		);


		/* Image Settings */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 150, 150, false );
		
		/* WooCommerce Support */
		add_theme_support( 'woocommerce');

		/* WooCommerce gallery */
		add_theme_support( 'wc-product-gallery-slider' );
		
		if ( get_theme_mod('product_image_lightbox', true) == true ) {
			add_theme_support( 'wc-product-gallery-lightbox' );
		}

		/* Disable WooCommerce wizard redirection */
		add_filter( 'woocommerce_prevent_automatic_wizard_redirect', '__return_true' );
		
		/* Register Menus */
		add_theme_support('nav-menus');
		register_nav_menus(
			array(
				'primary-menu'    => esc_html__( 'Main', 'goya' ),
				'topbar-menu'     => esc_html__( 'Top Bar', 'goya' ),
				'secondary-menu'  => esc_html__( 'Secondary', 'goya' ),
				'fullscreen-menu' => esc_html__( 'Full Screen', 'goya' ),
				'mobile-menu'     => esc_html__( 'Mobile', 'goya' ),
				'footer-menu'     => esc_html__( 'Footer', 'goya' )
			)
		);

		// Setup Admin Menus
		if ( is_admin() ) {
			goya_init_admin_pages();
		}
		
	}
}

add_action( 'after_setup_theme', 'goya_theme_setup' );


/* Remove Elementor redirection */

function goya_remove_elementor_splash() { 
	delete_transient( 'elementor_activation_redirect' );
}
add_action( 'init', 'goya_remove_elementor_splash' );


/* WP Bakery adjustments */

function goya_vc_theme_adjust() {

	if ( get_theme_mod('js_composer_standalone', false) == true ) {
		return;
	}
	
	// Disable plugin update message  
	vc_manager()->disableUpdater(true);

	// Bundled with the theme
	if ( function_exists( 'vc_set_as_theme' ) ) {
		vc_set_as_theme();
	}

}

add_action( 'vc_before_init', 'goya_vc_theme_adjust' );


/* Admin menu */

function goya_init_admin_pages() {
	add_action( 'admin_menu', 'adminSetupMenu');
}

function adminSetupMenu() {
	
	// Theme main menu
	add_menu_page( esc_html__('Goya', 'goya'), esc_html__('Goya', 'goya'), 'edit_theme_options', 'goya-theme', 'goya_theme_welcome', '', 60 );
	
	$installer = TGM_Plugin_Activation::get_instance();
	if ( ! $installer->is_tgmpa_complete() ) {
		// Theme Setup
		add_submenu_page( 'goya-theme', esc_html__('Setup Wizard', 'goya'), esc_html__('Setup Wizard', 'goya'), 'edit_theme_options', 'merlin', '__return_false' );

		// Plugins
		add_submenu_page( 'goya-theme', esc_html__('Install Plugins', 'goya'), esc_html__('Install Plugins', 'goya'), 'edit_theme_options', 'install-required-plugins', '__return_false' );
	}

	if (class_exists('OCDI_Plugin')) {
		// Demo Import
		add_submenu_page( 'goya-theme', esc_html__('Demo Import', 'goya'), esc_html__('Demo Import', 'goya'), 'edit_theme_options', 'pt-one-click-demo-import', '__return_false' );
	}
	
	// Theme Options
	add_submenu_page( 'goya-theme', esc_html__('Customize', 'goya'), esc_html__('Customize', 'goya'), 'edit_theme_options', 'customize.php', '' ); 
	
}

function goya_theme_welcome() {
	get_template_part( 'inc/admin/settings/pages/welcome' );
}

// Redirect to Welcome Page disabled for Merlin
//add_action( 'after_switch_theme', 'goya_activation_redirect' ) ;

function goya_activation_redirect() {
	if ( ! ( defined( 'WP_CLI' ) && WP_CLI ) ) {
		$theme_installed = 'theme_installed';
		
		if ( false == get_option( $theme_installed, false ) ) {		
			update_option( $theme_installed, true );
			wp_redirect( admin_url( 'admin.php?page=goya-theme' ) );
			die();
		} 
		
		delete_option( $theme_installed );
	}
}

/* Set default image-size options
---------------------------------------------------------- */
	
	if ( ! function_exists( 'goya_woocommerce_set_image_dimensions' ) ) {
	  function goya_woocommerce_set_image_dimensions() {

	  	if( ! goya_wc_active() ) {
	  		return;
	  	}

	    if ( ! get_option( 'goya_shop_image_sizes_set' ) ) {

	      // Shop image sizes
	      if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.3', '<' ) ) {
	      	// WooCommerce 3.2 and below: Set image-size options
	      	$catalog = array(
	      	  'width' 	=> '600',
	      	  'height'	=> '',
	      	  'crop'		=> ''
	      	);
	      	$single = array(
	      	  'width' 	=> '900',
	      	  'height'	=> '',
	      	  'crop'		=> ''
	      	);
	      	$thumbnail = array(
	      	  'width' 	=> '',
	      	  'height'	=> '150',
	      	  'crop'		=> ''
	      	);
	      	update_option( 'shop_catalog_image_size', $catalog );
	      	update_option( 'shop_single_image_size', $single );
	      	update_option( 'shop_thumbnail_image_size', $thumbnail );

	      } else {
	        // WooCommerce 3.3 and above: Set WP Customizer image-size options
	        update_option( 'woocommerce_thumbnail_image_width', 600 );
	        update_option( 'woocommerce_thumbnail_cropping', 'uncropped' );
	        update_option( 'woocommerce_single_image_width', 900 );
	      }

	      // Set "image sizes set" option
	      add_option( 'goya_shop_image_sizes_set', '1' );
	    }
	  }
	}
	add_action( 'after_switch_theme', 'goya_woocommerce_set_image_dimensions', 1 ); // Theme activation hook
	add_action( 'admin_init', 'goya_woocommerce_set_image_dimensions', 1000 ); // Additional hook for when WooCommerce is activated after the theme


/* Body Classes
---------------------------------------------------------- */

function goya_body_classes( $classes ) {

	// Blog ID on Multisite
	$classes[] = 'blog-id-' . get_current_blog_id();
	// Site Layout
	$classes[] = 'et-site-layout-' . goya_meta_config('site','global_layout', 'regular');
	// WP Gallery Popup
	$classes[] = ( get_theme_mod('wp_gallery_popup', false) == true ) ? 'wp-gallery-popup' : '';
	// Campaign bar
	$cookie_campaign = isset($_COOKIE['et-global-campaign']) ? wp_unslash($_COOKIE['et-global-campaign']) : false;
	if(!$cookie_campaign) {
		$classes[] = get_theme_mod('campaign_bar', false) ? 'has-campaign-bar' : false;
	}
	// Top Bar
	$classes[] = ( goya_meta_config('','top_bar',false) == true ) ? 'has-top-bar' : '';
	// Mega menu
	$classes[] = ( goya_meta_config('','megamenu_fullwidth', true) == true ) ? 'megamenu-fullwidth' : '';
	$classes[] = ( goya_meta_config('','megamenu_column_animation', false) == true ) ? 'megamenu-column-animation' : '';
	// Sticky header
	$header_sticky = goya_meta_config('','header_sticky',true);
	$classes[] = ( $header_sticky == true ) ? 'header-sticky' : '';
	// Header full width
	$classes[] = ( goya_meta_config('','header_full_width', false) == true ) ? 'header-full-width' : '';
	//Buttons borders
	$classes[] = 'el-style-border-' . goya_meta_config('elements','border_style','all');
	$classes[] = 'el-style-border-width-' . goya_meta_config('elements','border_width', 2);
	$classes[] = ( goya_meta_config('elements','floating_labels',true) == true ) ? 'floating-labels' : '';
	// Page load transition
	$page_transition = goya_meta_config('','page_transition',false);
	$classes[] = ( $page_transition == true ) ? 'et-page-load-transition-true' : 'et-page-load-transition-false';
	// CSS animations preload class
	if( $page_transition == true ) {
		$classes[] = 'et-preload';
	}
	// Distraction Free Checkout
	if ( goya_wc_active() && is_checkout() ) {
		$checkout_style = goya_meta_config('','checkout_style','free');
		$classes[] = ( $checkout_style == 'regular' ) ? 'checkout-style-regular' : 'checkout-distraction-free';
	}
	// Login/Register two columns
	$classes[] = ( goya_meta_config('','login_two_columns', false ) == true ) ? 'login-two-columns' : 'login-single-column';
	if ( goya_wc_active() && !is_user_logged_in() && is_account_page() ) {
		$classes[] = 'et-woocommerce-account-login';
	}
	if ( goya_wc_active() && !is_user_logged_in() && !is_account_page() && get_theme_mod( 'main_header_login_popup', false ) == true ) {
		$classes[] = 'et-login-popup';
	}

	// Add extra classes for header styles
	$body_classes = array_filter( array_merge($classes, goya_header_styles() ) );

	return $body_classes;
}
add_filter( 'body_class', 'goya_body_classes' );


/* WordPress checks
---------------------------------------------------------- */

/* Check if it's a Blog page */
function goya_is_blog () {
	return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag()) && 'post' == get_post_type();
}

/* Check if WooCommerce is active */
function goya_wc_active() {
	return class_exists( 'woocommerce' );
}

/*Check if it's a WooCommerce page*/
function goya_is_woocommerce() {
	if (!goya_wc_active()) {
		return false;	
	}

	$woocommerce = false;

	if ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) {
		$woocommerce = true;
	}

	return $woocommerce;
	
}


/* Menu Caching
---------------------------------------------------------- */

function goya_get_cached_menu( $menuargs ) {

	if ( !isset( $menuargs['menu'] ) ) {
		$theme_locations = get_nav_menu_locations();
		$nav_menu_selected_id = $theme_locations[$menuargs['theme_location']];
		$termslug = get_term_by( 'id', $nav_menu_selected_id, 'nav_menu' );
		$transient = 'menu_' . $termslug->slug . '_transient';
	} else {
		$transient = 'menu_' . $menuargs['menu'] . '_transient';
	}

	if ( !get_transient( $transient ) ) { // check if the menu is already cached
		$menuargs['echo'] = '0'; // set the output to return
		$this_menu = wp_nav_menu( $menuargs ); // build the menu with the given $menuargs
		echo esc_attr( $this_menu ); // output the menu for this run
		set_transient( $transient, $this_menu ); // set the transient, where the build HTML is saved
	} else {
		echo get_transient( $transient ); // just output the cached version
	}

}

add_action('wp_update_nav_menu', 'goya_delete_menu_transients');
function goya_delete_menu_transients($nav_menu_selected_id) {
	$termslug = get_term_by( 'id', $nav_menu_selected_id, 'nav_menu' );
	$transient = 'menu_' . $termslug->slug . '_transient';
	delete_transient( $transient ); 
}


/* Custom Background Support
---------------------------------------------------------- */

function goya_change_custom_background() {
	$background = get_background_image();
	$color = get_background_color();

	if ( ! $background && ! $color )
		return;

	$style = $color ? "background-color: #$color;" : '';

	if ( $background ) {
		$image = " background-image: url('".esc_html($background)."');";

		$repeat = get_theme_mod( 'background_repeat', 'repeat' );
		if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) )
			$repeat = 'repeat';
		$repeat = " background-repeat: $repeat;";

		$position = get_theme_mod( 'background_position_x', 'left' );
		if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) )
			$position = 'left';
		$position = " background-position: top $position;";

		$attachment = get_theme_mod( 'background_attachment', 'scroll' );
		if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) )
			$attachment = 'scroll';
		$attachment = " background-attachment: $attachment;";

		$style .= $image . $repeat . $position . $attachment;
	}
?>
<style type="text/css">
body.custom-background #wrapper { <?php echo trim( $style ); ?> }
</style>
<?php
}


/* Gradient Generation */
function goya_css_gradient( $color_start, $color_end, $angle = -32, $full = true ) {

	$return = 'linear-gradient( ' . str_replace( 'deg', '', $angle ) . 'deg,' . esc_attr( $color_end ) . ',' . esc_attr( $color_start ) . ' )';
	
	if ( $full == true ) {
		return 'background:' . $color_start . ';background:' . $return . ';';
	}
	
	return $return;
}

/* Utilities
---------------------------------------------------------- */

/* Get config values */
function goya_meta_config( $type, $param, $default ) {
	$type = ($type) ? $type . '_' : '';
	$value = get_theme_mod($type . $param, $default);
	
	$meta = get_post_meta(get_queried_object_id(), 'goya_'. $type . $param, true);
	
	if ($meta) {
		$value = $meta;
	}
	
	return $value;
}

/* Add Shortcode */
function goya_add_short( $name, $call ) {
	$func = 'add' . '_shortcode';
	return $func( $name, $call );
}

/* Load Template */
function goya_load_template_part($template_name) {
	ob_start();
	get_template_part($template_name);
	$var = ob_get_contents();
	ob_end_clean();
	return $var;
}

/* Encoding/Decoding */
function goya_encode( $value ) {
	$func = 'base64' . '_encode';
	return $func( $value );
}

function goya_decode( $value ) {
	$func = 'base64' . '_decode';
	return $func( $value );
}

/* Add h6 to shop widgets if empty */

add_filter('widget_display_callback','accept_html_widget_title',10,3);

function accept_html_widget_title($instance, $widget, $args){

	$title = trim($instance['title']);

	if ($title == '') {
		$instance['title'] = $instance['title'] . '&nbsp;';
	}
	
  return $instance;
}


/* Use custom context for wp_kses */
function goya_prefix_kses_allowed_html($tags, $context) {
  
  switch($context) {
  
    case 'essentials': 
    	$tags = array( 
    	  'a' => array('href' => array()),
    	  'b' => array(),
    	  'p' => array(),
    	  'h1' => array(),
    	  'h2' => array(),
    	  'h3' => array(),
    	  'h4' => array(),
    	  'h5' => array(),
    	  'h6' => array(),
    	  'span' => array(),
    	  'small' => array(),
    	  'i' => array('class' => array()),
    	  'img' => array('src' => array()),
    	);
    	return $tags;

    default: 
      return $tags;
  }
}

add_filter( 'wp_kses_allowed_html', 'goya_prefix_kses_allowed_html', 10, 2);


/* Search
---------------------------------------------------------- */

/* Header Search Box */
function goya_quick_search() {
	do_action( 'goya_quick_search_button' );
}
add_action( 'goya_quick_search', 'goya_quick_search' );


/* Search field */
function goya_search_box() { ?>
	<div class="goya-search">
		<?php if( goya_wc_active() ) {
			if ( defined( 'YITH_WCAS' ) ) {
				// YITH WC Ajax Search plugin
				echo do_shortcode('[yith_woocommerce_ajax_search]');
			} else {
				get_product_search_form();
			}
		} else { 
			get_search_form(); 
		} ?>
	</div>
<?php }

add_action( 'goya_search_box', 'goya_search_box' );

/* Search button */
function goya_quick_search_button() {
	$search_popup = goya_meta_config('','search_popup',true);
	$search_mobiles = goya_meta_config('','search_mobiles','header_icon');
	?>
	<a href="#" class="quick_search icon popup-<?php echo esc_attr( $search_popup ); ?> search-<?php echo esc_attr( $search_mobiles ); ?>">
		<?php echo goya_load_template_part('assets/img/svg/search.svg'); ?>
	</a>
	<?php
}
add_action( 'goya_quick_search_button', 'goya_quick_search_button' );


/* Social 
---------------------------------------------------------- */

function goya_social_share() {
	if ( function_exists( 'goya_social_share_links' ) ) {?>
		<div class="post-share">
			<?php goya_social_share_links(); // From plugin goya-core  ?>
		</div>
	<?php }
}

add_action( 'goya_social_share', 'goya_social_share' );


/* Get social media profiles list */
function goya_social_profiles( $wrapper_class = 'social-icons-default' ) {

	$socials = goya_meta_config('','social_links', array());

	$output = '';
	foreach( $socials as $social ) {
		if (!empty ($social['name']) ) {
			$output .= '<li><a href="' . esc_url( $social['url'] ) . '" target="_blank" data-toggle="tooltip" data-placement="left" title="' . esc_attr( $social['name'] ) . '"><i class="et-icon et-' . esc_attr( $social['name'] ) . '"></i></a></li>';
		}
	}
	
	return '<ul class="social-icons ' . $wrapper_class . '">' . $output . '</ul>';

}

/* Remove intrusive advertising
---------------------------------------------------------- */

add_filter( 'stop_gwp_live_feed', '__return_true' );

