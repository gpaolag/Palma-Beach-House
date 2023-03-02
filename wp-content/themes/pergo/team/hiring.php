<?php
$display_team_hiring = ot_get_option( 'display_team_hiring', 'on' );
if( $display_team_hiring == 'on' ):
	$team_hiring_title = ot_get_option( 'team_hiring_title', 'We Are Hiring!' );
	$team_hiring_title = sprintf( _x('%s', 'Team hiring title', 'pergo'), $team_hiring_title );
	$team_hiring_link_text = ot_get_option( 'team_hiring_link_text', 'Become part of our team' );
	$team_hiring_link_text = sprintf( _x('%s', 'Team hiring link text', 'pergo'), $team_hiring_link_text );	
	$team_hiring_link = ot_get_option( 'team_hiring_link', 'on' );
?>
	<div class="col-md-6 col-lg-4 animated" data-animation="fadeInUp" data-animation-delay="800">
		<div class="team-member">
			<!-- Team Member Photo -->						
			<img class="img-fluid" src="<?php echo PERGO_URI ?>/images/team-6.jpg" alt="<?php echo esc_attr($team_hiring_title) ?>">
			<!-- Team Member Meta -->			
			<div class="tm-hiring">	
				<h5 class="h5-sm"><?php echo esc_attr($team_hiring_title) ?></h5>
				<a class="<?php echo pergo_default_color(); ?>-color" href="<?php echo esc_url($team_hiring_link); ?>"><?php echo esc_attr($team_hiring_link_text) ?></a>
			</div>
		</div>	
	</div>	<!-- END TEAM MEMBER #6 -->
<?php endif; ?>