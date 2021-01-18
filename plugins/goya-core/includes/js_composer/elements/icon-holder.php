<?php
	
// VC element: et_icon_holder
vc_map( array(
	'name' => __( 'Icon Holder', 'goya' ),
	'description' => __( 'Container for Icon Box elements', 'goya' ),
	'category' => esc_html__('Goya', 'goya'),
	'base' => 'et_icon_holder',
	'icon' => 'et_icon_holder',
	'as_parent' => array( 'only' => 'et_iconbox' ),
	'controls' => 'full',
	'content_element' => true,
	'show_settings_on_create' => false,
	'js_view' => 'VcColumnView',
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns Large', 'goya'),
			'description' => esc_html__('1200px and up', 'goya'),
			'param_name' => 'columns_large',
			'value' => array(
				'1 Column' => '1',
				'2 Columns' => '2',
				'3 Columns' => '3',
				'4 Columns' => '4',
				'5 Columns' => '5'
			),
			'std' => '3',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns Medium', 'goya'),
			'description' => esc_html__('max-width: 1199px', 'goya'),
			'param_name' => 'columns_medium',
			'value' => array(
				'1 Column' => '1',
				'2 Columns' => '2',
				'3 Columns' => '3',
				'4 Columns' => '4',
				'5 Columns' => '5'
			),
			'std' => '2',
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns Mobile', 'goya'),
			'description' => esc_html__('max-width: 767px', 'goya'),
			'param_name' => 'columns_small',
			'value' => array(
				'1 Column' => '1',
				'2 Columns' => '2',
			),
			'std' => '1',
		),
		array(
			'type' => 'checkbox',
			'heading' => __('Center Columns', 'goya'),
			'param_name' => 'center',
			'value' => array(
				'Yes' => 'true'
			)
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra Class Name', 'goya'),
			'param_name' => 'extra_class',
		),
	)
) );

// Extend element with the WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_ET_Icon_Holder extends WPBakeryShortCodesContainer {}
}