<?php
$wp_customize->add_setting( 'ultrapress_body_font_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Simple_Notice_Custom_Control( 
		$wp_customize, 'ultrapress_body_font_heading',
		array(
			'label' => esc_html__( 'Body Font Styles', 'ultrapress' ),
			'type' => 'heading',
			'section' => 'body_style',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_body_font_family',
	array(
		'default' => '{"font":"Lato","regularweight":"regular","italicweight":"italic","boldweight":"regular","category":"sans-serif"}',
		'sanitize_callback' => 'ultrapress_google_font_sanitization',
		'transport' => 'refresh',
	)
);
 $wp_customize->add_control( 
	new Ultrapress_Google_Font_Select_Custom_Control( 
		$wp_customize, 'ultrapress_body_font_family',
		array(
			'label' => esc_html__( 'Body Font Family' , 'ultrapress'),
			'section' => 'body_style',
			'input_attrs' => array(
				'font_count' => 'all',
				'orderby' => 'alpha',
			),
		)
	) 
);
 $wp_customize->add_setting( 'ultrapress_body_font_color',
	array(
		'default' => '',
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization'
	)
);
 $wp_customize->add_control( 
	new Ultrapress_Customize_Alpha_Color_Control(
		$wp_customize, 'ultrapress_body_font_color',
		array(
			'label' => esc_html__( 'Text Color', 'ultrapress' ),
			'section' => 'body_style',
			'show_opacity' => false,
		)
	) 
);
 $wp_customize->add_setting( 'ultrapress_body_font_size',
 	array(
 		'default' => '',
 		'transport' => 'refresh',
 		'sanitize_callback' => 'absint'
 	)
 );
 $wp_customize->add_control( 
 	new Ultrapress_Slider_Custom_Control( 
 		$wp_customize, 'ultrapress_body_font_size',
 		array(
 			'label' => esc_html__( 'Font Size(px)', 'ultrapress' ),
 			'section' => 'body_style',
 			'input_attrs' => array(
 				'min' => 0,
 				'max' => 100,
 				'step' => 1,
 			),
 		)
 	) 
 );
  $wp_customize->add_setting( 'ultrapress_body_line_height',
 	array(
 		'default' => '',
 		'transport' => 'refresh',
 		'sanitize_callback' => 'ultrapress_floatval'
 	)
 );
 $wp_customize->add_control( 
 	new Ultrapress_Slider_Custom_Control( 
 		$wp_customize, 'ultrapress_body_line_height',
 		array(
 			'label' => esc_html__( 'Line Height(em)', 'ultrapress' ),
 			'section' => 'body_style',
 			'input_attrs' => array(
 				'min' => 0,
 				'max' => 10,
 				'step' => 0.1,
 			),
 		)
 	) 
 );