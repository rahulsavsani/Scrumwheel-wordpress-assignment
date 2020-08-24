<?php
/**
 * Theme constants
 */
$theme = wp_get_theme();
define( 'ULTRAPRESS_THEME', $theme->get( 'Name' ) );
define( 'ULTRAPRESS_VERSION', $theme->get( 'Version' ) );
/**
* Ultrapress functions and definitions
*
* @link https://developer.wordpress.org/themes/basics/theme-functions/
*
* @package UltraPress
*/
if ( ! function_exists( 'ultrapress_starter_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ultrapress_starter_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on creative starter, use a find and replace
		 * to change 'ultrapress' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ultrapress', get_template_directory() . '/languages' );
 		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
 		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		/*
		 * gutenberg support
		 */
		add_theme_support( 'align-wide' );
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		add_image_size( 'ultrapress_archive_thumbnail', 365, 230, true );
		add_image_size( 'ultrapress_archive_default', 360, 450, true );
		add_image_size( 'ultrapress_widget_rcp_size', 300, 150, true );
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary-menu' => esc_html__( 'Primary', 'ultrapress' ),
		) );
 		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
 		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ultrapress_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );
 		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );
 		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'ultrapress_starter_setup' );
 /**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ultrapress_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ultrapress_content_width', 640 );
}
add_action( 'after_setup_theme', 'ultrapress_content_width', 0 );
/**
* Register widget area.
*
* @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
*/
function ultrapress_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Default Sidebar', 'ultrapress' ),
		'id'            => 'default-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'ultrapress' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	if (class_exists( 'WooCommerce' )) {
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Sidebar', 'ultrapress' ),
			'id'            => 'shop-sidebar',
			'description'   => esc_html__( 'Add widgets here.', 'ultrapress' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4 class="widget-title">',
			'after_title'   => '</h4>',
		) );
	}
}
add_action( 'widgets_init', 'ultrapress_widgets_init' );
/**
* Enqueue scripts and styles.
*/
function ultrapress_enqueue_scripts() {
	/* Styles */
	wp_enqueue_style('ultrapress-google-fonts', ultrapress_google_fonts_url(), array(), null);
	wp_register_style( 'slick-theme', get_template_directory_uri() . '/assets/css/slick-theme.css');
	wp_register_style( 'slick', get_template_directory_uri() . '/assets/css/slick.css');
	wp_enqueue_style( 'ultrapress-style', get_stylesheet_uri() );
	wp_enqueue_style( 'ultrapress-responsive', get_template_directory_uri() . '/assets/css/responsive.css');

	/* Scripts */
	wp_register_script( 'slick', get_template_directory_uri() . '/assets/js/slick.min.js', array('jquery'), ULTRAPRESS_VERSION, true );
	wp_enqueue_script( 'skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), ULTRAPRESS_VERSION, true );
	wp_enqueue_script( 'ultrapress-custom', get_template_directory_uri() . '/assets/js/custom.js', array('jquery'), ULTRAPRESS_VERSION, true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ultrapress_enqueue_scripts' );


function bootstrap_register_scripts() {
    wp_register_style('bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css');
    wp_register_style('bootstrap.min', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
    wp_register_style('bootstrap-grid', get_template_directory_uri() . '/assets/css/bootstrap-grid.css');
    wp_register_style('bootstrap-grid.min', get_template_directory_uri() . '/assets/css/bootstrap-grid.min.css');
    wp_register_style('bootstrap-reboot', get_template_directory_uri() . '/assets/css/bootstrap-reboot.css');
    wp_register_style('bootstrap-reboot.min', get_template_directory_uri() . '/assets/css/bootstrap-reboot.min.css');

//    wp_register_script('bootstrap.bundle', get_template_directory_uri(). 'assets/js/bootstrap.bundle.js', array(), BOOTSTRAP_VERSION , true);

}
add_action('wp_enqueue_scripts', 'bootstrap_register_scripts' );


/**
 * Enqueue editor styles for Gutenberg
 */
function ultrapress_editor_styles() {
	wp_enqueue_style( 'ultrapress-gutenberg-editor', get_template_directory_uri() . '/assets/css/style-editor.css' );
}
add_action( 'enqueue_block_editor_assets', 'ultrapress_editor_styles');
$theme_paths = array(
	'/inc/ultrapress-functions.php',
	'/inc/ultrapress-customizer/functions.php',
	'/inc/customizer.php',
	'/inc/template-functions.php',
	'/inc/template-tags.php',
	'/inc/custom-header.php',
	'/inc/extras/dynamic-style.php',
	'/inc/extras/ultrapress-google-fonts.php',
	'/inc/extras/breadcrumb.php',
	'/inc/extras/dynamic-sidebar.php',
	'/inc/widgets/custom-widgets.php',
);
foreach ($theme_paths as $theme_path) {
	require_once get_parent_theme_file_path() . $theme_path;
}

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/extras/jetpack.php';
}
 /**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/extras/woocommerce.php';
	require get_template_directory() . '/inc/widgets/woocommerce-widgets.php';
}

if( class_exists( 'UT_Demo_Importer' ) ) {
	require_once get_template_directory() . '/inc/config/config-data.php';
}
	require get_template_directory() . '/inc/ultrapress-tgmpa.php';


function job_application(){
	echo 'hi';
	print_r($_POST);
	print_r($_FILES);
	print_r(wp_get_upload_dir());
	global $wpdb;

		if(isset($_POST['submit']))
		{
		$name = $_POST['fname']. ' '. $_POST['lname'];
		$email = $_POST['email'];
		$contact = $_POST['contact-info'];
		$job = $_POST['job'];
		$basedir = wp_get_upload_dir();
		var_dump($_FILES["resume"]["tmp_name"]);
		move_uploaded_file($_FILES["resume"]["tmp_name"],   
						  $basedir['basedir']."/resumes/".$_FILES["resume"]["name"]);
		$resume_url ="/resumes/".$_FILES["resume"]["name"]; 
		$wpdb->insert(
			'wp_job_entries', array(
				'applicant_name' => $name,
				'email' => $email,
				'contact' => $contact,
				'job' => $job,
				'resume' => $resume_url
			)
		);
		$wp_baseurl = get_site_url();
		$redirect = $wp_baseurl. '/job_openings/';
		wp_redirect($redirect);
		}

}

add_action('admin_post_nopriv_job_application', 'job_application');
add_action('admin_post_job_application', 'job_application');

