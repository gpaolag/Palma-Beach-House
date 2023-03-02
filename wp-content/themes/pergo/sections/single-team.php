<div class="<?php echo esc_attr($style) ?>"> <!-- Single TEAM MEMBER  -->
	<div class="team-member animated"<?php echo pergo_animation_attr($css_animation, $animation_delay); ?>>
		
		<img class="img-fluid" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title) ?>">
		<?php echo ($style == 'team-1')? '<div class="tm-overlay"></div>' : ''; ?>

			
		<div class="<?php echo ($style == 'team-1')? 'tm-meta white-color' : 'tm2-meta'; ?>">

			<?php if( $title != '' ): ?>			
				<<?php echo esc_attr($tagname) ?> class="<?php echo esc_attr($classname) ?>">
				<?php echo ( $link != '' )? '<a class="rose-hover" href="'.esc_url($link).'">' : ''; ?>
				<?php echo pergo_parse_text($title); ?>
				<?php echo ( $link != '' )? '</a>' : ''; ?>
				</<?php echo esc_attr($tagname) ?>>
			<?php endif; ?>

			<?php if( $subtitle != '' ): ?>
				<span class="<?php echo esc_attr($subtitle_text_color) ?>-color"><?php echo esc_attr($subtitle); ?></span>	
			<?php endif; ?>			

			<?php if( ($content != '') && ($style != 'team-1') ): ?>
			<p class="<?php echo esc_attr($content_text_size) ?> <?php echo esc_attr($content_text_color) ?>-color"><?php echo do_shortcode($content) ?></p>
			<?php endif; ?>		

		</div>	

	</div>
</div><!-- END Single TEAM MEMBER -->	