<?php
/**
 * The template for displaying all single job_opening posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package UltraPress
 */
get_header();

$post_layout = get_theme_mod('ultrapress_single_layout','layout2');

if($post_layout == 'layout1'){
    if(has_post_thumbnail( get_the_ID() )){
        $bg = 'style="background-image: url('.esc_url(get_the_post_thumbnail_url(get_the_ID(),"full")).')"';
    }else{
        $bg = '';
    }
    ?>

    <section class="breadcumb-section single-breadcrumb center overlay" <?php echo wp_kses_post($bg);?>>
        <div class="container">
            <div class="title-banner-wrapper">
                <h1 class="breadcrumb-title">
                    <?php echo wp_kses_post(get_the_title(get_the_ID()));?>
                </h1>
                <?php ultrapress_breadcrumbs(); ?>
            </div>
        </div>
    </section>
    <?php
}else{
    echo '<div class="ultrapress-breadcrumb-wrap"><div class="container">';

    ultrapress_breadcrumbs();

    echo '</div></div>';
}
$post_layout .= ' ';
?>
    <main id="main" class="site-main">
        <section class="single <?php echo esc_attr($post_layout);?>">
            <div class="container">
                <?php do_action('ultrapress_before_single'); ?>

                <div id="primary" class="post-content-wrapper">
                    <?php  do_action('ultrapress_before_single_content'); ?>
                    <?php
                    while ( have_posts() ) :
                        the_post();

                        // $single_layout = get_theme_mod('ultrapress_single_layout','layout2');
                        get_template_part( 'template-parts/single/single', 'job' );
                    endwhile;
                    ?>
                    <?php do_action('ultrapress_after_single_content'); ?>
                </div>
                <?php
                ?>
                <?php do_action('ultrapress_after_single'); ?>
            </div>
        </section>
    </main><!-- #main -->

<?php
get_footer();
