<?php 

// VC element: et_typestroke

vc_map( array(
	'base'  => 'et_typestroke',
	'name' => esc_html__('Stroke Type', 'goya' ),
	'description' => esc_html__('Text with Stroke style', 'goya' ),
	'category' => esc_html__('Goya', 'goya' ),
	'icon' => 'et_typestroke',
	'params' => array(
		array(
			'type'       => 'textarea_safe',
			'heading'    => esc_html__( 'Content', 'goya' ),
			'param_name' => 'slide_text',
			'value'		 => '<h2>Type Stroke</h2>',
			'description'=> 'Enter the content to display with stroke.',
			'admin_label' => true,
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Text Size', 'goya' ),
			'param_name' => 'text_size',
			'value' => array(
				'Small (14 px)' => 'small',
				'Medium (24px)' => 'medium',
				'Large (32px)' => 'large',
				'X-Large (48px)' => 'xlarge',
				'XX-Large (72px)' => 'xxlarge',
				'Custom Size' => 'custom',
			),
			'std' => 'medium',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Custom Text Size', 'goya' ),
			'param_name' => 'text_size_custom',
			'description' => esc_html__('Add the unit, for example: 28px. It will be scaled down on smaller devices.', 'goya' ),
			'dependency' => array(
				'element' => 'text_size',
				'value' => array( 'custom' )
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Text Color', 'goya' ),
			'param_name' => 'text_color',
			'value' => array(
				'Default' => '',
				'Dark' => 'dark',
				'Light' => 'light',
				'Accent Color' => 'accent',
				'Custom' => 'custom'
			),
			'std' => '',
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Custom Text Color', 'goya' ),
			'param_name' => 'text_color_custom',
			'dependency' => array(
				'element' => 'text_color',
				'value' => array( 'custom' )
			),
		),
		array(
		  'type' 					=> 'textfield',
		  'heading' 			=> esc_html__('Stroke Width', 'goya' ),
		  'param_name' 		=> 'stroke_width',
		  'std'=> '',
		  'description' 	=> esc_html__('Enter the value for the stroke width (default: 1px) ', 'goya' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra Class Name', 'goya' ),
			'param_name' => 'extra_class',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Animation', 'goya' ),
			'param_name' => 'animation',
			'value' => array(
				'None' => '',
				'Right to Left' => 'animation right-to-left',
				'Left to Right' => 'animation left-to-right',
				'Right to Left - 3D' => 'animation right-to-left-3d',
				'Left to Right - 3D' => 'animation left-to-right-3d',
				'Bottom to Top' => 'animation bottom-to-top',
				'Top to Bottom' => 'animation top-to-bottom',
				'Bottom to Top - 3D' => 'animation bottom-to-top-3d',
				'Top to Bottom - 3D' => 'animation top-to-bottom-3d',
				'Scale' => 'animation scale',
				'Fade' => 'animation fade-in'
			)
		),
	)
) );
