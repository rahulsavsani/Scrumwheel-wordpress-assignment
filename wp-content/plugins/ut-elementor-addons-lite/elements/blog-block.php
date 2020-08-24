<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class UT_Elementor_Addons_Lite_Widget_Blog_Block extends Widget_Base {

    use \Elementor\UT_Elementor_Addons_Lite_Queries;

    public function get_name() {
        return 'utal-blog-block';
    }

    public function get_title() {
        return  esc_html__( 'Post Block', 'ut-elementor-addons-lite' );
    }

    public function get_icon() {
        return 'eicon-posts-group';
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
        $this->add_control(
            'main_post_pos',
            array(
                'label'       => esc_html__( 'Main Post Position', 'ut-elementor-addons-lite' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => true,
                'default'       =>  'utal-left',
                'options'      => array(
                    'utal-left'   => esc_html__('Left','ut-elementor-addons-lite'),
                    'utal-right'   => esc_html__('Right','ut-elementor-addons-lite'),
                ),
            )
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'              => 'primary_image_size',
                'label'             => esc_html__( 'Primary Image Size', 'ut-elementor-addons-lite' ),
                'default'           => 'full',
                
            ]
        );


        $this->add_responsive_control(
            'item_ratio',
            [
                'label' => esc_html__( 'Image Ratio', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'desktop_default' => [
                    'size' => 0.66,
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
                    '{{WRAPPER}} .utal-blog-left .blog-image' => 'padding-bottom: calc( {{SIZE}} * 100% );',
                    '{{WRAPPER}} .utal-blog-left .utal-blog-block-wrapper:after' => 'content: "{{SIZE}}"; position: absolute; color: transparent;',
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
                    'px' => [
                        'min' => 10,
                        'max' => 600,
                    ],
                ],
                'desktop_default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .utal-blog-left .blog-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'post_style',
            array(
                'label'       => esc_html__( 'Secondary Post Layout', 'ut-elementor-addons-lite' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => true,
                'default'       =>  'grid',
                'options'      => array(
                    'grid'   => esc_html__('Grid','ut-elementor-addons-lite'),
                    'list'   => esc_html__('List','ut-elementor-addons-lite'),
                ),
            )
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'              => 'secondary_image_size',
                'label'             => esc_html__( 'Secondary Image Size', 'ut-elementor-addons-lite' ),
                'default'           => 'full',
            ]
        );

        $this->add_responsive_control(
            'seconday_item_ratio',
            [
                'label' => esc_html__( 'Secondary Image Ratio', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'desktop_default' => [
                    'size' => 0.66,
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
                    '{{WRAPPER}} .utal-blog-default .blog-image' => 'padding-bottom: calc( {{SIZE}} * 100% );',
                    '{{WRAPPER}} .utal-blog-default .utal-blog-block-wrapper:after' => 'content: "{{SIZE}}"; position: absolute; color: transparent;',
                ],
            ]
        );

        $this->add_responsive_control(
            'seconday_image_width',
            [
                'label' => esc_html__( 'Secondary Image Width', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 10,
                        'max' => 600,
                    ],
                ],
                'desktop_default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'size' => '',
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'size_units' => [ '%', 'px' ],
                'selectors' => [
                    '{{WRAPPER}} .utal-blog-default .blog-image' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'fallback_image',
            array(
                'label'       => esc_html__( 'Fallback Image', 'ut-elementor-addons-lite' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
            )
        );
        
        $this->end_controls_section();

        //$this->query_controls();
        $this->start_controls_section(
            'section_post_query',
            [
                'label'             => esc_html__( 'Query', 'ut-elementor-addons-lite' ),
            ]
        );

        $this->add_control(
            'categories',
            [
                'label'             => esc_html__( 'Categories', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::SELECT2,
                'label_block'       => true,
                'multiple'          => true,
                'options'           => ut_elementor_addons_lite_get_post_categories(),

            ]
        );

        $this->add_control(
            'authors',
            [
                'label'             => esc_html__( 'Authors', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::SELECT2,
                'label_block'       => true,
                'multiple'          => true,
                'options'           => ut_elementor_addons_lite_get_authors(),
            ]
        );

        $this->add_control(
            'tags',
            [
                'label'             => esc_html__( 'Tags', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::SELECT2,
                'label_block'       => true,
                'multiple'          => true,
                'options'           => ut_elementor_addons_lite_get_tags(),
            ]
        );

        $this->add_control(
            'exclude_posts',
            [
                'label'             => esc_html__( 'Exclude Posts', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::SELECT2,
                'label_block'       => true,
                'multiple'          => true,
                'options'           => ut_elementor_addons_lite_get_posts(),
            ]
        );

        $this->add_control(
            'order',
            [
                'label'             => esc_html__( 'Order', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::SELECT,
                'options'           => [
                   'DESC'           => esc_html__( 'Descending', 'ut-elementor-addons-lite' ),
                   'ASC'       => esc_html__( 'Ascending', 'ut-elementor-addons-lite' ),
                ],
                'default'           => 'DESC',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label'             => esc_html__( 'Order By', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::SELECT,
                'options'           => ut_elementor_addons_lite_get_post_orderby(),
                'default'           => 'date',
            ]
        );

        $this->add_control(
            'offset',
            [
                'label'             => esc_html__( 'Offset', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::NUMBER,
                'default'           => '',
            ]
        );

        $this->add_control(
            'showposts',
            [
                'label'             => esc_html__( 'No. of Post', 'ut-elementor-addons-lite' ),
                'type'              => Controls_Manager::NUMBER,
                'default'           => 5,
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => esc_html__( 'Post Content', 'ut-elementor-addons-lite' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->start_controls_tabs(
            'post_content_tab1'
        );

        $this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Main Post', 'ut-elementor-addons-lite' ),
            ]
        );
            $this->add_control(
                'content_title_show',
                [
                    'label'             => esc_html__( 'Post Title', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::SWITCHER,
                    'default'           => 'yes',
                    'label_on'          => esc_html__( 'Show', 'ut-elementor-addons-lite' ),
                    'label_off'         => esc_html__( 'Hide', 'ut-elementor-addons-lite' ),
                    'return_value'      => 'yes',
                ]
            );

            $this->add_control(
                'content_title_tag',
                array(
                    'label'       => esc_html__( 'Post Title Tag', 'ut-elementor-addons-lite' ),
                    'desc'       => esc_html__( 'Choose heading tag for Post title.', 'ut-elementor-addons-lite' ),
                    'type'        => Controls_Manager::SELECT,
                    'label_block' => true,
                    'default'       =>  'h3',
                    'options'      => array(
                        'h1'   => esc_html__('H1','ut-elementor-addons-lite'),
                        'h2'   => esc_html__('H2','ut-elementor-addons-lite'),
                        'h3'   => esc_html__('H3','ut-elementor-addons-lite'),
                        'h4'   => esc_html__('H4','ut-elementor-addons-lite'),
                        'h5'   => esc_html__('H5','ut-elementor-addons-lite'),
                        'h6'   => esc_html__('H6','ut-elementor-addons-lite'),
                    ),
                    'condition' => [
                        'content_title_show' => 'yes'
                    ],
                )
            );
            $this->add_control(
                'content_excerpts_show',
                [
                    'label'             => esc_html__( 'Excerpt', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::SWITCHER,
                    'default'           => 'yes',
                    'label_on'          => esc_html__( 'Show', 'ut-elementor-addons-lite' ),
                    'label_off'         => esc_html__( 'Hide', 'ut-elementor-addons-lite' ),
                    'return_value'      => 'yes',
                ]
            );
            $this->add_control(
                'content_excerpts',
                [
                    'label'             => esc_html__( 'Post Excerpt Length', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::NUMBER,
                    'default'           => '',
                    'description'       => esc_html__('Enter Length for contents in letters or leave blank to hide content','ut-elementor-addons-lite'),
                    'condition' => [
                        'content_excerpts_show' => 'yes'
                    ],
                ]
            );
            $this->add_control(
                'content_readmore_show',
                [
                    'label'             => esc_html__( 'Read More', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::SWITCHER,
                    'default'           => 'yes',
                    'label_on'          => esc_html__( 'Show', 'ut-elementor-addons-lite' ),
                    'label_off'         => esc_html__( 'Hide', 'ut-elementor-addons-lite' ),
                    'return_value'      => 'yes',
                ]
            );
            $this->add_control(
                'readmore',
                [
                    'label'             => esc_html__( 'Read More Text', 'ut-elementor-addons-lite' ),
                    'description'       => esc_html__( 'Enter text for Read More button or leave it blank to hide', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::TEXT,
                    'condition' => [
                        'content_readmore_show' => 'yes'
                    ],
                ]
            );

            $this->add_control(
                'meta_categories',
                [
                    'label'             => esc_html__( 'Show Categories', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::SWITCHER,
                    'default'           => 'yes',
                    'label_on'          => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                    'label_off'         => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                    'return_value'      => 'yes',
                ]
            );


            $this->add_control(
                'meta_categories_pos',
                array(
                    'label'       => esc_html__( 'Categories Position', 'ut-elementor-addons-lite' ),
                    'type'        => Controls_Manager::SELECT,
                    'label_block' => true,
                    'default'       =>  'top',
                    'options'      => array(
                        'top'   => esc_html__('Before Title','ut-elementor-addons-lite'),
                        'middle'   => esc_html__('After Title','ut-elementor-addons-lite'),
                        'bottom'   => esc_html__('After Content','ut-elementor-addons-lite'),
                    ),
                    'condition' => [
                        'meta_categories' => 'yes'
                    ],
                )
            );
        
            $this->add_control(
                'meta_date',
                [
                    'label'             => esc_html__( 'Show Date', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::SWITCHER,
                    'default'           => 'yes',
                    'label_on'          => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                    'label_off'         => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                    'return_value'      => 'yes',
                ]
            );
        
            $this->add_control(
                'meta_date_pos',
                array(
                    'label'       => esc_html__( 'Date Position', 'ut-elementor-addons-lite' ),
                    'type'        => Controls_Manager::SELECT,
                    'label_block' => true,
                    'default'       =>  'middle',
                    'options'      => array(
                        'top'   => esc_html__('Before Title','ut-elementor-addons-lite'),
                        'middle'   => esc_html__('After Title','ut-elementor-addons-lite'),
                        'bottom'   => esc_html__('After Content','ut-elementor-addons-lite'),
                    ),
                    'condition' => [
                        'meta_date' => 'yes'
                    ],
                )
            );
        
            $this->add_control(
                'meta_author',
                [
                    'label'             => esc_html__( 'Show Author', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::SWITCHER,
                    'default'           => 'yes',
                    'label_on'          => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                    'label_off'         => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                    'return_value'      => 'yes',
                ]
            );

            $this->add_control(
                'meta_author_pos',
                array(
                    'label'       => esc_html__( 'Author Position', 'ut-elementor-addons-lite' ),
                    'type'        => Controls_Manager::SELECT,
                    'label_block' => true,
                    'default'       =>  'middle',
                    'options'      => array(
                        'top'   => esc_html__('Before Title','ut-elementor-addons-lite'),
                        'middle'   => esc_html__('After Title','ut-elementor-addons-lite'),
                        'bottom'   => esc_html__('After Content','ut-elementor-addons-lite'),
                    ),
                    'condition' => [
                        'meta_author' => 'yes'
                    ],
                )
            );

        $this->end_controls_tab();;

        $this->start_controls_tab(
            'post_content_tab2',
            [
                'label' => esc_html__( 'Secondary Post', 'ut-elementor-addons-lite' ),
            ]
        );
                
            $this->add_control(
                'sec_content_title_show',
                [
                    'label'             => esc_html__( 'Secondary Post Title', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::SWITCHER,
                    'default'           => 'yes',
                    'label_on'          => esc_html__( 'Show', 'ut-elementor-addons-lite' ),
                    'label_off'         => esc_html__( 'Hide', 'ut-elementor-addons-lite' ),
                    'return_value'      => 'yes',
                ]
            );

            $this->add_control(
                'sec_content_title_tag',
                array(
                    'label'       => esc_html__( 'Secondary Post Title Tag', 'ut-elementor-addons-lite' ),
                    'desc'       => esc_html__( 'Choose heading tag for Post title.', 'ut-elementor-addons-lite' ),
                    'type'        => Controls_Manager::SELECT,
                    'label_block' => true,
                    'default'       =>  'h5',
                    'options'      => array(
                        'h1'   => esc_html__('H1','ut-elementor-addons-lite'),
                        'h2'   => esc_html__('H2','ut-elementor-addons-lite'),
                        'h3'   => esc_html__('H3','ut-elementor-addons-lite'),
                        'h4'   => esc_html__('H4','ut-elementor-addons-lite'),
                        'h5'   => esc_html__('H5','ut-elementor-addons-lite'),
                        'h6'   => esc_html__('H6','ut-elementor-addons-lite'),
                    ),
                    'condition' => [
                        'sec_content_title_show' => 'yes'
                    ],
                )
            );
            $this->add_control(
                'sec_content_excerpts_show',
                [
                    'label'             => esc_html__( 'Secondary Excerpt', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::SWITCHER,
                    'default'           => 'yes',
                    'label_on'          => esc_html__( 'Show', 'ut-elementor-addons-lite' ),
                    'label_off'         => esc_html__( 'Hide', 'ut-elementor-addons-lite' ),
                    'return_value'      => 'yes',
                ]
            );
            $this->add_control(
                'sec_content_excerpts',
                [
                    'label'             => esc_html__( 'Secondary Post Excerpt Length', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::NUMBER,
                    'default'           => '',
                    'description'       => esc_html__('Enter Length for contents in letters or leave blank to hide content','ut-elementor-addons-lite'),
                    'condition' => [
                        'sec_content_excerpts_show' => 'yes'
                    ],
                ]
            );
            $this->add_control(
                'sec_content_readmore_show',
                [
                    'label'             => esc_html__( 'Secondary Read More', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::SWITCHER,
                    'default'           => 'yes',
                    'label_on'          => esc_html__( 'Show', 'ut-elementor-addons-lite' ),
                    'label_off'         => esc_html__( 'Hide', 'ut-elementor-addons-lite' ),
                    'return_value'      => 'yes',
                ]
            );
            $this->add_control(
                'sec_readmore',
                [
                    'label'             => esc_html__( 'Secondary Read More Text', 'ut-elementor-addons-lite' ),
                    'description'       => esc_html__( 'Enter text for Read More button or leave it blank to hide', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::TEXT,
                    'condition' => [
                        'sec_content_readmore_show' => 'yes'
                    ],
                ]
            );
            $this->add_control(
                'sec_meta_categories',
                [
                    'label'             => esc_html__( 'Show Categories', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::SWITCHER,
                    'default'           => 'yes',
                    'label_on'          => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                    'label_off'         => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                    'return_value'      => 'yes',
                ]
            );


            $this->add_control(
                'sec_meta_categories_pos',
                array(
                    'label'       => esc_html__( 'Categories Position', 'ut-elementor-addons-lite' ),
                    'type'        => Controls_Manager::SELECT,
                    'label_block' => true,
                    'default'       =>  'top',
                    'options'      => array(
                        'top'   => esc_html__('Before Title','ut-elementor-addons-lite'),
                        'middle'   => esc_html__('After Title','ut-elementor-addons-lite'),
                        'bottom'   => esc_html__('After Content','ut-elementor-addons-lite'),
                    ),
                    'condition' => [
                        'sec_meta_categories' => 'yes'
                    ],
                )
            );
        
            $this->add_control(
                'sec_meta_date',
                [
                    'label'             => esc_html__( 'Show Date', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::SWITCHER,
                    'default'           => 'yes',
                    'label_on'          => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                    'label_off'         => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                    'return_value'      => 'yes',
                ]
            );
        
            $this->add_control(
                'sec_meta_date_pos',
                array(
                    'label'       => esc_html__( 'Date Position', 'ut-elementor-addons-lite' ),
                    'type'        => Controls_Manager::SELECT,
                    'label_block' => true,
                    'default'       =>  'middle',
                    'options'      => array(
                        'top'   => esc_html__('Before Title','ut-elementor-addons-lite'),
                        'middle'   => esc_html__('After Title','ut-elementor-addons-lite'),
                        'bottom'   => esc_html__('After Content','ut-elementor-addons-lite'),
                    ),
                    'condition' => [
                        'sec_meta_date' => 'yes'
                    ],
                )
            );
        
            $this->add_control(
                'sec_meta_author',
                [
                    'label'             => esc_html__( 'Show Author', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::SWITCHER,
                    'default'           => 'yes',
                    'label_on'          => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                    'label_off'         => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                    'return_value'      => 'yes',
                ]
            );

            $this->add_control(
                'sec_meta_author_pos',
                array(
                    'label'       => esc_html__( 'Author Position', 'ut-elementor-addons-lite' ),
                    'type'        => Controls_Manager::SELECT,
                    'label_block' => true,
                    'default'       =>  'middle',
                    'options'      => array(
                        'top'   => esc_html__('Before Title','ut-elementor-addons-lite'),
                        'middle'   => esc_html__('After Title','ut-elementor-addons-lite'),
                        'bottom'   => esc_html__('After Content','ut-elementor-addons-lite'),
                    ),
                    'condition' => [
                        'sec_meta_author' => 'yes'
                    ],
                )
            );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

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
                        'label'     => esc_html__( 'Main Post Title Color', 'ut-elementor-addons-lite' ),
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

            $this->add_control(
                'content_title_color_hover',
                [
                    'label'     => esc_html__( 'Main Post Title Color: Hover', 'ut-elementor-addons-lite' ),
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
                'label'     => esc_html__( 'Main Post Title Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .utal-blog-full .blog-post-title',
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
                'label'     => esc_html__( 'Main Post Excerpt Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-blog-full .content-excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'content_excerpt_typography',
                'label'     => esc_html__( 'Main Post Excerpt Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .utal-blog-full .content-excerpt',
            ]
        );

        $this->add_control(
            'desc_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->start_controls_tabs(
            'sec_title_tabs'
        );
            $this->start_controls_tab(
                'sec_title_tab1',
                [
                    'label' => esc_html__( 'Normal', 'ut-elementor-addons-lite' ),
                ]
            );

                $this->add_control(
                    'sec_content_title_color',
                    [
                        'label'     => esc_html__( 'Secondary Post Title Color', 'ut-elementor-addons-lite' ),
                        'type'      => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .utal-blog-default .blog-post-title a' => 'color: {{VALUE}};',
                        ],
                    ]
                );

            $this->end_controls_tab();
            $this->start_controls_tab(
                'sec_title_tab2',
                [
                    'label' => esc_html__( 'Hover', 'ut-elementor-addons-lite' ),
                ]
            );

            $this->add_control(
                'sec_content_title_color_hover',
                [
                    'label'     => esc_html__( 'Secondary Post Title Color: Hover', 'ut-elementor-addons-lite' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .utal-blog-default .blog-post-title a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'sec_content_title_typography',
                'label'     => esc_html__( 'Secondary Post Title Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .utal-blog-default .blog-post-title',
            ]
        );

        $this->add_control(
            'sec_title_divider',
            [
                'type' => Controls_Manager::DIVIDER,
            ]
        );

        $this->add_control(
            'sec_content_description_color',
            [
                'label'     => esc_html__( 'Secondary Post Excerpt Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-blog-default .content-excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'sec_content_excerpt_typography',
                'label'     => esc_html__( 'Secondary Post Excerpt Typography', 'ut-elementor-addons-lite' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .utal-blog-default .content-excerpt',
            ]
        );

        $this->add_control(
            'sec_desc_divider',
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
                        '{{WRAPPER}} .blog-image' => 'margin-bottom: {{SIZE}}{{UNIT}};',
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
                        '{{WRAPPER}} .blog-post-wrap' => 'padding-right: {{SIZE}}{{UNIT}}; padding-left: {{SIZE}}{{UNIT}}',
                        '{{WRAPPER}} .utal-blog-block-wrapper' => 'margin-left: -{{SIZE}}{{UNIT}}; margin-right: -{{SIZE}}{{UNIT}};',
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
                        '{{WRAPPER}} .blog-post-wrap' => 'padding-bottom: {{SIZE}}{{UNIT}};',
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
                            '{{WRAPPER}} .blog-content a.blog-readmore' => 'border-style: {{VALUE}}',
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
                            '{{WRAPPER}} .blog-content a.blog-readmore:hover' => 'border-style: {{VALUE}}',
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
    }

    protected function render() {
        $settings = $this->get_settings();

        $this->add_render_attribute( 'utal-blog-block', 'class', 'utal-blog-block' );
        $this->add_render_attribute( 'utal-blog-block', 'class', 'utal' );
        $showposts = isset( $settings[ 'showposts' ] )? $settings[ 'showposts' ] : 5;
        $fallback_image = isset( $settings[ 'fallback_image' ] )? $settings[ 'fallback_image' ] : '';
        $post_style = isset( $settings[ 'post_style' ] )? $settings[ 'post_style' ] : 'grid';
        $main_post_pos = isset( $settings[ 'main_post_pos' ] )? $settings[ 'main_post_pos' ] : 'utal-left';
        ?>
        <div <?php echo $this->get_render_attribute_string( 'utal-blog-block' ); ?>>
            <?php 
            if( !empty($settings['element_title']) ):?>
                <div class="block-header">
                    <h4 class="block-title">
                        <span class="title-span"><?php echo esc_html($settings['element_title']);?></span>
                    </h4>
                </div>
            <?php
            endif;?>
            <div class="utal-blog-block-wrapper modern-blog <?php echo esc_attr($post_style) . ' ' . esc_attr($main_post_pos) ;?>">
                <?php
                $block_args = ut_elementor_addons_lite_query($settings,$first_id='', $showposts );
                $query = new \WP_Query( $block_args );
                if ( $query->have_posts() ): ?>
                        <?php
                        $i = $j = 0;
                        while ( $query->have_posts() ): $query->the_post();
                            $i++;
                            $j++;
                            $img_size = 'secondary_image_size';                                
                            $title_show = isset( $settings[ 'sec_content_title_show' ] )? $settings[ 'sec_content_title_show' ] : 'yes';
                            $title_tag = isset( $settings[ 'sec_content_title_tag' ] )? $settings[ 'sec_content_title_tag' ] : 'h4';
                            $readmore_show = isset( $settings[ 'sec_content_readmore_show' ] )? $settings[ 'sec_content_readmore_show' ] : 'yes';
                            $excerpt_show = isset( $settings[ 'sec_content_excerpts_show' ] )? $settings[ 'sec_content_excerpts_show' ] : 'yes';
                            $excerpt = isset( $settings[ 'sec_content_excerpts' ] )? $settings[ 'sec_content_excerpts' ] : 200;
                            $readmore = isset( $settings[ 'sec_readmore' ] )? $settings[ 'sec_readmore' ] : esc_html__('Read More', 'ut-elementor-addons-lite');
                            $date = isset( $settings[ 'sec_meta_date' ] )? $settings[ 'sec_meta_date' ] : '';
                            $author = isset( $settings[ 'sec_meta_author' ] )? $settings[ 'sec_meta_author' ] : '';
                            $categories = isset( $settings[ 'sec_meta_categories' ] )? $settings[ 'sec_meta_categories' ] : '';
                            $date_pos = isset( $settings[ 'sec_meta_date_pos' ] )? $settings[ 'sec_meta_date_pos' ] : 'middle';
                            $author_pos = isset( $settings[ 'sec_meta_author_pos' ] )? $settings[ 'sec_meta_author_pos' ] : 'middle';
                            $categories_pos = isset( $settings[ 'sec_meta_categories_pos' ] )? $settings[ 'sec_meta_categories_pos' ] : 'top';
                            $date ? add_action( 'utal_pos_'. $date_pos, 'ut_elementor_addons_lite_post_date' ) : ''; // Check date and add function to hook in action ( utal_pos_top, utal_pos_middle, utal_pos_bottom )
                            $author ? add_action( 'utal_pos_'. $author_pos, 'ut_elementor_addons_lite_post_author' ) : '';// Check author and add function to hook in action ( utal_pos_top, utal_pos_middle, utal_pos_bottom )
                            $categories ? add_action( 'utal_pos_'. $categories_pos, 'ut_elementor_addons_lite_post_categories' ) : '';// Check categories and add function to hook in action ( utal_pos_top, utal_pos_middle, utal_pos_bottom )
                            if( $i == 1 ) {
                                echo '<div class="utal-blog-full">';
                                $img_size = 'primary_image_size';
                                $date = isset( $settings[ 'meta_date' ] )? $settings[ 'meta_date' ] : '';
                                $author = isset( $settings[ 'meta_author' ] )? $settings[ 'meta_author' ] : '';
                                $categories = isset( $settings[ 'meta_categories' ] )? $settings[ 'meta_categories' ] : '';
                                $date_pos = isset( $settings[ 'meta_date_pos' ] )? $settings[ 'meta_date_pos' ] : 'middle';
                                $author_pos = isset( $settings[ 'meta_author_pos' ] )? $settings[ 'meta_author_pos' ] : 'middle';
                                $categories_pos = isset( $settings[ 'meta_categories_pos' ] )? $settings[ 'meta_categories_pos' ] : 'top';
                                $date ? add_action( 'utal_pos_'. $date_pos, 'ut_elementor_addons_lite_post_date' ) : ''; // Check date and add function to hook in action ( utal_pos_top, utal_pos_middle, utal_pos_bottom )
                                $author ? add_action( 'utal_pos_'. $author_pos, 'ut_elementor_addons_lite_post_author' ) : '';// Check author and add function to hook in action ( utal_pos_top, utal_pos_middle, utal_pos_bottom )
                                $categories ? add_action( 'utal_pos_'. $categories_pos, 'ut_elementor_addons_lite_post_categories' ) : '';// Check categories and add function to hook in action ( utal_pos_top, utal_pos_middle, utal_pos_bottom )
                                $title_show = isset( $settings[ 'content_title_show' ] )? $settings[ 'content_title_show' ] : 'yes';
                                $title_tag = isset( $settings[ 'content_title_tag' ] )? $settings[ 'content_title_tag' ] : 'h4';
                                $readmore_show = isset( $settings[ 'content_readmore_show' ] )? $settings[ 'content_readmore_show' ] : 'yes';
                                $excerpt_show = isset( $settings[ 'content_excerpts_show' ] )? $settings[ 'content_excerpts_show' ] : 'yes';
                                $excerpt = isset( $settings[ 'content_excerpts' ] )? $settings[ 'content_excerpts' ] : 200;
                                $readmore = isset( $settings[ 'readmore' ] )? $settings[ 'readmore' ] : esc_html__('Read More', 'ut-elementor-addons-lite');

                            }
                            elseif ($i == 2) {
                                echo '<div class="utal-blog-default">';
                            }
                            ?>
                            <div class="blog-post-wrap">
                                <div class="blog-image">                                    
                                    <?php
                                    $img_src    = '';
                                    if ( has_post_thumbnail() ) {
                                        $img_src    = Group_Control_Image_Size::get_attachment_image_src( get_post_thumbnail_id(), $img_size, $settings );
                                        echo '<a href="'. esc_url(get_the_permalink()).'"><img src="'.esc_url( $img_src ) .'" alt="'. esc_attr( get_the_title() ).'"></a>';
                                    }
                                    elseif (!empty($fallback_image['id'])) { 
                                        $img_src    = Group_Control_Image_Size::get_attachment_image_src( $fallback_image['id'], $img_size, $settings );
                                        echo '<a href="'. esc_url(get_the_permalink()).'"><img src="'.esc_url( $img_src ) .'" alt="'. esc_attr( get_the_title() ).'"></a>';
                                    }?>
                                </div>
                                <div class="blog-content">
                                    <?php  
                                    do_action( 'utal_pos_top'); // trigger utal_pos_top to display post meta
                                    ($title_show) ? the_title('<'. $title_tag .'  class="blog-post-title"><a href="'. esc_url(get_the_permalink()).'">', '</a></'. $title_tag .' >') : ''; 
                                    do_action( 'utal_pos_middle'); // trigger utal_pos_middle to display post meta
                                    if( $excerpt_show == 'yes' ){
                                        echo ut_elementor_addons_lite_letter_count( get_the_excerpt(), $excerpt );
                                    }         
                                    if(!empty($readmore) && ($readmore_show == 'yes')){
                                        echo '<div class="utal-readmore"><a class="blog-readmore" href="' . esc_url(get_the_permalink()) . '">'. esc_html( $readmore ) . '</a></div>';
                                    }
                                    do_action( 'utal_pos_bottom'); // trigger utal_pos_bottom to display post meta
                                    ?>
                                </div>
                            </div>
                            <?php
                            remove_all_actions('utal_pos_top');
                            remove_all_actions('utal_pos_middle');
                            remove_all_actions('utal_pos_bottom');
                            if( $i == 1  || $showposts == $j || $i == 5 ) {
                                echo '</div>';
                            }
                            if( $i == 5 ){
                                $i = 0;
                            }
                        endwhile;
                        wp_reset_postdata();?>
                    </div>
                    <?php
                endif;
                ?>
            </div>
        </div><!-- element main wrapper -->
    <?php   

    }  
}
Plugin::instance()->widgets_manager->register_widget_type( new UT_Elementor_Addons_Lite_Widget_Blog_Block() );