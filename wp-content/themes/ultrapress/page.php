<?php
/**
 * The template for displaying all pages
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package UltraPress
 */
get_header();

ultrapress_title_banner();

$sidebar_layout = ultrapress_sidebar_layouts('page');

?>
<?php do_action('ultrapress_before_page');?>
<main id="main" class="site-main <?php echo esc_attr($sidebar_layout);?>">
	<div class="<?php ultrapress_container();?>">
        <?php do_action('ultrapress_before_page_content');?>
		<div id="primary" class="page-content-wrapper">
			<?php
			while ( have_posts() ) :
				the_post();

				get_template_part( 'template-parts/content', 'page' );

				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			endwhile;
			?>
		</div>
		<?php do_action('ultrapress_after_page_content');?>
		<?php 
		if($sidebar_layout != "no-sidebar"){
			get_sidebar(); 
		}	
		?>
	</div>
</main>
<?php do_action('ultrapress_after_page');?>
<?php
get_footer();
