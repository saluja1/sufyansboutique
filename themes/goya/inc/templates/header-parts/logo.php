<?php
/**
 * Template part for displaying the logo
 *
 * @package Goya
 */

$wp_logo_id = get_theme_mod( 'custom_logo' ); // Default WordPress Customizer option
$image = wp_get_attachment_image_src( $wp_logo_id , 'full' );

$logo = get_theme_mod( 'site_logo', get_template_directory_uri() . '/assets/img/logo-light.png' );
$logo_dark = get_theme_mod( 'site_logo_dark', get_template_directory_uri() . '/assets/img/logo-dark.png' );
$logo_alt = get_theme_mod( 'site_logo_alt', '' );
		
// Logo
if ( !empty( $wp_logo_id ) ) {
	$logo = ( is_ssl() ) ? str_replace( 'http://', 'https://', $image[0] ) : $image[0];
} else if ( !empty ($logo) ) {
	$logo = ( is_ssl() ) ? str_replace( 'http://', 'https://', $logo ) : $logo;
} else {
	$logo = false;
}

// Dark Scheme Logo
if ( !empty ($logo_dark) ) {
	$logo_dark = ( is_ssl() ) ? str_replace( 'http://', 'https://', $logo_dark ) : $logo_dark;
} else {
	$logo_dark = $logo;
}

// Alternative Logo
if ( !empty ($logo_alt) ) {
	$logo_alt = ( is_ssl() ) ? str_replace( 'http://', 'https://', $logo_alt ) : $logo_alt;
} else {
	$logo_alt = false;
}
$logo_alt_class =  get_theme_mod( 'site_logo_alt_use', '' );

?>

<div class="logo-holder">
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logolink <?php echo esc_attr( $logo_alt_class ) ?>">
		<?php if ( $logo ) { ?>
		<img src="<?php echo esc_attr($logo); ?>" class="logoimg bg--light" alt="<?php bloginfo('name'); ?>"/>
		<?php } else { ?>
			<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
		<?php } ?>
		<?php if ( $logo_dark ) { ?>
		<img src="<?php echo esc_attr($logo_dark); ?>" class="logoimg bg--dark" alt="<?php bloginfo('name'); ?>"/>
		<?php } ?>
		<?php if ( $logo_alt ) { ?>
		<img src="<?php echo esc_attr($logo_alt); ?>" class="logoimg bg--alt" alt="<?php bloginfo('name'); ?>"/>
		<?php } ?>
	</a>
</div>
					