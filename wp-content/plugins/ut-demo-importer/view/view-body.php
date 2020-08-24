<div id="#utdi-demo-browser" class="utdi-demo-browser">
    <div class="grid">
        <?php
        foreach ($this->items as $item => $value ) :
            $opt = get_option($this->opt_id);
            $imported_class = '';
            $btn_text = '';
            $status = '';
            if (!empty($opt[$item])) {
            $imported_class = 'imported';
                $btn_text .= esc_html__( 'Re-Import', 'ut-demo-importer' );
                $status .= esc_html__( 'Imported', 'ut-demo-importer' );
            }     else {
                $btn_text .= esc_html__( 'Import', 'ut-demo-importer' );
                $status .= esc_html__( 'Not Imported', 'ut-demo-importer' );
            }
            // main category utdi-tag
            $value_main_cat=$value['main_cat'];
            $value_main_replace = preg_replace('/\s*/', '', $value_main_cat);
            $value_replace_main = strtolower($value_main_replace);
            // normal category filter
            $value_cat=$value['cat'];
            $value_replace = preg_replace('/\s*/', '', $value_cat);
            $value_replace_w = strtolower($value_replace);
            // pro demo filter
            $plugin_status=$value['pro_demo'];
            if ($plugin_status == true) {
                $demo_class = 'pro';
            }else{
                $demo_class = 'free';
            } ?>
            <div id="<?php echo esc_attr($value_replace_w); ?>" class="utdi-demo-item element-item <?php echo esc_attr($imported_class); ?> <?php echo esc_attr($value_replace_w); ?> <?php echo esc_attr($value_replace_main); ?> <?php echo esc_attr($demo_class); ?>" data-ut-demo-importer>
                <?php if ($plugin_status == true): ?>
                    <span class="pro-tag"><?php echo esc_html('Go Pro','ut-demo-importer') ?></span>
                <?php endif ?>
                <div class="utdi-demo-screenshot">
                    <?php
                    $purchage_url=$value['purchage_url'];
                    $popup = strtolower($value['title']);
                    $themename=$value['theme'];
                    $image_url = '';
                    $image_url = UTDI_DEMO_URL . $themename.'/'. $item . '/screenshot.png';
                    if( empty($image_url) ){
                        $image_url = UTDI_URI . '/assets/img/screenshot.png';
                    }                    
                    if ( $plugin_status != true){
                        $popup_data = 'data-popup-open="popup-'.$popup.'"';
                        $popup_target = '';
                        $purchage_url_link = '#' ;
                    }else{
                        $popup_data = '';
                        $purchage_url_link = $purchage_url ;
                        $popup_target = 'target="_blank"';
                    }
                    ?>
                    <a <?php echo $popup_data.' '.$popup_target; ?> href="<?php echo esc_url( $purchage_url_link);?>">
                        <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr($value['title']); ?>">
                    </a>
                </div>
                <h2 class="utdi-demo-name text-center">
                    <?php echo esc_attr($value['title']); ?>
                </h2>
                <div class="utdi-demo-actions">
                    <?php
                    if ( $plugin_status != true){
                      ?>
                        <a class="button button-secondary import"  data-popup-open="popup-<?php echo esc_attr($popup); ?>" href="#">
                            <?php echo esc_html($btn_text); ?>
                        </a>
                    <?php
                    }else{
                        ?>
                        <a class="button" <?php echo $popup_data ?> href="<?php echo esc_url( $purchage_url_link);?>" target="_blank">
                            <?php _e( 'Go Pro', 'ut-demo-importer' ); ?>
                        </a>
                    <?php
                    } ?>
                    <a class="button button-primary" target="_blank" href="<?php echo esc_url($value['preview_url']); ?>">
                        <?php _e( 'Preview', 'ut-demo-importer' ); ?>
                    </a>
                </div>
                <!-- popup start-->
                <div class="popup" data-popup="popup-<?php echo esc_attr($popup); ?>" style="display: none;">
                    <div class="popup-wrap">
                        <form id="msform">
                            <!-- multi step progress bar start-->
                            <ul id="progressbar">
                                <li class="active"></li>
                            <?php
                                if (!empty($value['plugins'])) { ?>
                                    <li></li>
                                <?php } ?>
                            </ul>
                            <!-- multi step progress bar end-->
                            <!-- multi step fields start -->
                            <?php
                            if (!empty($value['plugins'])) { ?>
                                <fieldset>
                                    <h2 class="fs-title">
                                      <?php esc_html_e( 'Recomended Plugins', 'ut-demo-importer' ); ?>
                                    </h2>
                                    <p>
                                      <?php esc_html_e( 'These are the recomended plugins for this demo. To get exact looks and design, you need to install these plugins.', 'ut-demo-importer' ); ?>
                                    </p>
                                    <ul class="plugin-list">
                                        <?php
                                        $plugin_name = $value['plugins'];
                                        foreach ($plugin_name as $plugins) { 
                                            $plugin_slug = $plugins['plugin_slug'] ;
                                            $plugin_filename = $plugin_slug.'/'.$plugins['plugin_filename'].'.php';    
                                            $plugin_filename_dir = WP_PLUGIN_DIR.'/'.$plugin_slug.'/'.$plugins['plugin_filename'].'.php';
                                            if (is_plugin_active($plugin_filename) && file_exists($plugin_filename_dir)){ 
                                                $plugin_status_text = esc_html('Activated','ut-demo-importer');
                                                $plugin_status_processing = esc_html('Activated','ut-demo-importer');
                                                $plugin_status_class = esc_html('btn-disable','ut-demo-importer');
                                                $plugin_active = '';
                                            }elseif(!is_plugin_active($plugin_filename) && file_exists($plugin_filename_dir)){ 
                                                $plugin_status_text = esc_html('Activate','ut-demo-importer');
                                                $plugin_status_processing = esc_html('Activating...','ut-demo-importer');
                                                $plugin_status_class = '';
                                                $plugin_active = esc_html('activate-now','ut-demo-importer');
                                            }elseif (!is_plugin_active($plugin_filename) && !file_exists($plugin_filename_dir)) {
                                                $plugin_status_text = esc_html('Install','ut-demo-importer');
                                                $plugin_status_processing = esc_html('Installing...','ut-demo-importer');
                                                $plugin_status_class = '';
                                                $plugin_active = esc_html('activate-now','ut-demo-importer');
                                            } ?>
                                            <li> 
                                            <span><?php echo $plugins['plugin_name']; ?></span>
                                                <button class="install_plugin action-button <?php echo esc_attr($plugin_status_class). ' '. esc_attr($plugin_active);?>" 
                                                  data-slug="<?php echo $plugins['plugin_slug']; ?>" data-Pfilename="<?php echo $plugins['plugin_filename']; ?>"
                                                <?php if (!empty($plugins['plugin_source'])): ?>
                                                    data-Plink="<?php echo $plugins['plugin_source']; ?>"
                                                <?php endif ?> 
                                                  data-process="<?php echo esc_attr($plugin_status_processing); ?>"  >
                                                    <?php echo esc_html($plugin_status_text); ?>
                                                </button>
                                            </li>
                                          <?php
                                        } ?>
                                    </ul>
                                    <div class="plugin-msg" style="display: none;"><?php esc_html_e('Please Activate all plugins.','ut-demo-importer');?></div>
                                    <input type="button" name="next" class="next action-button active-plugins" value="Next" />
                                </fieldset>
                            <?php } ?>
                                <fieldset>
                                    <h2 class="fs-title">
                                        <?php esc_html_e( 'Demo Import', 'ut-demo-importer' ); ?>
                                    </h2>
                                    <p class="wait-message" style="display: none;">
                                      <?php esc_html_e( 'Importing demo may take some time. Please wait for a while until success message appears.', 'ut-demo-importer' ); ?>
                                    </p>
                                    <div class="LoaderBalls">
                                      <div class="LoaderBalls__item"></div>
                                      <div class="LoaderBalls__item"></div>
                                      <div class="LoaderBalls__item"></div>
                                      <div class="LoaderBalls__item"></div>
                                    </div>
                                    <div class="demo-done">
                                        <?php $image_done_url = UTDI_URI . '/assets/img/done.png'; ?>
                                        <img src="<?php echo esc_url($image_done_url); ?>" alt="">
                                    </div>
                                    <div class="demo-response">
                                        <p class="demo-response-content"></p>
                                    </div>
                                    <a class="btn-view-site button" href="<?php echo esc_url(home_url('/'));?>" target="_blank">
                                        <?php esc_html_e('View Site','ut-demo-importer'); ?>
                                    </a>
                                    <?php if (!empty($value['plugins'])): ?>
                                        <input type="button" name="previous" class="previous action-button" value="Previous" />
                                    <?php endif ?>
                                    <?php if ($plugin_status != true){ ?>
                                        <a class="button action-button" href="#" data-import="<?php echo esc_attr($item); ?>" data-nonce="<?php echo esc_attr( $nonce ); ?>">
                                            <?php echo esc_html($btn_text); ?>
                                        </a>
                                    <?php
                                    } else{ ?>
                                        <a class="button action-button" href="#">
                                            <?php esc_html_e('Go Pro' , 'ut-demo-importer'); ?>
                                        </a>
                                    <?php } ?>
                                </fieldset>
                                <!-- multi step fields end -->
                            <!-- popup close start-->
                            <a class="popup-close" data-popup-close="popup-<?php echo esc_attr($popup); ?>" href="#">
                                <?php esc_html_e('X', 'ut-demo-importer' ); ?>
                            </a>
                        </form>
                    </div>
                </div>
            <!-- popup close end-->
            </div><!-- /.ut-demo-importer-demo-item -->
        <?php endforeach; ?>
    </div>
        <!-- popup end-->
    <div class="clear"></div>
</div> <!-- demo body end-->