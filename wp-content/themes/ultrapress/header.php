<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package UltraPress
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php 
	if ( function_exists( 'wp_body_open' ) ) {
		wp_body_open();
	} ?>
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'ultrapress' ); ?></a>
	<div id="page" class="site">
		<?php do_action('ultrapress_scroll_to_top'); ?>
		
		<?php
		$header_layout = ultrapress_get_page_options('header_type','default');
		if($header_layout == 'default'){
			$header_layout = get_theme_mod('ultrapress_header_layouts','default');
		}
        do_action('ultrapress_before_header');
		if ($header_layout != 'hide'): ?>
			<header class="site-header">
				<?php get_template_part('template-parts/header/header',$header_layout);?>
			</header>
		<?php endif;?>	
		<?php do_action('ultrapress_after_header');?>
 		<div id="content" class="site-content">
        