<?php

/**

 * Creative starter demo config

 */

$options = array(
    'default' => array(
        'title'         => esc_html__('Default', 'ultrapress'),
        'main_cat'           => esc_html__('Demo Sites', 'ultrapress'),
        'cat'           => esc_html__('Business', 'ultrapress'),
        'pro_demo'    => false, 
        'demo_type' => 'starter',
        'purchage_url'    => 'https://uncodethemes.com/wordpress-themes/ultrapress/',
        'preview_url'   => 'http://ultrapress.uncodethemes.com/main/',
        'front_page'    => 'Home',
        'blog_page'     => 'Blog',
        'is_shop'       => true,
        'menus'         => array(
            'primary-menu'   => 'Main Menu',
        ),
        'plugins' => array(
            array(
                "plugin_name" => "Contact Form 7",
                "plugin_slug" => "contact-form-7",
                "plugin_filename" => "wp-contact-form-7", 
            ),
            array(
                "plugin_name" => "Elementor",
                "plugin_slug" => "elementor",
                "plugin_filename" => "elementor",
            ),
            array(
                "plugin_name" => "WooCommerce",
                "plugin_slug" => "woocommerce",
                "plugin_filename" => "woocommerce",
            ),
            array(
                "plugin_name" => "UT Elementor Addons Lite",
                "plugin_slug" => "ut-elementor-addons-lite",
                "plugin_filename" => "ut-elementor-addons-lite",
            ),
        ),
        'elementor'         => array(
            'color'   => 'disable',
            'font'   => 'disable',
        ),
        'theme'     => 'ultrapress',
    ),
    'blogify' => array(
        'title'         => esc_html__('Blogify', 'ultrapress'),
        'main_cat'           => esc_html__('Demo Sites', 'ultrapress'),
        'cat'           => esc_html__('Blog', 'ultrapress'),
        'pro_demo'    => false, 
        'demo_type' => 'starter',
        'purchage_url'    => 'https://uncodethemes.com/wordpress-themes/ultrapress/',
        'preview_url'   => 'http://ultrapress.uncodethemes.com/blogify',
        'front_page'    => 'Home',
        'blog_page'     => 'Blog',
        'is_shop'       => true,
        'menus'         => array(
            'primary-menu'   => 'Main',
        ),
        'plugins' => array(
            array(
                "plugin_name" => "Contact Form 7",
                "plugin_slug" => "contact-form-7",
                "plugin_filename" => "wp-contact-form-7", 
            ),
            array(
                "plugin_name" => "Elementor",
                "plugin_slug" => "elementor",
                "plugin_filename" => "elementor",
            ),
            array(
                "plugin_name" => "WooCommerce",
                "plugin_slug" => "woocommerce",
                "plugin_filename" => "woocommerce",
            ),
            array(
                "plugin_name" => "UT Elementor Addons Lite",
                "plugin_slug" => "ut-elementor-addons-lite",
                "plugin_filename" => "ut-elementor-addons-lite",
            ),
        ),
        'elementor'         => array(
            'color'   => 'disable',
            'font'   => 'disable',
        ),
        'theme'     => 'ultrapress',
    ),
);
UT_Demo_Importer::instance( $options );