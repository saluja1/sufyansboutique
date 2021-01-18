<?php

if( ! goya_wc_active() ) {
	return;
}

/* Catalog Mode
---------------------------------------------------------- */
	if ( get_theme_mod('shop_catalog_mode', false) == true ) {
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	}

	/* Breadcrumbs */
	function goya_change_breadcrumb_delimiter( $defaults ) {
		// Change the breadcrumb delimeter from '/' to '>'
		$defaults['delimiter'] = ' <i>/</i> ';
		return $defaults;
	}
	add_filter( 'woocommerce_breadcrumb_defaults', 'goya_change_breadcrumb_delimiter' );


	/* WooCommerce Products per Page */
	function goya_woocommerce_products_per_page( $cols ) {
		$products_per_page = goya_meta_config('','products_per_page',12);
		return $products_per_page;
	}
	add_filter( 'loop_shop_per_page', 'goya_woocommerce_products_per_page', 20 );


	/* Pagination */
	function goya_woocommerce_pagination_args( $defaults ) {
		$defaults['prev_text'] = '&larr; '.esc_html__( 'Prev', 'goya' );
		$defaults['next_text'] = esc_html__( 'Next', 'goya' ).' &rarr;';
		
		return $defaults;
	}
	add_filter( 'woocommerce_pagination_args', 'goya_woocommerce_pagination_args' );


/* Search
---------------------------------------------------------- */
	
	/* Disable redirection to single product from the search field */
	add_filter( 'woocommerce_redirect_single_search_result', '__return_false' );

	function goya_search_by_category() {

		if ( ! get_theme_mod('search_categories', false) == true ) {
			return;
		}

		if(isset($_REQUEST['product_cat']) && !empty($_REQUEST['product_cat'])) {
			$optsetlect = sanitize_key( $_REQUEST['product_cat'] );
		} else {
			$optsetlect = 0;
		}

		$nindex = isset( $index ) ? absint( $index ) : 0;

		$args = array(
			'id'              => 'product_cat-' . $nindex,
			'name'            => 'wc-category',
			'show_option_all' => esc_html__( 'All Categories', 'goya' ),
			'hierarchical'    => 0,
			'class'           => 'cate-dropdown wc-category-select',
			'taxonomy'        => 'product_cat',
			'depth'           => 1,
			'echo'            => 1,
			'value_field'     => 'slug',
			'selected'        => $optsetlect,
			'hide_if_empty'   => true
		);

		wp_dropdown_categories($args);

	}


	/* Shop notices */
	function goya_wc_print_notices() {
		echo '<div id="woo-notices-wrapper">';
			if ( function_exists('wc_print_notices') ) {
				echo wc_print_notices();
			}
		echo '</div>';
	}


	/* Multi Currency */
	if ( class_exists('WCML_WC_MultiCurrency')) {
		global $WCML_WC_MultiCurrency;
		remove_action('woocommerce_product_meta_start', array($WCML_WC_MultiCurrency, 'currency_switcher'));
	}

	/* Display subcategories for current category */
	function goya_subcategories_by_id($parent_cat_ID) {

		$args = array(
		 'hierarchical' => 1,
		 'show_option_none' => '',
		 'hide_empty' => 1,
		 'parent' => $parent_cat_ID,
		 'taxonomy' => 'product_cat'
		);

		$subcats = get_categories($args); ?>

		<ul class="shop_categories_list">
			<?php foreach ($subcats as $sc) {
				$link = get_term_link( $sc->slug, $sc->taxonomy ); ?>
				<li><a href="<?php echo esc_url($link); ?>"><?php echo esc_attr($sc->name); ?></a></li>
			<?php } ?>
		</ul>

	<?php }


	/* Product Masonry Filter */
	function goya_product_categories_nav($categories, $id, $products_id_array = false) {
		
		if (empty($categories) || !$categories){
			$args = array(
				'type'			=> 'post',
				'orderby'		=> 'name',
				'order'			=> 'ASC',
				'hide_empty'	=> 0,
				'hierarchical'	=> 1,
				'taxonomy'		=> 'product_cat'
			);
			$categories = get_categories( $args );

		} ?>
		<nav class="et-portfolio-filter" id="et-filter-<?php echo esc_attr($id); ?>">

			<ul>
				<li class="active"><a><?php esc_html_e('All', 'goya' ); ?></a></li>
				<?php 
					 foreach ($categories as $cat) {
						$term = get_term_by( 'slug', $cat, 'product_cat' );
						echo '<li><a data-filter="cat-' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</a></li>';
					 }
				?>
			</ul>
		</nav>
		<?php
	}
	add_action( 'et-products-filter', 'goya_product_categories_nav', 1, 4 );


	/* Remove VC-added p tags */
	function goya_remove_vc_added_p($content) {
		if (substr( $content, 0, 4 ) === "</p>") {
			$content = substr($content, 4);
		}
		if (substr( $content, -3 ) === "<p>") {
			$content = substr($content, 0, -3);
		}
		return $content;
	}

	/* Product Category Grid Sizes */
	function goya_get_product_cat_grid_size($style, $i) {

		if ($style == 'style1') {
			switch($i) {
				case 1:
				case 11:
				case 21:
					$article_size = 'col-md-8';
					break;
				case 3:
				case 13:
				case 23:
					$article_size = 'col-md-4 double-height';
					break;
				default:
					$article_size = 'col-md-4 grid-sizer';
					break;
			} 
		} else if ($style == 'style2') {
			
			switch($i) {
				case 1:
				case 13:
					$article_size = 'col-md-6';
					break;
				case 2:
				case 4:
				case 5:
				case 6:
				case 9:
				case 8:
				case 10:
				case 11:
				case 14:
				case 15:
				default:
					$article_size = 'col-md-3 grid-sizer';
					break;
				case 3:
				case 7:
				case 12:
					$article_size = 'col-md-3';
					break;
			}	
		} else if ($style == 'style3') {
			
			switch($i) {
				case 1:
				case 2:
				case 6:
				case 7:
				case 11:
				case 12:
					$article_size = 'col-md-6';
					break;
				case 3:
				case 4:
				case 5:
				default:
					$article_size = 'col-md-4';
					break;
			}	
		}
		
		return $article_size;

	}


