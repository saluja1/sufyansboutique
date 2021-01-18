<?php 
/**
 * The template for displaying the footer
 *
 * Contains the closing of the .site-content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Goya
 */

 ?>		
		</div><!-- End role["main"] -->
		
	</div><!-- End .page-wrapper-inner -->

	<?php do_action( 'goya_footer' ) ?>

	<?php do_action( 'goya_after_site' ) ?>

</div> <!-- End #wrapper -->

<?php 
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */
	 wp_footer(); 
?>
</body>
</html>