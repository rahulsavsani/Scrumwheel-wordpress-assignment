<?php
/**
 * Enqueue scripts for our Customizer preview
 *
 * @return void
 */
if ( ! function_exists( 'ultrapress_customizer_preview_scripts' ) ) {
	function ultrapress_customizer_preview_scripts() {
		wp_enqueue_script( 'ultrapress-customizer-preview', trailingslashit( get_template_directory_uri() ) . 'inc/ultrapress-customizer/js/customizer-preview.js', array( 'customize-preview', 'jquery' ) );
	}
}
add_action( 'customize_preview_init', 'ultrapress_customizer_preview_scripts' );
/**
 * Check if WooCommerce is active
 * Use in the active_callback when adding the WooCommerce Section to test if WooCommerce is activated
 *
 * @return boolean
 */
function ultrapress_is_woocommerce_active() {
	if ( class_exists( 'woocommerce' ) ) {
		return true;
	}
	return false;
}
/**
 * Set our Social Icons URLs.
 * Only needed for our sample customizer preview refresh
 *
 * @return array Multidimensional array containing social media data
 */
if ( ! function_exists( 'ultrapress_generate_social_urls' ) ) {
	function ultrapress_generate_social_urls() {
		$social_icons = array(
			array( 'url' => 'behance.net', 'icon' => 'fab fa-behance', 'title' => esc_html__( 'Follow me on Behance', 'ultrapress' ), 'class' => 'behance' ),
			array( 'url' => 'bitbucket.org', 'icon' => 'fab fa-bitbucket', 'title' => esc_html__( 'Fork me on Bitbucket', 'ultrapress' ), 'class' => 'bitbucket' ),
			array( 'url' => 'codepen.io', 'icon' => 'fab fa-codepen', 'title' => esc_html__( 'Follow me on CodePen', 'ultrapress' ), 'class' => 'codepen' ),
			array( 'url' => 'deviantart.com', 'icon' => 'fab fa-deviantart', 'title' => esc_html__( 'Watch me on DeviantArt', 'ultrapress' ), 'class' => 'deviantart' ),
			array( 'url' => 'discord.gg', 'icon' => 'fab fa-discord', 'title' => esc_html__( 'Join me on Discord', 'ultrapress' ), 'class' => 'discord' ),
			array( 'url' => 'dribbble.com', 'icon' => 'fab fa-dribbble', 'title' => esc_html__( 'Follow me on Dribbble', 'ultrapress' ), 'class' => 'dribbble' ),
			array( 'url' => 'etsy.com', 'icon' => 'fab fa-etsy', 'title' => esc_html__( 'favorite me on Etsy', 'ultrapress' ), 'class' => 'etsy' ),
			array( 'url' => 'facebook.com', 'icon' => 'fab fa-facebook-f', 'title' => esc_html__( 'Like me on Facebook', 'ultrapress' ), 'class' => 'facebook' ),
			array( 'url' => 'flickr.com', 'icon' => 'fab fa-flickr', 'title' => esc_html__( 'Connect with me on Flickr', 'ultrapress' ), 'class' => 'flickr' ),
			array( 'url' => 'foursquare.com', 'icon' => 'fab fa-foursquare', 'title' => esc_html__( 'Follow me on Foursquare', 'ultrapress' ), 'class' => 'foursquare' ),
			array( 'url' => 'github.com', 'icon' => 'fab fa-github', 'title' => esc_html__( 'Fork me on GitHub', 'ultrapress' ), 'class' => 'github' ),
			array( 'url' => 'instagram.com', 'icon' => 'fab fa-instagram', 'title' => esc_html__( 'Follow me on Instagram', 'ultrapress' ), 'class' => 'instagram' ),
			array( 'url' => 'kickstarter.com', 'icon' => 'fab fa-kickstarter-k', 'title' => esc_html__( 'Back me on Kickstarter', 'ultrapress' ), 'class' => 'kickstarter' ),
			array( 'url' => 'last.fm', 'icon' => 'fab fa-lastfm', 'title' => esc_html__( 'Follow me on Last.fm', 'ultrapress' ), 'class' => 'lastfm' ),
			array( 'url' => 'linkedin.com', 'icon' => 'fab fa-linkedin-in', 'title' => esc_html__( 'Connect with me on LinkedIn', 'ultrapress' ), 'class' => 'linkedin' ),
			array( 'url' => 'medium.com', 'icon' => 'fab fa-medium-m', 'title' => esc_html__( 'Follow me on Medium', 'ultrapress' ), 'class' => 'medium' ),
			array( 'url' => 'patreon.com', 'icon' => 'fab fa-patreon', 'title' => esc_html__( 'Support me on Patreon', 'ultrapress' ), 'class' => 'patreon' ),
			array( 'url' => 'pinterest.com', 'icon' => 'fab fa-pinterest-p', 'title' => esc_html__( 'Follow me on Pinterest', 'ultrapress' ), 'class' => 'pinterest' ),
			array( 'url' => 'plus.google.com', 'icon' => 'fab fa-google-plus-g', 'title' => esc_html__( 'Connect with me on Google+', 'ultrapress' ), 'class' => 'googleplus' ),
			array( 'url' => 'reddit.com', 'icon' => 'fab fa-reddit-alien', 'title' => esc_html__( 'Join me on Reddit', 'ultrapress' ), 'class' => 'reddit' ),
			array( 'url' => 'slack.com', 'icon' => 'fab fa-slack-hash', 'title' => esc_html__( 'Join me on Slack', 'ultrapress' ), 'class' => 'slack.' ),
			array( 'url' => 'slideshare.net', 'icon' => 'fab fa-slideshare', 'title' => esc_html__( 'Follow me on SlideShare', 'ultrapress' ), 'class' => 'slideshare' ),
			array( 'url' => 'snapchat.com', 'icon' => 'fab fa-snapchat-ghost', 'title' => esc_html__( 'Add me on Snapchat', 'ultrapress' ), 'class' => 'snapchat' ),
			array( 'url' => 'soundcloud.com', 'icon' => 'fab fa-soundcloud', 'title' => esc_html__( 'Follow me on SoundCloud', 'ultrapress' ), 'class' => 'soundcloud' ),
			array( 'url' => 'spotify.com', 'icon' => 'fab fa-spotify', 'title' => esc_html__( 'Follow me on Spotify', 'ultrapress' ), 'class' => 'spotify' ),
			array( 'url' => 'stackoverflow.com', 'icon' => 'fab fa-stack-overflow', 'title' => esc_html__( 'Join me on Stack Overflow', 'ultrapress' ), 'class' => 'stackoverflow' ),
			array( 'url' => 'tumblr.com', 'icon' => 'fab fa-tumblr', 'title' => esc_html__( 'Follow me on Tumblr', 'ultrapress' ), 'class' => 'tumblr' ),
			array( 'url' => 'twitch.tv', 'icon' => 'fab fa-twitch', 'title' => esc_html__( 'Follow me on Twitch', 'ultrapress' ), 'class' => 'twitch' ),
			array( 'url' => 'twitter.com', 'icon' => 'fab fa-twitter', 'title' => esc_html__( 'Follow me on Twitter', 'ultrapress' ), 'class' => 'twitter' ),
			array( 'url' => 'vimeo.com', 'icon' => 'fab fa-vimeo-v', 'title' => esc_html__( 'Follow me on Vimeo', 'ultrapress' ), 'class' => 'vimeo' ),
			array( 'url' => 'weibo.com', 'icon' => 'fab fa-weibo', 'title' => esc_html__( 'Follow me on weibo', 'ultrapress' ), 'class' => 'weibo' ),
			array( 'url' => 'youtube.com', 'icon' => 'fab fa-youtube', 'title' => esc_html__( 'Subscribe to me on YouTube', 'ultrapress' ), 'class' => 'youtube' ),
		);
		return apply_filters( 'ultrapress_social_icons', $social_icons );
	}
}
/**
 * Return an unordered list of linked social media icons, based on the urls provided in the Customizer Sortable Repeater
 * This is a sample function to display some social icons on your site.
 * This sample function is also used to show how you can call a PHP function to refresh the customizer preview.
 * Add the following code to header.php if you want to see the sample social icons displayed in the customizer preview and your theme.
 * Before any social icons display, you'll also need to add the relevent URL's to the Header Navigation > Social Icons section in the Customizer.
 * <div class="social">
 *	 <?php echo ultrapress_get_social_media(); ?>
 * </div>
 *
 * @return string Unordered list of linked social media icons
 */