/* Shop Filters
---------------------------------------------------------- */

	/* Shop: Catalog Bar */

	function goya_shop_toolbar() {
		global $_chosen_attributes;

		$filters = get_theme_mod('shop_filters', true);
		$filter_position = goya_meta_config('shop','filter_position','header');

		?>

		<div class="shop_bar">
			<div class="row">
				
				<div class="col-md-6 category_bar">
					<?php do_action( 'goya_breadcrumbs' ); ?>
				</div>

				<div class="col-md-6">
					<?php if ( have_posts() ) : ?>
						<div class="shop-filters <?php if (get_theme_mod('shop_sticky_filters', false) ) { echo 'sticky-filters'; } ?>">
								
						<?php
						// Used for mobile filters
						if ( $filters ) : ?>
							<div class="filter-trigger-box">
								<button id="et-shop-filters" class="filter-trigger filter-popup"><span class="icon-filter"><?php echo goya_load_template_part('assets/img/svg/sliders.svg'); ?></span> <?php esc_html_e('Filters', 'goya'); ?><span class="et-active-filters-count"></span></button>
						 
								<?php 
								// Header filters button
								if ($filter_position == 'header') : ?>
									<button id="et-shop-filters-header" class="filter-trigger filter-top"><span class="icon-filter"><?php echo goya_load_template_part('assets/img/svg/sliders.svg'); ?></span> <span class="icon-close"><?php echo goya_load_template_part('assets/img/svg/x.svg'); ?></span> <?php esc_html_e('Filters', 'goya'); ?><span class="et-active-filters-count"></span></button>
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<?php do_action( 'goya_before_shop_loop_catalog_ordering' ); ?>

						<?php 
						$list_icon = get_theme_mod('shop_view_list', true);
						$small_icon = get_theme_mod('shop_view_small', true);
						?>
						<div class="shop-views <?php echo esc_attr( 'list-' . $list_icon . ' small-' . $small_icon ); ?>">
							<button id="shop-display-grid" class="shop-display grid-icon active" data-display="grid">
								<?php echo goya_load_template_part('assets/img/svg/grid.svg'); ?>
							</button>
							<button id="shop-display-small" class="shop-display small-icon" data-display="small">
								<?php echo goya_load_template_part('assets/img/svg/grid-small.svg'); ?>
							</button>
							<button id="shop-display-list" class="shop-display list-icon" data-display="list">
								<?php echo goya_load_template_part('assets/img/svg/menu.svg'); ?>
							</button>
						</div>

						</div>
					<?php endif; ?>
				</div>

			</div>

			<?php if ($filter_position == 'popup' || $filter_position == 'header'  ) : ?>
				<?php do_action( 'goya_shop_filters' ); ?>
			<?php endif; ?>
		</div>

	<?php }

	add_action( 'goya_shop_toolbar', 'goya_shop_toolbar' );

	/* Shop Filters: Side Panel and Mobile */
	function goya_shop_filters() {
		global $_chosen_attributes;
		$filter_position = goya_meta_config('shop','filter_position','header');

		$top_class = ($filter_position == 'header') ? 'row block-grid-' . get_theme_mod('shop_filters_columns', 4) : '' ;

		if ( ! is_search() ) { ?>
			<div id="side-filters" class="side-panel">
				<header>
					<h6><?php esc_html_e('Filters', 'goya' ); ?></h6>
					<a href="#" class="et-close button btn-sm" title="<?php esc_attr_e('Done', 'goya'); ?>"><?php esc_attr_e('Done', 'goya'); ?></a>
				</header>
				<div class="side-panel-content custom_scroll">
					<ul class="shop-sidebar <?php echo esc_attr($top_class); ?>">
						<?php if( goya_active_woocommerce_filters() ) {
							if ( 0 < count( $_chosen_attributes ) ) { ?>
								<div class="header-active-filters">
									<span class="active-filters-title"><?php esc_html_e('Active Filters:', 'goya'); ?>&nbsp;</span>
									<?php the_widget( 'WC_Widget_Layered_Nav_Filters' ); ?>
									<a class="filter-reset-all" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>"><?php esc_html_e('Reset All', 'goya'); ?></a>
								</div>
						<?php }
							} ?>
						<?php if ( is_active_sidebar( 'widgets-shop' ) ) { dynamic_sidebar( 'widgets-shop' ); }?>
					</ul>
				</div>
			</div>
			<?php
		}
	}
	add_action( 'goya_shop_filters', 'goya_shop_filters' );

	/* WooCommerce filters */
	function goya_active_woocommerce_filters() {
		global $_chosen_attributes;

		$_chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();

		return $_chosen_attributes;

	}

	/* WC Ajax Filters Active */
	function goya_wc_ajax_filters_active() {
		global $wcapf;

		$active_filters = $wcapf->getChosenFilters();
		$active_filters = $active_filters['active_filters'];

		$active_filters = apply_filters( 'goya_wc_active_filters', $active_filters );

		if (sizeof($active_filters) > 0) {
			
			$instance = array(
				'title' => esc_attr( 'Active Filters:', 'goya' ),
				'button_text' => esc_attr( 'Remove All', 'goya' ),
			);

			the_widget( 'WCAPF_Active_Filters_Widget', $instance );

		} else {
			do_action( 'goya_breadcrumbs' );
		}

	}


	function goya_wc_ajax_filters() {
		if (class_exists('WCAPF') ) {
			$wcapf = get_option('wcapf_settings');
			$wcapf['scroll_to_top_offset'] = '150';
			$wcapf['enable_font_awesome'] = 0;
			update_option('wcapf_settings', $wcapf);
		}	
	}

	add_action( 'after_setup_theme', 'goya_wc_ajax_filters' );


