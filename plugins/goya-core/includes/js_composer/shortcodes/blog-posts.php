<?php

// Shortcode: et_posts
function goya_shortcode_posts( $atts, $content = NULL ) {
	
	extract( shortcode_atts( array(
		'num_posts'			=> '8',
		'category'			=> '',
		'style'			=> 'grid',
		'columns'			=> '3',
		'post_excerpt'		=> '0',
	), $atts ) );

	$categories = $category ? explode(',',$category) : false;

	$args = array(
		'post_status'     => 'publish',
		'post_type'     => 'post',
		'posts_per_page'  => intval( $num_posts ),
		'cat' => $categories,
	);
	
	$posts = new WP_Query( $args );

	$columns = intval( $columns );
	$img_size = 'medium_large';
	
	ob_start();
	
	if ($style == "carousel") {

		$classes[] = 'post';
		$classes[] = 'post-grid';
		$classes[] = 'post-slider';
		$classes[] = 'blog-post';

		$data_settings = ' ';

		if ( $posts->have_posts() ) :
		?>
			<div class="et-post-slider slick slick-slider slick-arrows-outside slick-controls-gray slick-dots-centered slick-dots-active-small" data-columns="<?php echo esc_attr( $columns ); ?>" data-slides-to-scroll="<?php echo esc_attr( $columns ); ?>" data-pagination="true" data-navigation="true">
			<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
				<article itemscope itemtype="http://schema.org/Article" <?php post_class(esc_attr(implode(' ', $classes))); ?>>
					<div class="et-post-slider-inner">
						<figure class="post-gallery">
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
									<?php goya_post_format_icon( get_the_ID() ); ?>
									<?php the_post_thumbnail($img_size); ?>
								</a>
							<?php endif; ?>
						</figure>
										
						<div class="et-post-slider-content">
							<?php if ( get_theme_mod('blog_category', true) == true ) the_category(); ?>
							<header class="post-title entry-header">
								<?php the_title('<h3 class="entry-title" itemprop="name headline"><a class="entry-link" href="'.get_permalink().'" title="'.the_title_attribute("echo=0").'">', '</a></h3>'); ?>
							</header>
							<?php get_template_part( 'inc/templates/postbit/post-meta' ); ?>
							<?php if ( $post_excerpt ) : ?>
							<div class="post-content">
								<?php echo goya_excerpt(100, '&hellip;'); ?>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</article>
			<?php endwhile; ?>
			</div>
		<?php
		endif;
	} else { ?>

		<?php if ($style == 'masonry' || $style == 'cards') { ?>
		<div class="row posts-shortcode align-stretch masonry" data-layoutmode="packery">
		<?php } else { ?>
		<div class="row posts-shortcode align-stretch">
		<?php } ?>
			<?php if ($posts->have_posts()) :  while ($posts->have_posts()) : $posts->the_post(); ?>
				<?php get_template_part( 'inc/templates/blogbit/'.$style); ?>
			<?php endwhile; else : endif; ?>
		</div>
		<?php
	}
	
	wp_reset_query();
	
	$output = ob_get_clean();
	
	return $output;
}

add_shortcode( 'et_posts', 'goya_shortcode_posts' );
