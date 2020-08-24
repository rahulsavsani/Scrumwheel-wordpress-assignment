<?php 
/**
 * Ultrapress Functions
 *
 * @package ultrapress
 */

/* Get Elementor Templates */
if(!function_exists('ultrapress_get_elementor_templates')){
	function ultrapress_get_elementor_templates( $type = '' ) {
		$args = [
			'post_type'         => 'elementor_library',
			'posts_per_page'    => -1,
		];

		if ( $type ) {
			$args['tax_query'] = [
				[
					'taxonomy' => 'elementor_library_type',
					'field'    => 'slug',
					'terms' => $type,
				]
			];
		}

		$page_templates = get_posts( $args );

		$options = array();
		if ( ! empty( $page_templates ) && ! is_wp_error( $page_templates ) ){
			$options[ '' ] = esc_html__('Choose Template','ultrapress');
			foreach ( $page_templates as $post ) {
				$options[ $post->ID ] = $post->post_title;
			}
		}
		return $options;
	}
}

/**
* Strip whitespace in dynamic style
*/
if( !function_exists('ultrapress_css_strip_whitespace') ){
    function ultrapress_css_strip_whitespace($css){
        $replace = array(
        "#/\*.*?\*/#s" => "",  // Strip C style comments.
        "#\s\s+#"      => " ", // Strip excess whitespace.
        );
        $search = array_keys($replace);
        $css = preg_replace($search, $replace, $css);
        
        $replace = array(
        ": "  => ":",
        "; "  => ";",
        " {"  => "{",
        " }"  => "}",
        ", "  => ",",
        "{ "  => "{",
        ";}"  => "}", // Strip optional semicolons.
        ",\n" => ",", // Don't wrap multiple selectors.
        "\n}" => "}", // Don't wrap closing braces.
        //"} "  => "}\n", // Put each rule on it's own line.
        );
        $search = array_keys($replace);
        $css = str_replace($search, $replace, $css);
        
        return trim($css);
    }
}


function ultrapress_color_range( $input, $min, $max ){
	if ( $input < $min ) {
		$input = $min;
	}
	if ( $input > $max ) {
		$input = $max;
	}
	return $input;
}

