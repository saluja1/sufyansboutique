<?php

// VC element: et_testimonial_slider
vc_map( array(
	'name' => esc_html__('Testimonial Slider', 'goya'),
	'description' => __( 'Create a testimonials slider', 'goya' ),
	'category' => esc_html__('Goya', 'goya'),
	'base' => 'et_testimonial_slider',
	'icon' => 'et_testimonial_slider',
	'content_element'	=> true,
	
	'js_view' => 'VcColumnView',
	'as_parent' => array('only' => 'et_testimonial'),
	'params'	=> array(
		array(
			'type' 			=> 'checkbox',
			'heading' 		=> __( 'Arrows', 'goya' ),
			'param_name' 	=> 'arrows',
			'description'	=> __( 'Display "prev" and "next" arrows.', 'goya' ),
			'value'			=> array(
				__( 'Enable', 'goya' )	=> 'true'
			)
		),
		array(
			'type' 			=> 'checkbox',
			'heading' 		=> __( 'Pagination', 'goya' ),
			'param_name' 	=> 'pagination',
			'description'	=> __( 'Display pagination.', 'goya' ),
			'value'			=> array(
				__( 'Enable', 'goya' )	=> 'true'
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
			'description'	=> __( 'Change slides automatically.', 'goya' ),
			'value'			=> array(
				__( 'Enable', 'goya' )	=> 'true'
			)
		),
		array(
			'type'      => 'textfield',
			'heading'     => __( 'Autoplay Speed', 'goya' ),
			'param_name'  => 'autoplay_speed',
			'description' => __( 'Enter autoplay in milliseconds (1 second = 1000 milliseconds). Default is 2500.', 'goya' ),
			'dependency'  => array(
        'element' => 'autoplay',
        'value'   => 'true'
      )
		),
	)
) );

// Extend element with the WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_ET_Testimonial_Slider extends WPBakeryShortCodesContainer {}
}