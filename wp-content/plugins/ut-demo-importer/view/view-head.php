    <h2>
  	    <strong>
  		    <?php esc_html_e( 'Demo Importer', 'ut-demo-importer' ); ?>
  	     </strong>
    </h2>
    <div id="welcome-panel" class="welcome-panel">
      	<div class="welcome-panel-content">
      		<p class="about-description text-center">
      			<?php _e('Make sure that you\'ve installed all the required & recommended plugins before proceeding with the demo installation here.', 'utdi-demo-importer' ); ?>
      		</p>
      	</div>
    </div>
    <!-- filter navigation section -->
        <nav class="nav-wrap filters">
            <div class="ui-group">
      		    <ul class="button-group js-radio-button-group" data-filter-group="main-cat">
                    <li class="btn-item is-checked" data-filter=""><?php esc_html_e('All' , 'ut-demo-importer');?></li>
                    <?php
                    $mainCategoryList = [];
                    foreach($this->items as $item => $mainValue) {
                        if (!in_array($mainValue['main_cat'], $mainCategoryList)) {
                            $mainCategoryList[] = $mainValue['main_cat'];
                        }
                    }
                    foreach ($mainCategoryList as $key => $mainValue ) : 
          				$value_replace = preg_replace('/\s*/', '', $mainValue);
          				$value_replace_w = strtolower($value_replace);
          				?>
          				<li class="btn-item" data-filter=".<?php echo esc_attr($value_replace_w); ?>"><?php echo esc_html($mainValue); ?></li>
                    <?php endforeach ?>
      		    </ul>
            </div>
          	<div class="ui-group">
          		<ul class="button-group filters-button-group" data-filter-group="cat">
          			<li class="btn-item is-checked" data-filter="*"><?php esc_html_e('All' , 'ut-demo-importer');?></li>
          			<?php   
          			$categoryList = [];
          			foreach($this->items as $item => $value) {
          				if (!in_array($value['cat'], $categoryList)) {
          					$categoryList[] = $value['cat'];
          				}
          			}
          			foreach ($categoryList as $key => $value ) : 
          				$value_replace = preg_replace('/\s*/', '', $value);
          				$value_replace_w = strtolower($value_replace);
          				?>

          				<li class="btn-item" data-filter=".<?php echo esc_attr($value_replace_w); ?>"><?php echo esc_html($value); ?></li>
          			<?php endforeach ?>
          		</ul>
          	</div>

          	<div class="ui-group">
          		<ul class="button-group js-radio-button-group" data-filter-group="pro-cat">
          			<li class="btn-item is-checked" data-filter=""><?php esc_html_e('All' , 'ut-demo-importer');?></li>
          			<li class="btn-item" data-filter=".free"><?php esc_html_e('Free' , 'ut-demo-importer'); ?></li>
          			<li class="btn-item" data-filter=".pro"><?php esc_html_e('Pro' , 'ut-demo-importer'); ?></li>
          		</ul>
          	</div>
        </nav>