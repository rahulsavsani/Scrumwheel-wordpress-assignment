<?php
$wp_customize->add_setting( 'ultrapress_banner_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Simple_Notice_Custom_Control( 
		$wp_customize, 'ultrapress_banner_heading',
		array(
			'label' => esc_html__( 'Banner Settings', 'ultrapress' ),
			'type' => 'heading',
			'section' => 'ultrapress_breadcrumb_banner_section',
		)
	) 
);

$wp_customize->add_setting( 'ultrapress_breadcrumb_banner_switch',
	array(
		'default' => true,
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_switch_sanitization'
	)
);
$wp_customize->add_control(
	new Ultrapress_Toggle_Switch_Custom_control(
		$wp_customize, 'ultrapress_breadcrumb_banner_switch',
		array(
			'label' => esc_html__( 'Show Banner', 'ultrapress' ),
			'section' => 'ultrapress_breadcrumb_banner_section'
		)
	)
);

$wp_customize->add_setting( 'ultrapress_bread_banner_bg_color',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Customize_Alpha_Color_Control( 
		$wp_customize, 'ultrapress_bread_banner_bg_color',
		array(
			'label' => esc_html__( 'Background Color', 'ultrapress' ),
			'section' => 'ultrapress_breadcrumb_banner_section',
			'show_opacity' => true,
		)
	)
);

$wp_customize->add_setting( 'ultrapress_bread_title_color',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Customize_Alpha_Color_Control( 
		$wp_customize, 'ultrapress_bread_title_color',
		array(
			'label' => esc_html__( 'Title Color', 'ultrapress' ),
			'section' => 'ultrapress_breadcrumb_banner_section',
			'show_opacity' => false,
		)
	)
);

$wp_customize->add_setting( 'ultrapress_banner_title_position',
	array(
		'default' => 'wide',
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_sanitize_select'
	)
);
$wp_customize->add_control( 'ultrapress_banner_title_position',
	array(
		'type'      => 'select',
		'choices'   => array(
			'left' => esc_html__('Left','ultrapress'),              
			'right' => esc_html__('Right','ultrapress'),
			'center' => esc_html__('Center','ultrapress'),              
			'wide' => esc_html__('Wide','ultrapress'),   
		),
		'label'     => esc_html__( 'Content Position', 'ultrapress' ),
		'section'   => 'ultrapress_breadcrumb_banner_section',
	)
);

$wp_customize->add_setting( 'ultrapress_bread_title_size',
    array(
       'transport' => 'refresh',
       'sanitize_callback' => 'absint'
    )
);
 
$wp_customize->add_control( 'ultrapress_bread_title_size',
    array(
       'label' => esc_html__( 'Font Size(px)','ultrapress' ),
       'section' => 'ultrapress_breadcrumb_banner_section',
       'type' => 'number', 
    )
);

$wp_customize->add_setting( 
	'ultrapress_bread_banner_bg_image', 
	array(
		'sanitize_callback' => 'esc_url_raw'
	)
);
$wp_customize->add_control( 
	new WP_Customize_Upload_Control( 
		$wp_customize, 
		'ultrapress_bread_banner_bg_image', 
		array(
			'label'      => esc_html__( 'Background Image', 'ultrapress' ),
			'section'    => 'ultrapress_breadcrumb_banner_section',                  
		)
	) 
);

$wp_customize->add_setting( 'ultrapress_bread_banner_bg_overlay',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization',
		'default' => 'rgba(0, 0, 0, 0.1)'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Customize_Alpha_Color_Control( 
		$wp_customize, 'ultrapress_bread_banner_bg_overlay',
		array(
			'label' => esc_html__( 'Background Overlay', 'ultrapress' ),
			'section' => 'ultrapress_breadcrumb_banner_section',
			'show_opacity' => true,
			'active_callback'  => 'ultrapress_bread_banner_image_cb',
		)
	)
);

$wp_customize->add_setting( 'ultrapress_bread_banner_height',
	array(
		'default' => 150,
		'transport' => 'refresh',
		'sanitize_callback' => 'absint'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Slider_Custom_Control( 
		$wp_customize, 'ultrapress_bread_banner_height',
		array(
			'label' => esc_html__( 'Banner Height(px)', 'ultrapress' ),
			'section' => 'ultrapress_breadcrumb_banner_section',
			'input_attrs' => array(
				'max' => 800,
				'step' => 1,
				'min' => 150
			),
		)
	) 
);