/* Mini Cart
---------------------------------------------------------- */

	/* Get items count */
	function goya_minicart_items_count() {
		$cart_count = apply_filters( 'goya_cart_count', WC()->cart->cart_contents_count );
		$count_class = ( $cart_count > 0 ) ? '' : ' et-count-zero';
				
		return '<span class="item-counter minicart-counter' . $count_class . '">' . $cart_count . '</span>';
	}

	/* Update minicart counter */
	function goya_minicart_update($fragments) {
		$cart_count = goya_minicart_items_count();
		$fragments['.minicart-counter'] = $cart_count;
		return $fragments;
	}
	add_filter('woocommerce_add_to_cart_fragments', 'goya_minicart_update'); 


	/* Replace values on ajax add to cart */
	function goya_single_ajax_add_to_cart_refresh() {
		if ( isset( $_REQUEST['single-ajax-add-to-cart'] ) ) {
			goya_wc_print_notices();

			//Refresh mini cart
			echo goya_minicart_items_count();
			woocommerce_mini_cart();

			exit;
		}
	}
	add_action( 'wp', 'goya_single_ajax_add_to_cart_refresh', 1000 );

	/* Minicart update totals */
	function goya_minicart_quantity_update( $cart_updated ) {
	  if ( isset( $_REQUEST['minicart_qty_update'] ) && $cart_updated ) {
	    WC()->cart->calculate_totals();
	    return false;
	  }
	}
	add_action( 'woocommerce_update_cart_action_cart_updated', 'goya_minicart_quantity_update' );


/* Checkout
---------------------------------------------------------- */

	function goya_back_button($context) {
		
		if ( $context == 'checkout' ) { ?>
		
			<div class="back-to-cart"><a class="button outlined" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('Back to Cart', 'goya' ); ?>" ><?php esc_html_e('Back to Cart', 'goya' ); ?> </a></div>
		
		<?php } else if ( $context == 'cart' && wc_get_page_id( 'shop' ) > 0 ) { ?>
		
			<div class="back-to-shop"><a class="button outlined" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>" title="<?php esc_attr_e('Back to Shop', 'goya' ); ?>" ><?php esc_html_e('Continue Shopping', 'goya' ); ?> </a></div>

		<?php } else if ( $context == 'minicart' && wc_get_page_id( 'shop' ) > 0 ) { ?>
			
			<p class="woocommerce-mini-cart__buttons buttons">
			  <a href="<?php echo esc_url( apply_filters( 'continue_shopping_url', get_permalink( wc_get_page_id( 'shop' ) ) ) ); ?>" id="et-cart-panel-continue" class="button outlined"><?php esc_html_e( 'Continue Shopping', 'goya' ); ?></a>
			</p>

		<?php }
		
	}

	add_action( 'goya_back_button', 'goya_back_button' );


	// Buy Now Woo plugin forces is_checkout on single page
	function goya_is_real_checkout() {
		if ( class_exists('Buy_Now_Woo') && is_product() ) {
			$is_checkout = false;
		} else {
			$is_checkout = is_checkout();
		}
		
		return $is_checkout;	
	}


	function goya_toggle_registration_login($context) {
		
		if ( $context == 'login' ) { ?>
			
			<p class="form-actions extra"><?php esc_html_e('Already a member?', 'goya'); ?><a href="#et-login-wrap" class="login-link"><?php esc_html_e('Login', 'woocommerce'); ?></a></p>
		
		<?php } else if ( $context == 'register' ) { ?>
		
			<p class="form-actions extra"><?php esc_html_e('Not a member?', 'goya'); ?><a href="#et-register-wrap" class="register-link"><?php esc_html_e('Register', 'woocommerce'); ?></a></p>
		
		<?php }
	}
	add_action( 'goya_toggle_registration_login', 'goya_toggle_registration_login' );
	

	// ARG Multistep Checkout
	$argmc = get_option('arg-mc-options');
	$argmc['tabs_layout'] = 'tabs-progress-bar';
	update_option('arg-mc-options', $argmc);


	// Inline Error messages
	$checkout_required_count = 0;

	function goya_checkout_required_field_notice( $notice ) {
		global $checkout_required_count;

		$checkout_required_count++;

		// Display a single notice for all errors
		if ( $checkout_required_count > 1 ) {
			return '';  
		} else {
			return esc_html__( 'Please fill in the required fields', 'goya' );
		}
	}
	add_filter( 'woocommerce_checkout_required_field_notice', 'goya_checkout_required_field_notice' );


