<?php $atts = $args ?>
<!-- HERO-8
============================================= -->
<div class="hero-class" data-class="hero-section bg-fixed division" data-section_id="hero-8">
	<div class="row d-flex align-items-center">		
		<div class="col-md-7 col-lg-6"> <!-- HERO TEXT -->
			<div class="hero-txt">

				<?php echo pergo_get_vc_param_html( 'title', $atts, 'fadeInUp', 300 ); ?><!-- Title -->	
				<?php echo pergo_get_vc_param_html( 'lead_text', $atts, 'fadeInUp', 400 ); ?><!-- Sub Title -->

				<!-- HERO STORE BADGES -->													
				<div class="hero-stores-badge animated" data-animation="fadeInUp" data-animation-delay="500">
					<?php foreach ($paramsArr as $key => $value) : ?>
						<a href="<?php echo esc_url($value['link']) ?>" class="store">
							<img class="appstore" src="<?php echo esc_url($value['image']) ?>" width="160" height="50" alt="<?php echo esc_attr($value['title']) ?>" />
						</a>
					<?php endforeach; ?>
					<span class="os-version"><?php echo esc_attr($require) ?></span> <!-- OS Prerequisite -->
									
				</div>	<!-- End Store Badges -->

			</div>
		</div>	<!-- END HERO TEXT -->


		<!-- HERO IMAGE -->
		<div class="col-md-5 col-lg-5 offset-lg-1 animated" data-animation="fadeInLeft" data-animation-delay="400">	
			<div class="hero-img">				
				<img class="img-fluid" src="<?php echo esc_url($image) ?>" alt="<?php echo esc_attr($title) ?>">
			</div>
		</div>


	</div>	  <!-- End row -->
</div>	<!-- END HERO-8 -->	