function ultrapress_esc_color( $input ) {

	if ( false === strpos( $input, 'rgba' ) ) {
		// If string doesn't start with 'rgba' then santize as hex color
		$input = sanitize_hex_color( $input );
	} else {
		// Sanitize as RGBa color
		$input = str_replace( ' ', '', $input );
		sscanf( $input, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
		$input = 'rgba(' . ultrapress_color_range( $red, 0, 255 ) . ',' . ultrapress_color_range( $green, 0, 255 ) . ',' . ultrapress_color_range( $blue, 0, 255 ) . ',' . ultrapress_color_range( $alpha, 0, 1 ) . ')';
	}
	return $input;
}

/* Get Page Meta Options */
if(!function_exists('ultrapress_get_page_options')){
	function ultrapress_get_page_options($key,$default=''){
		$id = get_the_ID();
		$page_meta = get_post_meta($id,'ultrapress_page_options',true);
		if(is_serialized( $page_meta )){
			$page_meta = unserialize($page_meta);
		}
		if( isset( $page_meta[$key] ) ){
			return $page_meta[$key];
		}else{
			return $default;
		}
		
	}
}

/* Ultrapress Container Check */
if(!function_exists('ultrapress_container')){
	function ultrapress_container(){

		$container_disable = ultrapress_get_page_options('disable_container',0);
		$container_type = ultrapress_get_page_options('container_width','container');
        if($container_disable == 1){
        	$class = 'no-container';
        }else{
        	$class = $container_type;
        }

        echo esc_attr($class);
	}
}

/* Ultrapress Sidebar Layouts */
if(!function_exists('ultrapress_sidebar_layouts')){
	function ultrapress_sidebar_layouts($page=''){
		switch ($page) {
			case 'page':
				$playout = ultrapress_get_page_options('sidebar_positions','default');
				if($playout == 'default'){
					$sidebar = get_theme_mod('ultrapress_page_sidebar_layout','no-sidebar');
			    }else{
			    	$sidebar = $playout;
			    }
				break;

			case 'post':
				$sidebar = get_theme_mod('ultrapress_post_sidebar_layout','no-sidebar');
				break;

			case 'archive':
				$sidebar = get_theme_mod('ultrapress_archive_sidebar_layout','right-sidebar');
				break;

			case 'shop':
				$sidebar = get_theme_mod('ultrapress_shop_sidebar_layout','right-sidebar');
				break;	
			
			default:
				$sidebar = get_theme_mod('ultrapress_page_sidebar_layout','no-sidebar');
				break;
				
		}

		if($sidebar == 'no-sidebar'){
			return $sidebar;
		}else{
			return $sidebar.' has-sidebar';
		}
	}
}

/*Ultrapress banner enable check */
if(!function_exists('ultrapress_is_banner_enable')){
	function ultrapress_is_banner_enable(){

	    $enable_banner_default = get_theme_mod('ultrapress_breadcrumb_banner_switch',true);
	    if(is_page()){
	    	$meta_banner = ultrapress_get_page_options('show_banner',1);
		    if($enable_banner_default == true && $meta_banner){
		    	$enable_banner = $meta_banner;
			}else{
				$enable_banner = false;
			}
		}else{
			$enable_banner = $enable_banner_default;
		}

	    return $enable_banner;
	}
}

/* Ultrapress Transparent Header Check */
if(!function_exists('ultrapress_is_header_transparent')){
	function ultrapress_is_header_transparent(){

		$trans_header = ultrapress_get_page_options('trans_header',0);
		$trans_single = get_theme_mod('ultrapress_single_layout','layout2');

		if($trans_header){
			$class = 'is-transparent';
		}elseif($trans_single == 'layout1' && is_single()){
			$class = 'is-transparent';
		}else{
			$is_transparent = get_theme_mod('ultrapress_trans_header_switch',0);
			if ($is_transparent == 1) {
				$class = 'is-transparent';
			}else{
				$class = '';
			}
		}
		if(class_exists('woocommerce') && is_product()){
			$class = '';
		}
		return esc_attr($class);

	}
}

/* Ultrapress Banner Styles */
if(!function_exists('ultrapress_title_banner_styles')){
	function ultrapress_title_banner_styles(){
		$b_color = get_theme_mod('ultrapress_bread_banner_bg_color');
		$b_image = get_theme_mod('ultrapress_bread_banner_bg_image');
		$b_overlay = get_theme_mod('ultrapress_bread_banner_bg_overlay','rgba(0, 0, 0, 0.1)');
		$b_height = get_theme_mod('ultrapress_bread_banner_height',150);
		$text_color = get_theme_mod('ultrapress_bread_title_color');
		$text_size = get_theme_mod('ultrapress_bread_title_size');
		$bread_nav = get_theme_mod('ultrapress_bread_nav_color');
		$bread_nav_hover = get_theme_mod('ultrapress_bread_nav_hover_color');

		$bp_bgcolor = ultrapress_get_page_options('banner_bgcolor');
		$bp_image = ultrapress_get_page_options('banner_bgimage');
		if(!empty($bp_image)){
			$bp_image = wp_get_attachment_image_url($bp_image,'large');
		}
		$bp_height = ultrapress_get_page_options('banner_height');
		$bp_color = ultrapress_get_page_options('banner_textcolor');

		$bg_styles = array(
			'b-color' => !empty($bp_bgcolor) ? $bp_bgcolor : $b_color,
			'b-image' => !empty($bp_image) ? $bp_image : $b_image,
			'b-height' => !empty($bp_height) ? $bp_height : $b_height,
			'b-overlay' => $b_overlay,
			't-color' => !empty($bp_color) ? $bp_color : $text_color,
			't-size' => $text_size,
			'bread-color' => !empty($bp_color) ? $bp_color : $bread_nav,
			'bread-hover' => $bread_nav_hover
		);

		return $bg_styles;
	}
}

/* Ultrapress Page Banner */
if(!function_exists('ultrapress_title_banner')){
function ultrapress_title_banner(){
	$bread_show = get_theme_mod('ultrapress_breadcrumb_switch',1);
	if($bread_show){
		$bread_show = ultrapress_get_page_options('show_breadcrumb',1);
	}
	$banner_styles = ultrapress_title_banner_styles();
    $title_position = get_theme_mod('ultrapress_banner_title_position','wide');

    if(!empty($banner_styles['b-image'])){
    	$title_position .= ' overlay has-bg-image';
    }

    $title_position .= ' header-'.ultrapress_is_header_transparent();
	if (ultrapress_is_banner_enable()): ?>
		<section class="breadcumb-section <?php echo esc_attr($title_position);?>">
			<div class="container">
				<div class="title-banner-wrapper">
				    <?php
                    if( is_home() ){

                        $title =  get_option('page_for_posts');
                        if($title){
                            echo '<h1 class="breadcrumb-title">'.  wp_kses_post(get_the_title($title)).'</h1>' ;
                        }else{
                            echo '<h1 class="breadcrumb-title">'.esc_html__('Blog','ultrapress').'</h1>';
                        }    
                    }elseif(class_exists('woocommerce') && is_shop() ){
                        echo '<h1 class="breadcrumb-title">';
                        	woocommerce_page_title();
                        echo '</h1>';
                    }elseif(class_exists('woocommerce') && is_product()){

                        the_title('<h1 class="breadcrumb-title">', '</h1>');
                    }
                    elseif(is_archive()) {
                       the_archive_title( '<h1 class="breadcrumb-title">', '</h1>' );

                    }elseif(is_single()){
                    	the_title('<h1 class="breadcrumb-title">', '</h1>');
                    } elseif(is_singular('page') ) {
                        wp_reset_postdata();
                        $meta = get_post_meta(get_the_ID(),'ultrapress_page_options',true);
                        $custom_title = ultrapress_get_page_options('custom_title');
                        $custom_subtitle = ultrapress_get_page_options('custom_subtitle');
                    	if($custom_subtitle){
                    		echo '<div class="custom-title-wrap">';
                    	}
                        if($custom_title){
                            echo '<h1 class="breadcrumb-title">'.esc_html($custom_title).'</h1>';
                        }else{
                            echo '<h1 class="breadcrumb-title">'.esc_html(get_the_title()).'</h1>';
                        }
                        if($custom_subtitle){
                            echo '<p>'.wp_kses_post($custom_subtitle).'</p>';
                            echo '</div>';
                        }

                    } elseif(is_search()) {
                        ?>
                        <h1 class="breadcrumb-title">
                            <?php 
                            /* translators: %s: search term */
                            printf(esc_html__( 'Search Results for: %s', 'ultrapress' ), '<span>' . get_search_query() . '</span>' ); ?>
                        </h1>
                        <?php
                    } elseif(is_404()) {
                        ?>
                        <h1 class="breadcrumb-title"><?php esc_html_e( '404 Error', 'ultrapress' ); ?></h1>
                        <?php
                    }else{
                    	the_archive_title( '<h1 class="breadcrumb-title">', '</h1>' );
                    }
                    if($bread_show){
	                    if(class_exists('woocommerce') && is_woocommerce()){
							ultrapress_product_breadcrumb();
	                    }else{
							ultrapress_breadcrumbs();
						}
					}
					?>	
				</div>
			</div>
		</section>
	    <?php 
	else:
		if($bread_show){
		echo '<div class="ultrapress-breadcrumb-wrap"><div class="container">';	
            if(class_exists('woocommerce') && is_woocommerce()){
				ultrapress_product_breadcrumb();
            }else{
				ultrapress_breadcrumbs();
			}
		}  
		echo '</div></div>';  
    endif; 
}
}

/* Get Cat Lists */
if( ! function_exists( 'ultrapress_post_cat_lists' ) ) :
    function ultrapress_post_cat_lists() {

        // Hide category and tag text for pages.
        if ( 'post' === get_post_type() ) {
            global $post;
            $categories = get_the_category();
            $output = '';
            if( $categories ) {
            	echo '<span class="post-cats">';
            	$count = 0;
                foreach( $categories as $category ) {
					$count ++;
					if($count > 1){
						echo ', &nbsp;';
					}
                    echo '<a href="'.esc_url(get_category_link( $category->term_id )).'" class="cat-links cat-' . esc_attr($category->term_id) . '" rel="category">'.esc_html($category->cat_name).'</a>';                   
                }
                echo '</span>';
            }
        }
    }
endif;

/* Get Post Tags */
if( ! function_exists( 'ultrapress_get_post_tags' ) ) :
function ultrapress_get_post_tags(){

	if ( 'post' === get_post_type() ) {
		$posttags = get_the_tags();
		if ($posttags) {
			echo '<span class="post-tags">';
			$count = 0;
			foreach($posttags as $tag) {
				$count ++;
				if($count > 1){
					echo ', &nbsp;';
				}
				echo '<a href="'.esc_url(get_tag_link( $tag->term_id )).'" class="tag-links tag-' . esc_attr($tag->term_id) . '" rel="tag">'.esc_html($tag->name).'</a>'; 
			}
			echo '</span>';
		}
	}	

}
endif;

/* Get Author image */
if(!function_exists('ultrapress_get_by_author')){
	function ultrapress_get_by_author(){
        global $post; 
        $author_id = $post->post_author;
		$byline = sprintf(
		/*translators: author link */
		esc_html( '%s'),
		'<span class="author vcard post-author"><a class="url" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><span class="author-img">'.get_avatar( get_the_author_meta('ID'), 50 ).'</span><span class="author-name">' . esc_html( get_the_author_meta( 'nickname', $author_id ) ) . '</span></a></span>'
		);
		echo '<span class="post-author">'. $byline .'</span>';// WPCS: XSS OK.
	}
}

/* Ultrapress Post Meta */
if(!function_exists('ultrapress_post_meta')){
	function ultrapress_post_meta(){
		$meta_show = get_theme_mod('ultrapress_meta_switch',true);
		if($meta_show):
		$meta_order = get_theme_mod( 'ultrapress_meta_reorder', 'author,date,category,tags,comments');
		$meta_explodes = explode(',', $meta_order);
		echo '<div class="meta-info">';
			foreach ($meta_explodes as $meta_explode) {
				if ( 'comments' === $meta_explode ) {
					?>
			        <span class="post-comment"> 
			            <a href="<?php echo esc_url( get_permalink() ) ?>#comments">
			                <?php
								echo absint(number_format_i18n( get_comments_number() ));
			                ?>
			            </a> 
			        </span> 
					<?php
				} elseif ( 'category' === $meta_explode ) {

					ultrapress_post_cat_lists();

				} elseif ( 'author' === $meta_explode ) {

					ultrapress_get_by_author();

				} elseif ( 'date' === $meta_explode ) {

					echo '<span class="post-date">';
					echo get_the_date();
					echo '</span>';

				} elseif ( 'tags' === $meta_explode ) {
					ultrapress_get_post_tags();
				}

			}

		echo '</div>';
		endif;
	}
}

/* ultrapress archive excerpt length */
function ultrapress_excerpt_length( $length ) {
    $excerpt_length =  get_theme_mod( 'ultrapress_archive_excerpt_lenghth', 80 );
    return $excerpt_length;
}
add_filter( 'excerpt_length', 'ultrapress_excerpt_length', 999 );

