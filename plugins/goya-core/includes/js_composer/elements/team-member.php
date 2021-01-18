<?php

// VC element: et_team_member
vc_map( array(
	'name' => esc_html__('Team Member', 'goya'),
	'description' => esc_html__('Display your team members in a stylish way', 'goya'),
	'category' => esc_html__('Goya', 'goya'),
	'base' => 'et_team_member',
	'icon' => 'et_team',
	'params' => array(
		array(
			'type' => 'attach_image', //attach_images
			'heading' => esc_html__('Select Team Member Image', 'goya'),
			'param_name' => 'image',
			'description' => esc_html__('Minimum size is 270x270 pixels', 'goya')
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Image Style', 'goya' ),
			'param_name' 	=> 'style',
			'description'	=> __( 'Select image style.', 'goya' ),
			'value' 		=> array(
				'Default'  => 'default',
				'Rounded' => 'rounded'
			),
			'std' 			=> 'default'
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
			'std' 			=> 'animation bottom-to-top'
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Name', 'goya'),
			'param_name' => 'name',
			'admin_label' => true,
			'description' => esc_html__('Enter name of the team member', 'goya')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Position', 'goya'),
			'param_name' => 'position',
			'description' => esc_html__('Enter position/title of the team member', 'goya')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Facebook', 'goya'),
			'param_name' => 'facebook',
			'description' => esc_html__('Enter Facebook Link', 'goya')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Twitter', 'goya'),
			'param_name' => 'twitter',
			'description' => esc_html__('Enter Twitter Link', 'goya')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Pinterest', 'goya'),
			'param_name' => 'pinterest',
			'description' => esc_html__('Enter Pinterest Link', 'goya')
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Linkedin', 'goya'),
			'param_name' => 'linkedin',
			'description' => esc_html__('Enter Linkedin Link', 'goya')
		)
	),
	
) );