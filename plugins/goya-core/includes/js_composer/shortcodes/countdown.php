<?php function goya_shortcode_countdown( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'date' => '12/24/2018 12:00:00',
		'utc_timezone' => '',
		'size'        => 'md',
		'countdown_color'        => '',
		'countdown_color_custom'        => '',
		'caption_color'       => '',
		'caption_color_custom'       => '',
		'animation' => 'animation bottom-to-top',
	), $atts ) );
	
	$element_id = uniqid('et-countdown-');

	$el_class[] = 'et-countdown';
	$el_class[] = $animation;
	$el_class[] = 'countdown-size-' . $size;
	$el_class[] = 'countdown-color-' . $countdown_color;
	$el_class[] = 'caption-color-' . $caption_color;

	// Enqueue Countdown script
	wp_enqueue_script( 'countdown', GOYA_THEME_URI . '/assets/js/vendor/jquery.downCount.js', array( 'jquery' ), GOYA_THEME_VERSION, true );

	// Custom styles
	$styles = '';
	if ($countdown_color_custom) {
		$styles .= '#' . $element_id . ' .et-countdown-ul li .timestamp { color:' . $countdown_color_custom .'; }';
	}
	if ($caption_color_custom) {
		$styles .= '#' . $element_id . ' .et-countdown-ul li .timelabel { color: ' . $caption_color_custom  . '; }';
	}

	//Add inline styles
  Goya_Layout::append_to_shortcodes_css_buffer( $styles );


	$out ='';
	ob_start();
	?>

	<div id="<?php echo esc_attr($element_id); ?>" class="<?php echo esc_attr(implode(' ', $el_class)); ?>" data-utc="<?php echo esc_attr($utc_timezone); ?>" data-date="<?php echo esc_attr($date); ?>">
		<ul class="et-countdown-ul">
			<li>
				<span class="days timestamp">00</span>
				<span class="timelabel"><?php esc_html_e( 'days', 'goya' ); ?></span>
			</li>
			<li>
				<span class="hours timestamp">00</span>
				<span class="timelabel"><?php esc_html_e( 'hours', 'goya' ); ?></span>
			</li>
			<li>
				<span class="minutes timestamp">00</span>
				<span class="timelabel"><?php esc_html_e( 'minutes', 'goya' ); ?></span>
			</li>
			<li>
				<span class="seconds timestamp">00</span>
				<span class="timelabel"><?php esc_html_e( 'seconds', 'goya' ); ?></span>
			</li>
		</ul>
	</div>
	<?php
	$out = ob_get_clean();
	return $out;
}
add_shortcode('et_countdown', 'goya_shortcode_countdown');