if ( ! function_exists( 'ultrapress_get_social_media' ) ) {
	function ultrapress_get_social_media() {
		$defaults = ultrapress_generate_defaults();
		$output = array();
		$social_icons = ultrapress_generate_social_urls();
		$social_urls = explode( ',', get_theme_mod( 'social_urls', $defaults['social_urls'] ) );
		$social_newtab = get_theme_mod( 'social_newtab', $defaults['social_newtab'] );
		$social_alignment = get_theme_mod( 'social_alignment', $defaults['social_alignment'] );
		$contact_phone = get_theme_mod( 'contact_phone', $defaults['contact_phone'] );
		if( !empty( $contact_phone ) ) {
			$output[] = sprintf( '<li class="%1$s"><i class="%2$s"></i>%3$s</li>',
				'phone',
				'fas fa-phone fa-flip-horizontal',
				$contact_phone
			);
		}
		foreach( $social_urls as $key => $value ) {
			if ( !empty( $value ) ) {
				$domain = str_ireplace( 'www.', '', parse_url( $value, PHP_URL_HOST ) );
				$index = array_search( strtolower( $domain ), array_column( $social_icons, 'url' ) );
				if( false !== $index ) {
					$output[] = sprintf( '<li class="%1$s"><a href="%2$s" title="%3$s"%4$s><i class="%5$s"></i></a></li>',
						$social_icons[$index]['class'],
						esc_url( $value ),
						$social_icons[$index]['title'],
						( !$social_newtab ? '' : ' target="_blank"' ),
						$social_icons[$index]['icon']
					);
				}
				else {
					$output[] = sprintf( '<li class="nosocial"><a href="%2$s"%3$s><i class="%4$s"></i></a></li>',
						$social_icons[$index]['class'],
						esc_url( $value ),
						( !$social_newtab ? '' : ' target="_blank"' ),
						'fas fa-globe'
					);
				}
			}
		}
		if( get_theme_mod( 'social_rss', $defaults['social_rss'] ) ) {
			$output[] = sprintf( '<li class="%1$s"><a href="%2$s" title="%3$s"%4$s><i class="%5$s"></i></a></li>',
				'rss',
				esc_url(home_url( '/feed' )),
				'Subscribe to my RSS feed',
				( !$social_newtab ? '' : ' target="_blank"' ),
				'fas fa-rss'
			);
		}
		if ( !empty( $output ) ) {
			$output = apply_filters( 'ultrapress_social_icons_list', $output );
			array_unshift( $output, '<ul class="social-icons ' . $social_alignment . '">' );
			$output[] = '</ul>';
		}
		return implode( '', $output );
	}
}
/**
* Set our Customizer default options
*/
if ( ! function_exists( 'ultrapress_generate_defaults' ) ) {
	function ultrapress_generate_defaults() {
		$customizer_defaults = array(
			'social_newtab' => 0,
			'social_urls' => '',
		);
		return apply_filters( 'ultrapress_customizer_defaults', $customizer_defaults );
	}
}
/**
* Load all our Customizer options
*/
include_once trailingslashit( dirname(__FILE__) ) . 'inc/customizer.php';
