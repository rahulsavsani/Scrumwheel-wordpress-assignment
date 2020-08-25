<?php
/**
 * The job_opening custom post type template file
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

// Enqueue bootstrap styles

wp_enqueue_style('bootstrap');
wp_enqueue_style('bootstrap.min');
wp_enqueue_style('bootstrap-grid');
wp_enqueue_style('bootstrap-grid.min');
wp_enqueue_style('bootstrap-reboot');
wp_enqueue_style('bootstrap-reboot.min');

?>
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4" align="center">JOBS</h1>
            <div class="ultrapress-breadcrumb-wrap">
                <div class="container" align="center">
                    <?php ultrapress_breadcrumbs();?>
                </div>
            </div>
        </div>

    </div>

    <main id="main" class="site-main">
        <section class="blog <?php echo esc_attr($class);?>">
            <div class="container">
                <div id="primary" class="blog-content-wrapper">
                    <?php
                    if ( have_posts()):
                        echo '<div class="blogs">';
                        while ( have_posts() ):
                            the_post();
                            ?>
                            <div class="container w-75">
                                </br>
                                <div class="container">
                                    <h4><a href="<?php echo the_permalink();?>">	<?php echo the_title();?>	</a></h4>
                                </div>
                                <div class="container">
                                    <p>	<?php echo wp_trim_words(get_the_content(),30);?>	</p>
                                </div>
                                <div class="container">
                                    Salary: Upto INR&nbsp;
                                    <?php echo get_post_meta(get_the_ID(), 'salary_range', true);?>
                                </div>
                                <div class="container">
                                    Vacancies:&nbsp;
                                    <?php echo get_post_meta(get_the_ID(), 'job_vacancies', true);?>
                                </div>
                                </br>
                                <div class="container">
                                    <a href="<?php echo the_permalink();?>">-View Job</a>
                                </div>
                                </br>
                                <hr>
                            </div>


                        <?php endwhile;
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
            </div>

        </section>
    </main><!-- #main -->

<?php
get_footer();
