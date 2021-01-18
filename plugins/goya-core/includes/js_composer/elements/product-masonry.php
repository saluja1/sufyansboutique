<?php

// VC element: et_product
vc_map( array(
	'name' => esc_html__('Product Masonry', 'goya'),
	'description' => esc_html__('Add WooCommerce products', 'goya'),
	'category' => esc_html__('Goya', 'goya'),
	'base' => 'et_product_masonry',
	'icon' => 'et_product_masonry',
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
	    'std'=> 'style4',
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
      'heading' => esc_html__('Margins between items', 'goya' ),
      'param_name' => 'item_margins',
      'group' => 'Style',
      'std'=> 'regular-padding',
      'value' => array(
      	'Regular' => 'regular-padding',
      	'No Margins' => 'no-padding'
      ),
      'description' => esc_html__('Adjust the space between items', 'goya' )
	  ),
		array(
      'type' => 'checkbox',
      'heading' => esc_html__('Category navigation', 'goya' ),
      'param_name' => 'category_navigation',
      'value' => array(
    		'Yes' => 'true'
    	),
      'description' => esc_html__('Show category navigation filter on top', 'goya' ),
      'dependency' => array(
      	'element' => 'product_sort', 
      	'value' => array('by-category')
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