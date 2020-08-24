<?php

// Get categories
if ( !function_exists('ut_elementor_addons_lite_get_post_categories') ) {
    function ut_elementor_addons_lite_get_post_categories() {

        $options = array();
        
        $terms = get_terms( array( 
            'taxonomy'      => 'category',
            'hide_empty'    => true,
        ));

        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
            foreach ( $terms as $term ) {
                $options[ $term->term_id ] = $term->name.' ('.$term->count.')';
            }
        }

        return $options;
    }
}



/**
 * Get All POst Types
 * @return array
 */
function ut_elementor_addons_lite_get_post_types(){

    $utal_cpts = get_post_types( array( 'public'   => true, 'show_in_nav_menus' => true ), 'object' );
    $utal_exclude_cpts = array( 'elementor_library', 'attachment' );

    foreach ( $utal_exclude_cpts as $exclude_cpt ) {
        unset($utal_cpts[$exclude_cpt]);
    }
    $post_types = array_merge($utal_cpts);
    foreach( $post_types as $type ) {
        $types[ $type->name ] = $type->label;
    }

    return $types;
}


/**
 * POst Orderby Options
 * @return array
 */
function ut_elementor_addons_lite_get_post_orderby(){
    $orderby = array(
        'ID'            => esc_html('Post ID','accesspress-parallax'),
        'author'        => esc_html('Post Author','accesspress-parallax'),
        'title'         => esc_html('Title','accesspress-parallax'),
        'date'          => esc_html('Date','accesspress-parallax'),
        'modified'      => esc_html('Last Modified Date','accesspress-parallax'),
        'parent'        => esc_html('Parent Id','accesspress-parallax'),
        'rand'          => esc_html('Random','accesspress-parallax'),
        'comment_count' => esc_html('Comment Count','accesspress-parallax'),
        'menu_order'    => esc_html('Menu Order','accesspress-parallax'),
    );

    return $orderby;
}


// Get all Authors
if ( !function_exists('ut_elementor_addons_lite_get_authors') ) {
    function ut_elementor_addons_lite_get_authors() {

        $options = array();

        $users = get_users();

        foreach ( $users as $user ) {
            $options[ $user->ID ] = $user->display_name;
        }

        return $options;
    }
}

// Get all Authors
if ( !function_exists('ut_elementor_addons_lite_get_tags') ) {
    function ut_elementor_addons_lite_get_tags() {

        $options = array();

        $tags = get_tags();

        foreach ( $tags as $tag ) {
            $options[ $tag->term_id ] = $tag->name.' ('.$tag->count.')';
        }

        return $options;
    }
}

// Get all Posts
if ( !function_exists('ut_elementor_addons_lite_get_posts') ) {
    function ut_elementor_addons_lite_get_posts() {

        $post_list = get_posts( array(
            'post_type'         => 'post',
            'orderby'           => 'date',
            'order'             => 'DESC',
            'posts_per_page'    => -1,
        ) );

        $posts = array();

        if ( ! empty( $post_list ) && ! is_wp_error( $post_list ) ) {
            foreach ( $post_list as $post ) {
               $posts[ $post->ID ] = $post->post_title;
            }
        }

        return $posts;
    }
}



if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    // Get all Products
    if ( !function_exists('ut_elementor_addons_lite_get_products') ) {
        function ut_elementor_addons_lite_get_products() {

            $post_list = get_posts( array(
                'post_type'         => 'product',
                'orderby'           => 'date',
                'order'             => 'DESC',
                'posts_per_page'    => -1,
            ) );

            $posts = array();

            if ( ! empty( $post_list ) && ! is_wp_error( $post_list ) ) {
                foreach ( $post_list as $post ) {
                   $posts[ $post->ID ] = $post->post_title;
                }
            }

            return $posts;
        }
    }
    
    // Woocommerce - Get product categories
    if ( !function_exists('ut_elementor_addons_lite_get_product_categories') ) {
        function ut_elementor_addons_lite_get_product_categories() {

            $options = array();

            $terms = get_terms( array( 
                'taxonomy'      => 'product_cat',
                'hide_empty'    => true,
            ));

            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
                foreach ( $terms as $term ) {
                    $options[ $term->term_id ] = $term->name.' ('.$term->count.')';
                }
            }

            return $options;
        }
    }

    // WooCommerce - Get product tags
    if ( !function_exists('ut_elementor_addons_lite_product_get_tags') ) {
        function ut_elementor_addons_lite_product_get_tags() {

            $options = array();

            $tags = get_terms( 'product_tag' );

            if ( ! empty( $tags ) && ! is_wp_error( $tags ) ){
                foreach ( $tags as $tag ) {
                    $options[ $tag->term_id ] = $tag->name.' ('.$tag->count.')';
                }
            }

            return $options;
        }
    }
}

