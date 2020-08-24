<?php
namespace Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class UT_Elementor_Addons_Lite_Widget_Nav_Menu extends Widget_Base {

	public function get_name() {
		return 'ut-nav-menu';
	}

	public function get_title() {
		return __( 'Nav Menu', 'ut-elementor-addons-lite' );
	}

	public function get_icon() {
		return 'eicon-nav-menu';
	}

	public function get_categories() {
		return [ 'ut-elementor-addons-lite' ];
	}

	private function get_available_menus() {
		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Nav Menu', 'ut-elementor-addons-lite' ),
			]
		);

		$menus = $this->get_available_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu',
				[
					'label'   => __( 'Menu', 'ut-elementor-addons-lite' ),
					'type'    => Controls_Manager::SELECT,
					'options'               => $menus,
					'default'               => array_keys( $menus )[0],
					'separator'             => 'after',
					'description' => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'ut-elementor-addons-lite' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		} else {
			$this->add_control(
				'menu',
				[
					'type' => Controls_Manager::RAW_HTML,
					'raw' => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'ut-elementor-addons-lite' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'separator' => 'after',
					'content_classes' => 'ut-addons-panel-alert ut-addons-panel-alert-info',
				]
			);
		}

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => __( 'Left', 'ut-elementor-addons-lite' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ut-elementor-addons-lite' ),
						'icon' => 'fa fa-align-center',
					],
					'flex-end' => [
						'title' => __( 'Right', 'ut-elementor-addons-lite' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .ut-custom-menu ul.custom-menu' => 'justify-content: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'layout',
			[
				'label'                 => __( 'Layout', 'ut-elementor-addons-lite' ),
				'type'                  => Controls_Manager::SELECT,
				'default'               => 'horizontal',
				'options'               => [
					'horizontal' => __( 'Horizontal', 'ut-elementor-addons-lite' ),
					'vertical' => __( 'Vertical', 'ut-elementor-addons-lite' ),
				]
			]
		);

		$this->end_controls_section();

		/* Main Menu Style */

		$this->start_controls_section(
			'section_style_main-menu',
			[
				'label'                 => __( 'Main Menu', 'ut-elementor-addons-lite' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'heading_menu_item',
			[
				'type'                  => Controls_Manager::HEADING,
				'label'                 => __( 'Menu Item', 'ut-elementor-addons-lite' ),
			]
		);

		$this->start_controls_tabs( 'tabs_menu_item_style' );

		$this->start_controls_tab(
			'tab_menu_item_normal',
			[
				'label'                 => __( 'Normal', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_responsive_control(
			'color_menu_item',
			[
				'label'                 => __( 'Text Color', 'ut-elementor-addons-lite' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .ut-custom-menu .menu-item a,{{WRAPPER}} .menu-item-has-children::after' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_menu_item_hover',
			[
				'label'                 => __( 'Hover', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_responsive_control(
			'color_menu_item_hover',
			[
				'label'                 => __( 'Text Color', 'ut-elementor-addons-lite' ),
				'type'                  => Controls_Manager::COLOR,
				'selectors'             => [
					'{{WRAPPER}} .ut-custom-menu .menu-item:hover a,
					{{WRAPPER}} .ut-custom-menu .menu-item:focus a, 
					{{WRAPPER}} .menu-item-has-children:hover::after' => 'color: {{VALUE}}',
				],
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_menu_item_active',
			[
				'label' => __( 'Active', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_responsive_control(
			'color_menu_item_active',
			[
				'label'                 => __( 'Text Color', 'ut-elementor-addons-lite' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .ut-custom-menu .menu-item.current-menu-item a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'menu_typography',
				'scheme'                => Scheme_Typography::TYPOGRAPHY_1,
				'separator'             => 'before',
				'selector'              => '{{WRAPPER}} .ut-custom-menu .menu-item', 
			]
		);


		$this->add_responsive_control(
			'padding_horizontal_menu_item',
			[
				'label'                 => __( 'Horizontal Padding', 'ut-elementor-addons-lite' ),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px' => [
						'max' => 50,
					],
				],
				'devices'               => [ 'desktop', 'tablet', 'mobile' ],
				'selectors'             => [
					'{{WRAPPER}} .ut-custom-menu .menu-item' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'padding_vertical_menu_item',
			[
				'label'                 => __( 'Vertical Padding', 'ut-elementor-addons-lite' ),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px' => [
						'max' => 50,
					],
				],
				'devices'               => [ 'desktop', 'tablet', 'mobile' ],
				'selectors'             => [
					'{{WRAPPER}} .ut-custom-menu .menu-item' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_section();

		/* Sub Menu Styles */
		$this->start_controls_section(
			'section_style_sub-menu',
			[
				'label'                 => __( 'Sub Menu', 'ut-elementor-addons-lite' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'sub_menu_item',
			[
				'type'                  => Controls_Manager::HEADING,
				'label'                 => __( 'Sub Menu Item', 'ut-elementor-addons-lite' ),
			]
		);

		$this->start_controls_tabs( 'tabs_submenu_item_style' );

		$this->start_controls_tab(
			'tab_submenu_item_normal',
			[
				'label'                 => __( 'Normal', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_control(
			'bgcolor_submenu_item',
			[
				'label'                 => __( 'Background Color', 'ut-elementor-addons-lite' ),
				'type'                  => Controls_Manager::COLOR,
				'scheme'                => [
					'type'     => Scheme_Color::get_type(),
					'value'    => Scheme_Color::COLOR_3,
				],
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .ut-custom-menu .sub-menu .menu-item' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'color_submenu_item',
			[
				'label'                 => __( 'Text Color', 'ut-elementor-addons-lite' ),
				'type'                  => Controls_Manager::COLOR,
				'scheme'                => [
					'type'     => Scheme_Color::get_type(),
					'value'    => Scheme_Color::COLOR_3,
				],
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .ut-custom-menu .sub-menu .menu-item a,{{WRAPPER}} ul.sub-menu .menu-item-has-children::after' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_submenu_item_hover',
			[
				'label'                 => __( 'Hover', 'ut-elementor-addons-lite' ),
			]
		);
		$this->add_control(
			'bgcolor_submenu_item_hover',
			[
				'label'                 => __( 'Background Color', 'ut-elementor-addons-lite' ),
				'type'                  => Controls_Manager::COLOR,
				'scheme'                => [
					'type'     => Scheme_Color::get_type(),
					'value'    => Scheme_Color::COLOR_4,
				],
				'selectors'             => [
					'{{WRAPPER}} .ut-custom-menu .sub-menu .menu-item:hover' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'color_submenu_item_hover',
			[
				'label'                 => __( 'Text Color', 'ut-elementor-addons-lite' ),
				'type'                  => Controls_Manager::COLOR,
				'scheme'                => [
					'type'     => Scheme_Color::get_type(),
					'value'    => Scheme_Color::COLOR_4,
				],
				'selectors'             => [
					'{{WRAPPER}} .ut-custom-menu .sub-menu>.menu-item:hover>a,{{WRAPPER}} ul.sub-menu>.menu-item-has-children:hover::after' => 'color: {{VALUE}}',
				],
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_submenu_item_active',
			[
				'label' => __( 'Active', 'ut-elementor-addons-lite' ),
			]
		);

		$this->add_control(
			'bgcolor_submenu_item_active',
			[
				'label'                 => __( 'Background Color', 'ut-elementor-addons-lite' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .ut-custom-menu .sub-menu .menu-item.current-menu-item' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'color_submenu_item_active',
			[
				'label'                 => __( 'Text Color', 'ut-elementor-addons-lite' ),
				'type'                  => Controls_Manager::COLOR,
				'default'               => '',
				'selectors'             => [
					'{{WRAPPER}} .ut-custom-menu .sub-menu .menu-item.current-menu-item a,{{WRAPPER}} ul.sub-menu .menu-item-has-children.current-menu-item::after' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'                  => 'submenu_typography',
				'scheme'                => Scheme_Typography::TYPOGRAPHY_1,
				'separator'             => 'before',
				'selector'              => '{{WRAPPER}} .ut-custom-menu .sub-menu .menu-item', 
			]
		);

        $this->add_group_control(
            Group_Control_Border::get_type(),
                [
                    'name'              => 'submenu_item_border',
                    'label' =>  __( 'Submenu Item Border', 'ut-elementor-addons-lite' ),
                    'selector'          => '{{WRAPPER}} .ut-custom-menu ul.sub-menu li:not(:last-child)',
                    ]
                );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'submenu_background',
                'label' => __( 'Background', 'ut-elementor-addons-lite' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .ut-custom-menu .sub-menu',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
                [
                    'name'              => 'submenu_border',
                    'selector'          => '{{WRAPPER}} .ut-custom-menu .sub-menu',
                    ]
                );
        
        $this->add_control('submenu_border_radius',
                [
                    'label'         => __('Border Radius', 'ut-elementor-addons-lite'),
                    'type'          => Controls_Manager::SLIDER,
                    'size_units'    => ['px', '%', 'em'],
                    'selectors'     => [
                        '{{WRAPPER}} .ut-custom-menu .sub-menu' => 'border-radius: {{SIZE}}{{UNIT}};'
                        ]
                    ]
                );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'              => 'submenu_box_shadow',
                'selector'          => '{{WRAPPER}} .ut-custom-menu .sub-menu',
            ]
            );

        $this->add_control('submenu_indent',
            [
                'label'         => __('Submenu Indent', 'ut-elementor-addons-lite'),
                'type'          => Controls_Manager::SLIDER,
                'size_units'    => ['px'],
                'selectors'     => [
                    '{{WRAPPER}} .ut-custom-menu>ul>li>ul.sub-menu' => 'margin-top: {{SIZE}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'submenu_margin',
            [
                'label' => __( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ut-custom-menu .sub-menu .menu-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_responsive_control(
            'submenu_padding',
            [
                'label' => __( 'Padding', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .ut-custom-menu .sub-menu .menu-item a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();

		/* Reponsive Menu Style */

		$this->start_controls_section(
			'section_style_resp-menu',
			[
				'label'                 => __( 'Responsive Menu', 'ut-elementor-addons-lite' ),
				'tab'                   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'resp_notice',
			[
				'type' => Controls_Manager::RAW_HTML,
				'raw' => '<em>' .__('Please switch to responsive mode to configure settings.','ut-elementor-addons-lite').'</em>',
			]
		);		

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'respmenu_background',
                'label' => __( 'Background', 'ut-elementor-addons-lite' ),
                'selector' => '{{WRAPPER}} .ut-custom-menu ul.custom-menu.is-active,{{WRAPPER}}  .ut-custom-menu ul.custom-menu ul',
            ]
        );

		$this->add_control(
			'resp_toggle_color',
			[
				'label'                 => __( 'Toggle Button Color', 'ut-elementor-addons-lite' ),
				'type'                  => Controls_Manager::COLOR,
				'selectors'             => [
					'{{WRAPPER}} .hamburger__line-in::before, .hamburger__line-in::after' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();

		$this->add_render_attribute( 'ut-custom-menu', 'class', 'ut-custom-menu utal');
		$this->add_render_attribute( 'ut-custom-menu', 'class', 'layout-'.$settings['layout']);
		?>
        <div <?php echo $this->get_render_attribute_string( "ut-custom-menu" ); ?>>
            <button class="hamburger hamburger--nav menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                <div class="hamburger__line hamburger__line--01">
                    <div class="hamburger__line-in hamburger__line-in--01"></div>
                </div>
                <div class="hamburger__line hamburger__line--02">
                    <div class="hamburger__line-in hamburger__line-in--02"></div>
                </div>
                <div class="hamburger__line hamburger__line--03">
                    <div class="hamburger__line-in hamburger__line-in--03"></div>
                </div>
            </button>
        	<?php

	        $args = apply_filters( 'ut_nav_menu_args',[
	            'menu'        => $settings['menu'],
	            'menu_class'  => 'menu custom-menu',
	            'fallback_cb' => '__return_empty_string',
	            'container'   => '',
	        ] );

        	wp_nav_menu( $args );
            
        	?>
        </div><!-- .ut-custom-menu-wrap -->
		<?php

	}

}

Plugin::instance()->widgets_manager->register_widget_type( new UT_Elementor_Addons_Lite_Widget_Nav_Menu() );
