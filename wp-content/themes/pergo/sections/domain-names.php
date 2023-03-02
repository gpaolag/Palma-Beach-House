<?php
$total = count($paramsArr);
$i = 1;
?>
<?php if( !empty($paramsArr) ):  ?>
<div id="search-1" class="text-<?php echo esc_attr($align) ?>">
	<div class="search-form m-top-40"><?php echo do_shortcode($shortcode); ?></div>
	<div class="domain-names">
	<div class="row">	
		<?php foreach ($paramsArr as $key => $value): extract($value); extract($value); ?>
			
			<div class="col-sm-3 <?php if($total != $i) echo 'b-right'; ?>">
				<div class="dn-box">
					<p class="p-lg txt-500"><span class="<?php echo esc_attr($color) ?>-color"><?php echo esc_attr($title) ?></span> <span class="price txt-700"><?php echo esc_attr($subtitle) ?></span></p>
				</div>
			</div><!-- DOMAIN NAME BOX -->	
			
		<?php $i++; endforeach; ?>					
	</div>	
	</div>
</div>	
<?php endif; ?>