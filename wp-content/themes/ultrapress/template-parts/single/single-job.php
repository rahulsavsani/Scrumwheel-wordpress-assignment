<?php
/**
 * Template part for displaying job_opening posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package UltraPress
 */


$post_order = get_theme_mod( 'ultrapress_post_content_reorder', 'featured_image,title,meta_tag,content,coments,navigation');
$post_explodes = explode(',', $post_order);
$thumbnail_id = attachment_url_to_postid('http://localhost/wordpress/wp-content/uploads/2020/07/video-image-2.jpg');
set_post_thumbnail(get_the_ID(), $thumbnail_id);
set_post_thumbnail_size(1024,1024);

// Enqueue bootstrap styles

wp_enqueue_style('bootstrap');
wp_enqueue_style('bootstrap.min');
wp_enqueue_style('bootstrap-grid');
wp_enqueue_style('bootstrap-grid.min');
wp_enqueue_style('bootstrap-reboot');
wp_enqueue_style('bootstrap-reboot.min');

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$baseurl = get_site_url();
	foreach ($post_explodes as $post_explode):
//		if ('featured_image' == $post_explode) {
//			ultrapress_post_thumbnail('full');
//		}else
		    if ('title' === $post_explode) {
			?>
			<header class="entry-header">
                <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <h1 class="display-4" align="center"><?php the_title(); ?></h1>
                    </div>

                </div>
<!--                <h1>--><?php //the_title(); ?><!--</h1>-->
			</header>
			<?php
		}
		elseif('content' === $post_explode) {
			?>

			<div class="entry-content">

				<?php
                echo get_the_term_list(get_the_ID(), 'job-category', 'Category: ', ', ', '');
                echo '</br></br>';
                echo '<b>Job Description:</b></br></br>';
				the_content();
				?>

                <div class="navbar navbar-light bg-light">
                    <?php
                        echo 'Role&emsp;&emsp;&emsp;: '. get_post_meta(get_the_ID(), 'position', true);
                        echo '</br> Vacancies &nbsp;: ';
                        echo get_post_meta(get_the_ID(), 'job_vacancies', true);
                        echo '</br> Salary &emsp;&emsp;: Upto '. get_post_meta(get_the_ID(), 'salary_range', true). ' INR';
                    ?>
                </div>
                <?php
				    echo '</br> Required Skills: &nbsp'. get_post_meta(get_the_ID(), 'required_skills', true);
				    echo '</br></br>';
                ?>

            <button type="submit" class="search-submit" name="apply" id="apply" onclick="window.location='<?php echo get_site_url();?>/apply<?php echo "?job="; the_title();?>'">Apply Now</button>
			</div>
        <!-- </form> -->
			<?php
		}elseif ('navigation' === $post_explode) {
			ultrapress_single_post_pagination();
		}
	endforeach;
	?>
</article><!-- #post-<?php the_ID(); ?> -->
