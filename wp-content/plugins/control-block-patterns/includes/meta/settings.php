<?php 
return array(
    [
        'desc'      => sprintf(esc_attr__('Block Patterns are predefined block layouts, available from the patterns tab of the block inserter. Once inserted into content, the blocks are ready for additional or modified content and configuration. %s', 'control-block-patterns'), '<p><a class="button" href="'.admin_url('edit.php?post_type=ctrl_block_patterns&page=directory').'">Insert Pattern Content from
Directory</a></p>'),
        'type'    => 'custom_html',
        'tab'    => 'patterns_settings',
    ],		
    array(
        'id'           => 'viewportWidth',
        'name'        => esc_html__( 'viewportWidth', 'control-block-patterns' ),
        'desc'         => '(optional) Number only. e.g. 1440 . An integer specifying the intended width of the pattern to allow for a scaled preview of the pattern in the inserter.',
        'std'          => '1140',
        'type'         => 'text',
        'rows'         => '2',
        'min'          => 100,
        'max'          => 5000,
        'admin_columns' => 'after author',
        'step'         => 1,
        'tab'          => 'patterns_settings',
    ),
    array(
        'id'           => 'description',
        'name'        => esc_html__( 'Description', 'control-block-patterns' ),
        'desc'         => '(optional): A visually hidden text used to describe the pattern in the inserter. A description is optional but it is strongly encouraged when the title does not fully describe what the pattern does. The description will help users discover the pattern while searching.',
        'std'          => '',
        'type'         => 'textarea',
        'rows'         => '2',
        'tab'          => 'patterns_settings',
    )
);