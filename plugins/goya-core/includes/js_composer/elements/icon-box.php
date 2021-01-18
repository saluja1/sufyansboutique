<?php
	
// VC element: et_iconbox

vc_map( array(
	 'name'			=> __( 'Icon Box', 'goya' ),
	 'description'	=> __( 'Feature box with image or icon.', 'goya' ),
	 'category' => esc_html__('Goya', 'goya'),
	 'base'			=> 'et_iconbox',
	 'icon'			=> 'et_iconbox',
	 'params'			=> array(
		
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Icon Type', 'goya' ),
			'param_name' 	=> 'icon_type',
			'description'	=> __( 'Select icon type.', 'goya' ),
			'value' 		=> array(
				'Font Icon'	=> 'icon',
				'Image'		=> 'image_id',
				'External Image'		=> 'external_img'
			),
			'std' 			=> 'icon',
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
			'dependency'	=> array(
				'element'	=> 'icon_type',
				'value'		=> 'icon'
			)
		),
		array(
			'type' 			=> 'iconpicker',
			'heading' 		=> __( 'Icon', 'goya' ),
			'param_name' 	=> 'icon_pixeden',
			'description' 	=> __( 'Select icon from library.', 'goya' ),
			'value' 		=> 'pe-7s-close',
			'settings' 		=> array(
				'type' 			=> 'pixeden',
				'emptyIcon' 	=> false,
				'iconsPerPage'	=> 500
			),
			'dependency'	=> array(
				'element'	=> 'icon_library',
				'value'		=> 'pixeden'
			)
		),
		array(
			'type' => 'iconpicker',
			'heading' => __( 'Icon', 'goya' ),
			'param_name' => 'icon_fontawesome',
			'value' => 'fa fa-adjust',
			'settings' => array(
				'emptyIcon' => false,
				'iconsPerPage' => 500,
			),
			'dependency' => array(
				'element' => 'icon_library',
				'value' => 'fontawesome',
			),
			'description' => __( 'Select icon from library.', 'goya' ),
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'External Image', 'goya' ),
			'param_name' 	=> 'image_url',
			'description'	=> __( 'Image Link', 'goya' ),
			'dependency'	=> array(
				'element'	=> 'icon_type',
				'value' 	=> array( 'external_img' )
			)
		),
		array(
			'type' 			=> 'attach_image',
			'heading' 		=> __( 'Image', 'goya' ),
			'param_name' 	=> 'image_id',
			'description'	=> __( 'Select image from the media library.', 'goya' ),
			'dependency'	=> array(
				'element'	=> 'icon_type',
				'value' 	=> array( 'image_id' )
			)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Image Style', 'goya' ),
			'param_name' 	=> 'image_style',
			'description'	=> __( 'Select an image style.', 'goya' ),
			'value' 		=> array(
				'Default'	=> 'default',
				'Rounded'	=> 'rounded'
			),
			'std' 			=> 'default',
			'dependency'	=> array(
				'element'	=> 'icon_type',
				'value' 	=> array( 'image_id' )
			)
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Title', 'goya' ),
			'param_name' 	=> 'title',
			'description'	=> __( 'Enter a feature title.', 'goya' )
		),
		array(
			'type' 			=> 'textfield',
			'heading' 		=> __( 'Sub-title', 'goya' ),
			'param_name' 	=> 'subtitle',
			'description'	=> __( 'Enter a sub-title.', 'goya' )
		),
		array(
			'type' 			=> 'textarea_html',
			'heading' 		=> __( 'Description', 'goya' ),
			'param_name' 	=> 'content', // Important: Only one textarea_html param per content element allowed and it should have "content" as a "param_name"
			'description'	=> __( 'Enter a feature description.', 'goya' )
		),
		array(
			'type' 			=> 'vc_link',
			'heading' 		=> __( 'Link', 'goya' ),
			'param_name' 	=> 'link',
			'description' 	=> __( 'Add a link after the description.', 'goya' )
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Layout', 'goya' ),
			'param_name' 	=> 'layout',
			'description'	=> __( 'Select a layout.', 'goya' ),
			'value' 		=> array(
				'Default'		=> 'default',
				'Centered'		=> 'centered',
				'Icon Right'	=> 'icon_right',
				'Icon Left'		=> 'icon_left'
			),
			'std' 			=> 'default',
			'group' => 'Styling'
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Icon Style', 'goya' ),
			'param_name' 	=> 'icon_style',
			'value' 		=> array(
				'Icon Only'		=> 'simple',
				'Solid Background'	=> 'background',
				'With Border'		=> 'border'
			),
			'std' 			=> 'simple',
			'dependency'	=> array(
				'element'	=> 'icon_type',
				'value' 	=> array( 'icon' )
			),
			'group' => 'Styling'
		),
		array(
			'type' => 'dropdown',
			'heading' 		=> __( 'Icon Color', 'goya' ),
			'param_name' => 'icon_color',
			'value' => array(
				'Default' => '',
				'Dark' => 'dark',
				'Light' => 'light',
				'Accent Color' => 'accent',
				'Custom' => 'custom'
			),
			'std' => '',
			'dependency'	=> array(
				'element'	=> 'icon_type',
				'value' 	=> array( 'icon' )
			),
			'group' => 'Styling'
		),
		array(
			'type' 			=> 'colorpicker',
			'heading' 		=> __( 'Icon Custom Color', 'goya' ),
			'param_name' 	=> 'icon_color_custom',
			'dependency'	=> array(
				'element'	=> 'icon_color',
				'value' 	=> array( 'custom' )
			),
			'group'  => 'Styling',
		),
		array(
			'type' 			=> 'colorpicker',
			'heading' 		=> __( 'Icon Background', 'goya' ),
			'param_name' 	=> 'icon_background_color_custom',
			'description' 	=> __( 'For "Solid Background" style only.', 'goya' ),
			'dependency'	=> array(
				'element'	=> 'icon_color',
				'value' 	=> array( 'custom' )
			),
			'group'  => 'Styling',
		),
		array(
			'type' => 'dropdown',
			'heading' 		=> __( 'Text Color Scheme', 'goya' ),
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
			'type' 			=> 'colorpicker',
			'heading' 		=> __( 'Title Color', 'goya' ),
			'param_name' 	=> 'title_color',
			'dependency'	=> array(
				'element'	=> 'text_color',
				'value' 	=> array( 'custom' )
			),
			'group'  => 'Styling',
		),
		array(
			'type' 			=> 'colorpicker',
			'heading' 		=> __( 'Subtitle Color', 'goya' ),
			'param_name' 	=> 'subtitle_color',
			'dependency'	=> array(
				'element'	=> 'text_color',
				'value' 	=> array( 'custom' )
			),
			'group'  => 'Styling',
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Animation', 'goya' ),
			'param_name' 	=> 'animation',
			'value' 		=> array(
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
			'std' 			=> 'animation bottom-to-top',
			'group'  => 'Styling',
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __('Bottom Spacing', 'goya' ),
			'param_name' 	=> 'bottom_spacing',
			'value' 		=> array(
				'(None)'	=> 'none',
				'Small'		=> 'small',
				'Medium'	=> 'medium',
				'Large'		=> 'large'
			),
			'std' 			=> 'none',
			'group'  => 'Styling',
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