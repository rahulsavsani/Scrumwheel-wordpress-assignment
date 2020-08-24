<?php
$wp_customize->add_setting( 'ultrapress_breadcrumb_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Simple_Notice_Custom_Control( 
		$wp_customize, 'ultrapress_breadcrumb_heading',
		array(
			'label' => esc_html__( 'Breadcrumb Settings', 'ultrapress' ),
			'type' => 'heading',
			'section' => 'ultrapress_breadcrumb_section',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_breadcrumb_switch',
	array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_switch_sanitization'
	)
);
$wp_customize->add_control(
	new Ultrapress_Toggle_Switch_Custom_control(
		$wp_customize, 'ultrapress_breadcrumb_switch',
		array(
			'label' => esc_html__( 'Show Breadcrumb', 'ultrapress' ),
			'section' => 'ultrapress_breadcrumb_section'
		)
	)
);
$wp_customize->add_setting( 'ultrapress_breadcrumb_separator', 
	array(
		'default' => '/',
		'sanitize_callback' => 'wp_kses_post',
	)
);
$wp_customize->add_control( 'ultrapress_breadcrumb_separator', 
	array(
		'label' => esc_html__( 'Breadcrumb Separator', 'ultrapress' ),
		'section' => 'ultrapress_breadcrumb_section',
		'type' => 'text',
	)
); 
$wp_customize->add_setting( 'ultrapress_bread_nav_color',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Customize_Alpha_Color_Control( 
		$wp_customize, 'ultrapress_bread_nav_color',
		array(
			'label' => esc_html__( 'Breadcrumb Nav Color', 'ultrapress' ),
			'section' => 'ultrapress_breadcrumb_section',
			'show_opacity' => false,
		)
	)
);
$wp_customize->add_setting( 'ultrapress_bread_nav_hover_color',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Customize_Alpha_Color_Control( 
		$wp_customize, 'ultrapress_bread_nav_hover_color',
		array(
			'label' => esc_html__( 'Breadcrumb Nav Hover Color', 'ultrapress' ),
			'section' => 'ultrapress_breadcrumb_section',
			'show_opacity' => false,
		)
	)
);