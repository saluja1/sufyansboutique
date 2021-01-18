<?php

/* Adding Lazyload Class */
function goya_add_lazy_class( $html = '', $new_class ) {
	if ( get_theme_mod('lazy_load',false) === true ) {
		$pattern = '/class="([^"]*)"/';
	
		// Class attribute set.
		if ( preg_match( $pattern, $html, $matches ) ) {
			$predefined_classes = explode( ' ', $matches[1] );
			if ( ! in_array( $new_class, $predefined_classes, true ) ) {
				$predefined_classes[] = $new_class;
				$html = str_replace(
					$matches[0],
					sprintf( 'class="%s"', implode( ' ', $predefined_classes ) ),
					$html
				);
			}
		} else {
			$html = preg_replace( '/(\<.+?\s)/', sprintf( '$1class="%s" ', $new_class ), $html );
		}
	}
	return $html;
}

/* Filter Images */
function goya_lazy_images_filter( $content ) {
	if ( get_theme_mod('lazy_load',false) === true ) {
		if ( is_feed()
			|| intval( get_query_var( 'print' ) ) === 1
			|| intval( get_query_var( 'printpage' ) ) === 1
			|| strpos( $_SERVER['HTTP_USER_AGENT'], 'Opera Mini' ) !== false
		) {
			return $content;
		}
	
		$matches = array();
		$resp_replace      = 'data-srcset=';
		$size_replace      = 'data-sizes=';
		// Skip some images.
		$skip_images_regex = '/class=".*(lazyload|rev-slidebg|skip-lazy).*"/';
		$skip_lazy_regex = '/data-lazyload=/';
		$placeholder = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';
		preg_match_all( '/<img\s+.*?>/', $content, $matches );
	
		$search  = array();
		$replace = array();
	
		foreach ( $matches[0] as $img_html ) {
	
			// Don't replace if a skip class is provided and the image has the class.
			if ( ! ( preg_match( $skip_images_regex, $img_html ) ) && ! ( preg_match( $skip_lazy_regex, $img_html ) ) ) {
	
				$replace_html = preg_replace( '/<img(.*?)src=/i', '<img$1src="' . $placeholder . '" data-src=', $img_html );
				$replace_html = preg_replace( '/srcset=/i', $resp_replace, $replace_html );
				$replace_html = preg_replace( '/sizes=/i', $size_replace, $replace_html );
	
				$replace_html = goya_add_lazy_class( $replace_html, 'lazyload' );
	
				array_push( $search, $img_html );
				array_push( $replace, $replace_html );
			}
		} // End foreach().
	
		$content = str_replace( $search, $replace, $content );
	}
	return $content;
}

/* Change source to low quality */
function goya_lazy_low_quality( $attr, $attachment, $size ) {
	if ( get_theme_mod('lazy_load',false) === true ) {
		$placeholder = 'data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==';
	
		// Low Quality Image Placeholders.
		if (!is_string($size)) {
			return $attr;
		}

		$skip = 'skip-lazy';
		if(preg_match("/{$skip}/i", $attr['class'])) {
			return $attr;
		}

		$post_size = array('medium','medium_large','large','full');

		if ( in_array($size, $post_size) ) {
			$placeholder = wp_get_attachment_image_src( $attachment->ID, 'post-thumbnail' );
			$placeholder = $placeholder[0];
		}
	
		// Lazy Sizes.
		$attr['data-src']      = $attr['src'];
		$attr['src']           = $placeholder;
		$attr['class']        .= ' et-lazyload lazyload';

		// Sizes
		if ( isset( $attr['sizes'] ) ) {
			$attr['data-sizes'] = $attr['sizes'];
			unset( $attr['sizes'] );
		} else {
			$attr['data-sizes'] = 'auto';
		}
	
		// SrcSet
		if ( isset( $attr['srcset'] ) ) {
			$attr['data-srcset'] = $attr['srcset'];
			unset( $attr['srcset'] );
		}
	}
	return $attr;
}

/*
 * Filters
 */

add_action( 'wp', function () {
	if ( !is_admin() && !(function_exists( 'is_amp_endpoint' ) && is_amp_endpoint() ) ) {
		add_filter( 'the_content', 'goya_lazy_images_filter', 200 );
		add_filter( 'wp_get_attachment_image_attributes', 'goya_lazy_low_quality', 10, 3 );
	}
} );


