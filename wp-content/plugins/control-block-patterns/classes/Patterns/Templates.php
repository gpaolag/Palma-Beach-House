<?php 
namespace ControlPatterns\Patterns;

class Templates {
	public function __construct() { 
		// high priority
    	add_action( 'get_footer', [ $this, 'get_footer_template' ], 999, 2 );

    	//less priority
    	add_action( 'wp_head', [ $this, 'get_head_scripts' ], 1 );
    	add_action( 'wp_body_open', [ $this, 'get_body_scripts' ], 1 );
    	add_action( 'wp_footer', [ $this, 'get_footer_scripts' ], 1 );
    }

    public function get_footer_template( $name, $args ){
		$display_patterns = get_post_meta( get_the_ID(), 'cbp_display_patterns', true );
		if( !empty($display_patterns) && $display_patterns == 'on' ){
			$this->get_patterns();
		}
    	
    }

    public function get_head_scripts(){
    	$this->settings_script('scripts_in_header_display');    	
    	

    	$default_stylesheet = cbp_get_option( 'default_stylesheet' );
    	$custom_css_loaded_in = cbp_get_option( 'custom_css_loaded_in', 'plugin' );
    	if( ($custom_css_loaded_in == 'plugin') || ($default_stylesheet != 'off') ){
    		wp_enqueue_style( 'control-block-patterns' , CTRLBP_CSS_URI. 'control-block-patterns.css', false, CTRLBP_PATTERNS_VER );
    	}

		$handle = 'control-block-patterns';


    	$custom_css = cbp_get_option( 'custom_css', NULL );
    	if( empty($custom_css) ) return;

		
    	switch ($custom_css_loaded_in) {    	
    		case 'deps':
    			$dependency = cbp_get_option( 'deps_handle' );
    			if( !empty($dependency) )
    			$handle = $dependency;
    			break;	
    		
    		default:
    			break;
    	}

		$custom_css .= $this->responsive_css();

		wp_add_inline_style( $handle,  control_block_patterns_compress($custom_css) );
		
    	
    }

	public function responsive_css(){
		$custom_css = '';
		$responsive_css = cbp_get_option( 'responsive_css', [] );
		if( empty($responsive_css) ) return $custom_css;
		
		foreach($responsive_css as $screen){
			if( empty( $screen['css'] ) ) continue;
			extract(wp_parse_args( $screen, array(
				'media' => 'max-width',
				'size' => 767,
				'css' => '',
			) ));

			$custom_css .= '@media only screen and ('.$media.': '.$size.'px){ '.$css.' }';
		}
		return $custom_css;
	}

    public function get_body_scripts(){
    	$this->settings_script('scripts_in_body_display');
    }

    public function get_footer_scripts(){
    	$this->settings_script('scripts_in_footer_display');
    }

    private function settings_script( $id = NULL ){
    	if( empty($id) ) return;
    	$fileds = $this->settings_scripts_map();

    	if( empty($fileds[$id]) ) return;
    	if(  cbp_get_option( $id, 'off' ) != 'on' ) return;

    	echo cbp_get_option( $fileds[$id][0], '' );
    	
    }

    private function settings_scripts_map(){
    	return apply_filters( 
    		'control_block_patterns/settings_scripts_map',
    		array(
    			'scripts_in_header_display' => array( 'scripts_in_header' ),
    			'scripts_in_body_display' => array( 'scripts_in_body' ),
    			'scripts_in_footer_display' => array( 'scripts_in_footer' ),

    		)
    	);
    }

    private function get_patterns(){
    	$patterns = get_post_meta( get_the_ID(), 'cbp_patterns', true );
    	if( empty( $patterns ) ) return;

    	foreach ($patterns as $key => $value) {
    		if( empty($value) || empty($value['pattern']) ) continue;


    		$pattern = $this->get_post_by_name( $value['pattern'] );
    		if( empty( $pattern->post_content ) ) continue;
    		echo '<div class="cbp-clearfix"></div>';
    		echo \do_blocks($pattern->post_content);
			if( cbp_get_option('edit_post_link', 'off') == 'on' ){
				edit_post_link( __( 'Edit Block Pattern', 'control-block-patterns' ), '<p class="cbp-edit-post-link default-max-width">', '</p>', $pattern->ID );
			}			
            echo '<div class="cbp-clearfix"></div>';			
    	}
    }

    private function get_post_by_name($name, $post_type = "ctrl_block_patterns") {
	    $query = new \WP_Query([
	        "post_type" => $post_type,
	        "name" => $name
	    ]);

	    return $query->have_posts() ? reset($query->posts) : null;
	}
}