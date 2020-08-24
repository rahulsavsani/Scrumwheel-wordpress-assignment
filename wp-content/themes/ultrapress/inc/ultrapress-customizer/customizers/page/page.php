<?php
$wp_customize->add_setting( 'ultrapress_page_settings_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Simple_Notice_Custom_Control( 
		$wp_customize, 'ultrapress_page_settings_heading',
		array(
			'label' => esc_html__( 'Page Settings', 'ultrapress' ),
			'type' => 'heading',
			'section' => 'ultrapress_page_setting_section',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_page_banner_switch',
	array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_switch_sanitization'
	)
);
$wp_customize->add_control(
	new Ultrapress_Toggle_Switch_Custom_control(
		$wp_customize, 'ultrapress_page_banner_switch',
		array(
			'label' => esc_html__( 'Show Banner', 'ultrapress' ),
			'section' => 'ultrapress_page_setting_section'
		)
	)
);
$wp_customize->add_setting( 'ultrapress_page_title_switch',
	array(
		'default' => false,
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_switch_sanitization'
	)
);
$wp_customize->add_control(
	new Ultrapress_Toggle_Switch_Custom_control(
		$wp_customize, 'ultrapress_page_title_switch',
		array(
			'label' => esc_html__( 'Show Page Title', 'ultrapress' ),
			'section' => 'ultrapress_page_setting_section'
		)
	)
);
$wp_customize->add_setting( 'ultrapress_page_fimage_switch',
	array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_switch_sanitization'
	)
);
$wp_customize->add_control(
	new Ultrapress_Toggle_Switch_Custom_control(
		$wp_customize, 'ultrapress_page_fimage_switch',
		array(
			'label' => esc_html__( 'Show Feature Image', 'ultrapress' ),
			'section' => 'ultrapress_page_setting_section'
		)
	)
);