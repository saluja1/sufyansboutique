<?php
	
// VC element: et_button
vc_map( array(
	 'name'			=> esc_html__( 'Button', 'goya' ),
	 'description'	=> esc_html__( 'Stylish button', 'goya' ),
	 'category' => esc_html__('Goya', 'goya'),
	 'base'			=> 'et_button',
	 'icon'			=> 'et_button',
	 'params'			=> array(
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Title', 'goya' ),
			'param_name' 	=> 'title',
			'description'	=> __( 'Add button title.', 'goya' ),
			'value' 		=> __( 'Button', 'goya' )
		),
		array(
			'type'			=> 'vc_link',
			'heading'		=> __( 'URL (Link)', 'goya' ),
			'param_name'	=> 'link',
			'description'	=> __( 'Add a button link.', 'goya' )
		),
		
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Add Arrow', 'goya'),
			'param_name' => 'add_arrow',
			'value' => array(
				'Yes' => 'true'
			),
			'description' => esc_html__('If enabled, will show an arrow on hover.', 'goya'),
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Size', 'goya' ),
			'param_name'	=> 'size',
			'description'	=> __( 'Select button size.', 'goya' ),
			'value'			=> array(
				'Large'			=> 'lg',
				'Medium'		=> 'md',
				'Small' 		=> 'sm',
			),
			'std' 			=> 'md'
		),
		array(
			'type'      => 'dropdown',
			'heading'     => __( 'Animation', 'goya' ),
			'param_name'  => 'animation',
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
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Style', 'goya' ),
			'param_name'	=> 'style',
			'description'	=> __( 'Select button style.', 'goya' ),
			'value' 		=> array(
				'Solid'			=> 'solid',
				'Solid Rounded'	=> 'solid rounded',
				'Outlined'			=> 'outlined',
				'Outlined Rounded'	=> 'outlined rounded',
				'Link'				=> 'link'
			),
			'std'			=> 'solid',
			'group' => 'Styling'
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Link/Button Color', 'goya' ),
			'description' => __( 'Also border color if "Outlined Button" is selected', 'goya' ),
			'param_name' => 'color',
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
			'type' 			=> 'colorpicker',
			'heading' 		=> __( 'Custom Color', 'goya' ),
			'description'	=> __( 'Link/Button custom color.', 'goya' ),
			'param_name' 	=> 'color_custom',
			'group'			 => 'Styling',
			'dependency' => array(
				'element' => 'color',
				'value' => array('custom')
			),
		),
		array(
			'type' 			=> 'colorpicker',
			'heading' 		=> __( 'Text Color (solid buttons)', 'goya' ),
			'description'	=> __( 'Text color for solid buttons.', 'goya' ),
			'param_name' 	=> 'text_color_custom',
			'group'			 => 'Styling',
			'dependency' => array(
				'element' => 'color',
				'value' => array('custom')
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Add Shadow on Hover?', 'goya'),
			'param_name' => 'shadow',
			'group'			 => 'Styling',
			'value' => array(
				'Yes' => 'button-shadow'
			),
			'dependency' => array(
				'element' => 'style',
				'value' => array('solid', 'solid rounded')
			),
			'description' => esc_html__('If enabled, this will add a shadow to the button', 'goya'),
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Align', 'goya' ),
			'param_name'	=> 'align',
			'description'	=> __( 'Select button alignment.', 'goya' ),
			'value'			=> array(
				'Left' 		=> 'left',
				'Center'	=> 'center',
				'Right' 	=> 'right',
				'Full Width' 	=> 'full'
			),
			'group'			 => 'Styling',
			'std' 			=> 'left'
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra Class', 'goya' ),
			'description' => esc_html__('Add a class for more customization', 'goya' ),
			'param_name' => 'extra_class',
			'group'  => 'Styling',
		),
	)
) );
