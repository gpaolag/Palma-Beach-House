<?php
namespace ControlPatterns\Patterns;

class Helper {

   public static function registered_paterns(){
		return \WP_Block_Patterns_Registry::get_instance()->get_all_registered(); 		
	}

	public static function registered_category_patterns($category_name){
		$registered_category_patterns = \WP_Block_Patterns_Registry::get_instance()->get_all_registered();
		$_pattern_choices = [];
		foreach ($registered_category_patterns as $pattern) {
			
			if( empty($pattern['categories'])  ) continue;
			if( !in_array($category_name, $pattern['categories']) ) continue;
	
			$_pattern_choices[ $pattern['name'] ] = $pattern['title'];

		}

		if(empty($_pattern_choices)) return;	
			

		return array(
			'id'           => 'cbp_category_'.$category_name,
			'name'        => esc_attr__( 'Disable Default Patterns?', 'control-block-patterns' ),
			'section'      => 'general',
			'type'         => 'checkbox_list',
			'options'		=> $_pattern_choices,
			'visible' => [ 'pattern_category_'.$category_name, '=', 'on' ],
			'desc'         => sprintf( __( 'Checked to be unregistered pattern from %1$s pattern category', 'control-block-patterns' ), '<code>'.$category_name.'</code>' ),
		);
		
		
	}

	public static function registered_categories(){		
		$registered_categories = \WP_Block_Pattern_Categories_Registry::get_instance()->get_all_registered();
		
		$_registered_categories = array();

		if( !empty($registered_categories) && !is_wp_error($registered_categories) ){
			foreach ($registered_categories as $value) {
						if($value['name'] == 'control-block-patterns') continue;
						$_registered_categories[] = array(
							'id'           => 'pattern_category_'.$value['name'],
							'name'        => $value['label'],
							'desc'         => sprintf( __( 'Use %1$s this to selectively remove all %2$s block patterns from the list of registered block patterns', 'control-block-patterns' ), '<code>OFF</code>', '<code>'.$value['label'].'</code>' ),
							'std'          => 'on',
							'type'         => 'on-off',
						);
						if(empty(self::registered_category_patterns($value['name']))) continue;
						$_registered_categories[] = self::registered_category_patterns($value['name']);
					}		
		}
		
		return $_registered_categories;
	}

	private function default_categories(){
		return array(
			'buttons' => _x( 'Buttons', 'Block pattern category', 'control-block-patterns' ),
			'columns' => _x( 'Columns', 'Block pattern category', 'control-block-patterns' ),
			'gallery' => _x( 'Gallery', 'Block pattern category', 'control-block-patterns' ),
			'header' => _x( 'Headers', 'Block pattern category', 'control-block-patterns' ),
			'text' => _x( 'Text', 'Block pattern category', 'control-block-patterns' ),
			'query' => _x( 'Query', 'Block pattern category', 'control-block-patterns' ) 
		);
	}	
	
	public static function get_post_by_name($name, $post_type = "ctrl_block_patterns") {
	    $query = new \WP_Query([
	        "post_type" => $post_type,
	        "name" => $name
	    ]);

	    return $query->have_posts() ? reset($query->posts) : null;
	}
	
    
}
