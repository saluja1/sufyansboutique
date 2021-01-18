<div class="row results-not-found">
	<div class="col-12">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<h4><?php printf( esc_html__( 'Ready to publish your first post? %sGet started here%s.', 'goya' ), '<a href="' . admin_url( 'post-new.php' ) . '">', '</a>' ); ?></h4>

		<?php elseif ( is_search() ) : ?>

		<h4 class="alert-error"><?php esc_html_e( 'Sorry, but nothing matched your search terms.', 'goya' ); ?></h4>
		<p><?php esc_html_e( 'Please try again with some different keywords.', 'goya' ); ?></p>

		<?php get_search_form(); ?>

		<?php else : ?>

		<h4><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for.', 'goya' ); ?></h4>

		<?php endif; ?>
	</div>
</div>