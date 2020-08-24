<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ultrapress
 */
$current_post_id = get_the_ID();
$terms_assets = get_the_terms( $current_post_id , 'category' );
?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="card default">
		<?php 
		if (has_post_thumbnail()): 
			$post_image_url = get_the_post_thumbnail_url($current_post_id , 'ultrapress_archive_default');
			?>
			<figure>
				<a href="<?php the_permalink();?>">	
					<img class="card-img-top" src="<?php echo esc_url($post_image_url);?>" alt="<?php the_title_attribute();?>">
				</a>
			</figure>
			<?php 
		endif;			
		?>
		<div class="content-default">
			<span class="category-default">
				<?php ultrapress_post_cat_lists(); ?>
			</span>
			<h3 class="title-default">
				<a href="<?php the_permalink();?>"><?php the_title();?></a>
			</h3>
		</div>
	</div>
</div><!-- <?php the_ID(); ?> -->
 