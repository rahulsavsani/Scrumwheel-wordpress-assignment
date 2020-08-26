<?php
/**
 * Template part for displaying job_opening posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package UltraPress
 */

// Enqueue bootstrap styles

wp_enqueue_style('bootstrap');
wp_enqueue_style('bootstrap.min');
wp_enqueue_style('bootstrap-grid');
wp_enqueue_style('bootstrap-grid.min');
wp_enqueue_style('bootstrap-reboot');
wp_enqueue_style('bootstrap-reboot.min');

$post_order = get_theme_mod( 'ultrapress_post_content_reorder', 'featured_image,title,meta_tag,content,coments,navigation');
$post_explodes = explode(',', $post_order);
$upload_dir = wp_upload_dir();
$attach_id = $upload_dir['baseurl'].'/2020/07/video-image-2.jpg';
$thumbnail_id = attachment_url_to_postid($attach_id);
set_post_thumbnail(get_the_ID(), $thumbnail_id);
set_post_thumbnail_size(1024,1024);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    $baseurl = get_site_url();
    foreach ($post_explodes as $post_explode):

        if ('title' === $post_explode) {
            ?>
            <header class="entry-header">
                <h1><?php the_title(); ?></h1>
            </header>
            <?php
        }
        elseif('content' === $post_explode) {
            ?>
            <h2>
                <?php the_title();?>
            </h2>
            <div class="entry-content">

                <?php
                $cat = get_the_terms(get_the_ID(), 'job-category');
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
                    echo '</br> Category &nbsp;&nbsp;: '. $cat[0]->name;
                    ?>
                </div>
                <?php
                echo '</br></br> <b>Required Skills:</b> </br></br>'. get_post_meta(get_the_ID(), 'required_skills', true);
                echo '</br></br>';
                ?>

                <button type="submit" class="search-submit" name="apply" id="apply" onclick="window.location='<?php echo get_site_url();?>/apply<?php echo "?job="; the_title();?>'">Apply Now</button>
            </div>
            <?php
        }elseif ('navigation' === $post_explode) {
            ultrapress_single_post_pagination();
        }
    endforeach;
    ?>
</article><!-- #post-<?php the_ID(); ?> -->
