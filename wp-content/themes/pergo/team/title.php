<?php $designation = get_post_meta( get_the_ID(), 'designation', true ); ?>
<span class="<?php echo pergo_default_color(); ?>-color"><?php echo esc_attr($designation) ?></span>

<?php the_title(pergo_team_title_before(), pergo_team_title_after()); ?><!-- Title -->