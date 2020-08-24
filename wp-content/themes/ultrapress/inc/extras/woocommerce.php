<?php
function ultrapress_woocommerce_setup() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'ultrapress_woocommerce_setup' );
function ultrapress_woocommerce_scripts() {
	wp_enqueue_style( 'ultrapress-woocommerce-style', get_template_directory_uri() . '/woocommerce.css' );
}
add_action( 'wp_enqueue_scripts', 'ultrapress_woocommerce_scripts' );
function ultrapress_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';
	return $classes;
}

/**
 * WooCommerce Breadcrumb Modify
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
/* Modified Breadcrumb */
if(!function_exists('ultrapress_product_breadcrumb')){
    function ultrapress_product_breadcrumb() {
        $seperator = get_theme_mod('ultrapress_breadcrumb_separator','/');
        $args = array( 'delimiter' => '<span class="delimiter">'.esc_html($seperator).'</span>' );
        woocommerce_breadcrumb( $args );
    }
}

/**
* Product Archive page & Custom template loop
*/

add_filter( 'loop_shop_per_page', 'ultrapress_loop_shop_per_page', 20 );
function ultrapress_loop_shop_per_page( $cols ) {
  $number = get_theme_mod('ultrapress_product_per_page', 9);
  return $number;
}


/**
 * Woo Commerce Number of row filter Function
**/
add_filter('loop_shop_columns', 'ultrapress_loop_columns');
if (!function_exists('ultrapress_loop_columns')) {
    function ultrapress_loop_columns() {
    	$layout = get_theme_mod('ultrapress_shop_display_layout','grid');
    	if($layout == 'list'){
    		$col = 1;
    	}else{
        	$col = get_theme_mod('ultrapress_shop_column_no',3);
        }

        return $col;
    }
}

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

/**
* Add Wrapper to WooCommerce Pages
*/
if ( ! function_exists( 'ultrapress_woocommerce_wrapper_before' ) ) {
    function ultrapress_woocommerce_wrapper_before() {

        if(is_product()){
            $sidebar_layout = 'no-sidebar'; 
        }else{
            $sidebar_layout = ultrapress_sidebar_layouts('shop');
        }
		$layout = get_theme_mod('ultrapress_shop_display_layout','grid');
        $class = $sidebar_layout;
        if(is_shop() || is_product_category() || is_product_tag()){
            $class .= ' '.$layout;
        }
        ?>
        <?php 
        if(is_product()){
            echo '<div class="ultrapress-breadcrumb-wrap"><div class="container">';   
                ultrapress_product_breadcrumb();
            echo '</div></div>';  
        }else{
           ultrapress_title_banner(); 
        }

        ?>
        <section class="woocommerce-page-wrap <?php echo esc_attr($class);?>">
        <main id="main" class="site-main product" >
        <div class="container">
     	<div id="primary" class="product-content-wrapper"> 
        <?php
    }
}
add_action( 'woocommerce_before_main_content', 'ultrapress_woocommerce_wrapper_before' );

if ( ! function_exists( 'ultrapress_woocommerce_wrapper_after' ) ) {

    function ultrapress_woocommerce_wrapper_after() {
        ?>
		</div><!--.product-content-wrapper-->
		<?php 
        if(is_product()){
            $sidebar_layout = 'no-sidebar'; 
        }else{
            $sidebar_layout = ultrapress_sidebar_layouts('shop');
        }
        if($sidebar_layout != 'no-sidebar'){
            get_sidebar(); 
        }
        ?>
		</div><!--.container-->
        </main><!-- #main -->
        </section><!--.woocommerce-page-wrap-->
        <?php
    }
}
add_action( 'woocommerce_after_main_content', 'ultrapress_woocommerce_wrapper_after' );

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);


