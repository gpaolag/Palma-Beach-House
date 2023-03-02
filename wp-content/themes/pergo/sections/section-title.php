<div class="row">	
	<div class="<?php echo implode(' ', $sectionclass) ?>">
		<?php if( $name != '' ): ?>
		<span class="section-id <?php echo esc_attr($name_color) ?>-color"><?php echo esc_attr($name); ?></span>
		<?php endif; ?>
		<?php if( $title != '' ): ?>			
			<<?php echo esc_attr($tagname) ?> class="<?php echo esc_attr($classname) ?>"><?php echo pergo_parse_text($title, $parse_args); ?></<?php echo esc_attr($tagname) ?>>
		<?php endif; ?>
		<p class="<?php echo  esc_attr($subtitle_text_size) ?> <?php echo esc_attr($subtitle_text_color) ?>-color"><?php echo pergo_parse_text($subtitle, $parse_args); ?></p>	

		<?php if( $enable_content == 'yes' ): ?>
			<div class="section-content m-top-20" data-animation="fadeInUp" data-animation-delay="300">
				<?php echo wpautop($content) ?>
			</div>
		<?php endif; ?>

		<?php if( $enable_list == 'yes' ): ?>
			<div class="section-list m-top-20">
			<?php 
			$Arr=(function_exists('vc_param_group_parse_atts'))?vc_param_group_parse_atts($content_list):array();
			pergo_vc_get_content_list_group($Arr, 'fadeInUp', '400'); 
			?>
			</div>
		<?php endif; ?>	

		<?php if( $enable_button == 'yes' ): ?>
			<div class="section-buttons m-top-35" data-animation="fadeInUp" data-animation-delay="1000">
			<?php 
			$paramsArr=(function_exists('vc_param_group_parse_atts'))?vc_param_group_parse_atts($params):array();
			echo pergo_get_button_groups($paramsArr); 
			?>
			</div>
		<?php endif; ?>	
	</div>		
</div> 	 <!-- END SECTION TITLE -->	