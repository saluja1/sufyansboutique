<?php
/**
 * Template part for displaying the campaign bar
 *
 * @package Goya
 */

$cookie = isset($_COOKIE['et-global-campaign']) ? wp_unslash($_COOKIE['et-global-campaign']) : false;
$dismissible = (goya_meta_config('','campaign_bar_dismissible',true) == true) ? 'dismissible' : '';

if ( !$cookie ) {
?>
	<aside class="campaign-bar et-global-campaign">
		<div class="container">
			<div class="row">
				<div class="col">
					<?php echo get_theme_mod('campaign_bar_content', ''); ?>
				</div>
			</div>
			<a href="#" class="remove <?php echo esc_attr( $dismissible ); ?>"></a>
		</div>
	</aside>
<?php } ?>