/**
* Queries for the elements
*
*/
if( ! function_exists('ut_elementor_addons_lite_query')){
    function ut_elementor_addons_lite_query($settings,$first_id='',$postsPerPage = 6, $offset= '' ){     
        $post_type      = 'post';
        $category       = '';
        $tags           = '';
        $exclude_posts  = '';
        $offset = empty($offset) ? $settings['offset'] : $offset ; 
        $category       = $settings['categories'];
        $tags           = $settings['tags'];
        $exclude_posts  = $settings['exclude_posts'];
        $orderby = isset($settings['orderby']) ? $settings['orderby'] : 'ID' ;
        $meta_key = '';
        $date = '';

        //Categories
        $post_cat = '';
        $post_cats = $category;
        if ( ! empty( $category) ){
            asort($category);    
        }
        
        if ( !empty( $post_cats) ) {
            $post_cat = implode( ",", $post_cats );
        }
        
        if( !empty($first_id)){
            $post_cat = $first_id;
        }
        // Post Authors
        $post_author = '';
        $post_authors = isset( $settings['authors'] ) ? $settings['authors'] : '';
        if ( !empty( $post_authors) ) {
            $post_author = implode( ",", $post_authors );
        }
        $args = array(
                'post_status'           => array( 'publish' ),
                'post_type'             => $post_type,
                'post__in'              => '',
                'cat'                   => $post_cat,
                'author'                => $post_author,
                'tag__in'               => $tags,
                'orderby'               => $orderby,
                'order'                 => $settings['order'],
                'post__not_in'          => $exclude_posts,
                'offset'                => $offset,
                'ignore_sticky_posts'   => 1,
                'posts_per_page'        => $postsPerPage,
                'meta_key' => $meta_key,
                'date_query' => $date
            );

        return $args;

    }
}

if( !function_exists('ut_elementor_addons_lite_letter_count') ){
    function ut_elementor_addons_lite_letter_count( $content, $limit ) {
        if( !empty($limit) && ($limit != 0) ){
            $striped_content = strip_tags( $content );
            $striped_content = strip_shortcodes( $striped_content );
            $limit_content = mb_substr( $striped_content, 0, $limit );

            if ( strlen( $limit_content ) < strlen( $content ) ) {
                $limit_content .= "...";
            }
            return '<div class="content-excerpt">'. $limit_content . '</div>';
        }
    }
}

if( ! function_exists('ut_elementor_addons_lite_post_categories') ){

    function ut_elementor_addons_lite_post_categories( $args = array( 'id' => '', 'option' => true ) ) {

        echo '<span class="blog-category">' . wp_kses_post(get_the_category_list(', ')) . '</span>';
        
    }
}


if( ! function_exists('ut_elementor_addons_lite_post_author') ){

    function ut_elementor_addons_lite_post_author( ) {

        echo '<span class="blog-author"><span class="blog-by">'. esc_html('By','ut-elementor-addons-lite') . '</span> ' . esc_html( get_the_author() ) . '</span>';
            
    }
}
if( ! function_exists('ut_elementor_addons_lite_post_date') ){

    function ut_elementor_addons_lite_post_date( ) {

        echo '<span class="blog-date">' . esc_html(get_the_date(get_option('date_format'))) . '</span>';
            
    }
}

function ut_elementor_addons_lite_get_cutomizer_logo(){
    $custom_logo_id_func = get_theme_mod( 'custom_logo' );
    $site_logo_img = wp_get_attachment_image_url( $custom_logo_id_func , 'full' );
    ob_start();
    ?>
    <?php if ($custom_logo_id_func): ?>
        <img src="<?php echo esc_attr($site_logo_img); ?>" alt="custom_logo">
    <?php endif ?>
    <?php
    $site_logo_img_url = ob_get_clean();
    return $site_logo_img_url;
}
function ut_elementor_addons_lite_navmenu_navbar_menu_select() {
    $menus_item = wp_get_nav_menus();
    $items = array();
    $i     = 0;
    foreach ( $menus_item as $menu_item ) {
        if ( $i == 0 ) {
            $default = $menu_item->slug;
            $i ++;
        }
        $items[ $menu_item->slug ] = $menu_item->name;
    }

    return $items;
}

function ut_elementor_addons_lite_get_menus() {

    $menus = wp_get_nav_menus();
    $items = ['0' => esc_html__( 'Select Menu', 'ut-elementor-addons-lite' ) ];
    foreach ( $menus as $menu ) {
        $items[ $menu->slug ] = $menu->name;
    }

    return $items;
}



if ( !function_exists( 'ut_elementor_addons_lite_get_elementor_templates' ) ) {

    function ut_elementor_addons_lite_get_elementor_templates() {
        $args = [
            'post_type' => 'elementor_library',
        ];

        $page_templates = get_posts( $args );

        $options = array();

        if ( !empty( $page_templates ) && !is_wp_error( $page_templates ) ) {
            $options['0'] = esc_html__('Select Template','ut-elementor-addons-lite');
            foreach ( $page_templates as $post ) {
                $options[ $post->ID ] = $post->post_title;
            }
        }
        return $options;
    }

}


if( ! function_exists('ut_elementor_addons_lite_sidebar_options') ){

    function ut_elementor_addons_lite_sidebar_options() {

        global $wp_registered_sidebars;
        $sidebar_options = [];

        if ( ! $wp_registered_sidebars ) {
            $sidebar_options['0'] = esc_html__( 'No sidebars were found', 'ut-elementor-addons-lite' );
        } else {
            $sidebar_options['0'] = esc_html__( 'Select Sidebar', 'ut-elementor-addons-lite' );

            foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar ) {
                $sidebar_options[ $sidebar_id ] = $sidebar['name'];
            }
        }

        return $sidebar_options;
    }
}
