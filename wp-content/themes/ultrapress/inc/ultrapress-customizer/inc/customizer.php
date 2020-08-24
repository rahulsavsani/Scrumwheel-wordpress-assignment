<?php
/**
* Customizer Setup and Custom Controls
*
* Adds the individual sections, settings, and controls to the theme customizer
*/
class Ultrapress_Initialise_Customizer_Settings {
 	// Get our default values
	private $defaults;
	public function __construct() {
 		// Get our Customizer defaults
		$this->defaults = ultrapress_generate_defaults();
 		// Register customizer Panel
		add_action( 'customize_register', array( $this, 'ultrapress_customizer_panels' ) );
 		// Register customizer sections
		add_action( 'customize_register', array( $this, 'ultrapress_customizer_sections' ) );
 		// Register Header Option Controls
		add_action( 'customize_register', array( $this, 'ultrapress_register_header_controls' ) );
 	 	// Register Typography Controls
		add_action( 'customize_register', array( $this, 'ultrapress_register_typography_controls' ) );
    	//Register Bread Banner Controls
		add_action( 'customize_register', array($this,'ultrapress_register_bread_banner_controls') );
    	//Register Page Option Controls
		add_action( 'customize_register', array($this,'ultrapress_register_page_settings_controls') );
    	//Register Archive Option Controls
		add_action( 'customize_register', array($this,'ultrapress_register_archive_settings_controls') );
 		// Register Footer Controls
		add_action( 'customize_register', array( $this, 'ultrapress_register_footer_settings_controls' ) );
 		// Register Theme Color Controls
		add_action( 'customize_register', array( $this, 'ultrapress_register_theme_color_controls' ) );
 		// Ultrapress Theme active callback
		add_action( 'customize_register', array( $this, 'ultrapress_registre_theme_active_callback' ) );
 		// Register woocommerce controls
		if (class_exists('woocommerce')) {
			add_action( 'customize_register', array( $this, 'ultrapress_woocommerce_controls' ) );
		}
	}
   	/**
 	 * Register the Customizer panels
 	 */
   	public function ultrapress_customizer_panels( $wp_customize ) {
 		/**
 		 * Add Ultrapress Theme Options Panel
 		 */
 		$wp_customize->add_panel( 'ultrapress_general_settings_panel',
 			array(
 				'title' => esc_html__( 'General', 'ultrapress' ),
 				'priority' =>1,
 			)
 		);
	    /**
	     * Header settings
	     */
	    $wp_customize->add_panel( 'ultrapress_header_panel',
	    	array(
	    		'title' => esc_html__( 'Header Settings', 'ultrapress' ),
	    		'priority' =>2,
	    	)
	    );
 		/**
 		 * Typography setting
 		 */
 		$wp_customize->add_panel( 'ultrapress_typography_panel',
 			array(
 				'title' => esc_html__( 'Typography', 'ultrapress' ),
 				'priority' =>3,
 			)
 		);
	    /**
	     * Breadcrumb Banner setting
	     */
	    $wp_customize->add_panel( 'ultrapress_breadcrumb_panel',
	    	array(
	    		'title' => esc_html__( 'Breadcrumb Banner', 'ultrapress' ),
	    		'priority' =>4,
	    	)
	    );
	    /**
	     * Page Settings
	     */
	    $wp_customize->add_panel( 'ultrapress_page_panel',
	    	array(
	    		'title' => esc_html__( 'Page Settings', 'ultrapress' ),
	    		'priority' =>5,
	    	)
	    );
	    /**
	     * Archive Settings
	     */
	    $wp_customize->add_panel( 'ultrapress_archive_panel',
	    	array(
	    		'title' => esc_html__( 'Archive Settings', 'ultrapress' ),
	    		'priority' =>6,
	    	)
	    );
	    /**
	     * Shop Settings
	     */
	    $wp_customize->add_panel( 'ultrapress_shop_panel',
	    	array(
	    		'title' => esc_html__( 'Shop Settings', 'ultrapress' ),
	    		'priority' =>7,
	    	)
	    );
 		/**
 		 * Footer Settings
 		 */
 		$wp_customize->add_panel( 'ultrapress_footer_panel',
 			array(
 				'title' => esc_html__( 'Footer Settings', 'ultrapress' ),
 				'priority' =>8,
 			)
 		);
 	}
   	/**
 	 * Register the Customizer sections
 	 */
   	public function ultrapress_customizer_sections( $wp_customize ) {
/*		$wp_customize->add_section( new Ultrapress_Upsell_Section( $wp_customize, 'ultrapress_upsell_section',
			array(
				'title' => __( 'Premium Addons Available', 'ultrapress' ),
				'url' => 'https://ultrapress.com',
				'backgroundcolor' => '#344860',
				'textcolor' => '#fff',
				'priority' => 0,
			)
		) );*/
		$wp_customize->add_section( new Ultrapress_Upsell_Section( $wp_customize, 'ultrapress_doc_section',
			array(
				'title' => __( 'View Documentation', 'ultrapress' ),
				'url' => '#',
				'backgroundcolor' => '#91da54',
				'textcolor' => '#000',
				'priority' => 200,
			)
		) );
 		/**
 		 * Body Style section
 		 */
 		$wp_customize->add_section( 'body_style',
 			array(
 				'title' => esc_html__( 'Body Style', 'ultrapress' ),
 				'panel' => 'ultrapress_typography_panel'
 			)
 		);
   		/**
 		 * Heading section
 		 */
   		$wp_customize->add_section( 'ultrapress_heading_style',
   			array(
   				'title' => esc_html__( 'Heading Style', 'ultrapress' ),
   				'panel' => 'ultrapress_typography_panel'
   			)
   		);
 		/**
 		 * Header Layout Section
 		 */
 		$wp_customize->add_section('header_customizer_setting',
 			array(
 				'title' 	  => esc_html__('Header Layouts' , 'ultrapress'),
 				'priority' => 6,
 				'panel'   => 'ultrapress_header_panel'
 			)
 		);
 		/**
 		 * Header Style Section
 		 */
 		$wp_customize->add_section('ultrapress_header_styles',
 			array(
 				'title' 	  => esc_html__('Header Styles' , 'ultrapress'),
 				'priority' => 6,
 				'panel'   => 'ultrapress_header_panel'
 			)
 		);
	    /**
	     * Breadcrumb Banner Section
	     */
	    $wp_customize->add_section('ultrapress_breadcrumb_banner_section',
	    	array(
	    		'title'     => esc_html__('Banner Settings' , 'ultrapress'),
	    		'panel'     => 'ultrapress_breadcrumb_panel'
	    	)
	    );
	    /**
	     * Breadcrumb Settings Section
	     */
	    $wp_customize->add_section('ultrapress_breadcrumb_section',
	    	array(
	    		'title'     => esc_html__('Breadcrumb Settings' , 'ultrapress'),
	    		'panel'     => 'ultrapress_breadcrumb_panel'
	    	)
	    );
	    /**
	     * Page Settings Section
	     */
	    $wp_customize->add_section('ultrapress_page_setting_section',
	    	array(
	    		'title'     => esc_html__('Page Contents' , 'ultrapress'),
	    		'panel'     => 'ultrapress_page_panel'
	    	)
	    ); 
	    /**
	     * Page Sidebar Settings Section
	     */
	    $wp_customize->add_section('ultrapress_page_sidebar_section',
	    	array(
	    		'title'     => esc_html__('Sidebar Settings' , 'ultrapress'),
	    		'panel'     => 'ultrapress_page_panel'
	    	)
	    ); 
	    /**
	     * Blog Page Settings Section
	     */
	    $wp_customize->add_section('ultrapress_blog_page_section',
	    	array(
	    		'title'     => esc_html__('Blog Settings' , 'ultrapress'),
	    		'panel'     => 'ultrapress_archive_panel'
	    	)
	    ); 
	    /**
	     * Blog Single Post Settings Section
	     */
	    $wp_customize->add_section('ultrapress_single_post_section',
	    	array(
	    		'title'     => esc_html__('Single Post Settings' , 'ultrapress'),
	    		'panel'     => 'ultrapress_archive_panel'
	    	)
	    ); 
	    /**
	     * Archive Sidebar Settings Section
	     */
	    $wp_customize->add_section('ultrapress_archive_sidebar_section',
	    	array(
	    		'title'     => esc_html__('Sidebar Settings' , 'ultrapress'),
	    		'panel'     => 'ultrapress_archive_panel'
	    	)
	    ); 
	    /**
	     * Meta Reorder Section
	     */
	    $wp_customize->add_section('ultrapress_meta_setting_section',
	    	array(
	    		'title'     => esc_html__('Meta Settings' , 'ultrapress'),
	    		'panel'     => 'ultrapress_archive_panel'
	    	)
	    ); 
	    /**
	     * Shop Settings Section
	     */
	    $wp_customize->add_section('ultrapress_shop_setting_section',
	    	array(
	    		'title'     => esc_html__('Shop Page' , 'ultrapress'),
	    		'panel'     => 'ultrapress_shop_panel'
	    	)
	    ); 
	    /**
	     * Related Product Section
	     */
	    $wp_customize->add_section('ultrapress_shop_related_section',
	    	array(
	    		'title'     => esc_html__('Related Products' , 'ultrapress'),
	    		'panel'     => 'ultrapress_shop_panel'
	    	)
	    ); 
	    /**
	     * Mini Cart Section
	     */
	    $wp_customize->add_section('ultrapress_mini_cart_section',
	    	array(
	    		'title'     => esc_html__('Mini Cart' , 'ultrapress'),
	    		'panel'     => 'ultrapress_shop_panel'
	    	)
	    ); 
 		/**
 		 * Footer Layout Section
 		 */
 		$wp_customize->add_section('ultrapress_footer_layout_section',
 			array(
 				'title' 	  => esc_html__('Footer Layouts' , 'ultrapress'),
 				'panel' 	  => 'ultrapress_footer_panel'
 			)
 		);
	    /**
	     * Footer Scroll Top Section
	     */
	    $wp_customize->add_section('ultrapress_scroll_top_section',
	    	array(
	    		'title'     => esc_html__('Scroll Top' , 'ultrapress'),
	    		'panel'     => 'ultrapress_footer_panel'
	    	)
	    );
 		/**
 		 * Theme color
 		 */
 		$wp_customize->add_section( 'ultrapress_theme_color_section',
 			array(
 				'title' => esc_html__( 'Theme Color', 'ultrapress' ),
 				'panel'  	  => 'ultrapress_general_settings_panel'
 			)
 		);
 		/**
 		 * Default Section Management
 		 */
 		$wp_customize ->get_section( 'title_tagline' )->panel = 'ultrapress_general_settings_panel';
 		$wp_customize ->get_section( 'colors' )->panel = 'ultrapress_general_settings_panel';
 		$wp_customize ->get_section( 'background_image' )->panel = 'ultrapress_general_settings_panel';
 		$wp_customize ->get_section( 'static_front_page' )->priority = 40;
 		$wp_customize ->remove_section( 'header_image' );
 	}
 	/**
 	 * Register Header Controls
 	 */
 	public function ultrapress_register_header_controls( $wp_customize ) {
 		require_once trailingslashit( get_template_directory() ) . 'inc/ultrapress-customizer/customizers/header/header.php';
 		require_once trailingslashit( get_template_directory() ) . 'inc/ultrapress-customizer/customizers/header/design.php';
 	}
 	/**
 	 * Register Typography Controls
 	 */
 	public function ultrapress_register_typography_controls( $wp_customize ) {
 		require_once trailingslashit( get_template_directory() ) . 'inc/ultrapress-customizer/customizers/typography/body.php';
 		require_once trailingslashit( get_template_directory() ) . 'inc/ultrapress-customizer/customizers/typography/heading.php';
 	}
	/**
	* Register Breadcrumb Banner controls
	*/
	public function ultrapress_register_bread_banner_controls( $wp_customize ) {
		require_once trailingslashit( get_template_directory() ) . 'inc/ultrapress-customizer/customizers/bread-banner/banner.php';
		require_once trailingslashit( get_template_directory() ) . 'inc/ultrapress-customizer/customizers/bread-banner/breadcrumb.php';
	}
	/**
	* Register Page controls
	*/
	public function ultrapress_register_page_settings_controls( $wp_customize ) {
		require_once trailingslashit( get_template_directory() ) . 'inc/ultrapress-customizer/customizers/page/page.php';
		require_once trailingslashit( get_template_directory() ) . 'inc/ultrapress-customizer/customizers/page/sidebar.php';
	}
	/**
	* Register Archive controls
	*/
	public function ultrapress_register_archive_settings_controls( $wp_customize ) {
		require_once trailingslashit( get_template_directory() ) . 'inc/ultrapress-customizer/customizers/archive/blog.php';
		require_once trailingslashit( get_template_directory() ) . 'inc/ultrapress-customizer/customizers/archive/single.php';
		require_once trailingslashit( get_template_directory() ) . 'inc/ultrapress-customizer/customizers/archive/sidebar.php';
		require_once trailingslashit( get_template_directory() ) . 'inc/ultrapress-customizer/customizers/archive/meta.php';
	}
 	/**
 	 * Register footer controls
 	 */
 	public function ultrapress_register_footer_settings_controls( $wp_customize ) {
 		require_once trailingslashit( get_template_directory() ) . 'inc/ultrapress-customizer/customizers/footer/footer.php';
 		require_once trailingslashit( get_template_directory() ) . 'inc/ultrapress-customizer/customizers/footer/scroll-top.php';
 	}
 	