/* Sharing */
function goya_social_share_links() {
	$id = get_the_ID();
	$permalink = esc_url(get_permalink($id));
	$title = the_title_attribute(array('echo' => 0, 'post' => $id) );
	$image_id = get_post_thumbnail_id($id);
	$image = wp_get_attachment_image_src($image_id,'full');

	$share_icons = get_theme_mod( 'share_icons', array('facebook', 'twitter', 'pinterest') );
	
	if ( !empty($share_icons) ) { ?>

		<ul class="social-icons share-article">
		
		<li class="share-label"><?php echo apply_filters( 'share_translation',  esc_html('Share', 'goya' ) ); ?></li>

		<?php
		
		foreach ( $share_icons as $icon ) {

			$href = $parameters = '';

			switch ($icon) {
				case 'facebook':
					$href = 'http://www.facebook.com/sharer.php?u=' . rawurlencode( esc_url($permalink) );
					break;
				case 'twitter':
					$href = 'https://twitter.com/intent/tweet?text=' . rawurlencode($title) . '&url=' . rawurlencode( esc_url($permalink) );
					break;
				case 'pinterest':
					$href = 'http://pinterest.com/pin/create/link/?url=' . esc_url($permalink) . '&media=' . ( ! empty( $image[0] ) ? esc_url($image[0]) : '' ) . '&description=' . rawurlencode( $title );
					$parameters = 'nopin="nopin" data-pin-no-hover="true"';
					break;
				case 'vk':
					$href = 'http://vk.com/share.php?url=' . esc_url($permalink);
					break;
				case 'linkedin':
					$href = 'https://www.linkedin.com/cws/share?url=' . esc_url($permalink);
					break;
				case 'whatsapp':
					$href = 'https://wa.me/?text=' . rawurlencode( $title . ' ' . esc_url( $permalink ) );
					break;
				case 'telegram':
					$href = 'https://telegram.me/share/url?url=' . esc_url($permalink) . '&text=' . rawurlencode( $title );
					break;
				case 'email':
					$href = 'mailto:?subject='. rawurlencode($title) . '&body=' . rawurlencode( esc_url($permalink ) );
					$icon = 'envelope-o';
					break;
				
				default:
					break;
			} ?>

			<li><a href="<?php echo esc_attr( $href ); ?>" <?php echo esc_attr( $parameters ); ?> target="_blank" class="et-icon et-<?php echo esc_attr( $icon ); ?> social"></a></li>
			
		<?php } ?>

		</ul>

	<?php 
	}
	
}

/* Post Utilites
---------------------------------------------------------- */

/* Get post categories */
function goya_get_post_categories() {
	$args = array(
		'type'			=> 'post',
		'child_of'		=> 0,
		'parent'		=> '',
		'orderby'		=> 'name',
		'order'			=> 'ASC',
		'hide_empty'	=> 1,
		'hierarchical'	=> 1,
		'exclude'		=> '',
		'include'		=> '',
		'number'		=> '',
		'taxonomy'		=> 'category',
		'pad_counts'	=> false
	);

	$category_list = array();
	
	$categories = get_categories( $args );
	
	foreach( $categories as $category ) { 
		$category_list[wp_specialchars_decode( $category->name )] = $category->term_id;
	}
	
	return $category_list;
};


/* Product Categories: array for select boxes */
function goya_product_categories_array(){
	if ( class_exists( 'WooCommerce' ) ) {
		
		$args = array(
			'taxonomy'   => 'product_cat',
			'orderby'    => 'name',
			'order'      => 'ASC',
			'hide_empty' => '0'
		);
		
		$product_categories = get_terms( $args );
		$out = array();
		if (!isset($product_categories->errors)) {
			foreach($product_categories as $product_category) {
				$out[$product_category->name] = $product_category->slug;
			}
		}
		return $out;
	}
}

function goya_wc_exists() {
	return class_exists( 'woocommerce' );
}

/* Get config values */
function goya_core_meta_config( $type, $param, $default ) {
	$type = ($type) ? $type . '_' : '';
	$value = get_theme_mod($type . $param, $default);
	
	$meta = get_post_meta(get_queried_object_id(), 'goya_'. $type . $param, true);
	if ($meta) {
		$value = $meta;
	}
	
	if (isset($_GET[$param]) ) {
		$value = sanitize_key(wp_unslash($_GET[$param]));
	}
	
	return $value;
}