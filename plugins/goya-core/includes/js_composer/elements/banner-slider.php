<?php
	
// VC element: et_banner_slider
vc_map( array(
	'name' => __( 'Banner Slider', 'goya' ),
	'description' => __( 'Create a banner slider', 'goya' ),
	'category' => esc_html__('Goya', 'goya'),
	'base' => 'et_banner_slider',
	'icon' => 'et_banner_slider',
	'as_parent' => array( 'only' => 'et_banner' ),
	'controls' => 'full',
	'content_element' => true,
	'show_settings_on_create' => false,
	'js_view' => 'VcColumnView',
	'params' => array(
		array(
			'type' 			=> 'checkbox',
			'heading' 		=> __( 'Adaptive Height', 'goya' ),
			'param_name' 	=> 'adaptive_height',
			'description'	=> __( 'Enable adaptive height for each slide.', 'goya' ),
			'value'			=> array(
				__( 'Enable', 'goya' )	=> '1'
			)
		),
		array(
			'type' 			=> 'checkbox',
			'heading' 		=> __( 'Arrows', 'goya' ),
			'param_name' 	=> 'arrows',
			'description'	=> __( 'Display "prev" and "next" arrows.', 'goya' ),
			'value'			=> array(
				__( 'Enable', 'goya' )	=> '1'
			)
		),
		array(
			'type' 			=> 'checkbox',
			'heading' 		=> __( 'Navigation Dots', 'goya' ),
			'param_name' 	=> 'pagination',
			'description'	=> __( 'Display pagination dots.', 'goya' ),
			'value'			=> array(
				__( 'Enable', 'goya' )	=> '1'
			)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Pagination Color', 'goya' ),
			'param_name' 	=> 'pagination_color',
			'description'	=> __( 'Select pagination color.', 'goya' ),
			'value' 		=> array(
				'Light'	=> 'light',
				'Gray'	=> 'gray',
				'Dark' 	=> 'dark'
			),
			'std' 			=> 'gray'
		),
		array(
			'type' 			=> 'checkbox',
			'heading' 		=> __( 'Infinite Loop', 'goya' ),
			'param_name' 	=> 'infinite',
			'description'	=> __( 'Infinite loop sliding.', 'goya' ),
			'value'			=> array(
				__( 'Enable', 'goya' )	=> '1'
			)
		),
		array(
			'type' 			=> 'dropdown',
			'heading' 		=> __( 'Animation Type', 'goya' ),
			'param_name' 	=> 'animation',
			'description'	=> __( 'Select animation type.', 'goya' ),
			'value' 		=> array(
				'Fade'  => 'fade',
				'Slide' => 'slide'
			),
			'std' 			=> 'slide'
		),
		array(
			'type'      => 'textfield',
			'heading'     => __( 'Animation Speed', 'goya' ),
			'param_name'  => 'speed',
			'description' => __( 'Enter animation speed in milliseconds (1 second = 1000 milliseconds).', 'goya' )
		),
		array(
			'type' 			=> 'checkbox',
			'heading' 		=> __( 'Autoplay', 'goya' ),
			'param_name' 	=> 'autoplay',
			'value'			=> array(
				__( 'Enable', 'goya' )	=> '1'
			)
		),
		array(
			'type'      => 'textfield',
			'heading'     => __( 'Autoplay Speed', 'goya' ),
			'param_name'  => 'autoplay_speed',
			'description' => __( 'Enter autoplay interval in milliseconds (1 second = 1000 milliseconds).', 'goya' ),
			'std' 			=> '4000',
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array( '1' )
			)
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Pause on hover', 'goya'),
			'param_name' => 'pause',
			'description' => esc_html__('Pause autoplay on hover.', 'goya'),
			'value' => array(
				__( 'Enable', 'goya' )	=> '1'
			),
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array( '1' )
			)
		),
	)
) );

// Extend element with the WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_ET_Banner_Slider extends WPBakeryShortCodesContainer {}
}