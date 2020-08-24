<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package UltraPress
 */
?>
 </div><!-- #content -->
<?php
do_action('ultrapress_before_footer');

$footer_layout = ultrapress_get_page_options('footer_type','default');
if($footer_layout == 'default'){
	$footer_layout = get_theme_mod('ultrapress_footer_layouts','default');
}
if ($footer_layout != 'hide'):
   get_template_part('template-parts/footer/footer',$footer_layout);
endif;

do_action('ultrapress_after_footer');

?>
</div><!-- #page -->
<?php wp_footer(); ?>
</body>
</html>
