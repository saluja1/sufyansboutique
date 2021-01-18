<?php 

// VC element: et_video_lightbox

vc_map( array(
	'name' => esc_html__('Video Lightbox', 'goya'),
	'description' => esc_html__('With icon or image link', 'goya'),
	'category' => esc_html__('Goya', 'goya'),
	'base' => 'et_video_lightbox',
	'icon' => 'et_video_lightbox',
	
	'params'	=> array(
	  array(
	  	'type' 					=> 'dropdown',
	  	'heading' 			=> esc_html__('Style', 'goya'),
	  	'param_name' 		=> 'style',
	  	'value'					=> array(
	  		esc_html__('Just Icon', 'goya' ) 	=> 'lightbox-icon',
	  		esc_html__('With Image', 'goya' ) 	=> 'lightbox-image',
	  		esc_html__('With Text', 'goya' ) 	=> 'lightbox-text',
	  	)
	  ),
	  array(
	  	'type'           => 'textfield',
	  	'heading'        => esc_html__( 'Video Link', 'goya' ),
	  	'param_name'     => 'video',
	  	'admin_label'	 	 => true,
	  	'description'    => esc_html__( 'URL of the video Youtube, Vimeo, etc.', 'goya' ),
	  ),
	  array(
	  	'type'           => 'textfield',
	  	'heading'        => esc_html__( 'Text for the link', 'goya' ),
	  	'param_name'     => 'video_text',
	  	'admin_label'	 	 => true,
	  	'description'    => esc_html__( 'Text you want to show next to the icon', 'goya' ),
	  	'dependency' 		 => array(
	  		'element' => 'style',
	  		'value' => array('lightbox-text')
	  	)
	  ),
	  array(
	  	'type' 					=> 'dropdown',
	  	'heading' 			=> esc_html__('Icon Style', 'goya'),
	  	'param_name' 		=> 'icon_style',
	  	'value'					=> array(
	  		'pulse' 	=> 'pulse',
	  		'simple' 	=> 'simple',
	  	),
	  	'std'						=> 'pulse',
	  	'group' 				=> 'Styling'
	  ),
	  array(
	  	'type' 					=> 'dropdown',
	  	'heading' 			=> esc_html__('Icon Size', 'goya'),
	  	'param_name' 		=> 'icon_size',
	  	'value'					=> array(
	  		'Small' 	=> 'small',
	  		'Medium' 	=> 'medium',
	  		'Large' 	=> 'large',
	  	),
	  	'std'						=> 'medium',
	  	'group' 				=> 'Styling'
	  ),
	  array(
	  	'type' => 'dropdown',
	  	'heading' => __( 'Icon Color', 'goya' ),
	  	'description' 	=> esc_html__( 'Color of the Play Icon', 'goya' ),
	  	'param_name' => 'icon_color',
	  	'value' => array(
	  		'Default' => '',
	  		'Light' => 'light',
	  		'Dark' => 'dark',
	  		'Accent Color' => 'accent',
	  		'Custom' => 'custom'
	  	),
	  	'std' => '',
	  	'group' 				=> 'Styling'
	  ),
	  array(
	  	'type' 					=> 'colorpicker',
	  	'heading' 			=> esc_html__( 'Icon Custom Color', 'goya' ),
	  	'param_name' 		=> 'icon_color_custom',
	  	'dependency' 		 => array(
	  		'element' => 'icon_color',
	  		'value' => array('custom')
	  	),
	  	'group' 				=> 'Styling'
	  ),
	  array(
	  	'type'           => 'attach_image',
	  	'heading'        => esc_html__( 'Select Image', 'goya' ),
	  	'param_name'     => 'image',
	  	'description'    => esc_html__( 'Select image from media library.', 'goya' ),
	  	'dependency' 		 => array(
	  		'element' => 'style',
	  		'value' => array('lightbox-image')
	  	)
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
	  	'type' 						=> 'dropdown',
	  	'heading' 				=> esc_html__('Image Hover Style', 'goya'),
	  	'param_name' 			=> 'hover_style',
	  	'value' 						=> array(
	  		'No Animation' 	=> '',
	  		'Image Zoom' 		=> 'hover-zoom',
	  	),
	  	'dependency' 			=> array(
	  		'element' => 'style',
	  		'value' => array('lightbox-image')
	  	),
	  	'group' 					=> 'Styling'
	  )
	),
	
) );