 	/**
 	 * Register theme color
 	 */
 	public function ultrapress_register_theme_color_controls( $wp_customize ){
 		require_once trailingslashit( get_template_directory() ) . 'inc/ultrapress-customizer/customizers/theme-color/theme-color.php';
 	}
 	/**
 	* Register woocommerce control
 	*/
 	public function ultrapress_woocommerce_controls($wp_customize){
 		require_once trailingslashit( get_template_directory() ) . 'inc/ultrapress-customizer/customizers/woocommerce/shop.php';
 		require_once trailingslashit( get_template_directory() ) . 'inc/ultrapress-customizer/customizers/woocommerce/related.php';
 		require_once trailingslashit( get_template_directory() ) . 'inc/ultrapress-customizer/customizers/woocommerce/mini-cart.php';
 	}
 	/**
 	* Register callback functions
 	*/
 	public function ultrapress_registre_theme_active_callback() {
 		require_once trailingslashit( get_template_directory() ) . 'inc/ultrapress-customizer/customizers/callback/active-callback.php';
 	}
 }   	
/**
* Load all our Customizer Custom Controls
*/
require_once trailingslashit( dirname(__FILE__) ) . 'custom-controls.php';
/**
* Initialise our Customizer settings
*/
$ultrapress_settings = new Ultrapress_Initialise_Customizer_Settings();