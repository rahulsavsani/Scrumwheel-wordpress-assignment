<?php 
/* Header Styles */ 
$wp_customize->add_setting( 'ultrapress_header_style_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Simple_Notice_Custom_Control( 
		$wp_customize, 'ultrapress_header_style_heading',
		array(
			'label' => esc_html__( 'Header Styles', 'ultrapress' ),
			'type' => 'heading',
			'section' => 'ultrapress_header_styles',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_trans_header_switch',
	array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_switch_sanitization'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Toggle_Switch_Custom_control( 
		$wp_customize, 'ultrapress_trans_header_switch',
		array(
			'label' => esc_html__( 'Transparent Header', 'ultrapress' ),
			'section' => 'ultrapress_header_styles'
		)
	) 
); 
$wp_customize->add_setting( 'ultrapress_header_container_switch',
	array(
		'default' => 0,
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_switch_sanitization'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Toggle_Switch_Custom_control( 
		$wp_customize, 'ultrapress_header_container_switch',
		array(
			'label' => esc_html__( 'Header Container', 'ultrapress' ),
			'section' => 'ultrapress_header_styles'
		)
	) 
); 
$wp_customize->add_setting( 'ultrapress_header_background',
	array(
		'default' => '',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization',
	)
);
$wp_customize->add_control(
	new Ultrapress_Customize_Alpha_Color_Control( 
		$wp_customize, 'ultrapress_header_background',
		array(
			'label' => esc_html__( 'Background Color', 'ultrapress' ),
			'section' => 'ultrapress_header_styles',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_header_nav_text_color',
	array(
		'default' => '',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( 
		$wp_customize, 'ultrapress_header_nav_text_color',
		array(
			'label' => esc_html__( 'Nav Text Color', 'ultrapress' ),
			'section' => 'ultrapress_header_styles',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_header_nav_text_hcolor',
	array(
		'default' => '',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( 
		$wp_customize, 'ultrapress_header_nav_text_hcolor',
		array(
			'label' => esc_html__( 'Nav Hover Color', 'ultrapress' ),
			'section' => 'ultrapress_header_styles',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_nav_font_size',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control(
	new Ultrapress_Slider_Custom_Control(
		$wp_customize, 'ultrapress_nav_font_size',
		array(
			'label' => esc_html__( 'Nav Font Size(px)', 'ultrapress' ),
			'section' => 'ultrapress_header_styles',
			'input_attrs' => array(
				'min' => 0,
				'max' => 100,
				'step' => 1,
			),
		)
	) 
);
/* Button Styles */
$wp_customize->add_setting( 'ultrapress_button_style_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Simple_Notice_Custom_Control( 
		$wp_customize, 'ultrapress_button_style_heading',
		array(
			'label' => esc_html__( 'Button Styles', 'ultrapress' ),
			'type' => 'heading',
			'section' => 'ultrapress_header_styles',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_purchase_btn_text_color',
	array(
		'default' => '',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( 
		$wp_customize, 'ultrapress_purchase_btn_text_color',
		array(
			'label' => esc_html__( 'Text Color', 'ultrapress' ),
			'section' => 'ultrapress_header_styles',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_purchase_btn_text_hover_color',
	array(
		'default' => '',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization',
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( 
		$wp_customize, 'ultrapress_purchase_btn_text_hover_color',
		array(
			'label' => esc_html__( 'Text Hover color', 'ultrapress' ),
			'section' => 'ultrapress_header_styles',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_purchase_btn_background',
	array(
		'default' => '',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization',
	)
);
$wp_customize->add_control(
	new Ultrapress_Customize_Alpha_Color_Control( 
		$wp_customize, 'ultrapress_purchase_btn_background',
		array(
			'label' => esc_html__( 'Background Color', 'ultrapress' ),
			'section' => 'ultrapress_header_styles',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_purchase_btn_hover_background',
	array(
		'default' => '',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization',
	)
);
$wp_customize->add_control(
	new Ultrapress_Customize_Alpha_Color_Control( 
		$wp_customize, 'ultrapress_purchase_btn_hover_background',
		array(
			'label' => esc_html__( 'Background Hover Color', 'ultrapress' ),
			'section' => 'ultrapress_header_styles',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_purchase_btn_border_color',
	array(
		'default' => '',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization',
	)
);
$wp_customize->add_control(
	new Ultrapress_Customize_Alpha_Color_Control( 
		$wp_customize, 'ultrapress_purchase_btn_border_color',
		array(
			'label' => esc_html__( 'Border Color', 'ultrapress' ),
			'section' => 'ultrapress_header_styles',
		)
	) 
);