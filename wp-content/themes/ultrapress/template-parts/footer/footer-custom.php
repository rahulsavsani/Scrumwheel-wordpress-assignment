<?php

/* Custom Header */

$template_id = ultrapress_get_page_options('custom_footer');
$footer_layout = ultrapress_get_page_options('footer_type','default');

if($footer_layout == 'default'){
	$footer_layout = get_theme_mod('ultrapress_footer_layouts','default');
	$template_id = get_theme_mod('ultrapress_custom_footer');
}

if($footer_layout!='hide'){
    if($footer_layout == 'custom' && $template_id!='' && defined('ELEMENTOR_VERSION')){

        echo '<footer><div class="ultrapress-custom-footer">';
        echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( absint($template_id) );
        echo '</div></footer>';
    }
}    