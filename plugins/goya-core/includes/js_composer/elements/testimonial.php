<?php

// VC element: et_testimonial
vc_map( array(
	'name' => esc_html__('Testimonial', 'goya'),
	'description' => esc_html__('Single Testimonial', 'goya'),
	'category' => esc_html__('Goya', 'goya'),
	'base' => 'et_testimonial',
	'icon' => 'et_testimonial',
	
	//'as_child' => array('only' => 'et_testimonial_slider'),
	'params'	=> array(
		array(
			'type'           => 'textarea',
			'heading'        => esc_html__( 'Quote', 'goya' ),
			'param_name'     => 'quote',
			'description'    => esc_html__( 'Quote you want to show', 'goya' ),
		),
		array(
		'type'           => 'textfield',
			'heading'        => esc_html__( 'Author', 'goya' ),
			'param_name'     => 'author_name',
			'admin_label'	 => true,
			'description'    => esc_html__( 'Name of the member.', 'goya' ),
		),
		array(
			'type'           => 'textfield',
			'heading'        => esc_html__( 'Author Title', 'goya' ),
			'param_name'     => 'author_title',
			'description'    => esc_html__( 'Title that will appear below author name.', 'goya' ),
		),
		array(
			'type'           => 'attach_image',
			'heading'        => esc_html__( 'Author Image', 'goya' ),
			'param_name'     => 'author_image',
			'description'    => esc_html__( 'Add Author image here. Could be used depending on style.', 'goya' )
		)
	),
	
) );