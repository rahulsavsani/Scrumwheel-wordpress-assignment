<?php
$wp_customize->add_setting( 'ultrapress_archive_sidebar_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Simple_Notice_Custom_Control( 
		$wp_customize, 'ultrapress_archive_sidebar_heading',
		array(
			'label' => esc_html__( 'Sidebar Settings', 'ultrapress' ),
			'type' => 'heading',
			'section' => 'ultrapress_archive_sidebar_section',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_archive_sidebar_layout',
	array(
		'default' => 'right-sidebar',
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_radio_sanitization'
	)
);
$wp_customize->add_control(
	new Ultrapress_Image_Radio_Button_Custom_Control(
		$wp_customize, 'ultrapress_archive_sidebar_layout',
		array(
			'label' => esc_html__( 'Choose Sidebar Layout', 'ultrapress' ),
			'section' => 'ultrapress_archive_sidebar_section',
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
$wp_customize->add_setting('ultrapress_archive_sidebar', array(
	'default'           =>  'default-sidebar',
	'sanitize_callback' => 'ultrapress_text_sanitization',
));
$wp_customize->add_control(
	new Ultrapress_Sidebar_Dropdown_Custom_Control(
		$wp_customize, 'ultrapress_archive_sidebar', array(
			'label'    		=> esc_html__('Choose Sidebar', 'ultrapress'),
			'section'  		=> 'ultrapress_archive_sidebar_section',
		)
	)
);