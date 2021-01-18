<?php
function goya_register_sidebars() {

	/* Blog Sidebar */

	register_sidebar(array(
		'id' => 'blog',
		'name' => esc_html__('Blog Sidebar', 'goya' ),
		'description' => esc_html__('Blog home/category sidebar', 'goya' ),
		'before_widget' => '<div id="%1$s" class="widget cf %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>'
	));
		
	/* Single Post Sidebar */

	register_sidebar(array(
		'id' => 'single',
		'name' => esc_html__('Post Sidebar', 'goya' ),
		'description'   => esc_html__('Single post sidebar', 'goya' ),
		'before_widget' => '<div id="%1$s" class="widget cf %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>'
	));

	/* Page Sidebar */

	register_sidebar(array(
		'id' => 'page',
		'name' => esc_html__('Page Sidebar', 'goya' ),
		'description'   => esc_html__('Custom pages sidebar', 'goya' ),
		'before_widget' => '<div id="%1$s" class="widget cf %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>'
	));

	/* Mobile Sidebar */

	register_sidebar(array(
		'id' => 'offcanvas-menu', 
		'name' => esc_html__('Off-Canvas Menu Panel', 'goya' ),
		'description'   => esc_html__('Displayed under menu in off canvas panel', 'goya' ),
		'before_widget' => '<div id="%1$s" class="widget cf %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>'
	));

	/* Shop Sidebar */
	if ( goya_wc_active() ) {
		if ( get_theme_mod('shop_filters_scrollbar', true) == true ) {
			register_sidebar( array(
				'id' 				=> 'widgets-shop',
				'name' 				=> esc_html__( 'Shop Sidebar', 'goya' ),
				'description' => esc_html__('Shop sidebar (top, side, offcanvas)', 'goya' ),
				'before_widget'		=> '<li id="%1$s" class="scroll-enabled scroll-type-default widget cf %2$s">',
				'after_widget' 		=> '</div></li>',
				'before_title' 		=> '<h6 class="et-widget-title">',
				'after_title' 		=> '</h6><div class="et-shop-widget-col custom_scroll et-shop-widget-scroll">'
			));
		} else {
			register_sidebar( array(
				'id' 				=> 'widgets-shop',
				'name' 				=> esc_html__( 'Shop Sidebar', 'goya' ),
				'description' => esc_html__('Shop sidebar (top, side, offcanvas)', 'goya' ),
				'before_widget'		=> '<li id="%1$s" class="widget cf %2$s">',
				'after_widget' 		=> '</div></li>',
				'before_title' 		=> '<h6 class="et-widget-title">',
				'after_title' 		=> '</h6><div class="et-shop-widget-col">'
			) );
		}
	}

	/* Footer Widgets Sidebar */

	$columns = get_theme_mod('footer_widgets_columns', 3);

	register_sidebar(array(
		'name' => esc_html__('Footer - Column 1', 'goya'),
		'id' => 'footer1',
		'before_widget' => '<div id="%1$s" class="widget cf %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>'
	));
	
	register_sidebar(array(
		'name' => esc_html__('Footer - Column 2', 'goya'),
		'id' => 'footer2',
		'before_widget' => '<div id="%1$s" class="widget cf %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>'
	));

	register_sidebar(array(
		'name' => esc_html__('Footer - Column 3', 'goya'),
		'id' => 'footer3',
		'before_widget' => '<div id="%1$s" class="widget cf %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>'
	));

	register_sidebar(array(
		'name' => esc_html__('Footer - Column 4', 'goya'),
		'id' => 'footer4',
		'before_widget' => '<div id="%1$s" class="widget cf %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6>',
		'after_title' => '</h6>'
	));
	
}

add_action( 'widgets_init', 'goya_register_sidebars' );