/* Product Badges
---------------------------------------------------------- */
	function goya_product_badge() {
		global $post, $product;

		// Out of Stock only on simple products
		if ( $product->get_type() === 'simple' and goya_out_of_stock()) { ?>
			<span class="badge out-of-stock"><?php esc_html_e( 'Out of Stock', 'goya' ); ?></span>
		<?php } else {

			if ( get_theme_mod('product_new_badge', true) == true ) {

				// "New Product" badge
				$postdate 		= get_the_time( 'Y-m-d' );			// Post date
				$postdate_stamp 	= strtotime( $postdate );			// Timestamped post date
				$new_range = get_theme_mod('new_badge_duration', 5);
				$is_new = apply_filters( 'goya_product_is_new', $product_new = false );

				// If the product was published within the time frame display the new badge
				if ( ( time() - ( 60 * 60 * 24 * $new_range ) ) < $postdate_stamp) { 
					$is_new = true; 
				}

				if ($is_new == true) { ?>
					<span class="badge new"><?php esc_html_e( 'New', 'goya' ); ?></span>
				<?php }
			}

			// "Sale" badge
			if($product->is_on_sale() && get_theme_mod('product_sale_flash', 'pct') != 'disabled' && get_theme_mod('shop_catalog_mode', false) == false ) {
				// Display percentage
				if ( get_theme_mod('product_sale_flash', 'pct') == 'pct' ) {
					if ( $product->get_type() === 'variable' ) {
						// Get product variation prices (regular and sale)
						$product_variation_prices = $product->get_variation_prices();
						
						$highest_sale_percent = 0;
						
						foreach( $product_variation_prices['regular_price'] as $key => $regular_price ) {
							// Get sale price for current variation
							$sale_price = $product_variation_prices['sale_price'][$key];
							
							// Is product variation on sale?
							if ( $sale_price < $regular_price ) {
								$sale_percent = round( ( ( $regular_price - $sale_price ) / $regular_price ) * 100 );
								
								// Is current sale percent highest?
								if ( $sale_percent > $highest_sale_percent ) {
									$highest_sale_percent = $sale_percent;
								}
							}
						}
						
						if ( $highest_sale_percent > 0 ) {
							// Return the highest product variation sale percent
							echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc"><span class="onsale-before">-</span>' . $highest_sale_percent . '<span class="onsale-after">%</span> <span class="onsale-off">' . esc_html__( 'Off', 'goya' ) . '</span></span>', $post, $product);
						}

					} else {
						$regular_price = $product->get_regular_price();
						$sale_percent = 0;
						
						// Make sure the percentage value can be calculated
						if ( intval( $regular_price ) > 0 ) {
							$sale_percent = round( ( ( $regular_price - $product->get_sale_price() ) / $regular_price ) * 100 );
						}
						
						if ( $sale_percent > 0 ) {
							echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale perc"><span class="onsale-before">-</span>' . $sale_percent . '<span class="onsale-after">%</span> <span class="onsale-off">' . esc_html__( 'Off', 'goya' ) . '</span></span>', $post, $product);
						}
					}
				// Or display text
				} else {
					echo apply_filters('woocommerce_sale_flash', '<span class="badge onsale">' . esc_html__( 'Sale', 'goya' ) . '</span>', $post, $product);
				}
			}
		}
	}
	add_action( 'goya_product_badge', 'goya_product_badge',3 );


	// Add badge to Shop loop
	if( get_theme_mod('product_sale_flash', 'pct') != 'disabled' || get_theme_mod('product_new_badge', true) == true ) {
		add_action( 'woocommerce_before_shop_loop_item_title', 'goya_product_badge',10 );
	}


	// Add badge to Single Product and Quickview
	if( get_theme_mod('single_product_sale_flash', true) == true ) {
		add_action( 'woocommerce_single_product_summary', 'goya_product_badge',9 );
	}

	/* Out of Stock Check */
	function goya_out_of_stock() {
		global $post;
		$id = $post->ID;
		$status = get_post_meta($id, '_stock_status',true);
		
		if ($status == 'outofstock') {
			return true;
		} else {
			return false;
		}
	}


	// Use the uncropped thumbnail instead of the default 100x100px
	add_filter( 'woocommerce_gallery_thumbnail_size', function( $size ) {
		return 'thumbnail';
	} );


/* Wishlist
---------------------------------------------------------- */

	/* Don't reload on variation change */
	add_filter( 'yith_wcwl_reload_on_found_variation', '__return_false' );

	
	/* More details link */
	function goya_qv_short_description(){
	  global $product; ?>

	  <div class="woocommerce-product-details__short-description"><?php echo get_the_excerpt(); ?><a href="<?php echo esc_url( get_permalink( $product->get_id() ) ); ?>" class="et-qv-details-button">[+]</a></div>
	<?php
	}


	/* Single Product: Social Sharing */
	if ( get_theme_mod('product_share_buttons', true) == true ) {
		add_action('woocommerce_single_product_summary', 'goya_social_share', 46);
	}


	/* Single Product: Sizing Guide */
	function goya_sizing_guide() {
		global $post, $product;
		
		// Get page id 
		$size_guide = goya_meta_config('product','size_guide',true);
		$size_page = goya_meta_config('product','size_page','');
		$sizing_guide_page = get_post_meta(get_the_ID(), 'goya_product_sizing_guide', true);
		$size_variable = goya_meta_config('product','size_variable',true);
		$size_apply = goya_meta_config('product','size_apply','all');
		$size_categories = goya_meta_config('product','size_categories','');
		$size_text = 'Size Guide';
		$in_category = false;

		$terms = get_the_terms( $product->get_id(), 'product_cat' );
		
		if (!empty($size_categories)) {
			foreach ($terms as $term) {
				if (in_array($term->term_id, $size_categories)) {
					$in_category = true;
					break;
				}
			}
		}

		if (!empty($sizing_guide_page) ) {
			$size_page = $sizing_guide_page;
			$size_guide = true;
		} else {
			if ( $size_apply == 'custom' && $in_category == false) {
				return;
			}
			if ($size_variable == true && !$product->is_type( 'variable' )) {
				return;
			}
		}

		// Check if the global option is active
		if ($size_guide == true && !empty($size_page)) {
			$post = get_post($size_page);
			setup_postdata( $post );
			?>
			<a href="#sizing-popup" rel="inline" class="sizing_guide" data-class="et-sizing-guide" data-button-inside="true">
				<?php echo the_title(); ?>
			</a>
			<div id="sizing-popup" class="mfp-hide text-left">
				<div class="theme-popup-content custom_scroll">
					<h1 class="page-header"><?php echo the_title(); ?></h1>
					<?php echo the_content(); ?>
				</div>
			</div>
			<?php
			wp_reset_postdata();
		}
	}


	/* Shop (product loop): Remove orderby & breadcrumb */
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	add_action( 'goya_before_shop_loop_result_count', 'woocommerce_result_count', 20 );
	add_action( 'goya_before_shop_loop_catalog_ordering', 'woocommerce_catalog_ordering', 30 );


	/* Shop (product loop): Remove Breadcrumb */
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
	add_action( 'goya_breadcrumbs', 'woocommerce_breadcrumb', 20);


	/* Change normal/sale prices order */
	function goya_woocommerce_price_html( $price, $product ){
			return preg_replace('@(<del>.*?</del>).*?(<ins>.*?</ins>)@misx', '$2 $1', $price);
	}
	add_filter( 'woocommerce_get_price_html', 'goya_woocommerce_price_html', 100, 2 );


