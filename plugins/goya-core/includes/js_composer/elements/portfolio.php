<?php

// Portfolio Masonry/Grid
vc_map( array(
	'name' => esc_html__('Portfolio', 'goya' ),
	'description' => esc_html__('Display your Portfolio items', 'goya' ),
	'category' => esc_html__('Goya', 'goya'),
	'base' => 'et_portfolio',
	'icon' => 'et_portfolio',
	'params'	=> array(
		array(
	    'type' => 'dropdown',
	    'heading' => esc_html__('Portfolio Layout', 'goya' ),
	    'param_name' => 'portfolio_layout',
	    'std'=> 'grid',
	    'value' => array(
	    	'List' => 'list',
	    	'Grid Columns' => 'grid',
	    	'Masonry' => 'masonry',
	    ),
	    'admin_label' => true,
	    'description' => esc_html__('Select Portfolio Layout', 'goya' )
		),
		array(
      'type' => 'checkbox',
      'heading' => esc_html__('Alternate columns', 'goya' ),
      'param_name' => 'alternate_cols',
      'value' => array(
    		'Yes' => 'true'
    	),
      'description' => esc_html__('Alternate image/text columns in List view', 'goya' ),
      'dependency'	=> array(
	    	'element'	=> 'portfolio_layout',
	    	'value' 	=> 'list'
	    ),
	  ),
		array(
	    'type' => 'dropdown',
	    'heading' => esc_html__('Columns', 'goya' ),
	    'param_name' => 'columns',
	    'std'=> '4',
	    'value' => array(
	    	'6 Columns' => '6',
	    	'4 Columns' => '4',
	    	'3 Columns' => '3',
	    	'2 Columns' => '2'
	    ),
	    'admin_label' => true,
	    'description' => esc_html__('Colums in Grid layout', 'goya' ),
	    'dependency'	=> array(
	    	'element'	=> 'portfolio_layout',
	    	'value' 	=> array( 'grid', 'masonry' )
	    ),
		),
		array(
	    'type' => 'dropdown',
	    'heading' => esc_html__('Items Style', 'goya' ),
	    'param_name' => 'item_style',
	    'group' => 'Style',
	    'std'=> 'regular',
	    'value' => array(
	    	'Regular' => 'regular',
	    	'Overlay' => 'overlay',
	    	'Hover Card' => 'hover-card'
	    ),
	    'admin_label' => true,
	    'description' => esc_html__('Select Items Style', 'goya' ),
	    'dependency'	=> array(
	    	'element'	=> 'portfolio_layout',
	    	'value' 	=> array( 'grid', 'masonry' )
	    ),
		),
		array(
      'type'      => 'dropdown',
      'heading'     => __( 'Animation', 'goya' ),
      'param_name'  => 'animation',
      'group' => 'Style',
      'value'     => array(
        'None'               => '',
        'Right to Left'      => 'animation right-to-left',
        'Left to Right'      => 'animation left-to-right',
        'Right to Left - 3D' => 'animation right-to-left-3d',
        'Left to Right - 3D' => 'animation left-to-right-3d',
        'Bottom to Top'      => 'animation bottom-to-top',
        'Top to Bottom'      => 'animation top-to-bottom',
        'Bottom to Top - 3D' => 'animation bottom-to-top-3d',
        'Top to Bottom - 3D' => 'animation top-to-bottom-3d',
        'Scale'              => 'animation scale',
        'Fade'               => 'animation fade',
      ),
      'dependency'	=> array(
      	'element'	=> 'portfolio_layout',
      	'value' 	=> array( 'grid', 'masonry' )
      ),
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
      'description' => esc_html__('Adjust the space between items', 'goya' ),
      'dependency'	=> array(
	    	'element'	=> 'portfolio_layout',
	    	'value' 	=> array( 'grid', 'masonry' )
	    ),
	  ),
	  array(
      'type' => 'checkbox',
      'heading' => esc_html__('Categories to show', 'goya' ),
      'param_name' => 'category_filter',
      'value' => goya_get_portfolio_categories(),
      'description' => esc_html__('Narrow items by category or leave empty to show items from all categories', 'goya' )
	  ),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Post count', 'goya' ),
			'param_name' 	=> 'num_posts',
			'description'	=> __( 'How many items to show.', 'goya' ),
			'std'=> '6',
		),
	  array(
      'type' => 'checkbox',
      'heading' => esc_html__('Load More Button', 'goya' ),
      'param_name' => 'loadmore',
      'value' => array(
    		'Yes' => 'true'
    	),
      'description' => esc_html__('Add Load More button at the bottom', 'goya' )
	  ),
	  array(
      'type' => 'checkbox',
      'heading' => esc_html__('Category navigation', 'goya' ),
      'param_name' => 'category_navigation',
      'value' => array(
    		'Yes' => 'true'
    	),
      'description' => esc_html__('Show category navigation filter on top', 'goya' ),
      'dependency'	=> array(
	    	'element'	=> 'portfolio_layout',
	    	'value' 	=> array( 'grid', 'masonry' )
	    ),
	  ),
	  
	),
	
) );