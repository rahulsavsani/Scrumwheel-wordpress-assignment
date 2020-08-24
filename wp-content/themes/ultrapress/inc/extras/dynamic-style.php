<?php
function ultrapress_dynamic_styles(){
    ob_start();
    /* Anchor styles */
    $acolor = get_theme_mod('ultrapress_anchor_color');
    $ahover = get_theme_mod('ultrapress_anchor_hover_color');
    if($acolor){
        ?>
        a, .meta-info>span a, .meta-info>span{ color: <?php echo ultrapress_esc_color($acolor)?>;}
        <?php
    }
    if($ahover){
        ?>
        a:hover,a:focus,a:visited, .meta-info>span:hover a, .meta-info>span:hover{ color: <?php echo ultrapress_esc_color($ahover)?>;}
        <?php
    }
    
    /* Theme Color */
    $theme_color = get_theme_mod('ultrapress_theme_skin_color');
    if($theme_color){
        ?>
        .input[type="submit"], .mini-cart span.header-cart-count, .widget .widget-title:before,.right-resurved a{ color: <?php echo ultrapress_esc_color($theme_color)?>;}
        <?php
    }

    /* Title Banner Styles */
    $banner_styles = ultrapress_title_banner_styles();
    ?>
    section.breadcumb-section{
        <?php if(!empty($banner_styles['b-color'])){?>
        background-color: <?php echo ultrapress_esc_color($banner_styles['b-color'])?>;
        <?php } if(!empty($banner_styles['b-image'])){?>
        background-image: url(<?php echo esc_url($banner_styles['b-image'])?>);
        <?php } if(!empty($banner_styles['b-height'])){?>
        min-height: <?php echo absint($banner_styles['b-height'])?>px;
        height: <?php echo absint($banner_styles['b-height'])?>px;
        <?php }?>
    }
    <?php
    if(!empty($banner_styles['b-overlay'])){
        ?>
        .breadcumb-section.overlay:before{
            background: <?php echo ultrapress_esc_color($banner_styles['b-overlay'])?>;
        }
        <?php
    }
    if(!empty($banner_styles['t-color'])){
        ?>
        h1.breadcrumb-title,.custom-title-wrap p{
            color: <?php echo ultrapress_esc_color($banner_styles['t-color'])?>;
        }
        <?php
    }
    if(!empty($banner_styles['t-size'])){
        ?>
        h1.breadcrumb-title{
            font-size: <?php echo absint($banner_styles['t-size'])?>px;
        }
        <?php
    }
    if(!empty($banner_styles['bread-color'])){
        ?>
        #ultrapress-breadcrumb a,#ultrapress-breadcrumb .delimiter,#ultrapress-breadcrumb .current{
            color: <?php echo ultrapress_esc_color($banner_styles['bread-color'])?>;
        }
        <?php
    }
    if(!empty($banner_styles['bread-hover'])){
        ?>
        #ultrapress-breadcrumb a:hover{
            color: <?php echo ultrapress_esc_color($banner_styles['bread-hover'])?>;
        }
        <?php
    }

    /* Typography Styles */
    $body_font = json_decode(get_theme_mod('ultrapress_body_font_family','{"font":"Lato","regularweight":"regular","italicweight":"italic","boldweight":"regular","category":"sans-serif"}'),true);
    if($body_font['boldweight'] == 'regular'){
        unset($body_font['boldweight']);
        $body_font['boldweight'] = 'normal';
    }
    $body_fsize = get_theme_mod('ultrapress_body_font_size');
    $b_lheight = get_theme_mod('ultrapress_body_line_height');
    $b_tcolor = get_theme_mod('ultrapress_body_font_color');
    $heading_font = json_decode(get_theme_mod('ultrapress_heading_font_family','{"font":"Lato","regularweight":"regular","italicweight":"italic","boldweight":"regular","category":"sans-serif"}'),true);
    if($heading_font['boldweight'] == 'regular'){
        unset($heading_font['boldweight']);
        $heading_font['boldweight'] = 'normal';
    }
    $h_tcolor = get_theme_mod('ultrapress_heading_font_color');
    $h1 = get_theme_mod('ultrapress_h1_font_size');
    $h2 = get_theme_mod('ultrapress_h2_font_size');
    $h3 = get_theme_mod('ultrapress_h3_font_size');
    $h4 = get_theme_mod('ultrapress_h4_font_size');
    $h5 = get_theme_mod('ultrapress_h5_font_size');
    $h6 = get_theme_mod('ultrapress_h6_font_size');
    if($body_font){
        ?>
        body,button, input, select, optgroup, textarea{
            font-family: "<?php echo esc_attr($body_font['font']);?>";
            font-weight: <?php echo esc_attr($body_font['boldweight']);?>;
            <?php if($body_fsize){?>
            font-size: <?php echo absint($body_fsize);?>px;
            <?php } if($b_lheight){?>
            line-height: <?php echo floatval($b_lheight);?>em;
            <?php } if($b_tcolor){?>
            color: <?php echo ultrapress_esc_color($b_tcolor);?>;
            <?php }?> 
        }
        <?php
    }
    if($heading_font){
        ?>
        h1,h2,h3,h4,h5,h6{
            font-family: "<?php echo esc_attr($heading_font['font']);?>";
            font-weight: <?php echo esc_attr($heading_font['boldweight']);?>;
            <?php if($h_tcolor){?>
            color: <?php echo ultrapress_esc_color($h_tcolor);?>;
            <?php }?> 
        }
        <?php
    }
    if($h1){
        ?>
        h1{ font-size: <?php echo absint($h1);?>px;}
        <?php
    }
    if($h2){
        ?>
        h2,.widget h2.widget-title{ font-size: <?php echo absint($h2);?>px;}
        <?php
    }
    if($h3){
        ?>
        h3{ font-size: <?php echo absint($h3);?>px;}
        <?php
    }
    if($h4){
        ?>
        h4{ font-size: <?php echo absint($h4);?>px;}
        <?php
    }
    if($h5){
        ?>
        h5{ font-size: <?php echo absint($h5);?>px;}
        <?php
    }
    if($h6){
        ?>
        h6{ font-size: <?php echo absint($h6);?>px;}
        <?php
    }

    /* Header Styles */
    $header_bg = get_theme_mod('ultrapress_header_background');
    $nav_color = get_theme_mod('ultrapress_header_nav_text_color');
    $nav_hcolor = get_theme_mod('ultrapress_header_nav_text_hcolor');
    $nav_size = get_theme_mod('ultrapress_nav_font_size');

    $btn_bg = get_theme_mod('ultrapress_purchase_btn_background');
    $btn_hbg = get_theme_mod('ultrapress_purchase_btn_hover_background');
    $btn_color = get_theme_mod('ultrapress_purchase_btn_text_color');
    $btn_hcolor = get_theme_mod('ultrapress_purchase_btn_text_hover_color');
    $btn_border = get_theme_mod('ultrapress_purchase_btn_border_color');

    if($btn_color||$btn_bg){
        ?>
        .menu-btn-wrap a.btn.btn-secondary{
            color: <?php echo ultrapress_esc_color($btn_color);?>;
            background-color: <?php echo ultrapress_esc_color($btn_bg);?>;
            <?php if($btn_border){?>
            border-color: <?php echo ultrapress_esc_color($btn_border);?> !important;
            <?php }?>
        }
        <?php
    }
    if($btn_hcolor||$btn_hbg){
        ?>
        .menu-btn-wrap a.btn.btn-secondary:hover{
            color: <?php echo ultrapress_esc_color($btn_hcolor);?>;
            background-color: <?php echo ultrapress_esc_color($btn_hbg);?>;
            <?php if($btn_border){?>
            border-color: <?php echo ultrapress_esc_color($btn_border);?> !important;
            <?php }?>
        }
        <?php   
    }

    if($header_bg){
        ?>
        .site-header .ultrapress-default-header,.site-header .ultrapress-default-header.is-sticky{
            background-color: <?php echo ultrapress_esc_color($header_bg);?>;
        }
        <?php
    }
    if($nav_size){
        ?>
        body .navbar-nav>li>a, body .site-header .ultrapress-default-header.is-sticky .navbar-nav>li>a {
            font-size: <?php echo absint($nav_size);?>px;
        }
        <?php
    }
    if($nav_color){
        ?>
        body .navbar-nav>li>a, body .site-header .ultrapress-default-header.is-sticky .navbar-nav>li>a {
            color: <?php echo ultrapress_esc_color($nav_color);?>;
        }
        .ultrapress-default-header.is-sticky .mini-cart a.dropdown svg, .mini-cart a.dropdown svg{
            fill: <?php echo ultrapress_esc_color($nav_color);?>;
        }
        <?php
    }
    if($nav_hcolor){
        ?>
        body .navbar-nav li>a:hover,body .site-header .navbar-nav>li.current_page_item>a,body .site-header .navbar-nav>li>a:hover{
            color: <?php echo ultrapress_esc_color($nav_hcolor);?>;
        }
        .ultrapress-default-header.is-sticky .mini-cart a:hover svg, .mini-cart a:hover svg{
            fill: <?php echo ultrapress_esc_color($nav_hcolor);?>;
        }
        ul.navbar-nav>li.menu-item:hover>a:before, ul.navbar-nav>li.menu-item:focus>a:before, ul.navbar-nav>li.menu-item.current_page_item>a:before, nav.navbar ul.navbar-nav>li.menu-item>a:after,.ultrapress-default-header.is-sticky nav.navbar ul.navbar-nav>li.menu-item>a:before{
            background-color: <?php echo ultrapress_esc_color($nav_hcolor);?> !important;
        }
        <?php
    }

    /* Meta Styles */
    $meta_color = get_theme_mod('ultrapress_meta_color');
    $meta_size = get_theme_mod('ultrapress_meta_font_size');
    if($meta_color || $meta_size){
        ?>
        .meta-info>span a,.meta-info>span{
            <?php if($meta_color){?>
            color: <?php echo ultrapress_esc_color($meta_color);?>;
            <?php } if($meta_size){?>
            font-size: <?php echo absint($meta_size);?>px;
            <?php }?>
        }
        <?php
    }

    /* Button Styles */
    $btn_color = get_theme_mod('ultrapress_theme_btn_text_color');
    $btn_hcolor = get_theme_mod('ultrapress_theme_btn_text_hcolor');
    $btn_bg = get_theme_mod('ultrapress_theme_btn_color');
    $btn_hbg = get_theme_mod('ultrapress_theme_btn_hcolor');
    if($btn_color||$btn_bg){
        ?>
        a.blog-btn, .btn, input[type="submit"], input[type="button"], button{
            color: <?php echo ultrapress_esc_color($btn_color);?>;
            background-color: <?php echo ultrapress_esc_color($btn_bg);?>;
        }
        <?php
    }
    if($btn_hcolor||$btn_hbg){
        ?>
        a.blog-btn:hover, .btn:hover, input[type="submit"]:hover, input[type="button"]:hover, button:hover{
            color: <?php echo ultrapress_esc_color($btn_hcolor);?>;
            background-color: <?php echo ultrapress_esc_color($btn_hbg);?>;
        }
        <?php   
    }

    /* Mini cart buttons */
    $mini_btn_bg = get_theme_mod('ultrapress_mc_button_bg_color');
    $mini_btn_hbg = get_theme_mod('ultrapress_mc_button_bg_hcolor');
    $mini_btn_txt = get_theme_mod('ultrapress_mc_button_text_color');
    $mini_btn_htxt = get_theme_mod('ultrapress_mc_button_text_hcolor');
    if($mini_btn_bg || $mini_btn_txt){
        ?>
        body .widget_shopping_cart_content p.woocommerce-mini-cart__buttons.buttons a.button.wc-forward{
            <?php if($mini_btn_bg){?>
            background-color: <?php echo ultrapress_esc_color($mini_btn_bg);?>!important;
            <?php } if($mini_btn_txt){?>
            color: <?php echo ultrapress_esc_color($mini_btn_txt);?>!important;
            <?php }?>
        }
        <?php
    }
    if($mini_btn_hbg || $mini_btn_htxt){
        ?>
        
        body .widget_shopping_cart_content p.woocommerce-mini-cart__buttons.buttons a.button.wc-forward:hover{
            <?php if($mini_btn_hbg){?>
            background-color: <?php echo ultrapress_esc_color($mini_btn_hbg);?>!important;
            <?php } if($mini_btn_htxt){?>
            color: <?php echo ultrapress_esc_color($mini_btn_htxt);?>!important;
            <?php }?>
        }
        <?php
    }

    /* Scroll Top */
    $scroll_bg = get_theme_mod('ultrapress_scroll_top_bg');
    $scroll_hbg = get_theme_mod('ultrapress_scroll_top_bg_hover');
    $scroll_color = get_theme_mod('ultrapress_scroll_top_color');
    $scroll_hcolor = get_theme_mod('ultrapress_scroll_top_hover_color');
    if($scroll_bg||$scroll_color){
        ?>
        a.scroll-to-top{
            background-color: <?php echo ultrapress_esc_color($scroll_bg);?>;
        }
        .scroll-to-top span{
            background-color: <?php echo ultrapress_esc_color($scroll_color);?>;
        }
        <?php
    }
    if($scroll_hcolor||$scroll_hbg){
        ?>
        a.scroll-to-top:hover{
            background-color: <?php echo ultrapress_esc_color($scroll_hbg);?>;
        }
        .scroll-to-top:hover span{
            background-color: <?php echo ultrapress_esc_color($scroll_hcolor);?>;
        }
        <?php   
    }

    /* Footer Styles */
    $footer_bg = get_theme_mod('ultrapress_footer_bg_color');
    $footer_text = get_theme_mod('ultrapress_footer_text_color');
    if($footer_bg){
        ?>
        .site-footer{ background-color: <?php echo ultrapress_esc_color($footer_bg);?>; }
        <?php
    }
    if($footer_text){
        ?>
        .site-footer .right-resurved p{ color: <?php echo ultrapress_esc_color($footer_text);?>;}
        <?php
    }

    $css = ob_get_clean();
    $css = ultrapress_css_strip_whitespace($css);
    wp_add_inline_style( 'ultrapress-responsive', $css );
}
add_action('wp_enqueue_scripts','ultrapress_dynamic_styles',999);