/* Category Grid
---------------------------------------------------------- */

	/* Add category subtitle */
	function goya_before_subcategory_title() {
		echo '<div class="category-caption">';
	}
	add_action( 'woocommerce_before_subcategory_title', 'goya_before_subcategory_title', 15 );

	function goya_after_subcategory_title() {
		echo '</div>';
	}
	add_action( 'woocommerce_after_subcategory_title', 'goya_after_subcategory_title', 15 );


	/* Category count */
	function goya_subcategory_count_html($markup, $category) {
		return '<mark class="count">' . $category->count . '</mark>';
	}
	add_filter( 'woocommerce_subcategory_count_html', 'goya_subcategory_count_html', 10, 2 );


	/* Add extra container to category link */
	function goya_category_div_open() {
		echo '<div class="et-category-inner">';
	}
	function goya_category_div_close() {
		echo '</div>';
	}
	add_action('woocommerce_before_subcategory', 'goya_category_div_open', 10);
	add_action('woocommerce_after_subcategory', 'goya_category_div_close', 10);	


	/* Shop (product loop): Change Category Thumbnail Size */
	function goya_template_loop_category_link_open($category) {
		$thumbnail_id = get_term_meta( $category->term_id, 'thumbnail_id', true  );
		if ( $thumbnail_id ) {
			$image = wp_get_attachment_image_src( $thumbnail_id, 'medium_large'  );
			$image = $image[0];
		} else {
			$image = wc_placeholder_img_src();
		}
		echo '<a href="' . get_term_link( $category, 'product_cat' ) . '" style="background-image:url('.esc_url($image).')">';
	}
	remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail', 10 );
	remove_action( 'woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10);
	add_action( 'woocommerce_before_subcategory', 'goya_template_loop_category_link_open', 10);


	/* Cart Page: Move cross-sells to the bottom */
	remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
	add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' );


	/* Single Product */

	// Remove Sale Flash (replaced by goya_product_badge())
	remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );


/* Shop Page: Layout changes
---------------------------------------------------------- */

	//woocommerce_before_shop_loop_item
	remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );

	//woocommerce_after_shop_loop_item
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	// woocommerce_before_shop_loop_item_title
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
	// woocommerce_shop_loop_item_title
	remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

	//woocommerce_after_shop_loop_item_title
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

	if ( get_theme_mod('rating_listing', false) == true ) {
		add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 10 );
	}

	// Remove Sidebar
	add_action('template_redirect', function() {
		if ( is_product() ) {
			remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar');
		}
	}, 0 );

	// Remove notices section
	remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );


