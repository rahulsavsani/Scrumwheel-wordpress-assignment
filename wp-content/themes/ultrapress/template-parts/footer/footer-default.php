<?php 
$copyright = get_theme_mod('ultrapress_copyright_text');
$copyright = strtr($copyright, array("[date]"=>date('Y'), "[site-title]"=>get_bloginfo()));

?>
<footer id="colophon" class="site-footer">
	<div class="container">
		<div class="right-resurved">
			<p>
				<?php 
				if($copyright){
					echo wp_kses_post($copyright);
				}else{
					printf( esc_html__( 'Copyright &copy; %1$s | Powered by %2$s', 'ultrapress' ), esc_html(date("Y")).' '.esc_html(get_bloginfo()), '<a href=" ' . esc_url('https://uncodethemes.com/wordpress-themes/ultrapress') . ' " rel="designer" target="_blank">UltraPress Theme</a>' );
				}
				?>
			</p>
		</div>
	</div>
</footer><!-- #colophon -->