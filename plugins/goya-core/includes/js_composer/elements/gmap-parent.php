<?php

// VC element: et_gmap_parent
vc_map( array(
	'name' => __('Google Map', 'goya'),
	'description'	=> esc_html__( 'Add a Google map with markers', 'goya' ),
	'category' => __('Goya', 'goya'),
	'base' => 'et_gmap_parent',
	'icon' => 'et_gmap_parent',
	'as_parent' => array('only' => 'et_gmap'),
	'controls' => 'full',
	'content_element' => true,
	'show_settings_on_create' => false,
	'js_view' => 'VcColumnView',
	'params' => array(
		array(
		  'type' => 'textfield',
		  'heading' => __('Map Height', 'goya'),
		  'param_name' => 'height',
		  'admin_label' => true,
		  'value' => 50,
		  'description' => __('Height of the map in vh (0-100). For example, 50 will be 50% of viewport height and 100 will be full height. <small>Add your Google Maps API in Appearance > Customize > General Settings.</small>', 'goya')
		),
		array(
			'type'           => 'textfield',
			'heading'        => __( 'Map Zoom', 'goya' ),
			'param_name'     => 'zoom',
			'value'			 		 => '0',
			'description'    => __( 'Set map zoom level. Leave 0 to automatically fit to bounds.', 'goya' )
		),
		array(
			'type'           => 'checkbox',
			'heading'        => __( 'Map Controls', 'goya' ),
			'param_name'     => 'map_controls',
			'std'            => 'panControl, zoomControl, mapTypeControl, scaleControl',
			'value'          => array(
				__('Pan Control', 'goya')             => 'panControl',
				__('Zoom Control', 'goya')            => 'zoomControl',
				__('Map Type Control', 'goya')        => 'mapTypeControl',
				__('Scale Control', 'goya')           => 'scaleControl',
				__('Street View Control', 'goya')     => 'streetViewControl'
			),
			'description'    => __( 'Toggle map options.', 'goya' )
		),

		array(
			'type'           => 'dropdown',
			'heading'        => __( 'Map Type', 'goya' ),
			'param_name'     => 'map_type',
			'std'            => 'roadmap_custom',
			'value'          => array(
				__('Custom Roadmap', 'goya')   => 'roadmap_custom',
				__('Default Roadmap (no custom styles)', 'goya')   => 'roadmap',
				__('Satellite', 'goya') => 'satellite',
				__('Hybrid', 'goya')    => 'hybrid',
			),
			'description' => __( 'Choose map style.', 'goya' ),
			'group' 					=> 'Map Styling',
		),
		
		array(
			'type' => 'dropdown',
			'heading' => __( 'Map Style', 'goya' ),
			'param_name' => 'map_style',
			'description' => __( 'Select a custom map style.', 'goya' ),
			'value' => array(
				'Paper' => 'paper',
				'Light' => 'light',
				'Dark' => 'dark',
				'Grayscale' => 'grayscale',
				'Countries' => 'countries'
			),
			'std' => 'paper',
			'dependency'	=> array(
				'element'	=> 'map_type',
				'value'		=> 'roadmap_custom'
			),
			'group' 					=> 'Map Styling',
		),

		array(
			'type' => 'textarea_raw_html',
			'heading' => __( 'Use Your Own Map Style', 'goya' ),
			'param_name' => 'custom_map_style',
			'description'    => sprintf(__( 'Paste your own style code here. Browse map styles or create your own in %s SnazzyMaps %s.', 'goya' ),'<a href="https://snazzymaps.com/" target="_blank">','</a>', 'goya' ),
			'dependency'	=> array(
				'element'	=> 'map_type',
				'value'		=> 'roadmap_custom'
			),
			'group' 					=> 'Map Styling',
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Locations List', 'goya' ),
			'param_name' => 'locations_list',
			'description' => __( 'Show a list with locations.', 'goya' ),
			'value' => array(
				__( 'Enable', 'goya' ) => '1'
			),
			'group' 				=> 'Locations List'
		),
		array(
			'type'           => 'dropdown',
			'heading'        => __( 'Locations list style', 'goya' ),
			'param_name'     => 'locations_layout',
			'std'            => 'horizontal',
			'value'          => array(
				__('Horizontal', 'goya')   => 'horizontal',
				__('Vertical', 'goya') => 'vertical',
			),
			'description' => __( 'Choose locations list layout.', 'goya' ),
			'dependency'	=> array(
				'element'	=> 'locations_list',
				'value'		=> '1'
			),
			'group' 				=> 'Locations List'
		),
		array(
			'type'           => 'dropdown',
			'heading'        => __( 'Locations rows/columns style', 'goya' ),
			'param_name'     => 'locations_columns',
			'std'            => '4',
			'value'          => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
			),
			'description' => __( 'Number of columns(horizontal) or rows(vertical).', 'goya' ),
			'dependency'	=> array(
				'element'	=> 'locations_list',
				'value'		=> '1'
			),
			'group' 				=> 'Locations List'
		),

	),
) );

// Extend element with the WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
	class WPBakeryShortCode_ET_Gmap_Parent extends WPBakeryShortCodesContainer { }
}