/* Single Product: Layout changes
---------------------------------------------------------- */

	// Single Product: Gallery/information layout
	add_action( 'woocommerce_before_single_product_summary', 'goya_single_product_layout_before', 0 );
	// Column middle tags
		add_action( 'woocommerce_before_single_product_summary','goya_single_product_layout_middle', 100 );
	// Closing tags
		add_action( 'woocommerce_after_single_product_summary', 'goya_single_product_layout_after', 0 );

	// Wishlist wrapper
	add_action( 'woocommerce_before_single_product', 'goya_add_wishlist_wrappers' );
	add_action( 'goya_quickview_woocommerce_before_single_product', 'goya_add_wishlist_wrappers' );

	add_action('woocommerce_single_product_summary', 'goya_sticky_bar_trigger', 33);

	
	/* Single Product: Add extra container to button cart elements */
	function goya_add_wishlist_wrappers() {
		global $product;
		$cart_layout = goya_meta_config( 'product','cart_buttons_layout','mixed');

		// Exclude some product types
		$product_types = array(
			'wdm_bundle_product',
		);
		$exclusions = apply_filters( 'goya_cart_wrapper_exclusions', $product_types );

		if ( $cart_layout != 'stacked' && !in_array($product->get_type(), $exclusions) ) {

			if ( $product->is_type( 'grouped' ) ) {
				add_action('woocommerce_before_add_to_cart_button', 'goya_wishlist_div_open', 1);
			} else {
				add_action('woocommerce_before_add_to_cart_quantity', 'goya_wishlist_div_open', 1);
			}
			add_action('woocommerce_after_add_to_cart_button', 'goya_extra_div_close', 2);

		}
		
	}

	//Some plugin may move the default elements, so better add a unique div.
	function goya_sticky_bar_trigger() {
		echo '<div class="clearfix sticky-bar-trigger"></div>';
	}

	/* Single Product: Wishlist/Share actions container */
	function goya_button_cart_actions_before() {
		echo '<div class="clearfix product_actions_wrap">';
	}
	/* Single Product: Add extra container summary */
	function goya_product_summary_open() {
		echo '<div class="et-pro-summary-top">';
	}
	function goya_product_summary_divider() {
		echo '</div><div class="et-pro-summary-content">';
	}
	function goya_single_product_price_clearfix() {
		echo '<div class="clearfix price-separator"></div>';
	}
	/* Single Product: Add extra container to button cart elements */
	function goya_wishlist_div_open() {
		echo '<div class="et-wishlist-div-open">';
	}
	function goya_extra_div_close() {
		echo '</div>';
	}

	/* Product summary: Opening tags */
	function goya_qv_product_summary_open() {
		echo '<div class="et-qv-summary-top">';
	}

	/* Product summary: Divider tags */
	function goya_qv_product_summary_divider() {
		echo '</div><div class="et-qv-summary-content ' . esc_attr( get_theme_mod('product_quickview_summary_layout', 'align-top') ) . '">';
	}

	function goya_single_product_layout_before() {
		global $post, $product;

		// Title position
		$title_position = goya_meta_config('product','title_position','right');

		// Header mode
		$transparent_header = goya_meta_config('product','transparent_header',false);

		// Product layout
		$product_layout = goya_meta_config('product','layout_single','regular');

		// Showcase mode
		$is_showcase = ($product_layout == 'showcase') ? true : false;
		$showcase_fixed = goya_meta_config('product','showcase_fixed',true);
		$showcase_fixed = ( $showcase_fixed == true ) ? 'showcase-fixed' : 'showcase-regular';

		// Product Classes
		$classes[] = 'product-showcase';
		$classes[] = $showcase_fixed;
		$classes[] = ($is_showcase) ? 'showcase-active' : 'showcase-disabled';
		$classes[] = !($is_showcase) ? 'product-title-' . $title_position : '';		

		$gallery_classes[] = 'product-gallery woocommerce-product-gallery-parent';

		// Lightbox
		if ( get_theme_support( 'wc-product-gallery-lightbox' ) ) {
			$gallery_classes[] = 'lightbox-enabled';
		}

		// Zoom
		$zoom_enabled = goya_meta_config('product','image_hover_zoom',false);

		$gallery_classes[] = ( $zoom_enabled ) ? 'zoom-enabled' : 'zoom-disabled';

		// Featured video
		$featured_video_url = get_post_meta( $product->get_id(), 'goya_product_featured_video', true );
		$has_featured_video = ( empty( $featured_video_url ) ) ? false : true;
		if ( $has_featured_video ) {
			$gallery_classes[] = 'has-featured-video';
		}

		$attachment_ids = $product->get_gallery_image_ids();

		if ( $attachment_ids && has_post_thumbnail() ) {
			$gallery_classes[] = 'has-additional-thumbnails';
			$gallery_classes[] = 'video-link-' . get_theme_mod('featured_video', 'gallery');
		}

		$class = goya_single_product_layout_columns();
		
		?>
		<div class="<?php echo esc_attr(implode(' ', $classes)); ?> ">
			<div class="product-header-spacer"></div>
			<div class="container showcase-inner">

				<?php if ( $title_position == 'top' && !$is_showcase) {
					remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5); ?>
					<h1 class="product_title entry-title"><?php echo esc_attr($product->get_title()); ?></h1>
				<?php } ?>
				<div class="row showcase-row">
					<div class="col-12 <?php echo esc_attr($class['gal']); ?> <?php echo esc_attr(implode(' ', $gallery_classes)); ?>">
	<?php }

	function goya_single_product_layout_middle() {
		global $product;

		$class = goya_single_product_layout_columns();

		$featured_video_url = get_post_meta( $product->get_id(), 'goya_product_featured_video', true );
		$has_featured_video = ( empty( $featured_video_url ) ) ? false : true;

		$product_layout = goya_meta_config('product','layout_single','regular');
		$is_showcase = ($product_layout == 'showcase') ? true : false; ?>

			<?php if ( $has_featured_video && ( get_theme_mod('featured_video', 'gallery') == 'gallery' ) && ! $is_showcase ) {
					goya_woocommerce_featured_video('video-gallery animation bottom-to-top');
				} ?>
				</div>
				<div class="col-12 <?php echo esc_attr($class['inf']); ?> product-information">
	<?php }

	function goya_single_product_layout_after() { ?>
					</div> <!-- .product-information -->
				</div> <!-- .showcase-row -->
			</div> <!-- .showcase-inner -->
		</div> <!-- .product-showcase -->
	<?php
	}

	// Columns width in single product layout
	function goya_single_product_layout_columns() {
		$product_layout = goya_meta_config('product','layout_single','regular');

		// Layout classes
		switch($product_layout) {
			case 'regular':
				$class_gal = 'col-lg-7';
				$class_inf = 'col-lg-5';
				break;
			case 'no-padding':
			case 'showcase':
				$class_gal = 'col-lg-7';
				$class_inf = 'col-lg-5';
				break;
			case 'full-width':
				$class_gal = 'col-lg-12';
				$class_inf = 'col-lg-12';
				break;
			default:
				$class_gal = 'col-lg-6';
				$class_inf = 'col-lg-6';
		}

		$class_layout = array(
			'gal' => $class_gal,
			'inf' => $class_inf
		);

		return $class_layout;
	}

	/* Single product: Set gallery options */
	function goya_single_product_gallery_params( $params ) {
		$transition = goya_meta_config('product','gallery_transition','fade');
		$mobile_thumbs = goya_meta_config('product','thumbnails_mobile','dots');

		// FlexSlider options
		if ( isset( $params['flexslider'] ) ) {
			$params['flexslider']['animation']      = $transition;
			$params['flexslider']['smoothHeight']   = ( $mobile_thumbs == 'dots' ) ? true : false;
			$params['flexslider']['directionNav']   = true;
			$params['flexslider']['prevText']   = goya_load_template_part('assets/img/svg/chevron-left.svg');
			$params['flexslider']['nextText']   = goya_load_template_part('assets/img/svg/chevron-right.svg');
			$params['flexslider']['animationSpeed'] = 300;
			$params['flexslider']['rtl'] = is_rtl();
		}
		
		// PhotoSwipe options
		if ( isset( $params['photoswipe_options'] ) ) {
			$params['photoswipe_options']['showHideOpacity']        = true;
			$params['photoswipe_options']['bgOpacity']              = 1;
			$params['photoswipe_options']['loop']                   = false;
			$params['photoswipe_options']['closeOnVerticalDrag']    = false;
			$params['photoswipe_options']['barsSize']               = array( 'top' => 0, 'bottom' => 0 );
			$params['photoswipe_options']['tapToClose']             = true;
			$params['photoswipe_options']['tapToToggleControls']    = false;
		}

		return $params;
	}
	add_filter( 'woocommerce_get_script_data', 'goya_single_product_gallery_params' );

	/* Single product: Tabs - Change "Reviews" tab title */
	function goya_woocommerce_reviews_tab_title( $title ) {
		$title = strtr( $title, array( 
			'(' => '<span>',
			')' => '</span>' 
		) );
		
		return $title;
	}
	add_filter( 'woocommerce_product_reviews_tab_title', 'goya_woocommerce_reviews_tab_title' );


	/* Single product: Tabs - Disable "Reviews" tab */
	if ( get_theme_mod('product_reviews', true) == false || get_theme_mod('shop_catalog_mode', false) == true ) {
		function goya_woocommerce_remove_reviews( $tabs ) {
			unset( $tabs['reviews'] );
			return $tabs;
		}
		add_filter( 'woocommerce_product_tabs', 'goya_woocommerce_remove_reviews', 98 );
		remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	}

	/* Add container to description tab */
	function goya_product_description_content() {
		global $post;

		$description_layout = goya_meta_config('product','description_layout','boxed');
		$heading = apply_filters( 'woocommerce_product_description_heading', esc_html__( 'Description', 'goya' ) );

		if ($description_layout == 'full') { ?>

			<div class="description-inner">
			<?php the_content(); ?>
			</div>

		<?php } else { ?>

			<div class="container">
				<div class="row justify-content-md-center">
					<div class="col-12">
						<?php if ( $heading ) : ?>
							<h2><?php echo esc_html( $heading ); ?></h2>
						<?php endif; ?>
						<div class="desc-layout-<?php echo esc_attr( $description_layout ); ?>">
						<?php the_content(); ?>
						</div>
					</div>
				</div>
			</div>
		<?php }
			
	}

	function goya_woocommerce_description_tab( $tabs ) {
		
		$tabs['description'] = array(
			'title'     => esc_html__( 'Description', 'goya' ),
			'callback'  => 'goya_product_description_content',
			'priority'  => 10
			
		);

		return $tabs;
	}
	add_filter( 'woocommerce_product_tabs', 'goya_woocommerce_description_tab' );


	/* +/- quantity field buttons */

	function goya_woocommerce_quantity_minus() {
		echo '<span class="minus">' .goya_load_template_part('assets/img/svg/minus.svg') . '</span>';
	}
	add_action( 'woocommerce_before_quantity_input_field', 'goya_woocommerce_quantity_minus' );

	function goya_woocommerce_quantity_plus() {
		echo '<span class="plus">' .goya_load_template_part('assets/img/svg/plus.svg') . '</span>';
	}
	add_action( 'woocommerce_after_quantity_input_field', 'goya_woocommerce_quantity_plus' );

	
	/*Single Product: Remove Reviews and Description if tabs are shown as accordion*/
	function goya_product_tabs() {

		// Remove reviews and description from tabs
		function goya_woocommerce_remove_tabs( $tabs ) {
			
			unset( $tabs['reviews'] );
			unset( $tabs['description'] );
			
			return $tabs;
		}
		

		// Register short description tab
		function goya_short_desc_product_accordion( $tabs ) {
			
			$tabs['desc_tab'] = array(
				'title'     => esc_html__( 'Description', 'goya' ),
				'callback'  => 'goya_short_desc_product_accordion_content',
				'priority'  => 10
				
			);

			return $tabs;
		}
		

		// Add short description content
		function goya_short_desc_product_accordion_content() {
			the_excerpt();
		}
		

		// Add full description to original position 
		function goya_full_description_product() {
			$description_layout = goya_meta_config('product','description_layout','boxed'); ?>
			
			<div class="full_description">
				
				<?php if ( $description_layout == 'full' ) { ?>
					<?php the_content(); ?>
				<?php } else { ?>
					
					<div class="container">
						<div class="row justify-content-md-center">
							<div class="col-12 entry-content desc-layout-<?php echo esc_attr( $description_layout ); ?>">
								<?php the_content(); ?>
							</div>
						</div>
					</div>

				<?php } ?>

			</div>
		<?php }
		
	}
	add_action('after_setup_theme','goya_product_tabs');


	/* Single product: Featured video */
	function goya_woocommerce_featured_video( $position ) {
		global $post, $product;
		$featured_video_url = get_post_meta( $product->get_id(), 'goya_product_featured_video', true );
		$has_featured_video = ( empty( $featured_video_url ) ) ? false : true;

		if ( $has_featured_video ) { ?>
			<div class="et-featured-video <?php echo esc_attr($position) ?>">
				<a href="#" class="et-feat-video-btn" data-mfp-src="<?php echo esc_url( $featured_video_url ); ?>">
					<span class="et-featured-video-icon"><?php get_template_part('assets/img/svg/play.svg'); ?></span>
					<span class="et-featured-video-label"><?php esc_html_e( 'Watch Video', 'goya' ); ?></span>
				</a>
			</div>
		<?php }

	}

	// Related/UpSells products status
	if ( get_theme_mod('related_products', true ) == false ) {
		remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
	}
	if ( get_theme_mod('upsell_products', true ) == false ) {
		remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
	}

	/* Single product: Up-sells and Related products columns */
	function goya_upsell_related_products_args( $args ) {
		$args['posts_per_page'] = get_theme_mod('product_upsell_related_per_page', 4);
		$args['columns'] = get_theme_mod('product_upsell_related_columns', 4);
		//$args['orderby'] = 'rand'; // Note: Use to change product order
		return $args;
	}
	add_filter( 'woocommerce_upsell_display_args', 'goya_upsell_related_products_args' );
	add_filter( 'woocommerce_output_related_products_args', 'goya_upsell_related_products_args' );


	/* Cart : Cross-sells products */
	function goya_change_cross_sells_product_number( $number ) {
		return get_theme_mod('product_upsell_related_per_page', 4);
	}
	add_filter( 'woocommerce_cross_sells_total', 'goya_change_cross_sells_product_number' );

	//Up-sells, Related and Cross-sells have all the same values
	function goya_change_cross_sells_columns( $columns ) {
		return get_theme_mod('product_upsell_related_columns', 4);
	}
	add_filter( 'woocommerce_cross_sells_columns', 'goya_change_cross_sells_columns' );


	/* Shop (product loop): Get alternative/hover image */
	if ( ! function_exists( 'goya_product_thumbnail_alt' ) ) {
		function goya_product_thumbnail_alt( $product ) {
			$product_gallery_thumbnail_ids = $product->get_gallery_image_ids();
			$product_thumbnail_alt_id = ( $product_gallery_thumbnail_ids ) ? reset( $product_gallery_thumbnail_ids ) : null; // Get first gallery image id

			if ( $product_thumbnail_alt_id ) {
				$product_thumbnail_alt_src = wp_get_attachment_image_src( $product_thumbnail_alt_id, 'shop_catalog' );

				// Make sure the first image is found (deleted image id's can still be assigned to the gallery)
				if ( $product_thumbnail_alt_src ) {
					return wp_get_attachment_image( $product_thumbnail_alt_id, 'shop_catalog', '', array('class'=>'product_thumbnail_hover') );				
				}
			}

			return '';
		}
	}

	// Shop: Use single add to cart button for variable products to enable swatches on product list
	function goya_add_loop_variation_swatches() {

		global $wp_query, $product;
		
		$vars = $wp_query->query_vars;

		if (class_exists('Woo_Variation_Swatches') && $product->is_type( 'variable' )) {

			if (get_theme_mod('archive_show_swatches', false) == true || array_key_exists('goya_product_swatches', $vars)) {

				// Enqueue variation scripts.
				wp_enqueue_script( 'wc-add-to-cart-variation' );

				// Get Available variations?
				$get_variations = count( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );

				// Load the template.
				wc_get_template(
					'loop/loop-variations.php',
					array(
						'available_variations' => $get_variations ? $product->get_available_variations() : false,
						'attributes'           => $product->get_variation_attributes(),
						'selected_attributes'  => $product->get_default_attributes(),
					)
				);
			}
		} else if (class_exists('Zoo_Clever_Swatch_Shop_Page')) {
			echo do_shortcode('[zoo_cw_shop_swatch]');
		}
	}


