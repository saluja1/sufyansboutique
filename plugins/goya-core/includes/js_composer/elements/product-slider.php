<?php

// VC element: et_product
vc_map( array(
	'name' => esc_html__('Products Grid/Carousel', 'goya'),
	'description' => esc_html__('Add WooCommerce products', 'goya'),
	'category' => esc_html__('Goya', 'goya'),
	'base' => 'et_product_slider',
	'icon' => 'et_product_slider',
	'admin_label' => true,
	'params'	=> array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Products', 'goya'),
			'param_name' => 'product_sort',
			'value' => array(
				'Best Sellers' => 'best-sellers',
				'Latest Products' => 'latest-products',
				'Top Rated' => 'top-rated',
				'Featured Products' => 'featured-products',
				'Sale Products' => 'sale-products',
				'By Category' => 'by-category',
				'By Product ID' => 'by-id',
				),
			'description' => esc_html__('Select the batch of products to show.', 'goya')
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Product Category', 'goya'),
			'param_name' => 'cat',
			'value' => goya_product_categories_array(),
			'description' => esc_html__('Choose categories to show.', 'goya'),
			'dependency' => array(
				'element' => 'product_sort', 
				'value' => array('by-category')
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Product IDs', 'goya'),
			'param_name' => 'product_ids',
			'description' => esc_html__('Enter the products IDs you would like to display separated by comma', 'goya'),
			'dependency' => array(
				'element' => 'product_sort',
				'value' => array('by-id')
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Order by', 'js_composer' ),
			'param_name' => 'orderby',
			'description' => sprintf( __( 'Select how to sort retrieved products. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
			'value' 		=> array(
				__( 'Date', 'js_composer' ) => 'date',
				__( 'ID', 'js_composer' ) => 'ID',
				__( 'Author', 'js_composer' ) => 'author',
				__( 'Title', 'js_composer' ) => 'title',
				__( 'Modified', 'js_composer' ) => 'modified',
				__( 'Random', 'js_composer' ) => 'rand',
				__( 'Comment count', 'js_composer' ) => 'comment_count',
				__( 'Menu order', 'js_composer' ) => 'menu_order'
			),
			'std' => 'date',
			'save_always' 	=> true
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Sort order', 'js_composer' ),
			'param_name' => 'order',
			'description' => sprintf( __( 'Designates the ascending or descending order. More at %s.', 'js_composer' ), '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex page</a>' ),
			'value' 		=> array(
				__( 'Descending', 'js_composer' )	=> 'DESC',
				__( 'Ascending', 'js_composer' )	=> 'ASC'
			),
			'std' => 'DESC',
			'save_always' 	=> true
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Per page', 'goya'),
			'param_name' => 'item_count',
			'value' => '4',
			'description' => esc_html__('The number of products to show.', 'goya'),
			'dependency' => array(
				'element' => 'product_sort', 
				'value' => array(
					'by-category',
					'sale-products',
					'top-rated',
					'latest-products',
					'best-sellers',
					'featured-products'
				)
			)
		),
		array(
			'type' => 'checkbox',
			'heading' => __('Hide Out of Stock', 'goya'),
			'param_name' => 'hide_out_of_stock',
			'value' => array(
				'Yes' => 'yes'
			),
		),
		array(
	    'type' => 'dropdown',
	    'heading' => esc_html__('Product Style', 'goya' ),
	    'param_name' => 'item_style',
	    'group' => 'Style',
	    'std'=> 'style1', 
	    'value' => array(
	    	'Style 1' => 'style1',
	    	'Style 2' => 'style2',
	    	'Style 3' => 'style3',
	    	'Style 4' => 'style4'
	    ),
	    'admin_label' => true,
	    'description' => esc_html__('Select Items Style', 'goya' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Carousel', 'goya'),
			'param_name' => 'carousel',
			'admin_label' => true,
			'value' => array(
				'Yes' => 'yes',
				'No' => 'no'
			),
			'description' => esc_html__('Select yes to display the products in a carousel.', 'goya'),
			'std' 			=> 'yes'
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns', 'goya'),
			'param_name' => 'columns',
			'value' => array(
				'5 Columns' => '5',
				'4 Columns' => '4',
				'3 Columns' => '3',
				'2 Columns' => '2',
				'1 Columns' => '1'
			),
			'description' => esc_html__('Select the layout of the products.', 'goya'),
			'std' 			=> '4'
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns to scroll', 'goya'),
			'param_name' => 'scroll',
			'value' => array(
				'Same as columns' => 'columns',
				'1' => '1'
			),
			'description' => esc_html__('Number of columns to scroll.', 'goya'),
			'std' 			=> 'columns',
			'dependency'	=> array(
				'element'	=> 'carousel',
				'value'   => array( 'yes' ),
			)
		),
		array(
			'type' => 'checkbox',
			'heading' => __('Show Pagination', 'goya'),
			'param_name' => 'pagination',
			'value' => array(
				'Yes' => 'true'
			),
			'dependency'	=> array(
				'element'	=> 'carousel',
				'value'   => array( 'yes' ),
			)
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Show Variations', 'goya'),
			'param_name' => 'show_variations',
			'value' => array(
				'Yes' => 'true'
			),
			'description' => esc_html__('Show variations (requires "WooCommerce Variation Swatches" plugin) .', 'goya'),
		),
	),
	
) );