<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class UT_Elementor_Addons_Lite_Widget_Blog_List extends Widget_Base {

    use \Elementor\UT_Elementor_Addons_Lite_Queries;

	public function get_name() {
		return 'utal-blog-list';
	}

	public function get_title() {
		return  esc_html__( 'Post List', 'ut-elementor-addons-lite' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'ut-elementor-addons-lite' ];
	}	

	protected function _register_controls() {	
		// Widget title section
        $this->start_controls_section(
            'section_detail',
            array(
                'label' => esc_html__( 'Section Setting', 'ut-elementor-addons-lite' ),
            )
        );

        $this->add_control(
                'element_title',
                [
                    'label'             => esc_html__( 'Element Title', 'ut-elementor-addons-lite' ),
                    'description'       => esc_html__( 'Enter text to change element title.', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::TEXT,
                ]
            );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'              => 'image_size',
                'label'             => esc_html__( 'Image Size', 'ut-elementor-addons-lite' ),
                'default'           => 'full',
                'exclude' => [ 'custom' ],
            ]
        );

        $this->add_responsive_control(
            'item_ratio',
            [
                'label' => esc_html__( 'Image Ratio', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'desktop_default' => [
                    'size' => 0.38,
                ],
                'tablet_default' => [
                    'size' => '',
                ],
                'mobile_default' => [
                    'size' => 0.5,
                ],
                'range' => [
                    'px' => [
                        'min' => 0.1,
                        'max' => 2,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-image' => 'padding-bottom: calc( {{SIZE}} * 100% );',
                    '{{WRAPPER}} .utal-blog-list-wrapper:after' => 'content: "{{SIZE}}"; position: absolute; color: transparent;',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_width',
            [
                'label' => esc_html__( 'Image Width', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'desktop_default' => [
                    'size' => 40,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'size_units' => [ '%' ],
                'selectors' => [
                    '{{WRAPPER}} .blog-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'content_width',
            [
                'label' => esc_html__( 'Content Width', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 40,
                        'max' => 100,
                    ],
                ],
                'desktop_default' => [
                    'size' => 60,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'size_units' => [ '%' ],
                'selectors' => [
                    '{{WRAPPER}} .utal-blog-list .utal-blog-list-wrapper .blog-post-wrap .blog-content' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fallback_image',
            array(
                'label'       => esc_html__( 'Fallback Image:', 'ut-elementor-addons-lite' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
            )
        );

        $this->add_control(
            'viewall_button', [
                'label' => esc_html__( 'View All Button', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'viewall_button_link',
            [
                'label' => esc_html__( 'View All Button Link', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'ut-elementor-addons-lite' ),
                'show_external' => true,
                'default' => [
                    'url' => '',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );
        
        $this->end_controls_section();

        $this->query_controls();

        $this->post_excerpts();

        $this->post_meta(array( 'meta_categories_pos' => true, 'meta_date_pos' => true, 'meta_author_pos' => true ) );


        //styling tab
        $this->start_controls_section(
            'section_general_style',
            [
                'label' => esc_html__( 'General Styles', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'content_element_color',
            [
                'label'     => esc_html__( 'Element Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .block-header .block-title span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'element_typography',
                'label'     => esc_html__( 'Element Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .block-header .block-title span',
            ]
        );

        $this->add_control(
            'element_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'content_date_color',
            [
                'label'     => esc_html__( 'Date Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-date' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'content_date_typography',
                'label'     => esc_html__( 'Date Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .blog-date',
            ]
        );

        $this->add_control(
            'date_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );
        $this->add_control(
            'content_author_color',
            [
                'label'     => esc_html__( 'Author Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-author' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'content_author_typography',
                'label'     => esc_html__( 'Author Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .blog-author',
            ]
        );

        $this->add_control(
            'author_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->start_controls_tabs(
            'category_tabs'
        );
            $this->start_controls_tab(
                'category_tab1',
                [
                    'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
                ]
            );

                $this->add_control(
                    'content_category_color',
                    [
                        'label'     => esc_html__( 'Category Color', 'ut-elementor-addons-lite' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .blog-category a' => 'color: {{VALUE}};',
                        ],
                    ]
                );
            $this->end_controls_tab();
            $this->start_controls_tab(
                'category_tab2',
                [
                    'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
                ]
            );
                $this->add_control(
                    'content_category_color_hover',
                    [
                        'label'     => esc_html__( 'Category Color hover', 'ut-elementor-addons-lite' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .blog-category a:hover' => 'color: {{VALUE}};',
                        ],
                    ]
                );
            $this->end_controls_tab();
        $this->end_controls_tabs();  

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'content_category_typography',
                'label'     => esc_html__( 'Category Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .blog-category',
            ]
        );   

        $this->add_control(
            'category_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );  

        $this->start_controls_tabs(
            'title_tabs'
        );
            $this->start_controls_tab(
                'title_tab1',
                [
                    'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
                ]
            );

                $this->add_control(
                    'content_title_color',
                    [
                        'label'     => esc_html__( 'Content Title Color', 'ut-elementor-addons-lite' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .blog-post-title a' => 'color: {{VALUE}};',
                        ],
                    ]
                );

            $this->end_controls_tab();
            $this->start_controls_tab(
                'title_tab2',
                [
                    'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
                ]
            );

            //element title
            $this->add_control(
                'content_title_color_hover',
                [
                    'label'     => esc_html__( 'Content Title Color: Hover', 'ut-elementor-addons-lite' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .blog-post-title a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'content_title_typography',
                'label'     => esc_html__( 'Content Title Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .blog-post-title',
            ]
        );

        $this->add_control(
            'title_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'content_description_color',
            [
                'label'     => esc_html__( 'Content Description Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .content-excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'content_excerpt_typography',
                'label'     => esc_html__( 'Content Description Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .content-excerpt',
            ]
        );

        $this->add_control(
            'desc_divider',
            [
                'type' => Controls_Manager::DIVIDER,
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
                        '{{WRAPPER}} .blog-content' => 'padding-left: {{SIZE}}{{UNIT}};',
                    ],
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
                        '{{WRAPPER}} .utal-blog-list-wrapper' => 'margin-left: -{{SIZE}}{{UNIT}}; margin-right: -{{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .blog-post-wrap' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'row_gap',
                [
                    'label' => esc_html__( 'Rows Gap', 'ut-elementor-addons-lite' ),
                    'type' => Controls_Manager::SLIDER,
                    'desktop_default' => [
                        'size' => 30,
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
                    'frontend_available' => true,
                    'selectors' => [
                        '{{WRAPPER}} .blog-post-wrap' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'post_divider',
                [
                    'label'             => esc_html__( 'Divider', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::SWITCHER,
                    'default'           => '',
                    'label_on'          => esc_html__( 'Show', 'ut-elementor-addons-lite' ),
                    'label_off'         => esc_html__( 'Hide', 'ut-elementor-addons-lite' ),
                    'return_value'      => 'yes',                
                ]
            ); 
        $this->add_control(
            'post_divider_style',
            [
                'label' => esc_html__( 'Style', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'solid' => esc_html__( 'Solid', 'elementor' ),
                    'double' => esc_html__( 'Double', 'elementor' ),
                    'dotted' => esc_html__( 'Dotted', 'elementor' ),
                    'dashed' => esc_html__( 'Dashed', 'elementor' ),
                    'groove' => esc_html__( 'Groove', 'elementor' ),
                ],
                'default' => 'solid',
                'selectors' => [
                    '{{WRAPPER}} .utal-blog-list-wrapper .post-divider' => 'border-top-style: {{VALUE}}',
                ],
                'condition' => [
                    'post_divider' => 'yes',
                ],
            ]
        );
            $this->add_control(
                'post_divider_color',
                [
                    'label' => esc_html__( 'Color', 'elementor' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#000',
                    'selectors' => [
                        '{{WRAPPER}} .utal-blog-list-wrapper .post-divider' => 'border-top-color: {{VALUE}}',
                    ],
                    'condition' => [
                        'post_divider' => 'yes',
                    ],
                ]
            );
            $this->add_control(
                'post_divider_weight',
                [
                    'label' => esc_html__( 'Divider Weight', 'ut-elementor-addons-lite' ),
                    'type' => Controls_Manager::SLIDER,
                    'default' => [
                        'size' => 1,
                    ],
                    'range' => [
                        'px' => [
                            'min' => 1,
                            'max' => 10,
                            'step' => 0.1,
                        ],
                    ],
                    'render_type' => 'template',
                    'condition' => [
                        'post_divider' => 'yes',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .utal-blog-list-wrapper .post-divider' => 'border-top-width: {{SIZE}}{{UNIT}}',
                    ],
                ]
            );

            $this->add_responsive_control(
                'post_divider_width',
                [
                    'label' => esc_html__( 'Divider Width', 'ut-elementor-addons-lite' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ '%', 'px' ],
                    'range' => [
                        'px' => [
                            'max' => 1000,
                        ],
                    ],
                    'desktop_default' => [
                        'size' => 100,
                        'unit' => '%',
                    ],
                    'tablet_default' => [
                        'unit' => '%',
                    ],
                    'mobile_default' => [
                        'unit' => '%',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .utal-blog-list-wrapper .post-divider' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                    'condition' => [
                        'post_divider' => 'yes',
                    ],
                ]
            );
        $this->add_responsive_control(
            'divider_gap',
            [
                'label' => esc_html__( 'Divider Gap', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 15,
                ],
                'range' => [
                    'px' => [
                        'min' => 2,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .utal-blog-list-wrapper .post-divider' => 'margin-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'post_divider' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'readmore_button_styles',
            [
                'label' => esc_html__( 'Button Styles', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'content_readmore_show' => 'yes'
                ]
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
                    'content_button_color',
                    [
                        'label'     => esc_html__( 'Button Text Color', 'ut-elementor-addons-lite' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .blog-readmore' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'content_button_bg_color',
                    [
                        'label'     => esc_html__( 'Button Background Color', 'ut-elementor-addons-lite' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .blog-readmore' => 'background-color: {{VALUE}};',
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
                            '{{WRAPPER}} .utal-blog-list-wrapper .blog-content a.blog-readmore' => 'border-style: {{VALUE}}',
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
                            '{{WRAPPER}} .blog-content a.blog-readmore' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                            '{{WRAPPER}} .blog-readmore' => 'border-color: {{VALUE}};',
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
                            '{{WRAPPER}} .blog-content a.blog-readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        'selector' => '{{WRAPPER}} .blog-content a.blog-readmore',
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
                    'content_button_color_hover',
                    [
                        'label'     => esc_html__( 'Button Text Color: Hover', 'ut-elementor-addons-lite' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .blog-readmore:hover' => 'color: {{VALUE}};border-color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'content_button_bg_color_hover',
                    [
                        'label'     => esc_html__( 'Button Background Color: Hover', 'ut-elementor-addons-lite' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .blog-readmore:hover' => 'background-color: {{VALUE}};',
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
                            '{{WRAPPER}} .utal-blog-list-wrapper .blog-content a.blog-readmore:hover' => 'border-style: {{VALUE}}',
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
                            '{{WRAPPER}} .blog-content a.blog-readmore:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                            '{{WRAPPER}} .blog-readmore:hover' => 'border-color: {{VALUE}};',
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
                            '{{WRAPPER}} .blog-content a.blog-readmore:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        'selector' => '{{WRAPPER}} .blog-content a.blog-readmore:hover',
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
                'name'      => 'content_button_typography',
                'label'     => esc_html__( 'Button Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .blog-readmore',
            ]
        );
        $this->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .blog-content a.blog-readmore' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .blog-content a.blog-readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $this->start_controls_section(
            'viewall_button_styles',
            [
                'label' => esc_html__( 'View All Button', 'ut-elementor-addons-lite' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'content_readmore_show' => 'yes'
                ]
            ]
        );
        $this->start_controls_tabs(
            'viewall_tabs'
        );
            $this->start_controls_tab(
                'viewall_tab1',
                [
                    'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
                ]
            );

                $this->add_control(
                    'viewall_color',
                    [
                        'label'     => esc_html__( 'Button Text Color', 'ut-elementor-addons-lite' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .viewall-button a' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'viewall_bg_color',
                    [
                        'label'     => esc_html__( 'Button Background Color', 'ut-elementor-addons-lite' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .viewall-button a' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'viewall_border',
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
                            '{{WRAPPER}} .viewall-button a' => 'border-style: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'viewall_border_width',
                    [
                        'label' => esc_html__( 'Border Width', 'ut-elementor-addons-lite' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .viewall-button a' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'viewall_border_color',
                    [
                        'label'     => esc_html__( 'Button Border Color', 'ut-elementor-addons-lite' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .viewall-button a' => 'border-color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'viewall_border_radius',
                    [
                        'label' => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .viewall-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        'name' => 'viewall_box_shadow',
                        'label' => esc_html__( 'Box Shadow', 'ut-elementor-addons-lite' ),
                        'selector' => '{{WRAPPER}} .viewall-button a',
                    ]
                );

            $this->end_controls_tab();
            $this->start_controls_tab(
                'viewall_tab2',
                [
                    'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
                ]
            );

                $this->add_control(
                    'viewall_color_hover',
                    [
                        'label'     => esc_html__( 'Button Text Color: Hover', 'ut-elementor-addons-lite' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .viewall-button a:hover' => 'color: {{VALUE}};border-color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'viewall_bg_color_hover',
                    [
                        'label'     => esc_html__( 'Button Background Color: Hover', 'ut-elementor-addons-lite' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .viewall-button a:hover' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'viewall_border_hover',
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
                            '{{WRAPPER}} .viewall-button a:hover' => 'border-style: {{VALUE}}',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'viewall_border_width_hover',
                    [
                        'label' => esc_html__( 'Border Width', 'ut-elementor-addons-lite' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .viewall-button a:hover' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    'viewall_border_color_hover',
                    [
                        'label'     => esc_html__( 'Button Border Color', 'ut-elementor-addons-lite' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .viewall-button a:hover' => 'border-color: {{VALUE}};',
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'viewall_border_radius_hover',
                    [
                        'label' => esc_html__( 'Border Radius', 'ut-elementor-addons-lite' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .viewall-button a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                        'name' => 'viewall_box_shadow_hover',
                        'label' => esc_html__( 'Box Shadow', 'ut-elementor-addons-lite' ),
                        'selector' => '{{WRAPPER}} .viewall-button a:hover',
                    ]
                );


            $this->end_controls_tab();

        $this->end_controls_tabs();
        $this->add_control(
            'viewall_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'viewall_typography',
                'label'     => esc_html__( 'Button Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .viewall-button a',
            ]
        );
        $this->add_responsive_control(
            'viewall_margin',
            [
                'label' => esc_html__( 'Margin', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .viewall-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
            'viewall_padding',
            [
                'label' => esc_html__( 'Padding', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .viewall-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

	protected function render() {
        $settings = $this->get_settings();

        $this->add_render_attribute( 'utal-blog-list', 'class', 'utal-blog-list' );
        /* Reset all actions in hook before starting*/
        remove_all_actions('utal_pos_top');
        remove_all_actions('utal_pos_middle');
        remove_all_actions('utal_pos_bottom');
        $date = isset( $settings[ 'meta_date' ] )? $settings[ 'meta_date' ] : '';
        $author = isset( $settings[ 'meta_author' ] )? $settings[ 'meta_author' ] : '';
        $categories = isset( $settings[ 'meta_categories' ] )? $settings[ 'meta_categories' ] : '';
        $date_pos = isset( $settings[ 'meta_date_pos' ] )? $settings[ 'meta_date_pos' ] : '';
        $author_pos = isset( $settings[ 'meta_author_pos' ] )? $settings[ 'meta_author_pos' ] : '';
        $categories_pos = isset( $settings[ 'meta_categories_pos' ] )? $settings[ 'meta_categories_pos' ] : 'top';
        $date ? add_action( 'utal_pos_'. $date_pos, 'ut_elementor_addons_lite_post_date' ) : 'middle'; // Check date and add function to hook in action ( utal_pos_top, utal_pos_middle, utal_pos_bottom )
        $author ? add_action( 'utal_pos_'. $author_pos, 'ut_elementor_addons_lite_post_author' ) : 'middle';// Check author and add function to hook in action ( utal_pos_top, utal_pos_middle, utal_pos_bottom )
        $categories ? add_action( 'utal_pos_'. $categories_pos, 'ut_elementor_addons_lite_post_categories' ) : '';// Check categories and add function to hook in action ( utal_pos_top, utal_pos_middle, utal_pos_bottom )
        $showposts = isset( $settings[ 'showposts' ] )? $settings[ 'showposts' ] : '';
        $title_show = isset( $settings[ 'content_title_show' ] )? $settings[ 'content_title_show' ] : 'yes';
        $title_tag = isset( $settings[ 'content_title_tag' ] )? $settings[ 'content_title_tag' ] : 'h4';
        $readmore_show = isset( $settings[ 'content_readmore_show' ] )? $settings[ 'content_readmore_show' ] : 'yes';
        $excerpt_show = isset( $settings[ 'content_excerpts_show' ] )? $settings[ 'content_excerpts_show' ] : 'yes';
        $excerpt = isset( $settings[ 'content_excerpts' ] )? $settings[ 'content_excerpts' ] : 200;
        $readmore = isset( $settings[ 'readmore' ] )? $settings[ 'readmore' ] : esc_html__('Read More', 'ut-elementor-addons-lite');
        $block_args = ut_elementor_addons_lite_query($settings,$first_id='', $showposts );
        $query = new \WP_Query( $block_args );
        $fallback_image = isset( $settings[ 'fallback_image' ] )? $settings[ 'fallback_image' ] : '';
        $post_divider = isset( $settings[ 'post_divider' ] )? $settings[ 'post_divider' ] : '';

        $this->add_render_attribute( 'utal-blog-list', 'class', 'utal' );
        ?>
        <div <?php echo $this->get_render_attribute_string( 'utal-blog-list' ); ?>>
                <?php 
                if( !empty($settings['element_title']) ):?>
                    <div class="block-header">
                        <h4 class="block-title">
                            <span class="title-span"><?php echo esc_html($settings['element_title']);?></span>
                        </h4>
                    </div>
                <?php
                endif;?>
            <div class="utal-blog-list-wrapper">
                <?php 
                if ( $query->have_posts() ):
                    while ( $query->have_posts() ): $query->the_post();
                        ?>
                        <div class="blog-post-wrap">
                            <div class="blog-image">                                    
                                <?php
                                $img_src    = '';
                                if ( has_post_thumbnail() ) {
                                    $img_src    = Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id(), 'image_size', $settings );
                                    echo '<a href="'. esc_url(get_the_permalink()).'"><img src="'.esc_url( $img_src ) .'" alt="'. esc_attr( get_the_title() ).'"></a>';
                                }
                                elseif (!empty($fallback_image['id'])) { 
                                    $img_src    = Group_Control_Image_Size::get_attachment_image_src( $fallback_image['id'], 'image_size', $settings );
                                    echo '<a href="'. esc_url(get_the_permalink()).'"><img src="'.esc_url( $img_src ) .'" alt="'. esc_attr( get_the_title() ).'"></a>';
                                }?>
                            </div>
                            <div class="blog-content">
                                <?php  
                                do_action( 'utal_pos_top'); // trigger utal_pos_top to display post meta
                                ($title_show) ? the_title('<'. $title_tag .'  class="blog-post-title"><a href="'. esc_url(get_the_permalink()).'">', '</a></'. $title_tag .' >') : ''; 
                                do_action( 'utal_pos_middle'); // trigger utal_pos_top to display post meta
                                if( $excerpt_show == 'yes' ){
                                    echo ut_elementor_addons_lite_letter_count( get_the_excerpt(), $excerpt );
                                }         
                                if(!empty($readmore) && ($readmore_show == 'yes')){
                                    echo '<div class="utal-readmore"><a class="blog-readmore" href="' . esc_url(get_the_permalink()) . '">'. esc_html( $readmore ) . '</a></div>';
                                }
                                do_action( 'utal_pos_bottom'); // trigger utal_pos_top to display post meta
                                ?>
                            </div>
                        </div>
                        <?php 
                        if($post_divider){
                            echo '<div class="post-divider"></div>';
                        }
                    endwhile;
                    wp_reset_postdata();         
                    if(!empty($settings['viewall_button']) ){                        
                        $target = isset($settings['viewall_button_link']['is_external']) ? ' target="_blank"' : '';
                        $nofollow = isset($settings['viewall_button_link']['nofollow']) ? ' rel="nofollow"' : '';
                        $url = isset($settings['viewall_button_link']['url']) ? $settings['viewall_button_link']['url'] : '';
                        echo '<div class="viewall-button"><a href="' . esc_url($url) . '"' . $target . $nofollow . '>' . $settings['viewall_button'] . ' </a></div></div></div>';
                    }
                endif;                
                ?>
            </div>
        </div><!-- element main wrapper -->
	<?php 	

	}  
}
Plugin::instance()->widgets_manager->register_widget_type( new UT_Elementor_Addons_Lite_Widget_Blog_List() );