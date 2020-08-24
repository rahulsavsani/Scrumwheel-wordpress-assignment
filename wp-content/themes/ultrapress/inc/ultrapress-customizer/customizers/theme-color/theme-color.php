<?php 
$wp_customize->add_setting( 'ultrapress_theme_color_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Simple_Notice_Custom_Control( 
		$wp_customize, 'ultrapress_theme_color_heading',
		array(
			'label' => esc_html__( 'Theme Skin Color', 'ultrapress' ),
			'type' => 'heading',
			'section' => 'ultrapress_theme_color_section',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_theme_skin_color',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Customize_Alpha_Color_Control( 
		$wp_customize, 'ultrapress_theme_skin_color',
		array(
			'label' => esc_html__( 'Theme Color', 'ultrapress' ),
			'section' => 'ultrapress_theme_color_section',
			'show_opacity' => true,
		)
	)
);
$wp_customize->add_setting( 'ultrapress_btn_color_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Simple_Notice_Custom_Control( 
		$wp_customize, 'ultrapress_btn_color_heading',
		array(
			'label' => esc_html__( 'Button Color', 'ultrapress' ),
			'type' => 'heading',
			'section' => 'ultrapress_theme_color_section',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_theme_btn_color',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Customize_Alpha_Color_Control( 
		$wp_customize, 'ultrapress_theme_btn_color',
		array(
			'label' => esc_html__( 'Background Color', 'ultrapress' ),
			'section' => 'ultrapress_theme_color_section',
			'show_opacity' => true,
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_theme_btn_hcolor',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control(
	new Ultrapress_Customize_Alpha_Color_Control( 
		$wp_customize, 'ultrapress_theme_btn_hcolor',
		array(
			'label' => esc_html__( 'Background Hover Color', 'ultrapress' ),
			'section' => 'ultrapress_theme_color_section',
			'show_opacity' => true,
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_theme_btn_text_color',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Customize_Alpha_Color_Control( 
		$wp_customize, 'ultrapress_theme_btn_text_color',
		array(
			'label' => esc_html__( 'Button Text Color', 'ultrapress' ),
			'section' => 'ultrapress_theme_color_section',
			'show_opacity' => true,
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_theme_btn_text_hcolor',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Customize_Alpha_Color_Control( 
		$wp_customize, 'ultrapress_theme_btn_text_hcolor',
		array(
			'label' => esc_html__( 'Text Hover Color', 'ultrapress' ),
			'section' => 'ultrapress_theme_color_section',
			'show_opacity' => true,
		)
	) 
);

$wp_customize->add_setting( 'ultrapress_anchor_color_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Simple_Notice_Custom_Control( 
		$wp_customize, 'ultrapress_anchor_color_heading',
		array(
			'label' => esc_html__( 'Anchor Color', 'ultrapress' ),
			'type' => 'heading',
			'section' => 'ultrapress_theme_color_section',
		)
	) 
);

$wp_customize->add_setting( 'ultrapress_anchor_color',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Customize_Alpha_Color_Control( 
		$wp_customize, 'ultrapress_anchor_color',
		array(
			'label' => esc_html__( 'Anchor Color', 'ultrapress' ),
			'section' => 'ultrapress_theme_color_section',
			'show_opacity' => true,
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_anchor_hover_color',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control(
	new Ultrapress_Customize_Alpha_Color_Control( 
		$wp_customize, 'ultrapress_anchor_hover_color',
		array(
			'label' => esc_html__( 'Anchor Hover Color', 'ultrapress' ),
			'section' => 'ultrapress_theme_color_section',
			'show_opacity' => true,
		)
	) 
);