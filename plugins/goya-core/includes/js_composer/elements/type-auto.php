<?php 

// VC element: et_typeauto

vc_map( array(
	'base'  => 'et_typeauto',
	'name' => esc_html__('Auto Type', 'goya' ),
	'description' => esc_html__('Animated text typing', 'goya' ),
	'category' => esc_html__('Goya', 'goya' ),
	'icon' => 'et_typeauto',
	'params' => array(
		array(
			'type'       => 'textarea_safe',
			'heading'    => esc_html__( 'Content', 'goya' ),
			'param_name' => 'typed_text',
			'value'		 => '<h2>Your animated text *Goya;WordPress*</h2>',
			'description'=> '
			Enter the content to display with typing text. <br />
			Text within <strong>*</strong> will be animated, for example: <strong>*Sample text*</strong>. <br />
			Text separator is <strong>;</strong> for example: <strong>*Goya;WordPress*</strong>',
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
			'heading' => __( 'Animated Text Color', 'goya' ),
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
	    'type' => 'textfield',
	    'heading' => esc_html__('Type Speed', 'goya' ),
	    'param_name' => 'typed_speed',
	    'description' => esc_html__('Speed of the type animation. Default is 50', 'goya' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Show Cursor', 'goya' ),
			'param_name' => 'cursor',
			'value' => array(
				'Yes' => '1'
			),
			'description' => esc_html__('If enabled, the text will always animate, looping through the sentences used.', 'goya' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Loop', 'goya' ),
			'param_name' => 'loop',
			'value' => array(
				'Yes' => '1'
			),
			'description' => esc_html__('If enabled, the text will always animate, looping through the sentences used.', 'goya' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra Class Name', 'goya' ),
			'param_name' => 'extra_class',
		),
	)
) );
