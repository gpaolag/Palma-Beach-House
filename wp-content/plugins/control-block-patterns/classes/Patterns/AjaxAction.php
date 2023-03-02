<?php 
namespace ControlPatterns\Patterns;

class AjaxAction {
	public function __construct() { 
        // Query Pattern
        add_action( 'wp_ajax_cbp-query-patterns', array( $this, 'query_patterns' ) );

        // Insert Pattern
    	add_action( 'wp_ajax_cbp-insert-pattern', array( $this, 'insert_pattern' ) );

    	
    }

    function insert_pattern(){
       
        $pattern_api = array();
		if( !empty($_REQUEST['id']) 
				&& is_numeric($_REQUEST['id']) 
				&& !empty($_REQUEST['source'])
				&& ( $_REQUEST['source']) == 'remote' ){

			$pattern_api = cbp_pattern_api($_REQUEST['id']);
            
		}

        if(!empty($pattern_api) && !is_wp_error($pattern_api) ){
            //unused field
            extract($pattern_api);
            $postarr = array(
                'post_title' => !empty($title['rendered'])? $title['rendered'] : 'Control Block Pattern #'.$id,
                'post_content' => !empty($pattern_content)? $pattern_content : '',
                'post_type' => 'ctrl_block_patterns',
                'meta_input'   => array(
                    'cbp_content' => !empty($pattern_content)? $pattern_content : '',
                    'display_preview' => 'on',
                    'description' => $meta['wpop_description'],
                    'viewportWidth'   => $meta['wpop_viewport_width'],
                    'viewportWidth'   => $meta['wpop_viewport_width'],                    
                    'content_rendered' => !empty($content['rendered'])? $content['rendered'] : '',
                    'cbp_pattern_api_result' => $pattern_api
                ),
            );
            $new_post_ID = wp_insert_post( $postarr, false, true );

            if( !empty( $new_post_ID ) && !is_wp_error($new_post_ID) ){
                $response = array(
                    'success' => true,
                    'data' => array(
                        'post_id' => $new_post_ID,
                        'button' => '<a href="'.admin_url('post.php?post='.$new_post_ID.'&action=edit').'" class="button button-primary cbp-edit-pattern">'.esc_attr__( 'Edit Pattern', 'control-block-patterns' ).'</a>',
                        'message' => esc_attr__( 'Pattern Inserted', 'control-block-patterns' )
                    )
                );
               
            }

        }

        $response = wp_parse_args( $response, 
        array(
            'success' => false,
            'data' => array(
                'post_id' => '',
                'button' => '',
                'message' => '',
            )
        ));

        wp_send_json_success( $response );
        wp_die();
    }

    function query_patterns(){
    	
		global $patterns_allowedtags, $pattern_field_defaults;

		

            $args = wp_parse_args(
                wp_unslash( $_REQUEST['request'] ),
                array(
                    'per_page' => $_REQUEST['request']['per_page'],				
                    'page' => !empty($_REQUEST['request']['page'])? $_REQUEST['request']['page'] : 1,	
                    'fields'   => array_merge(
                        (array) $pattern_field_defaults,
                        array(
                            'reviews_url' => false, // Explicitly request the reviews URL to be linked from the Add Themes screen.
                        )
                    ),
                )
            );



            if ( isset( $args['browse'] ) && 'favorites' === $args['browse'] && ! isset( $args['user'] ) ) {
                $user = get_user_option( 'wporg_favorites' );
                if ( $user ) {
                    $args['user'] = $user;
                }
            }

            $old_filter = isset( $args['browse'] ) ? $args['browse'] : '';

            $patterns = cbp_patterns_api( 'cbp_query_patterns', $args );
            $patterns = cbp_wp_prepare_patterns_for_js($patterns);
            

            $response = array(
                'info' => 
                [
                    'page' => $args['page'],
                    'pages' => ceil( 285 / count($patterns)),
                ],
                'themes' => $patterns
            );

            
        
            wp_send_json_success($response);
            
            
    }

    
}