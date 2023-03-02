<?php 
$args = array(
    'hide_empty' => false,
);

if($tax_term != '') $args['include'] = $tax_term;

$terms = get_terms( 'portfolio_category', $args );
if( !empty($terms) ):
?>
<!--   PORTFOLIO  -->
<div class="row m-top-40">
	<div class="col-lg-12 portfolio-filter <?php echo pergo_default_color() ?>-btngroup text-center" data-active="<?php echo esc_attr($active) ?>">
		<div class="btn-toolbar">
			<div class="btn-group">	
				<span class="filter btn active" data-filter="all"><?php printf(_x('%s', 'All text', 'pergo'), ot_get_option('portfolio_all_text', 'All')); ?></span>
				<?php 
				foreach ($terms as $key => $value) {
					echo '<span class="filter btn'.(($value->slug == $active)? ' active' : '').'" data-filter="'.esc_attr($value->slug).'">'.esc_attr($value->name).'</span>';
				} 
				?>
			</div>		
		</div>	
	</div>	
</div>	
<?php endif; ?>	