<?php if( $column != 'full' ): ?>
<div class="container">
	<div class="row d-flex align-items-center">
		<div class="<?php echo esc_attr($left_column_class) ?> animated" data-animation="fadeInUp" data-animation-delay="300">
		<?php endif; ?>	

		<div class="row">
			<div class="col-md-12">	
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
						<div class="section-buttons m-top-35 m-bottom-15" data-animation="fadeInUp" data-animation-delay="1000">
						<?php 
						$paramsArr=(function_exists('vc_param_group_parse_atts'))?vc_param_group_parse_atts($params):array();
						echo pergo_get_button_groups($paramsArr); 
						?>
						</div>
					<?php endif; ?>	

					<?php if( $footer_text != '' ): ?>
					<span class="os-version grey-color"><?php echo esc_attr($footer_text) ?></span>
					<?php endif; ?>	

				</div>
			</div>		
		</div> 	 <!-- End Hero content -->

	<?php if( $column != 'full' ): ?>
	</div>	<!-- end left column class -->	
		<div class="<?php echo esc_attr($right_column_class) ?>">
			<?php if($right_content_type == 'shortcode'): ?>
				<?php echo do_shortcode($shortcode); ?>
			<?php endif; ?>	

			<?php if($right_content_type == 'form'): 
				$dark_color_class = pergo_default_dark_color_classes();

				if( in_array($form_bg, $dark_color_class) ){
					$form_bg .= ' white-color';	
				}else{
					$form_bg .= ' dark-color';
				}	

				?>

				<div id="hero-form">
					<div class="hero-form animated" data-animation="fadeInLeft" data-animation-delay="400">
						<div class="row register-form form <?php echo esc_attr($form_bg); ?>">
							<h4 class="h4-md"><?php echo esc_attr($form_title) ?></h4><!-- Title -->
							<p class="p-sm"><?php echo esc_attr($form_desc) ?></p><!-- Text -->
							<?php echo do_shortcode('[contact-form-7 id="'.intval($form_id).'"]'); ?>
						</div>
					</div>
				</div>	<!-- END HERO FORM -->
			<?php endif; ?>

			<?php if($right_content_type == 'image'): 
					$video_class = ( $video_popup == 'yes' )? ' video-preview' : '';
					?>
					<div class="hero-img p-left-30 animated<?php echo esc_attr($video_class) ?>" data-animation="fadeInLeft" data-animation-delay="400">
						<?php if( $video_popup == 'yes' ): ?>					
							<a class="video-popup2" href="<?php echo esc_url($url) ?>"> 
								<!-- Play Icon -->									
								<div class="video-btn-md animated" data-animation="fadeInUp" data-animation-delay="700">	
									<div class="video-block-wrapper">
										<div class="play-icon-<?php echo esc_attr($icon_class); ?>"><div class="ico-bkg"></div>
											<i class="fas fa-play-circle"></i>
										</div>
									</div>
								</div>
								<!-- Preview Image -->
								<img class="img-fluid" src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($title) ?>">
							</a>
							<?php else: ?>
							<img class="img-fluid" src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($title) ?>" />
							<?php endif; ?>
				 		</div>
					</div>
			<?php endif; ?>
		</div>
	</div><!-- .row .d-flex .align-items-center -->
</div><!-- .container -->
<?php endif; ?>	