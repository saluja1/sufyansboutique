<?php
	
// Shortcode: et_banner
function goya_shortcode_banner( $atts, $content = NULL ) {
	
	extract( shortcode_atts( array(
		'layout'			=> 'full',
		'title' 			=> '',
		'title_size'		=> 'medium',
		'subtitle' 			=> '',
		'subtitle_type' 			=> 'text_style',
		'paragraph' 			=> '',
		'link'			=> '',
		'link_style'			=> 'link_style',
		'link_type'			=> 'banner_link',
		'text_color_scheme'	=> 'dark',
		'text_position'		=> 'h_center-v_center',
		'text_alignment'	=> 'align_left',
		'text_width'		=> '',
		'text_padding'		=> '',
		'text_animation'	=> '',
		'hover_effect'	=> '',
		'image_id'			=> '',
		'img_size'        => '',
		'alt_image_id'		=> '',
		'image_type'		=> 'fluid',
		'height'			=> '50',
		'custom_height'			=> '',
		'border_color'	=> '',
		'title_color'	=> '',
		'title_color_custom'	=> '',
		'subtitle_color'	=> '',
		'subtitle_color_custom'	=> '',
		'subtitle_background_custom' => '',
		'link_color'	=> '',
		'link_color_custom'	=> '',
		'link_background_custom'	=> '',
		'background_color'	=> '',
		'extra_class'	=> ''
	), $atts ) );

	$element_id = uniqid('et-banner-');

	$banner_class[] = $element_id;
	$banner_class[] = 'et-banner';
	
	// Centered content class
	$banner_class[] = 'content-' . esc_attr( $layout ) . ' ';
	
	// Image
	$image_output = '';
	$image_height = '';
	$image_url = '';
	if ( strlen( $image_id ) > 0 ) {
		$img_size = ($img_size === '' ? 'full' : $img_size);
		$image = wp_get_attachment_image($image_id, $img_size);
		if($image == '') {
			$image = '<img src="'. get_template_directory_uri() . '/assets/img/placeholder.png' . '" />';
		}

		$image_title = get_the_title( $image_id );
		
		if ( $image_type == 'fluid' ) {
			$banner_class[] = 'image-type-fluid';
			$image_output .= $image;
			
			if ( strlen( $alt_image_id ) > 0 ) {
				$banner_class[] = 'has-alt-image';
				$alt_image = wp_get_attachment_image($alt_image_id, $img_size,'', array( 'class' => 'et-banner-alt-image' ));
				$image_output .= $alt_image;
			}
		} else {
			$image = wp_get_attachment_image_src( $image_id, 'full' );

			if (!empty($image)) {
			$image_url = esc_url( $image[0] );
			}			
			
			if($image == '') {
				$image_url = get_template_directory_uri() . '/assets/img/placeholder.png';
			}
			// Image height style
			if ( $height != 'custom') {
				$banner_class[] = 'height_' . $height;
			} else {
				$image_height = 'height: ' . $custom_height . ';';
			}
			
			$banner_class[] = 'image-type-css';
			$image_output .= '<div class="et-banner-image vh-height" style="background-image: url(' . $image_url . ');"></div>';
			
			if ( strlen( $alt_image_id ) > 0 ) {
				$banner_class[] = 'has-alt-image';
				$alt_image = wp_get_attachment_image_src( $alt_image_id, 'full' );
				$image_output .= '<div class="et-banner-image vh-height et-banner-alt-image" style="background-image: url(' . esc_url( $alt_image[0] ) . ');"></div>';
			}
		}
		
		$banner_height = '';
	} else {
		// No image class
		$banner_class[] = 'image-type-none';
		
		// Banner height style
		if ( $height != 'custom') {
			$banner_class[] = 'height_' . $height;
		} else {
			$banner_height = 'height: ' . $custom_height . ';';
		}
	}
	
	// CSS animation
	if ( strlen( $text_animation ) > 0 ) {
		$animation_class = ' animated';
		$animation_data = ' data-animate="' . esc_attr( $text_animation ) . '"';
	} else {
		$animation_class = '';
		$animation_data = '';
	}
	
	// Text-color class
	$banner_class[] = 'text-color-' . $text_color_scheme;

	// Hover effect class
	$banner_class[] = 'hover-effect ' . $hover_effect;

	$banner_class[] = $extra_class;

	// Text
	$content_output = '';
		if($subtitle_type == 'tag_style') {
			$content_output .= ( strlen( $subtitle ) > 0 ) ? '<h4 class="et-banner-subtitle  color-' . $subtitle_color . ' ' . $subtitle_type.'">' . $subtitle . '</h4>' : '';
		}
		$content_output .= ( strlen( $title ) > 0 ) ? '<h2 class="et-banner-title color-' . $title_color . ' ' . esc_attr( $title_size ) . '">' . $title . '</h2>' : '';
		if($subtitle_type == 'text_style') {
			$content_output .= ( strlen( $subtitle ) > 0 ) ? '<h4 class="et-banner-subtitle  color-' . $subtitle_color . ' ' . $subtitle_type.'">' . $subtitle . '</h4>' : '';
		}
		$content_output .= ( strlen( $paragraph ) > 0 ) ? '<div class="et-banner-paragraph">' . $paragraph . '</div>' : '';
	
	// Link
	$banner_link_open_output = $banner_link_close_output = '';
	$link_class = '';
	$link_style = ' button et_btn ' . $link_style . ' color-' . $link_color;

	if ( strlen( $link ) > 0 ) {
		$banner_link = vc_build_link( $link );
		$banner_link_target_attr = ( strlen( $banner_link['target'] ) > 0) ? ' target="' . $banner_link['target'] . '"' : '';
		
		if ( $link_type === 'banner_link' ) {
			$banner_link_open_output = '<a href="' . esc_url( $banner_link['url'] ) . '" class="et-banner-link et-banner-link-full' . $link_class . '"' . $banner_link_target_attr . '>';
			$banner_link_close_output = '</a>';
		} else {
			$content_output .= '<a href="' . esc_url( $banner_link['url'] ) . '" class="et-banner-link' . $link_style . ' ' . $link_class . '"' . $banner_link_target_attr . '>' . $banner_link['title'] . '</a>';
		}
	}

	// Caption position
	$text_position = explode( '-', $text_position );
	
	if ( strlen( $content_output ) > 0 ) {
		// Content markup
		$content_output = '
			<div class="et-banner-content">
				<div class="et-banner-content-inner container">
					<div class="et-banner-text ' . $text_position[0] . ' ' . $text_position[1] . ' ' . $text_alignment . '">
						<div class="et-banner-text-inner' . $animation_class . '"' . $animation_data . '>' . $content_output . '</div>
					</div>
				</div>
			</div>';
	}

  // Custom styles
	$styles = '';

	// Background color
	if ( strlen( $background_color ) > 0 ) {
		$styles .= '.'. $element_id .'.et-banner { background-color: '. $background_color .';}';
	}
	
	if ( strlen( $alt_image_id ) > 0 ) {
		$styles .= '@media all and (min-width: 768px) {';
	}

	if ( strlen( $title_color_custom ) > 0 ) {
		$styles .= '.'. $element_id .' .et-banner-text .et-banner-title { color: '. $title_color_custom .';}';
	}
	if ( strlen( $subtitle_color_custom ) > 0 ) {
		$styles .= '.'. $element_id .' .et-banner-text .et-banner-subtitle { color: '. $subtitle_color_custom .';}';
	}
	if ( strlen( $subtitle_background_custom ) > 0 && $subtitle_type == 'tag_style' ) {
		$styles .= '.'. $element_id .' .et-banner-text .et-banner-subtitle { background-color: '. $subtitle_background_custom .'; }';	
	}
	if ( strlen( $link_color_custom ) > 0 ) {
		$styles .= '.'. $element_id .' .et-banner-text .et-banner-link, .'. $element_id .' .et-banner-text .et-banner-link:hover { color: '. $link_color_custom .';}';
	}
	if ( strlen( $link_background_custom ) > 0 ) {
		$styles .= '.'. $element_id .' .et-banner-text .et-banner-link.solid { background-color: '. $link_background_custom .';}';
	}

	if ( strlen( $alt_image_id ) > 0 ) {
		$styles .= '}';
	}

	if ($banner_height != '') {
		$styles .= '.'. $element_id .'.et-banner { '. $banner_height .';}';
	}

	if ( $image_height != '' ) {
		$styles .= '.'. $element_id .'.et-banner .et-banner-image { '. $image_height .';}';
	}
	
	// Text padding
	if ( strlen( $text_padding ) > 0 ) {
		$padding = $text_padding . ' ';
		$padding_top = '0 ';
		$padding_bottom = '0 ';
		
		if ( $text_position[1] === 'v_top' ) {
			$padding_top = $padding;
		} else if ( $text_position[1] === 'v_bottom' ) {
			$padding_bottom = $padding;
		}

		$styles .= '.'. $element_id .'.et-banner .et-banner-text { padding: ' . $padding_top . $padding . $padding_bottom . $padding . ';}';
	}

	// Text width
	if ( $text_width > 0 ) {
		$styles .= '.'. $element_id .'.et-banner .et-banner-text { width: '. $text_width .';}';
	}

	// Hover effects
	if ( strlen( $border_color ) > 0 && ($hover_effect == 'hover-border' || $hover_effect == 'hover-border hover-zoom') ) {
		$styles .= '.'. $element_id .'.et-banner:hover .et-banner-content-inner { box-shadow: inset 0 0 0 20px '. $border_color .';}';
	}

	//Add inline styles
  Goya_Layout::append_to_shortcodes_css_buffer( $styles );
	
	// Banner markup
	$banner_output = '
		<div class="' . esc_attr(implode(' ', $banner_class)) . '">' .
			$banner_link_open_output .
				$image_output .
				$content_output .
			$banner_link_close_output . '
		</div>';
	
	return $banner_output;
}

add_shortcode( 'et_banner', 'goya_shortcode_banner' );