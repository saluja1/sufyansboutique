<?php
	
// VC element: et_pricing_table

vc_map( array(
	'name' => esc_html__('Pricing Table Column', 'goya' ),
  'description' => esc_html__('Add a pricing table column', 'goya' ),
  'category' => esc_html__('Goya', 'goya'),
	'base' => 'et_pricing_column',
	'icon' => 'et_pricing_column',
	'as_child' => array('only' => 'et_pricing_table'),
	'params'	=> array(
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Highlight this column?', 'goya' ),
			'param_name' => 'highlight',
			'value' => array(
				__( 'Yes', 'goya' )	=> 'true'
			),
			'description' => esc_html__('If enabled, this column will be hightlighted. See the Styling tab.', 'goya' ),
		),
		array(
      'type'      => 'dropdown',
      'heading'     => __('Icon Type', 'goya' ),
      'param_name'  => 'icon_type',
      'description' => __( 'Select icon type.', 'goya' ),
      'value'     => array(
        'Font Icon' => 'icon',
        'Image'   => 'image_id'
      ),
      'std'       => 'icon',
      'dependency' => array(
        'element' => 'style',
        'value'   => array( 'counter-top','counter-bottom' )),
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
      )
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
      'type'      => 'attach_image',
      'heading'     => __( 'Image', 'goya' ),
      'param_name'  => 'image_id',
      'description' => __( 'Select image from the media library.', 'goya' ),
      'dependency'  => array(
        'element' => 'icon_type',
        'value'   => array( 'image_id' )
      )
    ),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Title', 'goya' ),
			'param_name'     => 'title',
			'admin_label'	 => true,
			'description'    => esc_html__( 'Title of this pricing column', 'goya' ),
		),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Price', 'goya' ),
			'param_name'     => 'price',
			'description'    => esc_html__( 'Price of this pricing column.', 'goya' ),
		),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Sub Title', 'goya' ),
			'param_name'     => 'sub_title',
			'description'    => esc_html__( 'Some information under the price.', 'goya' ),
		),
		array(
			'type'           => 'textarea_html',
			'heading'        => esc_html__( 'Description', 'goya' ),
			'param_name'     => 'content',
			'description'    => esc_html__( 'Include a small description for this box, this text area supports HTML too.', 'goya' ),
		),
		array(
			'type'           => 'vc_link',
			'heading'        => esc_html__( 'Pricing CTA Button', 'goya' ),
			'param_name'     => 'link',
			'description'    => esc_html__( 'Button at the end of the pricing table.', 'goya' ),
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
      'std'       => 'animation bottom-to-top'
    ),
		array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Background Color', 'goya' ),
      'param_name'     => 'background_color',
      'group'          => 'Styling',
      'dependency' => array(
        'element' => 'highlight',
        'value'   => array( 'true' )),
    ),
		array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Price Color', 'goya' ),
      'param_name'     => 'price_color',
      'group'          => 'Styling',
      'dependency' => array(
        'element' => 'highlight',
        'value'   => array( 'true' )),
    ),
    array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Icon Color', 'goya' ),
      'param_name'     => 'icon_color',
      'group'          => 'Styling',
      'dependency' => array(
        'element' => 'highlight',
        'value'   => array( 'true' )),
    ),
    array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Title Color', 'goya' ),
      'param_name'     => 'title_color',
      'group'          => 'Styling',
      'dependency' => array(
        'element' => 'highlight',
        'value'   => array( 'true' )),
    ),
    array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Button Color', 'goya' ),
      'param_name'     => 'button_color',
      'group'          => 'Styling',
      'dependency' => array(
        'element' => 'highlight',
        'value'   => array( 'true' )),
    ),
	),
	
) );

// Extend element with the WPBakeryShortCode class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCode' ) ) {
	class WPBakeryShortCode_ET_Pricing_Column extends WPBakeryShortCode {}
}