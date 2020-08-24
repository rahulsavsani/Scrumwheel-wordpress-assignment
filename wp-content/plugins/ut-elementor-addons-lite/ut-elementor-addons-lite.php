<?php 
/*
Plugin Name: UT Elementor Addons Lite
Plugin URI:  http://ultrapress.uncodethemes.com
Description: UT Elementor Addons Lite is a plugin that includes Elementor Elements for Uncode themes.
Version:     1.0.3
Author:      Uncodethemes
Author URI:  https://uncodethemes.com
License:     GPL2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages/
Text Domain: ut-elementor-addons-lite
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Create class UT_Elementor_Addons_Lite
if(!class_exists('UT_Elementor_Addons_Lite')){

    class UT_Elementor_Addons_Lite {

        // Construtor to load all hooks

        function __construct(){

            $this->define_constants();

            $this -> ut_elementor_addons_lite_includes();

            add_action( 'init', array($this,'ut_elementor_addons_lite_init') );
            add_action( 'elementor/init', [ $this, 'ut_elementor_addons_lite_widget_categories' ] );
            add_action( 'elementor/frontend/after_register_scripts',array($this,'register_frontend_assets') );
            add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'register_frontend_style' ] );
            add_action('elementor/widgets/widgets_registered',array($this,'ut_elementor_addons_lite_register'));

        }

        // Register Text Domain

        function ut_elementor_addons_lite_init(){
            load_plugin_textdomain( 'ut-elementor-addons-lite', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
        }

        // Define Folder Paths

        function define_constants(){

            defined('UTAL_CSS_DIR') or define('UTAL_CSS_DIR',plugin_dir_url(__FILE__).'assets/css');
            defined('UTAL_JS_DIR') or define('UTAL_JS_DIR',plugin_dir_url(__FILE__).'assets/js');
            defined('UTAL_PACKAGE_DIR') or define('UTAL_PACKAGE_DIR',plugin_dir_url(__FILE__).'assets/package');
            defined('UTAL_PATH') or define('UTAL_PATH',plugin_dir_path(__FILE__));
            defined('UTAL_PLUGIN_VERSION') or define('UTAL_PLUGIN_VERSION','1.0.2');

        }

        // Function to include helper functions
        function ut_elementor_addons_lite_includes(){

            require_once plugin_dir_path(__FILE__).'includes/queries.php';

            require_once plugin_dir_path(__FILE__).'includes/elementor-helper.php';

            $mythemes = array('ultrapress');
            $active_theme = wp_get_theme();
            if ( in_array($active_theme->template,$mythemes) ) {
                require_once plugin_dir_path(__FILE__).'includes/theme-meta.php';
            }

        }

        // Function to add ut-elementor-addons-lite category in elementor panel
        function ut_elementor_addons_lite_widget_categories() {

            $groups = array(
                'ut-elementor-addons-lite'  => esc_html__( 'UT Elementor Addons Lite', 'ut-elementor-addons-lite' )
            );

            foreach ( $groups as $key => $value )
            {
                \Elementor\Plugin::$instance->elements_manager->add_category( $key, [ 'title' => $value ], 1 );
            }

        }

        // Register elementor widgets
        function ut_elementor_addons_lite_register(){

            require_once plugin_dir_path(__FILE__).'elements/site-logo.php';
            require_once plugin_dir_path(__FILE__).'elements/nav-menu.php';
            require_once plugin_dir_path(__FILE__).'elements/search.php';
            require_once plugin_dir_path(__FILE__).'elements/blog-grid.php';
            require_once plugin_dir_path(__FILE__).'elements/blog-list.php';
            require_once plugin_dir_path(__FILE__).'elements/blog-block.php';
            require_once plugin_dir_path(__FILE__).'elements/slider.php';
            require_once plugin_dir_path(__FILE__).'elements/testimonial.php';
            require_once plugin_dir_path(__FILE__).'elements/content-ticker.php';
            require_once plugin_dir_path(__FILE__).'elements/team.php';
            if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
                require_once plugin_dir_path(__FILE__).'elements/products.php';
            }

        }


        // Register Frontend resources (Enqueue scripts and style)

        function register_frontend_style(){

            // wp_enqueue_style('font-aweasome',UTAL_PACKAGE_DIR.'/css/font-awesome.min.css',array(),UTAL_PLUGIN_VERSION);

            wp_enqueue_style('ut-elementor-addons-lite-frontend',UTAL_CSS_DIR.'/frontend.css',array(),UTAL_PLUGIN_VERSION);
            wp_enqueue_style('ut-elementor-addons-lite-responsive',UTAL_CSS_DIR.'/responsive.css',array(),UTAL_PLUGIN_VERSION);
            wp_register_style('slick',UTAL_CSS_DIR.'/slick.css',array(),UTAL_PLUGIN_VERSION);

        }

        // Register Frontend resources (Enqueue scripts and style)

        function register_frontend_assets(){

            wp_enqueue_script('ut-elementor-addons-lite-script',UTAL_JS_DIR.'/custom.js',array('jquery'), UTAL_PLUGIN_VERSION, true);   
            wp_register_script('slick',UTAL_JS_DIR.'/slick.js',array('jquery'), UTAL_PLUGIN_VERSION, true);       


        }

    }

    // Creating UT_Elementor_Addons_Lite class object

    $UT_Elementor_Addons_Lite_obj = new UT_Elementor_Addons_Lite();

  }