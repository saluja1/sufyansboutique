<?php
	
// VC element: et_pricing_table

vc_map( array(
	'name' => esc_html__('Pricing Table', 'goya' ),
	'category' => esc_html__('Goya', 'goya' ),
	'base' => 'et_pricing_table',
	'icon' => 'et_pricing_table',
	'content_element'	=> true,
	'as_parent' => array('only' => 'et_pricing_column'),
	'params'	=> array(
		array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Background Color', 'goya' ),
      'param_name'     => 'background_color',
      'description'    => esc_html__( 'You can choose the colors for the highlighted item in the individual Pricing Column settings.', 'goya' ),
    ),
		array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Price Color', 'goya' ),
      'param_name'     => 'price_color',
    ),
    array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Icon Color', 'goya' ),
      'param_name'     => 'icon_color',
      'dependency' => array(
        'element' => 'icon_type',
        'value'   => array( 'icon' )),
    ),
    array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Title Color', 'goya' ),
      'param_name'     => 'title_color',
    ),
    array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Button Color', 'goya' ),
      'param_name'     => 'button_color',
    ),
	),
	'description' => esc_html__('Pricing Table', 'goya' ),
	'js_view' => 'VcColumnView'
) );

// Extend element with the WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_ET_Pricing_Table extends WPBakeryShortCodesContainer {}
}