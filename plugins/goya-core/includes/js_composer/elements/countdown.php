<?php 

// VC element: et_countdown

vc_map(array(
  'name' => esc_html__('Countdown', 'goya' ),
  'base' => 'et_countdown',
  'icon' => 'et_countdown',
  'description' => esc_html__('Countdown module for your events.', 'goya' ),
  'category' => esc_html__('Goya', 'goya' ),
  'params' => array(
    array(
      'type' => 'textfield',
      'heading' => esc_html__('Upcoming Event Date', 'goya' ),
      'param_name' => 'date',
      'admin_label' => true,
      'value' => '12/24/2018 12:00:00',
      'description' => esc_html__('Enter the due date for Event. eg : 12/24/2018 12:00:00 => month/day/year hour:minute:second', 'goya' )
    ),
    array(
      'heading' => esc_html__('UTC Timezone', 'goya' ),
      'type' => 'dropdown',
      'param_name' => 'utc_timezone',
      'value' => array(
          '-12' => '-12',
          '-11' => '-11',
          '-10' => '-10',
          '-9' => '-9',
          '-8' => '-8',
          '-7' => '-7',
          '-6' => '-6',
          '-5' => '-5',
          '-4' => '-4',
          '-3' => '-3',
          '-2' => '-2',
          '-1' => '-1',
          '0' => '0',
          '+1' => '+1',
          '+2' => '+2',
          '+3' => '+3',
          '+4' => '+4',
          '+5' => '+5',
          '+6' => '+6',
          '+7' => '+7',
          '+8' => '+8',
          '+9' => '+9',
          '+10' => '+10',
          '+12' => '+12'
      ),

      'description'	=> sprintf( __( 'You can check your UTC Timezone in this %sinteractive map%s.', 'goya' ), '<a href="https://www.timeanddate.com/time/map/#!cities=1440" target="_blank">', '</a>' )
    ),
    array(
      'type'      => 'dropdown',
      'heading'     => __( 'Countdown Size', 'goya' ),
      'param_name'  => 'size',
      'value'     => array(
        'Large'     => 'lg',
        'Medium'    => 'md',
        'Small'     => 'sm',
      ),
      'std'       => 'md'
    ),
    array(
      'type'      => 'dropdown',
      'heading'     => __( 'Animation', 'goya' ),
      'param_name'  => 'animation',
      'value'     => array(
        'None'               => '',
        'Right to Left'      => 'animation right-to-left',
        'Left to Right'      => 'animation left-to-right',
        'Right to Left - 3D' => 'animation right-to-left-3d',
        'Left to Right - 3D' => 'animation left-to-right-3d',
        'Bottom to Top'      => 'animation bottom-to-top',
        'Top to Bottom'      => 'animation top-to-bottom',
        'Bottom to Top - 3D' => 'animation bottom-to-top-3d',
        'Top to Bottom - 3D' => 'animation top-to-bottom-3d',
        'Scale'              => 'animation scale',
        'Fade'               => 'animation fade',
      ),
      'std'       => 'animation bottom-to-top',
      'group'          => 'Styling',
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Countdown Color', 'goya' ),
      'param_name' => 'countdown_color',
      'value' => array(
        'Default' => '',
        'Dark' => 'dark',
        'Light' => 'light',
        'Accent Color' => 'accent',
        'Custom' => 'custom'
      ),
      'std' => '',
      'group' => 'Styling'
    ),
    array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Countdown Custom Color', 'goya' ),
      'param_name'     => 'countdown_color_custom',
      'dependency' => array(
        'element' => 'countdown_color',
        'value' => array( 'custom' )
      ),
      'group'          => 'Styling',
    ),
    array(
      'type' => 'dropdown',
      'heading' => __( 'Caption Color', 'goya' ),
      'param_name' => 'caption_color',
      'value' => array(
        'Default' => '',
        'Dark' => 'dark',
        'Light' => 'light',
        'Accent Color' => 'accent',
        'Custom' => 'custom'
      ),
      'std' => '',
      'group' => 'Styling'
    ),
    array(
      'type'           => 'colorpicker',
      'heading'        => esc_html__('Captions Custom Color', 'goya' ),
      'param_name'     => 'caption_color_custom',
      'dependency' => array(
        'element' => 'caption_color',
        'value' => array( 'custom' )
      ),
      'group'          => 'Styling',
    ),

  )
));
