<?php

// VC element: et_lightbox
vc_map( array(
 'name' => esc_html__( 'Lightbox', 'goya' ),
 'description' => esc_html__( 'Lightbox modal with custom content', 'goya' ),
 'category' => esc_html__('Goya', 'goya'),
 'base' => 'et_lightbox',
 'icon' => 'et_lightbox',
 'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => __('Link Type', 'goya' ),
			'param_name' => 'link_type',
			'description' => __( 'Select lightbox link type.', 'goya' ),
			'value' => array(
				'Link' => 'link',
				'Button' => 'btn',
				'Image' => 'image'
			),
			'std' => 'link'
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'goya' ),
			'param_name' => 'title',
			'description' => __( 'Enter a lightbox link/button title.', 'goya' )
		),
		// Dependency: link_type - btn
		array(
			'type' => 'dropdown',
			'heading' => __( 'Button Style', 'goya' ),
			'param_name' => 'button_style',
			'description' => __( 'Select button style.', 'goya' ),
			'value' => array(
				'Solid' => 'solid',
				'Solid Rounded' => 'solid rounded',
				'Outlined' => 'outlined',
				'Outlined Rounded' => 'outlined rounded',
				'Link' => 'link'
			),
			'std' => 'solid',
			'dependency' => array(
				'element' => 'link_type',
				'value' => array( 'btn' )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Button Align', 'goya' ),
			'param_name' => 'button_align',
			'value' => array(
				'Left' => 'left',
				'Center' => 'center',
				'Right' => 'right'
			),
			'std' => 'center',
			'dependency' => array(
				'element' => 'link_type',
				'value' => array( 'btn' )
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Button Size', 'goya' ),
			'param_name' => 'button_size',
			'description' => __( 'Select button size.', 'goya' ),
			'value' => array(
				'Mini' => 'xs',
				'Small' => 'sm',
				'Normal' => 'md',
				'Large' => 'lg'
			),
			'std' => 'lg',
			'dependency' => array(
				'element' => 'link_type',
				'value' => array( 'btn' )
			)
		),
		array(
			'type' => 'colorpicker',
			'heading' => __( 'Button Color', 'goya' ),
			'param_name' => 'button_color',
			'description' => __( 'Select button color.', 'goya' ),
			'dependency' => array(
				'element' => 'link_type',
				'value' => array( 'btn' )
			)
		),

		// Dependency: link_type - image
		array(
			'type' => 'attach_image',
			'heading' => __( 'Link Image', 'goya' ),
			'param_name' => 'link_image_id',
			'description' => __( 'Select image from the media library.', 'goya' ),
			'dependency' => array(
				'element' => 'link_type',
				'value' => array( 'image' )
			),
			'group' => 'Source',
		),
		array(
			'type' => 'dropdown',
			'heading' => __('Lightbox Type', 'goya' ),
			'param_name' => 'content_type',
			'description' => __( 'Select content type.', 'goya' ),
			'value' => array(
				'Image' => 'image',
				'Video' => 'iframe',
				'HTML' => 'inline'
			),
			'std' => 'image',
			'group' => 'Source',
		),
		// Dependency: content_type - image
		array(
			'type' => 'attach_image',
			'heading' => __( 'Lightbox Image', 'goya' ),
			'param_name' => 'content_image_id',
			'description' => __( 'Select image from the media library.', 'goya' ),
			'dependency' => array(
				'element' => 'content_type',
				'value' => array( 'image' )
			),
			'group' => 'Source',
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Lightbox Image Caption', 'goya' ),
			'param_name' => 'content_image_caption',
			'description' => __( 'Display image caption.', 'goya' ),
			'value' => array(
				__( 'Enable', 'goya' ) => '1'
			),
			'dependency' => array(
				'element' => 'content_type',
				'value' => array( 'image' )
			),
			'group' => 'Source',
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Video URL', 'goya' ),
			'param_name' => 'content_url',
			'description' => '
				Insert a Video URL. <strong>YouTube video:</strong> http://www.youtube.com/watch?v=xxxx',
			'dependency' => array(
				'element' => 'content_type',
				'value' => array( 'iframe' )
			),
			'group' => 'Source',
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Source ID', 'goya' ),
			'param_name' => 'content_selector',
			'description' => 'If the content is in another element of this page use the ID of that element(# included):<strong>#lightbox-id</strong>
			<br>Or use the editor below to add the content.',
			'dependency' => array(
				'element' => 'content_type',
				'value' => array( 'inline' )
			),
			'group' => 'Source',
		),
		array(
		  'type' => 'textarea_html',
		  'heading' => __( 'Custom Content', 'goya' ),
		  'param_name' => 'content',
		  'description' => __( 'Add the custom content for the ligthbox', 'goya' ),
		  'dependency' => array(
		  	'element' => 'content_type',
		  	'value' => array( 'inline' )
		  ),
		  'group' => 'Source',
		),
	)
) );