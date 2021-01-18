<?php

// VC element: et_product_category_grid
vc_map( array(
	'name' => esc_html__('Product Category Grid', 'goya'),
	'description' => esc_html__('Display Product Category Grid', 'goya'),
	'category' => esc_html__('Goya', 'goya'),
	'base' => 'et_product_category_grid',
	'icon' => 'et_product_category_grid',
	'params'	=> array(
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Product Category', 'goya'),
			'param_name' => 'cat',
			'value' => goya_product_categories_array(),
			'description' => esc_html__('Select the categories you would like to display', 'goya')
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Order by', 'goya'),
			'param_name' => 'order_by',
			'value' => array(
				'Name' => 'name',
				'Id' => 'id',
				'Slug' => 'slug',
				'Menu Order' => 'menu_order'
			),
			'std' => 'name'
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Sort Order', 'goya'),
			'param_name' => 'sort_order',
			'value' => array(
				'Ascending' => 'ASC',
				'Descending' => 'DESC',
			),
			'std' => 'ASC'
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Style', 'goya'),
			'param_name' => 'style',
			'admin_label' => true,
			'value' => array(
				'Style 1' => 'style1',
				'Style 2' => 'style2',
				'Style 3' => 'style3'
			),
			'description' => esc_html__('This applies different grid structures', 'goya')
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Rounded Corners', 'goya'),
			'param_name' => 'rounded_corners',
		  'value' => array(
				'Yes' => 'true'
			),
		),
	),
	
) );