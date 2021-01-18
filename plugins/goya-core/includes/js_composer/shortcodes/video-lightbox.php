<?php function goya_shortcode_video_lightbox( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'style'			=> 'lightbox-icon',
		'video'			=> '',
		'video_text'			=> '',
		'icon_style'			=> 'pulse',
		'icon_size'		=> 'medium',
		'icon_color'	=> '',
		'icon_color_custom'	=> '',
		'image' => '',
		'animation'		=> 'animation bottom-to-top',
		'hover_style'		=> '',
	), $atts ) );
	
	$element_id = uniqid('et-video-lightbox-');
	$el_class[] = 'et-lightbox';
	$el_class[] = 'et-video-lightbox';
	$el_class[] = 'mfp-video';
	$el_class[] = $style;
	$el_class[] = 'icon-' . $icon_style;
	$el_class[] = 'icon-color-' . $icon_color;
	$el_class[] = $hover_style;
	$el_class[] = $icon_size;
	$el_class[] = $animation;

	// Custom styles
	$styles = '';
	if ($icon_color_custom) {
		$styles .= '#' . $element_id . ' svg { stroke:' . $icon_color_custom .'; fill: '. $icon_color_custom .'; }';
		$styles .= '#' . $element_id . ' .et-video-icon:before { box-shadow: 0 0 0 4px ' . $icon_color_custom .'; }';
		$styles .= '#' . $element_id . '.small .et-video-icon:before { box-shadow: 0 0 0 2px ' . $icon_color_custom .'; }';
		$styles .= '#' . $element_id . '.large .et-video-icon:before { box-shadow: 0 0 0 5px ' . $icon_color_custom .'; }';
		$styles .= '#' . $element_id . '.et-video-icon:after { background-color:' . $icon_color_custom .'; }';
	}

	//Add inline styles
  Goya_Layout::append_to_shortcodes_css_buffer( $styles );

	$out ='';
	ob_start();
		
	?>

	<div id="<?php echo esc_attr($element_id); ?>" class="<?php echo esc_attr(implode(' ', $el_class)); ?>" data-mfp-type="iframe" data-mfp-src="<?php echo esc_url( $video ) ?>" >
		<?php
		if ($style == 'lightbox-image') { 
			$image_src = wp_get_attachment_image_src( $image, 'full' );
			$image_title = get_the_title( $image );

			$image_url = $image_src[0];
			
			if($image_src == '') {
				$image_url = get_template_directory_uri() . '/assets/img/placeholder.png';
			}

			?>
			
			<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_title ); ?>" />
		<?php } ?>
		
		<div class="et-video-icon">
			<?php get_template_part('assets/img/svg/play.svg'); ?>
		</div>

		<?php if ($style == 'lightbox-text') { ?>
			<span class="et-video-text"><?php echo wp_kses_post($video_text); ?></span>
		<?php } ?>
	</div>
	<?php
	
	$out = ob_get_clean();
	return $out;
}
add_shortcode('et_video_lightbox', 'goya_shortcode_video_lightbox');