<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package ultrapress
 */
if ( ! function_exists( 'ultrapress_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function ultrapress_posted_on() {
		$meta_layout = get_theme_mod( 'ultrapress_meta_field_layout', 'text' );
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);
		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'ultrapress' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
		if ($meta_layout == 'icon') {
			$meta_style = '<i class="fa fa-clock-o" aria-hidden="true"></i> <a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';
		}else{
			$meta_style = $posted_on ;
		}
		echo '<span class="posted-on">' . $meta_style . '</span>'; // WPCS: XSS OK.
	}
endif;
if ( ! function_exists( 'ultrapress_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function ultrapress_posted_by() {
		$meta_layout = get_theme_mod( 'ultrapress_meta_field_layout', 'text' );
		$author_name = get_the_author();
		$author_url = get_author_posts_url( get_the_author_meta( 'ID' ) );
		$byline = '<span class="author vcard">'.esc_html__('Posted by', 'ultrapress').' <a class="url fn n" href="' . esc_url( $author_url) . '">' . esc_html( $author_name ) . '</a></span>';
		if ($meta_layout == 'icon') {
			$meta_style = '<i class="fa fa-user" aria-hidden="true"></i> <span class="author vcard"><a class="url fn n" href="' . esc_url($author_url) . '">' . esc_html($author_name) . '</a></span>';
		}else{
			$meta_style = $byline ;
		}
 		echo '<span class="byline"> ' . $meta_style . '</span>'; // WPCS: XSS OK.
 	}
 endif;
 if ( ! function_exists( 'ultrapress_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function ultrapress_entry_footer() {

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'ultrapress' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;
add_action('ultrapress_after_single_content','ultrapress_entry_footer');

if ( ! function_exists( 'ultrapress_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function ultrapress_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}
		if ( is_singular() ) :
			?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div><!-- .post-thumbnail -->
			<?php else : ?>
				<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php
					the_post_thumbnail( 'post-thumbnail', array(
						'alt' => the_title_attribute( array(
							'echo' => false,
						) ),
					) );
					?>
				</a>
				<?php
		endif; // End is_singular().
	}
endif;

