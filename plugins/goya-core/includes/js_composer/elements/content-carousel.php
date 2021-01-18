<?php

// Content Carousel Shortcode
vc_map( array(
	'name' => esc_html__('Content Carousel', 'goya'),
	'description' => esc_html__('Display your content in a carousel', 'goya'),
	'category' => esc_html__('Goya', 'goya'),
	'base' => 'et_content_carousel',
	'icon' => 'et_content_carousel',
	'as_parent' => array('except' => 'et_content_carousel'),	
	
	'show_settings_on_create' => true,
	'content_element' => true,
	'params' => array(
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Columns', 'goya'),
			'param_name' => 'columns',
			'value' => array(
				'1 Column' => '1',
				'2 Columns' => '2',
				'3 Columns' => '3',
				'4 Columns' => '4'
			),
			'std' => '1',
			'description' => esc_html__('Select the layout.', 'goya' )
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Animation', 'goya'),
			'param_name' => 'animation',
			'value' => array(
				'Slide' => 'slide',
				'Fade' => 'fade',
			),
			'std' => 'slide',
		),
		
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Infinite', 'goya'),
			'param_name' => 'infinite',
			'value' => array(
				'Enable' => 'true'
			),
			'description' => esc_html__('Infinite loop sliding.', 'goya'),
		),

		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Auto Play', 'goya'),
			'param_name' => 'autoplay',
			'value' => array(
				'Enable' => 'true'
			),
			'description' => esc_html__('If enabled, the carousel will autoplay.', 'goya'),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Speed of the AutoPlay', 'goya'),
			'param_name' => 'autoplay_speed',
			'value' => '4000',
			'description' => esc_html__('Speed of the autoplay, default 4000 (4 seconds)', 'goya'),
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array('true')
			)
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Pause on hover', 'goya'),
			'param_name' => 'pause',
			'value' => array(
				'Enable' => 'true'
			),
			'description' => esc_html__('Pause autoplay on hover.', 'goya'),
			'dependency' => array(
				'element' => 'autoplay',
				'value' => array('true')
			)
		),
		array(
			'type' => 'checkbox',
			'heading' => __('Center Slides', 'goya'),
			'param_name' => 'center',
			'value' => array(
				'Yes' => 'true'
			)
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__('Margins between items', 'goya'),
			'param_name' => 'margins',
			'std'=> 'regular-padding',
			'value' => array(
				'Regular' => 'regular-padding',
				'Mini' => 'mini-padding',
				'Pixel' => 'pixel-padding',
				'None' => 'no-padding'
			),
			'description' => esc_html__('This will change the margins between items', 'goya' )
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Navigation Dots', 'goya'),
			'param_name' => 'pagination',
			'value' => array(
				__( 'Enable', 'goya' )	=> 'true'
			),
			'group' 					=> 'Navigation',
		),
		array(
			'type' 			=> 'checkbox',
			'heading' 		=> __( 'Arrows', 'goya' ),
			'param_name' 	=> 'arrows',
			'description'	=> __( 'Display "prev" and "next" arrows.', 'goya' ),
			'value'			=> array(
				__( 'Enable', 'goya' )	=> 'true'
			),
			'group' 					=> 'Navigation',
		),
		array(
			'type' => 'checkbox',
			'heading' => esc_html__('Overflow Visible?', 'goya'),
			'param_name' => 'overflow',
			'value' => array(
				'Yes' => 'overflow-visible'
			),
			'std' => '',
			'description' => esc_html__('Show semi-transparent previous and next slides', 'goya' ),
			'group' 					=> 'Navigation',
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__('Extra Class Name', 'goya'),
			'param_name' => 'extra_class',
		),
	),
	'js_view' => 'VcColumnView',
) );

class WPBakeryShortCode_ET_Content_Carousel extends WPBakeryShortCodesContainer { }