<?php
/**
 * UT_Elementor_Addons_Lite_Products 
 * @package ut-elementor-addons-lite
 * @since version 1.0.0
 */

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	return; // Exit if it is accessed directly
}

class UT_Elementor_Addons_Lite_Products extends Widget_Base {
    use \Elementor\UT_Elementor_Addons_Lite_Queries;

	/**
	 * Retrieve UT_Elementor_Addons_Lite_Products widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'utal-products';
	}

	/**
	 * Retrieve UT_Elementor_Addons_Lite_Products widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Woo Products', 'ut-elementor-addons-lite' );
	}

	/**
	 * Retrieve UT_Elementor_Addons_Lite_Products widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-products';
	}

	/**
	 * Retrieve the list of categories the UT_Elementor_Addons_Lite_Products widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'ut-elementor-addons-lite' );
	}

	/**
	 * Register UT_Elementor_Addons_Lite_Products widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function _register_controls() {

		// Widget title section
		$this->start_controls_section(
			'section_detail',
			array(
				'label' => esc_html__( 'Section Setting', 'ut-elementor-addons-lite' ),
			)
		);
        $this->add_control(
            'post_column',
            array(
                'label'       => esc_html__( 'No. of Columns:', 'ut-elementor-addons-lite' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => true,
                'default'       =>  'column3',
                'options'      => array(
                    'column1'   => esc_html__('1','ut-elementor-addons-lite'),
                    'column2'   => esc_html__('2','ut-elementor-addons-lite'),
                    'column3'   => esc_html__('3','ut-elementor-addons-lite'),
                    'column4'   => esc_html__('4','ut-elementor-addons-lite'),
                    'column4'   => esc_html__('4','ut-elementor-addons-lite'),
                ),
            )
        );

        $this->add_control(
            'categories',
            [
                'label'             => esc_html__( 'Product Categories', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::SELECT2,
                'label_block'       => true,
                'multiple'          => true,
                'options'           => ut_elementor_addons_lite_get_product_categories(),
            ]
        );
        
        $this->add_control(
            'showposts',
            [
                'label' => esc_html__( 'No. of Products', 'ut-elementor-addons-lite' ),
                'type'  => Controls_Manager::NUMBER,
                'min' => -1,
                'max' => 100,
                'step' => 1,
                'default' => 4,
            ]
        );

		$this->end_controls_section();

        //styling tab
        $this->start_controls_section(
            'section_general_style',
            [
                'label' => esc_html__( 'General Styles', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'space_image',
                [
                    'label' => esc_html__( 'Image & Content Gap', 'ut-elementor-addons-lite' ),
                    'type' => Controls_Manager::SLIDER,
                    'desktop_default' => [
                        'size' => 15,
                    ],
                    'tablet_default' => [
                        'size'  => '',
                    ],
                    'mobile_default' => [
                        'size'  => '',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .product img' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->start_controls_tabs(
                'price_tabs'
            );
                $this->start_controls_tab(
                    'price_tab1',
                    [
                        'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
                    ]
                );
                    $this->add_control(
                        'product_title_color',
                        [
                            'label'     => esc_html__( 'Title Color', 'ut-elementor-addons-lite' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .li.product h2.woocommerce-loop-product__title' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'price_color',
                        [
                            'label'     => esc_html__( 'Price Color', 'ut-elementor-addons-lite' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .price' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                $this->start_controls_tab(
                    'price_tab2',
                    [
                        'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
                    ]
                );
                    $this->add_control(
                        'product_title_color_hover',
                        [
                            'label'     => esc_html__( 'Title Color', 'ut-elementor-addons-lite' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .li.product h2.woocommerce-loop-product__title' => 'color: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'price_color_hover',
                        [
                            'label'     => esc_html__( 'Price Color', 'ut-elementor-addons-lite' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .price:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();


            $this->end_controls_tabs();

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'      => 'product_title_typography',
                    'label'     => esc_html__( 'Title Typography', 'ut-elementor-addons-lite' ),
                    'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .li.product h2.woocommerce-loop-product__title',
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'      => 'product_price_typography',
                    'label'     => esc_html__( 'Price Typography', 'ut-elementor-addons-lite' ),
                    'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .price',
                ]
            );

        $this->end_controls_section();//end for styling tab

        $this->start_controls_section(
            'inner_styles',
            [
                'label' => esc_html__( 'Inner Styles', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

            $this->add_responsive_control(
                'column_gap',
                [
                    'label' => esc_html__( 'Columns Gap', 'ut-elementor-addons-lite' ),
                    'type' => Controls_Manager::SLIDER,
                    'desktop_default' => [
                        'size' => 10,
                    ],
                    'tablet_default' => [
                        'size'  => '',
                    ],
                    'mobile_default' => [
                        'size'  => '',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .utal-product-wrapper' => 'margin-left: -{{SIZE}}{{UNIT}}; margin-right: -{{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .utal-products ul.utal-product-wrapper li.product' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'row_gap',
                [
                    'label' => esc_html__( 'Rows Gap', 'ut-elementor-addons-lite' ),
                    'type' => Controls_Manager::SLIDER,
                    'desktop_default' => [
                        'size' => 15,
                    ],
                    'tablet_default' => [
                        'size'  => '',
                    ],
                    'mobile_default' => [
                        'size'  => '',
                    ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} ul.utal-product-wrapper li.product' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();


        $this->start_controls_section(
            'product_button_styles',
            [
                'label' => esc_html__( 'Button Styles', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'button_tabs'
        );
            $this->start_controls_tab(
                'button_tab1',
                [
                    'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
                ]
            );

                $this->add_control(
                    'button_color',
                    [
                        'label'     => esc_html__( 'Button Text Color', 'ut-elementor-addons-lite' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} a.product_type_grouped, {{WRAPPER}} a.add_to_cart_button, {{WRAPPER}} a.product_type_external' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'button_bg_color',
                    [
                        'label'     => esc_html__( 'Button Background Color', 'ut-elementor-addons-lite' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} a.product_type_grouped, {{WRAPPER}} a.add_to_cart_button, {{WRAPPER}} a.product_type_external' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'button_border',
                    [
                        'label' => esc_html__( 'Style', 'elementor' ),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            '' => esc_html__( 'None', 'elementor' ),
                            'solid' => esc_html__( 'Solid', 'elementor' ),
                            'double' => esc_html__( 'Double', 'elementor' ),
                            'dotted' => esc_html__( 'Dotted', 'elementor' ),
                            'dashed' => esc_html__( 'Dashed', 'elementor' ),
                            'groove' => esc_html__( 'Groove', 'elementor' ),
                        ],
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} a.product_type_grouped, {{WRAPPER}} a.add_to_cart_button, {{WRAPPER}} a.product_type_external' => 'border-style: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'button_border_width',
                    [
                        'label' => esc_html__( 'Border Width', 'ut-elementor-addons-lite' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} a.product_type_grouped, {{WRAPPER}} a.add_to_cart_button, {{WRAPPER}} a.product_type_external' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'desktop_default' => [
                            'top' => '',
                            'right' => '',
                            'bottom' => '',
                            'left' => '',
                            'unit' => 'px',
                        ],
                        'tablet_default' => [
                            'top' => '',
                            'right' => '',
                            'bottom' => '',
                            'left' => '',
                            'unit' => 'px',
                        ],
                        'mobile_default' => [
                            'top' => '',
                            'right' => '',
                            'bottom' => '',
                            'left' => '',
                            'unit' => 'px',
                        ],
                    ]
                );

                $this->add_control(
                    'button_border_color',
                    [
                        'label'     => esc_html__( 'Button Border Color', 'ut-elementor-addons-lite' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} a.product_type_grouped, {{WRAPPER}} a.add_to_cart_button, {{WRAPPER}} a.product_type_external' => 'border-color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'button_border_radius',
                    [
                        'label' => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} a.product_type_grouped, {{WRAPPER}} a.add_to_cart_button, {{WRAPPER}} a.product_type_external' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'desktop_default' => [
                            'top' => '',
                            'right' => '',
                            'bottom' => '',
                            'left' => '',
                            'unit' => 'px',
                        ],
                        'tablet_default' => [
                            'top' => '',
                            'right' => '',
                            'bottom' => '',
                            'left' => '',
                            'unit' => 'px',
                        ],
                        'mobile_default' => [
                            'top' => '',
                            'right' => '',
                            'bottom' => '',
                            'left' => '',
                            'unit' => 'px',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'button_box_shadow',
                        'label' => esc_html__( 'Box Shadow', 'ut-elementor-addons-lite' ),
                        'selector' => '{{WRAPPER}} a.product_type_grouped, {{WRAPPER}} a.add_to_cart_button, {{WRAPPER}} a.product_type_external',
                    ]
                );

            $this->end_controls_tab();
            $this->start_controls_tab(
                'button_tab2',
                [
                    'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
                ]
            );

                $this->add_control(
                    'button_color_hover',
                    [
                        'label'     => esc_html__( 'Button Text Color: Hover', 'ut-elementor-addons-lite' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} a.product_type_grouped:hover, {{WRAPPER}} a.add_to_cart_button:hover, {{WRAPPER}} a.product_type_external:hover' => 'color: {{VALUE}};border-color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'button_bg_color_hover',
                    [
                        'label'     => esc_html__( 'Button Background Color: Hover', 'ut-elementor-addons-lite' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} a.product_type_grouped:hover, {{WRAPPER}} a.add_to_cart_button:hover, {{WRAPPER}} a.product_type_external:hover' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'button_border_hover',
                    [
                        'label' => esc_html__( 'Style', 'elementor' ),
                        'type' => Controls_Manager::SELECT,
                        'options' => [
                            '' => esc_html__( 'None', 'elementor' ),
                            'solid' => esc_html__( 'Solid', 'elementor' ),
                            'double' => esc_html__( 'Double', 'elementor' ),
                            'dotted' => esc_html__( 'Dotted', 'elementor' ),
                            'dashed' => esc_html__( 'Dashed', 'elementor' ),
                            'groove' => esc_html__( 'Groove', 'elementor' ),
                        ],
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} a.product_type_grouped:hover, {{WRAPPER}} a.add_to_cart_button:hover, {{WRAPPER}} a.product_type_external:hover' => 'border-style: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'button_border_width_hover',
                    [
                        'label' => esc_html__( 'Border Width', 'ut-elementor-addons-lite' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} a.product_type_grouped:hover, {{WRAPPER}} a.add_to_cart_button:hover, {{WRAPPER}} a.product_type_external:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'desktop_default' => [
                            'top' => '',
                            'right' => '',
                            'bottom' => '',
                            'left' => '',
                            'unit' => 'px',
                        ],
                        'tablet_default' => [
                            'top' => '',
                            'right' => '',
                            'bottom' => '',
                            'left' => '',
                            'unit' => 'px',
                        ],
                        'mobile_default' => [
                            'top' => '',
                            'right' => '',
                            'bottom' => '',
                            'left' => '',
                            'unit' => 'px',
                        ],
                    ]
                );

                $this->add_control(
                    'button_border_color_hover',
                    [
                        'label'     => esc_html__( 'Button Border Color', 'ut-elementor-addons-lite' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} a.product_type_grouped:hover, {{WRAPPER}} a.add_to_cart_button:hover, {{WRAPPER}} a.product_type_external:hover' => 'border-color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'button_border_radius_hover',
                    [
                        'label' => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} a.product_type_grouped:hover, {{WRAPPER}} a.add_to_cart_button:hover, {{WRAPPER}} a.product_type_external:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'desktop_default' => [
                            'top' => '',
                            'right' => '',
                            'bottom' => '',
                            'left' => '',
                            'unit' => 'px',
                        ],
                        'tablet_default' => [
                            'top' => '',
                            'right' => '',
                            'bottom' => '',
                            'left' => '',
                            'unit' => 'px',
                        ],
                        'mobile_default' => [
                            'top' => '',
                            'right' => '',
                            'bottom' => '',
                            'left' => '',
                            'unit' => 'px',
                        ],
                    ]
                );
                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'button_box_shadow_hover',
                        'label' => esc_html__( 'Box Shadow', 'ut-elementor-addons-lite' ),
                        'selector' => '{{WRAPPER}} a.product_type_grouped:hover, {{WRAPPER}} a.add_to_cart_button:hover, {{WRAPPER}} a.product_type_external:hover',
                    ]
                );


            $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->add_control(
            'button_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'button_typography',
                'label'     => esc_html__( 'Button Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} a.product_type_grouped, {{WRAPPER}} a.add_to_cart_button, {{WRAPPER}} a.product_type_external',
            ]
        );
        $this->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} a.product_type_grouped, {{WRAPPER}} a.add_to_cart_button, {{WRAPPER}} a.product_type_external' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'desktop_default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => '',
                ],
                'tablet_default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => '',
                ],
                'mobile_default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => '',
                ],
            ]
        );
        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} a.product_type_grouped, {{WRAPPER}} a.add_to_cart_button, {{WRAPPER}} a.product_type_external' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'desktop_default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'top' => '',
                    'right' => '',
                    'bottom' => '',
                    'left' => '',
                    'unit' => 'px',
                ],
            ]
        );

        $this->end_controls_section();
	}
	/**
	 * Render UT_Elementor_Addons_Lite_Products widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
        $settings = $this->get_settings();

        $this->add_render_attribute( 'utal-products', 'class', 'utal-products' );
        $showposts = isset( $settings[ 'showposts' ] )? $settings[ 'showposts' ] : '3';
        $column = isset( $settings[ 'post_column' ] )? $settings[ 'post_column' ] : 'column3';
        $cats = isset( $settings[ 'categories' ] )? $settings[ 'categories' ] : array();

        $this->add_render_attribute( 'utal-products', 'class', 'utal' );
        $block_args = array( 
                        'post_type' => 'product',
                        'posts_per_page' => $showposts,
                    );
        if( !empty($cats) ){
            $block_args['tax_query']  = array(
                            array(
                                'taxonomy'  => 'product_cat',
                                'field'     => 'id', 
                                'terms'     => $cats
                            )
                        );
        }
        $query = new \WP_Query( $block_args );
        ?>
        <div <?php echo $this->get_render_attribute_string( 'utal-products' ); ?>>
                <ul class="utal-product-wrapper <?php echo esc_attr($column);?>">
                    <?php 
                    if($query->have_posts()):
                        while($query->have_posts()):
                            $query->the_post(); 
                        wc_get_template_part( 'content', 'product' ); 
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </ul>
        </div><!-- element main wrapper -->
<?php
	}
}
Plugin::instance()->widgets_manager->register_widget_type( new UT_Elementor_Addons_Lite_Products() );