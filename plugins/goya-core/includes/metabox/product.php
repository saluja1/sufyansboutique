<?php

add_filter( 'rwmb_meta_boxes', 'goya_product_register_meta_boxes' );

function goya_product_register_meta_boxes( $meta_boxes ) {

	$prefix = 'goya_product_';

	$meta_boxes[] = array(
		'id' => 'et-product-content',
		'title' => 'Extra Content',
		'pages' => array( 'product' ),
		'context' => 'advanced',
		'priority' => 'high',
		'fields' => array(
			array(
		    'type' => 'heading',
		    'name' => esc_html__('Video', 'goya'),
			),
			array(
				'name' => esc_html__('Video URL', 'goya' ),
				'desc' => esc_html__('Enter a YouTube or Vimeo URL.', 'goya' ),
				'id'   => $prefix . 'featured_video',
				'type'  => 'text',
				'std' => '',
				'size' => '50'
			),
			array(
		    'type' => 'heading',
		    'name' => esc_html__('Size Guide', 'goya' ),
		    'desc' => esc_html__('Show the size guide on this product overriding global settings.', 'goya' ),
			),
			array(
				'name' => esc_html__('Link Page', 'goya' ),
				'id' => $prefix . 'sizing_guide',
				'type'        => 'post',
				'post_type'   => 'page',
				'field_type'  => 'select_advanced',
				'placeholder' => 'Select page',
				'query_args'  => array(
	        'post_status'    => 'publish',
	        'posts_per_page' => - 1,
		    ),
			),
	        
	  )
	);


	$meta_boxes[] = array(
		'id' => 'et-product-layout',
		'title' => 'Layout Settings',
		'pages' => array( 'product' ),
		'context' => 'advanced',
		'priority' => 'high',
		'fields' => array(
			array(
		    'type' => 'heading',
		    'name' => esc_html__('Header', 'goya'),
			),
			array(
				'name' => esc_html__('Transparent Header', 'goya' ),
				'id'   => $prefix . 'transparent_header',
				'class' => 'page-header-layout',
				'type' => 'select',
				'options'  => array(
					false         => esc_html__('Default', 'goya'),
					'transparent' => esc_html__('Transparent', 'goya'),
				),
				'std'  => '',
			),
			array(
				'name' => esc_html__('Main Header Color', 'goya' ),
				'desc' => esc_html__('Select header color mode for this page (if the header is transparent).', 'goya' ),
				'id'   => $prefix . 'header_style',
				'class' => 'page-header-field page-header-style hidden',
				'type' => 'select',
				'options'  => array(
					'dark-title'  => esc_html__('Dark Text', 'goya'),
					'light-title' => esc_html__('Light Text', 'goya'),
				),
				'std'  => '',
			),
			array(
		    'type' => 'heading',
		    'name' => esc_html__('Product Info', 'goya'),
		    'desc' => esc_html__('Area on top with gallery, name and cart button', 'goya'),
			),
			array(
				'name' => esc_html__('Product Info Background', 'goya' ),
				'desc' => esc_html__('Override background for product info (Globally defined in Customizer).', 'goya' ),
				'id'   => $prefix . 'showcase_background',
				'type' => 'color',
			),
			array(
				'name' => esc_html__('Product Info Color Style', 'goya' ),
				'desc' => esc_html__('Select header color mode for Product Info.', 'goya' ),
				'id'   => $prefix . 'showcase_style',
				'type' => 'select',
				'options'  => array(
					false        => esc_html__('Default', 'goya'),
					'dark-text'  => esc_html__('Dark Text', 'goya'),
					'light-text' => esc_html__('Light Text', 'goya'),
				),
				'std'  => '',
			),
			array(
		    'type' => 'heading',
		    'name' => esc_html__('Layout', 'goya'),
		    'desc' => esc_html__('"Default" is the value defined in the Customizer.', 'goya' ),
			),
			array(
				'name' => esc_html__('Product Layout', 'goya' ),
				'desc' => esc_html__('Override layout style.', 'goya' ),
				'id'   => $prefix . 'layout_single',
				'type' => 'select',
				'options'  => array(
					false        => esc_html__('Default', 'goya'),
					'regular'    => esc_html__('Regular', 'goya'),
					'showcase'   => esc_html__('Showcase', 'goya'),
					'no-padding' => esc_html__('No Padding', 'goya'),
					'full-width' => esc_html__('Full Width', 'goya'),
				),
				'std'  => '',
			),
			array(
				'name' => esc_html__('Gallery Style', 'goya' ),
				'desc' => esc_html__('Override gallery style.', 'goya' ),
				'id'   => $prefix . 'gallery_style',
				'type' => 'select',
				'options'  => array(
					false      => esc_html__('Default', 'goya'),
					'carousel' => esc_html__('Carousel', 'goya'),
					'column'   => esc_html__('Column', 'goya'),
					'grid'     => esc_html__('Grid', 'goya'),
				),
				'std'  => '',
			),
			array(
				'name' => esc_html__('Details Style', 'goya' ),
				'id'   => $prefix . 'details_style',
				'desc' => esc_html__('Override product details style.', 'goya' ),
				'type' => 'select',
				'options'  => array(
					false       => esc_html__('Default', 'goya'),
					'tabs'      => esc_html__('Tabs', 'goya'),
					'accordion' => esc_html__('Accordion', 'goya'),
					'vertical'  => esc_html__('Vertical', 'goya'),
		    ),
				'std'  => '',
			),
			array(
				'name' => esc_html__('Description Width', 'goya' ),
				'id'   => $prefix . 'description_layout',
				'type' => 'select',
				'options'  => array(
					false   => esc_html__('Default', 'goya'),
					'boxed' => esc_html__('Boxed', 'goya'),
					'full'  => esc_html__('Full Width', 'goya'),
		    ),
				'std'  => '',
			),
			array(
		    'type' => 'heading',
		    'name' => esc_html__('Item Style', 'goya'),
		    'desc' => esc_html__('Style for Masonry Products element', 'goya' ),
			),
			array(
				'name' => esc_html__('Masonry item size', 'goya' ),
				'desc' => esc_html__('Used in some views with masonry layout.', 'goya' ),
				'id'   => $prefix . 'masonry_size',
				'type' => 'image_select',
				'options'  => array(
					'small'  => get_template_directory_uri() . '/assets/img/admin/options/masonry-small.png',
					'large'  => get_template_directory_uri() . '/assets/img/admin/options/masonry-large.png',
					'horizontal' => get_template_directory_uri() . '/assets/img/admin/options/masonry-horizontal.png',
					'vertical'  => get_template_directory_uri() . '/assets/img/admin/options/masonry-vertical.png',
				),
				'std'  => '',
			),
	        
	  )
	);

return $meta_boxes;

}

?>