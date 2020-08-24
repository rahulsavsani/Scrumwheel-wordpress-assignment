<?php
/**
Plugin Name: UT Demo Importer
Plugin URI:  http://ultrapress.uncodethemes.com/main/
Description: Demo importer for Uncode themes.
Version:     1.0.1
Author:      Uncodethemes
Author URI:  http://uncodethemes.com
License:     GPL2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages/
Text Domain:  ut-demo-importer
*/

/**
 * Importer constants
 */
defined( 'UTDI_VER' ) or define( 'UTDI_VER', '3.0.0' ); // defining plugin version
defined( 'UTDI_DIR' ) or define( 'UTDI_DIR', plugin_dir_path( __FILE__ ) ); // defining plugin directory
defined( 'UTDI_URI' ) or define( 'UTDI_URI', plugin_dir_url( __FILE__ ) ); // defining plugin url
defined( 'UTDI_DEMO_URL' ) or define( 'UTDI_DEMO_URL', 'http://demo.uncodethemes.com/demo-importer/' ); // defining plugin url

/**
 * Scripts and styles for admin
 */
function ut_demo_importer_enqueue_scripts() {
    wp_enqueue_script( 'easing', UTDI_URI . '/assets/js/easing.min.js', array( 'jquery' ), UTDI_VER, true);
    wp_enqueue_script( 'easing-support', UTDI_URI . '/assets/js/easing-support.js', array( 'jquery' ), UTDI_VER, true);
    wp_enqueue_script( 'ut-demo-importer', UTDI_URI . '/assets/js/import.js', array( 'jquery' ), UTDI_VER, true);
    wp_enqueue_script( 'isotop', UTDI_URI . '/assets/js/isotop.js', array( 'jquery' ), UTDI_VER, true);
    wp_enqueue_style( 'easing-css', UTDI_URI . '/assets/css/easing.css', null, UTDI_VER);
    wp_enqueue_style( 'ut-demo-importer-css', UTDI_URI . '/assets/css/import.css', null, UTDI_VER);
    wp_enqueue_style( 'utdi-custom', UTDI_URI . '/assets/css/custom.css', null, UTDI_VER);
    wp_enqueue_script( 'utdi-custom', UTDI_URI . '/assets/js/custom.js', array( 'jquery' ), UTDI_VER, true);
}
add_action( 'admin_enqueue_scripts', 'ut_demo_importer_enqueue_scripts' );

/**
 * Load Importer
 */
require_once UTDI_DIR . '/CustomizerOption.php';
require_once UTDI_DIR . '/classes/abstract.class.php';
require_once UTDI_DIR . '/classes/importer.class.php';