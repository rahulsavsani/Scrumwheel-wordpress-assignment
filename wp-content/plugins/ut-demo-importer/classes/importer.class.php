<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Framework Class
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class UT_Demo_Importer extends UT_Demo_Importer_Abstract {
  /**
   *
   * option database/data name
   * @access public
   * @var string
   *
   */
    public $opt_id = 'theme_mods_utdi';
    /**
    *
    * framework option database/data name
    * @access public
    * @var string
    *
    */
    public $framework_id = '';
    /**
    *
    * demo items
    * @access public
    * @var array
    *
    */
     public $items = array();

    /**
    *
    * instance
    * @access private
    * @var class
    *
    */
     private static $instance = null;
    // run framework construct
    public function __construct( $items ) {
        $this->framework_id = defined( 'UTDI_OPTION' ) ? UTDI_OPTION : '_utdi_options';
        $this->items    = apply_filters( 'ut_demo_importer_items', $items );
        if( ! empty( $this->items ) ) {
            $this->addAction( 'admin_menu', 'admin_menu' );
            $this->addAction( 'wp_ajax_utdi_plugin_install', 'plugin_process' );
            $this->addAction( 'wp_ajax_ut_demo_importer', 'import_process' );
            $this->addAction( 'wp_ajax_nopriv_ut_demo_importer', 'import_process' );
            
        }
    }
    // instance
    public static function instance( $items = array() ) {
        self::$instance = new self( $items );
        return self::$instance;
    }
      // adding option page
    public function admin_menu() {
        $defaults_menu_args = array(
            'menu_parent'     => '',
            'menu_title'      => '',
            'menu_type'       => '',
            'menu_slug'       => '',
            'menu_icon'       => '',
            'menu_capability' => 'manage_options',
            'menu_position'   => null,
        );            
        $settings      = array(
          'menu_parent' => 'themes.php',
          'menu_title'  => esc_html__('Demo Importer', 'ut-demo-importer'),
          'menu_type'   => 'add_submenu_page',
          'menu_slug'   => 'utdi-import',
        );

        $args = wp_parse_args( $settings, $defaults_menu_args );
        if( $args['menu_type'] == 'add_submenu_page' ) {
            call_user_func( $args['menu_type'], $args['menu_parent'], $args['menu_title'], $args['menu_title'], $args['menu_capability'], $args['menu_slug'], array( &$this, 'admin_page' ) );
        } else {
            call_user_func( $args['menu_type'], $args['menu_title'], $args['menu_title'], $args['menu_capability'], $args['menu_slug'], array( &$this, 'admin_page' ), $args['menu_icon'], $args['menu_position'] );
        }
    }
    // output demo items
    public function admin_page() {
    $nonce = wp_create_nonce('ut_demo_importer');
    ?>
    <div class="wrap ut-demo-importer">
      <?php 
        require_once UTDI_DIR . '/view/view-head.php';
        require_once UTDI_DIR . '/view/view-body.php';
      ?>
    </div><!-- /.wrap -->
<?php }
    public function plugin_process() {
        $plugin_slug = sanitize_text_field(wp_unslash($_POST['p_slug'])) ;
        $plugin_filename = sanitize_text_field(wp_unslash($_POST['p_filename'])) ;
        $plugin_link = esc_url(wp_unslash($_POST['p_source'])) ;
        if (!empty($plugin_link)) {
            $plugin_source = $plugin_link ;
        }else{
            $plugin_source = '' ;
        }
        $pluginSlugs = array(
            array(
                "plugin_slug" => $plugin_slug ,
                "plugin_filename" => $plugin_filename ,
                "plugin_source" => $plugin_source ,
            ),
        );
        require_once(ABSPATH . 'wp-admin/includes/class-wp-upgrader.php');
        require_once(ABSPATH . 'wp-admin/includes/plugin-install.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/misc.php');
        require_once(ABSPATH . 'wp-admin/includes/plugin.php');
        function UT_Demo_ImporterpInstallActivation($slug, $filename, $source) {
            $pluginDir = WP_PLUGIN_DIR . '/' . $slug;    
            /* 
             * Don't try installing plugins that already exist (wastes time downloading files that 
             * won't be used 
             */
            if (!is_dir($pluginDir)) {
                $api = plugins_api(
                    'plugin_information',
                    array(
                        'slug' => $slug,
                        'fields' => array(
                            'sections' => false,
                        ),
                    )
                );
                if (!empty($source)) {
                    $download_source = $source ; 
                    }else{
                        $download_source = $api->download_link ;
                }
                // Replace with new QuietSkin for no output
                $skin     = new WP_Ajax_Upgrader_Skin();
                $upgrader = new Plugin_Upgrader( $skin );
                $install = $upgrader->install($download_source);
            }
            $pluginFilePath = $pluginDir . '/' . $filename . '.php';                
            if (file_exists($pluginFilePath)) {
              activate_plugin($pluginFilePath);
            }
        }
        foreach ($pluginSlugs as $pluginSlug) {
            UT_Demo_ImporterpInstallActivation($pluginSlug['plugin_slug'], $pluginSlug['plugin_filename'], $pluginSlug['plugin_source']);
        }
    }
    /**
    * Import Proccess
    */
    public function import_process() {
        if ( function_exists( 'ini_get' ) ) {
          if ( 600 < ini_get( 'max_execution_time' ) ) {
            @ini_set( 'max_execution_time', 600 );
        }
        if ( 656 < intval( ini_get( 'memory_limit' ) ) ) {
            @ini_set( 'memory_limit', '656M' );
        }
    } else {
       echo 'ini_get does not exist';
    }
    $id = sanitize_text_field(wp_unslash($_POST['id']));
    $type = $this->items[$id]['demo_type'];
    if($type == 'landing'){
        // Import XML Data
        $this->import_json_data();
    }else{
        // Disable color and typography schemes
        if( isset($this->items[$id]['elementor']) ){
            $this->set_elementor($this->items[$id]['elementor']);
        }
        // Import XML Data
        $this->import_xml_data();
        //Setup customizer
        $this->set_customizer_options();
        //Setup Widgets
        $this->set_widgets();
        // Setup Reading
        $this->set_pages_for_reading();
        // Setup Menu
        if (isset($this->items[$id]['menus'])) {
          $this->set_menu();
        }

        // If shop demo
        $shop_demo          = isset( $items['is_shop'] ) ? $items['is_shop'] : false;

        // Assign WooCommerce pages if WooCommerce Exists
        if ( class_exists( 'WooCommerce' ) && true == $shop_demo ) {

            $woopages = array(
                'woocommerce_shop_page_id'              => 'Shop',
                'woocommerce_cart_page_id'              => 'Cart',
                'woocommerce_checkout_page_id'          => 'Checkout',
                'woocommerce_pay_page_id'               => 'Checkout &#8594; Pay',
                'woocommerce_thanks_page_id'            => 'Order Received',
                'woocommerce_myaccount_page_id'         => 'My Account',
                'woocommerce_edit_address_page_id'      => 'Edit My Address',
                'woocommerce_view_order_page_id'        => 'View Order',
                'woocommerce_change_password_page_id'   => 'Change Password',
                'woocommerce_logout_page_id'            => 'Logout',
                'woocommerce_lost_password_page_id'     => 'Lost Password'
            );

            foreach ( $woopages as $woo_page_name => $woo_page_title ) {

                $woopage = get_page_by_title( $woo_page_title );
                if ( isset( $woopage ) && $woopage->ID ) {
                    update_option( $woo_page_name, $woopage->ID );
                }

            }
            // We no longer need to install pages
            delete_option( '_wc_needs_pages' );
            delete_transient( '_wc_activation_redirect' );
        }
        //$this->import_rev_slider();
    }
    echo 'Demo Imported Successfully!!';
}
    /* Import json File */
    public function import_json_data(){
        $id = sanitize_text_field(wp_unslash($_POST['id']));
        $themename = $this->items[$id]['theme'];
        $json_filepath = UTDI_DEMO_URL . $themename.'/'. $id . '/elementor.json';
        $response_data = json_decode(file_get_contents( $json_filepath, true ),true);
        $title = !empty( $response_data['title'] ) ? $response_data['title'] : esc_html__( 'New Template', 'utdi-import' );
        $args = [
            'post_type'    => 'elementor_library',
            'post_status'  => 'publish',
            'post_title'   => $title,
            'post_content' => '',
        ];
        $new_post_id = wp_insert_post( $args );
        update_post_meta( $new_post_id, '_elementor_data', $response_data['content'] );
        update_post_meta( $new_post_id, '_elementor_page_settings', $response_data['page_settings'] );
        update_post_meta( $new_post_id, '_elementor_template_type', $response_data['type'] );
        update_post_meta( $new_post_id, '_elementor_edit_mode', 'builder' );
        if ( $new_post_id && ! is_wp_error( $new_post_id ) ) {
            update_post_meta( $new_post_id, '_wp_page_template', ! empty( $response_data['page_template'] ) ? $response_data['page_template'] : 'elementor_canvas' );
        }
        echo 'Json Imported Successfully.';
        wp_die();
    }
    /* Set Elementor Settings*/
    public function set_elementor( $option = array('color' => 'disable', 'font' => 'disable') ){
        if($option['color'] == 'disable'){
            update_option( 'elementor_disable_color_schemes', 'yes' );
        }
        if($option['font'] == 'disable'){
            update_option( 'elementor_disable_typography_schemes', 'yes' );
        }
    }
    /**
    * Import XML data by WordPress Importer
    */
    public function import_xml_data() {
        if ( ! wp_verify_nonce( sanitize_text_field(wp_unslash($_POST['nonce'])), 'ut_demo_importer' ) ){
            die( 'Authentication Error!!!' ); 
        }
        $id = sanitize_text_field(wp_unslash($_POST['id']));
        $themename = $this->items[$id]['theme'];
        $file = UTDI_DEMO_URL . $themename.'/'. $id . '/content.xml';
        if ( ! defined('WP_LOAD_IMPORTERS') ) { 
            define( 'WP_LOAD_IMPORTERS', true );
        }
        $importer_error = false;
        if ( !class_exists( 'WP_Importer' ) ) {
            $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
            if ( file_exists( $class_wp_importer ) ){
                require_once($class_wp_importer);
            } else {
                $importer_error = true;
            }
        }
        if ( ! class_exists( 'WP_Import' ) ) {
            $class_wp_import = wp_normalize_path( dirname( __FILE__ ) ) . '/wordpress-importer.php';
            if ( file_exists( $class_wp_import ) && ! class_exists( 'WP_Import' ) ){
                require $class_wp_import;
        } else{
            $importer_error = true;
            }
        }
        if($importer_error){
            die(__("Error on import", 'ut-demo-importer'));
        } else {
            if(!file_get_contents( $file )){
                esc_html_e("File Error!!!", 'ut-demo-importer');
        } else {
            $wp_import = new WP_Import();
            $wp_import->fetch_attachments = true;
            $wp_import->import( $file );
            $options = get_option($this->opt_id);
            $options[$id] = true;
            update_option( $this->opt_id, $options );
            }
        }
    }
    /* update customizer data */
    function set_customizer_options() {
        $id = sanitize_text_field(wp_unslash($_POST['id']));
        $themename = $this->items[$id]['theme'];
        $customizer_filepath = UTDI_DEMO_URL . $themename.'/'. $id . '/customizer.dat';
        if ( file_get_contents( $customizer_filepath ) ) {
            $customizer_file = file_get_contents( $customizer_filepath, true );
            if ( !empty( $customizer_file ) ) {
                $options = unserialize( $customizer_file );
                    // Loop through the mods.
                foreach ( $options[ 'mods' ] as $key => $val ) {
                    // Save the mod.
                    set_theme_mod( $key, $val );
                }
                echo esc_html__( 'Customizer Settings saved.', 'ut-demo-importer' ) . '<br>';
            } else {
                echo esc_html__( 'Customizer Settings could not be imported', 'ut-demo-importer' ) . '<br>';
            }
        } else {
          echo esc_html__( 'Customizer Settings file not found.', 'ut-demo-importer' ) . '<br>';
        }  
    }
    /**
    * Update Widgets
    */
    function set_widgets() {
        $id = sanitize_text_field(wp_unslash($_POST['id']));
        $themename = $this->items[$id]['theme'];
        $widget_filepath = UTDI_DEMO_URL . $themename.'/'. $id . '/widgets.wie';
        if ( file_get_contents( $widget_filepath ) ) {
            global $wp_registered_sidebars;
            $widget_file = file_get_contents( $widget_filepath, true );
            $data = json_decode( $widget_file );
            // Have valid data?
            // If no data or could not decode
            if ( empty( $data ) || !is_object( $data ) ) {
                wp_die(
                _e( 'Widget data is not available', 'ut-demo-importer' ), '', array( 'back_link' => true )
                );
            }
            global $wp_registered_widget_controls;
            $widget_controls = $wp_registered_widget_controls;
            $available_widgets = array();
            foreach ( $widget_controls as $widget ) {
                if ( !empty( $widget[ 'id_base' ] ) && !isset( $available_widgets[ $widget[ 'id_base' ] ] ) ) { // no dupes
                  $available_widgets[ $widget[ 'id_base' ] ][ 'id_base' ] = $widget[ 'id_base' ];
                  $available_widgets[ $widget[ 'id_base' ] ][ 'name' ] = $widget[ 'name' ];
                }
            }
            // Get all existing widget instances
            $widget_instances = array();
            foreach ( $available_widgets as $widget_data ) {
                $widget_instances[ $widget_data[ 'id_base' ] ] = get_option( 'widget_' . $widget_data[ 'id_base' ] );
            }
            // Begin results
            $results = array();
            // Loop import data's sidebars
            foreach ( $data as $sidebar_id => $widgets ) {
                // Skip inactive widgets
                // (should not be in export file)
                if ( 'wp_inactive_widgets' == $sidebar_id ) {
                  continue;
                }
                // Check if sidebar is available on this site
                // Otherwise add widgets to inactive, and say so
                if ( isset( $wp_registered_sidebars[ $sidebar_id ] ) ) {
                      $sidebar_available = true;
                      $use_sidebar_id = $sidebar_id;
                      $sidebar_message_type = 'success';
                      $sidebar_message = '';
                } else {
                      $sidebar_available = false;
                        $use_sidebar_id = 'wp_inactive_widgets'; // add to inactive if sidebar does not exist in theme
                        $sidebar_message_type = 'error';
                        $sidebar_message = _e( 'Widget area does not exist in theme (using Inactive)', 'ut-demo-importer' );
                }
                // Result for sidebar
                $results[ $sidebar_id ][ 'name' ] = !empty( $wp_registered_sidebars[ $sidebar_id ][ 'name' ] ) ? $wp_registered_sidebars[ $sidebar_id ][ 'name' ] : $sidebar_id; // sidebar name if theme supports it; otherwise ID
                $results[ $sidebar_id ][ 'message_type' ] = $sidebar_message_type;
                $results[ $sidebar_id ][ 'message' ] = $sidebar_message;
                $results[ $sidebar_id ][ 'widgets' ] = array();
                // Loop widgets
                foreach ( $widgets as $widget_instance_id => $widget ) {
                    $fail = false;
                    // Get id_base (remove -# from end) and instance ID number
                    $id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
                    $instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );
                        // Does site support this widget?
                    if ( !$fail && !isset( $available_widgets[ $id_base ] ) ) {
                    $fail = true;
                    $widget_message_type = 'error';
                        $widget_message = __( 'Site does not support widget', 'ut-demo-importer' ); // explain why widget not imported
                    }
                    // Filter to modify settings object before conversion to array and import
                    // Leave this filter here for backwards compatibility with manipulating objects (before conversion to array below)
                    // Ideally the newer wie_widget_settings_array below will be used instead of this
                    $widget = apply_filters( 'wie_widget_settings', $widget ); // object
                    // Convert multidimensional objects to multidimensional arrays
                    // Some plugins like Jetpack Widget Visibility store settings as multidimensional arrays
                    // Without this, they are imported as objects and cause fatal error on Widgets page
                    // If this creates problems for plugins that do actually intend settings in objects then may need to consider other approach: https://wordpress.org/support/topic/problem-with-array-of-arrays
                    // It is probably much more likely that arrays are used than objects, however
                    $widget = json_decode( wp_json_encode( $widget ), true );
                    // Filter to modify settings array
                    // This is preferred over the older wie_widget_settings filter above
                    // Do before identical check because changes may make it identical to end result (such as URL replacements)
                    $widget = apply_filters( 'wie_widget_settings_array', $widget );

                    // Does widget with identical settings already exist in same sidebar?
                    if ( !$fail && isset( $widget_instances[ $id_base ] ) ) {
                        // Get existing widgets in this sidebar
                        $sidebars_widgets = get_option( 'sidebars_widgets' );
                        $sidebar_widgets = isset( $sidebars_widgets[ $use_sidebar_id ] ) ? $sidebars_widgets[ $use_sidebar_id ] : array(); // check Inactive if that's where will go
                        // Loop widgets with ID base
                        $single_widget_instances = !empty( $widget_instances[ $id_base ] ) ? $widget_instances[ $id_base ] : array();
                        foreach ( $single_widget_instances as $check_id => $check_widget ) {
                            // Is widget in same sidebar and has identical settings?
                            if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && ( array ) $widget == $check_widget ) {
                            $fail = true;
                            $widget_message_type = 'warning';
                                $widget_message = __( 'Widget already exists', 'ut-demo-importer' ); // explain why widget not imported
                                break;
                            }
                        }
                    }
                    // No failure
                    if ( !$fail ) {
                        // Add widget instance
                        $single_widget_instances = get_option( 'widget_' . $id_base ); // all instances for that widget ID base, get fresh every time
                        $single_widget_instances = !empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 ); // start fresh if have to
                        $single_widget_instances[] = $widget; // add it
                        // Get the key it was given
                        end( $single_widget_instances );
                        $new_instance_id_number = key( $single_widget_instances );
                        // If key is 0, make it 1
                        // When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
                        if ( '0' === strval( $new_instance_id_number ) ) {
                            $new_instance_id_number = 1;
                            $single_widget_instances[ $new_instance_id_number ] = $single_widget_instances[ 0 ];
                            unset( $single_widget_instances[ 0 ] );
                        } 
                        // Move _multiwidget to end of array for uniformity
                        if ( isset( $single_widget_instances[ '_multiwidget' ] ) ) {
                            $multiwidget = $single_widget_instances[ '_multiwidget' ];
                            unset( $single_widget_instances[ '_multiwidget' ] );
                            $single_widget_instances[ '_multiwidget' ] = $multiwidget;
                        }
                        // Update option with new widget
                        update_option( 'widget_' . $id_base, $single_widget_instances );
                        // Assign widget instance to sidebar
                        $sidebars_widgets = get_option( 'sidebars_widgets' ); // which sidebars have which widgets, get fresh every time
                        // Avoid rarely fatal error when the option is an empty string
                        // https://github.com/churchthemes/widget-importer-exporter/pull/11
                        if ( !$sidebars_widgets ) {
                            $sidebars_widgets = array();
                        }
                        $new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
                        $sidebars_widgets[ $use_sidebar_id ][] = $new_instance_id; // add new instance to sidebar
                        update_option( 'sidebars_widgets', $sidebars_widgets ); // save the amended data
                        // After widget import action
                        $after_widget_import = array(
                            'sidebar' => $use_sidebar_id,
                            'sidebar_old' => $sidebar_id,
                            'widget' => $widget,
                            'widget_type' => $id_base,
                            'widget_id' => $new_instance_id,
                            'widget_id_old' => $widget_instance_id,
                            'widget_id_num' => $new_instance_id_number,
                            'widget_id_num_old' => $instance_id_number
                        );
                        do_action( 'wie_after_widget_import', $after_widget_import );
                        // Success message
                        if ( $sidebar_available ) {
                          $widget_message_type = 'success';
                          $widget_message = esc_html__( 'Imported', 'ut-demo-importer' );
                        } else {
                          $widget_message_type = 'warning';
                          $widget_message = esc_html__( 'Imported to Inactive', 'ut-demo-importer' );
                        }
                    }
                    // Result for widget instance
                    $results[ $sidebar_id ][ 'widgets' ][ $widget_instance_id ][ 'name' ] = isset( $available_widgets[ $id_base ][ 'name' ] ) ? $available_widgets[ $id_base ][ 'name' ] : $id_base; // widget name or ID if name not available (not supported by site)
                    $results[ $sidebar_id ][ 'widgets' ][ $widget_instance_id ][ 'title' ] = !empty( $widget[ 'title' ] ) ? $widget[ 'title' ] : esc_html__( 'No Title', 'ut-demo-importer' ); // show "No Title" if widget instance is untitled
                    $results[ $sidebar_id ][ 'widgets' ][ $widget_instance_id ][ 'message_type' ] = $widget_message_type;
                    $results[ $sidebar_id ][ 'widgets' ][ $widget_instance_id ][ 'message' ] = $widget_message;
                    }
                }
        } else {
            echo esc_html__( 'Widget Importer file not found.', 'ut-demo-importer' ) . '<br>';
        }
    }

    /**
    * Set Homepage and Front page
    */
    public function set_pages_for_reading() {
        $id = sanitize_text_field(wp_unslash($_POST['id']));
        // Set Home
        if (isset($this->items[$id]['front_page'])) {
          $page = get_page_by_title($this->items[$id]['front_page']);
            if ( isset( $page->ID ) ) {
                update_option( 'page_on_front', $page->ID );
                update_option( 'show_on_front', 'page' );
            }
        }
        // Set Blog
        if (isset($this->items[$id]['blog_page'])) {
            $page = get_page_by_title($this->items[$id]['blog_page']);
            if ( isset( $page->ID ) ) {
                update_option( 'page_for_posts', $page->ID );
                update_option( 'show_on_front', 'page' );
            }
        }
    }

    /**
    * Setup Menu
    */
    public function set_menu() {
        $id = sanitize_text_field(wp_unslash($_POST['id']));
        // Store All Menu
        $menu_locations = array();
        foreach ($this->items[$id]['menus'] as $key => $value) {
            $menu = get_term_by( 'name', $value, 'nav_menu' );
            if (isset($menu->term_id)) {
                $menu_locations[$key] = $menu->term_id;
            }
        }
        // Set Menu If has
        if (isset($menu_locations)) {
            set_theme_mod( 'nav_menu_locations', $menu_locations );
        }
    }

    /**
    * Import Revolution Slider
    */
    public function import_rev_slider() {
        $id = sanitize_text_field(wp_unslash($_POST['id']));
        $is_revslider = ( $this->items[$id]['revslider'] ) ? true : false;
        if( $is_revslider && class_exists( 'UniteFunctionsRev' ) ) {
            $file_name = $this->items[$id]['revname'];
            if( $file_name ) {
                $themename = $this->items[$id]['theme'];
                $file = UTDI_DEMO_URL . $themename.'/'. $id . '/'.$file_name;
                $slider = new RevSlider();
                $result = $slider->importSliderFromPost( true, false, $file );
            }
        }
    }

}