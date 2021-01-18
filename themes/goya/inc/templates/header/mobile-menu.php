<?php 

/**
 * The template for displaying the mobile menu
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Goya
 */

$menu_type = goya_meta_config('','mobile_menu_type', 'sliding');
$menu_mode = ( goya_meta_config('','menu_mobile_mode', 'light') == 'dark' ) ? 'dark' : 'light';
$menu_style = apply_filters( 'goya_menu_style', $menu_mode );

$classes[] = $menu_style;
$classes[] = (goya_meta_config('','vertical_bar',true) == true) ? 'has-bar' : 'no-bar';

?>

<nav id="mobile-menu" class="side-panel side-menu side-mobile-menu <?php echo esc_attr(implode(' ', $classes)); ?>">

	<?php do_action( 'goya_vertical_panel_bar' ); ?>
	
	<div class="side-panel-content side-panel-mobile custom_scroll">
		<div class="container">
		
			<?php if (goya_meta_config('','menu_mobile_search', true) == true ) { ?>
				<div class="side-panel search-panel mobile-search">
					<?php goya_search_box(); ?>
				</div>
			<?php } ?>

			<?php
			if (has_nav_menu( 'mobile-menu' )) {
				$mobile_menu = 'mobile-menu';
			} else if (has_nav_menu( 'primary-menu' )) {
				$mobile_menu = 'primary-menu';
			} else {
				$mobile_menu = false;
			}
			
			if( $mobile_menu) {
				wp_nav_menu( array(
					'theme_location' => $mobile_menu,
					'depth' => 4,
					'container' => 'div',
					'container_id' => 'mobile-menu-container',
					'menu_class' => 'mobile-menu small-menu menu-'. $menu_type,
					'after' => '<span class="et-menu-toggle"></span>',
					'walker' => new goya_Mega_Menu 
				) );
			}
			?>

			<div class="bottom-extras">
				<?php do_action( 'goya_after_mobile_menu' ); ?>
			</div>

		</div>
	</div>
	
</nav>