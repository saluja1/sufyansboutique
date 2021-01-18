<?php 

// VC element: et_counter

vc_map( array(
	'name' => esc_html__('Counter', 'goya' ),
	'base' => 'et_counter',
	'icon' => 'et_counter',
	'category' => esc_html__('Goya', 'goya' ),
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Style', 'goya' ),
			'param_name' => 'style',
			'std' => 'counter-top',
			'value' => array(
				'Counter Top' => 'counter-top',
				'Counter Bottom' => 'counter-bottom',
				'Counter Left' => 'counter-left',
				'Counter Right' => 'counter-right',
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __('Icon Type', 'goya' ),
			'param_name' => 'icon_type',
			'description' => __( 'Select icon type.', 'goya' ),
			'value' => array(
				'Font Icon' => 'icon',
				'Image' => 'image_id'
			),
			'std' => 'icon',
			'dependency' => array(
				'element' => 'style',
				'value' => array( 'counter-top','counter-bottom' )),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Icon library', 'goya' ),
			'value' => array(
				__( 'Pixeden 7 Stroke', 'goya' ) => 'pixeden',
				__( 'Font Awesome', 'goya' ) => 'fontawesome',
			),
			'admin_label' => true,
			'param_name' => 'icon_library',
			'description' => __( 'Select icon library.', 'goya' ),
			'std' => 'pixeden',
			'dependency' => array(
				'element' => 'icon_type',
				'value' => 'icon'
			)
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'goya' ),
			'param_name' => 'icon_pixeden',
			'description' => __( 'Select icon from library.', 'goya' ),
			'value' => 'pe-7s-close',
			'settings' => array(
				'type' => 'pixeden',
				'emptyIcon' => false,
				'iconsPerPage' => 3000
			),
			'dependency' => array(
				'element' => 'icon_library',
				'value' => 'pixeden'
			)
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'goya' ),
			'param_name' => 'icon_fontawesome',
			'value' => 'fa fa-adjust',
			'settings' => array(
				'emptyIcon' => false,
				'iconsPerPage' => 4000,
			),
			'dependency' => array(
				'element' => 'icon_library',
				'value' => 'fontawesome',
			),
			'description' => __( 'Select icon from library.', 'goya' ),
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', 'goya' ),
			'param_name' => 'image_id',
			'description' => __( 'Select image from the media library.', 'goya' ),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => array( 'image_id' )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Image Style', 'goya' ),
			'param_name' => 'image_style',
			'description' => __( 'Select an image style.', 'goya' ),
			'value' => array(
				'Default' => 'default',
				'Rounded' => 'rounded'
			),
			'std' => 'default',
			'dependency' => array(
				'element' => 'icon_type',
				'value' => array( 'image_id' )
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Image Width', 'goya' ),
			'param_name' => 'icon_image_width',
			'description' => esc_html__( 'If you are using an image, you can set custom width here. Default is 64 (pixels).', 'goya' ),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => array( 'image_id' )),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Counter Color', 'goya' ),
			'param_name' => 'counter_color',
			'value' => array(
				'Default' => '',
				'Dark' => 'dark',
				'Light' => 'light',
				'Accent Color' => 'accent',
				'Custom' => 'custom'
			),
			'std' => '',
			'group' => 'Styling'
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Counter Custom Color', 'goya' ),
			'param_name' => 'counter_color_custom',
			'dependency' => array(
				'element' => 'counter_color',
				'value' => array( 'custom' )
			),
			'group' => 'Styling',
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Icon Color', 'goya' ),
			'param_name' => 'icon_color',
			'value' => array(
				'Default' => '',
				'Dark' => 'dark',
				'Light' => 'light',
				'Accent Color' => 'accent',
				'Custom' => 'custom'
			),
			'dependency' => array(
				'element' => 'icon_type',
				'value' => array('icon')
			),
			'std' => '',
			'group' => 'Styling'
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Icon Custom Color', 'goya' ),
			'param_name' => 'icon_color_custom',
			'dependency' => array(
				'element' => 'icon_color',
				'value' => array( 'custom' )
			),
			'group' => 'Styling',
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Text Color', 'goya' ),
			'param_name' => 'text_color',
			'value' => array(
				'Default' => '',
				'Dark' => 'dark',
				'Light' => 'light',
				'Custom' => 'custom'
			),
			'std' => '',
			'group' => 'Styling'
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Text Custom Color', 'goya' ),
			'param_name' => 'text_color_custom',
			'dependency' => array(
				'element' => 'text_color',
				'value' => array( 'custom' )
			),
			'group' => 'Styling',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Number to Count', 'goya' ),
			'param_name' => 'counter',
			'admin_label' => true
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Speed of the counter animation', 'goya' ),
			'param_name' => 'speed',
			'value' => '2000',
			'description' => esc_html__('Speed of the counter animation, default 1500', 'goya' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Title', 'goya' ),
			'param_name' => 'title',
			'admin_label' => true
		),
		array(
			'type' => 'textarea',
			'heading' => esc_html__( 'Description', 'goya' ),
			'param_name' => 'description',
			'description' => esc_html__( 'Include a small description for this counter', 'goya' ),
		),
	),
	'description' => esc_html__('Counters with icons', 'goya' )
) );
