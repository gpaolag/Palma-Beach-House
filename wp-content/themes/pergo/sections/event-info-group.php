<?php 
$info = '';
if( !empty($paramsArr) ):
$i= 1;
$count = count($paramsArr);
?>

<div class="schedule-left">	

	<?php foreach ($paramsArr as $key => $value): extract($value); ?>
	<div class="row schedule-event">
				
		<!-- Event Time -->
		<div class="col-sm-3 event-time">
			<span><?php echo esc_attr($start) ?></span>
			<span><?php echo esc_attr($end) ?></span>
		</div>	

		<!-- Event Description -->
		<div class="col-sm-9 event-description">

			
			<h5 class="h5-lg"><?php echo esc_attr($title) ?></h5><!-- Title -->

			<p class="event-speaker"><?php echo do_shortcode(nl2br($subtitle)); ?></p><!-- Speaker -->
			
			<p class="p-small"><?php echo do_shortcode(nl2br($desc)); ?></p><!-- Short Description -->

			<p class="p-xs"><?php echo do_shortcode(nl2br($info)); ?></p><!-- Event Notice -->

			<?php echo ( $count != $i )? '<hr>' : ''; ?>

		</div>
									
	</div>	<!-- END SESSION <?php echo intval($i) ?> -->
	<?php $i++; endforeach; ?>
</div>
<?php endif; ?>