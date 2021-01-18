<?php

/* Enqueue WordPress theme styles within Gutenberg. */

function goya_gutenberg_styles() {
	// Load the theme styles within Gutenberg.
	 	ob_start(); ?>
		
	 	.edit-post-visual-editor.editor-styles-wrapper {
		 	color:<?php echo esc_attr( get_theme_mod('main_font_color', '#585858') ); ?>;
		 }
		 <?php if (goya_has_default_font()) { ?>
		 	.edit-post-visual-editor.editor-styles-wrapper,
		 	.editor-styles-wrapper .editor-post-title__block .editor-post-title__input,
		 	.editor-styles-wrapper h1,
		 	.editor-styles-wrapper h2,
		 	.editor-styles-wrapper h3,
		 	.editor-styles-wrapper h4,
		 	.editor-styles-wrapper h5,
		 	.editor-styles-wrapper h6 {
		 		font-family: 'Jost';
		 		font-weight: 400;
			}
		<?php } ?>
		.block-editor .editor-styles-wrapper h1,
		.block-editor .editor-styles-wrapper h2,
		.block-editor .editor-styles-wrapper h3,
		.block-editor .editor-styles-wrapper h4,
		.block-editor .editor-styles-wrapper h5,
		.block-editor .editor-styles-wrapper h6,
		.editor-post-title__block .editor-post-title__input,
		.wp-block-quote  {
			color: <?php echo esc_attr( get_theme_mod('heading_color', '#282828') ); ?>;
		}
		.wp-block-freeform.block-library-rich-text__tinymce a {
			color: #151515;
			cursor: pointer;
		}
	 	.wp-block-freeform.block-library-rich-text__tinymce a:hover {
	 		color: <?php echo esc_attr( get_theme_mod('accent_color', '#b9a16b') ); ?>;
	 	}
	 
	 <?php

	 $styles = ob_get_contents();
	 if (ob_get_contents()) ob_end_clean();

	 $styles = goya_clean_custom_css($styles);

	 return $styles;
}
add_action( 'enqueue_block_editor_assets', 'goya_gutenberg_styles' );