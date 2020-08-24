<?php 
/* Header Layouts Callback */
function ultrapress_header_layouts_cb(){
	$header_layout = get_theme_mod('ultrapress_header_layouts');
	if($header_layout == 'custom'){
		return true;
	}
	return false;
}

/* Banner Overlay Callback */
function ultrapress_bread_banner_image_cb(){
	$bg_image = get_theme_mod('ultrapress_bread_banner_bg_image');
	if(!empty($bg_image)){
		return true;
	}
	return false;
}

/* Archive Column Callback */
function ultrapress_archive_column_cb(){
	$archive_callback_option = get_theme_mod('ultrapress_archive_layout');
	if($archive_callback_option != 'list'){
		return true;
	}
	return false;
}

/* Footer Layout Callback */
function ultrapress_footer_layouts_cb(){
	$footer_layout = get_theme_mod('ultrapress_footer_layouts');
	if($footer_layout == 'custom'){
		return true;
	}
	return false;
}

/* Footer Copyright Callback */
function ultrapress_footer_copyright_cb(){
	$footer_layout = get_theme_mod('ultrapress_footer_layouts');
	if($footer_layout == 'default'){
		return true;
	}
	return false;
}

/* Shop Column Callback */
function ultrapress_shop_column_cb(){
	$display_layout = get_theme_mod('ultrapress_shop_display_layout','grid');
	if($display_layout == 'grid'){
		return true;
	}
	return false;
}
