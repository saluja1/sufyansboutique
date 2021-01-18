<?php

add_filter( 'rwmb_meta_boxes', 'goya_post_register_meta_boxes' );

function goya_post_register_meta_boxes( $meta_boxes ) {

	$prefix = 'goya_post_';

	$meta_boxes[] = array(
		'id' => 'et-post-media',
		'title' => esc_html__('Media Content', 'goya' ),
		'pages' => array( 'post' ),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
		    'type' => 'heading',
		    'name' => esc_html__('Image Gallery', 'goya'),
			),
			array(
				'name'  => esc_html__('Images', 'goya' ),
				'desc' => esc_html__('Add images (max. 8) to show on header Gallery. Used for the Gallery post format.', 'goya' ),
				'id' => $prefix . 'featured_gallery',
				'type' => 'image_advanced',
				'max_file_uploads' => 8,
			),
			array(
		    'type' => 'heading',
		    'name' => esc_html__('Video', 'goya'),
			),
			array(
				'name' => esc_html__('Video URL', 'goya' ),
				'id'   => $prefix . 'featured_video',
				'desc' => esc_html__('Enter a YouTube or Vimeo URL. Used for the Video post format.', 'goya' ),
				'type' => 'text',
				'std'  => '',
				'size' => 40,
			)
		)
	);

	$meta_boxes[] = array(
		'id' => 'et-post-page',
		'title' => 'Page Settings',
		'pages' => array( 'post' ),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name' => esc_html__('Main Header Color', 'goya' ),
				'desc' => esc_html__('Header color mode used on Transparent Header & Background Featured Image.', 'goya' ),
				'id'   => $prefix . 'header_style',
				'type' => 'select',
				'options'  => array(
					'dark-title'  => esc_html__('Dark Text', 'goya'),
					'light-title' => esc_html__('Light Text', 'goya'),
				),
				'std'  => 'light-title',
			),
			array(
				'name' => esc_html__('Hero Title Background', 'goya' ),
				'desc' => esc_html__('Used on the Hero Title layout.', 'goya' ),
				'id'   => $prefix . 'hero_background',
				'type' => 'color',
			),
					
		)
	);

	return $meta_boxes;

}

?>