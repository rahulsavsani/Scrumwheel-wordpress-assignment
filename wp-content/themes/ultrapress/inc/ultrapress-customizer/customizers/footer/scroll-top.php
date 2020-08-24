<?php
$wp_customize->add_setting( 'ultrapress_scrolltop_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Simple_Notice_Custom_Control( 
		$wp_customize, 'ultrapress_scrolltop_heading',
		array(
			'label' => esc_html__( 'Scroll Top Settings', 'ultrapress' ),
			'type' => 'heading',
			'section' => 'ultrapress_scroll_top_section',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_scroll_top_switch',
	array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_switch_sanitization'
	)
);
$wp_customize->add_control(
	new Ultrapress_Toggle_Switch_Custom_control(
		$wp_customize, 'ultrapress_scroll_top_switch',
		array(
			'label' => esc_html__( 'Show Scroll Top', 'ultrapress' ),
			'section' => 'ultrapress_scroll_top_section'
		)
	)
);
$wp_customize->add_setting( 'ultrapress_scroll_top_position',
	array(
		'default' => 'right',
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_text_sanitization'
	)
);
$wp_customize->add_control( 
	'ultrapress_scroll_top_position',
	array(
		'type' => 'select',
		'label' => esc_html__( 'Scroll Top Position', 'ultrapress' ),
		'section' => 'ultrapress_scroll_top_section',
		'choices' => array(
			'left' => esc_html__('Left','ultrapress'),
			'right' => esc_html__('Right','ultrapress'),              
		)
	)
);
$wp_customize->add_setting( 'ultrapress_scroll_top_layout',
	array(
		'default' => 'square',
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_text_sanitization'
	)
);
$wp_customize->add_control( 'ultrapress_scroll_top_layout',
	array(
		'type' => 'select',
		'label' => esc_html__( 'Display Style', 'ultrapress' ),
		'section' => 'ultrapress_scroll_top_section',
		'choices' => array(
			'square' => esc_html__('Square','ultrapress'),
			'circle' => esc_html__('Circle','ultrapress'),              
		)
	)
);
$wp_customize->add_setting( 'ultrapress_scroll_top_bg',
	array(
		'default' => '',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new WP_Customize_Color_Control(
		$wp_customize, 'ultrapress_scroll_top_bg',
		array(
			'label' => esc_html__( 'Background Color', 'ultrapress' ),
			'section' => 'ultrapress_scroll_top_section',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_scroll_top_bg_hover',
	array(
		'default' => '',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new WP_Customize_Color_Control(
		$wp_customize, 'ultrapress_scroll_top_bg_hover',
		array(
			'label' => esc_html__( 'Background Hover', 'ultrapress' ),
			'section' => 'ultrapress_scroll_top_section',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_scroll_top_color',
	array(
		'default' => '',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new WP_Customize_Color_Control(
		$wp_customize, 'ultrapress_scroll_top_color',
		array(
			'label' => esc_html__( 'Text Color', 'ultrapress' ),
			'section' => 'ultrapress_scroll_top_section',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_scroll_top_hover_color',
	array(
		'default' => '',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new WP_Customize_Color_Control(
		$wp_customize, 'ultrapress_scroll_top_hover_color',
		array(
			'label' => esc_html__( 'Text Hover Color', 'ultrapress' ),
			'section' => 'ultrapress_scroll_top_section',
		)
	) 
);