<?php
namespace ControlPatterns\Patterns;

class Core {
	
	private $core = 'control-block-patterns';

    public function __construct() { 
    	add_action( 'init', [ $this, 'init' ] );
    }

    public function init(){
    	
    	register_block_pattern_category(
		    $this->core,
		    array( 'label' => cbp_get_option('core_pattern_label', 'Control Block Patterns') )
		);
		
    	if(empty($_REQUEST['page'])){
			$this->unregister_categories();
		}
    	$this->register_categories();
    	$this->register_patterns(); 

		
		
    }

    /**
	 * Unregister Categories from settings
	 *
	 * @return void
	 */
    public function unregister_categories(){
    	$registered_categories = \WP_Block_Pattern_Categories_Registry::get_instance()->get_all_registered();
    	foreach ($registered_categories as $key => $category) {
    		if( empty($category['name']) ) continue;

    		$category_name = $category['name'];
    		$display = cbp_get_option('pattern_category_'.$category_name, 'on');
			
    		if( !empty($display) && $display == 'on' ){
    			$category_patterns = cbp_get_option('cbp_category_'.$category_name);
    			if(empty($category_patterns)) continue;
    			foreach ($category_patterns as $key => $category_pattern) {
    				unregister_block_pattern($category_pattern);
    			}
    			
    			
    		}
			if ($display == 'off') {
    			$this->unregister_block_patterns_by_category( $category_name );
    			unregister_block_pattern_category( $category_name );
    		}
    		
    	}      	

    }
    

    /**
	 * Register Custom Block Pattern Categories
	 *
	 * @return void
	 */
    public function register_categories() {
    	$terms = get_terms( array(
		    'taxonomy' => 'block_pattern_category',
		    'hide_empty' => true,
		));		

		if( !empty($terms) && !is_wp_error($terms)){			
			foreach ($terms as $key => $term) {				
				register_block_pattern_category(
				    $term->slug,
				    array( 
				    	'label' => esc_attr($term->name)
				    )
				);
			}
		}

		
    }

    /**
	 * Register Custom Block Patterns
	 *
	 * @return void
	 */
    public function register_patterns() {
    	$args = array(
		  'numberposts' => -1,
		  'post_type'   => 'ctrl_block_patterns'
		);		
		 
		$patterns = get_posts( $args );
		if ( $patterns ) {
	        foreach ( $patterns as $post ) : 
	            setup_postdata( $post ); 
	            $categories = get_the_terms($post, 'block_pattern_category');
	            $categories = !empty($categories)? array_column((array)$categories, 'slug') : ['control-block-patterns'];	           


	            $keywords = get_the_terms($post, 'block_pattern_tag');
	            $keywords = !empty($keywords)? array_column((array)$keywords, 'name') : '';
	            $viewportWidth = get_post_meta($post->ID, 'viewportWidth', true);
	            $viewportWidth = !empty($viewportWidth)? $viewportWidth : 1140;

	            register_block_pattern(
				    $this->core.'/'.sanitize_title($post->post_name),
				    array(
				        'title'       => esc_attr($post->post_title),
				        'categories' =>  $categories,
				        'keywords' => $keywords,
				        'description' => esc_attr(get_post_meta($post->ID, 'description', true)),
				        'content'     => $post->post_content,
				        'viewportWidth' => intval($viewportWidth)
				    )
				); 
	       
	        endforeach;
	        wp_reset_postdata();
	    }	   

		
    }

    /**
	 * Block Pattern removal by category
	 *
	 * @return void
	 */
    public function unregister_block_patterns_by_category($category_name){
    		$patterns = \WP_Block_Patterns_Registry::get_instance()->get_all_registered();
    		foreach ($patterns as $pattern) {
    			if( empty($pattern['categories']) ) continue;
    			if( !in_array($category_name, $pattern['categories']) ) continue;
    			unregister_block_pattern( $pattern['name'] );
    		}
    }


    /**
	 * Block Pattern removal
	 *
	 * @return void
	 */
	function remove_all_core_block_patterns() {


	    // Remove all Core Patterns
	    $registered_patterns = $this->get_block_pattern_names_list();

	    foreach ( $registered_patterns as $pattern_name => $title ) {
	        // if the name starts with 'core' remove it
	        if ( substr( $pattern_name, 0, strlen( 'core' ) ) === 'core' ) {
	            unregister_block_pattern( $pattern_name );
	        }
	    }
	}

	/**
	 * Get an array of the names of all registered block patterns
	 *
	 * @return array $pattern_names
	 */
	function get_block_pattern_names_list() {
	    $get_patterns  = $this->helper('registered_paterns');	  
	    return array_column($get_patterns, 'title', 'name' );
	}
	

	private static function helper($key = NULL){
		$_Helper = new Helper();
		if( !empty($_Helper->{$key}) )
		return $_Helper->{$key};
	}

   
}
