<?php
/**
* The main template file
*
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists.
*
* @link https://developer.wordpress.org/themes/basics/template-hierarchy/
*
* @package UltraPress
*/
get_header();
ultrapress_title_banner();

$sidebar_layout = ultrapress_sidebar_layouts('archive');
$column_no = get_theme_mod('ultrapress_achive_column_no',2);
$blog_layout = get_theme_mod('ultrapress_archive_layout','list');
if($blog_layout!='list'){
	$class = $blog_layout.' col-'.$column_no;
}else{
	$class = $blog_layout;
}
$class .= ' '.$sidebar_layout;
?>

<main id="main" class="site-main">
	<section class="blog <?php echo esc_attr($class);?>">
		<div class="container">
			<div id="primary" class="blog-content-wrapper">
				<?php 
				if ( have_posts()): 
					echo '<div class="blogs">'; 
					while ( have_posts() ):
						the_post();
						
						get_template_part( 'template-parts/archive/archive', $blog_layout );
					endwhile;
					echo '</div>';
					the_posts_pagination( array(
	                  'prev_text' => '<',
	                  'next_text'  => '>',
					) );
					
				else:
					get_template_part( 'template-parts/content', 'none' );
				endif;
				?>
			</div>
			<?php 
			if($sidebar_layout != "no-sidebar"){
				get_sidebar(); 
			}	
			?>
		</div>
	</section>
</main><!-- #main -->

<?php
get_footer();
