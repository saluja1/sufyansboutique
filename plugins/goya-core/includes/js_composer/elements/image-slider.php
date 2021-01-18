<?php // Image shortcode
vc_map( array(
	'name' => __('Image Slider', 'goya'),
	'description' => __('Add Slider with your images', 'goya'),
	'category' => __('Goya', 'goya'),
	'base' => 'et_image_slider',
	'icon' => 'et_image_slider',
	'params'	=> array(
		array(
			'type' => 'attach_images',
			'heading' => __('Select Images', 'goya'),
			'param_name' => 'images'
		),
		array(
		  'type' => 'textfield',
		  'heading' => esc_html__('Image size', 'goya'),
		  'param_name' => 'img_size',
		  'description' => esc_html__('Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size.', 'goya')
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Display Caption?', 'goya'),
			'param_name' => 'caption',
			'value' => array(
				'Yes' => 'true'
			),
			'description' => esc_html__('If selected, the image caption will be displayed.', 'goya'),
		),
		array(
			'type' 			=> 'textfield',
			'heading' => __( 'Columns', 'goya' ),
			'param_name' => 'columns',
			'description' => __( 'Select number of columns to show.', 'goya' ),
			'value' 		=> '1',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Animation', 'goya'),
			'param_name' => 'animation',
			'value' => array(
				'Slide' => 'slide',
				'Fade' => 'fade',
			),
			'std' => 'slide',
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Infinite', 'goya'),
			'param_name' => 'infinite',
			'value' => array(
				'Enable' => 'true'
			),
			'description' => esc_html__('Infinite loop sliding.', 'goya'),
		),
		array(
			'type' => 'dropdown',
			'heading' => __('Use lightbox?', 'goya'),
			'param_name' => 'lightbox',
			'value' => array(
				'Yes' => 'yes',
				'No' => 'no',
			),
			'std' => 'no',
		),
		array(
			'type' => 'checkbox',
			'heading' => __('Center Images', 'goya'),
			'param_name' => 'center',
			'value' => array(
				'Yes' => 'true'
			)
		),
		array(
			'type' => 'checkbox',
			'heading' => __('Arrows', 'goya'),
			'param_name' => 'arrows',
			'description'	=> __( 'Display "prev" and "next" arrows.', 'goya' ),
			'value' => array(
				'Yes' => 'true'
			),
			'dependency' => array(
				'element' => 'lightbox',
				'value' => array('no')
			),
			'group' 					=> 'Navigation',
		),
		array(
			'type' => 'checkbox',
			'heading' => __('Navigation Dots', 'goya'),
			'param_name' => 'pagination',
			'value' => array(
				'Yes' => 'true'
			),
			'group' 					=> 'Navigation',
		),
		
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Overflow Visible?', 'goya'),
			'param_name' => 'overflow',
			'value' => array(
				'Yes' => 'overflow-visible'
			),
			'description' => esc_html__('Show semi-transparent previous and next slides', 'goya' ),
			'group' 					=> 'Navigation',
		),
		array(
			'type' => 'checkbox',
			'heading' => __('Auto Play', 'goya'),
			'param_name' => 'autoplay',
			'value' => array(
				'Yes' => 'true'
			),
			'group' 					=> 'Navigation',
			'description' => __('If enabled, the carousel will autoplay.', 'goya'),
		),
		array(
			'type' => 'textfield',
			'heading' => __('Speed of the AutoPlay', 'goya'),
			'param_name' => 'autoplay_speed',
			'value' => '4000',
			'group' 					=> 'Navigation',
			'description' => __('Speed of the autoplay, default 4000 (4 seconds)', 'goya'),
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array('true')
			)
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Pause on hover', 'goya'),
			'param_name' => 'pause',
			'value' => array(
				'Enable' => 'true'
			),
			'group' 					=> 'Navigation',
			'description' => esc_html__('Pause autoplay on hover.', 'goya'),
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array('true')
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra Class Name', 'goya'),
			'param_name' => 'extra_class',
		),
	),
) );