/* Quick View
---------------------------------------------------------- */

	// Shop (product loop): Quick view button when add to cart is enabled
	function goya_loop_quick_view () {
		global $product;

		echo apply_filters( 'goya_product_quickview_link', '<a href=' . get_permalink( $product->get_id() ) . ' title="'. esc_html__( 'Quick View', 'goya' ) .'" data-product_id="' . esc_attr( $product->get_id() ) . '" class="et-quickview-btn et-tooltip product_type_' . esc_attr( $product->get_type() ) . '"><span class="text">'. esc_html__( 'Quick View', 'goya' ) . '</span><span class="icon">' . goya_load_template_part('assets/img/svg/maximize-2.svg') . '</span></a>' );
	}

	function goya_quick_view_show_product_images () {
		wc_get_template( 'quickview/product-image.php' );
	}


/* Shop Infinite Load
---------------------------------------------------------- */

	function goya_shop_infinite_load_button() {
		
		$shop_infinite_load = goya_meta_config('shop','infinite_load','button');

		if ( $shop_infinite_load !== 'regular' ) { ?>
			<div class="et-infload-controls et-shop-infload-controls <?php echo esc_attr( $shop_infinite_load ); ?>-mode">
		    <a href="#" class="et-infload-btn et-shop-infload-btn button outlined"><?php esc_html_e( 'Load More', 'goya' ); ?></a>
		    <a class="et-infload-to-top"><?php esc_html_e( 'All products loaded.', 'goya' ); ?></a>
			</div>
		<?php }
	}

