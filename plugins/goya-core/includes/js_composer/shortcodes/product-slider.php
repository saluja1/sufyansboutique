<?php function goya_shortcode_product_slider( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'product_sort'      => '',
		'cat'               => '',
		'product_ids'       => '',
		'hide_out_of_stock' => '',
		'carousel'          => 'yes',
		'item_count'        => '4',
		'columns'           => '4',
		'orderby'	          => 'date',
		'order'		          => 'DESC',
		'item_style'        => 'style1',
		'scroll'            => 'columns',
		'pagination'        => '',
		'show_variations'   => '',
	), $atts ) );

	global $woocommerce, $woocommerce_loop;
			
	$args = array();
	
	if ($product_sort == "featured-products") {			
		$args = array(
			'tax_query'      => array(
				array(
					'taxonomy' => 'product_visibility',
					'field'    => 'name',
					'terms'    => 'featured',
					'operator' => 'IN',
				)
			 ),
		);
	} else if ($product_sort == "top-rated") {
		$ordering_args = WC()->query->get_catalog_ordering_args( 'rating', 'asc' );
				
		$args = array(
			'meta_key' 				=> $ordering_args['meta_key'],
			'orderby' 				=> $ordering_args['orderby'],
			'order' 				=> $ordering_args['order'],
		);
	} else if ($product_sort == "sale-products") {
		$args = array(
			'meta_query'     => array(
				'relation' => 'OR',
				array( // Simple
					'key'           => '_sale_price',
					'value'         => 0,
					'compare'       => '>',
					'type'          => 'numeric'
				),
				array( // Variable
					'key'           => '_min_variation_sale_price',
					'value'         => 0,
					'compare'       => '>',
					'type'          => 'numeric'
				)
			)
		);
	} else if ($product_sort == "by-category"){
		$args = array(
			'product_cat' => $cat,
		);
	} else if ($product_sort == "by-id"){
		$product_id_array = explode(',', $product_ids);
		$args = array(
			'post__in'		=> $product_id_array
		);	    
	} else if ($product_sort == 'best-sellers') {
		$args = array(
			'meta_key' 		=> 'total_sales',
			'orderby' 		=> 'meta_value_num',
			'order' => 'DESC',
		);
	} else {
		$product_sort = "latest-products";
	}

	$args['tax_query'][] = array(
		'taxonomy' => 'product_visibility',
		'field'    => 'name',
		'terms'    => array('exclude-from-catalog'),
		'operator' => 'NOT IN'
	);

	if ($hide_out_of_stock == 'yes') {
		$args['tax_query'][] = array(
			'taxonomy' => 'product_visibility',
			'field'    => 'name',
			'terms'    => array('outofstock'),
			'operator' => 'NOT IN'
		);
	}

	$args['post_type'] = 'product';
	$args['post_status'] = 'publish';
	
	if ($product_sort != "best-sellers") {
		$args['orderby'] = $orderby;
		$args['order'] = $order;
	}

	if ($product_sort != "by-id") {
		$args['ignore_sticky_posts'] = 1;
		$args['posts_per_page'] = $item_count;
		$args['no_found_rows'] = 1;
	}
	
	$args['meta_query'] = WC()->query->get_meta_query();
	
	ob_start();
	
	$products = new WP_Query( $args );

	$classes[] = 'et-product et-main-products products row';
	$classes[] = 'et-product-' . $item_style;
	$classes[] = 'products-' . $product_sort;

	// Product variations
	$classes[] = ($show_variations) ? 'et-shop-show-variations' : 'et-no-variations';
	
	if ( $products->have_posts() ) { ?>

		<?php $woocommerce_loop['columns'] = $columns;  ?>
		 
		<?php if ($carousel == 'yes') {
			$classes[] = 'carousel et-product-slider slick slick-arrows-outside slick-controls-gray slick-dots-centered slick-dots-active-small';
		?>
			
			<div class="carousel-container">
				<ul class="<?php echo esc_attr(implode(' ', $classes)); ?>" data-columns="<?php echo esc_attr($columns); ?>" data-slides-to-scroll="<?php echo esc_attr( ($scroll == 'columns') ? $columns : 1 ); ?>" data-navigation="true" data-pagination="<?php echo esc_attr($pagination); ?>">		

			<?php } else {  ?> 

			<ul class="<?php echo esc_attr(implode(' ', $classes)); ?>">

			<?php } ?>
					
					<?php while ( $products->have_posts() ) : $products->the_post(); ?>
						<?php 
						set_query_var( 'goya_is_shortcode', true );
						set_query_var( 'goya_product_style', $item_style );
						set_query_var( 'goya_product_swatches', $show_variations );
						$product = wc_get_product( $products->post->ID ); ?>
						<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; // end of the loop. ?>
										
				</ul>
			<?php if ($carousel == "yes") { ?></div><?php } ?>
		 
	<?php }
			 
	 $out = ob_get_contents();
	 if (ob_get_contents()) ob_end_clean();
	 
	 wp_reset_query();
	 wp_reset_postdata();
		 
	return $out;
}
add_shortcode('et_product_slider', 'goya_shortcode_product_slider');