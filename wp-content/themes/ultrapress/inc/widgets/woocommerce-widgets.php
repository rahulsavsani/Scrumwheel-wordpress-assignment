<?php 
/**
 * Recent product slider
 */
class ultrapress_recent_product_slider_widgets extends WP_Widget {
 	function __construct() {
		parent::__construct(
			'ultrapress_recent_product_slider_widgets', 
			esc_html__( '*Ultrapress - Recent Products Slider', 'ultrapress' ), 
			array( 'description' => esc_html__( 'Ultrapress Recent Products Slider', 'ultrapress' ), )
		);
	}
 	public function widget( $args, $instance ) {
		?>
		<?php
		echo wp_kses_post( $args['before_widget'] );
		$ultrapress_recent_product_slider_post_title = isset($instance['ultrapress_recent_product_slider_post_title']) ? $instance['ultrapress_recent_product_slider_post_title'] : '';
		$ultrapress_recent_product_slider_number_of_product = isset($instance['ultrapress_recent_product_slider_number_of_product']) ? $instance['ultrapress_recent_product_slider_number_of_product'] : 5;
		?>
		<div class="ultrapress-recent-product-slider ultrapress-recent ultrapress-recent-slider woocommerce">
			<?php if (!empty($ultrapress_recent_product_slider_post_title)): ?>
				<h4 class="widget-title"><?php echo esc_html($ultrapress_recent_product_slider_post_title); ?></h4>
			<?php endif ?>
			<?php 
			$most_viewed_args = array(
				'post_type'=>'product',
				'posts_per_page'=> $ultrapress_recent_product_slider_number_of_product,
				'order'=>'desc',
			);
 			$ultrapress_most_viewed_post_item = new wp_query($most_viewed_args);
			if ($ultrapress_most_viewed_post_item->have_posts()) { 
				wp_enqueue_style( 'slick-theme');
				wp_enqueue_style( 'slick');
				wp_enqueue_script( 'slick');
				?>
 				<ul id="ultrapress-recent-product-slider-holder" class="ultrapress-recent-product-slider-holder">
					<?php while ($ultrapress_most_viewed_post_item->have_posts()) {
						$ultrapress_most_viewed_post_item->the_post();
						?>
						<li class="ultrapress-recent-product-slider-item">
							<div class="ultrapress-recent-product-slider-item-holder">
								<?php if (has_post_thumbnail()): ?>
									<figure>
										<a href="<?php the_permalink();?>">
											<img src="<?php the_post_thumbnail_url('ultrapress_widget_rcp_size'); ?>" alt="<?php echo esc_attr(get_the_title());?>">
										</a>
									</figure>
								<?php endif ?>
								<div class="ultrapress-recent-post-content">
									<h4><a href="<?php the_permalink();?>"> <?php the_title(); ?></a></h4>
									<?php 
									$regular_price = get_post_meta( get_the_ID(), '_regular_price', true ); 
									$sale_price = get_post_meta( get_the_ID(), '_sale_price', true ); 
									$price = get_post_meta( get_the_ID(), '_price', true );
									?>
									<?php woocommerce_template_loop_rating();  ?>
									<?php 
									if (!empty($sale_price)) { ?>
										<del> <?php echo wp_kses_post(wc_price( $regular_price )); ?></del>
										<ins> <?php echo wp_kses_post(wc_price( $sale_price )); ?></ins>
										<?php
									}else{ ?>
										<ins> <?php echo wp_kses_post(wc_price( $price )); ?></ins>
									<?php } ?>
								</div>
							</div>
						</li>
					<?php } wp_reset_postdata(); ?>
				</ul>
			<?php } ?>
		</div>
		<?php
		echo wp_kses_post($args['after_widget']);
	}
 	public function form( $instance ) {
		$ultrapress_recent_product_slider_post_title = ! empty( $instance['ultrapress_recent_product_slider_post_title'] ) ? $instance['ultrapress_recent_product_slider_post_title'] : __('Recent Products','ultrapress');
		$ultrapress_recent_product_slider_number_of_product = ! empty( $instance['ultrapress_recent_product_slider_number_of_product'] ) ? $instance['ultrapress_recent_product_slider_number_of_product'] : 5;
 		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'ultrapress_recent_product_slider_post_title' ) ); ?>"><?php esc_html_e( 'Title:', 'ultrapress' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ultrapress_recent_product_slider_post_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ultrapress_recent_product_slider_post_title' ) ); ?>" type="text" value="<?php echo esc_attr( $ultrapress_recent_product_slider_post_title ); ?>">
			<label for="<?php echo esc_attr( $this->get_field_id( 'ultrapress_recent_product_slider_number_of_product' ) ); ?>"><?php esc_html_e( 'Number of posts:', 'ultrapress' ); ?></label> 
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'ultrapress_recent_product_slider_number_of_product' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'ultrapress_recent_product_slider_number_of_product' ) ); ?>" type="number" value="<?php echo esc_attr( $ultrapress_recent_product_slider_number_of_product ); ?>">
		</p>
		<?php 
	}
 	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['ultrapress_recent_product_slider_number_of_product'] = ( ! empty( $new_instance['ultrapress_recent_product_slider_number_of_product'] ) ) ? absint( $new_instance['ultrapress_recent_product_slider_number_of_product'] ) : '';
		$instance['ultrapress_recent_product_slider_post_title'] = ( ! empty( $new_instance['ultrapress_recent_product_slider_post_title'] ) ) ? sanitize_text_field( $new_instance['ultrapress_recent_product_slider_post_title'] ) : '';
 		return $instance;
	}
 } 
 function ultrapress_recent_product_slider_widgets_register() {
	register_widget( 'ultrapress_recent_product_slider_widgets' );
}
add_action( 'widgets_init', 'ultrapress_recent_product_slider_widgets_register' );
