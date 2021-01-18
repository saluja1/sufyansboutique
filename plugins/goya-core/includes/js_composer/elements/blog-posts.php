<?php
	
// VC element: et_posts
vc_map( array(
	 'name' => __( 'Blog Posts', 'goya' ),
	 'description' => __( 'Display posts from the blog Masonry,Grid../Slider', 'goya' ),
	 'base' => 'et_posts',
	 'icon' => 'et_posts',
	 'category' => __('Goya', 'goya'),
	 'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Number of Posts', 'goya' ),
			'param_name' => 'num_posts',
			'description' => __( 'Enter max number of posts to display.', 'goya' ),
			'value' => '8'
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Categories to show', 'goya' ),
			'param_name' => 'category',
			'description' => esc_html__('Narrow posts by category or leave empty to show posts from all categories', 'goya' ),
			'value' => goya_get_post_categories(),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Style', 'goya' ),
			'param_name' => 'style',
			'description' => __( 'Posts style.', 'goya' ),
			'value' => array(
				'Grid' => 'grid',
				'Masonry' => 'masonry',
				'Cards' => 'cards',
				'Classic' => 'classic',
				'List' => 'list',
				'Carousel' => 'carousel',
			),
			'std' => 'grid'
		),
		array(
			'type' 			=> 'textfield',
			'heading' => __( 'Columns', 'goya' ),
			'param_name' => 'columns',
			'description' => __( 'Select number of carousel columns.', 'goya' ),
			'value' 		=> '3',
			'dependency' => array(
				'element' => 'style',
				'value' => array('carousel')
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Post Excerpt', 'goya' ),
			'param_name' => 'post_excerpt',
			'description' => __( 'Display post excerpt.', 'goya' ),
			'value' => array(
				__( 'Enable', 'goya' ) => '1'
			),
			'dependency' => array(
				'element' => 'style',
				'value' => 'carousel'
			),
		)
	 )
) );