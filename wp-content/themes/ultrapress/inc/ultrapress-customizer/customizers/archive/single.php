<?php
$wp_customize->add_setting( 'ultrapress_spost_settings_heading',
	array(
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_text_field'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Simple_Notice_Custom_Control( 
		$wp_customize, 'ultrapress_spost_settings_heading',
		array(
			'label' => esc_html__( 'Single Post Settings', 'ultrapress' ),
			'type' => 'heading',
			'section' => 'ultrapress_single_post_section',
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_single_layout',
	array(
		'default' => 'layout2',
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_radio_sanitization'
	)
);
$wp_customize->add_control( 
	new Ultrapress_Image_Radio_Button_Custom_Control( 
		$wp_customize, 'ultrapress_single_layout',
		array(
			'label' => esc_html__( 'Single Post Layout', 'ultrapress' ),
			'section' => 'ultrapress_single_post_section',
			'choices' => array(
				'layout1' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'inc/ultrapress-customizer/images/post-modern.png',
					'name' => esc_html__( 'Layout1', 'ultrapress' )
				),
				'layout2' => array(
					'image' => trailingslashit( get_template_directory_uri() ) . 'inc/ultrapress-customizer/images/post-classic.png',
					'name' => esc_html__( 'Layout2', 'ultrapress' )
				),
			)
		)
	) 
);
$wp_customize->add_setting( 'ultrapress_post_content_reorder',
	array(
		'default' => 'featured_image,title,meta_tag,content,coments,navigation',
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_text_sanitization'
	)
);
$wp_customize->add_control( new Ultrapress_Pill_Checkbox_Custom_Control( $wp_customize, 'ultrapress_post_content_reorder',
	array(
		'label' => __( 'Post Content Order', 'ultrapress' ),
		'section' => 'ultrapress_single_post_section',
		'input_attrs' => array(
			'sortable' => true,
			'fullwidth' => true,
		),
		'choices' => array(
			'featured_image' => __( 'Feature Image', 'ultrapress' ),
			'title' => __( 'Title', 'ultrapress' ),
			'meta_tag' => __( 'Meta Tags', 'ultrapress'  ),
			'content' => __( 'Content', 'ultrapress'  ),
			'coments' => __( 'Coments', 'ultrapress'  ),
			'navigation' => __( 'Navigation', 'ultrapress'  ),
		)
	)
) );
$wp_customize->add_setting( 'ultrapress_post_sidebar_layout',
	array(
		'default' => 'no-sidebar',
		'transport' => 'refresh',
		'sanitize_callback' => 'ultrapress_radio_sanitization'
	)
);
$wp_customize->add_control(
	new Ultrapress_Image_Radio_Button_Custom_Control(
		$wp_customize, 'ultrapress_post_sidebar_layout',
		array(
			'label' => esc_html__( 'Choose Sidebar Layout', 'ultrapress' ),
			'section' => 'ultrapress_single_post_section',
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
$wp_customize->add_setting('ultrapress_post_sidebar', array(
	'default'           =>  'default-sidebar',
	'sanitize_callback' => 'ultrapress_text_sanitization',
));
$wp_customize->add_control(
	new Ultrapress_Sidebar_Dropdown_Custom_Control(
		$wp_customize, 'ultrapress_post_sidebar', array(
			'label'    		=> esc_html__('Choose Sidebar', 'ultrapress'),
			'section'  		=> 'ultrapress_single_post_section',
		)
	)
);