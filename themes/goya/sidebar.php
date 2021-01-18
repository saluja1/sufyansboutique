<?php 
/**
 * The sidebar containing the main widget area
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Goya
 */

if (is_page()) {
	$id = $wp_query->get_queried_object_id();
	$sidebar_pos = get_post_meta( $id, 'goya_page_sidebar_position', true);
} else if (is_single()) {
	$sidebar_pos = get_theme_mod('post_sidebar_position', 'right');
} else {
	$sidebar_pos = get_theme_mod('blog_sidebar_position', 'right');
}

if ($sidebar_pos == 'right') {
 	$sidebar_pos = 'sidebar-right';
} else {
 	$sidebar_pos = 'sidebar-left';
}
?>
<aside class="sidebar post-sidebar col <?php echo esc_attr( $sidebar_pos ); ?>" role="complementary">
	<div class="sidebar-inner">
		<?php 
		if (is_page()) {
			dynamic_sidebar('page');
		} else if (is_single()) {
			dynamic_sidebar('single');
		} else {
			dynamic_sidebar('blog');
		}
		?>
	</div>
</aside>