/* Plugins
---------------------------------------------------------- */

	/* Plugin: YITH Social Login reorder buttons */
	if ( class_exists( 'YITH_WC_Social_Login_Frontend' ) )  {
		remove_action('woocommerce_login_form', array( YITH_WC_Social_Login_Frontend(),'social_buttons') );
		add_action('woocommerce_login_actions', array( YITH_WC_Social_Login_Frontend(),'social_buttons') );
	}


	/* Plugin: Woo Variation Gallery */

	// Adjust gallery parameters
	function goya_woo_variation_gallery_slider_js_options() {
		$transition = goya_meta_config('product','gallery_transition','fade');

		$slick = array(
			'slidesToShow'   => 1,
			'slidesToScroll' => 1,
			'arrows'         => true,
			'dots'           => true,
			'fade'           => ($transition == 'fade') ?  true : false,
			'speed'          => 600,
			'adaptiveHeight' => true,
			'prevArrow'      => '<a class="slick-prev">'.goya_load_template_part('assets/img/svg/chevron-left.svg').'</a>',
			'nextArrow'      => '<a class="slick-next">'.goya_load_template_part('assets/img/svg/chevron-right.svg').'</a>',
			// 'lazyLoad'    => 'progressive',
			'rtl'            => is_rtl(),
		);
		return $slick;
	}
	add_filter( 'woo_variation_gallery_slider_js_options', 'goya_woo_variation_gallery_slider_js_options' );
	add_filter( 'rtwpvg_slider_js_options', 'goya_woo_variation_gallery_slider_js_options' );

	
	// Dequeue plugin slick style
	function goya_dequeue_plugin_style(){
		wp_dequeue_style( 'woo-variation-gallery-slider' );
		wp_dequeue_style( 'rtwpvg-slider' );
	}
	
	add_action( 'wp_enqueue_scripts', 'goya_dequeue_plugin_style', 999 );

