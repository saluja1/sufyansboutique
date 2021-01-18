<?php
  
// VC element: et_banner
vc_map( array(
  'name' => __( 'Banner', 'goya' ),
  'description' => __( 'Responsive banner', 'goya' ),
  'base' => 'et_banner',
  'icon' => 'et_banner',
  'category' => esc_html__('Goya', 'goya'),
  'params' => array(
    array(
      'type' => 'dropdown',
      'heading' => __( 'Content Layout', 'goya' ),
      'param_name' => 'layout',
      'description' => __( 'Select content layout. "Boxed" sets maximum width for text content', 'goya' ),
      'value' => array(
        'Full Width' => 'full',
        'Boxed' => 'boxed',
      ),
      'std' => 'full',
    ),
    array(
      'type' => 'attach_image',
      'heading' => __( 'Image', 'goya' ),
      'param_name' => 'image_id',
      'description' => __( 'Add a banner image.', 'goya' )
    ),
    array(
      'type' => 'textfield',
      'heading' => esc_html__('Image size', 'goya'),
      'param_name' => 'img_size',
      'description' => esc_html__('Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "full" image size.', 'goya')
    ),
    array(
      'type'      => 'attach_image',
      'heading'     => __( 'Image - Tablet/Mobile', 'goya' ),
      'param_name'  => 'alt_image_id',
      'description'   => __( 'Set an optional banner image to display on smaller screens (max-width: 640px).', 'goya' )
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Image Type', 'goya' ),
      'param_name' => 'image_type',
      'description' => __( '1. Fluid: the image size determines the banner height. 2) Background image: you can set your preferred height.', 'goya' ),
      'value' => array(
        'Fluid Image' => 'fluid',
        'CSS Background Image' => 'css'
      ),
      'std' => 'fluid'
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Banner Height', 'goya' ),
      'param_name' => 'height',
      'description' => __( 'Proportional to screen height', 'goya' ),
      'value' => array(
        '10%' => '10',
        '20%' => '20',
        '30%' => '30',
        '40%' => '40',
        '50%' => '50',
        '60%' => '60',
        '70%' => '70',
        '80%' => '80',
        '90%' => '90',
        '100%' => '100',
        'Custom Height' => 'custom',
      ),
      'std' => '30',
      'dependency' => array(
        'element' => 'image_type',
        'value' => array( 'css' )
      )
    ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Banner Height', 'goya' ),
      'param_name' => 'custom_height',
      'description' => __( 'Enter banner height with unit (eg. 300px).', 'goya' ),
      'dependency' => array(
        'element' => 'height',
        'value' => array( 'custom' )
      )
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Default Color Scheme', 'goya' ),
      'param_name' => 'text_color_scheme',
      'description' => __( 'This is the Default banner text color. You can override the color of each element.', 'goya' ),
      'value' => array(
        'Dark' => 'dark',
        'Light' => 'light'
      ),
      'std' => 'dark',
    ),
    array(
      'type' => 'colorpicker',
      'heading' => __( 'Banner Background', 'goya' ),
      'param_name' => 'background_color',
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Hover Effect', 'goya' ),
      'param_name' => 'hover_effect',
      'description' => __( 'Animation on hover.', 'goya' ),
      'value' => array(
        'None' => '',
        'Border' => 'hover-border',
        'Zoom' => 'hover-zoom',
        'Border & Zoom' => 'hover-border hover-zoom'
      ),
    ),
    array(
      'type' => 'colorpicker',
      'heading' => __( 'Hover Border Color', 'goya' ),
      'param_name' => 'border_color',
      'description' => __( 'Border color used on hover effect.', 'goya' ),
      'dependency' => array(
        'element' => 'hover_effect',
        'value' => array( 'hover-border', 'hover-border hover-zoom' )
      )
    ),
    array(
      'type' => 'textfield',
      'heading' => esc_html__('Extra Class', 'goya' ),
      'description' => esc_html__('Add a class for more customization', 'goya' ),
      'param_name' => 'extra_class',
    ),
    array(
      'type' => 'vc_link',
      'heading' => __( 'Link (URL)', 'goya' ),
      'param_name' => 'link',
      'description' => __( 'Set a banner link.', 'goya' ),
      'group' => 'Link'
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Link Type', 'goya' ),
      'param_name' => 'link_type',
      'description' => __( 'Full banner link (text/button not visible) or text/button link only', 'goya' ),
      'value' => array(
        'Banner Link' => 'banner_link',
        'Text/Button Link' => 'text_link'
      ),
      'std' => 'banner_link',
      'group' => 'Link'
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Link Style', 'goya' ),
      'param_name' => 'link_style',
      'value' => array(
        'Solid Button' => 'solid',
        'Outlined Button' => 'outlined',
        'Text Link' => 'link'
      ),
      'std' => 'link_style',
      'dependency' => array(
        'element' => 'link_type',
        'value' => array( 'text_link' )
      ),
      'group' => 'Link'
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Text/Button Link Color', 'goya' ),
      'description' => __( 'Also border color if "Outlined Button" is selected', 'goya' ),
      'param_name' => 'link_color',
      'value' => array(
        'Default' => '',
        'Dark' => 'dark',
        'Light' => 'light',
        'Accent Color' => 'accent',
        'Custom' => 'custom'
      ),
      'std' => '',
      'group' => 'Link'
    ),
    array(
      'type' => 'colorpicker',
      'heading' => __( 'Text/Button Link Color', 'goya' ),
      'param_name' => 'link_color_custom',
      'dependency' => array(
        'element' => 'link_color',
        'value' => array( 'custom' )
      ),
      'group' => 'Link'
    ),
    array(
      'type' => 'colorpicker',
      'heading' => __( 'Button Background', 'goya' ),
      'param_name' => 'link_background_custom',
      'dependency' => array(
        'element' => 'link_color',
        'value' => array( 'custom' )
      ),
      'group' => 'Link'
    ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Title', 'goya' ),
      'param_name' => 'title',
      'group' => 'Content'
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Title Size', 'goya' ),
      'param_name' => 'title_size',
      'value' => array(
        'Small' => 'small',
        'Medium' => 'medium',
        'Large' => 'large',
        'X-Large' => 'xlarge',
        'XX-Large' => 'xxlarge',
      ),
      'std' => 'medium',
      'group' => 'Content'
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Title Color', 'goya' ),
      'param_name' => 'title_color',
      'value' => array(
        'Default' => '',
        'Dark' => 'dark',
        'Light' => 'light',
        'Accent Color' => 'accent',
        'Custom' => 'custom'
      ),
      'std' => '',
      'group' => 'Content'
    ),
    array(
      'type' => 'colorpicker',
      'heading' => __( 'Title Color', 'goya' ),
      'param_name' => 'title_color_custom',
      'dependency' => array(
        'element' => 'title_color',
        'value' => array( 'custom' )
      ),
      'group' => 'Content'
    ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Subtitle/Tag', 'goya' ),
      'param_name' => 'subtitle',
      'group' => 'Content'
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Subtitle Type', 'goya' ),
      'param_name' => 'subtitle_type',
      'description' => __( 'Text only or Tag style', 'goya' ),
      'group' => 'Content',
      'value' => array(
        'Text' => 'text_style',
        'Tag' => 'tag_style'
      ),
      'std' => 'text_style'
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Subtitle/Tag Color', 'goya' ),
      'param_name' => 'subtitle_color',
      'value' => array(
        'Default' => '',
        'Dark' => 'dark',
        'Light' => 'light',
        'Accent Color' => 'accent',
        'Custom' => 'custom'
      ),
      'std' => '',
      'group' => 'Content'
    ),
    array(
      'type' => 'colorpicker',
      'heading' => __( 'Subtitle/Tag Color', 'goya' ),
      'param_name' => 'subtitle_color_custom',
      'dependency' => array(
        'element' => 'subtitle_color',
        'value' => array( 'custom' )
      ),
      'group' => 'Content'
    ),
    array(
      'type' => 'colorpicker',
      'heading' => __( 'Subtitle/Tag Background', 'goya' ),
      'description' => __( 'Used for Tag style', 'goya' ),
      'param_name' => 'subtitle_background_custom',
      'dependency' => array(
        'element' => 'subtitle_color',
        'value' => array( 'custom' )
      ),
      'group' => 'Content'
    ),
    array(
      'type' => 'textarea',
      'heading' => __( 'Extra Content', 'goya' ),
      'param_name' => 'paragraph',
      'description' => __( 'For tablet/desktop screens only.', 'goya' ),
      'group' => 'Content'
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Text Animation (Banner Slider)', 'goya' ),
      'param_name' => 'text_animation',
      'description' => __( 'Select a text animation (used by the Banner Slider).', 'goya' ),
      'value' => array(
        'None' => '',
        'fadeIn' => 'fadeIn',
        'fadeInDown' => 'et-fadeInDown',
        'fadeInLeft' => 'et-fadeInLeft',
        'fadeInRight' => 'et-fadeInRight',
        'fadeInUp' => 'et-fadeInUp' 
      ),
      'group' => 'Text Layout'
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Text Position', 'goya' ),
      'param_name' => 'text_position',
      'value' => array(
        'Center' => 'h_center-v_center',
        'Top Left' => 'h_left-v_top',
        'Top Center' => 'h_center-v_top',
        'Top Right' => 'h_right-v_top',
        'Center Left' => 'h_left-v_center',
        'Center Right' => 'h_right-v_center',
        'Bottom Left' => 'h_left-v_bottom',
        'Bottom Center' => 'h_center-v_bottom',
        'Bottom Right' => 'h_right-v_bottom'
      ),
      'std' => 'h_center-v_center',
      'group' => 'Text Layout'
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Text Alignment', 'goya' ),
      'param_name' => 'text_alignment',
      'value' => array(
        'Left' => 'align_left',
        'Center' => 'align_center',
        'Right' => 'align_right'
      ),
      'std' => 'align_left',
      'group' => 'Text Layout'
    ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Text Width', 'goya' ),
      'param_name' => 'text_width',
      'description' => __( 'Default is 50%', 'goya' ),
      'group' => 'Text Layout'
    ),
    array(
      'type' => 'textfield',
      'heading' => __( 'Text Padding', 'goya' ),
      'param_name' => 'text_padding',
      'description' => __( 'Default is 15% (relative to "Text Width" value above)', 'goya' ),
      'group' => 'Text Layout'
    ),
   )
) );