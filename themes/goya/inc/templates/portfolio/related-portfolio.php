<?php
	global $post;

	$p_page = goya_meta_config('portfolio','page', '');
	$category_navigation = goya_meta_config('portfolio','navigation', true);
	$portfolio_layout = goya_meta_config('portfolio','layout_main', 'masonry');
	
	$portfolio_layout = 'grid'; // related items only in grid mode

	$columns = goya_meta_config('portfolio','columns', '4');
	$alternate_cols = goya_meta_config('portfolio','alternate', true);
	$item_style = goya_meta_config('portfolio','item_style', 'regular');
	$item_margins = goya_meta_config('portfolio','item_margin', 'regular-padding');
	$animation = goya_meta_config('portfolio','animation', 'animation bottom-to-top');
	$num_posts = get_option( 'posts_per_page' );
	$loadmore = 'true';
	$aspect = 'original';

	$category_filter = false;
	$categories = false;

	$classes[] = $item_margins;
	$classes[] = 'row';

	$classes[] = 'masonry et-loader';
	$classes[] = 'variable-height';
	$classes[] = 'et-portfolio';
	$classes[] = 'et-portfolio-style-'.$item_style;

	$rand = rand(0,1000);

	$postId = $post->ID;
	$query = goya_get_blog_posts_related_by_category($postId);
?>
<?php if ($query->have_posts()) : ?>
<aside class="related-posts hide-on-print et-portfolio et-portfolio-style-regular regular-padding">
	<div class="container">
		<h3 class="related-title"><?php esc_html_e( 'Related Items', 'goya' ); ?></h3>
		<div class="<?php echo esc_attr(implode(' ', $classes)); ?>" data-loadmore="#loadmore-<?php echo esc_attr($rand); ?>">
			<?php while ($query->have_posts()) : $query->the_post(); ?>
				<?php 
				set_query_var( 'goya_port_layout', $portfolio_layout );
				set_query_var( 'goya_port_columns', $columns );
				set_query_var( 'goya_port_aspect', $aspect );
				set_query_var( 'goya_port_animation', $animation );

				get_template_part( 'inc/templates/portfolio/' . $item_style); ?>
			<?php endwhile; ?>
		</div>
	</div>
</aside>
<?php endif; ?>
<?php wp_reset_postdata(); ?>