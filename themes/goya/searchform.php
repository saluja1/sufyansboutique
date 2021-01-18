<form role="search" method="get" class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
	<fieldset>
		<div class="search-button-group">
			<input type="search" id="<?php echo esc_attr( uniqid('search-form-') ); ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'goya' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
			<button type="submit" class="submit"><?php get_template_part( 'assets/img/svg/search.svg' ); ?></button>
		</div>
	</fieldset>
</form>