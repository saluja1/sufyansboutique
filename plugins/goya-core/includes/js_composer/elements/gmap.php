<?php

// VC element: et_gmap
vc_map( array(
	'name' => esc_html__('Map Marker', 'goya'),
	'description' => esc_html__('Add location markers to map', 'goya'),
	'category' => esc_html__('Goya', 'goya'),
	'base' => 'et_gmap',
	'icon' => 'et_gmap',
	'as_child' => array('only' => 'et_gmap_parent'),
	'params' => array(
	array(
		'type'           => 'attach_image',
		'heading'        => esc_html__( 'Marker Image', 'goya' ),
		'param_name'     => 'marker_image',
		'description'    => esc_html__( 'Add your Custom marker image or use default one.', 'goya' )
	),
	array(
		'type'           => 'checkbox',
		'heading'        => esc_html__( 'Retina Marker', 'goya' ),
		'param_name'     => 'retina_marker',
		'value'          => array(
			esc_html__('Yes', 'goya') => 'yes',
		),
		'description'    => esc_html__( 'Enabling this option will reduce the size of marker for 50%, example if marker is 32x32 it will be 16x16.', 'goya' )
	),
	array(
		'type'           => 'textfield',
		'heading'        => esc_html__( 'Latitude', 'goya' ),
		'param_name'     => 'latitude',
		'description'    => esc_html__( 'Enter latitude coordinate. To select map coordinates, use http://www.latlong.net/convert-address-to-lat-long.html', 'goya' ),
	),
	array(
		'type'           => 'textfield',
		'heading'        => esc_html__( 'Longitude', 'goya' ),
		'param_name'     => 'longitude',
		'description'    => esc_html__( 'Enter longitude coordinate.', 'goya' ),
	),
	array(
		'type'           => 'textfield',
		'heading'        => esc_html__( 'Marker Title', 'goya' ),
		'admin_label'    => true,
		'param_name'     => 'marker_title'
	),
	array(
		'type'           => 'textarea',
		'heading'        => esc_html__( 'Marker Description', 'goya' ),
		'param_name'     => 'marker_description'
	)
	),
	
));
