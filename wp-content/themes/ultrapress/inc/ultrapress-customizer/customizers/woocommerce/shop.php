<?php
$wp_customize->add_setting( 'ultrapress_shop_setting_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Simple_Notice_Custom_Control( 
		$wp_customize, 'ultrapress_shop_setting_heading',
		array(
			'label' => esc_html__( 'Shop Settings', 'ultrapress' ),
			'type' => 'heading',
			'section' => 'ultrapress_shop_setting_section',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_shop_display_layout',
	array(
		'default' => 'grid',
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_radio_sanitization'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Image_Radio_Button_Custom_Control( 
		$wp_customize, 'ultrapress_shop_display_layout',
		array(
			'label' => esc_html__( 'Display Layout', 'ultrapress' ),
			'section' => 'ultrapress_shop_setting_section',
			'choices' => array(
				'list' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'inc/ultrapress-customizer/images/archive-layout3.png',
					'name' => esc_html__( 'List', 'ultrapress' )
				),
				'grid' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'inc/ultrapress-customizer/images/archive-layout.png',
					'name' => esc_html__( 'Grid', 'ultrapress' )
				)
			)
		)
	) 
);
$wp_customize->add_setting('ultrapress_shop_column_no', 
	array(
		'capability'            => 'edit_theme_options',
		'default'               => 3,
		'sanitize_callback'     => 'absint'
	) 
);
$wp_customize->add_control( 'ultrapress_shop_column_no', 
	array(
		'label'                 =>  esc_html__( 'Column no.', 'ultrapress' ),
		'section'               => 'ultrapress_shop_setting_section',
		'type'                  => 'number',
		'active_callback'  => 'ultrapress_shop_column_cb',
	) 
);
$wp_customize->add_setting( 'ultrapress_product_per_page', 
	array(
		'capability'            => 'edit_theme_options',
		'default'               => 9,
		'sanitize_callback'     => 'absint'
	) 
);
$wp_customize->add_control('ultrapress_product_per_page', 
	array(
		'type'                  => 'number',
		'label'                 =>  esc_html__( 'Product per page', 'ultrapress' ),
		'section'               => 'ultrapress_shop_setting_section',
	) 
);
$wp_customize->add_setting( 'ultrapress_shop_sidebar_layout',
	array(
		'default' => 'right-sidebar',
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_radio_sanitization'
	)
);
$wp_customize->add_control(
	new Ultrapress_Image_Radio_Button_Custom_Control(
		$wp_customize, 'ultrapress_shop_sidebar_layout',
		array(
			'label' => esc_html__( 'Choose Sidebar Layout', 'ultrapress' ),
			'section' => 'ultrapress_shop_setting_section',
			'choices' => array(
				'left-sidebar' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'inc/ultrapress-customizer/images/sidebar-left.png',
					'name' => esc_html__( 'Left Sidebar', 'ultrapress' )
				),
				'right-sidebar' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'inc/ultrapress-customizer/images/sidebar-right.png',
					'name' => esc_html__( 'Right Sidebar', 'ultrapress' )
				),
				'no-sidebar' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'inc/ultrapress-customizer/images/sidebar-none.png',
					'name' => esc_html__( 'No Sidebar', 'ultrapress' )
				)
			)
		)
	) 
);
$wp_customize->add_setting('ultrapress_shop_sidebar', array(
	'default'           =>  'default-sidebar',
	'sanitize_callback' => 'ultrapress_text_sanitization',
));
$wp_customize->add_control(
	new Ultrapress_Sidebar_Dropdown_Custom_Control(
		$wp_customize, 'ultrapress_shop_sidebar', array(
			'label'    		=> esc_html__('Choose Sidebar', 'ultrapress'),
			'section'  		=> 'ultrapress_shop_setting_section',
		)
	)
);