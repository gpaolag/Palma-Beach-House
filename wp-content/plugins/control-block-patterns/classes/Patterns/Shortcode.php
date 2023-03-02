<?php 
namespace ControlPatterns\Patterns;

class Shortcode {
	public function __construct() { 
		add_shortcode( 'control_block_patterns', [ $this, 'render' ] );
    }

	public function render($atts){
		
		$atts = shortcode_atts(
			[
				'id' => '',
				'title' => ''
			],
			$atts
		);

		$pattern_id = $atts['id'];
		unset( $atts['id'] );

		if( !empty($atts['title']) ){
			$pattern = get_page_by_title($atts['title'], OBJECT, 'ctrl_block_patterns');
		}elseif ( !empty($pattern_id) ) {
			$pattern = get_post($pattern_id);
		}else{
			$pattern = NULL;
		}
		

		if( empty( $pattern ) ) return;

		return \do_blocks($pattern->post_content);

	}

    
}