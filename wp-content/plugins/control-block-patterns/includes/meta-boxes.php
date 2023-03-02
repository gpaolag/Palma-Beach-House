<?php

function ctrl_block_patterns_meta_box(){

    $tabs = [ 
        'patterns_settings' => esc_attr__( 'Patterns Settings', 'control-block-patterns' )
    ];
    $meta_fields  = array();

	$meta_settings = apply_filters( 
		'control-block-patterns/meta/settings',  
		include __DIR__.'/meta/settings.php' 
	);
	$meta_fields = array_merge($meta_fields, $meta_settings);


	if( !empty($_GET['post']) ){
        $tabs['pattern_embed_tab'] =  esc_attr__( 'Pattern Embed', 'control-block-patterns' );
		$meta_embed = apply_filters( 
			'control-block-patterns/meta/embed', 
			include __DIR__.'/meta/embed.php' 
		);
		$meta_fields = array_merge($meta_fields, $meta_embed);
	}

    return [
            [   
                'id'             => 'ctrl_block_patterns',
                'title'          => esc_attr__('Block Patterns Data', 'control-block-patterns'),
                'post_types'      => [ 'ctrl_block_patterns' ],
                'context'        => 'normal', 
                'tab_style'       => 'left',
                'tabs'            => $tabs,
                'style'          => '',
                'fields'         => $meta_fields
            ]
        ]; 
    
    

}


function ctrlbp_meta_boxes(){
    $meta_boxes = ctrl_block_patterns_meta_box();

    
    
    $files = glob( __DIR__.'/meta-boxes/*.php');
    foreach($files as $file) {
        $_meta_box = include $file;
        if( !empty($_meta_box) ){
            $meta_boxes[] = $_meta_box;
        }
    }

    $files = glob( __DIR__.'/settings/*.php');    
    foreach($files as $file) {
        $_settings_box = include $file;
        if( !empty($_settings_box) ){
            $meta_boxes[] = $_settings_box;
        }
    }    

    return $meta_boxes;
}
