<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package UltraPress
 */
$post_order = get_theme_mod( 'ultrapress_post_content_reorder', 'featured_image,title,meta_tag,content,coments,navigation');
$post_explodes = explode(',', $post_order);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
	foreach ($post_explodes as $post_explode):
		if ('featured_image' == $post_explode) {
			ultrapress_post_thumbnail('full'); 
		}elseif ('title' === $post_explode) {				
			?>
			<header class="entry-header">
				<h1><?php the_title(); ?></h1>
			</header>
			<?php
		}elseif('meta_tag' == $post_explode) {
			ultrapress_post_meta();
		}elseif('content' === $post_explode) {
			?>
			<div class="entry-content">
				<?php
				the_content();?>
			</div>
			<?php	
		}elseif ('coments' === $post_explode) {
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		}elseif ('navigation' === $post_explode) {
			ultrapress_single_post_pagination();
		}
	endforeach; 
	?>
</article><!-- #post-<?php the_ID(); ?> -->
