<?php
namespace Elementor;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class UT_Elementor_Addons_Lite_Widget_Search extends Widget_Base {

	public function get_name() {
		return 'utal-search';
	}

	public function get_title() {
		return __( 'Search', 'ut-elementor-addons-lite' );
	}

	public function get_icon() {
		return 'eicon-search';
	}

	public function get_categories() {
		return [ 'ut-elementor-addons-lite' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Search', 'ut-elementor-addons-lite' ),
			]
		);

        $this->add_control(
            'placeholder', [
                'label' => esc_html__( 'Placeholder', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Search ...',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'button_text', [
                'label' => esc_html__( 'Button Text', 'ut-elementor-addons-lite' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Search',
                'label_block' => true,
            ]
        );

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'ut-elementor-addons-lite' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'ut-elementor-addons-lite' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ut-elementor-addons-lite' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ut-elementor-addons-lite' ),
						'icon' => 'fa fa-align-right',
					]
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-search-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label'     => esc_html__( 'Button Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-search-icon .search-submit' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'button_hover_color',
            [
                'label'     => esc_html__( 'Hover Color', 'ut-elementor-addons-lite' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .utal-search-icon .search-submit:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

		$this->end_controls_section();


	}

	protected function render() {

		$settings = $this->get_settings();
		$placeholder = $settings['placeholder'];
		$button_text = $settings['button_text'];
		?>
		<div class="utal-search-icon utal">
		<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
			 viewBox="0 0 512 512" xml:space="preserve">
				<path d="M508.875,493.792L353.089,338.005c32.358-35.927,52.245-83.296,52.245-135.339C405.333,90.917,314.417,0,202.667,0
					S0,90.917,0,202.667s90.917,202.667,202.667,202.667c52.043,0,99.411-19.887,135.339-52.245l155.786,155.786
					c2.083,2.083,4.813,3.125,7.542,3.125c2.729,0,5.458-1.042,7.542-3.125C513.042,504.708,513.042,497.958,508.875,493.792z
					 M202.667,384c-99.979,0-181.333-81.344-181.333-181.333S102.688,21.333,202.667,21.333S384,102.677,384,202.667
					S302.646,384,202.667,384z"/>
		</svg>
		<div class="utal-search-container">
			<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<label>
					<span class="screen-reader-text"><?php echo esc_html__('Search for:','ut-elementor-addons-lite'); ?></span>
					<input type="search" class="search-field" placeholder="<?php echo esc_attr($placeholder)?>" value="" name="s">
				</label>
				<input type="submit" class="search-submit" value="<?php echo esc_attr($button_text)?>">
			</form>
		</div>
		</div>
		<?php
	}



}

Plugin::instance()->widgets_manager->register_widget_type( new UT_Elementor_Addons_Lite_Widget_Search() );
