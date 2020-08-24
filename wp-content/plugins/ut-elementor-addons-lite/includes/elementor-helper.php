<?php
namespace Elementor;

/*
* Grouping Control
*
*/
trait UT_Elementor_Addons_Lite_Queries {
    
    protected function query_controls( $args = array( 'control_section' => true,'post_type' => false, 'categories' => true, 'tags' => true, 'authors' => false, 'exclude_posts' => true, 'order' => true, 'orderby' => true, 'offset' => true, 'showposts' => true,  ) ){
        $control_section = isset($args['control_section']) ? $args['control_section'] : true;
        $categories = isset($args['categories']) ? $args['categories'] : true;
        $tags = isset($args['tags']) ? $args['tags'] : true;
        $authors = isset($args['authors']) ? $args['authors'] : true;
        $exclude_posts = isset($args['exclude_posts']) ? $args['exclude_posts'] : true;
        $order = isset($args['order']) ? $args['order'] : true;
        $offset = isset($args['offset']) ? $args['offset'] : true;
        $showposts = isset($args['showposts']) ? $args['showposts'] : true;
        $post_type = isset($args['post_type']) ? $args['post_type'] : false;
        $orderby = isset($args['orderby']) ? $args['orderby'] : true;
        
        /**
         * Content Tab: Query
         */

        if( $control_section ){
            $this->start_controls_section(
                'section_post_query',
                [
                    'label'             => esc_html__( 'Query', 'ut-elementor-addons-lite' ),
                ]
            );
        }
        if( $post_type ){
            $this->add_control(
                'post_type',
                [
                    'label'             => esc_html__( 'Post Type', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::SELECT,
                    'options'           => ut_elementor_addons_lite_get_post_types(),
                    'default'           => 'post',

                ]
            );        
        }

        if( $categories ){
            //post categories
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
        }

        if( $authors ){
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
        }

        if( $tags ){
            //post tags
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
        }
       

        if( $exclude_posts ){
            //get all posts
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
        }


        if( $order ){
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
        }

        if( $orderby ){
            $this->add_control(
                'orderby',
                [
                    'label'             => esc_html__( 'Order By', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::SELECT,
                    'options'           => ut_elementor_addons_lite_get_post_orderby(),
                    'default'           => 'date',
                ]
            );
        }

        if( $offset ){
            $this->add_control(
                'offset',
                [
                    'label'             => esc_html__( 'Offset', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::NUMBER,
                    'default'           => '',
                ]
            );
        }

        if( $showposts ){
            $this->add_control(
                'showposts',
                [
                    'label'             => esc_html__( 'No. of Post', 'ut-elementor-addons-lite' ),
                    'type'              => Controls_Manager::NUMBER,
                    'default'           => 4,
                ]
            );
        }
        if( $control_section ){
            $this->end_controls_section();
        }        

    }

    //excerpts
    protected function post_excerpts( $args = array( 'control_section' => true,'content_title_show' => true, 'content_title_tag' => true, 'content_excerpts_show' => true, 'content_excerpts' => true, 'content_readmore_show' => true, 'readmore' => true ) ){
        $control_section = isset($args['control_section']) ? $args['control_section'] : true;
        $content_title_show = isset($args['content_title_show']) ? $args['content_title_show'] : true;
        $content_title_tag = isset($args['content_title_tag']) ? $args['content_title_tag'] : true;
        $content_excerpts_show = isset($args['content_excerpts_show']) ? $args['content_excerpts_show'] : true;
        $content_excerpts = isset($args['content_excerpts']) ? $args['content_excerpts'] : true;
        $content_readmore_show = isset($args['content_readmore_show']) ? $args['content_readmore_show'] : true;
        $readmore = isset($args['readmore']) ? $args['readmore'] : false;

        /**
         * Content Tab: Post Excerpts
         */      
        
        if( $control_section ){
            $this->start_controls_section(
                'section_post_excerpts',
                [
                    'label'             => esc_html__( 'Post Content', 'ut-elementor-addons-lite' ),
                ]
            );
        }
        
        if( $content_title_show ){
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
        }
        if( $content_title_tag ){ 

            $this->add_control(
                'content_title_tag',
                array(
                    'label'       => esc_html__( 'Post Title Tag', 'ut-elementor-addons-lite' ),
                    'desc'       => esc_html__( 'Choose heading tag for Post title.', 'ut-elementor-addons-lite' ),
                    'type'        => Controls_Manager::SELECT,
                    'label_block' => true,
                    'default'       =>  'h4',
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
        }
        if($content_excerpts_show){
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
        }

        if( $content_excerpts ){
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
        }
        if($content_readmore_show){
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
        }

        if( $readmore ){
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
        }
        
        if( $control_section ){
            $this->end_controls_section();
        }

    }
    //Post Meta
    protected function post_meta( $args = array( 'control_section' => true,'meta_categories' => true, 'meta_date' => true, 'meta_author' => true,'meta_categories_pos' => false, 'meta_date_pos' => false, 'meta_author_pos' => false ) ){
        $control_section = isset($args['control_section']) ? $args['control_section'] : true;
        $meta_categories = isset($args['meta_categories']) ? $args['meta_categories'] : true;
        $meta_date = isset($args['meta_date']) ? $args['meta_date'] : true;
        $meta_author = isset($args['meta_author']) ? $args['meta_author'] : true;
        $meta_categories_pos = isset($args['meta_categories_pos']) ? $args['meta_categories_pos'] : false;
        $meta_date_pos = isset($args['meta_date_pos']) ? $args['meta_date_pos'] : false;
        $meta_author_pos = isset($args['meta_author_pos']) ? $args['meta_author_pos'] : false;

        /**
         * Content Tab: Post Excerpts
         */

        if( $control_section ){         
            $this->start_controls_section(
                'section_post_meta',
                [
                    'label'             => esc_html__( 'Post Meta', 'ut-elementor-addons-lite' ),
                ]
            );
        }

        if( $meta_categories ){            
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
        }

        
        if( $meta_date_pos ){ 

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
        }

        if( $meta_date ){            
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
        }

        if( $meta_date_pos ){ 
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
        }

        if( $meta_author ){            
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
        }
        if( $meta_date_pos ){ 

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
        }
        
        if( $control_section ){
            $this->end_controls_section();
        }

    }

    protected function slider_settings( $args = array( 'control_section' => true,'arrows' => false, 'dots' => true, 'dots_pos' => true,'slidesToShow' => true, 'infinite_loop' => true, 'pauseOnHover' => true, 'autoplay' => true, 'autoplay_speed' => true, 'swipe' => true ) ){

        $control_section = isset($args['control_section']) ? $args['control_section'] : true;        
        $arrows = isset($args['arrows']) ? $args['arrows'] : true;
        $dots = isset($args['dots']) ? $args['dots'] : true;
        $dots_pos = isset($args['dots_pos']) ? $args['dots_pos'] : true;
        $slidesToShow = isset($args['slidesToShow']) ? $args['slidesToShow'] : true;
        $infinite_loop = isset($args['infinite_loop']) ? $args['infinite_loop'] : true;
        $pauseOnHover = isset($args['pauseOnHover']) ? $args['pauseOnHover'] : true;
        $autoplay = isset($args['autoplay']) ? $args['autoplay'] : true;
        $autoplay_speed = isset($args['autoplay_speed']) ? $args['autoplay_speed'] : true;
        $swipe = isset($args['swipe']) ? $args['swipe'] : false;
        if( $control_section ){         
            $this->start_controls_section(
                'section_slider_setting',
                [
                    'label'             => esc_html__( 'Slider Settings', 'ut-elementor-addons-lite' ),
                ]
            );
        }
            if( $arrows ){ 
                $this->add_control(
                    'arrows',
                    [
                        'label'             => esc_html__( 'Arrows', 'ut-elementor-addons-lite' ),
                        'type'              => Controls_Manager::SWITCHER,
                        'default'           => 'no',
                        'label_on'          => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                        'label_off'         => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                        'return_value'      => 'yes',
                    ]
                );
            }
            if( $dots ){ 
                $this->add_control(
                    'dots',
                    [
                        'label'             => esc_html__( 'Dots', 'ut-elementor-addons-lite' ),
                        'type'              => Controls_Manager::SWITCHER,
                        'default'           => 'no',
                        'label_on'          => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                        'label_off'         => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                        'return_value'      => 'yes',
                    ]
                );
            }
            if( $dots_pos ){ 
                $this->add_control(
                    'dots_pos',
                    [
                        'label'             => esc_html__( 'Dots Position', 'ut-elementor-addons-lite' ),
                        'type'              => Controls_Manager::SELECT,
                        'default'           => 'inside-box',                        
                        'options'      => [
                            'inside-box' => esc_html__('Inside Slider', 'ut-elementor-addons-lite'),
                            'outside-box'=> esc_html__('Outside Slider', 'ut-elementor-addons-lite'),
                        ],
                        'condition'         => [
                            'dots'  => 'yes'
                        ]
                    ]
                );
            }
            if( $slidesToShow ){ 

                $this->add_responsive_control(
                    'slidesToShow',
                    [
                        'label' => esc_html__( 'Slides to Show', 'ut-elementor-addons-lite' ),
                        'type' => Controls_Manager::NUMBER,
                        'min' => 1,
                        'max' => 4,
                        'step' => 1,
                        'devices' => [ 'desktop', 'tablet', 'mobile' ],
                        'desktop_default' => 3,
                        'tablet_default' => 2,
                        'mobile_default' => 1,
                    ]
                );
            }
            if( $infinite_loop ){ 
                
                $this->add_control(
                    'infinite_loop',
                    [
                        'label'             => esc_html__( 'Infinite Loop', 'ut-elementor-addons-lite' ),
                        'type'              => Controls_Manager::SWITCHER,
                        'default'           => 'yes',
                        'label_on'          => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                        'label_off'         => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                        'return_value'      => 'yes',
                    ]
                );
            }
            if( $pauseOnHover ){ 
                
                $this->add_control(
                    'pauseOnHover',
                    [
                        'label'             => esc_html__( 'Pause on Hover', 'ut-elementor-addons-lite' ),
                        'type'              => Controls_Manager::SWITCHER,
                        'default'           => 'yes',
                        'label_on'          => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                        'label_off'         => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                        'return_value'      => 'yes',
                    ]
                );
            }
            if( $autoplay ){ 
                
                $this->add_control(
                    'autoplay',
                    [
                        'label'             => esc_html__( 'Autoplay', 'ut-elementor-addons-lite' ),
                        'type'              => Controls_Manager::SWITCHER,
                        'default'           => 'no',
                        'label_on'          => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                        'label_off'         => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                        'return_value'      => 'yes',
                    ]
                );
            }
            if( $autoplay_speed ){ 
                
                $this->add_control(
                    'autoplay_speed',
                    [
                        'label'             => esc_html__( 'Autoplay Speed', 'ut-elementor-addons-lite' ),
                        'type'              => Controls_Manager::NUMBER,
                        'default'           => '5000',
                    ]
                );
            }
            if( $swipe ){ 
                
                $this->add_control(
                    'swipe',
                    [
                        'label'             => esc_html__( 'Swipe', 'ut-elementor-addons-lite' ),
                        'type'              => Controls_Manager::SWITCHER,
                        'default'           => 'yes',
                        'label_on'          => esc_html__( 'Yes', 'ut-elementor-addons-lite' ),
                        'label_off'         => esc_html__( 'No', 'ut-elementor-addons-lite' ),
                        'return_value'      => 'yes',
                    ]
                ); 
            }  
        if( $control_section ){
            $this->end_controls_section();
        }
    }

}