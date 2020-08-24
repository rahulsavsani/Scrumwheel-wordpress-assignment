<?php
/**
* Functions which enhance the theme by hooking into WordPress
*
* @package ultrapress
*/
/**
* Adds custom classes to the array of body classes.
*
* @param array $classes Classes for the body element.
* @return array
*/
function ultrapress_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

    $sticky_header = get_theme_mod('ultrapress_sticky_header_switch',0);
    if($sticky_header){
        $classes[] = 'sticky-header';
    }
    if(is_singular('post')){
        $post_layout = get_theme_mod('ultrapress_single_layout','layout2');
        $classes[] = 'single-'.$post_layout;
    }

 	return $classes;
}
add_filter( 'body_class', 'ultrapress_body_classes' );

/**
* Add a pingback url auto-discovery header for single posts, pages, or attachments.
*/
function ultrapress_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'ultrapress_pingback_header' );


/* Single Post Pagination */
if(!function_exists('ultrapress_single_post_pagination')){
    function ultrapress_single_post_pagination(){ ?>  
        <ul class="single-pagination-bar normal-list no-points d-flex vertical-center">
            <?php
            $prevPost = get_previous_post();
            if ( is_a( $prevPost , 'WP_Post' ) ) : 
                $prevtitle = esc_html(get_the_title($prevPost->ID)); 
                $prevthumbnail = get_the_post_thumbnail($prevPost->ID,'thumbnail'); 
                $length = strlen( $prevtitle );
                if( $length > 90 ) {
                    $prevtitle = substr( $prevtitle, 0, 90 );
                    $prevtitle = $prevtitle . ' &hellip;';
                }
                ?>
                <li class="page-bar-prev">
                    <a href="<?php echo esc_url(get_permalink($prevPost->ID));?>" class="link-cover">&nbsp;</a>
                    <div class="pagi-main-wrap d-flex vertical-center">
                        <div class="pagi-content-wrap">
                            <span class="custom-chevron prev"></span>
                            <span class="label"><?php esc_html_e('Previous Post','ultrapress');?></span>
                            <h4 class="article-name"><?php echo esc_html($prevtitle);?></h4>
                        </div>
                        <?php
                        if($prevthumbnail){ ?>
                            <span class="pag-img prev-image">
                                <?php echo wp_kses_post($prevthumbnail); ?>
                            </span>
                        <?php } ?>
                    </div>
                </li>
                <?php
            endif;
            ?>
            <?php
            $nextPost = get_next_post();
            if ( is_a( $nextPost , 'WP_Post' ) ) :
                $nextitle = esc_html(get_the_title($nextPost->ID)); 
                $nextthumbnail = get_the_post_thumbnail($nextPost->ID,'thumbnail'); 
                $length = strlen( $nextitle );
                if( $length > 90 ) {
                    $nextitle = substr( $nextitle, 0, 90 );
                    $nextitle = $nextitle . ' &hellip;';
                }
                ?>
                <li class="page-bar-next">
                    <a href="<?php echo esc_url(get_permalink($nextPost->ID));?>" class="link-cover">&nbsp;</a>
                    <div class="pagi-main-wrap d-flex vertical-center r-reverse">
                        <div class="pagi-content-wrap">
                            <span class="custom-chevron next"></span>
                            <span class="label"><?php esc_html_e('Next Post','ultrapress');?></span>
                            <h4 class="article-name"><?php echo esc_html($nextitle); ?></h4>
                        </div>
                        <?php
                        if($nextthumbnail){ ?>
                            <span class="pag-img next-image">
                                <?php echo wp_kses_post($nextthumbnail); ?>
                            </span>
                        <?php } ?>
                    </div>
                </li>
                <?php
            endif;
            ?>      
        </ul> 

    <?php 
    } 
}

/* Scroll Top */
add_action( 'ultrapress_after_footer', 'ultrapress_scroll_top_function', 10);
if(!function_exists('ultrapress_scroll_top_function')){
    function ultrapress_scroll_top_function(){
        $slayout = get_theme_mod( 'ultrapress_scroll_top_layout', 'square' );
        $sposition = get_theme_mod('ultrapress_scroll_top_position','right');
        $s_switch = get_theme_mod( 'ultrapress_scroll_top_switch', true );
        if ($s_switch) {
            ?>
            <a href="javascript:void(0)" class="scroll-to-top <?php echo esc_attr($slayout.' position-'.$sposition);?>" style="display:none;"><span></span><span></span></a>
            <?php
        }
    }
}


