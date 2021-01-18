<?php 

// VC element: et_hovercard

vc_map( array(
	'name' => esc_html__('Hover Card', 'goya' ),
	'base' => 'et_hovercard',
	'icon' => 'et_hovercard',
	'category' => esc_html__('Goya', 'goya' ),
	'params' => array(
		 array(
			'type'           => 'vc_link',
			'heading'        => esc_html__( 'Box link', 'goya' ),
			'param_name'     => 'link',
			'description'    => esc_html__( 'Add a URL (optional)', 'goya' ),
		),
		array(
		  'type' => 'textfield',
		  'heading' => esc_html__('Min Height', 'goya' ),
		  'param_name' => 'min_height',
		  'description' => esc_html__('Please enter the minimum height you would like for you box. Enter in number of pixels - Don\'t enter \'px\', default is \'300\'', 'goya' )
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra Class Name', 'goya' ),
			'param_name' => 'extra_class',
		),
    array(
			'type'  => 'textfield',
			'heading' => esc_html__('Title', 'goya' ),
			'param_name' => 'normal_title',
			'group' => esc_html__('Normal', 'goya' )
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Title Color', 'goya' ),
			'param_name' => 'normal_title_color',
			'group' => esc_html__('Normal', 'goya' )
		),
		array(
			'type' => 'attach_image',
			'heading' => esc_html__('Background Image', 'goya' ),
			'param_name' => 'normal_bg_image',
			'group' => esc_html__('Normal', 'goya' )
		),
		array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Background Color', 'goya' ),
      'param_name'     => 'normal_bg_color',
      'group' => esc_html__('Normal', 'goya' ),
      'dependency' => array(
        'element' => 'highlight',
        'value'   => array( 'true' )),
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
      'std'       => ''
    ),
    array(
      'type'      => 'dropdown',
      'heading'     => __('Icon', 'goya' ),
      'param_name'  => 'icon_type',
      'description' => __( 'Select icon type.', 'goya' ),
      'value'     => array(
      	'No Icon'  => 'no_icon',
        'Font Icon' => 'icon',
        'Image'   => 'image_id'
      ),
      'std'       => 'no_icon',
      'group' => esc_html__('Hover', 'goya' )
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
      'dependency'  => array(
        'element' => 'icon_type',
        'value'   => 'icon'
      ),
      'group' => esc_html__('Hover', 'goya' )
    ),
    array(
      'type'      => 'iconpicker',
      'heading'     => __( 'Icon', 'goya' ),
      'param_name'  => 'icon_pixeden',
      'description'   => __( 'Select icon from library.', 'goya' ),
      'value'     => 'pe-7s-close',
      'settings'    => array(
        'type'      => 'pixeden',
        'emptyIcon'   => false,
        'iconsPerPage'  => 3000
      ),
      'dependency'  => array(
        'element' => 'icon_library',
        'value'   => 'pixeden'
      ),
      'group' => esc_html__('Hover', 'goya' )
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
      'group' => esc_html__('Hover', 'goya' )
    ),
    array(
      'type'      => 'attach_image',
      'heading'     => __( 'Image', 'goya' ),
      'param_name'  => 'image_id',
      'description' => __( 'Select image from the media library.', 'goya' ),
      'dependency'  => array(
        'element' => 'icon_type',
        'value'   => array( 'image_id' )
      ),
      'group' => esc_html__('Hover', 'goya' )
    ),
		array(
			'type'  => 'textfield',
			'heading' => esc_html__('Title', 'goya' ),
			'param_name' => 'hover_title',
			'group' => esc_html__('Hover', 'goya' )
		),
		array(
			'type' => 'textarea_safe',
			'heading' => esc_html__('Content', 'goya' ),
			'param_name' => 'hover_content',
			'group' => esc_html__('Hover', 'goya' )
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Icon Color', 'goya' ),
			'param_name' => 'hover_icon_color',
			 'dependency'  => array(
        'element' => 'icon_type',
        'value'   => 'icon'
      ),
			'group' => esc_html__('Hover', 'goya' )
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Title Color', 'goya' ),
			'param_name' => 'hover_title_color',
			'group' => esc_html__('Hover', 'goya' )
		),
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__('Content Color', 'goya' ),
			'param_name' => 'hover_content_color',
			'group' => esc_html__('Hover', 'goya' )
		),
		array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Background Color', 'goya' ),
      'param_name'     => 'hover_bg_color',
      'group' => esc_html__('Hover', 'goya' ),
      'dependency' => array(
        'element' => 'highlight',
        'value'   => array( 'true' )),
    ),
	),
	'description' => esc_html__('Add a Hover Card', 'goya' )
) );