/* Manage Folder Structure */
remove_action('woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10);
remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close',5);


function ultrapress_woo_thumb_wrap_open(){
	echo '<figure>';
	woocommerce_template_loop_product_link_open();
}
add_action('woocommerce_before_shop_loop_item','ultrapress_woo_thumb_wrap_open',10);

function ultrapress_woo_thumb_wrap_close(){
	woocommerce_template_loop_product_link_close();
	echo '</figure>';
}
add_action('woocommerce_before_shop_loop_item_title','ultrapress_woo_thumb_wrap_close',15);

function ultrapress_woo_content_wrap_open(){
	echo '<div class="woo-content">';
}
add_action('woocommerce_shop_loop_item_title','ultrapress_woo_content_wrap_open',5);

function ultrapress_woo_content_wrap_close(){
	echo '</div>';
}
add_action('woocommerce_after_shop_loop_item','ultrapress_woo_content_wrap_close',25);

function ultrapress_woo_desc_wrap_open(){
	echo '<div class="woo-desc-wrap">';
	woocommerce_template_loop_product_link_open();
}
add_action('woocommerce_shop_loop_item_title','ultrapress_woo_desc_wrap_open',6);

function ultrapress_woo_desc_wrap_close(){
	woocommerce_template_loop_product_link_close();
    /* Add short desc */
    $layout = get_theme_mod('ultrapress_shop_display_layout','grid');
    if($layout == 'list'){
        woocommerce_template_single_excerpt();
    }
	echo '</div>';
}
add_action('woocommerce_after_shop_loop_item','ultrapress_woo_desc_wrap_close',5);

/**
 * Related Products Args.
*/
function ultrapress_related_products_args( $args ) {
    $defaults = array(
        'posts_per_page' => get_theme_mod('ultrapress_related_products_per_page',3),
        'columns'        => get_theme_mod('ultrapress_related_products_column',3),
    );

    $args = wp_parse_args( $defaults, $args );

    return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'ultrapress_related_products_args' );

/* Related title */

add_filter('gettext', 'ultrapress_change_related_text', 10, 3);
add_filter('ngettext', 'ultrapress_change_related_text', 10, 3);

function ultrapress_change_related_text($translated, $text, $domain)
{
    $related_title = get_theme_mod('ultrapress_related_product_title','Related Products');
    if ($text === 'Related products' && $domain === 'woocommerce') {
       $translated = $related_title;
   }
   return $translated;
}

/* Header Mini Cart */
if ( ! function_exists( 'ultrapress_woocommerce_cart_link_fragment' ) ) {
	function ultrapress_woocommerce_cart_link_fragment( $fragments ) {
		ob_start();
		ultrapress_woocommerce_cart_link();
		$fragments['span.header-cart-count'] = ob_get_clean();
		return $fragments;
	}
}
 add_filter( 'woocommerce_add_to_cart_fragments', 'ultrapress_woocommerce_cart_link_fragment' );
if ( ! function_exists( 'ultrapress_woocommerce_cart_link' ) ) {
 	function ultrapress_woocommerce_cart_link() {
 		?>
		<span class="header-cart-count">
			<?php echo esc_html(WC()->cart->get_cart_contents_count()); ?>
		</span>
 		<?php
 	}
}

/* Off canvas cart */
if(!function_exists('ultrapress_off_canvas_cart')){
    function ultrapress_off_canvas_cart(){
        $mini_cart_show = get_theme_mod('ultrapress_mini_cart_switch',true);
        $mini_cart_style = get_theme_mod('ultrapress_mc_diaplay_style','dropdown');
        if ($mini_cart_style == 'offcanvas' ): ?>
            <div class="off-canvas-cart">
                <a href="javascript:void(0)" class="off-canvas-close"></a>
                <div class="shopping-list-wrap">
                    <h4><?php echo esc_html('Your Shopping Cart','ultrapress');?></h4>
                    <div class="widget_shopping_cart_content">
                        <?php woocommerce_mini_cart(); ?>
                    </div>
                </div>
            </div>
            <?php 
        endif;
    }
}
add_action('ultrapress_after_footer','ultrapress_off_canvas_cart',20);        

/* Order review wrapper */
function ultrapress_order_review_wrap_start(){
    echo '<div class="order-review-wrapper">';
}
add_action('woocommerce_checkout_before_order_review_heading','ultrapress_order_review_wrap_start',5);
function ultrapress_order_review_wrap_end(){
    echo '</div>';
}
add_action('woocommerce_checkout_after_order_review','ultrapress_order_review_wrap_end',30);

/* Change default sorting order */
add_filter('woocommerce_default_catalog_orderby', 'ultrapress_default_catalog_orderby');
 
function ultrapress_default_catalog_orderby( $sort_by ) {
    return 'date';
}