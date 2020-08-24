<?php 
$wp_customize->add_setting( 'ultrapress_footer_layout_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Simple_Notice_Custom_Control( 
		$wp_customize, 'ultrapress_footer_layout_heading',
		array(
			'label' => esc_html__( 'Footer Layouts', 'ultrapress' ),
			'type' => 'heading',
			'section' => 'ultrapress_footer_layout_section',
		)
	) 
);

$wp_customize->add_setting( 'ultrapress_footer_layouts',
	array(
		'default' => 'default',
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_text_sanitization'
	)
);
$wp_customize->add_control( new Ultrapress_Text_Radio_Button_Custom_Control( $wp_customize, 'ultrapress_footer_layouts',
	array(
		'label' => esc_html__( 'Choose Footer Layouts', 'ultrapress' ),
		'section' => 'ultrapress_footer_layout_section',
		'choices' => array(
			'default' => esc_html__('Default','ultrapress'),
			'custom' => esc_html__('Custom','ultrapress'),
		),
	)
) );

if (defined('ELEMENTOR_VERSION')):
//Custom footer
$wp_customize->add_setting('ultrapress_custom_footer',
	array(
    	'capability' => 'edit_theme_options',
    	'sanitize_callback' => 'absint',
    	'transport' => 'refresh',
    )
);
$wp_customize->add_control( 'ultrapress_custom_footer',
	array(
		'label'  => esc_html__( 'Choose Footer Template', 'ultrapress' ),
		'section' => 'ultrapress_footer_layout_section',
		'type' => 'select',
		'choices' => ultrapress_get_elementor_templates(),
		'active_callback' => 'ultrapress_footer_layouts_cb' 
	)
); 
else:
//Notice
$wp_customize->add_setting( 'ultrapress_custom_footer_notfound_notice',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
 $wp_customize->add_control( 
	new Ultrapress_Simple_Notice_Custom_Control( 
		$wp_customize, 'ultrapress_custom_footer_notfound_notice',
		array(
			'label' => esc_html__( 'Note:', 'ultrapress' ),
			'description' => esc_html__( 'Elementor is not installed.Please install and activate elementor first.', 'ultrapress' ),
			'section' => 'ultrapress_footer_layout_section',
			'active_callback' => 'ultrapress_footer_layouts_cb'
		)
	) 
);
endif;

//Notice
$wp_customize->add_setting( 'ultrapress_custom_footer_notice',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
 $wp_customize->add_control( 
	new Ultrapress_Simple_Notice_Custom_Control( 
		$wp_customize, 'ultrapress_custom_footer_notice',
		array(
			'label' => esc_html__( 'Note:', 'ultrapress' ),
			'description' => esc_html__( 'Footer built from elementor will be applied.', 'ultrapress' ),
			'section' => 'ultrapress_footer_layout_section',
			'active_callback' => 'ultrapress_footer_layouts_cb'
		)
	) 
); 

$wp_customize->add_setting( 
	'ultrapress_copyright_text', 
	array(
		'default' => '',
		'sanitize_callback' => 'wp_kses_post' 
	)
);
$wp_customize->add_control( 
	'ultrapress_copyright_text', 
	array(
		'label' => esc_html__( 'Copyright Text', 'ultrapress' ),
		'description' => esc_html__( '[date],[site-title] can be used.', 'ultrapress' ),
		'section' => 'ultrapress_footer_layout_section',
		'type' => 'textarea',
		'active_callback' => 'ultrapress_footer_copyright_cb'
	)
);  


$wp_customize->add_setting( 'ultrapress_footer_bg_color',
	array(
		'default' => '',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( 
		$wp_customize, 'ultrapress_footer_bg_color',
		array(
			'label' => esc_html__( 'Background color', 'ultrapress' ),
			'section' => 'ultrapress_footer_layout_section',
			'active_callback'  => 'ultrapress_footer_copyright_cb',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_footer_text_color',
	array(
		'default' => '',
		'sanitize_callback' => 'ultrapress_hex_rgba_sanitization'
	)
);
$wp_customize->add_control(
	new WP_Customize_Color_Control( 
		$wp_customize, 'ultrapress_footer_text_color',
		array(
			'label' => esc_html__( 'Text color', 'ultrapress' ),
			'section' => 'ultrapress_footer_layout_section',
			'active_callback'  => 'ultrapress_footer_copyright_cb',
		)
	) 
);
   

