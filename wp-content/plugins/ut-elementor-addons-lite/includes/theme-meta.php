<?php
function ultrapress_meta_admin_assets() {
	wp_enqueue_style('ultrapress-admin-css', get_template_directory_uri().'/assets/css/admin.css',array('wp-color-picker'));
	wp_enqueue_script( 'ultrapress-admin-js', get_template_directory_uri() . '/assets/js/admin.js', array('jquery','media-upload','thickbox','wp-color-picker'), '4.3.1', true );
}
add_action('admin_enqueue_scripts', 'ultrapress_meta_admin_assets');


add_action( 'add_meta_boxes', 'ultrapress_add_meta_box' );
if ( ! function_exists( 'ultrapress_add_meta_box' ) ) {
	function ultrapress_add_meta_box() {
		add_meta_box( 'additional-page-metabox-options', esc_html__( 'UltraPress Page Options', 'ut-elementor-addons-lite' ), 'ultrapress_metabox_controls', 'page', 'normal', 'low' );
	}
}
$ultrapress_sidebar_layouts =array(
	'default' => array(
		'value'     => 'default',
		'label'     => esc_html__( 'Default', 'ut-elementor-addons-lite' ),
		'thumbnail' => esc_url(get_template_directory_uri()) . '/inc/ultrapress-customizer/images/sidebar-none.png',
	),
	'left-sidebar' => array(
		'value'     => 'left-sidebar',
		'label'     => esc_html__( 'Left Sidebar', 'ut-elementor-addons-lite' ),
		'thumbnail' => esc_url(get_template_directory_uri()) . '/inc/ultrapress-customizer/images/sidebar-left.png',
	),
	'right-sidebar' => array(
		'value'     => 'right-sidebar',
		'label'     => esc_html__( 'Right Sidebar', 'ut-elementor-addons-lite' ),
		'thumbnail' => esc_url(get_template_directory_uri()) . '/inc/ultrapress-customizer/images/sidebar-right.png',
	),
	'no-sidebar' => array(
		'value'     => 'no-sidebar',
		'label'     => esc_html__( 'Full width', 'ut-elementor-addons-lite' ),
		'thumbnail' => esc_url(get_template_directory_uri()) . '/inc/ultrapress-customizer/images/sidebar-none.png',
	),
);
if ( ! function_exists( 'ultrapress_metabox_controls' ) ) {
 	/**
 	 * Meta box render function
 	 *
 	 * @param  object $post Post object.
 	 * @since  1.0.0
 	 */
 	function ultrapress_metabox_controls( $post, $value = '') {
 		global $ultrapress_sidebar_layouts;
 		$meta = get_post_meta( $post->ID );
 		$templates = ultrapress_get_elementor_templates();
 		wp_nonce_field( 'ultrapress_control_meta_box', 'ultrapress_control_meta_box_nonce' ); // Always add nonce to your meta boxes!

 		$page_meta = unserialize(get_post_meta($post->ID,'ultrapress_page_options',true));
 		//print_r($page_meta);

 		$header_type = isset($page_meta['header_type']) ? $page_meta['header_type'] : 'default';
 		$custom_header = isset($page_meta['custom_header']) ? $page_meta['custom_header'] : '';
 		$trans_header = isset($page_meta['trans_header']) ? $page_meta['trans_header'] : 0;
 		$page_logo = isset($page_meta['page_logo']) ? $page_meta['page_logo'] : NULL;
 		$show_banner = isset($page_meta['show_banner']) ? $page_meta['show_banner'] : 1;
 		$custom_title = isset($page_meta['custom_title']) ? $page_meta['custom_title'] : '';
 		$custom_subtitle = isset($page_meta['custom_subtitle']) ? $page_meta['custom_subtitle'] : '';
 		$banner_height = isset($page_meta['banner_height']) ? $page_meta['banner_height'] : '';
 		$show_breadcrumb = isset($page_meta['show_breadcrumb']) ? $page_meta['show_breadcrumb'] : 1;
 		$banner_bgcolor = isset($page_meta['banner_bgcolor']) ? $page_meta['banner_bgcolor'] : '';
 		$banner_textcolor = isset($page_meta['banner_textcolor']) ? $page_meta['banner_textcolor'] : '';
 		$banner_bgimage = isset($page_meta['banner_bgimage']) ? $page_meta['banner_bgimage'] : NULL;
 		$disable_container = isset($page_meta['disable_container']) ? $page_meta['disable_container'] : 0;
 		$container_width = isset($page_meta['container_width']) ? $page_meta['container_width'] : 'container';
 		$sidebar_positions = isset($page_meta['sidebar_positions']) ? $page_meta['sidebar_positions'] : 'default';
 		$registerd_sidebar = isset($page_meta['registerd_sidebar']) ? $page_meta['registerd_sidebar'] : 'default';
 		$footer_type = isset($page_meta['footer_type']) ? $page_meta['footer_type'] : 'default';
 		$custom_footer = isset($page_meta['custom_footer']) ? $page_meta['custom_footer'] : '';

 		?>
 		<div class="ultrapress-options-wrapper tabs">
 			<ul class="tabs-nav">
 				<li><a href="#header"><?php esc_html_e('Header','ut-elementor-addons-lite' ) ?></a></li>
 				<li><a href="#breadcrumb"><?php esc_html_e('Title Banner','ut-elementor-addons-lite' ) ?></a></li>
 				<li><a href="#container"><?php esc_html_e('Container','ut-elementor-addons-lite' ) ?></a></li>
 				<li><a href="#sidebar"><?php esc_html_e('Sidebar','ut-elementor-addons-lite' ) ?></a></li>
 				<li><a href="#footer"><?php esc_html_e('Footer','ut-elementor-addons-lite' ) ?></a></li>
 			</ul>
 			<div class="tabs-stage">
 				<div id="header" class="admin-tab">
 					<div class="ultrapress-option-wrap">
 						<span class="title"><?php esc_html_e( 'Header Type', 'ut-elementor-addons-lite' ) ?></span>
 						<select name="ultrapress_page_options[header_type]" id="ultrapress_header_layouts">
 							<option value="default" <?php selected( $header_type, 'default' ); ?>><?php esc_html_e('Default','ut-elementor-addons-lite');?></option>
 							<option value="custom" <?php selected( $header_type, 'custom' ); ?>><?php esc_html_e('Custom','ut-elementor-addons-lite');?></option>
 							<option value="hide" <?php selected( $header_type, 'hide' ); ?>><?php esc_html_e('Hide','ut-elementor-addons-lite');?></option>
 						</select>
 					</div>
 					<?php if (defined('ELEMENTOR_VERSION')): ?>
 					
 					<div class="ultrapress-option-wrap">
 						<span class="title"><?php esc_html_e( 'Choose Custom Template', 'ut-elementor-addons-lite' ) ?></span> 
	 					<select name="ultrapress_page_options[custom_header]" id="ultrapress_custom_header">
	 						<?php
	 						if($templates){
	 							foreach($templates as $ID => $template):
	 								?> 
	 								<option value="<?php echo esc_attr($ID); ?>" <?php selected( $custom_header, $ID ); ?>><?php echo esc_html($template); ?></option>
	 								<?php 
	 							endforeach; 
	 						}
	 						?>
	 					</select>
	 					<em><?php esc_html_e('Choose if custom header is selected.','ut-elementor-addons-lite');?></em>
 					</div>
 					<?php endif ?>
	 				<div class="ultrapress-option-wrap">
	 					<span class="title"><?php esc_html_e( 'Transparent Header', 'ut-elementor-addons-lite' ) ?> </span>
	 					<input type="checkbox" name="ultrapress_page_options[trans_header]" value="1" <?php checked( $trans_header, 1 ); ?> />
	 				</div>
	 				<div class="ultrapress-option-wrap wordpress-uploader">
	 					<span class="title"><?php esc_html_e( 'Upload Page Logo', 'ut-elementor-addons-lite' ) ?></span>
	 					<?php 
	 					$image = __( 'Upload Logo', 'ut-elementor-addons-lite' );
	 					$image_size = 'full';
	 					$display = 'none';
	 					$class = 'button';
	 					$image_attributes = wp_get_attachment_image_src($page_logo, $image_size );
	 					if( $image_attributes) {
	 						$image = '<img src="'.$image_attributes[0].'"/>';
	 						$display = 'inline-block';
	 						$class = 'has-image';
	 					}
	 					?>
	 					<a href="#" class="ultrapress_upload_image_button <?php echo esc_attr($class);?>"><?php echo wp_kses_post($image);?></a>
	 					<input type="hidden" name="ultrapress_page_options[page_logo]" id="ultrapress_logo_image" value="<?php echo esc_attr($page_logo);?> "/>
	 					<a href="#" class="ultrapress_remove_image_button" style="display:inline-block;display:<?php echo esc_attr($display);?>"><?php esc_html_e('Remove Image','ut-elementor-addons-lite');?></a>
	 				</div>
 				</div>

	 			<div id="breadcrumb" class="admin-tab">

	 				<div class="ultrapress-option-wrap">
	 					<span class="title"><?php esc_html_e( 'Show Banner', 'ut-elementor-addons-lite' ) ?> </span>
	 					<div class="ultrapress-checkbox">
		 					<input id="show_banner" type="checkbox" name="ultrapress_page_options[show_banner]" value="1" <?php checked( $show_banner, 1 ); ?> />
		 					<label for="show_banner"></label>
	 					</div>
		 				<?php 
		 				$banner_en = get_theme_mod('ultrapress_breadcrumb_banner_switch',true);
		 				if(!$banner_en){
		 				?>
		 				<span class="info">
		 					<em><?php esc_html_e('Banner is disabled from global setting in customizer.','ut-elementor-addons-lite');?></em>
		 				</span>
		 				<?php }?>
	 				</div>
	 				<div class="same-line-option">
	 				<div class="ultrapress-option-wrap">
	 					<span class="title"><?php esc_html_e( 'Custom Title', 'ut-elementor-addons-lite' ) ?></span> 
	 					<input type="text" name="ultrapress_page_options[custom_title]" value="<?php echo esc_attr($custom_title)?>" />
	 				</div>
	 				<div class="ultrapress-option-wrap">
	 					<span class="title"><?php esc_html_e( 'Custom SubTitle', 'ut-elementor-addons-lite' ) ?></span> 
	 					<input type="text" name="ultrapress_page_options[custom_subtitle]" value="<?php echo esc_attr($custom_subtitle)?>" />
	 				</div>
	 				</div>
	 				<div class="ultrapress-option-wrap">
	 					<span class="title"><?php esc_html_e( 'Banner Height', 'ut-elementor-addons-lite' ) ?></span> 
	 					<input type="number" name="ultrapress_page_options[banner_height]" value="<?php echo esc_attr($banner_height)?>" />
	 				</div>
	 				<div class="ultrapress-option-wrap">
	 					<span class="title"><?php esc_html_e( 'Show Breadcrumb', 'ut-elementor-addons-lite' ) ?> </span>
	 					<div class="ultrapress-checkbox">
		 					<input id="show_breadcrumb" type="checkbox" name="ultrapress_page_options[show_breadcrumb]" value="1" <?php checked( $show_breadcrumb, 1 ); ?> />
		 					<label for="show_breadcrumb"></label>
	 					</div>
	 				</div>
	 				<div class="same-line-option">
	 				<div class="ultrapress-option-wrap">
	 				<span class="title"><?php esc_html_e( 'Background Color', 'ut-elementor-addons-lite' ) ?></span>
	 					<input class="color-field" name="ultrapress_page_options[banner_bgcolor]" type="text" value="<?php esc_attr($banner_bgcolor);?>" >
					</div>
					<div class="ultrapress-option-wrap">
	 				<span class="title"><?php esc_html_e( 'Text Color', 'ut-elementor-addons-lite' ) ?></span>
	 					<input class="color-field" name="ultrapress_page_options[banner_textcolor]" type="text" value="<?php esc_attr($banner_textcolor);?>" >
					</div>
					</div>
	 				<div class="ultrapress-option-wrap wordpress-uploader">
	 					<span class="title"><?php esc_html_e( 'Background Image', 'ut-elementor-addons-lite' ) ?></span>
	 					<?php 
	 					$image = __( 'Upload Image', 'ut-elementor-addons-lite' );
	 					$image_size = 'full';
	 					$display = 'none';
	 					$class = 'button';
	 					$image_attributes = wp_get_attachment_image_src($banner_bgimage, $image_size );
	 					if( $image_attributes) {
	 						$image = '<img src="'.$image_attributes[0].'"/>';
	 						$display = 'inline-block';
	 						$class = 'has-image';
	 					}
	 					?>
	 					<a href="#" class="ultrapress_upload_image_button <?php echo esc_attr($class);?>"><?php echo wp_kses_post($image);?></a>
	 					<input type="hidden" name="ultrapress_page_options[banner_bgimage]" id="ultrapress_banner_image" value="<?php echo esc_attr($banner_bgimage);?> "/>
	 					<a href="#" class="ultrapress_remove_image_button" style="display:inline-block;display:<?php echo esc_attr($display);?>"><?php esc_html_e('Remove Image','ut-elementor-addons-lite');?></a>
	 				</div>
	 			</div>

 			<div id="container" class="admin-tab">
 				<div class="ultrapress-option-wrap">
 					<span class="title"><?php esc_html_e( 'Disable Container', 'ut-elementor-addons-lite' ) ?> </span>
 					<input type="checkbox" name="ultrapress_page_options[disable_container]" value="1" <?php checked( $disable_container, 1 ); ?> />
 				</div>
 				<div class="ultrapress-option-wrap">
 					<span class="title"><?php esc_html_e( 'Container Width', 'ut-elementor-addons-lite' ) ?></span>
 					<select name="ultrapress_page_options[container_width]" id="container_width">
 						<option value="container" <?php selected( $container_width, 'container' ); ?>><?php esc_html_e( 'Container', 'ut-elementor-addons-lite' ) ?></option>
 						<option value="container-fluid" <?php selected( $container_width, 'container-fluid' ); ?>><?php esc_html_e( 'Container Fluid', 'ut-elementor-addons-lite' ) ?></option>
 					</select>
 				</div>
 			</div>
 			<div id="sidebar" class="admin-tab">
 				<div class="ultrapress-option-wrap">
 				<span class="title"><?php esc_html_e( 'Sidebar position', 'ut-elementor-addons-lite' ) ?></span>
		        <table class="form-table">
		            <tr>
		              <td>            
		                <?php
		                  $i = 0;  
		                  foreach ($ultrapress_sidebar_layouts as $field) {  
		                ?>            
		                  <div class="radio-image-wrapper slidercat" id="slider-<?php echo intval($i); ?>">
		                    <label for="img-radio-<?php echo intval($i); ?>" class="description">
		                        <input id="img-radio-<?php echo intval($i); ?>" type="radio" name="ultrapress_page_options[sidebar_positions]" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( esc_attr( $field['value'] ), 
		                            $sidebar_positions ); if(empty($sidebar_positions) && esc_attr( $field['value'] )=='default'){ echo "checked='checked'";  } ?>/>
		                        <span>
		                          <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" />
		                        </span>
		                        <span><?php echo esc_html( $field['label'] ); ?></span>
		                    </label>
		                  </div>
		                <?php  $i++; }  ?>
		              </td>
		            </tr>            
		        </table>
		        </div>	
 				<div class="ultrapress-option-wrap">
 					<span class="title"><?php esc_html_e( 'Choose Sidebar', 'ut-elementor-addons-lite' ) ?></span>
 					<select name="ultrapress_page_options[registerd_sidebar]" id="registerd_sidebar">
 						<option value="default"><?php esc_html_e('Default','ut-elementor-addons-lite');?></option>
 						<?php foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) { 
 							$sidebar_id = $sidebar['id'];
 							$sidebar_name = $sidebar['name'];
 							?>
 							<option value="<?php echo esc_attr($sidebar_id);?>" <?php selected( $registerd_sidebar, $sidebar_id ); ?>><?php echo esc_html($sidebar_name) ?></option>
 						<?php } ?>
 					</select>
 				</div>	
 			</div>

 			<div id="footer" class="admin-tab">
 				<div class="ultrapress-option-wrap">
 					<span class="title"><?php esc_html_e( 'Footer Type', 'ut-elementor-addons-lite' ) ?></span>
 					<select name="ultrapress_page_options[footer_type]" id="ultrapress_footer_layouts">
 						<option value="default" <?php selected( $footer_type, 'default' ); ?>><?php esc_html_e('Default','ut-elementor-addons-lite');?></option>
 						<option value="custom" <?php selected( $footer_type, 'custom' ); ?>><?php esc_html_e('Custom','ut-elementor-addons-lite');?></option>
 						<option value="hide" <?php selected( $footer_type, 'hide' ); ?>><?php esc_html_e('Hide','ut-elementor-addons-lite');?></option>
 					</select>
 				</div>
 				<?php if (defined('ELEMENTOR_VERSION')): ?>
 					<div class="ultrapress-option-wrap">
 						<span class="title"><?php esc_html_e( 'Choose Footer Template', 'ut-elementor-addons-lite' ) ?> </span>
 						<select name="ultrapress_page_options[custom_footer]" id="ultrapress_custom_footer">
 							<?php
 							if($templates){
 								foreach($templates as $ID => $template):
 									?> 
 									<option value="<?php echo esc_attr($ID); ?>" <?php selected( $custom_footer, $ID ); ?>><?php echo esc_html($template); ?></option>
 									<?php 
 								endforeach; 
 							}
 							?>
 						</select>
 					</div>	
 				<?php endif ?>
 			</div>
 		</div>
 	</div>
 	<?php
	}
}
add_action( 'save_post', 'ultrapress_save_metaboxes' );
if ( ! function_exists( 'ultrapress_save_metaboxes' ) ) {
 	/**
 	 * Save controls from the meta boxes
 	 *
 	 * @param  int $post_id Current post id.
 	 * @since 1.0.0
 	 */
 	function ultrapress_save_metaboxes( $post_id ) {

 		/*
 		 * We need to verify this came from the our screen and with proper authorization,
 		 * because save_post can be triggered at other times. Add as many nonces, as you
 		 * have metaboxes.
 		 */
 		if ( ! isset( $_POST['ultrapress_control_meta_box_nonce'] ) || ! wp_verify_nonce( sanitize_key( $_POST['ultrapress_control_meta_box_nonce'] ), 'ultrapress_control_meta_box' ) ) { // Input var okay.
 			return $post_id;

 		}
 		// Check the user's permissions.
 		if ( isset( $_POST['post_type'] ) && 'page' === $_POST['post_type'] ) { // Input var okay.
 			if ( ! current_user_can( 'edit_page', $post_id ) ) {
 				return $post_id;
 			}
 		} else {
 			if ( ! current_user_can( 'edit_post', $post_id ) ) {
 				return $post_id;
 			}
 		}
 		/*
 		 * If this is an autosave, our form has not been submitted,
 		 * so we don't want to do anything.
 		 */
 		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
 			return $post_id;
 		}
 		if ( isset( $_POST['ultrapress_page_options'] ) ) { 

 			//Sanitize Meta Fields
	 		$page_meta = $_POST['ultrapress_page_options'];

	 		$data['header_type'] = isset($page_meta['header_type']) ? sanitize_title($page_meta['header_type']) : 'default';
	 		$data['custom_header'] = isset($page_meta['custom_header']) ? (int)$page_meta['custom_header'] : 0;
	 		$data['trans_header'] = isset($page_meta['trans_header']) ? (int)$page_meta['trans_header'] : 0;
	 		$data['page_logo'] = isset($page_meta['page_logo']) ? (int)$page_meta['page_logo'] : NULL;
	 		$data['show_banner'] = isset($page_meta['show_banner']) ? (int)$page_meta['show_banner'] : 0;
	 		$data['custom_title'] = isset($page_meta['custom_title']) ? sanitize_text_field($page_meta['custom_title']) : '';
	 		$data['custom_subtitle'] = isset($page_meta['custom_subtitle']) ? sanitize_text_field($page_meta['custom_subtitle']) : '';
	 		$data['banner_height'] = isset($page_meta['banner_height']) ? sanitize_text_field($page_meta['banner_height']) : '';
	 		$data['show_breadcrumb'] = isset($page_meta['show_breadcrumb']) ? (int)$page_meta['show_breadcrumb'] : 0;
	 		$data['banner_bgcolor'] = isset($page_meta['banner_bgcolor']) ? sanitize_hex_color($page_meta['banner_bgcolor']) : '';
	 		$data['banner_textcolor'] = isset($page_meta['banner_textcolor']) ? sanitize_hex_color($page_meta['banner_textcolor']) : '';
	 		$data['banner_bgimage'] = isset($page_meta['banner_bgimage']) ? (int)$page_meta['banner_bgimage'] : NULL;
	 		$data['disable_container'] = isset($page_meta['disable_container']) ? (int)$page_meta['disable_container'] : 0;
	 		$data['container_width'] = isset($page_meta['container_width']) ? sanitize_text_field($page_meta['container_width']) : 'container';
	 		$data['sidebar_positions'] = isset($page_meta['sidebar_positions']) ? sanitize_text_field($page_meta['sidebar_positions']) : 'default';
	 		$data['registerd_sidebar'] = isset($page_meta['registerd_sidebar']) ? sanitize_title($page_meta['registerd_sidebar']) : 'default-sidebar';
	 		$data['footer_type'] = isset($page_meta['footer_type']) ? sanitize_text_field($page_meta['footer_type']) : 'default';
	 		$data['custom_footer'] = isset($page_meta['custom_footer']) ? (int)$page_meta['custom_footer'] : '';

 		    //Save Meta Fields
 			update_post_meta( $post_id, 'ultrapress_page_options', serialize( $data ) );
 		}
 		
 	}
 }