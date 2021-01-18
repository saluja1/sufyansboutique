<?php
/**
 *	Goya Widget: Social Media Icons
 */

class Goya_Widget_Social_Media extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname'   => 'et_widget et_widget_social_media',
			'description' => __('Display social media icons', 'goya' )
		);

		parent::__construct(
			'et_social_media_widget',
			__( 'Social Media Icons' , 'goya' ),
			$widget_ops
		);

	}

	/**
	 * Widget function
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget( $args, $instance ) {
		extract( $args );

		$social_icons = array(
			'facebook',
			'tiktok',
			'twitter',
			'instagram',
			'googleplus',
			'pinterest',
			'linkedin',
			'rss',
			'tumblr',
			'youtube',
			'email',
			'whatsapp',
			'vimeo',
			'behance',
			'dribbble',
			'flickr',
			'github',
			'skype',
			'snapchat',
			'wechat',
			'weibo',
			'foursquare',
			'soundcloud',
			'vk',
		);

		//Our variables from the widget settings.
		$title = apply_filters('widget_title', $instance['title'] );
		$intro_text = $instance['intro_text'];

		echo $before_widget;

		// Display the widget title 
		if ( $title ) echo $before_title . $title . $after_title; ?>

		<div class="social_widget">
			<?php if ($intro_text) { ?>
				<div class="intro-text"><?php echo esc_attr( $intro_text ) ?></div>
			<?php } ?>
			<ul class="social-icons">
				<?php foreach ($social_icons as $key) {
					if(isset($instance[$key]) && !empty($instance[$key])) { ?>
						<li><a href="<?php echo esc_url( $instance[$key] ); ?>" title="<?php echo esc_attr($key); ?>" target="_blank"><i class="et-icon et-<?php echo esc_attr($key); ?>"></i></a></li>
					<?php }
				} ?>
			</ul>
		</div>
		
		<?php 
		echo $after_widget;
	}

	//Update the widget 
	 
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['intro_text'] = strip_tags( $new_instance['intro_text'] );

		$instance['facebook'] = strip_tags( $new_instance['facebook'] );
		$instance['tiktok'] = strip_tags( $new_instance['tiktok'] );
		$instance['twitter'] = strip_tags( $new_instance['twitter'] );
		$instance['instagram'] = strip_tags( $new_instance['instagram'] );
		$instance['googleplus'] = strip_tags( $new_instance['googleplus'] );
		$instance['pinterest'] = strip_tags( $new_instance['pinterest'] );
		$instance['linkedin'] = strip_tags( $new_instance['linkedin'] );
		$instance['rss'] = strip_tags( $new_instance['rss'] );
		$instance['tumblr'] = strip_tags( $new_instance['tumblr'] );
		$instance['youtube'] = strip_tags( $new_instance['youtube'] );
		$instance['email'] = strip_tags( $new_instance['email'] );
		$instance['whatsapp'] = strip_tags( $new_instance['whatsapp'] );
		$instance['vimeo'] = strip_tags( $new_instance['vimeo'] );
		$instance['behance'] = strip_tags( $new_instance['behance'] );
		$instance['dribbble'] = strip_tags( $new_instance['dribbble'] );
		$instance['flickr'] = strip_tags( $new_instance['flickr'] );
		$instance['github'] = strip_tags( $new_instance['github'] );
		$instance['skype'] = strip_tags( $new_instance['skype'] );
		$instance['snapchat'] = strip_tags( $new_instance['snapchat'] );
		$instance['wechat'] = strip_tags( $new_instance['wechat'] );
		$instance['weibo'] = strip_tags( $new_instance['weibo'] );
		$instance['foursquare'] = strip_tags( $new_instance['foursquare'] );
		$instance['soundcloud'] = strip_tags( $new_instance['soundcloud'] );
		$instance['vk'] = strip_tags( $new_instance['vk'] );

		return $instance;
	}

	
	function form( $instance ) {

		$social_base = array(
			'facebook'   => esc_html__( 'Facebook', 'goya' ),
			'tiktok'   => esc_html__( 'Tiktok', 'goya' ),
			'twitter'    => esc_html__( 'Twitter', 'goya' ),
			'instagram'  => esc_html__( 'Instagram', 'goya' ),
			'googleplus' => esc_html__( 'Google+', 'goya' ),
			'pinterest'  => esc_html__( 'Pinterest', 'goya' ),
			'linkedin'   => esc_html__( 'LinkedIn', 'goya' ),
			'rss'        => esc_html__( 'RSS', 'goya' ),
			'tumblr'     => esc_html__( 'Tumblr', 'goya' ),
			'youtube'    => esc_html__( 'Youtube', 'goya' ),
			'email'      => esc_html__( 'Email', 'goya' ),
			'whatsapp'   => esc_html__( 'Whatsapp', 'goya' ),
			'vimeo'      => esc_html__( 'Vimeo', 'goya' ),
			'behance'    => esc_html__( 'Behance', 'goya' ),
			'dribbble'   => esc_html__( 'Dribbble', 'goya' ),
			'flickr'     => esc_html__( 'Flickr', 'goya' ),
			'github'     => esc_html__( 'GitHub', 'goya' ),
			'skype'      => esc_html__( 'Skype', 'goya' ),
			'snapchat'   => esc_html__( 'Snapchat', 'goya' ),
			'wechat'     => esc_html__( 'WeChat', 'goya' ),
			'weibo'      => esc_html__( 'Weibo', 'goya' ),
			'foursquare' => esc_html__( 'Foursquare', 'goya' ),
			'soundcloud' => esc_html__( 'Soundcloud', 'goya' ),
			'vk'         => esc_html__( 'VK', 'goya' ),
		);

		//Set up some default widget settings.
		$defaults = array( 
			'title' => '',
			'intro_text' => '',
			'facebook'   => '',
			'tiktok'   => '',
			'twitter'    => '',
			'instagram'  => '',
			'googleplus' => '',
			'pinterest'  => '',
			'linkedin'   => '',
			'rss'        => '',
			'tumblr'     => '',
			'youtube'    => '',
			'email'      => '',
			'whatsapp'   => '',
			'vimeo'      => '',
			'behance'    => '',
			'dribbble'   => '',
			'flickr'     => '',
			'github'     => '',
			'skype'      => '',
			'snapchat'   => '',
			'wechat'     => '',
			'weibo'      => '',
			'foursquare' => '',
			'soundcloud' => '',
			'vk'         => '',
		);
		
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Widget title:', 'goya'); ?></label>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" class="widefat" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'intro_text' ); ?>"><?php _e('Intro text', 'goya'); ?></label>
			<textarea id="<?php echo $this->get_field_id( 'intro_text' ); ?>" name="<?php echo $this->get_field_name( 'intro_text' ); ?>" rows="6" cols="20" class="widefat" ><?php echo $instance['intro_text']; ?></textarea>
		</p>

		<?php foreach ($social_base as $key => $value) { ?>
			<p>
				<label for="<?php echo $this->get_field_id( $key ); ?>"><?php _e($value, 'goya'); ?></label>
				<input type="text" id="<?php echo $this->get_field_id( $key ); ?>" name="<?php echo $this->get_field_name( $key ); ?>" value="<?php echo $instance[$key]; ?>" class="widefat" />
			</p>
		<?php } 
	}
}
