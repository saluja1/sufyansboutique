<?php // Image shortcode
vc_map( array(
	'name' => 'Image',
	'description' => esc_html__('Add an animated image', 'goya'),
	'category' => esc_html__('Goya', 'goya'),
	'base' => 'et_image',
	'icon' => 'et_image',
	'params' => array(
		array(
			'type' => 'attach_image',
			'heading' => esc_html__('Select Image', 'goya'),
			'param_name' => 'image'
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Display Caption?', 'goya'),
			'param_name' => 'caption',
			'value' => array(
				'Yes' => 'true'
			),
			'description' => esc_html__('If selected, the image caption will be displayed.', 'goya'),
			'group' 					=> 'Text',
		),
		array(
			'type'           => 'textarea_html',
			'heading'        => esc_html__( 'Text Below Image', 'goya' ),
			'param_name'     => 'content',
			'group' 					=> 'Text',
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Retina Size?', 'goya'),
			'param_name' => 'retina',
			'value' => array(
				'Yes' => 'retina_size'
			),
			'description' => esc_html__('If selected, the image will be display half-size, so it looks crisps on retina screens. Full Width setting will override this.', 'goya')
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Full Width?', 'goya'),
			'param_name' => 'full_width',
			'value' => array(
				'Yes' => 'true'
			),
			'description' => esc_html__('If selected, the image will always fill its container', 'goya')
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
      'group'          => 'Styling',
    ),
		array(
		  'type' => 'textfield',
		  'heading' => esc_html__('Image size', 'goya'),
		  'param_name' => 'img_size',
		  'description' => esc_html__('Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" size.', 'goya')
		),
		array(
		  'type' => 'dropdown',
		  'heading' => esc_html__('Image alignment', 'goya'),
		  'param_name' => 'alignment',
		  'value' => array(
		  	'Align left' => 'alignleft',
		  	'Align right' => 'alignright',
		  	'Align center' => 'aligncenter'
		  ),
		  'description' => esc_html__('Select image alignment.', 'goya')
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Link to Full-Width Image?', 'goya'),
			'param_name' => 'lightbox',
			'value' => array(
				'Yes' => 'true'
			)
		),
		array(
		  'type' => 'vc_link',
		  'heading' => esc_html__('Image link', 'goya'),
		  'param_name' => 'img_link',
		  'description' => esc_html__('Enter url if you want this image to have link.', 'goya'),
		  'dependency' => array(
		  	'element' => 'lightbox',
		  	'is_empty' => true
		  )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra Class Name', 'goya'),
			'param_name' => 'extra_class',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Border Radius', 'goya'),
			'param_name' => 'border_radius',
			'group' 				=> 'Styling',
			'description' => esc_html__('You can add your own border-radius code here. For ex: 2px 2px 4px 4px', 'goya')
		),
		array(
			'type' 						=> 'dropdown',
			'heading' 				=> esc_html__('Box Shadow', 'goya'),
			'param_name' 			=> 'box_shadow',
			'value' 						=> array(
				'No Shadow' => '',
				'Small' => 'small-shadow',
				'Medium' => 'medium-shadow',
				'Large' => 'large-shadow',
				'X-Large' => 'xlarge-shadow',
			),
			'dependency' => array(
				'element' => 'style',
				'value' => array('lightbox-style2')
			),
			'group' 				=> 'Styling'
		),
		array(
			'type' 						=> 'dropdown',
			'heading' 				=> esc_html__('Image Max Width', 'goya'),
			'param_name' 			=> 'max_width',
			'value' 						=> array(
				'100%' => 'size_100',
				'125%' => 'size_125',
				'150%' => 'size_150',
				'175%' => 'size_175',
				'200%' => 'size_200',
				'225%' => 'size_225',
				'250%' => 'size_250',
				'275%' => 'size_275',
			),
			'std' => 'size_100',
			'group' 				=> 'Styling',
			'description' => esc_html__('By default, image is contained within the columns, by setting this, you can extend the image over the container', 'goya')
		),
	),
	
) );
