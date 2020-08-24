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



//ultrapress_title_banner();
//$sidebar_layout = ultrapress_sidebar_layouts('archive');
//$column_no = get_theme_mod('ultrapress_achive_column_no',2);
//$blog_layout = get_theme_mod('ultrapress_archive_layout','list');
//if($blog_layout!='list'){
//	$class = $blog_layout.' col-'.$column_no;
//}else{
//	$class = $blog_layout;
//}
//$class .= ' '.$sidebar_layout;
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
<!--			--><?php //
//			if($sidebar_layout != "no-sidebar"){
//				get_sidebar();
//			}
//			?>
		</div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

    </section>
</main><!-- #main -->

<?php
get_footer();
